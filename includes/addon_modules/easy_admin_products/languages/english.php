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
define('MODULE_EASY_ADMIN_PRODUCTS_TITLE',                        'かんたん商品管理モジュール');
define('MODULE_EASY_ADMIN_PRODUCTS_DESCRIPTION',                  '商品を扱うための管理画面を提供します。');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_TITLE',                 'かんたん商品管理モジュールの有効化');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_DESCRIPTION',           'かんたん商品管理モジュールを有効化する場合は、「True」を選択してください。');
define('MODULE_EASY_ADMIN_PRODUCTS_MAX_ADDITIONAL_IMAGES_TITLE',       '追加画像の最大個数');
define('MODULE_EASY_ADMIN_PRODUCTS_MAX_ADDITIONAL_IMAGES_DESCRIPTION', '追加画像の最大個数を指定します');
define('MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_TITLE',             '優先順');
define('MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_DESCRIPTION',       'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('BOX_ADDON_MODULES_EASY_ADMIN_PRODUCTS',                   'かんたん商品管理');

define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_TITLE',                'かんたん商品管理');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_CATEGORY',                'カテゴリ');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_TITLE',                   '商品タイトル');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_MODEL',                   '商品型番');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_MANUFACTURER',            '商品メーカー');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_DESCRIPTION',             '商品説明');
define('MODULE_EASY_ADMIN_PRODUCTS_ITEM_SPECIAL',                 '特殊商品');

// 一覧画面のヘッダ
// MODULE_EASY_ADMIN_PRODUCTS_HEADING_0から連番とする
// defineされているのを確認し自動で表示する
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_0',                    'カテゴリ');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_1',                    '商品名');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_2',                    '型番');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_3',                    '価格');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_4',                    '在庫数');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_5',                    'ステータス');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_6',                    'ソート順');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_7',                    '操作');
define('MODULE_EASY_ADMIN_PRODUCTS_SEARCH',                       '検索');
define('MODULE_EASY_ADMIN_PRODUCTS_SEARCH_BTN',                       '../includes/addon_modules/easy_admin_products/images/button_search.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT',                       '新しい商品の追加');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT_BTN',                       '../includes/addon_modules/easy_admin_products/images/button_new_product_add.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_LIST',                         '商品一覧に戻る');

define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT',              '<img src="../includes/addon_modules/easy_admin_products/images/button_choice.gif" alt="選択">');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_ON',                    'ステータスオン');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_OFF',                   'ステータスオフ');

// カテゴリ一覧
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_LIST',          '■カテゴリを一覧から選択');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_SEARCH',        '■カテゴリを検索して選択');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND',              '<img src="../includes/addon_modules/easy_admin_products/images/icon_plus.gif" alt="展開">');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT',              '選択');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP',                 'トップ');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE',            '&nbsp;>&nbsp;');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT',              '【%s】');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_NAME',                'カテゴリ名');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEARCH',              '検索');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_DROP',                '外す');
define('MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_RESET',               'リセット');
define('MODULE_EASY_ADMIN_WINDOW_CLOSE_IMG',                      '../includes/addon_modules/easy_admin_products/images/icon_close.gif');
define('MODULE_EASY_ADMIN_WINDOW_CLOSE_ALT',                      '閉じる');

// 特殊商品
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SELECT',               '【特殊商品絞り込み】');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DOWNLOAD',             'ダウンロード商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_FEATURED',             'おすすめ商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SPECIAL',              '特価商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_QUANTITY',             '数量割引商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_ARRIVAL',              '入荷予定商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DISPLAY',              '表示商品');
define('MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_NONDISPLAY',           '非表示商品');

// 操作
define('MODULE_EASY_ADMIN_PRODUCTS_EDIT',                         '編集');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE',                       '削除');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_BTN',                   '../includes/addon_modules/easy_admin_products/images/button_delete.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY',                         'コピー');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_BTN',                     '../includes/addon_modules/easy_admin_products/images/button_copy.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL',                        '関連');
define('MODULE_EASY_ADMIN_PRODUCTS_XSELL_BTN',                    '../includes/addon_modules/easy_admin_products/images/button_xsel.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_STOCK',                        '在庫');
define('MODULE_EASY_ADMIN_PRODUCTS_STOCK_BTN',                    '../includes/addon_modules/easy_admin_products/images/button_stock.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_SAVE',                         '保存');
define('MODULE_EASY_ADMIN_PRODUCTS_CANCEL',                       'キャンセル');
define('MODULE_EASY_ADMIN_PRODUCTS_CANCEL_BTN',                   '../includes/addon_modules/easy_admin_products/images/button_cancel.gif');
define('MODULE_EASY_ADMIN_PRODUCTS_ADD',                          '追加');
define('MODULE_EASY_ADMIN_PRODUCTS_ADD_BTN',                      '../includes/addon_modules/easy_admin_products/images/button_add.gif');

// 商品
define('MODULE_EASY_ADMIN_PRODUCTS_INDISPENSABILITY',             '<font color="red">必須</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_YES',                          'はい');
define('MODULE_EASY_ADMIN_PRODUCTS_NO',                           'いいえ');
define('MODULE_EASY_ADMIN_PRODUCTS_DATE_START',                   '開始日');
define('MODULE_EASY_ADMIN_PRODUCTS_DATE_END',                     '終了日');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_STARTDATE',            '開始日(YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ENDDATE',              '終了日(YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_INSERT_TITLE',                 '新規商品登録');
define('MODULE_EASY_ADMIN_PRODUCTS_UPDATE_TITLE',                 '既存商品修正');
define('MODULE_EASY_ADMIN_PRODUCTS_BASE_TITLE',                   '■基本設定');
define('MODULE_EASY_ADMIN_PRODUCTS_PRICE_TITLE',                  '■価格詳細設定');
define('MODULE_EASY_ADMIN_PRODUCTS_SHIPPING_TITLE',               '■配送設定');
define('MODULE_EASY_ADMIN_PRODUCTS_CART_TITLE',                   '■カート追加設定');
define('MODULE_EASY_ADMIN_PRODUCTS_SEO_TITLE',                    '■SEO設定');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_STATUS',               'ステータス:');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_1',                     '表示');
define('MODULE_EASY_ADMIN_PRODUCTS_STATUS_0',                     '非表示');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_MODEL',                '型番:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_NAME',                 '商品名:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_TAX',                  '税種別:');
define('MODULE_EASY_ADMIN_PRODUCTS_TAX_0',                        'なし');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_PRICE',                '価格(税抜):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_GROSS',                '価格(税込):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_IMAGE',                '画像:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ADD_IMAGE',            '追加画像:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD',               'アップロード先ディレクトリ:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD_NOTE',          '<br/>既存のオプション画像を上書きしますか？<br/>%s<br/>上書きしたくない場合は[いいえ]を選択して、既存ファイルとは異なる名前のファイルを[オプション画像]に指定してください。<br/>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_DESCRIPTION',          '商品説明:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY',             '商品数量:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_WEIGHT',               '商品重量:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_CATEGORY',             'カテゴリ:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SORT',                 'ソート順:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_MANUFACTURER',         '商品メーカー:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_URL',                  '商品URL:');
define('MODULE_EASY_ADMIN_PRODUCTS_MANUFACTURER_0',               'なし');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_DATE_AVAILABLE',       '提供可能日(YYYY-MM-DD):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_FEATURED',             'おすすめ:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS',             '特価価格:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION',      '特価価格設定:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_0',    '無効');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_1',    '有効');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_2',    '無料商品');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_3',    '価格問い合わせ商品');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL',              'デジタル商品');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_1',            'はい、送付先住所をスキップ');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_0',            'いいえ、送付先住所が必要');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING',             '送料無料');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_1',           'はい、常に送料無料');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_0',           'いいえ、通常送料を適用');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_2',           'ダウンロード商品');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX',              '商品の数量欄の表示:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_1',            'はい、数量欄を表示');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_0',            'いいえ、数量欄は非表示');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MIN',            '商品の最小数量:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX',            '商品の最大数量:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX_NOTE',       '0=無制限&nbsp;1=商品欄非表示');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_UNIT',           '商品の数量単位:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY_MIX',         '最小数量/単位ミックス:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE',       '&lt;title&gt;タグ:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE_NOTE',  '挿入する情報を選択して指定<br/>');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_NAME',            '商品名:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TITLE',           'タイトル:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_MODEL',           'モデル:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_PRICE',           '価格:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAGLINE',         '定義済タグライン:');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_IMMIDIATE',       '直接指定');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_KEYWORD',     '&lt;meta&gt;タグ(keywords):');
define('MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_DESCRIPTION', '&lt;meta&gt;タグ(description):');

// 展開/閉じる
define('MODULE_EASY_ADMIN_PRODUCTS_OPEN',                         '--- [開く] ---');
define('MODULE_EASY_ADMIN_PRODUCTS_CLOSE',                        '--- [閉じる] ---');

// 削除
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_TITLE',                 '本当に商品を削除しますか?');
define('MODULE_EASY_ADMIN_PRODUCTS_DELETE_IMAGE',                 '次の画像を削除しますか？');

// コピー
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_TITLE',                   '商品をコピーする');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_CATEGORY_ORIGINAL',       '<strong>現カテゴリ</strong>');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_CATEGORY',                '<strong>カテゴリ</strong>　<font color="red">必須</font>');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_SELECT_TXT',              '');
define('MODULE_EASY_ADMIN_PRODUCTS_COPY_NOTE',                    '商品 %s をコピーしたいカテゴリを選んでください');

// エラー
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_MODEL',                  '型番は必須です');
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_MODEL_ALREADY_EXISTS',   'この型番は他の商品で使われています');
define('MODULE_EASY_ADMIN_PRODUCTS_ERROR_CATEGORIES',             '最低でもひとつのカテゴリを選択してください');

// notice
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_ERROR_SAVE',            '保存時にエラーが発生しました');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_STATUS',                'ステータス変更しました');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_INSERT',                '商品を作成しました');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_UPDATE',                '商品を保存しました');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_DELETE',                '%sを削除しました');
define('MODULE_EASY_ADMIN_PRODUCTS_NOTICE_COPY',                  '%sを「%s」にコピーしました');

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
