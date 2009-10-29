<?php
/**
 * addon_modules_help Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: addon_modules_help.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class addon_modules_help extends addOnModuleBase {
    var $title = MODULE_ADDON_MODULES_HELP_TITLE;
    var $description = MODULE_ADDON_MODULES_HELP_DESCRIPTION;
    var $sort_order = MODULE_ADDON_MODULES_HELP_SORT_ORDER;
    var $icon;
    var $status = MODULE_ADDON_MODULES_HELP_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ADDON_MODULES_HELP_STATUS_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_HELP_STATUS',
            'configuration_value' => MODULE_ADDON_MODULES_HELP_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_HELP_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_HELP_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_HELP_SORT_ORDER',
            'configuration_value' => MODULE_ADDON_MODULES_HELP_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_HELP_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();
    var $author_email = "sasaki@liquidst.jp";
    var $version = "1.0.0";
    var $require_zen_cart_version = ">= 1.3.0.2";
    var $require_addon_modules_version = ">= 1.0";

    // class constructer for php4
    function addon_modules_example() {
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