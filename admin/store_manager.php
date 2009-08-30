<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
//  $Id: store_manager.php 3297 2006-03-28 08:35:01Z drbyte $
//

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $languages = zen_get_languages();

  $products_filter = (isset($_GET['products_filter']) ? $_GET['products_filter'] : $products_filter);

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $current_category_id = (isset($_GET['current_category_id']) ? $_GET['current_category_id'] : $current_category_id);

  $configuration_key_lookup = zen_db_prepare_input($_POST['configuration_key']);

  switch($action) {

// clean out the admin_activity_log
    case 'clean_admin_activity_log':
      $db->Execute("delete from " . TABLE_ADMIN_ACTIVITY_LOG);
      $messageStack->add_session(SUCCESS_CLEAN_ADMIN_ACTIVITY_LOG, 'success');
      unset($_SESSION['reset_admin_activity_log']);
      zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;
// update all products in catalog
    case ('update_all_products_attributes_sort_order'):
      $all_products_attributes= $db->Execute("select p.products_id, pa.products_attributes_id from " .
      TABLE_PRODUCTS . " p, " .
      TABLE_PRODUCTS_ATTRIBUTES . " pa " . "
      where p.products_id= pa.products_id"
      );
      while (!$all_products_attributes->EOF) {
        $count++;
        $product_id_updated .= ' - ' . $all_products_attributes->fields['products_id'] . ':' . $all_products_attributes->fields['products_attributes_id'];
        zen_update_attributes_products_option_values_sort_order($all_products_attributes->fields['products_id']);
        $all_products_attributes->MoveNext();
      }
      $messageStack->add_session(SUCCESS_PRODUCT_UPDATE_SORT_ALL, 'success');
      $action='';
      zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
      break;

    case ('update_all_products_price_sorter'):
    // reset products_price_sorter for searches etc.
    $sql = "select products_id from " . TABLE_PRODUCTS;
    $update_prices = $db->Execute($sql);

    while (!$update_prices->EOF) {
      zen_update_products_price_sorter($update_prices->fields['products_id']);
      $update_prices->MoveNext();
    }
    $messageStack->add_session(SUCCESS_PRODUCT_UPDATE_PRODUCTS_PRICE_SORTER, 'success');
    $action='';
    zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;

    case ('update_all_products_viewed'):
    // reset products_viewed to 0
    $sql = "update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed= '0'";
    $update_viewed = $db->Execute($sql);

    $messageStack->add_session(SUCCESS_PRODUCT_UPDATE_PRODUCTS_VIEWED, 'success');
    $action='';
    zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;

    case ('update_all_products_ordered'):
    // reset products_ordered to 0
    $sql = "update " . TABLE_PRODUCTS . " set products_ordered= '0'";
    $update_viewed = $db->Execute($sql);

    $messageStack->add_session(SUCCESS_PRODUCT_UPDATE_PRODUCTS_ORDERED, 'success');
    $action='';
    zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;

    case ('update_counter'):
    // reset products_viewed to 0
    $sql = "update " . TABLE_COUNTER . " set counter= '" . (int)$_POST['new_counter'] . "'";
    $update_counter = $db->Execute($sql);

    $messageStack->add_session(SUCCESS_UPDATE_COUNTER . (int)$_POST['new_counter'], 'success');
    $action='';
    zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;

    case ('update_all_master_categories_id'):
    // reset products master categories ID

    $sql = "select products_id from " . TABLE_PRODUCTS;
    $check_products = $db->Execute($sql);
    while (!$check_products->EOF) {

      $sql = "select products_id, categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id='" . $check_products->fields['products_id'] . "'";
      $check_category = $db->Execute($sql);

      $sql = "update " . TABLE_PRODUCTS . " set master_categories_id='" . $check_category->fields['categories_id'] . "' where products_id='" . $check_products->fields['products_id'] . "'";
      $update_viewed = $db->Execute($sql);

      $check_products->MoveNext();
    }

    $messageStack->add_session(SUCCESS_UPDATE_ALL_MASTER_CATEGORIES_ID, 'success');
    $action='';
    zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
    break;

    case ('update_orders_id'):
      $old_orders_id = zen_db_prepare_input((int)$_POST['old_orders_id']);
      $new_orders_id = zen_db_prepare_input((int)$_POST['new_orders_id']);

      $db->Execute("update " . TABLE_ORDERS . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
      $db->Execute("update " . TABLE_ORDERS_PRODUCTS . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
      $db->Execute("update " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
      $db->Execute("update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
      $db->Execute("update " . TABLE_ORDERS_STATUS_HISTORY . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
      $db->Execute("update " . TABLE_ORDERS_TOTAL . " set orders_id='" . $new_orders_id . "' where orders_id='" . $old_orders_id . "'");
    break;

    case ('locate_configuration'):
      if ($_POST['configuration_key'] == '') {
        $messageStack->add_session(ERROR_CONFIGURATION_KEY_NOT_ENTERED, 'caution');
        zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
      }
      $found = 'false';
      $language_files_group = $_POST['language_files'];

          // build filenames to search
          switch ($language_files_group) {
            case (0): // none
              $filename_listing = '';
              break;
            case (1): // all english.php files
              $check_directory = array();
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $template_dir . '/' . $_SESSION['language'] . '/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/extra_definitions/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/extra_definitions/' . $template_dir . '/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/modules/payment/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/modules/shipping/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/modules/order_total/';
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language']. '/modules/product_types/';
              $check_directory[] = DIR_FS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
              $check_directory[] = DIR_FS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/newsletters/';
              break;
            case (2): // all catalog /language/*.php
              $check_directory = array();
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES;
              break;
            case (3): // all catalog /language/english/*.php
              $check_directory = array();
              $check_directory[] = DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/';
              break;
            case (4): // all admin /language/*.php
              $check_directory = array();
              $check_directory[] = DIR_FS_ADMIN . DIR_WS_LANGUAGES;
              break;
            case (5): // all admin /language/english/*.php
              // set directories and files names
              $check_directory = array();
              $check_directory[] = DIR_FS_ADMIN . DIR_WS_LANGUAGES . $_SESSION['language'] . '/';
              break;
            } // eof: switch

              // Check for new databases and filename in extra_datafiles directory

              for ($i = 0, $n = sizeof($check_directory); $i < $n; $i++) {
//echo 'I SEE ' . $check_directory[$i] . '<br>';
              $dir_check = $check_directory[$i];
              $file_extension = '.php';

              if ($dir = @dir($dir_check)) {
                while ($file = $dir->read()) {
                  if (!is_dir($dir_check . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                      $directory_array[] = $dir_check . $file;
                    }
                  }
                }
                if (sizeof($directory_array)) {
                  sort($directory_array);
                }
                $dir->close();
              }
              }

// show path and filename
          echo '<table border="0" width="100%" cellspacing="2" cellpadding="1" align="center">' . "\n";
          echo '<tr><td>&nbsp;</td></tr>';
          echo '<tr class="infoBoxContent"><td class="dataTableHeadingContent">' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . 'Searching ' . sizeof($directory_array) . ' files ...' . '</td></tr></table>' . "\n\n";
          echo '<tr><td>&nbsp;</td></tr>';

// check all files located
          $file_cnt = 0;
          for ($i = 0, $n = sizeof($directory_array); $i < $n; $i++) {
            // build file content of matching lines
            $file_cnt++;
            $file = $directory_array[$i];
            $show_file = '';
            if (file_exists($file)) {
              $show_file .= "\n" . '<table border="2" width="95%" cellspacing="2" cellpadding="1" align="center"><tr><td class="main">' . "\n";
              $show_file .= '<tr class="infoBoxContent"><td class="dataTableHeadingContent">';
              $show_file .= '<strong>' . $file . '</strong>';
              $show_file .= '</td></tr>';
              $show_file .= '<tr><td class="main">';
              // put file into an array to be scanned
              $lines = file($file);
              $found_line = 'false';
              // loop through the array, show line and line numbers
              foreach ($lines as $line_num => $line) {
                $cnt_lines++;
                if (strstr(strtoupper($line), strtoupper($configuration_key_lookup))) {
                  $found_line= 'true';
                  $found = 'true';
                  $show_file .= "<br />Line #<strong>{$line_num}</strong> : " . htmlspecialchars($line) . "<br />\n";
                } else {
                  if ($cnt_lines >= 5) {
//                    $show_file .= ' .';
                    $cnt_lines=0;
                  }
                }
              }
            }
            $show_file .= '</td></tr></table>' . "\n";

            // if there was a match, show lines
            if ($found_line == 'true') {
              echo $show_file . '<table><tr><td>&nbsp;</td></tr></table>';
            } // show file
          }

        $show_products_type_layout = 'false';
        $show_configuration_info = 'false';

      // if no matches in either databases or selected language directory give an error
      if ($found == 'false') {
        $messageStack->add(ERROR_CONFIGURATION_KEY_NOT_FOUND . ' ' . $_POST['configuration_key'], 'caution');
      } else {
        echo '<table width="90%" align="center"><tr><td>' . zen_draw_separator('pixel_black.gif', '100%', '2') . '</td></tr><tr><td>&nbsp;</td></tr></table>' . "\n";
      }
      break;




////////////////////////////////////////////////
    case ('locate_configuration_key'):
      if ($_POST['configuration_key'] == '') {
        $messageStack->add_session(ERROR_CONFIGURATION_KEY_NOT_ENTERED, 'caution');
        zen_redirect(zen_href_link(FILENAME_STORE_MANAGER));
      }
      $found = 'false';
      $language_files_group = $_POST['language_files'];

      $check_configure = $db->Execute("select * from " . TABLE_CONFIGURATION . " where configuration_key='" . $_POST['configuration_key'] . "'");
      if ($check_configure->RecordCount() < 1) {
        $check_configure = $db->Execute("select * from " . TABLE_PRODUCT_TYPE_LAYOUT . " where configuration_key='" . $_POST['configuration_key'] . "'");
        if ($check_configure->RecordCount() < 1) {

        } else {
          $show_products_type_layout = 'true';
          $show_configuration_info = 'true';
          $found = 'true';
        }
      } else {
        $show_products_type_layout = 'false';
        $show_configuration_info = 'true';
        $found = 'true';
      }

      // if no matches in either databases or selected language directory give an error
      if ($found == 'false') {
        $messageStack->add(ERROR_CONFIGURATION_KEY_NOT_FOUND . ' ' . $_POST['configuration_key'], 'caution');
      } else {
        echo '<table width="90%" align="center"><tr><td>' . zen_draw_separator('pixel_black.gif', '100%', '2') . '</td></tr><tr><td>&nbsp;</td></tr></table>' . "\n";
      }
      break;

///////////////////////////////////////////


    } // eof: action

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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
      </tr>

<?php
if ($show_configuration_info == 'true') {
  $show_configuration_info = 'false';
?>
      <tr><td colspan="2">
        <table border="3" cellspacing="4" cellpadding="4">
          <tr class="infoBoxContent">
            <td colspan="2" class="pageHeading" align="center"><?php echo TABLE_CONFIGURATION_TABLE; ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_KEY; ?></td>
            <td class="dataTableHeadingContentWhois"><?php echo $check_configure->fields['configuration_key']; ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_TITLE; ?></td>
            <td class="dataTableHeadingContentWhois"><?php echo $check_configure->fields['configuration_title']; ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_DESCRIPTION; ?></td>
            <td class="dataTableHeadingContentWhois"><?php echo $check_configure->fields['configuration_description']; ?></td>
          </tr>
<?php
  if ($show_products_type_layout == 'true') {
    $check_configure_group = $db->Execute("select * from " . TABLE_PRODUCT_TYPES . " where type_id='" . $check_configure->fields['product_type_id'] . "'");
  } else {
    $check_configure_group = $db->Execute("select * from " . TABLE_CONFIGURATION_GROUP . " where configuration_group_id='" . $check_configure->fields['configuration_group_id'] . "'");
  }
?>
<?php
  if ($show_products_type_layout == 'true') {
?>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_GROUP; ?></td>
            <td class="dataTableHeadingContentWhois"><?php echo 'Product Type Layout'; ?></td>
          </tr>
<?php } else { ?>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_VALUE; ?></td>
            <td class="dataTableHeadingContentWhois"><?php echo $check_configure->fields['configuration_value']; ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading"><?php echo TABLE_TITLE_GROUP; ?></td>
            <td class="dataTableHeadingContentWhois">
            <?php
              if ($check_configure_group->fields['configuration_group_id'] == '6') {
                $id_note = TEXT_INFO_CONFIGURATION_HIDDEN;
              } else {
                $id_note = '';
              }
              echo 'ID#' . $check_configure_group->fields['configuration_group_id'] . ' ' . $check_configure_group->fields['configuration_group_title'] . $id_note;
            ?>
            </td>
          </tr>
<?php } ?>
          <tr>
            <td class="main" align="right" valign="middle">
              <?php
                if ($show_products_type_layout == 'false' and ($check_configure->fields['configuration_id'] != 0 and $check_configure->fields['configuration_group_id'] != 6)) {
                  echo '<a href="' . zen_href_link(FILENAME_CONFIGURATION, 'gID=' . $check_configure_group->fields['configuration_group_id'] . '&cID=' . $check_configure->fields['configuration_id']) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>';
                } else {
                  $page= '';
                  if (strstr($check_configure->fields['configuration_key'], 'MODULE_SHIPPING')) $page .= 'shipping';
                  if (strstr($check_configure->fields['configuration_key'], 'MODULE_PAYMENT')) $page .= 'payment';
                  if (strstr($check_configure->fields['configuration_key'], 'MODULE_ORDER_TOTAL')) $page .= 'ordertotal';

                  if ($show_products_type_layout == 'true') {
                    echo '<a href="' . zen_href_link(FILENAME_PRODUCT_TYPES) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>';
                  } else {
                    if ($page != '') {
                      echo '<a href="' . zen_href_link(FILENAME_MODULES, 'set=' . $page) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>';
                    } else {
                      echo TEXT_INFO_NO_EDIT_AVAILABLE . '<br />';
                    }
                  }
                }
              ?>
              </td>
            <td class="main" align="center" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
          </tr>
        </table>
      </td></tr>
<?php
} else {
?>

<!-- bof: reset admin_activity_log -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class=<?php echo ($_SESSION['reset_admin_activity_log'] == true ? "alert" : "main"); ?> align="left" valign="top"><?php echo TEXT_INFO_ADMIN_ACTIVITY_LOG; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=clean_admin_activity_log') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: reset admin_activity_log -->

<!-- bof: update all option values sort orders -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=update_all_products_attributes_sort_order') . '">' . zen_image_button('button_update.gif', IMAGE_UPDATE) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: update all option values sort orders -->

<!-- bof: update all products price sorter -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_PRODUCTS_PRICE_SORTER_UPDATE; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=update_all_products_price_sorter') . '">' . zen_image_button('button_update.gif', IMAGE_UPDATE) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: update all products price sorter -->

<!-- bof: reset all counter to 0 -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr><form name = "update_counter" action="<?php echo zen_href_link(FILENAME_STORE_MANAGER, 'action=update_counter', 'NONSSL'); ?>" method="post">
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_COUNTER_UPDATE; ?></td>
            <td class="main" align="left" valign="bottom"><?php echo zen_draw_input_field('new_counter'); ?></td>
            <td class="main" align="right" valign="middle"><?php echo zen_image_submit('button_reset.gif', IMAGE_RESET); ?></td>
          </form></tr>
        </table></td>
      </tr>
<!-- eof: reset all counter to 0 -->

<!-- bof: reset all products_viewed to 0 -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_PRODUCTS_VIEWED_UPDATE; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=update_all_products_viewed') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: reset all products_viewed to 0 -->

<!-- bof: reset all products_ordered to 0 -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_PRODUCTS_ORDERED_UPDATE; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=update_all_products_ordered') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: reset all products_ordered to 0 -->

<!-- bof: reset all master_categories_id -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" align="left" valign="top"><?php echo TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE; ?></td>
            <td class="main" align="right" valign="middle"><?php echo '<a href="' . zen_href_link(FILENAME_STORE_MANAGER, 'action=update_all_master_categories_id') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: reset all master_categories_id -->

<!-- bof: resrt test order to new order number -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr><form name = "update_orders" action="<?php echo zen_href_link(FILENAME_STORE_MANAGER, 'action=update_orders_id', 'NONSSL'); ?>"' method="post">
            <td class="main" align="left" valign="top"><?php echo TEXT_ORDERS_ID_UPDATE; ?></td>
            <td class="main" align="left" valign="bottom">
              <?php echo TEXT_OLD_ORDERS_ID . '&nbsp;&nbsp;&nbsp;' . zen_draw_input_field('old_orders_id'); ?>
              <br /><?php echo TEXT_NEW_ORDERS_ID . '&nbsp;' . zen_draw_input_field('new_orders_id'); ?>
            </td>
            <td class="main" align="right" valign="middle"><?php echo zen_image_submit('button_reset.gif', IMAGE_RESET); ?></td>
          </form></tr>
          <tr>
            <td colspan="4" class="main" align="left" valign="top"><?php echo TEXT_INFO_ORDERS_ID_UPDATE; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: reset test order to new order number -->

<!-- bof: Locate a configuration constant KEY -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3" class="main" align="left" valign="middle"><?php echo TEXT_CONFIGURATION_CONSTANT; ?></td>
          </tr>

          <tr><form name = "locate_configure_key" action="<?php echo zen_href_link(FILENAME_STORE_MANAGER, 'action=locate_configuration_key', 'NONSSL'); ?>"' method="post">
            <td class="main" align="left" valign="bottom"><?php echo '<strong>' . TEXT_CONFIGURATION_KEY . '</strong>' . '<br />' . zen_draw_input_field('configuration_key'); ?></td>
            <td class="main" align="center" valign="bottom"><?php echo zen_image_submit('button_search.gif', IMAGE_SEARCH); ?></td>
            <td class="main" width="60%">&nbsp;</td>
          </form></tr>
          <tr>
            <td colspan="3" class="main" align="left" valign="top"><?php echo TEXT_INFO_CONFIGURATION_UPDATE; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: Locate a configuration constant KEY -->

<!-- bof: Locate a configuration constant -->
      <tr>
        <td colspan="2"><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3" class="main" align="left" valign="middle"><?php echo TEXT_CONFIGURATION_CONSTANT_FILES; ?></td>
          </tr>

          <tr><form name = "locate_configure" action="<?php echo zen_href_link(FILENAME_STORE_MANAGER, 'action=locate_configuration', 'NONSSL'); ?>"' method="post">
            <td class="main" align="left" valign="bottom"><?php echo '<strong>' . TEXT_CONFIGURATION_KEY_FILES . '</strong>' . '<br />' . zen_draw_input_field('configuration_key'); ?></td>
            <td class="main" align="left" valign="middle">
              <?php
                $language_lookup = array(array('id' => '0', 'text' => TEXT_LANGUAGE_LOOKUP_NONE),
                                              array('id' => '1', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_LANGUAGE),
                                              array('id' => '2', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG),
                                              array('id' => '3', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_CATALOG_TEMPLATE),
                                              array('id' => '4', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN),
                                              array('id' => '5', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_ADMIN_LANGUAGE)
                                                    );
//                                              array('id' => '6', 'text' => TEXT_LANGUAGE_LOOKUP_CURRENT_ALL)

                echo '<strong>' . TEXT_LANGUAGE_LOOKUPS . '</strong>' . '<br />' . zen_draw_pull_down_menu('language_files', $language_lookup, '0');
              ?>
            </td>
            <td class="main" align="right" valign="bottom"><?php echo zen_image_submit('button_search.gif', IMAGE_SEARCH); ?></td>
          </form></tr>
          <tr>
            <td colspan="4" class="main" align="left" valign="top"><?php echo TEXT_INFO_CONFIGURATION_UPDATE_FILES; ?></td>
          </tr>
        </table></td>
      </tr>
<!-- eof: Locate a configuration constant -->

<?php
} // eof configure
?>
      <tr>
        <td colspan="2"><?php echo '<br />' . zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>


    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>