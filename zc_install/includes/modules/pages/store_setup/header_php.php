<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 2342 2005-11-13 01:07:55Z drbyte $
 */

if (!isset($_GET['debug'])  && !zen_not_null($_POST['debug']))  define('ZC_UPG_DEBUG',false);
if (!isset($_GET['debug2']) && !zen_not_null($_POST['debug2'])) define('ZC_UPG_DEBUG2',false);
if (!isset($_GET['debug3']) && !zen_not_null($_POST['debug3'])) define('ZC_UPG_DEBUG3',false);

  $zc_install->error = false;

  if (!isset($_POST['store_name'])) $_POST['store_name'] = '';
  if (!isset($_POST['store_owner'])) $_POST['store_owner'] = '';
  if (!isset($_POST['store_owner_email'])) $_POST['store_owner_email'] = '';
  if (!isset($_POST['store_country'])) $_POST['store_country'] = '223';
  if (!isset($_POST['store_zone'])) $_POST['store_zone'] = '';
  if (!isset($_POST['store_address'])) $_POST['store_address'] = STORE_ADDRESS_DEFAULT_VALUE;
  if (!isset($_POST['store_default_language'])) $_POST['store_default_language'] = '';
  if (!isset($_POST['store_default_currency'])) $_POST['store_default_currency'] = '';

  require('../includes/configure.php');
  if (!defined('DB_TYPE') || DB_TYPE=='') {
    echo('Database Type Invalid. Did your configure.php file get written correctly?');
    $zc_install->setError('Database Type Invalid', 27);
  }

  require('../includes/classes/db/' . DB_TYPE . '/query_factory.php');
  $db = new queryFactory;
  $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");


  if (isset($_POST['submit'])) {
    $store_name = zen_db_prepare_input($_POST['store_name']);
    $store_owner = zen_db_prepare_input($_POST['store_owner']);
    $store_owner_email = zen_db_prepare_input($_POST['store_owner_email']);
    $store_country = zen_db_prepare_input($_POST['store_country']);
    $store_zone = zen_db_prepare_input($_POST['store_zone']);
    $store_address = zen_db_prepare_input($_POST['store_address']);
    $store_default_language = zen_db_prepare_input($_POST['store_default_language']);
    $store_default_currency = zen_db_prepare_input($_POST['store_default_currency']);

    $zc_install->isEmpty($store_name, ERROR_TEXT_STORE_NAME_ISEMPTY, ERROR_CODE_STORE_NAME_ISEMPTY);
    $zc_install->isEmpty($store_owner, ERROR_TEXT_STORE_OWNER_ISEMPTY, ERROR_CODE_STORE_OWNER_ISEMPTY);
    $zc_install->isEmpty($store_owner_email, ERROR_TEXT_STORE_OWNER_EMAIL_ISEMPTY, ERROR_CODE_STORE_OWNER_EMAIL_ISEMPTY);
    $zc_install->isEmail($store_owner_email, ERROR_TEXT_STORE_OWNER_EMAIL_NOTEMAIL, ERROR_CODE_STORE_OWNER_EMAIL_NOTEMAIL);
    $zc_install->isEmpty($store_address, ERROR_TEXT_STORE_ADDRESS_ISEMPTY, ERROR_CODE_STORE_ADDRESS_ISEMPTY);
    if ($_POST['demo_install'] == 'true') {
      $zc_install->fileExists('demo/' . DB_TYPE . '_demo.sql', ERROR_TEXT_DEMO_SQL_NOTEXIST, ERROR_CODE_DEMO_SQL_NOTEXIST);
    }

    if ($zc_install->error == false) {
      if ($_POST['demo_install'] == 'true') {
        executeSql('demo/' . DB_TYPE . '_demo.sql', DB_DATABASE, DB_PREFIX);
      }

      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_name) . "' where configuration_key = 'STORE_NAME'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_owner) . "' where configuration_key = 'STORE_OWNER'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_owner_email) . "' where configuration_key in 
             ('STORE_OWNER_EMAIL_ADDRESS', 'EMAIL_FROM', 'SEND_EXTRA_ORDER_EMAILS_TO', 'SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO', 'SEND_EXTRA_LOW_STOCK_EMAILS_TO',
              'SEND_EXTRA_GV_CUSTOMER_EMAILS_TO', 'SEND_EXTRA_GV_ADMIN_EMAILS_TO', 'SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO', 'SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO', 'SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO', 'SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO')";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_country) . "' where configuration_key = 'STORE_COUNTRY'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_zone) . "' where configuration_key = 'STORE_ZONE'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_address) . "' where configuration_key = 'STORE_NAME_ADDRESS'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_default_language) . "' where configuration_key = 'DEFAULT_LANGUAGE'";
      $db->Execute($sql);
      $sql = "update " . DB_PREFIX . "configuration set configuration_value = '" . $db->prepare_input($store_default_currency) . "' where configuration_key = 'DEFAULT_CURRENCY'";
      $db->Execute($sql);
      $db->Close();
      header('location: index.php?main_page=admin_setup&language=' . $language);
      exit;
    }
  }


  //if not submit, set some defaults
  $sql = "select countries_id, countries_name from " . DB_PREFIX . "countries";
  $country = $db->Execute($sql);
  $country_string = '';
  while (!$country->EOF) {
    $country_string .= '<option value="' . $country->fields['countries_id'] . '"' . setSelected($country->fields['countries_id'], $_POST['store_country']) . '>' . $country->fields['countries_name'] . '</option>';
    $country->MoveNext();
  }
  $sql = "select zone_id, zone_name from " . DB_PREFIX . "zones";
  $zone = $db->Execute($sql);
  $zone_string = '';
  while (!$zone->EOF) {
    $zone_string .= '<option value="' . $zone->fields['zone_id'] . '"' . setSelected($zone->fields['zone_id'], $_POST['store_zone']) . '>' . $zone->fields['zone_name'] . '</option>';
    $zone->MoveNext();
  }
  $sql = "select code, name from " . DB_PREFIX . "languages";
  $store_language = $db->Execute($sql);
  $language_string = '';
  while (!$store_language->EOF) {
    $language_string .= '<option value="' . $store_language->fields['code'] . '"' . setSelected($store_language->fields['code'], $_POST['store_default_language']) . '>' . $store_language->fields['name'] . '</option>';
    $store_language->MoveNext();
  }
  $sql = "select title, code from " . DB_PREFIX . "currencies";
  $currency = $db->Execute($sql) or die("error in $sql" . $db->ErrorMsg());;
  $currency_string = '';
  while (!$currency->EOF) {
    $currency_string .= '<option value="' . $currency->fields['code'] . '"' . setSelected($currency->fields['code'], $_POST['store_default_currency']) . '>' . $currency->fields['title'] . '</option>';
    $currency->MoveNext();
  }

  $db->Close();

  if (!isset($_POST['demo_install'])) $_POST['demo_install']=false;

  setInputValue($_POST['store_name'], 'STORE_NAME_VALUE', '');
  setInputValue($_POST['store_owner'], 'STORE_OWNER_VALUE', '');
  setInputValue($_POST['store_owner_email'], 'STORE_OWNER_EMAIL_VALUE', '');
  setInputValue($_POST['store_address'], 'STORE_ADDRESS_VALUE', STORE_ADDRESS_DEFAULT_VALUE);
  setRadioChecked($_POST['demo_install'], 'DEMO_INSTALL', 'false');

// this sets the first field to email address on login - setting in /common/tpl_main_page.php
  $zc_first_field= 'onload="document.getElementById(\'store_name\').focus()"';

?>