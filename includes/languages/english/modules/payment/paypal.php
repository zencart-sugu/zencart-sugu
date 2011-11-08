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
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong><br /><font color=green>Configuration Instructions:</font><br />On www.paypal.com, under "Profile",<ul><li>set your <strong>Instant Payment Notification Preferences</strong> URL to:<br />'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . ' </li><li>in <strong>Website Payments Preferences</strong> set your <strong>Automatic Return URL</strong> to:<br />'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</li>' . (defined('MODULE_PAYMENT_PAYPAL_STATUS') ? '' : '<li>... and click "install" above to enable PayPal support... and "edit" to tell Zen Cart your PayPal settings.</li>') . '</ul><font color=green><hr /></font>' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal IPN</strong>');
  }

  define('MODULE_PAYMENT_PAYPAL_TEXT_TX_ID', 'TransactionID: ');
  define('MODULE_PAYMENT_PAYPAL_TEXT_ITEMNAME', 'items');

?>