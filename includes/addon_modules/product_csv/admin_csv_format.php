<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(dirname(__FILE__) . '/classes/ProductCSV.php');
ini_set('include_path',ini_get('include_path').':'.dirname(__FILE__).'/pear:');
require('File/CSV.php');

$ProductCSV = new ProductCSV();
$action = (isset($_GET['action']) ? $_GET['action'] : '');

// delete format
if ($action == 'delete') {
  if (isset($_GET['fID'])) {
    $ProductCSV->deleteFormat($_GET['fID']);
  }
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format'));
}
if ($action == 'return') {
  if (array_key_exists('csv_format_type_id', $_POST)) {
    $_SESSION['product_csv']['csv_format_type_id'] = $_POST['csv_format_type_id'];
  }
  if (array_key_exists('csv_format_name',$_POST)) {
    $_SESSION['product_csv']['csv_format_name'] = $_POST['csv_format_name'];
  }
  if (array_key_exists('fID', $_POST)) {
    $_SESSION['product_csv']['fID'] = $_POST['fID'];
  }
  if (array_key_exists('csv_format_column', $_POST)){
    $_SESSION['product_csv']['csv_format_column'] = $_POST['csv_format_column'];
  }
  $_SESSION['product_csv']['returned'] = true;
  switch($_POST['return_to']) {
  case 'save':
    $action = 'save';
    break;
  case 'new':
    $action = 'new';
    break;
  case 'edit':
    $action = 'edit';
    break;
  default:
    $action = '';
    break;
  }
  $action_string = $action == '' ? '' : '&action='.$action;
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format'.$action_string));
  echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format'.$action_string)."<br/>\n";
  print_r($_SESSION['product_csv']);
  exit;
}
// check and save format
if ($action == 'save' && !isset($_REQUEST['upfile']) && !$_SESSION['product_csv']['returned']) {
  if (isset($_POST['csv_format_column'])) {
    $validate = true;
    switch ($_POST['csv_format_type_id']) {
    case 1:
      $validate = $validate && checkNecessity($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']));
      $validate = $validate && checkDuplicate($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']), $ProductCSV->getFormatColumnIgnore($_POST['csv_format_type_id']));
      break;
    case 2:
      $validate = $validate && checkNecessity($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']));
      $validate = $validate && checkDuplicate($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']), $ProductCSV->getFormatColumnIgnore($_POST['csv_format_type_id']));
      $validate = $validate && checkSequential($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']));
      $validate = $validate && checkDepth($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']));
      break;
    case 3:
      $validate = $validate && checkNecessityOption($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']));
      $validate = $validate && checkDuplicate($_POST['csv_format_column'], $ProductCSV->getFormatColumns($_POST['csv_format_type_id']), $ProductCSV->getFormatColumnIgnore($_POST['csv_format_type_id']));
      break;
    }
  }
  if (!isset($_POST['csv_format_column']) || $validate) {
    if (isset($_POST['fID'])) {
      $csv_format_id = $_POST['fID'];
    } else {
      $csv_format_id = false;
    }
    $ProductCSV->setFormat($_POST['csv_format_type_id'], $_POST['csv_format_name'], $_POST['csv_format_column'], $csv_format_id);
    if (isset($_SESSION['product_csv']['upfile'])) {
      unlink($_SESSION['product_csv']['upfile']);
      unset($_SESSION['product_csv']['upfile']);
    }
    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format'));
  }
}
// create, edit, and upload
if ($action == 'new' || $action == 'edit' || $action == 'save') {
  $name_csv_format_name = 'csv_format_name';
  $name_csv_format_type_id = 'csv_format_type_id';
  $csv_format_name = '';
  $csv_format_type_id = '';
  $hidden_field = '';
  $setting_now = '';
  $setting_new = '';
  $save_button = '';

  if ($_SESSION['product_csv']['returned']) {
    if (array_key_exists('csv_format_type_id', $_SESSION['product_csv'])) {
      $_POST['csv_format_type_id'] = $_SESSION['product_csv']['csv_format_type_id'];
      unset($_SESSION['product_csv']['csv_format_type_id']);
    }
    if (array_key_exists('csv_format_name',$_SESSION['product_csv'])) {
      $_POST['csv_format_name'] = $_SESSION['product_csv']['csv_format_name'];
      unset($_SESSION['product_csv']['csv_format_name']);
    }
    if (array_key_exists('fID', $_SESSION['product_csv'])) {
      $_REQUEST['fID'] = $_SESSION['product_csv']['fID'];
      unset($_SESSION['product_csv']['fID']);
    }
    if (array_key_exists('csv_format_column', $_SESSION['product_csv'])){
      $_POST['csv_format_column'] = $_SESSION['product_csv']['csv_format_column'];
      unset($_SESSION['product_csv']['csv_format_column']);
    }
    unset($_SESSION['product_csv']['returned']);
  }

  if (isset($_POST['csv_format_name'])) {
    $csv_format_name = $_POST['csv_format_name'];
  }
  if (isset($_POST['csv_format_type_id'])) {
    $csv_format_type_id = $_POST['csv_format_type_id'];
    $format_columns = $ProductCSV->getFormatColumns($csv_format_type_id);
  }
  // edit format if exists
  if ($action == 'edit' || $action == 'save') {
    if (isset($_REQUEST['fID'])) {
      $format = $ProductCSV->getFormatById($_REQUEST['fID']);
      if (!isset($format['csv_format_id']) || $format['csv_format_id'] != $_REQUEST['fID']) {
	zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format&action=new'));
      }
      $csv_format_name = $format['csv_format_name'];
      $csv_format_type_id = $format['csv_format_type_id'];
      $hidden_fields .= zen_draw_hidden_field('fID', $_REQUEST['fID']);
      $setting_now = FORM_FORMAT_NOW . '</th><td><table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">';
      foreach($format['columns'] as $val) {
	$setting_now .= '<tr><th>'.sprintf(FORM_FORMAT_COLUMN_NAME, $val['csv_format_column_number']).'</th><td>'.$val['csv_column_name'].'</td></tr>';
      }
      $setting_now .= '</table>';
      $save_button = '<input type="image" name="save" src="../admin/includes/languages/japanese/images/buttons/button_setup.gif" value="'.FORM_FORMAT_SAVE.'" onclick="return checkName();"/>';
	  
    }
    $hidden_fields .= zen_draw_hidden_field('csv_format_type_id', $csv_format_type_id);
    $disable_format_type = ' disabled="disabled"';
    $name_format_type_id = 'current_format_type_id';
    if (isset($_POST['csv_format_column'])) {
      $csv_format_column = $_POST['csv_format_column'];
    } elseif (isset($format)) {
      $csv_format_column = array();
      foreach($format['columns'] as $val) {
	$csv_format_column[$val['csv_format_column_number']] = $val['csv_column_id'];
      }
    }
  }
  // read uploaded file
  if ($action == 'save') {
    if (isset($_FILES['file']) && $_FILES['file']['size'] > 0) {
      $tempfile = DIR_FS_CATALOG . '/temp/csv_format_' . date('YmdHis');
      $_SESSION['product_csv']['upfile'] = $tempfile;
      move_uploaded_file($_FILES['file']['tmp_name'], $tempfile);
    }
    if (is_readable($_SESSION['product_csv']['upfile'])) {
      $tempfile = $_SESSION['product_csv']['upfile'];
      $conf = File_CSV::discoverFormat($tempfile);
      File_CSV::getPointer($tempfile, $conf);
      $data = File_CSV::read($tempfile, $conf);
    }

    if ($data != false) {
      $hidden_fields .= zen_draw_hidden_field('csv_format_name', $csv_format_name);
      $disable_format_name = ' disabled="disabled"';
      $name_csv_format_name = 'current_csv_format_name';

      $setting_new = '<table border="1">';
      $setting_new .= '<tr><th>'.FORM_FORMAT_COLUMN_HEADER1.'</th><th>'.FORM_FORMAT_COLUMN_HEADER2.'</th><th>'.FORM_FORMAT_COLUMN_HEADER3.'</th></tr>';
      $count = 0;
      foreach($data as $val) {
	$count++;
	$setting_new .= '
<tr><td>'.sprintf(FORM_FORMAT_COLUMN_NAME, $count).'</td><td>'.mb_convert_encoding($val, MODULE_PRODUCT_CSV_INTERNAL_CHARACTER, 'auto').'</td><td>'.zen_draw_pull_down_menu('csv_format_column['.$count.']', $format_columns, isset($csv_format_column) ? $csv_format_column[$count] : $format_columns[$count-1]['id']);
      }
      $setting_new .= '</table>';
      switch ($csv_format_type_id) {
      case 1:
	$NECESSITY = FORM_FORMAT_NECESSITY_PRODUCT;
	break;
      case 2:
	$NECESSITY = FORM_FORMAT_NECESSITY_CATEGORY;
	break;
      case 3:
	$NECESSITY = FORM_FORMAT_NECESSITY_OPTION;
	break;
      }
      $setting_new .= '<br/>'.FORM_FORMAT_NOTICE.'<br/>'.$NECESSITY.'<br/><br/>';
      $save_button = '<input type="submit" name="save" value="'.FORM_FORMAT_SAVE.'" />';
    } else {
      $setting_new = FORM_FORMAT_INVALID_FILE . '<br/>';
    }
  }
  // create return button
  $return_button = zen_draw_form('return', FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format&action=return', 'post');
  switch($action) {
  case 'save':
    if (isset($_POST['csv_format_column'])) {
      $return_button .= zen_draw_hidden_field('return_to', 'save');
      foreach($_POST['csv_format_column'] as $key => $val) {
	$return_button .= zen_draw_hidden_field('csv_format_column['.$key.']', $val);
      }
      if (isset($_REQUEST['fID'])) {
	$return_button .= zen_draw_hidden_field('fID', $_REQUEST['fID']);
      }
    }
    elseif (isset($_REQUEST['fID'])) {
      $return_button .= zen_draw_hidden_field('return_to', 'edit');
      $return_button .= zen_draw_hidden_field('fID', $_REQUEST['fID']);
    } else {
      $return_button .= zen_draw_hidden_field('return_to', 'new');
    }
    if (isset($_POST['csv_format_type_id'])) {
      $return_button .= zen_draw_hidden_field('csv_format_type_id', $_POST['csv_format_type_id']);
    }
    if (isset($_POST['csv_format_name'])) {
      $return_button .= zen_draw_hidden_field('csv_format_name', $_POST['csv_format_name']);
    }
    break;
  case 'new':
  case 'edit':
  default:
    $return_button .= zen_draw_hidden_field('return_to', '');
  }
  $return_button .= '<input type="submit" value="'.PRODUCT_CSV_RETURN_TEXT.'" name="submit"/></form>';

  $format_types = $ProductCSV->getFormatTypes();

  $body = '              '.
    zen_draw_form('csv_format', FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format&action=save', 'post', 'enctype="multipart/form-data"').'
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout1">
<tr><th valign="top"><label for="csv_format_name">'.FORM_FORMAT_NAME.': </label></th><td>'.zen_draw_input_field($name_csv_format_name, $csv_format_name, 'id="csv_format_name"'.$disable_format_name).'</td></tr>
<tr><th><label for="csv_format_type">'.FORM_FORMAT_TYPE.': </label></th><td>'.zen_draw_pull_down_menu($name_csv_format_type_id, $format_types, $csv_format_type_id, 'id="csv_format_type"'.$disable_format_type).'</td></tr>'.
$hidden_fields.'<tr><th>'.
$setting_now.'</tr><tr><th>'.
FORM_FORMAT_STEP1.'</th><td>'.
FORM_FORMAT_MESSAGE1.'<br />'.
zen_draw_hidden_field('MAX_FILE_SIZE', return_bytes(ini_get(upload_max_filesize))).'
<label for="file">'.FORM_FORMAT_FILE.': </label>'.zen_draw_file_field('file').' <input type="submit" name="upfile" value="'.FORM_FORMAT_UPLOAD.'" id="upfile" disabled="disabled" onclick="return checkName();"/></td></tr>
<tr><th>'.
FORM_FORMAT_STEP2.'</th><td>'.
FORM_FORMAT_MESSAGE2.'<br/>'.
$setting_new.
$save_button.'
</form>
              </td></tr></table>';
} else {
  // view all format
  $formats = $ProductCSV->getFormats();
  if (count($formats)) {
    $contents = '';
    $formats = $ProductCSV->getFormats();
    foreach($formats as $val) {
      $contents .= '
<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
<td class="dataTableContent">'.$val['csv_format_id'].'</td>
<td class="dataTableContent">'.$val['csv_format_name'].'</td>
<td class="dataTableContent">'.$val['csv_format_type_name'].'</td>
<td class="dataTableContent" align="right">
<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format' . '&fID=' . $val['csv_format_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>
<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format' . '&fID=' . $val['csv_format_id'] . '&action=delete') . '" id="delete" onclick="return window.confirm(\'' . sprintf(MESSAGE_DELETE_FORMAT, $val['csv_format_id'], $val['csv_format_name']) . '\')"' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>
</td>
<tr>';
    }
  } else {
    $contents = '              <tr>
                <td align="left" colspan="2" class="smallText">'.MESSAGE_NO_FORMATS.'</td>
              </tr>
';
  }
  $body = '          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">'.TABLE_HEADING_ID.'</td>
                <td class="dataTableHeadingContent">'.TABLE_HEADING_FORMAT_NAME.'</td>
                <td class="dataTableHeadingContent">'.TABLE_HEADING_FORMAT_TYPE.'</td>
                <td class="dataTableHeadingContent" align="right">'.TABLE_HEADING_ACTION.'&nbsp;</td>
              </tr>'.$contents.'
<tr>
			<td><img src="images/pixel_trans.gif" border="0" alt="" width="1" height="10"></td>
			</tr>
			              <tr>
                <td align="center" colspan="4" class="smallText"><a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv/csv_format&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a></td>
              </tr>
            </table></td>
          </tr>
';
}
if (!isset($return_button)) {
  $return_button = '';
} 
$return_button = '<td class="pageHeading" align="center">'.$return_button.'</td>';
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="../../../admin/includes/stylesheet.css">
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
  function checkName() {
    name = document.getElementById('csv_format_name').value;
    if (name == '') {
      alert('<?php echo MESSAGE_CHECK_NAME ?>');
      return false;
    } else {
      return true;
    }
  }
  function enableUpload() {
    var upload = document.getElementById('upfile');
    upload.removeAttribute('disabled');
  }
  function disableUpload() {
    var upload = document.getElementById('upfile');
    upload.setAttribute('disabled', 'disabled');
  }
  function checkFile() {
    var file = document.getElementsByName('file')[0];
    if (file == undefined) {
      return false;
    }
    if (file.addEventListener) {
      file.addEventListener('change', function(){if (file.value != '') {enableUpload();} else {disableUpload();}}, false);
    } else if (file.attachEvent) {
      file.attachEvent('onchange', function(){if (file.value != '') {enableUpload();} else {disableUpload();}});
    }
  }
  // -->
</script>
</head>
<body onload="init();checkFile();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<?php
// easy admin products by warranty
if (MODULE_WARRANTY_ADMIN_SIMPLIFY_STATUS == 'true') {
  warranty_admin_simplify_start();
}
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
			<td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
			</tr>
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
          </tr>
			<tr>
			<td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
			</tr>
		  <tr>
            <?php echo $return_button;?>
		  </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php echo $body; ?>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<?php
// easy admin products by warranty
if (MODULE_WARRANTY_ADMIN_SIMPLIFY_STATUS == 'true') {
  warranty_admin_simplify_end();
}
?>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
