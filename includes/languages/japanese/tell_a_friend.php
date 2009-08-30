<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tell_a_friend.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('NAVBAR_TITLE', '友達に教える');

define('HEADING_TITLE', '%sについて友達に教える');

define('FORM_TITLE_CUSTOMER_DETAILS', 'お客様');
define('FORM_TITLE_FRIEND_DETAILS', 'お友達');
define('FORM_TITLE_FRIEND_MESSAGE', 'メッセージ:');

define('FORM_FIELD_CUSTOMER_NAME', 'お客様のお名前:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'お客様のメールアドレス:');
define('FORM_FIELD_FRIEND_NAME', 'お友達のお名前:');
define('FORM_FIELD_FRIEND_EMAIL', 'お友達のメールアドレス:');

define('EMAIL_SEPARATOR', '------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT', '<strong>%s</strong>についてのおすすめメールを<strong>%s</strong>様に送信しました。');

define('EMAIL_TEXT_HEADER','重要!');

define('EMAIL_TEXT_SUBJECT', 'お友達の%s様が%sの商品をお薦めです');
define('EMAIL_TEXT_GREET', '%s様' . "\n\n");
define('EMAIL_TEXT_INTRO', 'お友達の%s様が下記の商品をお薦めになっています。' . "\n\n" . '□ 商品名：%s' . "\n" . '□ 取扱ショップ：%s)');

define('EMAIL_TELL_A_FRIEND_MESSAGE','%s様からのメッセージ:');

define('EMAIL_TEXT_LINK', 'この商品を見るには下記のリンクをクリックするか、' . "\n" . 'ウェブブラウザにURLをコピー＆ペーストしてください:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', 'よろしくお願いいたします。' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'エラー: お友達のお名前を入力してください。');
define('ERROR_TO_ADDRESS', 'エラー: お友達のEメールアドレスが正しくないようです。もう一度入力してください。');
define('ERROR_FROM_NAME', 'エラー: お客様ご自身のお名前を入力してください。');
define('ERROR_FROM_ADDRESS', 'エラー: お客様のEメールアドレスが正しくないようです。もう一度入力してください。');
?>
