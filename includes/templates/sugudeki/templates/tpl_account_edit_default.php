<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * View or change Customer Account Information
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_edit_default.php 3692 2006-06-02 17:15:15Z drbyte $
 * @copyright Portions Copyright 2003 osCommerce
 */
?>
<div class="centerColumn" id="accountEditDefault">
<h1 id="accountEditDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">

<?php echo zen_draw_form('account_edit', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onsubmit="return check_form(account_edit);"') . zen_draw_hidden_field('action', 'process'); ?>

<?php if ($messageStack->size('account_edit') > 0) echo $messageStack->output('account_edit'); ?>

<h2 class="headline"><?php echo TABLE_HEADING_LOGIN_DETAILS; ?></h2>
<table class="border fit account" id="login">
<tr class="email">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_EMAIL_ADDRESS; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_01 ; ?></p><?php echo zen_draw_input_field('email_address', $account->fields['customers_email_address'], 'id="email-address"'); ?></td>
</tr>
</table>

<h2 class="headline"><?php echo TABLE_HEADING_NAME; ?></h2>
<table class="border fit account" id="name">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_NAME ; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_04 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME; ?></label><?php echo zen_draw_input_field('firstname', $account->fields['customers_firstname'], 'id="firstname"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_05 ; ?></p>
<label><?php echo ENTRY_LAST_NAME ; ?></label><?php echo zen_draw_input_field('lastname', $account->fields['customers_lastname'], 'id="lastname"'); ?>
</div>
</td>
</tr>
<?php if (FURIKANA_NESESSARY) { ?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_KANA; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_06 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME_KANA; ?></label><?php echo zen_draw_input_field('firstname_kana', $account->fields['customers_firstname_kana'], 'id="firstname_kana"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_07 ; ?></p>
<label><?php echo ENTRY_LAST_NAME_KANA ; ?></label><?php echo zen_draw_input_field('lastname_kana', $account->fields['customers_lastname_kana'], 'id="lastname_kana"'); ?>
</div>
</td>
</tr>
<?php } ?>
</table>

<?php
  if ((ACCOUNT_GENDER == 'true')||(ACCOUNT_DOB == 'true')) {
?>
<h2 class="headline"><?php echo TABLE_HEADING_DATE_OF_BIRTH; ?></h2>
<table class="border fit account" id="birth">
<?php
  if (ACCOUNT_GENDER == 'true') {
?>
<tr class="gender">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><?php echo ENTRY_GENDER ; ?></th>
<td><?php echo zen_draw_radio_field('gender', 'm', $male, 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' . zen_draw_radio_field('gender', 'f', $female, 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>'; ?></td>
</tr>
<?php
  }
?>
<tr>
<?php
  if (ACCOUNT_DOB == 'true') {
?>
<th scope="row"><?php echo ENTRY_DATE_OF_BIRTH; ?></th>
<td><p><?php echo ENTRY_SAMPLE_13 ; ?></p><?php echo zen_draw_input_field('dob', zen_date_short($account->fields['customers_dob'], ACCOUNT_EDIT_DATE_FORMAT), 'id="dob"'); ?></td>
</tr>
<?php
  }
?>
</table>
<?php
  }
?>

<div class="submit">
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_REGISTER , BUTTON_REGISTER_ALT,'class="imgover"'); ?></div>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK , BUTTON_BACK_ALT,'class="imgover"') . '</a>'; ?></div>
</div>

</form>
</div></div>
