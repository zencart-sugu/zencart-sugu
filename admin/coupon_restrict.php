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
//  $Id: coupon_restrict.php 3666 2006-05-28 21:21:37Z wilt $
//
  define('MAX_DISPLAY_RESTRICT_ENTRIES', 5);
  require('includes/application_top.php');
  $restrict_array = array();
  $restrict_array[] = array('id'=>'Deny', text=>'Deny');
  $restrict_array[] = array('id'=>'Allow', text=>'Allow');
  if ($_GET['action']=='switch_status') {
    $status = $db->Execute("select coupon_restrict
                            from " . TABLE_COUPON_RESTRICT . "
                            where restrict_id = '" . $_GET['info'] . "'");

    $new_status = 'N';
    if ($status->fields['coupon_restrict'] == 'N') $new_status = 'Y';
    $db->Execute("update " . TABLE_COUPON_RESTRICT . "
                  set coupon_restrict = '" . $new_status . "'
                  where restrict_id = '" . $_GET['info'] . "'");
  }
  if ($_GET['action']=='add_category' && isset($_POST['cPath'])) {
  	if ($_POST['cPath'] == 0) $_POST['cPath'] = -1;
    $test_query=$db->Execute("select * from " . TABLE_COUPON_RESTRICT . "
                              where coupon_id = '" . $_GET['cid'] . "'
                              and category_id = '" . $_POST['cPath'] . "'");

    if ($test_query->RecordCount() < 1) {
      $status = 'N';
      if ($_POST['restrict_status']=='Deny') $status = 'Y';
      $db->Execute("insert into " . TABLE_COUPON_RESTRICT . "
                  (coupon_id, category_id, coupon_restrict)
                  values ('" . $_GET['cid'] . "', '" . $_POST['cPath'] . "', '" . $status . "')");
    }
  }
  if ($_GET['action']=='add_product' && $_POST['products']) {
    $test_query=$db->Execute("select * from " . TABLE_COUPON_RESTRICT . " where coupon_id = '" . $_GET['cid'] . "' and product_id = '" . $_POST['products'] . "'");
    if ($test_query->RecordCount() < 1) {
      $status = 'N';
      if ($_POST['restrict_status']=='Deny') $status = 'Y';
      $db->Execute("insert into " . TABLE_COUPON_RESTRICT . "
                  (coupon_id, product_id, coupon_restrict)
                  values ('" . $_GET['cid'] . "', '" . $_POST['products'] . "', '" . $status . "')");
    }
  }
  if ($_GET['action']=='remove' && $_GET['info']) {
    $db->Execute("delete from " . TABLE_COUPON_RESTRICT . " where restrict_id = '" . $_GET['info'] . "'");
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
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
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
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo HEADING_TITLE_CATEGORY; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo HEADER_COUPON_ID; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_COUPON_NAME; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_CATEGORY_ID; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_CATEGORY_NAME; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_ALLOW; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_DENY; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_REMOVE; ?></td>
                  </tr>
<?php
    $cr_query_raw = "select * from " . TABLE_COUPON_RESTRICT . " where coupon_id = '" . $_GET['cid'] . "' and category_id != '0'";
    $cr_split = new splitPageResults($_GET['cpage'], MAX_DISPLAY_RESTRICT_ENTRIES, $cr_query_raw, $cr_query_numrows);
    $cr_list = $db->Execute($cr_query_raw);
    while (!$cr_list->EOF) {
      $rows++;
      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
      if (((!$_GET['cid']) || (@$_GET['cid'] == $cr_list->fields['restrict_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($cr_list->fields);
      }
        echo '          <tr class="dataTableRow">' . "\n";
     if ($cr_list->fields['category_id'] != -1) {
     $coupon = $db->Execute("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . "
                             where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
     $category_name = zen_get_category_name($cr_list->fields['category_id'], $_SESSION['languages_id']);
     } else {
     	$category_name = TEXT_ALL_CATEGORIES;
     }
?>
                <td class="dataTableContent"><?php echo $_GET['cid']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $coupon->fields['coupon_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $cr_list->fields['category_id']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $category_name; ?></td>
<?php
		if ($cr_list->fields['coupon_restrict']=='N') {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $cr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ALLOW) . '</a></td>';
		} else {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $cr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_DENY) . '</a></td>';
		}
		if ($cr_list->fields['coupon_restrict']=='Y') {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $cr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ALLOW) . '</a></td>';
		} else {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $cr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_DENY) . '</a></td>';
		}
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=remove&info=' . $cr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icons/delete.gif', IMAGE_REMOVE) . '</a></td>';
?>
              </tr>
<?php
    $cr_list->MoveNext();
    }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $cr_split->display_count($cr_query_numrows, MAX_DISPLAY_RESTRICT_ENTRIES, $_GET['cpage'], TEXT_DISPLAY_NUMBER_OF_CATEGORIES); ?></td>
                    <td class="smallText" align="right"><?php echo $cr_split->display_links($cr_query_numrows, MAX_DISPLAY_RESTRICT_ENTRIES, MAX_DISPLAY_PAGE_LINKS, $_GET['cpage'],zen_get_all_get_params(array('cpage','action', 'x', 'y')),'cpage'); ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr><form name="restrict_category" method="post" action="<?php echo zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=add_category&info=' . $cInfo->restrict_id, 'NONSSL'); ?>">
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo HEADER_CATEGORY_NAME; ?></td>
                    <td class="smallText" align="left"></td>
                    <td class="smallText" align="left"><?php echo zen_draw_pull_down_menu('cPath', zen_get_category_tree(), $current_category_id); ?></td>
                    <td class="smallText" align="left"><?php echo zen_draw_pull_down_menu('restrict_status', $restrict_array, $current_category_id); ?></td>
                    <td class="smallText" align="left"><input type="submit" name="add" value="Add"></td>
                    <td class="smallText" align="left">&nbsp;</td>
                    <td class="smallText" align="left">&nbsp;</td>
                  </tr>
                </table></td>
              </tr></form>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo HEADING_TITLE_PRODUCT; ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo HEADER_COUPON_ID; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_COUPON_NAME; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_PRODUCT_ID; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_PRODUCT_NAME; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_ALLOW; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_DENY; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo HEADER_RESTRICT_REMOVE; ?></td>
                  </tr>
<?php
    $pr_query_raw = "select * from " . TABLE_COUPON_RESTRICT . " where coupon_id = '" . $_GET['cid'] . "' and product_id != '0'";
    $pr_split = new splitPageResults($_GET['ppage'], MAX_DISPLAY_RESTRICT_ENTRIES, $pr_query_raw, $pr_query_numrows);
    $pr_list = $db->Execute($pr_query_raw);
    while (!$pr_list->EOF) {
      $rows++;
      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
      if (((!$_GET['cid']) || (@$_GET['cid'] == $cr_list->fields['restrict_id'])) && (!$pInfo)) {
        $pInfo = new objectInfo($pr_list);
      }
        echo '          <tr class="dataTableRow">' . "\n";

     $coupon = $db->Execute("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cid'] . "' and language_id = '" . $_SESSION['languages_id'] . "'");
     $product_name = zen_get_products_name($pr_list->fields['product_id'], $_SESSION['languages_id']);
?>
                <td class="dataTableContent"><?php echo $_GET['cid']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $coupon->fields['coupon_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $pr_list->fields['product_id']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $product_name; ?></td>
<?php
		if ($pr_list->fields['coupon_restrict']=='N') {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $pr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ALLOW) . '</a></td>';
		} else {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $pr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_DENY) . '</a></td>';
		}
		if ($pr_list->fields['coupon_restrict']=='Y') {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $pr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_DENY) . '</a></td>';
		} else {
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=switch_status&info=' . $pr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ALLOW) . '</a></td>';
		}
		  echo '<td class="dataTableContent" align="center"><a href="' . zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=remove&info=' . $pr_list->fields['restrict_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icons/delete.gif', IMAGE_REMOVE) . '</a></td>';
?>
              </tr>
<?php
    $pr_list->MoveNext();
    }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $pr_split->display_count($pr_query_numrows, MAX_DISPLAY_RESTRICT_ENTRIES, $_GET['ppage'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                    <td class="smallText" align="right"><?php echo $pr_split->display_links($pr_query_numrows, MAX_DISPLAY_RESTRICT_ENTRIES, MAX_DISPLAY_PAGE_LINKS, $_GET['ppage'],zen_get_all_get_params(array('ppage','action', 'x', 'y')),'ppage'); ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr><form name="restrict_category" method="post" action="<?php echo zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=add_category&info=' . $cInfo->restrict_id, 'NONSSL'); ?>">
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
<?php
      if (isset($_POST['cPath_prod'])) $current_category_id = $_POST['cPath_prod'];
      $products = $db->Execute("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . $_SESSION['languages_id'] . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . $_POST['cPath_prod'] . "' order by pd.products_name");
      $products_array = array();
      while (!$products->EOF) {
        $products_array[] = array('id'=>$products->fields['products_id'],
                                   'text'=>$products->fields['products_name']);
        $products->MoveNext();
      }
?>
                    <td class="smallText" valign="top"><?php echo HEADER_CATEGORY_NAME; ?></td>
                    <td class="smallText" align="left"></td><form name="restrict_product" method="post" action="<?php echo zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'info=' . $cInfo->restrict_id, 'NONSSL'); ?>">
                    <?php echo zen_hide_session_id(); ?>
                    <td class="smallText" align="left"><?php echo zen_draw_pull_down_menu('cPath_prod', zen_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"'); ?></td></form>
                    <form name="restrict_category" method="post" action="<?php echo zen_href_link('coupon_restrict.php', zen_get_all_get_params(array('info', 'action', 'x', 'y')) . 'action=add_product&info=' . $cInfo->restrict_id, 'NONSSL'); ?>">
                    <td class="smallText" valign="top"><?php echo HEADER_PRODUCT_NAME; ?></td>
                    <td class="smallText" align="left"><?php echo zen_draw_pull_down_menu('products', $products_array, $current_category_id); ?></td>
                    <td class="smallText" align="left"><?php echo zen_draw_pull_down_menu('restrict_status', $restrict_array); ?></td>
                    <td class="smallText" align="left"><input type="submit" name="add" value="Add"></td>
                    <td class="smallText" align="left">&nbsp;</td>
                    <td class="smallText" align="left">&nbsp;</td>
                  </tr>
                </table></td>
              </tr></form>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . zen_href_link(FILENAME_COUPON_ADMIN, 'page=' . $_GET['page'] . '&cid=' . (!empty($cInfo->coupon_id) ? $cInfo->coupon_id : $_GET['cid']) . (isset($_GET['status']) ? '&status=' . $_GET['status'] : '')) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
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