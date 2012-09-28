<?php
/**
 * carousel_ui Module
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: carousel_ui.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class carousel_ui extends addonModuleBase {

    var $author                        = array("Otsuji Takashi",
                                               "Koji Sasaki");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.2";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title = MODULE_CAROUSEL_UI_TITLE;
    var $description = MODULE_CAROUSEL_UI_DESCRIPTION;
    var $sort_order = MODULE_CAROUSEL_UI_SORT_ORDER;
    var $icon;
    var $status = MODULE_CAROUSEL_UI_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_STATUS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_STATUS',
            'configuration_value' => MODULE_CAROUSEL_UI_STATUS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY',
            'configuration_value' => MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_SORT_ORDER',
            'configuration_value' => MODULE_CAROUSEL_UI_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          array(
            'configuration_title' => MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          array(
            'configuration_title' => MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          array(
            'configuration_title' => MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          array(
            'configuration_title' => MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),

          array(
            'configuration_title' => MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_TITLE,
            'configuration_key' => 'MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS',
            'configuration_value' => MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DEFAULT,
            'configuration_description' => MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );

    var $require_modules = array('jquery');
    var $notifier = array();

    // class constructer for php4
    function carousel_ui() {
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

    ///////////////////////////////////////////////////////////////////////////////////
    // 新着商品
    ///////////////////////////////////////////////////////////////////////////////////
    // カルーセルに表示する件数
    function get_carousel_count_new_products() {
      global $db, $current_category_id;

      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID";
      } else {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID";
      }

      $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->Execute($query);

      // 表示個数が少ない場合の対処
      $count = (int)$result->fields['count'];
      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS > $count)
        return $count;
      else
        return MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS;
    }

    function block_new_products() {
      global $db, $current_category_id;

      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      $return = array();

      $products = array();
      $title = '';

      // display limits
      $display_limit = zen_get_products_new_timelimit();

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            " . $display_limit;
      } else {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID
            " . $display_limit;
      }

      $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->ExecuteRandomMulti($query, MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS);

      while (!$result->EOF) {

        $id = $result->fields['products_id'];
        $name = $result->fields['products_name'];
        $image = $result->fields['products_image'];
        $manufacturers = $result->fields['manufacturers_name'];

        if ($result->fields['type_handler'] == '') {
          $type_handler = 'product_info';
        } else {
          $type_handler = $result->fields['type_handler'] . '_info';
        }
        $link = zen_href_link($type_handler, 'products_id=' . $id);

        $price = zen_get_products_display_price($id);

        $products[] = array(
          'id' => $id,
          'name' => $name,
          'image' => $image,
          'link' => $link,
          'price' => $price,
          'manufacturers' => $manufacturers
          );

        $result->MoveNextRandom();
      }

      if (count($products) > 0) {
        // 表示件数の倍になるようにする
        $visibleCount = (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS;
        if ($visibleCount == 0)
          $visibleCount = 1;
        $addCount = count($products) % $visibleCount;
        if ($addCount > 0)
          $addCount = $visibleCount - $addCount;
        for ($i=0; $i<$addCount; $i++) {
          $products[] = array(
            'id'            => 0,
            'name'          => '',
            'image'         => '',
            'link'          => '',
            'price'         => '',
            'manufacturers' => ''
            );
        }

        if (isset($parent_id) && $parent_id != 0) {
          $category_title = zen_get_categories_name((int)$parent_id);
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_NEW_PRODUCTS_TITLE, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' );
        } else {
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_NEW_PRODUCTS_TITLE, strftime('%B'));
        }

        $return['title'] = $title;
        $return['products'] = $products;
        $return['ui_conf'] = array(
         'auto' => (int)MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS,
         'speed' => (int)MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS,
         'vertical' => (MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS == 'true' ? 'true' : 'false'),
         'circular' => (MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS == 'true' ? 'true' : 'false'),
         'visible' => (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS,
         'scroll' => (int)MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS,
        );
      }

      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS < count($products)) {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT, 'class="imgover"');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT,     BUTTON_CAROUSEL_UI_NEXT_ALT,     'class="imgover"');
      }
      else {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED, BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED,     BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
      }

      return $return;
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // おすすめ商品
    ///////////////////////////////////////////////////////////////////////////////////
    // カルーセルに表示する件数
    function get_carousel_count_featured_products() {
      global $db, $current_category_id;
      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      $return = array();

      $products = array();
      $title = '';

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_FEATURED . " f
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = f.products_id
            AND f.status = 1
            ;";
      } else {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_FEATURED . " f
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = f.products_id
            AND f.status = 1
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID
            ;";
      }

      $query  = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query  = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->Execute($query);

      // 表示個数が少ない場合の対処
      $count = (int)$result->fields['count'];
      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS > $count)
        return $count;
      else
        return MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS;
    }

    function block_featured_products() {
      global $db, $current_category_id;
      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      $return = array();

      $products = array();
      $title = '';

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_FEATURED . " f
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = f.products_id
            AND f.status = 1
            ;";
      } else {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_FEATURED . " f
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = f.products_id
            AND f.status = 1
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID
            ;";
      }

      $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->ExecuteRandomMulti($query, MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS);

      while (!$result->EOF) {

        $id = $result->fields['products_id'];
        $name = $result->fields['products_name'];
        $image = $result->fields['products_image'];
        $manufacturers = $result->fields['manufacturers_name'];

        if ($result->fields['type_handler'] == '') {
          $type_handler = 'product_info';
        } else {
          $type_handler = $result->fields['type_handler'] . '_info';
        }
        $link = zen_href_link($type_handler, 'products_id=' . $id);

        $price = zen_get_products_display_price($id);

        $products[] = array(
          'id' => $id,
          'name' => $name,
          'image' => $image,
          'link' => $link,
          'price' => $price,
          'manufacturers' => $manufacturers
          );

        $result->MoveNextRandom();
      }

      if (count($products) > 0) {
        // 表示件数の倍になるようにする
        $visibleCount = (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS;
        if ($visibleCount == 0)
          $visibleCount = 1;
        $addCount = count($products) % $visibleCount;
        if ($addCount > 0)
          $addCount = $visibleCount - $addCount;
        for ($i=0; $i<$addCount; $i++) {
          $products[] = array(
            'id'            => 0,
            'name'          => '',
            'image'         => '',
            'link'          => '',
            'price'         => '',
            'manufacturers' => ''
            );
        }

        if (isset($parent_id) && $parent_id != 0) {
          $category_title = zen_get_categories_name((int)$parent_id);
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_FEATURED_PRODUCTS_TITLE, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' );
        } else {
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_FEATURED_PRODUCTS_TITLE, strftime('%B'));
        }

        $return['title'] = $title;
        $return['products'] = $products;
        $return['ui_conf'] = array(
         'auto' => (int)MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS,
         'speed' => (int)MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS,
         'vertical' => (MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS == 'true' ? 'true' : 'false'),
         'circular' => (MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS == 'true' ? 'true' : 'false'),
         'visible' => (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS,
         'scroll' => (int)MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS,
        );
      }

      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS < count($products)) {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT, 'class="imgover"');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT,     BUTTON_CAROUSEL_UI_NEXT_ALT,     'class="imgover"');
      }
      else {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED, BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED,     BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
      }

      return $return;
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // 特価商品
    ///////////////////////////////////////////////////////////////////////////////////
    // カルーセルに表示する件数
    function get_carousel_count_specials_products() {
      global $db, $current_category_id;

      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      $return = array();

      $products = array();
      $title = '';

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_SPECIALS . " s
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = s.products_id
            AND s.status = 1
            ;";
      } else {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_SPECIALS . " s
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = s.products_id
            AND s.status = 1
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID
            ;";
      }
      $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->Execute($query);

      // 表示個数が少ない場合の対処
      $count = (int)$result->fields['count'];
      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS > $count)
        return $count;
      else
        return MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS;
    }

    function block_specials_products() {
      global $db, $current_category_id;

      $query = "
        SELECT parent_id
        FROM " . TABLE_CATEGORIES . "
        WHERE categories_id = :categoriesID
        ;";

      $query = $db->bindVars($query, ':categoriesID', $current_category_id, 'integer');
      $result = $db->Execute($query);
      $parent_id = $result->fields['parent_id'];

      $return = array();

      $products = array();
      $title = '';

      if ( (!isset($parent_id)) || ($parent_id == '0') ) {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_SPECIALS . " s
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = s.products_id
            AND s.status = 1
            ;";
      } else {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
            , " . TABLE_SPECIALS . " s
            , " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
            , " . TABLE_CATEGORIES . " c
          WHERE p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
            AND p.products_id = s.products_id
            AND s.status = 1
            AND p.products_id = p2c.products_id
            AND p2c.categories_id = c.categories_id
            AND c.parent_id = :parentID
            ;";
      }
      $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
      $query = $db->bindVars($query, ':parentID', $parent_id, 'integer');
      $result = $db->ExecuteRandomMulti($query, MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS);

      while (!$result->EOF) {

        $id = $result->fields['products_id'];
        $name = $result->fields['products_name'];
        $image = $result->fields['products_image'];
        $manufacturers = $result->fields['manufacturers_name'];

        if ($result->fields['type_handler'] == '') {
          $type_handler = 'product_info';
        } else {
          $type_handler = $result->fields['type_handler'] . '_info';
        }
        $link = zen_href_link($type_handler, 'products_id=' . $id);

        $price = zen_get_products_display_price($id);

        $products[] = array(
          'id' => $id,
          'name' => $name,
          'image' => $image,
          'link' => $link,
          'price' => $price,
          'manufacturers' => $manufacturers
          );

        $result->MoveNextRandom();
      }

      if (count($products) > 0) {
        // 表示件数の倍になるようにする
        $visibleCount = (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS;
        if ($visibleCount == 0)
          $visibleCount = 1;
        $addCount = count($products) % $visibleCount;
        if ($addCount > 0)
          $addCount = $visibleCount - $addCount;
        for ($i=0; $i<$addCount; $i++) {
          $products[] = array(
            'id'            => 0,
            'name'          => '',
            'image'         => '',
            'link'          => '',
            'price'         => '',
            'manufacturers' => ''
            );
        }

        if (isset($parent_id) && $parent_id != 0) {
          $category_title = zen_get_categories_name((int)$parent_id);
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_SPECIALS_PRODUCTS_TITLE, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' );
        } else {
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_SPECIALS_PRODUCTS_TITLE, strftime('%B'));
        }

        $return['title'] = $title;
        $return['products'] = $products;
        $return['ui_conf'] = array(
         'auto' => (int)MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS,
         'speed' => (int)MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS,
         'vertical' => (MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS == 'true' ? 'true' : 'false'),
         'circular' => (MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS == 'true' ? 'true' : 'false'),
         'visible' => (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS,
         'scroll' => (int)MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS,
        );
      }

      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS < count($products)) {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT, 'class="imgover"');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT,     BUTTON_CAROUSEL_UI_NEXT_ALT,     'class="imgover"');
      }
      else {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED, BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED,     BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
      }

      return $return;
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // おすすめ商品
    ///////////////////////////////////////////////////////////////////////////////////
    // カルーセルに表示する件数
    function get_carousel_count_also_purchased_products() {
      global $db, $current_category_id;

      if (isset($_GET['products_id'])) {
        $query = "
          SELECT DISTINCT
            count(p.products_id) count
          FROM " . TABLE_ORDERS_PRODUCTS . " opa
            , " . TABLE_ORDERS_PRODUCTS . " opb
            , " . TABLE_ORDERS . " o
            , " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
          WHERE opa.products_id = :productsID
            AND opa.orders_id = opb.orders_id
            AND opb.products_id != :productsID
            AND opb.products_id = p.products_id
            AND opb.orders_id = o.orders_id
            AND p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID";

        $query  = $db->bindVars($query, ':productsID', $_GET['products_id'], 'integer');
        $query  = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
        $result = $db->Execute($query);

        // 表示個数が少ない場合の対処
        $count = (int)$result->fields['count'];
        if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS > $count)
          return $count;
        else
          return MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS;
      }
      else
        return 0;
    }

    function block_also_purchased_products() {
      global $db, $current_category_id;

      $return = array();
      $products = array();
      $title = '';

      if (isset($_GET['products_id'])) {
        $query = "
          SELECT DISTINCT
            p.products_id, p.products_image,
            pd.products_name,
            pt.type_handler,
            mf.manufacturers_name
          FROM " . TABLE_ORDERS_PRODUCTS . " opa
            , " . TABLE_ORDERS_PRODUCTS . " opb
            , " . TABLE_ORDERS . " o
            , " . TABLE_PRODUCTS . " p
            LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
            LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
            , " . TABLE_PRODUCTS_DESCRIPTION . " pd
          WHERE opa.products_id = :productsID
            AND opa.orders_id = opb.orders_id
            AND opb.products_id != :productsID
            AND opb.products_id = p.products_id
            AND opb.orders_id = o.orders_id
            AND p.products_status = 1
            AND p.products_id = pd.products_id
            AND pd.language_id = :languageID
          GROUP BY p.products_id
          ORDER BY o.date_purchased desc
          LIMIT :limit
          ;";

        $query = $db->bindVars($query, ':productsID', $_GET['products_id'], 'integer');
        $query = $db->bindVars($query, ':languageID', $_SESSION['languages_id'], 'integer');
        $query = $db->bindVars($query, ':limit', MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS, 'integer');

        $result = $db->Execute($query);
        while (!$result->EOF) {

          $id = $result->fields['products_id'];
          $name = $result->fields['products_name'];
          $image = $result->fields['products_image'];
          $manufacturers = $result->fields['manufacturers_name'];

          if ($result->fields['type_handler'] == '') {
            $type_handler = 'product_info';
          } else {
            $type_handler = $result->fields['type_handler'] . '_info';
          }
          $link = zen_href_link($type_handler, 'products_id=' . $id);

          $price = zen_get_products_display_price($id);

          $products[] = array(
            'id' => $id,
            'name' => $name,
            'image' => $image,
            'link' => $link,
            'price' => $price,
            'manufacturers' => $manufacturers
            );

          $result->MoveNext();
        }

        if (count($products) > 0) {
          // 表示件数の倍になるようにする
          $visibleCount = (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS;
          if ($visibleCount == 0)
            $visibleCount = 1;
          $addCount = count($products) % $visibleCount;
          if ($addCount > 0)
            $addCount = $visibleCount - $addCount;
          for ($i=0; $i<$addCount; $i++) {
            $products[] = array(
              'id'            => 0,
              'name'          => '',
              'image'         => '',
              'link'          => '',
              'price'         => '',
              'manufacturers' => ''
              );
          }

          $title = MODULE_CAROUSEL_UI_BLOCK_ALSO_PURCHASED_PRODUCTS_TITLE;

          $return['title'] = $title;
          $return['products'] = $products;
          $return['ui_conf'] = array(
           'auto' => (int)MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS,
           'speed' => (int)MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS,
           'vertical' => (MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS == 'true' ? 'true' : 'false'),
           'circular' => (MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS == 'true' ? 'true' : 'false'),
           'visible' => (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS,
           'scroll' => (int)MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS,
          );
        }
      }

      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS < count($products)) {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT, 'class="imgover"');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT,     BUTTON_CAROUSEL_UI_NEXT_ALT,     'class="imgover"');
      }
      else {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED, BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED,     BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
      }

      return $return;
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // 関連商品
    ///////////////////////////////////////////////////////////////////////////////////
    // カルーセルに表示する件数
    function get_carousel_count_xsell_products() {
      global $db;

      $query = "
        select distinct
          count(p.products_id) count
        from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p
          LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
          LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
          ," . TABLE_PRODUCTS_DESCRIPTION . " pd
        where xp.products_id = '" . (int)$_GET['products_id'] . "'
          and xp.xsell_id = p.products_id
          and p.products_id = pd.products_id
          and pd.language_id = '" . $_SESSION['languages_id'] . "'
          and p.products_status = 1";
      $result = $db->Execute($query);

      // 表示個数が少ない場合の対処
      $count = (int)$result->fields['count'];
      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS > $count)
        return $count;
      else
        return MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS;
    }

    function block_xsell_products() {
      global $db;

      $return = array();

      $products = array();
      $title = '';

      $query = "
        select distinct
          p.products_id, p.products_image,
          pd.products_name,
          pt.type_handler,
          mf.manufacturers_name
        from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p
          LEFT JOIN " . TABLE_PRODUCT_TYPES . " pt ON p.products_type = pt.type_id
          LEFT JOIN " . TABLE_MANUFACTURERS . " mf ON p.manufacturers_id = mf.manufacturers_id
          ," . TABLE_PRODUCTS_DESCRIPTION . " pd
        where xp.products_id = '" . (int)$_GET['products_id'] . "'
          and xp.xsell_id = p.products_id
          and p.products_id = pd.products_id
          and pd.language_id = '" . $_SESSION['languages_id'] . "'
          and p.products_status = 1
        order by xp.sort_order asc limit " . (int)MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS;
      $result = $db->Execute($query);

      while (!$result->EOF) {
        $id = $result->fields['products_id'];
        $name = $result->fields['products_name'];
        $image = $result->fields['products_image'];
        $manufacturers = $result->fields['manufacturers_name'];

        if ($result->fields['type_handler'] == '') {
          $type_handler = 'product_info';
        } else {
          $type_handler = $result->fields['type_handler'] . '_info';
        }
        $link = zen_href_link($type_handler, 'products_id=' . $id);

        $price = zen_get_products_display_price($id);

        $products[] = array(
          'id' => $id,
          'name' => $name,
          'image' => $image,
          'link' => $link,
          'price' => $price,
          'manufacturers' => $manufacturers
          );

        $result->MoveNext();
      }

      if (count($products) > 0) {
        // 表示件数の倍になるようにする
        $visibleCount = (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS;
        if ($visibleCount == 0)
          $visibleCount = 1;
        $addCount = count($products) % $visibleCount;
        if ($addCount > 0)
          $addCount = $visibleCount - $addCount;
        for ($i=0; $i<$addCount; $i++) {
          $products[] = array(
            'id'            => 0,
            'name'          => '',
            'image'         => '',
            'link'          => '',
            'price'         => '',
            'manufacturers' => ''
            );
        }

        if (isset($parent_id) && $parent_id != 0) {
          $category_title = zen_get_categories_name((int)$parent_id);
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_XSELL_PRODUCTS_TITLE, strftime('%B')) . ($category_title != '' ? ' - ' . $category_title : '' );
        } else {
          $title = sprintf(MODULE_CAROUSEL_UI_BLOCK_XSELL_PRODUCTS_TITLE, strftime('%B'));
        }

        $return['title'] = $title;
        $return['products'] = $products;
        $return['ui_conf'] = array(
         'auto' => (int)MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS,
         'speed' => (int)MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS,
         'vertical' => (MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS == 'true' ? 'true' : 'false'),
         'circular' => (MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS == 'true' ? 'true' : 'false'),
         'visible' => (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS,
         'scroll' => (int)MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS,
        );
      }

      if ((int)MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS < count($products)) {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS, BUTTON_CAROUSEL_UI_PREVIOUS_ALT, 'class="imgover"');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT,     BUTTON_CAROUSEL_UI_NEXT_ALT,     'class="imgover"');
      }
      else {
        $return ['prevbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED, BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
        $return ['nextbutton'] = $this->imageButton(BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED,     BUTTON_CAROUSEL_UI_DISABLED_ALT, '');
      }

      return $return;
    }

    // override getBlock method
    function getBlock($block, $page) {
      global $template;
      $return = false;
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
