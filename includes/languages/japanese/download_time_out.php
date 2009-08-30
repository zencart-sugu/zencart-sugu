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
// $Id: download_time_out.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE', 'ダウンロード ...');
define('HEADING_TITLE', 'ダウンロード ...');

define('TEXT_INFORMATION', 'あいにくこのダウンロード商品はダウンロード有効期限が切れています。他にダウンロードする商品があるようでしたら<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">マイページ</a>でご注文をご確認ください。<br /><br />
  万が一ご注文の不具合と思われる場合はお手数ですが<a href="' . zen_href_link(FILENAME_CONTACT_US) . '">こちら</a>からお問い合わせ下さい。<br /><br />
  ご利用ありがとうございます。
  ');
?>