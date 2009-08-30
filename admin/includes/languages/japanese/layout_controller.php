<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: layout_controller.php 3197 2006-03-17 21:40:58Z drbyte $
//

define('HEADING_TITLE', 'サイドボックスの表示設定');

define('TABLE_HEADING_LAYOUT_BOX_NAME', 'ボックスファイル名');
define('TABLE_HEADING_LAYOUT_BOX_STATUS', '表示サイド(左/右) <br />ステータス');
define('TABLE_HEADING_LAYOUT_BOX_STATUS_SINGLE', 'シングルボックス<br />ステータス');
define('TABLE_HEADING_LAYOUT_BOX_LOCATION', '表示サイド<br />左 または 右');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER', '左/右 サイド<br />整列順');
define('TABLE_HEADING_LAYOUT_BOX_SORT_ORDER_SINGLE', 'シングルボックス<br />整列順');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_INFO_LAYOUT_BOX','選択中のボックス: ');
define('TEXT_INFO_LAYOUT_BOX_NAME', 'ボックス名:');
define('TEXT_INFO_LAYOUT_BOX_LOCATION','表示サイド: (シングルボックスになっている場合は無視されます)');
define('TEXT_INFO_LAYOUT_BOX_STATUS', '左/右 ボックス ステータス: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_SINGLE', 'シングルボックス ステータス: ');
define('TEXT_INFO_LAYOUT_BOX_STATUS_INFO','ON= 1 OFF=0');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER', '左/右 ソート順:');
define('TEXT_INFO_LAYOUT_BOX_SORT_ORDER_SINGLE', 'シングルボックス ソート順:');
define('TEXT_INFO_INSERT_INTRO', '新しいボックスのデータを入力してください。');
define('TEXT_INFO_DELETE_INTRO', 'このボックスを本当に削除しますか?');
define('TEXT_INFO_HEADING_NEW_BOX', '新しいボックス');
define('TEXT_INFO_HEADING_EDIT_BOX', 'ボックスを編集');
define('TEXT_INFO_HEADING_DELETE_BOX', 'ボックスを削除');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX','テンプレートリストから不明のボックスを削除: ');
define('TEXT_INFO_DELETE_MISSING_LAYOUT_BOX_NOTE','ノート: ファイル自体は削除されません。ファイルをディレクトリに追加するとボックスを再度追加することができます。<br /><br /><strong>削除するボックス: </strong>');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER','全てのボックスの表示順をデフォルトテンプレートのものに戻す: ');
define('TEXT_INFO_RESET_TEMPLATE_SORT_ORDER_NOTE','(ボックスは削除されません。表示順がリセットされるだけです。)');
define('TEXT_INFO_BOX_DETAILS','ボックス詳細: ');

////////////////

define('HEADING_TITLE_LAYOUT_TEMPLATE', 'サイトテンプレートレイアウト');

define('TABLE_HEADING_LAYOUT_TITLE', 'タイトル');
define('TABLE_HEADING_LAYOUT_VALUE', '値');
define('TABLE_HEADING_ACTION', '操作');


define('TEXT_MODULE_DIRECTORY', 'サイトレイアウト ディレクトリ:');
define('TEXT_INFO_DATE_ADDED', '登録日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');

// layout box text in includes/boxes/layout.php
define('BOX_HEADING_LAYOUT', 'レイアウト');
define('BOX_LAYOUT_COLUMNS', 'ボックスコントローラ');

// file exists
define('TEXT_GOOD_BOX',' ');
define('TEXT_BAD_BOX','<font color="ff0000"><b>MISSING!!</b></font><br />');


// Success message
define('SUCCESS_BOX_DELETED','ボックステンプレートの削除に成功しました。: ');
define('SUCCESS_BOX_RESET','ボックステンプレートをデフォルトの設定に戻しました。: ');
define('SUCCESS_BOX_UPDATED','ボックス設定の更新に成功しました。: ');

define('TEXT_ON',' ON ');
define('TEXT_OFF',' OFF ');
define('TEXT_LEFT',' 左 ');
define('TEXT_RIGHT',' 右 ');

?>