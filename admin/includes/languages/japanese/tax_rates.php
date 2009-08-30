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
//  $Id: tax_rates.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '税率設定');

define('TABLE_HEADING_TAX_RATE_PRIORITY', '優先順位');
define('TABLE_HEADING_TAX_CLASS_TITLE', '税種別');
define('TABLE_HEADING_COUNTRIES_NAME', '国名');
define('TABLE_HEADING_ZONE', '地域');
define('TABLE_HEADING_TAX_RATE', '税率');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_INFO_DATE_ADDED', '登録日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_CLASS_TITLE', '税種別タイトル:');
define('TEXT_INFO_COUNTRY_NAME', '国名:');
define('TEXT_INFO_ZONE_NAME', '地域:');
define('TEXT_INFO_TAX_RATE', '税率(%):');
define('TEXT_INFO_TAX_RATE_PRIORITY', '重複する優先順位の税率が登録されると、同じ優先順位のものと複合されます。<br><br>優先順位:');
define('TEXT_INFO_RATE_DESCRIPTION', '説明:');
define('TEXT_INFO_INSERT_INTRO', '新しい税種別に関するデータを入力してください。');
define('TEXT_INFO_DELETE_INTRO', 'この税率を本当に削除しますか?');
define('TEXT_INFO_HEADING_NEW_TAX_RATE', '新しい税率');
define('TEXT_INFO_HEADING_EDIT_TAX_RATE', '税率を編集');
define('TEXT_INFO_HEADING_DELETE_TAX_RATE', '税率を削除');
?>