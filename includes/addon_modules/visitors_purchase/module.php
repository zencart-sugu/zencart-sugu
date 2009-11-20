<?php
/**
 * Visitors Purchase Module
 *
 * @package visitors
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: visitors_purchase.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  /**
   *
   * @author Koji Sasaki
   *
   */
  class visitors_purchase extends addonModuleBase {
    /**
     * Display modules title on admin.
     * @var string
     */
    var $title = MODULE_VISITORS_PURCHASE_TITLE;

    /**
     * Display modules descriptionl on admin.
     * @var string
     */
    var $description = MODULE_VISITORS_PURCHASE_DESCRIPTION;

    /**
     *
     * @var integer
     */
    var $sort_order = MODULE_VISITORS_PURCHASE_SORT_ORDER;
    var $icon;
    var $status = MODULE_VISITORS_PURCHASE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_VISITORS_PURCHASE_STATUS_TITLE,
            'configuration_key' => 'MODULE_VISITORS_PURCHASE_STATUS',
            'configuration_value' => MODULE_VISITORS_PURCHASE_STATUS_DEFAULT,
            'configuration_description' => MODULE_VISITORS_PURCHASE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_TITLE,
            'configuration_key' => 'MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS',
            'configuration_value' => MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DEFAULT,
            'configuration_description' => MODULE_VISITORS_PURCHASE_ORDERS_DATA_KEEP_DAYS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_VISITORS_PURCHASE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_VISITORS_PURCHASE_SORT_ORDER',
            'configuration_value' => MODULE_VISITORS_PURCHASE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_VISITORS_PURCHASE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('visitors');
    var $notifier = array(
          'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE',
          'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS',
          'NOTIFY_LOGIN_SUCCESS_VIA_VISITOR_TO_ACCOUNT',
        );

    var $tables = array(
      TABLE_VISITORS_ORDERS => array(
        'orders_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11),
        'visitors_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 11),
        'last_modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'date_purchased' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
        'INDEXES' => array(
          'PRIMARY' => array('orders_id'),
          'INDEX' => array(
            array('visitors_id'),
            ),
          ),
        ),
      );

// class constructor
    function visitors_purchase() {
      parent::__construct();
    }

    function notifierUpdate($notifier) {
      if ($notifier == 'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE' && zen_visitors_is_visitor()) {
        $this->_visitorsOrderCreate();
      }
      if ($notifier == 'NOTIFY_CHECKOUT_PROCESS_AFTER_ORDER_CREATE_ADD_PRODUCTS' && zen_visitors_is_visitor() &&
	  MODULE_EMAIL_TEMPLATES_STATUS != 'true') {
        $this->_replaceOrderObject();
      }
      if ($notifier == 'NOTIFY_LOGIN_SUCCESS_VIA_VISITOR_TO_ACCOUNT' && !zen_visitors_is_visitor()) {
        $this->_visitorsOrderToCustomersOrder();
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

    function _visitorsOrderCreate() {
      global $db, $insert_id;
      $sql_data_array = array(
        'orders_id' => $insert_id,
        'visitors_id' => $_SESSION['visitors_id'],
        'date_purchased' => 'now()'
      );
     zen_db_perform(TABLE_VISITORS_ORDERS, $sql_data_array);
    }

    function _replaceOrderObject() {
      global $order;
      require($this->dir . 'classes/class.visitorsOrder.php');
      $order = new visitorsOrder($order);
    }

    function _visitorsOrderToCustomersOrder() {
      global $db;
      $db->Execute("delete from " . TABLE_VISITORS_ORDERS . "
                    where visitors_id = '" . (int)$_SESSION['customer_id'] . "'");
    }
  }
