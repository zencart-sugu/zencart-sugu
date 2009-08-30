<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
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
//  $Id: products_price_manager.php 3304 2006-03-28 22:57:31Z ajeh $
//

  require('includes/application_top.php');

  // verify products exist
  $chk_products = $db->Execute("select * from " . TABLE_PRODUCTS . " limit 1");
  if ($chk_products->RecordCount() < 1) {
    $messageStack->add_session(ERROR_DEFINE_PRODUCTS, 'caution');
    zen_redirect(zen_href_link(FILENAME_CATEGORIES));
  }

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $products_filter = (isset($_GET['products_filter']) ? $_GET['products_filter'] : $products_filter);

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $current_category_id = (isset($_GET['current_category_id']) ? $_GET['current_category_id'] : $current_category_id);

  if ($action == 'new_cat') {
    $current_category_id = (isset($_GET['current_category_id']) ? $_GET['current_category_id'] : $current_category_id);
    $new_product_query = $db->Execute("select ptc.* from " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc  left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on ptc.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' where ptc.categories_id='" . $current_category_id . "' order by pd.products_name");
    $products_filter = $new_product_query->fields['products_id'];
    zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
  }

// set categories and products if not set
  if ($products_filter == '' and $current_category_id != '') {
    $new_product_query = $db->Execute("select ptc.* from " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc  left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on ptc.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' where ptc.categories_id='" . $current_category_id . "' order by pd.products_name");
    $products_filter = $new_product_query->fields['products_id'];
    if ($products_filter != '') {
      zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
    }
  } else {
    if ($products_filter == '' and $current_category_id == '') {
      $reset_categories_id = zen_get_category_tree('', '', '0', '', '', true);
      $current_category_id = $reset_categories_id[0]['id'];
      $new_product_query = $db->Execute("select ptc.* from " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc  left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on ptc.products_id = pd.products_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' where ptc.categories_id='" . $current_category_id . "' order by pd.products_name");
      $products_filter = $new_product_query->fields['products_id'];
      $_GET['products_filter'] = $products_filter;
    }
  }

  require(DIR_WS_MODULES . FILENAME_PREV_NEXT);

  if ($action == 'delete_special') {
    $delete_special = $db->Execute("delete from " . TABLE_SPECIALS . " where products_id='" . $products_filter . "'");

    // reset products_price_sorter for searches etc.
    zen_update_products_price_sorter($products_filter);

    zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
  }

  if ($action == 'delete_featured') {
    $delete_featured = $db->Execute("delete from " . TABLE_FEATURED . " where products_id='" . $products_filter . "'");

    zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
  }

  if ($action == 'add_discount_qty_id') {
    $add_id = $db->Execute("select discount_id from " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . " where products_id='" . $products_filter . "' order by discount_id desc limit 1");
    $add_cnt = 1;
    $add_id = $add_id->fields['discount_id'];
    while ($add_cnt <= DISCOUNT_QTY_ADD) {
      $db->Execute("insert into " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . "
                    (discount_id, products_id)
                    values ('" . ($add_id + $add_cnt) . "', '" . $products_filter . "')");
      $add_cnt++;
    }
    zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit' . '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
  }

  if (zen_not_null($action)) {
    switch ($action) {
      case ('update'):

        if ($_POST['master_category']) {
          $master_categories_id = $_POST['master_category'];
        } else {
          $master_categories_id = $_POST['master_categories_id'];
        }

        $products_date_available = ((zen_db_prepare_input($_POST['product_start']) == '') ? 'null' : "'".zen_date_raw($_POST['product_start'])."'");

        $specials_date_available = ((zen_db_prepare_input($_POST['special_start']) == '') ? '0001-01-01' : zen_date_raw($_POST['special_start']));
        $specials_expires_date = ((zen_db_prepare_input($_POST['special_end']) == '') ? '0001-01-01' : zen_date_raw($_POST['special_end']));

        $featured_date_available = ((zen_db_prepare_input($_POST['featured_start']) == '') ? '0001-01-01' : zen_date_raw($_POST['featured_start']));
        $featured_expires_date = ((zen_db_prepare_input($_POST['featured_end']) == '') ? '0001-01-01' : zen_date_raw($_POST['featured_end']));

    $tmp_value = zen_db_prepare_input($_POST['products_price_sorter']);
    $products_price_sorter = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;


        $db->Execute("update " . TABLE_PRODUCTS . " set
            products_price='" . zen_db_prepare_input($_POST['products_price']) . "',
            products_tax_class_id='" . zen_db_prepare_input($_POST['products_tax_class_id']) . "',
            products_date_available=" . $products_date_available . ",
            products_last_modified=now(),
            products_status='" . zen_db_prepare_input($_POST['products_status']) . "',
            products_quantity_order_min='" . zen_db_prepare_input($_POST['products_quantity_order_min']) . "',
            products_quantity_order_units='" . zen_db_prepare_input($_POST['products_quantity_order_units']) . "',
            products_quantity_order_max='" . zen_db_prepare_input($_POST['products_quantity_order_max']) . "',
            product_is_free='" . zen_db_prepare_input($_POST['product_is_free']) . "',
            product_is_call='" . zen_db_prepare_input($_POST['product_is_call']) . "',
            products_quantity_mixed='" . zen_db_prepare_input($_POST['products_quantity_mixed']) . "',
            products_priced_by_attribute='" . zen_db_prepare_input($_POST['products_priced_by_attribute']) . "',
            products_discount_type='" . zen_db_prepare_input($_POST['products_discount_type']) . "',
            products_discount_type_from='" . zen_db_prepare_input($_POST['products_discount_type_from']) . "',
            products_price_sorter='" . $products_price_sorter . "',
            master_categories_id='" . zen_db_prepare_input($master_categories_id) . "',
            products_mixed_discount_quantity='" . zen_db_prepare_input($_POST['products_mixed_discount_quantity']) . "'
            where products_id='" . $products_filter . "'");

        if ($_POST['specials_id'] != '') {

          $specials_id = zen_db_prepare_input($_POST['specials_id']);

          if ($_POST['products_priced_by_attribute'] == '1') {
            $products_price = zen_get_products_base_price($products_filter);
          } else {
            $products_price = zen_db_prepare_input($_POST['products_price']);
          }

          $specials_price = zen_db_prepare_input($_POST['specials_price']);
          if (substr($specials_price, -1) == '%') $specials_price = ($products_price - (($specials_price / 100) * $products_price));
          $db->Execute("update " . TABLE_SPECIALS . " set
              specials_new_products_price='" . zen_db_input($specials_price) . "',
              specials_date_available='" . zen_db_input($specials_date_available) . "',
              specials_last_modified=now(),
              expires_date='" . zen_db_input($specials_expires_date) . "',
              status='" . zen_db_input($_POST['special_status']) . "'
              where products_id='" . $products_filter . "'");
        }

        if ($_POST['featured_id'] != '') {

        $db->Execute("update " . TABLE_FEATURED . " set
            featured_date_available='" . zen_db_input($featured_date_available) . "',
            expires_date='" . zen_db_input($featured_expires_date) . "',
            featured_last_modified=now(),
            status='" . zen_db_input($_POST['featured_status']) . "'
            where products_id='" . $products_filter . "'");
        }

        $db->Execute("delete from " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . " where products_id='" . $products_filter . "'");
        $i=1;
        $new_id = 0;
        $discount_cnt = 0;
        for ($i=1, $n=sizeof($_POST['discount_qty']); $i<=$n; $i++) {
          if ($_POST['discount_qty'][$i] > 0) {
            $new_id++;
            $db->Execute("insert into " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . "
                          (discount_id, products_id, discount_qty, discount_price)
                          values ('" . $new_id . "', '" . $products_filter . "', '" . $_POST['discount_qty'][$i] . "', '" . $_POST['discount_price'][$i] . "')");
            $discount_cnt++;
          } else {
            loop;
          }
        }

        if ($discount_cnt <= 0) {
          $db->Execute("update " . TABLE_PRODUCTS . " set products_discount_type='0' where products_id='" . $products_filter . "'");
        }

        // reset products_price_sorter for searches etc.
        zen_update_products_price_sorter($products_filter);
        $messageStack->add_session(PRODUCT_UPDATE_SUCCESS, 'success');

        zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id));
        break;
      case 'set_products_filter':
        $_GET['products_filter'] = $_POST['products_filter'];

        zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['products_filter'] . '&current_category_id=' . $_POST['current_category_id']));
        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'page=' . $_GET['page']));
        }
        $featured_id = zen_db_prepare_input($_GET['fID']);

        $db->Execute("delete from " . TABLE_FEATURED . "
                      where featured_id = '" . (int)$featured_id . "'");

        zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'page=' . $_GET['page']));
        break;
      case 'edit':
      // set edit message
      $messageStack->add_session(PRODUCT_WARNING_UPDATE, 'caution');
      zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit_update' . '&products_filter=' . $_GET['products_filter'] . '&current_category_id=' . $current_category_id));
      break;
      case 'cancel':
      // set edit message
      $messageStack->add_session(PRODUCT_WARNING_UPDATE_CANCEL, 'warning');
      zen_redirect(zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['products_filter'] . '&current_category_id=' . $current_category_id));
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
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>

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
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" align="right">
<?php
    echo zen_draw_form('search', FILENAME_CATEGORIES, '', 'get');
// show reset search
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      echo '<a href="' . zen_href_link(FILENAME_CATEGORIES) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
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
<?php
///////////////////////////////////////////////////////////
// BOF: NEW CODE TO KEEP
?>

<?php
  if ($action != 'edit_update') {
    require(DIR_WS_MODULES . FILENAME_PREV_NEXT_DISPLAY);
?>

      <tr><form name="set_products_filter_id" <?php echo 'action="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=set_products_filter') . '"'; ?> method="post"><?php echo zen_draw_hidden_field('products_filter', $_GET['products_filter']); ?><?php echo zen_draw_hidden_field('current_category_id', $_GET['current_category_id']); ?>
        <td colspan="2"><table border="0" cellspacing="0" cellpadding="2">

<?php
if ($_GET['products_filter'] != '') {
?>
          <tr>
            <td class="main" width="200" align="left" valign="top">&nbsp;</td>
            <td colspan="2" class="main"><?php echo TEXT_PRODUCT_TO_VIEW; ?></td>
          </tr>
          <tr>
            <td class="main" width="200" align="center" valign="top">

<?php
// FIX HERE
  $display_priced_by_attributes = zen_get_products_price_is_priced_by_attributes($_GET['products_filter']);
  echo ($display_priced_by_attributes ? '<span class="alert">' . TEXT_PRICED_BY_ATTRIBUTES . '</span>' . '<br />' : '');
  echo zen_get_products_display_price($_GET['products_filter']) . '<br /><br />';
  echo zen_get_products_quantity_min_units_display($_GET['products_filter'], $include_break = true);
  $not_for_cart = $db->Execute("select p.products_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCT_TYPES . " pt on p.products_type= pt.type_id where pt.allow_add_to_cart = 'N'");
  while (!$not_for_cart->EOF) {
    $not_for_cart_array[] = $not_for_cart->fields['products_id'];
    $not_for_cart->MoveNext();
   }
?>
            </td>
            <td class="attributes-even" align="center"><?php echo zen_draw_products_pull_down('products_filter', 'size="5"', $not_for_cart->fields, true, $_GET['products_filter'], true, true); ?></td>
            <td class="main" align="center" valign="top">
              <?php
                echo zen_image_submit('button_display.gif', IMAGE_DISPLAY);
              ?>
            </td>
          </tr>
<?php
} else {
  $not_for_cart = '';
} // $_GET['products_filter'] != ''
?>
        <tr>
          <td colspan="3">
            <table>

<?php
// show when product is linked
if ($products_filter != '' && zen_get_product_is_linked($products_filter) == 'true') {
?>
              <tr>
                <td class="main" align="center" valign="bottom">
                  <?php echo zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED) . '&nbsp;&nbsp;' . TEXT_LEGEND_LINKED . ' ' . zen_get_product_is_linked($products_filter, 'true'); ?>
                </td>
              </tr>
<?php } ?>
              <tr>
                <td class="main" align="center" valign="bottom">
<?php
  if ($_GET['products_filter'] != '') {
    echo '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'cPath=' . $current_category_id . '&pID=' . $products_filter . '&product_type=' . zen_get_products_type($products_filter)) . '">' . zen_image_button('button_details.gif', IMAGE_DETAILS) . '<br />' . TEXT_PRODUCT_DETAILS . '</a>' . '&nbsp;&nbsp;&nbsp;';
    echo '</td><td class="main" align="center" valign="bottom">';
    echo '<a href="' . zen_href_link(FILENAME_CATEGORIES, 'action=new_product' . '&cPath=' . $current_category_id . '&pID=' . $products_filter . '&product_type=' . zen_get_products_type($products_filter)) . '">' . zen_image_button('button_edit_product.gif', IMAGE_EDIT_PRODUCT) . '<br />' . TEXT_PRODUCT_EDIT . '</a>';
    echo '</td><td class="main" align="center" valign="bottom">';
  	echo '<a href="' . zen_href_link(FILENAME_ATTRIBUTES_CONTROLLER, '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id, 'NONSSL') . '">' . zen_image_button('button_edit_attribs.gif', IMAGE_EDIT_ATTRIBUTES) . '<br />' . TEXT_ATTRIBUTE_EDIT . '</a>' . '&nbsp;&nbsp;&nbsp;';
  }
?>
                </td>
              </tr>
<?php if ($products_filter != '') { ?>
            <tr>
            <td class="smallText" align="center" colspan="3"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_TO_CATEGORIES, '&products_filter=' . $products_filter) . '">' . IMAGE_PRODUCTS_TO_CATEGORIES . '</a>'; ?></td>
            </tr>
<?php } ?>
            </table>
          </td>
        </tr>

        </table></td>
      </form></tr>
<?php } // $action != 'edit_update' ?>
<?php
// EOF: NEW CODE TO KEEP
///////////////////////////////////////////////////////////
?>
<?php
// start of attributes display
if ($products_filter == '') {
?>
      <tr>
        <td colspan="2" class="pageHeading" align="center" valign="middle" height="200"><?php echo HEADING_TITLE_PRODUCT_SELECT; ?></td>
      </tr>
<?php } ?>

<?php
// only show if allowed in cart
  if ($zc_products->get_allow_add_to_cart($products_filter) == 'Y') {
?>

<?php
// featured information
      $product = $db->Execute("select p.products_id,
                                      f.featured_id, f.expires_date, f.featured_date_available, f.status
                               from " . TABLE_PRODUCTS . " p, " .
                                        TABLE_FEATURED . " f
                               where p.products_id = f.products_id
                               and f.products_id = '" . $_GET['products_filter'] . "'");


      if ($product->RecordCount() > 0) {
        $fInfo = new objectInfo($product->fields);
      }

// specials information
      $product = $db->Execute("select p.products_id,
                                      s.specials_id, s.specials_new_products_price, s.expires_date, s.specials_date_available, s.status
                               from " . TABLE_PRODUCTS . " p, " .
                                        TABLE_SPECIALS . " s
                               where p.products_id = s.products_id
                               and s.products_id = '" . $_GET['products_filter'] . "'");

      if ($product->RecordCount() > 0) {
        $sInfo = new objectInfo($product->fields);
      }

// products information
      $product = $db->Execute("select p.products_id, p.products_model,
                                      p.products_price, p.products_date_available,
                                      p.products_tax_class_id,
                                      p.products_quantity_order_min, products_quantity_order_units, p.products_quantity_order_max,
                                      p.product_is_free, p.product_is_call, p.products_quantity_mixed, p.products_priced_by_attribute, p.products_status,
                                      p.products_discount_type, p.products_discount_type_from, p.products_price_sorter,
                                      pd.products_name,
                                      p.master_categories_id, p.products_mixed_discount_quantity
                               from " . TABLE_PRODUCTS . " p, " .
                                        TABLE_PRODUCTS_DESCRIPTION . " pd
                               where p.products_id = '" . $_GET['products_filter'] . "'
                               and p.products_id = pd.products_id
                               and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'");


      if ($product->RecordCount() > 0) {
        $pInfo = new objectInfo($product->fields);
      }

// set statuses
      if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
        switch ($pInfo->products_status) {
        case '0': $products_in_status = false; $products_out_status = true; break;
        case '1':
        default: $products_in_status = true; $products_out_status = false;
      }
      if (!isset($fInfo->status)) $fInfo->status = '1';
        switch ($fInfo->status) {
        case '0': $featured_in_status = false; $featured_out_status = true; break;
        case '1':
        default: $featured_in_status = true; $featured_out_status = false;
      }
      if (!isset($sInfo->status)) $sInfo->status = '1';
        switch ($sInfo->status) {
        case '0': $special_in_status = false; $special_out_status = true; break;
        case '1':
        default: $special_in_status = true; $special_out_status = false;
      }

// Product is Priced by Attributes
    if (!isset($pInfo->products_priced_by_attribute)) $pInfo->products_priced_by_attribute = '0';
    switch ($pInfo->products_priced_by_attribute) {
      case '0': $is_products_priced_by_attribute = false; $not_products_priced_by_attribute = true; break;
      case '1': $is_products_priced_by_attribute = true; $not_products_priced_by_attribute = false; break;
      default: $is_products_priced_by_attribute = false; $not_products_priced_by_attribute = true;
    }
// Product is Free
    if (!isset($pInfo->product_is_free)) $pInfo->product_is_free = '0';
    switch ($pInfo->product_is_free) {
      case '0': $in_product_is_free = false; $out_product_is_free = true; break;
      case '1': $in_product_is_free = true; $out_product_is_free = false; break;
      default: $in_product_is_free = false; $out_product_is_free = true;
    }
// Product is Call for price
    if (!isset($pInfo->product_is_call)) $pInfo->product_is_call = '0';
    switch ($pInfo->product_is_call) {
      case '0': $in_product_is_call = false; $out_product_is_call = true; break;
      case '1': $in_product_is_call = true; $out_product_is_call = false; break;
      default: $in_product_is_call = false; $out_product_is_call = true;
    }
// Products can be purchased with mixed attributes retail
    if (!isset($pInfo->products_quantity_mixed)) $pInfo->products_quantity_mixed = '0';
    switch ($pInfo->products_quantity_mixed) {
      case '0': $in_products_quantity_mixed = false; $out_products_quantity_mixed = true; break;
      case '1': $in_products_quantity_mixed = true; $out_products_quantity_mixed = false; break;
      default: $in_products_quantity_mixed = true; $out_products_quantity_mixed = false;
    }
// Products can be purchased with mixed attributes for discount
    if (!isset($pInfo->products_mixed_discount_quantity)) $pInfo->products_mixed_discount_quantity = '1';
    switch ($pInfo->products_mixed_discount_quantity) {
      case '0': $in_products_mixed_discount_quantity = false; $out_products_mixed_discount_quantity = true; break;
      case '1': $in_products_mixed_discount_quantity = true; $out_products_mixed_discount_quantity = false; break;
      default: $in_products_mixed_discount_quantity = true; $out_products_mixed_discount_quantity = false;
    }

// Product is product discount type - None, Percentage, Actual Price, $$ off
  $discount_type_array = array(array('id' => '0', 'text' => DISCOUNT_TYPE_DROPDOWN_0),
                                array('id' => '1', 'text' => DISCOUNT_TYPE_DROPDOWN_1),
                                array('id' => '2', 'text' => DISCOUNT_TYPE_DROPDOWN_2),
                                array('id' => '3', 'text' => DISCOUNT_TYPE_DROPDOWN_3));

// Product is product discount type from price or special
  $discount_type_from_array = array(array('id' => '0', 'text' => DISCOUNT_TYPE_FROM_DROPDOWN_0),
                              array('id' => '1', 'text' => DISCOUNT_TYPE_FROM_DROPDOWN_1));

// tax class id
    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class = $db->Execute("select tax_class_id, tax_class_title
                                     from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while (!$tax_class->EOF) {
      $tax_class_array[] = array('id' => $tax_class->fields['tax_class_id'],
                                 'text' => $tax_class->fields['tax_class_title']);
      $tax_class->MoveNext();
    }
?>
<?php if ($pInfo->products_id != '') { ?>
<script language="javascript">
var ProductStartDate = new ctlSpiffyCalendarBox("ProductStartDate", "new_prices", "product_start", "btnDate1","<?php echo (($pInfo->products_date_available <= '0001-01-01') ? '' : zen_date_short($pInfo->products_date_available)); ?>",scBTNMODE_CUSTOMBLUE);
</script>
<?php } ?>

<?php if ($fInfo->products_id != '') { ?>
<script language="javascript">
var FeaturedStartDate = new ctlSpiffyCalendarBox("FeaturedStartDate", "new_prices", "featured_start", "btnDate2","<?php echo (($fInfo->featured_date_available <= '0001-01-01') ? '' : zen_date_short($fInfo->featured_date_available)); ?>",scBTNMODE_CUSTOMBLUE);
var FeaturedEndDate = new ctlSpiffyCalendarBox("FeaturedEndDate", "new_prices", "featured_end", "btnDate3","<?php echo (($fInfo->expires_date <= '0001-01-01') ? '' : zen_date_short($fInfo->expires_date)); ?>",scBTNMODE_CUSTOMBLUE);
</script>
<?php } ?>

<?php if ($sInfo->products_id != '') { ?>
<script language="javascript">
var SpecialStartDate = new ctlSpiffyCalendarBox("SpecialStartDate", "new_prices", "special_start", "btnDate4","<?php echo (($sInfo->specials_date_available <= '0001-01-01') ? '' : zen_date_short($sInfo->specials_date_available)); ?>",scBTNMODE_CUSTOMBLUE);
var SpecialEndDate = new ctlSpiffyCalendarBox("SpecialEndDate", "new_prices", "special_end", "btnDate5","<?php echo (($sInfo->expires_date <= '0001-01-01') ? '' : zen_date_short($sInfo->expires_date)); ?>",scBTNMODE_CUSTOMBLUE);
</script>
<?php } ?>

<?php
// auto fix bad or missing products master_categories_id
  if (zen_get_product_is_linked($products_filter) == 'false' and $pInfo->master_categories_id != zen_get_products_category_id($products_filter)) {
    $sql = "update " . TABLE_PRODUCTS . " set master_categories_id='" . zen_get_products_category_id($products_filter) . "' where products_id='" . $products_filter . "'";
    $db->Execute($sql);
    $pInfo->master_categories_id = zen_get_products_category_id($products_filter);
  }
?>

<?php
  if ($pInfo->products_id != '') {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>
      <tr>
        <td class="pageHeading"><?php echo TEXT_PRODUCT_INFO . ' #' . $pInfo->products_id . '&nbsp;&nbsp;' . $pInfo->products_name; ?>&nbsp;&nbsp;&nbsp;<?php echo TEXT_PRODUCTS_MODEL . ' ' . $pInfo->products_model; ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>
      <form name="new_prices" <?php echo 'action="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, zen_get_all_get_params(array('action', 'info', $_GET['products_filter'])) . 'action=' . 'update', 'NONSSL') . '"'; ?> method="post"><?php echo zen_draw_hidden_field('products_id', $_GET['products_filter']); echo zen_draw_hidden_field('specials_id', $sInfo->specials_id); echo zen_draw_hidden_field('featured_id', $fInfo->featured_id); echo zen_draw_hidden_field('discounts_list', $discounts_qty); ?>
      <tr>
        <td colspan="4"><table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
          <tr>
            <td class="pageHeading" align="center" valign="middle">
              <?php echo ($action == '' ? '<span class="alert">' . TEXT_INFO_PREVIEW_ONLY . '</span>' : ''); ?>
            </td>
          </tr>
          <tr>
            <td class="main" align="center" valign="middle">
            <?php
            if ($action == '') {
              echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit' . '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT_PRODUCT) . '</a>' . '<br />' . TEXT_INFO_EDIT_CAUTION;
            } else {
              echo zen_image_submit('button_update.gif', IMAGE_UPDATE_PRICE_CHANGES) . '&nbsp;&nbsp;' . '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=cancel' . '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>' . '<br />' . TEXT_UPDATE_COMMIT;
            }
            ?>
            </td>
          </tr>
          <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
          </tr>
        </table></td>
      </tr>

      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">

<?php
// show when product is linked
if (zen_get_product_is_linked($products_filter) == 'true') {
?>
          <tr>
            <td class="main" width="200"><?php echo TEXT_MASTER_CATEGORIES_ID; ?></td>
            <td colspan="4" class="main">
              <?php
                // echo zen_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id);
                echo zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED) . '&nbsp;&nbsp;';
                echo zen_draw_pull_down_menu('master_category', zen_get_master_categories_pulldown($products_filter), $pInfo->master_categories_id); ?>
            </td>
          </tr>
          <tr>
            <td colspan="5" class="main"><?php echo TEXT_INFO_MASTER_CATEGORIES_ID; ?></td>
          </tr>
          <tr>
            <td colspan="5" class="main" align="center"><?php echo ($action == '' ? '<span class="alert">' . TEXT_INFO_PREVIEW_ONLY . '</span>' : TEXT_INFO_UPDATE_REMINDER); ?></td>
          </tr>
<?php } // master category linked ?>

<?php
if (zen_get_product_is_linked($products_filter) == 'false' and $pInfo->master_categories_id != zen_get_products_category_id($products_filter)) {
?>
          <tr>
            <td colspan="5" class="main"><span class="alert">
              <?php echo sprintf(TEXT_INFO_MASTER_CATEGORIES_ID_WARNING, $pInfo->master_categories_id, zen_get_products_category_id($products_filter)); ?></span>
              <br /><strong><?php echo sprintf(TEXT_INFO_MASTER_CATEGORIES_ID_UPDATE_TO_CURRENT, $pInfo->master_categories_id, zen_get_products_category_id($products_filter)); ?></strong>
            </td>
         </tr>
<?php } ?>
<?php
echo zen_draw_hidden_field('master_categories_id', $pInfo->master_categories_id);
?>


          <tr>
            <td class="main" width="200"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
            <td colspan="4" class="main"><?php echo zen_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id); ?></td>
          </tr>
          <tr>
            <td class="main" width="200"><?php echo TEXT_PRODUCTS_PRICE_INFO; ?></td>
            <td class="main"><?php echo TEXT_PRICE . '<br />' . zen_draw_input_field('products_price', (isset($pInfo->products_price) ? $pInfo->products_price : '')); ?></td>
            <td class="main"><?php echo TEXT_PRODUCT_AVAILABLE_DATE; ?><br /><script language="javascript">ProductStartDate.writeControl(); ProductStartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
            <td colspan="2" class="main"><?php echo zen_draw_radio_field('products_status', '1', $products_in_status) . '&nbsp;' . TEXT_PRODUCT_AVAILABLE . '<br />' . zen_draw_radio_field('products_status', '0', $products_out_status) . '&nbsp;' . TEXT_PRODUCT_NOT_AVAILABLE; ?></td>
          </tr>

          <tr>
            <td class="main" width="200">&nbsp;</td>
            <td class="main">
              <?php echo TEXT_PRODUCTS_QUANTITY_MIN_RETAIL; ?><br /><?php echo zen_draw_input_field('products_quantity_order_min', ($pInfo->products_quantity_order_min == 0 ? 1 : $pInfo->products_quantity_order_min), 'size="6"'); ?>
            </td>
            <td class="main">
              <?php echo TEXT_PRODUCTS_QUANTITY_UNITS_RETAIL; ?><br /><?php echo zen_draw_input_field('products_quantity_order_units', ($pInfo->products_quantity_order_units == 0 ? 1 : $pInfo->products_quantity_order_units), 'size="6"'); ?>
            </td>
            <td class="main">
              <?php echo TEXT_PRODUCTS_QUANTITY_MAX_RETAIL; ?><br /><?php echo zen_draw_input_field('products_quantity_order_max', $pInfo->products_quantity_order_max, 'size="6"'); ?>
            </td>
            <td class="main">
              <?php echo TEXT_PRODUCTS_MIXED; ?><br /><?php echo zen_draw_radio_field('products_quantity_mixed', '1', $in_products_quantity_mixed==1) . '&nbsp;' . TEXT_YES . '&nbsp;&nbsp;' . zen_draw_radio_field('products_quantity_mixed', '0', $out_products_quantity_mixed) . '&nbsp;' . TEXT_NO; ?>
            </td>
          </tr>
          <tr>
            <td colspan="3" class="main">&nbsp;</td>
            <td colspan="2" class="main">
              <?php echo TEXT_PRODUCTS_QUANTITY_MAX_RETAIL_EDIT; ?>
            </td>
          </tr>
          <tr>
            <td class="main" width="200">&nbsp;</td>
            <td class="main" valign="top"><?php echo TEXT_PRODUCT_IS_FREE; ?><br /><?php echo zen_draw_radio_field('product_is_free', '1', ($in_product_is_free==1)) . '&nbsp;' . TEXT_YES . '&nbsp;&nbsp;' . zen_draw_radio_field('product_is_free', '0', ($in_product_is_free==0)) . '&nbsp;' . TEXT_NO . ' ' . ($pInfo->product_is_free == 1 ? '<span class="errorText">' . TEXT_PRODUCTS_IS_FREE_EDIT . '</span>' : ''); ?></td>
            <td class="main" valign="top"><?php echo TEXT_PRODUCT_IS_CALL; ?><br /><?php echo zen_draw_radio_field('product_is_call', '1', ($in_product_is_call==1)) . '&nbsp;' . TEXT_YES . '&nbsp;&nbsp;' . zen_draw_radio_field('product_is_call', '0', ($in_product_is_call==0)) . '&nbsp;' . TEXT_NO . ' ' . ($pInfo->product_is_call == 1 ? '<span class="errorText">' . TEXT_PRODUCTS_IS_CALL_EDIT . '</span>' : ''); ?></td>
            <td colspan="2" class="main" valign="top"><?php echo TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES; ?><br /><?php echo zen_draw_radio_field('products_priced_by_attribute', '1', $is_products_priced_by_attribute==1) . '&nbsp;' . TEXT_PRODUCT_IS_PRICED_BY_ATTRIBUTE . '&nbsp;&nbsp;' . zen_draw_radio_field('products_priced_by_attribute', '0', $not_products_priced_by_attribute) . '&nbsp;' . TEXT_PRODUCT_NOT_PRICED_BY_ATTRIBUTE . ' ' . ($pInfo->products_priced_by_attribute == 1 ? '<span class="errorText">' . TEXT_PRODUCTS_PRICED_BY_ATTRIBUTES_EDIT . '</span>' : ''); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
// show nothing
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>
      <tr>
        <td class="pageHeading"><?php echo TEXT_PRODUCT_INFO_NONE; ?></td>
      </tr>
<?php  } ?>


<?php
  if ($pInfo->products_id != '') {
?>
<?php
  if ($sInfo->products_id != '') {
?>
      <tr>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="200"><?php echo TEXT_SPECIALS_PRODUCT_INFO; ?></td>
            <td class="main"><?php echo TEXT_SPECIALS_SPECIAL_PRICE . '<br />' . zen_draw_input_field('specials_price', (isset($sInfo->specials_new_products_price) ? $sInfo->specials_new_products_price : '')); ?></td>
            <td class="main"><?php echo TEXT_SPECIALS_AVAILABLE_DATE; ?><br /><script language="javascript">SpecialStartDate.writeControl(); SpecialStartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
            <td class="main"><?php echo TEXT_SPECIALS_EXPIRES_DATE; ?><br /><script language="javascript">SpecialEndDate.writeControl(); SpecialEndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
            <td class="main"><?php echo TEXT_SPECIALS_PRODUCTS_STATUS; ?><br />
              <?php echo zen_draw_radio_field('special_status', '1', $special_in_status) . '&nbsp;' . TEXT_SPECIALS_PRODUCT_AVAILABLE . '&nbsp;' . zen_draw_radio_field('special_status', '0', $special_out_status) . '&nbsp;' . TEXT_SPECIALS_PRODUCT_NOT_AVAILABLE; ?>
            </td>
            <td class="main" align="center" width="100"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['products_filter'] . '&current_category_id=' . $current_category_id . '&action=delete_special') . '">' .  zen_image_button('button_remove.gif', IMAGE_REMOVE_SPECIAL) . '</a>'; ?></td>
          </tr>
<?php
  if ($sInfo->status == 0) {
?>
          <tr>
            <td colspan="6"><?php echo '<span class="errorText">' . TEXT_SPECIAL_DISABLED . '</span>'; ?></td>
          </tr>
<?php } ?>
          <tr>
            <td colspan="6" class="main"><br><?php echo TEXT_SPECIALS_PRICE_TIP; ?></td>
          </tr>
        </table></td>
      </tr>
<?php  } else {
?>
      <tr>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="200"><?php echo TEXT_SPECIALS_PRODUCT_INFO; ?></td>
<?php
// Specials cannot be added to Gift Vouchers
      if(substr($pInfo->products_model, 0, 4) != 'GIFT') {
?>
            <td class="main" align="center"><?php echo '<a href="' . zen_href_link(FILENAME_SPECIALS, 'add_products_id=' . $_GET['products_filter'] . '&action=new' . '&sID=' . $sInfo->specials_id . '&go_back=ON') . '">' .  zen_image_button('button_install.gif', IMAGE_INSTALL_SPECIAL) . '</a>'; ?></td>
<?php  } else { ?>
            <td class="main" align="center"><?php echo TEXT_SPECIALS_NO_GIFTS; ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
<?php  } ?>

<?php
  if ($fInfo->products_id != '') {
?>
      <tr>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="200"><?php echo TEXT_FEATURED_PRODUCT_INFO; ?></td>
            <td class="main"><?php echo TEXT_FEATURED_AVAILABLE_DATE ; ?><br /><script language="javascript">FeaturedStartDate.writeControl(); FeaturedStartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
            <td class="main"><?php echo TEXT_FEATURED_EXPIRES_DATE; ?><br /><script language="javascript">FeaturedEndDate.writeControl(); FeaturedEndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></td>
            <td class="main"><?php echo TEXT_FEATURED_PRODUCTS_STATUS; ?><br />
              <?php echo zen_draw_radio_field('featured_status', '1', $featured_in_status) . '&nbsp;' . TEXT_FEATURED_PRODUCT_AVAILABLE . '&nbsp;' . zen_draw_radio_field('featured_status', '0', $featured_out_status) . '&nbsp;' . TEXT_FEATURED_PRODUCT_NOT_AVAILABLE; ?>
            </td>
            <td class="main" align="center" width="100"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $_GET['products_filter'] . '&current_category_id=' . $current_category_id . '&action=delete_featured') . '">' .  zen_image_button('button_remove.gif', IMAGE_REMOVE_FEATURED) . '</a>'; ?></td>
          </tr>
<?php
  if ($fInfo->status == 0) {
?>
          <tr>
            <td colspan="5"><?php echo '<span class="errorText">' . TEXT_FEATURED_DISABLED . '</span>'; ?></td>
          </tr>
<?php } ?>
        </table></td>
      </tr>
<?php  } else { ?>
      <tr>
        <td><br><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" width="200"><?php echo TEXT_FEATURED_PRODUCT_INFO; ?></td>
            <td class="main" align="center"><?php echo '<a href="' . zen_href_link(FILENAME_FEATURED, 'add_products_id=' . $_GET['products_filter'] . '&go_back=ON' . '&action=new') . '">' . zen_image_button('button_install.gif', IMAGE_INSTALL_FEATURED) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
<?php  } ?>


      <tr>
        <td><br><table border="4" cellspacing="0" cellpadding="2">
<?php
// fix here
// discount
    $discounts_qty = $db->Execute("select * from " . TABLE_PRODUCTS_DISCOUNT_QUANTITY . " where products_id='" . $products_filter . "' order by discount_qty");
    $discount_cnt = $discounts_qty->RecordCount();
    $make = 1;
    $i;
    while (!$discounts_qty->EOF) {
      $i++;
      $discount_name[] = array('id' => $i,
                                 'discount_qty' => $discounts_qty->fields['discount_qty'],
                                 'discount_price' => $discounts_qty->fields['discount_price']);
      $discounts_qty->MoveNext();
    }
?>

<?php
  if ($discounts_qty->RecordCount() > 0) {
?>

          <tr>
            <td colspan="5" class="main" valign="top"><?php echo TEXT_PRODUCTS_MIXED_DISCOUNT_QUANTITY; ?>&nbsp;&nbsp;<?php echo zen_draw_radio_field('products_mixed_discount_quantity', '1', $in_products_mixed_discount_quantity==1) . '&nbsp;' . TEXT_YES . '&nbsp;&nbsp;' . zen_draw_radio_field('products_mixed_discount_quantity', '0', $out_products_mixed_discount_quantity) . '&nbsp;' . TEXT_NO; ?></td>
          </tr>
          <tr>
            <td colspan="5" class="main" align="center">
              <?php
                if ($action != '') {
                  echo TEXT_ADD_ADDITIONAL_DISCOUNT . '<br />';
                  echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&current_category_id=' . $current_category_id . '&action=add_discount_qty_id') . '">' .  zen_image_button('button_blank_discounts.gif', IMAGE_ADD_BLANK_DISCOUNTS) . '</a>' . '<br />';
                  echo TEXT_BLANKS_INFO;
                } else {
                  echo ($action == '' ? '<span class="alert">' . TEXT_INFO_PREVIEW_ONLY . '</span>' : '');
                }
              ?>
            </td>
          </tr>
          <tr>
            <td colspan="5"><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
          </tr>
          <tr>
            <td class="main">
              <?php echo TEXT_DISCOUNT_TYPE_INFO; ?>
            </td>
            <td colspan="2" class="main">
              <?php echo TEXT_DISCOUNT_TYPE . ' ' . zen_draw_pull_down_menu('products_discount_type', $discount_type_array, $pInfo->products_discount_type); ?>
            </td>
            <td colspan="2" class="main">
              <?php echo TEXT_DISCOUNT_TYPE_FROM . ' ' . zen_draw_pull_down_menu('products_discount_type_from', $discount_type_from_array, $pInfo->products_discount_type_from); ?>
            </td>
          </tr>
          <tr>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_QTY_TITLE; ?></td>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_QTY; ?></td>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_PRICE; ?></td>
<?php
  if (DISPLAY_PRICE_WITH_TAX_ADMIN == 'true') {
?>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_PRICE_EACH_TAX; ?></td>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED_TAX; ?></td>
<?php } else { ?>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_PRICE_EACH; ?></td>
            <td class="main" align="center"><?php echo TEXT_PRODUCTS_DISCOUNT_PRICE_EXTENDED; ?></td>
<?php } ?>
          </tr>
<?php
/*
  $display_priced_by_attributes = zen_get_products_price_is_priced_by_attributes($_GET['products_filter']);
  $display_price = zen_get_products_base_price($_GET['products_filter']);
  $display_specials_price = zen_get_products_special_price($_GET['products_filter'], true);
  $display_sale_price = zen_get_products_special_price($_GET['products_filter'], false);
  $display_free_price = zen_get_products_price_is_free($_GET['products_filter']);
  $display_call_price = zen_get_products_price_is_call($_GET['products_filter']);
*/
    for ($i=0, $n=sizeof($discount_name); $i<$n; $i++) {
      switch ($pInfo->products_discount_type) {
        // none
        case '0':
          $discounted_price = 0;
          break;
        // percentage discount
        case '1':
          $display_price = zen_get_products_base_price($_GET['products_filter']);
          if ($pInfo->products_discount_type_from == '0') {
            $discounted_price = $display_price - ($display_price * ($discount_name[$i]['discount_price']/100));
          } else {
            $display_specials_price = zen_get_products_special_price($_GET['products_filter'], true);
            if (!$display_specials_price) {
              $discounted_price = $display_price - ($display_price * ($discount_name[$i]['discount_price']/100));
            } else {
              $discounted_price = $display_specials_price - ($display_specials_price * ($discount_name[$i]['discount_price']/100));
            }
          }

          break;
        // actual price
        case '2':
          if ($pInfo->products_discount_type_from == '0') {
            $discounted_price = $discount_name[$i]['discount_price'];
          } else {
            $discounted_price = $discount_name[$i]['discount_price'];
          }
          break;
        // amount offprice
        case '3':
          $display_price = zen_get_products_base_price($_GET['products_filter']);
          if ($pInfo->products_discount_type_from == '0') {
            $discounted_price = $display_price - $discount_name[$i]['discount_price'];
          } else {
            if (!$display_specials_price) {
              $discounted_price = $display_price - $discount_name[$i]['discount_price'];
            } else {
              $discounted_price = $display_specials_price - $discount_name[$i]['discount_price'];
            }
          }
          break;
      }
?>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_DISCOUNT . ' ' . $discount_name[$i]['id']; ?></td>
            <td class="main"><?php echo zen_draw_input_field('discount_qty[' . $discount_name[$i]['id'] . ']', $discount_name[$i]['discount_qty']); ?></td>
            <td class="main"><?php echo zen_draw_input_field('discount_price[' . $discount_name[$i]['id'] . ']', $discount_name[$i]['discount_price']); ?></td>
<?php
  if (DISPLAY_PRICE_WITH_TAX == 'true') {
?>
            <td class="main" align="right"><?php echo $currencies->display_price($discounted_price, '', 1) . ' ' . $currencies->display_price($discounted_price, zen_get_tax_rate(1), 1); ?></td>
            <td class="main" align="right"><?php echo ' x ' . number_format($discount_name[$i]['discount_qty']) . ' = ' . $currencies->display_price($discounted_price, '', $discount_name[$i]['discount_qty']) . ' ' . $currencies->display_price($discounted_price, zen_get_tax_rate(1), $discount_name[$i]['discount_qty']); ?></td>
<?php } else { ?>
            <td class="main" align="right"><?php echo $currencies->display_price($discounted_price, '', 1); ?></td>
            <td class="main" align="right"><?php echo ' x ' . number_format($discount_name[$i]['discount_qty']) . ' = ' . $currencies->display_price($discounted_price, '', $discount_name[$i]['discount_qty']); ?></td>
<?php } ?>
          </tr>
<?php
    }
?>
<?php
  } else {
?>
          <tr>
          <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
          </tr>
          <tr>
            <td class="main" align="center" width="500">
              <?php
                if ($action != '') {
                  echo TEXT_ADD_ADDITIONAL_DISCOUNT . '<br />';
                  echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'products_filter=' . $products_filter . '&action=add_discount_qty_id') . '">' .  zen_image_button('button_blank_discounts.gif', IMAGE_ADD_BLANK_DISCOUNTS) . '</a>' . '<br />';
                  echo TEXT_BLANKS_INFO;
                } else {
                  echo ($action == '' ? '<span class="alert">' . TEXT_INFO_PREVIEW_ONLY . '</span>' : '') . '<br />';
                  echo TEXT_INFO_NO_DISCOUNTS;
                }
              ?>
            </td>
          </tr>
<?php
  } // $discounts_qty->RecordCount() > 0
?>

        </table></td>
      </tr>

      <tr>
        <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2" align="center">
          <?php if ($action == '') { ?>
          <tr>
            <td class="pageHeading" align="center" valign="middle">
              <?php echo ($action == '' ? '<span class="alert">' . TEXT_INFO_PREVIEW_ONLY . '</span>' : ''); ?>
            </td>
          </tr>
          <?php } ?>
          <tr>
            <td class="main" align="center" valign="middle" width="100%">
            <?php
            if ($action == '') {
              echo '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit' . '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT_PRODUCT) . '</a>' . '<br />' . TEXT_INFO_EDIT_CAUTION;
            } else {
              echo zen_image_submit('button_update.gif', IMAGE_UPDATE_PRICE_CHANGES) . '&nbsp;&nbsp;' . '<a href="' . zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=cancel' . '&products_filter=' . $products_filter . '&current_category_id=' . $current_category_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>' . '<br />' . TEXT_UPDATE_COMMIT;
            }
            ?>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
      </tr>
        </table></td>
      </tr></form>
<?php } // no product selected ?>
<?php } // allow_add_to_cart == 'Y' ?>

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
