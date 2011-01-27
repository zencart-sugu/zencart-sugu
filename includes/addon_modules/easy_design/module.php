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

  // デザインの設定用モジュール
  class easy_design extends addonModuleBase {
    var $title       = MODULE_EASY_DESIGN_TITLE;
    var $description = MODULE_EASY_DESIGN_DESCRIPTION;
    var $sort_order  = MODULE_EASY_DESIGN_SORT_ORDER;
    var $icon;
    var $status      = MODULE_EASY_DESIGN_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_EASY_DESIGN_STATUS_TITLE,
            'configuration_key'         => 'MODULE_EASY_DESIGN_STATUS',
            'configuration_value'       => MODULE_EASY_DESIGN_STATUS_DEFAULT,
            'configuration_description' => MODULE_EASY_DESIGN_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_EASY_DESIGN_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_EASY_DESIGN_SORT_ORDER',
            'configuration_value'       => MODULE_EASY_DESIGN_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EASY_DESIGN_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array();

    var $author                        = array("kohata");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function easy_design() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function page() {
        return null;
    }

    function _install() {
      global $db;

      // カラーテーブルの構築
      // 存在しない場合に自動で作成
      $sql = "create table if not exists ".TABLE_EASY_DESIGN_COLORS." "
           . "(easy_design_color_id    int(11) auto_increment"
           . ",template_dir            varchar(255)"
           . ",easy_design_color_key   varchar(255)"
           . ",easy_design_color_name  text"
           . ",easy_design_color_value text"
           . ",primary key (easy_design_color_id)"
           . ",index       (template_dir)"
           . ",index       (easy_design_color_key))";
      $db->execute($sql);

      // 文言テーブルの構築
      // 存在しない場合に自動で作成
      $sql = "create table if not exists ".TABLE_EASY_DESIGN_LANGUAGES." "
           . "(easy_design_language_id         int(11) auto_increment"
           . ",language_id                     int(11)"
           . ",easy_design_language_key        varchar(255)"
           . ",easy_design_language_name       text"
           . ",easy_design_language_value      text"
           . ",easy_design_language_sort_order int(11)"
           . ",primary key (easy_design_language_id)"
           . ",index       (easy_design_language_key))";
      $db->execute($sql);

      $sql = "insert into ".TABLE_EASY_DESIGN_LANGUAGES." "
           . "(language_id"
           . ",easy_design_language_key"
           . ",easy_design_language_name"
           . ",easy_design_language_value"
           . ",easy_design_language_sort_order) "
           . "values"
           . "(2"
           . ",'".EASY_DESIGN_KEY_TAGLINE."'"
           . ",'".zen_db_input(EASY_DESIGN_TAGLINE_NAME)."'"
           . ",'".zen_db_input(EASY_DESIGN_TAGLINE_VALUE)."'"
           . ",1)";
      $db->execute($sql);

      $sql = "insert into ".TABLE_EASY_DESIGN_LANGUAGES." "
           . "(language_id"
           . ",easy_design_language_key"
           . ",easy_design_language_name"
           . ",easy_design_language_value"
           . ",easy_design_language_sort_order) "
           . "values"
           . "(2"
           . ",'".EASY_DESIGN_KEY_COPYLIGHT."'"
           . ",'".zen_db_input(EASY_DESIGN_COPYLIGHT_NAME)."'"
           . ",'".zen_db_input(EASY_DESIGN_COPYLIGHT_VALUE)."'"
           . ",2)";
      $db->execute($sql);
    }

    function _update() {
    }

    function _remove() {
      global $db;

      // カラーテーブルの削除
      $sql = "drop table if exists ".TABLE_EASY_DESIGN_COLORS;
      $db->execute($sql);

      // 文言テーブルの削除
      $sql = "drop table if exists ".TABLE_EASY_DESIGN_LANGUAGES;
      $db->execute($sql);
    }

    function _cleanUp() {
    }
  }
?>