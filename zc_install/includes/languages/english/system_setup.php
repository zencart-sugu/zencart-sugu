<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: system_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('SAVE_SYSTEM_SETTINGS', 'Save System Settings'); //this comes before TEXT_MAIN
  define('TEXT_MAIN', "We will now setup the Zen Cart&trade; System environment.  Please carefully review each setting, and change if necessary to suit your directory layout. Then click on <em>".SAVE_SYSTEM_SETTINGS.'</em> to continue.');
  define('TEXT_PAGE_HEADING', 'Zen Cart&trade; Setup - System Setup');
  define('SERVER_SETTINGS', 'Server Settings');
  define('PHYSICAL_PATH', 'Physical Path');
  define('PHYSICAL_PATH_INSTRUCTION', 'Physical Path to your<br />Zen Cart directory.<br />Leave no trailing slash.');
  define('PHYSICAL_HTTPS_PATH', 'Physical HTTPS Path');
  define('PHYSICAL_HTTPS_PATH_INSTRUCTION', 'Physical HTTPS Path to your<br />Zen Cart directory for SSL.<br />Leave no trailing slash.');
  define('VIRTUAL_HTTP_PATH', 'Virtual HTTP Path');
  define('VIRTUAL_HTTP_PATH_INSTRUCTION', 'Virtual Path to your<br />Zen Cart directory.<br />Leave no trailing slash.');
  define('VIRTUAL_HTTPS_PATH', 'Virtual HTTPS Path');
  define('VIRTUAL_HTTPS_PATH_INSTRUCTION', 'Virtual Path to your<br />secure Zen Cart directory.<br />Leave no trailing slash.');
  define('VIRTUAL_HTTPS_SERVER', 'Virtual HTTPS Server');
  define('VIRTUAL_HTTPS_SERVER_INSTRUCTION', 'Virtual server for your<br />secure Zen Cart directory.<br />Leave no trailing slash.');
  define('ENABLE_SSL', 'Enable SSL');
  define('ENABLE_SSL_INSTRUCTION', 'Would you like to enable Secure Sockets Layer in Customer area?<br />Leave this set to NO unless you\'re SURE you have SSL working.');
  define('ENABLE_SSL_ADMIN', 'Enable SSL in Admin Area');
  define('ENABLE_SSL_ADMIN_INSTRUCTION', 'Would you like to enable Secure Sockets Layer for Admin areas?<br />
Leave this set to NO unless you\'re SURE you have SSL working.');

?>