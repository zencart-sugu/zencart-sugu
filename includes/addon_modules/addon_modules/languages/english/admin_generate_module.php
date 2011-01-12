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

define('HEADING_TITLE', 'Create skelton');

// table header
define('TABLE_HEADING_MODULES_TITLE', 'Module title');
define('TABLE_HEADING_MODULES_NAME', 'Module name');
define('TABLE_HEADING_VARSION', 'Version');
define('TABLE_HEADING_SORT_ORDER', 'Sort order');
define('TABLE_HEADING_ACTION', '');

// table
define('MODULE_MODULE_GENERATE_VERSION', '0.1.1');

// side column
define('TITLE_SIDOBOX_OF_MODULE_GENERATE', 'Config');

define('MODULE_MODULE_GENERATE_MODULE_DESCRIPTION', 'Module description');
define('MODULE_MODULE_GENERATE_MODULE_AUTHOR', 'Author');
define('MODULE_MODULE_GENERATE_MODULE_EMAIL', 'Author email');
define('MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION', 'Required Zen Cart version');
define('MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION', 'Required addon_modules version');
define('MODULE_MODULE_GENERATE_MODULE_REQUIRED', 'Required module');
define('MODULE_MODULE_GENERATE_ADD', 'ADD');
define('MODULE_MODULE_GENERATE_REMOVE', 'REMOVE');

define('MODULE_MODULE_GENERATE_MODULE_EMAIL_DEFAULT', 'info@zencart-sugu.jp');
define('MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION_DEFAULT', '1.3.0.2');
define('MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION_DEFAULT', '0.1');

define('MODULE_MODULE_GENERATE_MODULE_GENERATE', 'create');

// エラーメッセージ
define('MODULE_MODULE_GENERATE_ERROR_TITLE', "Module title is empty.");
define('MODULE_MODULE_GENERATE_ERROR_NAME', "Module name is empty.");
define('MODULE_MODULE_GENERATE_ERROR_VALIDATE_NAME', "Module name accepts alphabet, number,_ , and -. Must be start alphabet.");
define('MODULE_MODULE_GENERATE_ERROR_VERSION', "Version is empty.");
define('MODULE_MODULE_GENERATE_ERROR_DESCRIPTION', "Module description is empty.");
define('MODULE_MODULE_GENERATE_ERROR_AUTHOR_EMAIL', "Author email is empty.");
define('MODULE_MODULE_GENERATE_ERROR_AUTHOR', "Author is empty.");
define('MODULE_MODULE_GENERATE_ERROR_ZENCART_VERSION', "Required Zen Cart version is empty.");
define('MODULE_MODULE_GENERATE_ERROR_ADDONMODULE_VERSION', "Required addon_modules version is empty.");
define('MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED', "Required module accespts alphabet, number,_ , and -. Must be start alphabet.");

define('MODULE_MODULE_GENERATE_ERROR_CREATE_FAILED', 'Failed to create skeltons.');
define('MODULE_MODULE_GENERATE_ERROR_MODULE_ALREADY_EXISTS', 'module %s is already exists.');
define('MODULE_MODULE_GENERATE_ERROR_MODULE_DIRECTORY_CANNOT_CREATE', 'Couldn\'t create module directory %s. Please check permission of %s.');
define('MODULE_MODULE_GENERATE_SUCCESS', 'Module %s was created successfully');
?>