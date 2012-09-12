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
define('MODULE_EMAIL_TEMPLATES_TITLE', 'Email Template');
define('MODULE_EMAIL_TEMPLATES_DESCRIPTION', 'Email template provides.');
define('MODULE_EMAIL_TEMPLATES_STATUS_TITLE', 'Activating Email template');
define('MODULE_EMAIL_TEMPLATES_STATUS_DESCRIPTION', 'Do you want to active to mail template?<br />true: Active<br />false: Inactive');
define('MODULE_EMAIL_TEMPLATES_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_EMAIL_TEMPLATES_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('BOX_TOOLS_EMAIL_TEMPLATES', 'Email Template');
define('TEXT_EMAIL_TEMPLATE', 'Email Template: ');
define('TEXT_EMAIL_TEMPLATE_SETUP_PAGE', 'Setup Page');
define('TEXT_EMAIL_TEMPLATE_EMPTY', 'No Email Templates');
define('TEXT_EMAIL_TEMPLATE_DESCRIPTION', 'Comment:It is buried [COMMENTS] in '.BOX_TOOLS_EMAIL_TEMPLATES.'<br />(The comment is not buried when there is no [COMMENTS] in the template.)');
define('TEXT_EMAIL_TEMPLATE_NO_TEMPLATE', BOX_TOOLS_EMAIL_TEMPLATES.' had not been found, mail was not transmitted.');

define('MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID', '2');

define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_GRP', 'User registration');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_TITLE', 'Thank you for registration');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT', 'Thank you for registration');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY', 'Thank you for registration.

Please enjoy shopping.');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP', 'Order is complete.');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_TITLE', 'Thank you for your order.[For Members]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT', 'Thank you for your order.[For Members]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY', 'Order Confirmation from XXXXXXXX

Dear [CUSTOMER_NAME]

Thank you for your order.
Your order is as follows.
------------------------------------------------------
Order Number: [ORDER_ID]
Order Date: [DATE_ORDERED]
Invoice:
[INVOICE_URL]

[COMMENT]

Products Ordered
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

Delivery Address
------------------------------------------------------
[DELIVERY_ADDRESS]

Billing Address
------------------------------------------------------
[BILLING_ADDRESS]

Payment Method
------------------------------------------------------
[PAYMENT_METHOD]

Thank you.

-----
This email sent to customers who register to our shopping site.
If you do not remember this email,please contact us at xxxxxxx@example.org.
-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_GRP', 'Order is complete.');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_TITLE', 'Thank you for your order.[For Guests]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT', 'Thank you for your order.[For Guests]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY', 'Order Confirmation from XXXXXXXX

Dear [CUSTOMER_NAME]

Thank you for your order.
Your order is as follows.
------------------------------------------------------
Order Number: [ORDER_ID]
Order Date: [DATE_ORDERED]

[COMMENT]

Products Ordered
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

Delivery Address
------------------------------------------------------
[DELIVERY_ADDRESS]

Billing Address
------------------------------------------------------
[BILLING_ADDRESS]

Payment Method
------------------------------------------------------
[PAYMENT_METHOD]

Thank you.

-----
This email sent to customers who register to our shopping site.
If you do not remember this email,please contact us at xxxxxxx@example.org.
-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_GRP',     'User notification');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_TITLE',   'Status Change');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT', 'Notice of order receipt status');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY', '
Dear [CUSTOMER_NAME]

Thank you for your order.
To announce the status of Order Number:[ORDER_ID] ,your order on [DATE_ORDERED].

[INVOICE_URL]

[COMMENTS]

Thank you.

-----
This email sent to customers who register to our shopping site.
If you do not remember this email,please contact us at xxxxxxx@example.org.
-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_STATUS_CHANGE_NO_NOTIFY', 'No');
define('MODULE_EMAIL_TEMPLATE_DATE_FORMAT_LONG',        '%Y/%m/%d ');

define('MODULE_EMAIL_TEMPLATE_SUN', 'SUN');
define('MODULE_EMAIL_TEMPLATE_MON', 'MON');
define('MODULE_EMAIL_TEMPLATE_TUE', 'TUE');
define('MODULE_EMAIL_TEMPLATE_WED', 'WED');
define('MODULE_EMAIL_TEMPLATE_THU', 'THU');
define('MODULE_EMAIL_TEMPLATE_FRI', 'FRI');
define('MODULE_EMAIL_TEMPLATE_SAT', 'SAT');

define('MODULE_EMAIL_TEMPLATE_NOT_DELIVERY', 'Non');
define('MODULE_EMAIL_TEMPLATE_INVOSICE_TEXT', 'For ordering information available at the following URL.');
?>
