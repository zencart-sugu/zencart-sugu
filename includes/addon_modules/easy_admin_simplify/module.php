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

  // 管理画面において使用しない機能をわかりやすくするモジュール
  class easy_admin_simplify extends addonModuleBase {
    var $title       = MODULE_EASY_ADMIN_SIMPLIFY_TITLE;
    var $description = MODULE_EASY_ADMIN_SIMPLIFY_DESCRIPTION;
    var $sort_order  = MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER;
    var $icon;
    var $status      = MODULE_EASY_ADMIN_SIMPLIFY_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_SIMPLIFY_STATUS_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_SIMPLIFY_STATUS',
            'configuration_value'       => MODULE_EASY_ADMIN_SIMPLIFY_STATUS_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_SIMPLIFY_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER',
            'configuration_value'       => MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_SIMPLIFY_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array();

    var $author                        = "kohata";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function easy_admin_simplify() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function page() {
        return null;
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
      global $db;
      $sql = "delete from ".TABLE_CONFIGURATION." where configuration_key like '".MODULE_EASY_ADMIN_SIMPLIFY_KEY."%'";
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    function block() {
      return array();
    }
  }
?>