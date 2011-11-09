<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal.php 2644 2005-12-21 16:56:32Z drbyte $
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'Paypal');
  if (function_exists('zen_catalog_href_link')) {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '');
  }

  define('MODULE_PAYMENT_PAYPAL_TEXT_TX_ID', '取引ID: ');
  define('MODULE_PAYMENT_PAYPAL_TEXT_ITEMNAME', '商品一式');

?>