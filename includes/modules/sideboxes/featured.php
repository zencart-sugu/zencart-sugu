<?php
/**
 * featured sidebox - displays a random Featured Product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: featured.php 2808 2006-01-06 17:17:32Z drbyte $
 */

// test if box should display
  $show_featured= true;

  if ($show_featured == true) {
    $random_featured_products_query = "select p.products_id, p.products_image, pd.products_name
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id and p.products_id = pd.products_id and p.products_status = 1 and f.status = 1 and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           order by pd.products_name desc
                           limit " . MAX_RANDOM_SELECT_FEATURED_PRODUCTS;

    // randomly select ONE featured product from the list retrieved:
    $random_featured_product = zen_random_select($random_featured_products_query);

    if ($random_featured_product->RecordCount() > 0)  {
      $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);

      require($template->get_template_dir('tpl_featured.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_featured.php');
      $title =  BOX_HEADING_FEATURED_PRODUCTS;
      $title_link = FILENAME_FEATURED_PRODUCTS;
      require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
    }
  }
?>