<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: functions_m17n.php 3415 2007-01-15 04:51:22Z sasaki $
//

////
// Return the manufacturers name in the needed language
// TABLES: manufacturers_info
  function zen_get_manufacturers_name($manufacturer_id, $language_id) {
    global $db;
    $manufacturer = $db->Execute("select manufacturers_name
                                  from " . TABLE_MANUFACTURERS_INFO . "
                                  where manufacturers_id = '" . (int)$manufacturer_id . "'
                                  and languages_id = '" . (int)$language_id . "'");

    return $manufacturer->fields['manufacturers_name'];
  }

  function get_audiences_list_with_language($query_category='email', $display_count="") {
    // used to display drop-down list of available audiences in emailing modules:
    // ie: mail, gv_main, coupon_admin... and eventually newsletters too.
    // gets info from query_builder table

    include_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'audience.php');  //$current_page
    global $db;
    $languages = zen_get_languages();
    $count_array = array();
    $count=0;
    if ($display_count=="") $display_count=AUDIENCE_SELECT_DISPLAY_COUNTS;

    // get list of queries in database table, based on category supplied
    $queries_list = $db->Execute("select query_name, query_string from " . TABLE_QUERY_BUILDER . " " .
                                 "where query_category like '%" . $query_category . "%'");

    $audience_list = array();
    if ($queries_list->RecordCount() > 1) {  // if more than one query record found
      $audience_list[] = array(
        'id' => '',
        'text' => TEXT_SELECT_AN_OPTION
        ); //provide a "not-selected" value
    }

    reset($queries_list);
    while (!$queries_list->EOF) {
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $query_string = $queries_list->fields['query_string'];
        // if requested, show recordcounts at end of descriptions of each entry
        // This could slow things down considerably, so use sparingly !!!!
        if ($display_count=='true' || $display_count ==true ) {  // if it's literal 'true' or logical true
          $languages_query_string = "customers_languages_id = '" . $languages[$i]['id'] . "'";
          if ($languages[$i]['code'] == DEFAULT_LANGUAGE) {
            $languages_query_string = "(" . $languages_query_string . " or customers_languages_id = '0')";
          }
          if (preg_match('/TABLE_CUSTOMERS/', $query_string)) {
            $query_string = preg_replace('/where/i', 'where ' . $languages_query_string . ' and', $query_string);
          }
          if (preg_match('/TABLE_CUSTOMERS c/', $query_string)) {
            $query_string = preg_replace('/customers_languages_id/', 'c.customers_languages_id', $query_string);
          }

          $count_array = $db->Execute(parsed_query_string($query_string));
          $count = $count_array->RecordCount();
        }

        // generate an array consisting of 2 columns which are identical. Key and Text are same.
        // Thus, when the array is used in a Select Box, the key is the same as the displayed description
        // The key can then be used to get the actual select SQL statement using the get...addresses_query function, below.
        if (!preg_match('/TABLE_CUSTOMERS/', $query_string)) {
          $audience_list[] = array(
            'id' => $queries_list->fields['query_name'],
            'text' => $queries_list->fields['query_name'] . ' (' . $count . ')'
            );
          break;
        } else {
          $audience_list[] = array(
            'id' => $queries_list->fields['query_name'] . ',languages_id:' . $languages[$i]['id'],
            'text' => $queries_list->fields['query_name'] .  ' (' . $languages[$i]['name'] . ') (' . $count . ')'
            );
        }
      }
      $queries_list->MoveNext();
    }

    //if this is called by an emailing module which offers individual customers as an option, add all customers email addresses as well.
    if ($query_category=='email') {
      $customers_values = $db->Execute("select c.customers_email_address, c.customers_firstname, c.customers_lastname, c.customers_languages_id, l.name as languages_name " .
                                       "from " . TABLE_CUSTOMERS . " c left join " . TABLE_LANGUAGES . " l on c.customers_languages_id = l.languages_id WHERE c.customers_email_format != 'NONE' " .
                                       "order by c.customers_lastname, c.customers_firstname, c.customers_email_address");
      while(!$customers_values->EOF) {
        $audience_list[] = array(
          'id' => $customers_values->fields['customers_email_address'],
          'text' => $customers_values->fields['customers_firstname'] . ' ' . $customers_values->fields['customers_lastname'] . ' (' . $customers_values->fields['customers_email_address'] . ') ' . $customers_values->fields['languages_name']
          );
        $customers_values->MoveNext();
      }
    }
    // send back the array for display in the SELECT drop-down menu
    return $audience_list;
  }


  function get_audience_sql_query_with_language($selected_entry, $query_category='email') {
    // This is used to take the query_name selected in the drop-down menu or singular customer email address and
    // generate the SQL Select query to be used to build the list of email addresses to be sent to
    // it only returns a query name and query string (SQL SELECT statement)
    // the query string is then used in a $db->Execute() command for later parsing and emailing.
    global $db;
    $query_name='';
    $queries_list = $db->Execute("select query_name, query_string from " . TABLE_QUERY_BUILDER . " " .
                                 "where query_category like '%" . $query_category . "%'");
    //                           "where query_category = '" . $query_category . "'");
    list($selected_entry, $language) = spliti(',', $selected_entry);
    $languages_query_string = '';
    if ($language != '') {
      list($keyname, $customers_languages_id) = spliti(':', $language);
      $customer_language = zen_get_language_code($customers_languages_id);
      $languages_query_string = "customers_languages_id = '" . (int)$customers_languages_id . "'";
      if ($customer_language == DEFAULT_LANGUAGE) {
        $languages_query_string = "(" . $languages_query_string . " or customers_languages_id = '0')";
      }
    }
    while (!$queries_list->EOF) {
      if ($selected_entry == $queries_list->fields['query_name']) {
        $query_string = $queries_list->fields['query_string'];
        $query_name   = $queries_list->fields['query_name'];
        if (preg_match('/TABLE_CUSTOMERS/', $query_string) && $languages_query_string != '') {
          $query_string = preg_replace('/where/i', 'where ' . $languages_query_string . ' and', $query_string);
          $query_name .= ' (' . zen_get_language_name($customers_languages_id) .')';
        }
        if (preg_match('/TABLE_CUSTOMERS c/', $query_string) && $languages_query_string != '') {
          $query_string = preg_replace('/customers_languages_id/', 'c.customers_languages_id', $query_string);
        }

        $query_string = parsed_query_string($query_string);
        //echo 'GET_AUD_EM_ADDR_QRY:<br />query_name='.$query_name.'<br />query_string='.$query_string;
      }
      $queries_list->MoveNext();
    }
    //if no match found against queries listed in database, then $selected_entry must be an email address
    if ($query_name=='' && $query_category=='email') {
      $cust_email_address = zen_db_prepare_input($selected_entry);
      $query_name   = $cust_email_address;
      $query_string = "select customers_firstname, customers_lastname, customers_email_address, customers_languages_id
                       from " . TABLE_CUSTOMERS . "
                       where customers_email_address = '" . zen_db_input($cust_email_address) . "'";
      $mail = $db->Execute($query_string);
      $customers_languages_id = $mail->fields['customers_languages_id'];
      $query_name .= ' (' . zen_get_language_name($customers_languages_id) .')';
    }
    //send back a 1-row array containing the query_name and the SQL query_string
    return array('query_name'=>$query_name, 'query_string'=>$query_string, 'customers_languages_id' => $customers_languages_id);
  }


////
// lookup language_code
  function zen_get_language_code($languages_id) {
    global $db;
    $check_language= $db->Execute("select code from " . TABLE_LANGUAGES . " where languages_id = '" . (int)$languages_id . "'");
    if ($check_language->fields['code'] != '') {
      return $check_language->fields['code'];
    }
    return DEFAULT_LANGUAGE;
  }


////
// restore_language
  function zen_restore_language($language = '') {
    include_once(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($language) && zen_not_null($language)) {
      $lng->set_language($language);
    } else {
      $lng->get_browser_language();
      $lng->set_language(DEFAULT_LANGUAGE);
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];
  }

  function zen_get_customers_language_id($customers_id) {
    global $db;
    $query = "
      select
        l.languages_id
      from
        " . TABLE_LANGUAGES . " l
        , " . TABLE_CUSTOMERS . " c
      where
        l.languages_id = c.customers_languages_id
        and c.customers_id = '" . (int)$customers_id . "'
      ";
    $result = $db->Execute($query);
    if ($result->RecordCount() > 0) {
      return $result->fields['languages_id'];
    }

    return false;
  }
  
  function zen_get_orders_language_id($orders_id) {
    global $db;
    $query = "
      select
        l.languages_id
      from
        " . TABLE_LANGUAGES . " l
        , " . TABLE_CUSTOMERS . " c
        , " . TABLE_ORDERS . " o
      where
        l.languages_id = c.customers_languages_id
        and c.customers_id = o.customers_id
        and o.orders_id = '" . (int)$orders_id . "'
      ";
    $result = $db->Execute($query);
    if ($result->RecordCount() > 0) {
      return $result->fields['languages_id'];
    }

    return false;
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