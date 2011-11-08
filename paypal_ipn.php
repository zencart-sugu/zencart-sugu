<?php

$_COOKIE['cookie_test'] = 'please_accept_for_session';
$_GET['main_page'] = 'checkout_process';

require_once(dirname(__FILE__) . '/includes/application_top.php');

// check client ip.
$hostName = strtolower(gethostbyaddr($_SERVER['REMOTE_ADDR']));
if ( MODULE_PAYMENT_PAYPAL_WPP_TEST == 'True' ) {
  $ipnHostName = 'ipn.sandbox.paypal.com';
}
else {
  $ipnHostName = 'notify.paypal.com';
}
$clientCheckOK = ($hostName == $ipnHostName) ? TRUE : FALSE;
if ( !$clientCheckOK ) {
  paypal_debug_log("invalid client=" . $_SERVER['REMOTE_ADDR'] . ",hostname=" . $hostName);
  exit;
}

// log id.
global $paypal_wpp_log_id;

// save raw post data.
$post_base64 = '';
$sep = '';
foreach ($_POST as $key => $value) {
  $post_base64 = $post_base64 . $sep . $key . '=' . $value;
  $sep = '&';
}
$post_base64 = base64_encode($post_base64);
$paypal_wpp_log_id = paypal_insert_log($post_base64);

if ( $_POST['payment_status'] != 'Completed' ) {
  paypal_save_and_mail_reject_reason("payment_status is " . $_POST['payment_status'], FALSE);
  exit;
}

$custom = $_POST['custom'];
if ( strlen($custom) == 0 ) {
  paypal_save_and_mail_reject_reason("custom parameter was not presented.");
  exit;
}

$parsed_custom = explode('-', $custom);
if ( count($parsed_custom) != 2 ) {
  paypal_save_and_mail_reject_reason("invalid custom=" . $custom);
  exit;
}
$paypal_session_unique_id = $parsed_custom[0];
$validate_value = md5($paypal_session_unique_id . MODULE_PAYMENT_PAYPAL_WPP_CUSTOM_KEY);
if ( $validate_value != $parsed_custom[1] ) {
  paypal_save_and_mail_reject_reason("invalid custom=" . $custom);
  exit;
}
paypal_debug_log("paypal_session_unique_id=" . $paypal_session_unique_id);

$sql = "SELECT session_id,saved_session,expiry FROM " . TABLE_PAYPAL_SESSION .
       " WHERE unique_id='" . (int)$paypal_session_unique_id . "'";
$result = $db->Execute($sql);
if ( $result->RecordCount() == 0 ) {
  paypal_save_and_mail_reject_reason("record not found. unique_id=" . $paypal_session_unique_id, FALSE);
  exit;
}
paypal_copy_session_data($paypal_session_unique_id);

paypal_debug_log('SESSIONID: Payer=' . $result->fields['session_id'] . ', IPN=' . session_id());

$_SESSION = unserialize(base64_decode($result->fields['saved_session']));
if ( $_SESSION === FALSE ) {
  paypal_save_and_mail_reject_reason("session restore failed.");
  exit;
}
paypal_save_customers_id($_SESSION['customer_id']);

if ( paypal_check_ipn() ) {
  paypal_debug_log("Order create.");
  $language_page_directory = DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
  require_once(dirname(__FILE__) . '/includes/modules/pages/checkout_process/header_php.php');
}

exit;





function paypal_check_ipn() {

  // read the post from PayPal system and add 'cmd'
  $req = 'cmd=_notify-validate';

  foreach ($_POST as $key => $value) {
  $value = urlencode($value);
    $req .= "&$key=$value";
  }

  if ( MODULE_PAYMENT_PAYPAL_WPP_TEST == 'True' ) {
    $paypalHostName = 'www.sandbox.paypal.com';
  }
  else {
    $paypalHostName = 'www.paypal.com';
  }

  // post back to PayPal system to validate
  $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
  $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
  $header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
  $errno = 0;
  $errstr = "";
  paypal_debug_log('Connect to ' . $paypalHostName);
  $fp = fsockopen('ssl://' . $paypalHostName, 443, $errno, $errstr, 30);

  global $paypal_transaction_id;

  // assign posted variables to local variables
  $payment_status = $_POST['payment_status'];
  $payment_amount = $_POST['mc_gross'];
  $payment_currency = $_POST['mc_currency'];
  $paypal_transaction_id = $_POST['txn_id'];

  if ($fp === FALSE) {
    // HTTP ERROR
    paypal_save_and_mail_reject_reason('connect failed. hostName=' . $paypalHostName);
    exit;
  }

  $received_invalid = FALSE;
  $payment_status_ok = FALSE;
  $payment_amount_ok = FALSE;
  $payment_currency_ok = FALSE;

  fputs ($fp, $header . $req);
  while (!feof($fp)) {
    $res = fgets ($fp, 1024);
    paypal_debug_log('received=' . $res);
    if (strcmp ($res, "VERIFIED") == 0) {
      // check the payment_status is Completed
      if ( $payment_status == 'Completed' ) {
        $payment_status_ok = TRUE;
      }

      // check that txn_id has not been previously processed

      // check that receiver_email is your Primary PayPal email

      // check that payment_amount/payment_currency are correct
      if ( $payment_amount == $_SESSION['paypal_subtotal'] ) {
        $payment_amount_ok = TRUE;
      }
      if ( $payment_currency == $_SESSION['paypal_currency'] ) {
        $payment_currency_ok = TRUE;
      }
    }
    else if (strcmp ($res, "INVALID") == 0) {
      // log for manual investigation
      paypal_save_and_mail_reject_reason('receive INVALID');
      $received_invalid = TRUE;
    }
  }

  fclose ($fp);

  if ( !$payment_status_ok ) {
    paypal_save_and_mail_reject_reason('payment_status differ. expect=Completed, actual=' . $payment_status);
  }
  if ( !$payment_amount_ok ) {
    paypal_save_and_mail_reject_reason('mc_gross differ. expect=' . $_SESSION['paypal_subtotal'] . ', actual=' . $payment_amount);
  }
  if ( !$payment_currency_ok ) {
    paypal_save_and_mail_reject_reason('mc_currency differ. expect=' . $_SESSION['paypal_currency'] . ', actual=' . $payment_currency);
  }

  return !$received_invalid && $payment_status_ok && $payment_amount_ok && $payment_currency_ok;
}


function paypal_insert_log($post_base64) {
  global $db;
  $sql = "INSERT INTO " . TABLE_PAYPAL_WPP_LOG . " (post_base64,created,updated)" .
         " VALUES(:post_base64,now(),now())";
  $sql = $db->bindVars($sql, ':post_base64', $post_base64, 'string');
  $db->Execute($sql);
  return $db->Insert_ID();
}


function paypal_copy_session_data($paypal_session_unique_id) {
  global $db, $paypal_wpp_log_id;
  $sql = "UPDATE " . TABLE_PAYPAL_WPP_LOG . " SET" .
         " session_id=(SELECT session_id FROM " . TABLE_PAYPAL_SESSION . " WHERE unique_id='" . (int)$paypal_session_unique_id . "')" .
         ",saved_session=(SELECT saved_session FROM " . TABLE_PAYPAL_SESSION . " WHERE unique_id='" . (int)$paypal_session_unique_id . "')" .
         ",expiry=(SELECT expiry FROM " . TABLE_PAYPAL_SESSION . " WHERE unique_id='" . (int)$paypal_session_unique_id . "')" .
         ",updated=now()" .
         " WHERE paypal_wpp_log_id='" . (int)$paypal_wpp_log_id . "'";
  $db->Execute($sql);
}


function paypal_save_customers_id($customers_id) {
  global $db, $paypal_wpp_log_id;
  $sql = "UPDATE " . TABLE_PAYPAL_WPP_LOG . " SET" .
         " customers_id='" . (int)$customers_id . "'" .
         ",updated=now()" .
         " WHERE paypal_wpp_log_id='" . (int)$paypal_wpp_log_id . "'";
  $db->Execute($sql);
}


function paypal_save_and_mail_reject_reason($reject_reason, $bSendMail = TRUE) {
  global $db, $paypal_wpp_log_id;
  $sql = "UPDATE " . TABLE_PAYPAL_WPP_LOG . " SET" .
         " reject_reason=:reject_reason" .
         ",updated=now()" .
         " WHERE paypal_wpp_log_id='" . (int)$paypal_wpp_log_id . "'";
  $sql = $db->bindVars($sql, ':reject_reason', $reject_reason, 'string');
  $db->Execute($sql);

  if ( $bSendMail && (strlen(MODULE_PAYMENT_PAYPAL_WPP_EMAIL) > 0) ) {
    mail(MODULE_PAYMENT_PAYPAL_WPP_EMAIL, 'IPN Error Message',
      'paypal_wpp_log_id=' . $paypal_wpp_log_id . "\r\n" .
      $reject_reason);
  }

  paypal_debug_log($reject_reason);
}


function paypal_debug_log($message) {
  $fp = fopen('temp/paypal.' . date('Ymd'), 'a');
  fwrite($fp, date('Y-m-d H:i:s', mktime()) . ' ' . $message . "\n");
  fclose($fp);
}

?>