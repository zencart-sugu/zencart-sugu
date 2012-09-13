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
define('MODULE_EASY_ADMIN_TITLE',                    'Admin Menu Setting');
define('MODULE_EASY_ADMIN_DESCRIPTION',              'To be able to easily change the admin menu structure.');

define('MODULE_EASY_ADMIN_STATUS_TITLE',             'Activating Admin Menu Setting');
define('MODULE_EASY_ADMIN_STATUS_DESCRIPTION',       'Do you want to active to Admin Menu Setting?<br />true: Active<br />false: Inactive');

define('MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL_TITLE', 'Dashboardリダイレクト先URL');
define('MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL_DESCRIPTION', '');

define('MODULE_EASY_ADMIN_SORT_ORDER_TITLE',         'Sort Order');
define('MODULE_EASY_ADMIN_SORT_ORDER_DESCRIPTION',   'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_EASY_ADMIN_BLOCK_TITLE',              'Admin Menu Setting');

define('BOX_EASY_ADMIN',                             'Admin Menu Setting');
define('BOX_ADMIN_ACL',                              'Access Permissions Setting');

// TOP MENU
//   MENU NAME,DROP DOWN
// EXAMPLE
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_1',        'Order Customer Management,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_2',        'Product Management,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_3',        'Content Management,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_4',        'Initialization,0');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_5',        'Other,0');

// SUB MENU
//   MENU NAME,MENU URL
// EXAMPLE
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_1_1',      BOX_CUSTOMERS_CUSTOMERS.','.FILENAME_CUSTOMERS.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_1_2',      BOX_CUSTOMERS_ORDERS.','.FILENAME_ORDERS.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_2_1',      BOX_CATALOG_CATEGORIES_PRODUCTS.','.FILENAME_CATEGORIES.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_2_2',      BOX_CATALOG_PRODUCTS_PRICE_MANAGER.','.FILENAME_PRODUCTS_PRICE_MANAGER.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_4_1',      BOX_TOOLS_ADMIN.','.FILENAME_ADMIN.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_4_2',      BOX_EASY_ADMIN.','.FILENAME_ADDON_MODULES_ADMIN.'.php'.'?module='.FILENAME_EASY_ADMIN);
?>