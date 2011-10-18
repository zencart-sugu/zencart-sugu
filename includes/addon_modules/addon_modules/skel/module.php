<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class :module_name extends addOnModuleBase {
    var $author = array(':author');
    var $author_email = ':author_email';
    var $version = ':version';
    var $require_zen_cart_version = ':zencart_version';
    var $require_addon_modules_version = ':addonmodule_version';

    var $title = :def_title;
    var $description = :def_description;
    var $sort_order = :def_sort_order;
    var $icon;
    var $status = :def_status;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => :def_status_title,
            'configuration_key' => ':def_module_status',
            'configuration_value' => :def_status_default,
            'configuration_description' => :def_status_description,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => :def_sort_order_title,
            'configuration_key' => ':def_module_sort_order',
            'configuration_value' => :def_sort_order_default,
            'configuration_description' => :def_sort_order_description,
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
    var $require_modules = array(:required);
    var $notifier = array();

    // class constructer for php4
    function :module_name() {
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