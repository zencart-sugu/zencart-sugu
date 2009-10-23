<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
//  $Id: addon_modules.php $
//

define('BOX_ADDON_MODULES_MANAGER', '追加モジュールの管理');

define('WARNING_NOT_INSTALLED_CORE_MODULE', '依存関係のエラー: 先にコアモジュールをインストールしてください。');
define('ERROR_REQUIRE_MODULE', '依存関係のエラー: %s モジュールが不足しています。');
define('WARNING_REQUIRE_MODULE', '依存関係の警告: %s モジュールがインストールされていないか有効ではありません。');
define('ERROE_MODULE_INSTALL_FAILED', 'エラー: %s モジュールのインストールに失敗しました。上記のメッセージを確認してください。');

define('WARNING_DEPEND_MODULE', '依存関係の警告: %s モジュールがインストールされています。');
define('WARNING_CANNOT_REMOVE_CORE_MODULE', '依存関係の警告: コアモジュールは必須のモジュールです。');
define('ERROE_MODULE_REMOVE_FAILED', 'エラー: %s モジュールのアンインストールに失敗しました。上記のメッセージを確認してください。');

define('WARNING_DEPEND_MODULE_INACTIVE', '警告: %s モジュールが無効に設定されました。依存するモジュールが正しく動作しなくなる可能性があります。');
