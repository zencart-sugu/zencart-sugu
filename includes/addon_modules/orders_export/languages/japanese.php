<?php
/**
 * :package - japanese
 *
 * @package :package
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: japanese.php $
 */

define('MODULE_ORDERS_EXPORT_TITLE', '注文データエクスポート');
define('MODULE_ORDERS_EXPORT_DESCRIPTION', '注文データエクスポート');

define('MODULE_ORDERS_EXPORT_STATUS_TITLE', 'orders_exportの有効化');
define('MODULE_ORDERS_EXPORT_STATUS_DESCRIPTION', 'orders_exportを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_ORDERS_EXPORT_SORT_ORDER_TITLE', '優先順');
define('MODULE_ORDERS_EXPORT_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// invoice_batch_print
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_COMMENTS', 'コメント');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS_MODEL', '型番');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS', '商品名');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_TAX', '税金');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_TOTAL', '合計');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRICE_EXCLUDING_TAX', '価格 (税別)');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRICE_INCLUDING_TAX', '価格 (税込み)');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_TOTAL_EXCLUDING_TAX', '合計 (税別)');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_TOTAL_INCLUDING_TAX', '合計 (税込み)');

define('MODULE_ORDERS_EXPORT_ENTRY_CUSTOMER', 'CUSTOMER:');

define('MODULE_ORDERS_EXPORT_ENTRY_SOLD_TO', 'ご購入者:');
define('MODULE_ORDERS_EXPORT_ENTRY_SHIP_TO', '配送先:');
define('MODULE_ORDERS_EXPORT_ENTRY_PAYMENT_METHOD', 'お支払方法:');
define('MODULE_ORDERS_EXPORT_ENTRY_SUB_TOTAL', '小計:');
define('MODULE_ORDERS_EXPORT_ENTRY_TAX', '税金:');
define('MODULE_ORDERS_EXPORT_ENTRY_SHIPPING', '配送:');
define('MODULE_ORDERS_EXPORT_ENTRY_TOTAL', '合計:');
define('MODULE_ORDERS_EXPORT_ENTRY_DATE_PURCHASED', 'ご注文日:');

define('MODULE_ORDERS_EXPORT_ENTRY_ORDER_ID','注文番号 ');
define('MODULE_ORDERS_EXPORT_TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;FREE');

// orders_export
define('MODULE_ORDERS_EXPORT_HEADING_TITLE', '注文データエクスポート');

define('MODULE_ORDERS_EXPORT_TABLE_HEADING_EXPORT', '選択');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_SHIPPING_METHOD', '配送方法');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PAYMENT_METHOD', '支払方法');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDERS_ID','ID');

define('MODULE_ORDERS_EXPORT_TEXT_BILLING_SHIPPING_MISMATCH','請求先と配送先が違います');

define('MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDERS', '注文');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_CUSTOMERS', '顧客名');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_COMPANY', '会社名');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDER_TOTAL', '注文合計');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_DATE_PURCHASED', '注文日');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_STATUS', 'ステータス');

define('MODULE_ORDERS_EXPORT_TEXT_ALL', '全て');
define('MODULE_ORDERS_EXPORT_TEXT_ASC', '▲');
define('MODULE_ORDERS_EXPORT_TEXT_DESC', '▼');
define('MODULE_ORDERS_EXPORT_TEXT_ALL_SHIPPING_METHOD', '- 全て -');
define('MODULE_ORDERS_EXPORT_TEXT_ALL_PAYMENT_METHOD', '- 全て -');
define('MODULE_ORDERS_EXPORT_TEXT_FROM', '自:');
define('MODULE_ORDERS_EXPORT_TEXT_TO', '至:');
define('MODULE_ORDERS_EXPORT_TEXT_ALL_ORDERS_STATUS', '-- 全て --');
define('MODULE_ORDERS_EXPORT_TEXT_ALLMATCH_ORDERS', '条件にマッチする注文をすべてエクスポートする');
define('MODULE_ORDERS_EXPORT_TEXT_PRINT_INVOICE', '納品書を印刷する');
define('MODULE_ORDERS_EXPORT_TEXT_PRINT_PAKINGSLIP', '配送票を印刷する');
define('MODULE_ORDERS_EXPORT_TEXT_FORMAT', '出力形式:');
define('MODULE_ORDERS_EXPORT_TEXT_SAVE_FILE', 'ファイルに保存する');
define('MODULE_ORDERS_EXPORT_TEXT_VIEW_HEADER', '1 行目に項目名を追加する');
define('MODULE_ORDERS_EXPORT_TEXT_VIEW_RAWDATA', 'エクスポート結果を画面に表示する');
define('MODULE_ORDERS_EXPORT_TEXT_RAWDATA', 'エクスポート結果');
define('MODULE_ORDERS_EXPORT_TEXT_SAVE_FILE_PATH', '保存先: ');
define('MODULE_ORDERS_EXPORT_CAUTION_NO_DATA', '条件にマッチする注文がありませんでした。');

// packingslip_batch_print
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_COMMENTS', 'コメント');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS_MODEL', '型番');
define('MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS', '商品');

define('MODULE_ORDERS_EXPORT_ENTRY_CUSTOMER', '顧客:');

define('MODULE_ORDERS_EXPORT_ENTRY_SOLD_TO', '請求先:');
define('MODULE_ORDERS_EXPORT_ENTRY_SHIP_TO', '配送先:');
define('MODULE_ORDERS_EXPORT_ENTRY_PAYMENT_METHOD', 'お支払い方法:');
define('MODULE_ORDERS_EXPORT_ENTRY_DATE_PURCHASED', '注文日:');

define('MODULE_ORDERS_EXPORT_ENTRY_ORDER_ID','注文番号 ');

// extra_definition
define('MODULE_ORDERS_EXPORT_BOX_CUSTOMERS_ORDERS_EXPORT', '注文データエクスポート');
define('MODULE_ORDERS_EXPORT_IMAGE_DOWNLOAD', 'ダウンロード');
?>
