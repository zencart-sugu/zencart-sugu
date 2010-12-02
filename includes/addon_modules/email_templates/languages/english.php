<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
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
// $Id: english.php $
//
define('MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN', '1');

//define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID_EN', '1');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT_EN', 'Thank you for membership registration');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY_EN', 'Thank you for membership registration');

//define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID_EN', '2');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT_EN', 'Thank you for the order[member]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY_EN', 'OrderConfirmation from XXXXXXXX

[CUSTOMER_NAME]

OrderNumber: [ORDER_ID]
OrderDate: [DATE_ORDERED]
Invoice:
[INVOICE_URL]

[COMMENT]

Products
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

Shipping
------------------------------------------------------
[DELIVERY_ADDRESS]

InvoiceAddress
------------------------------------------------------
[BILLING_ADDRESS]

Payment
------------------------------------------------------
[PAYMENT_METHOD]


-----
This E-mail is sent to the customer registered in this shop.
Very sorry to trouble you, but with mail when there is no mind hit
xxxxxxx@example.org

-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

//define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID_EN', '3');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT_EN', 'Thank you for the order[guest]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY_EN', 'OrderConfirmation from XXXXXXXX

[CUSTOMER_NAME]

OrderNumber: [ORDER_ID]
OrderDate: [DATE_ORDERED]
Invoice:
[INVOICE_URL]

[COMMENT]

Products
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

Shipping
------------------------------------------------------
[DELIVERY_ADDRESS]

InvoiceAddress
------------------------------------------------------
[BILLING_ADDRESS]

Payment
------------------------------------------------------
[PAYMENT_METHOD]


-----
This E-mail is sent to the customer registered in this shop.
Very sorry to trouble you, but with mail when there is no mind hit
xxxxxxx@example.org

-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

//define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID_EN', '4');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT_EN', 'Information of order situation');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY_EN', '
[CUSTOMER_NAME]

Thank you for use
[DATE_ORDERED]
Order receipt number¡§[ORDER_ID]

You can see ordering information
[INVOICE_URL]

-----
This E-mail is sent to the customer registered in this shop.
Very sorry to trouble you, but with mail when there is no mind hit
xxxxxxx@example.org

-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_NOT_DELIVERY', 'NONE');
?>