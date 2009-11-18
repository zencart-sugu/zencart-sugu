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


// calculate whether any cross-sell products are configured for the current product, and display if relevant
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_XSELL_PRODUCTS));

if (zen_not_null($xsell_data)) {
  $info_box_contents = array();
  $list_box_contents = $xsell_data;
  $title = '';
?>
<!-- bof: tpl_modules_xsell_products -->
<div class="centerBoxWrapper" id="crossSell">
<h2 class="centerBoxHeading"><?php echo TEXT_XSELL_PRODUCTS; ?></h2>
<?php
/**
 * require the list_box_content template to display the cross-sell info. This info was prepared in modules/xsell_products.php
 */
require($template->get_template_dir('tpl_columnar_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_columnar_display.php');
?>
</div>
<!-- eof: tpl_modules_xsell_products -->
<?php } ?>