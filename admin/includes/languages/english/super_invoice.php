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

define('HEADER_INVOICE', 'Invoice - Order #');
define('HEADER_TAX_ID', 'Fed Tax ID #');
define('HEADER_PHONE', 'Phone:');
define('HEADER_FAX', 'Fax:');
define('HEADER_CUSTOMER_NOTES', 'Order Notes:');
define('HEADER_PO_NUMBER', 'P.O. Number:');
define('HEADER_PO_INVOICE_DATE', 'Invoice Date:');
define('HEADER_PO_TERMS', 'Terms:');
define('HEADER_PO_TERMS_LENGTH', '30 Days');

define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Products');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Price (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Price (incl)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (incl)');
define('TABLE_HEADING_PRICE_NO_TAX', 'Unit Price');
define('TABLE_HEADING_TOTAL_NO_TAX', 'Total');

define('ENTRY_CUSTOMER', 'CUSTOMER');
define('ENTRY_BILL_TO', 'BILL TO');
define('ENTRY_SHIP_TO', 'SHIP TO');
define('ENTRY_PO_INFO', 'P.O. DETAILS');
define('ENTRY_NO_TAX', 'None!');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_ORDER_ID','Order #');
define('ENTRY_DATE_PURCHASED', 'Date Ordered:');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');

define('TEXT_INFO_ATTRIBUTE_FREE', '&nbsp;-&nbsp;FREE');
?>