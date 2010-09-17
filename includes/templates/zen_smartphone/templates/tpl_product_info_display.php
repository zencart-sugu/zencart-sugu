<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 3435 2006-04-14 03:42:46Z ajeh $
 */
 //require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
?>
<div class="centerColumn" id="productGeneral">

<!-- Form start-->
<?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product'), 'post', 'enctype="multipart/form-data"') . "\n"; ?>
<!-- /Form start-->

<div class="toolbar"><h1><?php echo $products_name; ?></h1></div>
<a class="back" href="#">back</a>

<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>

<!-- productImage -->
<?php
// -> zen_smartphone: div でなく ul li で。
/*
<div id="productImage">
*/
// <- zen_smartphone: div でなく ul li で。
?>
<ul>

<!-- Main Product Image -->
<li class="arrow">

<?php
// -> zen_smartphone: 画像はデフォルトだけでよい。
//  if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS != 'true') {
    if (zen_not_null($products_image)) {
      require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php');
    }
//  }
?>
<?php
//if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS == 'true') {
//  echo $GLOBALS['multiple_image_view']->getBlock('block_expd',$current_page_base);
//}
// <- zen_smartphone: 画像はデフォルトだけでよい。
?>

</li>
<!-- /Main Product Image-->

<?php
// -> zen_smartphone: Additionalはここでは出さない
/*
<!-- Additional Product Images -->
<?php
if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS == 'true') {
  echo $GLOBALS['multiple_image_view']->getBlock('block_thmb',$current_page_base);
}
?>
<!-- /Additional Product Images -->
*/
// <- zen_smartphone: Additionalはここでは出さない
?>

<?php
// -> zen_smartphone: div でなく ul li で。
/*
</div>
*/
// <- zen_smartphone: div でなく ul li で。
?>
<!-- /productImage -->

<!-- Product description -->
<?php
// -> zen_smartphone: div でなく ul li で。
/*
<div id="productDescription">
*/
// <- zen_smartphone: div でなく ul li で。
?>
<li>

<div><?php echo $products_name; ?></div>

<?php if ($products_description != '') { ?>
<?php echo HEADELINE_PRODUCT_DESCRIPTION ; ?>
<?php } ?>

<?php
  if (zen_not_null($products_url)) {
    if ($flag_show_product_info_url == 1) {
?>
<p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode(ereg('^http:\/\/', $products_url) ? substr($products_url,7) : $products_url ), 'NONSSL', true, false)); ?></p>
<?php
    } // $flag_show_product_info_url
  }
?>

<?php if ($products_description != '') { ?>
<div id="productDescriptionBody">
<?php echo stripslashes($products_description); ?>
</div>
<?php } ?>

<?php
// <- zen_smartphone: div でなく ul li で。
/*
</div>
*/
// <- zen_smartphone: div でなく ul li で。
?>
</li>
<?php
// -> zen_smartphone: 関連商品 (xsell) へのリンク
if (defined(FILENAME_XSELL_PRODUCTS)) {
  // calculate whether any cross-sell products are configured for the current product, and display if relevant
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_XSELL_PRODUCTS));
  if (zen_not_null($xsell_data)) {
?>
<li class="arrow"><a href="<?php echo zen_href_link(FILENAME_ADDON, 'module=zen_smartphone/xsell_list&products_id='. (int)$_GET['products_id']); ?>"><?php echo TEXT_XSELL_PRODUCTS; ?></a></li>
<?php
  }
}
// <- zen_smartphone: 関連商品 (xsell) へのリンク
?>
</ul>
<!-- /Product description -->

<!-- productGuide -->
<?php
// -> zen_smartphone: div でなく ul li で。
/*
<div id="productGuide">
*/
?>
<ul>

<?php
// -> zen_smartphone: h1はtoolbarを使い、上に移動した
/*
<h1 id="productName" class="productGeneral"><span><?php echo $products_manufacturer ; ?></span><br />
<?php echo $products_name; ?></h1>
*/
// <- zen_smartphone: h1はtoolbarを使い、上に移動した
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
                        .  zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT,'class="imgover"', 'submit')
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
<!-- /productGuide -->

<ul id="productInformation">
<?php
if($products_shipping_type){
    echo (($products_shipping_type) ? '<li>' . TEXT_PRODUCT_SHIPPING_TYPE . $products_shipping_type['name'] . sprintf(TEXT_PRODUCT_SHIPPING_TYPE_LINK, $products_shipping_type['url']) . '</li>' : '') . "\n"; 
}
?>
<li><a href="<?php echo  zen_href_link(FILENAME_ADDON, '&module=mt_pages&page=how_to_use', 'NONSSL'); ?>">ご利用ガイド</a></li>
</ul>

<br class="clearBoth" />


</form>
</div>
