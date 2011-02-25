<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// products情報
$products_column = array(
  'products_id'                      => 0,
  'products_type'                    => 1,
  'products_quantity'                => "",
  'products_model'                   => "",
  'products_image'                   => "",
  'products_price'                   => "",
  'products_virtual'                 => 0,
  'products_date_added'              => "",
  'products_last_modified'           => "",
  'products_date_available'          => "",
  'products_weight'                  => "",
  'products_status'                  => 1,
  'products_tax_class_id'            => 0,
  'manufacturers_id'                 => 0,
  'products_ordered'                 => 0,
  'products_quantity_order_min'      => "",
  'products_quantity_order_units'    => "",
  'products_priced_by_attribute'     => 0,
  'product_is_free'                  => 0,
  'product_is_call'                  => 0,
  'products_quantity_mixed'          => 0,
  'product_is_always_free_shipping'  => 0,
  'products_qty_box_status'          => 1,
  'products_quantity_order_max'      => "",
  'products_sort_order'              => "",
  'products_discount_type'           => 0,
  'products_discount_type_from'      => 0,
  'products_price_sorter'            => "",
  'master_categories_id'             => 0,
  'products_mixed_discount_quantity' => 1,
  'metatags_title_status'            => 0,
  'metatags_products_name_status'    => 0,
  'metatags_model_status'            => 0,
  'metatags_price_status'            => 0,
  'metatags_title_tagline_status'    => 0,
);

// products_description情報
$products_description_column = array(
  'language_id'                      => 0,
  'products_name'                    => '',
  'products_description'             => '',
  'products_url'                     => '',
  'products_viewed'                  => 0,
);

// featured情報
$featured_column = array(
  'featured_id'                      => 0,
  'featured_date_added'              => "",
  'featured_last_modified'           => "",
  'expires_date'                     => "",
  'date_status_change'               => "",
  'status'                           => 0,
  'featured_date_available'          => "",
);

// specials情報
$specials_column = array(
  'specials_id'                      => 0,
  'specials_new_products_price'      => "",
  'specials_date_added'              => "",
  'specials_last_modified'           => "",
  'expires_date'                     => "",
  'date_status_change'               => "",
  'status'                           => 0,
  'specials_date_available'          => "",
);

// meta_tags_products_description情報
$meta_tags_products_description_column = array(
  'language_id'                      => 0,
  'metatags_title'                   => "",
  'metatags_keywords'                => "",
  'metatags_description'             => "",
);
?>
