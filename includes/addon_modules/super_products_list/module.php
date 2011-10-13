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
      global $currencies;

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
      if ($return['price_from'] != '' || $return['price_to'] != '') {
        $return['price_from_to'] = $currencies->format($return['price_from']) . MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO . $currencies->format($return['price_to']);
      }else{
        $return['price_from_to'] = "";
      }
      if ($return['date_from'] != '' || $return['date_to'] != '') {
        $return['date_from_to'] = $return['date_from'] . MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO . $return['date_to'];
      }else{
        $return['date_from_to'] = "";
      }


      return $return;
    }

    // メーカー指定画面
    function page_manufacturers() {
      $this->echo_block_and_exit('block_manufacturers');
    }

    // メーカー指定画面用ブロック
    function block_manufacturers() {
      mb_convert_variables(CHARSET, 'UTF-8', $_REQUEST);

      $return = $_REQUEST;
      $keys = array('keywords', 'categories_id', 'price_from', 'price_to', 'date_from', 'date_to', 'sort', 'direction', 'limit');
      foreach ($keys as $key) {
        $return['encoded_params'] .= '&'. $key .'='. urlencode($_REQUEST[$key]);
      }
      return $return;
    }

    // メーカー一覧をJSONで返す
    function page_ajax_get_manufacturers() {
      mb_convert_variables(CHARSET, 'UTF-8', $_REQUEST);

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
        
        $data->result  = "ok";
        if (empty($manufacturers)) {
          $data->message = MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_NOT_FOUND;
        }else{
          $data->message = "";
        }
        $data->response->max_page = $max_page;
        $data->response->manufacturers = $manufacturers;
      }
      mb_convert_variables('UTF-8', CHARSET, $data);
      header("Content-Type: application/json; charset=UTF-8");
      echo $model->toJSON($data);
      exit;
    }

    // カテゴリ一覧ブロック
    function block_categories() {
      $model = new super_products_list_model();  

      $return = array();
      $return['categories'] = $model->get_categories_tree($_REQUEST['categories_id']);
      $return['search_link'] = zen_href_link(FILENAME_ADDON, 'module=super_products_list/results');
      return $return;
    }

    // 価格指定画面
    function page_price_setting() {
      $this->echo_block_and_exit('block_price_setting');
    }

    // 価格指定画面用ブロック
    function block_price_setting() {
      global $currencies;

      mb_convert_variables(CHARSET, 'UTF-8', $_REQUEST);
      $price_from = $_REQUEST['price_from'];
      $price_to   = $_REQUEST['price_to'];
      // 検索条件から価格を外す
      unset($_REQUEST['price_from']);
      unset($_REQUEST['price_to']);

      $model = new super_products_list_model();  
      $model->set_search_params($_REQUEST);
      $model->validate_search_params();
      $min_max_price = $model->get_min_max_price();

      $return = $_REQUEST;
      if (!$min_max_price) {
        $return['products_exists'] = false;
        $return['message'] = MODULE_SUPER_PRODUCTS_LIST_NOT_FOUND_PRODUCTS;
      }else{
        $price_from = zen_not_null($price_from) ? $price_from : $min_max_price['min'];
        $price_to   = zen_not_null($price_to) ? $price_to : $min_max_price['max'];
        $return['products_exists'] = true;
        $return['price_from'] = max($price_from, $min_max_price['min']);
        $return['price_to']   = min($price_to,   $min_max_price['max']);
        $return['min_value']  = $min_max_price['min'];
        $return['max_value']  = $min_max_price['max'];
      }
      $return['symbol_left']  = $currencies->currencies[$_SESSION['currency']]['symbol_left'];
      $return['symbol_right'] = $currencies->currencies[$_SESSION['currency']]['symbol_right'];
      return $return;
    }

    // 発売日指定画面
    function page_date_setting() {
      $this->echo_block_and_exit('block_date_setting');
    }

    // 発売日指定画面用ブロック
    function block_date_setting() {
      mb_convert_variables(CHARSET, 'UTF-8', $_REQUEST);
      $date_from = $_REQUEST['date_from'];
      $date_to   = $_REQUEST['date_to'];
      // 検索条件から発売日を外す
      unset($_REQUEST['date_from']);
      unset($_REQUEST['date_to']);

      $model = new super_products_list_model();  
      $model->set_search_params($_REQUEST);
      $model->validate_search_params();
      $min_max_date = $model->get_min_max_date();

      $return = $_REQUEST;
      if (!$min_max_date) {
        $return['products_exists'] = false;
        $return['message'] = MODULE_SUPER_PRODUCTS_LIST_NOT_FOUND_PRODUCTS;
      }else{
        $date_from = empty($date_from) ? $min_max_date['min'] : $date_from;
        $date_to   = empty($date_to) ? $min_max_date['max'] : $date_to;
        $return['products_exists'] = true;
        $return['date_from']      = $model->max_date($date_from, $min_max_date['min']);
        $return['date_to']        = $model->min_date($date_to,   $min_max_date['max']);
        $return['min_value']      = $min_max_date['min'];
        $return['max_value']      = $min_max_date['max'];
        $return['start_date']     = explode('/', $min_max_date['min']);
        $return['days']           = $model->calc_days($min_max_date['min'], $min_max_date['max']);
        $return['date_from_days'] = $model->calc_days($min_max_date['min'], $date_from);
        $return['date_to_days']   = $model->calc_days($min_max_date['min'], $date_to);
      }
      return $return;
    }

    function echo_block_and_exit($block_name) {
      global $current_page_base;

      $block = $this->getBlock($block_name, $current_page_base);
      header("Content-Type: text/html; charset=". CHARSET);
      echo $block;
      exit();	// blockの内容を出力しexit
    }
  }
?>
