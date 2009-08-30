<?php
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// | This source file is subject to version 2.0 of the GPL license,       |
// +----------------------------------------------------------------------+
// | Remise.jp Payment Module V.1.0.2                                     |
// | includes/modules/payment/remisecsp_zen.php                           |
// | Module created by REMISE(www.remise.jp) - 11/28/2006                 |
// | Released under GPL                                                   |
// +----------------------------------------------------------------------+
//
  define('MODULE_PAYMENT_REMISECSP_TEXT_TITLE', 'REMISEコンビニエンスストア決済');
  define('MODULE_PAYMENT_REMISECSP_TEXT_DESCRIPTION', 'REMISECSP');
  define('MODULE_PAYMENT_REMISECSP_TEXT_EXPLAIN','REMISEコンビニエンスストア決済システムを使用します。');
  define('MODULE_PAYMENT_REMISECSP_TEXT_NAME', '氏名:');
  define('MODULE_PAYMENT_REMISECSP_TEXT_KANA', 'フリガナ（全角）:');
  define('MODULE_PAYMENT_REMISECSP_TEXT_INDISPEN', '　（必須）');
  define('MODULE_PAYMENT_REMISECSP_TEXT_TYPE', 'タイプ:');
  define('MODULE_PAYMENT_REMISECSP_TEXT_INPUT_KANA', 'ミニュウリョク');
  define('MODULE_PAYMENT_REMISECSP_TEXT_GOODS_NAME', '商品一式');
  define('MODULE_PAYMENT_REMISECSP_TEXT_GOODS_UNIT', '点');
  define('MODULE_PAYMENT_REMISECSP_TEXT_ERROR_MESSAGE', 'REMISEコンビニエンスストア決済の処理にエラーが発生しました. もう一度試してください.');
  define('MODULE_PAYMENT_REMISECSP_TEXT_ERROR', 'REMISEコンビニエンスストア決済入力 エラー!');
  define('MODULE_PAYMENT_REMISECSP_TEXT_ERROR_INVALID_KANA','フリガナは全角カタカナで入力してください');
  define('MODULE_PAYMENT_REMISECSP_TEXT_ERROR_INVALID_PHONE_NUM','電話番号が不正です。アカウント情報を編集し、電話番号を修正してください');
  define('MODULE_PAYMENT_REMISECSP_TEXT_EMAIL_FOOTER', '');

?>