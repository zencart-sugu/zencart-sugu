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
<fieldset>

<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth" />
<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
    } else {
      $male = ($entry->fields['entry_gender'] == 'm') ? true : false;
    }
    $female = !$male;
?>

<?php echo zen_draw_radio_field('gender', 'm', $male, 'id="gender-male"') . '<label class="radioButtonLabel" for="gender-male">' . MALE . '</label><br>' . zen_draw_radio_field('gender', 'f', $female, 'id="gender-female"') . '<label class="radioButtonLabel" for="gender-female">' . FEMALE . '</label>' . (zen_not_null(ENTRY_GENDER_TEXT) ? '<span class="alert">' . ENTRY_GENDER_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<?php
  }
?>
<label class="inputLabel" for="firstname"><?php echo ENTRY_FIRST_NAME; ?></label><br>
<?php echo zen_draw_input_field('firstname', $entry->fields['entry_firstname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '20') . ' id="firstname"') . (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<?php if (FURIKANA_NESESSARY) { ?>
<label class="inputLabel" for="firstname_kana"><?php echo ENTRY_FIRST_NAME_KANA; ?></label><br>
<?php echo zen_draw_input_field('firstname_kana', $entry->fields['entry_firstname_kana'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname_kana', '20') . ' id="firstname_kana"') . (zen_not_null(ENTRY_FIRST_NAME_KANA_TEXT) ? '<span class="alert">' . ENTRY_FIRST_NAME_KANA_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php } ?>

<label class="inputLabel" for="lastname"><?php echo ENTRY_LAST_NAME; ?></label><br>
<?php echo zen_draw_input_field('lastname', $entry->fields['entry_lastname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '20') . ' id="lastname"') . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<?php if (FURIKANA_NESESSARY) { ?>
<label class="inputLabel" for="lastname_kana"><?php echo ENTRY_LAST_NAME_KANA; ?></label><br>
<?php echo zen_draw_input_field('lastname_kana', $entry->fields['entry_lastname_kana'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname_kana', '20') . ' id="lastname_kana"') . (zen_not_null(ENTRY_LAST_NAME_KANA_TEXT) ? '<span class="alert">' . ENTRY_LAST_NAME_KANA_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php } ?>

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
<label class="inputLabel" for="company"><?php echo ENTRY_COMPANY; ?></label><br>
<?php echo zen_draw_input_field('company', $entry->fields['entry_company'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '20') . ' id="company"') . (zen_not_null(ENTRY_COMPANY_TEXT) ? '<span class="alert">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php
  }
?>

<label class="inputLabel" for="country"><?php echo ENTRY_COUNTRY; ?></label><br>
<?php if ($process == true) $entry->fields['entry_country_id'] = (int)$_POST['country']; ?>
<?php echo zen_get_country_list('country', $entry->fields['entry_country_id'], 'id="country"') . (zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="postcode"><?php echo ENTRY_POST_CODE; ?></label><br>
<?php echo zen_draw_input_field('postcode', $entry->fields['entry_postcode'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '20') . ' id="postcode"') . (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<?php
  if (ACCOUNT_STATE == 'true') {
?>
<label class="inputLabel" for="state"><?php echo ENTRY_STATE; ?></label><br>

<?php
    if ($process == true || $entry_state_has_zones == true ) {
      if ($entry_state_has_zones == true) {
        echo zen_draw_pull_down_menu('state', $zones_array, $zone_name, 'id="state"');
      } else {
        echo zen_draw_input_field('state', zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], ''), zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '20') . ' id="state"');
      }
    } else {
      echo zen_draw_input_field('state', zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], ''), zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '20'), 'text');
    }

    if (zen_not_null(ENTRY_STATE_TEXT)) echo '<span class="alert">' . ENTRY_STATE_TEXT . '</span>';
?>
<br class="clearBoth" />
<?php
  }
?>

<label class="inputLabel" for="city"><?php echo ENTRY_CITY; ?></label><br>
<?php echo zen_draw_input_field('city', $entry->fields['entry_city'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '20') . ' id="city"') . (zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert">' . ENTRY_CITY_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="street-address"><?php echo ENTRY_STREET_ADDRESS; ?></label><br>
<?php echo zen_draw_input_field('street_address', $entry->fields['entry_street_address'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '20') . ' id="street-address"') . (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
<label class="inputLabel" for="suburb"><?php echo ENTRY_SUBURB; ?></label><br>
<?php echo zen_draw_input_field('suburb', $entry->fields['entry_suburb'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '20') . ' id="suburb"') . (zen_not_null(ENTRY_SUBURB_TEXT) ? '<span class="alert">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?>
<br class="clearBoth" />
<?php
  }
?>

<label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label><br>
<?php echo zen_draw_input_field('telephone', $entry->fields['entry_telephone'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '20') . ' id="telephone"') . (zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?>

<?php
  if (ACCOUNT_FAX_NUMBER == 'true') {
?>
<br class="clearBoth" />
<label class="inputLabel" for="fax"><?php echo ENTRY_FAX_NUMBER; ?></label><br>
<?php echo zen_draw_input_field('fax', $entry->fields['entry_fax'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '20') . ' id="fax"') . (zen_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="alert">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?>
<?php
  }
?>

<?php
  if ((isset($_GET['edit']) && ($_SESSION['customer_default_address_id'] != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
?>
<br><?php echo zen_draw_checkbox_field('primary', 'on', false, 'id="primary"') . '<label class="checkboxLabel" for="primary">' . SET_AS_PRIMARY . '</label>'; ?>
<?php
  }
?>
</fieldset>
