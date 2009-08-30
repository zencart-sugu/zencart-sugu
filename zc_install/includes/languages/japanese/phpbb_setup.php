<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: phpbb_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('SAVE_PHPBB_SETTINGS', 'phpBBの設定を保存'); //this comes before TEXT_MAIN
  define('TEXT_MAIN', 'phpBBフォーラムがインストール済みの場合、Zen CartからphpBBフォーラムにリンクするかどうかを確認します。各種設定項目を適切に入力し、<em>'.SAVE_PHPBB_SETTINGS.'</em> を押してください。次の画面へと移動します。');
  define('TEXT_PAGE_HEADING', 'Zen Cartの設定 -　phpBB の設定');
  define('PHPBB_INFORMATION', 'phpBB情報');
  define('PHPBB_USE', 'phpBBフォーラムとリンクさせますか');
  define('PHPBB_USE_INSTRUCTION', 'インストール済みのphpBBフォーラムとリンクするかどうか選択してください。');
  define('PHPBB_DIR', 'phpBBディレクトリ');
  define('PHPBB_DIR_INSTRUCTION', 'phpBBがインストールされているディレクトリ');

//possible future use:
  define('PHPBB_DATABASE_NAME', 'phpBB のデータベースの名前');
  define('PHPBB_DATABASE_NAME_INSTRUCTION', 'phpBB のデータが格納されているデータベースの名称を記入してください。');
  define('PHPBB_DATABASE_PREFIX', 'phpBB のデータベーステーブルプレフィクス');
  define('PHPBB_DATABASE_PREFIX_INSTRUCTION', 'phpBB のデータベーステーブルで使用するプレフィクス名を入力してください。プレフィクスが必要でない場合は空欄でかまいません。');
?>
