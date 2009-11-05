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
<div class="centerColumn" id="loginDefault">

<?php echo BOX_HEADING_COLORBOX. HEADING_TITLE; ?>
<br>
<br>

<?php

//print_r($_SESSION);
//$messageStack = $_SESSION['messages'];
//print_r($messageStack);
if(!empty($_SESSION['messages'])){
    if ($_SESSION['messages']->size('easy_login') > 0) echo $_SESSION['messages']->output('easy_login');
    unset($_SESSION['messages']);
}
?>
<?php echo HEADING_EASY_LOGIN;?>
<?php
//print_r($mobile);
if($mobile->isDoCoMo()){
    echo "<form action=./index.php?main_page=easy_login&guid=on&action=process method=post>";
    echo zen_draw_hidden_field('action', 'process');
}else{
    echo zen_draw_form('easy_login', zen_href_link(FILENAME_EASY_LOGIN, 'action=process', 'SSL'));
}
?>
<input type="submit" value="<?php echo BUTTON_EASY_LOGIN_ALT; ?>">
</form>
<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>

<?php
  if ($_SESSION['cart']->count_contents() > 0) {
?>
<div class="advisory"><?php echo TEXT_VISITORS_CART; ?></div>
<?php
  }
?>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
<fieldset>
<legend><?php echo HEADING_RETURNING_CUSTOMER; ?></legend><br/>

<label class="inputLabel" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '20') . ' id="login-email-address"'); ?>
<br class="clearBoth" />

<label class="inputLabel" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="login-password"'); ?>
<br class="clearBoth" />
</fieldset>

<input type="submit" value="<?php echo BUTTON_LOGIN_ALT; ?>">

<div class="buttonRow back important"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
</form>
<br class="clearBoth" />

<?php # echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>

<?php echo MOBILE_NEW_ACCOUNT; ?>
<?php echo '<a href="' . zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . MOBILE_NEW_ACCOUNT_ENTRY . '</a>'; ?>
</div>
