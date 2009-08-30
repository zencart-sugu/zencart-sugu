<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_general_funcs.php 4682 2006-10-06 20:52:56Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * load the system wide functions
 *
 * @package admin
 * @copyright Copyright 2003-2005 zen-cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
**/
// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// Define how do we update currency exchange rates
// Possible values are 'oanda' 'xe' or ''
  define('CURRENCY_SERVER_PRIMARY', 'oanda');
  define('CURRENCY_SERVER_BACKUP', 'xe');

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// define our general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'functions_prices.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'functions_email.php');

/**
 * Per-Page meta-tag editing functions
 */
require(DIR_WS_FUNCTIONS . 'functions_metatags.php');


// include the list of extra functions
  if ($za_dir = @dir(DIR_WS_FUNCTIONS . 'extra_functions')) {
    while ($zv_file = $za_dir->read()) {
      if (strstr($zv_file, '.php')) {
        require(DIR_WS_FUNCTIONS . 'extra_functions/' . $zv_file);
      }
    }
  }
if (isset($_GET) & sizeof($_GET) > 0 ) {
  foreach ($_GET as $key=>$value) {
    $_GET[$key] = strip_tags($value);
  }
}
?>