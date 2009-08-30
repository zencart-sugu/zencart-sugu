<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: phpbb_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('SAVE_PHPBB_SETTINGS', 'Save phpBB Settings'); //this comes before TEXT_MAIN
  define('TEXT_MAIN', "Next we need to know some information about whether you have installed and want to use the phpBB Forum.  Please carefully enter each setting in the appropriate box and press <em>".SAVE_PHPBB_SETTINGS.'</em> to continue.');
  define('TEXT_PAGE_HEADING', 'Zen Cart&trade; Setup - phpBB Setup');
  define('PHPBB_INFORMATION', 'phpBB Information');
  define('PHPBB_USE', 'Do you want to use phpBB forums');
  define('PHPBB_USE_INSTRUCTION', 'Choose whether you want to use the phpBB forum or not.');
  define('PHPBB_DIR', 'phpBB Directory');
  define('PHPBB_DIR_INSTRUCTION', 'The directory where phpBB is installed');

//possible future use:
  define('PHPBB_DATABASE_NAME', 'phpBB Database Name');
  define('PHPBB_DATABASE_NAME_INSTRUCTION', 'What is the name of the database used to hold the data for the phpBB forum');
  define('PHPBB_DATABASE_PREFIX', 'phpBB Database Table-Prefix');
  define('PHPBB_DATABASE_PREFIX_INSTRUCTION', 'What is the prefix you would like used for the phpBB database tables?  Leave empty if no prefix is needed.');
?>