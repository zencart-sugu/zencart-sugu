<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_payment.<br />
 * Displays the allowed payment modules, for selection by customer.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_payment_default.php 3183 2006-03-14 07:58:59Z birdbrain $
 */
?>
<?php echo $payment_modules->javascript_validation(); ?>
<div class="centerColumn" id="checkoutPayment">
<?php echo zen_draw_form('checkout_payment', zen_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post', 'onsubmit="return check_form();"'); ?>

<h1 id="checkoutPaymentHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<p class="attention"><?php echo FLOW_TEXT ; ?></p>

<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>
<?php if ($messageStack->size('checkout_payment') > 0) echo $messageStack->output('checkout_payment'); ?>


<h2 class="headline" id="checkoutPaymentHeadingAddress"><?php echo TITLE_BILLING_ADDRESS; ?></h2>

<p class="floatingBox important"><?php echo TEXT_SELECTED_BILLING_DESTINATION; ?></p>


<address><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br />'); ?>
<p class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHANGE_ADDRESS, BUTTON_CHANGE_ADDRESS_ALT,'class="imgover"') . '</a>'; ?></p>
</address>



<?php
  $selection =  $order_total_modules->credit_selection();
  if (sizeof($selection)>0) {
    for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
      if ($_GET['credit_class_error_code'] == $selection[$i]['id']) {
?>
<div class="messageStackError"><?php echo zen_output_string_protected($_GET['credit_class_error']); ?></div>

<?php
      }
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>

<h2 class="headline"><?php echo $selection[$i]['module']; ?></h2>
<?php
        if (IS_VISITORS_SESSION === true) {
?>
<div class="alert"><?php echo sprintf(TEXT_INFO_VISITORS_CREDIT_SELECTION, $selection[$i]['module']); ?></div>
<p class="important"><?php echo TEXT_INFO_VISITORS_CREATE_ACCOUNT; ?></p>
<?php
	} else {
?>
<?php echo $selection[$i]['redeem_instructions']; ?>
<div class="gvBal larger"><?php echo $selection[$i]['checkbox']; ?></div>
<p><label class="inputLabel"<?php echo ($selection[$i]['fields'][$j]['tag']) ? ' for="'.$selection[$i]['fields'][$j]['tag'].'"': ''; ?>><?php echo $selection[$i]['fields'][$j]['title']; ?></label>
<?php echo $selection[$i]['fields'][$j]['field']; ?></p>
<?php
        }
?>

<?php
      }
    }
?>

<?php 
    } 
?>

<h2 class="headline"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></h2>


<?php
  if (SHOW_ACCEPTED_CREDIT_CARDS != '0') {
?>

<?php
    if (SHOW_ACCEPTED_CREDIT_CARDS == '1') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();
    }
    if (SHOW_ACCEPTED_CREDIT_CARDS == '2') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled('IMAGE_');
    }
?>
<br class="clearBoth" />
<?php } ?>

<?php
  $selection = $payment_modules->selection();

  if (sizeof($selection) > 1) {
?>
<p class="important"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></p>
<?php
  } else {
?>
<p class="important"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></p>

<?php
  }
?>

<?php
  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>

<div class="payment">
<?php
    if (sizeof($selection) > 1) {
 ?>
<?php echo zen_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $_SESSION['payment'] ? true : false), 'id="pmt-'.$selection[$i]['id'].'"'); ?>
<?php
    } else {
?>
<?php echo zen_draw_hidden_field('payment', $selection[$i]['id']); ?>
<?php
    }
?>
<label for="pmt-<?php echo $selection[$i]['id']; ?>" class="radioButtonLabel"><?php echo $selection[$i]['module']; ?></label>

<?php
    if (MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod') {
?>
<div class="alert"><?php echo TEXT_INFO_COD_FEES; ?></div>
<?php
    } else {
      // echo 'WRONG ' . $selection[$i]['id'];
?>
<?php
    }
?>
</div>

<?php
    if (isset($selection[$i]['error'])) {
?>
    <div><?php echo $selection[$i]['error']; ?></div>

<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>

<div class="ccinfo">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
<label <?php echo (isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : ''); ?>class="inputLabelPayment"><?php echo $selection[$i]['fields'][$j]['title']; ?></label><?php echo $selection[$i]['fields'][$j]['field']; ?>
<br class="clearBoth" />
<?php
      }
?>
</div>
<?php
    }
    $radio_buttons++;
?>
<?php
  }
?>


<h2 class="headline"><?php echo HEADING_COMMENTS; ?></h2>
<p><?php echo TABLE_HEADING_COMMENTS; ?></p>
<?php echo zen_draw_textarea_field('comments', '45', '3'); ?>

<div class="submit"><?php echo zen_image_submit(BUTTON_IMAGE_CHECKOUT_CONFIRM, BUTTON_CHECKOUT_CONFIRM_ALT, ' class="imgover" onclick="submitFunction('.zen_user_has_gv_account($_SESSION['customer_id']).','.$order->info['total'].')"'); ?></div>


</div></form></div>