<?php
/**
 * addon_modules_example - Database Name Defines
 *
 * @package classes
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
define('TABLE_ADDON_MODULES_FEATURE_AREA', DB_PREFIX . 'feature_area');
define('TABLE_ADDON_MODULES_FEATURE_AREA_INFO', DB_PREFIX . 'feature_area_info');
?>
