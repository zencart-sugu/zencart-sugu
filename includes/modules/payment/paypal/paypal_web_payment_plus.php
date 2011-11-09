<?php

class paypal_web_payment_plus {

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

  var $sort_order;
  /**
   * $enabled determines whether this module shows or not... in catalog.
   *
   * @var boolean
    */
  var $enabled;

  /**
   * $form_action_url
   *
   * @var string
   */
  var $form_action_url;


  function paypal_web_payment_plus($code, $title, $description, $sort_order, $enabled) {
    $this->code = $code;
    $this->title = $title;
    $this->description = $description;
    $this->sort_order = $sort_order;
    $this->enabled = $enabled;
    if ( ENABLE_SSL == 'true' ) {
      $this->form_action_url = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG . 'paypal_submitter.php';
    }
    else {
      $this->form_action_url = HTTP_SERVER . DIR_WS_CATALOG . 'paypal_submitter.php';
    }
  }

  function get_form_action_url() {
    return $this->form_action_url;
  }

  function update_status() {
    global $order, $db;
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
    global $db, $order, $currencies, $currency, $order_total_modules;

    $sql = "INSERT INTO " . TABLE_PAYPAL_SESSION . " (session_id,saved_session,expiry)" .
           " VALUES (:session_id,:saved_session,:expiry)";
    $sql = $db->bindVars($sql, ':session_id', zen_session_id(), 'string');
    $sql = $db->bindVars($sql, ':saved_session', '', 'string');
    $sql = $db->bindVars($sql, ':expiry', time() + (1*60*60*24*2), 'integer');
    $db->Execute($sql);
    $paypal_session_unique_id = $db->Insert_ID();

    $custom = $paypal_session_unique_id . '-' . md5($paypal_session_unique_id . MODULE_PAYMENT_PAYPAL_WPP_CUSTOM_KEY);

    if ( MODULE_PAYMENT_PAYPAL_WPP_TEST == 'True' ) {
      $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_hosted-payment';
    }
    else {
      $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr?cmd=_hosted-payment';
    }

    if (MODULE_PAYMENT_PAYPAL_WPP_CURRENCY == 'User Selected Currency') {
      $amt = paypal_get_ot_total($order, $order_total_modules);
      $currency = $_SESSION['currency'];
    }
    else {
      $amt = paypal_get_ot_total($order, $order_total_modules, false);
      $currency = MODULE_PAYMENT_PAYPAL_WPP_CURRENCY;
      $amt = number_format(paypal_convert_money_string($amt) * $currencies->get_value($currency), $currencies->get_decimal_places($currency));
      $amt = paypal_convert_money_string($amt);
    }

    $_SESSION['paypal_session_unique_id'] = $paypal_session_unique_id;
    $_SESSION['paypal_subtotal'] = $amt;
    $_SESSION['paypal_currency'] = $currency;

    $sql = "UPDATE " . TABLE_PAYPAL_SESSION . " SET saved_session=:saved_session" .
           " WHERE unique_id='"  . (int)$paypal_session_unique_id . "'";
    $sql = $db->bindVars($sql, ':saved_session', base64_encode(serialize($_SESSION)), 'string');
    $db->Execute($sql);

    $billing_country = '';
    if ( strcasecmp($order->billing['country']['title'], 'Japan') === 0 ) {
      $billing_country = 'JP';
    }

    $delivery_country = '';
    if ( strcasecmp($order->delivery['country']['title'], 'Japan') === 0 ) {
      $delivery_country = 'JP';
    }

    $process_button_string = 
      zen_draw_hidden_field('business', MODULE_PAYMENT_PAYPAL_WPP_MERCHANT_ID) .
      zen_draw_hidden_field('subtotal', $amt) .
      zen_draw_hidden_field('currency_code', $currency) .
      zen_draw_hidden_field('buyer_email', $order->customer['email_address']) .
      zen_draw_hidden_field('billing_country', $billing_country) .
      zen_draw_hidden_field('billing_zip', str_replace('-', '', $order->billing['postcode'])) .
      zen_draw_hidden_field('billing_state', $order->billing['state']) .
      zen_draw_hidden_field('billing_city', $order->billing['city']) .
      zen_draw_hidden_field('billing_address1', $order->billing['street_address']) .
      zen_draw_hidden_field('billing_address2', $order->billing['suburb']) .
      zen_draw_hidden_field('billing_last_name', $order->billing['firstname']) .
      zen_draw_hidden_field('billing_first_name', $order->billing['lastname']) .
      zen_draw_hidden_field('country', $delivery_country) .
      zen_draw_hidden_field('zip', str_replace('-', '', $order->delivery['postcode'])) .
      zen_draw_hidden_field('state', $order->delivery['state']) .
      zen_draw_hidden_field('city', $order->delivery['city']) .
      zen_draw_hidden_field('address1', $order->delivery['street_address']) .
      zen_draw_hidden_field('address2', $order->delivery['suburb']) .
      zen_draw_hidden_field('last_name', $order->delivery['firstname']) .
      zen_draw_hidden_field('first_name', $order->delivery['lastname']) .
      zen_draw_hidden_field('custom', $custom) .
      zen_draw_hidden_field('return', zen_href_link(FILENAME_CHECKOUT_SUCCESS_PAYPAL_IPN_WAITING, '', 'SSL')) .
      zen_draw_hidden_field('paymentaction', MODULE_PAYMENT_PAYPAL_WPP_SETTLEMENT_TYPE) .
      zen_draw_hidden_field('cancel_return', zen_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL')) .
      zen_draw_hidden_field('paypal_url' , $paypalUrl);

    return $process_button_string;
  }

  /**
   * Store transaction info to the order and process any results that come back from the payment gateway
    *
    */

  function before_process() {
    global $order_total_modules;
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

    return $output;
  }

  /**
   * Post-processing activities
   *
   * @return boolean
    */

  function after_process() {

    global $insert_id, $order, $db;
    // restored in paypal_ipn.php
    global $paypal_session_unique_id, $paypal_transaction_id, $paypal_wpp_log_id;

    if ( strlen($order->info['comments']) > 0 ) {
      $newline = "\n\n";
    }
    else {
      $newline = "";
    }

    $order->info['comments'] = $order->info['comments'] . $newline . MODULE_PAYMENT_PAYPAL_TEXT_TX_ID . $paypal_transaction_id;

    $sql = "UPDATE " . TABLE_ORDERS_STATUS_HISTORY . " SET comments=:comments" .
           " WHERE orders_id=:orders_id";
    $sql = $db->bindVars($sql, ':comments', $order->info['comments'], 'string');
    $sql = $db->bindVars($sql, ':orders_id', $insert_id, 'integer');
    $db->Execute($sql);

    $sql = "DELETE FROM " . TABLE_PAYPAL_SESSION .
           " WHERE unique_id='" . (int)$paypal_session_unique_id . "'";
    $result = $db->Execute($sql);

    $sql = "INSERT INTO " . TABLE_PAYPAL_PAYMENT_STATUS_HISTORY .
           " (paypal_ipn_id,txn_id,parent_txn_id,payment_status,pending_reason,date_added)" .
           " VALUES(:paypal_ipn_id,:txn_id,:parent_txn_id,:payment_status,:pending_reason,now())";
    $sql = $db->bindVars($sql, ':paypal_ipn_id', $paypal_wpp_log_id, 'integer');
    $sql = $db->bindVars($sql, ':txn_id', $paypal_transaction_id, 'string');
    $sql = $db->bindVars($sql, ':parent_txn_id', $_POST['parent_txn_id'], 'string');
    $sql = $db->bindVars($sql, ':payment_status', $_POST['payment_status'], 'string');
    $sql = $db->bindVars($sql, ':pending_reason', $_POST['pending_reason'], 'string');
    $db->Execute($sql);

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
}

?>