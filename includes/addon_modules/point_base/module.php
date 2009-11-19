<?php
/**
 * point_base Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: point_base.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class point_base extends addOnModuleBase {
    var $title = MODULE_POINT_BASE_TITLE;
    var $description = MODULE_POINT_BASE_DESCRIPTION;
    var $sort_order = MODULE_POINT_BASE_SORT_ORDER;
    var $icon;
    var $status = MODULE_POINT_BASE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_POINT_BASE_STATUS_TITLE,
            'configuration_key' => 'MODULE_POINT_BASE_STATUS',
            'configuration_value' => MODULE_POINT_BASE_STATUS_DEFAULT,
            'configuration_description' => MODULE_POINT_BASE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_POINT_BASE_POINT_SYMBOL_TITLE,
            'configuration_key' => 'MODULE_POINT_BASE_POINT_SYMBOL',
            'configuration_value' => MODULE_POINT_BASE_POINT_SYMBOL_DEFAULT,
            'configuration_description' => MODULE_POINT_BASE_POINT_SYMBOL_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_TITLE,
            'configuration_key' => 'MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS',
            'configuration_value' => MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DEFAULT,
            'configuration_description' => MODULE_POINT_BASE_MAX_DISPLAY_SEARCH_RESULTS_POINTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_POINT_BASE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_POINT_BASE_SORT_ORDER',
            'configuration_value' => MODULE_POINT_BASE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_POINT_BASE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    var $tables = array(
      TABLE_POINT_HISTORIES => array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'auto_increment' => true),
        'customers_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'related_id_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
        'related_id_value' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'deposit' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'withdraw' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'pending' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 255),
        'class' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
        'created_at' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'status' => array('type' => 'integer', 'null' => false, 'default' => '1', 'length' => 1),
        'INDEXES' => array(
          'PRIMARY' => array('id'),
          'INDEX' => array(
            array('customers_id', 'status'),
            ),
          ),
        ),
      TABLE_CUSTOMERS_POINTS => array(
        'customers_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'deposit' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'pending' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'updated_at' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'INDEXES' => array(
          'PRIMARY' => array('customers_id'),
          ),
        ),
      );

    // class constructer for php4
    function point_base() {
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

    // blocks
    function block() {
      $return = array();
      if ($_SESSION['customer_id'] && IS_VISITORS_SESSION !== true &&
	  MODULE_ORDER_TOTAL_ADDPOINT_STATUS == 'true' &&  MODULE_ORDER_TOTAL_SUBPOINT_STATUS == 'true') {
        require_once(DIR_FS_CATALOG . $this->dir . 'classes/class.point.php');
        $point =& new point($_SESSION['customer_id']);
        $customers_points = $point->getCustomersPoints();
        $return['title'] = MODULE_POINT_BASE_BLOCK_TITLE;
        $return['customers_points'] = $customers_points;
      } else {
        return false;
      }
      return $return;
    }
  }
