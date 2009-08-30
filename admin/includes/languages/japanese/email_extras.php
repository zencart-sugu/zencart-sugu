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
// $Id: email_extras.php 2081 2005-10-03 05:34:18Z ajeh $
//

// office use only
  define('OFFICE_FROM','差出人:');
  define('OFFICE_EMAIL','メールアドレス:');

  define('OFFICE_SENT_TO','宛て先:');
  define('OFFICE_EMAIL_TO','メールアドレス:');
  define('OFFICE_USE','会社での利用のみ:');
  define('OFFICE_LOGIN_NAME','ログイン名:');
  define('OFFICE_LOGIN_EMAIL','ログインメールアドレス:');
  define('OFFICE_LOGIN_PHONE','<strong>電話:</strong>');
  define('OFFICE_IP_ADDRESS','IPアドレス:');
  define('OFFICE_HOST_ADDRESS','ホスト名:');
  define('OFFICE_DATE_TIME','日付・時間:');

  define('EMAIL_GREET', '様');

// email disclaimer
  define('EMAIL_DISCLAIMER', 'このメールアドレスは、あなたもしくはあなたのお客様からいただいたものです。このメールに心当たりがない方は、お手数ですが %s までお知らせください。');
  define('EMAIL_SPAM_DISCLAIMER','このメールは、US CAN-SPAM Law in effect 01/01/2004に準拠して送信されました。購読削除を希望される場合は、差出人アドレスにリクエストいただければ速やかに対処いたします。');
  define('EMAIL_FOOTER_COPYRIGHT','Copyright &copy; 2004 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>. Powered by <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a>');
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[ギフト券]');
  define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[クーポン券]');
  define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[ご注文状況]');
  define('TEXT_UNSUBSCRIBE', "\n\nこのメールマガジンとショップからのお知らせを購読解除するには以下のリンクをクリック: \n");

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', '不可能');
?>