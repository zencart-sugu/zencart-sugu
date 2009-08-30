<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: developers_tool_kit.php 1105 2005-04-04 22:05:35Z birdbrain $
//
  define('HEADING_TITLE', '開発者用ツール');
  define('TABLE_CONFIGURATION_TABLE', 'CONSTANT定義を検索');

  define('SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER', '<strong>成功</strong>: 属性のソート順を更新しました');

  define('ERROR_CONFIGURATION_KEY_NOT_FOUND', '<strong>エラー:</strong> 一致する設定キー(Configuration Keys)が見つかりません...');
  define('ERROR_CONFIGURATION_KEY_NOT_ENTERED', '<strong>エラー:</strong> 検索のための設定キーかテキストが入力されていません ... 検索を中止しました');

  define('TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE', '<strong>全商品の価格ソートを更新</strong><br />表示価格でのソートを可能にするには: ');

  define('TEXT_CONFIGURATION_CONSTANT', '<strong>CONSTANT・言語定義ファイルを検索</strong>');
  define('TEXT_CONFIGURATION_KEY', 'キーまたは名前:');
  define('TEXT_INFO_CONFIGURATION_UPDATE', '<strong>注意:</strong> CONSTANTSは大文字です。<br />ドロップダウンで選択されていれば、データベーステーブル内に何も見つからない場合、ランゲージファイル、機能(functions)、クラス(classes)その他の検索が行われます。');

  define('TABLE_TITLE_KEY', '<strong>キー:</strong>');
  define('TABLE_TITLE_TITLE', '<strong>タイトル:</strong>');
  define('TABLE_TITLE_DESCRIPTION', '<strong>説明:</strong>');
  define('TABLE_TITLE_GROUP', '<strong>グループ:</strong>');
  define('TABLE_TITLE_VALUE', '<strong>値:</strong>');

  define('TEXT_LOOKUP_NONE', '- 未記入 -');
  define('TEXT_INFO_SEARCHING', '検索中 ');
  define('TEXT_INFO_FILES_FOR', ' ファイル ... for: ');
  define('TEXT_INFO_MATCHES_FOUND', '一致する行がヒット: ');

  define('TEXT_LANGUAGE_LOOKUPS', 'ランゲージファイルの検索:');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE', '全ランゲージファイル ' . strtoupper($_SESSION['language']) . ' - ショップページ(Catalog)/管理者ページ(Admin)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG', 'メインの全ランゲージファイル - ショップページ(Catalog) (' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE', '現在選択中の全ランゲージファイル - ' . DIR_WS_CATALOG . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN', 'メインの全ランゲージファイル - 管理者ページ(Admin) (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . 'english.php /espanol.php etc.)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE', '現在選択中の全ランゲージファイル - 管理者ページ(Admin) (' . DIR_WS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/*.php)');
  define('TEXT_LANGUAGE_LOOKUP_CURRENT_ALL', '現在選択中の全ランゲージファイル - ショップページ(Catalog)/管理者ページ(Admin)');

  define('TEXT_FUNCTION_CONSTANT', '<strong>機能ファイル(Function files)内で機能(Functions)類を検索 </strong>');
  define('TEXT_FUNCTION_LOOKUPS', '機能ファイルを検索:');
  define('TEXT_FUNCTION_LOOKUP_CURRENT', '全ての機能ファイル - ショップページ(Catalog)/管理者ページ(Admin)');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_CATALOG', '全ての機能ファイル - ショップページ(Catalog)');
  define('TEXT_FUNCTION_LOOKUP_CURRENT_ADMIN', '全ての機能ファイル - 管理者ページ(Admin)');

  define('TEXT_CLASS_CONSTANT', '<strong>クラスファイル(Classes files)内でクラス(Classes)類を検索</strong>');
  define('TEXT_CLASS_LOOKUPS', 'クラスファイルを検索:');
  define('TEXT_CLASS_LOOKUP_CURRENT', '全てのクラスファイル - ショップページ(Catalog)/管理者ページ(Admin)');
  define('TEXT_CLASS_LOOKUP_CURRENT_CATALOG', '全てのクラスファイル - ショップページ(Catalog)');
  define('TEXT_CLASS_LOOKUP_CURRENT_ADMIN', '全てのクラスファイル - 管理者ページ(Admin)');

  define('TEXT_TEMPLATE_CONSTANT', '<strong>テンプレート(Template)類を検索</strong>');
  define('TEXT_TEMPLATE_LOOKUPS', 'テンプレートファイルを検索:');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT', '全てのテンプレートファイル - /templates sideboxes /pages etc.');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_TEMPLATES', '全てのテンプレートファイル - /templates');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_SIDEBOXES', '全てのテンプレートファイル - /sideboxes');
  define('TEXT_TEMPLATE_LOOKUP_CURRENT_PAGES', '全てのテンプレートファイル - /pages');

  define('TEXT_ALL_FILES_CONSTANT', '<strong>全ファイル内を検索</strong>');
  define('TEXT_ALL_FILES_LOOKUPS', '全ファイル内を検索:');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT', '全ファイル - ショップページ(Catalog)/管理者ページ(Admin)');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_CATALOG', '全ファイル - ショップページ(Catalog)');
  define('TEXT_ALL_FILES_LOOKUP_CURRENT_ADMIN', '全ファイル - 管理者ページ(Admin)');

  define('TEXT_INFO_NO_EDIT_AVAILABLE','編集不可');
  define('TEXT_INFO_CONFIGURATION_HIDDEN', ' or, HIDDEN');
?>