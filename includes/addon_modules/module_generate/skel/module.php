<?php
/**
 * :pacckage - module class
 *
 * @package :pakckage
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class :module_name extends addOnModuleBase {
    var $author = array(':author');
    var $author_email = ':author_email';
    var $version = ':version';
    var $require_zen_cart_version = ':zencart_version';
    var $require_addon_modules_version = ':addonmodule_version';

    var $title = :def_title;
    var $description = :def_description;
    var $sort_order = :def_sort_order;
    var $icon;
    var $status = :def_status;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => :def_status_title,
            'configuration_key' => ':def_module_status',
            'configuration_value' => :def_status_default,
            'configuration_description' => :def_status_description,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => :def_sort_order_title,
            'configuration_key' => ':def_module_sort_order',
            'configuration_value' => :def_sort_order_default,
            'configuration_description' => :def_sort_order_description,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array(':required');
    var $notifier = array();

    // class constructer for php4
    function :module_name() {
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