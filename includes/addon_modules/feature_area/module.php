<?php
/**
 * feature_area Module
 *
 * @package classes
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class feature_area extends addonModuleBase {
    var $author                        = array("saito",
                                               "kohata",
                                               "Koji Sasaki");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.2";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title = MODULE_FEATURE_AREA_TITLE;
    var $description = MODULE_FEATURE_AREA_DESCRIPTION;
    var $sort_order = MODULE_FEATURE_AREA_SORT_ORDER;
    var $icon;
    var $status = MODULE_FEATURE_AREA_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_FEATURE_AREA_STATUS_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_STATUS',
            'configuration_value' => MODULE_FEATURE_AREA_STATUS_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_FEATURE_AREA_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_SORT_ORDER',
            'configuration_value' => MODULE_FEATURE_AREA_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
/*
          array(
            'configuration_title' => MODULE_FEATURE_AREA_UI_MAX_DISPLAY_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_UI_MAX_DISPLAY',
            'configuration_value' => MODULE_FEATURE_AREA_UI_MAX_DISPLAY_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_UI_MAX_DISPLAY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
*/
          array(
            'configuration_title' => MODULE_FEATURE_AREA_UI_CONF_AUTO_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_UI_CONF_AUTO',
            'configuration_value' => MODULE_FEATURE_AREA_UI_CONF_AUTO_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_UI_CONF_AUTO_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FEATURE_AREA_UI_CONF_SPEED_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_UI_CONF_SPEED',
            'configuration_value' => MODULE_FEATURE_AREA_UI_CONF_SPEED_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_UI_CONF_SPEED_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_FEATURE_AREA_UI_CONF_VISIBLE_TITLE,
            'configuration_key' => 'MODULE_FEATURE_AREA_UI_CONF_VISIBLE',
            'configuration_value' => MODULE_FEATURE_AREA_UI_CONF_VISIBLE_DEFAULT,
            'configuration_description' => MODULE_FEATURE_AREA_UI_CONF_VISIBLE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          );
    var $require_modules = array('carousel_ui');
    var $notifier = array(
          );

    // class constructer for php4
    function feature_area() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
      global $db;
      $sql = "create table if not exists ".TABLE_ADDON_MODULES_FEATURE_AREA." "
           . "(id int(11) auto_increment,"
           . "main_image    varchar(64),"
           . "thumb_image   varchar(64),"
           . "link_url      varchar(255),"
           . "sort_order      varchar(255),"
           . "date_added    datetime,"
           . "last_modified datetime,"
           . "status  tinyint(1),"
           . "new_window  tinyint(1),"
           . "primary key (id),"
           . "KEY idx_status_zen (status),"
           . "KEY idx_sort_order_zen (sort_order)"
           . ")";
           $db->execute($sql);

      $sql = "create table if not exists ".TABLE_ADDON_MODULES_FEATURE_AREA_INFO." "
           . "(id int(11) auto_increment,"
           . "languages_id     int,"
           . "name         varchar(255),"
           . "url_clicked      int,"
           . "date_last_click  datetime,"
           . "primary key (id,languages_id),"
           . "KEY idx_categories_name_zen (name)"
           . ")";
      $db->execute($sql);

    }

    function _update() {
    }

    function _remove() {
      global $db;
      $sql = "drop table if exists ".TABLE_ADDON_MODULES_FEATURE_AREA;
      $db->execute($sql);
      $sql = "drop table if exists ".TABLE_ADDON_MODULES_FEATURE_AREA_INFO;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    // blocks
    function block() {
      global $db;

      $query_raw = "select * from " . TABLE_ADDON_MODULES_FEATURE_AREA . " order by sort_order";
      $results = $db->execute($query_raw);

      $return = array();
      $return['result'] = $results;

      $return['title'] = MODULE_FEATURE_AREA_BLOCK_TITLE;

      return $return;
    }

    function getVisibleCount() {
      global $db;
      
      $visible_count = (int)MODULE_FEATURE_AREA_UI_CONF_VISIBLE;
      $result = $db->Execute("SELECT count(*) AS count from " . TABLE_ADDON_MODULES_FEATURE_AREA . " order by sort_order");
      // 最大表示件数 < スクロールエリア表示件数
      if ($result->fields['count'] < $visible_count) {
        // 『スクロールエリア表示件数』を『最大表示件数』に変更する
        $visible_count = $result->fields['count'];
      }
    
      return $visible_count;
    }
    
  }
?>