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
//  $Id: salemaker.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'セールの管理(SALE Maker)');
define('TABLE_HEADING_SALE_NAME', 'セール名');
define('TABLE_HEADING_SALE_DEDUCTION', '値引き額');
define('TABLE_HEADING_SALE_DATE_START', '開始日');
define('TABLE_HEADING_SALE_DATE_END', '終了日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');
define('TEXT_SALEMAKER_NAME', 'セール名:');
define('TEXT_SALEMAKER_DEDUCTION', '値引き額:');
define('TEXT_SALEMAKER_DEDUCTION_TYPE', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;タイプ:&nbsp;&nbsp;');
define('TEXT_SALEMAKER_PRICERANGE_FROM', '価格幅:');
define('TEXT_SALEMAKER_PRICERANGE_TO', '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;から&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
define('TEXT_SALEMAKER_SPECIALS_CONDITION', '特価商品の場合:');
define('TEXT_SALEMAKER_DATE_START', '開始日:');
define('TEXT_SALEMAKER_DATE_END', '終了日:');
define('TEXT_SALEMAKER_CATEGORIES', '<b>または</b> セール対象のカテゴリを選択:');
define('TEXT_SALEMAKER_POPUP', '<a href="javascript:session_win();"><span class="errorText"><b>セール管理(SALE Maker)のコツ(Tips)はこちら</b></span></a>');
define('TEXT_SALEMAKER_POPUP1', '<a href="javascript:session_win1();"><span class="errorText"><b>(詳細)</b></span></a>');
define('TEXT_SALEMAKER_IMMEDIATELY', 'すぐに');
define('TEXT_SALEMAKER_NEVER', 'なし');
define('TEXT_SALEMAKER_ENTIRE_CATALOG', '<b>全ての商品</b>にセールを適用する場合はこのチェックボックスをチェックしてください。:');
define('TEXT_SALEMAKER_TOP', '全ての商品');
define('TEXT_INFO_DATE_ADDED', '登録日:');
define('TEXT_INFO_DATE_MODIFIED', '更新日:');
define('TEXT_INFO_DATE_STATUS_CHANGE', 'ステータス変更日:');
define('TEXT_INFO_SPECIALS_CONDITION', '特価商品への適用:');
define('TEXT_INFO_DEDUCTION', '値引き額:');
define('TEXT_INFO_PRICERANGE_FROM', '価格幅:');
define('TEXT_INFO_PRICERANGE_TO', ' から ');
define('TEXT_INFO_DATE_START', '開始日:');
define('TEXT_INFO_DATE_END', '終了日:');
define('SPECIALS_CONDITION_DROPDOWN_0', '特価商品の価格を無視する - レギュラー価格にセールを適用し、特価を置き換える');
define('SPECIALS_CONDITION_DROPDOWN_1', 'セール対象外 - 特価商品はセールを適用しない');
define('SPECIALS_CONDITION_DROPDOWN_2', '特価商品の価格にさらにセール値引きを適用する');
// moved to english.php
/*
define('DEDUCTION_TYPE_DROPDOWN_0', 'Deduct amount');
define('DEDUCTION_TYPE_DROPDOWN_1', 'Percent');
define('DEDUCTION_TYPE_DROPDOWN_2', 'New Price');
*/
define('TEXT_INFO_HEADING_COPY_SALE', 'セールをコピー');
define('TEXT_INFO_COPY_INTRO', '"%s"のコピー名を入力してください');
define('TEXT_INFO_HEADING_DELETE_SALE', 'セールを削除');
define('TEXT_INFO_DELETE_INTRO', 'このセールを本当に削除しますか?');
?>