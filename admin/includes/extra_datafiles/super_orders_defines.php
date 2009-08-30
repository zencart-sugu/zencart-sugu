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
//  DESCRIPTION:   Contains all the general defines     //
//  necessary for the Super Orders system to operate    //
//  properly.                                           //
//                                                      //
//  You should not have to edit anything in this file.  //
//                                                      //
//////////////////////////////////////////////////////////
// $Id: super_orders_defines.php 25 2006-02-03 18:55:56Z BlindSide $
*/

// Core files
define('FILENAME_SUPER_EDIT', 'super_edit');
define('FILENAME_SUPER_ORDERS', 'super_orders');
define('FILENAME_SUPER_DATA_SHEET', 'super_data_sheet');
define('FILENAME_SUPER_INVOICE', 'super_invoice');
define('FILENAME_SUPER_PACKINGSLIP', 'super_packingslip');
define('FILENAME_SUPER_SHIPPING_LABEL', 'super_shipping_label');
define('FILENAME_SUPER_PAYMENTS', 'super_payments');
define('FILENAME_SUPER_PAYMENT_TYPES', 'super_payment_types');

// Reports
define('FILENAME_SUPER_REPORT_AWAIT_PAY', 'super_report_await_pay');
define('FILENAME_SUPER_REPORT_CASH', 'super_report_cash');

// Batch Systems
define('FILENAME_SUPER_BATCH_STATUS', 'super_batch_status');
define('FILENAME_SUPER_BATCH_FORMS', 'super_batch_forms');

// Boxes
define('BOX_CUSTOMERS_SUPER_ORDERS', 'Super Orders');
define('BOX_CUSTOMERS_SUPER_BATCH_STATUS', 'バッチ ステータス変更');
define('BOX_CUSTOMERS_SUPER_BATCH_FORMS', 'バッチ フォーム印刷');
define('BOX_REPORTS_SUPER_REPORT_AWAIT_PAY', '支払い待ち');
define('BOX_REPORTS_SUPER_REPORT_CASH', '現金収支報告');
define('BOX_REPORTS_SUPER_PAYMENT_TYPES', '支払い方法');

// Table names
define('TABLE_SO_PURCHASE_ORDERS', DB_PREFIX . 'so_purchase_orders');
define('TABLE_SO_PAYMENTS', DB_PREFIX . 'so_payments');
define('TABLE_SO_PAYMENT_TYPES', DB_PREFIX . 'so_payment_types');
define('TABLE_SO_REFUNDS', DB_PREFIX . 'so_refunds');
define('TABLE_CUSTOMERS_ADMIN_NOTES', DB_PREFIX . 'customers_admin_notes');


// DO NOT EDIT!
define('SUPER_ORDERS_VERSION', '2.0');
// DO NOT EDIT!
?>