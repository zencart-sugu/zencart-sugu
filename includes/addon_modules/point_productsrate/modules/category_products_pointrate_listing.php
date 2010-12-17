<?php
/**
 * Category Products Point Rate Listing
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_products_pointrate_listing.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (isset($_GET['set_display_categories_dropdown'])) {
  $_SESSION['display_categories_dropdown'] = $_GET['set_display_categories_dropdown'];
}
if (!isset($_SESSION['display_categories_dropdown'])) {
  $_SESSION['display_categories_dropdown'] = 0;
}
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?>&nbsp;-&nbsp;<?php echo zen_output_generated_category_path($current_category_id); ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
    echo zen_draw_form('search', FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate'. 'get');
// show reset search
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
    }
    echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search') . zen_hide_session_id();
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
      echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
    }
    echo '</form>';
?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
  if ($_SESSION['display_categories_dropdown'] == 0) {
    echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&set_display_categories_dropdown=1&cID=' . $categories->fields['categories_id'] . '&cPath=' . $cPath . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')) . '">' . zen_image(DIR_WS_ICONS . 'cross.gif', IMAGE_ICON_STATUS_OFF) . '</a>&nbsp;&nbsp;';
    echo zen_draw_form('goto', FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate'. 'get');
    echo zen_hide_session_id();
    echo HEADING_TITLE_GOTO . ' ' . zen_draw_pull_down_menu('cPath', zen_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
    echo '</form>';
  } else {
    echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&set_display_categories_dropdown=0&cID=' . $categories->fields['categories_id'] . '&cPath=' . $cPath . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')) . '">' . zen_image(DIR_WS_ICONS . 'tick.gif', IMAGE_ICON_STATUS_ON) . '</a>&nbsp;&nbsp;';
    echo HEADING_TITLE_GOTO;
  }
?>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><?php echo zen_draw_form('update_rate', FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_productsrate&action=update_rate', 'post'); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
<?php if ($action == '') { ?>
                <td class="dataTableHeadingContent" width="20" align="right"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_MODEL; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE; ?></td>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_QUANTITY; ?>&nbsp;&nbsp;&nbsp;</td>
                <td class="dataTableHeadingContent" width="50" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_CATEGORIES_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_POINTRATE; ?>&nbsp;</td>
<?php } // action == '' ?>
              </tr>
<?php
    switch ($_SESSION['categories_products_sort_order']) {
      case (0):
        $order_by = " order by c.sort_order, cd.categories_name";
        break;
      case (1):
        $order_by = " order by cd.categories_name";
      case (2);
      case (3);
      case (4);
      case (5);
      case (6);
      }

    $categories_count = 0;
    $rows = 0;
    if (isset($_GET['search'])) {
      $search = zen_db_prepare_input($_GET['search']);

      $categories = $db->Execute("select c.categories_id, cd.categories_name, cd.categories_description, c.categories_image,
                                         c.parent_id, c.sort_order, c.date_added, c.last_modified,
                                         c.categories_status
                                  from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                  where c.categories_id = cd.categories_id
                                  and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                  and cd.categories_name like '%" . zen_db_input($search) . "%'" .
                                  $order_by);
    } else {
      $categories = $db->Execute("select c.categories_id, cd.categories_name, cd.categories_description, c.categories_image,
                                         c.parent_id, c.sort_order, c.date_added, c.last_modified,
                                         c.categories_status
                                  from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                  where c.parent_id = '" . (int)$current_category_id . "'
                                  and c.categories_id = cd.categories_id
                                  and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'" .
                                  $order_by);
    }
    while (!$categories->EOF) {
      $categories_count++;
      $rows++;

// Get parent_id for subcategories if search
      if (isset($_GET['search'])) $cPath = $categories->fields['parent_id'];

      if (isset($cInfo) && is_object($cInfo) && ($categories->fields['categories_id'] == $cInfo->categories_id) ) {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''  . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&' . zen_get_path($categories->fields['categories_id'])) . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&' . zen_get_path($categories->fields['categories_id'])) . '\'">' . "\n";
      }
?>
<?php if ($action == '') { ?>
                <td class="dataTableContent" width="20" align="right"><?php echo $categories->fields['categories_id']; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&' . zen_get_path($categories->fields['categories_id'])) . '">' . zen_image(DIR_WS_ICONS . 'folder.gif', ICON_FOLDER) . '</a>&nbsp;<b>' . $categories->fields['categories_name'] . '</b>'; ?></td>
                <td class="dataTableContent" align="center">&nbsp;</td>
                <td class="dataTableContent" align="right">&nbsp;<?php echo zen_get_products_sale_discount('', $categories->fields['categories_id'], true); ?></td>
                <td class="dataTableContent" align="center">&nbsp;</td>
                <td class="dataTableContent" align="right" valign="bottom">
                  <?php
                  if (SHOW_COUNTS_ADMIN == 'false') {
                    // don't show counts
                  } else {
                    // show counts
                    $total_products = zen_get_products_to_categories($categories->fields['categories_id'], true);
                    $total_products_on = zen_get_products_to_categories($categories->fields['categories_id'], false);
                    echo $total_products_on . TEXT_PRODUCTS_STATUS_ON_OF . $total_products . TEXT_PRODUCTS_STATUS_ACTIVE;
                  }
                  ?>
                  &nbsp;&nbsp;
                </td>
                <td class="dataTableContent" width="50" align="left">
<?php
      if ($categories->fields['categories_status'] == '1') {
        echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON);
      } else {
        echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF);
      }
      if (zen_get_products_to_categories($categories->fields['categories_id'], true, 'products_active') == 'true') {
        echo '&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED);
      }
?>
                </td>
                <td class="dataTableContent" align="right"><?php echo $categories->fields['sort_order']; ?></td>
                <td class="dataTableContent" align="right">
                </td>
<?php } // action == '' ?>
              </tr>
<?php
      $categories->MoveNext();
    }


    switch ($_SESSION['categories_products_sort_order']) {
      case (0):
        $order_by = " order by p.products_sort_order, pd.products_name";
        break;
      case (1):
        $order_by = " order by pd.products_name";
        break;
      case (2);
        $order_by = " order by p.products_model";
        break;
      case (3);
        $order_by = " order by p.products_quantity, pd.products_name";
        break;
      case (4);
        $order_by = " order by p.products_quantity DESC, pd.products_name";
        break;
      case (5);
        $order_by = " order by p.products_price_sorter, pd.products_name";
        break;
      case (6);
        $order_by = " order by p.products_price_sorter DESC, pd.products_name";
        break;
      }

    $products_count = 0;
    if (isset($_GET['search'])) {
      $products_query_raw = ("select p.products_type, p.products_id, pd.products_name, p.products_quantity,
                                       p.products_image, p.products_price, p.products_date_added,
                                       p.products_last_modified, p.products_date_available,
                                       p.products_status, p2c.categories_id,
                                       p.products_model,
                                       p.products_quantity_order_min, p.products_quantity_order_units, p.products_priced_by_attribute,
                                       p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.product_is_always_free_shipping,
                                       p.products_quantity_order_max, p.products_sort_order, ppr.rate
                                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, "
                                       . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                       left join " . TABLE_PRODUCTS_POINT_RATE . " ppr on p2c.products_id = ppr.products_id
                                where p.products_id = pd.products_id
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and p.products_id = p2c.products_id
                                and (
                                pd.products_name like '%" . zen_db_input($_GET['search']) . "%'
                                or pd.products_description like '%" . zen_db_input($_GET['search']) . "%'
                                or p.products_model like '%" . zen_db_input($_GET['search']) . "%')" .
                                $order_by);
    } else {
      $products_query_raw = ("select p.products_type, p.products_id, pd.products_name, p.products_quantity,
                                       p.products_image, p.products_price, p.products_date_added,
                                       p.products_last_modified, p.products_date_available,
                                       p.products_status, p.products_model,
                                       p.products_quantity_order_min, p.products_quantity_order_units, p.products_priced_by_attribute,
                                       p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.product_is_always_free_shipping,
                                       p.products_quantity_order_max, p.products_sort_order, ppr.rate
                                from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                                       left join " . TABLE_PRODUCTS_POINT_RATE . " ppr on p2c.products_id = ppr.products_id
                                where p.products_id = pd.products_id
                                and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and p.products_id = p2c.products_id
                                and p2c.categories_id = '" . (int)$current_category_id . "'" .
                                $order_by);
    }
// Split Page
// reset page when page is unknown
if (($_GET['page'] == '1' or $_GET['page'] == '') and $_GET['pID'] != '') {
  $old_page = $_GET['page'];
  $check_page = $db->Execute($products_query_raw);
  if ($check_page->RecordCount() > MAX_DISPLAY_RESULTS_CATEGORIES) {
    $check_count=1;
    while (!$check_page->EOF) {
      if ($check_page->fields['products_id'] == $_GET['pID']) {
        break;
      }
      $check_count++;
      $check_page->MoveNext();
    }
    $_GET['page'] = round((($check_count/MAX_DISPLAY_RESULTS_CATEGORIES)+(fmod_round($check_count,MAX_DISPLAY_RESULTS_CATEGORIES) !=0 ? .5 : 0)),0);
    $page = $_GET['page'];
    if ($old_page != $_GET['page']) {
//      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID'] . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')));
    }
  } else {
    $_GET['page'] = 1;
  }
}
    $products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_RESULTS_CATEGORIES, $products_query_raw, $products_query_numrows);
    $products = $db->Execute($products_query_raw);
// Split Page

    while (!$products->EOF) {
      $products_count++;
      $rows++;

// Get categories_id for product if search
      if (isset($_GET['search'])) $cPath = $products->fields['categories_id'];

// Split Page
      $type_handler = $zc_products->get_admin_handler($products->fields['products_type']);
      if (isset($pInfo) && is_object($pInfo) && ($products->fields['products_id'] == $pInfo->products_id) ) {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">' . "\n";
      }
// Split Page
?>
                <td class="dataTableContent" width="20" align="right"><?php echo $products->fields['products_id']; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT, 'cPath=' . $cPath . '&pID=' . $products->fields['products_id'] . '&action=new_product_preview&read=only' . '&product_type=' . $products->fields['products_type'] . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')) . '">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $products->fields['products_name']; ?></td>
                <td class="dataTableContent"><?php echo $products->fields['products_model']; ?></td>
                <td colspan="2" class="dataTableContent" align="right"><?php echo zen_get_products_display_price($products->fields['products_id']); ?></td>
                <td class="dataTableContent" align="right"><?php echo $products->fields['products_quantity']; ?></td>
                <td class="dataTableContent" width="50" align="left">
<?php
      if ($products->fields['products_status'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&action=setflag&flag=0&pID=' . $products->fields['products_id'] . '&cPath=' . $cPath . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')) . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&action=setflag&flag=1&pID=' . $products->fields['products_id'] . '&cPath=' . $cPath . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '')) . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }
      if (zen_get_product_is_linked($products->fields['products_id']) == 'true') {
        echo '&nbsp;&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED) . '<br>';
      }
?>
                </td>
<?php if ($action == '') { ?>
                <td class="dataTableContent" align="right"><?php echo $products->fields['products_sort_order']; ?></td>
                <td class="dataTableContent" align="right"><?php
        echo zen_draw_hidden_field('products_id[]', $products->fields['products_id']);
        echo zen_draw_input_field('rate[]', $products->fields['rate'],  zen_set_field_length(TABLE_PRODUCTS_POINT_RATE, 'rate'));
?></td>

<?php } // action == '' ?>

              </tr>
<?php
      $products->MoveNext();
    }

    $cPath_back = '';
    if (sizeof($cPath_array) > 0) {
      for ($i=0, $n=sizeof($cPath_array)-1; $i<$n; $i++) {
        if (empty($cPath_back)) {
          $cPath_back .= $cPath_array[$i];
        } else {
          $cPath_back .= '_' . $cPath_array[$i];
        }
      }
    }

    $cPath_back = (zen_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
?>
<?php if ($action == '') { ?>
              <tr>
                <td colspan="9"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText"><?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br />' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?></td>
                    <td align="right" class="smallText"><?php if (sizeof($cPath_array) > 0) echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate&' . $cPath_back . 'cID=' . $current_category_id) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>&nbsp;'; ?>

<?php if ($zc_skip_products == false && $products_count > 0) { ?>
<?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE, 'name="submit_update"'); ?>
<?php
  } else {
?>
<?php } // hide has cats?>
          &nbsp;</td>
                  </tr>
                </table></td>
              </tr>
<?php } // turn off when editing ?>
            </table></form></td>
