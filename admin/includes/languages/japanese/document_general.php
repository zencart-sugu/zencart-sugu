<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: document_general.php 2830 2006-01-10 17:13:18Z birdbrain $
//

define('HEADING_TITLE', 'カテゴリ・商品');
define('HEADING_TITLE_GOTO', 'ジャンプ:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'カテゴリ・商品');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'ソート');

define('TABLE_HEADING_PRICE','価格/特別価格/セール価格');
define('TABLE_HEADING_QUANTITY','数量');

define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_STATUS', 'ステータス');

define('TEXT_CATEGORIES', 'カテゴリ:');
define('TEXT_SUBCATEGORIES', 'サブカテゴリ:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_PRICE_INFO', '価格:');
define('TEXT_PRODUCTS_TAX_CLASS', '税クラス:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '平均値:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '数量:');
define('TEXT_DATE_ADDED', '作成日:');
define('TEXT_DATE_AVAILABLE', '提供可能日:');
define('TEXT_LAST_MODIFIED', '更新日:');
define('TEXT_IMAGE_NONEXISTENT', '画像なし');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', '新しいカテゴリか商品を挿入してください');
define('TEXT_PRODUCT_MORE_INFORMATION', '詳細をご覧になるには、この商品の <a href="http://%s" target="blank">Webページ</a>へ。.');
define('TEXT_PRODUCT_DATE_ADDED', '当ショップへのこの商品の追加日： %s. ');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'この商品の入荷予定日: %s.');

define('TEXT_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_EDIT_CATEGORIES_ID', 'カテゴリID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'カテゴリ名:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'カテゴリ画像:');
define('TEXT_EDIT_SORT_ORDER', 'ソート順:');

define('TEXT_INFO_COPY_TO_INTRO', 'この商品をコピーしたい新しいカテゴリを選んでください。');
define('TEXT_INFO_CURRENT_CATEGORIES', '現在のカテゴリ: ');

define('TEXT_INFO_HEADING_NEW_CATEGORY', '新しいカテゴリ');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'カテゴリを編集');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'カテゴリを削除');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'カテゴリを移動');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', '商品を削除');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', '商品を移動');
define('TEXT_INFO_HEADING_COPY_TO', 'コピー先');

define('TEXT_DELETE_CATEGORY_INTRO', 'このカテゴリを本当に削除しますか?');
define('TEXT_DELETE_PRODUCT_INTRO', 'この商品を永久に削除しますか?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>警告:</b>  %s (サブ-)カテゴリがこのカテゴリにリンクされています!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b>  %s 商品がこのカテゴリにリンクされています!');

define('TEXT_MOVE_PRODUCTS_INTRO', '移動させたいカテゴリを選択してください<b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', '移動させたいカテゴリを選択してください<b>%s</b>');
define('TEXT_MOVE', ' <b>%s</b>を動かす:');

define('TEXT_NEW_CATEGORY_INTRO', '新しいカテゴリ用に、以下の情報を入力してください。');
define('TEXT_CATEGORIES_NAME', 'カテゴリー名:');
define('TEXT_CATEGORIES_IMAGE', 'カテゴリーイメージ:');
define('TEXT_SORT_ORDER', 'ソート順:');

define('TEXT_DOCUMENT_STATUS', 'ドキュメントのステータス:');
define('TEXT_PRODUCTS_VIRTUAL', '商品はバーチャルか:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '常に送料無料:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', '商品のQuantity Boxを表示:');
define('TEXT_DOCUMENT_DATE_AVAILABLE', '日付が利用できる:');
define('TEXT_DOCUMENT_AVAILABLE', '利用できる');
define('TEXT_DOCUMENT_NOT_AVAILABLE', '利用できない');
define('TEXT_PRODUCT_IS_VIRTUAL', 'はい、送付先をスキップします');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'いいえ、配送先の入力が必要です');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'はい、いつでも送料無料です');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'いいえ、通常の送料の扱いです');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', '特別商品/ダウンロード商品の組み合わせでは住所の入力が必要です。');
define('TEXT_PRODUCTS_SORT_ORDER', '整列順:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'はい、総量ボックスを見せてください');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'いいえ、総量ボックスを見せないでください');

define('TEXT_DOCUMENT_NAME', 'ドキュメント名:');
define('TEXT_DOCUMENT_DETAILS', 'ドキュメントのコンテンツ:');
define('TEXT_DOCUMENT_IMAGE', 'ドキュメントイメージ:');
define('TEXT_DOCUMENT_IMAGE_DIR', 'ディレクトリーにアップロードする:');
define('TEXT_DOCUMENT_URL', 'ドキュメントのURL:');
define('TEXT_DOCUMENT_URL_WITHOUT_HTTP', '<small>(without http://)</small>');

define('EMPTY_CATEGORY', '空のカテゴリー');

define('TEXT_HOW_TO_COPY', 'メソッドをコピー:');
define('TEXT_COPY_AS_LINK', '商品にリンクする');
define('TEXT_COPY_AS_DUPLICATE', '商品を複製する');

// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','複製商品にのみ使用することができます');
  define('TEXT_COPY_ATTRIBUTES','商品のアトリビュートを複製しますか？');
  define('TEXT_COPY_ATTRIBUTES_YES','はい');
  define('TEXT_COPY_ATTRIBUTES_NO','いいえ');

  define('TEXT_INFO_CURRENT_PRODUCT', '現在の商品: ');
  define('TABLE_HEADING_MODEL', 'モデル');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','ID#の商品のアトリビュートの変更');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','Delete <strong>全ての</strong>商品アトリビュート:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','アトリビュートを他の商品、もしくはカテゴリ全体にコピーする:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','アトリビュートを :から<br />別の<strong>商品</strong>へコピーする<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','アトリビュートを :から<br />別の<strong>カテゴリー</strong>へコピーする<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>既に作成されている商品アトリビュートはどのように扱いますか？</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','先に<strong>消去</strong>し、そして新しいアトリビュートをコピーする');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','新しい設定/価格で<strong>更新</strong>し、新しいのを追加する');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>無視</strong>して新しいアトリビュートを追加する');

  define('SUCCESS_ATTRIBUTES_DELETED','アトリビュートは無事削除されました');
  define('SUCCESS_ATTRIBUTES_UPDATE','アトリビュートは無事更新されました');

  define('ICON_ATTRIBUTES','アトリビュートの特徴');

  define('TEXT_CATEGORIES_IMAGE_DIR','ディレクトリにアップロードする:');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','警告: 総量ボックスを見せないで、ディフォルトの総量１にセットする');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','警告: 総量ボックスを見せないで、ディフォルトの総量１にセットする');

  define('TEXT_PRODUCT_OPTIONS', '<strong>選択してください:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','アトリビュートの特徴:');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','ダウンロード: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','アトリビュートによって値付けされた商品:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','はい');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','いいえ');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*表示価格は最も安いグループ属性による価格です。');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*表示価格は最も安いグループ属性による価格です。');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','商品の最少数量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','商品の数量ユニット:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','商品の最大数量:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = 無制限, 1 = 総量箱なし');

  define('TEXT_PRODUCTS_MIXED','商品数量 最少/ユニット混合:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', '商品は無料です');
  define('TEXT_PRODUCT_IS_FREE','商品は無料です:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*商品は無料に設定されています');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*商品は無料に設定されています');

  define('TEXT_PRODUCT_IS_CALL','この商品は価格要問い合わせ:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*この商品は価格要問い合わせとマークされています');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*この商品は価格要問い合わせとマークされています');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>新しいアトリビュートをスキップする</strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>新しいアトリビュートを挿入する</strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>アトリビュートから更新する </strong>');

// meta tags
  define('TEXT_META_TAG_TITLE_INCLUDES','<strong>この商品のメタタグタイトルが何を含んでいるべきかマークする:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRODUCTS_NAME_STATUS','<strong>商品名:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_STATUS','<strong>タイトル:</strong>');
  define('TEXT_PRODUCTS_METATAGS_MODEL_STATUS','<strong>モデル:</strong>');
  define('TEXT_PRODUCTS_METATAGS_PRICE_STATUS','<strong>価格:</strong>');
  define('TEXT_PRODUCTS_METATAGS_TITLE_TAGLINE_STATUS','<strong>タイトル/タグライン:</strong>');
  define('TEXT_META_TAGS_TITLE','<strong>メタタグタイトル:</strong>');
  define('TEXT_META_TAGS_KEYWORDS','<strong>メタタグキーワード:</strong>');
  define('TEXT_META_TAGS_DESCRIPTION','<strong>メタタグの説明:</strong>');
  define('TEXT_META_EXCLUDED', '<span class="alert">排除された</span>');
?>