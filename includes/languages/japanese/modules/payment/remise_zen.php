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
// | This source file is subject to version 2.0 of the GPL license,       |
// +----------------------------------------------------------------------+
// | Remise.jp Payment Module V.1.0.2                                    |
// | includes/languages/japanese/modules/payment/remise_zen.php           |
// | Module created by REMISE(www.remise.jp) - 11/28/2006                 |
// | Released under GPL                                                   |
// +----------------------------------------------------------------------+

	define('MODULE_PAYMENT_REMISE_TEXT_TITLE', 'REMISEクレジットカード決済');
	define('MODULE_PAYMENT_REMISE_TEXT_DESCRIPTION', 'REMISE(www.remise.jp)');
	define('MODULE_PAYMENT_REMISE_TEXT_EXPLAIN','REMISEクレジットカード決済システムを使用します。手続きの最終画面でクレジットカード情報を入力します。');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_OWNER', 'クレジットカード所有者:');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_OWNER_ROMA', 'クレジットカード所有者(半角英数ローマ字):');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_NUMBER', 'クレジットカード番号:');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_CARD_EXPIRES', 'クレジットカード有効期限:');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD', '支払い方法:');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_REVO', 'リボ払い');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ESPAY', '分割払い（２回払い）');
	define('MODULE_PAYMENT_REMISE_TEXT_CREDIT_METHOD_ONE', '一括払い'); 
	define('MODULE_PAYMENT_REMISE_TEXT_TYPE', 'タイプ:');
	define('MODULE_PAYMENT_REMISE_TEXT_JS_CC_NUMBER', '* クレジットカード番号は少なくても ' . CC_NUMBER_MIN_LENGTH . ' 文字以上必要です。');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_MESSAGE', 'クレジットカードの処理中にエラーが発生しました. 入力内容を訂正しもう一度試してください。　');
	define('MODULE_PAYMENT_REMISE_TEXT_CC_NAME', 'クレジットカード所有者名は、半角英数２文字以上で入力してください。　');
	define('MODULE_PAYMENT_REMISE_TEXT_CC_INVALID_DATE', 'クレジットカードの有効期限が正しくありません。ご確認後もう一度入力してください。　');
	define('MODULE_PAYMENT_REMISE_TEXT_CC_INVALID_NUMBER', 'クレジットカード番号が有効ではありません。ご確認後もう一度入力してください。　');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR', 'クレジットカード エラー!');
	define('MODULE_PAYMENT_REMISE_TEXT_EMAIL_FOOTER', '');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_C14', '取り扱い不可（カード会社へお問い合わせください）');	
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G03', '限度額オーバー（カード会社へお問い合わせください）');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G12', '取り扱い不可（カード会社へお問い合わせください）');  
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G30', 'このカードは現在使用できません（カード会社へお問い合わせください）');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G54', '取り扱い不可（カード会社へお問い合わせください）'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G55', '限度額オーバー（カード会社へお問い合わせください）'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G56', '使用出来ないカード会社です');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G60', '使用出来ないカードです');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G65', 'カード番号でエラーになりました。カード番号を確かめて再度お手続きをお願いします。');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G78', '支払い方法でエラーになりました。他の支払い方法を選択してください。');  
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G83', '有効期限エラー');
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G97', '取り扱い不可（カード会社へお問い合わせください）'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_G99', '取り扱い不可（カード会社へお問い合わせください）'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_31003', 'カード番号に誤りがあります。カード番号を確かめて再度お手続きをお願いします。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_31005', 'カード番号に誤りがあります。このカードはお取り扱いできません。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H12_32006', 'カード番号に誤りがあります。カード番号を確かめて再度お手続きをお願いします。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_22001', '使用できないカード会社です。管理者へお問い合わせください'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_42101', '実売上エラー（仮売上なし）。該当する仮売上がありません。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45003', '取消エラー（履歴がありません）'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45004', '取消エラー（二重取り消し）。該当データは既に取り消し済みです。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_H97_45005', ''); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_P90', '使用できないカード会社です。管理者へお問い合わせください'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_S01', 'カード会社のホストエラーです。しばらくしてから再度ご購入手続きをしてください。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_S99_9910', 'セッションの有効期限切れです。再度ご購入手続きをお願いします。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_S99_9940', '重複した受付です。ブラウザを閉じて再度ご購入手続きをお願いします。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_X51', 'カード会社のシステムエラーです。しばらくしてから再度ご購入手続きをしてください。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_X53', 'カード会社のシステムエラーです。しばらくしてから再度ご購入手続きをしてください。'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_X65', 'カード会社のシステムエラーです。しばらくしてから再度ご購入手続きをしてください。'); 
	define('MODULE_PAYMENT_REMISE_MAIL_FUTEIKANN', '＊この商品は不定貫商品となります'); 
	define('MODULE_PAYMENT_REMISE_TEXT_ERROR_LOW', 'この金額ではクレジットカード決済はご利用できません。他の決済方法を選択してください。'); 
?>