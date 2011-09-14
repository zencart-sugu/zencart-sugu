<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(dirname(__FILE__) . '/includes/action_xsell.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<style>
  .productmenutitle{
    cursor:pointer;
    margin-bottom: 0px;
    background-color:orange;
    color:#FFFFFF;
    font-weight:bold;
    font-family:ms sans serif;
    width:100%;
    padding:3px;
    font-size:12px;
    text-align:center;
  /*border:1px solid #000000;*/
  }
  .productmenutitle1{
    cursor:pointer;
    margin-bottom: 0px;
    background-color: red;
    color:#FFFFFF;
    font-weight:bold;
    font-family:ms sans serif;
    width:100%;
    padding:3px;
    font-size:12px;
    text-align:center;
  /*border:1px solid #000000;*/
  }
</style>
<script language="JavaScript1.2">
function cOn(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCCCCC";
  }
}

function cOnA(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCFFFF";
  }
}

function cOut(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="DFE4F4";
  }
}
</script>
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
<body onLoad="init()">
<!-- header //-->
<div class="header_area">
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
</div>
<!-- header_eof //-->

  <table border="0" width="100%" cellspacing="0" cellpadding="0">
   <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '100%', '10');?></td>
   </tr>
   <tr>
    <td class="pageHeading"><?php echo MODULE_EASY_ADMIN_PRODUCTS_XSELL_HEADING_TITLE; ?></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '100%', '15');?></td>
   </tr>
  </table>

<?php
if ($_GET['add_related_product_ID'] == '' && $_GET['sort'] == '') {
?>
<?php
}else if ($_GET['add_related_product_ID'] != '' && $_GET['sort'] == '') {
    $products_name_query = 'select pd.products_name, p.products_model, p.products_image from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"';
    $products_name_result = $db->Execute($products_name_query);
?>
  <table border="0" cellspacing="0" cellpadding="0" bgcolor="#999999" align="center">
<?php
$products_query_raw = 'select p.products_id, p.products_model, p.products_image, p.products_price, pd.products_name, p.products_id from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'"';
$products_query_raw = easy_admin_products_model::xsell_add_search_condition($products_query_raw, $_REQUEST['searchProduct'], $_REQUEST['searchKeyword']);
$products_query_raw .= " order by p.products_id asc";
$products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
?>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContent">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], easy_admin_products_model::xsell_zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_form('update_cross',
                                 FILENAME_ADDON_MODULES_ADMIN,
                                 'module=easy_admin_products/xsell&action=update_cross&'.easy_admin_products_model::xsell_zen_get_all_get_params(array('module', 'action')),
                                 'post');
    ?><table cellpadding="1" cellspacing="1" border="0">
   <tr>
    <td colspan="6"><table cellpadding="3" cellspacing="0" border="0" width="100%">
     <tr class="dataTableHeadingRow">
      <td valign="top" align="center" colspan="2"><span class="pageHeading"><?php echo MODULE_EASY_ADMIN_PRODUCTS_TEXT_SETTING_SELLS.': '.$products_name_result->fields['products_name'].' ('.TEXT_MODEL.': '.$products_name_result->fields['products_model'].') ('.MODULE_EASY_ADMIN_PRODUCTS_TEXT_PRODUCT_ID.': '.$_GET['add_related_product_ID'].')';?></span></td>
     </tr>
     <tr class="dataTableHeadingRow">
      <td align="right"><?php echo ((file_exists(DIR_FS_CATALOG_IMAGES.$products['products_image'])) ? zen_image(DIR_WS_CATALOG_IMAGES.$products_name_result->fields['products_image']) : DIR_WS_CATALOG_IMAGES.$products_name_result->fields['products_image'] );?></td>
      <td align="right" valign="bottom"><?php
        echo zen_image_submit('button_update.gif') . '<br><br>'.
             '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products&page='.$_SESSION['easy_admin_products_page']).'">' . zen_image_button('button_cancel.gif') . '</a><br/><br/>'.
             '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/xsell&sort=1&add_related_product_ID='.$_GET['add_related_product_ID']).'">' . zen_image_button('button_sort.gif') . '</a>';
     ?></td>
     </tr>
    </table></td>
   </tr>
   <tr class="dataTableHeadingRow">
    <td colspan="6" class="dataTableHeadingContent">
      <?php $searchCategory = easy_admin_products_model::xsell_make_search_category(); ?>
      <?php echo MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_TARGET; ?>
      <?php echo zen_draw_pull_down_menu('searchProduct', $searchCategory, $_REQUEST['searchProduct']); ?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <?php echo MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_KEYWORD; ?>
      <?php echo zen_draw_input_field('searchKeyword', $_REQUEST['searchKeyword'], 'size=60'); ?>
      <input type="submit" name="doSearch" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_BUTTON?>">
      <?php if ($_REQUEST['searchKeyword'] != "") { ?>
        &nbsp;&nbsp;
        <input type="submit" name="doSearchReset" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_RESET_BUTTON?>">
      <?php } ?>
    </td>
   </tr>
     <tr class="dataTableHeadingRow">
      <td class="dataTableHeadingContent" width="75">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_CROSS_SELL_THIS;?>&nbsp;</td>
      <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
   </tr>
<?php
$products_query  = $products_query_raw;
$products_result = $db->Execute($products_query);
while (!$products_result->EOF) {
  $xsold_query  = 'select * from '.TABLE_PRODUCTS_XSELL.' where products_id = "'.$_GET['add_related_product_ID'].'" and xsell_id = "'.$products_result->fields['products_id'].'"';
  $xsold_result = $db->Execute($xsold_query);
?>
   <tr bgcolor='#DFE4F4'>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products_result->fields['products_id'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products_result->fields['products_model'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo ((is_file(DIR_FS_CATALOG_IMAGES.$products_result->fields['products_image'])) ?  zen_image(DIR_WS_CATALOG_IMAGES.$products_result->fields['products_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : '<br>No Image<br>');?>&nbsp;</td>
    <td class="dataTableContent">&nbsp;<?php echo zen_draw_hidden_field('product[]', $products_result->fields['products_id']) . zen_draw_checkbox_field('cross[]', $products_result->fields['products_id'], (($xsold_result->RecordCount() > 0) ? true : false), '', ' onMouseOver="this.style.cursor=\'hand\'"');?>&nbsp;<label onMouseOver="this.style.cursor='hand'"><?php echo MODULE_EASY_ADMIN_PRODUCTS_TEXT_CROSS_SELL;?></label>&nbsp;</td>
    <td class="dataTableContent">&nbsp;<?php echo $products_result->fields['products_name'];?>&nbsp;</td>
    <td class="dataTableContent">&nbsp;<?php echo $currencies->format($products_result->fields['products_price']);?>&nbsp;</td>
   </tr>
<?php
  $products_result->MoveNext();
}
?>
  </table></form></td>
   </tr>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContent">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], easy_admin_products_model::xsell_zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
  </table>
<?php
}elseif($_GET['add_related_product_ID'] != '' && $_GET['sort'] != ''){
    $products_name_query = 'select pd.products_name, p.products_model, p.products_image from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd where p.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id ="'.(int)$languages_id.'"';
    $products_name_result = $db->Execute($products_name_query);
?>
  <table border="0" cellspacing="0" cellpadding="0" bgcolor="#999999" align="center">
<?php
$products_query_raw = 'select p.products_id as products_id, p.products_price, p.products_image, p.products_model, pd.products_name, p.products_id, x.products_id as xproducts_id, x.xsell_id, x.sort_order, x.ID from '.TABLE_PRODUCTS.' p, '.TABLE_PRODUCTS_DESCRIPTION.' pd, '.TABLE_PRODUCTS_XSELL.' x where x.xsell_id = p.products_id and x.products_id = "'.$_GET['add_related_product_ID'].'" and p.products_id = pd.products_id and pd.language_id = "'.(int)$languages_id.'" order by x.sort_order asc';
$products_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $products_query_raw, $products_query_numrows);
$sort_order_drop_array = array();
for($i=1;$i<=$products_query_numrows;$i++){
  $sort_order_drop_array[] = array('id' => $i, 'text' => $i);
}
?>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContent">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], easy_admin_products_model::xsell_zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
   <tr>
    <td><?php echo zen_draw_form('update_sort',
                                 FILENAME_ADDON_MODULES_ADMIN,
                                 'module=easy_admin_products/xsell&action=update_sort&'.easy_admin_products_model::xsell_zen_get_all_get_params(array('module', 'action')),
                                 'post');
    ?><table cellpadding="1" cellspacing="1" border="0">
   <tr>
    <td colspan="6"><table cellpadding="3" cellspacing="0" border="0" width="100%">
     <tr class="dataTableHeadingRow">
      <td valign="top" align="center" colspan="2"><span class="pageHeading"><?php echo MODULE_EASY_ADMIN_PRODUCTS_TEXT_SETTING_SELLS.': '.$products_name_result->fields['products_name'].' ('.TEXT_MODEL.': '.$products_name_result->fields['products_model'].') (Product ID: '.$_GET['add_related_product_ID'].')';?></span></td>
     </tr>
     <tr class="dataTableHeadingRow">
      <td align="right"><?php echo zen_image(DIR_WS_CATALOG_IMAGES.$products_name_result->fields['products_image']);?></td>
      <td align="right" valign="bottom"><?php
        echo zen_image_submit('button_update.gif') . '<br><br>'.
             '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products&page='.$_SESSION['easy_admin_products_page']).'">' . zen_image_button('button_cancel.gif') . '</a><br/><br/>'.
             '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/xsell&add_related_product_ID='.$_GET['add_related_product_ID']).'">' . zen_image_button('button_xsell.gif') . '</a>';
      ?></td>
     </tr>
    </table></td>
   </tr>
   <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_ID;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_MODEL;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_IMAGE;?>&nbsp;</td>
    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_NAME;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_PRICE;?>&nbsp;</td>
    <td class="dataTableHeadingContent">&nbsp;<?php echo MODULE_EASY_ADMIN_PRODUCTS_TABLE_HEADING_PRODUCT_SORT;?>&nbsp;</td>
   </tr>
<?php
$products_query  = $products_query_raw;
$products_result = $db->Execute($products_query);
while (!$products_result->EOF){
?>
   <tr bgcolor='#DFE4F4'>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products_result->fields['products_id'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products_result->fields['products_model'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo ((is_file(DIR_FS_CATALOG_IMAGES.$products_result->fields['products_image'])) ?  zen_image(DIR_WS_CATALOG_IMAGES.$products_result->fields['products_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) : '<br>'.TEXT_NO_IMAGE.'<br>');?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $products_result->fields['products_name'];?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo $currencies->format($products_result->fields['products_price']);?>&nbsp;</td>
    <td class="dataTableContent" align="center">&nbsp;<?php echo zen_draw_pull_down_menu($products_result->fields['products_id'], $sort_order_drop_array, $products_result->fields['sort_order']);?>&nbsp;</td>
     </tr>
<?php
  $products_result->MoveNext();
}
?>
    </table></form></td>
   </tr>
   <tr>
    <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContent">
     <tr>
      <td class="smallText" valign="top"><?php echo $products_split->display_count($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
      <td class="smallText" align="right"><?php echo $products_split->display_links($products_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], easy_admin_products_model::xsell_zen_get_all_get_params(array('page', 'info', 'x', 'y', 'cID', 'action'))); ?></td>
     </tr>
    </table></td>
   </tr>
  </table>
<?php
}
//   Update relation by CSV
else if ($_POST['csvupload']==1) {
    echo '<div>[<a href="xsell.php">'.XSELL_TEXT_BACK_TO_MAIN.'</a>]</div>';

    do {
        if ( !is_uploaded_file($xsellcsv) )
            break;
        if ( $xsellcsv == null )
            break;
        echo XSELL_UPLOAD_FILE . '<br>';
        echo XSELL_UPLOAD_TEMP . $xsellcsv . '<br>';
        echo XSELL_UPLOAD_USER_FILE . $xsellcsv_name . '<br>';
        echo XSELL_SIZE . $xsellcsv_size . '<br>';

        $fp = fopen($xsellcsv, 'r');
        $firstRow = true;
        while ($row = fgetcsv($fp, 256)) {
            if ( $firstRow ) {
                $firstRow = false;
                continue;
            }
            $message = "";
            do {
                $mainProductsModel = $row[0];
                $relateProductsModel = $row[1];
                $action = $row[2];
                $eoreor = $row[3];
                $mainProductId = xsell_get_products_id($mainProductsModel);
                if ( $mainProductId == null ) {
                    $msg = XSELL_UPLOAD_ERR_PRODUCT_NOT_FOUND;
                    $message = xsell_make_error_deco($msg);
                    break;
                }
                $relateProductId = xsell_get_products_id($relateProductsModel);
                if ( $relateProductId == null ) {
                    $msg = XSELL_UPLOAD_ERR_PRODUCT_NOT_FOUND;
                    $message = xsell_make_error_deco($msg);
                    break;
                }
                if ( $action == "delete" ) {
                    $sql = "DELETE FROM ".TABLE_PRODUCTS_XSELL.
                      " WHERE products_id='".$mainProductId."' AND xsell_id='".$relateProductId."'";
		    $result = mysql_query($sql);
                    $message = XSELL_UPLOAD_OK_RELATED;
                }
                else {
                    if ( xsell_is_registered_relation($mainProductId, $relateProductId) ) {
                        $message = xsell_make_error_deco(XSELL_UPLOAD_ERR_ALREADY_HAS_RELATION);
                    }
                    else {
                        $sortOrder = xsell_allocate_sort_order($mainProductId);
                        // insert relation ship
                        $sql = "INSERT INTO ".TABLE_PRODUCTS_XSELL." (products_id,xsell_id,sort_order)" .
                          " VALUES('".$mainProductId."','".$relateProductId."','".$sortOrder."')";
                        $result = mysql_query($sql);
                        // make relation ship in this upload step
                        $message = XSELL_UPLOAD_OK_RELATED;
                    }
                }
            } while (false);
            echo zen_output_string($mainProductsModel) . "," . zen_output_string($relateProductsModel) . "," . $action . "," . " " . $message . "<br>";
        }

    } while (false);
}
?>
<!-- body_text_eof //-->
  </td>
 </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<div class="footer-area">
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
</div>
<!-- footer_eof //-->
<br />
</body>
</html>
