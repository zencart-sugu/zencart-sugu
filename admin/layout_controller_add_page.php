<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
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
//  $Id: layout_controller_add_page.php 2981 2006-02-07 04:59:30Z ajeh $
//


  require('includes/application_top.php');

  if (zen_not_null($_GET['template_dir'])) {
    $template_dir = $_GET['template_dir'];
  }else{
    die('template_dir is empty');
  }

  if (zen_not_null($_GET['layout_page'])) {
    $layout_page = $_GET['layout_page'];
  }

  if ($_GET['action']) {
    switch ($_GET['action']) {
      case 'add':
        // check
        if( zen_not_null($layout_page) == false ){
          $messageStack->add_session('layout page is empty.', 'error');
          zen_redirect(zen_href_link(FILENAME_LAYOUT_CONTROLLER, 'template_dir=' . $template_dir));
        }

        // get default setting
        $default_setting = $db->Execute("SELECT * FROM " . TABLE_LAYOUT_BOXES . " WHERE layout_template='" . zen_db_prepare_input($template_dir) . "' and layout_page =''");
        // duplicate setting
        while( !$default_setting->EOF ){
          $sql_data_array = array(
            'layout_template' => $default_setting->fields['layout_template'],
            'layout_box_name' => $default_setting->fields['layout_box_name'],
            'layout_box_status' => $default_setting->fields['layout_box_status'],
            'layout_box_location' => $default_setting->fields['layout_box_location'],
            'layout_box_sort_order' => $default_setting->fields['layout_box_sort_order'],
            'layout_box_sort_order_single' => $default_setting->fields['layout_box_sort_order_single'],
            'layout_box_status_single' => $default_setting->fields['layout_box_status_single'],
            'layout_page' => $layout_page
          );
          zen_db_perform(TABLE_LAYOUT_BOXES, $sql_data_array);

          $default_setting->MoveNext();
        }
        $messageStack->add_session(LAYOUT_PAGE_WAS_ADDED, 'success');
        zen_redirect(zen_href_link(FILENAME_LAYOUT_CONTROLLER, 'template_dir=' . $template_dir . '&layout_page=' . $layout_page));
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
//-->
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
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE . ' ' . $template_dir; ?></td>
          </tr>
          <tr>
            <td class="main">
<?php 
  echo zen_draw_form('form_add_page', FILENAME_LAYOUT_CONTROLLER_ADD_PAGE, '', 'get');
  echo zen_draw_hidden_field('action', 'add');
  echo zen_draw_hidden_field('template_dir', $template_dir);
  // draw not setuped layout page drop down
  $not_setuped_pages = zen_get_not_setuped_layout_pages($template_dir);
  echo HEADING_TITLE_SELECT_ADD_LAYOUT_PAGE . ' ' . zen_draw_pull_down_menu('layout_page', $not_setuped_pages);
  echo zen_image_submit('button_insert.gif');
?>
              </form>
            </td>
          </tr>
        </table></td>
      </tr>
    </td>
  </tr>
</table>
</body>
</html>
