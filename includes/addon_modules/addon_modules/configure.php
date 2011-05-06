<?php
/**
 * @package addon_modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('MODULE_ADDON_MODULES_STATUS_DEFAULT', 'true');
define('MODULE_ADDON_MODULES_SORT_ORDER_DEFAULT', '');
define('MODULE_ADDON_MODULES_DISTRIBUTION_URL_DEFAULT', 'http://sugu.e7.com');
define('MODULE_ADDON_MODULES_MODULE_LIST_YML_NAME',     '/addon_module_list.yml');
define('MODULE_ADDON_MODULES_DOWNLOAD_TEMP_DIRECTORY',  '/tmp/');
define('MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY',       'includes/addon_modules/');

define('MODULE_ADDON_MODULES_SORT_ORDER_CSS_SELECTOR',  '-10000');
