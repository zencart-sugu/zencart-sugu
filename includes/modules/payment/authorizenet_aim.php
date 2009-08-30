<?php
/**
 * autorize.net AIM payment method class
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: authorizenet_aim.php 3308 2006-03-29 08:21:33Z ajeh $
 */
/**
 * Authorize.net Payment Module (AIM version)
 * You must have SSL active on your server to be compliant with merchant TOS
 *
 */
class authorizenet_aim extends base {
  /**
   * $code determines the internal 'code' name used to designate "this" payment module
   *
   * @var string
   */
  var $code;
  /**
   * $title is the displayed name for this payment method
   *
   * @var string
   */
  var $title;
  /**
   * $description is a soft name for this payment method
   *
   * @var string
   */
  var $description;
  /**
   * $enabled determines whether this module shows or not... in catalog.
   *
   * @var boolean
   */
  var $enabled;
  /**
   * $response tracks response information returned from the AIM gateway
   *
   * @var string/array
   */
  var $response;
  /**
     * Constructor
     *
     * @return authorizenet_aim
     */
  function authorizenet_aim() {
    global $order;
    $this->code = 'authorizenet_aim';
    if ($_GET['main_page'] != '') {
      $this->title = MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE; // Payment module title in Catalog
    } else {
      $this->title = MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_ADMIN_TITLE; // Payment module title in Admin
    }
    $this->description = MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_DESCRIPTION; // Descriptive Info about module in Admin
    $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_AIM_STATUS == 'True') ? true : false); // Whether the module is installed or not
    $this->sort_order = MODULE_PAYMENT_AUTHORIZENET_AIM_SORT_ORDER; // Sort Order of this payment option on the customer payment page
    $this->form_action_url = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false); // Page to go to upon submitting page info

    if ((int)MODULE_PAYMENT_AUTHORIZENET_AIM_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_AUTHORIZENET_AIM_ORDER_STATUS_ID;
    }

    if (is_object($order)) $this->update_status();
  }
  /**
   * calculate zone matches and flag settings to determine whether this module should display to customers or not
   *
   */
  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_AUTHORIZENET_AIM_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_AUTHORIZENET_AIM_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
      while (!$check->EOF) {
        if ($check->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
        $check->MoveNext();
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }
  }
  /**
   * JS validation which does error-checking of data-entry if this module is selected for use
   * (Number, Owner, and CVV Lengths)
   *
   * @return string
   */
  function javascript_validation() {
    $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
    '    var cc_owner = document.checkout_payment.authorizenet_aim_cc_owner.value;' . "\n" .
    '    var cc_number = document.checkout_payment.authorizenet_aim_cc_number.value;' . "\n";
    if (MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV == 'True')  {
      $js .= '    var cc_cvv = document.checkout_payment.authorizenet_aim_cc_cvv.value;' . "\n";
    }
    $js .= '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_OWNER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n" .
    '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_NUMBER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n";
    if (MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV == 'True')  {
      $js .= '    if (cc_cvv == "" || cc_cvv.length < "3" || cc_cvv.length > "4") {' . "\n".
      '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_JS_CC_CVV . '";' . "\n" .
      '      error = 1;' . "\n" .
      '    }' . "\n" ;
    }
    $js .= '  }' . "\n";

    return $js;
  }
  /**
   * Display Credit Card Information Submission Fields on the Checkout Payment Page
   *
   * @return array
   */
  function selection() {
    global $order;

    for ($i=1; $i<13; $i++) {
      $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
    }

    $today = getdate();
    for ($i=$today['year']; $i < $today['year']+10; $i++) {
      $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
    }
    if (MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV == 'True') {
      $selection = array('id' => $this->code,
                         'module' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE,
                         'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => zen_draw_input_field('authorizenet_aim_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'], 'id="'.$this->code.'-cc-owner"'),
                                                 'tag' => $this->code.'-cc-owner'),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => zen_draw_input_field('authorizenet_aim_cc_number', '', 'id="'.$this->code.'-cc-number"'),
                                                 'tag' => $this->code.'-cc-number'),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => zen_draw_pull_down_menu('authorizenet_aim_cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"') . '&nbsp;' . zen_draw_pull_down_menu('authorizenet_aim_cc_expires_year', $expires_year),
                                                 'tag' => $this->code.'-cc-expires-month'),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CVV,
                                                 'field' => zen_draw_input_field('authorizenet_aim_cc_cvv','', 'size="4", maxlength="4"' . ' id="'.$this->code.'-cc-cvv"'),
                                                 'tag' => $this->code.'-cc-cvv')
			 ));
    } else {
      $selection = array('id' => $this->code,
                         'module' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE,
                         'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => zen_draw_input_field('authorizenet_aim_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => zen_draw_input_field('authorizenet_aim_cc_number')),
                                           array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => zen_draw_pull_down_menu('authorizenet_aim_cc_expires_month', $expires_month) . '&nbsp;' . zen_draw_pull_down_menu('authorizenet_aim_cc_expires_year', $expires_year))));
    }
    return $selection;
  }
  /**
   * Evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   *
   */
  function pre_confirmation_check() {
    global $_POST, $messageStack;

    include(DIR_WS_CLASSES . 'cc_validation.php');

    $cc_validation = new cc_validation();
    $result = $cc_validation->validate($_POST['authorizenet_aim_cc_number'], $_POST['authorizenet_aim_cc_expires_month'], $_POST['authorizenet_aim_cc_expires_year'], $_POST['authorizenet_aim_cc_cvv']);
    $error = '';
    switch ($result) {
      case -1:
      $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
      break;
      case -2:
      case -3:
      case -4:
      $error = TEXT_CCVAL_ERROR_INVALID_DATE;
      break;
      case false:
      $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
      break;
    }

    if ( ($result == false) || ($result < 1) ) {
      $payment_error_return = 'payment_error=' . $this->code . '&authorizenet_aim_cc_owner=' . urlencode($_POST['authorizenet_aim_cc_owner']) . '&authorizenet_aim_cc_expires_month=' . $_POST['authorizenet_aim_cc_expires_month'] . '&authorizenet_aim_cc_expires_year=' . $_POST['authorizenet_aim_cc_expires_year'];
      $messageStack->add_session('checkout_payment', $error . '['.$this->code.']', 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
    }

    $this->cc_card_type = $cc_validation->cc_type;
    $this->cc_card_number = $cc_validation->cc_number;
    $this->cc_expiry_month = $cc_validation->cc_expiry_month;
    $this->cc_expiry_year = $cc_validation->cc_expiry_year;
  }
  /**
   * Display Credit Card Information on the Checkout Confirmation Page
   *
   * @return array
   */
  function confirmation() {
    global $_POST;

    if (MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV == 'True') {
      $confirmation = array(//'title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE, // Redundant
                            'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_TYPE,
                                                    'field' => $this->cc_card_type),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['authorizenet_aim_cc_owner']),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['authorizenet_aim_cc_expires_month'], 1, '20' . $_POST['authorizenet_aim_cc_expires_year']))),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CVV,
                                                    'field' => $_POST['authorizenet_aim_cc_cvv'])));
    } else {
      $confirmation = array(//'title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CATALOG_TITLE, // Redundant
                            'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_TYPE,
                                                    'field' => $this->cc_card_type),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $_POST['authorizenet_aim_cc_owner']),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['authorizenet_aim_cc_expires_month'], 1, '20' . $_POST['authorizenet_aim_cc_expires_year'])))));
    }
    return $confirmation;
  }
  /**
   * Build the data and actions to process when the "Submit" button is pressed on the order-confirmation screen.
   * This sends the data to the payment gateway for processing.
   * (These are hidden fields on the checkout confirmation page)
   *
   * @return string
   */
  function process_button() {
    $process_button_string = zen_draw_hidden_field('cc_owner', $_POST['authorizenet_aim_cc_owner']) .
                             zen_draw_hidden_field('cc_expires', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
                             zen_draw_hidden_field('cc_type', $this->cc_card_type) .
                             zen_draw_hidden_field('cc_number', $this->cc_card_number);
    if (MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV == 'True') {
      $process_button_string .= zen_draw_hidden_field('cc_cvv', $_POST['authorizenet_aim_cc_cvv']);
    }

    $process_button_string .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

    return $process_button_string;
    return false;
  }
  /**
   * Store the CC info to the order and process any results that come back from the payment gateway
   *
   */
  function before_process() {
    global $_POST, $response, $db, $order, $messageStack;

    if (MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_NUMBER == 'True') {
      $order->info['cc_number'] = $_POST['cc_number'];
    }
    $order->info['cc_expires'] = $_POST['cc_expires'];
    $order->info['cc_type'] = $_POST['cc_type'];
    $order->info['cc_owner'] = $_POST['cc_owner'];
    $order->info['cc_cvv'] = $_POST['cc_cvv'];

    // DATA PREPARATION SECTION
    unset($submit_data);  // Cleans out any previous data stored in the variable

    // Create a string that contains a listing of products ordered for the description field
    $description = '';
    for ($i=0; $i<sizeof($order->products); $i++) {
      $description .= $order->products[$i]['name'] . '(qty: ' . $order->products[$i]['qty'] . ') + ';
    }
    // Remove the last "\n" from the string
    $description = substr($description, 0, -2);

    // Create a variable that holds the order time
    $order_time = date("F j, Y, g:i a");

    // Calculate the next expected order id
    $last_order_id = $db->Execute("select * from " . TABLE_ORDERS . " order by orders_id desc limit 1");
    $new_order_id = $last_order_id->fields['orders_id'];
    $new_order_id = ($new_order_id + 1);

    // Populate an array that contains all of the data to be sent to Authorize.net
    $submit_data = array(
                         'x_login' => MODULE_PAYMENT_AUTHORIZENET_AIM_LOGIN, // The login name is assigned by authorize.net
                         'x_tran_key' => MODULE_PAYMENT_AUTHORIZENET_AIM_TXNKEY,  // The Transaction Key is generated through the merchant interface
                         'x_relay_response' => 'FALSE', // AIM uses direct response, not relay response
                         'x_delim_data' => 'TRUE', // The default delimiter is a comma
                         'x_version' => '3.1',  // 3.1 is required to use CVV codes
                         'x_type' => MODULE_PAYMENT_AUTHORIZENET_AIM_AUTHORIZATION_TYPE == 'Authorize' ? 'AUTH_ONLY': 'AUTH_CAPTURE',
                         'x_method' => 'CC', //MODULE_PAYMENT_AUTHORIZENET_AIM_METHOD == 'Credit Card' ? 'CC' : 'ECHECK',
                         'x_amount' => number_format($order->info['total'], 2),
                         'x_card_num' => $_POST['cc_number'],
                         'x_exp_date' => $_POST['cc_expires'],
                         'x_card_code' => $_POST['cc_cvv'],
                         'x_email_customer' => MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_CUSTOMER == 'True' ? 'TRUE': 'FALSE',
                         'x_email_merchant' => MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_MERCHANT == 'True' ? 'TRUE': 'FALSE',
                         'x_cust_id' => $_SESSION['customer_id'],
                         'x_invoice_num' => $new_order_id,
                         'x_first_name' => $order->billing['firstname'],
                         'x_last_name' => $order->billing['lastname'],
                         'x_company' => $order->billing['company'],
                         'x_address' => $order->billing['street_address'],
                         'x_city' => $order->billing['city'],
                         'x_state' => $order->billing['state'],
                         'x_zip' => $order->billing['postcode'],
                         'x_country' => $order->billing['country']['title'],
                         'x_phone' => $order->customer['telephone'],
                         'x_email' => $order->customer['email_address'],
                         'x_ship_to_first_name' => $order->delivery['firstname'],
                         'x_ship_to_last_name' => $order->delivery['lastname'],
                         'x_ship_to_address' => $order->delivery['street_address'],
                         'x_ship_to_city' => $order->delivery['city'],
                         'x_ship_to_state' => $order->delivery['state'],
                         'x_ship_to_zip' => $order->delivery['postcode'],
                         'x_ship_to_country' => $order->delivery['country']['title'],
                         'x_description' => $description,
                         // Merchant defined variables go here
                         'Date' => $order_time,
                         'IP' => $_SERVER['REMOTE_ADDR'],
                         'Session' => zen_session_id());

    if(MODULE_PAYMENT_AUTHORIZENET_AIM_TESTMODE == 'Test') {
      $submit_data['x_test_request'] = 'TRUE';
    }

    // concatenate the submission data and put into $data variable
    while(list($key, $value) = each($submit_data)) {
      $data .= $key . '=' . urlencode(ereg_replace(',', '', $value)) . '&';
    }

    // Remove the last "&" from the string
    $data = substr($data, 0, -1);


    // SEND DATA BY CURL SECTION
    // Post order info data to Authorize.net, make sure you have cURL support installed

    unset($response);

    // The commented line below is an alternate connection method
    //exec("/usr/bin/curl -d \"$data\" https://secure.authorize.net/gateway/transact.dll", $response);

    $url = 'https://secure.authorize.net/gateway/transact.dll';

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL,$url);

    curl_setopt($ch, CURLOPT_VERBOSE, 0);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);

    //========================
    // If you have GoDaddy hosting or other hosting services that require use of a proxy to talk to external sites via cURL,
    // then uncomment the following 3 lines and substitute they proxy server's address for 1.1.1.1 below:
//    curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, true);
//    curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
//    curl_setopt ($ch, CURLOPT_PROXY, '1.1.1.1');
    //========================

    $authorize = curl_exec($ch);

    curl_close ($ch);

    $response = split('\,', $authorize);


    // DATABASE SECTION
    // Insert the send and receive response data into the database.
    // This can be used for testing or for implementation in other applications
    // This can be turned on and off if the Admin Section
    if (MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_DATA == 'True'){

      // Create a string from all of the response data for insertion into the database
      while(list($key, $value) = each($response)) {
        $response_list .= ($key +1) . '=' . urlencode(ereg_replace(',', '', $value)) . '&';
      }

      // Remove the last "&" from the string
      $response_list = substr($response_list, 0, -1);


      $response_code = explode(',', $response[0]);
      $response_text = explode(',', $response[3]);
      $transaction_id = explode(',', $response[6]);
      $authorization_type = explode(',', $response[11]);

      $db_response_code = $response_code[0];
      $db_response_text = $response_text[0];
      $db_transaction_id = $transaction_id[0];
      $db_authorization_type = $authorization_type[0];
      $db_session_id = zen_session_id();


      // Insert the data into the database
      $db->Execute("insert into " . TABLE_AUTHORIZENET . "  (id, customer_id,order_id, response_code, response_text, authorization_type, transaction_id, sent, received, time, session_id) values ('', '" . $_SESSION['customer_id'] . "', '" . $new_order_id . "', '" . $db_response_code . "', '" . $db_response_text . "', '" . $db_authorization_type . "', '" . $db_transaction_id . "', '" . $data . "', '" . $response_list . "', '" . $order_time . "', '" . $db_session_id . "')");
    }

    // Parse the response code and text for custom error display
    $response_code = explode(',', $response[0]);
    $response_text = explode(',', $response[3]);
    $x_response_code = $response_code[0];
    $x_response_text = $response_text[0];
    // If the response code is not 1 (approved) then redirect back to the payment page with the appropriate error message
    if ($x_response_code != '1') {
      $messageStack->add_session('checkout_payment', $x_response_text . ' - ' . MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_DECLINED_MESSAGE, 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
    }
  }
  /**
   * Post-process activities.
   *
   * @return boolean
   */
  function after_process() {
    return false;
  }
  /**
   * Used to display error message details
   *
   * @return array
   */
  function get_error() {
    global $_GET;

    $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_AIM_TEXT_ERROR,
                   'error' => stripslashes(urldecode($_GET['error'])));

    return $error;
  }
  /**
   * Check to see whether module is installed
   *
   * @return boolean
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_AIM_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Install the payment module and its configuration settings
   *
   */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Authorize.net (AIM) Module', 'MODULE_PAYMENT_AUTHORIZENET_AIM_STATUS', 'True', 'Do you want to accept Authorize.net payments via the AIM Method?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Username', 'MODULE_PAYMENT_AUTHORIZENET_AIM_LOGIN', 'testing', 'The login username used for the Authorize.net service', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_AIM_TXNKEY', 'Test', 'Transaction Key used for encrypting TP data', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_AIM_TESTMODE', 'Test', 'Transaction mode used for processing orders', '6', '0', 'zen_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authorization Type', 'MODULE_PAYMENT_AUTHORIZENET_AIM_AUTHORIZATION_TYPE', 'Authorize', 'Do you want submitted credit card transactions to be authorized only, or authorized and captured?', '6', '0', 'zen_cfg_select_option(array(\'Authorize\', \'Authorize/Capture\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Database Storage', 'MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_DATA', 'False', 'Do you want to save the gateway data to the database? (Note: You must add a table first)', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Customer Notifications', 'MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_CUSTOMER', 'False', 'Should Authorize.Net email a receipt to the customer?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Merchant Notifications', 'MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_MERCHANT', 'False', 'Should Authorize.Net email a receipt to the merchant?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Request CVV Number', 'MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV', 'True', 'Do you want to ask the customer for the card\'s CVV number', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Store the Credit Card Number', 'MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_NUMBER', 'False', 'Do you want to store the Credit Card Number. Security Note: The Credit Card Number will be stored unenecrypted.', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_AIM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_AUTHORIZENET_AIM_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_AUTHORIZENET_AIM_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
  }
  /**
   * Remove the module and all its settings
   *
   */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }
  /**
   * Internal list of configuration keys used for configuration of the module
   *
   * @return array
   */
  function keys() {
    return array('MODULE_PAYMENT_AUTHORIZENET_AIM_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_AIM_LOGIN', 'MODULE_PAYMENT_AUTHORIZENET_AIM_TXNKEY', 'MODULE_PAYMENT_AUTHORIZENET_AIM_TESTMODE', 'MODULE_PAYMENT_AUTHORIZENET_AIM_AUTHORIZATION_TYPE', 'MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_DATA', 'MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_CUSTOMER', 'MODULE_PAYMENT_AUTHORIZENET_AIM_EMAIL_MERCHANT', 'MODULE_PAYMENT_AUTHORIZENET_AIM_USE_CVV', 'MODULE_PAYMENT_AUTHORIZENET_AIM_STORE_NUMBER', 'MODULE_PAYMENT_AUTHORIZENET_AIM_SORT_ORDER', 'MODULE_PAYMENT_AUTHORIZENET_AIM_ZONE', 'MODULE_PAYMENT_AUTHORIZENET_AIM_ORDER_STATUS_ID'); //'MODULE_PAYMENT_AUTHORIZENET_AIM_METHOD'
  }
}
?>