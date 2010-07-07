<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:
//////////////////////////////////////////////////////////
// $Id: super_batch_forms.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('TITLE_BATCH_OUTPUT', 'バッチ印刷出力');

define('HEADING_TITLE', '注文一括印刷');

define('HEADING_SEARCH_FILTER', '検索条件');
define('HEADING_UPDATE_ORDERS', 'チェックを入れたオーダーを更新');

define('HEADING_START_DATE', '何日から');
define('HEADING_END_DATE', '何日まで');
define('HEADING_SEARCH_STATUS', 'ステータス');
define('HEADING_SEARCH_PRODUCTS', '商品');
define('HEADING_SEARCH_CUSTOMERS', '顧客');
define('HEADING_SEARCH_LANGUAGES', '言語');
define('HEADING_SEARCH_PAYMENT_METHOD', '支払い方法');
define('HEADING_SEARCH_TEXT', 'テキスト検索');
define('HEADING_SEARCH_ORDER_TOTAL', '注文合計');

define('BUTTON_UPDATE_STATUS', 'ステータスの更新');
define('BUTTON_SEARCH', '検索');
define('BUTTON_CHECK_ALL', '全てにチェックを入れる');
define('BUTTON_UNCHECK_ALL', '全てのチェックを外す');

define('TEXT_ENTER_SEARCH', '注文状況を選択してから、 <strong>検索</strong> ボタンを押してください');
define('TEXT_TOTAL_ORDERS', '検索結果 合計: ');
define('TEXT_ALL_ORDERS', '全ての注文');
define('TEXT_ORDER_VALUE', ' 円');
define('ICON_ORDER_DETAILS', '注文の詳細を表示');

define('DROPDOWN_ALL_PRODUCTS', '全ての製品');
define('DROPDOWN_ALL_PAYMENTS', '全ての支払い方法');
define('DROPDOWN_ALL_CUSTOMERS', '全ての顧客');
define('DROPDOWN_ALL_LANGUAGES', '全ての言語');
define('DROPDOWN_GREATER_THAN', ' 以上');
define('DROPDOWN_LESS_THAN', ' 以下');
define('DROPDOWN_EQUAL_TO', ' 等しい');

define('HEADING_SELECT_FORM', '印刷形式');
define('HEADING_NUM_COPIES', '部数');
define('BUTTON_SUBMIT_PRINT', '印刷');

define('SELECT_INVOICE', '納品書');
define('SELECT_PACKINGSLIP', '配送表');
define('SELECT_SHIPPING_LABEL', '宛名ラベル');

define('TABLE_HEADING_ORDERS_ID','オーダー ID');
define('TABLE_HEADING_CUSTOMERS', '顧客');
define('TABLE_HEADING_DATE_PURCHASED', '注文日');
define('TABLE_HEADING_ORDER_STATUS', 'ステータス');
define('TABLE_HEADING_ORDER_TOTAL', '注文合計');
define('TABLE_HEADING_PAYMENT_METHOD', '支払い方法');

define('ERROR_NO_ORDERS', 'エラー: オーダーにチェックが入っていません！');
define('ERROR_NO_FILE', 'エラー: そのようなファイルはありません！');
?>
