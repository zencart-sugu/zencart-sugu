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
//  $Id: gv_mail.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'ギフト券をメール送付');

define('TEXT_CUSTOMER', '顧客:');
define('TEXT_SUBJECT', '件名:');
define('TEXT_FROM', '差出人email:');
define('TEXT_TO', '宛て先email:');
define('TEXT_AMOUNT', '引き換え額');
define('TEXT_MESSAGE', 'テキスト形式 <br />本文:');
define('TEXT_RICH_TEXT_MESSAGE', 'HTML形式 <br />本文:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">個々にメールを送信するか、上のプルダウンから選択してください。</span>');
define('TEXT_SELECT_CUSTOMER', '顧客を選択');
define('TEXT_ALL_CUSTOMERS', '全ての顧客');
define('TEXT_NEWSLETTER_CUSTOMERS', 'メールマガジンに登録しているすべての顧客');

define('NOTICE_EMAIL_SENT_TO', 'Notice: %sにメールを送信');
define('ERROR_NO_CUSTOMER_SELECTED', 'エラー： 顧客が選択されていません。');
define('ERROR_NO_AMOUNT_SELECTED', 'エラー： 額が選択されていません。');
define('ERROR_NO_SUBJECT', 'エラー： 件名が入力されていません。');
define('ERROR_GV_AMOUNT', '金額を単位抜きで入力してください。例: 500.00');

define('TEXT_GV_ANNOUNCE','<font color="#0000ff">大切なお客様であるあなたに、' . TEXT_GV_NAME . 'を贈呈いたします。</font>');
define('TEXT_GV_WORTH', '' . TEXT_GV_NAME . 'の引換額： ');
define('TEXT_TO_REDEEM', 'この' . TEXT_GV_NAME . 'を引き換えるには、以下のリンクをクリックしてください。動作に問題がある場合は' . TEXT_GV_REDEEM.'をご入力ください。'."\n");
define('TEXT_WHICH_IS', ' ギフト券番号：');
define('TEXT_IN_CASE', ' ');
define('TEXT_OR_VISIT', 'または ');
define('TEXT_ENTER_CODE', ' にて精算時にギフト番号を入力してください。');
define('TEXT_CLICK_TO_REDEEM','金券として利用するためにここをクリックしてください');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', '当ショップでご購入いただいた' . TEXT_GV_NAME . 'はセキュリティのため有効になっておりませんでしたが、ただいまご利用が可能になりました。');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . '' . TEXT_GV_NAME . ' の引換額は%sです。');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . '' . TEXT_GV_NAME . 'は当ショップからメールでどなたにでも贈ることができます。');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");

?>
