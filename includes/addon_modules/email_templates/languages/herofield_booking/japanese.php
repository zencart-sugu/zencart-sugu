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
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_TITLE', 'ユーザー登録完了メール');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_SUBJECT', '手ぶらでＢＢＱ　会員登録完了のお知らせ');
define('MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_BODY', 
'[CUSTOMER_NAME] 様

このたびは当社ウェブサイトにて、ご登録いただきありがとうございました。

当社ウェブサイトにてご登録いただいたアカウントで、お客様はこれから
以下の便利なサービスをご利用いただけます。

・ご予約カート
ご予約途中の予約日・人数・チェックイン時間およびご注文の商品情報は、
削除またはご予約完了するまで保持してあります。再度、ログインして
いただければご予約カートの復元が可能です。

・お客様情報の確認・変更
マイページから、お客様のご住所などを確認・変更が可能です。
パスワードの変更もマイページにて対応可能です。

・注文履歴
マイページから、ご予約いただいた一覧を確認することができます。
ご予約の変更・キャンセルもこちらから行えます。

※ご質問などは、下記までにお問い合せいただきます様お願いします。

/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/
Open AIR! BBQ GARDEN　手ぶらでＢＢＱ
　Phone：042-480-5455
　Mail：bbq-village@herofield.com
/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_GRP', '注文完了');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_TITLE', 'ご予約完了のお知らせ[会員用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_SUBJECT', 'ご予約完了のお知らせ');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_BODY', 
'このたびは当社ウェブサイトよりご予約いただき、誠にありがとうございます。
以下の内容でご予約を承りました。

[CUSTOMER_NAME] 様

受付け日時： [DATE_ORDERED]

●ご予約番号
     [BOOKING_NUMBER]
　　　　　※ご予約番号は大切にお控えください。
　　　　　　予約内容の変更、キャンセルの際に必要となります。

●ご利用日
    [BOOKING_INFO]

●ご利用人数
    大人　：[ADULTS] 名
    子供（小学生迄）：[CHILDREN] 名
    未就学児：[BABYES] 名
------------------------------------------------------
     合計 ：[TOTAL] 名 (大人+子供の人数)

●ご利用内容
[PRODUCTS_ORDERED]
------------------------------------------------------
[TOTALS]

●お支払い方法
[PAYMENT_METHOD]

●備考欄
[COMMENT]

＜ご利用上の注意事項＞
[VENUE_TERM]

入場口にて予約番号とお名前を確認させていただきます。
庭園入園の際は、グループの皆さまご一緒にご入場ください。

ご予約ありがとうございます。
当日のご来場をお待ちしております。

※ご質問などは、下記までにお問い合せいただきます様お願いします。

/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/
[VENUE_NAME]
[VENUE_INFO]
/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/');

define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_GRP', '注文完了');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_TITLE', '未使用');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_SUBJECT', 'ご注文ありがとうございます[ゲスト用]');
define('MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_BODY', '');

define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_GRP',     'ユーザ通知');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_TITLE',   'ステータス変更');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_SUBJECT', 'ご注文受付状況のお知らせ');
define('MODULE_EMAIL_TEMPLATE_STATUS_MAIL_BODY', 
'[CUSTOMER_NAME] 様

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
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_SUBJECT', '手ぶらでＢＢＱ　新しいパスワードのご案内');
define('MODULE_EMAIL_TEMPLATE_PASSWORD_FORGOTTEN_MAIL_BODY', 
'[CUSTOMER_NAME] 様

当社ウェブサイトをご利用いただきありがとうございます。


新しいパスワードの申請を受け付けました。

新しいパスワードは

   [NEW_PASSWORD]

です。

新しいパスワードでログインした後
「マイページ」でご希望のパスワードに変更できます。


※ご質問などは、下記までにお問い合せいただきます様お願いします。

/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/
Open AIR! BBQ GARDEN　手ぶらでＢＢＱ
　Phone：042-480-5455
　Mail：bbq-village@herofield.com
/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/＊/');

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
?>