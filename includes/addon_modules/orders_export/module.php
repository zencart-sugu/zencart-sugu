<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class orders_export extends addOnModuleBase {
    var $author = array('ohmura');
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.1.1';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '0.1';

    var $title = MODULE_ORDERS_EXPORT_TITLE;
    var $description = MODULE_ORDERS_EXPORT_DESCRIPTION;
    var $sort_order = MODULE_ORDERS_EXPORT_SORT_ORDER;
    var $icon;
    var $status = MODULE_ORDERS_EXPORT_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ORDERS_EXPORT_STATUS_TITLE,
            'configuration_key' => 'MODULE_ORDERS_EXPORT_STATUS',
            'configuration_value' => MODULE_ORDERS_EXPORT_STATUS_DEFAULT,
            'configuration_description' => MODULE_ORDERS_EXPORT_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ORDERS_EXPORT_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ORDERS_EXPORT_SORT_ORDER',
            'configuration_value' => MODULE_ORDERS_EXPORT_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ORDERS_EXPORT_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    /**
     * define default block layouts.
     * these will be set automatically when module installed.
     *
     - parameters
     -- name:     name of block method
     -- location: where the block is included
                  header,main_top,main_bottom,sidebar_left,sidebar_right,footer,main are available.
     -- visible:  0) always include block excluding pages
                  1) include block at pages
     -- pages:    target pages
     */
    /* examples
    var $block_layouts = array(array('name'     => 'block',
                                     'location' => 'main_top',
                                     'visible'  => '0',
                                     'pages'    => array('checkout_confirmation',
                                                         'checkout_payment',
                                                         'checkout_payment_address',
                                                         'checkout_shipping',
                                                         'checkout_shipping_address',
                                                         'checkout_success')),
                         );
    end of examples */
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function orders_export() {
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

  }
?>
