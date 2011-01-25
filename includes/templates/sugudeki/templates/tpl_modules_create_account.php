<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_create_account.php 3777 2006-06-15 07:03:03Z drbyte $
 */
?>

<?php if ($messageStack->size('create_account') > 0) echo $messageStack->output('create_account'); ?>

<h2 class="headline"><?php echo TABLE_HEADING_LOGIN_DETAILS; ?></h2>

<table class="border fit account" id="login">
<tr class="email">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_EMAIL_ADDRESS; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_01 ; ?></p><?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_PASSWORD; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_02 ; ?></p><?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_03 ; ?></p><?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm"'); ?></td>
</tr>
</table>

<h2 class="headline"><?php echo TABLE_HEADING_NAME; ?></h2>
<table class="border fit account" id="name">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_NAME ; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_04 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME; ?></label><?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_05 ; ?></p>
<label><?php echo ENTRY_LAST_NAME ; ?></label><?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname"'); ?>
</div>
</td>
</tr>
<?php if (FURIKANA_NESESSARY) { ?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_KANA; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_06 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME_KANA; ?></label><?php echo zen_draw_input_field('firstname_kana', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname_kana', '40') . ' id="firstname_kana"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_07 ; ?></p>
<label><?php echo ENTRY_LAST_NAME_KANA ; ?></label><?php echo zen_draw_input_field('lastname_kana', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname_kana', '40') . ' id="lastname_kana"'); ?>
</div>
</td>
</tr>
<?php } ?>
</table>

<h2 class="headline"><?php echo TABLE_HEADING_ADDRESS_DETAILS; ?></h2>
<?php echo zen_draw_hidden_field('country', SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY);?>
<table class="border fit account" id="address">
<tr class="post">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_POST_CODE; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_08 ; ?></p><?php 
	// Modified for Ajax住所+国名非表示 by zen-dera project 2007 BOF
	echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode"'); 
	// Modified for Ajax住所+国名非表示 by zen-dera project 2007 EOF
?><span><?php echo ENTRY_SAMPLE_00 ; ?></span></td>
</tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_STATE; ?></label></th>
<td><?php
    if ($process == true || $entry_state_has_zones == true ) {
      if ($entry_state_has_zones == true) {
        echo zen_draw_pull_down_menu('state', $zones_array, zen_convert_to_zone_name_m17n($zone_name) . ' id="state"');
      } else {
        echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state"');
      }
    } else {
      echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state"');
    };?>
</td>
</tr>
<?php
  }
?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_CITY; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_09 ; ?></p><?php echo zen_draw_input_field('city', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_STREET_ADDRESS; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_10 ; ?></p><?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address"') ; ?></td>
</tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
<tr>
<th scope="row"><?php echo ENTRY_SUBURB; ?></th>
<td><p><?php echo ENTRY_SAMPLE_11 ; ?></p><?php echo zen_draw_input_field('suburb', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb"'); ?></td>
</tr>
<?php
  }
?>
</table>

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<h2 class="headline"><?php echo CATEGORY_COMPANY; ?></h2>
<table class="border fit account" id="companyName">
<tr>
<th scope="row"><?php echo ENTRY_COMPANY; ?></th>
<td><?php echo zen_draw_input_field('company', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company"') ; ?></td>
</tr>
</table>
<?php
  }
?>

<h2 class="headline"><?php echo TABLE_HEADING_PHONE_FAX_DETAILS; ?></h2>
<table class="border fit account" id="tel">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><label><?php echo ENTRY_TELEPHONE_NUMBER; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_12 ; ?></p><?php echo zen_draw_input_field('telephone', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone"'); ?></td>
</tr>
<?php
  if (ACCOUNT_FAX_NUMBER == 'true') {
?>
<tr>
<th scope="row"><?php echo ENTRY_FAX_NUMBER; ?></th>
<td><p><?php echo ENTRY_SAMPLE_12 ; ?></p><?php echo zen_draw_input_field('fax', $account->fields['customers_fax'], 'id="fax"') ; ?></td>
</tr>
<?php
  }
?>
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
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><?php echo ENTRY_GENDER ; ?></th>
<td><?php echo zen_draw_radio_field('gender', 'm', '', 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' . zen_draw_radio_field('gender', 'f', '', 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>'; ?></td>
</tr>
<?php
  }
?>
<tr>
<?php
  if (ACCOUNT_DOB == 'true') {
?>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED2;?></span><?php echo ENTRY_DATE_OF_BIRTH; ?></th>
<td><p><?php echo ENTRY_SAMPLE_13 ; ?></p><?php echo zen_draw_input_field('dob','', 'id="dob"') ; ?></td>
</tr>
<?php
  }
?>
</table>
<?php
  }
?>

<?php
  if (DISPLAY_PRIVACY_CONDITIONS == 'true') {
?>
<fieldset id="privacyBox">
<div class="information"><?php echo TEXT_PRIVACY_CONDITIONS_DESCRIPTION;?></div>
<?php echo zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy"');?>
<label class="checkboxLabel" for="privacy"><?php echo TEXT_PRIVACY_CONDITIONS_CONFIRM;?></label>
</fieldset>
<?php
  }
?>