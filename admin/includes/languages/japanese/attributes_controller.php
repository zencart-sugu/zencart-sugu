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
//  $Id: attributes_controller.php 2830 2006-01-10 17:13:18Z birdbrain $
//

define('HEADING_TITLE', 'CATEGORIES: ');

define('HEADING_TITLE_OPT', '商品オプション');
define('HEADING_TITLE_VAL', 'オプション値');
define('HEADING_TITLE_ATRIB', '商品オプション属性の管理');
define('HEADING_TITLE_ATRIB_SELECT','商品オプション属性を表示する商品を選択してください。');

define('TEXT_PRICES_AND_WEIGHTS', '価格と重量の設定');
define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR', 'プライスファクターやオフセットは、オプション選択時の追加料金に次のように作用します。<br/><br/><b>　オプション選択時の購入単価（商品1点あたり）<br/>　＝ [商品価格] ＋ [オプション価格]<br/>　　＋ [ベース価格] ×（[プライスファクター]−[オフセット]）</b><br/><br/>ただし、[商品属性による価格]、[属性による価格増減をベース価格に含める]の<br/>フラグの状態で[ベース価格]が変わり、2フラグともに "はい" なら<br/><br/><b>[ベース価格] ＝ [商品価格]＋[オプション価格]</b><br/><br/>いずれか、あるいは両方 "いいえ" なら<br/><br/><b>[ベース価格] ＝ [商品価格]</b><br/><br/>になります。<br/><br/>プライスファクター');

define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET', 'オフセット');
define('TABLE_HEADING_ATTRIBUTES_PRICE_ONETIME', 'ワンタイム値引の値引金額');

define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME', 'ワンタイムプライスファクター／オフセットは、オプション選択時の追加料金に次のように作用します。<br/><br/><b>　オプション選択時の購入単価（商品1点あたり）<br/>　＝ [商品価格] ＋ [オプション価格]</b><br/><br/>この他に、1注文あたりかかる料金があって・・・<br/><b>　オプション選択時の追加料金（1注文あたり）<br/>　　 [ベース価格] ×（[ワンタイムプライスファクター]−[ワンタイムオフセット]）</b><br/><br/>ただし、[商品属性による価格]、[属性による価格増減をベース価格に含める]の<br/>フラグの状態で[ベース価格]が変わり、2フラグともに "はい" なら<br/><br/><b>[ベース価格] ＝ [商品価格]＋[オプション価格]</b><br/><br/>いずれか、あるいは両方 "いいえ" なら<br/><br/><b>[ベース価格] ＝ [商品価格]</b><br/><br/>になります。<br/><br/>ワンタイムプライスファクター');

define('TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_OFFSET_ONETIME', 'ワンタイムオフセット');

define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES', 'オプションの数量値引設定<br/><br/>例:2:-8,4:-16,N:-20<br/>この場合、このオプションを指定した商品購入個数が2個までは8円引き、<br/>3〜4個までは6円引き、5個以上は20円引きになります。<br/>最後の値引指定はNの値は無視され、商品購入個数が直前の値引指定<br/>の個数(ここでは4)の+1個以上の時の値引指定として値引額だけが作用します。<br/>Nの値に動作上の意味はありませんが、運用で混乱を避けるために<br/>直前の値引指定の個数+1(ここでは5)を指定してください。<br/>値引は商品１個単位に作用します。<br/>-をつけない金額指定をすると<br/>値引ではなく逆にその金額が加算される設定になります。<br/>');
define('TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME', 'オプションのワンタイム数量値引設定<br/><br/>例:2:-8,4:-16,N:-20<br/>この場合、このオプションを指定した商品購入個数が2個までは8円引き、<br/>3〜4個までは6円引き、5個以上は20円引きになります。<br/>最後の値引指定はNの値は無視され、商品購入個数が直前の値引指定<br/>の個数(ここでは4)の+1個以上の時の値引指定として値引額だけが作用します。<br/>Nの値に動作上の意味はありませんが、運用で混乱を避けるために<br/>直前の値引指定の個数+1(ここでは5)を指定してください。<br/>値引は同一商品同一オプションの購入に一回だけ作用します。<br/>-をつけない金額指定をすると<br/>値引ではなく逆にその金額が加算される設定になります。<br/>');

define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS', '単語毎の価格');
//Price Per Word
define('TABLE_HEADING_ATTRIBUTES_PRICE_WORDS_FREE', '無料の最大単語数');
//- Free Words
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS', '文字毎の価格');
//Price Per Letter
define('TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS_FREE', '無料の最大文字数');
//- Free Letters
define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', '商品名');
define('TABLE_HEADING_OPT_NAME', 'オプション名');
define('TABLE_HEADING_OPT_VALUE', 'オプション値');
define('TABLE_HEADING_OPT_PRICE', '価格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '±');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_DOWNLOAD', 'ダウンロード商品:');
define('TABLE_TEXT_FILENAME', 'ファイル名:');
define('TABLE_TEXT_MAX_DAYS', '有効期間(日):');
define('TABLE_TEXT_MAX_COUNT', '最大ダウンロード数:');
define('TABLE_HEADING_OPT_DISCOUNTED','ディスカウント');
define('TABLE_HEADING_PRICE_BASE_INCLUDED','基本価格に含む');
define('TABLE_HEADING_PRICE_TOTAL','合計値引額<br />ワンタイム値引額');
//Total|Disc: Onetime:
define('TEXT_WARNING_OF_DELETE', 'このオプションは商品と価格に結びついています。- 安全な削除ができません');
define('TEXT_OK_TO_DELETE', 'このオプションは商品と価格に結びついていません。- 安全に削除できます');
define('TEXT_OPTION_ID', 'オプションID');
define('TEXT_OPTION_NAME', 'オプション名');

define('ATTRIBUTE_WARNING_DUPLICATE','商品オプション属性を複製しました。- 商品オプション属性は追加されていません'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','商品オプション属性の複製が存在します。 - 商品オプション属性は変更されていません'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_INVALID_MATCH','商品オプション属性とオプション値が一致しません。 - 商品オプション属性は追加されませんでした'); // miss matched option and options value
define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','商品オプション属性とオプション値が一致しません - 商品オプション属性は変更されませんでした'); // miss matched option and options value
define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','複製可能なオプション名が追加されました。'); // Options Name Duplicate warning
define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','複製可能なオプション値が追加されました。'); // Options Value Duplicate warning

define('PRODUCTS_ATTRIBUTES_EDITING','編集'); // title
define('PRODUCTS_ATTRIBUTES_DELETE','削除'); // title
define('PRODUCTS_ATTRIBUTES_ADDING','新しい属性を追加'); // title
define('TEXT_DOWNLOADS_DISABLED','NOTE: ダウンロード販売は利用付加になりました。');

define('TABLE_TEXT_MAX_DAYS_SHORT', '日:');
define('TABLE_TEXT_MAX_COUNT_SHORT', '最大:');

  define('TABLE_HEADING_OPTION_SORT_ORDER','表示の整列順');
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','デフォルトの整列順');
  define('TEXT_SORT',' Order: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','±');
  define('TABLE_HEADING_OPT_WEIGHT','重量');
  define('TABLE_HEADING_OPT_SORT_ORDER','整列順');
  define('TABLE_HEADING_OPT_DEFAULT','デフォルト');

  define('TABLE_HEADING_OPT_TYPE', 'オプションタイプ'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','サイズ');
  define('TABLE_HEADING_OPTION_VALUE_MAX','最大');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','行');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','コメント');

  define('TEXT_OPTION_VALUE_COMMENTS','コメント: ');
  define('TEXT_OPTION_VALUE_SIZE','表示サイズ: ');
  define('TEXT_OPTION_VALUE_MAX','最大の長さ: ');

  define('TEXT_ATTRIBUTES_IMAGE','オプション画像:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','オプション画像の保存ディレクトリ:');

  define('TEXT_ATTRIBUTES_FLAGS','属性<br />フラグ');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', '表示のみ');
  define('TEXT_ATTRIBUTES_IS_FREE', '商品が無料商品のとき<br/>属性による価格も無料にする');
  define('TEXT_ATTRIBUTES_DEFAULT', 'デフォルトで<br />選択される');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', '属性による価格増減にも特価/セールの割引を適用する');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','属性による価格増減をベース価格に含める');
  define('TEXT_ATTRIBUTES_REQUIRED','テキスト入力を必須にする');

  define('LEGEND_BOX','属性フラグ');
  define('LEGEND_KEYS','OFF/ON');
  define('LEGEND_ATTRIBUTES_DISPLAY_ONLY', '参照のみ');
  define('LEGEND_ATTRIBUTES_IS_FREE', '無料');
  define('LEGEND_ATTRIBUTES_DEFAULT', 'デフォルト');
  define('LEGEND_ATTRIBUTE_IS_DISCOUNTED', '値引きされた');
  define('LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED','基本価格');
  define('LEGEND_ATTRIBUTES_REQUIRED','要求事項');
  define('LEGEND_ATTRIBUTES_IMAGES','イメージ');
  define('LEGEND_ATTRIBUTES_DOWNLOAD','有効/非有効<br />ファイルネーム');

  define('TEXT_ATTRIBUTES_UPDATE_SORT_ORDER','デフォルトの整列順にする');
  define('TEXT_PRODUCTS_LISTING','表示されている商品: ');
  define('TEXT_NO_PRODUCTS_SELECTED','商品が選択されていません');
  define('TEXT_NO_ATTRIBUTES_DEFINED','この商品には属性が定義されていません。商品ID：');

  define('TEXT_PRODUCTS_ID','商品ID');
  define('TEXT_ATTRIBUTES_DELETE','全て削除');
  define('TEXT_ATTRIBUTES_COPY_PRODUCTS','属性を商品にコピーする');
  define('TEXT_ATTRIBUTES_COPY_CATEGORY','属性をカテゴリーにコピーする');

  define('TEXT_INFO_HEADING_ATTRIBUTE_FEATURES','属性の変更　商品ID ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_DELETE','この商品の<strong>全て</strong>の属性を削除します。:<br />');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO','属性を他の商品やカテゴリーにコピーします。:<br />');

  define('TEXT_ATTRIBUTES_COPY_TO_PRODUCTS','商品');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_PRODUCT','商品オプション属性を他の<strong>商品</strong>にコピーします。コピー元商品ID');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_COPY_TO','全商品オプション属性のコピー先商品:');

  define('TEXT_ATTRIBUTES_COPY_TO_CATEGORY','カテゴリー');
  define('TEXT_INFO_ATTRIBUTES_FEATURE_CATEGORIES_COPY_TO','商品オプションをコピーするカテゴリ:');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_COPY_TO_CATEGORY','<strong>カテゴリー</strong>内の全ての商品に商品オプション属性をコピーする コピー元商品ID');

  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>既存の商品オプション属性の扱いを指定します。</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','まず<strong>削除</strong>してから、新しい商品オプション属性をコピーする');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','新しい設定/価格を<strong>更新</strong>してから新しいものを追加する');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','現在のものは<strong>無視</strong>して新しい商品オプション属性を追加する');

  define('SUCCESS_PRODUCT_UPDATE_SORT','属性の整列順を更新しました。 商品ID ');
  define('SUCCESS_PRODUCT_UPDATE_SORT_NONE','整列順を更新する属性がありません。商品ID ');
  define('SUCCESS_ATTRIBUTES_DELETED','属性を削除しました。');
  define('SUCCESS_ATTRIBUTES_UPDATE','属性を更新しました。');

  define('WARNING_PRODUCT_COPY_TO_CATEGORY_NONE','コピー先のカテゴリが選択されていません。');
  define('TEXT_PRODUCT_IN_CATEGORY_NAME',' - カテゴリー: ');

  define('TEXT_DELETE_ALL_ATTRIBUTES','本当に全ての属性を削除しますか？　商品ID ');

  define('TEXT_ATTRIBUTE_COPY_SKIPPING','<strong>新しい属性をスキップ</strong>');
  define('TEXT_ATTRIBUTE_COPY_INSERTING','<strong>新しい商品オプション属性の挿入元</strong>');
  define('TEXT_ATTRIBUTE_COPY_UPDATING','<strong>U商品オプション属性から更新</strong>');

// preview
  define('TEXT_ATTRIBUTES_PREVIEW','属性プレビュー');
  define('TEXT_ATTRIBUTES_PREVIEW_DISPLAY','商品オプション属性のプレビュー ID:');
  define('TEXT_PRODUCT_OPTIONS', '<strong>選択してください:</strong>');


  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>挿入ボタンを押すと商品オプション属性の設定を定義します。</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', '商品オプション属性によって価格付けします。');
  define('TEXT_PRODUCTS_PRICE', '商品価格: ');
  define('TEXT_SPECIAL_PRICE', '特別価格: ');
  define('TEXT_SALE_PRICE', 'セールの価格: ');
  define('TEXT_FREE', '無料');
  define('TEXT_CALL_FOR_PRICE', '価格についてお問い合わせください');
  define('TEXT_SAVE_CHANGES','変更を保存する:');

  define('TEXT_INFO_ID', 'ID#');
  define('TEXT_INFO_ALLOW_ADD_TO_CART_NO', 'カートに追加されていません');

  define('TEXT_DELETE_ATTRIBUTES_OPTION_NAME_VALUES', '以下のオプションのオプション値を全て削除しますか？');
  define('TEXT_INFO_PRODUCT_NAME', '<strong>商品名: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_NAME', '<strong>オプション名: </strong>');
  define('TEXT_INFO_PRODUCTS_OPTION_ID', '<strong>ID#</strong>');
  define('SUCCESS_ATTRIBUTES_DELETED_OPTION_NAME_VALUES', '以下のオプションのオプション値を全て削除しました。: ');
?>
