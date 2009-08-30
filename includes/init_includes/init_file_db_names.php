<?php
/**
 * load the filename/database table names and he compatiblity functions
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_file_db_names.php 3051 2006-02-17 03:40:14Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * set the type of request (secure or not)
 */
$request_type = ((isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) == 'on') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == '1') || (isset($_SERVER['HTTP_X_FORWARDED_BY']) && strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_BY']),'SSL')) || (isset($_SERVER['HTTP_X_FORWARDED_HOST']) &&  strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_HOST']),'SSL')) || (isset($_SERVER['SCRIPT_URI']) && strtolower(substr($_SERVER['SCRIPT_URI'], 0, 6)) == 'https:') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' )   )  ? 'SSL' : 'NONSSL';
/**
 * set php_self in the local scope
 */
if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
/**
 * require global definitons for Filenames 
 */
require(DIR_WS_INCLUDES . 'filenames.php');
/**
 * require global definitons for Database Table Names 
 */
require(DIR_WS_INCLUDES . 'database_tables.php');
/**
 * require compatibility functions 
 */
require(DIR_WS_FUNCTIONS . 'compatibility.php');
/**
 * include the list of extra database tables and filenames
 */
// set directories to check for databases and filename files
$extra_datafiles_directory = DIR_FS_CATALOG . DIR_WS_INCLUDES . 'extra_datafiles/';
$ws_extra_datafiles_directory = DIR_WS_INCLUDES . 'extra_datafiles/';

// Check for new databases and filename etc in extra_datafiles directory
$directory_array = array();
$file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));

if ($dir = @dir($extra_datafiles_directory)) {
  while ($file = $dir->read()) {
    if (!is_dir($extra_datafiles_directory . $file)) {
      if (preg_match('/\.php$/', $file) > 0) {
        $directory_array[] = $file;
      }
    }
  }
  if (sizeof($directory_array)) {
    sort($directory_array);
  }
  $dir->close();
}

$file_cnt=0;
for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
  $file_cnt++;
  $file = $directory_array[$i];

  if (file_exists($ws_extra_datafiles_directory . $file)) {
      /**
       * require 3rd party datafiles (ussually to add extra filename/DB Table name definitions) 
       */
    include($ws_extra_datafiles_directory . $file);
    //    echo 'LOADING: ' . $ws_extra_datafiles_directory . $file . ' ' . $file_cnt . '<br />';
  }
}
?>