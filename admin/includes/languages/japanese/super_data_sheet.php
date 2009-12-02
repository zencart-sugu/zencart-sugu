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
//  DESCRIPTION:   Takes all the order data found on    //
//  the details screen and formats it for printing on   //
//  standard 8.5" x 11" paper.                          //
//////////////////////////////////////////////////////////
// $Id: super_data_sheet.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('PAGE_TITLE', '注文管理');
define('HEADER_ORDER_DATA', '注文番号');
define('HEADER_CUSTOMER_ID', '顧客番号');
define('HEADER_ADDRESS_DATA', '住所データ');
define('HEADER_STATUS_HISTORY', 'ステータスの履歴');
define('HEADER_PAYMENT_HISTORY', '支払履歴');

define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_COMMENTS', 'コメント');
define('TABLE_HEADING_TYPE', 'オーダータイプ');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRODUCTS_MODEL', '型番');
define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_TAX', '税率');
define('TABLE_HEADING_TOTAL', '合計');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '価格 (税抜き)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '価格 (税込み)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '合計 (税抜き)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '合計 (税込み)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', '顧客に通知');
define('TABLE_HEADING_DATE_ADDED', '処理日');

define('TABLE_HEADING_ADMIN_NOTES', '管理ノート');
define('TABLE_HEADING_AUTHOR', '編者');
define('TABLE_HEADING_ADD_NOTES', '新しく加える');
define('TABLE_HEADING_RATING', '格付け');
define('TEXT_WARN_NOT_VISIBLE', ' （この情報は秘密です）');
define('TEXT_AVG_RATING', '平均した格付け: ');
define('TEXT_ADMIN_NOTES_NONE', 'このお客様にはレビューはありません。');

define('PAYMENT_TABLE_NUMBER', '番号');
define('PAYMENT_TABLE_NAME', '支払者名');
define('PAYMENT_TABLE_AMOUNT', '数量');
define('PAYMENT_TABLE_TYPE', 'タイプ');
define('PAYMENT_TABLE_POSTED', '投稿日');
define('PAYMENT_TABLE_MODIFIED', '最終更新');
define('PAYMENT_TABLE_ACTION', '操作');

define('ENTRY_CUSTOMER_ADDRESS', 'お客様住所:');
define('ENTRY_SHIPPING_ADDRESS', '配送先住所:');
define('ENTRY_BILLING_ADDRESS', '請求先住所:');
define('ENTRY_PAYMENT_METHOD', '支払方法:');
define('ENTRY_CREDIT_CARD_TYPE', 'クレジットカード種別:');
define('ENTRY_CREDIT_CARD_OWNER', 'クレジットカード所有者:');
define('ENTRY_CREDIT_CARD_NUMBER', 'クレジットカード番号:');
define('ENTRY_CREDIT_CARD_CVV', 'クレジットカーCVV番号:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'クレジットカード有効期限:');
define('ENTRY_SUB_TOTAL', '小計:');
define('ENTRY_TAX', '税金:');
define('ENTRY_SHIPPING', '配送:');
define('ENTRY_TOTAL', '合計:');
define('ENTRY_AMOUNT_APPLIED', '入金済み:');
define('ENTRY_BALANCE_DUE', '請求額合計:');
define('ENTRY_DATE_PURCHASED', '注文日:');
define('ENTRY_STATUS', 'ステータス:');

define('TEXT_INFO_PAYMENT_METHOD', '支払方法:');
define('TEXT_INFO_SHIPPING_METHOD', '配送方法:');

define('ENTRY_ORDER_ID','注文番号');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">無料</span>');

define('TEXT_DOWNLOAD_TITLE', 'オーダーのダウンロード状態');
define('TEXT_DOWNLOAD_STATUS', '状態');
define('TEXT_DOWNLOAD_FILENAME', 'ファイルネーム');
define('TEXT_DOWNLOAD_MAX_DAYS', '日数');
define('TEXT_DOWNLOAD_MAX_COUNT', 'カウント');
define('TEXT_DOWNLOAD_AVAILABLE', '利用可能');
define('TEXT_DOWNLOAD_EXPIRED', '期限切れ');
define('TEXT_DOWNLOAD_MISSING', 'サーバー上にありません。');

define('IMAGE_ICON_STATUS_CURRENT', '状態 - 利用可能');
define('IMAGE_ICON_STATUS_EXPIRED', '状態 - 期限切れ');
define('IMAGE_ICON_STATUS_MISSING', '状態 - 不明');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'ダウンロードに成功しました。');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', '無効なダウンロードです。');
define('TEXT_INFO_IP_ADDRESS', 'IPアドレス: ');
define('TEXT_NO_PAYMENT_DATA', '支払データがありません');
?>