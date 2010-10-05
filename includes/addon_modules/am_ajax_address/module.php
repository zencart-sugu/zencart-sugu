<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author saito
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: am_ajax_address $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class am_ajax_address extends addonModuleBase {
    var $author                        = "saito";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.2";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title       = MODULE_AM_AJAX_ADDRESS_TITLE;
    var $description = MODULE_AM_AJAX_ADDRESS_DESCRIPTION;
    var $sort_order  = MODULE_AM_AJAX_ADDRESS_SORT_ORDER_DEFAULT;
    var $icon;
    var $status      = MODULE_AM_AJAX_ADDRESS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_AM_AJAX_ADDRESS_STATUS_TITLE,
            'configuration_key'         => 'MODULE_AM_AJAX_ADDRESS_STATUS',
            'configuration_value'       => MODULE_AM_AJAX_ADDRESS_STATUS_DEFAULT,
            'configuration_description' => MODULE_AM_AJAX_ADDRESS_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ));
    var $require_modules = array('jquery');
    var $notifier        = array('NOTIFY_HEADER_START_CREATE_ACCOUNT',
                                 'NOTIFY_HEADER_START_CHECKOUT_SHIPPING_ADDRESS',
                                 'NOTIFY_HEADER_START_ADDRESS_BOOK_PROCESS',
                                 'NOTIFY_HEADER_START_CHECKOUT_PAYMENT_ADDRESS',
                                 'NOTIFY_HEADER_START_CREATE_VISITOR',
                                 'NOTIFY_HEADER_START_VISITOR_TO_ACCOUNT',
                                 'NOTIFY_HEADER_START_VISITOR_EDIT',
                                 'NOTIFY_HEADER_START_LOGIN'
                           );

    // class constructer for php4
    function am_ajax_address() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      switch($notifier) {
      default:
        $template_dir = $this->_getTemplateDir('.js', $page, 'jscript');
        $directory_array = $this->_getTemplatePart($template_dir, '/^notifier_/', '.php');
        while(list ($key, $value) = each($directory_array)) {
          require($template_dir . '/' . $value);
        }
	break;
      }
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

  }
?>