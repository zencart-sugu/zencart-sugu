<?php
/**
 * module_generate Module
 *
 * @package module_generate
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: admin.php $
 */

if (isset($_POST['module_title'])) {
  $module_title = htmlspecialchars($_POST['module_title']);
  $module_name = htmlspecialchars($_POST['module_name']);
  $module_version = htmlspecialchars($_POST['module_version']);
  $module_sort_order = htmlspecialchars($_POST['module_sort_order']);
  $module_description = htmlspecialchars($_POST['module_description']);
  $module_author = htmlspecialchars($_POST['module_author']);
  $module_author_email = htmlspecialchars($_POST['module_author_email']);
  $module_zencart_version = htmlspecialchars($_POST['module_zencart_version']);
  $module_addonmodule_version = htmlspecialchars($_POST['module_addonmodule_version']);
  $module_required = htmlspecialchars($_POST['module_required']);

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
  
  if ($module_required != '' && !preg_match('/^[a-zA-Z][a-zA-Z0-9_-]*$/',$module_required)) {
    $messageStack->add(MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED, 'error');
    $validate = false;
  }
  
  // validation OK
  if ($validate) {
    $skelton_dir = DIR_FS_CATALOG_ADDON_MODULES . 'module_generate/skel/';
    $module_dir = DIR_FS_SQL_CACHE . '/' . $module_name . '/';
    $module_language_dir = $module_dir . '/languages/';
    mkdir($module_dir);
    mkdir($module_language_dir);

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
    foreach ($files as $file) {
      $buff = file($file);
      $buff = implode('', $buff);

      $buff = preg_replace('/:package/', $module_name, $buff);
      $buff = preg_replace('/:module_name/', $module_name, $buff);
      $buff = preg_replace('/:author_email/', $module_author_email, $buff);
      $buff = preg_replace('/:author/', $module_author, $buff);
      $buff = preg_replace('/:version/', $module_author, $buff);
      $buff = preg_replace('/:zencart_version/', $module_zencart_version, $buff);
      $buff = preg_replace('/:addonmodule_version/', $module_addonmodule_version, $buff);
      $buff = preg_replace('/:required/', $module_required, $buff);

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
      $fp = fopen($module_dir . basename($file), 'w');
      fwrite($fp, $buff);
      fclose($fp);
    }
    foreach ($languages as $file) {
      $buff = file($file);
      $buff = implode('', $buff);

      $buff = preg_replace('/:package/', $module_name, $buff);
      $buff = preg_replace('/:def_title/', $def_title , $buff);
      $buff = preg_replace('/:module_title/', $module_title , $buff);
      $buff = preg_replace('/:def_description/', $def_description , $buff);
      $buff = preg_replace('/:module_description/', $module_description , $buff);

      $buff = preg_replace('/:def_status_title/', $def_status_title, $buff);
      $buff = preg_replace('/:def_status_description/', $def_status_description, $buff);

      $buff = preg_replace('/:def_sort_order_title/', $def_sort_order_title, $buff);
      $buff = preg_replace('/:def_sort_order_description/', $def_sort_order_description, $buff);

      // write file
      $fp = fopen($module_language_dir . basename($file), 'w');
      fwrite($fp, $buff);
      fclose($fp);
    }
    // archive files
    require(DIR_FS_CATALOG_ADDON_MODULES . 'addon_modules/pear/Tar.php');
    $tarname = DIR_FS_SQL_CACHE . '/' . $module_name . '.tar';
    $tar = new Archive_Tar($tarname);
    $ret = $tar->createModify($module_dir, '', DIR_FS_SQL_CACHE . '/');

    // remove skelton files
    foreach ($files as $file) {
      unlink($module_dir.basename($file));
    }
    foreach ($languages as $file) {
      unlink($module_language_dir.basename($file));
    }
    rmdir($module_language_dir);
    rmdir($module_dir);

    // last process
    if (!$ret) {
      $messageStack->add(MODULE_MODULE_GENERATE_ERROR_CREATE_FAILED, 'error');
    } else {
      if ($request_type== 'NONSSL') {
        header("Pragma: no-cache");
      } else {
        header("Pragma: ");
      }
      header('Content-Type: application/octet-stream');
      header('Content-Disposition: attachment; filename="'.basename($tarname).'"');
      header('Content-Length: '.filesize($tarname));
      readfile($tarname);
      unlink($tarname);
      exit;
    }
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

  function checkBeforeSubmit() {
    var e;
    var error = new Array();

    e = document.getElementById('module_title');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_TITLE; ?>');
    }
    e = document.getElementById('module_name');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_NAME; ?>');
    }
    if (e && e.value && !e.value.match(/^[a-zA-Z][a-zA-Z0-9_-]*$/)) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VALIDATE_NAME; ?>');
    }
    e = document.getElementById('module_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VERSION; ?>');
    }
    e = document.getElementById('module_description');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_DESCTIPTION; ?>');
    }
    e = document.getElementById('module_author');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_AUTHOR; ?>');
    }
    e = document.getElementById('module_author_email');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_AUTHOR_EMAIL; ?>');
    }
    e = document.getElementById('module_zencart_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_ZENCART_VERSION; ?>');
    }
    e = document.getElementById('module_addonmodule_version');
    if (!e || !e.value) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_ADDONMODULE_VERSION; ?>');
    }
    e = document.getElementById('module_required');
    if (e && e.value && !e.value.match(/^[a-zA-Z][a-zA-Z0-9_-]*$/)) {
      error.push('<?php echo MODULE_MODULE_GENERATE_ERROR_VALIDATE_REQUIRED; ?>');
    }

    if (error.length > 0) {
      alert(error.join('\n'));
      return false;
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
<?php echo zen_draw_form('module_generate', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(), 'post', 'id="module_generate" onsubmit="return checkBeforeSubmit();"'); ?>
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
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo TABLE_HEADING_MODULES_TITLE; ?></td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_MODULES_NAME; ?></td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_VARSION; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
          echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
?>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_title', '', 'size="30" id="module_title"'); ?></td>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_name', '', 'id="module_name"'); ?></td>
                <td class="dataTableContent"><?php echo zen_draw_input_field('module_version', MODULE_MODULE_GENERATE_VERSION, 'readonly="readonly" size="10" id="module_version"'); ?></td>
                <td class="dataTableContent" align="right"><?php echo zen_draw_input_field('module_sort_order', '', 'size="5" id="module_sort_order"'); ?></td>
                <td class="dataTableContent" align="right"><?php echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); ?>&nbsp;</td>
              </tr>
            </table></td>
<?php
// 以下サイドカラム
      $heading = array();
      $contents = array();

      $heading[] = array('text' => '<b>' . TITLE_SIDOBOX_OF_MODULE_GENERATE . '</b>');

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_DESCRIPTION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_description', '', 'size="50" id="module_description"'));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_AUTHOR.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_author', '', 'id="module_author"'));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_EMAIL.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_author_email', MODULE_MODULE_GENERATE_MODULE_EMAIL_DEFAULT, 'id="module_author_email"'));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_zencart_version', MODULE_MODULE_GENERATE_MODULE_ZENCART_VERSION_DEFAULT, 'id="module_zencart_version"'));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_addonmodule_version', MODULE_MODULE_GENERATE_MODULE_ADDONMODULE_VERSION_DEFAULT, 'id="module_addonmodule_version"'));

      $contents[] = array('align' => 'left', 'text' => '<b>'.MODULE_MODULE_GENERATE_MODULE_REQUIRED.'</b>');
      $contents[] = array('align' => 'left', 'text' => zen_draw_input_field('module_required', '', 'id="module_required"'));

      $contents[] = array('align' => 'center', 'text' => zen_draw_input_field('submit', MODULE_MODULE_GENERATE_MODULE_GENERATE, '', '', 'submit'));

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";
    $box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
  }
// サイドカラム終了
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
</form>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
