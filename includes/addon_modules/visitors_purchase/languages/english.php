<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//

define('MODULE_VISITORS_PURCHASE_TITLE', 'Merchandise purchase by visitor');
define('MODULE_VISITORS_PURCHASE_DESCRIPTION', 'The merchandise purchase by the visitor who doesn\'t register the member is enabled.');
define('MODULE_VISITORS_PURCHASE_STATUS_TITLE', 'Activating Purchases by Visitors');
define('MODULE_VISITORS_PURCHASE_STATUS_DESCRIPTION', 'Do you want to active to purchases by visitors?<br />true: Active<br />false: Inactive');
define('MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_TITLE', 'Days in which visitor\'s order data is preserved');
define('MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DESCRIPTION', 'How many days from the commodity purchase date visitor\'s order data is preserved is set. When specified days are exceeded, visitor\'s order data is automatically deleted from the data base. It makes it to an empty column when not deleting it automatically.<br />Default = ' . MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DEFAULT);
define('MODULE_VISITORS_PURCHASE_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_VISITORS_PURCHASE_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

// additional defines login
define('HEADING_NEW_CUSTOMER_WITH_VISITORS', '[For first visit or unregistered customers,]<br />If you want to create your account,then press [Next] Button.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_WITH_VISITORS', '
Do not miss the chance!<br />Once you have customer account for ' . STORE_NAME . ', then later enjoy a comfortable shopping without having to enter your customer information.');
define('HEADING_NEW_VISITORS', '¡ÚShopping without creating account¡Û<br /> Enter Your Information and press [Compleete] button.');
define('TEXT_NEW_VISITORS_INTRODUCTION', 'In ' . STORE_NAME . ',You can buy anything without creating an account.However,services for members are not available.');
define('ENTRY_EMAIL_FORMAT','Email Format');

// additional defines checkout_confirmation
define('TEXT_INFO_VISITORS_CREDIT_SELECTION', 'If you want to use [%s] Service,you need to create customer account.');
define('TEXT_INFO_VISITORS_CREATE_ACCOUNT', '<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">Customer Registoration</a>');

// additional defines checkout_confirmation
define('HEADING_CUSTOMER_ADDRESS', 'Cutomer Information');

// additional defines checkout_process
define('EMAIL_TEXT_CUSTOMER_ADDRESS', 'Customer Information');
define('EMAIL_VISITORS_DISCLAIMER', 'This E-mail is sent to the customer ordered to this shop. Very sorry to trouble you, but please contact the %s with mail when there is no idea.');
define('SEND_EXTRA_VISITORS_NEW_ORDERS_EMAILS_TO_SUBJECT','[New Order] (Visitors)');

// additional defines checkout_success
define('TEXT_INFO_VISITORS_NOTIFY_PRODUCTS', 'Customer registration is required for receiving our notifications.');
define('TEXT_VISITORS_SEE_ORDERS', 'You can view the Purchase history.You can view the Purchase history from user page.');
define('TEXT_INFO_VISITORS_SEE_ORDERS', 'Customer registration is required for entering user page');
define('TEXT_VISITOR_TO_ACCOUNT', 'Visitor');
define('TEXT_VISITOR_TO_ACCOUNT_INTRODUCTION', '
<p class="attention">To create an customer account from this order\'s information,press <strong>"Register(Free!)"</strong> button.</p>

<p>If you register now,you can create customer account from this Order\'s information.Do not miss this chance!<br />
Once you have customer account for ' . STORE_NAME . ', then later enjoy a comfortable shopping without having to enter your customer information.</p>');

define('TEXT_VISITORS_ORDER', 'Visitors Order');
