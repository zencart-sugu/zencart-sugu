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
//  $Id: banner_manager.php 3131 2006-03-07 22:53:04Z ajeh $
//

define('HEADING_TITLE', 'バナーの管理');

define('TABLE_HEADING_BANNERS', 'バナー');
define('TABLE_HEADING_GROUPS', 'グループ');
define('TABLE_HEADING_STATISTICS', '表示 / クリック');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS','新しいウィンドウ');
define('TABLE_HEADING_BANNER_ON_SSL', 'SSLを表示');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_BANNER_SORT_ORDER', 'ソート順');

define('TEXT_BANNERS_TITLE', 'バナー タイトル:');
define('TEXT_BANNERS_URL', 'バナー URL:');
define('TEXT_BANNERS_GROUP', 'バナー グループ:');
define('TEXT_BANNERS_NEW_GROUP', ' または下に新しいバナー・グループを登録');
define('TEXT_BANNERS_IMAGE', '画像ファイル:');
define('TEXT_BANNERS_IMAGE_LOCAL', ' または下にサーバ上の画像ファイル名を入力');
define('TEXT_BANNERS_IMAGE_TARGET', '画像の保存先:');
define('TEXT_BANNER_IMAGE_TARGET_INFO', '<strong>サーバー上のイメージの推奨される場所:</strong> ' . DIR_FS_CATALOG_IMAGES . 'banners/');
define('TEXT_BANNERS_HTML_TEXT_INFO', '<strong>注意: HTMLバナーはクリックの記録がされません。</strong>');
define('TEXT_BANNERS_HTML_TEXT', 'HTML テキスト:');
define('TEXT_BANNERS_ALL_SORT_ORDER', 'ソートの順番 全てのバナーボックス');
define('TEXT_BANNERS_ALL_SORT_ORDER_INFO', '<strong>注意: バナーボックスは全てのバナーを定義された順序で表示します。</strong>');
define('TEXT_BANNERS_EXPIRES_ON', '終了日:');
define('TEXT_BANNERS_OR_AT', ' または');
define('TEXT_BANNERS_IMPRESSIONS', '表示回数');
define('TEXT_BANNERS_SCHEDULED_AT', '開始日:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>バナーについて:</b><ul><li>バナーには、画像かHTMLテキストのいずれかを使用します。両方は使用できません。</li><li>HTMLテキストが画像よりも優先されます。</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>画像について:</b><ul><li>バナー画像保存先ディレクトリには、適切な書き込み権限を与えてください。</li><li>Webサーバにバナー画像をアップロードしない場合は、&quot;画像の保存先&quot; 欄は入力しないでください 。(この場合は、サーバ側の画像を使用することになります)</li><li>&quot;画像の保存先&quot; を指定する場合は、存在するディレクトリ、またはディレクトリを先に作成しておく必要があります。また、ディレクトリの末尾にスラッシュ(/)が必要です。(例: banners/)</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>終了日について:</b><ul><li>終了日と表示回数の2つの入力欄のうち、ひとつだけが登録されます。</li><li>バナー表示を自動的に終了させない場合は、これらの欄を空欄のままにしてください。</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>開始日について:</b><ul><li>開始日が登録されると、バナーは登録された日付から有効になります。</li><li>開始日が登録されたバナーは、開始日が来るまで表示されません。</li></ul>');
define('TEXT_BANNERS_STATUS', 'バナーのステータス:');
define('TEXT_BANNERS_ACTIVE', '表示');
define('TEXT_BANNERS_NOT_ACTIVE', '非表示');
define('TEXT_INFO_BANNER_STATUS', '<strong>注意:</strong> バナーのステータスは設定された日時と表示回数によって更新されます');
define('TEXT_BANNERS_OPEN_NEW_WINDOWS', 'バナーの新しいウィンドウ');
define('TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>注意:</strong>バナーは新しい窓で開きます');
define('TEXT_BANNERS_ON_SSL', 'SSL上のバナー');
define('TEXT_INFO_BANNER_ON_SSL', '<strong>注意:</strong>バナーはエラーのないSSLページに表示されます');

define('TEXT_BANNERS_DATE_ADDED', '登録日:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', '開始日: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', '終了日: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', '終了日: <b>%s</b> クリック数');
define('TEXT_BANNERS_STATUS_CHANGE', 'ステータス変更: %s');

define('TEXT_BANNERS_DATA', 'デ<br/>ー<br/>タ');
define('TEXT_BANNERS_LAST_3_DAYS', '最近３日間');
define('TEXT_BANNERS_BANNER_VIEWS', 'バナー表示');
define('TEXT_BANNERS_BANNER_CLICKS', 'バナー クリック');

define('TEXT_INFO_DELETE_INTRO', 'このバナーを本当に削除しますか？');
define('TEXT_INFO_DELETE_IMAGE', 'バナー画像も削除');

define('SUCCESS_BANNER_INSERTED', '成功: バナーが挿入されました。');
define('SUCCESS_BANNER_UPDATED', '成功: バナーが更新されました。');
define('SUCCESS_BANNER_REMOVED', '成功: バナーが削除されました。');
define('SUCCESS_BANNER_STATUS_UPDATED', '成功: バナーのステータスが変更されました。');

define('ERROR_BANNER_TITLE_REQUIRED', 'エラー: バナーのタイトルが必要です。');
define('ERROR_BANNER_GROUP_REQUIRED', 'エラー: バナーのグループが必要です。');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'エラー: 保存先のディレクトリが存在しません。: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'エラー: 保存先のディレクトリに書き込みができません。: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'エラー: 画像が存在しません。');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'エラー: 画像が削除できません。');
define('ERROR_UNKNOWN_STATUS_FLAG', 'エラー: 不明なステータスです。');
define('ERROR_BANNER_IMAGE_REQUIRED', 'エラー: バナーの画像が必要です。');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'エラー: グラフディレクトリが存在しません。グラフディレクトリを作成してください。例: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'エラー: グラフディレクトリに書き込みができません。グラフディレクトリの位置: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');

define('TEXT_LEGEND_BANNER_ON_SSL', 'SSLを表示');
define('TEXT_LEGEND_BANNER_OPEN_NEW_WINDOWS', '新しいウィンドウ');

// Tooltip Text for images in Banner Manager
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_ON','新しいウインドウを開くー可能');
define('IMAGE_ICON_BANNER_OPEN_NEW_WINDOWS_OFF','新しいウインドウを開くー不可能');
define('IMAGE_ICON_BANNER_ON_SSL_ON','安全なページを開くー可能');
define('IMAGE_ICON_BANNER_ON_SSL_OFF','安全なページを開くー不可能');

define('SUCCESS_BANNER_OPEN_NEW_WINDOW_UPDATED', '成功しました: 新しいウィンドウを開くバナーのステータスは更新されました.');
define('SUCCESS_BANNER_ON_SSL_UPDATED', '成功しました: SSLページ内で開くバナーのステータスは更新されました');
?>