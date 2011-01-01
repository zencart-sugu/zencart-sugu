<?php
/**
 * module_generate Module
 *
 * @package module_generate
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin.php $
 */

define('HEADING_TITLE', 'モジュールの雛形を作成');

// テーブルヘッダー
define('TABLE_HEADING_MODULES_TITLE', 'モジュールタイトル');
define('TABLE_HEADING_MODULES_NAME', 'モジュール名');
define('TABLE_HEADING_VARSION', 'バージョン');
define('TABLE_HEADING_SORT_ORDER', '優先順');
define('TABLE_HEADING_ACTION', '操作');

// テーブル
define('MODULE_MODULE_GENERATE_VERSION', '0.1.1');

// サイドカラム
define('TITLE_SIDOBOX_OF_MODULE_GENERATE', '設定');

define('MODULE_MODULE_GENERATE_MODULE_DESCRIPTION', 'モジュール説明');
define('MODULE_MODULE_GENERATE_MODULE_AUTHOR', '著者');
define('MODULE_MODULE_GENERATE_MODULE_EMAIL', '著者メールアドレス');
define('MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION', '必要Zen Cartバージョン');
define('MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION', '必要addon_modulesバージョン');
define('MODULE_MODULE_GENERATE_MODULE_REQUIRED', '必要モジュール');

define('MODULE_MODULE_GENERATE_MODULE_EMAIL_DEFAULT', 'info@zencart-sugu.jp');
define('MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION_DEFAULT', '1.3.0.2');
define('MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION_DEFAULT', '0.1');

define('MODULE_MODULE_GENERATE_MODULE_GENERATE', '作成');

// エラーメッセージ
define('MODULE_MODULE_GENERATE_ERROR_TITLE', "モジュールタイトルが空白です。");
define('MODULE_MODULE_GENERATE_ERROR_NAME', "モジュール名が空白です。");
define('MODULE_MODULE_GENERATE_ERROR_VALIDATE_NAME', "モジュール名は半角英数字及び_と-で英字から始まる必要があります。");
define('MODULE_MODULE_GENERATE_ERROR_VERSION', "バージョンが空白です。");
define('MODULE_MODULE_GENERATE_ERROR_DESCRIPTION', "モジュール説明が空白です。");
define('MODULE_MODULE_GENERATE_ERROR_AUTHOR_EMAIL', "著者メールアドレスが空白です。");
define('MODULE_MODULE_GENERATE_ERROR_AUTHOR', "著者が空白です。");
define('MODULE_MODULE_GENERATE_ERROR_ZENCART_VERSION', "必要Zen Cartバージョンが空白です。");
define('MODULE_MODULE_GENERATE_ERROR_ADDONMODULE_VERSION', "必要addon_modulesバージョンが空白です。");
define('MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED', "必要モジュールは半角英数字及び_と-で英字から始まる必要があります。");

define('MODULE_MODULE_GENERATE_ERROR_CREATE_FAILED', '雛形の作成に失敗しました。');
?>