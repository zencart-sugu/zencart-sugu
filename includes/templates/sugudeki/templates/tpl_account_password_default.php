<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_password.<br />
 * Allows customer to change their password
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_password_default.php 2896 2006-01-26 19:10:56Z birdbrain $
 */
?>
<div class="centerColumn" id="accountPassword">

<h1><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">

<?php echo zen_draw_form('account_password', zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post', 'onsubmit="return check_form(account_password);"') . zen_draw_hidden_field('action', 'process'); ?>

<?php if ($messageStack->size('account_password') > 0) echo $messageStack->output('account_password'); ?>

<table class="border fit">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_PASSWORD_CURRENT ; ?></label></th>
<td><?php echo zen_draw_password_field('password_current','','id="password-current"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_PASSWORD_NEW ; ?></label></th>
<td><?php echo zen_draw_password_field('password_new','','id="password-new"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_PASSWORD_CONFIRMATION ; ?></label></th>
<td><?php echo zen_draw_password_field('password_confirmation','','id="password-confirm"'); ?></td>
</tr>
</table>


<div class="submit">
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_REGISTER , BUTTON_REGISTER_ALT,'class="imgover"'); ?></div>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT,'class="imgover"') . '</a>'; ?></div>
</div>

</form>
</div></div>
