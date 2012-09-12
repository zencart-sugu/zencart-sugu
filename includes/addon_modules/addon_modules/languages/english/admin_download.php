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
//  $Id: blocks.php $
//

define('HEADING_TITLE',                  'Addon Module Download');
define('HEADING_INFOBOX_TITLE',          'Module Details');

define('TABLE_HEADING_MODULE_NAME',      'Module Name');
define('TABLE_HEADING_DESCRIPTION',      'Description');
define('TABLE_HEADING_VERSION',          'Version');
define('TABLE_HEADING_ACTION',           'Action');

define('TEXT_BACK',                      'Back');
define('TEXT_DOWNLOAD',                  'Download');

define('TEXT_INFO_BOX_MODULE_NAME',      'Module Name: ');
define('TEXT_INFO_BOX_FILENAME',         'File Name: ');
define('TEXT_INFO_BOX_DISTRIBUTION_URL', 'Distribution URL: ');
define('TEXT_INFO_BOX_AUTHOR',           'Author: ');
define('TEXT_INFO_BOX_VERSION',          'Version: ');
define('TEXT_INFO_BOX_REQUIRE_ZENCART',  'Corresponding ZenCart: ');
define('TEXT_INFO_BOX_REQUIRE_ADDON',    'Corresponding Addon Module Core: ');
define('TEXT_INFO_BOX_DESCRIPTION',      'Module Description: ');

define('ERROR_NOT_PERMISSION_ADDON_DIR', MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY.' is not write permission.');
define('ERROR_NOT_PERMISSION_TEMP',      MODULE_ADDON_MODULES_DOWNLOAD_TEMP_DIRECTORY.' is not write permission.');
define('ERROR_NO_FILE',                  '%s module does not exist.');
define('ERROR_CANNOT_DOWNLOAD',          'Unable to download %s module.');
define('ERROR_DOWNLOADED',               'The %s module is already downloaded.');
define('ERROR_VERSION',                  'The %s module operates by ZenCart %s, Addon Module Core %s.');
define('SUCCESS_EXTRACT',                'The %s module have been downloaded.');
define('ERROR_EXTRACT',                  'Unable to expand the %s module.');
