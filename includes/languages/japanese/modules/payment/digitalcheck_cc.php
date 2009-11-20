<?php
 /*
  * Copyright (C) 2006 NICOS_CONVENI INC.
  *
  * This program is free software; you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation; either version 2 of the License, or
  * (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with Shigeo; if not, write to the Free Software
  * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
  *
  * $Id$
  */
//

  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TITLE', 'クレジットカード決済(デジタルチェック)');
if (ENABLE_SSL_CATALOG=='true') {
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_DESCRIPTION', 'デジタルチェック クレジットカード決済の機能を提供します。<br/>'
                                                           .'<br/>'
                                                           .'申請時は下記を連絡してください。<br/>'
                                                           .'・決済完了通知URL<br/>'
                                                           .'　'.HTTPS_SERVER.DIR_WS_HTTPS_CATALOG.'extras/digitalcheck_cc_finish_payment.php<br/>'
                                                           .'・決済完了時戻り先URL<br/>'
                                                           .'　'.HTTPS_SERVER.DIR_WS_HTTPS_CATALOG.'index.php?main_page=checkout_process<br/>'
                                                           .'・キャンセル時戻り先URL <br/>'
                                                           .'　'.HTTPS_SERVER.DIR_WS_HTTPS_CATALOG.'index.php?main_page=checkout_payment<br/>'
                                                           );
}
else {
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_DESCRIPTION', 'デジタルチェック クレジットカード決済の機能を提供します。<br/>'
                                                           .'<br/>'
                                                           .'申請時は下記を連絡してください。<br/>'
                                                           .'・決済完了通知URL<br/>'
                                                           .'　'.HTTP_SERVER.DIR_WS_CATALOG.'extras/digitalcheck_cc_finish_payment.php<br/>'
                                                           .'・決済完了時戻り先URL<br/>'
                                                           .'　'.HTTP_SERVER.DIR_WS_CATALOG.'index.php?main_page=checkout_process<br/>'
                                                           .'・キャンセル時戻り先URL <br/>'
                                                           .'　'.HTTP_SERVER.DIR_WS_CATALOG.'index.php?main_page=checkout_payment<br/>'
                                                           );
}
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_NOT_SUCCESS', 'クレジットカードの決済完了通知が取得できませんでした。');
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TIMEOUT', 'クレジットカードの決済タイムアウト');
  define('MODULE_PAYMENT_DIGITALCHECK_CC_MAIL_TIMEOUT', "セッションタイムアウトにより、以下のクレジットカード決済は無効です\n"
                                                       ."取消処理を行ってください\n"
                                                       ."\n"
                                                       ."顧客ID:%d\n"
                                                       ."SID:%s");
?>
