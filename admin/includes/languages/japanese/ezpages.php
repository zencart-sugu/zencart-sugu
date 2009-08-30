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
//  $Id: ezpages.php 2827 2006-01-08 19:46:40Z ajeh $
//
define('HEADING_TITLE', 'EZ-Pages');
define('TABLE_HEADING_PAGES', 'ページタイトル');
define('TABLE_HEADING_ACTION', 'アクション');
define('TABLE_HEADING_VSORT_ORDER', 'サイドボックスの整列順');
define('TABLE_HEADING_HSORT_ORDER', 'Footer Sort Order');
define('TEXT_PAGES_TITLE', 'ページタイトル:');
define('TEXT_PAGES_HTML_TEXT', 'HTML コンテンツ:');
define('TABLE_HEADING_DATE_ADDED', '追加日:');
define('TEXT_PAGES_STATUS_CHANGE', 'ステータスの変更: %s');
define('TEXT_INFO_DELETE_INTRO', 'このページを本当に削除しますか？');
define('SUCCESS_PAGE_INSERTED', '成功: このページは挿入されました');
define('SUCCESS_PAGE_UPDATED', '成功: このページは更新されました');
define('SUCCESS_PAGE_REMOVED', '成功: このページは削除されました');
define('SUCCESS_PAGE_STATUS_UPDATED', '成功: このページのステータスは更新されました');
define('ERROR_PAGE_TITLE_REQUIRED', 'エラー: ページタイトルが必要です.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'エラー: ステータス不明のフラグです');
define('ERROR_MULTIPLE_HTML_URL', 'エラー: 各々のリンクに対して複数の設定を適用しています<br />: HTML コンテンツ -or- 内部リンク URL -or- 外部リンク URL　どれか一つのみ設定してください');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_STATUS_HEADER', 'ヘッダー:');
define('TABLE_HEADING_STATUS_SIDEBOX', 'サイドボックス:');
define('TABLE_HEADING_STATUS_FOOTER', 'フッター:');
define('TABLE_HEADING_STATUS_TOC', 'グルーピング:');
define('TABLE_HEADING_CHAPTER', 'グループID:');

define('TABLE_HEADING_PAGE_OPEN_NEW_WINDOW', '新しいウィンドウを開く:');
define('TABLE_HEADING_PAGE_IS_SSL', 'ページはSSLです:');

define('TEXT_DISPLAY_NUMBER_OF_PAGES', ' <b>%d</b> から <b>%d</b> を表示(<b>%d</b> ページ中)');
define('IMAGE_NEW_PAGE', '新規ページ');
define('TEXT_INFO_PAGE_IMAGE', 'イメージ');
define('TEXT_INFO_CURRENT_IMAGE', '現在のイメージ:');
define('TEXT_INFO_PAGES_ID', 'ID: ');
define('TEXT_INFO_PAGES_ID_SELECT', 'ページを選択 ...');

define('TEXT_HEADER_SORT_ORDER', '順番:');
define('TEXT_SIDEBOX_SORT_ORDER', '順番:');
define('TEXT_FOOTER_SORT_ORDER', '順番:');
define('TEXT_TOC_SORT_ORDER', '順番:');
define('TEXT_CHAPTER', 'グループID:');
define('TABLE_HEADING_CHAPTER_PREV_NEXT', 'グループID:&nbsp;<br />');

define('TEXT_HEADER_SORT_ORDER_EXPLAIN', 'ヘッダーの整列順はヘッダーが一列に作られている時にのみ使用されます; 整列順はゼロより大きい数値を設定してください');
define('TEXT_SIDEBOX_ORDER_EXPLAIN', 'サイドボックスの整列順はサイドボックスが垂直に並べられている時にのみ使用されます; 整列順はゼロより大きい数値を設定してください。');
define('TEXT_FOOTER_ORDER_EXPLAIN', 'フッターの整列順はフッターが一列に作られている時にのみ使用されます; 整列順はゼロより大きい数値を設定してください');
define('TEXT_TOC_SORT_ORDER_EXPLAIN', 'グループ整列順はコンテンツブロックのエリアが一列に垂直に並んでいる時のみ使用できます。整列順はゼロより大きい数値を設定してください。');
define('TEXT_CHAPTER_EXPLAIN', 'グルーピングを使用して、ページをグループ化し自動的に目次を表示させることができます。同じグループIDをもつページ同士がグループ化されます。整列順はグループ内での目次の表示順を指定します。');

define('TEXT_ALT_URL', '内部リンクURL:');
define('TEXT_ALT_URL_EXPLAIN', '特定されるとこのページコンテンツは無視され、内部リンクはリンクとして使用されるURLに変換されます。<br />例: index.php?main_page=reviews<br />マイアカウントの例: index.php?main_page=account and mark as SSL');

define('TEXT_ALT_URL_EXTERNAL', '外部リンク URL:');
define('TEXT_ALT_URL_EXTERNAL_EXPLAIN', '特定されるとこのページコンテンツは無視され、外部リンクはリンクとして使用されるURLに変換されます。<br />外部リンクへの例: http://www.sashbox.net');

define('TEXT_SORT_CHAPTER_TOC_TITLE_INFO', '表示順: ');
define('TEXT_SORT_CHAPTER_TOC_TITLE', 'グループ');
define('TEXT_SORT_HEADER_TITLE', 'ヘッダー');
define('TEXT_SORT_SIDEBOX_TITLE', 'サイドボックス');
define('TEXT_SORT_FOOTER_TITLE', 'フッター');
define('TEXT_SORT_PAGE_TITLE', 'ページタイトル');
define('TEXT_SORT_PAGE_ID_TITLE', 'ページID, タイトル');

define('TEXT_PAGE_TITLE', 'タイトル:');
define('TEXT_WARNING_MULTIPLE_SETTINGS', '<strong>警告: 複数のリンク定義</strong>');
?>