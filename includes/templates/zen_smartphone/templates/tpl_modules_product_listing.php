<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_product_listing.php 3241 2006-03-22 04:27:27Z ajeh $
 * UPDATED TO WORK WITH COLUMNAR PRODUCT LISTING 04/04/2006
 */
// -> zen_smartphone: search moreは使いません
// if(MODULE_SEARCH_MORE_STATUS == 'true') {
//   echo $GLOBALS['search_more']->getBlock('block_search_form',$current_page_base);
// }
// <- zen_smartphone: search moreは使いません

 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));
?>
<div id="productListing">

<?php
// -> zen_smartphone: 件数表示は下に移動。よって消します。
/*
<?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<div class="navSplitPages">
<div id="productsListingTopNumber" class="navSplitPagesResult"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
<?php
if(MODULE_SEARCH_MORE_STATUS == 'true') {
	echo '<div id="block_sort">';
  echo $GLOBALS['search_more']->getBlock('block_par_page',$current_page_base);
  echo $GLOBALS['search_more']->getBlock('block_sort',$current_page_base);
	echo '</div>';
}
?>
</div>
<div id="productsListingListingTopLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<br class="clearBoth" />
<?php
}
?>
*/
// <- zen_smartphone: 件数表示は下に移動。よって消します。
?>

<?php
/**
 * load the list_box_content template to display the products
 */
// -> zen_smartphone: columnar_displayをベースに商品一覧用にカスタマイズします
//if (PRODUCT_LISTING_LAYOUT_STYLE == 'columns') {
//  require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
//} else {// (PRODUCT_LISTING_LAYOUT_STYLE == 'rows')
  require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');
//}
#require($template->get_template_dir('tpl_columnar_display_for_products_list.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display_for_products_list.php');
// <- zen_smartphone: columnar_displayをベースに商品一覧用にカスタマイズします
?>

<?php
// -> zen_smartphone: 件数表示はAjaxでの読み込みに変更する
/*
<?php if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div  id="productsListingListingBottomLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<div id="productsListingBottomNumber" class="navSplitPagesResult"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
<?php
  }
?>
*/
?>
<?php
    $parameters = zen_get_all_get_params(array('page', 'info', 'x', 'y'));
    // next button
    if (($listing_split->current_page_number < $listing_split->number_of_pages) &&  ($listing_split->number_of_pages != 1)) {
       $display_links_string = zen_href_link($_GET['main_page'], $parameters, $request_type);
       $display_links_string = preg_replace("/&amp;/", "&", $display_links_string); // これどこでhtmlspecialcharsされているんだろうか…手動で戻す
?>
<ul id="ajax-nextpage">
<li><a class="whiteButton" href="#">next page</a></li>
</ul>
<script type="text/javascript" src="<?php echo $template->get_template_dir('nextPageAdd.js',DIR_WS_TEMPLATE, $current_page_base,'js'). '/nextPageAdd.js'; ?>"></script>
<script type="text/javascript">
var option = {
	current_page: "<?php echo $listing_split->current_page_number; ?>",
	max_page: "<?php echo ceil($listing_split->number_of_rows / $listing_split->number_of_rows_per_page); ?>",
	url: "<?php echo $display_links_string; ?>&page=",
	loading: "<li id='loading'>nowloading...</li>",
	loading_element_name: '#productListing ul#product-listing #loading',
	added_list_element: $('#productListing ul#product-listing'),
	max_page_callback: function () {
		$('#productListing #ajax-nextpage').hide();
	}
};
var npa = new $.nextPageAdd(option);
$('#productListing #ajax-nextpage a').click(npa.addPage);
</script>
<?php
    }
// <- zen_smartphone: 件数表示はAjaxでの読み込みに変更する
?>
</div>

<?php
// if ($show_top_submit_button == true or $show_bottom_submit_button == true or (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>
