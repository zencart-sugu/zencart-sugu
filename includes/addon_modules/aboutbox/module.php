<?php
/**
 * shopping_cart_summary Module
 *
 * @package Addon Modules
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: aboutbox.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class aboutbox extends addOnModuleBase {
    var $author = array('saito');
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.1.2';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    var $title = MODULE_ABOUTBOX_TITLE;
    var $description = MODULE_ABOUTBOX_DESCRIPTION;
    var $sort_order = MODULE_ABOUTBOX_SORT_ORDER;
    var $icon;
    var $status = MODULE_ABOUTBOX_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ABOUTBOX_STATUS_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_STATUS',
            'configuration_value' => MODULE_ABOUTBOX_STATUS_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_SORT_ORDER',
            'configuration_value' => MODULE_ABOUTBOX_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_HEADER_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_CFG_HEADER',
            'configuration_value' => MODULE_ABOUTBOX_HEADER_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_HEADER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_GREETING_TITLE_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_CFG_GREETING_TITLE',
            'configuration_value' => MODULE_ABOUTBOX_GREETING_TITLE_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_GREETING_TITLE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_GREETING_TEXT_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_CFG_GREETING_TEXT',
            'configuration_value' => MODULE_ABOUTBOX_GREETING_TEXT_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_GREETING_TEXT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_textarea_aboutbox('
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_IMAGEPATH_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_CFG_IMAGEPATH',
            'configuration_value' => MODULE_ABOUTBOX_IMAGEPATH_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_IMAGEPATH_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_DISPLAY_CALENDAR_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_DISPLAY_CALENDAR',
            'configuration_value' => MODULE_ABOUTBOX_DISPLAY_CALENDAR_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_DISPLAY_CALENDAR_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ABOUTBOX_AVALABLE_CARDS_TITLE,
            'configuration_key' => 'MODULE_ABOUTBOX_AVALABLE_CARDS',
            'configuration_value' => MODULE_ABOUTBOX_AVALABLE_CARDS_DEFAULT,
            'configuration_description' => MODULE_ABOUTBOX_AVAILABLE_CARDS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'0\', \'1\', \'2\'), '
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function aboutbox() {
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
      $return['title'] = MODULE_ABOUTBOX_CFG_HEADER;
      $return['sub_title'] = MODULE_ABOUTBOX_CFG_GREETING_TITLE;
      $return['text'] = MODULE_ABOUTBOX_CFG_GREETING_TEXT;
      $return['image'] = MODULE_ABOUTBOX_CFG_IMAGEPATH;

      return $return;
    }

  }
?>