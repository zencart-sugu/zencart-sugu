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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE',       '管理画面シンプル設定');

define('TEXT_INFORMATION',    '管理画面各項目の表示、非表示を設定してください');

define('TEXT_DISPLAY',        '表示する');
define('TEXT_CHANGE',         '変更しない');

define('TEXT_UPDATE',         '更新');
define('TEXT_UPDATE_SUCCESS', '設定しました');

// 以下表示項目の定義
// 番号は連番の必要があります
// type:D 表示,非表示
// type:C 変更,従来
$easy_admin_simplify_config   = array();
$easy_admin_simplify_config[] = array(
  'title' => 'カテゴリ管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'CATEGORY_LANGUAGE',          'description'=>'日本語以外の入力項目'),
    array('type'=>'D', 'key'=>'CATEGORY_PRICE_LINK',        'description'=>'商品価格管理へのリンク'),
    array('type'=>'D', 'key'=>'CATEGORY_PRODUCT_TYPE',      'description'=>'新規商品の商品種類プルダウン'),
    array('type'=>'C', 'key'=>'CATEGORY_PRODUCT_ATTRIBUTE', 'description'=>'商品オプションへのリンク'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '商品管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'PRODUCT_LANGUAGE',             'description'=>'日本語以外の入力項目'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_ATTRIBUTE',      'description'=>'商品属性による価格'),
    array('type'=>'D', 'key'=>'PRODUCT_TAX_CLASS',            'description'=>'税種別'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_GROSS',          'description'=>'商品価格（グロス）'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_FREE',           'description'=>'無料商品'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_CALL',           'description'=>'価格お問い合わせ'),
    array('type'=>'D', 'key'=>'PRODUCT_VIRTUAL',              'description'=>'ヴァーチャル商品'),
    array('type'=>'D', 'key'=>'PRODUCT_ALWAYS_FREE_SHIPPING', 'description'=>'常に送料無料'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_MAX',   'description'=>'商品の最小数量'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_MIN',   'description'=>'商品の最大数量'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_UNIT',  'description'=>'商品の数量単位'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_MIXED',       'description'=>'最小数量/単位ミックス'),
    array('type'=>'D', 'key'=>'PRODUCT_WEIGHT',               'description'=>'商品重量'),
    array('type'=>'D', 'key'=>'PRODUCT_NUMBER_UNIT',          'description'=>'小数点'),
    array('type'=>'D', 'key'=>'PRODUCT_META_TAGS_USAGE',      'description'=>'メタタグでの注意書き'),
    array('type'=>'D', 'key'=>'PRODUCT_CATEGORY_MANAGER',     'description'=>'複数のカテゴリがマネージャをリンク'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '注文ステータス設定',
  'item'  => array(
    array('type'=>'D', 'key'=>'ORDER_STATUS_LANGUAGE', 'description'=>'日本語以外の入力項目'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '顧客管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'CUSTOMERS_GROUP_PRICING', 'description'=>'グループ割引'),
    array('type'=>'D', 'key'=>'CUSTOMERS_REFERRAL',      'description'=>'割引券贈呈'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'メーカーの管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'MANUFACTURERS_LANGUAGE', 'description'=>'日本語以外の入力項目'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '特価商品の管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'SPECIALS_PRICE_LINK',  'description'=>'価格の管理へのリンク'),
    array('type'=>'D', 'key'=>'SPECIALS_EDIT_LINK',   'description'=>'編集へのリンク'),
    array('type'=>'D', 'key'=>'SPECIALS_PRE_ADD',     'description'=>'選択へのリンク'),
    array('type'=>'D', 'key'=>'SPECIALS_NUMBER_UNIT', 'description'=>'小数点'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'おすすめ商品の管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'FEATURED_PRICE_LINK', 'description'=>'価格の管理へのリンク'),
    array('type'=>'D', 'key'=>'FEATURED_EDIT_LINK',  'description'=>'編集へのリンク'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '商品オプション名の管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'OPTIONS_NAME_LANGUAGE',   'description'=>'日本語以外の入力項目'),
    array('type'=>'D', 'key'=>'OPTIONS_NAME_BIG_MODIFY', 'description'=>'一連の大きな変更'),
    array('type'=>'D', 'key'=>'OPTIONS_NAME_LENGTH',     'description'=>'テキスト属性の長さ'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '商品オプション値の管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_LANGUAGE', 'description'=>'日本語以外の入力項目'),
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_COPY',     'description'=>'コピー操作'),
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_COPIER',   'description'=>'おすすめ商品プルダウン'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '商品オプション属性の管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_MODIFY',       'description'=>'商品および価格編集ボタン'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_CATEGORY',     'description'=>'複数カテゴリのリンク管理へのリンク'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_NUMBER_UNIT',  'description'=>'小数点'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_WEIGHT',       'description'=>'属性の重量'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_ONETIME',      'description'=>'属性のワンタイム値引き'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRICE_FACTOR', 'description'=>'属性のプライスファクター'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_QTY_PRICES',   'description'=>'数量値引き'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRICE_WORDS',  'description'=>'単語/文字値引き'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_FLAGS',        'description'=>'属性フラグ'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_IMAGE',        'description'=>'オプション画像'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_CATEGORIES',   'description'=>'カテゴリ選択プルダウン'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRODUCTS',     'description'=>'商品選択プルダウン'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_LEGEND',       'description'=>'属性凡例'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_COLUMN',       'description'=>'重量,属性,値引き列'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'バナーの管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'BANNER_MANAGER_NEW_GROUP',    'description'=>'新しいバナー'),
    array('type'=>'D', 'key'=>'BANNER_MANAGER_IMAGE_LOCAL',  'description'=>'画像ファイル名を入力'),
    array('type'=>'D', 'key'=>'BANNER_MANAGER_IMAGE_TARGET', 'description'=>'画像の保存先'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'ショップ全般の設定',
  'item'  => array(
    array('type'=>'D', 'key'=>'CONFIGURATION_1_2',  'description'=>'ショップオーナー名'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_5',  'description'=>'入荷予定商品のソート順'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_6',  'description'=>'入荷予定商品のソート順に用いるフィールド'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_7',  'description'=>'表示言語と通貨の連動'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_8',  'description'=>'表示言語の選択'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_10', 'description'=>'商品の追加後にカートを表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_11', 'description'=>'デフォルトの検索演算子'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_13', 'description'=>'カテゴリ内の商品数を表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_14', 'description'=>'税額の小数点位置'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_15', 'description'=>'価格を税込みで表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_16', 'description'=>'価格を税込みで表示 - 管理画面'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_17', 'description'=>'商品にかかる税額の算定基準'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_18', 'description'=>'送料にかかる税額の算定基準'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_19', 'description'=>'税金の表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_23', 'description'=>'ショップのステータス'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_20', 'description'=>'管理画面のタイムアウト設定(秒数)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_21', 'description'=>'管理画面のプログラム処理の上限時間設定(秒)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_22', 'description'=>'Zen Cart新バージョンの自動チェック(ヘッダで告知するか否か)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_24', 'description'=>'サーバの稼動時間(アップタイム)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_25', 'description'=>'リンク切れページのチェック'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_26', 'description'=>'HTMLエディタ'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_27', 'description'=>'phpBBへのリンクを表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_28', 'description'=>'カテゴリ内の商品数を表示 - 管理画面'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'メールの設定',
  'item'  => array(
    array('type'=>'D', 'key'=>'CONFIGURATION_12_206', 'description'=>'メール送信 - 接続方法'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_212', 'description'=>'メールの改行コード'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_213', 'description'=>'メール送信にMIME HTMLを使用'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_214', 'description'=>'メールアドレスをDNSで確認'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_215', 'description'=>'メールを送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_216', 'description'=>'メール保存の設定'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_217', 'description'=>'メール送信エラーの表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_220', 'description'=>'送信メールの送信元アドレスの実在性'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_221', 'description'=>'管理者が送信するメールフォーマット'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_227', 'description'=>'ギフト券送付メール(コピー)の送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_228', 'description'=>'ギフト券送付メール(コピー)の送信先'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_229', 'description'=>'ショップ運営者からのギフト券送付メール(コピー)の送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_230', 'description'=>'ショップ運営者からのギフト券送付メール(コピー)の送信先'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_231', 'description'=>'ショップ運営者からのクーポン券送付メール(コピー)の送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_232', 'description'=>'ショップ運営者からのクーポン券送付メール(コピー)の送信先'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_233', 'description'=>'ショップ運営者の注文ステータスメール(コピー)の送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_234', 'description'=>'ショップ運営者の注文ステータスメール(コピー)の送信先'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_235', 'description'=>'掲載待ちレビューについてメール送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_236', 'description'=>'掲載待ちレビューについてのメール送信先'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_237', 'description'=>'「お問い合わせ」メールのドロップダウン設定'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_238', 'description'=>'ゲストに「友達に知らせる」機能を許可'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_239', 'description'=>'「お問い合わせ」にショップ名と住所を表記'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_240', 'description'=>'在庫わずかになったらメール送信'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_242', 'description'=>'「メールマガジンの購読解除」リンクの表示'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_243', 'description'=>'オンラインユーザー数の表示設定'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_207', 'description'=>'SMTP認証 - メールアカウント'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_208', 'description'=>'SMTP認証 - パスワード'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_209', 'description'=>'SMTP認証 - DNS名'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_210', 'description'=>'SMTP認証 - IPポート番号'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_211', 'description'=>'テキストメールでの貨幣の変換'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => '注文合計モジュールの設定',
  'item'  => array(
    array('type'=>'D', 'key'=>'MODULES_OT_SHIPPING', 'description'=>'配送モジュール'),
    array('type'=>'D', 'key'=>'MODULES_OT_SUBTOTAL', 'description'=>'小計モジュール'),
    array('type'=>'D', 'key'=>'MODULES_OT_TOTAL',    'description'=>'合計モジュール'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Super orders',
  'item'  => array(
    array('type'=>'D', 'key'=>'SUPER_ORDERS_PAYMENT',     'description'=>'支払情報'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_FINAL',       'description'=>'注文最終設定'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_SPLIT',       'description'=>'梱包を分割'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_PRODUCTS',    'description'=>'商品を修正'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_NUMBER_UNIT', 'description'=>'小数点'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'セールの管理',
  'item'  => array(
    array('type'=>'D', 'key'=>'SALEMAKER_NUMBER_UNIT', 'description'=>'小数点'),
  )
);
?>