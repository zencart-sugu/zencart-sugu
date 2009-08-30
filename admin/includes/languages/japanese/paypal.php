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
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: paypal.php 3016 2006-02-12 05:26:46Z ajeh $
//

  // sort orders
  define('TEXT_PAYPAL_IPN_SORT_ORDER_INFO', '注文を表示する: ');
  define('TEXT_SORT_PAYPAL_ID_DESC', '受け取ったPayPalの注文(新しいもの - 古いもの)');
  define('TEXT_SORT_PAYPAL_ID', '受け取ったPayPalの注文(古いもの - 新しいもの)');
  define('TEXT_SORT_ZEN_ORDER_ID_DESC', '注文 ID (降順), 受け取ったPayPalの注文');
  define('TEXT_SORT_ZEN_ORDER_ID', '注文 ID (昇順), 受け取ったPayPalの注文');
  define('TEXT_PAYMENT_AMOUNT_DESC', '注文の総量（降順)');
  define('TEXT_PAYMENT_AMOUNT', '注文の総量（昇順)');

  //begin ADMIN text
  define('HEADING_ADMIN_TITLE', 'PayPal Instant Paymentの通知');
  define('HEADING_PAYMENT_STATUS', '支払いのステータス');
  define('TEXT_ALL_IPNS', '全て');

  define('TABLE_HEADING_ORDER_NUMBER', '注文番号');
  define('TABLE_HEADING_PAYPAL_ID', 'PayPalの番号');
  define('TABLE_HEADING_TXN_TYPE', '処理のタイプ');
  define('TABLE_HEADING_PAYMENT_STATUS', '支払いのステータス');
  define('TABLE_HEADING_PAYMENT_AMOUNT', '総量');
  define('TABLE_HEADING_ACTION', 'アクション');
  define('TABLE_HEADING_DATE_ADDED', '追加日時');
  define('TABLE_HEADING_NUM_HISTORY_ENTRIES', 'ステータスの履歴の中のエントリー数');
  define('TABLE_HEADING_ENTRY_NUM', 'エントリー数');
  define('TABLE_HEADING_TRANS_ID', '処理ID');



  define('TEXT_INFO_PAYPAL_IPN_HEADING', 'PayPal IPN');
  define('TEXT_DISPLAY_NUMBER_OF_TRANSACTIONS', '(<strong>%d</strong> IPNの)<strong>%d</strong> から <strong>%d</strong>を表示中');

  //Details section
  define('HEADING_DEATILS_CUSTOMER_REGISTRATION_TITLE', 'PayPal 顧客登録の詳細');
  define('HEADING_DETAILS_REGISTRATION_TITLE', 'PayPal Instant Paymentの通知');
  define('TEXT_INFO_ENTRY_ADDRESS', '住所');
  define('TEXT_INFO_ORDER_NUMBER', '注文番号');
  define('TEXT_INFO_TXN_TYPE', '処理のタイプ');
  define('TEXT_INFO_PAYMENT_STATUS', '支払いのステータス');
  define('TEXT_INFO_PAYMENT_AMOUNT', '総量');
  define('ENTRY_FIRST_NAME', '名');
  define('ENTRY_LAST_NAME', '姓');
  define('ENTRY_BUSINESS_NAME', 'ビジネスネーム');
  define('ENTRY_ADDRESS', '住所');
  //EMAIL ALREADY DEFINED IN ORDERS
  define('ENTRY_PAYER_ID', '支払い者のID');
  define('ENTRY_PAYER_STATUS', '支払い者のステータス');
  define('ENTRY_ADDRESS_STATUS', '住所のステータス');
  define('ENTRY_PAYMENT_TYPE', '支払いのタイプ');
  define('TABLE_HEADING_ENTRY_PAYMENT_STATUS', '支払いのステータス');
  define('TABLE_HEADING_PENDING_REASON', 'ペンディングの理由');
  define('TABLE_HEADING_IPN_DATE', 'IPNの日時');
  define('ENTRY_INVOICE', '内訳');
  define('ENTRY_PAYPAL_IPN_TXN', '処理ID');
  define('ENTRY_PAYMENT_DATE', '支払い日時');
  define('ENTRY_PAYMENT_LAST_MODIFIED', '最終更新日');
  define('ENTRY_MC_CURRENCY', 'MCの通貨');
  define('ENTRY_MC_GROSS', 'MCの合計');
  define('ENTRY_MC_FEE', 'MCのフィー');
  define('ENTRY_PAYMENT_GROSS', '支払額合計');
  define('ENTRY_PAYMENT_FEE', '支払いフィー');
  define('ENTRY_SETTLE_AMOUNT', '清算の合計');
  define('ENTRY_SETTLE_CURRENCY', '清算の通貨');
  define('ENTRY_EXCHANGE_RATE', '換金レート');
  define('ENTRY_CART_ITEMS', 'カート内のアイテム数');
  define('ENTRY_CUSTOMER_COMMENTS', '顧客のコメント');
  define('TEXT_NO_IPN_HISTORY', 'IPNの履歴は参照できません');
  define('TEXT_TXN_SIGNATURE', '処理の署名');
  //end ADMIN text
?>
