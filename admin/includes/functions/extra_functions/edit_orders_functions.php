<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
/* 
 * @version $Id: edit_orders_functions.php, v 1.0.0 11/26/2010 12:00:00 J Theed $
 *
 */

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_get_country_id
  //
  // Arguments   : country_name        country name string
  //
  // Return      : country_id
  //
  // Description : Function to retrieve the country_id based on the country's name
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_get_country_id($country_name) {

   global $db;
    $country_id_query = $db -> Execute("select * from " . TABLE_COUNTRIES . " where countries_name = '" . $country_name . "'");

    if (!$country_id_query->RecordCount()) {
      return 0;
    }
    else {
      return $country_id_query->fields['countries_id'];
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_get_country_iso_code_2
  //
  // Arguments   : country_id        country id number
  //
  // Return      : country_iso_code_2
  //
  // Description : Function to retrieve the country_iso_code_2 based on the country's id
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_get_country_iso_code_2($country_id) {
      global $db;
    $country_iso_query = $db -> Execute("select * from " . TABLE_COUNTRIES . " where countries_id = '" . $country_id . "'");

    if (!zen_db_num_rows($country_iso_query)) {
      return 0;
    }
    else {
      $country_iso_row = zen_db_fetch_array($country_iso_query);
      return $country_iso_row['countries_iso_code_2'];
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_get_zone_id
  //
  // Arguments   : country_id        country id string
  //               zone_name        state/province name
  //
  // Return      : zone_id
  //
  // Description : Function to retrieve the zone_id based on the zone's name
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_get_zone_id($country_id, $zone_name) {
      global $db;
    $zone_id_query = $db -> Execute("select * from " . TABLE_ZONES . " where zone_country_id = '" . $country_id . "' and zone_name = '" . $zone_name . "'");

    if (!$zone_id_query->RecordCount()) {
      return 0;
    }
    else {
      return $zone_id_query->fields['zone_id'];
    }
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_field_exists
  //
  // Arguments   : table    table name
  //               field    field name
  //
  // Return      : true/false
  //
  // Description : Function to check the existence of a database field
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_field_exists($table,$field) {
   global $db;

    $describe_query = $db -> Execute("describe $table");
             while (!$describe_query -> EOF)
    {
      if ($d_row["Field"] == "$field") {
         return true;
      }
      $describe_query -> MoveNext();
    }

    return false;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_html_quotes
  //
  // Arguments   : string    any string
  //
  // Return      : string with single quotes converted to html equivalent
  //
  // Description : Function to change quotes to HTML equivalents for form inputs.
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_html_quotes($string) {
    $stringquotfixed = str_replace("'", "&#39;", $string);
    $stringquotfixed = str_replace('"', '&#34;', $stringquotfixed);
    return $stringquotfixed;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : zen_html_unquote
  //
  // Arguments   : string    any string
  //
  // Return      : string with html equivalent converted back to single quotes
  //
  // Description : Function to change HTML equivalents back to quotes
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function zen_html_unquote($string) {
    return str_replace("&#39;", "'", $string);
  }
  
?>