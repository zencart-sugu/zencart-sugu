<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class easy_admin_products extends addOnModuleBase {
    var $title       = MODULE_EASY_ADMIN_PRODUCTS_TITLE;
    var $description = MODULE_EASY_ADMIN_PRODUCTS_DESCRIPTION;
    var $version     = "1.0.0";
    var $sort_order  = MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER;
    var $status      = MODULE_EASY_ADMIN_PRODUCTS_STATUS;
    var $icon;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_PRODUCTS_STATUS_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_PRODUCTS_STATUS',
            'configuration_value'       => MODULE_EASY_ADMIN_PRODUCTS_STATUS_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_PRODUCTS_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'), '
            ),
          array(
            'configuration_title'       => MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER',
            'configuration_value'       => MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EASY_ADMIN_PRODUCTS_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
            ),
          );

    var $require_modules = array();
    var $notifier        = array();

    // class constructer for php4
    function easy_admin_products() {
        $this->__construct();
    }

    function __construct() {
        require_once($this->dir . 'classes/easy_admin_products_model.php');
        require_once($this->dir . 'classes/easy_admin_products_html.php');
        parent::__construct();
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

    //
    // page
    //
    function page_hoge() {
    }

    //
    // block
    //
    function block_hoge() {
    }

    //
    // notify
    //
    function notify_hoge() {
    }

    //
    // functions
    //
    function hoge() {
    }
}
