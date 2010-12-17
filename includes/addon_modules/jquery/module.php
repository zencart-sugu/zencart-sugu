<?php
/**
 * jquery Module
 *
 * @package Addon Modules
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jquery.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class jquery extends addonModuleBase {
    var $title = MODULE_JQUERY_TITLE;
    var $description = MODULE_JQUERY_DESCRIPTION;
    var $sort_order = MODULE_JQUERY_SORT_ORDER;
    var $icon;
    var $status = MODULE_JQUERY_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_JQUERY_STATUS_TITLE,
            'configuration_key' => 'MODULE_JQUERY_STATUS',
            'configuration_value' => MODULE_JQUERY_STATUS_DEFAULT,
            'configuration_description' => MODULE_JQUERY_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_JQUERY_LIBRARY_TITLE,
            'configuration_key' => 'MODULE_JQUERY_LIBRARY',
            'configuration_value' => MODULE_JQUERY_LIBRARY_DEFAULT,
            'configuration_description' => MODULE_JQUERY_LIBRARY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_JQUERY_NOCONFLICT_STATUS_TITLE,
            'configuration_key' => 'MODULE_JQUERY_NOCONFLICT_STATUS',
            'configuration_value' => MODULE_JQUERY_NOCONFLICT_STATUS_DEFAULT,
            'configuration_description' => MODULE_JQUERY_NOCONFLICT_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_JQUERY_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_JQUERY_SORT_ORDER',
            'configuration_value' => MODULE_JQUERY_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_JQUERY_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    var $author                        = array("Koji Sasaki",
                                               "The jQuery Project");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function jquery() {
      $this->__construct();
      if (MODULE_JQUERY_NOCONFLICT_STATUS == 'true') {
        define('JQUERY_ALIAS', 'jQuery');
      } else {
        define('JQUERY_ALIAS', '$');
      }
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
