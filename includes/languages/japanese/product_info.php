<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_info.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('TEXT_PRODUCT_NOT_FOUND', '該当する商品は見つかりませんでした。');
define('TEXT_CURRENT_REVIEWS', '現在のレビュー:');
define('TEXT_MORE_INFORMATION', 'より詳しい情報は、この商品の<a href="%s" target="_blank">Webページ</a>をご覧ください');
define('TEXT_DATE_ADDED', 'この商品は%sに登録されました。');
define('TEXT_DATE_AVAILABLE', 'この商品は%sに入荷予定です。');
define('TEXT_ALSO_PURCHASED_PRODUCTS', 'この商品をお求めの客様はこんな商品もお求めです。');
define('TEXT_PRODUCT_OPTIONS', '選択して下さい: ');
define('TEXT_PRODUCT_MANUFACTURER', 'メーカー: ');
define('TEXT_PRODUCT_WEIGHT', '重量: ');
define('TEXT_PRODUCT_QUANTITY', ' 在庫量');
define('TEXT_PRODUCT_MODEL', 'モデル: ');



// previous next product
define('PREV_NEXT_PRODUCT', '商品');
define('PREV_NEXT_FROM', ' from ');
define('IMAGE_BUTTON_PREVIOUS','前のアイテム');
define('IMAGE_BUTTON_NEXT','次のアイテム');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','商品リストに戻る');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', '%sの新着商品');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', '入荷予定商品');
//define('TABLE_HEADING_DATE_EXPECTED', '登録予定日');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [は: ');
define('TEXT_ATTRIBUTE_IS_FREE',' 今なら: 無料]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' 基本料がかかります');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','数量値引があります');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');
?>
