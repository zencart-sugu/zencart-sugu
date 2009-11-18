<?php
/*
//////////////////////////////////////////////////////////
//  SALES REPORT                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2006 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION: The language file contains all the     //
//  text that appears on the report.  The first set of  //
//  configuration defines actually impact the report's  //
//  output and behavior.                                //
//////////////////////////////////////////////////////////
// $Id: stats_sales_report.php 103 2006-10-13 21:06:48Z BlindSide $
*/

/*
** CONFIGURATION DEFINES
*/
//////////////////////////////////////////////////////////
// DEFAULT SEARCH OPTIONS
// These values are loaded into the report when (a) the
// report is laoded fresh, or (b) when the defaults button
// is pressed.  If you prefer to have no option set for a
// given entry, you may leave its define empty. Valid
// entries are in the comments following each define.
// Default settings are in brackets [].
//
define('DEFAULT_DATE_SEARCH_TYPE', 'preset'); // ['preset'], 'custom' (cannot be empty if next 3 options are set!)
define('DEFAULT_DATE_PRESET', 'yesterday'); // ['yesterday'], 'this_month', 'last_month', 'custom'
define('DEFAULT_START_DATE', ''); // (date in mm-dd-yyyy format)
define('DEFAULT_END_DATE', ''); // (date in mm-dd-yyyy format)

define('DEFAULT_DATE_TARGET', 'status'); // ['purchased'], 'status'
define('DEFAULT_DATE_STATUS', '10'); // (status number) [lowest status number]
define('DEFAULT_PAYMENT_METHOD', ''); // [any entry in `orders.payment_module_code` field]
define('DEFAULT_CURRENT_STATUS', ''); // [status number]
define('DEFAULT_MANUFACTURER', ''); // manufacturers_id from Admin > Catalog > Manufacturers ("mID=##" in the URL)

define('DEFAULT_TIMEFRAME', 'day'); // ['day'], 'week', 'month', 'year'
define('DEFAULT_TIMEFRAME_SORT', ''); // ['asc'], 'desc'
define('DEFAULT_DETAIL_LEVEL', 'product'); // ['timeframe'], 'product', 'order', 'matrix'

// order line items: 'oID', 'last_name', 'num_products', 'goods', 'shipping', 'discount', 'gc_sold', 'gc_used', 'grand'
// product line items: 'pID', 'name', 'manufacturer', 'model', 'base_price', 'quantity', 'onetime_charges', 'grand'
define('DEFAULT_LI_SORT_A', 'model');
define('DEFAULT_LI_SORT_ORDER_A', ''); // 'asc', 'desc'
define('DEFAULT_LI_SORT_B', 'name');
define('DEFAULT_LI_SORT_ORDER_B', ''); // 'asc', 'desc'

define('DEFAULT_OUTPUT_FORMAT', 'print'); // ['display'], 'print', 'csv'
define('DEFAULT_AUTO_PRINT', ''); // 'true', ['false']
define('DEFAULT_CSV_HEADER', ''); // 'true', ['false']


//////////////////////////////////////////////////////////
// DISPLAY EMPTY TIMEFRAME LINES
// Setting this define to true will disable displaying
// a timeframe line if that timeframe is empty.  By
// default, an empty timeframe displays the value of the
// define TEXT_NO_DATA.
//
// Be aware, if this is enabled and your search yields
// no results at all, the screen will look as if no search
// was performed (which is why this is disabled by default)
//
define('DISPLAY_EMPTY_TIMEFRAMES', false);


//////////////////////////////////////////////////////////
// PRODUCT MANUFACTURERS COLUMN
// Setting this define to true will display the
// manufacturer on each product line item, and will default
// to the value of TEXT_NONE if there is no manufacturer.
// False will remove the manufacturer column from the report.
//
define('DISPLAY_MANUFACTURER', true);


//////////////////////////////////////////////////////////
// ONE-TIME FEES COLUMN
// If your store does not have *any* one-time fees on its
// products, you can disable displaying the column.
//
// Note that this switch does not affect math calculations,
// so if you happen to have a product with fees attached,
// they will still be accounted for and appear in the total.
//
define('DISPLAY_ONE_TIME_FEES', false);


//////////////////////////////////////////////////////////
// DECIMAL PLACES IN AVERAGES
// Sets the number of decimal places displayed in averages
// on timeframe statistics display
//
define('NUM_DECIMAL_PLACES', 2);


//////////////////////////////////////////////////////////
// TIMEFRAME DATE DISPLAY
// These control the display format of the start and end
// dates of each timeframe line.  Each define corresponds
// to the timeframe of its namesake.  See the PHP manual
// entry on the date() function for a table on the accepted
// formatting characters: http://us2.php.net/date
//
define('TIME_DISPLAY_DAY', 'Y-n-j');
define('TIME_DISPLAY_WEEK', 'Y-n-j');
define('TIME_DISPLAY_MONTH', 'Y-n-j');
define('TIME_DISPLAY_YEAR', 'Y-n-j');
define('DATE_SPACER', ' thru<br/>&nbsp;&nbsp;&nbsp;');


//////////////////////////////////////////////////////////
// EXCLUDE SPECIFIED PRODUCTS
// Prevents specified products from appearing on the sales
// report at all.  **ADDING PRODUCTS TO THIS DEFINE WILL
// IMPACT TOTALS CALCULATIONS!**
//
// The value of the product will be excluded from totals
// for gc_sold, gc_sold_qty, goods, num_products, and
// diff_products.
//
// The values for gc_used, gc_used_qty, discount,
// discount_qty, tax, and shipping all come from the
// orders_total table, and so CANNOT be excluded based
// on product ID.
//
// If an order is made up entirely of excluded products,
// and has no shipping, discounts, tax, or used gift
// certificates, it will have a total of 0.  In this
// situation, the order will not be displayed in the results.
//
// EXAMPLE: define('EXCLUDE_PRODUCTS', serialize(array(25, 14, 43)) );
//
define('EXCLUDE_PRODUCTS', serialize(array( )));



/*
** LANGUAGE DEFINES
*/
// Search menu heading
define('PAGE_HEADING', '販売レポート');
define('HEADING_TITLE_SEARCH', '1. 表示方法選択');
define('HEADING_TITLE_SORT', '2. ソート方法選択');
define('HEADING_TITLE_PROCESS', '3. レポート作成');
define('SEARCH_TIMEFRAME', '期間選択');
define('SEARCH_TIMEFRAME_DAY', '日単位');
define('SEARCH_TIMEFRAME_WEEK', '週単位');
define('SEARCH_TIMEFRAME_MONTH', '月単位');
define('SEARCH_TIMEFRAME_YEAR', '年単位');
define('SEARCH_TIMEFRAME_SORT', 'ソート');
define('SEARCH_DATE_PRESET', '表示期間の選択');
define('SEARCH_DATE_CUSTOM', '表示期間');
define('SEARCH_DATE_YESTERDAY', '昨日 (%s)');
define('SEARCH_DATE_LAST_MONTH', '先月 (%s)');
define('SEARCH_DATE_THIS_MONTH', '今月 (%s)');
define('SEARCH_START_DATE', '開始日');
define('SEARCH_END_DATE', '終了日（当日含む）');
define('SEARCH_DATE_FORMAT', 'yyyy/dd/mm');
define('SEARCH_DATE_TARGET', '日付範囲の判定基準');
define('SEARCH_PAYMENT_METHOD', '支払方法');
define('SEARCH_CURRENT_STATUS', '注文状態（ステータス）');
define('SEARCH_MANUFACTURER', 'メーカー');
define('SEARCH_DETAIL_LEVEL', '詳細レベル');
define('SEARCH_OUTPUT_FORMAT', '表示方法');
define('SEARCH_SORT_PRODUCT', 'ソート方法');
define('SEARCH_SORT_ORDER', '注文のソート方法');
define('SEARCH_SORT_THEN', 'ソート方法2');
define('BUTTON_SEARCH', 'レポートを表示する');
define('BUTTON_LOAD_DEFAULTS', 'リセット');
define('BUTTON_DEFAULT_SEARCH', 'クイックサーチ');
define('SEARCH_WAIT_TEXT', '処理中。少々お待ちください。');


// Form element text
// radio buttons
define('RADIO_DATE_TARGET_PURCHASED', '注文された日付');
define('RADIO_DATE_TARGET_STATUS', '注文ステータスが更新された日付');
define('RADIO_TIMEFRAME_SORT_ASC', '日付順');
define('RADIO_TIMEFRAME_SORT_DESC', '最新日付順');
define('RADIO_LI_SORT_ASC', '昇順');
define('RADIO_LI_SORT_DESC', '降順');

// dropdown menus
define('SELECT_DETAIL_TIMEFRAME', '詳細なし');
define('SELECT_DETAIL_PRODUCT', '注文商品情報あり');
define('SELECT_DETAIL_ORDER', '注文顧客情報あり');
define('SELECT_DETAIL_MATRIX', '詳細表示');
define('SELECT_OUTPUT_DISPLAY', '同画面表示');
define('SELECT_OUTPUT_PRINT', '印刷用画面表示');
define('SELECT_OUTPUT_CSV', 'CSVエクスポート');
define('SELECT_PRODUCT_ID', '商品番号');
define('SELECT_QUANTITY', '数量');
define('SELECT_LAST_NAME', '顧客名');

// checkboxes
define('CHECKBOX_AUTO_PRINT', '自動印刷');
define('CHECKBOX_CSV_HEADER', '1行目にタイトルを挿入する');
define('CHECKBOX_NEW_WINDOW', '結果を新しいウィンドウで表示する');


// Report Column Headings
// Timeframe
define('TABLE_HEADING_TIMEFRAME', '注文日');
define('TABLE_HEADING_NUM_ORDERS', '注文数');
define('TABLE_HEADING_NUM_PRODUCTS', '注文商品数');
define('TABLE_HEADING_TOTAL_GOODS', '価格');
define('TABLE_HEADING_TAX', '消費税');
define('TABLE_HEADING_SHIPPING', '送料');
define('TABLE_HEADING_DISCOUNTS', '割引');
define('TABLE_HEADING_GC_SOLD', 'ギフト券購入');
define('TABLE_HEADING_GC_USED', 'ギフト券使用');
define('TABLE_HEADING_TOTAL', '合計');
define('TABLE_FOOTER_TIMEFRAMES', ' 日');

// Order Line Items
define('TABLE_HEADING_ORDERS_ID', '注文ID');
define('TABLE_HEADING_CUSTOMER', '顧客名');
define('TABLE_HEADING_ORDER_TOTAL', '注文合計');

// Product Line Items
define('TABLE_HEADING_PRODUCT_ID', '商品ID');
define('TABLE_HEADING_PRODUCT_NAME', '商品名');
define('TABLE_HEADING_MANUFACTURER', 'メーカー');
define('TABLE_HEADING_MODEL', '商品番号');
define('TABLE_HEADING_BASE_PRICE', '価格');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_ONETIME_CHARGES', '1回の金額');
define('TABLE_HEADING_PRODUCT_TOTAL', '合計');

// Data Matrix
define('MATRIX_GENERAL_STATS', '統計');
define('MATRIX_ORDER_REVENUE', '総売上');
define('MATRIX_ORDER_PRODUCT_COUNT', '総商品数');
define('MATRIX_LARGEST', '注文の最大値: ');
define('MATRIX_SMALLEST', '注文の最小値: ');
define('MATRIX_AVERAGES', '平均');
define('MATRIX_AVG_ORDER', '&nbsp;平均売上金額');
define('MATRIX_AVG_PROD_ORDER', '&nbsp;平均売上商品数');
define('MATRIX_AVG_PROD_ORDER_DIFF', '&nbsp;顧客辺りの平均売上商品数');
define('MATRIX_AVG_ORDER_CUST', '&nbsp;顧客辺りの注文数');
define('MATRIX_ORDER_STATS', '注文統計');
define('MATRIX_TOTAL_PAYMENTS', '支払方法');
define('MATRIX_TOTAL_CC', 'クレジットカード');
define('MATRIX_TOTAL_SHIPPING', '配送方法');
define('MATRIX_TOTAL_CURRENCIES', '通貨');
define('MATRIX_TOTAL_CUSTOMERS', '特別な顧客');
define('MATRIX_PRODUCT_STATS', '商品情報');
define('MATRIX_PRODUCT_SPREAD', '注文数');
define('MATRIX_PRODUCT_REVENUE_RATIO', '売上価格の割合 %');
define('MATRIX_PRODUCT_QUANTITY_RATIO', '売上個数の割合 %');


// CSV Export
define('CSV_FILENAME_PREFIX', 'sales_');
define('CSV_HEADING_START_DATE', '開始日');
define('CSV_HEADING_END_DATE', '終了日');
define('CSV_HEADING_LAST_NAME', '姓');
define('CSV_HEADING_FIRST_NAME', '名');
define('CSV_SEPARATOR', ',');
define('CSV_NEWLINE', "\n");


// Print Format
define('PRINT_DATE_TO', ' - ');
define('PRINT_DATE_TARGET', '注文状態の選択:');
define('PRINT_TIMEFRAMES', '%s 期間選択 %s');
define('PRINT_DATE_PURCHASED', '注文の日付');
define('PRINT_DATE_STATUS', '注文状態（ステータス）');
define('PRINT_ORDER_STATUS', '%s [%s]');
define('PRINT_PAYMENT_METHOD', '支払い方法:');
define('PRINT_CURRENT_STATUS', '現在の注文状態:');
define('PRINT_DETAIL_LEVEL', '詳細レベル:');

// javascript pop-up alert window
define('ALERT_JS_HIGHLIGHT', '#FF40CF');
define('ALERT_MSG_START', "検索条件の入力に誤りがあります:");
define('ALERT_DATE_INVALID', "> 日付入力に誤りがありました。");
define('ALERT_DATE_MISSING', "> 日付をセットするか、日付の範囲を設定してください。");
define('ALERT_CSV_CONFLICT', "> 表示方法で " . SELECT_DETAIL_MATRIX . " と " . SELECT_DETAIL_TIMEFRAME . " を選択した時は、CSV出力は利出来ません。");
define('ALERT_MSG_FINISH', "再設定してもう一度検索してください。");

// Other text defines
define('ERROR_MISSING_REQ_INFO', 'エラー: 必要な項目が埋められておりません。');
define('ALT_TEXT_SORT_ASC', '注文の昇順でソート');
define('ALT_TEXT_SORT_DESC', '注文の降順でソート');
define('TEXT_REPORT_TIMESTAMP', 'レポート時間: ');
define('TEXT_PARSE_TIME', '解析時間: %s sec.');
define('TEXT_EMPTY_SELECT', '(選択してください)');
define('TEXT_QTY', '| 数量: ');
define('TEXT_DIFF', '| 商品の種類: ');
define('TEXT_SAME', '| (same)');
define('TEXT_SAME_ONE', '| --');
define('TEXT_PRINT_FORMAT', '印刷');
define('TEXT_PRINT_FORMAT_TITLE', '\'' . PAGE_HEADING . '\' を押して表示画面に戻ってください。');
define('TEXT_NO_DATA', '-- 注文がありません。 --');
?>