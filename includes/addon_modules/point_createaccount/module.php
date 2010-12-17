<?php
/**
 * point_createaccount Module
 *
 * @package Viewed_customers
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: point_createaccount.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class point_createaccount extends addOnModuleBase {
    var $title = MODULE_POINT_CREATEACCOUNT_TITLE;
    var $description = MODULE_POINT_CREATEACCOUNT_DESCRIPTION;

    var $author                        = array("saito",
                                               "Koji Sasaki");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $sort_order = MODULE_POINT_CREATEACCOUNT_SORT_ORDER;
    var $icon;
    var $status = MODULE_POINT_CREATEACCOUNT_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_POINT_CREATEACCOUNT_STATUS_TITLE,
            'configuration_key' => 'MODULE_POINT_CREATEACCOUNT_STATUS',
            'configuration_value' => MODULE_POINT_CREATEACCOUNT_STATUS_DEFAULT,
            'configuration_description' => MODULE_POINT_CREATEACCOUNT_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_POINT_CREATEACCOUNT_PENDING_TITLE,
            'configuration_key' => 'MODULE_POINT_CREATEACCOUNT_PENDING',
            'configuration_value' => MODULE_POINT_CREATEACCOUNT_PENDING_DEFAULT,
            'configuration_description' => MODULE_POINT_CREATEACCOUNT_PENDING_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_POINT_CREATEACCOUNT_POINT_TITLE,
            'configuration_key' => 'MODULE_POINT_CREATEACCOUNT_POINT',
            'configuration_value' => MODULE_POINT_CREATEACCOUNT_POINT_DEFAULT,
            'configuration_description' => MODULE_POINT_CREATEACCOUNT_POINT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_POINT_CREATEACCOUNT_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_POINT_CREATEACCOUNT_SORT_ORDER',
            'configuration_value' => MODULE_POINT_CREATEACCOUNT_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_POINT_CREATEACCOUNT_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('point_base');
    var $notifier = array('NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT');

    var $tables = array();

    // class constructer for php4
    function point_createaccount() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      if ($this->enabled) {
        if ($notifier == 'NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT'
          && (int)MODULE_POINT_CREATEACCOUNT_POINT > 0) {
          require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
          $point =& new point($_SESSION['customer_id']);
          return $point->add((int)MODULE_POINT_CREATEACCOUNT_POINT, sprintf(MODULE_POINT_CREATEACCOUNT_HISTORY_DESCRIPTION, $_SESSION['customer_id']), $this->code, 'customers_id', $_SESSION['customer_id'], $this->pending);
        }
      }
      return false;
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    // specify methods
    function insertPointRate($customers_id, $rate) {
      global $db;
      $sql_data_array = array(
        'customers_id' => $customers_id,
        'rate' => $rate
        );
      zen_db_perform(TABLE_CUSTOMERS_POINT_RATE, $sql_data_array);
    }

    function deletePointRate($customers_id) {
      global $db;
      $query = "
        delete
        from " . TABLE_CUSTOMERS_POINT_RATE . "
        where
          customers_id = :customersID
        ;";
      $query = $db->bindVars($query, ':customersID', $customers_id, 'integer');
      $db->Execute($query);
    }

    function getPointRate($customers_id) {
      global $db;
      $query = "
        select
          rate
        from " . TABLE_CUSTOMERS_POINT_RATE . "
        where
          customers_id = :customersID
        ;";
      $query = $db->bindVars($query, ':customersID', $customers_id, 'integer');
      $result = $db->Execute($query);
      if ($result->RecordCount() > 0) {
        return (int)$result->fields['rate'];
      }
      return false;
    }

  }
