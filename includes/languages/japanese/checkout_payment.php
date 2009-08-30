<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php 3206 2006-03-19 04:04:09Z birdbrain $
 */

define('NAVBAR_TITLE_1', 'レジに進む');
define('NAVBAR_TITLE_2', 'お支払い情報');

define('HEADING_TITLE', 'お支払い情報を記入してください');

define('TABLE_HEADING_BILLING_ADDRESS', 'ご請求先住所');
define('TEXT_SELECTED_BILLING_DESTINATION', 'ご請求先住所は左記の通りです。クレジットカードをご利用の場合はカード会社にご登録の住所と同じ住所にしてください。住所を変更される場合は左の<em>住所の変更</em>をクリックしてください。');
define('TITLE_BILLING_ADDRESS', 'ご請求先住所:');

define('TABLE_HEADING_PAYMENT_METHOD', 'お支払い方法');
define('TEXT_SELECT_PAYMENT_METHOD', 'お支払い方法を選択してください.');
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