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
//  $Id: downloads_manager.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE','ダウンロード商品の管理');
define('TABLE_HEADING_ATTRIBUTES_ID', '属性ID');
define('TABLE_HEADING_PRODUCTS_ID', '商品ID');
define('TABLE_HEADING_PRODUCT', '商品名');
define('TABLE_HEADING_MODEL', '型番');
define('TABLE_HEADING_OPT_NAME', 'オプション名');
define('TABLE_HEADING_OPT_VALUE', 'オプション値の名前');
define('TABLE_TEXT_FILENAME', 'ファイル名');
define('TABLE_TEXT_MAX_DAYS', 'ダウンロード期日');
define('TABLE_TEXT_MAX_COUNT', 'ダウンロード回数');
define('TABLE_HEADING_ACTION', '操作');

define('TABLE_HEADING_OPT_PRICE', '価格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '接頭辞(Prefix)');

define('TEXT_PRODUCTS_NAME', '商品: ');
define('TEXT_PRODUCTS_MODEL', '型番: ');

define('TEXT_INFO_HEADING_EDIT_PRODUCTS_DOWNLOAD', 'ダウンロード情報の編集');
define('TEXT_INFO_HEADING_DELETE_PRODUCTS_DOWNLOAD', 'ダウンロード情報の確定');
define('TEXT_INFO_EDIT_INTRO', 'ダウンロード情報の編集:');
define('TEXT_DELETE_INTRO', '以下のファイル名をデータベースから削除します。ファイル自体のサーバからの削除は行われません。:');

define('TEXT_INFO_FILENAME', 'ファイル名: ');
define('TEXT_INFO_MAX_DAYS', 'ダウンロード期日: ');
define('TEXT_INFO_MAX_COUNT', 'ダウンロード回数: ');

define('TEXT_INFO_FILENAME_MISSING','&nbsp;ファイル名不明');
define('TEXT_INFO_FILENAME_GOOD','&nbsp;ファイル名有効');
?>