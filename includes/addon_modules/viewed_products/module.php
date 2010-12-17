<?php
/**
 * viewed_products Module
 *
 * @package viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  /**
   *
   * @author Koji Sasaki
   *
   */
  class viewed_products extends addOnModuleBase {
    /**
     * Display modules title on admin.
     * @var string
     */
    var $title = MODULE_VIEWED_PRODUCTS_TITLE;

    /**
     * Display modules descriptionl on admin.
     * @var string
     */
    var $description = MODULE_VIEWED_PRODUCTS_DESCRIPTION;

    /**
     * Module author
     * @var string
     */
    var $author = array("Koji Sasaki");

    /**
     * Module author email
     * @var string
     */
    var $author_email = "info@zencart-sugu.jp";

    /**
     * Module version for addon module download manager.
     * @var string
     */
    var $version = "0.1";

    /**
     * Require addon modules core version
     * @var string
     */

    var $require_addon_modules_version = "0.1";

    /**
     * Require zen cart version
     * @var string
     */
    var $require_zen_cart_version = "1.3.0.2";

    /**
     * Module priority number
     * @var integer
     */
    var $sort_order = MODULE_VIEWED_PRODUCTS_SORT_ORDER;
    var $icon;
    var $status = MODULE_VIEWED_PRODUCTS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_VIEWED_PRODUCTS_STATUS_TITLE,
            'configuration_key' => 'MODULE_VIEWED_PRODUCTS_STATUS',
            'configuration_value' => MODULE_VIEWED_PRODUCTS_STATUS_DEFAULT,
            'configuration_description' => MODULE_VIEWED_PRODUCTS_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\',\'false\'), '
          ),
          array(
            'configuration_title' => MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_TITLE,
            'configuration_key' => 'MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED',
            'configuration_value' => MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DEFAULT,
            'configuration_description' => MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_TITLE,
            'configuration_key' => 'MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE',
            'configuration_value' => MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DEFAULT,
            'configuration_description' => MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_VIEWED_PRODUCTS_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_VIEWED_PRODUCTS_SORT_ORDER',
            'configuration_value' => MODULE_VIEWED_PRODUCTS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_VIEWED_PRODUCTS_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );

    var $require_modules = array();

    var $notifier = array(
      'NOTIFY_MAIN_TEMPLATE_VARS_END_DOCUMENT_GENERAL_INFO',
      'NOTIFY_MAIN_TEMPLATE_VARS_END_DOCUMENT_PRODUCT_INFO',
      'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_FREE_SHIPPING_INFO',
      'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_INFO',
      'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_MUSIC_INFO',

      'NOTIFY_LOGIN_SUCCESS',
      'NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT',

      'NOTIFY_HEADER_START_LOGOFF',
      );

    var $tables = array(
      TABLE_CUSTOMERS_VIEWED_PRODUCTS => array(
        'customers_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'products_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'date_added' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
        'INDEXES' => array(
          'PRIMARY' => array('customers_id', 'products_id'),
          ),
        ),
      );

    // class constructer for php4
    function viewed_products() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      if (in_array($notifier, array(
        'NOTIFY_MAIN_TEMPLATE_VARS_END_DOCUMENT_GENERAL_INFO',
        'NOTIFY_MAIN_TEMPLATE_VARS_END_DOCUMENT_PRODUCT_INFO',
        'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_FREE_SHIPPING_INFO',
        'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_INFO',
        'NOTIFY_MAIN_TEMPLATE_VARS_END_PRODUCT_MUSIC_INFO',
        ))) {
        $_SESSION['viewed']->addProduct($_GET['products_id']);

      } elseif (in_array($notifier, array(
        'NOTIFY_LOGIN_SUCCESS',
        'NOTIFY_LOGIN_SUCCESS_VIA_CREATE_ACCOUNT',
        ))) {
        $_SESSION['viewed']->setStoreDB();
        $_SESSION['viewed']->restoreProducts();

      } elseif (in_array($notifier, array(
        'NOTIFY_HEADER_START_LOGOFF',
        ))) {
        $_SESSION['viewed']->reset();
        $_SESSION['viewed']->unsetStoreDB();

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

    function block() {
      $return = array();
      $viewed_products = $_SESSION['viewed']->getProducts();
      if (!$viewed_products) $viewed_products = array();
      if(count($viewed_products) > 0) {
        $return['title'] = MODULE_VIEWED_PRODUCTS_BLOCK_TITLE;
        $return['viewed_products'] = $viewed_products;
        list($small_width, $small_height) = spliti('x', MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE);
        $return['small_width'] = $small_width;
        $return['small_height'] = $small_height;
      }
      return $return;
    }
  }
