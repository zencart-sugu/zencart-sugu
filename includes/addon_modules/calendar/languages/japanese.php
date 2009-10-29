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
define('MODULE_CALENDAR_BLOCK_TITLE', '営業カレンダー');

define('MODULE_CALENDAR_SUN', '日');
define('MODULE_CALENDAR_MON', '月');
define('MODULE_CALENDAR_TUE', '火');
define('MODULE_CALENDAR_WED', '水');
define('MODULE_CALENDAR_THU', '木');
define('MODULE_CALENDAR_FRI', '金');
define('MODULE_CALENDAR_SAT', '土');

define('MODULE_CALENDAR_SHIPPING',             '本日ご注文いただくと、最短お届け日は%sです');
define('MODULE_CALENDAR_SHIPPING_END',         '%sまで最終配送可能日として指定できます');
define('MODULE_CALENDAR_SHIIPING_DAY',         '%_MONTH_%月%_DAY_%日');

define('MODULE_CALENDAR_HOLIDAY_DAY',          '毎月%_DAY_%日');
define('MODULE_CALENDAR_HOLIDAY_WEEK',         '毎週%_WEEK_%曜日');
define('MODULE_CALENDAR_HOLIDAY_WEEKCNT',      '第%_WEEKCNT_%%_WEEK_%曜日');
define('MODULE_CALENDAR_HOLIDAY_MONTHWEEKCNT', '%_MONTH_%月第%_WEEKCNT_%%_WEEK_%曜日');
define('MODULE_CALENDAR_HOLIDAY_MONTHDAY',     '%_MONTH_%月%_DAY_%日');
define('MODULE_CALENDAR_HOLIDAY_YEARMONTHDAY', '%_YEAR_%年%_MONTH_%月%_DAY_%日');
define('MODULE_CALENDAR_HOLIDAY',              'は定休日です');

define('MODULE_CALENDAR_DAY',              '<span class="today">■</span>注文日&nbsp;&nbsp;<span class="rest">■</span>休業日&nbsp;&nbsp;<span>■</span>営業日');

define('BOX_CALENDAR', '営業カレンダー');

define('BUTTON_IMAGE_FOOTER_SHIPPING', 'button_footer_shipping.gif');
define('BUTTON_FOOTER_SHIPPING_ALT', '配送方法');

define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_HEADER',  '希望配送日');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_HEADER', '希望配送時刻');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FORMAT',  'm月d日');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FAST',    '最短で発送');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_NONE',   '指定しない');
?>