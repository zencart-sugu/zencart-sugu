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

define('MODULE_VISITORS_PURCHASE_TITLE', 'ビジターによる商品購入');
define('MODULE_VISITORS_PURCHASE_DESCRIPTION', '会員登録をしないビジターによる商品購入を可能にします。');
define('MODULE_VISITORS_PURCHASE_STATUS_TITLE', 'ビジターによる商品購入の有効化');
define('MODULE_VISITORS_PURCHASE_STATUS_DESCRIPTION', 'ビジターによる商品購入を有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_TITLE', 'ビジターの注文データを保存しておく日数');
define('MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DESCRIPTION', 'ビジターの注文データを商品購入日から何日間保存するかを設定します。指定した日数を超えると自動的にビジターの注文データがデータベースから削除されます。自動削除しない場合は空欄にします。<br />・初期値 = ' . MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DEFAULT);
define('MODULE_VISITORS_PURCHASE_SORT_ORDER_TITLE', '優先順');
define('MODULE_VISITORS_PURCHASE_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// additional defines login
define('HEADING_NEW_CUSTOMER_WITH_VISITORS', '【初めてのご来店・未登録の方は】<br /> アカウント作成を希望される方は「次へ」ボタンを押してください。');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_WITH_VISITORS', 'この機会に是非ご登録ください!<br />' . STORE_NAME . 'では、一度アカウントを作成していただきますと以降のご利用ではお客様情報などの入力を省くことができ、快適にショッピングを楽しんでいただけます。');
define('HEADING_NEW_VISITORS', '【アカウント作成をせずにお買い物される方】<br /> お客様の情報を入力して「送信」ボタンを押してください。');
define('TEXT_NEW_VISITORS_INTRODUCTION', '' . STORE_NAME . 'では、アカウント作成をされていなくてもお買い物ができます。※マイページなどの会員向けサービスはご利用いただけませんのでご注意ください。');
define('ENTRY_EMAIL_FORMAT','Eメールの形式');

// additional defines checkout_confirmation
define('TEXT_INFO_VISITORS_CREDIT_SELECTION', '%sのご利用には会員登録が必要です。');
define('TEXT_INFO_VISITORS_CREATE_ACCOUNT', '<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">会員登録はこちら</a>');

// additional defines checkout_confirmation
define('HEADING_CUSTOMER_ADDRESS', 'お客様情報');

// additional defines checkout_process
define('EMAIL_TEXT_CUSTOMER_ADDRESS', 'お客様情報');
define('EMAIL_VISITORS_DISCLAIMER', 'このメールは当ショップにご注文いただいたお客様に対してお送りしています。お心当たりが無いようでしたら大変お手数ですがメールにて %s までご連絡ください。');
define('SEND_EXTRA_VISITORS_NEW_ORDERS_EMAILS_TO_SUBJECT','[新規注文] (ビジター)');

// additional defines checkout_success
define('TEXT_INFO_VISITORS_NOTIFY_PRODUCTS', 'お知らせメールの購読には会員登録が必要です。');
define('TEXT_VISITORS_SEE_ORDERS', 'マイページからお客様のご注文履歴をご覧いただけます。');
define('TEXT_INFO_VISITORS_SEE_ORDERS', 'マイページのご利用には会員登録が必要です。');
define('TEXT_VISITOR_TO_ACCOUNT', '未登録の方は');
define('TEXT_VISITOR_TO_ACCOUNT_INTRODUCTION', '
<p class="attention">注文情報からアカウント作成を希望される方は<strong>会員登録（無料）</strong>ボタンを押してください。</p>

<p>今すぐご登録いただきますと現在の注文情報を引き継ぐことが出来ます。この機会に是非ご登録ください!<br />' . STORE_NAME . 'では、一度アカウントを作成していただきますと以降のご利用ではお客様情報などの入力を省くことができ、快適にショッピングを楽しんでいただけます。</p>');

define('TEXT_VISITORS_ORDER', 'ビジターによる注文');
