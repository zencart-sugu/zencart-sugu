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
//  $Id: email_welcome.php 2999 2006-02-09 17:21:39Z drbyte $
//
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    switch ($action) {
      case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          zen_set_feature_status($_GET['fID'], $_GET['flag']);
          $messageStack->add_session(SUCCESS_FEATURE_AREA_STATUS_UPDATED, 'success');
        } else {
          $messageStack->add_session(ERROR_UNKNOWN_STATUS_FLAG, 'error');
        }

        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $_GET['fID']));
      break;
      case 'insert':
      case 'save':
        if (isset($_GET['fID'])) $feature_id = zen_db_prepare_input($_GET['fID']);
        $link_url = zen_db_prepare_input($_POST['link_url']);
        $sort_order = zen_db_prepare_input($_POST['sort_order']);
        $status = zen_db_prepare_input($_POST['status']);
        $new_window = zen_db_prepare_input($_POST['new_window']);

        $sql_data_array = array(
          'link_url' => $link_url,
          'sort_order' => $sort_order,
          'status' => $status,
          'new_window' => $new_window,
        );

        if ($action == 'insert') {
          $insert_sql_data = array('date_added' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          zen_db_perform(TABLE_ADDON_MODULES_FEATURE_AREA, $sql_data_array);
          $feature_id = zen_db_insert_id();
        } elseif ($action == 'save') {
          $update_sql_data = array('last_modified' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $update_sql_data);

          zen_db_perform(TABLE_ADDON_MODULES_FEATURE_AREA, $sql_data_array, 'update', "id = '" . (int)$feature_id . "'");
        }

        $feature_main_image = new upload('main_image');
        $feature_main_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['main_img_dir']);
        if ( $feature_main_image->parse() &&  $feature_main_image->save()) {
          // remove image from database if none
          if ($feature_main_image->filename != 'none') {
            $db->Execute("update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                          set main_image = '" .  $_POST['main_img_dir'] . $feature_main_image->filename . "'
                          where id = '" . (int)$feature_id . "'");
          } else {
            $db->Execute("update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                          set main_image = ''
                          where id = '" . (int)$feature_id . "'");
          }
        }
        $feature_thumb_image = new upload('thumb_image');
        $feature_thumb_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['thumb_img_dir']);
        if ( $feature_thumb_image->parse() &&  $feature_thumb_image->save()) {
          // remove image from database if none
          if ($feature_thumb_image->filename != 'none') {
            $db->Execute("update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                          set thumb_image = '" .  $_POST['thumb_img_dir'] . $feature_thumb_image->filename . "'
                          where id = '" . (int)$feature_id . "'");
          } else {
            $db->Execute("update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                          set thumb_image = ''
                          where id = '" . (int)$feature_id . "'");
          }
        }

        $languages = zen_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $feature_name_array = $_POST['feature_name'];
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('name' => zen_db_prepare_input($feature_name_array[$language_id]));

          if ($action == 'insert') {
            $insert_sql_data = array('id' => $feature_id,
                                     'languages_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            zen_db_perform(TABLE_ADDON_MODULES_FEATURE_AREA_INFO, $sql_data_array);
          } elseif ($action == 'save') {
            zen_db_perform(TABLE_ADDON_MODULES_FEATURE_AREA_INFO, $sql_data_array, 'update', "id = '" . (int)$feature_id . "' and languages_id = '" . (int)$language_id . "'");
          }
        }

        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&' . (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'fID=' . $feature_id));
        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page']));
        }
        $feature_id = zen_db_prepare_input($_GET['fID']);

        if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {

          $manufacturer = $db->Execute("select main_image
                                        from " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                                        where id = '" . (int)$feature_id . "'");
          $main_image_location = DIR_FS_CATALOG_IMAGES . $manufacturer->fields['main_image'];
          if (file_exists($main_image_location)) @unlink($main_image_location);
          $thumbimage_location = DIR_FS_CATALOG_IMAGES . $manufacturer->fields['thumb_image'];
          if (file_exists($thumb_image_location)) @unlink($thumb_image_location);
        }

        $db->Execute("delete from " . TABLE_ADDON_MODULES_FEATURE_AREA . "
                      where id = '" . (int)$feature_id . "'");
        $db->Execute("delete from " . TABLE_ADDON_MODULES_FEATURE_AREA_INFO . "
                      where id = '" . (int)$feature_id . "'");

/*
        if (isset($_POST['delete_products']) && ($_POST['delete_products'] == 'on')) {
          $products = $db->Execute("select products_id
                                    from " . TABLE_PRODUCT_MUSIC_EXTRA . "
                                    where artists_id = '" . (int)$feature_id . "'");

          while (!$products->EOF) {
            zen_remove_product($products->fields['products_id']);
            $products->MoveNext();
          }
        } else {
          $db->Execute("update " . TABLE_PRODUCT_MUSIC_EXTRA . "
                        set artists_id = ''
                        where artists_id = '" . (int)$feature_id . "'");
        }
*/

        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page']));
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
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FEATURE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FEATURE_MAIN_IMAGE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FEATURE_THUMB_IMAGE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FEATURE_LINK_URL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SORT_ORDER; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $query_raw = "select * from " . TABLE_ADDON_MODULES_FEATURE_AREA . " order by sort_order";
  $results_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $query_raw, $feature_query_numrows);
  $results = $db->Execute($query_raw);
  while (!$results->EOF) {
      if ((!isset($_GET['fID']) || (isset($_GET['fID']) && ($_GET['fID'] == $results->fields['id']))) && !isset($fInfo) && (substr($action, 0, 3) != 'new')) {
      $fInfo_array = $results->fields;
      $fInfo = new objectInfo($fInfo_array);
  }

    if (isset($fInfo) && is_object($fInfo) && ($results->fields['id'] == $fInfo->id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=edit') . '\'">' . "\n";
    }

    $display_url = $results->fields['link_url'];
    if (strlen($results->fields['link_url']) > 20) {
      $display_url = substr($results->fields['link_url'], 0, 5) . "...";
    }
?>
                <td class="dataTableContent"><?php echo $results->fields['id']; ?></td>
                <td class="dataTableContent"><?php echo feature_area_get_name($results->fields['id'], $_SESSION['languages_id']); ?></td>
                <td class="dataTableContent"><a href="<?php echo  DIR_WS_CATALOG_IMAGES.$results->fields['main_image'];?>" target="_blank"><?php echo $results->fields['main_image']; ?></a></td>
                <td class="dataTableContent"><a href="<?php echo  DIR_WS_CATALOG_IMAGES.$results->fields['thumb_image'];?>" target="_blank"><?php echo $results->fields['thumb_image']; ?></a></td>
                <td class="dataTableContent"><a href="<?php echo  $results->fields['link_url'];?>" target="_blank"><?php echo $display_url; ?></a></td>
                <td class="dataTableContent" align="center">
<?php
      if ($results->fields['status'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=setflag&flag=0') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=setflag&flag=1') . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }
?>
                </td>
                <td class="dataTableContent" align="right"><?php echo $results->fields['sort_order']; ?>&nbsp;</td>
                <td class="dataTableContent" align="right">
                  <?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>'; ?>
                  <?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $results->fields['id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>'; ?>
                  <?php if (isset($fInfo) && is_object($fInfo) && ($results->fields['id'] == $fInfo->artists_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('fID')) . 'fID=' . $results->fields['id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>
                </td>
              </tr>
<?php
    $results->MoveNext();
  }

?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $results_split->display_count($feature_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_FEATURES); ?></td>
                    <td class="smallText" align="right"><?php echo $results_split->display_links($feature_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
?>
              <tr>
                <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->artists_id . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'setflag':
      if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
        zen_set_banner_status($_GET['bID'], $_GET['flag']);

        $messageStack->add_session(SUCCESS_BANNER_STATUS_UPDATED, 'success');
      } else {
        $messageStack->add_session(ERROR_UNKNOWN_STATUS_FLAG, 'error');
      }

    case 'new':

      $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_FEATURE . '</b>');

      $contents = array('form' => zen_draw_form('feature_area', FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&action=insert', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);

      $manufacturer_inputs_string = '';
      $languages = zen_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('feature_name[' . $languages[$i]['id'] . ']', '', zen_set_field_length(TABLE_ADDON_MODULES_FEATURE_AREA_INFO, 'name') );
      }
      $contents[] = array('text' => '<br>' . TEXT_FEATURE_NAME . $manufacturer_inputs_string);
      $contents[] = array('text' => '<br>' . TEXT_FEATURE_URL . '<br>' . zen_draw_input_field('feature_url', '', zen_set_field_length(TABLE_ADDON_MODULES_FEATURE_AREA, 'link_url')));

      $contents[] = array('text' => '<br>' . TEXT_FEATURE_MAIN_IMAGE . '<br>' . zen_draw_file_field('main_image'));
      $dir = @dir(DIR_FS_CATALOG_IMAGES);
      $dir_info[] = array('id' => '', 'text' => "Main Directory");
      while ($file = $dir->read()) {
        if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
          $dir_info[] = array('id' => $file . '/', 'text' => $file);
        }
      }
      $default_directory = 'feature/';
      $contents[] = array('text' => '<BR />' . TEXT_FEATURE_MAIN_IMAGE_DIR . zen_draw_pull_down_menu('main_img_dir', $dir_info, $default_directory));

      $contents[] = array('text' => '<br>' . TEXT_FEATURE_THUMB_IMAGE . '<br>' . zen_draw_file_field('thumb_image'));
      $dir = @dir(DIR_FS_CATALOG_IMAGES);
      $dir_info[] = array('id' => '', 'text' => "Main Directory");
      while ($file = $dir->read()) {
        if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
          $dir_info[] = array('id' => $file . '/', 'text' => $file);
        }
      }
      $default_directory = 'feature/';
      $contents[] = array('text' => '<BR />' . TEXT_FEATURE_THUMB_IMAGE_DIR . zen_draw_pull_down_menu('thumb_img_dir', $dir_info, $default_directory));

      $status_radio =
                 zen_draw_radio_field("status", 1, true).TEXT_FEATURE_STATUS_TRUE.
                 zen_draw_radio_field("status", 0, false).TEXT_FEATURE_STATUS_FALSE;
      $contents[] = array('text' => '<br />' . TEXT_FEATURE_STATUS . '<br>' . $status_radio);
      $new_window_radio =
                 zen_draw_radio_field("new_window", 1, false).TEXT_FEATURE_NEW_WINDOW_TRUE.
                 zen_draw_radio_field("new_window", 0, true).TEXT_FEATURE_NEW_WINDOW_FALSE;
      $contents[] = array('text' => '<br />' . TEXT_FEATURE_NEW_WINDOW . '<br>' . $new_window_radio);

      $contents[] = array('text' => '<br />' . TEXT_FEATURE_SORT_ORDER . '<br>' . zen_draw_input_field('sort_order', '', 'size="5"'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $_GET['fID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;

    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_FEATURE . '</b>');
      $contents = array('form' => zen_draw_form('feature', FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id . '&action=save', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_EDIT_INTRO);

      $manufacturer_inputs_string = '';
      $languages = zen_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . zen_draw_input_field('feature_name[' . $languages[$i]['id'] . ']', feature_area_get_name($fInfo->id, $languages[$i]['id']), zen_set_field_length(TABLE_ADDON_MODULES_FEATURE_AREA_INFO, 'name'));
      }
      $contents[] = array('text' => '<br>' . TEXT_FEATURE_NAME . $manufacturer_inputs_string);

      $contents[] = array('text' => '<br />' . TEXT_FEATURE_URL . '<br>' . zen_draw_input_field('link_url', $fInfo->link_url, zen_set_field_length(TABLE_ADDON_MODULES_FEATURE_AREA, 'link_url')));

      $contents[] = array('text' => '<br />' . TEXT_FEATURE_MAIN_IMAGE . '<br>' . zen_draw_file_field('main_image') . '<br />' . $fInfo->main_image);
      $dir = @dir(DIR_FS_CATALOG_IMAGES);
      $dir_info[] = array('id' => '', 'text' => "Main Directory");
      while ($file = $dir->read()) {
        if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
          $dir_info[] = array('id' => $file . '/', 'text' => $file);
        }
      }
      $default_directory = substr( $fInfo->main_image, 0,strpos( $fInfo->main_image, '/')+1);
      $contents[] = array('text' => '<BR />' . TEXT_FEATURE_MAIN_IMAGE_DIR . zen_draw_pull_down_menu('main_img_dir', $dir_info, $default_directory));
      $contents[] = array('text' => '<br />' . zen_info_image($fInfo->main_image, $fInfo->link_url,300));

      $contents[] = array('text' => '<br />' . TEXT_FEATURE_THUMB_IMAGE . '<br>' . zen_draw_file_field('thumb_image') . '<br />' . $fInfo->thumb_image);
      $dir = @dir(DIR_FS_CATALOG_IMAGES);
      $dir_info[] = array('id' => '', 'text' => "Main Directory");
      while ($file = $dir->read()) {
        if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
          $dir_info[] = array('id' => $file . '/', 'text' => $file);
        }
      }
      $default_directory = substr( $fInfo->thumb_image, 0,strpos( $fInfo->thumb_image, '/')+1);
      $contents[] = array('text' => '<BR />' . TEXT_FEATURE_THUMB_IMAGE_DIR . zen_draw_pull_down_menu('thumb_img_dir', $dir_info, $default_directory));
      $contents[] = array('text' => '<br />' . zen_info_image($fInfo->thumb_image, $fInfo->link_url));

      $status_radio =
                 zen_draw_radio_field("status", 1, $fInfo->status==1).TEXT_FEATURE_STATUS_TRUE.
                 zen_draw_radio_field("status", 0, $fInfo->status==0).TEXT_FEATURE_STATUS_FALSE;
      $contents[] = array('text' => '<br />' . TEXT_FEATURE_STATUS . '<br>' . $status_radio);
      $new_window_radio =
                 zen_draw_radio_field("new_window", 1, $fInfo->new_window==1).TEXT_FEATURE_NEW_WINDOW_TRUE.
                 zen_draw_radio_field("new_window", 0, $fInfo->new_window==0).TEXT_FEATURE_NEW_WINDOW_FALSE;
      $contents[] = array('text' => '<br />' . TEXT_FEATURE_NEW_WINDOW . '<br>' . $new_window_radio);
      $contents[] = array('text' => '<br />' . TEXT_FEATURE_SORT_ORDER . '<br>' . zen_draw_input_field('sort_order', $fInfo->sort_order, 'size="5"'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_FEATURE . '</b>');

      $contents = array('form' => zen_draw_form('feature', FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . feature_area_get_name($fInfo->id,$_SESSION['languages_id'])  . '</b>');
      $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', '', true) . ' ' . TEXT_DELETE_IMAGE);

      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($fInfo) && is_object($fInfo)) {
        $heading[] = array('text' => '<b>' . feature_area_get_name($fInfo->id, $_SESSION['languages_id']) . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=feature_area&page=' . $_GET['page'] . '&fID=' . $fInfo->id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . zen_date_short($fInfo->date_added));
        if (zen_not_null($fInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . zen_date_short($fInfo->last_modified));
        $contents[] = array('text' => '<br />' . zen_info_image($fInfo->thumb_image, $fInfo->link_url));
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
