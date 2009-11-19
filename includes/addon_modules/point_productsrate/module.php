<?php
/**
 * point_productsrate Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: point_productsrate.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class point_productsrate extends addOnModuleBase {
    var $title = MODULE_POINT_PRODUCTSRATE_TITLE;
    var $description = MODULE_POINT_PRODUCTSRATE_DESCRIPTION;
    var $sort_order = MODULE_POINT_PRODUCTSRATE_SORT_ORDER;
    var $icon;
    var $status = MODULE_POINT_PRODUCTSRATE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_POINT_PRODUCTSRATE_STATUS_TITLE,
            'configuration_key' => 'MODULE_POINT_PRODUCTSRATE_STATUS',
            'configuration_value' => MODULE_POINT_PRODUCTSRATE_STATUS_DEFAULT,
            'configuration_description' => MODULE_POINT_PRODUCTSRATE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_POINT_PRODUCTSRATE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_POINT_PRODUCTSRATE_SORT_ORDER',
            'configuration_value' => MODULE_POINT_PRODUCTSRATE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_POINT_PRODUCTSRATE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('point_base');
    var $notifier = array();

    var $tables = array(
      TABLE_PRODUCTS_POINT_RATE => array(
        'products_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'rate' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'INDEXES' => array(
          'PRIMARY' => array('products_id'),
          ),
        ),
      );

    // class constructer for php4
    function point_productsrate() {
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
    function insertPointRate($products_id, $rate) {
      global $db;
      $sql_data_array = array(
        'products_id' => $products_id,
        'rate' => $rate
        );
      zen_db_perform(TABLE_PRODUCTS_POINT_RATE, $sql_data_array);
    }

    function deletePointRate($products_id) {
      global $db;
      $query = "
        delete
        from " . TABLE_PRODUCTS_POINT_RATE . "
        where
          products_id = :productsID
        ;";
      $query = $db->bindVars($query, ':productsID', $products_id, 'integer');
      $db->Execute($query);
    }

    function getPointRate($products_id) {
      global $db;
      $query = "
        select
          rate
        from " . TABLE_PRODUCTS_POINT_RATE . "
        where
          products_id = :productsID
        ;";
      $query = $db->bindVars($query, ':productsID', $products_id, 'integer');
      $result = $db->Execute($query);
      if ($result->RecordCount() > 0) {
        return (int)$result->fields['rate'];
      }
      return false;
    }

  }
