<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_confirmation.<br />
 * Displays final checkout details, cart, payment and shipping info details.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_confirmation_default.php 3306 2006-03-29 07:15:46Z drbyte $
 */
?>
<div class="centerColumn" id="checkoutConfirmDefault">

<h1 id="checkoutConfirmDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

<h2 class="headline" id="checkoutConfirmDefaultHeadingCart"><?php echo HEADING_PRODUCTS; ?></h2>

 <table width="100%" id="cartContentsDisplay" class="border">
     <tr class="tableHeading">
        <th scope="col" id="scProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
        <th scope="col" id="scUnitHeading"><?php echo TABLE_HEADING_PRICE; ?></th>
				<th scope="col" id="scQuantityHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <th scope="col" class="scTaxHeading"><span>
          <?php echo HEADING_TAX; ?></td>
<?php    }  // endif tax info display  ?>
        <th scope="col" id="scTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
     </tr>
<?php // now loop thru all products to display quantity and price ?>
<?php for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $product['rowClass']; ?>">
          <td class="cartProductDisplay">
<a href="<?php echo zen_href_link(zen_get_info_page($order->products[$i]['id']), 'products_id=' . $order->products[$i]['id']); ?>"><?php echo $order->products[$i]['name'];?></a>
          <?php  echo $order->products[$i]['stock_check']; ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul id="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' .
nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>
				
		<td class="cartUnitDisplay"><span><?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax']);?></span><?php echo TEXT_PRICE_TAX ; ?></td>
		<td class="cartQuantity"><?php echo $order->products[$i]['qty']; ?></td>
<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
    <td class="cartTax"><span>
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
    <td class="cartTotalDisplay"><span>
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?></span><?php echo TEXT_PRICE_TAX ; ?>
        </td>
      </tr>
<?php  }  // end for loopthru all products ?>
      </table>
 
<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
?>
<div id="orderTotals">
<table>
<?php $order_total_modules->output(); ?>
</table>
</div>

<?php
  }
?>

<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART) . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>

<?php
if (IS_VISITORS_SESSION === true) {
?>

<h2 class="headline" id="checkoutConfirmDefaultCustomerAddress"><?php echo HEADING_CUSTOMER_ADDRESS; ?></h2>

<address><?php echo zen_address_format($order->customer['format_id'], $order->customer, 1, ' ', '<br />') . '<br />' . ENTRY_EMAIL_ADDRESS . $order->customer['email_address']; ?>
<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON, 'module=visitors/visitor_edit', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</address>


<?php
}
?>

<?php
  if ($_SESSION['sendto'] != false) {
?>

<h2 class="headline" id="checkoutDefaultShippingAddress"><?php echo HEADING_DELIVERY_ADDRESS; ?></h2>


<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?>
<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</address>


<?php
    if ($order->info['shipping_method']) {
?>
<h2 class="headline"><?php echo HEADING_SHIPPING_METHOD; ?></h2>
<div class="area"><?php echo $order->info['shipping_method']; ?>

<?php
  // 配送情報
  if (MODULE_CALENDAR_STATUS == 'true') {
    echo $GLOBALS['calendar']->getBlock('block_delivery_info',$current_page_base);
  }
?>

<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</div>
<?php
    }
?>

<?php
  }
?>

<h2 class="headline" id="checkoutConfirmDefaultBillingAddress"><?php echo HEADING_BILLING_ADDRESS; ?></h2>
<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?>
<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</address>

<?php
  $class =& $_SESSION['payment'];
?>
<h2 class="headline"><?php echo HEADING_PAYMENT_METHOD; ?></h2> 
<div class="area"><?php echo $GLOBALS[$class]->title; ?>
<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>
<div class="important"><?php echo $confirmation['title']; ?></div>

<?php
    }
?>

<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
?>
<div class="creditDetail"><?php echo $confirmation['fields'][$i]['title']; ?></div>
<div class="creditDetail"><?php echo $confirmation['fields'][$i]['field']; ?></div>
<?php
     }
?>


<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</div>
<?php
  }
?>





<h2 class="headline" id="checkoutConfirmDefaultHeadingComments"><?php echo HEADING_COMMENTS; ?></h2>

<div class="area"><?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->info['comments'])); ?>
<p class="buttonRow"><?php echo  '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT,'class="imgover"') . '</a>'; ?></p>
</div>

<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>
<div class="submit"><?php echo zen_image_submit(BUTTON_IMAGE_CHECKOUT_SUCCESS, BUTTON_CHECKOUT_SUCCESS_ALT, 'name="btn_submit" id="btn_submit" class="imgover"') ;?></div>
</form>

</div></div>
