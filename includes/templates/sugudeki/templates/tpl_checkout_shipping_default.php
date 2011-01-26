<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping.<br />
 * Displays allowed shipping modules for selection by customer.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_default.php 3183 2006-03-14 07:58:59Z birdbrain $
 */
?>
<div class="centerColumn" id="checkoutShipping">

<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>

<h1 id="checkoutShippingHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<?php
  echo zen_addOnModules_get_block('checkout_step');
?>

<p class="attention"><?php echo FLOW_TEXT ; ?></p>

<h2 id="checkoutShippingHeadingAddress" class="headline"><?php echo TITLE_SHIPPING_ADDRESS; ?></h2>

<p><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?></p>

<address><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?>
<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHANGE_SHIPPING, BUTTON_CHANGE_SHIPPING_ALT,'class="imgover"') . '</a>'; ?></p>
</address>


<?php
  if (zen_count_shipping_modules() > 0) {
?>

<h2 class="headline" id="checkoutShippingHeadingMethod"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></h2>

<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>

<p><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></p>

<?php
    } elseif ($free_shipping == false) {
?>
<p><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></p>

<?php
    }
?>
<?php
    if ($free_shipping == true) {
?>
<div id="freeShip" class="important" ><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;<?php echo $quotes[$i]['icon']; ?></div>
<div id="defaultSelected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>

<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
?>

<?php
        if (isset($quotes[$i]['error'])) {
?>
      <div><?php echo $quotes[$i]['error']; ?></div>
<?php
        } else {
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
            $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);

            if ( ($checked == true) || ($n == 1 && $n2 == 1) ) {
              //echo '      <div id="defaultSelected" class="moduleRowSelected">' . "\n";
            //} else {
              //echo '      <div class="moduleRow">' . "\n";
            }
?>
<?php
            if ( ($n > 1) || ($n2 > 1) ) {
?>
<p class="methods"><?php echo $quotes[$i]['methods'][$j]['title']; ?>
<?php // echo "&nbsp;&nbsp;".$quotes[$i]['methods'][$j]['option']; ?></p>

<div class="methods">
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></div>
<?php
            } else {
?>
<div class="methods">
<div class="important forward"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></div>
<?php
            }
?>
<label for="ship-<?php echo $quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id']; ?>" class="checkboxLabel" >
<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id'].'"'); ?> 
<?php echo $quotes[$i]['module']; ?>&nbsp;<?php if (isset($quotes[$i]['icon']) && zen_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?>
</label>
</div>


<?php
            $radio_buttons++;
          }
        }
?>

<?php
      }
    }
?>

<?php
  }
?>

<?php
  // 配送日時
  if (MODULE_CALENDAR_STATUS == 'true') {
    echo $GLOBALS['calendar']->getBlock('block_desired_delivery_date',$current_page_base);
    echo $GLOBALS['calendar']->getBlock('block_desired_delivery_time',$current_page_base);
  }
?>

<h2 class="headline"><?php echo HEADING_COMMENTS; ?></h2>
<p><?php echo TABLE_HEADING_COMMENTS; ?></p>
<?php echo zen_draw_textarea_field('comments', '45', '3'); ?>


<div class="submit"><?php echo zen_image_submit(BUTTON_IMAGE_CHECKOUT_PAYMENT, BUTTON_CHECKOUT_PAYMENT_ALT,' class="imgover"'); ?></div>


</div></form></div>
