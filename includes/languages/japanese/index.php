<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 3027 2006-02-13 17:15:51Z drbyte $
 */

define('TEXT_MAIN','テンプレートファイルがない場合、このヘッドライン部分を変更するには以下のファイルを編集します。<br />
<strong>/includes/languages/japanese/index.php</strong>');

// Showcase vs Store
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', '<span class="greetUser">ゲスト</span>さん、いらっしゃいませ。<a href="%s">ログイン</a>しますか?');
} else {
  define('TEXT_GREETING_GUEST', 'ようこそ、当ショップをお楽しみください。');
}

define('TEXT_GREETING_PERSONAL', '<span class="greetUser">%s</span>様、いらっしゃいませ。商品の<a href="%s">新着情報</a>をご覧になりますか?');

define('TEXT_INFORMATION', 'この部分を変更するには、<br /><strong>/includes/languages/japanese/index.php</strong>の<strong>define(\'TEXT_I
NFORMATION\',</strong>の右側の<br />
シングルクォーテーション(\')の間を編集してください。<br />また、下部のテキストボックスのみを使用する場合は、<br /><strong>define(\'TEXT_IN
FORMATION\',\'\')</strong><br />のようにシングルクォーテーションの間には、何も記入せずに保存することで、この部分は非表示になります。');

//moved to english
//define('TABLE_HEADING_FEATURED_PRODUCTS','おすすめ商品');

//define('TABLE_HEADING_NEW_PRODUCTS', '新着商品 %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', '入荷予定商品');
//define('TABLE_HEADING_DATE_EXPECTED', '登録予定日');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  // This section deals with product-listing page contents
  define('HEADING_TITLE', '購入可能商品');
  define('TABLE_HEADING_IMAGE', '商品画像');
  define('TABLE_HEADING_MODEL', 'モデル');
  define('TABLE_HEADING_PRODUCTS', '商品名');
  define('TABLE_HEADING_MANUFACTURER', 'メーカー');
  define('TABLE_HEADING_QUANTITY', '数量');
  define('TABLE_HEADING_PRICE', '価格');
  define('TABLE_HEADING_WEIGHT', '重量');
  define('TABLE_HEADING_BUY_NOW', '今すぐ買う');
  define('TEXT_NO_PRODUCTS', 'このカテゴリの商品はありません。');
  define('TEXT_NO_PRODUCTS2', 'このメーカーの商品はありません。');
  define('TEXT_NUMBER_OF_PRODUCTS', '商品番号: ');
  define('TEXT_SHOW', '分類:');
  define('TEXT_BUY', '一つ買う \'');
  define('TEXT_NOW', '\' 今すぐ');
  define('TEXT_ALL_CATEGORIES', '全カテゴリ');
  define('TEXT_ALL_MANUFACTURERS', '全メーカー');
} elseif ($category_depth == 'top') {
  // 何も選択されていないトップレベルのホームページでの表示
  /*このヘッドラインは「○○○ショップへようこそ」など好みのコピーに変更してください。*/

  define('HEADING_TITLE', 'おめでとうございます!<br />
オンラインショップ構築ソフトZen Cart 日本語版のインストールに成功しました。');
} elseif ($category_depth == 'nested') {
  // サブカテゴリでの表示
  /*このヘッドラインは「○○○ショップへようこそ」など好みのコピーに変更してください。*/
  define('HEADING_TITLE', 'おめでとうございます!<br />
オンラインショップ構築ソフトZen Cart 日本語版のインストールに成功しました。'); 
}
?>
