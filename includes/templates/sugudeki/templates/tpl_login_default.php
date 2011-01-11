<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_default.php 2834 2006-01-11 22:16:37Z birdbrain $
 */
?>

<h1 id="loginDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

</div>

<!-- mainBody -->
<div id="mainBody">

<div class="new">
<h2 class="transparent"><?php echo HEADING_NEW_CUSTOMER ; ?></h2>
<div id="visitorBox" class="box">
<?php echo TEXT_NEW_CUSTOMER_INTRODUCTION ; ?>

<div id="visitorBoxButtons">

<?php
  require_once('includes/classes/order.php');
  $order = new order();
  if (count($order->products)) {
$bt = "back";	
}else{
$bt = "submit";
}
?>

<p class="<?php echo $bt ; ?>"><?php echo '<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT,'class="imgover"') . '</a>'; ?></p>

<?php
  if (count($order->products)) {
?>
<p class="forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDON, 'module=visitors/create_visitor', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_VISITOR, BUTTON_VISITOR_ALT,'class="imgover"') . '</a>'; ?></p>
<?php
}
?>
</div>
</div>
</div>

<div class="returning">
<h2 class="transparent"><?php echo HEADING_RETURNING_CUSTOMER; ?></h2>

<div id="loginBox" class="box">
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>

<p class="attention"><?php echo TEXT_RETURNING_CUSTOMER ; ?></p>

<div id="loginBoxBody">
<table>
<tr class="email">
<th scope="row"><?php echo ENTRY_EMAIL_ADDRESS; ?></th>
<td><?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address"'); ?></td>
</tr>
<tr>
<th scope="row"><?php echo ENTRY_PASSWORD; ?></th>
<td><?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '40') . ' id="login-password"'); ?></td>
</tr>
<tr>
<th scope="row">&nbsp;</th>
<td><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
</tr>
</table>


<p class="submit"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT,'class="imgover"'); ?></p>

</div>

</form>
</div>
</div>

</div>
<!-- /mainBody -->
