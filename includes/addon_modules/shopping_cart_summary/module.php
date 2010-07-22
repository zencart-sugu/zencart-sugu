<?php
/**
 * shopping_cart_summary Module
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: shopping_cart_summary.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class shopping_cart_summary extends addonModuleBase {
    var $title = MODULE_SHOPPING_CART_SUMMARY_TITLE;
    var $description = MODULE_SHOPPING_CART_SUMMARY_DESCRIPTION;

    var $author                        = "Koji Sasaki";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $sort_order = MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER;
    var $icon;
    var $status = MODULE_SHOPPING_CART_SUMMARY_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_SHOPPING_CART_SUMMARY_STATUS_TITLE,
            'configuration_key' => 'MODULE_SHOPPING_CART_SUMMARY_STATUS',
            'configuration_value' => MODULE_SHOPPING_CART_SUMMARY_STATUS_DEFAULT,
            'configuration_description' => MODULE_SHOPPING_CART_SUMMARY_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER',
            'configuration_value' => MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function shopping_cart_summary() {
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
      global $currencies;

      $return = array();
      $return['title'] = MODULE_SHOPPING_CART_SUMMARY_BLOCK_TITLE;
      $return['contents_count'] = $_SESSION['cart']->count_contents();
      $return['products'] = $_SESSION['cart']->get_products();
      $return['total'] = $currencies->format($_SESSION['cart']->show_total());

      return $return;
    }

  }
?>