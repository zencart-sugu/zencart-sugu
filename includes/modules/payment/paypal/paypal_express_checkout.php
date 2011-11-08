<?php
//define('PAYPAL_AUTH_MODE',       '3TOKEN');
define('PAYPAL_EC_API_ENDPOINT_TEST', 'https://api-3t.sandbox.paypal.com/nvp');
define('PAYPAL_EC_URL_TEST',          'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=');
define('PAYPAL_EC_API_ENDPOINT',      'https://api-3t.paypal.com/nvp');
define('PAYPAL_EC_URL',               'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=');
define('PAYPAL_EC_VERSION',           '65.1');
define('PAYPAL_USE_PROXY',            FALSE);
define('PAYPAL_PROXY_HOST',           '127.0.0.1');
define('PAYPAL_PROXY_PORT',           '808');

class paypal_express_checkout {

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
   * $sort_order
   *
   * @var number
   */
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

  function paypal_express_checkout($code, $title, $description, $sort_order, $enabled) {
    $this->code        = $code;
    $this->title       = $title;
    $this->description = $description;
    $this->sort_order  = $sort_order;
    $this->enabled     = $enabled;
    $this->form_action_url = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
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
    return array('id'     => $this->code,
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
  }

  /**
   * Store transaction info to the order and process any results that come back from the payment gateway
   *
   */

  function before_process() {
    global $order, $order_total_modules;

    if (!isset($_REQUEST['token'])) {
      $billing_agreement_id = $this->get_billing_agreement_id($_SESSION['customer_id']);
      if (MODULE_PAYMENT_PAYPAL_EC_REFERENCE=='False' ||
          $billing_agreement_id == "") {
        $this->SetExpressCheckout();
      }
      else {
        $this->DoReferenceTransaction($billing_agreement_id);
      }
    }
    else {
      $this->DoExpressCheckout(urlencode($_REQUEST['token']));
    }
  }

  function get_billing_agreement_id($customers_id) {
    global $db;

    $result = $db->Execute("select * from ".TABLE_CUSTOMERS." where customers_id=".(int)$customers_id);
    if ($result->EOF)
      return "";
    else
      return $result->fields['paypal_express_checkout_billing_agreement_id'];
  }

  function SetExpressCheckout() {
    global $order, $order_total_modules;
    global $currencies;

    $method = "SetExpressCheckout";

    $parm  = "";
    $parm .= "&RETURNURL=".urlencode(zen_href_link(FILENAME_CHECKOUT_PROCESS, "", "SSL"));
    $parm .= "&CANCELURL=".urlencode(zen_href_link(FILENAME_CHECKOUT_PAYMENT, "", "SSL"));
    $parm .= "&REQCONFIRMSHIPPING=".(($order->content_type=="virtual")?"0":"1");
    $parm .= "&NOSHIPPING=".(($order->content_type=="virtual")?"1":"0");
    $parm .= "&LOCALECODE=".paypal_language_convert($_SESSION['language']);

    // 送付先
    $parm .= "&PAYMENTREQUEST_0_SHIPTONAME=".paypal_esacpe_parm($order->delivery['firstname'].' '.$order->delivery['lastname']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOSTREET=".paypal_esacpe_parm($order->delivery['street_address']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOSTREET2=".paypal_esacpe_parm($order->delivery['suburb']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOCITY=".paypal_esacpe_parm($order->delivery['city']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOSTATE=".paypal_esacpe_parm($order->delivery['state']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOZIP=".paypal_esacpe_parm($order->delivery['postcode']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE=".paypal_esacpe_parm($order->delivery['country']['iso_code_2']);
    $parm .= "&PAYMENTREQUEST_0_SHIPTOPHONENUM=".paypal_esacpe_parm($order->delivery['telephone']);

    // 通貨
    if (MODULE_PAYMENT_PAYPAL_EC_CURRENCY == 'USER') {
      $amt = paypal_get_ot_total($order, $order_total_modules);
      $currency = $_SESSION['currency'];
    }
    else {
      $amt = paypal_get_ot_total($order, $order_total_modules, false);
      $currency = MODULE_PAYMENT_PAYPAL_EC_CURRENCY;
      $amt = number_format(paypal_convert_money_string($amt) * $currencies->get_value($currency), $currencies->get_decimal_places($currency));
      $amt = paypal_convert_money_string($amt);
    }

    // 金額
//    $tax   = paypal_get_ot_tax($order, $order_total_modules);
    $parm .= "&PAYMENTREQUEST_0_AMT=".$amt;
    $parm .= "&PAYMENTREQUEST_0_CURRENCYCODE=".paypal_esacpe_parm($currency);
//    $parm .= "&PAYMENTREQUEST_0_ITEMAMT=".(paypal_get_ot_subtotal($order, $order_total_modules)-$tax);
//    $parm .= "&PAYMENTREQUEST_0_SHIPPINGAMT=".paypal_get_ot_shipping($order, $order_total_modules);
//    $parm .= "&PAYMENTREQUEST_0_HANDLINGAMT=".paypal_get_ot_loworderfee($order, $order_total_modules);
//    $parm .= "&PAYMENTREQUEST_0_SHIPDISCAMT=".paypal_get_ot_coupon($order, $order_total_modules);
//    $parm .= "&PAYMENTREQUEST_0_TAXAMT=".$tax;
    $parm .= "&PAYMENTREQUEST_0_PAYMENTACTION=".MODULE_PAYMENT_PAYPAL_EC_SETTLEMENT_TYPE;
    if (MODULE_PAYMENT_PAYPAL_EC_REFERENCE=='True') {
      $parm .= "&BILLINGTYPE=MerchantInitiatedBillingSingleAgreement";
    }

    $parm .= "&L_PAYMENTREQUEST_0_NAME0=".paypal_esacpe_parm(MODULE_PAYMENT_PAYPAL_TEXT_ITEMNAME);
    $parm .= "&L_PAYMENTREQUEST_0_AMT0=".$amt;
    $parm .= "&L_PAYMENTREQUEST_0_QTY0=1";

    // 商品情報
//    $no = 0;
//    foreach($order->products as $product) {
//      $tax   = 0;//$product['final_price']*$product['tax']/100;
//      $parm .= "&L_PAYMENTREQUEST_0_NAME".$no."=".paypal_esacpe_parm($product['name']);
//      $parm .= "&L_PAYMENTREQUEST_0_AMT".$no."=".($product['final_price']+$tax);
//      $parm .= "&L_PAYMENTREQUEST_0_NUMBER".$no."=".paypal_esacpe_parm($product['model']);
//      $parm .= "&L_PAYMENTREQUEST_0_QTY".$no."=".$product['qty'];
//      $no++;
//    }
//print str_replace("&", "<br/>", $parm);die;

    // API呼び出し
    $resArray = paypal_hash_call($method, $parm);
    $ack      = strtoupper($resArray["ACK"]);
    if ($ack == "SUCCESS") {
      // Redirect to paypal.com here
      $token     = urldecode($resArray["TOKEN"]);
      if (MODULE_PAYMENT_PAYPAL_EC_TEST == 'True')
        $payPalURL = PAYPAL_EC_URL_TEST.$token;
      else
        $payPalURL = PAYPAL_EC_URL.$token;
      header("Location: ".$payPalURL);
      exit;
    }
    else {
      global $messageStack;
      $messageStack->add_session('checkout_payment', $resArray['L_LONGMESSAGE0'], 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, "", "SSL"));
      exit;
    }
  }

  function DoExpressCheckout($token) {
    global $db;

    $method = "GetExpressCheckoutDetails";
    $parm   = "&TOKEN=".$token;

    // API呼び出し
    $resArray = paypal_hash_call($method, $parm);
    $ack      = strtoupper($resArray["ACK"]);
    if ($ack != 'SUCCESS') {
      global $messageStack;
      $messageStack->add_session('checkout_payment', $resArray['L_LONGMESSAGE0'], 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, "", "SSL"));
      exit;
    }

    // 通貨
    if (MODULE_PAYMENT_PAYPAL_EC_CURRENCY == 'USER') {
      $currency = $_SESSION['currency'];
    }
    else {
      $currency = MODULE_PAYMENT_PAYPAL_EC_CURRENCY;
    }

    $method = "DoExpressCheckoutPayment";
    $parm   = "&TOKEN=".$token
            . "&PAYERID=".$resArray["PAYERID"]
            . "&PAYMENTREQUEST_0_PAYMENTACTION=".MODULE_PAYMENT_PAYPAL_EC_SETTLEMENT_TYPE
            . "&PAYMENTREQUEST_0_AMT=".$resArray["PAYMENTREQUEST_0_AMT"]
            . "&PAYMENTREQUEST_0_CURRENCYCODE=".paypal_esacpe_parm($currency);

    // API呼び出し
    $resArray = paypal_hash_call($method, $parm);
    $ack      = strtoupper($resArray["ACK"]);
    if ($ack == 'SUCCESS' || $ack == 'SUCCESSWITHWARNING') {
      $db->Execute("update ".TABLE_CUSTOMERS." set paypal_express_checkout_billing_agreement_id='".zen_db_input($resArray["BILLINGAGREEMENTID"])."' where customers_id=".(int)$_SESSION['customer_id']);
    }
    else  {
      global $messageStack;
      $messageStack->add_session('checkout_payment', $resArray['L_LONGMESSAGE0'], 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, "", "SSL"));
      exit;
    }
  }

  function DoReferenceTransaction($billing_agreement_id) {
    global $order, $order_total_modules;
    global $currencies;

    $method = "DoReferenceTransaction";

    $parm  = "";
    $parm .= "&REFERENCEID=".$billing_agreement_id;

    // 送付先
    $parm .= "&SHIPTONAME=".paypal_esacpe_parm($order->delivery['firstname'].' '.$order->delivery['lastname']);
    $parm .= "&SHIPTOSTREET=".paypal_esacpe_parm($order->delivery['street_address']);
    $parm .= "&SHIPTOSTREET2=".paypal_esacpe_parm($order->delivery['suburb']);
    $parm .= "&SHIPTOCITY=".paypal_esacpe_parm($order->delivery['city']);
    $parm .= "&SHIPTOSTATE=".paypal_esacpe_parm($order->delivery['state']);
    $parm .= "&SHIPTOZIP=".paypal_esacpe_parm($order->delivery['postcode']);
    $parm .= "&SHIPTOCOUNTRYCODE=".paypal_esacpe_parm($order->delivery['country']['iso_code_2']);
    $parm .= "&SHIPTOPHONENUM=".paypal_esacpe_parm($order->delivery['telephone']);

    // 通貨
    if (MODULE_PAYMENT_PAYPAL_EC_CURRENCY == 'USER') {
      $amt = paypal_get_ot_total($order, $order_total_modules);
      $currency = $_SESSION['currency'];
    }
    else {
      $amt = paypal_get_ot_total($order, $order_total_modules, false);
      $currency = MODULE_PAYMENT_PAYPAL_EC_CURRENCY;
      $amt = number_format(paypal_convert_money_string($amt) * $currencies->get_value($currency), $currencies->get_decimal_places($currency));
      $amt = paypal_convert_money_string($amt);
    }

    // 金額
//    $tax   = paypal_get_ot_tax($order, $order_total_modules);
    $parm .= "&AMT=".$amt;
    $parm .= "&CURRENCYCODE=".paypal_esacpe_parm($currency);
//    $parm .= "&ITEMAMT=".(paypal_get_ot_subtotal($order, $order_total_modules)-$tax);
//    $parm .= "&SHIPPINGAMT=".paypal_get_ot_shipping($order, $order_total_modules);
//    $parm .= "&HANDLINGAMT=".paypal_get_ot_loworderfee($order, $order_total_modules);
//    $parm .= "&SHIPDISCAMT=".paypal_get_ot_coupon($order, $order_total_modules);
//    $parm .= "&TAXAMT=".$tax;
    $parm .= "&PAYMENTACTION=".MODULE_PAYMENT_PAYPAL_EC_SETTLEMENT_TYPE;

    $parm .= "&L_PAYMENTREQUEST_0_NAME0=".paypal_esacpe_parm(MODULE_PAYMENT_PAYPAL_TEXT_ITEMNAME);
    $parm .= "&L_PAYMENTREQUEST_0_AMT0=".$amt;
    $parm .= "&L_PAYMENTREQUEST_0_QTY0=1";

    // 商品情報
//    $no = 0;
//    foreach($order->products as $product) {
//      $tax   = 0;//$product['final_price']*$product['tax']/100;
//      $parm .= "&L_NAME".$no."=".paypal_esacpe_parm($product['name']);
//      $parm .= "&L_AMT".$no."=".($product['final_price']+$tax);
//      $parm .= "&L_NUMBER".$no."=".paypal_esacpe_parm($product['model']);
//      $parm .= "&L_QTY".$no."=".$product['qty'];
//      $no++;
//    }

    // API呼び出し
    $resArray = paypal_hash_call($method, $parm);
    $ack      = strtoupper($resArray["ACK"]);
    if ($ack == "SUCCESS") {
      ; // do nothing
    }
    else {
      global $messageStack;
      $messageStack->add_session('checkout_payment', $resArray['L_LONGMESSAGE0'], 'error');
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, "", "SSL"));
      exit;
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
}

?>