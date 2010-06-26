<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 */

define('CROSS_SELL_SUCCESS', '関連商品情報を更新しました。商品ID #'.$_GET['add_related_product_ID']);
define('SORT_CROSS_SELL_SUCCESS', '関連商品のソート順を更新しました。商品ID #'.$_GET['add_related_product_ID']);
define('HEADING_TITLE', '関連商品管理');
define('TABLE_HEADING_PRODUCT_ID', '商品ID');
define('TABLE_HEADING_PRODUCT_MODEL', '商品型番');
define('TABLE_HEADING_PRODUCT_NAME', '商品名');
define('TABLE_HEADING_CURRENT_SELLS', '現在の関連商品');
define('TABLE_HEADING_UPDATE_SELLS', '関連商品の更新');
define('TABLE_HEADING_PRODUCT_IMAGE', '商品画像');
define('TABLE_HEADING_PRODUCT_PRICE', '商品価格');
define('TABLE_HEADING_CROSS_SELL_THIS', 'この商品を、関連商品にしますか？');
define('TEXT_EDIT_SELLS', '更新する');
define('TEXT_SORT', 'ソート順');
define('TEXT_SETTING_SELLS', '関連商品を設定する商品');
define('TEXT_PRODUCT_ID', '商品ID');
define('TEXT_MODEL', '型番');
define('TABLE_HEADING_PRODUCT_SORT', 'ソート順');
define('TEXT_NO_IMAGE', 'No Image');
define('TEXT_CROSS_SELL', '関連商品');

define('TABLE_DATA_PARENT_PRODUCT_PRICE_MARK', '-');
define('XSELL_TITLE_UPLOAD_FILE', 'CSV からの一括設定');
define('XSELL_CMD_LABEL_UPLOAD', 'アップロード');
define('XSELL_TEXT_BACK_TO_MAIN', '一覧に戻る');
define('XSELL_TITLE_UPLOAD_FILE', 'ファイルのアップロード');
define('XSELL_UPLOAD_FILE', 'ファイルがアップロードされました. ');
define('XSELL_UPLOAD_TEMP', '一時ファイル名: ');
define('XSELL_UPLOAD_USER_FILE', 'ユーザーファイル名: ');
define('XSELL_SIZE', 'サイズ: ');
define('XSELL_UPLOAD_ERR_ALREADY_HAS_RELATION', '既に関連付けされています');
define('XSELL_UPLOAD_ERR_PRODUCT_NOT_FOUND', '商品が見つかりません');
define('XSELL_UPLOAD_OK_RELATED', '成功');
define('XSELL_TEXT_SEARCH_TARGET', '検索対象: ');
define('XSELL_TEXT_SEARCH_KEYWORD', 'キーワード: ');
define('XSELL_TEXT_SEARCH_BUTTON', '検索');
define('XSELL_TEXT_SEARCH_RESET_BUTTON', '絞込解除');
define('XSELL_TEXT_SEARCH_ITEM_PRODUCT_NAME', '商品名');
define('XSELL_TEXT_SEARCH_ITEM_PRODUCT_DESCRIPTION', '商品説明文');
define('XSELL_TEXT_SEARCH_ITEM_PRODUCT_MODEL', '商品コード');
?>