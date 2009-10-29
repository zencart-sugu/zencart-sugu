<?php
/**
 * category_sitemap Module
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

  class category_sitemap extends addonModuleBase {
    var $title       = MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TITLE;
    var $description = MODULE_ADDON_MODULES_CATEGORY_SITEMAP_DESCRIPTION;
    var $sort_order  = MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER;
    var $icon;
    var $status      = MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_TITLE,
            'configuration_key'         => 'MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS',
            'configuration_value'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_TITLE,
            'configuration_key'         => 'MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL',
            'configuration_value'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
          array(
            'configuration_title'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER',
            'configuration_value'       => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array('jquery');
    var $notifier        = array();

    var $author                        = "kohata";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function category_sitemap() {
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
     	return null;
    }

    // カテゴリ一覧を構築する
    function getCategoryTree($parent_id=0, $path="", $level=0) {
      global $db;

      $categories = array();

      if ($level >= MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL)
        return $categories;

      $sql        = "select
                        c.categories_id
                       ,cd.categories_name
                     from ".
                       TABLE_CATEGORIES." c,".
                       TABLE_CATEGORIES_DESCRIPTION." cd
                     where
                       c.categories_id=cd.categories_id
                       and cd.language_id=".(int)$_SESSION['languages_id']."
                       and c.categories_status=1
                       and c.parent_id=".(int)$parent_id."
                     order by sort_order, cd.categories_name";
      $result = $db->Execute($sql);

      while (!$result->EOF) {
        if ($path == "")
          $cPath = $result->fields['categories_id'];
        else
          $cPath = $path."_".$result->fields['categories_id'];
        $categories[] = array('path'  => $cPath,
                              'name'  => $result->fields['categories_name'],
                              'child' => $this->getCategoryTree($result->fields['categories_id'], $cPath, $level+1));
      	$result->MoveNext();
      }
      return $categories;
    }

    function block() {
      $return               = array();
      $return['title']      = BOX_CATEGORY_SITEMAP;
      $return['categories'] = $this->getCategoryTree();

      return $return;
    }

  }
?>