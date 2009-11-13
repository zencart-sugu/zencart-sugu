<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php 3206 2006-03-19 04:04:09Z birdbrain $
 */
 
define('FLOW_TEXT', '下記の項目をご入力ください。入力が終わりましたら、ページ下の<strong>「入力内容の確認へ進む」</strong>ボタンを押してください。
');

define('NAVBAR_TITLE_1', 'ご注文手続き');
define('NAVBAR_TITLE_2', 'お支払い情報');

define('HEADING_TITLE', 'ご注文手続き');

define('TABLE_HEADING_BILLING_ADDRESS', 'ご請求先住所');
define('TEXT_SELECTED_BILLING_DESTINATION', '請求書は下記の住所にお送りします。<br />
ご請求先を変更するには「ご請求先の変更」ボタンを押してください。');
define('TITLE_BILLING_ADDRESS', 'ご請求先住所');

define('TABLE_HEADING_PAYMENT_METHOD', 'お支払い方法');
define('TEXT_SELECT_PAYMENT_METHOD', 'ご希望のお支払い方法をお選び下さい。');
define('TITLE_PLEASE_SELECT', '選択してください');
define('TEXT_ENTER_PAYMENT_INFORMATION', '今回のご注文でご利用いただけるお支払い方法はこれだけです。');
define('TABLE_HEADING_COMMENTS', 'ご注文についてご要望などございましたらご記入ください。');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>次画面に進んでください</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '→ご注文の最終確認');

define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">ご利用規約</span>');
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">ご利用規約に同意される場合はチェックボックスをクリックしてください。ご利用規約は<a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><span class="pseudolink">こちら</span></a>でご覧いただけます。');
define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">利用規約に同意します</span>');

define('TEXT_CHECKOUT_AMOUNT_DUE', '合計金額: ');
define('TEXT_YOUR_TOTAL','総額');
?>