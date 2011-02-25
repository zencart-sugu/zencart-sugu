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
  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $module_key = 'ADDON_MODULE_INSTALLED';

  if (zen_not_null($action)) {
    switch ($action) {
      case 'save':
        while (list($key, $value) = each($_POST['configuration'])) {
          $db->Execute("update " . TABLE_CONFIGURATION . "
                       set configuration_value = '" . zen_db_input($value) . "'
                       where configuration_key = '" . zen_db_input($key) . "'");
        }
        $configuration_query = 'select configuration_key as cfgkey, configuration_value as cfgvalue
                                from ' . TABLE_CONFIGURATION;

        $configuration = $db->Execute($configuration_query);

        $module = new $_GET['module'];
        if ($module->status != 'true' && $module->_dependModules()) {
          $messageStack->add_session(sprintf(WARNING_DEPEND_MODULE_INACTIVE, $module->code), 'warning');
        }
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'action=save_enabled_to_cache&' . ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL'));
        break;
      case 'install':
      /**
       * @todo
       * module update
       */
      //case 'update_confirm':
      case 'remove':
      case 'cleanup_confirm';
        $class = basename($_GET['module']);
        if (file_exists(DIR_FS_CATALOG_ADDON_MODULES . $class . '/module.php')) {
          $configuration_query = 'select configuration_key as cfgkey, configuration_value as cfgvalue
                                  from ' . TABLE_CONFIGURATION;

          $configuration = $db->Execute($configuration_query);

          zen_addOnModules_load_module_files($class);

          $module = new $class;
          if ($action == 'install') {
            $module->install();
          /**
           * @todo
           * module update
           */
          //} elseif ($action == 'update_confirm') {
          //  $module->update();
          } elseif ($action == 'remove') {
            $module->remove();
          } elseif ($action == 'cleanup_confirm') {
            $module->cleanup();
          }
        }

        if ($action == 'install' || $action == 'update_confirm') {
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $class . '&action=edit', 'NONSSL'));
        } else {
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $class, 'NONSSL'));
        }
        break;
      case 'save_enabled_to_cache':
        zen_addOnModules_save_enabled_modules_to_cache();
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : '') . ($_GET['edit'] == 1 ? '&action=edit' : ''), 'NONSSL'));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          <?php
          if (isset($GLOBALS['addon_modules'])) {
          ?>
          <tr>
            <td>
              <?php echo zen_draw_form("download", FILENAME_ADDON_MODULES_ADMIN, "module=addon_modules/download", "post"); ?>
                <input type="submit" value="<?php echo BUTTON_TEXT_MODULE_DOWNLOAD; ?>">
              </form>
            </td>
          </tr>
          <?php
          }
          ?>
          <tr>
            <td class="smallText" colspan="2">
            <?php echo
              '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, zen_get_all_get_params()) . '" class="menuBoxContentLink">' .
  '<b><u>' . TEXT_ADDON_MODULES_REFRESH_LIST . '</u></b>' . '</a>' .
  '&nbsp;&nbsp;' . TEXT_ADDON_MODULES_LEGEND . '&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_green.gif') . '&nbsp;' . TEXT_ADDON_MODULES_ACTIVE . '&nbsp;&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif') . '&nbsp;' . TEXT_ADDON_MODULES_INACTIVE . '&nbsp;&nbsp;' .
  zen_image(DIR_WS_IMAGES . 'icon_status_red.gif') . '&nbsp;' . TEXT_ADDON_MODULES_REMOVED . '&nbsp;&nbsp;';
            ?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo TABLE_HEADING_MODULES; ?></td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_VARSION; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $directory_array = array();
  if ($dir = @dir(DIR_FS_CATALOG_ADDON_MODULES)) {
    while ($file = $dir->read()) {
      if (is_dir(DIR_FS_CATALOG_ADDON_MODULES . $file) && strtoupper($file) != 'CVS' && preg_match('/^[^\.]/', $file)) {
        $directory_array[] = $file;
      }
    }
    sort($directory_array);
    $dir->close();
  }


  $installed_modules = array();
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];
    $class = $file;
    zen_addOnModules_load_module_files($class);

    if (zen_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        if ($module->sort_order > 0 && !isset($installed_modules[$module->sort_order])) {
          $installed_modules[$module->sort_order] = $file;
        } else {
          $installed_modules[] = $file;
        }
      }
      if ((!isset($_GET['module']) || (isset($_GET['module']) && ($_GET['module'] == $class))) && !isset($mInfo)) {
        $module_info = array('code' => $module->code,
                             'title' => $module->title,
                             'description' => $module->description,
                             'status' => $module->check());
        $module_keys = $module->keys();
        $keys_extra = array();
        for ($j=0, $k=sizeof($module_keys); $j<$k; $j++) {
          $key_value = $db->Execute("select configuration_title, configuration_value, configuration_key,
                                            configuration_description, use_function, set_function
                                     from " . TABLE_CONFIGURATION . "
                                     where configuration_key = '" . $module_keys[$j] . "'");

          $keys_extra[$module_keys[$j]]['title'] = $key_value->fields['configuration_title'];
          $keys_extra[$module_keys[$j]]['value'] = $key_value->fields['configuration_value'];
          $keys_extra[$module_keys[$j]]['description'] = $key_value->fields['configuration_description'];
          $keys_extra[$module_keys[$j]]['use_function'] = $key_value->fields['use_function'];
          $keys_extra[$module_keys[$j]]['set_function'] = $key_value->fields['set_function'];
        }
        $module_info['keys'] = $keys_extra;
        $mInfo = new objectInfo($module_info);
      }
      if (isset($mInfo) && is_object($mInfo) && ($class == $mInfo->code) ) {
        if ($module->check() > 0) {
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $class . '&action=edit', 'NONSSL') . '\'">' . "\n";
        } else {
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
        }
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $class, 'NONSSL') . '\'">' . "\n";
      }
      $status_icon = zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', TEXT_ADDON_MODULES_REMOVED);
      if ($module->check() > 0) {
        if ($module->status  == 'true') {
          $status_icon = zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', TEXT_ADDON_MODULES_ACTIVE);
        } else {
          $status_icon = zen_image(DIR_WS_IMAGES . 'icon_status_yellow.gif', TEXT_ADDON_MODULES_INACTIVE);
        }
      }
?>
                <td class="dataTableContent"><?php echo $status_icon . '&nbsp;' . $module->title; ?></td>
                <td class="dataTableContent"><?php echo $module->code; ?></td>
                <td class="dataTableContent"><?php echo $module->varsion; ?></td>
                <td class="dataTableContent" align="right"><?php if (is_numeric($module->sort_order)) echo $module->sort_order; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($mInfo) && is_object($mInfo) && ($class == $mInfo->code) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $class, 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
  }
  ksort($installed_modules);
  $installed_modules_keys = array_keys($installed_modules);
  sort($installed_modules_keys);
  $installed_addon_modules = array();
  foreach ($installed_modules_keys as $installed_modules_key) {
    array_push($installed_addon_modules, $installed_modules[$installed_modules_key]);
  } 
  $check = $db->Execute("select configuration_value
                         from " . TABLE_CONFIGURATION . "
                         where configuration_key = '" . $module_key . "'");

  if ($check->RecordCount() > 0) {
    if ($check->fields['configuration_value'] != implode(';', $installed_modules)) {
      $db->Execute("update " . TABLE_CONFIGURATION . "
                    set configuration_value = '" . implode(';', $installed_modules) . "', last_modified = now()
                    where configuration_key = '" . $module_key . "'");
      zen_addOnModules_save_enabled_modules_to_cache();
    }
  } else {
    $db->Execute("insert into " . TABLE_CONFIGURATION . "
                  (configuration_title, configuration_key, configuration_value,
                   configuration_description, configuration_group_id, sort_order, date_added)
                 values ('Installed Modules', '" . $module_key . "', '" . implode(';', $installed_modules) . "',
                         'This is automatically updated. No need to edit.', '6', '0', now())");
    zen_addOnModules_save_enabled_modules_to_cache();
  }
?>
              <tr>
                <td colspan="3" class="smallText"><?php echo TEXT_MODULE_DIRECTORY . ' ' . DIR_FS_CATALOG_ADDON_MODULES; ?></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($action) {
    case 'edit':
      $keys = '';
      reset($mInfo->keys);
      while (list($key, $value) = each($mInfo->keys)) {
        $keys .= '<b>' . $value['title'] . '</b><br>' . $value['description'] . '<br>';
        if ($value['set_function']) {
          eval('$keys .= ' . $value['set_function'] . "'" . str_replace('\'', '\\\'', $value['value']) . "', '" . $key . "');");
        } else {
          $keys .= zen_draw_input_field('configuration[' . $key . ']', $value['value']);
        }
        $keys .= '<br><br>';
      }
      $keys = substr($keys, 0, strrpos($keys, '<br><br>'));
      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');
      $contents = array('form' => zen_draw_form('modules', FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : '') . '&action=save', 'post', '', true));
      if (ADMIN_CONFIGURATION_KEY_ON == 1) {
        $contents[] = array('text' => '<strong>Key: ' . $mInfo->code . '</strong><br />');
      }
      $contents[] = array('text' => $keys);
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL') . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;

    /**
     * @todo
     * module update
     */
    /*
    case 'update':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_UPDATE_MODULE . '</b>');
      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');

      $update_module = false;
      if ($mInfo->status == '1') {
        $update_module = true;
      }

      if ($update_module) {
        $contents[] = array('text' => TEXT_UPDATE_MODULE_INTRO);
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=update_confirm', 'NONSSL') . '">' . zen_image_button('button_update.gif', IMAGE_UPDATE) . '</a>' . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL') . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      } else {
        $contents[] = array('text' => TEXT_UPDATE_MODULE_DO_NOTHING);
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      }
      break;
      */

    case 'cleanup':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_CLEANUP_MODULE . '</b>');
      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');

      $cleanup_module = false;
      if ($mInfo->status != '1') {
        if (!is_object(${$mInfo->code})) {
          ${$mInfo->code} = new $mInfo->code;
        }
        if (${$mInfo->code}->tableExist()) {
          $tables_string = '<ul>';
          foreach(${$mInfo->code}->tables as $table => $fields) {
            $tables_string .= '<li>' . $table . '</li>';
          }
          $tables_string .= '</ul>';
          $cleanup_module = true;
          }
      }

      if ($cleanup_module) {
        $contents[] = array('text' => TEXT_CLEANUP_MODULE_INTRO);
        $contents[] = array('text' => $tables_string);
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=cleanup_confirm', 'NONSSL') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>' . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL') . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      } else {
        $contents[] = array('text' => TEXT_CLEANUP_MODULE_DO_NOTHING);
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, ($_GET['module'] != '' ? 'module=' . $_GET['module'] : ''), 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>');
      }
      break;

    default:
      $heading[] = array('text' => '<b>' . $mInfo->title . '</b>');

      if ($mInfo->status == '1') {

        $admin_pages = '';
        $module_dir = @dir(DIR_FS_CATALOG . ${$mInfo->code}->dir);
        while ($file = $module_dir->read()) {
          $admin_page_name = '';
          if (preg_match('/^admin[_]{0,1}(.*)\.php$/', $file, $matches)) {
            $admin_page_name = $file;
            $lang_file = @fopen(DIR_FS_CATALOG_ADDON_MODULES . $mInfo->code . '/languages/' . $_SESSION['language'] . '/' . $file, "r");
            if ($lang_file) {
              $lang_file_contents = fread($lang_file, filesize(DIR_FS_CATALOG_ADDON_MODULES . $mInfo->code . '/languages/' . $_SESSION['language'] . '/' . $file));
              fclose($lang_file);

              if (preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE\',[\s]*\'(.*)\'\);/', $lang_file_contents, $title_matches)) {
                 $admin_page_name = $title_matches[1];
              }
            }
            $admin_pages .= '<li><a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=' . $mInfo->code . ($matches[1] != '' ? '/' . $matches[1] : '')) . '">' . $admin_page_name . '</a></li>';
          }
        }

        if ($admin_pages != '') {
          $contents[] = array('text' => '<b>' . TEXT_ADDON_MODULES_ADMIN_PAGES . '</b><ul>' . $admin_pages . '</ul><hr>');
        }

        $keys = '';
        reset($mInfo->keys);
        while (list(, $value) = each($mInfo->keys)) {
          $keys .= '<b>' . $value['title'] . '</b><br>';
          if ($value['use_function']) {
            $use_function = $value['use_function'];
            if (ereg('->', $use_function)) {
              $class_method = explode('->', $use_function);
              if (!is_object(${$class_method[0]})) {
                require_once(DIR_WS_CLASSES . $class_method[0] . '.php');
                ${$class_method[0]} = new $class_method[0]();
              }
              $keys .= zen_call_function($class_method[1], $value['value'], ${$class_method[0]});
            } else {
              $keys .= zen_call_function($use_function, $value['value']);
            }
          } else {
            $keys .= $value['value'];
          }
          $keys .= '<br><br>';
        }

        if (ADMIN_CONFIGURATION_KEY_ON == 1) {
          $contents[] = array('text' => '<strong>Key: ' . $mInfo->code . '</strong><br />');
        }
        $keys = substr($keys, 0, strrpos($keys, '<br><br>'));
        /**
         * @todo
         * module update process
         */
        //$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=update', 'NONSSL') . '">' . zen_image_button('button_module_update.gif', IMAGE_MODULE_UPDATE) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=remove', 'NONSSL') . '">' . zen_image_button('button_module_remove.gif', IMAGE_MODULE_REMOVE) . '</a> <a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=edit', 'NONSSL') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
        $contents[] = array('text' => '<br>' . $mInfo->description);
        $contents[] = array('text' => '<br>' . $keys);

      } else {
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=install', 'NONSSL') . '">' . zen_image_button('button_module_install.gif', IMAGE_MODULE_INSTALL) . '</a>');
        $contents[] = array('text' => '<br>' . $mInfo->description);
        if (!is_object(${$mInfo->code})) {
          ${$mInfo->code} = new $mInfo->code;
        }
        if (${$mInfo->code}->tableExist()) {
          $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $mInfo->code . '&action=cleanup', 'NONSSL') . '">' . zen_image_button('button_module_cleanup.gif', IMAGE_MODULE_CLEANUP) . '</a>');
        }
      }
      break;
  }
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";
    $box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
