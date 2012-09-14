<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class checkout_step extends addOnModuleBase {
    var $author = array('saito');
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.1.2';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    var $title = MODULE_CHECKOUT_STEP_TITLE;
    var $description = MODULE_CHECKOUT_STEP_DESCRIPTION;
    var $sort_order = MODULE_CHECKOUT_STEP_SORT_ORDER;
    var $icon;
    var $status = MODULE_CHECKOUT_STEP_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_CHECKOUT_STEP_STATUS_TITLE,
            'configuration_key' => 'MODULE_CHECKOUT_STEP_STATUS',
            'configuration_value' => MODULE_CHECKOUT_STEP_STATUS_DEFAULT,
            'configuration_description' => MODULE_CHECKOUT_STEP_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_CHECKOUT_STEP_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_CHECKOUT_STEP_SORT_ORDER',
            'configuration_value' => MODULE_CHECKOUT_STEP_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_CHECKOUT_STEP_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function checkout_step() {
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
      $page = $_GET['main_page'];
      $return = array();
      $return['title'] = MODULE_CHECKOUT_STEP_BLOCK_TITLE;
      if ($page != FILENAME_CHECKOUT_SUCCESS && $_SESSION['cart']->count_contents() < 1) {
	return array();
      }

      switch($page) {
      case FILENAME_CHECKOUT_SHIPPING_ADDRESS:
	$page = FILENAME_CHECKOUT_SHIPPING;
	$return['steps'] = $this->_createSteps($page);
	break;
      case FILENAME_CHECKOUT_PAYMENT_ADDRESS:
	$page = FILENAME_CHECKOUT_PAYMENT;
	$return['steps'] = $this->_createSteps($page);
	break;
      case FILENAME_SHOPPING_CART:
      case FILENAME_CHECKOUT_SHIPPING:
      case FILENAME_CHECKOUT_PAYMENT:
      case FILENAME_CHECKOUT_CONFIRMATION:
      case FILENAME_CHECKOUT_SUCCESS:
	$return['steps'] = $this->_createSteps($page);
	break;
      case FILENAME_LOGIN:
      case FILENAME_CREATE_ACCOUNT:
      case FILENAME_CREATE_ACOUNT_SUCCESS:
	if ($_SESSION['navigation']->snapshot['page'] == FILENAME_CHECKOUT_SHIPPING) {
	  $page = FILENAME_LOGIN;
	  $return['steps'] = $this->_createSteps($page);
	  break;
	}
      case FILENAME_ADDON:
	if (($_GET['module'] == 'visitors/create_visitor' || $_GET['module'] == 'visitors/visitor_edit') && $_SESSION['navigation']->snapshot['page'] == FILENAME_CHECKOUT_SHIPPING) {
	  $page = FILENAME_LOGIN;
	  $return['steps'] = $this->_createSteps($page);
	  break;
	}
      default:
	unset($_SESSION['steps']);
	$return = array();
      }
      return $return;
    }

    function _isLogin() {
      if ($_SESSION['customer_id'] > 0 && !isset($_SESSION['visitors_id'])) {
	$login = true;
      } else {
	$login = false;
      }
      return $login;
    }

    function _isShipping() {
      if ($_SESSION['cart']->get_content_type() == 'virtual') {
	$shipping = false;
      } else {
	$shipping = true;
      }
      return $shipping;
    }

    function _createSteps($page) {
	$steps = array();
	$steps[] = array('page' => FILENAME_SHOPPING_CART, 'text' => MODULE_CHECKOUT_STEP_BLOCK_CART);
	if (!$this->_isLogin()) {
	  $steps[] = array('page' => FILENAME_LOGIN, 'text' => MODULE_CHECKOUT_STEP_BLOCK_LOGIN);
	}
//	if ($this->_isShipping()) {
	  $steps[] = array('page' => FILENAME_CHECKOUT_SHIPPING, 'text' => MODULE_CHECKOUT_STEP_BLOCK_SHIPPING);
//	}
	$steps[] = array('page' => FILENAME_CHECKOUT_PAYMENT, 'text' => MODULE_CHECKOUT_STEP_BLOCK_PAYMENT);
	$steps[] = array('page' => FILENAME_CHECKOUT_CONFIRMATION, 'text' => MODULE_CHECKOUT_STEP_BLOCK_CONFIRMATION);
	$steps[] = array('page' => FILENAME_CHECKOUT_SUCCESS, 'text' => MODULE_CHECKOUT_STEP_BLOCK_SUCCESS);
      $steps = $this->_searchCurrent($steps, $page);
      return $steps;
    }

    function _searchCurrent($steps, $page) {
      foreach($steps as $key => $val) {
	if ($page == $val['page'] || $page == FILENAME_CREATE_ACCOUNT || $page == FILENAME_CREATE_ACCOUNT_SUCCESS) {
	  $steps[$key]['current'] = 'current';
	  break;
	}
      }
      return $steps;
    }

  }
?>
