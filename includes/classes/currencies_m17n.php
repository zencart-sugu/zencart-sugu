<?php
/**
 * currencies Class.
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: currencies.php 3041 2006-02-15 21:56:45Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * currencies Class.
 * Class to handle currencies
 *
 * @package classes
 */
class currenciesM17n extends currencies {
  var $currencies;

  // class constructor
  function currenciesM17n() {
    global $db;
    $this->currencies = array();
    $currencies_query = "select c.code, c.title, cm17n.symbol_left, cm17n.symbol_right, c.decimal_point,
                                  c.thousands_point, c.decimal_places, c.value
                         from " . TABLE_CURRENCIES . " c
                             , " . TABLE_CURRENCIES_M17N . " cm17n
                         where c.currencies_id = cm17n.currencies_id
                         and cm17n.language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $currencies = $db->Execute($currencies_query);

    while (!$currencies->EOF) {
      $this->currencies[$currencies->fields['code']] = array('title' => $currencies->fields['title'],
      'symbol_left' => $currencies->fields['symbol_left'],
      'symbol_right' => $currencies->fields['symbol_right'],
      'decimal_point' => $currencies->fields['decimal_point'],
      'thousands_point' => $currencies->fields['thousands_point'],
      'decimal_places' => $currencies->fields['decimal_places'],
      'value' => $currencies->fields['value']);

      $currencies->MoveNext();
    }
  }

  function currencies() {
    $this->currenciesM17n();
  }
}
?>