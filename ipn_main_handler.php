<?php
/**
 * ipn_main_handler.php callback handler for paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ipn_main_handler.php 3475 2006-04-22 04:35:09Z ajeh $
 */
/**
 * require general paypal functions
 */
require('includes/modules/payment/paypal/paypal_functions.php');
/**
 * require custom paypal application_top.php
 */
require('includes/modules/payment/paypal/ipn_application_top.php');
/**
 * require language defines
 */
if (!isset($_SESSION['language'])) $_SESSION['language'] = 'english';
if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php')) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'checkout_process.php');
} else {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/checkout_process.php');
}
//require('includes/languages/english/checkout_process.php');

$scheme = 'http://';
if (ENABLE_SSL == 'true') $scheme = 'http://';
//Parse url
$web = parse_url($scheme . MODULE_PAYMENT_PAYPAL_HANDLER);

//build post string
foreach($_POST as $i=>$v) {
  $postdata .= $i . "=" . urlencode(stripslashes($v)) . "&";
}

$postdata .= "cmd=_notify-validate";

if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
  $info = "VERIFIED";
} else {
  //Set the port number
  if($web['scheme'] == "https") {
    $web['port']="443";  $ssl="ssl://";
  } else {
    $web['port']="80";
  }

  //Create paypal connection
  $fp=@fsockopen($ssl . $web['host'],$web['port'],$errnum,$errstr,30);

  if(!$fp) {
    ipn_debug_email('IPN FATAL ERROR::Could not establish fsockopen. Host Details = ' . $ssl . $web['host'] . ':' . $web['port']);
    die();
  }


  //Post Data

  fputs($fp, "POST $web[path] HTTP/1.1\r\n");
  fputs($fp, "Host: $web[host]\r\n");
  fputs($fp, "Content-type: application/x-www-form-urlencoded\r\n");
  fputs($fp, "Content-length: ".strlen($postdata)."\r\n");
  fputs($fp, "Connection: close\r\n\r\n");
  fputs($fp, $postdata . "\r\n\r\n");

  //loop through the response from the server
  while(!feof($fp)) {
    $info[]=@fgets($fp, 1024);
  }

  //close fp - we are done with it
  fclose($fp);

  //break up results into a string
  $info = implode(",",$info);
}

ipn_debug_email('IPN INFO - POST VARS  ' . "\n" . $postdata);
ipn_debug_email('IPN INFO - CURL INFO  ' . "\n" . $info);


if (SEND_PAYPAL_TRANS_DETAILS == 'Yes') ipn_debug_email('IPN INFO::Transaction Details # ' . $info, '', true);

if (!ipn_validate_transaction($info, $_POST) === true) {
  ipn_debug_email('IPN FATAL ERROR::Transaction did not validate');
  die();
}
/**
 * reaquire shipping class
 */
require(DIR_WS_CLASSES . 'shipping.php');
/**
 * require payment class
 */
require(DIR_WS_CLASSES . 'payment.php');
$payment_modules = new payment($_SESSION['payment']);
$shipping_modules = new shipping($_SESSION['shipping']);
/**
 * require order class
 */
require(DIR_WS_CLASSES . 'order.php');
$order = new order();
/**
 * require order_total class
 */
require(DIR_WS_CLASSES . 'order_total.php');
$order_total_modules = new order_total();
$order_totals = $order_total_modules->process();

$txn_type = ipn_test_txn_uniqueness();
ipn_debug_email('IPN NOTICE:set transaction type ' . $txn_type . ' postdata=' . $postdata);
// For now we filter out subscription payments
if ($_POST['txn_type'] == 'subcr_payment') {
  ipn_debug_email('IPN NOTICE: Subscription payemnt - Filter for now');
  die();
}
switch ($txn_type) {
  case 'unique':
  if (valid_payment($info, $order->info['total'], $_SESSION['currency']) === false) {
    die();
  }
  if ($ipnFoundSession === false) {
    ipn_debug_email('IPN NOTICE: Unique but no session - Must be a one of personal payment');
    die();
  }
  $new_order_id = $order->create($order_totals);
  $paypal_order = ipn_create_order_array($new_order_id, $txn_type);
  zen_db_perform(TABLE_PAYPAL, $paypal_order);
  $insert_id = $db->Insert_ID();
  $paypal_order_history = ipn_create_order_history_array($insert_id);
  zen_db_perform(TABLE_PAYPAL_PAYMENT_STATUS_HISTORY, $paypal_order_history);
  $new_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
  if ($_POST['payment_status'] =='Pending') {
    $new_status = MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID;
    $db->Execute("update " . TABLE_ORDERS  . "
                    set orders_status = " . MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID . "
                    where orders_id = '" . $new_order_id . "'");
  }
  $sql_data_array = array('orders_id' => $new_order_id,
                          'orders_status_id' => $new_status,
                          'date_added' => 'now()',
                          'comments' => 'PayPal status: ' . $_POST['payment_status'] . ' ' . $_POST['pending_reason']. ' @ '.$_POST['payment_date'] . ' Parent Trans ID:' . $_POST['parent_txn_id'] . ' Trans ID:' . $_POST['txn_id'] . ' Amount: ' . $_POST['mc_gross'],
                          'customer_notified' => false
  );

  zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
  $order->create_add_products($new_order_id, 2);
  $order->send_order_email($new_order_id, 2);
  $_SESSION['cart']->reset(true);
  break;
  case 'parent':
  case 'echeck-denied':
  case 'echeck-cleared':
  if ($txn_type == 'parent') {
    $ipn_id = $db->Execute("select zen_order_id, paypal_ipn_id
                              from " . TABLE_PAYPAL . "
                              where txn_id = '" . $_POST['parent_txn_id'] . "'");
  } else {
    $ipn_id = $db->Execute("select zen_order_id, paypal_ipn_id
                              from " . TABLE_PAYPAL . "
                              where txn_id = '" . $_POST['txn_id'] . "'");
  }
  if ($txn_type == 'parent') {
    $paypal_order = ipn_create_order_array($ipn_id->fields['zen_order_id'], $txn_type);
    zen_db_perform(TABLE_PAYPAL, $paypal_order);
  } else {
   $paypal_order = ipn_create_order_update_array($txn_type);
   zen_db_perform(TABLE_PAYPAL, $paypal_order, 'update', "txn_id='" . $_POST['txn_id'] . "'");
  }
  $paypal_order_history = ipn_create_order_history_array($ipn_id->fields['paypal_ipn_id']);
//payment_status=Refunded
  if ($_POST['payment_status'] == 'Refunded' || $_POST['payment_status'] == 'Denied') {
    $new_status = MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID;
  } elseif ($txn_type=='echeck-cleared') {
    $new_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
  }
  ipn_debug_email('IPN NOTICE:set new status ' . $new_status . ' for reason_code = ' . $_POST['pending_reason'] . " order id = " .  $ipn_id->fields['zen_order_id']);

  if ($_POST['payment_status'] == 'Refunded' || $_POST['payment_status'] == 'Denied' || $txn_type=='echeck-cleared') {
    $db->Execute("update " . TABLE_ORDERS  . "
                    set orders_status = '" . $new_status . "'
                    where orders_id = '" . $ipn_id->fields['zen_order_id'] . "'");

    $sql_data_array = array('orders_id' => $ipn_id->fields['zen_order_id'],
    'orders_status_id' => $new_status,
    'date_added' => 'now()',
    'comments' => 'PayPal status: ' . $_POST['payment_status'] . ' ' . ' @ '.$_POST['payment_date'] . ' Parent Trans ID:' . $_POST['parent_txn_id'] . ' Trans ID:' . $_POST['txn_id'] . ' Amount: ' . $_POST['mc_gross'],
    'customer_notified' => false
    );

    zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
  }
  break;
  default:
  ipn_debug_email('IPN WARNING:Could not establish txn type ' . $txn_type . ' postdata=' . $postdata);
}
?>