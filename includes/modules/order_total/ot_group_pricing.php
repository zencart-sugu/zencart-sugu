<?php
/**
 * @package orderTotal
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_group_pricing.php 2315 2005-11-07 08:41:46Z drbyte $
 */

  class ot_group_pricing {
    var $title, $output;

    function ot_group_pricing() {
      $this->code = 'ot_group_pricing';
      $this->title = MODULE_ORDER_TOTAL_GROUP_PRICING_TITLE;
      $this->description = MODULE_ORDER_TOTAL_GROUP_PRICING_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER;
      $this->include_shipping = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING;
      $this->include_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX;
      $this->credit_tax = MODULE_ORDER_TOTAL_GROUP_PRICING_CREDIT_TAX;
      $this->credit_class = true;

      $this->output = array();
    }

    function process() {
      global $db, $order, $currencies;
      $group_query = $db->Execute("select customers_group_pricing from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      if ($group_query->fields['customers_group_pricing'] != '0') {
        $group_discount = $db->Execute("select group_name, group_percentage from " . TABLE_GROUP_PRICING . " where
                                        group_id = '" . $group_query->fields['customers_group_pricing'] . "'");
        $order_total = $this->get_order_total();
        $gift_vouchers = $_SESSION['cart']->gv_only();
        $discount = ($order_total - $gift_vouchers) * $group_discount->fields['group_percentage'] / 100;
        $od_amount = zen_round($discount, 2);
        if ($this->calculate_tax != "none") {
          $tod_amount = $this->calculate_tax_deduction($order_total, $od_amount, $this->calculate_tax, true);
//          $od_amount = $this->calculate_credit($order_total);
        }
        $this->deduction = $od_amount;
        if ($discount > 0 ) {
          $order->info['total'] -= $this->deduction;
          $this->output[] = array('title' => $this->title . ':',
                                  'text' => '-' . $currencies->format($this->deduction, true, $order->info['currency'], $order->info['currency_value']),
                                  'value' => $this->deduction);
        }
      }
    }

    function get_order_total() {
      global $order;
      $order_total = $order->info['total'];
      if ($this->include_tax == 'false') $order_total = $order_total - $order->info['tax'];
      if ($this->include_shipping == 'false') $order_total = $order_total - $order->info['shipping_cost'];

      return $order_total;
    }

    function calculate_tax_deduction($amount, $od_amount, $method, $finalise = false) {
      global $order;
      $tax_address = zen_get_tax_locations();
      switch ($method) {
        case 'Standard':
        if ($amount == 0) {
          $ratio1 = 0;
        } else {
          $ratio1 = zen_round($od_amount / $amount,2);
        }
        $tod_amount = 0;
        reset($order->info['tax_groups']);
        while (list($key, $value) = each($order->info['tax_groups'])) {
          $tax_rate = zen_get_tax_rate_from_desc($key, $tax_address['country_id'], $tax_address['zone_id']);
          $total_net += $tax_rate * $value;
        }
        if ($od_amount > $total_net) $od_amount = $total_net;
        reset($order->info['tax_groups']);
        while (list($key, $value) = each($order->info['tax_groups'])) {
          $tax_rate = zen_get_tax_rate_from_desc($key, $tax_address['country_id'], $tax_address['zone_id']);
          $net = $tax_rate * $value;
          if ($net > 0) {
            $god_amount = $value * $ratio1;
            $tod_amount += $god_amount;
            if ($finalise) $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
          }
        }
        if ($finalise) $order->info['tax'] -= $tod_amount;
        if ($finalise) $order->info['total'] -= $tod_amount;
        break;
        case 'Credit Note':
          $tax_rate = zen_get_tax_rate($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
          $tax_desc = zen_get_tax_description($this->tax_class, $tax_address['country_id'], $tax_address['zone_id']);
          $tod_amount = $this->deduction / (100 + $tax_rate)* $tax_rate;
          if ($finalise) $order->info['tax_groups'][$tax_desc] -= $tod_amount;
          if ($finalise) $order->info['tax'] -= $tod_amount;
          if ($finalise) $order->info['total'] -= $tod_amount;
        break;
        default:
      }
      return zen_round($tod_amount, 2);
    }

    function pre_confirmation_check($order_total) {
      global $order, $db;
      if ($this->include_shipping == 'false') $order_total -= $order->info['shipping_cost'];
      if ($this->include_tax == 'false') $order_total -= $order->info['tax'];
      $group_query = $db->Execute("select customers_group_pricing from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      if ($group_query->fields['customers_group_pricing'] != '0') {
        $group_discount = $db->Execute("select group_name, group_percentage from " . TABLE_GROUP_PRICING . " where
                                        group_id = '" . $group_query->fields['customers_group_pricing'] . "'");
        $discount = $order_total * $group_discount->fields['group_percentage'] / 100;
        $od_amount = zen_round($discount, 2);
        if ($this->calculate_tax != "none") {
          $tod_amount = $this->calculate_tax_deduction($order_total, $od_amount, $this->calculate_tax);
          $od_amount = $od_amount + $tod_amount;
        }
      }
      return $od_amount + $tod_amount;
    }

    function credit_selection() {
      return $selection;
    }

    function collect_posts() {
    }

    function update_credit_account($i) {
    }

    function apply_credit() {
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('インストール状態', 'MODULE_ORDER_TOTAL_GROUP_PRICING_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_ORDER_TOTAL_GROUP_PRICING_SORT_ORDER', '290', '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('送料を含める', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_SHIPPING', 'false', '送料を計算に含めますか？', '6', '5', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('税金を含める', 'MODULE_ORDER_TOTAL_GROUP_PRICING_INC_TAX', 'true', '税金を計算に含めますか？', '6', '6','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('税金の再計算', 'MODULE_ORDER_TOTAL_GROUP_PRICING_CALC_TAX', 'Standard', '税金を再計算しますか？', '6', '7','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税種別', 'MODULE_ORDER_TOTAL_GROUP_PRICING_TAX_CLASS', '0', '顧客割引をCredit Note（貸方票）取引として利用する際に適応する税種別。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>
