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
//  $Id: mail.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_TITLE', '顧客へのメール送信');

define('TEXT_CUSTOMER', '顧客:');
define('TEXT_SUBJECT', '件名:');
define('TEXT_FROM', '差出人:');
define('TEXT_MESSAGE', 'テキスト <br />本文:');
define('TEXT_MESSAGE_HTML','HTML（リッチテキスト） <br />本文:');
define('TEXT_SELECT_CUSTOMER', '顧客を選択');
define('TEXT_ALL_CUSTOMERS', '全ての顧客');
define('TEXT_NEWSLETTER_CUSTOMERS', 'メールマガジン登録者');
define('TEXT_ATTACHMENTS_LIST','選択された添付書類: ');
define('TEXT_SELECT_ATTACHMENT','サーバ上の<br />添付書類: ');
define('TEXT_SELECT_ATTACHMENT_TO_UPLOAD','アップロードする<br />添付書類<br />&amp; attach: ');
define('TEXT_ATTACHMENTS_DIR','アップロード用フォルダ: ');

define('NOTICE_EMAIL_SENT_TO', 'Notice: %s にメールを送信しました。');
define('ERROR_NO_CUSTOMER_SELECTED', 'エラー: 選択された顧客は存在しません。');
define('ERROR_NO_SUBJECT', 'エラー: 件名が入力されていません。');
define('ERROR_ATTACHMENTS', 'エラー: 添付書類を、アップロードと追加の両方行うことはできません。どちらか一つだけ選んでください。');
?>