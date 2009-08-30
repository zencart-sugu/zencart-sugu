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
// $Id: advanced_search_result.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE_1', '詳細検索');
define('NAVBAR_TITLE_2', '検索結果');

//define('HEADING_TITLE_1', '詳細検索');
define('HEADING_TITLE', '詳細検索');

define('HEADING_SEARCH_CRITERIA', '検索キーワードを入力してください');

define('TEXT_SEARCH_IN_DESCRIPTION', '商品説明から検索する');
define('ENTRY_CATEGORIES', 'カテゴリー:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'サブカテゴリを含む');
define('ENTRY_MANUFACTURERS', 'メーカー:');
define('ENTRY_PRICE_FROM', '価格下限:');
define('ENTRY_PRICE_TO', '価格上限:');
define('ENTRY_DATE_FROM', '開始日付:');
define('ENTRY_DATE_TO', '終了日付:');

define('TEXT_SEARCH_HELP_LINK', 'ヘルプ[?]');

define('TEXT_ALL_CATEGORIES', '全カテゴリ');
define('TEXT_ALL_MANUFACTURERS', '全メーカー');

define('HEADING_SEARCH_HELP', '検索ヘルプ');
define('TEXT_SEARCH_HELP', '詳細検索では、単語や文字列を AND や OR で区切ることができます。<br /><br />例えば マイクロソフト AND マウスと入力すると、両方の単語を含んだ商品を検索します。それに対して、マウス OR キーボードと入力すると、両方かどちらかの単語を含んだ商品を検索します。<br /><br />いくつかの単語を引用符で囲んで検索すると、入力した文字列に正確に一致するものを探します。<br /><br />例えば、"ノート パソコン"として検索すると、そのままの文字列を含んだ商品を検索することができます。<br /><br />カッコを使ってこれらを組み合わせて指定することもできます。
<br /><br />例：マイクロソフト AND (キーボード OR マウス OR "visual basic")');
define('TEXT_CLOSE_WINDOW', 'ウインドウを閉じる[x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'モデル');
define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_MANUFACTURER', 'メーカー');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRICE', '価格');
define('TABLE_HEADING_WEIGHT', '重量');
define('TABLE_HEADING_BUY_NOW', '今すぐ購入');

define('TEXT_NO_PRODUCTS', '該当する商品は見つかりませんでした。');

define('ERROR_AT_LEAST_ONE_INPUT', '最低一つ以上の検索項目を入力してください。');
define('ERROR_INVALID_FROM_DATE', '無効な開始日付が入力されました。');
define('ERROR_INVALID_TO_DATE', '無効な終了日付が入力されました。');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', '終了日付は開始日付と同じかそれ以降の日付を入力してください。');
define('ERROR_PRICE_FROM_MUST_BE_NUM', '価格下限には半角数字を入力してください。');
define('ERROR_PRICE_TO_MUST_BE_NUM', '価格上限には半角数字を入力してください。');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '価格上限は価格下限と同じかそれ以上の数値を入力してください。');
define('ERROR_INVALID_KEYWORDS', '無効な検索キーワードが入力されました。');
?>
