<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: product_types.php 1122 2005-04-05 04:37:58Z drbyte $
//

define('HEADING_TITLE', '商品タイプの管理');
define('HEADING_TITLE_LAYOUT', '商品タイプ情報ページ レイアウトオプション :: ');

define('TABLE_HEADING_PRODUCT_TYPES', '商品タイプ');
define('TABLE_HEADING_PRODUCT_TYPES_ALLOW_ADD_TO_CART', 'カートに<br />入れる');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_CONFIGURATION_TITLE', 'タイトル');
define('TABLE_HEADING_CONFIGURATION_VALUE', '値');

define('TEXT_HEADING_NEW_PRODUCT_TYPE', '新しい商品タイプ');
define('TEXT_HEADING_EDIT_PRODUCT_TYPE', '商品タイプを編集');
define('TEXT_HEADING_DELETE_PRODUCT_TYPE', '商品タイプを削除');

define('TEXT_PRODUCT_TYPES', '商品タイプ:');
define('TEXT_PRODUCT_TYPES_HANDLER', '取扱いページ：');
define('TEXT_PRODUCT_TYPES_ALLOW_ADD_CART', 'この商品はカートに追加可能：');
define('TEXT_DATE_ADDED', '登録日：');
define('TEXT_LAST_MODIFIED', '最終更新日：');
define('TEXT_PRODUCTS', '商品：');
define('TEXT_PRODUCTS_IMAGE_DIR', 'アップロードするディレクトリ:');
define('TEXT_IMAGE_NONEXISTENT', '画像なし');
define('TEXT_MASTER_TYPE', 'この商品タイプを以下の商品のサブタイプとして扱う');

define('TEXT_NEW_INTRO', '新しいメーカーについての情報を入力してください');
define('TEXT_EDIT_INTRO', '必要な情報を変更してください');

define('TEXT_PRODUCT_TYPES_NAME', '商品タイプの名称：');
define('TEXT_PRODUCT_TYPES_IMAGE', '商品タイプのデフォルト画像：');
define('TEXT_PRODUCT_TYPES_URL', 'メーカー((Manufacturer))のURL：');

define('TEXT_DELETE_INTRO', 'この商品タイプを本当に削除しますか?');
define('TEXT_DELETE_IMAGE', '商品タイプのデフォルト画像を削除しますか?');
define('TEXT_DELETE_PRODUCTS', 'この商品タイプから商品を削除しますか? (商品レビュー、特別商品、発売前商品からの削除も含みます)');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>注意:</b> %sの商品がまだこの商品タイプにリンクされています!');

define('ERROR_DIRECTORY_NOT_WRITEABLE', 'エラー：このディレクトリに書き込みできません。: 適切なパーミッションを設定してください。: %s');
define('ERROR_DIRECTORY_DOES_NOT_EXIST','エラー：ディレクトリが存在しません: %s');

define('IMAGE_LAYOUT', 'レイアウト設定');
?>