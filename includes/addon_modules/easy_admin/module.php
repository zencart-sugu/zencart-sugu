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

  // 管理メニューの設定用モジュール
  class easy_admin extends addOnModuleBase {
    var $author = "kohata";
    var $author_email = "info@zencart-sugu.jp";
    var $version = "0.1.2";
    var $require_zen_cart_version = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title       = MODULE_EASY_ADMIN_TITLE;
    var $description = MODULE_EASY_ADMIN_DESCRIPTION;
    var $sort_order  = MODULE_EASY_ADMIN_SORT_ORDER;
    var $icon;
    var $status      = MODULE_EASY_ADMIN_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_STATUS_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_STATUS',
            'configuration_value'       => MODULE_EASY_ADMIN_STATUS_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_SORT_ORDER',
            'configuration_value'       => MODULE_EASY_ADMIN_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array();

    // class constructer for php4
    function easy_admin() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function page() {
        return null;
    }

    function _install() {
      global $db;

      // トップメニューの構築
      // 存在しない場合に自動で作成
      $sql = "create table if not exists ".TABLE_EASY_ADMIN_TOP_MENUS." "
           . "(easy_admin_top_menu_id         int(11) auto_increment"
           . ",easy_admin_top_menu_name       varchar(255)"
           . ",is_dropdown                    int(1)"
           . ",easy_admin_top_menu_sort_order int(11)"
           . ",primary key (easy_admin_top_menu_id))";
      $db->execute($sql);

      $sql = "delete from ".TABLE_EASY_ADMIN_TOP_MENUS;
      $db->execute($sql);

      $topmenu = 1;
      for (;;) {
        $key = 'MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_'.$topmenu;
        if (defined($key)) {
          $menu = explode(",", constant($key));
          $sql  = "insert into ".TABLE_EASY_ADMIN_TOP_MENUS." "
                . "(easy_admin_top_menu_id,easy_admin_top_menu_name,is_dropdown,easy_admin_top_menu_sort_order)"
                . "values ("
                . $topmenu.","
                . "'".zen_db_input($menu[0])."',"
                . (int)$menu[1].","
                . (int)topmenu.")";
          $db->execute($sql);
          $topmenu++;
        }
        else {
          break;
        }
      }

      // サブメニューの構築
      // 存在しない場合に自動で作成
      $sql = "create table if not exists ".TABLE_EASY_ADMIN_SUB_MENUS." "
           . "(easy_admin_sub_menu_id         int(11) auto_increment"
           . ",easy_admin_top_menu_id         int(11)"
           . ",easy_admin_sub_menu_name       varchar(255)"
           . ",easy_admin_sub_menu_url        varchar(255)"
           . ",easy_admin_sub_menu_sort_order int(11)"
           . ",primary key (easy_admin_sub_menu_id))";
      $db->execute($sql);

      $sql = "delete from ".TABLE_EASY_ADMIN_SUB_MENUS;
      $db->execute($sql);

      $topmenu = 1;
      for (;;) {
        if (!defined('MODULE_EASY_ADMIN_TOP_DEFAULT_MENU_'.$topmenu))
          break;

        $key = 'MODULE_EASY_ADMIN_SUB_DEFAULT_MENU_'.$topmenu;
        if (defined($key."_1")) {
          $submenu = 1;
          for (;;) {
            $subkey = $key."_".$submenu;
            if (defined($subkey)) {
              $menu = explode(",", constant($subkey));
              $sql  = "insert into ".TABLE_EASY_ADMIN_SUB_MENUS." "
                    . "(easy_admin_top_menu_id,easy_admin_sub_menu_name,easy_admin_sub_menu_url,easy_admin_sub_menu_sort_order)"
                    . "values ("
                    . $topmenu.","
                    . "'".zen_db_input($menu[0])."',"
                    . "'".zen_db_input($menu[1])."',"
                    . $submenu.")";
              $db->execute($sql);
              $submenu++;
            }
            else {
              break;
            }
          }
        }
        $topmenu++;
      }

        $sql = "create table if not exists ".TABLE_ADMIN_ACL." "
            . "(acl_id int(11) auto_increment,"
            . "admin_id int(11),"
            . "easy_admin_top_menu_id int(11),"
            . "easy_admin_sub_menu_id int(11),"
            . "primary key (acl_id)"
            . ")";
        $db->execute($sql);

    }

    function _update() {
    }

    function _remove() {
      global $db;

      // トップメニューテーブルの削除
      $sql = "drop table if exists ".TABLE_EASY_ADMIN_TOP_MENUS;
      $db->execute($sql);

      // サブメニューテーブルの削除
      $sql = "drop table if exists ".TABLE_EASY_ADMIN_SUB_MENUS;
      $db->execute($sql);

      // 権限テーブルの削除
      $sql = "drop table if exists ".TABLE_ADMIN_ACL;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

    function block() {
      return array();
    }

    //右メニューを取得
    function block_right_top_menu() {
      $return          = array();
      $return['title'] = '';
      $return['menus'] = getMenus(0);

      return $return;
    }

    //トップメニューとサブメニューを取得
    function block_dropdown_menu() {
      $return          = array();
      $return['title'] = '';
      $return['menus'] = getMenus(1);

      return $return;
    }

    function block_acl_setup() {
        $return = array();
        $return['test'] = 'abcdefghijklmn';
        return $return;
    }

    // override getBlock method
    // admin/includes/header.phpからの呼び出し
    function getBlock($block, $page) {

        if(preg_match("/\?/", $_SERVER["REQUEST_URI"]) > 0) {
            preg_match("/\/([^\/\?]*\??[^\?]*)$/", $_SERVER["REQUEST_URI"], $matches);
        }else{
            preg_match("/\/([^\/]*)$/", $_SERVER["REQUEST_URI"], $matches);
        }

        if(check_page($matches[1])) {

            die("<p style='line-height:1.4em; text-align:center; padding-top:10px;'>このページを閲覧するための権限がありません。<br /><a href=" . zen_href_link(FILENAME_DEFAULT, '', 'NONSSL') . ">管理画面トップ</a>に戻って下さい。</p>");
        }

      global $template;
      $return = false;

      //クラスメソッドが存在する場合処理（クラス, メソッド）
      if (method_exists($this, $block)) {
        $module = $this->code;

        extract($this->{$block}());
        $block_module = $this;

        ob_start();
        require($this->_getTemplateDir($block . '.php', $page, 'templates'). '/'. $block . '.php');
        $content = ob_get_contents();
        ob_end_clean();

        if ($content != '') {
          ob_start();
          require($this->_getTemplateDir('tpl_block.php', $page, 'common'). '/tpl_block.php');
          $return = ob_get_contents();
          ob_end_clean();
        }
      }

      return $return;
    }
  }
?>
