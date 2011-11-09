<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: application_top.php 3178 2006-03-12 22:30:49Z drbyte $
 */

/**
 * set the level of error reporting
 */
/**
 * set the level of error reporting
 * 
 * Note STRICT_ERROR_REPORTING should never be set to true on a production site. <br />
 * It is mainly there to show php warnings during testing/bug fixing phases.<br />
 * note for strict error reporting we also turn on show_errors as this may be disabled<br />
 * in php.ini. Otherwise we respect the php.ini setting 
 * 
 */
if (defined('STRICT_ERROR_REPORTING') && STRICT_ERROR_REPORTING == true) {
  @ini_set('display_errors', TRUE);
  error_reporting(version_compare(PHP_VERSION, 5.3, '>=') ? E_ALL & ~E_DEPRECATED & ~E_NOTICE : E_ALL & ~E_NOTICE);
} else {
  error_reporting(0);
}
/**
 * boolean used to see if we are in the admin script, obviously set to false here.
 */
if (!defined('IS_ADMIN_FLAG')) define('IS_ADMIN_FLAG', false);

// define the project version
  require('version.php');
// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];
  require('../includes/classes/class.base.php');
  require('../includes/classes/class.notifier.php');
  require('includes/functions/general.php');
  require('includes/classes/installer.php');
  $zc_install = new installer;
  define('DIR_WS_INSTALL_TEMPLATE', 'includes/templates/template_default/');
  
  // $language = 'english';
  $language = 'japanese';
  if  (isset($_GET['language'])) $language = $_GET['language'];
  if (!isset($_GET['language'])) $_GET['language'] = $language;

// initialize the message stack for output messages
  require('includes/classes/boxes.php');
  require('includes/classes/message_stack.php');
  $messageStack = new messageStack;

?>
