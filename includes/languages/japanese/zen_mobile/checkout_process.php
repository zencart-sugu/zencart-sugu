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
// $Id: checkout_process.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('EMAIL_TEXT_SUBJECT', '����ʸ���꤬�Ȥ��������ޤ���');
define('EMAIL_TEXT_HEADER', '��ʸ��ǧ��');
define('EMAIL_TEXT_FROM',' from ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','�����٤�'.STORE_NAME.'������ĺ�����꤬�Ȥ��������ޤ���');
define('EMAIL_DETAILS_FOLLOW','����ʸ���Ƥϰʲ����̤�Ǥ���');
define('EMAIL_TEXT_ORDER_HISTORY_CONFIRM','�ܤ����ϥޥ��ڡ�������ʸ���򤫤餴��ǧ���������ޤ���');
define('EMAIL_TEXT_ORDER_NUMBER', '����ʸ�ֹ�:');
define('EMAIL_TEXT_INVOICE_URL', '�������ٽ�:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', '�������ٽ��URL�Ϥ�����Ǥ���');
define('EMAIL_TEXT_DATE_ORDERED', '����ʸ��:');
define('EMAIL_TEXT_PRODUCTS', '����');
define('EMAIL_TEXT_SUBTOTAL', '����:');
define('EMAIL_TEXT_TAX', '�ǳ�:        ');
define('EMAIL_TEXT_SHIPPING', '������ˡ: ');
define('EMAIL_TEXT_TOTAL', '���:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', '���Ϥ���');
define('EMAIL_TEXT_BILLING_ADDRESS', '�����轻��');
define('EMAIL_TEXT_PAYMENT_METHOD', '����ʧ����ˡ');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','������');
define('HEADING_SHIPPING_METHOD','������ˡ');

define('EMAIL_GREET', ' ��');
?>