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
 * @version $Id: globalnavi.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class globalnavi extends addonModuleBase {
    var $title = MODULE_GLOBALNAVI_TITLE;
    var $description = MODULE_GLOBALNAVI_DESCRIPTION;
    var $sort_order = MODULE_GLOBALNAVI_SORT_ORDER;
    var $icon;
    var $status = MODULE_GLOBALNAVI_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_GLOBALNAVI_STATUS_TITLE,
            'configuration_key' => 'MODULE_GLOBALNAVI_STATUS',
            'configuration_value' => MODULE_GLOBALNAVI_STATUS_DEFAULT,
            'configuration_description' => MODULE_GLOBALNAVI_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_GLOBALNAVI_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_GLOBALNAVI_SORT_ORDER',
            'configuration_value' => MODULE_GLOBALNAVI_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_GLOBALNAVI_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_GLOBALNAVI_LIMIT_TITLE,
            'configuration_key' => 'MODULE_GLOBALNAVI_CFG_LIMIT',
            'configuration_value' => MODULE_GLOBALNAVI_LIMIT_DEFAULT,
            'configuration_description' => MODULE_GLOBALNAVI_LIMIT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array('jquery');
    var $notifier = array();

    var $author                        = "s.saito";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    // class constructer for php4
    function globalnavi() {
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
      $categories = $this->_get_categories(0, MODULE_GLOBALNAVI_CFG_LIMIT);
      foreach($categories as $key => $val) {
        $categories[$key]['sub'] = $this->_get_categories($val['id']);
      }
      //$return['title'] = MODULE_GLOBALNAVI_BLOCK_TITLE;
      $return['categories'] = $categories;
      return $return;
    }

    function _get_categories($parent_id = 0, $limit = null) {
      global $db;
      $categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                         from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         where 
                         parent_id = '" . (int)$parent_id . "'
                         and c.categories_id = cd.categories_id
                         and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         order by sort_order, cd.categories_name";
      if (!empty($limit)) {
        $categories_query .= ' limit ' . $limit;
      }
      $categories = $db->Execute($categories_query);
      while (!$categories->EOF) {
        $categories_array[] = array('id' => $categories->fields['categories_id'],
                                    'text' => $indent . $categories->fields['categories_name']);
        $categories->MoveNext();
      }
      return $categories_array;
    }

  }
?>