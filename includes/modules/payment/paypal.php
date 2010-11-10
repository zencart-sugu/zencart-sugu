<?php
/**
 * paypal.php payment module class for Paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal.php 3279 2006-03-27 22:51:19Z wilt $
 */

define('MODULE_PAYMENT_PAYPAL_RM', '2');

if (IS_ADMIN_FLAG === true) {
  include_once(DIR_FS_CATALOG_MODULES . 'payment/paypal/paypal_functions.php');
} else {
  include_once(DIR_WS_MODULES . 'payment/paypal/paypal_functions.php');
}
/**
 * paypal IPN pyment method class
 *
 */
class paypal extends base {
  /**
   * string repesenting the payment method
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
    * constructor
    *
    * @param int $paypal_ipn_id
    * @return paypal
    */
  function paypal($paypal_ipn_id = '') {
    global $order;
    $this->code = 'paypal';
    if ($_GET['main_page'] != '') {
      $this->title = MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE; // Payment Module title in Catalog
    } else {
      $this->title = MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE; // Payment Module title in Admin
    }
    $this->description = MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_PAYMENT_PAYPAL_SORT_ORDER;
    $this->enabled = ((MODULE_PAYMENT_PAYPAL_STATUS == 'True') ? true : false);
    if ((int)MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID > 0) {
      $this->order_status = MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;
    }
    if (is_object($order)) $this->update_status();
    if (MODULE_PAYMENT_PAYPAL_TESTING == 'Live') {
      $this->form_action_url = 'https://' . MODULE_PAYMENT_PAYPAL_HANDLER;
    } else {
      $this->form_action_url = DIR_WS_CATALOG . 'ipn_test.php';
    }
  }
  /**
   * calculate zone matches and flag settings to determine whether this module should display to customers or not
    *
    */
  function update_status() {
    global $order, $db;

    if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYPAL_ZONE > 0) ) {
      $check_flag = false;
      $check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYPAL_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
      while (!$check_query->EOF) {
        if ($check_query->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
          $check_flag = true;
          break;
        }
        $check_query->MoveNext();
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
    return false;
  }
  /**
   * Displays Credit Card Information Submission Fields on the Checkout Payment Page
   * In the case of paypal, this only displays the paypal title
   *
   * @return array
    */
  function selection() {
    return array('id' => $this->code,
                 'module' => $this->title);
  }
  /**
   * Normally evaluates the Credit Card Type for acceptance and the validity of the Credit Card Number & Expiration Date
   * Since paypal module is not collecting info, it simply skips this step.
   *
   * @return boolean
   */
  function pre_confirmation_check() {
    return false;
  }
  /**
   * Display Credit Card Information on the Checkout Confirmation Page
   * Since none is collected for paypal before forwarding to paypal site, this is skipped
   *
   * @return boolean
    */
  function confirmation() {
    return false;
  }
  /**
   * Build the data and actions to process when the "Submit" button is pressed on the order-confirmation screen.
   * This sends the data to the payment gateway for processing.
   * (These are hidden fields on the checkout confirmation page)
   *
   * @return string
    */
  function process_button() {
    global $db, $order, $currencies, $currency;

    $this->totalsum = $order->info['total'];

    // save the session stuff permanently in case paypal loses the session
    $db->Execute("delete from " . TABLE_PAYPAL_SESSION . " where session_id = '" . session_id() . "'");

    $sql = "insert into " . TABLE_PAYPAL_SESSION . " (session_id, saved_session, expiry) values (
            '" . session_id() . "',
            '" . base64_encode(serialize($_SESSION)) . "',
            '" . (time() + (1*60*60*24*2)) . "')";

    $db->Execute($sql);


    if (MODULE_PAYMENT_PAYPAL_CURRENCY == 'Selected Currency') {
      $my_currency = $_SESSION['currency'];
    } else {
      $my_currency = substr(MODULE_PAYMENT_PAYPAL_CURRENCY, 5);
    }
    if (!in_array($my_currency, array('CAD', 'EUR', 'GBP', 'JPY', 'USD', 'AUD'))) {
      $my_currency = 'USD';
    }
    $telephone = preg_replace('/\D/', '', $order->customer['telephone']);
    $process_button_string = zen_draw_hidden_field('business', MODULE_PAYMENT_PAYPAL_BUSINESS_ID) .
                             zen_draw_hidden_field('cmd', '_ext-enter') .
                             zen_draw_hidden_field('return', zen_href_link(FILENAME_CHECKOUT_PROCESS, 'referer=paypal', 'SSL')) .
                             zen_draw_hidden_field('cancel_return', zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL')) .
                             zen_draw_hidden_field('notify_url', zen_href_link('ipn_main_handler.php', '', 'SSL',false,false,true)) .
                             zen_draw_hidden_field('rm', MODULE_PAYMENT_PAYPAL_RM) .
                             zen_draw_hidden_field('currency_code', $my_currency) .
    //                              zen_draw_hidden_field('address_override', MODULE_PAYMENT_PAYPAL_ADDRESS_OVERRIDE) .
    //                              zen_draw_hidden_field('no_shipping', MODULE_PAYMENT_PAYPAL_ADDRESS_REQUIRED) .
                             zen_draw_hidden_field('bn', 'zencart') .
                             zen_draw_hidden_field('mrb', 'R-6C7952342H795591R') .
                             zen_draw_hidden_field('pal', '9E82WJBKKGPLQ') .
                             zen_draw_hidden_field('cbt', MODULE_PAYMENT_PAYPAL_CBT) .
    //                              zen_draw_hidden_field('handling', MODULE_PAYMENT_PAYPAL_HANDLING) .
                             zen_draw_hidden_field('image_url', MODULE_PAYMENT_PAYPAL_IMAGE_URL) .
                             zen_draw_hidden_field('page_style', MODULE_PAYMENT_PAYPAL_PAGE_STYLE) .
                             //zen_draw_hidden_field('item_name', STORE_NAME) .
                             //zen_draw_hidden_field('item_name', MODULE_PAYMENT_PAYPAL_BUSINESS_ID) .
    //                               zen_draw_hidden_field('invoice', '') .
    //                               zen_draw_hidden_field('num_cart_items', '') .
                             zen_draw_hidden_field('lc', $order->customer['country']['iso_code_2']) .
    //                               zen_draw_hidden_field('amount', number_format(($order->info['total'] - $order->info['shipping_cost']) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency))) .
    //                               zen_draw_hidden_field('shipping', number_format($order->info['shipping_cost'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency))) .
                             zen_draw_hidden_field('amount', number_format(($this->totalsum) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency))) .
                             zen_draw_hidden_field('shipping', '0.00') .
                             zen_draw_hidden_field('custom', zen_session_name() . '=' . zen_session_id() ) .
                             zen_draw_hidden_field('upload', sizeof($order->products) ) .
                             zen_draw_hidden_field('redirect_cmd', '_xclick') .
                             zen_draw_hidden_field('paypal_order_id', $paypal_order_id)
                             ;
                             
    if(MODULE_PAYMENT_PAYPAL_IGNORE_STORE_NAME == 'False'){
      $process_button_string .= zen_draw_hidden_field('item_name', STORE_NAME) .
      zen_draw_hidden_field('item_number', '1');
    }else if(MODULE_PAYMENT_PAYPAL_IGNORE_STORE_NAME == 'Original'){
      $process_button_string .= zen_draw_hidden_field('item_name', 'Purchase');
    }
    
    if(MODULE_PAYMENT_PAYPAL_IGNORE_ADDRESS != 'True'){
      $process_button_string .= 
//                             zen_draw_hidden_field('first_name', $order->customer['firstname']) .
//                             zen_draw_hidden_field('last_name', $order->customer['lastname']) .
                             zen_draw_hidden_field('first_name', $order->customer['lastname']) .
                             zen_draw_hidden_field('last_name', $order->customer['firstname']) .
                             zen_draw_hidden_field('address1', $order->customer['street_address']) .
    //                              zen_draw_hidden_field('address2', '') .
                             zen_draw_hidden_field('city', $order->customer['city']) .
    //                              zen_draw_hidden_field('state',strtoupper(substr($order->customer['state'],0,2))) .
                             zen_draw_hidden_field('state',zen_get_zone_code($order->customer['country']['id'], $order->customer['zone_id'],$order->customer['zone_id'])) .
                             zen_draw_hidden_field('zip', $order->customer['postcode']) .
                             zen_draw_hidden_field('country', $order->customer['country']['iso_code_2']) .
                             zen_draw_hidden_field('email', $order->customer['email_address']) .
                             zen_draw_hidden_field('night_phone_a',substr($telephone,0,3)) .
                             zen_draw_hidden_field('night_phone_b',substr($telephone,3,3)) .
                             zen_draw_hidden_field('night_phone_c',substr($telephone,6,4)) .
                             zen_draw_hidden_field('day_phone_a',substr($telephone,0,3)) .
                             zen_draw_hidden_field('day_phone_b',substr($telephone,3,3)) .
                             zen_draw_hidden_field('day_phone_c',substr($telephone,6,4))
                             ;
    }

    return $process_button_string;
  }
  /**
   * Store transaction info to the order and process any results that come back from the payment gateway
    *
    */
  function before_process() {
    global $order_total_modules;
    if (isset($_GET['referer']) && $_GET['referer'] == 'paypal') {
      $this->notify('NOTIFY_PAYMENT_PAYPAL_RETURN_TO_STORE');
      if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
        // simulate call to ipn_handler.php here
        ipn_simulate_ipn_handler((int)$_GET['count']);
      }
      $_SESSION['cart']->reset(true);
      unset($_SESSION['sendto']);
      unset($_SESSION['billto']);
      unset($_SESSION['shipping']);
      unset($_SESSION['payment']);
      unset($_SESSION['comments']);
      unset($_SESSION['cot_gv']);
      $order_total_modules->clear_posts();//ICW ADDED FOR CREDIT CLASS SYSTEM
      $_SESSION['navigation']->remove_current_page();
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
    } else {
      $this->notify('NOTIFY_PAYMENT_PAYPAL_CANCELLED_DURING_CHECKOUT');
      $_SESSION['navigation']->remove_current_page();
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
    }
  }
  /**
    * Checks referrer
    *
    * @param string $zf_domain
    * @return boolean
    */
  function check_referrer($zf_domain) {
    return true;
  }
  /**
    * Build admin-page components
    *
    * @param int $zf_order_id
    * @return string
    */
  function admin_notification($zf_order_id) {
    global $db;

    $sql = "select * from " . TABLE_PAYPAL . " where zen_order_id = '" . $zf_order_id . "' order by paypal_ipn_id DESC LIMIT 1";
    $ipn = $db->Execute($sql);
    require(DIR_FS_CATALOG. DIR_WS_MODULES . 'payment/paypal/paypal_admin_notification.php');
    return $output;
  }
  /**
   * Post-processing activities
   *
   * @return boolean
    */
  function after_process() {
    $_SESSION['order_created'] = '';
    return false;
  }
  /**
   * Used to display error message details
   *
   * @return boolean
    */
  function output_error() {
    return false;
  }
  /**
   * Check to see whether module is installed
   *
   * @return boolean
    */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_STATUS'");
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
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('PayPal 支払いを有効にする', 'MODULE_PAYMENT_PAYPAL_STATUS', 'True', 'PayPal での支払いを受け付けますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('E-Mailアドレス', 'MODULE_PAYMENT_PAYPAL_BUSINESS_ID','".STORE_OWNER_EMAIL_ADDRESS."', 'PayPal サービスに使用するE-Mailアドレスを設定して下さい。', '6', '2', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('処理通貨設定', 'MODULE_PAYMENT_PAYPAL_CURRENCY', 'Selected Currency', 'クレジットカード処理に使用する通貨を設定して下さい。', '6', '4', 'zen_cfg_select_option(array(\'Selected Currency\',\'Only USD\',\'Only CAD\',\'Only EUR\',\'Only GBP\',\'Only JPY\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_PAYMENT_PAYPAL_SORT_ORDER', '0', '表示の整列順を設定できます。数字が小さいほど上位に表示されます', '6', '5', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('適用地域', 'MODULE_PAYMENT_PAYPAL_ZONE', '0', '適用地域を選択すると、選択した地域のみで利用可能となります。', '6', '6', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('初期注文ステータス', 'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID', '0', '設定したステータスが受注時に適用されます。', '6', '7', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('item_nameを送信しない(文字化け対策)', 'MODULE_PAYMENT_PAYPAL_IGNORE_STORE_NAME', 'True', 'PayPalサイトへitem_nameを送信しないようにします。<br />True=item_nameを送信しません。この場合、paypalサイト上で、購入者が自由に入力できるようになります。<br />False=Zen-Cart標準の動作で、ショップ名を送信します。文字化けの可能性があります。<br />Original=任意の文字列(デフォルトでPurchase)を送信します。item_nameを指定した場合は、こちらを利用してください。文字列の変更はincludes/modules/payment/paypal.phpです。*英数のみ利用可', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\', \'Original\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('顧客情報を送信しない(文字化け対策)', 'MODULE_PAYMENT_PAYPAL_IGNORE_ADDRESS', 'True', 'PayPalサイトへ顧客の住所、氏名を送信しないようにします。(paypal側で入力できるので、送信しなくても問題ありません)', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Pending Notification Status', 'MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID', '" . DEFAULT_ORDERS_STATUS_ID .  "', 'Set the status of orders made with this payment module that are not yet completed to this value<br />(\'Pending\' recommended)', '6', '5', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Refund Order Status', 'MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID', '1', 'Set the status of orders that have been refunded made with this payment module to this value<br />(\'Pending\' recommended)', '6', '7', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    //     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handling Charge', 'MODULE_PAYMENT_PAYPAL_HANDLING', '0', 'The cost of handling. This is not quantity specific. The same handling will be charged regardless of the number of items purchased. If omitted or 0, no handling charges will be assessed.', '6', '15', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Address override', 'MODULE_PAYMENT_PAYPAL_ADDRESS_OVERRIDE', '', 'If set to 1 the address passed in via Zen Cart will override the users paypal-stored address. The user will be shown the Zen Cart address, but will not be able to edit it. If the address is not valid (i.e. missing required fields, including country) or not included, then no address will be shown.<br />Empty=No Override<br />1=Passed-in Address overrides users paypal-stored address', '6', '18', 'zen_cfg_select_option(array(\'\',\'1\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Shipping Address Options', 'MODULE_PAYMENT_PAYPAL_ADDRESS_REQUIRED', '1', 'The buyers shipping address. If set to 0 your customer will be prompted to include a shipping address. If set to 1 your customer will not be asked for a shipping address. If set to 2 your customer will be required to provide a shipping address.<br />0=Prompt<br />1=Not Asked<br />2=Required<br /><br /><strong>NOTE: If you allow your customers to enter their own shipping address, then MAKE SURE you verify the paypal confirmation details to verify the proper address when filling orders. Zen Cart does not know if they choose an alternate shipping address compared to the one entered when placing an order.</strong>', '6', '20', 'zen_cfg_select_option(array(\'0\',\'1\',\'2\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Continue Button Text', 'MODULE_PAYMENT_PAYPAL_CBT', '', 'Sets the text for the Continue button on the PayPal Payment Complete page. <br />Requires Return URL to be set.<br />Leave blank if no customization required.', '6', '22', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Image URL', 'MODULE_PAYMENT_PAYPAL_IMAGE_URL', '', 'The internet URL of the 150x50-pixel image you would like to use as your logo. If omitted, the customer will see your Business name if you have a Business account, or your email address if you have premier account.', '6', '24', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Page Style', 'MODULE_PAYMENT_PAYPAL_PAGE_STYLE', 'paypal', 'Sets the Custom Payment Page Style for payment pages. The value of page_style is the same as the Page Style Name you chose when adding or editing the page style. You can add and edit Custom Payment Page Styles from the Profile subtab of the My Account tab on the paypal site. If you would like to always reference your Primary style, set this to \"primary.\" If you would like to reference the default PayPal page style, set this to \"paypal\".', '6', '25', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Mode for PayPal web services<br /><br />Default:<br /><code>www.paypal.com/cgi-bin/webscr</code><br />or<br /><code>www.paypal.com/us/cgi-bin/webscr</code>', 'MODULE_PAYMENT_PAYPAL_HANDLER', 'www.paypal.com/cgi-bin/webscr', 'Choose the URL for PayPal live processing', '6', '73', '', now())");

    // Paypal testing options go here
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Status Live/Testing', 'MODULE_PAYMENT_PAYPAL_TESTING', 'Live', 'Set paypal to Live or Test', '6', '1', 'zen_cfg_select_option(array(\'Live\', \'Test\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Email Notifications', 'MODULE_PAYMENT_PAYPAL_IPN_DEBUG', 'No', 'Enable debug email notifications', '6', '71', 'zen_cfg_select_option(array(\'Yes\',\'No\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Debug Email Address', 'MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS','".STORE_OWNER_EMAIL_ADDRESS."', 'The email address to use for paypal debugging', '6', '72', now())");

    $this->notify('NOTIFY_PAYMENT_PAYPAL_INSTALLED');
  }
  /**
   * Remove the module and all its settings
    *
    */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE  'MODULE_PAYMENT_PAYPAL%'");
    $this->notify('NOTIFY_PAYMENT_PAYPAL_UNINSTALLED');

  }
  /**
   * Internal list of configuration keys used for configuration of the module
   *
   * @return array
    */
  function keys() {
    return array(
    'MODULE_PAYMENT_PAYPAL_STATUS',
    'MODULE_PAYMENT_PAYPAL_BUSINESS_ID',
    'MODULE_PAYMENT_PAYPAL_CURRENCY',
    'MODULE_PAYMENT_PAYPAL_ZONE',
    'MODULE_PAYMENT_PAYPAL_PROCESSING_STATUS_ID',
    'MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID',
    'MODULE_PAYMENT_PAYPAL_REFUND_ORDER_STATUS_ID',
    'MODULE_PAYMENT_PAYPAL_SORT_ORDER',
    //         'MODULE_PAYMENT_PAYPAL_HANDLING' ,
    //         'MODULE_PAYMENT_PAYPAL_ADDRESS_OVERRIDE' ,
    //         'MODULE_PAYMENT_PAYPAL_ADDRESS_REQUIRED' ,
    'MODULE_PAYMENT_PAYPAL_CBT' ,
    //         'MODULE_PAYMENT_PAYPAL_IMAGE_URL' ,
    'MODULE_PAYMENT_PAYPAL_PAGE_STYLE' ,
    'MODULE_PAYMENT_PAYPAL_HANDLER',
    'MODULE_PAYMENT_PAYPAL_IGNORE_STORE_NAME',
    'MODULE_PAYMENT_PAYPAL_IGNORE_ADDRESS',

    // Paypal testing/debug options go here:
//    'MODULE_PAYMENT_PAYPAL_IPN_DEBUG',
//    'MODULE_PAYMENT_PAYPAL_DEBUG_EMAIL_ADDRESS',
//    'MODULE_PAYMENT_PAYPAL_TESTING'
    );
  }
}
?>
