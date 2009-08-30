<?php
/**
 * load the system wide functions
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_special_funcs.php 2753 2005-12-31 19:17:17Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * require the whos online functions and update
 */
require(DIR_WS_FUNCTIONS . 'whos_online.php');
zen_update_whos_online();
/**
 * require the password crypto functions
 */
require(DIR_WS_FUNCTIONS . 'password_funcs.php');
/**
 * require the banner functions, auto-activate and auto-expire
 */
require(DIR_WS_FUNCTIONS . 'banner.php');
zen_activate_banners();
zen_expire_banners();
/**
 * only process once per session do not include banners as banners expire per click as well as per date
 * require the banner functions, auto-activate and auto-expire.
 *
 * this is processed in the admin for dates that expire as being worked on
 */
if (isset($_SESSION['updateExpirations']) && $_SESSION['updateExpirations'] === true) {
  /**
   * require the specials products functions, auto-activate and auto-expire
   */
  require(DIR_WS_FUNCTIONS . 'specials.php');
  zen_start_specials();
  zen_expire_specials();
  /**
   * require the featured products functions, auto-activate and auto-expire
   */
  require(DIR_WS_FUNCTIONS . 'featured.php');
  zen_start_featured();
  zen_expire_featured();
  /**
   * require the salemaker functions, auto-activate and auto-expire
   */
  require(DIR_WS_FUNCTIONS . 'salemaker.php');
  zen_start_salemaker();
  zen_expire_salemaker();
  $_SESSION['updateExpirations'] = true;
}
?>