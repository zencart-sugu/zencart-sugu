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
//  $Id: options_values_manager.php 1148 2005-04-07 19:24:10Z drbyte $
//

define('HEADING_TITLE_OPT', '商品オプション値の管理');
define('HEADING_TITLE_VAL', '商品オプション値の管理');
define('HEADING_TITLE_ATRIB', '商品属性');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_PRODUCT', '商品名');
define('TABLE_HEADING_OPT_NAME', 'オプション名');
define('TABLE_HEADING_OPT_VALUE', 'オプション値');
define('TABLE_HEADING_OPT_PRICE', '価格');
define('TABLE_HEADING_OPT_PRICE_PREFIX', '接頭辞(Prefix)');
define('TABLE_HEADING_ACTION', '操作');
define('TABLE_HEADING_DOWNLOAD', 'ダウンロード商品:');
define('TABLE_TEXT_FILENAME', 'ファイル名:');
define('TABLE_TEXT_MAX_DAYS', 'ダウンロード期限:');
define('TABLE_TEXT_MAX_COUNT', '最高ダウンロード回数:');

define('TEXT_WARNING_OF_DELETE', 'このオプションにリンクされた商品・オプション価があります。削除するとエラーが出る可能性があります。');
define('TEXT_OK_TO_DELETE', 'このオプションにリンクされた商品・価はありません。削除可能です。');
define('TEXT_OPTION_ID', 'オプションID');
define('TEXT_OPTION_NAME', 'オプション名');
define('TABLE_HEADING_OPT_DISCOUNTED','ディスカウント');

define('ATTRIBUTE_WARNING_DUPLICATE','属性を複製 - 属性は追加されませんでした。'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_DUPLICATE_UPDATE','属性の複製は存在します - 属性は変更されませんでした。'); // attributes duplicate warning
define('ATTRIBUTE_WARNING_INVALID_MATCH','属性オプションとオプション値が一致しません - 属性は追加されませんでした。'); // miss matched option and options value
define('ATTRIBUTE_WARNING_INVALID_MATCH_UPDATE','属性オプションとオプション値が一致しません - 属性は追加されませんでした。'); // miss matched option and options value
define('ATTRIBUTE_POSSIBLE_OPTIONS_NAME_WARNING_DUPLICATE','可能な複製オプション名が追加されました(Possible Duplicate Options Name Added)。'); // Options Name Duplicate warning
define('ATTRIBUTE_POSSIBLE_OPTIONS_VALUE_WARNING_DUPLICATE','可能な複製オプション値が追加されました(Possible Duplicate Options Value Added)。'); // Options Value Duplicate warning

define('PRODUCTS_ATTRIBUTES_EDITING','編集'); // title
define('PRODUCTS_ATTRIBUTES_DELETE','削除'); // title
define('PRODUCTS_ATTRIBUTES_ADDING','新しい属性の追加'); // title
define('TEXT_DOWNLOADS_DISABLED','NOTE: ダウンロード機能オフ');

define('TABLE_TEXT_MAX_DAYS_SHORT', 'ダウンロード期限:');
define('TABLE_TEXT_MAX_COUNT_SHORT', 'ダウンロード可能回数:');

  define('TABLE_HEADING_OPTION_SORT_ORDER','ソート順');
  define('TABLE_HEADING_OPTION_VALUE_SORT_ORDER','デフォルト順');
  define('TEXT_SORT',' Order: ');

  define('TABLE_HEADING_OPT_WEIGHT_PREFIX','接頭辞(Prefix)');
  define('TABLE_HEADING_OPT_WEIGHT','重量');
  define('TABLE_HEADING_OPT_SORT_ORDER','ソート順');
  define('TABLE_HEADING_OPT_DEFAULT','デフォルト');

  define('TABLE_HEADING_YES','はい');
  define('TABLE_HEADING_NO','いいえ');

  define('TABLE_HEADING_OPT_TYPE', 'オプションのタイプ'); //CLR 031203 add option type column
  define('TABLE_HEADING_OPTION_VALUE_SIZE','サイズ');
  define('TABLE_HEADING_OPTION_VALUE_MAX','最高');
  define('TABLE_HEADING_OPTION_VALUE_ROWS','列');
  define('TABLE_HEADING_OPTION_VALUE_COMMENTS','コメント');

  define('TEXT_OPTION_VALUE_COMMENTS','コメント: ');
  define('TEXT_OPTION_VALUE_SIZE','表示サイズ: ');
  define('TEXT_OPTION_VALUE_MAX','最長: ');

  define('TEXT_ATTRIBUTES_IMAGE','属性の画像見本:');
  define('TEXT_ATTRIBUTES_IMAGE_DIR','属性の画像ディレクトリ:');

  define('TEXT_ATTRIBUTES_FLAGS','属性<br />フラグ:');
  define('TEXT_ATTRIBUTES_DISPLAY_ONLY', '使用目的<br />表示のみ:');
  define('TEXT_ATTRIBUTES_IS_FREE', '属性は無料<br />商品が無料の際は:');
  define('TEXT_ATTRIBUTES_DEFAULT', 'デフォルト属性<br />マーク・選択されているもの:');
  define('TEXT_ATTRIBUTE_IS_DISCOUNTED', '同じディスカウントを適用<br />商品に使用:');
  define('TEXT_ATTRIBUTE_PRICE_BASE_INCLUDED','ベース価格に含む<br />属性によって価格決定の場合');

  define('TEXT_PRODUCT_OPTIONS_INFO','商品オプションの追加設定');

// Option Names/Values copier from one to another
  define('TEXT_OPTION_VALUE_COPY_ALL', '<strong>オプション名と値が...の商品を全てコピーする</strong>');
  define('TEXT_INFO_OPTION_VALUE_COPY_ALL', '商品に現在登録されているオプション名と値を選択してください。もしくは存在するオプション名かと値から、新たなオプション名と値をコピーしたい商品を選択してください。');
  define('TEXT_SELECT_OPTION_FROM', '適合するオプション名:');
  define('TEXT_SELECT_OPTION_VALUES_FROM', '適合するオプション値:');
  define('TEXT_SELECT_OPTION_TO', '追加するオプション名:');
  define('TEXT_SELECT_OPTION_VALUES_TO', '追加するオプション値:');
  define('TEXT_SELECT_OPTION_VALUES_TO_CATEGORIES_ID', '空欄にしておくか、更新したい商品のカテゴリーIDを入力してください');//Leave blank for ALL Products or<br />enter a Category ID for Products to update

// Option Name/Value to Option Name for Category with Product defaults
  define('TEXT_OPTION_VALUE_COPY_OPTIONS_TO', '<strong>既存のオプション名からオプション名と値を商品にコピーする</strong>');//<strong>Copy Option Name/Value to Products with existing Option Name ...</strong>
  define('TEXT_INFO_OPTION_VALUE_COPY_OPTIONS_TO', '商品に現在登録されているオプション名と値を選択してください。
もしくは選択されたカテゴリー内にある、希望するオプション名を持った商品を選択してください<br />
<strong>例:</strong>オプション名追加:色のOption値:赤を全てに適用、オプション名:Size
<strong>例:</strong>オプション名追加:ProductIDが34のvalue値を持つ商品の色のoption値:緑
<strong>例:</strong>オプション名追加:ProductIDが34のvalue値を持つ商品の色のoption値:緑CategoryIDのサイズ:65
        ');

  define('TEXT_SELECT_OPTION_TO_ADD_TO', '追加する先のオプション名:');
  define('TEXT_SELECT_OPTION_FROM_ADD', '追加するオプション名:');
  define('TEXT_SELECT_OPTION_VALUES_FROM_ADD', '追加するオプション値:');
  define('TEXT_SELECT_OPTION_FROM_PRODUCTS_ID', 'ProductID #の初期アトリビュート値もしくは初期値がない場合は空白:');
  define('TEXT_COPY_ATTRIBUTES_CONDITIONS','<strong>既存の商品アトリビュートはどのようにしますか?</strong>');
  define('TEXT_COPY_ATTRIBUTES_DELETE','<strong>削除</strong> 先に削除してから、新しいアトリビュートを付けてください。');
  define('TEXT_COPY_ATTRIBUTES_UPDATE','<strong>更新</strong> 新しい設定と価格で既存のアトリビュートを更新する。');
  define('TEXT_COPY_ATTRIBUTES_IGNORE','<strong>無視</strong> 既存のアトリビュートを無視し、新しいアトリビュートのみを追加する');

  define('TEXT_INFO_FROM', ' から: ');
  define('TEXT_INFO_TO', ' へ: ');
  define('ERROR_OPTION_VALUES_COPIED', 'エラー: 無効なオプション名とオプション値です');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH', 'エラー: 選択されたオプション名とオプション値が適合しません。');
  define('ERROR_OPTION_VALUES_NONE', 'エラー: コピーするものがありません');
  define('SUCCESS_OPTION_VALUES_COPIED', 'コピーは成功しました! ');
  define('ERROR_OPTION_VALUES_COPIED_MISMATCH_PRODUCTS_ID', 'エラー: Products ID#のオプション名とオプション値が失われています');//Missing Option Name/Value for Products ID#

  define('TEXT_OPTION_VALUE_DELETE_ALL', '<strong>オプション名と値が...である全ての商品のアトリビュートを削除する</strong>');//Delete Matching Attribute from ALL Products where Option Name and Value ...
  define('TEXT_INFO_OPTION_VALUE_DELETE_ALL', '商品に存在するオプション名とオプション値を選択してください、もしくは特定の商品カテゴリの中から消去したい商品を全て選択してください。');
  define('TEXT_SELECT_DELETE_OPTION_FROM', '適合するオプション名:');
  define('TEXT_SELECT_DELETE_OPTION_VALUES_FROM', '適合するオプション値:');

  define('ERROR_OPTION_VALUES_DELETE_MISMATCH', 'エラー: 選択されたオプション名とオプション値が適合しません');

  define('SUCCESS_OPTION_VALUES_DELETE', '成功l: :の削除 ');
?>