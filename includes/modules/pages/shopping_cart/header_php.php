<?php
/**
 * shopping_cart header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3579 2006-05-06 06:04:12Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_SHOPPING_CART');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

// Validate Cart for checkout
$_SESSION['valid_to_checkout'] = true;
$_SESSION['cart_errors'] = '';
$_SESSION['cart']->get_products(true);

if (!$_SESSION['valid_to_checkout']) {
  $messageStack->add('shopping_cart', ERROR_CART_UPDATE . $_SESSION['cart_errors'] , 'caution');
}

$totalsDisplay = '';
switch (true) {
  case (SHOW_TOTALS_IN_CART == '1'):
  $totalsDisplay = TEXT_TOTAL_ITEMS . $_SESSION['cart']->count_contents() . TEXT_TOTAL_WEIGHT . $_SESSION['cart']->show_weight() . TEXT_PRODUCT_WEIGHT_UNIT . TEXT_TOTAL_AMOUNT . $currencies->format($_SESSION['cart']->show_total());
  break;
  case (SHOW_TOTALS_IN_CART == '2'):
  $totalsDisplay = TEXT_TOTAL_ITEMS . $_SESSION['cart']->count_contents() . ($_SESSION['cart']->show_weight() > 0 ? TEXT_TOTAL_WEIGHT . $_SESSION['cart']->show_weight() . TEXT_PRODUCT_WEIGHT_UNIT : '') . TEXT_TOTAL_AMOUNT . $currencies->format($_SESSION['cart']->show_total());
  break;
  case (SHOW_TOTALS_IN_CART == '3'):
  $totalsDisplay = TEXT_TOTAL_ITEMS . $_SESSION['cart']->count_contents() . TEXT_TOTAL_AMOUNT . $currencies->format($_SESSION['cart']->show_total());
  break;
}

// testing/debugging
//  require(DIR_WS_MODULES . 'debug_blocks/shopping_cart_contents.php');

$flagHasCartContents = ($_SESSION['cart']->count_contents() > 0);
$cartShowTotal = $currencies->format($_SESSION['cart']->show_total());

$flagAnyOutOfStock = false;
$products = $_SESSION['cart']->get_products();
for ($i=0, $n=sizeof($products); $i<$n; $i++) {
  if (($i/2) == floor($i/2)) {
    $rowClass="rowEven";
  } else {
    $rowClass="rowOdd";
  }
  switch (true) {
    case (SHOW_SHOPPING_CART_DELETE == 1):
    $buttonDelete = true;
    $checkBoxDelete = false;
    break;
    case (SHOW_SHOPPING_CART_DELETE == 2):
    $buttonDelete = false;
    $checkBoxDelete = true;
    break;
    default:
    $buttonDelete = true;
    $checkBoxDelete = true;
    break;
    $cur_row++;
  } // end switch
  $attributeHiddenField = "";
  if (STOCK_CHECK == 'true') {
    $flagStockCheck = zen_check_stock($products[$i]['id'], $products[$i]['quantity']);
    if ($flagStockCheck == true) {
      $flagAnyOutOfStock = true;
    }
  }
  $attrArray = false;
  // Push all attributes information in an array
  if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
    if (PRODUCTS_OPTIONS_SORT_ORDER=='0') {
      $options_order_by= ' ORDER BY LPAD(popt.products_options_sort_order,11,"0")';
    } else {
      $options_order_by= ' ORDER BY popt.products_options_name';
    }
    foreach ($products[$i]['attributes'] as $option => $value) {
      $attributes = "SELECT popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                     FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                     WHERE pa.products_id = :productsID
                     AND pa.options_id = :optionsID
                     AND pa.options_id = popt.products_options_id
                     AND pa.options_values_id = :optionsValuesID
                     AND pa.options_values_id = poval.products_options_values_id
                     AND popt.language_id = :languageID
                     AND poval.language_id = :languageID " . $options_order_by;

      $attributes = $db->bindVars($attributes, ':productsID', $products[$i]['id'], 'integer');
      $attributes = $db->bindVars($attributes, ':optionsID', $option, 'integer');
      $attributes = $db->bindVars($attributes, ':optionsValuesID', $value, 'integer');
      $attributes = $db->bindVars($attributes, ':languageID', $_SESSION['languages_id'], 'integer');
      $attributes_values = $db->Execute($attributes);
      if ($value == PRODUCTS_OPTIONS_VALUES_TEXT_ID) {
        $attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . TEXT_PREFIX . $option . ']',  $products[$i]['attributes_values'][$option]);
        $attr_value = $products[$i]['attributes_values'][$option];
      } else {
        $attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
        $attr_value = $attributes_values->fields['products_options_values_name'];
      }

      //clr 030714 determine if attribute is a text attribute and assign to $attr_value temporarily
      $attrArray[$option]['products_options_name'] = $attributes_values->fields['products_options_name'];
      $attrArray[$option]['options_values_id'] = $value;
      $attrArray[$option]['products_options_values_name'] = zen_output_string_protected($attr_value);
      $attrArray[$option]['options_values_price'] = $attributes_values->fields['options_values_price'];
      $attrArray[$option]['price_prefix'] = $attributes_values->fields['price_prefix'];
    }
  } //end foreach [attributes]
  $linkProductsImage = zen_href_link(zen_get_info_page($products[$i]['id']), 'products_id=' . $products[$i]['id']);
  $linkProductsName = zen_href_link(zen_get_info_page($products[$i]['id']), 'products_id=' . $products[$i]['id']);
  $productsImage = (IMAGE_SHOPPING_CART_STATUS == 1 ? zen_image(DIR_WS_IMAGES . $products[$i]['image'], $products[$i]['name'], IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT) : '');
  $productsName = $products[$i]['name'];
  $show_products_quantity_max = zen_get_products_quantity_order_max($products[$i]['id']);
  $showFixedQuantity = (($show_products_quantity_max == 1 or zen_get_products_qty_box_status($products[$i]['id']) == 0) ? true : false);
//  $showFixedQuantityAmount = $products[$i]['quantity'] . zen_draw_hidden_field('products_id[]', $products[$i]['id']) . zen_draw_hidden_field('cart_quantity[]', 1);
//  $showFixedQuantityAmount = $products[$i]['quantity'] . zen_draw_hidden_field('cart_quantity[]', 1);
  $showFixedQuantityAmount = $products[$i]['quantity'] . zen_draw_hidden_field('cart_quantity[]', $products[$i]['quantity']);
  $showMinUnits = zen_get_products_quantity_min_units_display($products[$i]['id']);
  $quantityField = zen_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4"');
  $buttonUpdate = ((SHOW_SHOPPING_CART_UPDATE == 1 or SHOW_SHOPPING_CART_UPDATE == 3) ? zen_image_submit(ICON_IMAGE_UPDATE, ICON_UPDATE_ALT) : '') . zen_draw_hidden_field('products_id[]', $products[$i]['id']);
  $productsPrice = $currencies->display_price($products[$i]['final_price'], zen_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . ($products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->display_price($products[$i]['onetime_charges'], zen_get_tax_rate($products[$i]['tax_class_id']), 1) : '');
  $productsPriceEach = $currencies->display_price($products[$i]['final_price'], zen_get_tax_rate($products[$i]['tax_class_id']), 1) . ($products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->display_price($products[$i]['onetime_charges'], zen_get_tax_rate($products[$i]['tax_class_id']), 1) : '');
  $productArray[$i] = array('attributeHiddenField'=>$attributeHiddenField,
                            'flagStockCheck'=>$flagStockCheck,
                            'flagShowFixedQuantity'=>$showFixedQuantity,
                            'linkProductsImage'=>$linkProductsImage,
                            'linkProductsName'=>$linkProductsName,
                            'productsImage'=>$productsImage,
                            'productsName'=>$productsName,
                            'showFixedQuantity'=>$showFixedQuantity,
                            'showFixedQuantityAmount'=>$showFixedQuantityAmount,
                            'showMinUnits'=>$showMinUnits,
                            'quantityField'=>$quantityField,
                            'buttonUpdate'=>$buttonUpdate,
                            'productsPrice'=>$productsPrice,
                            'productsPriceEach'=>$productsPriceEach,
                            'rowClass'=>$rowClass,
                            'buttonDelete'=>$buttonDelete,
                            'checkBoxDelete'=>$checkBoxDelete,
                            'id'=>$products[$i]['id'],
                            'attributes'=>$attrArray);
} // end FOR loop
// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_SHOPPING_CART');
?>
