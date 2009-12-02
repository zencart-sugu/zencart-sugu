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
//  DESCRIPTION:   Replaces admin/invoice.php, adds     //
//  amount paid & balance due values based on           //
//  super_order class calculations.  Also includes the  //
//  option to display a tax exemption number,           //
//  configurable from the admin.                        //
//////////////////////////////////////////////////////////
// $Id: super_invoice.php 25 2006-02-03 18:55:56Z BlindSide $
*/

// Don't forget to configure the new Phone and Fax numbers in the Admin!
// Configuration > My Store > Store Phone/Store Fax

define('HEADER_INVOICE', '請求書-注文番号 #');
define('HEADER_TAX_ID', 'Fed Tax ID #');
define('HEADER_PHONE', '電話:');
define('HEADER_FAX', 'FAX:');
define('HEADER_CUSTOMER_NOTES', 'お客様コメント:');
define('HEADER_PO_NUMBER', 'P.O. Number:');
define('HEADER_PO_INVOICE_DATE', '請求日:');
define('HEADER_PO_TERMS', '用語:');
define('HEADER_PO_TERMS_LENGTH', '30日');

define('TABLE_HEADING_COMMENTS', 'コメント');
define('TABLE_HEADING_PRODUCTS_MODEL', '商品番号');
define('TABLE_HEADING_PRODUCTS', '商品名');
define('TABLE_HEADING_TAX', '税率');
define('TABLE_HEADING_TOTAL', '合計');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', '価格 (税抜き)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', '価格 (税込み)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', '合計 (税抜き)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', '合計 (税込み)');
define('TABLE_HEADING_PRICE_NO_TAX', '単価');
define('TABLE_HEADING_TOTAL_NO_TAX', '合計');

define('ENTRY_CUSTOMER', '顧客名');
define('ENTRY_BILL_TO', '請求先');
define('ENTRY_SHIP_TO', '配送先');
define('ENTRY_PO_INFO', 'P.O. DETAILS');
define('ENTRY_NO_TAX', '税金を含まず');
define('ENTRY_SUB_TOTAL', '小計:');
define('ENTRY_TAX', '税金:');
define('ENTRY_SHIPPING', '配送:');
define('ENTRY_TOTAL', '合計:');
define('ENTRY_ORDER_ID','注文番号');
define('ENTRY_DATE_PURCHASED', 'ご注文日:');
define('ENTRY_PAYMENT_METHOD', '支払方法:');

define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;無料');
?>