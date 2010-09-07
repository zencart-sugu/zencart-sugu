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
