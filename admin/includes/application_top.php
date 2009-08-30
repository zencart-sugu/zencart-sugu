<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: application_top.php 3009 2006-02-11 15:41:10Z wilt $
//
/**
 * File contains just application_top code
 * 
 * Initializes common classes & methods. Controlled by an array which describes
 * the elements to be initialised and the order in which that happens.
 *
 * @package admin
 * @copyright Copyright 2003-2005 zen-cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 */
/**
 * boolean if true the autoloader scripts will be parsed and their output shown. For debugging purposes only.
 */
define('DEBUG_AUTOLOAD', false);
/** 
 * boolean used to see if we are in the admin script, obviously set to false here.
 * DO NOT REMOVE THE define BELOW. WILL BREAK ADMIN
 */
define('IS_ADMIN_FLAG', true);
/** 
 * integer saves the time at which the script started.
 */
// Start the clock for the page parse time log
define('PAGE_PARSE_START_TIME', microtime());
/**
 * set the level of error reporting
 */
error_reporting(E_ALL & ~E_NOTICE);

// set php_self in the local scope
if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
/**
 * Set the local configuration parameters - mainly for developers
 */
if (file_exists('includes/local/configure.php')) {
  /**
   * load any local(user created) configure file.
   */
  include('includes/local/configure.php');
}
// Check for application configuration parameters
if (!file_exists('includes/configure.php')) {
  if (file_exists('../zc_install/index.php')) {
    //header('location: ../zc_install/index.php');
    echo 'ERROR: Admin configure.php not found. Suggest running install? <a href="../zc_install/index.php">Click here for installation</a>';
  } else {
    die('ERROR: admin/includes/configure.php file not found. Suggest running zc_install/index.php?');
  }
}
/**
 * load the main configure file.
 */
require('includes/configure.php');
/**
 * ignore version-check if INI file setting has been set
 */
if (file_exists(DIR_FS_ADMIN . 'includes/local/skip_version_check.ini')) {
  $lines=@file(DIR_FS_ADMIN . 'includes/local/skip_version_check.ini');
  foreach($lines as $line) {
    if (substr($line,0,14)=='admin_configure_php_check=') $check_cfg=substr(trim(strtolower(str_replace('admin_configure_php_check=','',$line))),0,3);
  }
}
/*
// turned off for now
  if ($check_cfg != 'off') {
    // if the admin/includes/configure.php file doesn't contain admin-related content, throw error
    $zc_pagepath = str_replace(basename($PHP_SELF),'',__FILE__); //remove page name from full path of current page
    $zc_pagepath = str_replace(array('\\','\\\\'),'/',$zc_pagepath); // convert '\' marks to '/'
    $zc_pagepath = str_replace('//','/',$zc_pagepath); //convert doubles to single
    $zc_pagepath = str_replace(strrchr($zc_pagepath,'/'),'',$zc_pagepath); // remove trailing '/'
    $zc_adminpage = str_replace('\\','/',DIR_FS_ADMIN); //convert "\" to '/'
    $zc_adminpage = str_replace('//','/',$zc_adminpage); // remove doubles
    $zc_adminpage = str_replace(strrchr($zc_adminpage,'/'),'',$zc_adminpage); // remove trailing '/'
    if (!defined('DIR_WS_ADMIN') || $zc_pagepath != $zc_adminpage ) {
      echo ('ERROR: The admin/includes/configure.php file has invalid configuration. Please rebuild, or verify specified paths.');
      if (file_exists('../zc_install/index.php')) {
        echo '<br /><a href="../zc_install/index.php">Click here for installation</a>';
      }
      echo '<br /><br /><br /><br />['.$zc_pagepath.']&nbsp;&nbsp;&nbsp;&laquo;&raquo;&nbsp;&nbsp;&nbsp;[' .$zc_adminpage.']<br />';
    }
  }
*/
/**
 * include the list of extra configure files
 */
if ($za_dir = @dir(DIR_WS_INCLUDES . 'extra_configures')) {
  while ($zv_file = $za_dir->read()) {
    if (strstr($zv_file, '.php')) {
      /** 
       * include the list of extra configure files
       */
      include(DIR_WS_INCLUDES . 'extra_configures/' . $zv_file);
    }
  }
}
$loader_file = 'config.core.php';
$base_dir = DIR_WS_INCLUDES . 'auto_loaders/';
if (file_exists(DIR_WS_INCLUDES . 'auto_loaders/overrides/' . $loader_file)) {
  $base_dir = DIR_WS_INCLUDES . 'auto_loaders/overrides/';
}
/**
 * load the default application_top autoloader file. 
 */
include($base_dir . $loader_file);
if ($loader_dir = dir(DIR_WS_INCLUDES . 'auto_loaders')) {
  while ($loader_file = $loader_dir->read()) {
    if ((preg_match('/^config\./', $loader_file) > 0) && (preg_match('/\.php$/', $loader_file) > 0)) {
      if ($loader_file != 'config.core.php') {
        $base_dir = DIR_WS_INCLUDES . 'auto_loaders/';
        if (file_exists(DIR_WS_INCLUDES . 'auto_loaders/overrides/' . $loader_file)) {
          $base_dir = DIR_WS_INCLUDES . 'auto_loaders/overrides/';
        }
        /**
         * load the application_top autoloader files.
         */
        include($base_dir . $loader_file);
      }
    }
  }
}
/** 
 * load the autoloader interpreter code.
 */
require(DIR_FS_CATALOG . 'includes/autoload_func.php');

/**
  * is Furikana nesessary?
**/
if (defined('FURIKANA_NECESSARY_COUNTRIES') &&
  !is_bool(strpos(strtolower(FURIKANA_NECESSARY_COUNTRIES), strtolower($_SESSION['language']))))
  define('FURIKANA_NESESSARY', true);
else
  define('FURIKANA_NESESSARY', false);
?>