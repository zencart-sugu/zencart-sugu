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
define('MODULE_CAROUSEL_UI_TITLE', 'カルーセルUI');
define('MODULE_CAROUSEL_UI_DESCRIPTION', 'カルーセルUI<br />「新着商品」「おすすめ商品」「特価商品」をカルーセルUIブロックで表示します。<br />有効化の後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">ブロックの設定</a>から表示設定をしてください。');

define('MODULE_CAROUSEL_UI_STATUS_TITLE', 'カルーセルUIの有効化');
define('MODULE_CAROUSEL_UI_STATUS_DESCRIPTION', 'カルーセルUIを有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_TITLE', 'jCarouselLiteライブラリ');
define('MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DESCRIPTION', 'jCarouselLiteライブラリのファイル名を設定します。特に理由がない限り変更する必要はありません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DEFAULT);

define('MODULE_CAROUSEL_UI_SORT_ORDER_TITLE', '優先順');
define('MODULE_CAROUSEL_UI_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。<br />※jQueryモジュールよりも大きな数字を設定してください。');

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_TITLE', '新着商品 - 最大表示件数');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DESCRIPTION', '新着商品の最大表示件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_TITLE', '新着商品 - 自動スクロール');
define('MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DESCRIPTION', '新着商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_TITLE', '新着商品 - スクロール速度');
define('MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DESCRIPTION', '新着商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_TITLE', '新着商品 - 縦スクロール');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DESCRIPTION', '新着商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_TITLE', '新着商品 - 循環スクロール');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DESCRIPTION', '新着商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_TITLE', '新着商品 - スクロールエリア表示件数');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DESCRIPTION', '新着商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_TITLE', '新着商品 - スクロール件数');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DESCRIPTION', '新着商品の一度にスクロールさせる件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - 最大表示件数');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品の最大表示件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - 自動スクロール');
define('MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - スクロール速度');
define('MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - 縦スクロール');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - 循環スクロール');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - スクロールエリア表示件数');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_TITLE', 'おすすめ商品 - スクロール件数');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DESCRIPTION', 'おすすめ商品の一度にスクロールさせる件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_TITLE', '特価商品 - 最大表示件数');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品の最大表示件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_TITLE', '特価商品 - 自動スクロール');
define('MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_TITLE', '特価商品 - スクロール速度');
define('MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_TITLE', '特価商品 - 縦スクロール');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_TITLE', '特価商品 - 循環スクロール');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_TITLE', '特価商品 - スクロールエリア表示件数');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_TITLE', '特価商品 - スクロール件数');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DESCRIPTION', '特価商品の一度にスクロールさせる件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - 最大表示件数');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますの最大表示件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - 自動スクロール');
define('MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますを自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - スクロール速度');
define('MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますをスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - 縦スクロール');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますを縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - 循環スクロール');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますを循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - スクロールエリア表示件数');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますのスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_TITLE', 'こんな商品も購入しています - スクロール件数');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'こんな商品も購入していますの一度にスクロールさせる件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_TITLE', '関連商品 - 最大表示件数');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DESCRIPTION', '関連商品の最大表示件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_TITLE', '関連商品 - 自動スクロール');
define('MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DESCRIPTION', '関連商品を自動的にスクロールする場合の間隔(ミリ秒)を設定します。<br />0ミリ秒の場合は自動スクロールしません。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_TITLE', '関連商品 - スクロール速度');
define('MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DESCRIPTION', '関連商品をスクロールする速度(ミリ秒)を設定します。<br />設定値を大きくするとゆっくりスクロールします。0に設定するとスクロールしなくなります。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_TITLE', '関連商品 - 縦スクロール');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DESCRIPTION', '関連商品を縦にスクロールしますか？<br />true: 縦スクロール<br />false: 横スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_TITLE', '関連商品 - 循環スクロール');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DESCRIPTION', '関連商品を循環的にスクロールしますか？<br />true: 循環スクロール<br />false: 往復スクロール<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_TITLE', '関連商品 - スクロールエリア表示件数');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DESCRIPTION', '関連商品のスクロールエリアに表示する件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_TITLE', '関連商品 - スクロール件数');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DESCRIPTION', '関連商品の一度にスクロールさせる件数を設定します。<br />・初期値 = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DEFAULT);

define('BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS', 'button_carousel_ui_prev.gif');
define('BUTTON_CAROUSEL_UI_PREVIOUS_ALT', '前へ');
define('BUTTON_IMAGE_CAROUSEL_UI_NEXT', 'button_carousel_ui_next.gif');
define('BUTTON_CAROUSEL_UI_NEXT_ALT', '次へ');
define('BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED', 'button_carousel_ui_prev-disabled.gif');
define('BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED',     'button_carousel_ui_next-disabled.gif');
define('BUTTON_CAROUSEL_UI_DISABLED_ALT', '無効');

define('MODULE_CAROUSEL_UI_BLOCK_NEW_PRODUCTS_TITLE', '%sの新着商品');
define('MODULE_CAROUSEL_UI_BLOCK_FEATURED_PRODUCTS_TITLE', 'おすすめ商品');
define('MODULE_CAROUSEL_UI_BLOCK_SPECIALS_PRODUCTS_TITLE', '%s: 今月の特価品');
define('MODULE_CAROUSEL_UI_BLOCK_ALSO_PURCHASED_PRODUCTS_TITLE', 'この商品を買った人はこんな商品も買っています');
define('MODULE_CAROUSEL_UI_BLOCK_XSELL_PRODUCTS_TITLE', 'この商品の関連商品');

define('BUTTON_IMAGE_SHIPPING', 'button_footer_shipping.gif');
define('BUTTON_SHIPPING_ALT', '配送方法');

define('BUTTON_CAROUSEL_UI_PAGE', 'ページ:');
