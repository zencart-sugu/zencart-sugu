<?php
/**
 * Module Template
 * Ajax用に大分スッキリしたテンプレートを作った
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
