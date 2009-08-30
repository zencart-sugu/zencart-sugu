<?php
/**
 * checkout_new_address.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_new_address.php 3777 2006-06-15 07:03:03Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * determine pulldown menu contents if appropriate
 */
  $entry_query = "SELECT entry_country_id, entry_zone_id, entry_state
                  FROM   " . TABLE_ADDRESS_BOOK . " a, " . TABLE_CUSTOMERS . " c
                  WHERE  a.customers_id = :customersID
                  AND  a.customers_id = c.customers_id
                  AND    a.address_book_id = c.customers_default_address_id";
  $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $entry = $db->Execute($entry_query);
  $country = $entry->fields['entry_country_id'];
  if (ACCOUNT_STATE == 'true'){
    $zone_id = 0;
    $check_query = "SELECT count(*) AS total
                      FROM " . TABLE_ZONES . "
                      WHERE zone_country_id = :zoneCountryID";
    $check_query = $db->bindVars($check_query, ':zoneCountryID', $country, 'integer');
    $check = $db->Execute($check_query);
    $entry_state_has_zones = ($check->fields['total'] > 0);
    if ($entry_state_has_zones == true && ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true') {
      $zones_array = array();
      $zones_array[] = array('id' => PULL_DOWN_ALL, 'text' => PULL_DOWN_ALL);
      $zones_values = $db->Execute("select zone_name
                                   from " . TABLE_ZONES . "
                                   where zone_country_id = '" . (int)$entry->fields['entry_country_id'] . "'
                                   order by zone_id");
      while (!$zones_values->EOF) {
        $zones_array[] = array('id' => $zones_values->fields['zone_name'], 'text' => $zones_values->fields['zone_name']);
        $zones_values->MoveNext();
      }
    }
  }


$error = false;
$process = false;
if (isset($_POST['action']) && ($_POST['action'] == 'submit')) {
  // process a new address
  if (zen_not_null($_POST['firstname']) && zen_not_null($_POST['lastname']) && zen_not_null($_POST['street_address']) 
     ) {
    $process = true;
    if (ACCOUNT_GENDER == 'true') $gender = zen_db_prepare_input($_POST['gender']);
    if (ACCOUNT_COMPANY == 'true') $company = zen_db_prepare_input($_POST['company']);
    $firstname = zen_db_prepare_input($_POST['firstname']);
    $lastname = zen_db_prepare_input($_POST['lastname']);
    // ->furikana
    if (FURIKANA_NESESSARY) {
      $firstname_kana = zen_db_prepare_input($_POST['firstname_kana']);
      $lastname_kana = zen_db_prepare_input($_POST['lastname_kana']);
    }
    // <-furikana
    $street_address = zen_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = zen_db_prepare_input($_POST['suburb']);
    $postcode = zen_db_prepare_input($_POST['postcode']);
    $city = zen_db_prepare_input($_POST['city']);
    $country = zen_db_prepare_input($_POST['country']);
    if (ACCOUNT_STATE == 'true') {
      if (isset($_POST['zone_id'])) {
        $zone_id = zen_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
      $state = zen_db_prepare_input($_POST['state']);
    }
    $telephone = zen_db_prepare_input($_POST['telephone']);
    $fax = zen_db_prepare_input($_POST['fax']);

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_LAST_NAME_ERROR);
    }

    // ->furikana
    if (FURIKANA_NESESSARY) {
      if (strlen($firstname_kana) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_FIRST_NAME_KANA_ERROR);
      }

      if (strlen($lastname_kana) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('checkout_address', ENTRY_LAST_NAME_KANA_ERROR);
      }
    }
    // <-furikana

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_CITY_ERROR);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_array[] = array('id' => PULL_DOWN_ALL, 'text' => PULL_DOWN_ALL);
        $zones_values = $db->Execute("select zone_name
                                     from " . TABLE_ZONES . "
                                     where zone_country_id = '" . (int)$country . "'
                                     order by zone_id");

        while (!$zones_values->EOF) {
          $zones_array[] = array('id' => $zones_values->fields['zone_name'], 'text' => $zones_values->fields['zone_name']);
          $zones_values->MoveNext();
        }
        $zone_query = "SELECT distinct zone_id
                       FROM " . TABLE_ZONES . "
                       WHERE zone_country_id = :zoneCountryID
                       AND (zone_name like ':zone'
                       OR zone_code like ':zone')";

        $zone_query = $db->bindVars($zone_query, ':zoneCountryID', $country, 'integer');
        $zone_query = $db->bindVars($zone_query, ':zone', $state, 'noquotestring');
        $zone = $db->Execute($zone_query);
        if ($zone->RecordCount() == 1) {
          $zone_id = $zone->fields['zone_id'];
        } else {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('checkout_address', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_POST_CODE_ERROR);
    }

    if ( (is_numeric($country) == false) || ($country < 1) ) {
      $error = true;

      $messageStack->add('checkout_address', ENTRY_COUNTRY_ERROR);
    }

    if ($error == false) {
      // ->furikana
      if (FURIKANA_NESESSARY) {
        $sql_data_array = array(array('fieldName'=>'customers_id', 'value'=>$_SESSION['customer_id'], 'type'=>'integer'),
                                array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
                                array('fieldName'=>'entry_lastname','value'=>$lastname, 'type'=>'string'),
                                array('fieldName'=>'entry_firstname_kana', 'value'=>$firstname_kana, 'type'=>'string'),
                                array('fieldName'=>'entry_lastname_kana','value'=>$lastname_kana, 'type'=>'string'),
                                array('fieldName'=>'entry_telephone', 'value'=>$telephone, 'type'=>'string'),
                                array('fieldName'=>'entry_fax', 'value'=>$fax, 'type'=>'string'),
                                array('fieldName'=>'entry_street_address','value'=>$street_address, 'type'=>'string'),
                                array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
                                array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
                                array('fieldName'=>'entry_country_id', 'value'=>$country, 'type'=>'integer')
        );
      }
      else {
        $sql_data_array = array(array('fieldName'=>'customers_id', 'value'=>$_SESSION['customer_id'], 'type'=>'integer'),
                                array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
                                array('fieldName'=>'entry_lastname','value'=>$lastname, 'type'=>'string'),
                                array('fieldName'=>'entry_telephone', 'value'=>$telephone, 'type'=>'string'),
                                array('fieldName'=>'entry_fax', 'value'=>$fax, 'type'=>'string'),
                                array('fieldName'=>'entry_street_address','value'=>$street_address, 'type'=>'string'),
                                array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
                                array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
                                array('fieldName'=>'entry_country_id', 'value'=>$country, 'type'=>'integer')
        );
      }
      // <-furikana

      if (ACCOUNT_GENDER == 'true') $sql_data_array[] = array('fieldName'=>'entry_gender', 'value'=>$gender, 'type'=>'enum:m|f');
      if (ACCOUNT_COMPANY == 'true') $sql_data_array[] = array('fieldName'=>'entry_company', 'value'=>$company, 'type'=>'string');
      if (ACCOUNT_SUBURB == 'true') $sql_data_array[] = array('fieldName'=>'entry_suburb', 'value'=>$suburb, 'type'=>'string');
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>$zone_id, 'type'=>'integer');
          $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>'', 'type'=>'string');
        } else {
          $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>0, 'type'=>'integer');
          $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>$state, 'type'=>'string');
        }
      }
      $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array);
      switch($addressType) {
        case 'billto':
        $_SESSION['billto'] = $db->Insert_ID();
        $_SESSION['payment'] = '';
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
        break;
        case 'shipto':
        $_SESSION['sendto'] = $db->Insert_ID();
        $_SESSION['shipping'] = '';
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
        break;
      }
    }
  } elseif (isset($_POST['address'])) {
    switch($addressType) {
      case 'billto':
      $reset_payment = false;
      if ($_SESSION['billto']) {
        if ($_SESSION['billto'] != $_POST['address']) {
          if ($_SESSION['payment']) {
            $reset_payment = true;
          }
        }
      }
      $_SESSION['billto'] = $_POST['address'];

      $check_address_query = "SELECT count(*) AS total
                              FROM " . TABLE_ADDRESS_BOOK . "
                              WHERE customers_id = :customersID
                              AND address_book_id = :addressBookID";

      $check_address_query = $db->bindVars($check_address_query, ':customersID', $_SESSION['customer_id'], 'integer');
      $check_address_query = $db->bindVars($check_address_query, ':addressBookID', $_SESSION['billto'], 'integer');
      $check_address = $db->Execute($check_address_query);

      if ($check_address->fields['total'] == '1') {
        if ($reset_payment == true) $_SESSION['payment'] = '';
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
      } else {
        $_SESSION['billto'] = '';
      }
      // no addresses to select from - customer decided to keep the current assigned address
      break;
      case 'shipto':
      $reset_shipping = false;
      if ($_SESSION['sendto']) {
        if ($_SESSION['sendto'] != $_POST['address']) {
          if ($_SESSION['shipping']) {
            $reset_shipping = true;
          }
        }
      }
     $_SESSION['sendto'] = $_POST['address'];
      $check_address_query = "SELECT count(*) AS total
                              FROM " . TABLE_ADDRESS_BOOK . "
                              WHERE customers_id = :customersID
                              AND address_book_id = :addressBookID";

      $check_address_query = $db->bindVars($check_address_query, ':customersID', $_SESSION['customer_id'], 'integer');
      $check_address_query = $db->bindVars($check_address_query, ':addressBookID', $_SESSION['sendto'], 'integer');
      $check_address = $db->Execute($check_address_query);
      if ($check_address->fields['total'] == '1') {
        if ($reset_shipping == true) $_SESSION['shipping'] = '';
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      } else {
        $_SESSION['sendto'] = '';
      }
      break;
    }
  } else {
    switch($addressType) {
      case 'billto':
      $_SESSION['billto'] = $_SESSION['customer_default_address_id'];
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));
      break;
      case 'shipto':
      $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
      break;
    }
  }
}
?>