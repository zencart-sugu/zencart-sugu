<?php
/**
 * autorize.net Standard payment method class
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: authorizenet.php 3308 2006-03-29 08:21:33Z ajeh $
 */
/**
 * Enter description here...
 *
 */
class authorizenet extends base {
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
   * @return authorizenet
   */
  function authorizenet() {
    global $order;

    $this->code = 'authorizenet';
    if ($_GET['main_page'] != '') {
      $this->title = MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE; // Payment module title in Catalog
    } else {
      $this->title = MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE; // Payment module title in Admin
    }
    $this->description = MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION;
    $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') ? true : false);
    $this->sort_order = MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER;

    if ((int)MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID;
    }

    if (is_object($order)) $this->update_status();

    $this->form_action_url = 'https://secure.authorize.net/gateway/transact.dll';
  }

  // Authorize.net utility functions
  // DISCLAIMER:
  //     This code is distributed in the hope that it will be useful, but without any warranty;
  //     without even the implied warranty of merchantability or fitness for a particular purpose.

  // Main Interfaces:
  //
  // function InsertFP ($loginid, $txnkey, $amount, $sequence) - Insert HTML form elements required for SIM
  // function CalculateFP ($loginid, $txnkey, $amount, $sequence, $tstamp) - Returns Fingerprint.

  // compute HMAC-MD5
  // Uses PHP mhash extension. Pl sure to enable the extension
  // function hmac ($key, $data) {
  //   return (bin2hex (mhash(MHASH_MD5, $data, $key)));
  //}

  // Thanks is lance from http://www.php.net/manual/en/function.mhash.php
  //lance_rushing at hot* spamfree *mail dot com
  //27-Nov-2002 09:36
  //
  //Want to Create a md5 HMAC, but don't have hmash installed?
  //
  //Use this:
  /**
   * compute HMAC-MD5
   *
   * @param string $key
   * @param string $data
   * @return string
   */
  function hmac ($key, $data)
  {
    // RFC 2104 HMAC implementation for php.
    // Creates an md5 HMAC.
    // Eliminates the need to install mhash to compute a HMAC
    // Hacked by Lance Rushing

    $b = 64; // byte length for md5
    if (strlen($key) > $b) {
      $key = pack("H*",md5($key));
    }
    $key  = str_pad($key, $b, chr(0x00));
    $ipad = str_pad('', $b, chr(0x36));
    $opad = str_pad('', $b, chr(0x5c));
    $k_ipad = $key ^ $ipad ;
    $k_opad = $key ^ $opad;

    return md5($k_opad  . pack("H*",md5($k_ipad . $data)));
  }
  // end code from lance (resume authorize.net code)

  // Calculate and return fingerprint
  // Use when you need control on the HTML output
  function CalculateFP ($loginid, $txnkey, $amount, $sequence, $tstamp, $currency = "") {
    return ($this->hmac ($txnkey, $loginid . "^" . $sequence . "^" . $tstamp . "^" . $amount . "^" . $currency));
  }
  /**
   * Inserts the hidden variables in the HTML FORM required for SIM
   * Invokes hmac function to calculate fingerprint.
   *
   * @param string $loginid
   * @param string $txnkey
   * @param float $amount
   * @param string $sequence
   * @param float $currency
   * @return string
   */

  function InsertFP ($loginid, $txnkey, $amount, $sequence, $currency = "") {
    $tstamp = time ();
    $fingerprint = $this->hmac ($txnkey, $loginid . "^" . $sequence . "^" . $tstamp . "^" . $amount . "^" . $currency);

    $str = zen_draw_hidden_field('x_fp_sequence', $sequence) .
    zen_draw_hidden_field('x_fp_timestamp', $tstamp) .
    zen_draw_hidden_field('x_fp_hash', $fingerprint);

    return $str;
  }
  // end authorize.net-provided code

  // class methods
  /**
   * calculate zone matches and flag settings to determine whether this module should display to customers or not
   *
   */
  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_AUTHORIZENET_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_AUTHORIZENET_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
    '    var cc_owner = document.checkout_payment.authorizenet_cc_owner.value;' . "\n" .
    '    var cc_number = document.checkout_payment.authorizenet_cc_number.value;' . "\n" .
    '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n" .
    '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
    '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER . '";' . "\n" .
    '      error = 1;' . "\n" .
    '    }' . "\n" .
    '  }' . "\n";

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
    $selection = array('id' => $this->code,
                       'module' => $this->title,
	       'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
	                               'field' => zen_draw_input_field('authorizenet_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'], 'id="'.$this->code.'-cc-owner"'),
                                               'tag' => $this->code.'-cc-owner'),
                                         array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                               'field' => zen_draw_input_field('authorizenet_cc_number', '', 'id="'.$this->code.'-cc-number"'),
                                               'tag' => $this->code.'-cc-number'),
                                         array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                               'field' => zen_draw_pull_down_menu('authorizenet_cc_expires_month', $expires_month, '', 'id="'.$this->code.'-cc-expires-month"') . '&nbsp;' . zen_draw_pull_down_menu('authorizenet_cc_expires_year', $expires_year),
                                               'tag' => $this->code.'-cc-expires-month')
		               ));

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
    $result = $cc_validation->validate($_POST['authorizenet_cc_number'], $_POST['authorizenet_cc_expires_month'], $_POST['authorizenet_cc_expires_year']);
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
      $payment_error_return = 'payment_error=' . $this->code . 'authorizenet_cc_owner=' . urlencode($_POST['authorizenet_cc_owner']) . '&authorizenet_cc_expires_month=' . $_POST['authorizenet_cc_expires_month'] . '&authorizenet_cc_expires_year=' . $_POST['authorizenet_cc_expires_year'];
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

    $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                          'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                                  'field' => $_POST['authorizenet_cc_owner']),
                                            array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                  'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                            array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                  'field' => strftime('%B, %Y', mktime(0,0,0,$_POST['authorizenet_cc_expires_month'], 1, '20' . $_POST['authorizenet_cc_expires_year'])))));

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
    global $_SERVER, $order;

    $sequence = rand(1, 1000);
    $process_button_string = zen_draw_hidden_field('x_Login', MODULE_PAYMENT_AUTHORIZENET_LOGIN) .
        zen_draw_hidden_field('x_Card_Num', $this->cc_card_number) .
        zen_draw_hidden_field('x_Exp_Date', $this->cc_expiry_month . substr($this->cc_expiry_year, -2)) .
        zen_draw_hidden_field('x_Amount', number_format($order->info['total'], 2)) .
        zen_draw_hidden_field('x_Relay_URL', zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false)) .
        zen_draw_hidden_field('x_Method', ((MODULE_PAYMENT_AUTHORIZENET_METHOD == 'Credit Card') ? 'CC' : 'ECHECK')) .
        zen_draw_hidden_field('x_Version', '3.0') .
        zen_draw_hidden_field('x_Cust_ID', $_SESSION['customer_id']) .
        zen_draw_hidden_field('x_Email_Customer', ((MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER == 'True') ? 'TRUE': 'FALSE')) .
//        zen_draw_hidden_field('x_first_name', $order->billing['firstname']) .
//        zen_draw_hidden_field('x_last_name', $order->billing['lastname']) .
        zen_draw_hidden_field('x_first_name', $order->billing['lastname']) .
        zen_draw_hidden_field('x_last_name', $order->billing['firstname']) .
        zen_draw_hidden_field('x_address', $order->billing['street_address']) .
        zen_draw_hidden_field('x_city', $order->billing['city']) .
        zen_draw_hidden_field('x_state', $order->billing['state']) .
        zen_draw_hidden_field('x_zip', $order->billing['postcode']) .
        zen_draw_hidden_field('x_country', $order->billing['country']['title']) .
        zen_draw_hidden_field('x_phone', $order->customer['telephone']) .
        zen_draw_hidden_field('x_email', $order->customer['email_address']) .
//        zen_draw_hidden_field('x_ship_to_first_name', $order->delivery['firstname']) .
//        zen_draw_hidden_field('x_ship_to_last_name', $order->delivery['lastname']) .
        zen_draw_hidden_field('x_ship_to_first_name', $order->delivery['lastname']) .
        zen_draw_hidden_field('x_ship_to_last_name', $order->delivery['firstname']) .
        zen_draw_hidden_field('x_ship_to_address', $order->delivery['street_address']) .
        zen_draw_hidden_field('x_ship_to_city', $order->delivery['city']) .
        zen_draw_hidden_field('x_ship_to_state', $order->delivery['state']) .
        zen_draw_hidden_field('x_ship_to_zip', $order->delivery['postcode']) .
        zen_draw_hidden_field('x_ship_to_country', $order->delivery['country']['title']) .
        zen_draw_hidden_field('x_Customer_IP', $_SERVER['REMOTE_ADDR']) .
    $this->InsertFP(MODULE_PAYMENT_AUTHORIZENET_LOGIN, MODULE_PAYMENT_AUTHORIZENET_TXNKEY, number_format($order->info['total'], 2), $sequence);
    if (MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test') $process_button_string .= zen_draw_hidden_field('x_Test_Request', 'TRUE');

    $process_button_string .= zen_draw_hidden_field(zen_session_name(), zen_session_id());

    return $process_button_string;
  }
  /**
   * Store the CC info to the order and process any results that come back from the payment gateway
   *
   */
  function before_process() {
    global $_POST, $messageStack;

    if ($_POST['x_response_code'] == '1') return;
    if ($_POST['x_response_code'] == '2') {
      $messageStack->add_session('checkout_payment', MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE, 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
    }
    // Code 3 is an error - but anything else is an error too (IMHO)
    $messageStack->add_session('checkout_payment', MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE, 'error');
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
  }
  /**
   * Post-processing activities
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

    $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR,
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
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_STATUS'");
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
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Authorize.net 支払を有効にする', 'MODULE_PAYMENT_AUTHORIZENET_STATUS', 'True', 'Authorize.net 支払を有効にしますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ログインユーザー名', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'testing', 'Authorize.netサービスに使用されるログイン・ユーザー名を設定', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('トランザクションキー', 'MODULE_PAYMENT_AUTHORIZENET_TXNKEY', 'Test', 'TPデータの暗号化に使用されまるトランザクションキーを設定', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('トランザクションモード', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'Test', '注文処理に使用されるトランザクションモードの設定', '6', '0', 'zen_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('トランザクション方法', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'Credit Card', '注文処理に使用されるトランザクション方法', '6', '0', 'zen_cfg_select_option(array(\'Credit Card\', \'eCheck\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('顧客への通知', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'False', 'Authorize.Netから顧客に、レシートをメールで送りますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', '0', '表示の整列順を設定できます。数字が小さいほど上位に表示されます。', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('適用地域', 'MODULE_PAYMENT_AUTHORIZENET_ZONE', '0', '適用地域を選択すると、選択した地域のみで利用可能となります。', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('初期注文ステータス', 'MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID', '0', '設定したステータスが受注時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
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
    return array('MODULE_PAYMENT_AUTHORIZENET_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'MODULE_PAYMENT_AUTHORIZENET_TXNKEY', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'MODULE_PAYMENT_AUTHORIZENET_ZONE', 'MODULE_PAYMENT_AUTHORIZENET_ORDER_STATUS_ID', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER');
  }
}
?>