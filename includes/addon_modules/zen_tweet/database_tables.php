<?php
/**
 * addon_modules_skeleten - Database Name Defines
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
define('TABLE_ADDON_MODULES_ZEN_TWEET', DB_PREFIX . 'zentweet');
define('TABLE_PRODUCTS', DB_PREFIX . 'products');
define('TABLE_FEATURED', DB_PREFIX . 'featured');
define('TABLE_PRODUCTS_DESCRIPTION', DB_PREFIX . 'products_description');
define('TABLE_CATEGORIES_DESCRIPTION', DB_PREFIX . 'categories_description');
?>
