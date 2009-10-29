<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class addon_modules_example extends addOnModuleBase {
    var $title = MODULE_ADDON_MODULES_EXAMPLE_TITLE;
    var $description = MODULE_ADDON_MODULES_EXAMPLE_DESCRIPTION;
    var $sort_order = MODULE_ADDON_MODULES_EXAMPLE_SORT_ORDER;
    var $icon;
    var $status = MODULE_ADDON_MODULES_EXAMPLE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ADDON_MODULES_EXAMPLE_STATUS_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_EXAMPLE_STATUS',
            'configuration_value' => MODULE_ADDON_MODULES_EXAMPLE_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_EXAMPLE_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_EXAMPLE_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_EXAMPLE_SORT_ORDER',
            'configuration_value' => MODULE_ADDON_MODULES_EXAMPLE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_EXAMPLE_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('addon_modules_help');
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

    // blocks
    function block() {
      $return = array();
      $return['title'] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_TITLE;
      $return['var_1'] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_VAR_1;
      $return['var_2'] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_VAR_2;
      $return['var_3'] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_VAR_3;
      return $return;
    }

    function block_hogehoge() {
      $return = array();
      $return['title'] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_HOGEHOGE_TITLE;
      $return['list'][] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_HOGEHOGE_LIST_1;
      $return['list'][] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_HOGEHOGE_LIST_2;
      $return['list'][] = MODULE_ADDON_MODULES_EXAMPLE_BLOCK_HOGEHOGE_LIST_3;
      return $return;
    }

    // page methods
    function page() {
      $return = array();
      $return['var_1'] = TEXT_VAR_1;
      $return['var_2'] = TEXT_VAR_2;
      $return['var_3'] = TEXT_VAR_3;
      return $return;
    }
    function _page_metatags() {
      $return = array();
      $return['title'] = 'addon_modules_example meta tag title';
      $return['description'] = 'addon_modules_example meta tag description';
      $return['keywords'] = 'addon_modules_example meta tag keywords';
      return $return;
    }
    function _page_breadcrumb() {
      $return = array();
      $return[] = array('title' => NAVBAR_TITLE, 'link' => null);
      return $return;
    }
    function _page_template_vars() {
      $return = array();
      $return['var_3'] = 'Called template_vars, overwriten $var_3.';
      return $return;
    }

    function page_hogehoge() {
      $return = array();
      $return['list'][] = TEXT_LIST_1;
      $return['list'][] = TEXT_LIST_2;
      $return['list'][] = TEXT_LIST_3;
      return $return;
    }

  }
?>