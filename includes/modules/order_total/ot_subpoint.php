<?php
/**
 * Order Total Sub Point Module
 *
 * @package point
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: ot_subpoint.php $
 */

  class ot_subpoint {
    var $title, $output;
    var $require_modules = array('point_base');

    function ot_subpoint() {
      global $currencies;
      $this->code = 'ot_subpoint';
      $this->title = MODULE_ORDER_TOTAL_SUBPOINT_TITLE;
      $this->header = MODULE_ORDER_TOTAL_SUBPOINT_HEADER;
      $this->description = MODULE_ORDER_TOTAL_SUBPOINT_DESCRIPTION;
      $this->user_prompt = MODULE_ORDER_TOTAL_SUBPOINT_USER_PROMPT;
      $this->sort_order = MODULE_ORDER_TOTAL_SUBPOINT_SORT_ORDER;
      $this->include_shipping = MODULE_ORDER_TOTAL_SUBPOINT_INC_SHIPPING;
      $this->include_tax = MODULE_ORDER_TOTAL_SUBPOINT_INC_TAX;
      $this->calculate_tax = MODULE_ORDER_TOTAL_SUBPOINT_CALC_TAX;
      $this->credit_tax = MODULE_ORDER_TOTAL_SUBPOINT_CREDIT_TAX;
      $this->tax_class  = MODULE_ORDER_TOTAL_SUBPOINT_TAX_CLASS;
      $this->show_redeem_box = MODULE_ORDER_TOTAL_SUBPOIN_REDEEM_BOX;
      $this->credit_class = true;
      if (!zen_not_null(ltrim($_SESSION['cot_subpoint'], ' 0')) || $_SESSION['cot_subpoint'] == '0') $_SESSION['cot_subpoint'] = '0';
      $this->checkbox = $this->user_prompt . '<input type="textfield" size="6" onchange="submitFunction()" name="cot_subpoint" value="' . number_format($_SESSION['cot_subpoint'], 0, null, '') . '" onfocus="if (this.value == \'' . number_format($_SESSION['cot_subpoint'], 0, null, '') . '\') this.value = \'\';" />' . ($this->user_has_subpoint_account($_SESSION['customer_id']) > 0 ? '<br />' . MODULE_ORDER_TOTAL_SUBPOINT_USER_BALANCE . $currencies->format($this->user_has_subpoint_account($_SESSION['customer_id'])) : '');
      $this->output = array();

      $this->enabled = ((MODULE_ORDER_TOTAL_SUBPOINT_STATUS == 'true' && MODULE_POINT_BASE_STATUS == 'true') ? true : false);
    }


    function process() {
      global $order, $currencies;
      if ($_SESSION['cot_subpoint']) {
        $order_total = $this->get_order_total();
        $od_amount = $this->calculate_credit($order_total);
        if ($this->calculate_tax != "none") {
          $tod_amount = zen_round($this->calculate_tax_deduction($order_total, $od_amount, $this->calculate_tax, true), 0);
          $od_amount = $this->calculate_credit($order_total);
        }
        $this->deduction = $od_amount + $tod_amount;
        $order->info['total'] = zen_round($order->info['total'] - $this->deduction, 0);
        if ($od_amount > 0) {
          $this->output[] = array('title' => $this->title . '',
          'text' => '-' . $currencies->format($this->deduction),
          'value' => $this->deduction * -1);
        }
      }
    }

    function clear_posts() {
      unset($_SESSION['cot_subpoint']);
    }
    function selection_test() {
      if ($this->user_has_subpoint_account($_SESSION['customer_id'])) {
        return true;
      } else {
        return false;
      }
    }

    function pre_confirmation_check($order_total) {
      global $order;
      // clean out negative values and strip common currency symbols
      $_SESSION['cot_subpoint'] = str_replace(array('$','%','#','\\'), '', $_SESSION['cot_subpoint']);  // eucでは表せない
      $_SESSION['cot_subpoint'] = abs($_SESSION['cot_subpoint']);

      if ($_SESSION['cot_subpoint'] > 0) {
        if ($this->include_shipping == 'false') $order_total -= $order->info['shipping_cost'];
        if ($this->include_tax == 'false') $order_total -= $order->info['tax'];
        if (ereg('[^0-9/.]', trim($_SESSION['cot_subpoint']))) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_REDEEM_POINT), 'SSL',true, false));
        }
        if ($_SESSION['cot_subpoint'] > $this->user_has_subpoint_account($_SESSION['customer_id'])) {
          zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'credit_class_error_code=' . $this->code . '&credit_class_error=' . urlencode(TEXT_INVALID_REDEEM_POINT), 'SSL',true, false));
        }
        $od_amount = $this->calculate_credit($order_total);
        if ($this->calculate_tax != "none") {
          $tod_amount = $this->calculate_tax_deduction($order_total, $od_amount, $this->calculate_tax);
          $od_amount = $this->calculate_credit($order_total)+$tod_amount;
        }
        if ($od_amount >= $order->info['total'] && MODULE_ORDER_TOTAL_SUBPOINT_ORDER_STATUS_ID != 0) $order->info['order_status'] = MODULE_ORDER_TOTAL_SUBPOINT_ORDER_STATUS_ID;
      }
      return $od_amount + $tod_amount;
    }

    function use_credit_amount() {
      if ($this->selection_test()) {
        $output_string = $this->checkbox;
      }
      return $output_string;
    }

    function update_credit_account() {
      return false;
    }

    function credit_selection() {
      global $db, $currencies;
      if ($this->use_credit_amount()) {
        $selection = array(
          'id' => $this->code,
          'module' => $this->title,
          'redeem_instructions' => MODULE_ORDER_TOTAL_SUBPOINT_REDEEM_INSTRUCTIONS,
          'checkbox' => $this->use_credit_amount(),
          'fields' => array(
            array(
              'tag' => 'disc-'.$this->code
              )
            )
          );

      }
      return $selection;
    }

    function apply_credit() {
      global $insert_id, $order;
      if ($_SESSION['cot_subpoint'] > 0 && $this->enabled) {
        require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
        $point =& new point($_SESSION['customer_id']);
        $id = $point->sub($_SESSION['cot_subpoint'], sprintf(MODULE_ORDER_TOTAL_SUBPOINT_HISTORY_DESCRIPTION, $insert_id), $this->code, 'orders_id', $insert_id);
        $subpoint_payment_amount = $this->deduction;
      }

      $_SESSION['cot_subpoint'] = false;
      return $subpoint_payment_amount;
    }


    function collect_posts() {
      global $db, $currencies, $messageStack;
      if (!$_POST['cot_subpoint']) $_SESSION['cot_subpoint'] = '0';
    }

    function calculate_credit($amount) {
      global $db, $order;
      $subpoint_payment_amount = $_SESSION['cot_subpoint'];
      $subpoint_amount = $subpoint_payment_amount;
      $save_total_cost = $amount;
      $full_cost = $save_total_cost - $subpoint_payment_amount;
      if ($full_cost < 0) {
        $full_cost = 0;
        $subpoint_payment_amount = $save_total_cost;
      }
      return zen_round($subpoint_payment_amount, 0);
    }

    function calculate_tax_deduction($amount, $od_amount, $method, $finalise = false) {
      global $order;
      $tax_address = zen_get_tax_locations();
      switch ($method) {
        case 'Standard':
        $ratio1 = zen_round($od_amount / $amount, 0);
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
      return $tod_amount;
    }

    function user_has_subpoint_account($c_id) {
      if (MODULE_POINT_BASE_STATUS == 'true') {
      require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
      $point =& new point($c_id);
      $subpoint = $point->getCustomersPoints();
      if ($subpoint) {
        return $subpoint['deposit'];
      }
      }
      return 0; // was preventing checkout_payment from continuing
    }

    function get_order_total() {
      global $order;
      $order_total = $order->info['total'];
      if ($this->include_tax == 'false') $order_total = $order_total - $order->info['tax'];
      if ($this->include_shipping == 'false') $order_total = $order_total - $order->info['shipping_cost'];

      return $order_total;
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_SUBPOINT_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array(
        'MODULE_ORDER_TOTAL_SUBPOINT_STATUS',
        'MODULE_ORDER_TOTAL_SUBPOINT_INC_SHIPPING',
        'MODULE_ORDER_TOTAL_SUBPOINT_INC_TAX',
        'MODULE_ORDER_TOTAL_SUBPOINT_CALC_TAX',
        'MODULE_ORDER_TOTAL_SUBPOINT_TAX_CLASS',
        'MODULE_ORDER_TOTAL_SUBPOINT_CREDIT_TAX',
        'MODULE_ORDER_TOTAL_SUBPOINT_ORDER_STATUS_ID',
        'MODULE_ORDER_TOTAL_SUBPOINT_CANCEL_ORDER_STATUS_ID',
        'MODULE_ORDER_TOTAL_SUBPOINT_SORT_ORDER'
        );
    }

    function install() {
      global $db, $messageStack;
      if ($this->requireModules()) {
        $messageStack->add_session(sprintf(ERROE_MODULE_INSTALL_FAILED, $this->code), 'error');
        zen_redirect(zen_href_link(FILENAME_MODULES, 'set=ordertotal&module=' . $this->code, 'NONSSL'));
        exit();
      }

      $i = 0;
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function, date_added)
        values
          ('使用ポイントモジュールの有効化', 'MODULE_ORDER_TOTAL_SUBPOINT_STATUS', 'false',
          '使用ポイントモジュールを有効にしますか？<br />true: 有効<br />false: 無効',
          '6', '" . $i++ . "','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function ,date_added)
        values
          ('送料を含める', 'MODULE_ORDER_TOTAL_SUBPOINT_INC_SHIPPING', 'true',
          '送料を計算に含めますか？',
          '6', '" . $i++ . "', 'zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function ,date_added)
        values
          ('税金を含める', 'MODULE_ORDER_TOTAL_SUBPOINT_INC_TAX', 'true',
          '税金を計算に含めますか？',
          '6', '" . $i++ . "','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function ,date_added)
        values
          ('税金を再計算する', 'MODULE_ORDER_TOTAL_SUBPOINT_CALC_TAX', 'None',
          '税金を再計算しますか？',
          '6', '" . $i++ . "','zen_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, use_function, set_function, date_added)
        values
          ('税種別', 'MODULE_ORDER_TOTAL_SUBPOINT_TAX_CLASS', '0',
          'ポイントに適用される税種別',
          '6', '" . $i++ . "', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function ,date_added)
        values
          ('ポイントに税金を付加する', 'MODULE_ORDER_TOTAL_SUBPOINT_CREDIT_TAX', 'false',
          'ポイント購入時に税金を付加しますか？',
          '6', '" . $i++ . "','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function, use_function, date_added)
        values
          ('注文ステータス', 'MODULE_ORDER_TOTAL_SUBPOINT_ORDER_STATUS_ID', '0',
          'ポイントで全額支払いを行った場合の注文ステータスを設定します。',
          '6', '" . $i++ . "', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function, use_function, date_added)
        values
          ('使用ポイントを取消す注文ステータス', 'MODULE_ORDER_TOTAL_SUBPOINT_CANCEL_ORDER_STATUS_ID', '0',
          '設定した注文ステータスに更新された時に使用ポイントを取り消します。',
          '6', '" . $i++ . "', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())
        ");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, date_added)
        values
          ('表示の整列順', 'MODULE_ORDER_TOTAL_SUBPOINT_SORT_ORDER', '860',
          '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',
          '6', '" . $i++ . "', now())");
    }

    function remove() {
      global $db, $messageStack;
      if ($this->dependModules()) {
        $messageStack->add_session(sprintf(ERROE_MODULE_REMOVE_FAILED, $this->code), 'error');
        zen_redirect(zen_href_link(FILENAME_MODULES, 'set=ordertotal&module=' . $this->code, 'NONSSL'));
        exit();
      }

      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function requireModules() {
      global $messageStack;
      $error = false;
      for ($i = 0, $n = count($this->require_modules); $i < $n; $i++) {
        $module = null;
        $class = $this->require_modules[$i];
        $module_directory = DIR_FS_CATALOG_ADDON_MODULES;
        if (!is_object($GLOBALS[$class])) {
          if(zen_addOnModules_load_module_files($module_directory, $class)) {
            $GLOBALS[$class] = new $class;
          } else {
            $error = true;
            $messageStack->add_session(sprintf(ERROR_REQUIRE_MODULE, $class), 'error');
          }
        }
        if (!$GLOBALS[$class]->enabled && !$error) {
          $error = true;
          $messageStack->add_session(sprintf(WARNING_REQUIRE_MODULE, $class), 'warning');
        }
      }

      return $error;
    }

    function dependModules() {
      global $messageStack;

      $module_directory = DIR_FS_CATALOG_ADDON_MODULES;
      $module_key = 'ADDON_MODULE_INSTALLED';

      eval('$module_installed = ' . $module_key . ';');

      if (defined($module_key) && zen_not_null($module_installed)) {
        $modules = explode(';', $module_installed);
        reset($modules);

        while (list(, $value) = each($modules)) {
          $module = null;
          $class = $value;
          if (!is_object($GLOBALS[$class])) {
            zen_addOnModules_load_module_files($module_directory, $class);
            $GLOBALS[$class] = new $class;
          }

          $require_modules = $GLOBALS[$class]->require_modules;
          for ($i = 0, $n = count($require_modules); $i < $n; $i++) {
            if ($require_modules[$i] == $this->code) {
              $error = true;
              $messageStack->add_session(sprintf(WARNING_DEPEND_MODULE, $class), 'warning');
            }
          }
        }
      }

      return $error;
    }
  }
?>