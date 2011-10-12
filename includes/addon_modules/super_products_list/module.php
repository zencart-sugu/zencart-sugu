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
          array(
            'configuration_title' => MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE_TITLE,
            'configuration_key' => 'MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE',
            'configuration_value' => MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE_DEFAULT,
            'configuration_description' => MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE_DESCRIPTION,
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
    var $require_modules = array('jquery');
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
    // 検索画面
    function page() {
      $return = array();
      $return = $this->module_form($return);
      return $return;
    }

    // 検索結果
    function page_results() {
      global $messageStack;

      $model = new super_products_list_model();  

      $model->set_search_params($_REQUEST);
      $errors = $model->validate_search_params();
      if (!empty($errors)) {
        foreach ($errors as $error) {
          $messageStack->add('header', $error, 'error');
        }
      }
      $search_params = $model->get_search_params();

      $return = $search_params;
      $return['result_all'] = $model->count_all();
      $return['products']   = $model->search();
      $return['paging']     = $model->get_paging($return['result_all']);
      if (zen_not_null($search_params['categories_id'])) {
        $current_category = $model->get_category($search_params['categories_id']);
        $return['current_categories_path']        = $model->get_categories_path($search_params['categories_id'], $model->get_super_products_list_link('results'));
        $return['current_categories_name']        = $current_category['categories_name'];
        $return['current_categories_description'] = $current_category['categories_description'];
      } else {
        $return['current_categories_name'] = MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_CATEGORIES;
      }
      if (zen_not_null($search_params['manufacturers_id'])) {
        $current_manufacturer = $model->get_manufacturer($search_params['manufacturers_id']);
        $return['current_manufacturers_name'] = $current_manufacturer['manufacturers_name'];
      } else {
        $return['current_manufacturers_name'] = MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_MANUFACTURERS;
      }

      $return = $this->module_form($return);
      return $return;
    }

    // 検索フォーム（検索画面、検索結果画面で共通利用）
    function module_form($return = array()) {
      $return['categories_options'] = zen_get_categories(array(array('id' => '', 'text' => MODULE_SUPER_PRODUCTS_LIST_TEXT_ALL_CATEGORIES)),0 ,'', '1');
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
      $limit_options = super_products_list_model::get_limit_options();
      foreach ($limit_options as $limit_option) {
        $return['limit_options'][] = array('id' => $limit_option, 'text' => $limit_option);
      }
      return $return;
    }

    // メーカー指定画面
    function page_manufacturers() {
      foreach ($_REQUEST as $key => $val) {
        $_REQUEST[$key] = mb_convert_encoding($_REQUEST[$key], CHARSET, 'UTF-8');
      }

      $block = $GLOBALS['super_products_list']->getBlock('block_manufacturers', $current_page_base);
      header("Content-Type: text/html; charset=". CHARSET);
      echo $block;
      exit();	// blockの内容だけ出力したいのでexit
    }

    // メーカー指定画面用ブロック
    function block_manufacturers() {
      $return = $_REQUEST;
      $keys = array('keywords', 'categories_id', 'price_from', 'price_to', 'date_from', 'date_to');
      foreach ($keys as $key) {
        $return['encoded_params'] .= '&'. $key .'='. urlencode($_REQUEST[$key]);
      }
      return $return;
    }

    // メーカー一覧をJSONで返す
    function page_ajax_get_manufacturers() {
      foreach ($_REQUEST as $key => $val) {
        $_REQUEST[$key] = mb_convert_encoding($_REQUEST[$key], CHARSET, 'UTF-8');
      }

      $data;
      $model = new super_products_list_model();  
      $model->set_search_params($_REQUEST);
      $errors = $model->validate_search_params();
      if (!empty($errors)) {
        $data->result  = "ng";
        $data->message = join("<br />", $errors);
      }else{
        $search_params = $model->get_search_params();
        $max_count = $model->count_all_manufacturers();
        $max_page = ceil($max_count / MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_LIST_LIMIT_DEFAULT);
        $manufacturers = $model->search_manufacturers();
        for ($i = 0, $n = count($manufacturers); $i < $n; $i++) {
          $manufacturers[$i]['name'] = mb_convert_encoding($manufacturers[$i]['name'], 'UTF-8', CHARSET);
        }
        
        $data->result  = "ok";
        $data->message = "";
        $data->response->max_page = $max_page;
        $data->response->manufacturers = $manufacturers;
      }
      header("Content-Type: application/json; charset=UTF-8");
      echo $model->toJSON($data);
      exit;
    }
  }
?>
