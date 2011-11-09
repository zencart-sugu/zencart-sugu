<?php
/**
 * functions used by payment module class for Paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal_functions.php 3048 2006-02-16 23:40:21Z wilt $
 */
  function datetime_to_sql_format($paypalDateTime) {
    //Copyright (c) 2004 DevosC.com
    $months = array('Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05',  'Jun' => '06',  'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12');
    $hour = substr($paypalDateTime, 0, 2);$minute = substr($paypalDateTime, 3, 2);$second = substr($paypalDateTime, 6, 2);
    $month = $months[substr($paypalDateTime, 9, 3)];
    $day = (strlen($day = preg_replace("/,/" , '' , substr($paypalDateTime, 13, 2))) < 2) ? '0'.$day: $day;
    $year = substr($paypalDateTime, -8, 4);
    if (strlen($day)<2) $day = '0'.$day;
    return ($year . "-" . $month . "-" . $day . " " . $hour . ":" . $minute . ":" . $second);
  }

  function ipn_debug_email($message, $email_address = MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS, $always_send = false) {
    if (MODULE_PAYMENT_PAYPAL_IPN_DEBUG == 'Yes' || $always_send) {
      mail($email_address,'IPN DEBUG message', $message);
      ipn_add_error_log($message);
    }
  }
  function ipn_get_stored_session($session_stuff) {
    global $db;
    if (!is_array($session_stuff)) {
      ipn_debug_email('IPN FATAL ERROR::Could not find custom variable in post, cannot re-create session'); 
      return false;
    }
    $sql = "SELECT * FROM " . TABLE_PAYPAL_SESSION . " WHERE session_id = :sessionID";
    $sql = $db->bindVars($sql, ':sessionID', $session_stuff[1], 'string');
    $stored_session = $db->Execute($sql);
    if ($stored_session->recordCount() < 1) {
      ipn_debug_email('IPN FATAL ERROR::Could not find stored session in DB, cannot re-create session'); 
      return false;
    }
    $_SESSION = unserialize(base64_decode($stored_session->fields['saved_session']));
    return true;
  }
  function ipn_validate_transaction($info, $postArray) {
    if (!eregi("VERIFIED",$info)) {
      ipn_debug_email('IPN WARNING::Transaction was not marked as VERIFIED. IPN Info = ' . $info);
      return false;
    }
    if ($postArray['business'] != MODULE_PAYMENT_PAYPAL_BUSINESS_ID) {
      ipn_debug_email('IPN WARNING::Transaction email address not matched. From IPN = ' . $postArray['business'] . ': From CONFIG = ' .  MODULE_PAYMENT_PAYPAL_BUSINESS_ID);
      return false;
    }
    return true;
  }  
    function valid_payment($info, $amount, $currency) {
    if ( ($_POST['mc_currency'] != $currency) || ($_POST['mc_gross'] != $amount) && MODULE_PAYMENT_PAYPAL_TESTING == false ) {
      ipn_debug_email('IPN WARNING::Currency Mismatch for email address = ' . $_POST['business'] . ' | mc_currency = ' . $_POST['mc_currency'] . ' | $currency = ' . $currency . ' | mc_gross = ' . $_POST['mc_gross'] . " | $amount = " . $amount);
      return false;
    }
    return true;
  }

  function ipn_test_txn_uniqueness() {
    global $db;
    $txn_type = 'unknown';
    if (isset($_POST['txn_type']) && $_POST['txn_type'] == 'send_money') return $txn_type;
//    if (isset($_POST['txn_type']) && $_POST['txn_type'] == 'web_accept') return $txn_type;
    if (isset($_POST['parent_txn_id']) && $_POST['parent_txn_id'] != "") {
      $test_txn = $db->execute("select * from " . TABLE_PAYPAL . " where txn_id = '" . $_POST['parent_txn_id'] . "'");
      if ($test_txn->RecordCount() > 0) { 
        $txn_type = 'parent'; 
        return $txn_type;
      }
    }
    $test_txn = $db->execute("select * from " . TABLE_PAYPAL . " where txn_id = '" . $_POST['txn_id'] . "'");
    if ($test_txn->RecordCount() <= 0) {
      $txn_type = 'unique';
      return $txn_type;
    }
// OK its not unique or linked to a parent. There are one or 2 ways this can happen    
// it could be 
// 
// 1. could be an e-check denied
// 2. could be an e-check cleared
// 3. could be...
    if ($_POST['payment_status']=='Completed' && $_POST['payment_type']=='echeck') {
      $txn_type = 'echeck-cleared';
      return $txn_type;
    }
    if ($_POST['payment_status']=='Denied' && $_POST['payment_type']=='echeck') {  
      $txn_type = 'echeck-denied';
      return $txn_type;
    }
    return $txn_type;
  }
  function ipn_create_order_array($new_order_id, $txn_type) {
    $paypal_order = array('zen_order_id' => $new_order_id,
                          'txn_type' => $txn_type,
                          'reason_code' => $_POST['reason_code'],
                          'payment_type' => $_POST['payment_type'],
                          'payment_status' => $_POST['payment_status'],
                          'pending_reason' => $_POST['pending_reason'],
                          'invoice' => $_POST['invoice'],
                          'mc_currency' => $_POST['mc_currency'],
                          'first_name' => $_POST['first_name'],
                          'last_name' => $_POST['last_name'],
                          'payer_business_name' => $_POST['payer_business_name'],
                          'address_name' => $_POST['address_name'],
                          'address_street' => $_POST['address_street'],
                          'address_city' => $_POST['address_city'],
                          'address_state' => $_POST['address_state'],
                          'address_zip' => $_POST['address_zip'],
                          'address_country' => $_POST['address_country'],
                          'address_status' => $_POST['address_status'],
                          'payer_email' => $_POST['payer_email'],
                          'payer_id' => $_POST['payer_id'],
                          'payer_status' => $_POST['payer_status'],
                          'payment_date' => datetime_to_sql_format($_POST['payment_date']),
                          'business' => $_POST['business'],
                          'receiver_email' => $_POST['receiver_email'],
                          'receiver_id' => $_POST['receiver_id'],
                          'txn_id' => $_POST['txn_id'],
                          'parent_txn_id' => $_POST['parent_txn_id'],
                          'num_cart_items' => $_POST['num_cart_items'],
                          'mc_gross' => $_POST['mc_gross'],
                          'mc_fee' => $_POST['mc_fee'],
                          'settle_amount' => $_POST['settle_amount'],
                          'settle_currency' => $_POST['settle_currency'],
                          'exchange_rate' => $_POST['exchange_rate'],
                          'notify_version' => $_POST['notify_version'],
                          'verify_sign' => $_POST['verify_sign'],
                          'date_added' => 'now()',
                          'memo' => $_POST['memo']
                         );
    return $paypal_order;
  }
  function ipn_create_order_history_array($insert_id) {
    $paypal_order_history = array ('paypal_ipn_id' => $insert_id,
                                   'txn_id' => $_POST['txn_id'],
                                   'parent_txn_id' => $_POST['parent_txn_id'],
                                   'payment_status' => $_POST['payment_status'],
                                   'pending_reason' => $_POST['pending_reason'],
                                   'date_added' => 'now()'
                                  );
    return $paypal_order_history;
  }
  function ipn_create_order_update_array($txn_type) {
    $paypal_order = array('reason_code' => $_POST['reason_code'],
                          'payment_type' => $_POST['payment_type'],
                          'txn_type' => $txn_type,
                          'parent_txn_id' => $_POST['parent_txn_id'],
                          'payment_status' => $_POST['payment_status'],
                          'pending_reason' => $_POST['pending_reason'],
                          'invoice' => $_POST['invoice'],
                          'mc_currency' => $_POST['mc_currency'],
                          'first_name' => $_POST['first_name'],
                          'last_name' => $_POST['last_name'],
                          'payer_business_name' => $_POST['payer_business_name'],
                          'address_name' => $_POST['address_name'],
                          'address_street' => $_POST['addrss_street'],
                          'address_city' => $_POST['address_city'],
                          'address_state' => $_POST['address_state'],
                          'address_zip' => $_POST['address_zip'],
                          'address_country' => $_POST['address_country'],
                          'payer_email' => $_POST['payer_email'],
                          'payer_id' => $_POST['payer_id'],
                          'business' => $_POST['business'],
                          'receiver_email' => $_POST['receiver_email'],
                          'receiver_id' => $_POST['receiver_id'],
                          'num_cart_items' => $_POST['num_cart_items'],
                          'mc_gross' => $_POST['mc_gross'],
                          'mc_fee' => $_POST['mc_fee'],
                          'settle_amount' => $_POST['settle_amount'],
                          'settle_currency' => $_POST['settle_currency'],
                          'exchange_rate' => $_POST['exchange_rate'],
                          'notify_version' => $_POST['notify_version'],
                          'verify_sign' => $_POST['verify_sign'],
                          'last_modified' => 'now()'
                         );
    return $paypal_order;
  }
  function ipn_simulate_ipn_handler($count) {
    global $db;
    $sql = "select * from paypal_testing order by paypal_ipn_id desc limit " . $count;
    $paypal_testing = $db->execute($sql);
    while (!$paypal_testing->EOF) {
      $paypal_fields[] = $paypal_testing->fields;
      $paypal_testing->moveNext();
    }
    $paypal_fields = array_reverse($paypal_fields);
    foreach ($paypal_fields as $value) {
      foreach($value as $i=>$v) {
        $postdata .= $i . "=" . urlencode(stripslashes($v)) . "&"; 
      }
      $address = HTTP_SERVER . DIR_WS_CATALOG . 'ipn_main_handler.php?' . $postdata;
      $response = ipn_fopen($address);
      echo $response;
    }
  }
  function ipn_add_error_log($message) {
    if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
//      echo date('D M Y G:i') . ' -- ' . $message . "\n";
    }
    $fp = @fopen('ipn.log', 'a');
    @fwrite($fp, date('D M Y G:i') . ' -- ' . $message . "\n");
    @fclose($fp);
  }
  function ipn_fopen($filename) {
    $response = '';
    $fp = fopen($filename,'rb');
    if ($fp) {
      $response = getRequestBodyContents($fp);
      @fclose($fp);
    }
    return $response;
  }
  function getRequestBodyContents(&$handle) {
    if ($handle) {
      while(!feof($handle)) {
        $line .= @fgets($handle, 1024);
      }
      return $line;
    }
    return false;
  }

  function paypal_language_convert($name) {
    if (strtolower($name) == "english")  return "US";
    if (strtolower($name) == "japanese") return "JP";
    return "US";
  }

  function paypal_esacpe_parm($parm) {
    $parm = mb_convert_encoding($parm, "UTF-8", CHARSET);
    $parm = urlencode($parm);
//    $parm = htmlspecialchars($parm);
    return $parm;
  }

  function paypal_convert_money_string($value) {
    $str = "";
    for($i=0; $i<strlen($value); $i++) {
      if (substr($value, $i, 1) == "." ||
          substr($value, $i, 1) == "-" ||
          substr($value, $i, 1) >= "0" &&
          substr($value, $i, 1) <= "9")
        $str .= substr($value, $i, 1);
    }
    return (float)$str;
  }

  function paypal_get_ot_total($order, $order_total_modules, $text=true) {
    $order_totals = $order_total_modules->process();

    $total = (int)$order->info['total'];
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_total') {
        if ($text)
          return paypal_convert_money_string($order_total['text']);
        else
          return (float)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_get_ot_subtotal($order, $order_total_modules) {
    $order_totals = $order_total_modules->process();

    $total = (int)$order->info['subtotal'];
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_subtotal') {
        return paypal_convert_money_string($order_total['text']);
//        return (int)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_get_ot_shipping($order, $order_total_modules) {
    $order_totals = $order_total_modules->process();

    $total = (int)$order->info['shipping_cost'];
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_shipping') {
        return paypal_convert_money_string($order_total['text']);
//        return (int)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_get_ot_loworderfee($order, $order_total_modules) {
    $order_totals = $order_total_modules->process();

    $total = 0;
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_loworderfee') {
        return paypal_convert_money_string($order_total['text']);
//        return (int)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_get_ot_tax($order, $order_total_modules) {
    $order_totals = $order_total_modules->process();

    $total = (int)$order->info['tax'];
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_tax') {
        return paypal_convert_money_string($order_total['text']);
//        return (int)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_get_ot_coupon($order, $order_total_modules) {
    $order_totals = $order_total_modules->process();

    $total = 0;
    foreach ($order_totals as $order_total) {
      if ($order_total['code'] == 'ot_coupon') {
        return -paypal_convert_money_string($order_total['text']);
//        return -(int)$order_total['value'];
      }
    }

    return $total;
  }

  function paypal_nvpHeader($methodName) {
    $nvpHeaderStr = "";
    if (defined('PAYPAL_AUTH_MODE')) {
      //$AuthMode = "3TOKEN"; //Merchant's API 3-TOKEN Credential is required to make API Call.
      //$AuthMode = "FIRSTPARTY"; //Only merchant Email is required to make EC Calls.
      //$AuthMode = "THIRDPARTY";Partner's API Credential and Merchant Email as Subject are required.
      $AuthMode = PAYPAL_AUTH_MODE;
    }
    else {
      $AuthMode = "3TOKEN";
    }

    switch($AuthMode) {
      case "3TOKEN":
        $nvpHeaderStr = "&PWD=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_PASS)."&USER=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_ID)."&SIGNATURE=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_SIGNATURE);
        break;
      case "FIRSTPARTY":
        $nvpHeaderStr = "&SUBJECT=".urlencode($subject);
        break;
      case "THIRDPARTY":
        $nvpHeaderStr = "&PWD=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_PASS)."&USER=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_ID)."&SIGNATURE=".urlencode(MODULE_PAYMENT_PAYPAL_EC_BUSINESS_SIGNATURE)."&SUBJECT=".urlencode($subject);
        break;    
      case "PERMISSION":
        $nvpHeaderStr = formAutorization($AUTH_token,$AUTH_signature,$AUTH_timestamp);
        break;
    }
    return $nvpHeaderStr;
  }

  function paypal_hash_call($methodName, $nvpStr) {
    // form header string
    $nvpheader = paypal_nvpHeader($methodName);

    //setting the curl parameters.
    $ch = curl_init();
    if (MODULE_PAYMENT_PAYPAL_EC_TEST == 'True')
      curl_setopt($ch, CURLOPT_URL, PAYPAL_EC_API_ENDPOINT_TEST);
    else
      curl_setopt($ch, CURLOPT_URL, PAYPAL_EC_API_ENDPOINT);
    curl_setopt($ch, CURLOPT_VERBOSE, 1);

    //turning off the server and peer verification(TrustManager Concept).
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_POST, 1);

    //in case of permission APIs send headers as HTTPheders
//    if(!empty($AUTH_token) && !empty($AUTH_signature) && !empty($AUTH_timestamp)) {
//      $headers_array[] = "X-PP-AUTHORIZATION: ".$nvpheader;
//      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_array);
//      curl_setopt($ch, CURLOPT_HEADER, false);
//    }
//    else {
      $nvpStr=$nvpheader.$nvpStr;
//    }

    //if USE_PROXY constant set to TRUE in Constants.php, then only proxy will be enabled.
    //Set proxy name to PROXY_HOST and port number to PROXY_PORT in constants.php 
    if (PAYPAL_USE_PROXY)
      curl_setopt ($ch, CURLOPT_PROXY, PAYPAL_PROXY_HOST.":".PAYPAL_PROXY_PORT); 

    //check if version is included in $nvpStr else include the version.
    if(strlen(str_replace('VERSION=', '', strtoupper($nvpStr))) == strlen($nvpStr)) {
      $nvpStr = "&VERSION=" . urlencode(PAYPAL_EC_VERSION) . $nvpStr;
    }

    $nvpreq="METHOD=".urlencode($methodName).$nvpStr;

    //setting the nvpreq as POST FIELD to curl
    curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

    //getting response from server
    $id       = paypal_create_log($_SESSION['customer_id'], $methodName, $nvpreq);
    $response = curl_exec($ch);
    paypal_update_log($id, $response);

    //convrting NVPResponse to an Associative Array
    $nvpResArray             = paypal_deformatNVP($response);
    $nvpReqArray             = paypal_deformatNVP($nvpreq);

    if (curl_errno($ch)) {
      $nvpResArray['ACK']            = "ERROR";
      $nvpResArray['L_LONGMESSAGE0'] = curl_error($ch)."[".curl_errno($ch)."]";
    }
    curl_close($ch);

    return $nvpResArray;
  }

  function paypal_deformatNVP($nvpstr) {
  	$intial=0;
   	$nvpArray = array();


  	while(strlen($nvpstr)) {
  		//postion of Key
  		$keypos= strpos($nvpstr,'=');
  		//position of value
  		$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);

  		/*getting the Key and Value values and storing in a Associative Array*/
  		$keyval=substr($nvpstr,$intial,$keypos);
  		$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
  		//decoding the respose
  		$nvpArray[urldecode($keyval)] =urldecode( $valval);
  		$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
    }
  	return $nvpArray;
  }

  function paypal_create_log($customers_id, $method, $request) {
    global $db;

    $query = "insert into ".TABLE_PAYPAL_LOG." (customers_id, method, request, created) values(".(int)$customers_id.", '".zen_db_input($method)."', '".zen_db_input($request)."', now())";
    $db->Execute($query);

    return $db->Insert_ID();
  }

  function paypal_update_log($paypal_log_id, $response) {
    global $db;

    $nvpResArray = paypal_deformatNVP($response);
    $query       = "update ".TABLE_PAYPAL_LOG." set response='".zen_db_input($response)."',ack='".zen_db_input($nvpResArray['ACK'])."',updated=now() where paypal_log_id=".(int)$paypal_log_id;
    $db->Execute($query);
  }

  function paypal_get_default_currency() {
    global $currencies;

    foreach($currencies->currencies as $k => $c) {
      if ($c['value'] == 1)
        return $k;
    }

    return "";
  }
?>
