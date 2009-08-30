<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS - Version 1.0                          //
//                                                      //
//  By Frank Koehl  (fkoehl@gmail.com)                  //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
*/

define('MODULE_PAYMENT_PURCHASE_ORDER_TEXT_TITLE', '発注書');

define('MODULE_PAYMENT_PURCHASE_ORDER_FAX_NUMBER', '856-881-3596');

define('MODULE_PAYMENT_PURCHASE_ORDER_TEXT_DESCRIPTION','
<font size=2 color="red"><b>お読み下さい！<br>重要な支払い情報</b></font><p>
<B>発注書を受け取るまではあなたの注文は処理されません。</B><p>
あなたの支払いを確認するために<br>' . MODULE_PAYMENT_PURCHASE_ORDER_PAYTO . '<br><br>
あるいは <b>署名入りのコピー</b>をFAXでお送り下さればすぐに処理いたします。
あなたの <b>注文番号</b>を確実にご記入下さるか、もしくは注文書のコピー（注文後にお送りしたEメール）をFAXでお送り下さい。<br><br>
FAXの送り先はこちら<b>' . STORE_FAX . '</b>.
');

define('MODULE_PAYMENT_PURCHASE_ORDER_TEXT_EMAIL_FOOTER', "
重要な支払い情報 \n
発注書を受け取るまではあなたの注文は処理されません。 \n
あなたの支払いを確認するために" . "\n" . MODULE_PAYMENT_PURCHASE_ORDER_PAYTO . " \n
あなたの支払い状況を次のアドレスまで、E-mailでお送り下さい。 \n" . STORE_NAME_ADDRESS . " \n
あるいは、署名入りのコピーをFAXでお送り下さればすぐに処理いたします。
あなたの注文番号を確実にご記入下さるか、もしくは注文書のコピーを添えてFAXでお送り下さい。 \n
FAXの送り先はこちら" . STORE_FAX);
?>