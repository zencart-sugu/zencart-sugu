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
//  $Id: categories.php 2847 2006-01-13 07:40:50Z drbyte $
//

define('HEADING_TITLE', 'カテゴリ・商品の管理');
define('HEADING_TITLE_GOTO', 'ジャンプ:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'カテゴリ / 商品');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'Sort');

define('TABLE_HEADING_PRICE','価格/特価/セール');
define('TABLE_HEADING_QUANTITY','数量');

define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_STATUS', 'ステータス');

define('TEXT_CATEGORIES', 'カテゴリ:');
define('TEXT_SUBCATEGORIES', 'サブカテゴリ:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_PRICE_INFO', '価格:');
define('TEXT_PRODUCTS_TAX_CLASS', '税種別:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '平均点:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '数量:');
define('TEXT_DATE_ADDED', '登録日:');
define('TEXT_DATE_AVAILABLE', '発売日:');
define('TEXT_LAST_MODIFIED', '更新日:');
define('TEXT_IMAGE_NONEXISTENT', '画像が存在しません。');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', '新しいカテゴリまたは商品を登録してください。.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'もっと詳しい情報は、この商品の<a href="http://%s" target="blank">Webページ</a>をご覧ください。');
define('TEXT_PRODUCT_DATE_ADDED', 'この商品は %s にカタログに登録されました。.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'この商品は %s に入荷予定です。');

define('TEXT_EDIT_INTRO', '必要な変更を加えてください。');
define('TEXT_EDIT_CATEGORIES_ID', 'カテゴリID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'カテゴリ名:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'カテゴリ画像:');
define('TEXT_EDIT_SORT_ORDER', '整列順:');

define('TEXT_INFO_COPY_TO_INTRO', 'この商品をコピーする先のカテゴリを選択してください。');
define('TEXT_INFO_CURRENT_CATEGORIES', '現在のカテゴリ: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', '新しいカテゴリ');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'カテゴリを編集');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'カテゴリを削除');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'カテゴリを移動');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', '商品を削除');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', '商品を移動');
define('TEXT_INFO_HEADING_COPY_TO', 'コピー先');

define('TEXT_DELETE_CATEGORY_INTRO', 'このカテゴリを本当に削除しますか?');
define('TEXT_DELETE_PRODUCT_INTRO', 'この商品を本当に削除しますか?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>警告:</b> このカテゴリには %s 個のサブカテゴリが登録されています!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> このカテゴリには %s 個の商品が登録されています!');

define('TEXT_MOVE_PRODUCTS_INTRO', '<b>%s</b>を移動する先のカテゴリを選んでください。');
define('TEXT_MOVE_CATEGORIES_INTRO', '<b>%s</b>を移動する先のカテゴリを選んでください。');
define('TEXT_MOVE', '<b>%s</b>の移動先:');

define('TEXT_NEW_CATEGORY_INTRO', '新しいカテゴリの情報を入力してください。');
define('TEXT_CATEGORIES_NAME', '新しいカテゴリ:');
define('TEXT_CATEGORIES_IMAGE', 'カテゴリ画像:');
define('TEXT_SORT_ORDER', '整列順:');

define('TEXT_PRODUCTS_STATUS', '商品ステータス:');
define('TEXT_PRODUCTS_VIRTUAL', 'バーチャル商品:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '配送料無料:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', '商品の数量入力欄の表示:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', '発売日:');
define('TEXT_PRODUCT_AVAILABLE', '在庫あり');
define('TEXT_PRODUCT_NOT_AVAILABLE', '品切れ');
define('TEXT_PRODUCT_IS_VIRTUAL', 'はい、配送先の指定は不要です。');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'いいえ、配送先の指定が必要です');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'はい、送料を無料にします。');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'いいえ、通常どおりの送料です。');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'はい、在庫数を表示します。');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'いいえ、在庫数を表示しません。');

define('TEXT_PRODUCTS_MANUFACTURER', 'メーカー:');
define('TEXT_PRODUCTS_NAME', '商品名:');
define('TEXT_PRODUCTS_DESCRIPTION', '商品の説明:');
define('TEXT_PRODUCTS_QUANTITY', '商品の在庫数:');
define('TEXT_PRODUCTS_MODEL', '商品の型番:');
define('TEXT_PRODUCTS_IMAGE', '商品の画像:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'アップロードするディレクトリ:');
define('TEXT_PRODUCTS_URL', '商品のURL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(\'http://\'はいりません。)</small>');
define('TEXT_PRODUCTS_PRICE_NET', '価格 (税抜き):');
define('TEXT_PRODUCTS_PRICE_GROSS', '価格 (税込み):');
define('TEXT_PRODUCTS_WEIGHT', '商品の重量:');

define('EMPTY_CATEGORY', '空のカテゴリ');

define('TEXT_HOW_TO_COPY', 'コピーの方法:');
define('TEXT_COPY_AS_LINK', 'リンクのコピー(他のカテゴリへ)');
define('TEXT_COPY_AS_DUPLICATE', '重複コピー(同一のカテゴリ可)');

define('TEXT_RESTRICT_PRODUCT_TYPE', '商品タイプの制限');
define('TEXT_CATEGORY_HAS_RESTRICTIONS', 'このカテゴリはこれらの商品タイプに限られています。');
define('ERROR_CANNOT_ADD_PRODUCT_TYPE','この特定のタイプの勝因はこのカテゴリーには追加できません。カテゴリーの制限事項をチェックしてみてください');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','商品の複製だけに使用する...');
  define('TEXT_COPY_ATTRIBUTES','商品オプションをコピーして複製しますか?');
  define('TEXT_COPY_ATTRIBUTES_YES','はい');
  define('TEXT_COPY_ATTRIBUTES_NO','いいえ');

  define('TEXT_INFO_CURRENT_PRODUCT', '現在の商品: ');
  define('TABLE_HEADING_MODEL', '型番');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','商品のオプション変更 商品ID:');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','<strong>全ての</strong> 商品オプションを削除する:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','以下の商品の商品オプションを他の商品または全体にコピー:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','以下の商品の商品オプションを<strong>他の商品</strong>にコピー:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','以下の商品の商品オプションを<strong>カテゴリ</strong>にコピー:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>現在の商品オプションをどうしますか?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>削除</strong>し、新しいオプションをコピーする');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','新しい設定/価格を<strong>更新</strong>し、新しいものを追加する');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>無視</strong>して新しいオプションだけを追加する');

  define('SUCCESS_ATTRIBUTES_DELETED','商品のオプションを削除しました。');
  define('SUCCESS_ATTRIBUTES_UPDATE','商品のオプションを更新しました。');

  define('ICON_ATTRIBUTES','商品のオプション');

  define('TEXT_CATEGORIES_IMAGE_DIR','アップロード先のディレクトリ:');

  define('TEXT_VIRTUAL_PREVIEW','警告: バーチャル商品のため配送先指定をスキップします');
  define('TEXT_VIRTUAL_EDIT','警告: バーチャル商品のため配送先指定をスキップします');
  define('TEXT_FREE_SHIPPING_PREVIEW','警告: 配送料無料の商品のため配送先住所が必要です。');
  define('TEXT_FREE_SHIPPING_EDIT','警告: 配送料無料の商品のため配送先住所が必要です。');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','警告: 在庫量を表示しません。デフォルトは1です。');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','警告: 在庫量を表示しません。デフォルトは1です。');

  define('TEXT_PRODUCT_OPTIONS', '<strong>選択してください:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','商品のオプション:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','ダウンロード商品: ');


  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','商品オプションを付加する:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','はい');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','いいえ');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*表示価格は最も価格の低い価格のオプションを含めた価格になります。');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*表示価格は最も価格の低い価格のオプションを含めた価格になります。');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','最小個数:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','購入単位:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','最大個数:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = 無制限、1 = 数量ボックスが消えます。それ以上の場合はその数まで注文できるようになります。');

  define('TEXT_PRODUCTS_MIXED','購入単位を最小個数として扱う:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', '商品は無料');
  define('TEXT_PRODUCT_IS_FREE','無料の商品:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*この商品は無料に設定されています');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*この商品は無料に設定されています');

  define('TEXT_PRODUCT_IS_CALL','価格お問い合わせ商品にする:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*この商品は価格お問い合わせ商品に設定されています。');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*この商品は価格お問い合わせ商品に設定されています。');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>新しいオプションをスキップします。</strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>新しいオプションを挿入します。</strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>オプションを更新します。 </strong>');

  define('TEXT_SHIPPING_INFO',
  '<strong>バーチャル商品</strong> は「サービス」や「' . TEXT_GV_NAMES . '」のように配送料や配送先住所の必要の無いものです。<br />' .
  '<strong>常に配送料無料</strong> は配送料は必要ないが、配送先住所が必要なものです。<br />' .
  '<strong>ダウンロード商品</strong> はバーチャル商品ですので、両方ともマークする必要はありません。<br />'
  );

  define('TEXT_ANY_TYPE', 'いずれのタイプでも');
  define('TABLE_HEADING_PRODUCT_TYPES', '商品タイプ');

// categories status
define('TEXT_INFO_HEADING_STATUS_CATEGORY', '以下のカテゴリのステータスを変える:');
define('TEXT_CATEGORIES_STATUS_INTRO', 'カテゴリのステータスを以下に変える: ');
define('TEXT_CATEGORIES_STATUS_OFF', 'オフ');
define('TEXT_CATEGORIES_STATUS_ON', 'オン');
define('TEXT_PRODUCTS_STATUS_INFO', '全商品のステータスを以下に変える: ');
define('TEXT_PRODUCTS_STATUS_OFF', 'オフ');
define('TEXT_PRODUCTS_STATUS_ON', 'オン');
define('TEXT_PRODUCTS_STATUS_NOCHANGE', '変更なし');
define('TEXT_CATEGORIES_STATUS_WARNING', '<strong>警告...</strong><br />注意: カテゴリを無効にすると、このカテゴリに属する全商品が無効になります。このカテゴリ内にあり、他のカテゴリにリンクしている商品も無効になります。');

define('TEXT_PRODUCTS_STATUS_ON_OF',' の ');
define('TEXT_PRODUCTS_STATUS_ACTIVE',' アクティブ ');

define('TEXT_CATEGORIES_DESCRIPTION', 'カテゴリの説明:');
define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', '価格要問い合わせの商品');

// Metatags
  define('TEXT_INFO_HEADING_EDIT_CATEGORY_META_TAGS', 'カテゴリのヘッダ情報定義');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_INTRO', 'ヘッダ情報のカスタマイズ');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_TITLE', 'タイトル:');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_KEYWORDS', 'Metaタグ(Keywords):');
  define('TEXT_EDIT_CATEGORIES_META_TAGS_DESCRIPTION', 'Metaタグ(Description):');




?>