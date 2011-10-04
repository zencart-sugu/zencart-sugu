<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class super_products_list extends addOnModuleBase {
    var $author = array('ohmura');
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.1.1';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '0.1';

    var $title = MODULE_SUPER_PRODUCTS_LIST_TITLE;
    var $description = MODULE_SUPER_PRODUCTS_LIST_DESCRIPTION;
    var $sort_order = MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER;
    var $icon;
    var $status = MODULE_SUPER_PRODUCTS_LIST_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_SUPER_PRODUCTS_LIST_STATUS_TITLE,
            'configuration_key' => 'MODULE_SUPER_PRODUCTS_LIST_STATUS',
            'configuration_value' => MODULE_SUPER_PRODUCTS_LIST_STATUS_DEFAULT,
            'configuration_description' => MODULE_SUPER_PRODUCTS_LIST_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER',
            'configuration_value' => MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_SUPER_PRODUCTS_LIST_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS_TITLE,
            'configuration_key' => 'MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS',
            'configuration_value' => MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS_DEFAULT,
            'configuration_description' => MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
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
    function super_products_list() {
      require_once($this->dir . 'classes/super_products_list_model.php');
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

    // page methods
    function page() {
      $return = array();
      $return = $this->module_form($return);
      return $return;
    }

    function page_results() {
      global $messageStack;

      $search_params = super_products_list_model::get_search_params($_REQUEST);
      $errors = super_products_list_model::validate_search_params($search_params);
      if (!empty($errors)) {
        foreach ($errors as $error) {
          $messageStack->add('header', $error, 'error');
        }
      }

      $return = $search_params;
      $return['result_all'] = super_products_list_model::count_all($search_params);
      $return['products']   = super_products_list_model::search($search_params);
      $return['paging']     = super_products_list_model::get_paging($search_params, $return['result_all']);

      $return = $this->module_form($return);
      return $return;
    }

    function module_form($return = array()) {
      $return['categories_options'] = zen_get_categories(array(array('id' => '', 'text' => MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_CATEGORIES)),0 ,'', '1');
      $return['manufacturers_options'] = zen_get_manufacturers(array(array('id' => '', 'text' => MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_MANUFACTURERS)));
      $return['sort_options']     = array(
        array('id' => 'name',       'text' => MODULE_SUPER_PRODUCTS_LIST_SORT_NAME),
        array('id' => 'price',      'text' => MODULE_SUPER_PRODUCTS_LIST_SORT_PRICE),
        array('id' => 'sort_order', 'text' => MODULE_SUPER_PRODUCTS_LIST_SORT_SORT_ORDER),
        array('id' => 'date',       'text' => MODULE_SUPER_PRODUCTS_LIST_SORT_DATE),
      );
      $return['direction_options'] = array(
        array('id' => 'asc',  'text' => MODULE_SUPER_PRODUCTS_LIST_DIRECTION_ASC),
        array('id' => 'desc', 'text' => MODULE_SUPER_PRODUCTS_LIST_DIRECTION_DESC),
      );
      return $return;
    }
  }
?>
