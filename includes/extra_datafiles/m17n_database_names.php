<?php
/**
 * m17n_database_names.php
 * Defines the filenames used in the project
 *
 * @package general
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: m17n_database_names.php 3454 2007-11-18 00:56:32Z sasaki$
 * @private
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('TABLE_ZONES_M17N', DB_PREFIX . 'zones_m17n');
define('TABLE_TAX_CLASS_M17N', DB_PREFIX . 'tax_class_m17n');
define('TABLE_TAX_RATES_M17N', DB_PREFIX . 'tax_rates_m17n');
define('TABLE_CURRENCIES_M17N', DB_PREFIX . 'currencies_m17n');
define('TABLE_GROUP_PRICING_M17N', DB_PREFIX . 'group_pricing_m17n');
?>