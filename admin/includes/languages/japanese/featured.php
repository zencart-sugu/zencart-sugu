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
//  $Id: featured.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'おすすめ商品の管理');

define('TABLE_HEADING_PRODUCTS', '商品');
define('TABLE_HEADING_PRODUCTS_MODEL','型番');
define('TABLE_HEADING_PRODUCTS_PRICE', '商品価格/特別価格/セール価格');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','割引率(%)');
define('TABLE_HEADING_AVAILABLE_DATE', '提供開始日');
define('TABLE_HEADING_EXPIRES_DATE','提供終了日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_FEATURED_PRODUCT', '商品:');
define('TEXT_FEATURED_EXPIRES_DATE', '提供終了日:');
define('TEXT_FEATURED_AVAILABLE_DATE', '提供開始日:');

define('TEXT_INFO_DATE_ADDED', '作成日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_NEW_PRICE', '新しい価格:');
define('TEXT_INFO_ORIGINAL_PRICE', '元の価格:');
define('TEXT_INFO_PERCENTAGE', '割引率(%):');
define('TEXT_INFO_AVAILABLE_DATE', '提供開始日:');
define('TEXT_INFO_EXPIRES_DATE', '提供終了日:');
define('TEXT_INFO_STATUS_CHANGE', 'ステータス変更:');
define('TEXT_IMAGE_NONEXISTENT', '画像なし');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'おすすめ商品を削除');
define('TEXT_INFO_DELETE_INTRO', 'このおすすめ商品を本当に削除しますか?');
?>