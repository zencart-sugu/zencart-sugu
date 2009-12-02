<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   New class to handle all the tasks    //
//  related to the data of the customer.                //
//  (i.e. addresses, passwords, personal info, store    //
//  admin feedback)                                     //
//////////////////////////////////////////////////////////
// $Id: customer.php 25 2006-02-03 18:55:56Z BlindSide $
*/

/*
CUSTOMER class features:

- Manage private admin notes (add/edit/delete)
- Assigned Orders array (ID only)
- Change password
- Change personal info
- Newsletter preferences
- Manage address book entries
        > add/edit/delete
        > ignore store-wide address limit
- Build customer stats
        > Products purchased
        > # orders
        > Shipping Destinations
        > Billing Destinations
- Averages
        > Total spent
        > Quantity
        > # products
        > Orders per month/year
*/

class customer {
  var $cID, $profile, $address, $admin_notes, $admin_note_count, $karma;
  var $info, $totals, $average, $address;
  global $db;

  function customer($cID) {
    $this->cID = (int)$cID;
    $data = $db->Execute("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . $this->cID . "'");
    // do stuff here
  }


  // build array of any existing private notes about the customer, or return false
  function get_admin_notes() {
    $this->admin_notes = array();

    $notes_query = $db->Execute("select * from " . TABLE_CUSTOMERS_ADMIN_NOTES . " where customers_id = '" . $this->cID . "'");
    if ($notes_query->RecordCount() > 0) {
      while (!$notes_query->EOF) {
        //gather info about the admin author
        $admin_data = $db->Execute("select admin_name, admin_email from " . TABLE_ADMIN . " where admin_id = '" . $notes_query->fields['admin_id'] . "'");

        $this->admin_notes[] = array('date' => $notes_query->fields['date_added'],
                                     'name' => $admin_data->fields['admin_name'],
                                     'email' => $admin_data->fields['admin_email'],
                                     'notes' => $notes_query->fields['admin_notes'],
                                     'karma' => $notes_query->fields['karma']);

        $this->karma += $notes_query->fields['karma'];
        if (zen_not_null($notes_query->fields['admin_notes'])) $this->admin_note_count++;
        $notes_query->MoveNext();
      }
    }
    else {
      $this->admin_notes = false;
    }
  }

}  // END class customer

  if (zen_not_null($action)) {
    switch ($action) {
      case 'status':
        if ($_GET['current'] == CUSTOMERS_APPROVAL_AUTHORIZATION) {
          $sql = "update " . TABLE_CUSTOMERS . " set customers_authorization=0 where customers_id='" . $_GET['cID'] . "'";
        } else {
          $sql = "update " . TABLE_CUSTOMERS . " set customers_authorization='" . CUSTOMERS_APPROVAL_AUTHORIZATION . "' where customers_id='" . $_GET['cID'] . "'";
        }
        $db->Execute($sql);
        $action = '';
        zen_redirect(zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $_GET['cID'] . '&page=' . $_GET['page'], 'NONSSL'));
        break;
      case 'update':
        $customers_id = zen_db_prepare_input($_GET['cID']);
        $customers_firstname = zen_db_prepare_input($_POST['customers_firstname']);
        $customers_lastname = zen_db_prepare_input($_POST['customers_lastname']);
        $customers_email_address = zen_db_prepare_input($_POST['customers_email_address']);
        $customers_telephone = zen_db_prepare_input($_POST['customers_telephone']);
        $customers_fax = zen_db_prepare_input($_POST['customers_fax']);
        $customers_newsletter = zen_db_prepare_input($_POST['customers_newsletter']);
        $customers_group_pricing = zen_db_prepare_input($_POST['customers_group_pricing']);
        $customers_email_format = zen_db_prepare_input($_POST['customers_email_format']);
        $customers_gender = zen_db_prepare_input($_POST['customers_gender']);
        $customers_dob = zen_db_prepare_input($_POST['customers_dob']);

        $customers_authorization = zen_db_prepare_input($_POST['customers_authorization']);
        $customers_referral= zen_db_prepare_input($_POST['customers_referral']);

        if (CUSTOMERS_APPROVAL_AUTHORIZATION == 2 and $customers_authorization == 1) {
          $customers_authorization = 2;
          $messageStack->add_session(ERROR_CUSTOMER_APPROVAL_CORRECTION2, 'caution');
        }

        if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 and $customers_authorization == 2) {
          $customers_authorization = 1;
          $messageStack->add_session(ERROR_CUSTOMER_APPROVAL_CORRECTION1, 'caution');
        }

        $default_address_id = zen_db_prepare_input($_POST['default_address_id']);
        $entry_street_address = zen_db_prepare_input($_POST['entry_street_address']);
        $entry_suburb = zen_db_prepare_input($_POST['entry_suburb']);
        $entry_postcode = zen_db_prepare_input($_POST['entry_postcode']);
        $entry_city = zen_db_prepare_input($_POST['entry_city']);
        $entry_country_id = zen_db_prepare_input($_POST['entry_country_id']);

        $entry_company = zen_db_prepare_input($_POST['entry_company']);
        $entry_state = zen_db_prepare_input($_POST['entry_state']);
        if (isset($_POST['entry_zone_id'])) $entry_zone_id = zen_db_prepare_input($_POST['entry_zone_id']);

        if (strlen($customers_firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_firstname_error = true;
        } else {
          $entry_firstname_error = false;
        }

        if (strlen($customers_lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $error = true;
          $entry_lastname_error = true;
        } else {
          $entry_lastname_error = false;
        }

        if (ACCOUNT_DOB == 'true') {
          if (checkdate(substr(zen_date_raw($customers_dob), 4, 2), substr(zen_date_raw($customers_dob), 6, 2), substr(zen_date_raw($customers_dob), 0, 4))) {
            $entry_date_of_birth_error = false;
          } else {
            $error = true;
            $entry_date_of_birth_error = true;
          }
        }

        if (strlen($customers_email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_email_address_error = true;
        } else {
          $entry_email_address_error = false;
        }

        if (!zen_validate_email($customers_email_address)) {
          $error = true;
          $entry_email_address_check_error = true;
        } else {
          $entry_email_address_check_error = false;
        }

        if (strlen($entry_street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_street_address_error = true;
        } else {
          $entry_street_address_error = false;
        }

        if (strlen($entry_postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
          $error = true;
          $entry_post_code_error = true;
        } else {
          $entry_post_code_error = false;
        }

        if (strlen($entry_city) < ENTRY_CITY_MIN_LENGTH) {
          $error = true;
          $entry_city_error = true;
        } else {
          $entry_city_error = false;
        }

        if ($entry_country_id == false) {
          $error = true;
          $entry_country_error = true;
        } else {
          $entry_country_error = false;
        }

        if (ACCOUNT_STATE == 'true') {
          if ($entry_country_error == true) {
            $entry_state_error = true;
          } else {
            $zone_id = 0;
            $entry_state_error = false;
            $check_value = $db->Execute("select count(*) as total
                                         from " . TABLE_ZONES . "
                                         where zone_country_id = '" . (int)$entry_country_id . "'");

            $entry_state_has_zones = ($check_value->fields['total'] > 0);
            if ($entry_state_has_zones == true) {
              $zone_query = $db->Execute("select zone_id
                                          from " . TABLE_ZONES . "
                                          where zone_country_id = '" . (int)$entry_country_id . "'
                                          and zone_name = '" . zen_db_input($entry_state) . "'");

              if ($zone_query->RecordCount() > 0) {
                $entry_zone_id = $zone_query->fields['zone_id'];
              } else {
                $error = true;
                $entry_state_error = true;
              }
            } else {
              if ($entry_state == false) {
                $error = true;
                $entry_state_error = true;
              }
            }
         }
      }

      if (strlen($customers_telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $error = true;
        $entry_telephone_error = true;
      } else {
        $entry_telephone_error = false;
      }

      $check_email = $db->Execute("select customers_email_address
                                   from " . TABLE_CUSTOMERS . "
                                   where customers_email_address = '" . zen_db_input($customers_email_address) . "'
                                   and customers_id != '" . (int)$customers_id . "'");

      if ($check_email->RecordCount() > 0) {
        $error = true;
        $entry_email_address_exists = true;
      } else {
        $entry_email_address_exists = false;
      }

      if ($error == false) {

        $sql_data_array = array('customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
                                'customers_email_address' => $customers_email_address,
                                'customers_telephone' => $customers_telephone,
                                'customers_fax' => $customers_fax,
                                'customers_group_pricing' => $customers_group_pricing,
                                'customers_newsletter' => $customers_newsletter,
                                'customers_email_format' => $customers_email_format,
                                'customers_authorization' => $customers_authorization,
                                'customers_referral' => $customers_referral
                                );

        if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $customers_gender;
        if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = zen_date_raw($customers_dob);

        zen_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "'");

        $db->Execute("update " . TABLE_CUSTOMERS_INFO . "
                      set customers_info_date_account_last_modified = now()
                      where customers_info_id = '" . (int)$customers_id . "'");

        if ($entry_zone_id > 0) $entry_state = '';

        $sql_data_array = array('entry_firstname' => $customers_firstname,
                                'entry_lastname' => $customers_lastname,
                                'entry_street_address' => $entry_street_address,
                                'entry_postcode' => $entry_postcode,
                                'entry_city' => $entry_city,
                                'entry_country_id' => $entry_country_id);

        if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $entry_company;
        if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $entry_suburb;

        if (ACCOUNT_STATE == 'true') {
          if ($entry_zone_id > 0) {
            $sql_data_array['entry_zone_id'] = $entry_zone_id;
            $sql_data_array['entry_state'] = '';
          } else {
            $sql_data_array['entry_zone_id'] = '0';
            $sql_data_array['entry_state'] = $entry_state;
          }
        }

        zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customers_id . "' and address_book_id = '" . (int)$default_address_id . "'");

        zen_redirect(zen_href_link(FILENAME_CUSTOMERS, zen_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_id, 'NONSSL'));

        } else if ($error == true) {
          $cInfo = new objectInfo($_POST);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_CUSTOMERS, zen_get_all_get_params(array('cID', 'action')), 'NONSSL'));
        }
        $customers_id = zen_db_prepare_input($_GET['cID']);

        if (isset($_POST['delete_reviews']) && ($_POST['delete_reviews'] == 'on')) {
          $reviews = $db->Execute("select reviews_id
                                   from " . TABLE_REVIEWS . "
                                   where customers_id = '" . (int)$customers_id . "'");

          while (!$reviews->EOF) {
            $dbExecute("delete from " . TABLE_REVIEWS_DESCRIPTION . "
                        where reviews_id = '" . (int)$reviews['reviews_id'] . "'");
            $reviews->MoveNext();
          }

          $db->Execute("delete from " . TABLE_REVIEWS . "
                        where customers_id = '" . (int)$customers_id . "'");
        } else {
          $db->Execute("update " . TABLE_REVIEWS . "
                        set customers_id = null
                        where customers_id = '" . (int)$customers_id . "'");
        }

        $db->Execute("delete from " . TABLE_ADDRESS_BOOK . "
                      where customers_id = '" . (int)$customers_id . "'");

        $db->Execute("delete from " . TABLE_CUSTOMERS . "
                      where customers_id = '" . (int)$customers_id . "'");

        $db->Execute("delete from " . TABLE_CUSTOMERS_INFO . "
                      where customers_info_id = '" . (int)$customers_id . "'");

        $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET . "
                      where customers_id = '" . (int)$customers_id . "'");

        $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                      where customers_id = '" . (int)$customers_id . "'");

        $db->Execute("delete from " . TABLE_WHOS_ONLINE . "
                      where customer_id = '" . (int)$customers_id . "'");


        zen_redirect(zen_href_link(FILENAME_CUSTOMERS, zen_get_all_get_params(array('cID', 'action')), 'NONSSL'));
        break;
      default:
        $customers = $db->Execute("select c.customers_id, c.customers_gender, c.customers_firstname,
                                          c.customers_lastname, c.customers_dob, c.customers_email_address,
                                          a.entry_company, a.entry_street_address, a.entry_suburb,
                                          a.entry_postcode, a.entry_city, a.entry_state, a.entry_zone_id,
                                          a.entry_country_id, c.customers_telephone, c.customers_fax,
                                          c.customers_newsletter, c.customers_default_address_id,
                                          c.customers_email_format, c.customers_group_pricing,
                                          c.customers_authorization, c.customers_referral
                                  from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a
                                  on c.customers_default_address_id = a.address_book_id
                                  where a.customers_id = c.customers_id
                                  and c.customers_id = '" . (int)$_GET['cID'] . "'");

        $cInfo = new objectInfo($customers->fields);
    }
  }
?>