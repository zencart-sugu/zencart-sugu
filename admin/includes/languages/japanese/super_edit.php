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
//  DESCRIPTION:   Generates a pop-up window to edit    //
//  the selected order information, broken into         //
//  sections: contact, product, history, and total.     //
//////////////////////////////////////////////////////////
// $Id: super_edit.php 25 2006-02-03 18:55:56Z BlindSide $
*/

// include the language file for super_orders.php since they overlap so much
require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_SUPER_ORDERS . '.php');

define('HEADER_EDIT_ORDER', '注文内容の編集 #');
define('HEADER_EDIT_TOTAL', '注文合計の値');
define('HEADER_EDIT_CONTACT', '連絡データ');
define('HEADER_EDIT_HISTORY', '注文履歴');

define('TABLE_HEADING_DELETE_COMMENTS', '削除');
define('ENTRY_NAME', '名前:');
define('ENTRY_ADDRESS', '住所:');
define('ENTRY_POSTCODE', '郵便番号:');
define('ENTRY_CHANGE_CUSTOMER', '異なるお客様へのポイント注文:');

define('BUTTON_CANCEL', '中止');
define('BUTTON_SUBMIT', '送信');

define('TEXT_SPLIT_EXPLAIN', '商品は次の注文番号へ移動しました #');
define('COMMENTS_SPLIT_OLD', 'オーダーは分けられました。  新しいオーダー: ');
define('COMMENTS_SPLIT_NEW', '注文は分割されました。元の注文は: ');

define('NL', "\n");

?>