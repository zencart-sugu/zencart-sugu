<?php
/**
 * visitors purchase modules functions.php
 *
 * @package functions
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

function zen_visitors_purchase_is_enabled() {
  if (MODULE_VISITORS_PURCHASE_STATUS == 'true') {
    return true;
  }
  return false;
}


function zen_visitors_purchase_clean_up_visitors_ordrs() {
  global $db;
  if (defined('MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS') && trim(MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS) != '') {
    $query = "
      select
        orders_id, visitors_id, last_modified, date_purchased
      from
        " . TABLE_VISITORS_ORDERS . "
      where
        date_purchased < subdate(now(),INTERVAL " . MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS . " DAY)
        and (
          last_modified is null
          or last_modified < subdate(now(),INTERVAL " . MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS . " DAY)
          )
      ;";
    $result = $db->Execute($query);
    while (!$result->EOF) {
      zen_remove_order($result->fields['orders_id'], false);
      zen_visitors_purchase_delete_visitors_order($result->fields['orders_id']);
      $result->MoveNext();
    }
  }
}

function zen_visitors_purchase_delete_visitors_order($orders_id) {
  global $db;
  $db->Execute("delete from " . TABLE_VISITORS_ORDERS . "
                where orders_id = '" . (int)$orders_id . "'");
}

function zen_visitors_purchase_update_visitors_order($orders_id) {
  $sql_data_array = array(
    'last_modified' => 'now()'
  );
  zen_db_perform(TABLE_VISITORS_ORDERS, $sql_data_array, 'update', "orders_id = '" . (int)$orders_id . "'");

}

function zen_visitors_purchase_is_visitors_order($orders_id) {
  global $db;
  $query = "select count(*) as count from " . TABLE_VISITORS_ORDERS . " where orders_id = '" . (int)$orders_id . "';";
  $result = $db->Execute($query);
  if ($result->fields['count'] > 0) {
    return true;
  }
  return false;
}

