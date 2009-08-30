<?php
/**
 * checkout_new_address.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_address_book.php 3012 2006-02-11 16:34:02Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$radio_buttons = 0;

// ->furikana
if (FURIKANA_NESESSARY) {
  $addresses_query = "select address_book_id, entry_firstname as firstname, entry_lastname as lastname,
                                 entry_firstname_kana as firstname_kana, entry_lastname_kana as lastname_kana,
                                 entry_company as company, entry_street_address as street_address,
                                 entry_suburb as suburb, entry_city as city, entry_postcode as postcode,
                                 entry_state as state, entry_zone_id as zone_id,
                                 entry_country_id as country_id
  								 , entry_telephone as telephone
  								 , entry_fax as fax
                          from " . TABLE_ADDRESS_BOOK . "
                          where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
}
else {
  $addresses_query = "select address_book_id, entry_firstname as firstname, entry_lastname as lastname,
                                 entry_company as company, entry_street_address as street_address,
                                 entry_suburb as suburb, entry_city as city, entry_postcode as postcode,
                                 entry_state as state, entry_zone_id as zone_id,
                                 entry_country_id as country_id
  								 , entry_telephone as telephone
  								 , entry_fax as fax
                          from " . TABLE_ADDRESS_BOOK . "
                          where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
}
// <-furikana

$addresses = $db->Execute($addresses_query);

while (!$addresses->EOF) {
  $format_id = zen_get_address_format_id($addresses->fields['country_id']);
  $radio_buttons++;
  $addresses->MoveNext();
}
// run again so available for listing loop
$addresses = $db->Execute($addresses_query);
?>