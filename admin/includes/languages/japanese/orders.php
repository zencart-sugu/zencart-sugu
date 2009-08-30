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
//  $Id: orders.php 2652 2005-12-22 18:30:59Z drbyte $
//

define('HEADING_TITLE', '注文管理');
define('HEADING_TITLE_SEARCH', '注文ID:');
define('HEADING_TITLE_STATUS', 'ステータス:');

define('TABLE_HEADING_PAYMENT_METHOD', '支払方法<br />配送方法');
define('TABLE_HEADING_ORDERS_ID','ID');

define('TEXT_BILLING_SHIPPING_MISMATCH','請求先と配送先が違います');

define('TABLE_HEADING_COMMENTS', 'コメント');
define('TABLE_HEADING_CUSTOMERS', '顧客名');
define('TABLE_HEADING_ORDER_TOTAL', '注文合計');
define('TABLE_HEADING_DATE_PURCHASED', '注文日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_TYPE', 'Order Type');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRODUCTS_MODEL', '型番');
define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_TAX', '税率');
define('TABLE_HEADING_TOTAL', '合計');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '価格 (税抜き)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '価格 (税込み)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '合計 (税抜き)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '合計 (税込み)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', '顧客に通知');
define('TABLE_HEADING_DATE_ADDED', '処理日');

define('ENTRY_CUSTOMER', '顧客名:');
define('ENTRY_SOLD_TO', 'ご注文者名:');
define('ENTRY_DELIVERY_TO', '配送先:');
define('ENTRY_SHIP_TO', '配送先:');
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
define('ENTRY_DATE_PURCHASED', '注文日:');
define('ENTRY_STATUS', 'ステータス:');
define('ENTRY_DATE_LAST_UPDATED', '更新日:');
define('ENTRY_NOTIFY_CUSTOMER', '処理状況を顧客に通知:');
define('ENTRY_NOTIFY_COMMENTS', '追加コメント:');
define('ENTRY_PRINTABLE', '納品書をプリント');

define('TEXT_INFO_HEADING_DELETE_ORDER', '削除日');
define('TEXT_INFO_DELETE_INTRO', 'この注文を本当に削除しますか?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', '在庫数を元に戻す');
define('TEXT_DATE_ORDER_CREATED', '注文日:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_PAYMENT_METHOD', '支払方法:');
define('TEXT_PAID', 'Paid');
define('TEXT_UNPAID', 'Un-paid');

define('TEXT_ALL_ORDERS', '全ての注文');
define('TEXT_NO_ORDER_HISTORY', '注文履歴はありません。');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'ご注文受付状況のお知らせ');
define('EMAIL_TEXT_ORDER_NUMBER', 'ご注文受付番号:');
define('EMAIL_TEXT_INVOICE_URL', 'ご注文についての情報を下記URLでご覧いただけます。:');
define('EMAIL_TEXT_DATE_ORDERED', 'ご注文日:');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>[ご連絡事項]: </em>');
define('EMAIL_TEXT_STATUS_UPDATED', 'ご注文状況は次のようになっております。:' . "\n");
define('EMAIL_TEXT_STATUS_LABEL', '<strong>現在の受付状況:</strong> %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'ご質問などがございましたら、このメールにご返信ください。' . "\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'エラー: 注文が存在しません。');
define('SUCCESS_ORDER_UPDATED', '成功: 注文状態が更新されました。');
define('WARNING_ORDER_NOT_UPDATED', '警告: 注文状態は何も更新されませんでした。');

define('ENTRY_ORDER_ID','送り状 No. ');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">FREE</span>');

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

define('TEXT_INFO_IP_ADDRESS', 'IPアドレス: ');
define('TEXT_DELETE_CVV_FROM_DATABASE','データベースからCVVを削除');
define('TEXT_DELETE_CVV_REPLACEMENT','削除');
define('TEXT_MASK_CC_NUMBER','この数にマスクをかけてください');
define('TEXT_PRODUCTS_ORDERED','注文商品点数: ');
?>