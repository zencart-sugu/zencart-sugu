<?php
/**
 * Visitors Module
 *
 * @package visitors
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: visitors.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  /**
   *
   * @author Koji Sasaki
   *
   */
  class visitors extends addonModuleBase {
    /**
     * Display modules title on admin.
     * @var string
     */
    var $title = MODULE_VISITORS_TITLE;

    /**
     * Display modules descriptionl on admin.
     * @var string
     */
    var $description = MODULE_VISITORS_DESCRIPTION;

    /**
     *
     * @var integer
     */
    var $sort_order = MODULE_VISITORS_SORT_ORDER;
    var $icon;
    var $status = MODULE_VISITORS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_VISITORS_STATUS_TITLE,
            'configuration_key' => 'MODULE_VISITORS_STATUS',
            'configuration_value' => MODULE_VISITORS_STATUS_DEFAULT,
            'configuration_description' => MODULE_VISITORS_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\'), '
          ),
          array(
            'configuration_title' => MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_TITLE,
            'configuration_key' => 'MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS',
            'configuration_value' => MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DEFAULT,
            'configuration_description' => MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_VISITORS_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_VISITORS_SORT_ORDER',
            'configuration_value' => MODULE_VISITORS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_VISITORS_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();

    var $notifier = array(
          'NOTIFY_HEADER_START_ACCOUNT_EDIT',
          'NOTIFY_HEADER_START_CREATE_ACCOUNT',
          'NOTIFY_HEADER_START_CREATE_VISITOR',
          'NOTIFY_HEADER_START_LOGIN',
        );

    var $tables = array(
      TABLE_VISITORS => array(
        'visitors_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11),
        'visitors_email_address' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 96),
        'visitors_info_date_account_created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'visitors_info_date_account_last_modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'INDEXES' => array(
          'PRIMARY' => array('visitors_id'),
          'INDEX' => array(
            array('visitors_email_address'),
            ),
          ),
        ),
      );

    var $author                        = "k.sasaki";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function visitors() {
      parent::__construct();
    }

    function notifierUpdate($notifier) {
      if ($notifier == 'NOTIFY_HEADER_START_ACCOUNT_EDIT'
        || $notifier == 'NOTIFY_HEADER_START_CREATE_ACCOUNT'
        || $notifier == 'NOTIFY_HEADER_START_CREATE_VISITOR'
        || $notifier == 'NOTIFY_HEADER_START_LOGIN') {
        $this->_cleanUpVisitors();
      }
      return false;
    }

    function _install() {
      global $db;

      $db->Execute("
        INSERT INTO " . TABLE_QUERY_BUILDER . " (
          query_id, query_category, query_name,
          query_description,
          query_string,
          query_keys_list
          )
        VALUES(
          null, 'email', '" . NOT_INCLUDE_VISITORS_ALL_CUSTOMETS . "',
          'Returns all customers name and email address for sending mass emails (ie: for newsletters, coupons, GV''s, messages, etc).',
          'select c.customers_email_address, c.customers_firstname, c.customers_lastname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id where v.visitors_id is null order by c.customers_lastname, c.customers_firstname, c.customers_email_address',
          ''
          )
        ;");
      $db->Execute("
        INSERT INTO " . TABLE_QUERY_BUILDER . " (
          query_id, query_category, query_name,
          query_description,
          query_string,
          query_keys_list
          )
        VALUES(
          null, 'email,newsletters', '" . NOT_INCLUDE_VISITORS_ALL_NEWSLETTER_SUBSCIBERS . "',
          'Returns name and email address of newsletter subscribers',
          'select c.customers_firstname, c.customers_lastname, c.customers_email_address from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id where c.customers_newsletter = ''1'' and v.visitors_id is null',
          ''
          )
        ;");
      $db->Execute("
        INSERT INTO " . TABLE_QUERY_BUILDER . " (
          query_id, query_category, query_name,
          query_description,
          query_string,
          query_keys_list
          )
        VALUES(
          null, 'email,newsletters', '" . NOT_INCLUDE_VISITORS_DORMANT_CUSTOMERS_LAST_3MONTHS_SUBSCIBERS . "',
          'Subscribers who HAVE purchased something, but have NOT purchased for at least three months.',
          'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id , TABLE_ORDERS o where c.customers_newsletter = ''1'' and c.customers_id = o.customers_id and o.date_purchased < subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',
          ''
          )
        ;");
      $db->Execute("
        INSERT INTO " . TABLE_QUERY_BUILDER . " (
          query_id, query_category, query_name,
          query_description,
          query_string,
          query_keys_list
          )
        VALUES(
          null, 'email,newsletters', '" . NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_SUBSCIBERS . "',
          'Newsletter subscribers who are also active customers (purchased something) in last 3 months.',
          'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id, TABLE_ORDERS o where c.customers_newsletter = ''1'' AND c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',
          '')
        ;");
      $db->Execute("
        INSERT INTO " . TABLE_QUERY_BUILDER . " (
          query_id, query_category, query_name,
          query_description,
          query_string,
          query_keys_list
          )
        VALUES(
          null, 'email,newsletters', '" . NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_REGARDLESS_OF_SUBSCRIPTION_STATUS . "',
          'All active customers (purchased something) in last 3 months, ignoring newsletter-subscription status.',
          'select c.customers_email_address, c.customers_lastname, c.customers_firstname from TABLE_CUSTOMERS c left join TABLE_VISITORS v on c.customers_id = v.visitors_id, TABLE_ORDERS o WHERE c.customers_id = o.customers_id and o.date_purchased > subdate(now(),INTERVAL 3 MONTH) and v.visitors_id is null GROUP BY c.customers_email_address order by c.customers_lastname, c.customers_firstname ASC',
          '')
        ;");
    }

    function _update() {
    }

    function _remove() {
      global $db;
      $db->Execute("DELETE FROM " . TABLE_QUERY_BUILDER . " WHERE query_string LIKE '%TABLE_VISITORS%';");
    }

    function _cleanUp() {
    }

    function _cleanUpVisitors() {
      global $db;
      if (isset($_POST['email_address']) && $_POST['email_address'] != '') {
        $email_address = zen_db_prepare_input($_POST['email_address']);
        $query = "
          select visitors_id
          from " . TABLE_VISITORS . "
          where visitors_email_address = :email
          ;";
        $query = $db->bindVars($query, ':email', $email_address, 'string');
        $result = $db->Execute($query);
        while (!$result->EOF) {
          zen_visitors_delete_visitor($result->fields['visitors_id']);
          $result->moveNext();
        }
      }
    }

    // page methods
    function page_create_visitor() {
      global $zco_notifier;

      $return = array();

      // This should be first line of the script:
      $zco_notifier->notify('NOTIFY_HEADER_START_CREATE_VISITOR');

      $return = $this->module_create_visitor($return);

      // This should be last line of the script:
      $zco_notifier->notify('NOTIFY_HEADER_END_CREATE_VISITOR');

      return $return;
    }

    function _page_create_visitor_breadcrumb() {
      $return = array();
      $return[] = array('title' => NAVBAR_TITLE, 'link' => null);
      return $return;
    }

    function page_visitor_edit() {
      global $zco_notifier;

      $return = array();

      $zco_notifier->notify('NOTIFY_HEADER_START_VISITOR_EDIT');

      if (!$_SESSION['visitors_id']) {
        zen_redirect(zen_href_link(FILENAME_DEFAULT));
      }

      $return = $this->module_visitor_edit($return);


      // This should be last line of the script:
     $zco_notifier->notify('NOTIFY_HEADER_END_VISITOR_EDIT');

      return $return;
    }

    function _page_visitor_edit_breadcrumb() {
      $return = array();
      $return[] = array('title' => NAVBAR_TITLE, 'link' => null);
      return $return;
    }


    function page_visitor_to_account() {
      global $zco_notifier;

      $return = array();

      $zco_notifier->notify('NOTIFY_HEADER_START_VISITOR_TO_ACCOUNT');

      if (!$_SESSION['visitors_id']) {
        zen_redirect(zen_href_link(FILENAME_DEFAULT));
      }

      $return = $this->module_visitor_to_account($return);


      // This should be last line of the script:
     $zco_notifier->notify('NOTIFY_HEADER_END_VISITOR_TO_ACCOUNT');

      return $return;
    }

    function _page_visitor_to_account_breadcrumb() {
      $return = array();
      $return[] = array('title' => NAVBAR_TITLE, 'link' => null);
      return $return;
    }

    function zoneOptions($return = array()) {
      global $db;

      if (ACCOUNT_STATE == 'true' && ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true') {
        $zone_id = 0;
        $check_query = "
          SELECT count(*) as total
          FROM " . TABLE_ZONES . "
          WHERE zone_country_id = '" . (int)SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY . "'
          ;";
        $check = $db->Execute($check_query);
        $entry_state_has_zones = ($check->fields['total'] > 0);
        $return['entry_state_has_zones'] = $entry_state_has_zones;
        if ($entry_state_has_zones == true) {
          $zones_array = array();
          $zones_array[] = array('id' => PULL_DOWN_ALL, 'text' => PULL_DOWN_ALL);
          $zones_values = $db->Execute("
            SELECT zone_name
            FROM " . TABLE_ZONES . "
            WHERE zone_country_id = '" . (int)SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY . "'
            ORDER BY zone_id
            ;");
          while (!$zones_values->EOF) {
            $zones_array[] = array(
              'id' => $zones_values->fields['zone_name'],
              'text' => $zones_values->fields['zone_name'],
              );
            $zones_values->MoveNext();
          }
          $return['zones_array'] = $zones_array;
        }
      }

      return $return;
    }

    function prosessPrivacyConditions ($return = array()) {

      if (DISPLAY_PRIVACY_CONDITIONS == 'true') {
        if (!isset($_POST['privacy_conditions']) || ($_POST['privacy_conditions'] != '1')) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED,
            'type' => 'error',
            );
        }
      }

      return $return;
    }

    function processGender($return = array()) {

      if (ACCOUNT_GENDER == 'true') {
        if (isset($_POST['gender'])) {
          $gender = zen_db_prepare_input($_POST['gender']);
        } else {
          $gender = false;
        }
      }

      if (ACCOUNT_GENDER == 'true') {
        if ( ($gender != 'm') && ($gender != 'f') ) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_GENDER_ERROR,
            'type' => 'error',
            );
        }
      }

      $return['gender'] = $gender;

      return $return;
    }

    function processEmailFormat($return = array()) {

      if (isset($_POST['email_format'])) {
        $email_format = zen_db_prepare_input($_POST['email_format']);
      } else {
        $email_format = false;
      }
      $return['email_format'] = $email_format;

      return $return;
    }

    function processFirstname($return = array()) {

      $firstname = zen_db_prepare_input($_POST['firstname']);

      if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_FIRST_NAME_ERROR,
          'type' => 'error',
          );
      }
      $return['firstname'] = $firstname;

      return $return;
    }

    function processLastname($return = array()) {

      $lastname = zen_db_prepare_input($_POST['lastname']);
      if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_LAST_NAME_ERROR,
          'type' => 'error',
          );
      }
      $return['lastname'] = $lastname;

      return $return;
    }

    function processFirstnameKana($return = array()) {

      if (FURIKANA_NESESSARY) {
        $firstname_kana = zen_db_prepare_input($_POST['firstname_kana']);
        if (strlen($firstname_kana) < ENTRY_FIRST_NAME_MIN_LENGTH) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_FIRST_NAME_KANA_ERROR,
            'type' => 'error',
            );
        }
        if ($firstname_kana != "" && !preg_match(ENTRY_HIRAKANA_REGEXP, $firstname_kana)) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_FIRST_NAME_KANA.ENTRY_HIRAKANA_NOMATCH,
            'type' => 'error',
            );
        }
        $return['firstname_kana'] = $firstname_kana;
      }

      return $return;
    }

    function processLastnameKana($return = array()) {

      if (FURIKANA_NESESSARY) {
        $lastname_kana = zen_db_prepare_input($_POST['lastname_kana']);
        if (strlen($lastname_kana) < ENTRY_LAST_NAME_MIN_LENGTH) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_LAST_NAME_KANA_ERROR,
            'type' => 'error',
            );
        }
        if ($lastname_kana != "" && !preg_match(ENTRY_HIRAKANA_REGEXP, $lastname_kana)) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_LAST_NAME_KANA.ENTRY_HIRAKANA_NOMATCH,
            'type' => 'error',
            );
        }
        $return['lastname_kana'] = $lastname_kana;
      }

      return $return;
    }

    function processNames($return = array()) {

      $return = $this->processFirstname($return);
      $return = $this->processLastname($return);

      $return = $this->processFirstnameKana($return);
      $return = $this->processLastnameKana($return);

      return $return;
    }

    function processDOB($return = array()) {

      if (ACCOUNT_DOB == 'true') {
        if (empty($_POST['dob'])) {
          $dob = zen_db_prepare_input('0001-01-01 00:00:00');
        } else {
          $dob = zen_db_prepare_input($_POST['dob']);
          if (ENTRY_DOB_MIN_LENGTH > 0 or !empty($_POST['dob'])) {
            if (!preg_match('/^[0-9]{4}\/[0-9]{2}\/[0-9]{2}$/', $dob)) {
              $return['error'] = true;
              $return['error_messages'][] = array(
                'message' => ENTRY_DATE_OF_BIRTH_ERROR,
                'type' => 'error',
                );
            }
          }

          $return['dob'] = $dob;
        }
      }

      return $return;
    }

    function processEmailAddress($return = array()) {
      global $db;

      $email_address = zen_db_prepare_input($_POST['email_address']);

      if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_EMAIL_ADDRESS_ERROR,
          'type' => 'error',
          );

      } elseif (zen_validate_email($email_address) == false) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_EMAIL_ADDRESS_CHECK_ERROR,
          'type' => 'error',
          );

      } else {
        if(!$_SESSION['customer_id']) {
          $check_email_query = "
            SELECT count(*) as total
            FROM " . TABLE_CUSTOMERS . " c
            LEFT JOIN " . TABLE_VISITORS . " v ON c.customers_id = v.visitors_id
            WHERE c.customers_email_address = '" . zen_db_input($email_address) . "'
            AND v.visitors_email_address is null
            ;";
        } else {
          $check_email_query = "
            SELECT count(*) as total
            FROM " . TABLE_CUSTOMERS . " c
            LEFT JOIN " . TABLE_VISITORS . " v ON c.customers_id = v.visitors_id
            WHERE c.customers_email_address = '" . zen_db_input($email_address) . "'
            AND customers_id != '" . (int)$_SESSION['customer_id'] . "'
          ;";
        }

        $check_email = $db->Execute($check_email_query);
        if ($check_email->fields['total'] > 0) {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_EMAIL_ADDRESS_ERROR_EXISTS,
            'type' => 'error',
            );

        }
      }

      $return['email_address'] = $email_address;

      return $return;
    }

    function processCompany($return = array()) {

      if (ACCOUNT_COMPANY == 'true') {
        $company = zen_db_prepare_input($_POST['company']);
        $return['company'] = $company;
      }

      return $return;
    }

    function processStreetAddress($return = array()) {

      $street_address = zen_db_prepare_input($_POST['street_address']);
      if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_STREET_ADDRESS_ERROR,
          'type' => 'error',
          );
      }
      $return['street_address'] = $street_address;

      return $return;
    }

    function processSuburb($return = array()) {

      if (ACCOUNT_SUBURB == 'true') {
        $suburb = zen_db_prepare_input($_POST['suburb']);
        $return['suburb'] = $suburb;
      }

      return $return;
    }

    function processPostcode($return = array()) {

      $postcode = zen_db_prepare_input($_POST['postcode']);
      if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_POST_CODE_ERROR,
          'type' => 'error',
          );
      }
      $return['postcode'] = $postcode;

      return $return;
    }

    function processCity($return = array()) {

      $city = zen_db_prepare_input($_POST['city']);
      if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_CITY_ERROR,
          'type' => 'error',
          );
      }
      $return['city'] = $city;

      return $return;
    }

    function processCountry($return = array()) {

      $country = zen_db_prepare_input($_POST['country']);
      if (is_numeric($country) == false) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_COUNTRY_ERROR,
          'type' => 'error',
          );
      }
      $return['country'] = $country;

      return $return;
    }

    function processState($return = array()) {
      global $db;

      if(isset($return['country'])){
        $country = $return['country'];
      }

      if (ACCOUNT_STATE == 'true') {
        $state = zen_db_prepare_input($_POST['state']);

        $zone_id = 0;
        $check_query = "
          SELECT count(*) as total
          FROM " . TABLE_ZONES . "
          WHERE zone_country_id = '" . (int)$country . "'
          ;";
        $check = $db->Execute($check_query);

        $entry_state_has_zones = ($check->fields['total'] > 0);
        $return['entry_state_has_zones'] = $entry_state_has_zones;

        if ($entry_state_has_zones == true) {
          $zones_array = array();
          $zones_array[] = array('id' => PULL_DOWN_ALL, 'text' => PULL_DOWN_ALL);
          $zones_values = $db->Execute("
            SELECT zone_name
            FROM " . TABLE_ZONES . "
            WHERE zone_country_id = '" . (int)$country . "'
            ORDER BY zone_id
            ;");

          while (!$zones_values->EOF) {
            $zones_array[] = array(
              'id' => $zones_values->fields['zone_name'],
              'text' => $zones_values->fields['zone_name'],
              );
            $zones_values->MoveNext();
          }
          $return['zones_array'] = $zones_array;

          $zone_query = "
            SELECT DISTINCT zone_id, zone_name
            FROM " . TABLE_ZONES . "
            WHERE zone_country_id = '" . (int)$country . "'
            AND zone_code =  '" . strtoupper(zen_db_input($state)) . "'
            ;";
          $zone = $db->Execute($zone_query);
          if ($zone->RecordCount() > 0) {
            $zone_id = $zone->fields['zone_id'];
            $zone_name = $zone->fields['zone_name'];

          } else {
            $zone_query = "
              select distinct zone_id, zone_name
              from " . TABLE_ZONES . "
              where zone_country_id = '" . (int)$country . "'
              and (zone_name like '" . zen_db_input($state) . "'
              or zone_code like '" . zen_db_input($state) . "')";

            $zone = $db->Execute($zone_query);

            if ($zone->RecordCount() > 0) {
              $zone_id = $zone->fields['zone_id'];
              $zone_name = $zone->fields['zone_name'];
            }
          }

          if (!$zone_name) {
            $return['error'] = true;
            $return['error_messages'][] = array(
              'message' => ENTRY_STATE_ERROR_SELECT,
              'type' => 'error',
              );

            }
          } else {
            if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
              $return['error'] = true;
              $return['error_messages'][] = array(
                'message' => ENTRY_STATE_ERROR,
                'type' => 'error',
                );
              $error = true;
            }
          }
        }

      $return['state'] = $state;
      $return['zone_id'] = $zone_id;
      $return['zone_name'] = $zone_name;

      return $return;
    }

    function processTelephone($return = array()) {

      $telephone = zen_db_prepare_input($_POST['telephone']);
      if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_TELEPHONE_NUMBER_ERROR,
          'type' => 'error',
          );
      }

      if ($telephone != "" && !preg_match('/^[0-9\-]+$/', $telephone)) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_TELEPHONE_NOMATCH,
          'type' => 'error',
          );
      }

      $return['telephone'] = $telephone;

      return $return;
    }

    function processFax($return = array()) {

      $fax = zen_db_prepare_input($_POST['fax']);

      if ($fax != "" && !preg_match('/^[0-9\-]+$/', $fax)) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_FAX_NOMATCH,
          'type' => 'error',
          );
      }

      $return['fax'] = $fax;

      return $return;
    }

    function processAddress($return = array()) {

      $return = $this->processCompany($return);
      $return = $this->processStreetAddress($return);
      $return = $this->processSuburb($return);
      $return = $this->processPostcode($return);
      $return = $this->processCity($return);
      $return = $this->processCountry($return);
      $return = $this->processState($return);
      $return = $this->processTelephone($return);
      $return = $this->processFax($return);

      return $return;
    }

    function processCustomersAuthorization($return = array()) {

      $customers_authorization = CUSTOMERS_APPROVAL_AUTHORIZATION;
      $return['customers_authorization'] = $customers_authorization;

      return $return;
    }

    function processCustomersReferral($return = array()) {

      $customers_referral = zen_db_prepare_input($_POST['customers_referral']);
      $return['customers_referral'] = $customers_referral;

      return $return;
    }

    // modules methods
    function module_create_visitor($return = array()) {
      global $db, $messageStack, $zco_notifier;

      $return = $this->zoneOptions($return);

      $process = false;

      /**
       * Process form contents
       */
      if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
        $process = true;

        $return['error'] = false;
        $return['error_messages'] = array();

        $return = $this->prosessPrivacyConditions($return);
        $return = $this->processGender($return);
        $return = $this->processEmailFormat($return);
        $return = $this->processNames($return);
        $return = $this->processDOB($return);
        $return = $this->processEmailAddress($return);
        $return = $this->processAddress($return);
        $return = $this->processEmailFormat($return);
        $return = $this->processCustomersAuthorization($return);
        $return = $this->processCustomersReferral($return);

        if (count($return['error_messages']) > 0) {
          foreach ($return['error_messages'] as $error_message) {
            $messageStack->add('create_visitor', $error_message['message'], $error_message['type']);
          }
        }

        if ($return['error'] == true) {
          // hook notifier class
          $zco_notifier->notify('NOTIFY_FAILURE_DURING_CREATE_VISITOR');
        } else {
          extract($return);

          $sql_data_array = array(
            'customers_firstname' => $firstname,
            'customers_lastname' => $lastname,
            'customers_email_address' => $email_address,
            'customers_nick' => '',
            'customers_telephone' => $telephone,
            'customers_fax' => $fax,
            'customers_newsletter' => 0,
            'customers_email_format' => $email_format,
            'customers_default_address_id' => '0',
            'customers_password' => '', // Visitors can't set a passowrd
            'customers_authorization' => (int)CUSTOMERS_APPROVAL_AUTHORIZATION,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['customers_firstname_kana'] = $firstname_kana;
            $sql_data_array['customers_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) $sql_data_array['customers_referral'] = $customers_referral;
          if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
          if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_date_raw($_POST['dob']));

          zen_db_perform(TABLE_CUSTOMERS, $sql_data_array);

          $_SESSION['customer_id'] = $db->Insert_ID();

          // create a visitor
          $sql_data_array = array(
            'visitors_id' => $_SESSION['customer_id'],
            'visitors_email_address' => $email_address,
            'visitors_info_date_account_created' => 'now()'
          );

          zen_db_perform(TABLE_VISITORS, $sql_data_array);
          $_SESSION['visitors_id'] = $_SESSION['customer_id'];


          $sql_data_array = array(
            'customers_id' => $_SESSION['customer_id'],
            'entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_telephone' => $telephone,
            'entry_fax' => $fax,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => $country,
//            'entry_email_address' => $email_address,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['entry_firstname_kana'] = $firstname_kana;
            $sql_data_array['entry_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
          if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
          if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
          if (ACCOUNT_STATE == 'true') {
            if ($zone_id > 0) {
              $sql_data_array['entry_zone_id'] = $return['zone_id'];
              $sql_data_array['entry_state'] = '';
            } else {
              $sql_data_array['entry_zone_id'] = '0';
              $sql_data_array['entry_state'] = $return['state'];
            }
          }

          zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

          $address_id = $db->Insert_ID();

          $sql = "
            UPDATE " . TABLE_CUSTOMERS . "
            SET customers_default_address_id = '" . (int)$address_id . "'
            WHERE customers_id = '" . (int)$_SESSION['customer_id'] . "'";

          $db->Execute($sql);

          $sql = "
            INSERT INTO " . TABLE_CUSTOMERS_INFO . "
              (customers_info_id, customers_info_number_of_logons,
              customers_info_date_account_created)
            VALUES
              ('" . (int)$_SESSION['customer_id'] . "', '0', now())
            ;";

          $db->Execute($sql);

          if (SESSION_RECREATE == 'True') {
            zen_session_recreate();
          }

          $_SESSION['customer_first_name'] = $firstname;
          $_SESSION['customer_last_name'] = $lastname;
          // ->furikana
          if (FURIKANA_NESESSARY) {
            $_SESSION['customer_first_name_kana'] = $firstname_kana;
            $_SESSION['customer_last_name_kana'] = $lastname_kana;
          }
          // <-furikana
          $_SESSION['customer_default_address_id'] = $address_id;
          $_SESSION['customer_country_id'] = $country;
          $_SESSION['customer_zone_id'] = $zone_id;
          $_SESSION['customers_authorization'] = $customers_authorization;

          // restore cart contents
          $_SESSION['cart']->restore_contents();

          // hook notifier class
          $zco_notifier->notify('NOTIFY_LOGIN_SUCCESS_VIA_CREATE_VISITOR');

          zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));

        } //endif !error
      }

      $return['process'] = $process;

      return $return;
    }

    function module_visitor_edit($return = array()) {
      global $db, $messageStack, $zco_notifier;

      $return = $this->zoneOptions($return);

      $process = false;

      /**
       * Process form contents
       */
      if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
        $process = true;

        $return['error'] = false;
        $return['error_messages'] = array();

        $return = $this->processGender($return);
        $return = $this->processNames($return);
        $return = $this->processDOB($return);
        $return = $this->processEmailAddress($return);
        $return = $this->processAddress($return);
        $return = $this->processEmailFormat($return);
        $return = $this->processCustomersAuthorization($return);
        $return = $this->processCustomersReferral($return);

        if (count($return['error_messages']) > 0) {
          foreach ($return['error_messages'] as $error_message) {
            $messageStack->add('create_visitor', $error_message['message'], $error_message['type']);
          }
        }



        if ($return['error'] == true) {
          // hook notifier class
          $zco_notifier->notify('NOTIFY_FAILURE_DURING_VISITOR_EDIT');
        } else {
          extract($return);

          $sql_data_array = array(
            'customers_firstname' => $firstname,
            'customers_lastname' => $lastname,
            'customers_email_address' => $email_address,
            'customers_nick' => $nick,
            'customers_telephone' => $telephone,
            'customers_fax' => $fax,
            'customers_email_format' => $email_format,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['customers_firstname_kana'] = $firstname_kana;
            $sql_data_array['customers_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) $sql_data_array['customers_referral'] = $customers_referral;
          if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
          if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_date_raw($_POST['dob']));

          zen_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "'");

          // create a visitor
          $sql_data_array = array(
            'visitors_email_address' => $email_address,
            'visitors_info_date_account_last_modified' => 'now()'
          );

          zen_db_perform(TABLE_VISITORS, $sql_data_array, 'update', "visitors_id = '" . (int)$_SESSION['customer_id'] . "'");
          $_SESSION['visitors_id'] = $_SESSION['customer_id'];

          $sql_data_array = array(
            'entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_telephone' => $telephone,
            'entry_fax' => $fax,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => $country,
//            'entry_email_address' => $email_address,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['entry_firstname_kana'] = $firstname_kana;
            $sql_data_array['entry_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
          if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
          if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
          if (ACCOUNT_STATE == 'true') {
            if ($zone_id > 0) {
              $sql_data_array['entry_zone_id'] = $zone_id;
              $sql_data_array['entry_state'] = '';
            } else {
              $sql_data_array['entry_zone_id'] = '0';
              $sql_data_array['entry_state'] = $state;
            }
          }

          zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['customer_default_address_id'] . "'");

          $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
                  SET    customers_info_date_account_last_modified = now()
                  WHERE  customers_info_id = :customersID";

          $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');

          $_SESSION['customer_first_name'] = $firstname;
          $_SESSION['customer_last_name'] = $lastname;
          // ->furikana
          if (FURIKANA_NESESSARY) {
            $_SESSION['customer_first_name_kana'] = $firstname_kana;
            $_SESSION['customer_last_name_kana'] = $lastname_kana;
          }
          // <-furikana
          $_SESSION['customer_country_id'] = $country;
          $_SESSION['customer_zone_id'] = $zone_id;

          $messageStack->add_session('header', SUCCESS_VISITOR_UPDATED, 'success');

          zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));

        } //endif !error
      } else {
        $return = $this->getFormDefault($return);
      }

      return $return;
    }

    function getFormDefault($return = array()) {
      global $db;

      // ->furikana
      if (FURIKANA_NESESSARY) {
        $account_query = "
          SELECT customers_gender, customers_firstname, customers_lastname,
                 customers_firstname_kana, customers_lastname_kana,
                 customers_dob, customers_email_address,
                 customers_email_format, customers_referral
          FROM   " . TABLE_CUSTOMERS . "
          WHERE  customers_id = :customersID";
      } else {
        $account_query = "
          SELECT customers_gender, customers_firstname, customers_lastname,
                 customers_dob, customers_email_address,
                 customers_email_format, customers_referral
          FROM   " . TABLE_CUSTOMERS . "
          WHERE  customers_id = :customersID";
      }
      // <-furikana

      $account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
      $account = $db->Execute($account_query);

      $return['firstname'] = $account->fields['customers_firstname'];
      $return['lastname'] = $account->fields['customers_lastname'];

      // ->furikana
      if (FURIKANA_NESESSARY) {
        $return['firstname_kana'] = $account->fields['customers_firstname_kana'];
        $return['lastname_kana'] = $account->fields['customers_lastname_kana'];
      }
      // <-furikana

      $return['email_address'] = $account->fields['customers_email_address'];

      if (ACCOUNT_GENDER == 'true') {
        $return['gender'] = $account->fields['customers_gender'];
      }

      // if DOB field has database default setting, show blank:
      $return['dob'] = ($account->fields['customers_dob'] == '0001-01-01 00:00:00') ? '' : date('Y/m/d', $account->fields['customers_dob']);
      $return['customers_referral'] = $account->fields['customers_referral'];
      $return['email_format'] = $account->fields['customers_email_format'];

      $entry_query = "
          SELECT entry_company, entry_street_address, entry_suburb, entry_postcode, entry_city,
                 entry_state, entry_zone_id, entry_country_id
               , entry_telephone, entry_fax
          FROM   " . TABLE_ADDRESS_BOOK . "
          WHERE  customers_id = :customersID
          AND    address_book_id = :addressBookID";

      $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
      $entry_query = $db->bindVars($entry_query, ':addressBookID', $_SESSION['customer_default_address_id'], 'integer');
      $entry = $db->Execute($entry_query);

      $return['company'] = $entry->fields['entry_company'];
      $return['street_address'] = $entry->fields['entry_street_address'];
      $return['suburb'] = $entry->fields['entry_suburb'];
      $return['postcode'] = $entry->fields['entry_postcode'];
      $return['city'] = $entry->fields['entry_city'];
      $return['state'] = $entry->fields['entry_state'];
      $return['zone_id'] = $entry->fields['entry_zone_id'];
      $return['country'] = $entry->fields['entry_country_id'];
      $return['telephone'] = $entry->fields['entry_telephone'];
      $return['fax'] = $entry->fields['entry_fax'];

      if (!isset($zone_name) || (int)$zone_name == 0) $zone_name = zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], $entry->fields['entry_state']);
      if ($state == '' && $zone_name != '') $state = $zone_name;
      $return['state'] = $state;
      $return['zone_name'] = $zone_name;

      return $return;
    }

    function processNick($return = array()) {
      global $phpBB;

      $nick = zen_db_prepare_input($_POST['nick']);
      if ($phpBB->phpBB['installed'] == true) {
        if (strlen($nick) < ENTRY_NICK_MIN_LENGTH)  {
          $return['error'] = true;
          $return['error_messages'][] = array(
            'message' => ENTRY_NICK_LENGTH_ERROR,
            'type' => 'error',
            );
        } else {
          // check Zen Cart for duplicate nickname
          $check_nick_query = "SELECT * from " . TABLE_CUSTOMERS  . "
                               WHERE customers_nick = '" . $nick . "'";
          $check_nick = $db->Execute($check_nick_query);
          if ($check_nick->RecordCount() > 0 ) {
            $return['error'] = true;
            $return['error_messages'][] = array(
              'message' => ENTRY_NICK_DUPLICATE_ERROR,
              'type' => 'error',
              );
          }
          // check phpBB for duplicate nickname
          if ($phpBB->phpbb_check_for_duplicate_nick($nick) == 'already_exists' ) {
            $return['error'] = true;
            $return['error_messages'][] = array(
              'message' => ENTRY_NICK_DUPLICATE_ERROR . '(phpBB)',
              'type' => 'error',
              );
          }
        }
      }

      $return['nick'] = $nick;

      return $return;
    }

    function processNewsletter($return = array()) {

      if (isset($_POST['newsletter'])) {
        $newsletter = zen_db_prepare_input($_POST['newsletter']);
      } else {
        $newsletter = false;
      }

      $return['newsletter'] = $newsletter;

      return $return;
    }

    function processPassword($return = array()) {

      $password = zen_db_prepare_input($_POST['password']);
      $confirmation = zen_db_prepare_input($_POST['confirmation']);

      if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_PASSWORD_ERROR,
          'type' => 'error',
          );
      } elseif ($password != $confirmation) {
        $return['error'] = true;
        $return['error_messages'][] = array(
          'message' => ENTRY_PASSWORD_ERROR_NOT_MATCHING,
          'type' => 'error',
          );
      }

      $return['password'] = $password;
      $return['confirmation'] = $confirmation;

      return $return;
    }

    function module_visitor_to_account($return = array()) {
      global $db, $messageStack, $zco_notifier;

      $return = $this->zoneOptions($return);

      $process = false;

      /**
       * Process form contents
       */
      if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
        $process = true;

        $return['error'] = false;
        $return['error_messages'] = array();

        $return = $this->prosessPrivacyConditions($return);
        $return = $this->processGender($return);
        $return = $this->processNames($return);
        $return = $this->processNick($return);
        $return = $this->processDOB($return);
        $return = $this->processEmailAddress($return);
        $return = $this->processAddress($return);
        $return = $this->processEmailFormat($return);
        $return = $this->processCustomersAuthorization($return);
        $return = $this->processCustomersReferral($return);
        $return = $this->processNewsletter($return);
        $return = $this->processPassword($return);

        if (count($return['error_messages']) > 0) {
          foreach ($return['error_messages'] as $error_message) {
            $messageStack->add('create_account', $error_message['message'], $error_message['type']);
          }
        }

        if ($return['error'] == true) {
          // hook notifier class
          $zco_notifier->notify('NOTIFY_FAILURE_DURING_VISITOR_TO_ACCOUNT');
        } else {
          extract($return);

          $sql_data_array = array(
            'customers_firstname' => $firstname,
            'customers_lastname' => $lastname,
            'customers_email_address' => $email_address,
            'customers_nick' => $nick,
            'customers_telephone' => $telephone,
            'customers_fax' => $fax,
            'customers_newsletter' => (int)$newsletter,
            'customers_email_format' => $email_format,
            'customers_password' => zen_encrypt_password($password),
            'customers_authorization' => (int)CUSTOMERS_APPROVAL_AUTHORIZATION,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['customers_firstname_kana'] = $firstname_kana;
            $sql_data_array['customers_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if ((CUSTOMERS_REFERRAL_STATUS == '2' and $customers_referral != '')) $sql_data_array['customers_referral'] = $customers_referral;
          if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
          //      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = zen_date_raw($dob);
          if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = (empty($_POST['dob']) ? zen_db_prepare_input('0001-01-01 00:00:00') : zen_date_raw($_POST['dob']));

          zen_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "'");

          // delete a visitor
          $db->Execute("delete from " . TABLE_VISITORS . "
                        where visitors_id = '" . (int)$_SESSION['visitors_id'] . "'");
          unset($_SESSION['visitors_id']);

          $sql_data_array = array(
            'entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_telephone' => $telephone,
            'entry_fax' => $fax,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => $country,
//            'entry_email_address' => $email_address,
            );

          // ->furikana
          if (FURIKANA_NESESSARY) {
            $sql_data_array['entry_firstname_kana'] = $firstname_kana;
            $sql_data_array['entry_lastname_kana'] = $lastname_kana;
          }
          // <-furikana

          if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
          if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
          if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
          if (ACCOUNT_STATE == 'true') {
            if ($zone_id > 0) {
              $sql_data_array['entry_zone_id'] = $zone_id;
              $sql_data_array['entry_state'] = '';
            } else {
              $sql_data_array['entry_zone_id'] = '0';
              $sql_data_array['entry_state'] = $state;
            }
          }

          zen_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$_SESSION['customer_id'] . "' and address_book_id = '" . (int)$_SESSION['customer_default_address_id'] . "'");

          $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
                  SET    customers_info_date_account_last_modified = now()
                  WHERE  customers_info_id = :customersID";

          $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');

          // phpBB create account
          if ($phpBB->phpBB['installed'] == true) {
            $phpBB->phpbb_create_account($nick, $password, $email_address);
          }
          // End phppBB create account

          $_SESSION['customer_first_name'] = $firstname;
          $_SESSION['customer_last_name'] = $lastname;
          // ->furikana
          if (FURIKANA_NESESSARY) {
            $_SESSION['customer_first_name_kana'] = $firstname_kana;
            $_SESSION['customer_last_name_kana'] = $lastname_kana;
          }
          // <-furikana
          $_SESSION['customer_country_id'] = $country;
          $_SESSION['customer_zone_id'] = $zone_id;

          // restore cart contents
          $_SESSION['cart']->restore_contents();

          // hook notifier class
          $zco_notifier->notify('NOTIFY_LOGIN_SUCCESS_VIA_VISITOR_TO_ACCOUNT');

          // build the message content
          $name = $firstname . ' ' . $lastname;

          if (ACCOUNT_GENDER == 'true') {
            if ($gender == 'm') {
              $email_text = sprintf(EMAIL_GREET_MR, $name);
            } else {
              $email_text = sprintf(EMAIL_GREET_MS, $name);
            }
          } else {
            $email_text = sprintf(EMAIL_GREET_NONE, $name);
          }
          $html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
          $html_msg['EMAIL_FIRST_NAME'] = $firstname;
          $html_msg['EMAIL_LAST_NAME']  = $lastname;

          // initial welcome
          $email_text .=  EMAIL_WELCOME;
          $html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);

          if (NEW_SIGNUP_DISCOUNT_COUPON != '' and NEW_SIGNUP_DISCOUNT_COUPON != '0') {
            $coupon_id = NEW_SIGNUP_DISCOUNT_COUPON;
            $coupon = $db->Execute("select * from " . TABLE_COUPONS . " where coupon_id = '" . $coupon_id . "'");
            $coupon_desc = $db->Execute("select coupon_description from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
            $db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");

            // if on, add in Discount Coupon explanation
            //        $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .
            $email_text .= "\n" . EMAIL_COUPON_INCENTIVE_HEADER .
            (!empty($coupon_desc->fields['coupon_description']) ? $coupon_desc->fields['coupon_description'] . "\n\n" : '') .
            strip_tags(sprintf(EMAIL_COUPON_REDEEM, ' ' . $coupon->fields['coupon_code'])) . EMAIL_SEPARATOR;

            $html_msg['COUPON_TEXT_VOUCHER_IS'] = EMAIL_COUPON_INCENTIVE_HEADER ;
            $html_msg['COUPON_DESCRIPTION']     = (!empty($coupon_desc->fields['coupon_description']) ? '<strong>' . $coupon_desc->fields['coupon_description'] . '</strong>' : '');
            $html_msg['COUPON_TEXT_TO_REDEEM']  = str_replace("\n", '', sprintf(EMAIL_COUPON_REDEEM, ''));
            $html_msg['COUPON_CODE']  = $coupon->fields['coupon_code'];
          } //endif coupon

          if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
            $coupon_code = zen_create_coupon_code();
            $insert_query = $db->Execute("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
            $insert_id = $db->Insert_ID();
            $db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

            // if on, add in GV explanation
            $email_text .= "\n\n" . sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) .
            sprintf(EMAIL_GV_REDEEM, $coupon_code) .
            EMAIL_GV_LINK . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . "\n\n" .
            EMAIL_GV_LINK_OTHER . EMAIL_SEPARATOR;
            $html_msg['GV_WORTH'] = str_replace('\n','',sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) );
            $html_msg['GV_REDEEM'] = str_replace('\n','',str_replace('\n\n','<br />',sprintf(EMAIL_GV_REDEEM, '<strong>' . $coupon_code . '</strong>')));
            $html_msg['GV_CODE_NUM'] = $coupon_code;
            $html_msg['GV_CODE_URL'] = str_replace('\n','',EMAIL_GV_LINK . '<a href="' . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . '">' . TEXT_GV_NAME . ': ' . $coupon_code . '</a>');
            $html_msg['GV_LINK_OTHER'] = EMAIL_GV_LINK_OTHER;
          } // endif voucher

          // add in regular email welcome text
          $email_text .= "\n\n" . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_GV_CLOSURE;

          $html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT);
          $html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
          $html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_GV_CLOSURE);

          // include create-account-specific disclaimer
          $email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
          $html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');

          // send welcome email
          // 登録ありがとうメールをカスタマイズできるようにする
          if (MODULE_EMAIL_TEMPLATES_STATUS == 'true') {
            require_once("includes/addon_modules/email_templates/classes/CustomMail.php");
            $CustomMail = new CustomMail();
            $CustomMail->send_welcome_email($_SESSION['customer_id'], $email_address);
          }
          else
            zen_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'welcome');

          // send additional emails
          if (SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_STATUS == '1' and SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO !='') {
            if ($_SESSION['customer_id']) {
              $account_query = "select customers_firstname, customers_lastname, customers_email_address
                                from " . TABLE_CUSTOMERS . "
                                where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

              $account = $db->Execute($account_query);
            }

            $extra_info=email_collect_extra_info($name,$email_address, $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'] , $account->fields['customers_email_address'] );
            $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
            zen_mail('', SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO, SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT . ' ' . EMAIL_SUBJECT,
            $email_text . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'welcome_extra');
          } //endif send extra emails
          $_SESSION['navigation']->clear_snapshot();
          zen_redirect(zen_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));

        } //endif !error
      } else {
        $return = $this->getFormDefault($return);
      }

      return $return;
    }

  }
