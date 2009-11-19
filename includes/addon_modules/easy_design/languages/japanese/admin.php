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

define('HEADING_TITLE',                      'デザインの設定');

define('TEXT_HEADER_CHANGE_TEMPLATE',        'テンプレートの変更');
define('TEXT_HEADER_CHANGE_COLOR',           'カラーの変更');
define('TEXT_HEADER_CHANGE_OBJECTION',       '文言の変更');
define('TEXT_HEADER_CHANGE_LOGO',            'ロゴ画像の変更');

define('TEXT_ACTION_CHANGE',                 '変更');
define('TEXT_ACTION_SAVE',                   '保存');
define('TEXT_ACTION_RECOVERY',               '初期設定に戻す');

define('TEXT_UPDATE_SUCCESS_TEMPLATE',       'テンプレートの変更を行いました');
define('TEXT_UPDATE_SUCCESS_COLOR',          'カラーの変更を行いました');
define('TEXT_UPDATE_FAILURE_COLOR',          'カラーの変更が失敗しました（cssファイルの書き込みができません）');
define('TEXT_UPDATE_SUCCESS_OBJECTION',      '文言の変更を行いました');
define('TEXT_UPDATE_SUCCESS_LOGO',           'ロゴ画像の変更を行いました');
define('TEXT_UPDATE_FAILURE_LOGO',           'ロゴ画像の変更が失敗しました');
define('TEXT_UPDATE_FAILURE_LOGO_EXT',       'アップロードできるのは画像のみです(gif,jpg,bmp,tif,png)');
define('TEXT_UPDATE_FAILURE_LOGO_UNLINK',    '既に存在するファイルの削除ができません');
define('TEXT_UPDATE_FAILURE_LOGO_DIR',       'テンプレート内にimages/logoディレクトリが存在しません');
define('TEXT_UPDATE_FAILURE_LOGO_PERMIT',    'テンプレート内のimages/logoディレクトリに書き込み権限がありません');

define('TEXT_CONFIRM_COLOR_RECOVERY',        'カラーを初期状態に戻してもいいですか？');
?>