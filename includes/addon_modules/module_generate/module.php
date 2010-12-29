<?php
/**
 * module_generate Module
 *
 * @package module_generate
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class module_generate extends addOnModuleBase {
    var $author = array('saito');
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.1.2';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    var $title = MODULE_MODULE_GENERATE_TITLE;
    var $description = MODULE_MODULE_GENERATE_DESCRIPTION;
    var $sort_order = MODULE_MODULE_GENERATE_SORT_ORDER;
    var $icon;
    var $status = MODULE_MODULE_GENERATE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_MODULE_GENERATE_STATUS_TITLE,
            'configuration_key' => 'MODULE_MODULE_GENERATE_STATUS',
            'configuration_value' => MODULE_MODULE_GENERATE_STATUS_DEFAULT,
            'configuration_description' => MODULE_MODULE_GENERATE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_MODULE_GENERATE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_MODULE_GENERATE_SORT_ORDER',
            'configuration_value' => MODULE_MODULE_GENERATE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_MODULE_GENERATE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function module_generate() {
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
?>