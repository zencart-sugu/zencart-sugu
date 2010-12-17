<?php
/**
 * Points
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: points.php $
 */

define('HEADING_TITLE', 'ポイント管理');
define('HEADING_TITLE_SEARCH', '顧客ID:');
define('HEADING_TITLE_CLASS', 'モジュールクラス:');

define('TABLE_HEADING_POINTS_ID', 'ID');
define('TABLE_HEADING_CUSTOMERS', '顧客名');
define('TABLE_HEADING_DESCRIPTION', '適用');
define('TABLE_HEADING_DEPOSIT', '有効');
define('TABLE_HEADING_PENDING', '保留');
define('TABLE_HEADING_WITHDRAW', '使用');
define('TABLE_HEADING_CLASS', 'モジュールクラス');
define('TABLE_HEADING_CREATED', '登録日時');
define('TABLE_HEADING_UPDATED', '更新日時');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_ALL_POINTS', '全て');
define('TEXT_DISPLAY_NUMBER_OF_POINTS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');

define('ENTRY_POINT_ID','ID: ');

define('ENTRY_CUSTOMERS_ID','顧客ID: ');
define('ENTRY_CUSTOMERS_NAME','顧客名: ');
define('ENTRY_CUSTOMERS_EMAIL','顧客メールアドレス: ');
define('ENTRY_DESCRIPTION','適用: ');
define('ENTRY_POINT','ポイント: ');
define('ENTRY_DEPOSIT','有効ポイント: ');
define('ENTRY_PENDING','保留ポイント: ');
define('ENTRY_WITHDRAW','使用ポイント: ');
define('ENTRY_STATUS','ステータス: ');

define('TEXT_INFO_HEADING_NEW_POINT', '新規ポイント登録');
define('TEXT_NEW_INTRO', '新規ポイントを登録します。');

define('TEXT_INFO_HEADING_NEWCONFIRM_POINT', '新規ポイント登録確認');
define('TEXT_NEWCONFIRM_INTRO', '以下の内容で新規ポイントを登録しますか？<br />ポイント残額計算に反映するには登録後にステータスONにします。');

define('TEXT_INFO_HEADING_EDIT_POINT', 'ポイント編集');
define('TEXT_EDIT_INTRO', 'このポイントを編集します。');

define('TEXT_INFO_HEADING_DELETE_POINT', 'ポイント削除確認');
define('TEXT_INFO_DELETE_INTRO', 'このポイントを本当に削除しますか?<br />データが完全に削除されます。この操作の実行は元に戻せません。');
define('TEXT_INFO_HEADING_STATUS_OFF_POINT', 'ステータスOFF確認');
define('TEXT_INFO_STATUS_OFF_INTRO', 'このポイントを本当にステータスOFFにしますか?<br />ステータスOFFにするとポイント残額計算に反映されなくなります。');
define('TEXT_INFO_HEADING_STATUS_ON_POINT', 'ステータスON確認');
define('TEXT_INFO_STATUS_ON_INTRO', 'このポイントを本当にステータスONにしますか?<br />ステータスONにするとポイント残額計算に反映されます。');
define('TEXT_INFO_HEADING_PENDING_TO_DEPOSIT_POINT', 'ポイント有効確認');
define('TEXT_INFO_PENDING_TO_DEPOSIT_INTRO', 'このポイントを本当に有効にしますか?');
define('TEXT_INFO_HEADING_DEPOSIT_TO_PENDING_POINT', 'ポイント保留確認');
define('TEXT_INFO_DEPOSIT_TO_PENDING_INTRO', 'このポイントを本当に保留にしますか?');
define('TEXT_STATUS_OFF', 'ステータスをOFFにする');
define('TEXT_STATUS_ON', 'ステータスをONにする');
define('TEXT_PENDING_TO_DEPOSIT', 'ポイントを有効にする');
define('TEXT_DEPOSIT_TO_PENDING', 'ポイントを保留にする');
define('TEXT_DATE_POINT_CREATED', '登録日:');
define('TEXT_DATE_POINT_UPDATED', '更新日:');
define('TEXT_INFO_POINT_CLASS', 'モジュールクラス:');

define('SUCCESS_POINT_INSERTED', 'ポイントが登録されました。ポイント残額計算に反映するにはステータスONにしてください。');
define('SUCCESS_POINT_UPDATED', 'ポイントが更新されました。');
define('SUCCESS_POINT_DELETED', 'ポイントが削除されました。');

define('ERROR_CUSTOMERS_ID', '顧客IDが存在しません。');
define('ERROR_DESCRIPTION', '適用を入力してください。');
define('ERROR_POINT_VALUE', 'ポイント数は1以上を入力してください。');
define('ERROR_POINT_SPECIFY', 'ポイント種別が不正です。');
