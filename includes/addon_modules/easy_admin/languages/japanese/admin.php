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

define('HEADING_TITLE',                      '管理メニューの設定');

define('TEXT_HEADER_TOP_MENU',               'トップレベルメニュー一覧');
define('TEXT_HEADER_TOP_MENU_NAME',          'メニュー名');
define('TEXT_HEADER_TOP_MENU_TYPE',          '表示位置');
define('TEXT_HEADER_TOP_MENU_ORDER',         '並び順');
define('TEXT_HEADER_TOP_MENU_ACTION',        'アクション');

define('TEXT_MENU_TYPE_DROPDOWN',            'ドロップダウンメニュー');
define('TEXT_MENU_TYPE_RIGHTUP',             '右上メニュー');

define('TEXT_ACTION_ADD',                    '追加');
define('TEXT_ACTION_EDIT',                   '修正');
define('TEXT_ACTION_DELETE',                 '削除');
define('TEXT_ACTION_UPDATE',                 '更新');
define('TEXT_ACTION_SUBMENU',                'サブメニュー管理');

define('TEXT_INPUT_ADD',                     '[追加]');
define('TEXT_INPUT_NAME',                    'メニュー名');
define('TEXT_INPUT_TYPE',                    'メニュー表示位置');
define('TEXT_INPUT_ORDER',                   '並び順');

define('TEXT_ERROR_MENU_NAME',               'メニュー名を入力してください');
define('TEXT_ERROR_MENU_DROPDOWN',           'メニュー表示位置を選択してください');
define('TEXT_ERROR_MENU_ORDER',              '並び順を入力してください');
define('TEXT_INSERT_SUCCESS_TOPMENU',        'トップメニューの追加を行いました');
define('TEXT_UPDATE_SUCCESS_TOPMENU',        'トップメニューの変更を行いました');
define('TEXT_DELETE_SUCCESS_TOPMENU',        'トップメニューの削除を行いました(サブメニューも含めて削除)');
define('TEXT_CONFIRM_MENU_DELETE',           'を削除してもいいですか？');
?>