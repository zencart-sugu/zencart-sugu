<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

switch ($_GET['action']) {
 case 'new':
 default : 
   $action = 'new';
}

// action new
if (isset($_POST['module_title'])) {
  $module_title = htmlspecialchars($_POST['module_title']);
  $module_name = htmlspecialchars($_POST['module_name']);
  $module_version = htmlspecialchars($_POST['module_version']);
  $module_sort_order = htmlspecialchars($_POST['module_sort_order']);
  $module_description = htmlspecialchars($_POST['module_description']);
  $module_author = htmlspecialchars($_POST['module_author'], ENT_QUOTES);
  $module_author_email = htmlspecialchars($_POST['module_author_email']);
  $module_zencart_version = htmlspecialchars($_POST['module_zencart_version']);
  $module_addonmodule_version = htmlspecialchars($_POST['module_addonmodule_version']);

  //$module_required = !empty($_POST['module_required']) ? $_POST['module_required'] : '' ;
  $module_required = array();
  if (!empty($_POST['module_required'])) {
    foreach ($_POST['module_required'] as $key => $val) {
      if (!empty($val)) {
	$module_required[] = htmlspecialchars($val);
      }
    }
  }

  // validate
  $validate = true;
  if ($module_title == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_TITLE, 'error');
    $validate = false;
  }
  if ($module_name == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_NAME, 'error');
    $validate = false;
  }
  if ($module_name != '' && !preg_match('/^[a-zA-Z][a-zA-Z0-9_-]*$/',$module_name)) {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_VALIDATE_NAME, 'error');
    $validate = false;
  }
  if ($module_version == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_VERSION, 'error');
    $validate = false;
  }
  if ($module_description == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_DESCRIPTION, 'error');
    $validate = false;
  }
  if ($module_author == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_AUTHOR, 'error');
    $validate = false;
  }
  if ($module_author_email == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_AUTHOR_EMAIL, 'error');
    $validate = false;
  }
  if ($module_zencart_version == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_ZENCART_VERSION, 'error');
    $validate = false;
  }
  if ($module_addonmodule_version == '') {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_ADDONMODULE_VERSION, 'error');
    $validate = false;
  }

  foreach ($module_required as $key => $val) {
    if ($val != '' && !preg_match('/^[a-zA-Z][a-zA-Z0-9_-]*$/',$val)) {
      $messageStack->add(MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED, 'error');
      $validate = false;
    } else {
      $module_required[$key] = "'" . $val . "'";
    }
  }
  
  // validation OK
  if ($validate) {
    $skelton_dir = DIR_FS_CATALOG_ADDON_MODULES . 'addon_modules/skel/';
    $module_dir = DIR_FS_CATALOG_ADDON_MODULES . '/' . $module_name . '/';
    $module_language_dir = $module_dir . '/languages/';
    if (is_dir($module_dir)) {
      $messageStack->add(sprintf(MODULE_MODULE_GENERATE_ERROR_MODULE_ALREADY_EXISTS, $module_name), 'error');
      $validate = false;
    } else {
      $module_dir_is_writable = mkdir($module_dir);
      if (!$module_dir_is_writable) {
        $messageStack->add(sprintf(MODULE_MODULE_GENERATE_ERROR_MODULE_DIRECTORY_CANNOT_CREATE, $module_dir, DIR_FS_CATALOG_ADDON_MODULES) , 'error');
	$validate = false;
      } else {
        chmod($module_dir, 0777);
        mkdir($module_language_dir);
        chmod($module_language_dir, 0777);
      }
    }
  }
  if ($validate) {
    // prepare variables
    $def_title                  = 'MODULE_'.strtoupper($module_name).'_TITLE';
    $def_description            = 'MODULE_'.strtoupper($module_name).'_DESCRIPTION';
    $def_sort_order             = 'MODULE_'.strtoupper($module_name).'_SORT_ORDER';

    $def_status                 = 'MODULE_'.strtoupper($module_name).'_STATUS';
    $def_status_title           = 'MODULE_'.strtoupper($module_name).'_STATUS_TITLE';
    $def_module_status          = 'MODULE_'.strtoupper($module_name).'_STATUS';
    $def_status_default         = 'MODULE_'.strtoupper($module_name).'_STATUS_DEFAULT';
    $def_status_description     = 'MODULE_'.strtoupper($module_name).'_STATUS_DESCRIPTION';

    $def_sort_order_title       = 'MODULE_'.strtoupper($module_name).'_SORT_ORDER_TITLE';
    $def_module_sort_order      = 'MODULE_'.strtoupper($module_name).'_SORT_ORDER';
    $def_sort_order_default     = 'MODULE_'.strtoupper($module_name).'_SORT_ORDER_DEFAULT';
    $def_sort_order_description = 'MODULE_'.strtoupper($module_name).'_SORT_ORDER_DESCRIPTION';

    // read skeltons
    $files = array();
    if ($handle = opendir($skelton_dir)) {
      while(false !== ($file = readdir($handle))) {
        if (is_file($skelton_dir.$file)) {
          $files[] = $skelton_dir.$file;
        }
      }
      closedir($handle);
    }
    $languages = array();
    if ($handle = opendir($skelton_dir.'languages/')) {
      while(false !== ($file = readdir($handle))) {
        if (is_file($skelton_dir.'languages/'.$file)) {
          $languages[] = $skelton_dir.'languages/'.$file;
        }
      }
      closedir($handle);
    }

    // replace parameters
    $module_created = true;
    foreach ($files as $file) {
      $buff = file($file);
      $buff = implode('', $buff);

      $buff = preg_replace('/:module_name/', $module_name, $buff);
      $buff = preg_replace('/:author_email/', $module_author_email, $buff);
      $buff = preg_replace('/:author/', $module_author, $buff);
      $buff = preg_replace('/:version/', $module_version, $buff);
      $buff = preg_replace('/:zencart_version/', $module_zencart_version, $buff);
      $buff = preg_replace('/:addonmodule_version/', $module_addonmodule_version, $buff);
      $buff = preg_replace('/:required/', implode(',', $module_required), $buff);

      $buff = preg_replace('/:def_title/', $def_title, $buff);
      $buff = preg_replace('/:def_description/', $def_description, $buff);

      $buff = preg_replace('/:def_status_title/', $def_status_title, $buff);
      $buff = preg_replace('/:def_module_status/', $def_module_status, $buff);
      $buff = preg_replace('/:def_status_default/', $def_status_default, $buff);
      $buff = preg_replace('/:def_status_description/', $def_status_description, $buff);

      $buff = preg_replace('/:def_sort_order_title/', $def_sort_order_title, $buff);
      $buff = preg_replace('/:def_module_sort_order/', $def_module_sort_order, $buff);
      $buff = preg_replace('/:def_sort_order_default/', $def_sort_order_default, $buff);
      $buff = preg_replace('/:def_sort_order_description/', $def_sort_order_description, $buff);

      $buff = preg_replace('/:def_status/', $def_status, $buff);
      $buff = preg_replace('/:def_sort_order/', $def_sort_order, $buff);

      $buff = preg_replace('/:module_sort_order/', $module_sort_order, $buff);

      // write files
      $filename = $module_dir . basename($file);
      $fp = fopen($filename, 'w');
      $write_is_complete = fwrite($fp, $buff);
      fclose($fp);
      chmod($filename, 0777);
      if ($write_is_complete === false) {
        $module_created = false;
      }
    }
    foreach ($languages as $file) {
      $buff = file($file);
      $buff = implode('', $buff);

      $buff = preg_replace('/:def_title/', $def_title , $buff);
      $buff = preg_replace('/:module_title/', $module_title , $buff);
      $buff = preg_replace('/:def_description/', $def_description , $buff);
      $buff = preg_replace('/:module_description/', $module_description , $buff);

      $buff = preg_replace('/:def_status_title/', $def_status_title, $buff);
      $buff = preg_replace('/:def_status_description/', $def_status_description, $buff);

      $buff = preg_replace('/:def_sort_order_title/', $def_sort_order_title, $buff);
      $buff = preg_replace('/:def_sort_order_description/', $def_sort_order_description, $buff);

      // write file
      $filename = $module_language_dir . basename($file);
      $fp = fopen($filename, 'w');
      $write_is_complete = fwrite($fp, $buff);
      fclose($fp);
      chmod($filename, 0777);
      if ($write_is_complete === false) {
        $module_created = false;
      }
    }
    if ($module_created) {
      $messageStack->add(sprintf(MODULE_MODULE_GENERATE_SUCCESS, $module_name), 'success');
      $success = true;
    } else {
      $messageStack->add(MODULE_MODULE_GENERATE_ERROR_CREATE_FAILED, 'error');
    }
  }
}

// load template
if (isset($action)) {
  $template_dir = DIR_FS_CATALOG_ADDON_MODULES . 'addon_modules/templates/admin/generate_module/';
  $template = $template_dir . $action . '.php';
  if (file_exists($template)) {
    require($template);
  }
}
?>