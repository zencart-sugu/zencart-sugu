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
//  $Id: block.php $
//

  require('includes/application_top.php');

  $db->Execute(CREATE_TABLE_BLOCKS);

  // get an array of template info
  $location_options = array();
  $location_options[] = array('id' => '', 'text' => TEXT_NONE);
  $dir = @dir(DIR_FS_CATALOG_TEMPLATES);
  if (!$dir) die('DIR_FS_CATALOG_TEMPLATES NOT SET');
  while ($file = $dir->read()) {
    if (is_dir(DIR_FS_CATALOG_TEMPLATES . $file) && strtoupper($file) != 'CVS' && $file != 'template_default') {
      if (file_exists(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php')) {
        require(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php');
        $template_info[$file] = array('name' => $template_name,
                                      'version' => $template_version,
                                      'author' => $template_author,
                                      'description' => $template_description,
                                      'screenshot' => $template_screenshot);
        if ($file == $template_dir && file_exists(DIR_FS_CATALOG_TEMPLATES . $file . '/template_layout.php')) {
          require(DIR_FS_CATALOG_TEMPLATES . $file . '/template_layout.php');
          foreach($layout_locations as $layout_location) {
            $location_options[] = array('id' => $layout_location, 'text' => $layout_location);
          }
        }
      }
    }
  }

// Check all exisiting boxes are in the main /sideboxes
  $box_names = array();
  $boxes_directory = DIR_FS_CATALOG_MODULES . 'sideboxes/';
  $lang_file = @fopen(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '.php', "r");
  $lang_file_contents = '';
  if ($lang_file) {
    $lang_file_contents = fread($lang_file, filesize(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '.php'));
    fclose($lang_file);
  }
  $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
  $directory_array = array();
  if ($dir = @dir($boxes_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($boxes_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          if ($file != 'empty.txt') {
            $boxname = strtoupper(str_replace($file_extension, '', $file));
            $define_boxname = 'BOXNAME_' . $boxname;
            if (!defined($define_boxname)) {

              $matches = false;

              if (!$matches) {
                preg_match('/[^\\]{2,}[ ]*define\(\'BOX_HEADING_' . $boxname . '\', \'(.*)\'\);/', $lang_file_contents, $matches);
              }
              if ($matches) {
                define($define_boxname, $matches[1]);
                //echo "define('$define_boxname', '$matches[1]');\n";
              } else {
                //echo "define('$define_boxname', '$box_name');\n";
              }
            }
            eval('$box_names[$file] = ' . $define_boxname . ';');
            $directory_array[] = $file;
          }
        }
      }
    }
    if (sizeof($directory_array)) {
      sort($directory_array);
    }
    $dir->close();
  }

// Check all exisiting boxes are in the current template /sideboxes/template_dir
  $dir_check= $directory_array;
  $boxes_directory = DIR_FS_CATALOG_MODULES . 'sideboxes/' . $template_dir . '/';

  $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));

  if ($dir = @dir($boxes_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($boxes_directory . $file)) {
          if (in_array($file, $dir_check, TRUE)) {
            // skip name exists
          } else {
            if ($file != 'empty.txt') {
              $directory_array[] = $file;
            }
          }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  $warning_new_box = '';
  for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
    $file = $directory_array[$i];

    // Verify Definitions
    $definitions = $db->Execute("
      SELECT module, block
      FROM " . TABLE_BLOCKS . "
      WHERE module = 'sideboxes'
        AND block = '" . $file . "'
        AND template = '" . $template_dir . "'
      ;");
    if ($definitions->EOF) {
      if (!strstr($file, 'ezpages_bar')) {
        $warning_new_box .= $file . ' ';
      } else {
        // skip ezpage sideboxes
        //$warning_new_box .= $file . ' - HIDDEN ';
      }
      $db->Execute("
        INSERT INTO " . TABLE_BLOCKS . "
          (module, template, block, status, location, sort_order, visible, pages)
        VALUES
          ('sideboxes', '" . $template_dir  . "', '" . $file . "', 0, '', 0, 0, '')
        ;");
    }
  }


  // Check all exisiting addon modules blocks
  $enabled_blocks = array();
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $methods = get_class_methods($class);
    foreach ($methods as $method) {
      if (preg_match('/^block.*/', $method)) {
        $enabled_blocks[] = array('module' => $class, 'block' => $method);
      }
    }
  }

  $warning_new_block = '';
  $block_names = array();
  for ($i = 0, $n = sizeof($enabled_blocks); $i < $n; $i++) {
    $module = $enabled_blocks[$i]['module'];
    $block = $enabled_blocks[$i]['block'];
    $define_blockname = 'MODULE_' . strtoupper($module) . '_' . strtoupper($block) . '_TITLE';
    if (defined($define_blockname)) {
      eval('$block_names[$module . \'#\' . $block] = ' . $define_blockname . ';');
    } else {
      $block_names[$module . '#' . $block] = $block;
    }

    // Verify Definitions
    $definitions = $db->Execute("
      SELECT module, block
      FROM " . TABLE_BLOCKS . "
      WHERE module = '" . $module . "'
        AND block = '" . $block . "'
        AND template = '" . $template_dir . "'
      ;");
    if ($definitions->EOF) {
      if (!strstr($block, 'ezpages_bar')) {
        $warning_new_block .= $module . '#' . $block . ' ';
      } else {
        // skip ezpage sideboxes
        //$warning_new_block .= $block . ' - HIDDEN ';
      }
      $db->Execute("
        INSERT INTO " . TABLE_BLOCKS . "
          (module, template, block, status, location, sort_order, visible, pages)
        VALUES
          ('" . $module . "', '" . $template_dir  . "', '" . $block . "', 0, '', 0, 0, '')
        ;");
    }
  }


  $check_sort_order = $db->Execute("
    SELECT count(*) as count, min(sort_order) as min, max(sort_order) as max
    FROM " . TABLE_BLOCKS . "
    WHERE (template='" . $template_dir . "'
    AND block NOT LIKE '%ezpages_bar%')
    ;");
  $sort_order_min = -$check_sort_order->fields['count'];
  if ($check_sort_order->fields['min'] < $sort_order_min) $sort_order_min = $check_sort_order->fields['min'];
  $sort_order_max = $check_sort_order->fields['count'];
  if ($check_sort_order->fields['max'] > $sort_order_max) $sort_order_max = $check_sort_order->fields['max'];

  $sort_order_options = array();
  for ($i = $sort_order_min, $n = $sort_order_max; $i <= $n; $i++) {
    $sort_order_options[] = array('id' => $i, 'text' => $i);
  }

  // Check all exisiting pages are in the main /pages
  $pages_directory = DIR_FS_CATALOG_MODULES . 'pages/';

  $directory_array = array();
  if ($dir = @dir($pages_directory)) {
    while ($file = $dir->read()) {
      if (is_dir($pages_directory . $file) && !preg_match('/^\..*|^popup.*|^redirect$|^download$|^checkout_process$|^addon$/', $file)) {
        $directory_array[] = $file;
      }
    }
    if (sizeof($directory_array)) {
      sort($directory_array);
    }
    $dir->close();
  }

  $pages_options = array();
  foreach ($directory_array as $directory) {
    $define_pagename = 'PAGENAME_' . strtoupper($directory);
    if (!defined($define_pagename)) {
      $lang_file = @fopen(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $directory . '.php', "r");
      if ($lang_file) {
        $lang_file_contents = fread($lang_file, filesize(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $directory . '.php'));
        fclose($lang_file);

        $matches = false;

        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE_2\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE_1\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }

        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE_2\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE_1\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }

        if ($matches) {
          define($define_pagename, $matches[1]);
          //echo "define('$define_pagename', '$matches[1]');\n";
        } else {
          //echo "define('$define_pagename', '$directory');\n";
        }
      }
    }

    eval('$page_name = ' . $define_pagename . ';');
    $pages_options[] = array('id' => $directory, 'text' => '<strong>' . $page_name . '</strong> (' . $directory . ')');
  }

  // Check all exisiting addon modules pages
  $enabled_pages = array();
  $enabled_addon_modules = zen_addOnModules_get_enabled_modules();
  for ($i = 0, $n = count($enabled_addon_modules); $i < $n; $i++) {
    $class = $enabled_addon_modules[$i];
    $methods = get_class_methods($class);
    foreach ($methods as $method) {
      if (preg_match('/^page.*/', $method)) {
        $enabled_pages[] = array('module' => $class, 'page' => $method);
      }
    }
  }

  $addon_pages_options = array();
  for ($i = 0, $n = sizeof($enabled_pages); $i < $n; $i++) {
    $module = $enabled_pages[$i]['module'];
    $page = $enabled_pages[$i]['page'];
    $define_pagename = 'MODULE_' . strtoupper($module) . '_' . strtoupper($page) . '_TITLE';
    if (!defined($define_pagename)) {
      $lang_file = @fopen(DIR_FS_CATALOG_ADDON_MODULES . $module . '/languages/' . $_SESSION['language'] . '/' . $page . '.php', "r");
      if ($lang_file) {
        $lang_file_contents = fread($lang_file, filesize(DIR_FS_CATALOG_ADDON_MODULES . $module . '/languages/' . $_SESSION['language'] . '/' . $page . '.php'));
        fclose($lang_file);

        $matches = false;

        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE_2\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE_1\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'HEADING_TITLE\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }

        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE_2\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE_1\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }
        if (!$matches) {
          preg_match('/[^\\]{2,}[ ]*define\(\'NAVBAR_TITLE\', \'(.*)\'\);/', $lang_file_contents, $matches);
        }

        if ($matches) {
          define($define_pagename, $matches[1]);
          //echo "define('$define_pagename', '$matches[1]');\n";
        } else {
          define($define_pagename, $page);
          //echo "define('$define_pagename', '$directory');\n";
        }
      }
    }

    eval('$page_name = ' . $define_pagename . ';');
    $addon_pages_options[] = array('id' => $module . '#' . $page, 'text' => '<strong>' . $page_name . '</strong> (' . $module . '#' . $page . ')');
  }

////////////////////////////////////
  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'save':
        $id = zen_db_prepare_input($_GET['bID']);
        $location = zen_db_prepare_input($_POST['location']);
        $sort_order = zen_db_prepare_input($_POST['sort_order']);
        $visible = zen_db_prepare_input($_POST['visible']);
        $pages = '';
        if (is_array($_POST['pages'])) {
          $pages = zen_db_prepare_input($_POST['pages']);
          $pages = implode("\n", $pages);
        }

        $status = 0;
        if ($location != '') $status = 1;

        $sql_data_array = array(
          'location' => $location,
          'status' => $status,
          'sort_order' => (int)$sort_order,
          'visible' => (int)$visible,
          'pages' => $pages,
          );
        zen_db_perform(TABLE_BLOCKS, $sql_data_array, 'update', "id = '" . (int)$id . "'");

        $messageStack->add_session(SUCCESS_BLOCK_UPDATED . $_GET['block'], 'success');
        zen_redirect(zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $id));

        break;

      case 'deleteconfirm':
        $id = zen_db_prepare_input($_GET['bID']);

        $db->Execute("DELETE FROM " . TABLE_BLOCKS . " WHERE id = '" . zen_db_input($id) . "'");

        $messageStack->add_session(SUCCESS_BLOCK_DELETED . $_GET['block'], 'success');
        zen_redirect(zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page']));

        break;

      case 'save_all':
        $id = zen_db_prepare_input($_POST['id']);
        $location = zen_db_prepare_input($_POST['location']);
        $sort_order = zen_db_prepare_input($_POST['sort_order']);
        for ($i = 0, $n = count($id); $i < $n; $i++) {
          $status = 0;
          if ($location[$i] != '') $status = 1;
          $sql_data_array = array(
            'location' => $location[$i],
            'status' => $status,
            'sort_order' => (int)$sort_order[$i],
            );
          zen_db_perform(TABLE_BLOCKS, $sql_data_array, 'update', "id = '" . (int)$id[$i] . "'");
        }

        $messageStack->add_session(SUCCESS_BLOCKS_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID']));

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
<style type="text/css">
<!--
  div.page-checkbox {
    float: left;
    margin-bottom: 1em;
    width: 50%;
  }
-->
</style>
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
<script type="text/javascript">
  <!--
  var cBoxAllChecked = false;
  var cBoxClicked = false;
  function checkBoxClick(cBox, rowID) {
    cBoxClicked = true;
    resetCheckBoxAll();
  }

  function resetCheckBoxAll() {
    document.getElementById('check-all').checked = false;
  }

  function changeAllCheckBox(cBoxAllCheck, objForm) {
    var valChecked = cBoxAllCheck.checked;
    var eLength = objForm.elements.length;
    var i = 0;
    for (i = 0; i < eLength; i++) {
      var el = objForm.elements[i];
      if (el.type == 'checkbox'
        && el.id.match(/page-chechbox-/)) {
        el.checked = valChecked;
      }
    }
    return false;
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
if ($warning_new_box) {
?>
        <tr class="messageStackError">
          <td colspan="2" class="messageStackError">
<?php echo 'WARNING: New boxes found: ' . $warning_new_box; ?>
          </td>
        </tr>
<?php
}
?>
<?php
if ($warning_new_block) {
?>
        <tr class="messageStackError">
          <td colspan="2" class="messageStackError">
<?php echo 'WARNING: New blocks found: ' . $warning_new_block; ?>
          </td>
        </tr>
<?php
}
?>
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE . ' ' . $template_dir; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>

<?php
if (count($layout_locations) > 0) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" align="left">
              <strong>Boxes Path: </strong><?php echo DIR_FS_CATALOG_MODULES . 'sideboxes/ ... ' . '<br />'; ?>
              <strong>Modules Path: </strong><?php echo DIR_FS_CATALOG_ADDON_MODULES . ' ... ' . '<br />&nbsp;'; ?>
          </td>
          </tr>
          <tr>
<?php
  if ($_GET['action'] != 'edit') {
?>
            <td valign="top">
              <?php echo zen_draw_form('block_layouts', FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID'] . '&action=save_all'); ?>
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_BOX_NAME; ?><br /><?php echo TABLE_HEADING_BLOCK_NAME; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_BOX; ?><br /><?php echo TABLE_HEADING_MODULE; ?>#<?php echo TABLE_HEADING_BLOCK; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_LOCATION; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                <td colspan="2" class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>

<?php
  $boxes_directory = DIR_FS_CATALOG_MODULES . 'sideboxes' . '/';
  $boxes_directory_template = DIR_FS_CATALOG_MODULES . 'sideboxes/' . $template_dir . '/';

  $block_layouts = $db->Execute("
    SELECT id, module, block, status, location, sort_order, visible, pages
    FROM " . TABLE_BLOCKS . "
    WHERE (template='" . $template_dir . "'
    AND block NOT LIKE '%ezpages_bar%')
    ORDER BY status DESC, location, sort_order
    ;");

  $i = 0;
  while (!$block_layouts->EOF) {
//    if (((!$_GET['bID']) || (@$_GET['bID'] == $block_layouts->fields['id'])) && (!$bInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
  if ((!isset($_GET['bID']) || (isset($_GET['bID']) && ($_GET['bID'] == $block_layouts->fields['id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'new')) {
      $bInfo = new objectInfo($block_layouts->fields);
    }

//  if ( (is_object($bInfo)) && ($block_layouts->fields['id'] == $bInfo->id) ) {
    if (isset($bInfo) && is_object($bInfo) && ($block_layouts->fields['id'] == $bInfo->id)) {
      echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'">' . "\n";
    }
?>
<?php
    if ($block_layouts->fields['module'] == 'sideboxes') {
      if (file_exists($boxes_directory . $block_layouts->fields['block'])
        || file_exists($boxes_directory_template . $block_layouts->fields['block'])) {
        $exists_box = true;
        $td_class = 'dataTableContent';
      } else {
        $exists_box = false;
        $td_class = 'messageStackError';
      }
?>
                <td class="dataTableContent"><strong><?php echo $box_names[$block_layouts->fields['block']]; ?></strong></td>
                <td class="dataTableContent"><?php echo (file_exists($boxes_directory_template . $block_layouts->fields['block']) ? '<span class="alert">' . ereg_replace(DIR_FS_CATALOG_MODULES, '', $boxes_directory_template) . '</span>' . $block_layouts->fields['block'] : ereg_replace(DIR_FS_CATALOG_MODULES, '', $boxes_directory) . $block_layouts->fields['block']); ?></td>
                <td class="<?php echo $td_class; ?>" align="center"><?php echo ($block_layouts->fields['status']=='1' ? TEXT_ON : '<span class="alert">' . TEXT_OFF .'</span>'); ?></td>
                <td class="<?php echo $td_class; ?>" align="center">
                  <?php echo zen_draw_hidden_field('id[' . $i . ']', $block_layouts->fields['id'])?>
                  <?php echo zen_draw_pull_down_menu('location[' . $i . ']', $location_options, $block_layouts->fields['location']); ?>
                </td>
                <td class="<?php echo $td_class; ?>" align="center">
                  <?php echo zen_draw_pull_down_menu('sort_order[' . $i . ']', $sort_order_options, $block_layouts->fields['sort_order']); ?>
                </td>
                <td class="dataTableContent" align="right">
                  <?php echo (($exists_box) ? TEXT_GOOD_BLOCK : TEXT_BAD_BLOCK) ; ?>
                  <?php echo '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $block_layouts->fields['id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', IMAGE_EDIT) . '</a>'; ?>
                  <?php if ( (is_object($bInfo)) && ($block_layouts->fields['id'] == $bInfo->id) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $block_layouts->fields['id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
<?php
   } else {
      if (in_array($block_layouts->fields['module'], $enabled_addon_modules)
        && method_exists($block_layouts->fields['module'], $block_layouts->fields['block'])) {
        $exists_block = true;
        $td_class = 'dataTableContent';
      } else {
        $exists_block = false;
        $td_class = 'messageStackError';
      }
?>
                <td class="dataTableContent"><strong><?php echo $block_names[$block_layouts->fields['module'] . '#' . $block_layouts->fields['block']]; ?></strong></td>
                <td class="dataTableContent" width="100"><?php echo $block_layouts->fields['module'] . '#' . $block_layouts->fields['block']; ?></td>
                <td class="<?php echo $td_class; ?>" align="center"><?php echo ($block_layouts->fields['status']=='1' ? TEXT_ON : '<span class="alert">' . TEXT_OFF .'</span>'); ?></td>
                <td class="<?php echo $td_class; ?>" align="center">
                  <?php echo zen_draw_hidden_field('id[' . $i . ']', $block_layouts->fields['id'])?>
                  <?php echo zen_draw_pull_down_menu('location[' . $i . ']', $location_options, $block_layouts->fields['location']); ?>
                </td>
                <td class="<?php echo $td_class; ?>" align="center">
                  <?php echo zen_draw_pull_down_menu('sort_order[' . $i . ']', $sort_order_options, $block_layouts->fields['sort_order']); ?>
                </td>
                <td class="dataTableContent" align="right">
                  <?php echo (($exists_block) ? TEXT_GOOD_BLOCK : TEXT_BAD_BLOCK) ; ?>
                  <?php echo '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $block_layouts->fields['id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', IMAGE_EDIT) . '</a>'; ?>
                  <?php if ( (is_object($bInfo)) && ($block_layouts->fields['id'] == $bInfo->id) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $block_layouts->fields['id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
<?php
   }
?>
              </tr>

<?php
    $i++;
    $last_location = $block_layouts->fields['location'];
    $block_layouts->MoveNext();
    if (($block_layouts->fields['location'] != $last_location) and !$block_layouts->EOF) {
?>
              <tr valign="top">
                <td colspan="6" height="20" align="center" valign="middle"><?php echo zen_draw_separator('pixel_black.gif', '90%', '3'); ?></td>
              </tr>
<?php
    }
  }
?>

              <tr valign="top">
                <td valign="top"><?php echo zen_draw_separator('pixel_trans.gif', '75%', '10'); ?></td>
              </tr>
              <tr valign="top">
                <td colspan="6" align="center">
                  <?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?>
                  <a href="<?php echo zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $_GET['bID']); ?>"><?php echo zen_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>
                </td>
              </tr>
            </table>
            </form>
            </td>
<?php
  } elseif ($_GET['bID'] > 0) {
    $block_layouts = $db->Execute("
      SELECT id, module, block, status, location, sort_order, visible, pages
      FROM " . TABLE_BLOCKS . "
      WHERE template='" . $template_dir . "'
        AND block NOT LIKE '%ezpages_bar%'
        AND id = '" . (int)$_GET['bID'] . "'
      ;");
    $bInfo = new objectInfo($block_layouts->fields);
  }
?>
<?php
  $heading = array();
  $contents = array();

  if (is_object($bInfo)) {
    switch ($_GET['action']) {
      case 'edit':
        switch ($bInfo->visible) {
          case '0': $in_visible = false; $out_visible = true; break;
          case '1': $in_visible = true; $out_visible = false; break;
          default: $in_visible = false; $out_visible = true;
        }

        $pages_inputs_string = '';
        $pages_inputs_string .= '<label for="check-all">' . zen_draw_checkbox_field('check_all', '1', false, '', 'id="check-all" onClick="changeAllCheckBox(this, this.form);"') . TEXT_CHECK_ALL . '</label><br />';
        foreach ($pages_options as $pages_option) {
          $page_checked = zen_addOnModules_page_match($bInfo->pages, $pages_option['id']);
          $pages_inputs_string .= '<div class="page-checkbox"><label for="page-chechbox-' . $pages_option['id'] . '">' . zen_draw_checkbox_field('pages[' . $pages_option['id'] . ']', $pages_option['id'], $page_checked, '', 'id="page-chechbox-' . $pages_option['id'] . '" class="page-chechbox"  onclick="checkBoxClick(this, \'page-chechbox-' . $pages_option['id'] . '\');"') . $pages_option['text'] . '</label></div>';
        }
        if (count($addon_pages_options) > 0) {
          $pages_inputs_string .= '<br />' . zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3') . '<br />';
          foreach ($addon_pages_options as $pages_option) {
            $page_checked = zen_addOnModules_page_match($bInfo->pages, $pages_option['id']);
            $pages_inputs_string .= '<div class="page-checkbox"><label for="page-chechbox-' . $pages_option['id'] . '">' . zen_draw_checkbox_field('pages[' . $pages_option['id'] . ']', $pages_option['id'], $page_checked, '', 'id="page-chechbox-' . $pages_option['id'] . '" class="page-chechbox"  onclick="checkBoxClick(this, \'page-chechbox-' . $pages_option['id'] . '\');"') . $pages_option['text'] . '</label></div>';
          }
        }

        if ($bInfo->module == 'sideboxes') {
          $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_BOX . '</b>');

          $contents = array('form' => zen_draw_form('block_layouts', FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=save' . '&block=' . $bInfo->block));
          $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
          $contents[] = array('text' => TEXT_INFO_BOX_NAME . ' <strong>' . $box_names[$bInfo->block] . '</strong> (' . $bInfo->block . ')');
          $contents[] = array('text' => TEXT_INFO_BOX_STATUS . ' ' .  ($bInfo->status == '1' ? TEXT_ON : TEXT_OFF));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BOX_LOCATION . '<br />' . zen_draw_pull_down_menu('location', $location_options , $bInfo->location));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BOX_SORT_ORDER . '<br />' . zen_draw_pull_down_menu('sort_order', $sort_order_options , $bInfo->sort_order));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BOX_VISIBLE . '<br /><label for="visible-1">' . zen_draw_radio_field('visible', '1', $in_visible, '', 'id="visible-1"') . TEXT_VISIBLE_PAGES . '</label><br /><label for="visible-0">' . zen_draw_radio_field('visible', '0', $out_visible, '', 'id="visible-0"') . TEXT_INVISIBLE_PAGES . '</label>');
          $contents[] = array('text' => '<br />' . TEXT_INFO_BOX_PAGES . ' ' . $pages_inputs_string);
        } else {
          $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_BLOCK . '</b>');

          $contents = array('form' => zen_draw_form('block_layouts', FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=save' . '&block=' . $bInfo->block));
          $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
          $contents[] = array('text' => TEXT_INFO_MODULE_NAME . ' ' . $bInfo->module);
          $contents[] = array('text' => TEXT_INFO_BLOCK_NAME . ' <strong>' . $block_names[$bInfo->module . '#' . $bInfo->block] . '</strong> (' . $bInfo->block . ')');
          $contents[] = array('text' => TEXT_INFO_BLOCK_STATUS . ' ' .  ($bInfo->status == '1' ? TEXT_ON : TEXT_OFF));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BLOCK_LOCATION . '<br />' . zen_draw_pull_down_menu('location', $location_options , $bInfo->location));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BLOCK_SORT_ORDER . '<br />' . zen_draw_pull_down_menu('sort_order', $sort_order_options , $bInfo->sort_order));
          $contents[] = array('text' => '<br />' . TEXT_INFO_BLOCK_VISIBLE . '<br /><label for="visible-1">' . zen_draw_radio_field('visible', '1', $in_visible, '', 'id="visible-1"') . TEXT_VISIBLE_PAGES . '</label><br /><label for="visible-0">' . zen_draw_radio_field('visible', '0', $out_visible, '', 'id="visible-0"') . TEXT_INVISIBLE_PAGES . '</label>');
          $contents[] = array('text' => '<br />' . TEXT_INFO_BOX_PAGES . ' ' . $pages_inputs_string);
        }

        $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&block=' . $bInfo->block) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;

      case 'delete':
        if ($bInfo->module == 'sideboxes') {
          $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_BOX . '</b>');

          $contents = array('form' => zen_draw_form('block_layouts', FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=deleteconfirm' . '&block=' . $bInfo->block));
          $contents[] = array('text' => TEXT_INFO_DELETE_BOX_INTRO);
          $contents[] = array('text' => '<br /><b>' . $bInfo->block . '</b>');
        } else {
          $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_BLOCK . '</b>');

          $contents = array('form' => zen_draw_form('block_layouts', FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=deleteconfirm' . '&block=' . $bInfo->block));
          $contents[] = array('text' => TEXT_INFO_DELETE_BLOCK_INTRO);
          $contents[] = array('text' => '<br /><b>' . $bInfo->module . '#' . $bInfo->block . '</b>');
        }

        $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;

      default:
        $pages_outputs_string = '';
        foreach ($pages_options as $pages_option) {
          if (zen_addOnModules_page_match($bInfo->pages, $pages_option['id'])) {
            $pages_outputs_string .= $pages_option['text'] . '<br />';
          }
        }
        if (count($addon_pages_options) > 0) {
          $pages_outputs_string .= zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3') . '<br />';
          foreach ($addon_pages_options as $pages_option) {
            if (zen_addOnModules_page_match($bInfo->pages, $pages_option['id'])) {
              $pages_outputs_string .= $pages_option['text'] . '<br />';
            }
          }
        }

        if ($bInfo->module == 'sideboxes') {
          $heading[] = array('text' => '<strong>' . TEXT_INFO_BOX . $bInfo->block . '</strong>');
          $contents[] = array('align' => 'left', 'text' => '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
          $contents[] = array('text' => '<strong>' . TEXT_INFO_BOX_DETAILS . '<strong>');
          $contents[] = array('text' => TEXT_INFO_BOX_NAME . ' <strong>' . $box_names[$bInfo->block] . '</strong> (' . $bInfo->block . ')');
          $contents[] = array('text' => TEXT_INFO_BOX_STATUS . ' ' .  ($bInfo->status == '1' ? TEXT_ON : TEXT_OFF));
          $contents[] = array('text' => TEXT_INFO_BOX_LOCATION . ' ' . $bInfo->location);
          $contents[] = array('text' => TEXT_INFO_BOX_SORT_ORDER . ' ' . $bInfo->sort_order);
          $contents[] = array('text' => ($bInfo->visible == '1' ? TEXT_VISIBLE_PAGES : TEXT_INVISIBLE_PAGES));
          $contents[] = array('text' => $pages_outputs_string);
          if (!(file_exists($boxes_directory . $bInfo->block) || file_exists($boxes_directory_template . $bInfo->block))) {
            $contents[] = array('align' => 'left', 'text' => '<br /><strong>' . TEXT_INFO_DELETE_MISSING_BOX . '<br />' . $template_dir . '</strong>');
            $contents[] = array('align' => 'left', 'text' => TEXT_INFO_DELETE_MISSING_BOX_NOTE . '<strong>' . $bInfo->block . '</strong>');
            $contents[] = array('align' => 'left', 'text' => '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=delete' . '&block=' . $bInfo->block) . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
          }
        } else {
          $heading[] = array('text' => '<strong>' . TEXT_INFO_BLOCK . $bInfo->module . '#' . $bInfo->block . '</strong>');
          $contents[] = array('align' => 'left', 'text' => '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
          $contents[] = array('text' => '<strong>' . TEXT_INFO_BLOCK_DETAILS . '<strong>');
          $contents[] = array('text' => TEXT_INFO_MODULE_NAME . ' ' . $bInfo->module);
          $contents[] = array('text' => TEXT_INFO_BLOCK_NAME . ' <strong>' . $block_names[$bInfo->module . '#' . $bInfo->block] . '</strong> (' . $bInfo->block . ')');
          $contents[] = array('text' => TEXT_INFO_BLOCK_STATUS . ' ' .  ($bInfo->status == '1' ? TEXT_ON : TEXT_OFF));
          $contents[] = array('text' => TEXT_INFO_BLOCK_LOCATION . ' ' . $bInfo->location);
          $contents[] = array('text' => TEXT_INFO_BLOCK_SORT_ORDER . ' ' . $bInfo->sort_order);
          $contents[] = array('text' => ($bInfo->visible == '1' ? TEXT_VISIBLE_PAGES : TEXT_INVISIBLE_PAGES));
          $contents[] = array('text' => $pages_outputs_string);
          if (!(in_array($bInfo->module, $enabled_addon_modules) && method_exists($bInfo->module, $bInfo->block))) {
            $contents[] = array('align' => 'left', 'text' => '<br /><strong>' . TEXT_INFO_DELETE_MISSING_BLOCK . '<br />' . $template_dir . '</strong>');
            $contents[] = array('align' => 'left', 'text' => TEXT_INFO_DELETE_MISSING_BLOCK_NOTE . '<strong>' . $bInfo->module . '#' . $bInfo->block . '</strong>');
            $contents[] = array('align' => 'left', 'text' => '<a href="' . zen_href_link(FILENAME_BLOCKS, 'page=' . $_GET['page'] . '&bID=' . $bInfo->id . '&action=delete' . '&block=' . $bInfo->block) . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
          }
        }
        break;
    }
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo "\n" . '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
          <tr valign="top">
            <td valign="top"><?php echo zen_draw_separator('pixel_trans.gif', '1', '100'); ?></td>
          </tr>

<!-- end of display -->

        </table></td>
      </tr>
<?php
} else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" align="center"><strong><?php echo TEXT_NO_LAYOUT_LOCATIONS; ?></strong></td>
          </tr>
        </table></td>
      </tr>
<?php
}
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>