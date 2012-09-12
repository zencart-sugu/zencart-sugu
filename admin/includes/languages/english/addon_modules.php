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

define('HEADING_TITLE', 'Management of Addon Module');

define('TEXT_ADDON_MODULES_REFRESH_LIST', 'Refresh List');
define('TEXT_ADDON_MODULES_LEGEND', 'Legend: ');
define('TEXT_ADDON_MODULES_ACTIVE', 'Active Module');
define('TEXT_ADDON_MODULES_INACTIVE', 'Inactive Module');
define('TEXT_ADDON_MODULES_REMOVED', 'Removed Module');

define('TABLE_HEADING_MODULES', 'Module');
define('TABLE_HEADING_VARSION', 'Version');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_SORT_ORDER', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_ADDON_MODULES_ADMIN_PAGES', 'Module Administration Pages:');
define('TEXT_MODULE_DIRECTORY', 'Module Directory:');

define('TEXT_INFO_HEADING_UPDATE_MODULE', 'Module Update');
define('TEXT_UPDATE_MODULE_INTRO', 'Module has been updated. Please execute the update.<br /><span class="alert">This action can not be undone. Please make a backup and carefully executed.</span>');
define('IMAGE_MODULE_UPDATE', 'Module Update');
define('TEXT_UPDATE_MODULE_DO_NOTHING', 'There are no items can be updated.');
define('ERROE_MODULE_UPDATE_FAILED', 'ERROR: %s Failed to update the module.');

define('TEXT_INFO_HEADING_CLEANUP_MODULE', 'Delete Module Data');
define('TEXT_CLEANUP_MODULE_INTRO', 'Completely remove the table from the database.<br /><span class="alert">This action can not be undone. Please make a backup and carefully executed.</span>');
define('IMAGE_MODULE_CLEANUP', 'Delete Module Data');
define('TEXT_CLEANUP_MODULE_DO_NOTHING', 'Module\'s data that can be deleted.');
define('ERROE_MODULE_CLEANUP_FAILED', 'ERROR: %s Failed to delete the module\'s data. Please uninstall the module previously.');

define('SUCCESS_CREATE_TABLE', '%s table was created for the database.');
define('SUCCESS_DROP_TABLE', '%s table was deleted from the database.');

define('BUTTON_TEXT_MODULE_DOWNLOAD', 'Download Module');
