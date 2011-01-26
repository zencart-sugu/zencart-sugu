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
define('HEADING_NEW_CUSTOMER_WITH_VISITORS', '[For first visit or unregistered customers,]<br />If you want to create your account,then press [Next] Button.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_WITH_VISITORS', '
Do not miss the chance!<br />Once you have customer account for ' . STORE_NAME . ', then later enjoy a comfortable shopping without having to enter your customer information.');
define('HEADING_NEW_VISITORS', '【Shopping without creating account】<br /> Enter Your Information and press [Compleete] button.');
define('TEXT_NEW_VISITORS_INTRODUCTION', 'In ' . STORE_NAME . ',You can buy anything without creating an account.However,services for members are not available.');
define('ENTRY_EMAIL_FORMAT','Eメールの形式');

// additional defines checkout_confirmation
define('TEXT_INFO_VISITORS_CREDIT_SELECTION', 'If you want to use [%s] Service,you need to create customer account.');
define('TEXT_INFO_VISITORS_CREATE_ACCOUNT', '<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">Customer Registoration</a>');

// additional defines checkout_confirmation
define('HEADING_CUSTOMER_ADDRESS', 'Cutomer Information');

// additional defines checkout_process
define('EMAIL_TEXT_CUSTOMER_ADDRESS', 'Customer Information');
define('EMAIL_VISITORS_DISCLAIMER', 'このメールは当ショップにご注文いただいたお客様に対してお送りしています。お心当たりが無いようでしたら大変お手数ですがメールにて %s までご連絡ください。');
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
