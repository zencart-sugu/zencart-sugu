<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_send.php 3058 2006-02-21 09:40:07Z birdbrain $
 */

define('HEADING_TITLE', TEXT_GV_NAME . '送信');
define('HEADING_TITLE_CONFIRM_SEND', TEXT_GV_NAME . '送信の確認');
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . 'を送信しました');
define('NAVBAR_TITLE', '' . TEXT_GV_NAME . '送信');
define('EMAIL_SUBJECT', STORE_NAME . 'からのメッセージ');
define('HEADING_TEXT','<br />以下のフォームに' . TEXT_GV_NAME . 'のお受取人情報などをご記入ください。<br/>' . TEXT_GV_NAME . 'についての詳しい情報は<a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '</a>でご覧になれます。<br />');
define('ENTRY_NAME', 'お受取人のお名前:');
define('ENTRY_EMAIL', 'お受取人のEメールアドレス:');
define('ENTRY_MESSAGE', 'メッセージ:');
define('ENTRY_AMOUNT', '金額:');
define('ERROR_ENTRY_TO_NAME_CHECK', 'お受取人のお名前が入力されていません。');
define('ERROR_ENTRY_AMOUNT_CHECK', TEXT_GV_NAME . 'の金額が正しく入力されていません。もう一度やり直して下さい。');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', 'Eメールアドレスが正しく入力されていないようです。もう一度やり直して下さい。');
define('MAIN_MESSAGE', TEXT_GV_NAME . ' %s分を%s様(%s)に送ります。訂正が必要な場合は<strong>編集</strong>ボタンをクリックしてください。<br /><br />送信するメッセージ:<br /><br />');
define('SECONDARY_MESSAGE', '%s 様<br /><br />' . '%sの' . TEXT_GV_NAME . 'が%s様から贈られました。');
define('PERSONAL_MESSAGE', '%s様からのメッセージ:');
define('TEXT_SUCCESS', TEXT_GV_NAME . 'の送信に成功しました。');
define('TEXT_SEND_ANOTHER', '他に' . TEXT_GV_NAME . 'を贈りますか?');
define('TEXT_AVAILABLE_BALANCE',  '現在の残高');

define('EMAIL_GV_TEXT_SUBJECT', '%sさんからのギフト');
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', '' . TEXT_GV_NAME . '(%s)が');
define('EMAIL_GV_FROM', '%s様から' . TEXT_GV_NAME . 'が贈られました。');
define('EMAIL_GV_MESSAGE', 'メッセージ：');
define('EMAIL_GV_SEND_TO', '%s様、こんにちは。');
define('EMAIL_GV_REDEEM', '以下のURLをクリックすると、この' . TEXT_GV_NAME . 'を引き換えることができます。また、当ショップで直接' . TEXT_GV_REDEEM . ': %s を入力していただくことでも引き換えることもできます。' . "\n\n" . '');
define('EMAIL_GV_LINK', '引き換え用URLをクリックしてください。'."\n");
define('EMAIL_GV_VISIT', 'または');
define('EMAIL_GV_ENTER', '' . TEXT_GV_REDEEM . 'を当ショップで入力してください。');
define('EMAIL_GV_FIXED_FOOTER', '上記のURLをクリックしてもうまく' . TEXT_GV_NAME . 'の引き換えができない場合は' . "\n" .
                                'お手数ですがこの' . TEXT_GV_NAME . 'の' . TEXT_GV_REDEEM . 'を当ショップにて入力してください。');
define('EMAIL_GV_SHOP_FOOTER', '');
?>