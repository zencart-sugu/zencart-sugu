<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

ini_set('include_path',ini_get('include_path').':'.dirname(__FILE__).'/pear:');
require dirname(__FILE__)."/pear/File/CSV.php";

$ProductCSV = new ProductCSV();
$action = (isset($_GET['action']) ? $_GET['action'] : '');

$zco_notifier->notify('NOTIFY_PRODUCT_CSV_BEFORE_ACTION');
if ($action == 'return') {
  $_SESSION['product_csv'] = $_POST;
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv', 'NONSSL'));
}
if ($action == 'import') {
  // update
  if (isset($_POST['upfile']) && $_FILES['file'] && $_FILES['file']['size'] > 0) {
    $tempfile = DIR_FS_CATALOG . '/temp/import_' . date('YmdHis') . '.csv';
    move_uploaded_file($_FILES['file']['tmp_name'], $tempfile);
  }
  if (is_readable($tempfile)) {
    $ProductCSV->import($tempfile, $_POST['csv_format_id'], isset($_POST['ignore_first_line']));
  } else {
    $messageStack->add(PRODUCT_CSV_ERROR_READ ,'caution');
  }
  // make return button
  $return_button = zen_draw_form('return', FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv&action=return', 'post');
  $return_button .= zen_draw_hidden_field('csv_format_id', $_POST['csv_format_id']);
  $return_button .= zen_draw_hidden_field('ignore_first_line', $_POST['ignore_first_line']);
  $return_button .= '<input type="submit" value="'.PRODUCT_CSV_RETURN_TEXT.'" name="submit"/></form>';
} elseif ($action == 'export') {
  // prepare conf for File::CSV
  $format = $ProductCSV->getFormatById($_POST['csv_format_id']);
  $conf['fields'] = count($format['columns']);
  $conf['sep'] = MODULE_PRODUCT_CSV_EXPORT_CONFIG_SEP;
  $conf['quote'] = MODULE_PRODUCT_CSV_EXPORT_CONFIG_QUOTE;
  $conf['crlf'] = MODULE_PRODUCT_CSV_EXPORT_CONFIG_EOL;
  // write header line to tempfile
  foreach ($format['columns'] as $val) {
    $arr[] = mb_convert_encoding($val['csv_column_name'], MODULE_PRODUCT_CSV_EXPORT_CHARACTER ,MODULE_PRODUCT_CSV_INTERNAL_CHARACTER);
  }
  $tempfile = DIR_FS_CATALOG . '/temp/export_'.date('YmdHis').'.csv';
  File_CSV::getPointer($tempfile, $conf, FILE_MODE_WRITE);
  File_CSV::write($tempfile, $arr, $conf);

  switch ($format['csv_format_type_id']) {
  case 1:
    $prefix = 'products_';
    // get products_id
    $categories_products_id_list = array();
    $products_ids = zen_get_categories_products_list($_POST['category_id'], true, true);
    $products_ids = array_unique($products_ids);
    // write line
    foreach ($products_ids as $val) {
      $data = $ProductCSV->getExportDataProduct($val, $format);
      foreach ($data as $key => $d) {
	$data[$key] = mb_convert_encoding($d, MODULE_PRODUCT_CSV_EXPORT_CHARACTER ,MODULE_PRODUCT_CSV_INTERNAL_CHARACTER);
	$data[$key] = str_replace("\r\n", "\n", $data[$key]);
      }
      File_CSV::write($tempfile, $data, $conf);
    }
    break;
  case 2:
    $prefix = 'categories_';
    $format = zen_add_number_to_format($format);
    $max_depth = zen_get_max_depth($format);
    $categories = zen_get_categories_with_depth($_POST['category_id'], $max_depth);
    foreach ($categories as $key => $category) {
      foreach ($category as $key2 => $id) {
	if (empty($id)) {
	  continue;
	}
	$categories_products_id_list = array();
	$products = zen_get_categories_products_list($id, true, false);
	$count = count($products) == 0 ? 1 : count($products);
	for ($i=0; $i<$count; $i++) {
    $products_id = $products[$i];
	  $data = $ProductCSV->getExportDataCategory($id, $format, $products_id);
	  if ($data !== false) {
	    foreach ($data as $key => $d) {
	      $data[$key] = mb_convert_encoding($d, MODULE_PRODUCT_CSV_EXPORT_CHARACTER ,MODULE_PRODUCT_CSV_INTERNAL_CHARACTER);
	      $data[$key] = str_replace("\r\n", "\n", $data[$key]);
	    }
	    File_CSV::write($tempfile, $data, $conf);
	  }
	}
      }
    }
    break;
  case 3:
    $prefix = 'options_';
    // get products_id
    $categories_products_id_list = array();
    $products_ids = zen_get_categories_products_list($_POST['category_id'], true, true);
    $products_ids = array_unique($products_ids);
    // write line
    foreach ($products_ids as $val) {
      $attributes_ids = zen_get_attributes($val);
      foreach ($attributes_ids as $id) {
	$data = $ProductCSV->getExportDataOption($id, $format);
	if (count($data) == 0) {
	  continue;
	}
	foreach ($data as $key => $d) {
	  $data[$key] = mb_convert_encoding($d, MODULE_PRODUCT_CSV_EXPORT_CHARACTER ,MODULE_PRODUCT_CSV_INTERNAL_CHARACTER);
	  $data[$key] = str_replace("\r\n", "\n", $data[$key]);
	}
	File_CSV::write($tempfile, $data, $conf);
      }
    }
    break;
  }

  // output and delete tempfile
  if ($request_type== 'NONSSL') {
    header("Pragma: no-cache");
  } else {
    header("Pragma: ");
  }
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename="'.$prefix.date('YmdHis').'.csv"');
  header('Content-Length: '.filesize($tempfile));
  ob_end_clean();
  readfile($tempfile);
  unlink($tempfile);
  exit;
}
  $formats = $ProductCSV->getFormats();
if (!isset($return_button)) {
  $return_button = '';
}
$return_button = '<td class="pageHeading" align="right">'.$return_button.'</td>';
if (!isset($body)) {
  if (array_key_exists('product_csv', $_SESSION)) {
      if (array_key_exists('csv_format_id', $_SESSION['product_csv'])) {
	$csv_format_id = $_SESSION['product_csv']['csv_format_id'];
      }
      if (array_key_exists('ignore_first_line', $_SESSION['product_csv'])) {
	$ignore_first_line = $_SESSION['product_csv']['ignore_first_line'];
      }
      unset($_SESSION['product_csv']);
    }
  $body = '<tr><th>'.
zen_draw_form('import', FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv&action=import', 'post', 'enctype="multipart/form-data"').
PRODUCT_CSV_IMPORT_TITLE.'</th></tr><tr><td>'.
PRODUCT_CSV_IMPORT_MESSAGE.'<table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout3"><tr><th width="40%">
<label for="format">'.PRODUCT_CSV_FORMAT.': </label></th><td>'.zen_draw_pull_down_menu('csv_format_id', $formats, '', 'id="format"').'</td></tr>
<tr><th width="40%"><label for="ignore">'.PRODUCT_CSV_IGNORE_FIRST_LINE.': </label>'.zen_draw_checkbox_field('ignore_first_line', 'ignore', false, '', 'id="ignore"').
zen_draw_hidden_field('MAX_FILE_SIZE', return_bytes(ini_get(upload_max_filesize))).'</th><td>'.
zen_draw_file_field('file').' <input type="submit" name="upfile" value="'.PRODUCT_CSV_IMPORT_BUTTON.'" disabled="disabled" id="upfile"/><br/>
</form></td></tr></table></tr><tr><th>'.
zen_draw_form('export', FILENAME_ADDON_MODULES_ADMIN, 'module=product_csv&action=export', 'post').
PRODUCT_CSV_EXPORT_TITLE.'</th></tr><tr><td><table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout3">
<tr>
<th width="40%"><label for="format">'.PRODUCT_CSV_FORMAT.': </label></th><td>'.zen_draw_pull_down_menu('csv_format_id', $formats, '', 'id="format"').'</td>
</tr>
<tr>
<th width="40%"><label for="category">'.PRODUCT_CSV_EXPORT_CATEGORY.': </label></th><td>'.zen_draw_pull_down_menu('category_id', zen_get_category_tree(), '', 'id="category"').'</td>
</tr>
<tr>
<td  colspan="2" align="center"><input type="submit" name="downfile" value="'.PRODUCT_CSV_EXPORT_BUTTON.'"/></td>
</form>
</tr>
</table>
</td></tr>';
}
$zco_notifier->notify('NOTIFY_PRODUCT_CSV_FINISH_BODY_GENERATE');
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
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
	    <?php echo $return_button; ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout1">
<?php echo $body; ?>
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
