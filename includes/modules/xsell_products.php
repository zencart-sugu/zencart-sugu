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

// in case admin switches aren't added properly, assume default settings:
if (!defined('MAX_DISPLAY_XSELL')) define('MAX_DISPLAY_XSELL',6);
if (!defined('MIN_DISPLAY_XSELL')) define('MIN_DISPLAY_XSELL',1);
if (!defined('XSELL_DISPLAY_PRICE')) define('XSELL_DISPLAY_PRICE','false');
if (!defined('SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS')) define('SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS',3);

// collect information on available cross-sell products for the current product-id
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS > 0 ) {
  $xsell_query = $db->Execute("select distinct p.products_id, p.products_image, pd.products_name
                                 from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                 where xp.products_id = '" . $_GET['products_id'] . "'
                                  and xp.xsell_id = p.products_id
                                  and p.products_id = pd.products_id
                                  and pd.language_id = '" . $_SESSION['languages_id'] . "'
                                  and p.products_status = 1
                                 order by xp.sort_order asc limit " . MAX_DISPLAY_XSELL);
  $num_products_xsell = $xsell_query->RecordCount();

  // don't display if less than the minimum amount set in Admin->Config->Minimum Values->Cross-Sell
  if ($num_products_xsell >= MIN_DISPLAY_XSELL && $num_products_xsell > 0) {
?>
<!-- xsell_products //-->
<?php
$row = 0;
$col = 0;
$list_box_contents = array();
$title='';
if ($num_products_xsell < SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS==0) {
  $col_width = floor(100/$num_products_xsell);
} else {
  $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS);
}
while (!$xsell_query->EOF) {
  $xsell_query->fields['products_name'] = zen_get_products_name($xsell_query->fields['products_id']);
  $list_box_contents[$row][$col] = array('params' => 'class="centerBoxContentsCrossSell centeredContent back"' . ' ' . 'style="width:' . $col_width . '%;"',
  'text' => '<a href="' . zen_href_link(zen_get_info_page($xsell_query->fields['products_id']), 'products_id=' . (int)$xsell_query->fields['products_id']) . '">' . zen_image(DIR_WS_IMAGES . $xsell_query->fields['products_image'], $xsell_query->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_page($xsell_query->fields['products_id']), 'products_id=' . $xsell_query->fields['products_id']) . '">' . $xsell_query->fields['products_name'] . '</a>' . (XSELL_DISPLAY_PRICE=='true'? '<br />'.zen_get_products_display_price($xsell_query->fields['products_id']):'') );
  $col ++;
  if ($col > (SHOW_PRODUCT_INFO_COLUMNS_XSELL_PRODUCTS -1)) {
    $col = 0;
    $row ++;
  }
  $xsell_query->MoveNext();
}
// store data into array for display later where desired:
$xsell_data = $list_box_contents;
  }
}
?>