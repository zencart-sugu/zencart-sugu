<?php
/**
 * application_bottom.php
 * Common actions carried out at the end of each page invocation.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: application_bottom.php 3019 2006-02-13 03:59:48Z birdbrain $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (in_array($filename, $restore_language_pages) && isset($admin_language)) {
  zen_restore_language($admin_language);
}
?>