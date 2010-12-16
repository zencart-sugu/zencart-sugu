<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class advanced_stock extends addOnModuleBase {
    var $author                        = array("saito");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";

    var $title = MODULE_ADDON_MODULES_ADVANCED_STOCK_TITLE;
    var $description = MODULE_ADDON_MODULES_ADVANCED_STOCK_DESCRIPTION;
    var $sort_order = MODULE_ADDON_MODULES_ADVANCED_STOCK_SORT_ORDER;
    var $icon;
    var $status = MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_ENABLE_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_ENABLE',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_ENABLE_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_ENABLE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SEND_FOR_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_SEND_FOR',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SEND_FOR_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SEND_FOR_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISABLE_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_DISABLE',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISABLE_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISABLE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISPLAY_STOCK_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_DISPLAY_STOCK',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISPLAY_STOCK_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_DISPLAY_STOCK_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_FLAG_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_FLAG',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_FLAG_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_FLAG_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_MESSAGE_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_MESSAGE',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_MESSAGE_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_MESSAGE_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_textarea_small('
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_ADVANCED_STOCK_SORT_ORDER',
            'configuration_value' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_ADVANCED_STOCK_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array('NOTIFY_HEADER_END_SHOPPING_CART');

    // class constructer for php4
    function advanced_stock() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
      switch ($notifier) {
      case 'NOTIFY_HEADER_END_SHOPPING_CART':
	if (is_array($GLOBALS['productArray'])) {
	  $flagAnyOutOfStock = false;
	  foreach ($GLOBALS['productArray'] as $key => $product) {
	    $send_for_status = advanced_stock_get_sendfor_status($product['id']);
	    if ($send_for_status && !empty($GLOBALS['productArray'][$key]['flagStockCheck'])) {
	      // お取り寄せの場合
	      $GLOBALS['productArray'][$key]['flagStockCheck'] = advanced_stock_get_mark();
	      $GLOBALS['flagAnySendForProduct'] = true;
	    } elseif (!empty($GLOBALS['productArray'][$key]['flagStockCheck'])) {
	      // 在庫切れの場合
	      $flagAnyOutOfStock = true;
	    }
	  }
	  if ($flagAnyOutOfStock == false) {
	    // 在庫切れがなかった場合
	    $GLOBALS['flagAnyOutOfStock'] = false;
	  }
	}
	break;
      default:
	break;
      }
    }

    function _install() {
      global $db;
      $column_exists = false;
      $table = $db->Execute('explain ' . TABLE_PRODUCTS);
      while(!$table->EOF) {
	if ($table->fields['Field'] == MODULE_ADDON_MODULES_COLUMN_NAME) {
	  $column_exists = true;
	  break;
	}
	$table->MoveNext();
      }
      if ($column_exists === false) {
	$sql = 'ALTER TABLE ' . TABLE_PRODUCTS . ' ADD COLUMN ' . MODULE_ADDON_MODULES_COLUMN_NAME . ' tinyint(1) NOT NULL default \'0\'';
	$db->Execute($sql);
      }
    }

    function _update() {
    }

    function _remove() {
      global $db;
      $column_exists = false;
      $table = $db->Execute('explain ' . TABLE_PRODUCTS);
      while(!$table->EOF) {
	if ($table->fields['Field'] == MODULE_ADDON_MODULES_COLUMN_NAME) {
	  $column_exists = true;
	  break;
	}
	$table->MoveNext();
      }
      if ($column_exists === true) {
	$sql = 'ALTER TABLE ' . TABLE_PRODUCTS . ' DROP COLUMN ' . MODULE_ADDON_MODULES_COLUMN_NAME;
	$db->Execute($sql);
      }
    }

    function _cleanUp() {
    }

    function advanced_stock_get_sendfor_message() {
      return advanced_stock_get_sendfor_message();
    }
    function display_advanced_stock($products_id) {
      if (MODULE_ADDON_MODULES_ADVANCED_STOCK_DISPLAY_STOCK == 'true') {
        return display_advanced_stock($products_id);
      }
      return '';
    }
    function advanced_stock_get_buy_now_button($products_id, $the_button, $additional_link = false) {
      return advanced_stock_get_buy_now_button($products_id, $the_button, $additional_link);
    }
    function advanced_stock_get_sendfor_status($products_id) {
      return advanced_stock_get_sendfor_status($products_id);
    }
    function advanced_stock_set_sendfor_status($products_id) {
      return advanced_stock_set_sendfor_status($products_id);
    }
    function advanced_stock_draw_sendfor_flag() {
      return advanced_stock_draw_sendfor_flag();
    }
  }
?>