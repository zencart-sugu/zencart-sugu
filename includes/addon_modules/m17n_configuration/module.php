<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class m17n_configuration extends addonModuleBase {
    var $author                        = array("saito");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title       = MODULE_M17N_CONFIGURATION_TITLE;
    var $description = MODULE_M17N_CONFIGURATION_DESCRIPTION;
    var $sort_order  = MODULE_M17N_CONFIGURATION_SORT_ORDER;
    var $icon;
    var $status      = MODULE_M17N_CONFIGURATION_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_M17N_CONFIGURATION_STATUS_TITLE,
            'configuration_key'         => 'MODULE_M17N_CONFIGURATION_STATUS',
            'configuration_value'       => MODULE_M17N_CONFIGURATION_STATUS_DEFAULT,
            'configuration_description' => MODULE_M17N_CONFIGURATION_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\'),'
          ),
          array(
            'configuration_title'       => MODULE_M17N_CONFIGURATION_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_M17N_CONFIGURATION_SORT_ORDER',
            'configuration_value'       => MODULE_M17N_CONFIGURATION_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_M17N_CONFIGURATION_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array('NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_INFO',
                                 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_MUSIC_INFO',
                                 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_FREE_SHIPPING_INFO',
                                 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_DOCUMENT_GENERAL_INFO',
                                 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_DOCUMENT_PRODUCT_INFO');

    var $tables = array(
      TABLE_M17N_CONFIGURATION_KEYS => array(
        'm17n_configuration_keys_id' => array('type' => 'integer', 'null' => false, 'default' => false, 'length' => 11, 'auto_increment' => true),
        'm17n_configuration_key' => array('type' => 'varchar', 'null' => false, 'default' => '', 'length' => 255),
        'set_function_backup' => array('type' => 'text', 'null' => false, 'default' => ''),
        'use_function_backup' => array('type' => 'text', 'null' => false, 'default' => ''),
        'INDEXES' => array(
          'PRIMARY' => array('m17n_configuration_keys_id'),
          'UNIQUE' => array(array('m17n_configuration_key'))
        )
      )
    );

    // class constructer for php4
    function m17n_configuration() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      switch ($notifier) {
      case 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_INFO':
      case 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_MUSIC_INFO':
      case 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_PRODUCT_FREE_SHIPPING_INFO':
      case 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_DOCUMENT_GENERAL_INFO':
      case 'NOTIFY_MAIN_TEMPLATE_VARS_EXTRA_DOCUMENT_PRODUCT_INFO':
        zen_m17n_set_show_product_switch();
      }
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
      zen_m17n_restore_configuration();
    }

    function _cleanUp() {
    }


  }
?>