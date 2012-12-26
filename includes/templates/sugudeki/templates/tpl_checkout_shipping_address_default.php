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
?>
<div class="centerColumn" id="checkoutShipAddressDefault">

<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"'); ?>
<h1 id="checkoutShipAddressDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>

<?php
  if ($process == false || $error == true) {
?>

<h2 class="headline" id="checkoutShipAddressDefaultAddress"><?php echo TITLE_SHIPPING_ADDRESS; ?></h2>

     <address><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br />'); ?></address>
    <p class="attention"><?php if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) echo TEXT_CREATE_NEW_SHIPPING_ADDRESS; ?></p>

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
    if ($addresses_count > 1) {
?>

<h2 class="headline"><?php echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?></h2>
<?php
      require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
     }
  }

?>

<div class="submit">
<p><?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CHANGE_ORAGE, BUTTON_CHANGE_ALT,'class="imgover"'); ?></p>
</div>


</div></form></div>
