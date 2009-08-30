<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin_setup.php 2342 2005-11-13 01:07:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('TEXT_PAGE_HEADING', 'Zen Cart設定 - 管理者アカウント設定');
  define('SAVE_ADMIN_SETTINGS', '管理者設定を保存');//this comes before TEXT_MAIN
  define('TEXT_MAIN', "あなたの店舗の設定を行うために、管理者用のアカウントが必要です。管理者IDとパスワード、そしてパスワードを忘れてしまった際に新しいパスワードを配信するための電子メールアドレスを記入してください。内容を確認してから、<em>".SAVE_ADMIN_SETTINGS.'</em>をクリックしてください。');
  define('ADMIN_INFORMATION', '管理者情報');
  define('ADMIN_USERNAME', '管理者ID');
  define('ADMIN_USERNAME_INSTRUCTION', 'Zen Cartの管理を行うためのユーザ名を記入してください。');
  define('ADMIN_PASS', '管理者パスワード');
  define('ADMIN_PASS_INSTRUCTION', 'Zen Cartの管理者アカウントに使われるパスワードを記入してください。');
  define('ADMIN_PASS_CONFIRM', '管理者パスワード（確認）');
  define('ADMIN_PASS_CONFIRM_INSTRUCTION', '確認のためもう一度パスワードを入力してください。');
  define('ADMIN_EMAIL', '管理者の電子メール');
  define('ADMIN_EMAIL_INSTRUCTION', 'Zen Cartの管理者の電子メールを記入してください。');
  define('UPGRADE_DETECTION','最新版の検出');
  define('UPGRADE_INSTRUCTION_TITLE','ログインの際にZen Cartが更新されたかチェック');
  define('UPGRADE_INSTRUCTION_TEXT','Zen Cartのライブバージョンサーバーに接続してZen Cartが更新されたかをチェックします。Zen Cartが更新されていた場合には、メッセージが表示されますが、自動的に更新されることは<em>ありません</em>。<br />この設定はインストール完了後にAdmin->Config->My Store->Check if version update is availableで変更することができます。');

?>