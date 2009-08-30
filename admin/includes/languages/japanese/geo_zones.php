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
//  $Id: geo_zones.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '地域税設定');

define('TABLE_HEADING_COUNTRY', '国名');
define('TABLE_HEADING_COUNTRY_ZONE', '地域');
define('TABLE_HEADING_TAX_ZONES', '地域税');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_HEADING_NEW_ZONE', '新しい地域');
define('TEXT_INFO_NEW_ZONE_INTRO', '新しい地域の情報を入力してください。');

define('TEXT_INFO_HEADING_EDIT_ZONE', '地域を編集');
define('TEXT_INFO_EDIT_ZONE_INTRO', '必要な変更を行ってください。');

define('TEXT_INFO_HEADING_DELETE_ZONE', '地域を削除');
define('TEXT_INFO_DELETE_ZONE_INTRO', 'この地域を本当に削除しますか?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE', '新しいサブ地域');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO', '新しいサブ地域の情報を入力してください。');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE', 'サブ地域を編集');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO', '必要な変更を行ってください。');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE', 'サブ地域を削除');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO', 'このサブ地域を本当に削除しますか?');

define('TEXT_INFO_DATE_ADDED', '登録日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_ZONE_NAME', '地域名:');
define('TEXT_INFO_NUMBER_ZONES', '地域の数:');
define('TEXT_INFO_ZONE_DESCRIPTION', '説明:');
define('TEXT_INFO_COUNTRY', '国名:');
define('TEXT_INFO_COUNTRY_ZONE', '地域:');
define('TYPE_BELOW', '全ての地域');
define('PLEASE_SELECT', '全ての地域');
define('TEXT_ALL_COUNTRIES', '全ての国');

define('TEXT_INFO_NUMBER_TAX_RATES','税率の数:');
define('ERROR_TAX_RATE_EXISTS','警告: この地域用に税率が設定されています。地域を削除する前に設定された税率を削除してください。');
?>