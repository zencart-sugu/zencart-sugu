<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: system_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('SAVE_SYSTEM_SETTINGS', 'システム設定の変更を保存'); //this comes before TEXT_MAIN
  define('TEXT_MAIN', 'Zen Cartのシステム環境を変更します。それぞれの設定についてよく検証して、ご自身のサイトのディレクトリ配置に合うように変更を行ってください。その後 <em>システム設定の変更を保存</em> を押してください');
  define('TEXT_PAGE_HEADING', 'Zen Cartの設定　- システム設定');
  define('SERVER_SETTINGS', 'サーバ設定');
  define('PHYSICAL_PATH', '物理パス');
  define('PHYSICAL_PATH_INSTRUCTION', 'あなたのサイト内のZen Cartディレクトリまでの物理パス。最後尾のスラッシュ記号「/」は取り除いてください。');
  define('PHYSICAL_HTTPS_PATH', '物理HTTPSパス');
  define('PHYSICAL_HTTPS_PATH_INSTRUCTION', 'あなたのサイト内のZen Cartディレクトリまでの物理HTTPSパス。最後尾のスラッシュ記号「/」は取り除いてください。');
  define('VIRTUAL_HTTP_PATH', '仮想HTTPパス');
  define('VIRTUAL_HTTP_PATH_INSTRUCTION', 'あなたのサイト内のZen Cartディレクトリまでの仮想パス。最後尾のスラッシュ記号「/」は取り除いてください。');
  define('VIRTUAL_HTTPS_PATH', '仮想HTTPSパス');
  define('VIRTUAL_HTTPS_PATH_INSTRUCTION', 'あなたのサイト内のZen Cartディレクトリまでの仮想HTTPSパス。最後尾のスラッシュ記号「/」は取り除いてください。');
  define('VIRTUAL_HTTPS_SERVER', '仮想HTTPSサーバ');
  define('VIRTUAL_HTTPS_SERVER_INSTRUCTION', 'Zen Cartディレクトリ用仮想HTTPSサーバ。最後尾のスラッシュ記号「/」は取り除いてください。');
  define('ENABLE_SSL', 'ショップでSSLを有効にする');
  define('ENABLE_SSL_INSTRUCTION', 'ショップでSSLを有効にしますか?<br />SSLが確実に動くことを確認できるまでこの設定は「いいえ」にしておいてください。');
  define('ENABLE_SSL_ADMIN', '管理画面でSSLを有効にする');
  define('ENABLE_SSL_ADMIN_INSTRUCTION', '管理画面でSSLを有効にしますか?<br />SSLが確実に動くことを確認できるまでこの設定は「いいえ」にしておいてください。');

?>
