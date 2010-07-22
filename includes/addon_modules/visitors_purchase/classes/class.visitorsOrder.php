<?php
/**
 * File contains the order-processing class ("order")
 *
 * @package classes
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.visitorsOrder.php $
 */
/**
 * vistors order
 * Handles vistors order-mail-processing functions
 *
 * @package classes
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class visitorsOrder extends order {

  function visitorsOrder($order) {
    foreach ($order as $key => $value) {
      $this->$key = $value;
    }
  }

  function send_order_email($zf_insert_id, $zf_mode) {
    global $currencies, $order_totals;

    //      print_r($this);
    //      die();
    if ($this->email_low_stock != '' and SEND_LOWSTOCK_EMAIL=='1') {
      // send an email
      $email_low_stock = SEND_EXTRA_LOW_STOCK_EMAIL_TITLE . "\n\n" . $this->email_low_stock;
      zen_mail('', SEND_EXTRA_LOW_STOCK_EMAILS_TO, EMAIL_TEXT_SUBJECT_LOWSTOCK, $email_low_stock, STORE_OWNER, EMAIL_FROM, array('EMAIL_MESSAGE_HTML' => nl2br($email_low_stock)),'low_stock');
    }

    // lets start with the email confirmation
    // make an array to store the html version
    $html_msg=array();

    //intro area
    $email_order = EMAIL_TEXT_HEADER . EMAIL_TEXT_FROM . STORE_NAME . "\n\n" .
    $this->customer['firstname'] . ' ' . $this->customer['lastname'] . EMAIL_GREET . "\n\n" .
    EMAIL_THANKS_FOR_SHOPPING . "\n" . EMAIL_DETAILS_FOLLOW . "\n" .
    EMAIL_SEPARATOR . "\n" .
    EMAIL_TEXT_ORDER_NUMBER . ' ' . $zf_insert_id . "\n" .
    EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n" .

    $html_msg['EMAIL_TEXT_HEADER']     = EMAIL_TEXT_HEADER;
    $html_msg['EMAIL_TEXT_FROM']       = EMAIL_TEXT_FROM;
    $html_msg['INTRO_STORE_NAME']      = STORE_NAME;
    $html_msg['EMAIL_THANKS_FOR_SHOPPING'] = EMAIL_THANKS_FOR_SHOPPING;
    $html_msg['EMAIL_DETAILS_FOLLOW']  = EMAIL_DETAILS_FOLLOW;
    $html_msg['INTRO_ORDER_NUM_TITLE'] = EMAIL_TEXT_ORDER_NUMBER;
    $html_msg['INTRO_ORDER_NUMBER']    = $zf_insert_id;
    $html_msg['INTRO_DATE_TITLE']      = EMAIL_TEXT_DATE_ORDERED;
    $html_msg['INTRO_DATE_ORDERED']    = strftime(DATE_FORMAT_LONG);

    //comments area
    if ($this->info['comments']) {
      $email_order .= zen_db_output($this->info['comments']) . "\n\n";
      $html_msg['ORDER_COMMENTS'] = zen_db_output($this->info['comments']);
    } else {
      $html_msg['ORDER_COMMENTS'] = '';
    }

    //products area
    $email_order .= EMAIL_TEXT_PRODUCTS . "\n" .
    EMAIL_SEPARATOR . "\n" .
    $this->products_ordered .
    EMAIL_SEPARATOR . "\n";
    $html_msg['PRODUCTS_TITLE'] = EMAIL_TEXT_PRODUCTS;
    $html_msg['PRODUCTS_DETAIL']='<table class="product-details" border="0" width="100%" cellspacing="0" cellpadding="2">' . $this->products_ordered_html . '</table>';

    //order totals area
    $html_ot .= '<td class="order-totals-text" align="right" width="100%">' . '&nbsp;' . '</td><td class="order-totals-num" align="right" nowrap="nowrap">' . '---------' .'</td></tr><tr>';
    for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
      $email_order .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
      $html_ot .= '<td class="order-totals-text" align="right" width="100%">' . $order_totals[$i]['title'] . '</td><td class="order-totals-num" align="right" nowrap="nowrap">' .($order_totals[$i]['text']) .'</td></tr><tr>';
    }
    $html_msg['ORDER_TOTALS'] = '<table border="0" width="100%" cellspacing="0" cellpadding="2">' . $html_ot . '</table>';

    $html_msg['HEADING_ADDRESS_INFORMATION']= HEADING_ADDRESS_INFORMATION;

    $html_msg['ADDRESS_CUSTOMER_TITLE']     = EMAIL_TEXT_CUSTOMER_ADDRESS;
    $html_msg['ADDRESS_CUSTOMER_DETAIL']    = zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, '', "<br />") . '<br />'. ENTRY_EMAIL_ADDRESS . $this->customer['email_address'];

    $email_order .= "\n" . EMAIL_TEXT_CUSTOMER_ADDRESS . "\n" .
    EMAIL_SEPARATOR . "\n" .
    zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], 0, '', "\n") . "\n" .
    ENTRY_EMAIL_ADDRESS . $this->customer['email_address'] . "\n";

    //addresses area: Delivery
    $html_msg['ADDRESS_DELIVERY_TITLE']     = EMAIL_TEXT_DELIVERY_ADDRESS;
    $html_msg['ADDRESS_DELIVERY_DETAIL']    = ($this->content_type != 'virtual') ? zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, '', "<br />") : 'n/a';
    $html_msg['SHIPPING_METHOD_TITLE']      = HEADING_SHIPPING_METHOD;
    $html_msg['SHIPPING_METHOD_DETAIL']     = (zen_not_null($this->info['shipping_method'])) ? $this->info['shipping_method'] : 'n/a';

    if ($this->content_type != 'virtual') {
      $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" .
      EMAIL_SEPARATOR . "\n" .
      zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], 0, '', "\n") . "\n";
    }

    //addresses area: Billing
    $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
    EMAIL_SEPARATOR . "\n" .
    zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], 0, '', "\n") . "\n\n";
    $html_msg['ADDRESS_BILLING_TITLE']   = EMAIL_TEXT_BILLING_ADDRESS;
    $html_msg['ADDRESS_BILLING_DETAIL']  = zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, '', "<br />");

    if (is_object($GLOBALS[$_SESSION['payment']])) {
      $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" .
      EMAIL_SEPARATOR . "\n";
      $payment_class = $_SESSION['payment'];
      $email_order .= $GLOBALS[$payment_class]->title . "\n\n";
      if ($GLOBALS[$payment_class]->email_footer) {
        $email_order .= $GLOBALS[$payment_class]->email_footer . "\n\n";
      }
    } else {
      $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" .
      EMAIL_SEPARATOR . "\n";
      $email_order .= PAYMENT_METHOD_GV . "\n\n";
    }
    $html_msg['PAYMENT_METHOD_TITLE']  = EMAIL_TEXT_PAYMENT_METHOD;
    $html_msg['PAYMENT_METHOD_DETAIL'] = (is_object($GLOBALS[$_SESSION['payment']]) ? $GLOBALS[$payment_class]->title : PAYMENT_METHOD_GV );
    $html_msg['PAYMENT_METHOD_FOOTER'] = (is_object($GLOBALS[$_SESSION['payment']]) ? $GLOBALS[$payment_class]->email_footer : '');

    $html_msg['EMAIL_VISITORS_DISCLAIMER'] = sprintf(EMAIL_VISITORS_DISCLAIMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');

    // include disclaimer
    $email_order .= "\n-----\n" . sprintf(EMAIL_VISITORS_DISCLAIMER, STORE_OWNER_EMAIL_ADDRESS) . "\n\n";
    // include copyright
    $email_order .= "\n-----\n" . EMAIL_FOOTER_COPYRIGHT . "\n\n";

    while (strstr($email_order, '&nbsp;')) $email_order = str_replace('&nbsp;', ' ', $email_order);

    $html_msg['EMAIL_FIRST_NAME'] = $this->customer['firstname'];
    $html_msg['EMAIL_LAST_NAME'] = $this->customer['lastname'];
    $html_msg['EMAIL_GREET'] = EMAIL_GREET;
    //  $html_msg['EMAIL_TEXT_HEADER'] = EMAIL_TEXT_HEADER;
    $html_msg['EXTRA_INFO'] = '';
    zen_mail($this->customer['firstname'] . ' ' . $this->customer['lastname'], $this->customer['email_address'], EMAIL_TEXT_SUBJECT . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id, $email_order, STORE_NAME, EMAIL_FROM, $html_msg, 'checkout_visitors');

    // send additional emails
    if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
      $extra_info=email_collect_extra_info('','', $this->customer['firstname'] . ' ' . $this->customer['lastname'], $this->customer['email_address'], $this->customer['telephone']);
      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
      zen_mail('', SEND_EXTRA_ORDER_EMAILS_TO, SEND_EXTRA_VISITORS_NEW_ORDERS_EMAILS_TO_SUBJECT . ' ' . EMAIL_TEXT_SUBJECT . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id,
      $email_order . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'checkout_visitors_extra');
    }
  }

}
