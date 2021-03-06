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

define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_GRP', 'ユーザー登録');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_TITLE', 'ユーザー登録ありがとうございます');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT', 'ユーザー登録ありがとうございます');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY', 'ユーザー登録ありがとうございます

これからもよろしくお願いします。');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP', '注文完了');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_TITLE', 'ご注文ありがとうございます[会員用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT', 'ご注文ありがとうございます[会員用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY', '注文確認書 from XXXXXXXX

[CUSTOMER_NAME] 様

ご利用ありがとうございます。
ご注文内容は以下の通りです。
------------------------------------------------------
ご注文番号: [ORDER_ID]
ご注文日: [DATE_ORDERED]
請求明細書:
[INVOICE_URL]

[COMMENT]

商品
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

お届け先
------------------------------------------------------
[DELIVERY_ADDRESS]

請求先住所
------------------------------------------------------
[BILLING_ADDRESS]

お支払い方法
------------------------------------------------------
[PAYMENT_METHOD]


-----
このメールは当ショップに登録されたお客様に対してお送りしています。
お心当たりが無いようでしたら大変お手数ですがメールにて
xxxxxxx@example.org までご連絡ください。

-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_GRP', '注文完了');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_TITLE', 'ご注文ありがとうございます[ゲスト用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT', 'ご注文ありがとうございます[ゲスト用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY', '注文確認書 from XXXXXXXX

[CUSTOMER_NAME] 様

ご利用ありがとうございます。
ご注文内容は以下の通りです。
------------------------------------------------------
ご注文番号: [ORDER_ID]
ご注文日: [DATE_ORDERED]

[COMMENT]

商品
------------------------------------------------------
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

お届け先
------------------------------------------------------
[DELIVERY_ADDRESS]

請求先住所
------------------------------------------------------
[BILLING_ADDRESS]

お支払い方法
------------------------------------------------------
[PAYMENT_METHOD]


-----
このメールは当ショップに登録されたお客様に対してお送りしています。
お心当たりが無いようでしたら大変お手数ですがメールにて
xxxxxxx@example.org までご連絡ください。

-----
Copyright (c) XXXXXXXX Inc. All Rights Reserved
');

define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_GRP',     'ユーザ通知');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_TITLE',   'ステータス変更');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT', 'ご注文受付状況のお知らせ');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY', '
[CUSTOMER_NAME] 様

ご利用ありがとうございます。
[DATE_ORDERED]にご利用いただいた
ご注文受付番号：[ORDER_ID]の状況が変更されましたのでお知らせします。

[INVOICE_URL]

[COMMENTS]

よろしくお願いします。

-----
このメールは当ショップに登録されたお客様に対してお送りしています。
お心当たりが無いようでしたら大変お手数ですがメールにて
xxxxxxx@example.org までご連絡ください。

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

define('MODULE_EMAIL_TEMPLATE_STATUS_CHANGE_NO_NOTIFY', 'しない');
define('MODULE_EMAIL_TEMPLATE_DATE_FORMAT_LONG',        '%Y年%m月%d日 ');

define('MODULE_EMAIL_TEMPLATE_SUN', '日曜日');
define('MODULE_EMAIL_TEMPLATE_MON', '月曜日');
define('MODULE_EMAIL_TEMPLATE_TUE', '火曜日');
define('MODULE_EMAIL_TEMPLATE_WED', '水曜日');
define('MODULE_EMAIL_TEMPLATE_THU', '木曜日');
define('MODULE_EMAIL_TEMPLATE_FRI', '金曜日');
define('MODULE_EMAIL_TEMPLATE_SAT', '土曜日');

define('MODULE_EMAIL_TEMPLATE_NOT_DELIVERY', '無し');
define('MODULE_EMAIL_TEMPLATE_INVOICE_TEXT', 'ご注文についての情報は下記URLでご覧いただけます。');


// ---------------------------------------------------
// ここから英語. japanese.php と english.php は一緒に読み込まれないので、1言語の中に2定義が必要となる。
// 逆に、英語の方は英語だけでいいっしょ。
// ---------------------------------------------------

define('MODULE_EMAIL_TEMPLATE_CREATE_LANGUAGE_ID_EN', '1');

define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT_EN', 'Thank you for registration');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY_EN', 'Thank you for registration.

Please enjoy shopping.');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT_EN', 'Thank you for your order.[For Members]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY_EN', 'Order Confirmation from XXXXXXXX

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

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT_EN', 'Thank you for your order.[For Guests]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY_EN', 'Order Confirmation from XXXXXXXX

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


define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT_EN', 'Notice of order receipt status');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY_EN', '
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


define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_SUBJECT_EN', '新しいパスワードのお知らせ');
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_BODY_EN', '
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

?>