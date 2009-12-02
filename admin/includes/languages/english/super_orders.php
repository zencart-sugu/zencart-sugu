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

define('HEADING_TITLE_ORDERS_LISTING', 'Orders Listing');
define('HEADING_TITLE_ORDER_DETAILS', 'Order #');
define('HEADING_TITLE_SEARCH', 'Order ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('HEADING_REOPEN_ORDER', 'reopen');

define('TABLE_HEADING_ORDERS_ID','ID');
define('TABLE_HEADING_STATUS_HISTORY', 'Status History');
define('TABLE_HEADING_ADD_COMMENTS', 'Add New Status/Comments');
define('TABLE_HEADING_FINAL_STATUS', 'Close Order');
define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_CUSTOMERS', 'Customers');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_PAYMENT_METHOD', 'Payment Method');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_TYPE', 'Order Type');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Products');
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
define('TABLE_HEADING_KARMA', 'Karma');
define('TEXT_WARN_NOT_VISIBLE', ' (this information is CONFIDENTIAL)');
define('TEXT_TOTAL_KARMA', 'Total Karma: ');
define('TEXT_ADMIN_NOTES_NONE', 'Customer has no reviews');

define('PAYMENT_TABLE_NUMBER', 'Number');
define('PAYMENT_TABLE_NAME', 'Payor Name');
define('PAYMENT_TABLE_AMOUNT', 'Amount');
define('PAYMENT_TABLE_TYPE', 'Type');
define('PAYMENT_TABLE_POSTED', 'Date Posted');
define('PAYMENT_TABLE_MODIFIED', 'Last Modified');
define('PAYMENT_TABLE_ACTION', 'Action');
define('ALT_TEXT_ADD', 'ADD');
define('ALT_TEXT_UPDATE', 'UPDATE');
define('ALT_TEXT_DELETE', 'DELETE');

define('ENTRY_PAYMENT_DETAILS', 'Payment Details');
define('ENTRY_CUSTOMER_ADDRESS', 'Customer Address:');
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address:');
define('ENTRY_BILLING_ADDRESS', 'Billing Address:');
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
define('ENTRY_NOTIFY_CUSTOMER', 'Notify Customer?');
define('ENTRY_NOTIFY_COMMENTS', 'Append Comments?');

define('HEADING_COLOR_KEY', 'Color Key:');
define('TEXT_PURCHASE_ORDERS', 'Purchase Order');
define('TEXT_PAYMENTS', 'Payment');
define('TEXT_REFUNDS', 'Refund');

define('TEXT_MAILTO', 'mailto');
define('TEXT_STORE_EMAIL', 'web');
define('TEXT_WHOIS_LOOKUP', 'whois');
define('TEXT_ICON_LEGEND', 'Action Icon Legend:');
define('TEXT_BILLING_SHIPPING_MISMATCH', 'Billing and Shipping do not match');
define('TEXT_INFO_HEADING_DELETE_ORDER', 'Delete Order - ');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this order?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restock product quantity');
define('TEXT_DATE_ORDER_CREATED', 'Date Created:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');
define('TEXT_INFO_SHIPPING_METHOD', 'Shipping Method:');
define('TEXT_ALL_ORDERS', 'All Orders');
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available');
define('TEXT_DISPLAY_ONLY', '(Display Only)');

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order does not exist.');
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.');
define('WARNING_ORDER_NOT_UPDATED', 'Warning: Nothing to change. The order was not updated.');
define('SUCCESS_MARK_COMPLETED', 'Success: Order #%s is complete!');
define('WARNING_MARK_CANCELLED', 'Warning: Order #%s has been cancelled');
define('WARNING_ORDER_REOPEN', 'Warning: Order #%s has been reopened');

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
define('TEXT_MORE', '... more');

define('TEXT_INFO_IP_ADDRESS', 'IP Address: ');

define('TEXT_NEW_WINDOW', ' (new window)');
define('IMAGE_SHIPPING_LABEL', 'Shipping Label');
define('ICON_ORDER_DETAILS', 'Display Order Details');
define('ICON_ORDER_PRINT', 'Print Data Sheet' . TEXT_NEW_WINDOW);
define('ICON_ORDER_INVOICE', 'Display Invoice' . TEXT_NEW_WINDOW);
define('ICON_ORDER_PACKINGSLIP', 'Display Packing Slip' . TEXT_NEW_WINDOW);
define('ICON_ORDER_SHIPPING_LABEL', 'Display Shipping Label' . TEXT_NEW_WINDOW);
define('ICON_ORDER_DELETE', 'Delete Order');
define('ICON_EDIT_CONTACT', 'edit contact data');
define('ICON_EDIT_PRODUCT', 'edit products');
define('ICON_EDIT_TOTAL', 'edit order totals');
define('ICON_EDIT_HISTORY', 'edit status history');
define('ICON_CLOSE_STATUS', 'Close Status');
define('ICON_MARK_COMPLETED', 'Mark Order Completed');
define('ICON_MARK_CANCELLED', 'Mark Order Cancelled');

define('MINI_ICON_ORDERS', 'Show Customer\'s Orders');
define('MINI_ICON_INFO', 'Show Customer\'s Profile');

define('BUTTON_TO_LIST', 'Order List');
define('BUTTON_SPLIT', 'Split Packing Slip');
define('SELECT_ORDER_LIST', 'Jump to Order:');

define('TEXT_NO_PAYMENT_DATA', 'No Payment Data Available');
define('TEXT_PAYMENT_DATA', 'Order Payment Data');
?>