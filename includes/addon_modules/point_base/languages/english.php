<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//
define('MODULE_POINT_BASE_TITLE', 'Point');
define('MODULE_POINT_BASE_DESCRIPTION', 'Point Module');
define('MODULE_POINT_BASE_STATUS_TITLE', 'Activating Point Module<br />Please display setting of the "Current points balance" block for the <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks') . '">Block Setting</a> after activation.');
define('MODULE_POINT_BASE_STATUS_DESCRIPTION', 'Do you want to active to point? (Point module is required for all other point modules)<br />true: Enable<br />false: Disable');
define('MODULE_POINT_BASE_POINT_SYMBOL_TITLE', 'Point Unit Name');
define('MODULE_POINT_BASE_POINT_SYMBOL_DESCRIPTION', 'Please enter the name of the point unit.<br />Default = ' . MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT);
define('MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_TITLE', 'Maximum of the point history displayed by point management page');
define('MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DESCRIPTION', 'Please set up the maximum of the point history displayed on a point management page.<br />Default = ' . MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DEFAULT);
define('MODULE_POINT_BASE_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_POINT_BASE_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('BOX_CUSTOMERS_POINTS', 'Point Manager');

if (defined('MODULE_POINT_BASE_POINT_SYMBOL')) {
  define('TEXT_POINT', MODULE_POINT_BASE_POINT_SYMBOL);
} elseif (defined('MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT')) {
  define('TEXT_POINT', MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT);
} else {
  define('TEXT_POINT', 'Point');
}

define('SUCCESS_ADDPOINT_DEPOSIT', 'Purchase Points are now available');
define('SUCCESS_ADDPOINT_CANCEL', 'Purchase Points has been canceled');
define('SUCCESS_ADDPOINT_DELETE', 'Purchase Points has been removed');
define('SUCCESS_SUBPOINT_CANCEL', 'Used Points has been canceled');
define('SUCCESS_SUBPOINT_DELETE', 'Used Points has been removed');

define('SUCCESS_CUSTOMERS_POINTS_DELETE', 'Customerd points have been removed.');

define('MODULE_POINT_BASE_BLOCK_TITLE', 'Current Purchce Points.');
define('TEXT_CUSTOMERS_POINT_DEPOSIT', 'Available Purchase Points');
define('TEXT_CUSTOMERS_POINT_PENDING', 'Pending Purchase Points');
define('TEXT_CUSTOMERS_POINT_UPDATED', 'Last Modified.');
