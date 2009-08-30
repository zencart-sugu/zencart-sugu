<?php
/**
 * whats_new sidebox - displays a random "new" product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: whats_new.php 2769 2006-01-02 07:34:58Z drbyte $
 */

// display limits
  $display_limit = zen_get_products_new_timelimit();

  $random_whats_new_sidebox_product_query = "select p.products_id, p.products_image, p.products_tax_class_id, p.products_price
                           from " . TABLE_PRODUCTS . " p
                           where p.products_status = 1 " . $display_limit . "
                           limit " . MAX_RANDOM_SELECT_NEW;

  $random_whats_new_sidebox_product = zen_random_select($random_whats_new_sidebox_product_query);

  if ($random_whats_new_sidebox_product->RecordCount() > 0 ) {
    $whats_new_price = zen_get_products_display_price($random_whats_new_sidebox_product->fields['products_id']);
    $random_whats_new_sidebox_product->fields['products_name'] = zen_get_products_name($random_whats_new_sidebox_product->fields['products_id']);
    $random_whats_new_sidebox_product->fields['specials_new_products_price'] = zen_get_products_special_price($random_whats_new_sidebox_product->fields['products_id']);
    require($template->get_template_dir('tpl_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_whats_new.php');
    $title =  BOX_HEADING_WHATS_NEW;
    $title_link = FILENAME_PRODUCTS_NEW;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
  }
?>