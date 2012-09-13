<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) Voyager Japan, Inc. All rights reserved.               |
// | Author Yuki SHIDA                                                    |
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
define('MODULE_EASY_ADMIN_PRODUCTS_TITLE',                        'Easy Product Management Module');
define('MODULE_EASY_ADMIN_PRODUCTS_DESCRIPTION',                  'Provides the ability to easily handle the goods.');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_TITLE',                 'Activating Easy Product Management Module');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_DESCRIPTION',           '"Easy Product Management Module" is activate when, \'True\' Please select.');
define('MODULE_EASY_ADMIN_PRODUCTS_MAX_ADDITIONAL_IMAGES_TITLE',       '追加画像の最大個数');
define('MODULE_EASY_ADMIN_PRODUCTS_MAX_ADDITIONAL_IMAGES_DESCRIPTION', '追加画像の最大個数を指定します');
define('MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_TITLE',             'Sort Order');
define('MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_DESCRIPTION',       'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('BOX_ADDON_MODULES_EASY_ADMIN_PRODUCTS',                   'Easy Product Management');

define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_TITLE',                'Easy Product Management');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_CATEGORY',                'Category');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_TITLE',                   'Products Title');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_MODEL',                   'Products Model');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_MANUFACTURER',            'Products Manufacturer');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_DESCRIPTION',             'Products Description');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_SPECIAL',                 'Special Products');

// for list
// MODULE_EASY_ADMIN_PRODUCTS_HEADING_0, 1, 2, ...
// 
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_0',                    'Category');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_1',                    'Products Name');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_2',                    'Products Model');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_3',                    'Products Price');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_4',                    'Quantity of Stock');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_5',                    'Status');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_6',                    'Sort Order');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_7',                    'Action');
define('MODULE_EASY_ADMIN_PRODUCTS_SEARCH',                       'Search');
define('MODULE_EASY_ADMIN_PRODUCTS_SEARCH_BTN',                       '../includes/addon_modules/easy_admin_products/images/button_search.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT',                       'New Product');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT_BTN',                       '../includes/addon_modules/easy_admin_products/images/button_new_product_add.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_LIST',                         'Back to Products List');

define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT',              'Select');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_ON',                    'Status On');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_OFF',                   'Status Off');

// category list
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_LIST',          '*Select Category From List');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_SEARCH',        '*Select Category To Search');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND',              'Expand');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT',              'Select');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP',                 'Top');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE',            '&nbsp;>&nbsp;');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT',              '【%s】');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_NAME',                'Category Name');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEARCH',              'Search');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_DROP',                'Drop');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_RESET',               'Reset');
define('MODULE_EASY_ADMIN_WINDOW_CLOSE_IMG',                      '../includes/addon_modules/easy_admin_products/images/icon_close.gif');
define('MODULE_EASY_ADMIN_WINDOW_CLOSE_ALT',                      'Close');

// special list
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SELECT',               '[Special Product Refine]');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DOWNLOAD',             'Download Products');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_FEATURED',             'Featured Products');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SPECIAL',              'Specials');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_QUANTITY',             'Quantity Discounts Products');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_ARRIVAL',              'Schedule of Arrival of Products');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DISPLAY',              'Display Products');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_NONDISPLAY',           'No Display Products');

// controll
define('MODULE_EASY_ADMIN_PRODUCTS_EDIT',                         'Edit');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE',                       'Delete');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_BTN',                   '../includes/addon_modules/easy_admin_products/images/button_delete.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY',                         'Copy');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_BTN',                     '../includes/addon_modules/easy_admin_products/images/button_copy.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL',                        'XSell');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_BTN',                    '../includes/addon_modules/easy_admin_products/images/button_xsel.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_STOCK',                        'Stock');
define('MODULE_EASY_ADMIN_PRODUCTS_STOCK_BTN',                    '../includes/addon_modules/easy_admin_products/images/button_stock.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_SAVE',                         'Save');
define('MODULE_EASY_ADMIN_PRODUCTS_CANCEL',                       'Cancel');
define('MODULE_EASY_ADMIN_PRODUCTS_CANCEL_BTN',                   '../includes/addon_modules/easy_admin_products/images/button_cancel.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_ADD',                          'Add');
define('MODULE_EASY_ADMIN_PRODUCTS_ADD_BTN',                      '../includes/addon_modules/easy_admin_products/images/button_add.gif');

// products
define('MODULE_EASY_ADMIN_PRODUCTS_INDISPENSABILITY',             '<font color="red">Required</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_YES',                          'Yes');
define('MODULE_EASY_ADMIN_PRODUCTS_NO',                           'No');
define('MODULE_EASY_ADMIN_PRODUCTS_DATE_START',                   'Start Date');
define('MODULE_EASY_ADMIN_PRODUCTS_DATE_END',                     'End Date');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_STARTDATE',            'Start Date (YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ENDDATE',              'End Date (YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT_TITLE',                 'New Products Registration');
define('MODULE_EASY_ADMIN_PRODUCTS_UPDATE_TITLE',                 'A Existing Product Modify');
define('MODULE_EASY_ADMIN_PRODUCTS_BASE_TITLE',                   '*Basic Setting');
define('MODULE_EASY_ADMIN_PRODUCTS_PRICE_TITLE',                  '*Price Details Setting');
define('MODULE_EASY_ADMIN_PRODUCTS_SHIPPING_TITLE',               '*Delivery Setting');
define('MODULE_EASY_ADMIN_PRODUCTS_CART_TITLE',                   '*Additional Cart Setting');
define('MODULE_EASY_ADMIN_PRODUCTS_SEO_TITLE',                    '*SEO Setting');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_STATUS',               'Status:');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_1',                     'Display');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_0',                     'No Display');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_MODEL',                'Model:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_NAME',                 'Products Name:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_TAX',                  'Tax Type:');
define('MODULE_EASY_ADMIN_PRODUCTS_TAX_0',                        'None');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_PRICE',                'Price(Net):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_GROSS',                'Price(Gross):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_IMAGE',                'Image:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_IMAGE_NOTE',           '<br/><font color="red">アップロードする画像の拡張子が現在アップロード済みのものと異なる場合は、<br/>再度追加画像をアップロードしてください</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ADD_IMAGE',            '追加画像:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ADD_IMAGE_NOTE',       '<br/><font color="red">追加画像はメイン画像と同じ拡張子に自動的に変換されます</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD',               'Upload Directory:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD_NOTE',          '<br/>Do you want to overwrite the existing option image?<br/>If you do not want to overwrite [No] to select and please setting existing file with different name at [Option Image].<br/>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_DESCRIPTION',          'Products Description:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY',             'Products Quantity:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_WEIGHT',               'Products Weight:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_CATEGORY',             'Category:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SORT',                 'Sort Order:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_MANUFACTURER',         'Products Manufacturer:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_URL',                  'Products URL:');
define('MODULE_EASY_ADMIN_PRODUCTS_MANUFACTURER_0',               '--none--');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_DATE_AVAILABLE',       'Date Available(YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_FEATURED',             'Featured Products:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_OPTION',               '商品属性による価格:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_OPTION_TEXT',          '設定(別ウィンドウで開きます)');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_OPTION_NOSAVE',        '<font color="red">保存後に設定可能です</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS',             'Specials:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION',      'Special Price Setting:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_0',    'Disable');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_1',    'Option pricing');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_2',    'Product is Free');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_3',    'Product is Call for Price');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL',              'Product is Virtual');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_1',            'Yes, Skip Shipping Address');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_0',            'No, Shipping Address Required');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING',             'Always Free Shipping');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_1',           'Yes, Always Free Shipping');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_0',           'No, Normal Shipping Rules');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_2',           'Special, Product/Download Combo Requires a Shipping Address');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX',              'Products Quantity Box Shows:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_1',            'Yes, Show Quantity Box');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_0',            'No, Do not show Quantity Box');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MIN',            'Product Qty Minimum:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX',            'Product Qty Maximum:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX_NOTE',       '0 = Unlimited, 1 = No Qty Boxes');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_UNIT',           'Product Qty Units:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY_MIX',         'Product Qty Min/Unit Mix:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE',       '&lt;title&gt;Tag:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE_NOTE',  'Choose to insert the specified information<br/>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_NAME',            'Products Name:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TITLE',           'Title:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_MODEL',           'Model:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_PRICE',           'Price:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAGLINE',         'Predefined Tagline:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_IMMIDIATE',       'Immediate Specify');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_KEYWORD',     '&lt;meta&gt;Tag(keywords):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_DESCRIPTION', '&lt;meta&gt;Tag(description):');

// open/close
define('MODULE_EASY_ADMIN_PRODUCTS_OPEN',                         '--- [Open] ---');
define('MODULE_EASY_ADMIN_PRODUCTS_CLOSE',                        '--- [Close] ---');

// delete
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_TITLE',                 'Do you want to really delete a product?');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_IMAGE',                 '次の画像を削除しますか？');

// copy
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_TITLE',                   'Copying Products');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_CATEGORY_ORIGINAL',       '<strong>現カテゴリ</strong>');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_CATEGORY',                '<strong>カテゴリ</strong>　<font color="red">必須</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_SELECT_TXT',              '');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_NOTE',                    'Please choose the category you want to copy products [%s]');

// error
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_MODEL',                  'Products model is required');
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_MODEL_ALREADY_EXISTS',   'この型番は他の商品で使われています');
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_CATEGORIES',             'Please select at least one category');

// notice
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_ERROR_SAVE',            'An Error occurred when saving');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_STATUS',                'Status Changed');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_INSERT',                'Product Created');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_UPDATE',                'Product Saved');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_DELETE',                'Deleted %s');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_COPY',                  '%s were copied to %s.');

// xsell
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_HEADING_TITLE',          '関連商品');
define('MODULE_EASY_ADMIN_PRODUCTS_TEXT_SETTING_SELLS',           '関連商品を設定する商品');
define('MODULE_EASY_ADMIN_PRODUCTS_TEXT_PRODUCT_ID',              '商品ID');

define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_TARGET',                   '検索対象');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_KEYWORD',                  'キーワード');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_NAME',        '商品名');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_DESCRIPTION', '商品説明文');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_MODEL',       '商品コード');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_BUTTON',                   '検索');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_RESET_BUTTON',             '絞込解除');
define('MODULE_EASY_ADMIN_PRODUCTS_TEXT_CROSS_SELL',                            '関連商品');

define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_ID',      '商品ID');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_MODEL',   '商品型番');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_NAME',    '商品名');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_IMAGE',   '商品画像');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_PRICE',   '商品価格');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_SORT',    'ソート順');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_CROSS_SELL_THIS', 'この商品を、関連商品にしますか？');

define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_CURRENT_SELLS',   '現在の関連商品');
define('MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_UPDATE_SELLS',    '関連商品の更新');

define('MODULE_EASY_ADMIN_PRODUCTS_CROSS_SELL_SUCCESS',            '関連商品情報を更新しました。商品ID #'.$_GET['add_related_product_ID']);
define('MODULE_EASY_ADMIN_PRODUCTS_SORT_CROSS_SELL_SUCCESS',       '関連商品のソート順を更新しました。商品ID #'.$_GET['add_related_product_ID']);

// attribute
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_EDIT',              'オプション属性編集');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_0',         'ID');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_1',         'オプション名');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_2',         'オプション値');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_3',         '±価格');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_4',         '±重量');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_5',         '整理順');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_6',         '属性フラグ');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_7',         '合計値引き額');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_OPERATION', '操作');

define('LEGEND_ATTRIBUTES_DISPLAY_ONLY',       '参照のみ');
define('LEGEND_ATTRIBUTES_IS_FREE',            '無料');
define('LEGEND_ATTRIBUTES_DEFAULT',            'デフォルト');
define('LEGEND_ATTRIBUTE_IS_DISCOUNTED',       '値引きされた');
define('LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED', '基本価格');
define('LEGEND_ATTRIBUTES_REQUIRED',           '要求事項');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_ERROR_SAVE', '保存時にエラーが発生しました');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_STATUS',     '属性フラグを変更しました');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_INSERT',     'オプション属性を追加しました');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_UPDATE',     'オプション属性の編集が完了しました');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_DELETE',     '%sを削除しました');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_DELETE_OPTION', '%s のグループを削除しました');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_TITLE',      'オプションの新規作成');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_EDIT_TITLE',        'オプションの編集');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_SETTING',    '■オプションの設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_NAME',       'オプション名');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_VALUE',      'オプション値');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_NAME_BTN', 'options_name_manager.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_NAME', 'オプション名追加');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_VALUE_BTN', 'options_values_manager.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_VALUE', 'オプション値追加');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_AND_WEIGHT_SETTING', '■価格と重量の設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE',             '価格');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT',            '重量');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_SORT_ORDER',        '整理順');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_PLUS', '商品価格に加算する');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_MINUS', '商品価格から減算する');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_REPLACE', '商品価格を置き換える');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_PLUS', '商品重量に加算する');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_MINUS', '商品重量から減算する');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_REPLACE', '商品重量を置き換える');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_STATUS_SETTING',    '■属性フラグ');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DISPLAY_ONLY', '表示のみ');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRODUCT_ATTRIBUTE_IS_FREE', '商品が無料商品のとき属性による価格も無料にする');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DEFAULT', 'デフォルトで
選択される');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DISCOUNTED', '属性による価格増減にも特価/セールの割引を適用する');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_PRICE_BASE_INCLUDED', '属性による価格増減をベース価格に含める');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_REQUIRED', 'テキスト入力を必須にする');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_SETTING', '■特殊な値引き設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_ONETIME',     'ワンタイム値引の値引金額');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_TITLE', 'プライスファクター／オフセット');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR',      'プライスファクター');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_OFFSET', 'オフセット');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME_TITLE', 'ワンタイムプライスファクター／オフセット');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME', 'ワンタイムプライスファクター');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME_OFFSET', 'ワンタイムオフセット');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES_SETTING', '■ボリュームディスカウント設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES',        'オプションの数量値引設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES_ONETIME', 'オプションのワンタイム数量値引設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS_SETTING', '■テキストオプションの設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS',       '単語毎の価格');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS_FREE',  '無料の最大単語数');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_LETTERS',     '文字毎の価格');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_LETTERS_FREE', '無料の最大文字数');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_SETTING',     '■オプション画像の設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE',             'オプション画像');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_DIR',         '保存ディレクトリ');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_OVERWRITE',   '既存のオプション画像を上書きしますか？');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_OVERWRITE_DESCRIPTION', '上書きしたくない場合は[いいえ]を選択して、既存ファイルとは異なる名前のファイルを[オプション画像]に指定してください。');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_DOWNLOAD_SETTING',  '■ダウンロードオプションの設定');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FILENAME',          'ダウンロード商品 ファイル名');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAXDAYS',           '有効期間(日)');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAXCOUNT',          '最大ダウンロード数');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING',      '--[開く]--');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CLOSE_SETTING',     '--[閉じる]--');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CREATE',            '新規追加');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT',            '挿入');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_UPDATE',            '更新');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CANCEL_BTN',        'button_cancel.gif');

define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_DELETE_TITLE',      '本当にオプション属性を削除しますか?');
define('MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_DELETE_OPTION_TITLE', '以下のオプションのオプション値を全て削除しますか？');

define('MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_ID',                  '商品ID');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_NAME',                '商品名');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_MODEL',               '型番');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY',                    '個数');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_SKUMODEL',                    'SKU型番');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY_FOR_ALL_VARIANTS',   '全体在庫数');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_ADD_QUANTITY',                'SKU在庫の追加');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_SYNC_QUANTITY',               '在庫数の反映');

define('MODULE_EASY_ADMIN_PRODUCTS_PWA_STOCK_ID',                    '在庫管理ID');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_VARIANT',                     'オプション組み合わせ');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY_IN_STOCK',           '在庫個数');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_EDIT',                        '修正');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE',                      '削除');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_SUBMIT',                      '更新');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_CANCEL',                      'キャンセル');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_SEARCH',                      '検索');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_RESET',                       'リセット');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_ACTION',                      '操作');

define('MODULE_EASY_ADMIN_PRODUCTS_PWA_EDIT_QUANTITY',               '在庫個数修正');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT',              'SKU在庫削除');

define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_CONFIRMATION', 'オプション組み合わせの在庫を削除してもいいですか？');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_PROCESSED',    'オプション組み合わせの在庫が削除されました');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_YES',          'はい');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_NO',           'いいえ');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_UPDATE_PARENT_PROCESSED',     '親在庫数が更新されました');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_UPDATE_VARIANT_PROCESSED',    '在庫数が更新されました');
define('MODULE_EASY_ADMIN_PRODUCTS_PWA_SKU_NOT_DEFINED',             'この商品のSKU在庫は定義されていません。<br />
「SKU在庫の追加」から追加してください。');

// categories
define('BOX_ADDON_MODULES_EASY_ADMIN_PRODUCTS_CATEGORIES',        'かんたんカテゴリ管理');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_TITLE',     'かんたんカテゴリ管理');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_0',         'ID');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_1',         'カテゴリ名');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_2',         '商品一覧へ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_3',         'ステータス');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_4',         'ソート順');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_0',  'ID');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_1',  'カテゴリパス');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_2',  '商品一覧へ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_3',  'ステータス');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_4',  'ソート順');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_OPERATION', '操作');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_LINK_TO_PRODUCTS',  '商品一覧へ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_CREATE_BTN',        '<img src="../includes/addon_modules/easy_admin_products/images/button_new_category.gif" alt="新しい>カテゴリの追加" />');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_ICON_PLUS',         'サブカテゴリへ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SETFLAG_TITLE',     '以下のカテゴリのステータスを変える');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_WARNING',    '<strong>警告...</strong><br />注意: カテゴリを無効にすると、このカテゴリに属する全商品が無効になります。このカテゴリ内にあり、他のカテゴリにリンクしている商品も無効になります。');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_INTRO',      'カテゴリのステータスを以下に変える:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_INFO',       '全商品のステータスを以下に変える:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_ON',         'オン');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_OFF',        'オフ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_NOCHANGE',   '変更なし');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_SETFLAG',    'ステータスを変更しました');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_SETFLAG_FAILED', 'ステータスを変更できませんでした');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_TITLE',      'カテゴリを削除');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_INTRO',      'このカテゴリを本当に削除しますか?');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_INTRO_LINKED_PRODUCTS', '<strong>警告:</strong> このカテゴリ配下の商品について、「マスターカテゴリーID」がこのカテゴリを指定していると、カテゴリ削除後にリンク商品の金額が適切にならないことがあります。
リンク商品がこのカテゴリ配下に含まれる場合は、予めもう一方のカテゴリを「マスターカテゴリーID」として設定しておくべきです。<br />
<br />
<strong>注意:</strong> このカテゴリ配下の商品について、他のカテゴリにリンクされていなければその商品は自動的に削除されます。');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_DELETE',     '%sを削除しました');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_BACK_TO_LIST',      '[カテゴリ一覧に戻る]');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_BASIC_SETTING',     '■基本設定:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS',            'ステータス:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NAME',              'カテゴリ名:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_IMAGE',             '画像:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_IMAGE_DIR',         'アップロード先ディレクトリ:');
define('TEXT_IMAGE_NONEXISTENT',            '画像が存在しません。');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DESCRIPTION',       'カテゴリ説明');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SORT_ORDER',        'ソート順:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_SETTING',    '■ヘッダ情報定義');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_TITLE',      'タイトル:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_META_KEYWORDS', 'Metaタグ(keywords)');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_META_DESCRIPTION', 'Metaタグ(Description)');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_INSERT',     'カテゴリを追加しました。');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_UPDATE',     'カテゴリの編集が完了しました。');

// カテゴリ検索
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_TREE',              'カテゴリツリー');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH',            'カテゴリ検索');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_TITLE',      '検索:');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_CATEGORIES_NAME', 'カテゴリ名');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_CATEGORIES_DESCRIPTION', 'カテゴリ説明');
?>
