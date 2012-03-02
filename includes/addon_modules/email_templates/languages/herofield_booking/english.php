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
define('MODULE_EMAIL_TEMPLATES_TITLE', 'メールテンプレート');
define('MODULE_EMAIL_TEMPLATES_DESCRIPTION', 'メールテンプレート機能を提供します。');
define('MODULE_EMAIL_TEMPLATES_STATUS_TITLE', 'メールテンプレートの有効化');
define('MODULE_EMAIL_TEMPLATES_STATUS_DESCRIPTION', 'メールテンプレートを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_EMAIL_TEMPLATES_SORT_ORDER_TITLE', '優先順');
define('MODULE_EMAIL_TEMPLATES_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('BOX_TOOLS_EMAIL_TEMPLATES', 'Emailテンプレート');
define('TEXT_EMAIL_TEMPLATE', 'Emailテンプレート: ');
define('TEXT_EMAIL_TEMPLATE_SETUP_PAGE', 'セットアップページ');
define('TEXT_EMAIL_TEMPLATE_EMPTY', 'Emailテンプレートがありません');
define('TEXT_EMAIL_TEMPLATE_DESCRIPTION', 'コメント:'.BOX_TOOLS_EMAIL_TEMPLATES.'内の[COMMENTS]に埋め込まれます<br />(テンプレート内に[COMMENTS]が無い場合はコメントの埋め込みは行われません)');
define('TEXT_EMAIL_TEMPLATE_NO_TEMPLATE', BOX_TOOLS_EMAIL_TEMPLATES.'が見つからなかったためメールの送信は行われませんでした。');

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

define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_GRP', 'パスワードリマインダー');
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_TITLE', 'パスワードリマインダー メール');
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_SUBJECT', '新しいパスワードのお知らせ');
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_BODY', '
[CUSTOMER_NAME] 様

ご利用ありがとうございます。

新しいパスワードの申請を受け付けました。

新しいパスワードは

   [NEW_PASSWORD]

です。

新しいパスワードでログインした後
「マイページ」でご希望のパスワードに変更できます。

-----
このメールは当ショップに登録されたお客様に対してお送りしています。
お心当たりが無いようでしたら大変お手数ですがメールにて
xxxxxxx@example.org までご連絡ください。

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
define('MODULE_EMAIL_TEMPLATE_INVOSICE_TEXT', 'ご注文についての情報は下記URLでご覧いただけます。');
?>
