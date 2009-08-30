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
//  $Id: manufacturers.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'メーカーの管理');

define('TABLE_HEADING_MANUFACTURERS', 'メーカー');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_MANUFACTURER', '新しいメーカー');
define('TEXT_HEADING_EDIT_MANUFACTURER', 'メーカーを編集');
define('TEXT_HEADING_DELETE_MANUFACTURER', 'メーカーを削除');

define('TEXT_MANUFACTURERS', 'メーカー:');
define('TEXT_DATE_ADDED', '登録日:');
define('TEXT_LAST_MODIFIED', '更新日:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'アップロードするディレクトリ:');
define('TEXT_IMAGE_NONEXISTENT', '画像がありません。');

define('TEXT_NEW_INTRO', '新しいメーカーの情報を入力してください。');
define('TEXT_EDIT_INTRO', '必要な変更を行ってください。');

define('TEXT_MANUFACTURERS_NAME', 'メーカー名:');
define('TEXT_MANUFACTURERS_IMAGE', 'メーカーの画像:');
define('TEXT_MANUFACTURERS_URL', 'メーカーのURL:');

define('TEXT_DELETE_INTRO', 'このメーカーを本当に削除しますか?');
define('TEXT_DELETE_IMAGE', 'メーカーの画像を削除しますか?');
define('TEXT_DELETE_PRODUCTS', 'このメーカーの商品を削除しますか? (商品レビュー、特価商品、入荷予定商品も含みます)');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> このメーカーにリンクされている商品が %s個あります!');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'エラー: このディレクトリに書き込みできません。正しいユーザ権限を %s に設定してください。');
define('ERROR_DIRECTORY_DOES_NOT_EXIST', 'エラー: %s ディレクトリが存在しません。');
?>