<?php
/**
 * addOnModules functions.php
 *
 * @package functions
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_addOnModules.php $
 */

function zen_addOnModules_get_installed_modules() {
  global $installed_addon_modules;
  if (!isset($installed_addon_modules)) {
    $installed_addon_modules = array();
    $module_key = 'ADDON_MODULE_INSTALLED';
    eval('$module_installed = ' . $module_key . ';');
    if (defined($module_key) && zen_not_null($module_installed)) {
      $modules = explode(';', $module_installed);
      while (list(, $value) = each($modules)) {
        $class = $value;
        $installed_addon_modules[] = $class;
      }
    }
  }
  return $installed_addon_modules;
}

function zen_addOnModules_get_enabled_modules() {
  $enabled_addon_modules = array();
  $installed_addon_modules = zen_addOnModules_get_installed_modules();
  for ($i = 0, $n = count($installed_addon_modules); $i < $n; $i++) {
    $class = $installed_addon_modules[$i];
    if (!is_object($GLOBALS[$class])) {
      zen_addOnModules_load_module_files($class);
      if (class_exists($class)) {
        $GLOBALS[$class] = new $class;
      }
    }
    if ($GLOBALS[$class]->enabled) {
      $enabled_addon_modules[] = $installed_addon_modules[$i];
    }
  }
  return $enabled_addon_modules;
}

function zen_addOnModules_load_module_files($class) {
  global $template_dir;
  $module_directory = DIR_FS_CATALOG_ADDON_MODULES . $class . '/';
  if (file_exists($module_directory . 'module.php')) {
    if (file_exists($module_directory . 'configure.php')) require_once($module_directory . 'configure.php');
    if (file_exists($module_directory . 'database_tables.php')) require_once($module_directory . 'database_tables.php');
    if (file_exists($module_directory . 'filenames.php')) require_once($module_directory . 'filenames.php');
    if (file_exists($module_directory . 'functions.php')) require_once($module_directory . 'functions.php');

    $dir_languages = $module_directory . 'languages/';
    if (file_exists($dir_languages . $template_dir . '/' . $_SESSION['language'] . '.php')) {
      $template_dir_select = $template_dir . '/';
      /**
       * include the template language overrides
       */
      include_once($dir_languages . $template_dir_select . $_SESSION['language'] . '.php');
    }
    include_once($dir_languages . $_SESSION['language'] . '.php');

    require_once($module_directory . 'module.php');

    return true;
  }

  return false;
}

function zen_addOnModules_load_boxes_dhtml(&$za_contents, $boxes_dhtml) {
  $enabled_addon_modules = zen_addOnModules_get_installed_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $module_directory = DIR_FS_CATALOG_ADDON_MODULES . $class . '/';
    if (file_exists($module_directory . $boxes_dhtml)) {
      require($module_directory . $boxes_dhtml);
    }
  }
}

function zen_addOnModules_get_module_init_files() {
  $module_init_files = array();
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $module_directory = DIR_FS_CATALOG_ADDON_MODULES . $class . '/';
    if (file_exists($module_directory . 'init_admin.php')) {
      $module_init_files[] = $module_directory . 'init_admin.php';
    }
  }
  return $module_init_files;
}

function zen_addOnModules_page_match($pages, $page) {
  $pages = str_replace(array(' ', "\r\n", "\r", "\n"), array('', '|',  '|', '|'), $pages);
  $pages = preg_replace('/[|]+/', '|', $pages);
  return preg_match('/^(' . $pages . ')$/', $page);
}

function zen_addOnModules_perseAdminModule($str = null) {
  // sanitize the GET parameters
  if (zen_not_null($str)) $str = ereg_replace('[^0-9a-zA-Z_\/]', '', $str);

  // parse module params
  list($class, $page) = split('/', $str);
  if ($page != '') {
    $page = 'admin_' . $page;
  } else {
    $page = 'admin';
  }

  return array('class' => $class, 'page' => $page);
}

function zen_addOnModules_save_enabled_modules_to_cache() {

  $enabled_modules = zen_addOnModules_get_enabled_modules();
  if (is_array($enabled_modules)) {
    $fd = fopen(DIR_FS_SQL_CACHE . "/enabled_addon_modules.txt", "w");
    if ($fd) {
      fwrite($fd, implode(';', $enabled_modules));
      fclose($fd);
      return true;
    }
    else {
      return false;
    }
  }
  else {
    return false;
  }
}

