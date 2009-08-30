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
// $Id: gv_faq.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE', TEXT_GV_NAME . 'についてよくある質問と答え');
define('HEADING_TITLE', TEXT_GV_NAME . 'についてよくある質問と答え');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">' . TEXT_GV_NAMES . 'を購入するには</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">' . TEXT_GV_NAMES . 'を贈るには</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">' . TEXT_GV_NAMES . 'をショッピングに使うには</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">' . TEXT_GV_NAMES . 'を使うには [贈られた方向け]</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">問題が起きたときは</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE',TEXT_GV_NAMES . 'を購入するには');
define('SUB_HEADING_TEXT', TEXT_GV_NAMES . 'は当ショップの他の商品と同様にお求めいただけます。<br />当ショップが提供している通常の方法でお支払いができ、お求めいただいた' . TEXT_GV_NAME . 'の金額はお客様の' . TEXT_GV_NAME . 'アカウントに追加されます。<br />お客様の' . TEXT_GV_NAME . 'アカウントに残高がある場合はショッピングカート欄に表示され、メールで' . TEXT_GV_NAME . 'を贈るためのリンクも表示されます。');
  break;
  case '2':
define('SUB_HEADING_TITLE',TEXT_GV_NAMES . 'を贈るには');
define('SUB_HEADING_TEXT',TEXT_GV_NAME . 'を贈るためには、各ページのショッピングカート欄からリンクされた' . TEXT_GV_NAME . '送信ページに行き、下記の項目を記入していただきます。<br />
' . TEXT_GV_NAME . 'を受け取られる方のお名前<br />
' . TEXT_GV_NAME . 'を受け取られる方のメールアドレス<br />
お贈りになる金額 (注意: ' . TEXT_GV_NAME . ' アカウントにある全額を贈る必要はありません)<br />
メールに添えるメッセージ<br /><br />
実際に送信する前に確認・変更できますが、全ての情報を正確にご入力ください。');
  break;
  case '3':
  define('SUB_HEADING_TITLE',TEXT_GV_NAMES . 'をショッピングに使うには');
  define('SUB_HEADING_TEXT','お客様の' . TEXT_GV_NAME . 'アカウントに残高がある場合、当ショップでのお買い物にお使いいたけます。<br />お支払い方法を選択する際に' . TEXT_GV_NAME . 'の記入欄が表示されますので、' . TEXT_GV_NAME . 'アカウントの残高からお使いになる金額を入力して下さい。アカウントの残高がご注文金額に足りない場合は、他のお支払い方法も選択していただく必要がありますのでご注意ください。<br />
ご注文の総額よりも' . TEXT_GV_NAME . 'アカウントの残高が多い場合には、アカウントに差引残高が表示されます。');
  break;
  case '4':
  define('SUB_HEADING_TITLE',TEXT_GV_NAMES . 'を使うには [贈られた方向け]');
  define('SUB_HEADING_TEXT','メールで' . TEXT_GV_NAME . 'を受け取られた場合には、メール内に' . TEXT_GV_NAME . 'の送信者情報が記載されているでしょう。また、メール内には' . TEXT_GV_NAME . '' . TEXT_GV_REDEEM . 'が記載されているはずです。後の参照用にメールを印刷しておくとよいでしょう。<br />
' . TEXT_GV_NAME . 'を引き換えるには2つの方法があります。<br /><br />
 1. とりあえず引き換えるだけでしたら、メールに記載されているリンクをクリックすると当店の' . TEXT_GV_NAME . '引き換えページに飛びます。ログインするか、当ショップのご利用が初めての場合は当ショップのアカウントをお作りいただいた後で、' . TEXT_GV_NAME . 'を有効にしてお客様用の' . TEXT_GV_NAME . 'アカウントをご用意させていただきます。<br />
 2. ショッピングご精算の手続き中、お支払い方法を選択するページ内に' . TEXT_GV_REDEEM . 'を入力する欄があります。ここに' . TEXT_GV_REDEEM . 'を入力して引き換えボタンを押して下さい。コードが有効になると、' . TEXT_GV_NAME . 'アカウントに入金が行われます。残高の範囲内でご自由にお使いいただけます。');
  break;
  case '5':
  define('SUB_HEADING_TITLE','問題が起きたときは');
  define('SUB_HEADING_TEXT','' . TEXT_GV_NAME . 'システムをご利用中に何か問題がございましたら、'. STORE_OWNER_EMAIL_ADDRESS . 'までメールでご連絡ください。 <br />
その際には、迅速な問題解決のためにできるだけ詳しく(「どの画面で」「どんな操作をした」など)状況をお知らせいただくよう願いいたします。 ');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','上の質問の中からお選びください');

  }
?>