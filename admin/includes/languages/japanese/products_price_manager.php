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
//  $Id: products_price_manager.php 543 2004-11-13 19:19:29Z wilt $
//

define('HEADING_TITLE', '商品価格の管理');
define('HEADING_TITLE_PRODUCT_SELECT','価格情報を表示したい商品を選択');

define('TABLE_HEADING_PRODUCTS', '商品');
define('TABLE_HEADING_PRODUCTS_MODEL','型番');
define('TABLE_HEADING_PRODUCTS_PRICE', '商品価格/特別価格/セール価格');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','割引率(%)');
define('TABLE_HEADING_AVAILABLE_DATE', '提供開始可能日');
define('TABLE_HEADING_EXPIRES_DATE','提供終了日');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_PRODUCT_INFO', '商品情報:');
define('TEXT_PRODUCTS_PRICE_INFO', '商品価格の情報:');
define('TEXT_PRODUCTS_MODEL','型番:');
define('TEXT_PRICE', '価格');
define('TEXT_PRODUCT_AVAILABLE_DATE', '提供可能日:');
define('TEXT_PRODUCTS_STATUS', '商品のステータス:');
define('TEXT_PRODUCT_AVAILABLE', '在庫あり');
define('TEXT_PRODUCT_NOT_AVAILABLE', '在庫切れ');

define('TEXT_PRODUCT_INFO_NONE', '上のリストから商品を選択 ...');
  define('TEXT_PRODUCT_IS_FREE','無料の商品:');
  define('TEXT_PRODUCTS_IS_FREE_EDIT','<br />*「無料」マーク付きの商品');
  define('TEXT_PRODUCT_IS_CALL','価格お問い合わせ商品:');
  define('TEXT_PRODUCTS_IS_CALL_EDIT','<br />*「価格お問い合わせ」マーク付きの商品');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES','属性によって価格決定:');
  define('TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE','Yes');
  define('TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE','No');
  define('TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT','<br />*表示価格は最も安いグループ属性の価格を含む');
  define('TEXT_PRODUCTS_MIXED','最低量とユニット量を組み合わせて適応する:');
  define('TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY', '数量は同一商品であればオプション値に関係なく合算する。');

  define('TEXT_PRODUCTS_QUANTITY_MIN_RETAIL','最低量:');
  define('TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL','ユニット量:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL','最高量:');
  define('TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT','0= 無制限<br />1= 数量欄非表示');

define('TEXT_FEATURED_PRODUCT_INFO', 'おすすめ商品の情報:');
define('TEXT_FEATURED_PRODUCT', '商品:');
define('TEXT_FEATURED_EXPIRES_DATE', '提供終了日:');
define('TEXT_FEATURED_AVAILABLE_DATE', '提供開始可能日:');
define('TEXT_FEATURED_PRODUCTS_STATUS', 'おすすめ商品の情報:');
define('TEXT_FEATURED_PRODUCT_AVAILABLE', 'アクティブ');
define('TEXT_FEATURED_PRODUCT_NOT_AVAILABLE', '非アクティブ');
define('TEXT_FEATURED_DISABLED', '<strong>注意: </strong>');

define('TEXT_SPECIALS_PRODUCT', '商品:');
define('TEXT_SPECIALS_SPECIAL_PRICE', '特価商品:');
define('TEXT_SPECIALS_EXPIRES_DATE', '提供終了日:');
define('TEXT_SPECIALS_AVAILABLE_DATE', '提供開始可能日:');
define('TEXT_SPECIALS_PRICE_TIP', '<b>特価商品の注意:</b><ul><li>特価商品の価格欄にパーセンテージ(%)を入力し、割引きを表記できます。例: <b>20%</b></li><li>新価格を入力する際は、少数点は\'.\' にしてください。例: <b>49.99</b></li><li>提供終了日を未記入のままにすれば、特価商品の提供は終了しません。</li></ul>');
define('TEXT_SPECIALS_PRODUCT_INFO', '特価商品の情報:');
define('TEXT_SPECIALS_PRODUCTS_STATUS', '特価商品のステータス:');
define('TEXT_SPECIALS_PRODUCT_AVAILABLE', 'アクティブ');
define('TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE', '非アクティブ');
define('TEXT_SPECIALS_NO_GIFTS','ギフト券の場合特価を適用しない');
define('TEXT_SPECIAL_DISABLED', '<strong>注意：特価商品の情報は、現在非表示、提供終了、まだ提供開始になっていない、のいずれかです。</strong>');

define('TEXT_INFO_DATE_ADDED', '作成日:');
define('TEXT_INFO_LAST_MODIFIED', '更新日:');
define('TEXT_INFO_NEW_PRICE', '新価格:');
define('TEXT_INFO_ORIGINAL_PRICE', '元価格:');
define('TEXT_INFO_PERCENTAGE', '割引率(%):');
define('TEXT_INFO_AVAILABLE_DATE', '提供スタート:');
define('TEXT_INFO_EXPIRES_DATE', '提供終了:');
define('TEXT_INFO_STATUS_CHANGE', 'ステータス変更:');
define('TEXT_IMAGE_NONEXISTENT', '画像なし');

define('TEXT_INFO_HEADING_DELETE_FEATURED', 'おすすめ商品の削除');
define('TEXT_INFO_DELETE_INTRO', 'このおすすめ商品を本当に削除しますか?');

  define('TEXT_ATTRIBUTES_INSERT_INFO', '<strong>属性を設定し、「設定」ボタンを押してください。</strong>');
  define('TEXT_PRICED_BY_ATTRIBUTES', '属性によって価格を決定');
  define('TEXT_PRODUCTS_PRICE', '商品価格: ');
  define('TEXT_SPECIAL_PRICE', '特別価格: ');
  define('TEXT_SALE_PRICE', 'セール価格: ');
  define('TEXT_FREE', '無料');
  define('TEXT_CALL_FOR_PRICE', '価格お問い合わせ');

define('TEXT_ADD_ADDITIONAL_DISCOUNT', DISCOUNT_QTY_ADD . ' レベルの割引レベルを追加する');
define('TEXT_BLANKS_INFO','全ての0 の割引レベルは更新の際に削除されます');
define('TEXT_INFO_NO_DISCOUNTS', '大量割引はまだ作成されていません');
define('TEXT_PRODUCTS_DISCOUNT_QTY_TITLE', '割引レベル');
define('TEXT_PRODUCTS_DISCOUNT','割引');
define('TEXT_PRODUCTS_DISCOUNT_QTY','最小限の有効数量');
define('TEXT_PRODUCTS_DISCOUNT_PRICE','割引の値');
define('TEXT_PRODUCTS_DISCOUNT_TYPE','タイプ');

define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH','価格を計算:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED','拡張された価格Extended Price:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX','価格を<br />計算する: &nbsp; 税込み:');
define('TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX','拡張された<br />価格: &nbsp; 税込み:');

define('TEXT_EACH','ea.');
define('TEXT_EXTENDED','トータル');

define('TEXT_DISCOUNT_TYPE_INFO', 'ディスカウント価格の情報');
define('TEXT_DISCOUNT_TYPE','ディスカウントタイプ:');
define('TEXT_DISCOUNT_TYPE_FROM', 'この価格からディスカウント:');

define('DISCOUNT_TYPE_DROPDOWN_0','なし');
define('DISCOUNT_TYPE_DROPDOWN_1','割引率(%)');
define('DISCOUNT_TYPE_DROPDOWN_2','割引き後価格');
define('DISCOUNT_TYPE_DROPDOWN_3','一定金額割引き');

define('DISCOUNT_TYPE_FROM_DROPDOWN_0','価格');
define('DISCOUNT_TYPE_FROM_DROPDOWN_1','特価');

define('TEXT_UPDATE_COMMIT','現在表示されている内容を確定する');

define('TEXT_PRODUCTS_TAX_CLASS', '税の種別:');

define('TEXT_INFO_MASTER_CATEGORIES_ID_WARNING', '<strong>警告：</strong> 商品のマスターカテゴリID# %s は現在のカテゴリID# %s と一致しないため、商品はリンクされません!');
define('TEXT_INFO_MASTER_CATEGORIES_CURRENT', ' 現在のカテゴリID# %s はマスターカテゴリID# %sと一致');
define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT', 'マスターカテゴリID# %sを現在のカテゴリID# %sと一致させるため更新');

define('PRODUCT_WARNING_UPDATE', '必要な変更を行ったら「更新」ボタンで確定してください。');
define('PRODUCT_UPDATE_SUCCESS', '商品情報の更新に成功!');
define('PRODUCT_WARNING_UPDATE_CANCEL', '変更はキャンセルされ、保存されませんでした...');
define('TEXT_INFO_EDIT_CAUTION', '<strong>編集するにはクリック ...</strong>');
define('TEXT_INFO_PREVIEW_ONLY', 'これはプレビューです：現在の価格ステータス');
define('TEXT_INFO_UPDATE_REMINDER', '<strong>商品情報を変更し、「更新」ボタンで確定してください。</strong>');
?>
