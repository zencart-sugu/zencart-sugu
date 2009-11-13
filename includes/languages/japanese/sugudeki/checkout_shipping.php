<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_shipping.php 3027 2006-02-13 17:15:51Z drbyte $
 */

define('FLOW', '<img src="'.$images.'flow_checkout_shipping.gif" alt="配送情報の入力" width="688" height="50" />');
define('FLOW_TEXT', '下記の項目をご入力ください。入力が終わりましたら、ページ下の<strong>「お支払い情報の入力へ進む」</strong>ボタンを押してください。');

define('NAVBAR_TITLE_1', 'ご注文手続き');
define('NAVBAR_TITLE_2', '配送情報の入力');

define('HEADING_TITLE', 'ご注文手続き');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'お届け先住所');
define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'ご注文の品物は下記の住所にお届けします。<br />
お届け先を変更するには「お届け先の変更」ボタンを押してください。');
define('TITLE_SHIPPING_ADDRESS', 'お届け先');

define('TABLE_HEADING_SHIPPING_METHOD', '配送方法');
define('TEXT_CHOOSE_SHIPPING_METHOD', 'ご希望の配送方法をお選び下さい。');
define('TITLE_PLEASE_SELECT', '選択してください');
define('TEXT_ENTER_SHIPPING_INFORMATION', '今回のご注文でご利用いただける配送方法はこちらのみです。');

define('TABLE_HEADING_COMMENTS', '注文についてご意見、ご要望などあればご記入ください。');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '次画面に進んでください');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '→お支払い方法を選択');

// when free shipping for orders over $XX.00 is active
  define('FREE_SHIPPING_TITLE', '配送料無料');
  define('FREE_SHIPPING_DESCRIPTION', '%s以上お買い上げの場合、配送料が無料になります。');
?>
