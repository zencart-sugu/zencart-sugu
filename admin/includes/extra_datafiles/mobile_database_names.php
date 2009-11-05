<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mobile_database_names.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('TABLE_CARRIER', DB_PREFIX . 'carrier');
define('TABLE_EMOJI', DB_PREFIX . 'emoji');
define('TABLE_CARRIER_EMOJI', DB_PREFIX . 'carrier_emoji');
?>
