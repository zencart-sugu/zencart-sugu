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
//  $Id: gv_queue.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '承認待ち' . TEXT_GV_NAME);

define('TABLE_HEADING_CUSTOMERS', '顧客');
define('TABLE_HEADING_ORDERS_ID', '注文番号.');
define('TABLE_HEADING_VOUCHER_VALUE', TEXT_GV_NAME . ' 額');
define('TABLE_HEADING_DATE_PURCHASED', '購入日');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_REDEEM_GV_MESSAGE_HEADER', '当Webサイトにてご購入いただいた' . TEXT_GV_NAME);
define('TEXT_REDEEM_GV_MESSAGE_RELEASED', 'セキュリティ管理プロセスのためすぐに有効にはなりませんでしたが、' .
                                          'ただ今ご利用開始の処理が完了いたしました。当店にてご自身でご利用いただくことができる他、メールにてどなたにでも贈ることができます。' . "\n\n"
                                          );

define('TEXT_REDEEM_GV_MESSAGE_AMOUNT', 'ご購入いただきました' . TEXT_GV_NAME . 'の引換額は%sです。');
define('TEXT_REDEEM_GV_MESSAGE_THANKS', '当店をご利用いただき、誠にありがとうございます。');

define('TEXT_REDEEM_GV_MESSAGE_BODY', '');
define('TEXT_REDEEM_GV_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_GV_SUBJECT', TEXT_GV_NAME . ' ご購入');
define('TEXT_REDEEM_GV_SUBJECT_ORDER',' ご注文番号');

define('TEXT_EDIT_ORDER','ご注文番号を編集する');
define('TEXT_GV_NONE','有効化する' . TEXT_GV_NAME . 'はありません。');

define('ERROR_MAX_GIFT_AMOUNT_EXCEEDED','ギフト券残高が'.MAX_GIFT_AMOUNT.'を超えるので引き換えできません。');
?>
