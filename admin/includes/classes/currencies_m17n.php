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
//  $Id: currencies.php 1969 2005-09-13 06:57:21Z drbyte $
//

////
// Class to handle currencies
// TABLES: currencies
class currenciesM17n extends currencies {
  var $currencies;

  // class constructor
  function currenciesM17n() {
    global $db;
    $this->currencies = array();
    $currencies = $db->Execute("select c.code, c.title, cm17n.symbol_left, cm17n.symbol_right, c.decimal_point,
                                       c.thousands_point, c.decimal_places, c.value
                                from " . TABLE_CURRENCIES . " c
                                , " . TABLE_CURRENCIES_M17N . " cm17n
                                where c.currencies_id = cm17n.currencies_id
                                and cm17n.language_id = '" . (int)$_SESSION['languages_id'] . "'");

    while (!$currencies->EOF) {
      $this->currencies[$currencies->fields['code']] = array(
        'title' => $currencies->fields['title'],
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