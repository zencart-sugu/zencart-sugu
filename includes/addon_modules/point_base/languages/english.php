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
define('MODULE_POINT_BASE_TITLE', 'ポイント');
define('MODULE_POINT_BASE_DESCRIPTION', 'ポイントモジュール');
define('MODULE_POINT_BASE_STATUS_TITLE', 'ポイントモジュールの有効化<br />有効化の後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks') . '">ブロックの設定</a>から「現在のポイント残額」ブロックの表示設定をしてください。');
define('MODULE_POINT_BASE_STATUS_DESCRIPTION', 'ポイントを有効にしますか？ (ポイントモジュールは他の全てのポイントモジュールにとって必須です)<br />true: 有効<br />false: 無効');
define('MODULE_POINT_BASE_POINT_SYMBOL_TITLE', 'ポイント単位名称');
define('MODULE_POINT_BASE_POINT_SYMBOL_DESCRIPTION', 'ポイントの単位名称を入力してください。<br />・初期値 = ' . MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT);
define('MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_TITLE', 'ポイント管理ページで表示するポイント履歴の最大値');
define('MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DESCRIPTION', 'ポイント管理ページで表示するポイント履歴の最大値を設定してください。<br />・初期値 = ' . MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DEFAULT);
define('MODULE_POINT_BASE_SORT_ORDER_TITLE', '優先順');
define('MODULE_POINT_BASE_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('BOX_CUSTOMERS_POINTS', 'ポイント管理');

if (defined('MODULE_POINT_BASE_POINT_SYMBOL')) {
  define('TEXT_POINT', MODULE_POINT_BASE_POINT_SYMBOL);
} elseif (defined('MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT')) {
  define('TEXT_POINT', MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT);
} else {
  define('TEXT_POINT', 'ポイント');
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
