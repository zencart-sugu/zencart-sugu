<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: customers.php 1969 2005-09-13 06:57:21Z drbyte $
//

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