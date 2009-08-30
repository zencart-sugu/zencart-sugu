<?php
/**
 * @package shippingMethod
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ups.php 3308 2006-03-29 08:21:33Z ajeh $
 */
/**
 * Enter description here...
 *
 */
class ups extends base {
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $code;
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $title;
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $description;
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $icon;
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $enabled;
  /**
   * Enter description here...
   *
   * @var unknown_type
   */
  var $types;
  /**
   * Enter description here...
   *
   * @return ups
   */
  function ups() {
    global $order, $db, $template;

    $this->code = 'ups';
    $this->title = MODULE_SHIPPING_UPS_TEXT_TITLE;
    $this->description = MODULE_SHIPPING_UPS_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_SHIPPING_UPS_SORT_ORDER;
    $this->icon = $template->get_template_dir('shipping_ups.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'shipping_ups.gif';
    $this->tax_class = MODULE_SHIPPING_UPS_TAX_CLASS;
    $this->tax_basis = MODULE_SHIPPING_UPS_TAX_BASIS;

    // disable only when entire cart is free shipping
    if (zen_get_shipping_enabled($this->code)) {
      $this->enabled = ((MODULE_SHIPPING_UPS_STATUS == 'True') ? true : false);
    }

    if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_UPS_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_UPS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
      while (!$check->EOF) {
        if ($check->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
          $check_flag = true;
          break;
        }
        $check->MoveNext();
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }

    $this->types = array('1DM' => 'Next Day Air Early AM',
    '1DML' => 'Next Day Air Early AM Letter',
    '1DA' => 'Next Day Air',
    '1DAL' => 'Next Day Air Letter',
    '1DAPI' => 'Next Day Air Intra (Puerto Rico)',
    '1DP' => 'Next Day Air Saver',
    '1DPL' => 'Next Day Air Saver Letter',
    '2DM' => '2nd Day Air AM',
    '2DML' => '2nd Day Air AM Letter',
    '2DA' => '2nd Day Air',
    '2DAL' => '2nd Day Air Letter',
    '3DS' => '3 Day Select',
    'GND' => 'Ground',
    'GNDCOM' => 'Ground Commercial',
    'GNDRES' => 'Ground Residential',
    'STD' => 'Canada Standard',
    'XPR' => 'Worldwide Express',
    'XPRL' => 'worldwide Express Letter',
    'XDM' => 'Worldwide Express Plus',
    'XDML' => 'Worldwide Express Plus Letter',
    'XPD' => 'Worldwide Expedited');
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $method
   * @return unknown
   */
  function quote($method = '') {
    global $_POST, $order, $shipping_weight, $shipping_num_boxes;

    if ( (zen_not_null($method)) && (isset($this->types[$method])) ) {
      $prod = $method;
      // BOF: UPS USPS
    } else if ($order->delivery['country']['iso_code_2'] == 'CA') {
      $prod = 'STD';
      // EOF: UPS USPS
    } else {
      $prod = 'GNDRES';
    }

    if ($method) $this->_upsAction('3'); // return a single quote

    $this->_upsProduct($prod);

    $country_name = zen_get_countries(SHIPPING_ORIGIN_COUNTRY, true);
    $this->_upsOrigin(SHIPPING_ORIGIN_ZIP, $country_name['countries_iso_code_2']);
    $this->_upsDest($order->delivery['postcode'], $order->delivery['country']['iso_code_2']);
    $this->_upsRate(MODULE_SHIPPING_UPS_PICKUP);
    $this->_upsContainer(MODULE_SHIPPING_UPS_PACKAGE);
    $this->_upsWeight($shipping_weight);
    $this->_upsRescom(MODULE_SHIPPING_UPS_RES);
    $upsQuote = $this->_upsGetQuote();

    if ( (is_array($upsQuote)) && (sizeof($upsQuote) > 0) ) {
      switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
        case (0):
        $show_box_weight = '';
        break;
        case (1):
        $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
        break;
        case (2):
        $show_box_weight = ' (' . number_format($shipping_weight * $shipping_num_boxes,2) . TEXT_SHIPPING_WEIGHT . ')';
        break;
        default:
        $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
        break;
      }
      $this->quotes = array('id' => $this->code,
      'module' => $this->title . $show_box_weight);

      $methods = array();
      // BOF: UPS USPS
      $allowed_methods = explode(", ", MODULE_SHIPPING_UPS_TYPES);
      $std_rcd = false;
      // EOF: UPS USPS
      $qsize = sizeof($upsQuote);
      for ($i=0; $i<$qsize; $i++) {
        list($type, $cost) = each($upsQuote[$i]);
        // BOF: UPS USPS
        if ($type=='STD') {
          if ($std_rcd) continue;
          else $std_rcd = true;
        }
        if (!in_array($type, $allowed_methods)) continue;
        // EOF: UPS USPS
        $methods[] = array('id' => $type,
        'title' => $this->types[$type],
        'cost' => ($cost + MODULE_SHIPPING_UPS_HANDLING) * $shipping_num_boxes);
      }

      $this->quotes['methods'] = $methods;

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }
    } else {
      /* ORIGINAL
      $this->quotes = array('module' => $this->title,
      'error' => 'An error occurred with the UPS shipping calculations.<br />' . $upsQuote . '<br />If you prefer to use UPS as your shipping method, please contact the store owner.');
      */
      // BOF: UPS USPS
      $this->quotes = array('module' => $this->title,
      'error' => 'We are unable to obtain a rate quote for UPS shipping.<br />Please contact the store if no other alternative is shown.');
      // EOF: UPS USPS
    }

    if (zen_not_null($this->icon)) $this->quotes['icon'] = zen_image($this->icon, $this->title);

    return $this->quotes;
  }
  /**
   * Enter description here...
   *
   * @return unknown
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_UPS_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Enter description here...
   *
   */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable UPS Shipping', 'MODULE_SHIPPING_UPS_STATUS', 'True', 'Do you want to offer UPS shipping?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('UPS Pickup Method', 'MODULE_SHIPPING_UPS_PICKUP', 'CC', 'How do you give packages to UPS? CC - Customer Counter, RDP - Daily Pickup, OTP - One Time Pickup, LC - Letter Center, OCA - On Call Air', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('UPS Packaging?', 'MODULE_SHIPPING_UPS_PACKAGE', 'CP', 'CP - Your Packaging, ULE - UPS Letter, UT - UPS Tube, UBE - UPS Express Box', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Residential Delivery?', 'MODULE_SHIPPING_UPS_RES', 'RES', 'Quote for Residential (RES) or Commercial Delivery (COM)', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Handling Fee', 'MODULE_SHIPPING_UPS_HANDLING', '0', 'Handling fee for this shipping method.', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_UPS_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Tax Basis', 'MODULE_SHIPPING_UPS_TAX_BASIS', 'Shipping', 'On what basis is Shipping Tax calculated. Options are<br />Shipping - Based on customers Shipping Address<br />Billing Based on customers Billing address<br />Store - Based on Store address if Billing/Shipping Zone equals Store zone', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_UPS_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_SHIPPING_UPS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    // BOF: UPS USPS
    //      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Shipping Methods', 'MODULE_SHIPPING_UPS_TYPES', 'Nxt AM,Nxt AM Ltr,Nxt,Nxt Ltr,Nxt PR,Nxt Save,Nxt Save Ltr,2nd AM,2nd AM Ltr,2nd,2nd Ltr,3 Day Select,Ground,Canada,World Xp,World Xp Ltr, World Xp Plus,World Xp Plus Ltr,World Expedite', 'Select the USPS services to be offered.', '6', '13', 'zen_cfg_select_multioption(array(\'1DM\',\'1DML\', \'1DA\', \'1DAL\', \'1DAPI\', \'1DP\', \'1DPL\', \'2DM\', \'2DML\', \'2DA\', \'2DAL\', \'3DS\',\'GND\', \'STD\', \'XPR\', \'XPRL\', \'XDM\', \'XDML\', \'XPD\'), ', now() )");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ( 'Shipping Methods: <br />Nxt AM, Nxt AM Ltr, Nxt, Nxt Ltr, Nxt PR, Nxt Save, Nxt Save Ltr, 2nd AM, 2nd AM Ltr, 2nd, 2nd Ltr, 3 Day Select, Ground, Canada,World Xp, World Xp Ltr, World Xp Plus, World Xp Plus Ltr, World Expedite', 'MODULE_SHIPPING_UPS_TYPES', '1DM, 1DML, 1DA, 1DAL, 1DAPI, 1DP, 1DPL, 2DM, 2DML, 2DA, 2DAL, 3DS, GND, STD, XPR, XPRL, XDM, XDML, XPD', 'Select the UPS services to be offered.', '6', '13', 'zen_cfg_select_multioption(array(\'1DM\',\'1DML\', \'1DA\', \'1DAL\', \'1DAPI\', \'1DP\', \'1DPL\', \'2DM\', \'2DML\', \'2DA\', \'2DAL\', \'3DS\',\'GND\', \'STD\', \'XPR\', \'XPRL\', \'XDM\', \'XDML\', \'XPD\'), ', now() )");
    // EOF: UPS USPS
  }
  /**
   * Enter description here...
   *
   */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
  }
  /**
   * Enter description here...
   *
   * @return unknown
   */
  function keys() {
    return array('MODULE_SHIPPING_UPS_STATUS', 'MODULE_SHIPPING_UPS_PICKUP', 'MODULE_SHIPPING_UPS_PACKAGE', 'MODULE_SHIPPING_UPS_RES', 'MODULE_SHIPPING_UPS_HANDLING', 'MODULE_SHIPPING_UPS_TAX_CLASS', 'MODULE_SHIPPING_UPS_TAX_BASIS', 'MODULE_SHIPPING_UPS_ZONE', 'MODULE_SHIPPING_UPS_SORT_ORDER', 'MODULE_SHIPPING_UPS_TYPES');
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $prod
   */
  function _upsProduct($prod){
    $this->_upsProductCode = $prod;
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $postal
   * @param unknown_type $country
   */
  function _upsOrigin($postal, $country){
    $this->_upsOriginPostalCode = $postal;
    $this->_upsOriginCountryCode = $country;
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $postal
   * @param unknown_type $country
   */
  function _upsDest($postal, $country){
    $postal = str_replace(' ', '', $postal);

    if ($country == 'US') {
      $this->_upsDestPostalCode = substr($postal, 0, 5);
    } else {
      $this->_upsDestPostalCode = $postal;
    }

    $this->_upsDestCountryCode = $country;
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $foo
   */
  function _upsRate($foo) {
    switch ($foo) {
      case 'RDP':
      $this->_upsRateCode = 'Regular+Daily+Pickup';
      break;
      case 'OCA':
      $this->_upsRateCode = 'On+Call+Air';
      break;
      case 'OTP':
      $this->_upsRateCode = 'One+Time+Pickup';
      break;
      case 'LC':
      $this->_upsRateCode = 'Letter+Center';
      break;
      case 'CC':
      $this->_upsRateCode = 'Customer+Counter';
      break;
    }
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $foo
   */
  function _upsContainer($foo) {
    switch ($foo) {
      case 'CP': // Customer Packaging
      $this->_upsContainerCode = '00';
      break;
      case 'ULE': // UPS Letter Envelope
      $this->_upsContainerCode = '01';
      break;
      case 'UT': // UPS Tube
      $this->_upsContainerCode = '03';
      break;
      case 'UEB': // UPS Express Box
      $this->_upsContainerCode = '21';
      break;
      case 'UW25': // UPS Worldwide 25 kilo
      $this->_upsContainerCode = '24';
      break;
      case 'UW10': // UPS Worldwide 10 kilo
      $this->_upsContainerCode = '25';
      break;
    }
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $foo
   */
  function _upsWeight($foo) {
    $this->_upsPackageWeight = $foo;
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $foo
   */
  function _upsRescom($foo) {
    switch ($foo) {
      case 'RES': // Residential Address
      $this->_upsResComCode = '1';
      break;
      case 'COM': // Commercial Address
      $this->_upsResComCode = '0';
      break;
    }
  }
  /**
   * Enter description here...
   *
   * @param unknown_type $action
   */
  function _upsAction($action) {
    /* 3 - Single Quote
    4 - All Available Quotes */

    $this->_upsActionCode = $action;
  }
  /**
   * Enter description here...
   *
   * @return unknown
   */
  function _upsGetQuote() {
    if (!isset($this->_upsActionCode)) $this->_upsActionCode = '4';

    $request = join('&', array('accept_UPS_license_agreement=yes',
    '10_action=' . $this->_upsActionCode,
    '13_product=' . $this->_upsProductCode,
    '14_origCountry=' . $this->_upsOriginCountryCode,
    '15_origPostal=' . $this->_upsOriginPostalCode,
    '19_destPostal=' . $this->_upsDestPostalCode,
    '22_destCountry=' . $this->_upsDestCountryCode,
    '23_weight=' . $this->_upsPackageWeight,
    '47_rate_chart=' . $this->_upsRateCode,
    '48_container=' . $this->_upsContainerCode,
    '49_residential=' . $this->_upsResComCode));
    $http = new httpClient();
    if ($http->Connect('www.ups.com', 80)) {
      $http->addHeader('Host', 'www.ups.com');
      $http->addHeader('User-Agent', 'Zen Cart');
      $http->addHeader('Connection', 'Close');

      if ($http->Get('/using/services/rave/qcostcgi.cgi?' . $request)) $body = $http->getBody();

      $http->Disconnect();
    } else {
      return 'error';
    }

    // BOF: UPS USPS
    /*
    TEST by checking out in the catalog; try a variety of shipping destinations to be sure
    your customers will be properly served.  If you are not getting any quotes, try enabling
    more alternatives in admin. Make sure your store's postal code is set in Admin ->
    Configuration -> Shipping/Packaging, since you won't get any quotes unless there is
    a origin that UPS recognizes.

    If you STILL don't get any quotes, here is a way to find out exactly what UPS is sending
    back in response to rate quote request.  At line 278, you will find this statement in a
    comment block:

    mail('you@yourdomain.com','UPS response',$body,'From: <you@yourdomain.com>');
    */
    // EOF: UPS USPS

    $body_array = explode("\n", $body);

    $returnval = array();
    $errorret = 'error'; // only return error if NO rates returned

    $n = sizeof($body_array);
    for ($i=0; $i<$n; $i++) {
      $result = explode('%', $body_array[$i]);
      $errcode = substr($result[0], -1);
      switch ($errcode) {
        case 3:
        if (is_array($returnval)) $returnval[] = array($result[1] => $result[8]);
        break;
        case 4:
        if (is_array($returnval)) $returnval[] = array($result[1] => $result[8]);
        break;
        case 5:
        $errorret = $result[1];
        break;
        case 6:
        if (is_array($returnval)) $returnval[] = array($result[3] => $result[10]);
        break;
      }
    }
    if (empty($returnval)) $returnval = $errorret;

    return $returnval;
  }
}
?>