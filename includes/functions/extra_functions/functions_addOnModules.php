<?php
/**
 * addOnModules functions.php
 *
 * @package functions
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
        $installed_addon_modules[] = $value;
      }
    }
  }
  return $installed_addon_modules;
}

function zen_addOnModules_get_enabled_modules() {
  global $enabled_addon_modules;
  if (!isset($enabled_addon_modules)) {
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
    usort($enabled_addon_modules, "zen_addOnModules_sort_enabled_modules");
  }
  return $enabled_addon_modules;
}

/**
 * sort enabled modules order by sort_order
 *
 * @author saito
 * @see zen_addOnModules_get_enabled_modules
 */
function zen_addOnModules_sort_enabled_modules($a, $b) {
  $sort_order_a = $GLOBALS[$a]->sort_order;
  $sort_order_b = $GLOBALS[$b]->sort_order;
  if ($sort_order_a == $sort_order_b) {
    return 0;
  }
  if (is_numeric($sort_order_a) && is_numeric($sort_order_b)) {
    return ($sort_order_a < $sort_order_b) ? -1 : 1;
  } elseif (is_numeric($sort_order_a)) {
    return -1;
  } elseif (is_numeric($sort_order_b)) {
    return 1;
  }
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
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
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
    if (file_exists($module_directory . 'init.php')) {
      $module_init_files[] = $module_directory . 'init.php';
    }
  }
  return $module_init_files;
}

function zen_addOnModules_get_layout_location_blocks($layout_location, $page) {
  global $db, $layout_location_blocks, $template_dir;
  $return = false;
  if (!is_array($layout_location_blocks)) {
    $layout_location_blocks = array();
  }

  if (!is_array($layout_location_blocks[$layout_location])) {
    $layout_location_blocks[$layout_location] = array();
  }

  $module_names = '';
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  $enabled_addon_modules[] = 'sideboxes';
  if (count($enabled_addon_modules) > 0) {
    for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
      $class = $enabled_addon_modules[$i];
      $module_names .= " '" . zen_db_prepare_input($class) . "',";
    }
    $module_names = trim($module_names, ',');

    $query = "
      SELECT
        *
      FROM " . TABLE_BLOCKS . "
      WHERE module IN (" . $module_names . ")
      AND status = 1
      AND location = :location
      AND template = :template
      ORDER BY sort_order, block
      ;";
    $query = $db->bindVars($query, ':location', $layout_location, 'string');
    $query = $db->bindVars($query, ':template', $template_dir, 'string');
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $module = $result->fields['module'];
      $block = $result->fields['block'];
      $pages = $result->fields['pages'];
      $visible = $result->fields['visible'];

      $display = false;
      if ($pages == '') {
        $display = true;

      } else {
	if ($page == FILENAME_DEFAULT) {
	  if (isset($_GET['cPath'])) {
	    global $current_category_id;
	    $page = zen_has_category_subcategories($current_category_id) ? FILENAME_DEFAULT . '_categories' : FILENAME_DEFAULT . '_products';
	  }
	  if (isset($_GET['manufacturers_id'])) {
	    $page = FILENAME_DEFAULT . '_products';
	  }
	}
        if ($page == FILENAME_ADDON) {
          $perse_page_module = zen_addOnModules_persePageModule($_GET['module']);
          $page = $perse_page_module['class'] . '#' . $perse_page_module['method'];
        }
        $page_match = zen_addOnModules_page_match($pages, $page);

        if (($visible == 1 && $page_match)
          || ($visible == 0 && !$page_match)) {
            $display = true;
        }
      }

      if ($display) {
        $layout_location_blocks[$layout_location][] = array(
          'module' => $module,
          'block' => $block,
          'css_selector' => $result->fields['css_selector'],
          'insert_position' => $result->fields['insert_position'],
          );
      }

      $result->MoveNext();
    }
  }

  return $layout_location_blocks;
}

function zen_addOnModules_get_block_styles($layout_location, $page) {
  global $db, $layout_location_blocks;

  if (!is_array($layout_location_blocks[$layout_location])) {
    $layout_location_blocks = zen_addOnModules_get_layout_location_blocks($layout_location, $current_page_base);
  }

  $return = false;

  $blocks = $layout_location_blocks[$layout_location];
  for ($i = 0, $n = count($blocks); $i < $n; $i++) {
    $module = $blocks[$i]['module'];
    $block = $blocks[$i]['block'];
    if ($module != 'sideboxes') {
      $return .= $GLOBALS[$module]->getBlockStyles($block, $page);
    }
  }

  return $return;
}

function zen_addOnModules_get_block_jscripts($layout_location, $page) {
  global $db, $layout_location_blocks;

  if (!is_array($layout_location_blocks[$layout_location])) {
    $layout_location_blocks = zen_addOnModules_get_layout_location_blocks($layout_location, $current_page_base);
  }

  $return = false;

  $blocks = $layout_location_blocks[$layout_location];
  for ($i = 0, $n = count($blocks); $i < $n; $i++) {
    $module = $blocks[$i]['module'];
    $block = $blocks[$i]['block'];
    if ($module != 'sideboxes') {
      $return .= $GLOBALS[$module]->getBlockJScripts($block, $page);
    }
  }

  return $return;
}

function zen_addOnModules_get_layout_contents($layout_location, $page) {
  global $layout_location_blocks;

  if (!is_array($layout_location_blocks[$layout_location])) {
    $layout_location_blocks = zen_addOnModules_get_layout_location_blocks($layout_location, $current_page_base);
  }


  $blocks = $layout_location_blocks[$layout_location];
  if ($layout_location == "main") {
    $return = array();
    for ($i = 0, $n = count($blocks); $i < $n; $i++) {
      $module = $blocks[$i]['module'];
      $block  = $blocks[$i]['block'];
      $key    = $module."/".$block;
      if ($module == 'sideboxes')
        $contents = zen_addOnModules_get_sidebox($block);
      else
        $contents = $GLOBALS[$module]->getBlock($block, $page);
      $return[$key] = array(
        'contents'        => $contents,
        'css_selector'    => $blocks[$i]['css_selector'],
        'insert_position' => $blocks[$i]['insert_position'],
      );
    }
  }
  else {
    $return = false;
    for ($i = 0, $n = count($blocks); $i < $n; $i++) {
      $module = $blocks[$i]['module'];
      $block = $blocks[$i]['block'];
      if ($module == 'sideboxes') {
        $return .= zen_addOnModules_get_sidebox($block);
      } else {
        $return .= $GLOBALS[$module]->getBlock($block, $page);
      }
    }
  }

  return $return;
}

function zen_addOnModules_page_match($pages, $page) {
  $pages = str_replace(array(' ', "\r\n", "\r", "\n"), array('', '|',  '|', '|'), $pages);
  $pages = preg_replace('/[|]+/', '|', $pages);
  return preg_match('/^(' . $pages . ')$/', $page);
}

function zen_addOnModules_get_sidebox($_block) {
  extract($GLOBALS);
  $return = false;

  ob_start();

  $column_box_default = 'tpl_box.php';
  $module = 'sideboxes';
  $column_width = BOX_WIDTH_LEFT;
  $box_id = zen_get_box_id($_block);
  if ( file_exists(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $_block) ) {
    require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/' . $_block);
  } else {
    require(DIR_WS_MODULES . 'sideboxes/' . $_block);
  }

  $return = ob_get_contents();
  ob_end_clean();

  return $return;
}

function zen_addOnModules_get_styles($page) {
  $return = false;
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $return .= $GLOBALS[$class]->getStyle($page);
    $return .= $GLOBALS[$class]->getPageStyle($page);
  }
  return $return;
}

function zen_addOnModules_get_jscripts($page) {
  $return = false;
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $return .= $GLOBALS[$class]->getJScript($page);
    $return .= $GLOBALS[$class]->getPageJScript($page);
  }
  return $return;
}

function zen_addOnModules_persePageModule($str = null) {
  // sanitize the GET parameters
  if (zen_not_null($str)) $str = ereg_replace('[^0-9a-zA-Z_\/]', '', $str);

  // parse module params
  list($class, $method) = split('/', $str);
  if ($method != '') {
    $method = 'page_' . $method;
  } else {
    $method = 'page';
  }

  return array('class' => $class, 'method' => $method);
}

function zen_addOnModules_get_block($module_name, $block_name = 'block') {
  global $current_page_base;
  if (is_object($GLOBALS[$module_name]) && $GLOBALS[$module_name]->enabled) {
    return  $GLOBALS[$module_name]->getBlock($block_name, $current_page_base);
  }
  else {
    return '';
  }
}

/**
 * call addon_module's methods with parameter.
 *
 * @param string $module_name module's_name
 * @param string $function_name function's name
 * @param array $values function's parameter
 */
function zen_addOnModules_call_function($module_name, $function_name, $values = array(), $default_module_name = null, $default_function_name = null, $default_values = array()) {
  if (is_object($GLOBALS[$module_name]) && $GLOBALS[$module_name]->enabled) {
    if (method_exists($GLOBALS[$module_name], $function_name)) {
      // call class method
      return call_user_func_array(array($GLOBALS[$module_name], $function_name), $values);
    }
  } elseif (function_exists($function_name)) {
    return call_user_func_array($function_name, $values);
  } elseif (!is_null($default_function_name)) {
    if (!is_null($default_module_name) && is_object($GLOBALS[$default_module_name]) && $GLOBALS[$default_module_name]->enabled) {
      if (method_exists($GLOBALS[$default_module_name], $default_function_name)) {
        // call class method
        return call_user_func_array(array($GLOBALS[$default_module_name], $default_function_name), $default_values);
      } elseif (functions_exists($default_function_name)) {
        // call global functions
        return call_user_func_array($default_function_name, $default_values);
      }
    } else {
      // call global functions
      return call_user_func_array($default_function_name, $default_values);
    }
  }
  return '';
}
?>
