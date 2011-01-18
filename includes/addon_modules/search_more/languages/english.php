<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Ohtsuji Takashi                                                   |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//
define('MODULE_SEARCH_MORE_TITLE', 'もっと検索');
define('MODULE_SEARCH_MORE_DESCRIPTION', '検索結果に対して追加で条件を指定できるようにするモジュールです。');
define('MODULE_SEARCH_MORE_STATUS_TITLE', 'もっと検索の有効化');
define('MODULE_SEARCH_MORE_STATUS_DESCRIPTION', 'もっと検索を有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_SEARCH_MORE_SORT_ORDER_TITLE', '優先順');
define('MODULE_SEARCH_MORE_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_TITLE', '表示件数リストボックスのタイトル');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_DESCRIPTION', '商品一覧の中で表示される商品の数を指定するリストのラベルを指定してください。デフォルト値は「表示件数」です。');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_TITLE', '表示件数リストボックスの値');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_DESCRIPTION', '商品一覧の中で表示される商品の数を指定するリストの内容をカンマ(,)区切りで指定してください。デフォルト値は「10,25,50,100」です。');
define('MODULE_SEARCH_MORE_SORT_LIST_NAME_TITLE', '並び替えリストボックスのタイトル');
define('MODULE_SEARCH_MORE_SORT_LIST_NAME_DESCRIPTION', '商品一覧のソート順を指定するリストのラベルを指定してください。デフォルト値は「並び替え」です。');

#ブロック名の定義
define('MODULE_SEARCH_MORE_BLOCK_TITLE', 'Search More');
define('MODULE_SEARCH_MORE_BLOCK_SEARCH_FORM_TITLE', 'Search More:Search Form');
define('MODULE_SEARCH_MORE_BLOCK_SORT_TITLE', 'Search More：Sort');
define('MODULE_SEARCH_MORE_BLOCK_PAR_PAGE_TITLE', 'Search More：Search Result');

#検索条件フォームで使用する文言
define('HEADING_TITLE_1', 'Advanced Search(Search Result for [%s])');
define('HEADING_TITLE_2', 'Search Again');
define('MODULE_SEARCH_MORE_ENTRY_KEYWORD', 'Keyword');
define('MODULE_SEARCH_MORE_TEXT_SEARCH_IN_DESCRIPTION', 'Search In Product descriptions.');
define('MODULE_SEARCH_MORE_ENTRY_CATEGORIES', 'Categories');
define('MODULE_SEARCH_MORE_ENTRY_INCLUDE_SUBCATEGORIES', 'Include Subcategories');
define('MODULE_SEARCH_MORE_ENTRY_MANUFACTURERS', 'manufactures');
define('MODULE_SEARCH_MORE_ENTRY_PRICE_RANGE', 'Product Price Range');
define('MODULE_SEARCH_MORE_ENTRY_DATE_RANGE', 'Product Entry date');

define('MODULE_SEARCH_MORE_TEXT_SEARCH_HELP_LINK', 'Help [?]');
define('MODULE_SEARCH_MORE_TEXT_ALL_CATEGORIES', 'All categories');
define('MODULE_SEARCH_MORE_TEXT_ALL_MANUFACTURERS', 'All');
define('MODULE_SEARCH_MORE_TEXT_FROM_TO', '-');

define('MODULE_SEARCH_MORE_TEXT_NO_PRODUCTS', 'No products matches this search.');
define('MODULE_SEARCH_MORE_KEYWORD_FORMAT_STRING', 'Please input at least one or more keywords.');
define('MODULE_SEARCH_MORE_ERROR_AT_LEAST_ONE_INPUT', 'Please specify at least one or more search items.');
define('MODULE_SEARCH_MORE_ERROR_INVALID_FROM_DATE', 'The starting date is invalid.');
define('MODULE_SEARCH_MORE_ERROR_INVALID_TO_DATE', 'The end date is invalid.');
define('MODULE_SEARCH_MORE_ERROR_TO_DATE_LESS_THAN_FROM_DATE', '終了日付は開始日付と同じかそれ以降の日付を入力してください');
define('MODULE_SEARCH_MORE_ERROR_PRICE_FROM_MUST_BE_NUM', '価格下限には数字を入力してください');
define('MODULE_SEARCH_MORE_ERROR_PRICE_TO_MUST_BE_NUM', '価格上限には数字を入力してください');
define('MODULE_SEARCH_MORE_ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '価格上限は価格下限と同じかそれ以上の数字を入力してください');
define('MODULE_SEARCH_MORE_ERROR_INVALID_KEYWORDS', '無効なキーワードです。');
define('MODULE_SEARCH_MORE_TEXT_PRICE_EN'                  ,'円');
define('MODULE_SEARCH_MORE_PRICE_FORMAT_STRING_SAMPLE'     ,'例：500　〜　10000');
define('MODULE_SEARCH_MORE_DOB_FORMAT_STRING_SAMPLE'       ,'例：2009/01/01　〜　2009/06/30');

#ソートブロックで用いる文言
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL'            ,'型番');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL_DESC'       ,'型番(降順)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME'             ,'商品名');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC'        ,'商品名(降順)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER'     ,'メーカー');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER_DESC','メーカー(降順)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY'         ,'在庫');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY_DESC'    ,'在庫(降順)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT'           ,'重さ');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT_DESC'      ,'重さ(降順)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE'            ,'価格');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC'       ,'価格(降順)');

define('MODULE_SEARCH_MORE_TEXT_DISPLAY', '<img src="includes/templates/sugudeki/buttons/japanese/button_display_small.gif" width="37" height="23" alt="表示" />');
