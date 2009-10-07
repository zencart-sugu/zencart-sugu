<?php
/**
 * addon_modules Core Module
 *
 * @package addon_modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  /**
   *
   * @author Koji Sasaki
   *
   */
  class addon_modules extends addOnModuleBase {
    /**
     * Display modules title on admin.
     * @var string
     */
    var $title = MODULE_ADDON_MODULES_TITLE;

    /**
     * Display modules descriptionl on admin.
     * @var string
     */
    var $description = MODULE_ADDON_MODULES_DESCRIPTION;

    /**
     *
     * @var integer
     */
    var $sort_order = MODULE_ADDON_MODULES_SORT_ORDER;
    var $icon;
    var $status = MODULE_ADDON_MODULES_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ADDON_MODULES_STATUS_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_STATUS',
            'configuration_value' => MODULE_ADDON_MODULES_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_SORT_ORDER',
            'configuration_value' => MODULE_ADDON_MODULES_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );

    var $require_modules = array();

    var $notifier = array();

    var $tables = array(
      TABLE_BLOCKS => array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'auto_increment' => true),
        'module' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'block' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'template' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
        'location' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'sort_order' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'visible' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
        'pages' => array('type' => 'text', 'null' => false),
        'INDEXES' => array(
          'PRIMARY' => array('id'),
          'UNIQUE' => array(
            array('module', 'block', 'template'),
            ),
          'INDEX' => array(
            array('module', 'template', 'status', 'location', 'sort_order'),
            ),
          ),
        ),
      );

    // class constructer for php4
    function addon_modules() {
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

  }
