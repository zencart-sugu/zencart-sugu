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

<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>

<!-- productImage -->
<div id="productImage">

<!-- Main Product Image -->
<?php
  if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS != 'true') {
    if (zen_not_null($products_image)) {
      require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php');
    }
  }
?>
<?php
if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS == 'true') {
  echo $GLOBALS['multiple_image_view']->getBlock('block_expd',$current_page_base);
}
?>
<!-- /Main Product Image-->

<!-- Additional Product Images -->
<?php
if(MODULE_MULTIPLE_IMAGE_VIEW_STATUS == 'true') {
  echo $GLOBALS['multiple_image_view']->getBlock('block_thmb',$current_page_base);
}
?>
<!-- /Additional Product Images -->

</div>
<!-- /productImage -->

<!-- productGuide -->
<div id="productGuide">

<h1 id="productName" class="productGeneral"><span><?php echo $products_manufacturer ; ?></span><br />
<?php echo $products_name; ?></h1>

<dl class="summary">
<?php $stock =  ((($advanced_stock = zen_addOnModules_call_function('advanced_stock', 'display_advanced_stock', array((int)$_GET['products_id']))) != '') ? $advanced_stock : $products_quantity); ?>
<?php if ($flag_show_product_info_quantity == 1 && $stock != ''): ?>
<dt><?php echo TEXT_PRODUCT_QUANTITY ; ?></dt>
<dd><?php echo $stock; ?></dd>
<?php
endif; // end of display stock
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
<!--bof Add to Cart Box -->
<?php
if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
  // do nothing
} else {
?>
            <?php
    $display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<dt>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . '</dt><dd>' . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</dd>' : '');
            ?>
<?php
            if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
              // hide the quantity box and default to 1
              $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']);
            } else {
              // show the quantity box
$the_button = '';
$the_button .= '<dt>'.PRODUCTS_ORDER_QTY.'</dt>'."\n";
$the_button .= '<dd><input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" />' .PRODUCTS_ORDER_QTY_TEXT.'<br />'. zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']).'</dd>'."\n".'</dl>'."\n";
            }
$in_cart_button_html    = '<div class="cartAdd">'
                        . '<div class="price">'. ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']).'</div>'."\n"
                        .  zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT,'class="imgover"')
                        . '</div>';
$the_button .= $in_cart_button_html;
$display_button = ($advanced_stock_button = zen_addOnModules_call_function('advanced_stock', 'advanced_stock_get_buy_now_button', array($_GET['products_id'], $the_button))) != '' ? $advanced_stock_button : zen_get_buy_now_button($_GET['products_id'], $the_button);
?>

<?php if ($display_qty != '' or $display_button != '') { ?>
<?php echo $display_qty; ?>
<?php echo $display_button; ?>
<?php } // display qty and button ?>
<?php } // CUSTOMERS_APPROVAL == 3 ?>
<!--eof Add to Cart Box-->

<ul id="productInformation">
<?php
if($products_shipping_type){
    echo (($products_shipping_type) ? '<li>' . TEXT_PRODUCT_SHIPPING_TYPE . $products_shipping_type['name'] . sprintf(TEXT_PRODUCT_SHIPPING_TYPE_LINK, $products_shipping_type['url']) . '</li>' : '') . "\n"; 
}
?>
<li><a href="<?php echo  zen_href_link(FILENAME_ADDON, '&module=mt_pages&page=how_to_use', 'NONSSL'); ?>">ご利用ガイド</a></li>
</ul>

</div>
<!-- /productGuide -->

<br class="clearBoth" />

<!-- Product description -->
<div id="productDescription">
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

</div>
<!-- /Product description -->


</form>
</div>

<!--bof Product date added/available-->
<?php
  if ($products_date_available > date('Y-m-d H:i:s')) {
    if ($flag_show_product_info_date_available == 1) {
?>
  <p id="productDateAvailable" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)); ?></p>
<?php
    }
  } else {
    if ($flag_show_product_info_date_added == 1) {
?>
      <p id="productDateAdded" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)); ?></p>
<?php
    } // $flag_show_product_info_date_added
  }
?>
<!--eof Product date added/available -->
