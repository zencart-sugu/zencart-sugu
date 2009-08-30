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
// $Id: cc.php 2424 2005-11-22 09:25:32Z drbyte $
//

  define('MODULE_PAYMENT_CC_TEXT_TITLE', 'クレジットカード');
  define('MODULE_PAYMENT_CC_TEXT_DESCRIPTION', 'クレジットカードテスト情報:<br /><br />テスト用番号: 4111111111111111<br />有効期限: 任意');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_TYPE', 'クレジットカードタイプ:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_OWNER', 'カード名義:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_NUMBER', 'カード番号:');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_CVV', 'CVV 番号 (<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_CVV_HELP) . '\')">' . '詳しい情報' . '</a>)');
  define('MODULE_PAYMENT_CC_TEXT_CREDIT_CARD_EXPIRES', '有効期限:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_OWNER', '* クレジットカードの名義は' . CC_OWNER_MIN_LENGTH . '文字必要です.\n');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_NUMBER', '* クレジットカード番号は半角数字で' . CC_NUMBER_MIN_LENGTH . '以上必要です。\n');
  define('MODULE_PAYMENT_CC_TEXT_ERROR', 'クレジットカード エラー:');
  define('MODULE_PAYMENT_CC_TEXT_JS_CC_CVV', '* CVV 番号は' . CC_CVV_MIN_LENGTH . '文字以上必要です。\n');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_ERROR','警告 - 設定エラー: ');
  define('MODULE_PAYMENT_CC_TEXT_EMAIL_WARNING','警告: クレジットカード支払いモジュールが有効になっていますが、カード情報をメール送信するように設定されていません。その結果、この方法での注文にカード番号の処理ができない可能性があります。管理画面>モジュール>支払い>クレジットカード>編集でカード情報を送信するEメールアドレスを設定してください。' . "\n\n\n\n");
?>