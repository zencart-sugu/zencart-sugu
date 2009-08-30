<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS - Version 1.0                          //
//                                                      //
//  By Frank Koehl  (fkoehl@gmail.com)                  //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
*/

  class purchaseorder {
    var $code, $title, $description, $enabled;

// class constructor
    function purchaseorder() {
      global $order;

      $this->code = 'purchaseorder';
      $this->title = MODULE_PAYMENT_PURCHASE_ORDER_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PURCHASE_ORDER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PURCHASE_ORDER_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    
      $this->email_footer = MODULE_PAYMENT_PURCHASE_ORDER_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PURCHASE_ORDER_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PURCHASE_ORDER_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_PURCHASE_ORDER_TEXT_DESCRIPTION);
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PURCHASE_ORDER_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Purchase Order Module', 'MODULE_PAYMENT_PURCHASE_ORDER_STATUS', 'True', 'Do you want to accept Purchase Order payments?', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Make payable to:', 'MODULE_PAYMENT_PURCHASE_ORDER_PAYTO', '', 'Who should payments be made payable to?', '6', '2', now());");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '4', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PURCHASE_ORDER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '5', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '6', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PURCHASE_ORDER_STATUS', 'MODULE_PAYMENT_PURCHASE_ORDER_ZONE', 'MODULE_PAYMENT_PURCHASE_ORDER_ORDER_STATUS_ID', 'MODULE_PAYMENT_PURCHASE_ORDER_SORT_ORDER', 'MODULE_PAYMENT_PURCHASE_ORDER_PAYTO');
    }
  }
?>