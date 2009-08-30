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
// close session (store variables)
zen_session_close();

// breaks things
// pconnect disabled (safety switch)
// $db->close();

if ( (GZIP_LEVEL == '1') && ($ext_zlib_loaded == true) && ($ini_zlib_output_compression < 1) ) {
  if ( (PHP_VERSION < '4.0.4') && (PHP_VERSION >= '4') ) {
    zen_gzip_output(GZIP_LEVEL);
  }
}
?>