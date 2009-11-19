<?php
/**
 * point_customersrate Module
 *
 * @package Viewed_customers
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: point_customersrate.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class point_customersrate extends addOnModuleBase {
    var $title = MODULE_POINT_CUSTOMERSRATE_TITLE;
    var $description = MODULE_POINT_CUSTOMERSRATE_DESCRIPTION;

    var $author                        = "Koji Sasaki";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $sort_order = MODULE_POINT_CUSTOMERSRATE_SORT_ORDER;
    var $icon;
    var $status = MODULE_POINT_CUSTOMERSRATE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_POINT_CUSTOMERSRATE_STATUS_TITLE,
            'configuration_key' => 'MODULE_POINT_CUSTOMERSRATE_STATUS',
            'configuration_value' => MODULE_POINT_CUSTOMERSRATE_STATUS_DEFAULT,
            'configuration_description' => MODULE_POINT_CUSTOMERSRATE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_POINT_CUSTOMERSRATE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_POINT_CUSTOMERSRATE_SORT_ORDER',
            'configuration_value' => MODULE_POINT_CUSTOMERSRATE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_POINT_CUSTOMERSRATE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('point_base');
    var $notifier = array();

    var $tables = array(
      TABLE_CUSTOMERS_POINT_RATE => array(
        'customers_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'rate' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'INDEXES' => array(
          'PRIMARY' => array('customers_id'),
          ),
        ),
      );

    // class constructer for php4
    function point_customersrate() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
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
