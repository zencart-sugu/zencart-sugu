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
// $Id: super_batch_status.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('HEADING_TITLE', '注文ステータス一括変更');

define('HEADING_SEARCH_FILTER', '検索条件');
define('HEADING_UPDATE_ORDERS', 'チェックを入れたオーダーのステータスを変更');

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

define('HEADING_SELECT_STATUS', 'ステータス');
define('HEADING_ADD_COMMENTS', 'コメント');
define('ENTRY_NOTIFY_CUSTOMER', '処理状況を顧客に通知');
define('ENTRY_NOTIFY_COMMENTS', 'コメント');

define('TEXT_ENTER_SEARCH', '注文状況を選択してから、検索ボタンを押してください');
define('TEXT_TOTAL_ORDERS', '検索結果 合計: ');
define('TEXT_ALL_ORDERS', '全ての注文');
define('TEXT_ORDER_VALUE', ' 円');
define('ICON_ORDER_DETAILS', '注文の詳細を表示');
define('ERROR_NO_ORDERS', 'Error: オーダーにチェックが入っていません！');

define('DROPDOWN_ALL_PRODUCTS', '全ての製品');
define('DROPDOWN_ALL_PAYMENTS', '全ての支払い方法');
define('DROPDOWN_ALL_CUSTOMERS', '全ての顧客');
define('DROPDOWN_ALL_LANGUAGES', '全ての言語');
define('DROPDOWN_GREATER_THAN', ' 以上');
define('DROPDOWN_LESS_THAN', ' 以下');
define('DROPDOWN_EQUAL_TO', ' 等しい');

define('TABLE_HEADING_ORDERS_ID','オーダー ID');
define('TABLE_HEADING_CUSTOMERS', '顧客');
define('TABLE_HEADING_DATE_PURCHASED', '注文日');
define('TABLE_HEADING_ORDER_STATUS', 'ステータス');
define('TABLE_HEADING_ORDER_TOTAL', '注文合計');
define('TABLE_HEADING_PAYMENT_METHOD', '支払い方法');

define('SUCCESS_ORDER_UPDATED', 'ステータスの更新は成功しました！');
define('WARNING_ORDER_NOT_UPDATED', '警告：更新は失敗しました');

define('TEXT_SELECT_EMAIL_TEMPLATES', 'メールテンプレート');
define('TEXT_SELECT_LANGUAGES', '言語');

define('BUTTON_READ_EMAIL_TEMPLATE', '読込');
?>
