<?php
/*
//////////////////////////////////////////////////////////////////////////
//  EDIT ORDERS v3.0                                               	//
//                                                                  	//
//  See readme for module credit information											//
//                                                      				//
//  Powered by Zen-Cart (www.zen-cart.com)              				//
//  Portions Copyright (c) 2005 The Zen-Cart Team       				//
//                                                     					//
//  Released under the GNU General Public License       				//
//  available at www.zen-cart.com/license/2_0.txt       				//
//  or see "license.txt" in the downloaded zip          				//
//////////////////////////////////////////////////////////////////////////
//  DESCRIPTION:  Language file definitions for edit_orders.php		//
//////////////////////////////////////////////////////////////////////////
// $Id: edit_orders.php v 2010-10-24 $
*/

define('HEADING_TITLE', 'Editing Order');
define('HEADING_TITLE_SEARCH', 'Order ID:');
define('HEADING_TITLE_STATUS', 'Status:');
define('ADDING_TITLE', 'Adding a Product to Order');

define('ENTRY_UPDATE_TO_CC', 'Enter <strong>Credit Card</strong> to view CC fields.');
define('ENTRY_UPDATE_TO_CK', 'Enter the payment method used for this order to hide CC fields. (<strong>PayPal, Check/Money Order, Western Union, etc</strong>)');
define('TABLE_HEADING_STATUS_HISTORY', 'Order Status History &amp; Comments');
define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_CUSTOMERS', 'Customers');
define('TABLE_HEADING_ORDER_TOTAL', 'Order Total');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Products');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_UNIT_PRICE', 'Unit Price');
define('TABLE_HEADING_TOTAL_PRICE', 'Total Price');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Customer Notified');
define('TABLE_HEADING_DATE_ADDED', 'Date Added');

define('ENTRY_CUSTOMER', 'Customer Address:');
define('ENTRY_CUSTOMER_NAME', 'Name');
define('ENTRY_CUSTOMER_COMPANY', 'Company');
define('ENTRY_CUSTOMER_ADDRESS', 'Address');
define('ENTRY_CUSTOMER_SUBURB', 'Suburb');
define('ENTRY_CUSTOMER_CITY', 'City');
define('ENTRY_CUSTOMER_STATE', 'State');
define('ENTRY_CUSTOMER_POSTCODE', 'Postcode');
define('ENTRY_CUSTOMER_COUNTRY', 'Country');

define('ENTRY_SOLD_TO', 'SOLD TO:');
define('ENTRY_DELIVERY_TO', 'Delivery To:');
define('ENTRY_SHIP_TO', 'SHIP TO:');
define('ENTRY_SHIPPING_ADDRESS', 'Shipping Address:');
define('ENTRY_BILLING_ADDRESS', 'Billing Address:');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');
define('ENTRY_CREDIT_CARD_TYPE', 'Credit Card Type:');
define('ENTRY_CREDIT_CARD_OWNER', 'Credit Card Owner:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Credit Card Number:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Credit Card Expires:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_SHIPPING_TAX_RATE', 'Shipping Tax Rate (Not Stored in DB)&nbsp;');
define('ENTRY_SHIPPING_TAX_SYMBOL', '&#37; &nbsp;&nbsp;&nbsp;');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_DATE_PURCHASED', 'Date Purchased:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Date Last Updated:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notify Customer:');
define('ENTRY_NOTIFY_COMMENTS', 'Append Comments:');
define('ENTRY_PRINTABLE', 'Print Invoice');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Delete Order');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this order?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Restock product quantity');
define('TEXT_DATE_ORDER_CREATED', 'Date Created:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_PAYMENT_METHOD', 'Payment Method:');

define('TEXT_ALL_ORDERS', 'All Orders');
define('TEXT_NO_ORDER_HISTORY', 'No Order History Available');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Order Update');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_STATUS_UPDATE', '<b>Current Order Status:</b>' . "\n" . '%s' . "\n\n" . 'Please reply to this email if you have any questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', '<b>Comments:</b>' . "\n%s\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: Order does not exist.');
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.');
define('WARNING_ORDER_NOT_UPDATED', 'Warning: Nothing to change. The order was not updated.');

define('TEXT_ADD_NEW_PRODUCT', 'Add Product');
define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'Choose product');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'Choose options');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'No Options: Skipped..');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', '&nbsp;Qty&nbsp;');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Add now');
define('ADDPRODUCT_TEXT_STEP1', 'Step 1:');
define('ADDPRODUCT_TEXT_STEP2', 'Step 2:');
define('ADDPRODUCT_TEXT_STEP3', 'Step 3:');
define('ADDPRODUCT_TEXT_STEP4', 'Step 4:');
define('ADDPRODUCT_SPECIALS_SALES_PRICE', 'Use Specials/Sales Price');

define('TEXT_ATTRIBUTES_SIMPLE_EDITOR', 'Simple Attributes Editor');
define('TEXT_ATTRIBUTES_ADVANCED_EDITOR', 'Advanced Attributes Editor');
define('TEXT_ATTRIBUTES_PRODUCT_OPTION', 'Option for Product: &nbsp;&nbsp;');
define('TEXT_ATTRIBUTES_OPTION_PRICE_CHANGE', 'Option Price Change:');
define('TEXT_ATTRIBUTES_ONE_TIME_CHARGE', 'One Time Charges: &nbsp;&nbsp;');

define('IMAGE_ORDER_DETAILS', 'Display Order Details');

// BEGIN TY TRACKER 1  ----------------------------------------------
define('TABLE_HEADING_CARRIER_NAME', 'Carrier');
define('TABLE_HEADING_TRACKING_ID', 'Tracking ID');
define('ENTRY_ADD_TRACK', 'Add Tracking ID');
// END TY TRACKER 1 -------------------------------------------------
