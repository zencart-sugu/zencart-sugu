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
define('MODULE_SHOPPING_CART_SUMMARY_TITLE', 'ショッピングカートサマリーブロック');
define('MODULE_SHOPPING_CART_SUMMARY_DESCRIPTION', 'ショッピングカートサマリーブロック<br />ショッピングカートのサマリーを表示するブロックを追加します。<br />有効化後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">ブロックの設定</a>から表示設定をしてください。');
define('MODULE_SHOPPING_CART_SUMMARY_STATUS_TITLE', 'ショッピングカートサマリーブロックの有効化');
define('MODULE_SHOPPING_CART_SUMMARY_STATUS_DESCRIPTION', 'ショッピングカートサマリーブロックを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_TITLE', '優先順');
define('MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_SHOPPING_CART_SUMMARY_BLOCK_TITLE', 'ショッピングカートサマリーブロック');
define('HEADER_SHOPPING_CART_A_CONTENT', '');
define('HEADER_SHOPPING_CART_CONTENTS', '<span class="total">（%s点）</span>');
define('HEADER_SHOPPING_CART_EMPTY', '空です');
define('HEADER_SHOPPING_CART_TOTAL', ' 合計：<span class="price">%s</span>');
define('BUTTON_IMAGE_VIEW_SHOPPING_CART', 'button_view_shopping_cart.gif');
define('BUTTON_VIEW_SHOPPING_CART_ALT', 'カートの中身を見る');
?>