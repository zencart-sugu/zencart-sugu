<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//

define('MODULE_VISITORS_TITLE', 'ビジターモジュール');
define('MODULE_VISITORS_DESCRIPTION', 'ビジターモジュール');
define('MODULE_VISITORS_STATUS_TITLE', 'ビジターモジュールの有効化');
define('MODULE_VISITORS_STATUS_DESCRIPTION', 'ビジターモジュールを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_TITLE', 'ビジターの顧客データを保存しておく日数');
define('MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DESCRIPTION', 'ビジターの顧客データを商品購入日から何日間保存するかを設定します。指定した日数を超えると自動的にビジターの顧客データがデータベースから削除されます。自動削除しない場合は空欄にします。<br />・初期値 = ' . MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DEFAULT);
define('MODULE_VISITORS_SORT_ORDER_TITLE', '優先順');
define('MODULE_VISITORS_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('NOT_INCLUDE_VISITORS_ALL_CUSTOMETS', 'ビジターを除く全ての顧客');
define('NOT_INCLUDE_VISITORS_ALL_NEWSLETTER_SUBSCIBERS', 'ビジターを除く全てのメールマガジン購読者');
define('NOT_INCLUDE_VISITORS_DORMANT_CUSTOMERS_LAST_3MONTHS_SUBSCIBERS', 'ビジターを除く休眠中の顧客 (過去３ヶ月超に注文) (メールマガジン購読者のみ)');
define('NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_SUBSCIBERS', 'ビジターを除く過去３ヶ月未満に注文があった活発な顧客 (メールマガジン購読者のみ)');
define('NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_REGARDLESS_OF_SUBSCRIPTION_STATUS', 'ビジターを除く過去３ヶ月未満に注文があった活発な顧客 (メールマガジン購読者でなくとも)');

define('TEXT_VISITORS_ACCOUNT', 'ビジター');
define('BUTTON_IMAGE_VISITOR','button_visitor.gif');

//会員登録
define('MODULE_VISITORS_TABLE_HEADING_NAME', '名前');
define('MODULE_VISITORS_ENTRY_NAME', '姓名（漢字）');
define('MODULE_VISITORS_ENTRY_KANA', '姓名（ひらがな）');
define('MODULE_VISITORS_ENTRY_SAMPLE_01', '半角英数字　例：who@example.co.jp');
define('MODULE_VISITORS_ENTRY_SAMPLE_02', '半角英数字　5文字以上');
define('MODULE_VISITORS_ENTRY_SAMPLE_03', '確認のためもう一度パスワードを入力してください');
define('MODULE_VISITORS_ENTRY_SAMPLE_04', ''); // 例：日本');
define('MODULE_VISITORS_ENTRY_SAMPLE_05', ''); // 例：太郎');
define('MODULE_VISITORS_ENTRY_SAMPLE_06', ''); // 例：にほん');
define('MODULE_VISITORS_ENTRY_SAMPLE_07', ''); // 例：たろう');
define('MODULE_VISITORS_ENTRY_SAMPLE_08', '半角数字・ハイフン(-)あり　例： 123-4567');
define('MODULE_VISITORS_ENTRY_SAMPLE_09', '例： 渋谷区');
define('MODULE_VISITORS_ENTRY_SAMPLE_10', '例： ○○町1-2-3');
define('MODULE_VISITORS_ENTRY_SAMPLE_11', '例： ○○マンション○○○号室');
define('MODULE_VISITORS_ENTRY_SAMPLE_12', '半角数字・ハイフン(-)あり　例： 03-1234-5678');
define('MODULE_VISITORS_ENTRY_SAMPLE_13', '例： 1970/05/21');
define('MODULE_VISITORS_ENTRY_SAMPLE_00', '<a href="http://www.post.japanpost.jp/zipcode/" target="_blank">郵便番号を調べる</a>');

// ひらがなチェック
// ぁ〜ん,゛,゜,ー
define('ENTRY_HIRAKANA_REGEXP',    '/^(\x82[\x9f-\xf1]|\x81[\x4a\x4b\x5b]|'.
                                   '\xa4[\xa1-\xf3]|\xa1[\xab\xac\xbc]|'.
                                   '\xe3\x81[\x81-\xbf]|\xe3\x82[\x9b\x9c]|\xe3\x83\xbc)+$/');
define('ENTRY_HIRAKANA_REGEXP_JS', '/^[ぁ-ん゛゜ー]+$/');
define('ENTRY_HIRAKANA_NOMATCH',   'は全角ひらがなのみ入力できます');

define('MODULE_VISITORS_BUTTON_IMAGE_CHECKOUT_SHIPPING', 'button_checkout_shipping.gif');
define('MODULE_VISITORS_BUTTON_CHECKOUT_SHIPPING_ALT',   '配送情報の入力へ進む');
define('MODULE_VISITORS_BUTTON_IMAGE_REGISTER',          'button_register.gif');
define('MODULE_VISITORS_BUTTON_REGISTER_ALT',            '登録する');
define('MODULE_VISITORS_BUTTON_IMAGE_CHANGE_ORAGE',      'button_change_orage.gif');
define('MODULE_VISITORS_BUTTON_CHANGE_ALT',              '変更する');

