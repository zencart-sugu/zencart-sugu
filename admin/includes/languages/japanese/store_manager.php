<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                                 |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: store_manager.php 2634 2005-12-20 06:56:04Z drbyte $
//
//
  define('HEADING_TITLE', 'ショップ管理ツール');
  define('TABLE_CONFIGURATION_TABLE', 'CONSTANT定義を検索');

  define('SUCCESS_PRODUCT_UPDATE_SORT_ALL', '<strong>成功</strong>: 属性のソート順を更新しました');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>成功</strong>: 商品価格のソート値を更新しました。');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED', '<strong>成功</strong>: 「商品の閲覧回数ランキング」を0にリセットしました');
  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED', '<strong>Successful</strong> 商品の順番をゼロのリセット');
  define('SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID', '<strong>成功</strong>: リンクされた商品のためのマスターカテゴリをリセットしました');
  define('SUCCESS_UPDATE_COUNTER', '<strong>成功</strong> カウンタを以下の値に更新しました: ');
  define('SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG', '<strong>成功しました</strong> 管理者のアクティビティログを更新します');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>エラー:</strong> 一致する設定キー(Configuration Keys)が見つかりません...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>エラー:</strong> 検索のための設定キーかテキストが入力されていません ... 検索を中止しました');

  define('TEXT_INFO_COUNTER_UPDATE', '<strong>カウンタを更新</strong><br />以下の新しい値に更新: ');
  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>全商品の価格ソートを更新</strong><br />表示価格でのソートを可能にするには: ');
  define('TEXT_INFO_PRODUCTS_VIEWED_UPDATE', '<strong>「商品の閲覧回数ランキング」をリセット</strong><br />「商品の閲覧回数ランキングを0にリセット: ');
  define('TEXT_INFO_PRODUCTS_ORDERED_UPDATE', '<strong>注文された商品をリセットする</strong><br />注文された商品のカウントをゼロにする: ');
  define('TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE', '<strong>全商品のマスターカテゴリIDをリセット</strong><br />リンクされた商品と価格に反映するには: ');
  define('TEXT_INFO_ADMIN_ACTIVITY_LOG', '<strong>管理者のアクティビティログテーブルをデータベースから削除<br />警告: この更新を行う前バックアップを必ず取ってください!</strong><br />管理者のアクティビティログは管理者の活動履歴を記録したものです このため非常に大きくなるため、速やかにきれいにしていく必要があります。<br />警告は60日で50000件ほど溜まります');

  define('TEXT_ORDERS_ID_UPDATE', '<strong>現在のオーダーIDをリセットする</strong>');
  define('TEXT_INFO_ORDERS_ID_UPDATE', '<strong>注意: 現在のオーダーIDをリセットする前に ...</strong><br />最初にテスト注文を行い、このオーダーIDを元に新しいオーダーIDを決めてください。<br />新しいオーダーIDは、次の実際の注文時に開始したいオーダーIDより1少ない数値を記入します(<strong>例:</strong> 次の実際のオーダーIDを「1225」から始めたければ「1224」と入力)。<br /><strong>警告:</strong> オーダーIDは増やす方向へリセットはできますが、減らす方向へリセットはできません。<br />オーダーIDを一度「25」にリセットし、再度「20」にリセットしても、次の実際のオーダーIDは「26」からになります。');
  define('TEXT_OLD_ORDERS_ID', '古いオーダーID');
  define('TEXT_NEW_ORDERS_ID', '新しいオーダーID');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>CONSTANT・ランゲージ定義ファイルを検索</strong>');
  define('TEXT_CONFIGURATION_KEY', 'キーまたは名前:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>注意:</strong> CONSTANTSは大文字です。<br />ランゲージ定義ファイルの検索でデータベーステーブルに何も見つからない場合、上級検索(alternative search)になります。');


  define('TEXT_CONFIGURATION_CONSTANT_FILES', '<strong>ランゲージ定義ファイル内を検索</strong>');
  define('TEXT_CONFIGURATION_KEY_FILES', 'テキストを探す:');
  define('TEXT_INFO_CONFIGURATION_UPDATE_FILES', '<strong>注意:</strong> ランゲージ定義ファイル内の検索は大文字・小文字いずれも可能です。');

  define('TABLE_TITLE_KEY', '<strong>キー:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>タイトル:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>説明:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>グループ:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>値:</strong>');

  define('TEXT_LANGUAGE_LOOKUPS', '言語定義ファイルの検索:');
  define('TEXT_LANGUAGE_LOOKUP_NONE', '- 未記入 -');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', '全てのランゲージファイル ' . strtoupper($_SESSION['language']) . ' - ショップページ(Catalog)/管理者ページ(Admin)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'メインの全ランゲージファイル - ショップページ(Catalog) (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', '現在選択中の全ランゲージファイル - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'メインの全ランゲージファイル - 管理者ページ(Admin) (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', '現在選択中の全ランゲージファイル - 管理者ページ(Admin) (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', '現在選択中の全ランゲージファイル - ショップページ(Catalog)/管理者ページ(Admin)');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','編集不可');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' もしくは不可視');
?>