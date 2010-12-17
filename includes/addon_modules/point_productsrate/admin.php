<?php
/**
 * Products Point Rate
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: products_pointrate.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  require(DIR_WS_MODULES . 'prod_cat_header_code.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (!isset($_SESSION['categories_products_sort_order'])) {
    $_SESSION['categories_products_sort_order'] = CATEGORIES_PRODUCTS_SORT_ORDER;
  }

  if (!isset($_GET['reset_categories_products_sort_order'])) {
    $reset_categories_products_sort_order = $_SESSION['categories_products_sort_order'];
  }

  if (zen_not_null($action)) {
    switch ($action) {
      case 'update_rate':
        $products_id = zen_db_prepare_input($_POST['products_id']);
        $rate = zen_db_prepare_input($_POST['rate']);

        for ($i = 0, $n = count($products_id); $i < $n; $i++ ) {
          $GLOBALS['point_productsrate']->deletePointRate($products_id[$i]);
          if ($rate[$i] != '') {
            $GLOBALS['point_productsrate']->insertPointRate($products_id[$i], $rate[$i]);
          }
        }
        $messageStack->add_session(SUCCESS_PRODUCTS_POINTRATE_UPDATED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('module', 'action')) . 'module=point_productsrate', 'NONSSL'));
        break;
    }
  }

  // check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
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
  if (typeof _editor_url == "string") HTMLArea.replaceAll();
}
// -->
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
<?php if ($action == '') { ?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="smallText" align="center" width="100" valign="top"><?php echo TEXT_LEGEND; ?></td>
            <td class="smallText" align="center" width="100" valign="top"><?php echo TEXT_LEGEND_STATUS_OFF . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></td>
            <td class="smallText" align="center" width="100" valign="top"><?php echo TEXT_LEGEND_STATUS_ON . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></td>
            <td class="smallText" align="center" width="100" valign="top"><?php echo TEXT_LEGEND_LINKED . '<br />' . zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED); ?></td>
          </tr>
        </table></td>
      </tr>
<?php } ?>
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top">
<?php
  require(DIR_FS_CATALOG . $GLOBALS['point_productsrate']->dir . 'modules/category_products_pointrate_listing.php');

  $heading = array();
  $contents = array();
  // Make an array of product types
  $sql = "select type_id, type_name from " . TABLE_PRODUCT_TYPES;
  $product_types = $db->Execute($sql);
  while (!$product_types->EOF) {
    $type_array[] = array('id' => $product_types->fields['type_id'], text => $product_types->fields['type_name']);
    $product_types->MoveNext();
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>

          </tr>
          <tr>
            <td class="alert" colspan="3" width="100%" align="center">
<?php
  // warning if products are in top level categories
  $check_products_top_categories = $db->Execute("select count(*) as products_errors from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = 0");
  if ($check_products_top_categories->fields['products_errors'] > 0) {
    echo WARNING_PRODUCTS_IN_TOP_INFO . $check_products_top_categories->fields['products_errors'] . '<br />';
  }
?>
            </td>
          </tr>
          <tr>
<?php
// Split Page
if ($products_query_numrows > 0) {
  if (empty($pInfo->products_id)) {
    $pInfo->products_id= $pID;
  }
?>
            <td class="smallText" align="center"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_RESULTS_CATEGORIES, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS) . '<br>' . $products_split->display_links($products_query_numrows, MAX_DISPLAY_RESULTS_CATEGORIES, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'info', 'x', 'y', 'pID')) ); ?></td>

<?php
}
// Split Page
?>
          </tr>
        </table></td>
      </tr>
    </table>
    </td>
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

