<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_success_default.php 3799 2006-06-18 17:07:40Z ajeh $
 */
?>
<div class="centerColumn" id="checkoutSuccess">

<h1 id="checkoutSuccessHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<h2 class="headline"><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h2>

<?php if (DEFINE_CHECKOUT_SUCCESS_STATUS >= 1 and DEFINE_CHECKOUT_SUCCESS_STATUS <= 2) { ?>
<div id="checkoutSuccessMainContent" class="content">
<?php
/**
 * require the html_defined text for checkout success
 */
  require($define_page);
?>
</div>
<?php } ?>
<p id="checkoutSuccessOrderNumber"><?php echo TEXT_YOUR_ORDER_NUMBER .'<span>'. $zv_orders_id.'</span>'; ?></p>
<?php
if (IS_VISITORS_SESSION === true) {
?>
<p id="checkoutSuccessOrderLink"><?php echo TEXT_VISITORS_SEE_ORDERS;?></p>

<p id="checkoutSuccessInfoOrderLink" class="alert"><?php echo TEXT_INFO_VISITORS_SEE_ORDERS; ?></p>

<h2 class="headline"><?php echo TEXT_VISITOR_TO_ACCOUNT; ?></h2>

<div class="information"><?php echo TEXT_VISITOR_TO_ACCOUNT_INTRODUCTION; ?></div>

<div class="submit">
<?php echo '<a href="' . zen_href_link(FILENAME_ADDON, 'module=visitors/visitor_to_account', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT,'class="imgover"') . '</a>'; ?>
</div>



<?php
} else {
?>
<p id="checkoutSuccessOrderLink"><?php echo TEXT_SEE_ORDERS;?></p>
<?php
}
?>
<p id="checkoutSuccessContactLink"><?php echo TEXT_CONTACT_STORE_OWNER;?></p>



</div></div>