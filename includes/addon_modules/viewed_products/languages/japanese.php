<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
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
define('MODULE_VIEWED_PRODUCTS_TITLE', '最近見た商品');
define('MODULE_VIEWED_PRODUCTS_DESCRIPTION', '最近見た商品を記録して表示します。');
define('MODULE_VIEWED_PRODUCTS_STATUS_TITLE', '最近見た商品モジュールの有効化<br />有効化の後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks') . '">ブロックの設定</a>から「最近見た商品」ブロックの表示設定をしてください。');
define('MODULE_VIEWED_PRODUCTS_STATUS_DESCRIPTION', '最近見た商品を有効にしますか？<br />true: 有効<br />false: 無効');
define('MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_TITLE', '最大表示件数');
define('MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DESCRIPTION', '最近見た商品の最大表示件数を設定してください。<br />・初期値 = ' . MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DEFAULT);
define('MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_TITLE', '最近見た商品画像(小)のサイズ');
define('MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DESCRIPTION', '最近見た商品画像(小)のサイズを 横幅x高さ で設定してください。<br />・初期値 = ' . MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DEFAULT);
define('MODULE_VIEWED_PRODUCTS_SORT_ORDER_TITLE', '優先順');
define('MODULE_VIEWED_PRODUCTS_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_VIEWED_PRODUCTS_BLOCK_TITLE', '最近ご覧になった商品');
