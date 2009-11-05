<?php
/**
 * visitors modules functions.php
 *
 * @package functions
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

function zen_visitors_reset_session_vars() {
  $temp_session_vars = array(
    'initiated' => $_SESSION['initiated'],
    'customers_host_address' => $_SESSION['customers_host_address'],
    'cartID' => $_SESSION['cartID'],
    'cart' => $_SESSION['cart'],
    'navigation' => $_SESSION['navigation'],
    'check_valid' => $_SESSION['check_valid'],
    'language' => $_SESSION['language'],
    'languages_id' => $_SESSION['languages_id'],
    'languages_code' => $_SESSION['languages_code'],
    'currency' => $_SESSION['currency'],
    'session_counter' => $_SESSION['session_counter'],
    'customers_ip_address' => $_SESSION['customers_ip_address']
  );
  $_SESSION = $temp_session_vars;
}

function zen_visitors_delete_visitor($visitors_id) {
  global $db;
  $db->Execute("delete from " . TABLE_ADDRESS_BOOK . "
                where customers_id = '" . (int)$visitors_id . "'");

  $db->Execute("delete from " . TABLE_CUSTOMERS . "
                where customers_id = '" . (int)$visitors_id . "'");

  $db->Execute("delete from " . TABLE_CUSTOMERS_INFO . "
                where customers_info_id = '" . (int)$visitors_id . "'");

  $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET . "
                where customers_id = '" . (int)$visitors_id . "'");

  $db->Execute("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                where customers_id = '" . (int)$visitors_id . "'");

  $db->Execute("delete from " . TABLE_WHOS_ONLINE . "
                where customer_id = '" . (int)$visitors_id . "'");

  zen_visitors_delete_visitors_data($visitors_id);
}

function zen_visitors_delete_visitors_data($visitors_id) {
  global $db;
  $db->Execute("delete from " . TABLE_VISITORS . "
                where visitors_id = '" . (int)$visitors_id . "'");
}

function zen_visitors_update_visitors_data($customers_id, $customers_email_address) {
  global $db;
  $customers_id = zen_db_prepare_input($customers_id);
  $customers_email_address = zen_db_prepare_input($customers_email_address);
  $check_email = $db->Execute("select customers_email_address
                               from " . TABLE_CUSTOMERS . "
                               where customers_email_address = '" . zen_db_input($customers_email_address) . "'
                               and customers_id != '" . (int)$customers_id . "'");

  if (!$check_email->RecordCount()) {
    $sql_data_array = array(
      'visitors_email_address' => $customers_email_address,
      'visitors_info_date_account_last_modified' => 'now()'
    );
    zen_db_perform(TABLE_VISITORS, $sql_data_array, 'update', "visitors_id = '" . (int)$customers_id . "'");
  }
}

function zen_visitors_is_alive($visitors_id) {
  global $db;
  $query = "
    select count(*) count
    from " . TABLE_VISITORS . "
    where visitors_id = :visitorsID
    ;";
  $query = $db->bindVars($query, ':visitorsID', $visitors_id, 'integer');
  $result = $db->Execute($query);
  if ($result->fields['count'] > 0) {
    return true;
  }
  return false;
}

function zen_visitors_is_enabled() {
  if (MODULE_VISITORS_STATUS == 'true') {
    return true;
  }
  return false;
}

function zen_visitors_is_visitor() {
  if (zen_visitors_is_enabled() && !empty($_SESSION['visitors_id'])) {
    return true;
  }
  return false;
}

function zen_visitors_clean_up_visitors() {
  global $db;
  if (defined('MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS') && trim(MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS) != '') {
    $query = "
      select
        visitors_id, visitors_email_address,
        visitors_info_date_account_created,
        visitors_info_date_account_last_modified
      from
        " . TABLE_VISITORS . "
      where
        visitors_info_date_account_created < subdate(now(),INTERVAL " . MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS . " DAY)
        and (
          visitors_info_date_account_last_modified is null
          or visitors_info_date_account_last_modified < subdate(now(),INTERVAL " . MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS . " DAY)
          )
      ;";
    $result = $db->Execute($query);
    while (!$result->EOF) {
      zen_visitors_delete_visitor($result->fields['visitors_id']);
      $result->MoveNext();
    }
  }
}

function zen_visitors_is_visitors_account($customers_id) {
  global $db;
  $query = "select count(*) as count from " . TABLE_VISITORS . " where visitors_id = '" . (int)$customers_id . "';";
  $result = $db->Execute($query);
  if ($result->fields['count'] > 0) {
    return true;
  }
  return false;
}

