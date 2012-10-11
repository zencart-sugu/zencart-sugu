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
define('MODULE_EASY_ADMIN_TITLE',                    '管理メニューの設定');
define('MODULE_EASY_ADMIN_DESCRIPTION',              '管理画面のメニュー構成を簡単に変更できるようにする');

define('MODULE_EASY_ADMIN_STATUS_TITLE',             '管理メニューの設定の有効化');
define('MODULE_EASY_ADMIN_STATUS_DESCRIPTION',       '管理メニューの設定を有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL_TITLE', 'Dashboardリダイレクト先URL');
define('MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL_DESCRIPTION', HTTP_SERVER . DIR_WS_ADMIN .'までは自動で付与するのでその下を指定します');

define('MODULE_EASY_ADMIN_SORT_ORDER_TITLE',         '優先順');
define('MODULE_EASY_ADMIN_SORT_ORDER_DESCRIPTION',   'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// addon_moduleブロック管理用
define('MODULE_EASY_ADMIN_BLOCK_TITLE',              '管理メニューの設定');

define('BOX_EASY_ADMIN',                             '管理メニューの設定');
define('BOX_ADMIN_ACL',                              'アクセス権限の設定');

// TOP MENU
//   MENU NAME,DROP DOWN
// EXAMPLE
//   注文・顧客管理,1
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_1',        '注文・顧客管理,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_2',        '商品管理,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_3',        'コンテンツ管理,1');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_4',        '初期設定,0');
define('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_5',        'その他,0');

// SUB MENU
//   MENU NAME,MENU URL
// EXAMPLE
//   顧客管理,customers.php
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_1_1',      BOX_CUSTOMERS_CUSTOMERS.','.FILENAME_CUSTOMERS.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_1_2',      BOX_CUSTOMERS_ORDERS.','.FILENAME_ORDERS.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_2_1',      BOX_CATALOG_CATEGORIES_PRODUCTS.','.FILENAME_CATEGORIES.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_2_2',      BOX_CATALOG_PRODUCTS_PRICE_MANAGER.','.FILENAME_PRODUCTS_PRICE_MANAGER.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_4_1',      BOX_TOOLS_ADMIN.','.FILENAME_ADMIN.'.php');
define('MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_4_2',      BOX_EASY_ADMIN.','.FILENAME_ADDON_MODULES_ADMIN.'.php'.'?module='.FILENAME_EASY_ADMIN);
?>
