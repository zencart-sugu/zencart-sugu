<?php
/**
 * @package Configuration Settings
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

  define('DIR_WS_ADDON_MODULES', DIR_WS_INCLUDES . 'addon_modules/');
  define('DIR_FS_CATALOG_ADDON_MODULES', DIR_FS_CATALOG . DIR_WS_ADDON_MODULES);
?>