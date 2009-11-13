<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.<br />
 * Displays shopping-cart contents
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart_default.php 3455 2006-04-18 04:44:25Z drbyte $
 */
?>
<div class="centerColumn" id="shoppingCartDefault">
<?php
  if ($flagHasCartContents) {
?>



<h1 id="cartDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>

<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product'), 'post', 'onsubmit="return validateQuantity()"'); ?>
<div id="cartInstructionsDisplay" class="content"><?php echo TEXT_INFORMATION; ?></div>

<?php  if ($flagAnyOutOfStock) { ?>

<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>

<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>

<?php    } else { ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>

<?php    } //endif STOCK_ALLOW_CHECKOUT ?>
<?php  } //endif flagAnyOutOfStock ?>
<?php if (MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS == 'true'): ?>
<?php if ($flagAnySendForProduct): ?>
<div class="messageStackError"><?php echo advanced_stock_get_sendfor_message(); ?></div>
<?php endif; ?>
<?php endif; ?>
<table width="100%" id="cartContentsDisplay" class="border">
     <tr class="tableHeading">
        <th scope="col" id="scProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
        <th scope="col" id="scUnitHeading"><?php echo TABLE_HEADING_PRICE; ?></th>
				<th scope="col" id="scQuantityHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
        <th scope="col" id="scTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
        <th scope="col" id="scRemoveHeading"><?php echo TABLE_HEADING_DELETE ; ?></th>
     </tr>
         <!-- Loop through all products /-->
<?php
  foreach ($productArray as $product) {
?>
     <tr class="<?php echo $product['rowClass']; ?>">
       <td class="cartProductDisplay">
<a href="<?php echo $product['linkProductsName']; ?>"><?php echo $product['productsImage']; ?>
<?php echo $product['productsName'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>'; ?></a>
<br class="clearBoth" />


<?php
  echo $product['attributeHiddenField'];
  if (isset($product['attributes']) && is_array($product['attributes'])) {
  echo '<div id="cartAttribsList">';
  echo '<ul>';
    reset($product['attributes']);
    foreach ($product['attributes'] as $option => $value) {
?>

<li><?php echo $value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']); ?></li>

<?php
    }
  echo '</ul>';
  echo '</div>';
  }
?>
       </td>
       <td class="cartUnitDisplay"><span><?php echo $product['productsPriceEach']; ?></span><?php echo TEXT_PRICE_TAX ; ?></td>
       <td class="cartQuantity">
<?php
  if ($product['flagShowFixedQuantity']) {
    echo $product['showFixedQuantityAmount'] . '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
  } else {
    echo $product['quantityField'] . '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span>' . $product['showMinUnits'];
  }
?>
<?php
  if ($product['buttonUpdate'] == '' || $product['flagShowFixedQuantity']) {
    echo '' ;
  } else {
    echo '<span class="update">'.$product['buttonUpdate'].'</span>';
  }
?>
       </td>
       <td class="cartTotalDisplay"><span><?php echo $product['productsPrice']; ?></span><?php echo TEXT_PRICE_TAX ; ?></td>
       <td class="cartRemoveItemDisplay">
<?php
  if ($product['buttonDelete']) {
?>
           <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>"><?php echo zen_image_button(BUTTON_IMAGE_SMALL_DELETE, BUTTON_SMALL_DELETE_ALT,'class="imgover"'); ?></a>
<?php
  }
?>
</td>
     </tr>
<?php
  } // end foreach ($productArray as $product)
?>
       <!-- Finished loop through all products /-->
      </table>

<div id="cartSubTotal">
<?php
// show update cart button
  if (SHOW_SHOPPING_CART_UPDATE == 2 or SHOW_SHOPPING_CART_UPDATE == 3) {
?>
<p class="back"><?php echo CART_SHIPPING_METHOD_RECALCULATE_TXT ; ?></p>
<p class="back"><?php echo zen_image_submit(ICON_IMAGE_LUMP_UPDATE, ICON_LUMP_UPDATE_ALT,'class="imgover"'); ?></p>
<?php
  } else { // don't show update button below cart
?>
<?php
  } // show checkout button
?>

<p class="forward"><span><?php echo SUB_TITLE_TOTAL; ?> <?php echo $cartShowTotal; ?></span><?php echo TEXT_PRICE_TAX ; ?></p>
</div>

<br class="clearBoth" />
<!-- shopping cart buttons-->
<div id="shoppingcart-buttons">
<p class="forward"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHECKOUT, BUTTON_CHECKOUT_ALT,'class="imgover"') . '</a>'; ?></p>

<p class="back"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE_SHOPPING, BUTTON_CONTINUE_SHOPPING_ALT,'class="imgover"') . '</a>'; ?></p>
</div>
<!-- /shopping cart buttons-->
</form>

<?php
  } else {
?>
<h1 id="cartDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">
<p id="cartEmptyText"><?php echo TEXT_CART_EMPTY; ?></p>
<?php
  }
?>

</div></div>
