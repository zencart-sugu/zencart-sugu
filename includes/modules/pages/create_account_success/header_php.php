<?php
/**
 * create_account_success header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 2968 2006-02-04 20:00:28Z wilt $
 */

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE_1);
$breadcrumb->add(NAVBAR_TITLE_2);

if (sizeof($_SESSION['navigation']->snapshot) > 0) {
  $origin_href = zen_href_link($_SESSION['navigation']->snapshot['page'], zen_array_to_string($_SESSION['navigation']->snapshot['get'], array(zen_session_name())), $_SESSION['navigation']->snapshot['mode']);
  $_SESSION['navigation']->clear_snapshot();
} else {
  $origin_href = zen_href_link(FILENAME_DEFAULT);
}
?>