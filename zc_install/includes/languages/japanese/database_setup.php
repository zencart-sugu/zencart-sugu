<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: database_setup.php 3164 2006-03-11 01:54:17Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('SAVE_DATABASE_SETTINGS', 'データベース設定を保存');//this comes before TEXT_MAIN
  define('TEXT_MAIN', "次にデータベースの設定を行います。注意して各項目を入力し、<em>" . SAVE_DATABASE_SETTINGS . "</em> をクリックしてください。");
  define('TEXT_PAGE_HEADING', 'Zen Cart設定　-　データベース設定');
  define('DATABASE_INFORMATION', 'データベース設定');
  define('DATABASE_TYPE', 'データベースタイプ');
  define('DATABASE_TYPE_INSTRUCTION', '使用するデータベースタイプを選択してください。');
  define('DATABASE_HOST', 'データベースホスト名');
  define('DATABASE_HOST_INSTRUCTION', '接続するホスト名を入力してください。(例）\'db1.myserver.com\', \'192.168.0.1\', \'localhost\'。');
  define('DATABASE_USERNAME', 'データベースユーザ名');
  define('DATABASE_USERNAME_INSTRUCTION', 'データベース接続に使用するユーザ名を入力してください。(例）\'root\'。');
  define('DATABASE_PASSWORD', 'データベースパスワード');
  define('DATABASE_PASSWORD_INSTRUCTION', 'データベース接続に使用するパスワードを入力してください。');
  define('DATABASE_NAME', 'データベース名');
  define('DATABASE_NAME_INSTRUCTION', 'データベース名を入力してください。(例）\'zencart\'。');
  define('DATABASE_PREFIX', 'テーブルプレフィクス');
  define('DATABASE_PREFIX_INSTRUCTION', 'データベーステーブルに付けるプレフィクスを入力してください。(例）\'zen_\'。必要でなければ空白にしてください。<br />プレフィクスを使用することで一つのデータベースで複数の店舗を運営することができます。');
  define('DATABASE_CREATE', 'データベース作成');
  define('DATABASE_CREATE_INSTRUCTION', 'データベースを新規作成しますか? ');
  define('DATABASE_CONNECTION', '持続的接続');
  define('DATABASE_CONNECTION_INSTRUCTION', '持続的接続(Persistent connection)を有効にしますか？<br>分からない場合は\「いいえ」を選択してください。');
  define('DATABASE_SESSION', 'データベースセッション');
  define('DATABASE_SESSION_INSTRUCTION', 'データベースでのセッション管理を許可しますか？<br>分からない場合は「はい」を選択してください。');
  define('CACHE_TYPE', 'SQLキャッシュの方法');
  define('CACHE_TYPE_INSTRUCTION', 'SQLキャッシュを使用するための方法を選択してください。');
  define('SQL_CACHE', 'セッション/SQLキャッシュディレクトリ');
  define('SQL_CACHE_INSTRUCTION', 'ファイルベースの SQLキャッシュを使用するためのディレクトリを入力してください。');
  define('ONLY_UPDATE_CONFIG_FILES','設定ファイルのみ更新');


  define('REASON_TABLE_ALREADY_EXISTS','指定されたデータベーステーブル「%s」はすでに存在しているので、作成することができません。');
  define('REASON_TABLE_DOESNT_EXIST','指定されたデータベーステーブル「%s」が見つからないので、削除することができません。');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','設定キー「%s」はすでに存在しているので、挿入することができません。');
  define('REASON_COLUMN_ALREADY_EXISTS','コラム「%s」はすでに存在しているので、加えることができません。');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','コラム「%s」が見つからないので、削除することができません。');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','コラム「%s」が見つからないので、変更することができません。');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','設定キー「%s」はすでに存在しているので挿入することができません。');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','インデックス「%s」(テーブル「%s」)が見つからないので、削除することができません。');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','テーブル「%s」の主要キーが見つからないので、削除することができません。');
  define('REASON_INDEX_ALREADY_EXISTS','インデックス「%s」(テーブル「%s」)はすでに存在しているので、加えることができません。');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','テーブル「%s」の主要キーはすでに存在しているので、加えることができません。');
  define('REASON_NO_PRIVILEGES','ユーザ「%s@%s」は「%s」の権限を持っていません。');

?>
