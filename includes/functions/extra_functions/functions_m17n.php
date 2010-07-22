<?php
/**
 * functions_m17n
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions_m17n.php 2618 2008-01-15 00:35:47Z sasaki $
 */

////
// Returns the address_format_id for the given country
// TABLES: countries;

function zen_update_customers_language($customers_id, $languages_id) {
  global $db;
  $sql_data_array = array(
    array('fieldName' => 'customers_languages_id', 'value' => $languages_id, 'type' => 'integer')
  );
  $where_clause = "customers_id = :customersID";
  $where_clause = $db->bindVars($where_clause, ':customersID', $customers_id, 'integer');
  $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
}

////
// Return the zone name in the needed language
// TABLES: zones_name
  function zen_get_zone_name_m17n($zone_id, $language_id) {
    global $db;
    $zone = $db->Execute("select zone_name_m17n
                          from " . TABLE_ZONES_M17N . "
                          where zone_id = '" . (int)$zone_id . "'
                          and language_id = '" . (int)$language_id . "'");

    return $zone->fields['zone_name_m17n'];
  }

  function zen_convert_to_zone_name_m17n($zone_name, $language_id = null) {
    global $db;
    if (is_null($language_id)) {
      $language_id = $_SESSION['languages_id'];
    }
    $zone = $db->Execute("select zm17n.zone_name_m17n
                          from " . TABLE_ZONES_M17N . " zm17n
                          , " . TABLE_ZONES . " z
                          where zm17n.zone_id = z.zone_id
                          and zm17n.language_id = '" . (int)$language_id . "'
                          and z.zone_name like binary '" . zen_db_input($zone_name) . "'");

    return $zone->fields['zone_name_m17n'];
  }

  function zen_convert_to_zone_name($zone_name_m17n, $language_id = null) {
    global $db;
    if (is_null($language_id)) {
      $language_id = $_SESSION['languages_id'];
    }
    $zone = $db->Execute("select z.zone_name
                          from " . TABLE_ZONES . " z
                          , " . TABLE_ZONES_M17N . " zm17n
                          where z.zone_id = zm17n.zone_id
                          and zm17n.language_id = '" . (int)$language_id . "'
                          and zm17n.zone_name_m17n like binary '" . zen_db_input($zone_name_m17n) . "'");

    return $zone->fields['zone_name'];
  }

  function zen_get_languages_id_by_code($code) {
    global $db;
    $query = "
      select languages_id
      from " . TABLE_LANGUAGES . "
      where code like '" . zen_db_input($code) . "';";
    $result = $db->Execute($query);
    if ($result->RecordCount() > 0) {
      return $result->fields['languages_id'];
    }
    return false;
  }
    function zen_get_tax_class_title_m17n($tax_class_id, $language_id) {
    global $db;
    $tax_class = $db->Execute("select tax_class_title
                               from " . TABLE_TAX_CLASS_M17N . "
                               where tax_class_id = '" . (int)$tax_class_id . "'
                               and language_id = '" . (int)$language_id . "'");

    return $tax_class->fields['tax_class_title'];
  }

  function zen_get_tax_class_description_m17n($tax_class_id, $language_id) {
    global $db;
    $tax_class = $db->Execute("select tax_class_description
                               from " . TABLE_TAX_CLASS_M17N . "
                               where tax_class_id = '" . (int)$tax_class_id . "'
                               and language_id = '" . (int)$language_id . "'");

    return $tax_class->fields['tax_class_description'];
  }

  function zen_get_tax_description_m17n($tax_rates_id, $language_id) {
    global $db;
    $tax_rates = $db->Execute("select tax_description
                               from " . TABLE_TAX_RATES_M17N . "
                               where tax_rates_id = '" . (int)$tax_rates_id . "'
                               and language_id = '" . (int)$language_id . "'");

    return $tax_rates->fields['tax_description'];
  }

  function zen_get_symbol_left_m17n($currencies_id, $language_id) {
    global $db;
    $tax_rates = $db->Execute("select symbol_left
                               from " . TABLE_CURRENCIES_M17N . "
                               where currencies_id = '" . (int)$currencies_id . "'
                               and language_id = '" . (int)$language_id . "'");

    return $tax_rates->fields['symbol_left'];
  }

  function zen_get_symbol_right_m17n($currencies_id, $language_id) {
    global $db;
    $tax_rates = $db->Execute("select symbol_right
                               from " . TABLE_CURRENCIES_M17N . "
                               where currencies_id = '" . (int)$currencies_id . "'
                               and language_id = '" . (int)$language_id . "'");

    return $tax_rates->fields['symbol_right'];
  }

  function zen_get_group_name_m17n($group_id, $language_id) {
    global $db;
    $group = $db->Execute("select group_name
                           from " . TABLE_GROUP_PRICING_M17N . "
                           where group_id = '" . (int)$group_id . "'
                           and language_id = '" . (int)$language_id . "'");

    return $group->fields['group_name'];
  }
?>