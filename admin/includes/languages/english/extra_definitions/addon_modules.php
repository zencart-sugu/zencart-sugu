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

define('BOX_ADDON_MODULES_MANAGER', 'Addon Modules Manager');

define('WARNING_NOT_INSTALLED_CORE_MODULE', 'DEPENDENCY ERROR: Please install first the core module.');
define('ERROR_REQUIRE_MODULE', 'DEPENDENCY ERROR: %s The module is insufficient.');
define('WARNING_REQUIRE_MODULE', 'DEPENDENCY WARNING: %s Module is inactive or not installed.');
define('ERROE_MODULE_INSTALL_FAILED', 'ERROR: %s Failed to install the module. Please check the above message.');

define('WARNING_DEPEND_MODULE', 'DEPENDENCY WARNING: %s Module is installed.');
define('WARNING_CANNOT_REMOVE_CORE_MODULE', 'DEPENDENCY WARNING: The core modules are required.');
define('ERROE_MODULE_REMOVE_FAILED', 'ERROR: %s Failed to uninstall the module. Please check the above message.');

define('WARNING_DEPEND_MODULE_INACTIVE', 'WARNING: %s モジュールが無効に設定されました。依存するモジュールが正しく動作しなくなる可能性があります。');
