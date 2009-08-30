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
//  $Id: reviews.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_TITLE', 'レビューの管理');

define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_CUSTOMER_NAME','顧客名');
define('TABLE_HEADING_RATING', '採点');
define('TABLE_HEADING_DATE_ADDED', '投稿日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('ENTRY_PRODUCT', '商品名:');
define('ENTRY_FROM', '投稿者:');
define('ENTRY_DATE', '日付:');
define('ENTRY_REVIEW', 'レビュー内容:');
define('ENTRY_REVIEW_TEXT', '<small><font color="#ff0000"><b>注意:</b></font></small>&nbsp;HTMLタグは使用できません! &nbsp;');
define('ENTRY_RATING', '採点:');

define('TEXT_INFO_DELETE_REVIEW_INTRO', 'このレビューを本当に削除しますか?');

define('TEXT_INFO_DATE_ADDED', '投稿日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_IMAGE_NONEXISTENT', '画像なし');
define('TEXT_INFO_REVIEW_AUTHOR', '投稿者:');
define('TEXT_INFO_REVIEW_RATING', '採点:');
define('TEXT_INFO_REVIEW_READ', '閲覧された回数:');
define('TEXT_INFO_REVIEW_SIZE', 'サイズ:');
define('TEXT_INFO_PRODUCTS_AVERAGE_RATING', '平均点:');

define('TEXT_OF_5_STARS', '5点満点の%s点!');
define('TEXT_GOOD', '<small><font color="#ff0000"><b>良い</b></font></small>');
define('TEXT_BAD', '<small><font color="#ff0000"><b>悪い</b></font></small>');
define('TEXT_INFO_HEADING_DELETE_REVIEW', 'レビューを削除');

define('TEXT_ALL_STATUS','--選択してください--');
define('TEXT_PENDING_APPROVAL','承認待ち');
define('TEXT_APPROVED','承認済み');
define('HEADING_TITLE_STATUS','ステータス');

?>