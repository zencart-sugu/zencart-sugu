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
//  $Id: banner_statistics.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'バナー統計');

define('TABLE_HEADING_SOURCE', '日付');
define('TABLE_HEADING_VIEWS', '表示');
define('TABLE_HEADING_CLICKS', 'クリック');

define('TEXT_BANNERS_DATA', 'D<br/>A<br/>T<br/>A');
define('TEXT_BANNERS_DAILY_STATISTICS', '%s  Daily Statistics For %s %s');//画像に文字が乗るため、日本語にすると化ける
define('TEXT_BANNERS_MONTHLY_STATISTICS', '%s Monthly Statistics For %s');//画像に文字が乗るため、日本語にすると化ける
define('TEXT_BANNERS_YEARLY_STATISTICS', '%s Yearly Statistics');

define('STATISTICS_TYPE_DAILY', '日次');
define('STATISTICS_TYPE_MONTHLY', '月次');
define('STATISTICS_TYPE_YEARLY', '年次');

define('TITLE_TYPE', 'タイプ:');
define('TITLE_YEAR', '年:');
define('TITLE_MONTH', '月:');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'エラー: グラフディレクトリが存在しません。グラフディレクトリを作成してください。例: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'エラー: グラフディレクトリに書き込みができません。グラフディレクトリの位置: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
?>