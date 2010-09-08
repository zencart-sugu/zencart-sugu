<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: $
 */
?>
<div class="centerColumn" id="indexCategories">

<?php
// -> zen_smartphone: h1 は toolbar を使う
/*
<h1 id="indexCategoriesHeading"><?php echo $product['name']; ?></h1>
*/
?>
<div class="toolbar"><h1><?php echo $product['name']; ?></h1></div>
<a class="back" href="#">cancel</a>
<?php
// <-> zen_smartphone: h1 は toolbar を使う
?>

<ul>
<li>
<?php
  echo zen_image(DIR_WS_IMAGES.$product['image'], $product['name'], MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT);
?>
</li>
<li><a class="goback" href="#"><?php echo MODULE_ZEN_SMARTPHONE_IMAGE_DESCRIPTION_RETURN; ?></a></li>
</ul>

<ul>

<?php
// -> zen_smartphone: see modules/pages/product_info/main_template_vars.php
    // get attributes
    require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_ATTRIBUTES));
// <- zen_smartphone: see modules/pages/product_info/main_template_vars.php
?>

<?php
// -> zen_smartphone: see tpl_product_info_display.php
?>
<?php
// -> zen_smartphone: dl dt dd ではなく、ul li で。
/*
<dl class="summary">
<dt><?php echo TEXT_PRODUCT_QUANTITY ; ?></dt>
<?php if (MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS == 'true'): ?>
<dd><?php echo display_advanced_stock((int)$_GET['products_id']) ?></dd>
<?php else: ?>
<dd><?php if($products_quantity != 0){echo 'あり';}else{echo 'なし';}?></dd>
<?php endif; ?>
*/
?>
<li>
<?php echo TEXT_PRODUCT_QUANTITY ; ?>
<?php if (MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS == 'true'): ?>
<?php echo display_advanced_stock((int)$_GET['products_id']) ?>
<?php else: ?>
<?php if($products_quantity != 0){echo 'あり';}else{echo 'なし';}?>
<?php endif; ?>
</li>
<?php
// -> zen_smartphone: dl dt dd ではなく、ul li で。
?>

<?php
  if ($pr_attr->fields['total'] > 0) {
?>
<?php
/**
 * display the product atributes
 */
  require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
<?php
  }
?>

<?php
// -> zen_smartphone: dl dt dd ではなく、ul li で。
//$the_button = '';
//$the_button .= '<dt>'.PRODUCTS_ORDER_QTY.'</dt>'."\n";
//$the_button .= '<dd><input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" />' .PRODUCTS_ORDER_QTY_TEXT.'<br />'. zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']).'</dd>'."\n".'</dl>'."\n";
$the_button = '<li>';
$the_button .= '<div>'.PRODUCTS_ORDER_QTY.'</div>'."\n";
$the_button .= '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" />' .PRODUCTS_ORDER_QTY_TEXT.'<br />'. zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']).''."\n";
$the_button .= ''."\n";

$in_cart_button_html    = '<div class="cartAdd">'
                        . '<div class="price">'. ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']).'</div>'."\n"
                        .  zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT,'class="imgover"')
                        . '</div>';
$in_cart_button_html .= '</li>'."\n";
// <- zen_smartphone: dl dt dd ではなく、ul li で。
$the_button .= $in_cart_button_html;
if (MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS == 'true'):
  $display_button = advanced_stock_get_buy_now_button($_GET['products_id'], $the_button);
else:
  $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
endif;
?>

<?php if ($display_qty != '' or $display_button != '') { ?>
<?php echo $display_button; ?>
<?php } // display qty and button ?>

<?php
// -> zen_smartphone: div でなく ul li で。
/*
</div>
*/
// <- zen_smartphone: div でなく ul li で。
?>
</ul>
<?php
// <- zen_smartphone: see tpl_product_info_display.php
?>

</div>
