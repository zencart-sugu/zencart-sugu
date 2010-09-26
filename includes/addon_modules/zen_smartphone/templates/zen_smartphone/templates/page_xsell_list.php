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
?>
<div class="centerColumn" id="crossSell">
<div class="toolbar"><h1><?php echo TEXT_XSELL_PRODUCTS; ?></h1></div>
<a class="back" href="#">back</a>
<?php
// calculate whether any cross-sell products are configured for the current product, and display if relevant
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_XSELL_PRODUCTS));

if (zen_not_null($xsell_data)) {
  $info_box_contents = array();
  $list_box_contents = $xsell_data;
  $title = '';
?>
<?php
/**
 * require the list_box_content template to display the cross-sell info. This info was prepared in modules/xsell_products.php
 */
require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
?>
<!-- eof: tpl_modules_xsell_products -->
<?php } ?>

<?php
// -> zen_smartphone: 件数表示はAjaxでの読み込みに変更する
    $number_of_rows = $max_products_xsell;
    $number_of_rows_per_page = MAX_DISPLAY_XSELL;
    
    $current_page_number = (isset($_GET['page']) ? (int)$_GET['page'] : 1);
    $number_of_pages = ceil($number_of_rows / $number_of_rows_per_page);
    // next button
    if (($current_page_number < $number_of_pages) &&  ($number_of_pages != 1)) {
       $display_links_string = zen_href_link(FILENAME_ADDON, 'module=zen_smartphone/xsell_list_parts&products_id='. (int)$_GET['products_id']);
       $display_links_string = preg_replace("/&amp;/", "&", $display_links_string); // これどこでhtmlspecialcharsされているんだろうか…手動で戻す
?>
<ul id="ajax-nextpage">
<li><a class="whiteButton" href="#">next page</a></li>
</ul>
<script type="text/javascript" src="<?php echo $template->get_template_dir('nextPageAdd.js',DIR_WS_TEMPLATE, $current_page_base,'js'). '/nextPageAdd.js'; ?>"></script>
<script type="text/javascript">
var option = {
	current_page: "<?php echo $current_page_number; ?>",
	max_page: "<?php echo $number_of_pages; ?>",
	url: "<?php echo $display_links_string; ?>&page=",
	loading: "<li id='loading'>nowloading...</li>",
	loading_element_name: '#crossSell ul#product-listing #loading',
	added_list_element: $('#crossSell ul#product-listing'),
	max_page_callback: function () {
		$('#crossSell #ajax-nextpage').hide();
	}
};
var npa = new $.nextPageAdd(option);
$('#crossSell #ajax-nextpage a').click(npa.addPage);
</script>
<?php
    }
// <- zen_smartphone: 件数表示はAjaxでの読み込みに変更する
?>
</div>
