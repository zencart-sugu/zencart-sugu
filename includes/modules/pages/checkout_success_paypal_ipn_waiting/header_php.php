<?php
/**
 * checkout_success_paypal_ipn_waiting header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Portions Copyright (c) 2004 DevosC.com
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id$
 */

// if the customer is not logged on, redirect them to the shopping cart page
if (!$_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}

if ( isset($_SESSION['cart']) ) {
  $_SESSION['cart']->reset(true);
}
foreach (array(
           'sendto',
           'billto',
           'shipping',
           'payment',
           'comments'
         ) as $zc_payment_keyword) {
  if ( isset($_SESSION[$zc_payment_keyword]) ) {
    unset($_SESSION[$zc_payment_keyword]);
  }
}

require(DIR_WS_CLASSES . 'order_total.php');
$order_total_modules = new order_total;
if (MODULE_ORDER_TOTAL_INSTALLED) {
  reset($order_total_modules->modules);
  while (list(, $value) = each($order_total_modules->modules)) {
    $class = substr($value, 0, strrpos($value, '.'));
    if ( $GLOBALS[$class]->credit_class) {
      // first parameter must be object instance for PHP4.
      if ( method_exists($GLOBALS[$class], "clear_posts") ) {
        $GLOBALS[$class]->clear_posts();
      }
    }
  }
}

// $_SESSION['paypal_session_unique_id'] is set in paypal process_button().
$sql = "SELECT COUNT(*) AS c FROM " . TABLE_PAYPAL_SESSION .
       " WHERE unique_id='" . (int)$_SESSION['paypal_session_unique_id'] . "'";
$result = $db->Execute($sql);
if ( $result->fields['c'] <= 0 ) {
  // IPN already notified.
  zen_redirect(zen_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
//$breadcrumb->add(NAVBAR_TITLE_1);
//$breadcrumb->add(NAVBAR_TITLE_2);

?>