<?php
/**
 * addon_modules_example - Database Name Defines
 *
 * @package classes
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: database_tables.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * Database name defines
 *
 */
define('TABLE_EASY_ADMIN_TOP_MENUS', DB_PREFIX . 'easy_admin_top_menus');
define('TABLE_EASY_ADMIN_SUB_MENUS', DB_PREFIX . 'easy_admin_sub_menus');
define('TABLE_ADMIN_ACL', DB_PREFIX . 'admin_acl');
?>
