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

require(dirname(__FILE__) . '/includes/products_attributes.php');

$products_id = $_REQUEST['products_id'];
$attributes_id = $_REQUEST['attributes_id'];
$edit_mode = $attributes_id ? true : false;

$model = new easy_admin_products_attribute_model();
$html  = new easy_admin_products_html();

# load | new attributes
$zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_START_EDIT');
$easy_admin_products_attributes_validate = array();
if ($_REQUEST['attribute']) {
  $attribute = $_REQUEST['attribute'];
}else{
  $columns  = array(
    "attributes_column" => $attributes_column,
  );
  if ($edit_mode) {
    $attribute = $model->load_attribute($columns, $products_id, $attributes_id);
  }else{
    $attribute = $model->new_attribute($columns, $products_id);
  }
}

# get datas for display
$options_id_default = (int)$attribute['options_id'];
$options_values_id_default = (int)$attribute['options_values_id'];
$products_options = $model->get_products_options();
$options_for_json = array();
foreach ($products_options as $products_option) {
  $options_for_json[$products_option['id']] = array(
    'label' => $products_option['options_name'],
    'type'  => $products_option['type_name'],
    'require_value' => $model->is_require_option_value($products_option['type']),
  );
}

$price_prefix_options = array(
  array("id" => "+", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_PLUS),
  array("id" => "-", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_MINUS),
  array("id" => "", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_PREFIX_REPLACE),
);

$weight_prefix_options = array(
  array("id" => "+", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_PLUS),
  array("id" => "-", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_MINUS),
  array("id" => "", "text" => MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX_REPLACE),
);
$on_overwrite = true;
$off_overwrite = false;

# open/close settings
$open_price_factor_setting = false;
if ($attribute['attributes_price_onetime'] != 0 ||
    $attribute['attributes_price_factor'] != 0 ||
    $attribute['attributes_price_factor_offset'] != 0 ||
    $attribute['attributes_price_factor_onetime'] != 0 ||
    $attribute['attributes_price_factor_onetime_offset'] != 0) {
  $open_price_factor_setting = true;
}

$open_qty_prices_setting = false;
if (zen_not_null($attribute['attributes_qty_prices']) ||
    zen_not_null($attbibute['attributes_qty_prices_onetime'])) {
  $open_qty_prices_setting = true;
}

$open_price_words_setting = false;
if ($attribute['attributes_price_words'] != 0 ||
    $attribute['attributes_price_words_free'] != 0 ||
    $attribute['attributes_price_letters'] != 0 ||
    $attribute['attributes_price_letters_free'] != 0) {
  $open_price_words_setting = true;
}

$open_image_setting = false;
if (zen_not_null($attribute['attributes_image'])) {
  $open_image_setting = true;
}

$open_download_setting = false;
if (zen_not_null($attribute['products_attributes_filename']) ||
    zen_not_null($attribute['products_attributes_maxdays']) ||
    zen_not_null($attribute['products_attributes_maxcount'])) { 
  $open_download_setting = true;
}

# load template
require(dirname(__FILE__) . '/templates/admin_attributes/edit.php'); 
