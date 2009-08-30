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

define('EMAIL_TEXT_SUBJECT', 'ご注文ありがとうございます。');
define('EMAIL_TEXT_HEADER', '注文確認書');
define('EMAIL_TEXT_FROM',' from ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','ご利用ありがとうございます。');
define('EMAIL_DETAILS_FOLLOW','ご注文内容は以下の通りです。');
define('EMAIL_TEXT_ORDER_NUMBER', 'ご注文番号:');
define('EMAIL_TEXT_INVOICE_URL', '請求明細書:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', '請求明細書のURLはこちらです。');
define('EMAIL_TEXT_DATE_ORDERED', 'ご注文日:');
define('EMAIL_TEXT_PRODUCTS', '商品');
define('EMAIL_TEXT_SUBTOTAL', '小計:');
define('EMAIL_TEXT_TAX', '税額:        ');
define('EMAIL_TEXT_SHIPPING', '配送方法: ');
define('EMAIL_TEXT_TOTAL', '合計:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'お届け先');
define('EMAIL_TEXT_BILLING_ADDRESS', '請求先住所');
define('EMAIL_TEXT_PAYMENT_METHOD', 'お支払い方法');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', 'via');

// suggest not using # vs No as some spamm protection block emails with these subjects
define('EMAIL_ORDER_NUMBER_SUBJECT', ' No: ');
define('HEADING_ADDRESS_INFORMATION','ご住所');
define('HEADING_SHIPPING_METHOD','配送方法');

define('EMAIL_GREET', ' 様');
?>