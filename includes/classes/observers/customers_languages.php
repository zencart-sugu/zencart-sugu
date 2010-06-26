<?php
/**
 * customers_languages.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: customers_languages.php 3012 2008-01-15 16:34:02Z sasaki $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class observers_customers_languages extends base  {

  function observers_customers_languages() {
    global $zco_notifier;
    $notifier = array(
      'NOTIFY_LOGIN_SUCCESS',
      'NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT'
      );
      
    $zco_notifier->attach($this, $notifier);
  }

  function update(&$callingClass, $notifier, $paramsArray) {
    if ($notifier == 'NOTIFY_LOGIN_SUCCESS'
      || $notifier == 'NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT') {
      zen_update_customers_language($_SESSION['customer_id'], $_SESSION['languages_id']);

    }
  }
}

?>