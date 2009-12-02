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
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////
// $Id: super_orders.php 25 2006-02-03 18:55:56Z BlindSide $
*/

require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');

define('HEADING_TITLE_ORDERS_LISTING', '注文管理');
define('HEADING_TITLE_ORDER_DETAILS', 'オーダー詳細 ID#');
define('HEADING_TITLE_SEARCH', '注文ID:');
define('HEADING_TITLE_STATUS', 'ステータス:');
define('HEADING_REOPEN_ORDER', '再度開く');

define('TABLE_HEADING_ORDERS_ID','ID');
define('TABLE_HEADING_STATUS_HISTORY', 'ステータス履歴');
define('TABLE_HEADING_ADD_COMMENTS', 'コメント');
define('TABLE_HEADING_FINAL_STATUS', '終わる');
define('TABLE_HEADING_COMMENTS', 'コメント');
define('TABLE_HEADING_CUSTOMERS', '顧客名');
define('TABLE_HEADING_ORDER_TOTAL', '注文合計');
define('TABLE_HEADING_PAYMENT_METHOD', 'お支払い方法');
define('TABLE_HEADING_DATE_PURCHASED', '注文日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_TYPE', 'Order Type');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRODUCTS_MODEL', '商品番号');
define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_TAX', '税率');
define('TABLE_HEADING_TOTAL', '合計');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '価格(税抜き)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '価格(税込み)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '合計(税抜き)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '合計(税込み)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', '顧客に通知');
define('TABLE_HEADING_DATE_ADDED', '処理日');

define('TABLE_HEADING_ADMIN_NOTES', '管理ノート');
define('TABLE_HEADING_AUTHOR', '編者');
define('TABLE_HEADING_ADD_NOTES', '新しく加える');
define('TABLE_HEADING_KARMA', 'カルマ');
define('TEXT_WARN_NOT_VISIBLE', ' （この情報は秘密です）');
define('TEXT_TOTAL_KARMA', 'トータルカルマ: ');
define('TEXT_ADMIN_NOTES_NONE', 'このお客様にはレビューはありません。');

define('PAYMENT_TABLE_NUMBER', '番号');
define('PAYMENT_TABLE_NAME', '支払者名');
define('PAYMENT_TABLE_AMOUNT', '数量');
define('PAYMENT_TABLE_TYPE', 'タイプ');
define('PAYMENT_TABLE_POSTED', '投稿日');
define('PAYMENT_TABLE_MODIFIED', '最終更新');
define('PAYMENT_TABLE_ACTION', '操作');
define('ALT_TEXT_ADD', '追加');
define('ALT_TEXT_UPDATE', 'アップデート');
define('ALT_TEXT_DELETE', '削除');

define('ENTRY_PAYMENT_DETAILS', '支払の詳細');
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
define('ENTRY_DATE_LAST_UPDATED', '更新日:');
define('ENTRY_NOTIFY_CUSTOMER', '処理状況を顧客に通知:');
define('ENTRY_NOTIFY_COMMENTS', '追加コメント:');

define('HEADING_COLOR_KEY', 'カラーキー:');
define('TEXT_PURCHASE_ORDERS', '発注書');
define('TEXT_PAYMENTS', '支払');
define('TEXT_REFUNDS', '還付');

define('TEXT_MAILTO', 'メールを出す');
define('TEXT_STORE_EMAIL', 'ウエブメール');
define('TEXT_WHOIS_LOOKUP', 'whois');
define('TEXT_ICON_LEGEND', '操作アイコン:');
define('TEXT_BILLING_SHIPPING_MISMATCH', '請求先と配送先が違います');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'オーダー削除 - ');
define('TEXT_INFO_DELETE_INTRO', '本当にこのオーダーを削除しますか？');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', '在庫を元に戻す');
define('TEXT_DATE_ORDER_CREATED', 'データ作成日:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', '最終更新日:');
define('TEXT_INFO_PAYMENT_METHOD', '支払方法:');
define('TEXT_INFO_SHIPPING_METHOD', '配送方法:');
define('TEXT_ALL_ORDERS', '全てのオーダー');
define('TEXT_NO_ORDER_HISTORY', 'オーダー履歴はありません');
define('TEXT_DISPLAY_ONLY', '（表示のみ）');

define('ERROR_ORDER_DOES_NOT_EXIST', '失敗: オーダーがありません');
define('SUCCESS_ORDER_UPDATED', '成功: オーダーは完全にアップデートされました。');
define('WARNING_ORDER_NOT_UPDATED', '警告：変更はありません。オーダーはアップデートされません。');
define('SUCCESS_MARK_COMPLETED', '成功：オーダー #%s は実行されました！');
define('WARNING_MARK_CANCELLED', '警告：オーダー #%s はキャンセルされました');
define('WARNING_ORDER_REOPEN', '警告：オーダー #%s が再度開かれました。');

define('ENTRY_ORDER_ID','オーダー No. ');
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
define('TEXT_MORE', '... more');

define('TEXT_INFO_IP_ADDRESS', 'IP アドレス: ');

define('TEXT_NEW_WINDOW', ' （新しいウインドウ）');
define('IMAGE_SHIPPING_LABEL', '宛名ラベル');
define('ICON_ORDER_DETAILS', 'オーダーの詳細を表示');
define('ICON_ORDER_PRINT', 'データシートを印刷' . TEXT_NEW_WINDOW);
define('ICON_ORDER_INVOICE', '納品書を表示' . TEXT_NEW_WINDOW);
define('ICON_ORDER_PACKINGSLIP', '梱包を表示' . TEXT_NEW_WINDOW);
define('ICON_ORDER_SHIPPING_LABEL', '宛名ラベルを表示' . TEXT_NEW_WINDOW);
define('ICON_ORDER_DELETE', '削除');
define('ICON_EDIT_CONTACT', '登録データを修正');
define('ICON_EDIT_PRODUCT', '商品を修正');
define('ICON_EDIT_TOTAL', '注文合計を修正');
define('ICON_EDIT_HISTORY', 'ステータス履歴を修正');
define('ICON_CLOSE_STATUS', 'ステータスを閉じる');
define('ICON_MARK_COMPLETED', '注文完了マーク');
define('ICON_MARK_CANCELLED', '注文キャンセルマーク');

define('MINI_ICON_ORDERS', '顧客のオーダーを表示');
define('MINI_ICON_INFO', '顧客の情報を表示');

define('BUTTON_TO_LIST', 'オーダーリスト');
define('BUTTON_SPLIT', '梱包を分割');
define('SELECT_ORDER_LIST', 'オーダーに移動:');

define('TEXT_NO_PAYMENT_DATA', '支払情報がありません');
define('TEXT_PAYMENT_DATA', '支払日');
?>