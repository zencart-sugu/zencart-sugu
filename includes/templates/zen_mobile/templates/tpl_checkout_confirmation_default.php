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
echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>
<div class="centerColumn" id="checkoutConfirmDefault">
<br>
<h1 id="checkoutConfirmDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

<div id="checkoutShipto" class="back">
<h2 id="checkoutConfirmDefaultBillingAddress"><?php echo "<br>".BOX_HEADING_COLORBOX.HEADING_BILLING_ADDRESS; ?></h2>
<br>
<?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?>
<br>
<?php echo '-><a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a><br>'; ?>
<?php
  $class =& $_SESSION['payment'];
?>
<?php
  if (is_array($payment_modules->modules)) {
    if ($confirmation = $payment_modules->confirmation()) {
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php echo $confirmation['title']; ?>
<?php
    }
?>
<div class="important">

<?php
      for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
?>
<div class="back"><?php echo $confirmation['fields'][$i]['title']; ?></div>
<div ><?php echo $confirmation['fields'][$i]['field']; ?></div>
<?php
     }
?>
      </div>
<?php
  }
?>

</div>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
  if ($_SESSION['sendto'] != false) {
?>
<div id="checkoutBillto" class="forward">
<h2 id="checkoutConfirmDefaultBillingAddress"><?php echo BOX_HEADING_COLORBOX.HEADING_DELIVERY_ADDRESS; ?></h2>
<br>
<?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?>

<div class="buttonRow forward"><?php echo '-><a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a><br>'; ?></div>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<h3 id="checkoutConfirmDefaultPayment"><?php echo BOX_HEADING_COLORBOX.HEADING_PAYMENT_METHOD; ?></h3> 
<h4 id="checkoutConfirmDefaultPaymentTitle"><?php echo $GLOBALS[$class]->title; ?></h4>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
    if ($order->info['shipping_method']) {
?>
<h3 id="checkoutConfirmDefaultShipment"><?php echo BOX_HEADING_COLORBOX.HEADING_SHIPPING_METHOD; ?></h3>
<h4 id="checkoutConfirmDefaultShipmentTitle"><?php echo $order->info['shipping_method']; ?></h4>

<?php
    }
?>
</div>
<?php
  }
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
// always show comments
//  if ($order->info['comments']) {
?>

<h2 id="checkoutConfirmDefaultHeadingComments"><?php echo BOX_HEADING_COLORBOX . HEADING_ORDER_COMMENTS; ?></h2>


<div><?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->info['comments'])); ?></div>
<div class="buttonRow forward"><?php echo  '-><a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>
<?php
//  }
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">

<h2 id="checkoutConfirmDefaultHeadingCart"><?php echo BOX_HEADING_COLORBOX.HEADING_PRODUCTS; ?></h2>

<br class="clearBoth" />
      <table border="0" width="100%" cellspacing="0" cellpadding="0" id="cartContentsDisplay">
        <tr class="cartTableHeading">
<?php
  // If there are tax groups, display the tax columns for price breakdown
  if (sizeof($order->info['tax_groups']) > 1) {
?>
          <th scope="col" id="ccTaxHeading"><?php echo HEADING_TAX; ?></th>
<?php
  }
?>
        </tr>
<?php // now loop thru all products to display quantity and price ?>
<?php for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $product['rowClass']; ?>">
          <td class="cartProductDisplay"><?php echo $order->products[$i]['name']; ?>
          x&nbsp;<?php echo $order->products[$i]['qty']; ?>
          <?php  echo $stock_check; ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul id="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br($order->products[$i]['attributes'][$j]['value']); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>

<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <td class="cartTotalDisplay">
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
        <td class="cartTotalDisplay">
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?>
        </td>
      </tr>
<?php  }  // end for loopthru all products ?>
      </table>
<div class="buttonRow forward"><?php echo '-><a href="' . zen_href_link(FILENAME_SHOPPING_CART) . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a>'; ?></div>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
?>
<div id="orderTotals"><?php $order_total_modules->output(); ?>
<br>
</div>
<?php
  }
?>

<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');

  if (is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"') ;?></div>
</form>

</div>
