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
define('MODULE_CALENDAR_TITLE',                    '営業カレンダー');
define('MODULE_CALENDAR_DESCRIPTION',              '営業カレンダー');

define('MODULE_CALENDAR_STATUS_TITLE',             '営業カレンダーの有効化');
define('MODULE_CALENDAR_STATUS_DESCRIPTION',       '営業カレンダーを有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_CALENDAR_START_SUNDAY_TITLE',       '週の開始が日曜日');
define('MODULE_CALENDAR_START_SUNDAY_DESCRIPTION', '週の開始を日曜日としますか？ <br />true: 日曜<br />false: 月曜');

define('MODULE_CALENDAR_DELIVERY_TITLE',           '配送指定可能日');
define('MODULE_CALENDAR_DELIVERY_INPUT',           '最短配送可能日：注文日の翌日から%s営業日<br/>最終配送可能日：最短配送可能日から%s日間');
define('MODULE_CALENDAR_DELIVERY_DESCRIPTION',     '配送日として指定できる範囲を日数として指定します');

define('MODULE_CALENDAR_DELIVERY_START_TITLE',     '最短配送可能日: 注文日の翌日からの営業日');
define('MODULE_CALENDAR_DELIVERY_END_TITLE',       '最終配送可能日: 最短配送可能日から日間');
define('MODULE_CALENDAR_DELIVERY_DESCRIPTION',     '配送日として指定できる範囲を日数として指定します');

define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_TITLE',       '配送時刻の選択項目');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_DESCRIPTION', '配送時刻の選択項目をカンマ区切りで入力してください');

define('MODULE_CALENDAR_SORT_ORDER_TITLE',         '優先順');
define('MODULE_CALENDAR_SORT_ORDER_DESCRIPTION',   'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// addon_moduleブロック管理用
define('MODULE_CALENDAR_BLOCK_TITLE', 'Business Calendar');

define('MODULE_CALENDAR_TITLE_STYLE', '%s/%s');
define('MODULE_CALENDAR_SUN', 'SUN');
define('MODULE_CALENDAR_MON', 'MON');
define('MODULE_CALENDAR_TUE', 'TUE');
define('MODULE_CALENDAR_WED', 'WED');
define('MODULE_CALENDAR_THU', 'THU');
define('MODULE_CALENDAR_FRI', 'FRI');
define('MODULE_CALENDAR_SAT', 'SAT');

define('MODULE_CALENDAR_SHIPPING',             'You order today, the earliest delivery date is %s.');
define('MODULE_CALENDAR_SHIPPING_END',         '%s can be specified as the delivery date.');
define('MODULE_CALENDAR_SHIIPING_DAY',         '%_MONTH_%/%_DAY_%');

define('MODULE_CALENDAR_HOLIDAY_DAY',          '%_DAY_% of every month');
define('MODULE_CALENDAR_HOLIDAY_WEEK',         'Every %_WEEK_%');
define('MODULE_CALENDAR_HOLIDAY_WEEKCNT',      'Every %_WEEKCNT_%th %_WEEK_%');
define('MODULE_CALENDAR_HOLIDAY_MONTHWEEKCNT', '%_WEEKCNT_%th %_WEEK_% of %_MONTH_%');
define('MODULE_CALENDAR_HOLIDAY_MONTHDAY',     '%_MONTH_%/%_DAY_%');
define('MODULE_CALENDAR_HOLIDAY_YEARMONTHDAY', '%_YEAR_%/%_MONTH_%/%_DAY_%');
define('MODULE_CALENDAR_HOLIDAY',              'is regular holiday.');

define('MODULE_CALENDAR_DAY', '<span class="today">X</span>Order date&nbsp;&nbsp;<span class="rest">X</span>Holiday&nbsp;&nbsp;<span>X</span>Buiness date');
define('BOX_CALENDAR', 'Business Calendar');

define('BUTTON_IMAGE_FOOTER_SHIPPING', 'button_footer_shipping.gif');
define('BUTTON_FOOTER_SHIPPING_ALT', 'Available Shipping Methods');

define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_HEADER',  'Specified Delivery Date');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_HEADER', 'Specified Delivery Time');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FORMAT',  'm/d');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FAST',    'As Soon As Possible');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_NONE',   'Not Specified');
?>
