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
//  DESCRIPTION:   This report displays orders that     //
//  have outstanding payments or refunds.  Missing      //
//  purchase order data can be seached as well.         //
//////////////////////////////////////////////////////////
// $Id: super_report_await_pay.php 32 2006-03-30 22:44:14Z BlindSide $
*/

define('HEADING_TITLE', 'Orders Awaiting Payment');

define('HEADING_REPORT_TYPE', 'Show me all outstanding...');
define('HEADING_PRINT_FORMAT', 'Display results in print format');
define('HEADING_WITHIN_LIMIT', 'Include activities within 30 days of today');
define('BUTTON_SEARCH', 'List Orders');

define('OUT_PAYMENTS', 'Payments');
define('OUT_PO', 'Purchase Orders');
define('OUT_REFUNDS', 'Refunds');

define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_ORDER_NUMBER', 'Order #');
define('TABLE_HEADING_STATE', 'Customer State');
define('TABLE_HEADING_BILLING_NAME', 'Billing Name');
define('TABLE_HEADING_CUSTOMERS_PHONE', 'Customer\'s Phone');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_AMOUNT_APPLIED', 'Amount Applied');
define('TABLE_HEADING_SO_BALANCE', 'Balance Due');

define('TABLE_SUBHEADING_PO_CHECKS', 'Purchase Order Checks');
define('TABLE_SUBHEADING_CHECKS', 'Direct / Personal Checks');
define('TABLE_SUBHEADING_TOTAL_PAYMENTS', 'Total Payments');

define('TEXT_ORDERS', ' Orders');

define('TABLE_FOOTER_ORDER_GRAND_TOTAL', 'Order Total:');
define('TABLE_FOOTER_TOTAL_APPLIED', 'Total Applied:');
define('TABLE_FOOTER_TOTAL_BALANCE', 'Total Balance:');
?>