<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping_adresss.<br />
 * Allows customer to change the shipping address.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_address_default.php 2857 2006-01-17 17:04:53Z birdbrain $
 */
echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>
<div class="centerColumn" id="checkoutShipAddressDefault">

<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"'); ?>
<h1 id="checkoutShipAddressDefaultHeading"><?php echo HEADING_TITLE; ?></h1><br>

<?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>

<?php
  if ($process == false || $error == true) {
?>

<h2 id="checkoutShipAddressDefaultAddress"><?php echo BOX_HEADING_COLORBOX . TITLE_SHIPPING_ADDRESS; ?></h2>
<br>
     <address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?></address>
<br>

<?php
    if ($addresses_count > 1) {
?>
<br>
<fieldset>
<legend><?php echo BOX_HEADING_COLORBOX . TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></legend><br>
<br>
<?php
      require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
     }
?>

    <div class="instructions"><?php if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) echo BOX_HEADING_COLORBOX .  TEXT_CREATE_NEW_SHIPPING_ADDRESS; ?></div>

<?php
     if ($addresses_count <= MAX_ADDRESS_BOOK_ENTRIES) {
?>
<?php
/**
 * require template to display new address form
 */
  require($template->get_template_dir('tpl_modules_checkout_new_address.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_new_address.php');
?>
<?php
    }
?>
<?php
  }
?>
</fieldset>

<br>
<div class="buttonRow forward"><?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CONTINUE, TEXT_CONTINUE_CHECKOUT_PROCEDURE); ?></div>

<?php
  if ($process == true) {
?>
  <div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  }
?>
</form>
</div>
