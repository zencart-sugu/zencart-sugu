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
define('MODULE_FEATURE_AREA_TITLE', 'フィーチャーエリアUI');
define('MODULE_FEATURE_AREA_DESCRIPTION', 'フィーチャーエリアUI');
define('MODULE_FEATURE_AREA_STATUS_TITLE', 'フィーチャーエリアUIの有効化');
define('MODULE_FEATURE_AREA_STATUS_DESCRIPTION', 'フィーチャーエリアUIを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_FEATURE_AREA_SORT_ORDER_TITLE', '優先順');
define('MODULE_FEATURE_AREA_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_FEATURE_AREA_BLOCK_TITLE', 'フィーチャーエリアUI');
define('MODULE_FEATURE_AREA_TITLE', 'フィーチャーエリアUI');

//define('NAVBAR_TITLE', 'フィーチャーエリアUI');

define('BOX_ADDON_MODULES_FEATURE_AREA', 'フィーチャーエリアUI');

define('MODULE_FEATURE_AREA_UI_MAX_DISPLAY_TITLE', 'サムネイル - 最大表示数');
define('MODULE_FEATURE_AREA_UI_MAX_DISPLAY_DESCRIPTION', 'サムネイルの最大表示件数を設定します。<br />・初期値 = ' . MODULE_FEATURE_AREA_UI_MAX_DISPLAY_DEFAULT);
define('MODULE_FEATURE_AREA_UI_CONF_AUTO_TITLE', 'メイン画像 - 自動スクロール ');
define('MODULE_FEATURE_AREA_UI_CONF_AUTO_DESCRIPTION', 'メイン画像を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_FEATURE_AREA_UI_CONF_AUTO_DEFAULT);
define('MODULE_FEATURE_AREA_UI_CONF_SPEED_TITLE', 'メイン画像 - スクロール速度');
define('MODULE_FEATURE_AREA_UI_CONF_SPEED_DESCRIPTION', 'メイン画像をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_FEATURE_AREA_UI_CONF_SPEED_DEFAULT);
define('MODULE_FEATURE_AREA_UI_CONF_VISIBLE_TITLE', 'サムネイル - スクロールエリア表示件数');
define('MODULE_FEATURE_AREA_UI_CONF_VISIBLE_DESCRIPTION', 'サムネイルのスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_FEATURE_AREA_UI_CONF_VISIBLE_DEFAULT);

define('BUTTON_IMAGE_FEATURE_AREA_UI_PREV',  'button_carousel_ui_prev.png');
define('BUTTON_IMAGE_FEATURE_AREA_UI_NEXT',  'button_carousel_ui_next.png');
define('BUTTON_IMAGE_FEATURE_AREA_UI_STOP',  'button_carousel_ui_stop.png');
define('BUTTON_IMAGE_FEATURE_AREA_UI_START', 'button_carousel_ui_start.png');
define('BUTTON_CAROUSEL_UI_PREV_ALT',        '前へ');
define('BUTTON_CAROUSEL_UI_NEXT_ALT',        '次へ');
define('BUTTON_CAROUSEL_UI_STOP_ALT',        '停止');
define('BUTTON_CAROUSEL_UI_START_ALT',       '再開');
?>