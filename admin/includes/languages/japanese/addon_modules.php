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
//  $Id: addon_modules.php $
//

define('HEADING_TITLE', '追加モジュールの管理');

define('TEXT_ADDON_MODULES_REFRESH_LIST', '再読み込み');
define('TEXT_ADDON_MODULES_LEGEND', '凡例: ');
define('TEXT_ADDON_MODULES_ACTIVE', '有効なモジュール');
define('TEXT_ADDON_MODULES_INACTIVE', '無効なモジュール');
define('TEXT_ADDON_MODULES_REMOVED', 'インストールされていないモジュール');

define('TABLE_HEADING_MODULES', 'モジュール');
define('TABLE_HEADING_VARSION', 'バージョン');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_SORT_ORDER', '優先順');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_ADDON_MODULES_ADMIN_PAGES', 'モジュール管理ページ:');
define('TEXT_MODULE_DIRECTORY', 'モジュールディレクトリ:');

define('TEXT_INFO_HEADING_UPDATE_MODULE', 'モジュールのアップデート');
define('TEXT_UPDATE_MODULE_INTRO', 'モジュールが更新されています、アップデートを実行してください。<br /><span class="alert">この操作は元に戻すことができません。バックアップを取るなどして慎重に行ってください。</span>');
define('IMAGE_MODULE_UPDATE', 'モジュールのアップデート');
define('TEXT_UPDATE_MODULE_DO_NOTHING', 'アップデート可能な項目はありません。');
define('ERROE_MODULE_UPDATE_FAILED', 'エラー: %s モジュールのアップデートに失敗しました。');

define('TEXT_INFO_HEADING_CLEANUP_MODULE', 'モジュールデータの削除');
define('TEXT_CLEANUP_MODULE_INTRO', '次のテーブルをデータベースから完全に削除します。<br /><span class="alert">この操作は元に戻すことができません。バックアップを取るなどして慎重に行ってください。</span>');
define('IMAGE_MODULE_CLEANUP', 'モジュールデータの削除');
define('TEXT_CLEANUP_MODULE_DO_NOTHING', '削除可能なモジュールデータはありません。');
define('ERROE_MODULE_CLEANUP_FAILED', 'エラー: %s モジュールのデータ削除に失敗しました。先にモジュールのアンインストールを行ってください。');

define('SUCCESS_CREATE_TABLE', '%sテーブルをデータベースに作成しました。');
define('SUCCESS_DROP_TABLE', '%sテーブルをデータベースから削除しました。');

define('BUTTON_TEXT_MODULE_DOWNLOAD', 'モジュールのダウンロード');
