<?php
/**
 * zen_smartphone modules functions.php
 *
 * @package functions
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

// functions_customers.php の zen_customer_greeting より、zen_smartphoneに特化したものを再定義
// 全体に関係するので。
function zen_customer_greeting_for_smartphone() {

  if (isset($_SESSION['customer_id']) && $_SESSION['customer_first_name']) {
    $greeting_string = sprintf(TEXT_GREETING_FOR_SMARTPHONE_PERSONAL, zen_href_link(FILENAME_ACCOUNT), zen_output_string_protected($_SESSION['customer_first_name']), zen_href_link(FILENAME_LOGOFF));
  } else {
    $greeting_string = sprintf(TEXT_GREETING_FOR_SMARTPHONE_GUEST, zen_href_link(FILENAME_LOGIN, '', 'SSL'), zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
  }

  return $greeting_string;
}

?>