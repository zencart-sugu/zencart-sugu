<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: shopping_cart.php 3183 2006-03-14 07:58:59Z birdbrain $
 */

define('NAVBAR_TITLE', 'ショッピングカート');
define('HEADING_TITLE', 'ショッピングカート');
define('HEADING_TITLE_EMPTY', 'ショッピングカート');
define('TEXT_INFORMATION', 'ショッピングカートには以下の商品が入っています。<br />
この内容でご注文される場合は「ご注文手続きへ進む」ボタンを、続けて他の商品をご覧になる場合は「お買い物を続ける」ボタンを押してください。');
define('TABLE_HEADING_REMOVE', '削除');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_MODEL', 'モデル');
define('TABLE_HEADING_PRICE','単価');
define('TEXT_CART_EMPTY', 'カートには何も入っていません。');
define('SUB_TITLE_SUB_TOTAL', '小計：');
define('SUB_TITLE_TOTAL', '合計：');

define('OUT_OF_STOCK_CANT_CHECKOUT', ' ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' の印がついた商品は在庫切れ、あるいはご注文数に在庫が不足してします。<br />おそれいりますが(' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ')印のついた商品のご注文数量を変更お願いいたします。');
define('OUT_OF_STOCK_CAN_CHECKOUT', '「' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '」表示の商品はご要望の数量の在庫がありません。<br />在庫数を超えた分については入荷待ちとなります。');

define('TEXT_TOTAL_ITEMS', '合計点数: ');
define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;重量: ');
define('TEXT_TOTAL_AMOUNT', '&nbsp;&nbsp;金額: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[ヘルプ (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

define('TEXT_NOT_A_NUMBER', '数量は半角の数値で入力してください');
?>