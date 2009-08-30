<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('TEXT_PAGE_HEADING', 'Zen Cart&trade; Setup - Administrator Account Setup');
  define('SAVE_ADMIN_SETTINGS', 'Save Admin Settings');//this comes before TEXT_MAIN
  define('TEXT_MAIN', "To administer settings in your Zen Cart&trade; shop, you need an Administrative account.  Please select an administrator's name, and password, and enter an email address for reset passwords to be sent to.  Enter and check the information carefully and press <em>".SAVE_ADMIN_SETTINGS.'</em> when you are done.');
  define('ADMIN_INFORMATION', 'Administrator Information');
  define('ADMIN_USERNAME', 'Administrator\'s Username');
  define('ADMIN_USERNAME_INSTRUCTION', 'Enter the username to be used for your Zen Cart administrator account.');
  define('ADMIN_PASS', 'Administrator\'s Password');
  define('ADMIN_PASS_INSTRUCTION', 'Enter the password to be used for your Zen Cart administrator account.');
  define('ADMIN_PASS_CONFIRM', 'Confirm Administrator\'s Password');
  define('ADMIN_PASS_CONFIRM_INSTRUCTION', 'Confirm the password to be used for your Zen Cart administrator account.');
  define('ADMIN_EMAIL', 'Administrator\'s Email');
  define('ADMIN_EMAIL_INSTRUCTION', 'Enter the email address to be used for your Zen Cart administrator account.');
  define('UPGRADE_DETECTION','Upgrade Detection');
  define('UPGRADE_INSTRUCTION_TITLE','Check for Zen Cart&trade; updates when logging into Admin');
  define('UPGRADE_INSTRUCTION_TEXT','This will attempt to talk to the live Zen Cart&trade; versioning server to determine if an upgrade is available or not. If an update is available, a message will appear in admin.  It will NOT automatically APPLY any upgrades.<br />You can override this later in Admin->Config->My Store->Check if version update is available.');

?>