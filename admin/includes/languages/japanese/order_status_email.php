<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Super Orders allows you to send      //
//  status update e-mails from several different        //
//  locations.  COnsequently the defines for the e-mail //
//  text had to be moved to a standalone location, to   //
//  avoid having the text defined in multiple           //
//  language files.                                     //
//////////////////////////////////////////////////////////
// $Id: order_status_email.php 25 2006-02-03 18:55:56Z BlindSide $
*/

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'ご注文受付状況のお知らせ');
define('EMAIL_TEXT_ORDER_NUMBER', 'ご注文受付番号：');
define('EMAIL_TEXT_INVOICE_URL', 'ご注文についての情報を下記URLでご覧いただけます。：');
define('EMAIL_TEXT_DATE_ORDERED', 'ご注文日：');
define('EMAIL_TEXT_COMMENTS_UPDATE', '<em>コメント：</em>');
define('EMAIL_TEXT_STATUS_UPDATED', 'ご注文状況は次のようになっております。：' . "\n");
define('EMAIL_TEXT_STATUS_LABEL', '現在の受付状況： %s' . "\n\n");
define('EMAIL_TEXT_STATUS_PLEASE_REPLY', 'ご質問などがございましたら、このメールにご返信ください。' . "\n");
?>