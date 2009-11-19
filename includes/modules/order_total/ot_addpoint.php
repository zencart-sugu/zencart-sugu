<?php
/**
 * Order Total Add Point Module
 *
 * @package point
 * @copyright Copyright (C) 2008 Liquid System Technology, Inc.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: ot_addpoint.php $
 */

  class ot_addpoint {
    var $title, $output;
    var $point;
    var $require_modules = array('point_base');

    function ot_addpoint() {
      $this->code = 'ot_addpoint';
      $this->credit_class = true;
      $this->title = MODULE_ORDER_TOTAL_ADDPOINT_TITLE;
      $this->description = MODULE_ORDER_TOTAL_ADDPOINT_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_ADDPOINT_STATUS == 'true' && MODULE_POINT_BASE_STATUS == 'true') ? true : false);
      $this->rate = (int)MODULE_ORDER_TOTAL_ADDPOINT_RATE;
      $this->amount = 0;
      $this->point = 0;
      $this->sort_order = MODULE_ORDER_TOTAL_ADDPOINT_SORT_ORDER;

      $this->output = array();

      if ($this->enabled
        && defined('IS_VISITORS_SESSION')) {
        if (IS_VISITORS_SESSION !== true) {
          $this->enabled = false;
        }
      }
    }

    function process() {
      global $order;
      $this->_calcAddPoint();
      if ($this->point > 0 && $this->enabled) {
      $this->output[] = array(
        'title' => $this->title . '',
        'text' => $this->point . TEXT_POINT,
        'value' => $this->point);
      }
    }

    function _calcAddPoint() {
      global $db, $order;
      require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
      $point =& new point($_SESSION['customer_id']);
      $this->amount = 0;
      $this->point = 0;

      if (MODULE_POINT_PRODUCTSRATE_STATUS == 'true') {
        foreach ($order->products as $fields) {
          $products_id = zen_get_prid($fields['id']);
          $products_pointrate = $GLOBALS['point_productsrate']->getPointRate($products_id);
          if ($products_pointrate !== false) {
            $this->point +=  (int)($fields['final_price'] * $fields['qty'] * $products_pointrate / 100);
          } else {
            $this->amount += $fields['final_price'] * $fields['qty'];
          }
        }

      } else {
        foreach ($order->products as $fields) {
          $this->amount += $fields['final_price'] * $fields['qty'];
        }
      }

      if (MODULE_POINT_GROUPRATE_STATUS == 'true') {
        $query = "
          select
            customers_group_pricing
          from
            " . TABLE_CUSTOMERS . "
          where
            customers_id = :customersID
          ;";
        $query = $db->bindVars($query, ':customersID', $_SESSION['customer_id'], 'integer');
        $result = $db->Execute($query);
        if ($result->RecordCount() > 0) {
          $group_id = $result->fields['customers_group_pricing'];
          $group_pointrate = $GLOBALS['point_grouprate']->getPointRate($group_id);
          if ($group_pointrate !== false) {
            $this->rate = $group_pointrate;
          }
        }
      }

      if (MODULE_POINT_CUSTOMERSRATE_STATUS == 'true') {
        $customers_pointrate = $GLOBALS['point_customersrate']->getPointRate($_SESSION['customer_id']);
        if ($customers_pointrate !== false) {
          $this->rate = $customers_pointrate;
        }
      }

      $this->point += (int)($this->amount * $this->rate / 100);

      $deduction = 0;
      if (is_object($GLOBALS['ot_coupon'])) {
        $deduction += $GLOBALS['ot_coupon']->deduction;
      }
      if (is_object($GLOBALS['cot_gv'])) {
        $deduction += $GLOBALS['cot_gv']->deduction;
      }
      if (is_object($GLOBALS['ot_subpoint'])) {
        $deduction += $GLOBALS['ot_subpoint']->deduction;
      }
      if (is_object($GLOBALS['ot_group_pricing'])) {
        $deduction += $GLOBALS['ot_group_pricing']->deduction;
      }

      $this->point -= ceil($deduction * $this->rate / 100);
    }

    function credit_selection() {
      return false;
    }

    function collect_posts() {
      return false;
    }

    function pre_confirmation_check() {
      return false;
    }

    function update_credit_account() {
      return false;
    }

    function apply_credit() {
      global $insert_id, $order;
      if ($this->point > 0 && $this->enabled) {
        require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
        $point =& new point($_SESSION['customer_id']);
        $pending = true;
        if ($order->info['order_status'] == MODULE_ORDER_TOTAL_ADDPOINT_DEPOSIT_ORDER_STATUS_ID) {
          $pending = false;
        }
        $id = $point->add($this->point, sprintf(MODULE_ORDER_TOTAL_ADDPOINT_HISTORY_DESCRIPTION, $insert_id), $this->code, 'orders_id', $insert_id, $pending);
        return $id;
      } else {
        return false;
      }
    }

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_ADDPOINT_STATUS'");
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }

    function keys() {
      return array(
        'MODULE_ORDER_TOTAL_ADDPOINT_STATUS',
        'MODULE_ORDER_TOTAL_ADDPOINT_RATE',
        'MODULE_ORDER_TOTAL_ADDPOINT_DEPOSIT_ORDER_STATUS_ID',
        'MODULE_ORDER_TOTAL_ADDPOINT_CANCEL_ORDER_STATUS_ID',
        'MODULE_ORDER_TOTAL_ADDPOINT_SORT_ORDER'
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
          ('購入ポイントモジュールの有効化', 'MODULE_ORDER_TOTAL_ADDPOINT_STATUS', 'false',
          '購入ポイントモジュールを有効にしますか？<br />true: 有効<br />false: 無効',
          '6', '" . $i++ . "','zen_cfg_select_option(array(\'true\', \'false\'), ', now())
        ");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, date_added)
        values
          ('購入ポイント還元率', 'MODULE_ORDER_TOTAL_ADDPOINT_RATE', '1',
          '商品購入金額に対してのポイント還元率をパーセントで設定します。<br />例: 1 (1% - 商品購入金額100円で1ポイント還元)',
          '6', '" . $i++ . "', now())
        ");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function, use_function, date_added)
        values
          ('購入ポイントを使用可能にする注文ステータス', 'MODULE_ORDER_TOTAL_ADDPOINT_DEPOSIT_ORDER_STATUS_ID', '0',
          '設定した注文ステータスに更新された時に購入ポイントを使用可能にします。',
          '6', '" . $i++ . "', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())
        ");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description,
          configuration_group_id, sort_order, set_function, use_function, date_added)
        values
          ('購入ポイントを取消す注文ステータス', 'MODULE_ORDER_TOTAL_ADDPOINT_CANCEL_ORDER_STATUS_ID', '0',
          '設定した注文ステータスに更新された時に購入ポイントを取り消します。',
          '6', '" . $i++ . "', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())
        ");
      $db->Execute("
        insert into " . TABLE_CONFIGURATION . "
          (configuration_title, configuration_key, configuration_value,
          configuration_description, configuration_group_id, sort_order, date_added)
        values
          ('表示の整列順', 'MODULE_ORDER_TOTAL_ADDPOINT_SORT_ORDER', '1100',
          '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。',
          '6', '" . $i++ . "', now())
        ");
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