<?php
/**
 * customer authorisation based on DOWN_FOR_MAINTENANCE and CUSTOMERS_APPROVAL_AUTHORIZATION settings
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_customer_auth.php 2753 2005-12-31 19:17:17Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (!strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])){
  //  if (EXCLUDE_ADMIN_IP_FOR_MAINTENANCE != $_SERVER['REMOTE_ADDR']){
  if (DOWN_FOR_MAINTENANCE=='true' and $_GET['main_page'] != DOWN_FOR_MAINTENANCE_FILENAME) zen_redirect(zen_href_link(DOWN_FOR_MAINTENANCE_FILENAME));
}
/**
 * do not let people get to down for maintenance page if not turned on
 */
if (DOWN_FOR_MAINTENANCE=='false' and $_GET['main_page'] == DOWN_FOR_MAINTENANCE_FILENAME) {
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
}
/**
 * recheck customer status for authorization
 */
if (CUSTOMERS_APPROVAL_AUTHORIZATION > 0 && ($_SESSION['customer_id'] != '' and $_SESSION['customers_authorization'] != '0')) {
  $check_customer_query = "select customers_id, customers_authorization
                             from " . TABLE_CUSTOMERS . "
                             where customers_id = '" . $_SESSION['customer_id'] . "'";
  $check_customer = $db->Execute($check_customer_query);
  $_SESSION['customers_authorization'] = $check_customer->fields['customers_authorization'];
}
/**
 * customer login status
 * 0 = normal shopping
 * 1 = Login to shop
 * 2 = Can browse but no prices
 * verify display of prices
 */
switch (true) {
  case (DOWN_FOR_MAINTENANCE == 'true'):
  /**
   * if not down for maintenance check login status
   */
  break;
  //  case ($_GET['main_page'] == FILENAME_LOGOFF):
  case ($_GET['main_page'] == FILENAME_LOGOFF or $_GET['main_page'] == FILENAME_PRIVACY or $_GET['main_page'] == FILENAME_PASSWORD_FORGOTTEN or $_GET['main_page'] == FILENAME_CONTACT_US or $_GET['main_page'] == FILENAME_CONDITIONS or $_GET['main_page'] == FILENAME_SHIPPING or $_GET['main_page'] == FILENAME_UNSUBSCRIBE):
  break;
  case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
  /**
   * customer must be logged in to browse
   */
  //die('I see ' . $_GET['main_page'] . ' vs ' . FILENAME_LOGIN);
  if ($_GET['main_page'] != FILENAME_LOGIN and $_GET['main_page'] != FILENAME_CREATE_ACCOUNT ) {
    if (!isset($_GET['set_session_login'])) {
      $_GET['set_session_login'] = 'true';
      $_SESSION['navigation']->set_snapshot();
    }
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  break;
  case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
  /**
   * customer may browse but no prices
   */
  break;
  default:
  /**
   * proceed normally
   */
  break;
}
/**
 * customer authorization status
 * 0 = normal shopping
 * 1 = customer authorization to shop
 * 2 = customer authorization pending can browse but no prices
 * verify display of prices
 */
switch (true) {
  case (DOWN_FOR_MAINTENANCE == 'true'):
  /**
   * if not down for maintenance check login status
   */
  break;
  case ($_GET['main_page'] == FILENAME_LOGOFF or $_GET['main_page'] == FILENAME_PRIVACY or $_GET['main_page'] == FILENAME_PASSWORD_FORGOTTEN or $_GET['main_page'] == FILENAME_CONTACT_US or $_GET['main_page'] == FILENAME_CONDITIONS or $_GET['main_page'] == FILENAME_SHIPPING or $_GET['main_page'] == FILENAME_UNSUBSCRIBE):
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '1' and $_SESSION['customer_id'] == ''):
  /**
   * customer must be logged in to browse
   */
  if ($_GET['main_page'] != FILENAME_LOGIN and $_GET['main_page'] != FILENAME_CREATE_ACCOUNT ) {
    if (!isset($_GET['set_session_login'])) {
      $_GET['set_session_login'] = 'true';
      $_SESSION['navigation']->set_snapshot();
    }
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '2' and $_SESSION['customer_id'] == ''):
  /**
   * customer must be logged in to browse
   */
  /*
  if ($_GET['main_page'] != FILENAME_LOGIN and $_GET['main_page'] != FILENAME_CREATE_ACCOUNT ) {
  if (!isset($_GET['set_session_login'])) {
  $_GET['set_session_login'] = 'true';
  $_SESSION['navigation']->set_snapshot();
  }
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  */
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '1' and $_SESSION['customers_authorization'] != '0'):
  /**
   * customer is pending approval
   * customer must be logged in to browse
   */
  if ($_GET['main_page'] != CUSTOMERS_AUTHORIZATION_FILENAME) {
    zen_redirect(zen_href_link(CUSTOMERS_AUTHORIZATION_FILENAME));
  }
  break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION == '2' and $_SESSION['customers_authorization'] != '0'):
  /**
   * customer may browse but no prices
   */
  break;
  default:
  /**
   * proceed normally
   */
  break;
}
?>