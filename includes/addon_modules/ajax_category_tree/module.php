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

  class ajax_category_tree extends addonModuleBase {
    var $title       = MODULE_ADDON_MODULES_AJAXCATEGORYTREE_TITLE;
    var $description = MODULE_ADDON_MODULES_AJAXCATEGORYTREE_DESCRIPTION;
    var $sort_order  = MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER;
    var $icon;
    var $status      = MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS_TITLE,
            'configuration_key'         => 'MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS',
            'configuration_value'       => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title'       => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER',
            'configuration_value'       => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_AJAXCATEGORYTREE_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array('jquery');
    var $notifier        = array();

    var $author                        = array("kohata");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function ajax_category_tree() {
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

    function page() {
      // 普通にpageで表示するとヘッダやサイドボックスも含まれてしまうのでパラメータで判断して即exit
      if (isset($_GET['key'])) {
      	$path  = $_GET['key'];
      	$cPath = $_GET['cPath'];
      	echo getAjaxCategoryTreeJson($this->get_categories($path, $cPath));
      	exit;
      } else {
      	return null;
      }
    }

    // 指定カテゴリーから、親カテゴリーまでのIDリストを作成する
    function getCategoryIdList($category_id) {
      global $db;

      $ids = array();

      for (;;) {
        if ($category_id==0)
          break;
        $ids[] = $category_id;
        $sql = "select
                   parent_id
                from ".
                  TABLE_CATEGORIES."
                where
                  categories_id=".(int)$category_id;
        $result = $db->Execute($sql);
        if ($result->EOF)
          break;
        $category_id = $result->fields['parent_id'];
      }

      return array_reverse($ids);
    }

    function get_categories($parent_id='0', $cPath="") {
      global $db;

      // cPathの展開
      if ($cPath != "")
        $cPathArray = explode("_", $cPath);
      else
        $cPathArray = array();

      // get categories
      $categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                         from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         where
                         parent_id = '" . (int)$parent_id . "'
                         and c.categories_id = cd.categories_id
                         and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         and c.categories_status = 1
                         order by sort_order, cd.categories_name";

      $categories = $db->Execute($categories_query);

      while (!$categories->EOF) {
        // cPathが指定された場合の子供の展開
        $child = array();

        // 今処理しているカテゴリーと同じ場合に
        // その下層を検索する
        if (count($cPathArray) > 0 &&
            $categories->fields['categories_id'] == $cPathArray[0]) {
          $parent_id = $cPathArray[0];
          array_shift($cPathArray);
          $child = $this->get_categories($parent_id, implode("_", $cPathArray));
        }
        $categories_ids     = $this->getCategoryIdList($categories->fields['categories_id']);

        if (count($child))
          $childjson = ", children:".getAjaxCategoryTreeJson($child);
        else
          $childjson = "";

      	$categories_array[] = array('key'       => $categories->fields['categories_id'],
                        				    'title'     => $categories->fields['categories_name'],
                        				    'haschild'  => zen_has_category_subcategories($categories->fields['categories_id']),
                        				    'url'       => implode("_", $categories_ids),
                        				    'categoryid'=>$categories->fields['categories_id'],
                        				    'child'     => $child,
                        				    'childjson' => $childjson);
      	$categories->MoveNext();
      }
      return $categories_array;
    }

    function block() {
      $return          = array();
      $return['title'] = BOX_AJAXCATEGORYTREE;
      if (isset($_GET['cPath']))
        $return['top'] = $this->get_categories("0", $_GET['cPath']);
      else if (isset($_GET['categories_id'])) {
        $ids           = $this->getCategoryIdList($_GET['categories_id']);
        $return['top'] = $this->get_categories("0", implode("_", $ids));
      }
      else
        $return['top'] = $this->get_categories("0", "");

      return $return;
    }

  }
?>