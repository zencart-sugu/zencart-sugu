<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE',             'カレンダー設定');
define('HEADING_SUBTITLE_HOLIDAY',  '○営業日設定');
define('HEADING_SUBTITLE_SHIPPING', '○配送可能日設定');

define('TEXT_HOLIDAY_INFORMATION',  '休日、営業日を編集してください');

define('TEXT_ACTION_EDIT',   '編集');
define('TEXT_ACTION_DELETE', '削除');
define('TEXT_ACTION_UPDATE', '更新');
define('TEXT_ACTION_ADD',    '追加');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'エラー: キャッシュディレクトリが存在しません。 設定->キャッシュで設定してください。');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'エラー: キャッシュディレクトリに書き込みができません。正しいユーザ権限を設定してください。');

define('TEXT_CONFIRM_CALENDAR_DELETE', 'を削除してもいいですか？');

define('TEXT_HEADER_CALENDAR_TYPE',      '営業');
define('TEXT_HEADER_CALENDAR_NAME',      '指定日');
define('TEXT_HEADER_CALENDAR_OPERATION', '操作');

define('TEXT_OPENDAY',      '営業日');

define('TEXT_LIST_ADD',     '休日、営業日追加');
define('TEXT_LIST_WEEK',    '%s曜日');
define('TEXT_LIST_WEEKCNT', '第%d週');
define('TEXT_LIST_YEAR',    '%d年');
define('TEXT_LIST_MONTH',   '%d月');
define('TEXT_LIST_DAY',     '%d日');

define('TEXT_RADIO_EVERYWEEK',   '毎週');
define('TEXT_RADIO_EVERYMONTH',  '毎月');
define('TEXT_RADIO_EVERYYEAR',   '毎年');
define('TEXT_RADIO_MONTH',       '特定月');
define('TEXT_RADIO_SPECIFICDAY', '特定日');
define('TEXT_RADIO_HOLIDAY',     '休日');
define('TEXT_RADIO_OPENDAY',     '営業日');
define('TEXT_RADIO_DESCRIPTION', '上記指定日を<font color="red">　%s　</font>とする');

define('TEXT_UPDATE_SUCCESS', 'カレンダーの更新を行いました');
define('TEXT_ERROR_SETTING',  '日付の設定がおかしいです');
define('TEXT_ERROR_DELIVERY', '配送日の設定がおかしいです');
?>