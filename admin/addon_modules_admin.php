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
//  $Id: addon_modules_admin.php $
//
  require('includes/application_top.php');

  $perse_admin_module = zen_addOnModules_perseAdminModule($_GET['module']);
  $admin_class = $perse_admin_module['class'];
  $admin_page = $perse_admin_module['page'];

  // check module admin page enable
  $enable_admin_page = false;

  $enabled_modules = zen_addOnModules_get_installed_modules();
  if (in_array($admin_class, $enabled_modules)) {
    $admin_module = $GLOBALS[$admin_class];
    $admin_page_file = DIR_FS_CATALOG . $admin_module->dir . $admin_page . '.php';
    $admin_page_language_file = DIR_FS_CATALOG . $admin_module->dir . 'languages/' . $_SESSION['language'] .'/' . $admin_page . '.php';

    if (file_exists($admin_page_file)) {
      $enable_admin_page = true;
    }
  }

  if ($enable_admin_page) {
    if (file_exists($admin_page_language_file)) {
      require($admin_page_language_file);
    }
    require($admin_page_file);
  }


  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>