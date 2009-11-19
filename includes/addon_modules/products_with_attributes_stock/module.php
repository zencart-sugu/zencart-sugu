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

  // デザインの設定用モジュール
  class products_with_attributes_stock extends addonModuleBase {
    var $title       = MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_TITLE;
    var $description = MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_DESCRIPTION;
    var $sort_order  = MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER;
    var $icon;
    var $status      = MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS_TITLE,
            'configuration_key'         => 'MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS',
            'configuration_value'       => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS_DEFAULT,
            'configuration_description' => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER',
            'configuration_value'       => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_SORT_ORDER_DESCRIPTION,
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
    function products_with_attributes_stock() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function page() {
        return null;
    }

    function _install() {
      global $db;

      // 在庫テーブルの構築
      // 存在しない場合に自動で作成
      $sql = "create table if not exists ".TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK." "
           . "(stock_id         INT NOT NULL AUTO_INCREMENT"
           . ",products_id      INT NOT NULL"
           . ",stock_attributes VARCHAR( 255 ) NOT NULL"
           . ",skumodel         VARCHAR( 255 ) NOT NULL"
           . ",quantity         FLOAT NOT NULL"
           . ",PRIMARY KEY (stock_id))";
      $db->execute($sql);
    }

    function _update() {
    }

    function _remove() {
      global $db;

      // 在庫テーブルの削除
      $sql = "drop table if exists ".TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    function block() {
      return array();
    }
  }
?>