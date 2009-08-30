<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: database_upgrade.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('PAGE_HEADING', 'Zen Cart&trade; セットアップ　-　データベースアップグレード');
  define('UPDATE_DATABASE_NOW','データベースをアップデートする');//this comes before TEXT_MAIN
  define('TEXT_MAIN', '<em>注意: </em> このスクリプトは下にリストされたバージョンから、あなたのZen Cartデータベーススキーマをアップグレードするためだけに使用されるべきです。  ' .
                      '<span class="emphasis"><strong>アップグレードする前にあなたのデータベースのフルバックアップを行うことを強く推奨します!</strong></span>');
  define('TEXT_MAIN_2','<span class="emphasis">下の詳細を非常に注意深くチェックしてください。</span>この情報はあなたのconfigure.php設定から得られています。<br />' .
                      'もしそれらが正確であると確信できなければ、先に進まないでください。さもないと、あなたのデータベースを破損する危険があります。');

  define('DATABASE_INFORMATION', 'データベース情報');
  define('DATABASE_TYPE', 'データベースタイプ');
  define('DATABASE_HOST', 'データベースホスト');
  define('DATABASE_USERNAME', 'データベースユーザ名');
  define('DATABASE_PASSWORD', 'データベースパスワード');
  define('DATABASE_NAME', 'データベース名');
  define('DATABASE_PREFIX', 'データベーステーブルプレフィクス');
  define('DATABASE_PRIVILEGES', 'データベース権限');

  define('SNIFFER_PREDICTS','<em>Upgrade Sniffer</em> predicts: ');
  define('CHOOSE_UPGRADES','アップグレードステップを選択してください');
  define('TITLE_DATABASE_PREFIX_CHANGE','データベーステーブルプレフィクス変更');
  define('ERROR_PREFIX_CHANGE_NEEDED','<span class="errors">あなたのデータベースの中にZen Cartのテーブルを見つけることができませんでした。<br />恐らくあなたのデータベーステーブルのプレフィクスは不正確に指定されました。</span><br />もしプレフィクスを変えても問題が解決しないなら、phpMyAdminまたはあなたのウェブサーバのコントロールパネルを使ってconfigure.phpの設定と現行のデータベースを、手作業で比較する必要があるでしょう。');
  define('TEXT_DATABASE_PREFIX_CHANGE','もしデータベーステーブルのプレフィクスを変更したければ、下に新しいプレフィクスを入力してください。<span class="emphasis">注意: 重複チェックは行いませんので、既に使用されているプレフィクスではないことを確認してください。</span>既に存在するテーブルプレフィクスを使うとデータベースを壊すことになります。');
  define('TEXT_DATABASE_PREFIX_CHANGE_WARNING','<span class="errors"><strong>注意: もし、データベースの完全で信頼できる最近のバックアップがないのであれば、テーブルプレフィクスの変更を試すのは止めてください。もし処理中に何かうまくいかなかった場合、あなたのバックアップから復旧する必要があるでしょう。もし心配だったり確信が持てないのであれば、テーブル名の変更を試すことはやめてください。</strong></span>');
  define('DATABASE_OLD_PREFIX','古いテーブルプレフィクス');
  define('DATABASE_OLD_PREFIX_INSTRUCTION','古いテーブルプレフィクスを入力してください');
  define('ENTRY_NEW_PREFIX','新しいテーブルプレフィクス');
  define('DATABASE_NEW_PREFIX_INSTRUCTION','新しいテーブルプレフィクスを入力してください');
  define('ENTRY_ADMIN_ID','管理者のID (Zen Cartの管理者エリア)');
  define('ENTRY_ADMIN_PASSWORD','パスワード');
  define('ADMIN_PASSSWORD_INSTRUCTION','データベースの変更を行うには管理者のユーザーネームとパスワード（管理画面にアクセスできるアカウント）が必要になります。<em> (MySQLのパスワードではありません) </em>');
  define('TITLE_SECURITY','データベースのセキュリティ');

  define('UPDATE_DATABASE_WARNING_DO_NOT_INTERRUPT','<span class="emphasis">下をクリックした後、中断しないでください。アップグレードの間お待ちください。</span>');
  define('SKIP_UPDATES','アップグレードをスキップする');


  define('REASON_TABLE_ALREADY_EXISTS','既に存在するためテーブルを更新することができませんでした。');
  define('REASON_TABLE_DOESNT_EXIST','テーブルが存在しないためテーブルを削除することができませんでした。');
  define('REASON_CONFIG_KEY_ALREADY_EXISTS','コンフィギュレーションキーが既に存在するため新規に挿入することができません。');
  define('REASON_COLUMN_ALREADY_EXISTS','カラムが既に存在するため新規に追加することができません。');
  define('REASON_COLUMN_DOESNT_EXIST_TO_DROP','カラムが存在しないためカラムを削除することができませんでした。');
  define('REASON_COLUMN_DOESNT_EXIST_TO_CHANGE','カラムが存在しないためカラムを変更することができませんでした。');
  define('REASON_PRODUCT_TYPE_LAYOUT_KEY_ALREADY_EXISTS','プロダクトタイプレイアウトコンフィギュレーションキーが既に存在するため新規に挿入することができません。');
  define('REASON_INDEX_DOESNT_EXIST_TO_DROP','インデックスが存在しないためインデックスを削除することができませんでした。');
  define('REASON_PRIMARY_KEY_DOESNT_EXIST_TO_DROP','プライマリーキーが存在しないためプライマリーキーを削除することができませんでした。');
  define('REASON_INDEX_ALREADY_EXISTS','インデックスが既に存在するため新規に追加することができません。');
  define('REASON_PRIMARY_KEY_ALREADY_EXISTS','プライマリーキーが既に存在するためテーブルに新規にプライマリーキーを追加することができません。');
  define('REASON_NO_PRIVILEGES','このユーザーはデータベース編集権限がありません。');

?>
