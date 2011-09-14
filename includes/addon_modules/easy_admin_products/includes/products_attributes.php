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

// products¾ðÊó
$attributes_column = array(
  // table columns
  'products_attributes_id'                 => 0,
  'products_id'                            => 0,
  'options_id'                             => 0,
  'options_values_id'                      => 0,
  'options_values_price'                   => 0,
  'price_prefix'                           => "",
  'products_options_sort_order'            => 0,
  'product_attribute_is_free'              => 0,
  'products_attributes_weight'             => 0,
  'products_attributes_weight_prefix'      => "",
  'attributes_display_only'                => 0,
  'attributes_default'                     => 0,
  'attributes_discounted'                  => 0,
  'attributes_image'                       => "",
  'attributes_price_base_included'         => 0,
  'attributes_price_onetime'               => 0,
  'attributes_price_factor'                => 0,
  'attributes_price_factor_offset'         => 0,
  'attributes_price_factor_onetime'        => 0,
  'attributes_price_factor_onetime_offset' => 0,
  'attributes_qty_prices'                  => "",
  'attributes_qty_prices_onetime'          => "",
  'attributes_price_words'                 => 0,
  'attributes_price_words_free'            => 0,
  'attributes_price_letters'               => 0,
  'attributes_price_letters_free'          => 0,
  'attributes_required'                    => 0,
  // download columns
  'products_attributes_filename'           => "",
  'products_attributes_maxdays'            => "",
  'products_attributes_maxcount'           => "",
  // working columns for display
  'products_options_name'                  => "",
  'products_options_values_name'           => "",
  'products_display_price'                 => "",
  'products_attributes_display_weight'     => "",
  'attributes_display_price_final'         => "",
  'products_status'                        => "",
);
?>
