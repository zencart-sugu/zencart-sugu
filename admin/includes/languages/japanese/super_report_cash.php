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
//  DESCRIPTION:   Report that displays all income for  //
//  the given date range.  Report results come solely   //
//  from the Super Orders payment system.               //
//////////////////////////////////////////////////////////
// $Id: super_report_cash.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('HEADING_TITLE', 'Cash Report');

define('HEADING_DATE_RANGE', 'Specify your date range');
define('HEADING_SELECT_TARGET', 'Select your data');
define('HEADING_START_DATE', 'Start Date');
define('HEADING_END_DATE', 'End Date (inclusive)');
define('HEADING_PRINT_FORMAT', 'Display results in print format');
define('BUTTON_SEARCH', 'Search Orders');

define('HEADING_COLOR_KEY', 'Color Key:');
define('TEXT_PAYMENTS', 'Payments');
define('TEXT_REFUNDS', 'Refunds');
define('TEXT_BOTH', 'Both');
define('TEXT_TO', ' to ');
define('TEXT_NO_PAYMENT_DATA', 'No payment data to display');
define('TEXT_NO_REFUND_DATA', 'No refund data to display');

define('TABLE_HEADING_ORDER_ID', 'Order #');
define('TABLE_HEADING_NUMBER', 'Number');
define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_AMOUNT', 'Value');
define('TABLE_HEADING_TYPE', 'Type');
define('TABLE_HEADING_STATE', 'State');
define('TABLE_HEADING_DATE_PURCHASED', 'Date of Purchase');
define('TABLE_HEADING_DATE_POSTED', 'Date Posted');
define('TABLE_SUB_COUNT', 'Total %s Payments: ');
define('TABLE_SUB_TOTAL', 'Total %s Value: ');

define('TABLE_FOOTER_NUM_TYPES', ' total payment types');
define('TABLE_FOOTER_NUM_PAYMENTS', 'Total Payments: ');
define('TABLE_FOOTER_CASH_TOTAL', 'Payments: ');
define('TABLE_FOOTER_NUM_REFUNDS', 'Total Refunds: ');
define('TABLE_FOOTER_REFUND_TOTAL', 'Refunds: ');
define('TABLE_FOOTER_TOTAL_INCOME', 'Total Income: ');
?>