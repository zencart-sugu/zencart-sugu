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

define('PAGE_TITLE', 'Order Details');
define('HEADER_ORDER_DATA', 'Order #');
define('HEADER_CUSTOMER_ID', 'Customer #');
define('HEADER_ADDRESS_DATA', 'ADDRESS DATA');
define('HEADER_STATUS_HISTORY', 'STATUS HISTORY');
define('HEADER_PAYMENT_HISTORY', 'PAYMENT HISTORY');

define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_TYPE', 'Order Type');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Products');
define('TABLE_HEADING_QUANTITY', 'Qty');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Price (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Price (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)');
define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Customer Notified');
define('TABLE_HEADING_DATE_ADDED', 'Date Added');

define('TABLE_HEADING_ADMIN_NOTES', 'Admin Notes');
define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_ADD_NOTES', 'Add New Note');
define('TABLE_HEADING_RATING', 'Rating');
define('TEXT_WARN_NOT_VISIBLE', ' (this information is CONFIDENTIAL)');
define('TEXT_AVG_RATING', 'Average Rating: ');
define('TEXT_ADMIN_NOTES_NONE', 'Customer has no reviews');

define('PAYMENT_TABLE_NUMBER', 'Number');
define('PAYMENT_TABLE_NAME', 'Payor Name');
define('PAYMENT_TABLE_AMOUNT', 'Amount');
define('PAYMENT_TABLE_TYPE', 'Type');
define('PAYMENT_TABLE_POSTED', 'Date Posted');
define('PAYMENT_TABLE_MODIFIED', 'Last Modified');
define('PAYMENT_TABLE_ACTION', 'Action');

define('ENTRY_CUSTOMER_ADDRESS', 'Customer:');
define('ENTRY_SHIPPING_ADDRESS', 'Shipping:');
define('ENTRY_BILLING_ADDRESS', 'Billing:');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Owner:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Number:');
define('ENTRY_CREDIT_CARD_CVV', 'Credit Card CVV Number:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Expires:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_AMOUNT_APPLIED', 'Amount Applied:');
define('ENTRY_BALANCE_DUE', 'Balance Due:');
define('ENTRY_DATE_PURCHASED', 'Date Purchased:');
define('ENTRY_STATUS', 'Status:');

define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');
define('TEXT_INFO_SHIPPING_METHOD', 'Shipping Method:');

define('ENTRY_ORDER_ID','Order #');
define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;<span class="alert">FREE</span>');

define('TEXT_DOWNLOAD_TITLE', 'Order Download Status');
define('TEXT_DOWNLOAD_STATUS', 'Status');
define('TEXT_DOWNLOAD_FILENAME', 'Filename');
define('TEXT_DOWNLOAD_MAX_DAYS', 'Days');
define('TEXT_DOWNLOAD_MAX_COUNT', 'Count');
define('TEXT_DOWNLOAD_AVAILABLE', 'Available');
define('TEXT_DOWNLOAD_EXPIRED', 'Expired');
define('TEXT_DOWNLOAD_MISSING', 'Not on Server');

define('IMAGE_ICON_STATUS_CURRENT', 'Status - Available');
define('IMAGE_ICON_STATUS_EXPIRED', 'Status - Expired');
define('IMAGE_ICON_STATUS_MISSING', 'Status - Missing');

define('SUCCESS_ORDER_UPDATED_DOWNLOAD_ON', 'Download was successfully enabled');
define('SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF', 'Download was successfully disabled');

define('TEXT_INFO_IP_ADDRESS', 'IP Address: ');
define('TEXT_NO_PAYMENT_DATA', 'No Payment Data Available');
?>