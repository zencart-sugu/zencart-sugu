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
//  $Id: product_music.php 2830 2006-01-10 17:13:18Z birdbrain $
//

define('HEADING_TITLE', 'カテゴリ / 商品');
define('HEADING_TITLE_GOTO', 'ジャンプ:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'カテゴリ / 商品');
define('TABLE_HEADING_CATEGORIES_SORT_ORDER', 'ソート');

define('TABLE_HEADING_PRICE','価格/特別価格/セール価格');
define('TABLE_HEADING_QUANTITY','数量');

define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_STATUS', 'ステータス');

define('TEXT_CATEGORIES', 'カテゴリ:');
define('TEXT_SUBCATEGORIES', 'サブカテゴリ:');
define('TEXT_PRODUCTS', '商品:');
define('TEXT_PRODUCTS_RECORD_ARTIST', 'レコーディングアーティスト:');
define('TEXT_PRODUCTS_RECORD_COMPANY', 'レコード会社:');
define('TEXT_PRODUCTS_MUSIC_GENRE', '音楽ジャンル:');
define('TEXT_PRODUCTS_PRICE_INFO', '価格:');
define('TEXT_PRODUCTS_TAX_CLASS', '税種別:');
define('TEXT_PRODUCTS_AVERAGE_RATING', '平均値:');
define('TEXT_PRODUCTS_QUANTITY_INFO', '数量:');
define('TEXT_DATE_ADDED', '登録日:');
define('TEXT_DATE_AVAILABLE', '提供開始日:');
define('TEXT_LAST_MODIFIED', '更新日:');
define('TEXT_IMAGE_NONEXISTENT', '画像なし');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'このレベルに新しいカテゴリか商品を追加してください。');
define('TEXT_PRODUCT_MORE_INFORMATION', 'より詳細な情報を見るにはこの商品の <a href="http://%s" target="blank">Webページ</a> へ。');
define('TEXT_PRODUCT_DATE_ADDED', 'この商品の当ショップへの登録日：%s');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'この商品の入荷予定日： %s');

define('TEXT_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_EDIT_CATEGORIES_ID', 'カテゴリID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'カテゴリ名:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'カテゴリ画像:');
define('TEXT_EDIT_SORT_ORDER', 'ソート順:');

define('TEXT_INFO_COPY_TO_INTRO', 'この商品をコピーしたい新しいカテゴリを選択してください。');
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

define('TEXT_DELETE_WARNING_CHILDS', '<b>警告:</b>  %s 個の(サブ)カテゴリがこのカテゴリにまだリンクされています!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>警告:</b> %s 個の商品がこのカテゴリにまだリンクされています!');

define('TEXT_MOVE_PRODUCTS_INTRO', '<b>%s</b> を移動させたいカテゴリを選んでください。');
define('TEXT_MOVE_CATEGORIES_INTRO', ' <b>%s</b> カテゴリを移動させたいカテゴリを選んでください。');
define('TEXT_MOVE', ' <b>%s</b> を移動:');

define('TEXT_NEW_CATEGORY_INTRO', '新しいカテゴリについての情報を入力してください。');
define('TEXT_CATEGORIES_NAME', 'カテゴリ名:');
define('TEXT_CATEGORIES_IMAGE', 'カテゴリ画像:');
define('TEXT_SORT_ORDER', 'ソート順:');

define('TEXT_PRODUCTS_STATUS', '商品ステータス:');
define('TEXT_PRODUCTS_VIRTUAL', 'ヴァーチャル商品:');
define('TEXT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING', '常に送料無料:');
define('TEXT_PRODUCTS_QTY_BOX_STATUS', '商品の数量欄は:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', '提供可能日:');
define('TEXT_PRODUCT_AVAILABLE', '在庫あり');
define('TEXT_PRODUCT_NOT_AVAILABLE', '在庫切れ');
define('TEXT_PRODUCT_IS_VIRTUAL', 'はい、送付先住所の入力をスキップ');
define('TEXT_PRODUCT_NOT_VIRTUAL', 'いいえ、送付先住所の入力は必要');
define('TEXT_PRODUCT_IS_ALWAYS_FREE_SHIPPING', 'はい、常に送料無料');
define('TEXT_PRODUCT_NOT_ALWAYS_FREE_SHIPPING', 'いいえ、通常の送料を適用');
define('TEXT_PRODUCT_SPECIAL_ALWAYS_FREE_SHIPPING', '特別商品とダウンロード商品のコンビネーションは配送先住所の登録が必要です。');
define('TEXT_PRODUCTS_SORT_ORDER', 'ソート順:');

define('TEXT_PRODUCTS_QTY_BOX_STATUS_ON', 'はい、数量欄を表示');
define('TEXT_PRODUCTS_QTY_BOX_STATUS_OFF', 'いいえ、数量欄は非表示');

define('TEXT_PRODUCTS_MANUFACTURER', '商品のメーカー:');
define('TEXT_PRODUCTS_NAME', '商品名:');
define('TEXT_PRODUCTS_DESCRIPTION', '商品説明:');
define('TEXT_PRODUCTS_QUANTITY', '商品数量:');
define('TEXT_PRODUCTS_MODEL', '商品型番:');
define('TEXT_PRODUCTS_IMAGE', '商品画像:');
define('TEXT_PRODUCTS_IMAGE_DIR', 'ディレクトリにアップロード:');
define('TEXT_PRODUCTS_URL', '商品のURL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>("http://"なしで入力)</small>');
define('TEXT_PRODUCTS_PRICE_NET', '商品価格 (ネット):');
define('TEXT_PRODUCTS_PRICE_GROSS', '商品価格 (グロス):');
define('TEXT_PRODUCTS_WEIGHT', '商品の重量:');

define('EMPTY_CATEGORY', '空のカテゴリ');

define('TEXT_HOW_TO_COPY', 'コピー方法:');
define('TEXT_COPY_AS_LINK', 'リンクされた商品');
define('TEXT_COPY_AS_DUPLICATE', '商品をコピー');


// Products and Attribute Copy Options
  define('TEXT_COPY_ATTRIBUTES_ONLY','商品の複製にのみ使用');
  define('TEXT_COPY_ATTRIBUTES','商品属性もコピーしますか?');
  define('TEXT_COPY_ATTRIBUTES_YES','はい');
  define('TEXT_COPY_ATTRIBUTES_NO','いいえ');
  define('TEXT_COPY_MEDIA_MANAGER','この商品に関連したメディア管理コレクション(Media Manager collections)をコピーしてください。');

  define('TEXT_INFO_CURRENT_PRODUCT', '現在のカテゴリ: ');
  define('TABLE_HEADING_MODEL', '型番');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','商品ID# の属性を変更 ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','<strong>全</strong> 商品の属性を削除:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','他の商品またはカテゴリに属性をコピー:<br />');

  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','別の <strong>商品</strong> に属性をコピー:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','別の <strong>カテゴリ</strong> に属性をコピー:<br />');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>すでに存在する商品属性をどう処理しますか?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>先に削除</strong> し、新しい属性をコピー');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>新設定・価格を更新</strong> し、新しいものをコピー');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>無視</strong> し、新しい属性をコピー');

  define('SUCCESS_ATTRIBUTES_DELETED','属性の削除に成功しました。');
  define('SUCCESS_ATTRIBUTES_UPDATE','属性の更新に成功しました。');

  define('ICON_ATTRIBUTES','おすすめ属性(アトリビュートの特徴)');

  define('TEXT_CATEGORIES_IMAGE_DIR','ディレクトリにアップロード:');

  define('TEXT_PRODUCTS_QTY_BOX_STATUS_PREVIEW','警告: 数量欄を表示せず、数量1に設定します。');
  define('TEXT_PRODUCTS_QTY_BOX_STATUS_EDIT','警告: 数量欄を表示せず、数量1に設定します。');

  define('TEXT_PRODUCT_OPTIONS', '<strong>選択してください:</strong>');
  define('TEXT_PRODUCTS_ATTRIBUTES_INFO','おすすめ属性(アトリビュートの特徴):');
  define('TEXT_PRODUCT_ATTRIBUTES_DOWNLOADS','ダウンロード: ');

  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','商品価格は属性による:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','はい');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','いいえ');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_PREVIEW','*表示価格は最も安いグループ属性による価格です。(Display price will include lowest group attributes prices plus price)');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','*表示価格は最も安いグループ属性による価格です。(Display price will include lowest group attributes prices plus price)');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','商品の最少数量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','商品の数量ユニット:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','商品の最多数量:');

  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0 = 無制限、1 = 数量欄なし');

  define('TEXT_PRODUCTS_MIXED','商品数量 最少/ユニット混合:');

  define('PRODUCTS_PRICE_IS_FREE_TEXT', '商品は無料');
  define('TEXT_PRODUCT_IS_FREE','無料商品:');
  define('TEXT_PRODUCTS_IS_FREE_PREVIEW','*商品は無料とマーク済み');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','*商品は無料とマーク済み');

  define('TEXT_PRODUCT_IS_CALL','価格お問い合わせ商品:');
  define('TEXT_PRODUCTS_IS_CALL_PREVIEW','*商品は価格お問い合わせとマーク済み');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','*商品は価格お問い合わせとマーク済み');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>新しい属性をスキップ </strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>新しい属性を挿入 </strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>属性から更新 </strong>');

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
