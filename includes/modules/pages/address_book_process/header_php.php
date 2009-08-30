<?php
/**
 * Header code file for the Address Book Process page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3777 2006-06-15 07:03:03Z drbyte $
 */
if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

/**
 * Process deletes
 */
if (isset($_GET['action']) && ($_GET['action'] == 'deleteconfirm') && isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $sql = "DELETE FROM " . TABLE_ADDRESS_BOOK . "
          WHERE  address_book_id = :delete 
          AND    customers_id = :customersID";

  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
  $sql = $db->bindVars($sql, ':delete', $_GET['delete'], 'integer');
  $db->Execute($sql);

  $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');

  zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
}

/**
 * Process new/update actions
 */
$process = false;
if (isset($_POST['action']) && (($_POST['action'] == 'process') || ($_POST['action'] == 'update'))) {
  $process = true;
  $error = false;

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


  /**
	 * error checking when updating or adding an entry
	 */
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

      $messageStack->add('addressbook', ENTRY_GENDER_ERROR);
    }
  }

  if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
  }

  if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
  }

  // ->furikana
  if (FURIKANA_NESESSARY) {
    if (strlen($firstname_kana) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_FIRST_NAME_KANA_ERROR);
    }

    if (strlen($lastname_kana) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_LAST_NAME_KANA_ERROR);
    }
  }
  // <-furikana

  if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
  }

  if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
  }

  if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_CITY_ERROR);
  }

  if (!is_numeric($country)) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
  }

  if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
    $error = true;

    $messageStack->add('addressbook', ENTRY_TELEPHONE_NUMBER_ERROR);
  }

  if (ACCOUNT_STATE == 'true') {
    $zone_id = 0;
    $check_query = "SELECT count(*) AS total
                    FROM   " . TABLE_ZONES . "
                    WHERE  zone_country_id = :country";

    $check_query = $db->bindVars($check_query, ':country', $country, 'integer');
    $check = $db->Execute($check_query);

    $entry_state_has_zones = ($check->fields['total'] > 0);
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
      $zone_query = "SELECT DISTINCT zone_id
                     FROM   " . TABLE_ZONES . "
                     WHERE  zone_country_id = :country 
                     AND    (zone_name LIKE ':state%'
                     OR     zone_code LIKE '%:state%')";

      $zone_query = $db->bindVars($zone_query, ':state', $state, 'noquotestring');
      $zone_query = $db->bindVars($zone_query, ':country', $country, 'integer');
      $zone = $db->Execute($zone_query);

      if ($zone->RecordCount() == 1) {
        $zone_id = $zone->fields['zone_id'];
      } else {
        $error = true;

        $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
      }
    } else {
      if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_STATE_ERROR);
      }
    }
  }

  if ($error == false) {
    // ->furikana
    if (FURIKANA_NESESSARY) {
      $sql_data_array= array(array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
                             array('fieldName'=>'entry_lastname', 'value'=>$lastname, 'type'=>'string'),
                             array('fieldName'=>'entry_firstname_kana', 'value'=>$firstname_kana, 'type'=>'string'),
                             array('fieldName'=>'entry_lastname_kana', 'value'=>$lastname_kana, 'type'=>'string'),
                             array('fieldName'=>'entry_telephone', 'value'=>$telephone, 'type'=>'string'),
                             array('fieldName'=>'entry_fax', 'value'=>$fax, 'type'=>'string'),
                             array('fieldName'=>'entry_street_address', 'value'=>$street_address, 'type'=>'string'),
                             array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
                             array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
                             array('fieldName'=>'entry_country_id', 'value'=>$country, 'type'=>'integer'));
    }
    else {
      $sql_data_array= array(array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
                             array('fieldName'=>'entry_lastname', 'value'=>$lastname, 'type'=>'string'),
                             array('fieldName'=>'entry_telephone', 'value'=>$telephone, 'type'=>'string'),
                             array('fieldName'=>'entry_fax', 'value'=>$fax, 'type'=>'string'),
                             array('fieldName'=>'entry_street_address', 'value'=>$street_address, 'type'=>'string'),
                             array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
                             array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
                             array('fieldName'=>'entry_country_id', 'value'=>$country, 'type'=>'integer'));
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
        $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>'0', 'type'=>'integer');
        $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>$state, 'type'=>'string');
      }
    }

    if ($_POST['action'] == 'update') {
      $where_clause = "address_book_id = :edit and customers_id = :customersID";
      $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
      $where_clause = $db->bindVars($where_clause, ':edit', $_GET['edit'], 'integer');
      $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', $where_clause);

      // re-register session variables
      if ( (isset($_POST['primary']) && ($_POST['primary'] == 'on')) || ($_GET['edit'] == $_SESSION['customer_default_address_id']) ) {
        $_SESSION['customer_first_name'] = $firstname;
        $_SESSION['customer_country_id'] = $country;
        $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
        $_SESSION['customer_default_address_id'] = (int)$_GET['edit'];

        // ->furikana
        if (FURIKANA_NESESSARY) {
          $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
                                  array('fieldName'=>'customers_firstname_kana', 'value'=>$firstname_kana, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname_kana', 'value'=>$lastname_kana, 'type'=>'string'),
                                  array('fieldName'=>'customers_default_address_id', 'value'=>$_GET['edit'], 'type'=>'integer'));
        }
        else {
          $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
                                  array('fieldName'=>'customers_default_address_id', 'value'=>$_GET['edit'], 'type'=>'integer'));
        }
        // <-furikana

        if (ACCOUNT_GENDER == 'true') $sql_data_array[] = array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'enum:m|f');
        $where_clause = "customers_id = :customersID";
        $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
        $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
      }
    } else {

      $sql_data_array[] = array('fieldName'=>'customers_id', 'value'=>$_SESSION['customer_id'], 'type'=>'integer');
//      print_r($sql_data_array);
      $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $new_address_book_id = $db->Insert_ID();

      // reregister session variables
      if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) {
        $_SESSION['customer_first_name'] = $firstname;
        $_SESSION['customer_country_id'] = $country;
        $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
        if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $_SESSION['customer_default_address_id'] = $new_address_book_id;

        // ->furikana
        if (FURIKANA_NESESSARY) {
          $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
                                  array('fieldName'=>'customers_firstname_kana', 'value'=>$firstname_kana, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname_kana', 'value'=>$lastname_kana, 'type'=>'string'));
        }
        else {
          $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'));
        }
        // <-furikana

        if (ACCOUNT_GENDER == 'true') $sql_data_array[] = array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'string');
        if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $sql_data_array[] = array('fieldName'=>'customers_default_address_id', 'value'=>$new_address_book_id, 'type'=>'integer');

        $where_clause = "customers_id = :customersID";
        $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
        $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
      }
    }

    $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');

    zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }
}

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
  // ->furikana
  if (FURIKANA_NESESSARY) {
    $entry_query = "SELECT entry_gender, entry_company, entry_firstname, entry_lastname,
                           entry_firstname_kana, entry_lastname_kana,
                           entry_street_address, entry_suburb, entry_postcode, entry_city,
                           entry_state, entry_zone_id, entry_country_id
	  				     , entry_telephone, entry_fax
                    FROM   " . TABLE_ADDRESS_BOOK . "
                    WHERE  customers_id = :customersID
                    AND    address_book_id = :addressBookID";
  }
  else {
    $entry_query = "SELECT entry_gender, entry_company, entry_firstname, entry_lastname,
                           entry_street_address, entry_suburb, entry_postcode, entry_city,
                           entry_state, entry_zone_id, entry_country_id
	  				     , entry_telephone, entry_fax
                    FROM   " . TABLE_ADDRESS_BOOK . "
                    WHERE  customers_id = :customersID
                    AND    address_book_id = :addressBookID";
  }
  // <-furikana

  $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $entry_query = $db->bindVars($entry_query, ':addressBookID', $_GET['edit'], 'integer');
  $entry = $db->Execute($entry_query);

  if ($entry->RecordCount()<=0) {
    $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

    zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }
  if (!isset($zone_name) || (int)$zone_name == 0) $zone_name = zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], $entry->fields['entry_state']);

} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  if ($_GET['delete'] == $_SESSION['customer_default_address_id']) {
    $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');

    zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  } else {
    $check_query = "SELECT count(*) AS total
                    FROM " . TABLE_ADDRESS_BOOK . "
                    WHERE address_book_id = :addressBookID
                    AND customers_id = :customersID";

    $check_query = $db->bindVars($check_query, ':customersID', $_SESSION['customer_id'], 'integer');
    $check_query = $db->bindVars($check_query, ':addressBookID', $_GET['delete'], 'integer');
    $check = $db->Execute($check_query);

    if ($check->fields['total'] < 1) {
      $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

      zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }
} else {
  $entry_query = "SELECT entry_country_id
                  FROM   " . TABLE_ADDRESS_BOOK . " a, " . TABLE_CUSTOMERS . " c
                  WHERE  a.customers_id = :customersID
                  AND  a.customers_id = c.customers_id
                  AND    a.address_book_id = c.customers_default_address_id";

  $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $entry = $db->Execute($entry_query);
}
/**
 * determine pulldown menu contents if appropriate
 */
  if (ACCOUNT_STATE == 'true' && ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true') {
    $zone_id = 0;
    $check_query = "select count(*) as total
                      from " . TABLE_ZONES . "
                      where zone_country_id = '" . (int)$entry->fields['entry_country_id'] . "'";
    $check = $db->Execute($check_query);
    $entry_state_has_zones = ($check->fields['total'] > 0);
    if ($entry_state_has_zones == true) {
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

if (!isset($_GET['delete']) && !isset($_GET['edit'])) {
  if (zen_count_customer_address_book_entries() >= MAX_ADDRESS_BOOK_ENTRIES) {
    $messageStack->add_session('addressbook', ERROR_ADDRESS_BOOK_FULL);
    zen_redirect(zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }
}

$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2, zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
  $breadcrumb->add(NAVBAR_TITLE_MODIFY_ENTRY);
} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $breadcrumb->add(NAVBAR_TITLE_DELETE_ENTRY);
} else {
  $breadcrumb->add(NAVBAR_TITLE_ADD_ENTRY);
}
?>