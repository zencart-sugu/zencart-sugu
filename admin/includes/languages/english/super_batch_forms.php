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

define('TITLE_BATCH_OUTPUT', 'Output Batch Print Job');

define('HEADING_TITLE', 'Batch Form Printing');

define('HEADING_SEARCH_FILTER', 'Select Order Criteria');
define('HEADING_UPDATE_ORDERS', 'Update Selected Orders');

define('HEADING_START_DATE', 'Start Date');
define('HEADING_END_DATE', 'End Date (inclusive)');
define('HEADING_SEARCH_STATUS', 'Current Status:');
define('HEADING_SEARCH_PRODUCTS', 'Ordered Product:');
define('HEADING_SEARCH_CUSTOMERS', 'Customer:');
define('HEADING_SEARCH_PAYMENT_METHOD', 'Payment Method:');
define('HEADING_SEARCH_TEXT', 'Text Search:');
define('HEADING_SEARCH_ORDER_TOTAL', 'Order Total:');

define('BUTTON_UPDATE_STATUS', 'Update Status');
define('BUTTON_SEARCH', 'Search');
define('BUTTON_CHECK_ALL', 'Check All');
define('BUTTON_UNCHECK_ALL', 'Uncheck All');

define('TEXT_ENTER_SEARCH', 'Enter your criteria above, then click the <strong>Search</strong> button');
define('TEXT_TOTAL_ORDERS', 'Total Orders Found: ');
define('TEXT_ALL_ORDERS', 'All Orders');
define('TEXT_ORDER_VALUE', ' ($ value)');
define('ICON_ORDER_DETAILS', 'Display Order Details');

define('DROPDOWN_ALL_PRODUCTS', 'All Products');
define('DROPDOWN_ALL_PAYMENTS', 'All Payments');
define('DROPDOWN_ALL_CUSTOMERS', 'All Customers');
define('DROPDOWN_GREATER_THAN', ' (greater than)');
define('DROPDOWN_LESS_THAN', ' (less than)');
define('DROPDOWN_EQUAL_TO', ' (equals)');

define('HEADING_SELECT_FORM', 'Which form would you like to print?');
define('HEADING_NUM_COPIES', 'How many copies?');
define('BUTTON_SUBMIT_PRINT', 'Print Forms');

define('SELECT_INVOICE', 'Invoices');
define('SELECT_PACKINGSLIP', 'Packing Slips');
define('SELECT_SHIPPING_LABEL', 'Shipping Labels');

define('TABLE_HEADING_ORDERS_ID','Order ID');
define('TABLE_HEADING_CUSTOMERS', 'Customer');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_ORDER_STATUS', 'Order Status');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');

define('ERROR_NO_ORDERS', 'Error: No orders selected!');
define('ERROR_NO_FILE', 'Error: Target file does not exist!');
?>