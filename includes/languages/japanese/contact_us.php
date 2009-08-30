<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: contact_us.php 3149 2006-03-10 07:29:34Z birdbrain $
 */

define('HEADING_TITLE', 'お問い合わせ');
define('NAVBAR_TITLE', 'お問い合わせ');
define('TEXT_SUCCESS', 'メッセージが送信されました。');
define('EMAIL_SUBJECT', 'お問い合わせ');

define('ENTRY_NAME', 'お名前:');
define('ENTRY_EMAIL', 'Eメールアドレス:');
define('ENTRY_ENQUIRY', 'メッセージ:');

define('SEND_TO_TEXT','メールを送る:');

define('TABLE_HEADING_PRIVACY_CONDITIONS', '<span class="privacyconditions">個人情報保護方針について</span>');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '<span class="privacydescription">個人情報保護方針に同意される場合はチェックボックスをクリックしてください。内容はこちらでご覧いただけます。</span> <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><u>個人情報保護方針</u></a>.');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">個人情報保護方針に同意する</span>');
define('ENTRY_EMAIL_NAME_CHECK_ERROR','お名前に間違えございませんか？お名前は最低' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字入力してください。');
define('ENTRY_EMAIL_CONTENT_CHECK_ERROR','メッセージの入力がされていないようです。メッセージの欄にお問い合わせ内容を記入して下さい。');
?>