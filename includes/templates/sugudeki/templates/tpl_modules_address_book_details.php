<?php
/**
 * Module Template
 *
 * Displays address-book details/selection
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_address_book_details.php 3777 2006-06-15 07:03:03Z drbyte $
 */

?>

<h2 class="headline"><?php echo TABLE_HEADING_NAME; ?></h2>
<table class="border fit account" id="name">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_NAME ; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_04 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME; ?></label><?php echo zen_draw_input_field('firstname', $entry->fields['entry_firstname'], 'id="firstname"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_05 ; ?></p>
<label><?php echo ENTRY_LAST_NAME ; ?></label><?php echo zen_draw_input_field('lastname', $entry->fields['entry_lastname'], 'id="lastname"'); ?>
</div>
</td>
</tr>
<?php if (FURIKANA_NESESSARY) { ?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_KANA; ?></label></th>
<td>
<div class="back">
<p class="first"><?php echo ENTRY_SAMPLE_06 ; ?></p>
<label><?php echo ENTRY_FIRST_NAME_KANA; ?></label><?php echo zen_draw_input_field('firstname_kana', $entry->fields['entry_firstname_kana'], 'id="firstname_kana"'); ?>
</div>
<div class="back">
<p class="last"><?php echo ENTRY_SAMPLE_07 ; ?></p>
<label><?php echo ENTRY_LAST_NAME_KANA ; ?></label><?php echo zen_draw_input_field('lastname_kana', $entry->fields['entry_lastname_kana'], 'id="lastname_kana"'); ?>
</div>
</td>
</tr>
<?php } ?>
</table>

<h2 class="headline"><?php echo TABLE_HEADING_ADDRESS_DETAILS; ?></h2>
<?php echo zen_draw_hidden_field('country', SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY);?>
<table class="border fit account" id="address">
<tr class="post">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_POST_CODE; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_08 ; ?></p><?php echo zen_draw_input_field('postcode', $entry->fields['entry_postcode'], 'id="postcode" '); ?><span><?php echo ENTRY_SAMPLE_00 ; ?></span></td>
</tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_STATE; ?></label></th>
<td><?php
    if ($process == true || $entry_state_has_zones == true ) {
      if ($entry_state_has_zones == true) {
        echo zen_draw_pull_down_menu('state', $zones_array, zen_convert_to_zone_name_m17n($zone_name), 'id="state"');
      } else {
        echo zen_draw_input_field('state', '', 'id="state"');
      }
    } else {
      echo zen_draw_input_field('state', zen_convert_to_zone_name_m17n(zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], $entry->fields['entry_state'])), 'id="state"');
    }
?>
</td>
</tr>
<?php
  }
?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_CITY; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_09 ; ?></p><?php echo zen_draw_input_field('city', $entry->fields['entry_city'], 'id="city"'); ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_STREET_ADDRESS; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_10 ; ?></p><?php echo zen_draw_input_field('street_address', $entry->fields['entry_street_address'], 'id="street-address"'); ?></td>
</tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
<tr>
<th scope="row"><?php echo ENTRY_SUBURB; ?></th>
<td><p><?php echo ENTRY_SAMPLE_11 ; ?></p><?php echo zen_draw_input_field('suburb', $entry->fields['entry_suburb'], 'id="suburb"') ; ?></td>
</tr>
<?php
  }
?>
</table>

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<h2 class="headline"><?php echo CATEGORY_COMPANY; ?></h2>
<table class="border fit account" id="company">
<tr>
<th scope="row"><?php echo ENTRY_COMPANY; ?></th>
<td><?php echo zen_draw_input_field('company', $entry->fields['entry_company'], 'id="company"') ; ?></td>
</tr>
</table>
<?php
  }
?>

<h2 class="headline"><?php echo TABLE_HEADING_PHONE_FAX_DETAILS; ?></h2>
<table class="border fit account" id="tel">
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_TELEPHONE_NUMBER; ?></label></th>
<td><p><?php echo ENTRY_SAMPLE_12 ; ?></p><?php echo zen_draw_input_field('telephone', $entry->fields['entry_telephone'], 'id="telephone"'); ?></td>
</tr>
<?php
  if (ACCOUNT_FAX_NUMBER == 'true') {
?>
<tr>
<th scope="row"><?php echo ENTRY_FAX_NUMBER; ?></th>
<td><p><?php echo ENTRY_SAMPLE_12 ; ?></p><?php echo zen_draw_input_field('fax', $entry->fields['entry_fax'], 'id="fax"'); ?></td>
</tr>
<?php
  }
?>
</table>

<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
    } else {
      $male = ($entry->fields['entry_gender'] == 'm') ? true : false;
    }
    $female = !$male;
?>
<h2 class="headline"><?php echo ENTRY_GENDER; ?></h2>
<table class="border fit account" id="birth">
<tr class="gender">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><?php echo ENTRY_GENDER ; ?></th>
<td><?php echo zen_draw_radio_field('gender', 'm', $male, 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label>' . zen_draw_radio_field('gender', 'f', $female, 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>'; ?></td>
</tr>
</table>
<?php
  }
?>


<p class="primary">
<?php
  if ((isset($_GET['edit']) && ($_SESSION['customer_default_address_id'] != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
?>
<?php echo zen_draw_checkbox_field('primary', 'on', false, 'id="primary"') . ' <label class="checkboxLabel" for="primary">' . SET_AS_PRIMARY . '</label>'; ?>
<?php
  }
?>
</p>

