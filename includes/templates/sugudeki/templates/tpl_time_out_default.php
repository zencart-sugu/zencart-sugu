<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_time_out_default.php 2997 2006-02-09 05:08:20Z birdbrain $
 */
?>
<div class="centerColumn" id="timeoutDefault">
<?php
    if ($_SESSION['customer_id']) {
?>
<h1 id="timeoutDefaultHeading"><?php echo HEADING_TITLE_LOGGED_IN; ?></h1>
<div id="centerColumnBody">
<?php echo TEXT_INFORMATION_LOGGED_IN; ?>

<?php
  } else {
?>
<h1 id="timeoutDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">
<?php echo TEXT_INFORMATION; ?>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>

<h2 class="headline"><?php echo HEADING_RETURNING_CUSTOMER; ?></h2>

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


<p class="button"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT,'class="imgover"'); ?></p>

</div>

</form>


<?php
 }
 ?>
</div></div>