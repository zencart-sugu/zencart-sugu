<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
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
// $Id: ot_loworderfee.php 1969 2005-09-13 06:57:21Z drbyte $
//

  class ot_loworderfee {
    var $title, $output;

    function ot_loworderfee() {
      $this->code = 'ot_loworderfee';
      $this->title = MODULE_ORDER_TOTAL_LOWORDERFEE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_LOWORDERFEE_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;

      if (MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE == 'true') {
        switch (MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION) {
          case 'national':
            if ($order->delivery['country_id'] == STORE_COUNTRY) $pass = true; break;
          case 'international':
            if ($order->delivery['country_id'] != STORE_COUNTRY) $pass = true; break;
          case 'both':
            $pass = true; break;
          default:
            $pass = false; break;
        }

//        if ( ($pass == true) && ( ($order->info['total'] - $order->info['shipping_cost']) < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
        if ( ($pass == true) && ( $order->info['subtotal'] < MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER) ) {
          $charge_it = 'true';
          $cart_content_type = $_SESSION['cart']->get_content_type();
          $gv_content_only = $_SESSION['cart']->gv_only();
          if ($cart_content_type == 'physical' or $cart_content_type == 'mixed') {
            $charge_it = 'true';
          } else {
            // check to see if everything is virtual, if so - skip the low order fee.
            if ((($cart_content_type == 'virtual') and MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL == 'true')) {
              $charge_it = 'false';
            }
            if (($cart_content_type == 'virtual') and ($gv_content_only == $order->info['subtotal']) and (MODULE_ORDER_TOTAL_LOWORDERFEE_GV == 'true')) {
            // check to see if everything is gift voucher, if so - skip the low order fee.
              $charge_it = 'false';
            }
          }

          if ($charge_it == 'true') {
            $tax = zen_get_tax_rate(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);
            $tax_description = zen_get_tax_description(MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS, $order->delivery['country']['id'], $order->delivery['zone_id']);

// calculate from flat fee or percentage
            if (substr(MODULE_ORDER_TOTAL_LOWORDERFEE_FEE, -1) == '%') {
              $low_order_fee = ($order->info['subtotal'] * (MODULE_ORDER_TOTAL_LOWORDERFEE_FEE/100));
            } else {
              $low_order_fee = MODULE_ORDER_TOTAL_LOWORDERFEE_FEE;
            }


            $order->info['tax'] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['tax_groups']["$tax_description"] += zen_calculate_tax($low_order_fee, $tax);
            $order->info['total'] += $low_order_fee + zen_calculate_tax($low_order_fee, $tax);

            $this->output[] = array('title' => $this->title . ':',
                                    'text' => $currencies->format(zen_add_tax($low_order_fee, $tax), true, $order->info['currency'], $order->info['currency_value']),
                                    'value' => zen_add_tax($low_order_fee, $tax));
          }
        }
      }
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = "select configuration_value
                        from " . TABLE_CONFIGURATION . "
                        where configuration_key = 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS'";

        $check_query = $db->Execute($check_query);
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array('MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('インストール状態', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '400', '表示の整列順を設定できます。数字が小さいほど上位に表示されます。', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('低額商品取扱い手数料設定', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', '低額商品取扱い手数料設定を有効にしますか？', '6', '3', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('取扱い手数料を課金する注文金額', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'この注文金額未満の場合手数料を課金します。', '6', '4', 'currencies->format', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values ('低額商品取扱い手数料金額', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'パーセンテージ計算の場合は、%を入力してください。 - 例 10%<br />手数料が一律の場合は、手数料金額を入力してください。- 例 5', '6', '5', '', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('低額商品取扱い手数料を適用する地域の設定', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', '設定した地域に対して低額商品取扱い手数料が適用されます。', '6', '6', 'zen_cfg_select_option(array(\'national\', \'international\', \'both\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税種別', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', '低額商品取扱い手数料金額に適用される税種別', '6', '7', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('ヴァーチャル商品だけの注文には適応しない', 'MODULE_ORDER_TOTAL_LOWORDERFEE_VIRTUAL', 'false', 'ヴァーチャル商品だけの注文の場合は低額商品取扱い手数料は適応しない。', '6', '8', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('ヴァーチャルギフト券だけの注文には適応しない', 'MODULE_ORDER_TOTAL_LOWORDERFEE_GV', 'false', 'ヴァーチャルギフト券だけの注文の場合は低額商品取扱い手数料は適応しない。', '6', '9', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
    }

    function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>
