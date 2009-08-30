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
// $Id: super_customers.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('HEADING_TITLE', 'Customers');

define('TABLE_HEADING_ID', 'ID#');
define('TABLE_HEADING_FIRSTNAME', 'First Name');
define('TABLE_HEADING_LASTNAME', 'Last Name');
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Created');
define('TABLE_HEADING_LOGIN', 'Last Login');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_PRICING_GROUP', 'Pricing Group');
define('TABLE_HEADING_AUTHORIZATION_APPROVAL', 'Authorized');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Created:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Last Logon:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Number of Logons:');
define('TEXT_INFO_COUNTRY', 'Country:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Number of Reviews:');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this customer?');
define('TEXT_DELETE_REVIEWS', 'Delete %s review(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Delete Customer');
define('TYPE_BELOW', 'Type below');
define('PLEASE_SELECT', 'Select One');
define('TEXT_INFO_NUMBER_OF_ORDERS', 'Number of Orders:');
define('TEXT_INFO_LAST_ORDER','Last Order:');
define('TEXT_INFO_ORDERS_TOTAL', 'Total:');
define('CUSTOMERS_REFERRAL', 'Customer Referral<br />1st Discount Coupon');

define('ENTRY_NONE', 'None');

define('TABLE_HEADING_COMPANY','Company');

define('CUSTOMERS_AUTHORIZATION', 'Customers Authorization Status');
define('CUSTOMERS_AUTHORIZATION_0', 'Approved');
define('CUSTOMERS_AUTHORIZATION_1', 'Pending Approval - Must be Authorized to Browse');
define('CUSTOMERS_AUTHORIZATION_2', 'Pending Approval - May Browse No Prices');
define('CUSTOMERS_AUTHORIZATION_3', 'Pending Approval - May browse with prices but may not buy');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION1', 'Warning: Your shop is set up for Approval with No Browse. The customer has been set to Pending Approval - No Browse');
define('ERROR_CUSTOMER_APPROVAL_CORRECTION2', 'Warning: Your shop is set up for Approval with Browse no prices. The customer has been set to Pending Approval - Browse No Prices');
?>