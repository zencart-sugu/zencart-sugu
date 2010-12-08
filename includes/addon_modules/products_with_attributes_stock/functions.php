<?php
/**
 * CALENDAR modules functions.php
 *
 * @package functions
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

  // テンプレート一覧を取得する
  function xxxgetTemplates($template="") {
  }

function pwas_check_stock($products_id, $products_quantity, $attributes = '') {
  $stock_left = pwas_get_products_stock($products_id, $attributes) - $products_quantity;
  $out_of_stock = '';
  
  if ($stock_left < 0 && !is_array($attributes)) {
    $out_of_stock = '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
  }
  elseif ($stock_left < 0 && is_array($attributes)) {
    $out_of_stock = '<span class="markProductOutOfStock">' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '</span>';
  }
  
  return $out_of_stock;
}

function pwas_get_products_stock($products_id, $attributes = '') {
  global $db;

  $products_id = zen_get_prid($products_id);

  // get product level stock quantity
  $stock_query = "select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'"; 

  // check if there attributes for this product
  if(is_array($attributes) and sizeof($attributes) > 0){
    // check if any attribute stock values have been set for the product
    // (only of there is will we continue, otherwise we'll use product level data)
    $attribute_stock = $db->Execute("select stock_id from " . TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK . " where products_id = '" . (int)$products_id . "'");
    if ($attribute_stock->RecordCount() > 0) {

      // prepare to search for details for the particular attribute combination passed as a parameter
      if(sizeof($attributes) > 1){
        if (isset($attributes[0]['value_id'])) {
	  $ary = array();
	  for ($i=0; $i<count($attributes); $i++) {
	    $ary[] = $attributes[$i]['value_id'];
	  }
	}
	else {
	  $ary = $attributes;
	}
	$first_search = 'where options_values_id in ("'.implode('","',$ary).'")';
      } else {
	if (isset($attributes[0]['value_id'])) {
	  $first_search = 'where options_values_id="'.$attributes[0]['value_id'].'"';
	}
	else {
	  foreach ($attributes as $attribute) {
	    $first_search = 'where options_values_id="'.$attribute.'"';
	  }
	}
      }

      // obtain the attribute ids
      $query = 'select products_attributes_id from '.TABLE_PRODUCTS_ATTRIBUTES.' '.$first_search.' and products_id="'.$products_id.'" order by products_attributes_id';
      $attributes_new = $db->Execute($query);

      while(!$attributes_new->EOF){
	$stock_attributes[] = $attributes_new->fields['products_attributes_id'];	
	$attributes_new->MoveNext();
      }
      if(sizeof($stock_attributes) > 1){
	$stock_attributes = implode(',',$stock_attributes);
      } else {
	$stock_attributes = $stock_attributes[0];
      }

      // create the query to find attribute stock 	
      $stock_query = 'select quantity as products_quantity from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id = "'.(int)$products_id.'" and stock_attributes="'.$stock_attributes.'"';

    }

  }

  // get the stock value for the product or attribute combination
  $stock_values = $db->Execute($stock_query);
  return $stock_values->fields['products_quantity'];
}

function pwas_notify_start_checkout_shipping() {
  global $messageStack;

  // if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() <= 0) {
    zen_redirect(zen_href_link(FILENAME_TIME_OUT));
  }

  // if the customer is not logged on, redirect them to the login page
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  } else {
    // validate customer
    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {
      $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_SHIPPING));
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }

  // Validate Cart for checkout
  $_SESSION['valid_to_checkout'] = true;
  $_SESSION['cart']->get_products(true);
  if ($_SESSION['valid_to_checkout'] == false) {
    $messageStack->add('header', ERROR_CART_UPDATE, 'error');
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
  }

  // Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $_SESSION['cart']->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (zen_addOnModules_call_function('advanced_stock', 'advanced_stock_get_sendfor_status', array($products[$i]['id'])) != '') {
        continue;
      }

      // Added to allow individual stock of different attributes
      unset($attributes);
      if(is_array($products[$i]['attributes'])){
        $attributes = $products[$i]['attributes'];
      } else {
        $attributes = '';
      }
      // End change

      $stock_check = pwas_check_stock($products[$i]['id'], $products[$i]['quantity'], $attributes);
      if (zen_not_null($stock_check)) {
        zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }
}

function pwas_notify_start_checkout_payment() {
  global $messageStack;

  // if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() <= 0) {
    zen_redirect(zen_href_link(FILENAME_TIME_OUT));
  }

  // if the customer is not logged on, redirect them to the login page
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  } else {
    // validate customer
    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {
      $_SESSION['navigation']->set_snapshot();
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }

  // if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!$_SESSION['shipping']) {
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  // avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($_SESSION['cart']->cartID) && $_SESSION['cartID']) {
    if ($_SESSION['cart']->cartID != $_SESSION['cartID']) {
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

  // Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
    $products = $_SESSION['cart']->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (zen_addOnModules_call_function('advanced_stock', 'advanced_stock_get_sendfor_status', array($products[$i]['id'])) != '') {
        continue;
      }

      // Added to allow individual stock of different attributes
      unset($attributes);
      if(is_array($products[$i]['attributes'])){
        $attributes = $products[$i]['attributes'];
      } else {
        $attributes = '';
      }
      // End change

      $stock_check = pwas_check_stock($products[$i]['id'], $products[$i]['quantity'], $attributes);
      if (zen_not_null($stock_check)) {
        zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
        break;
      }
    }
  }
}

function pwas_notify_checkout_start_confirmation() {
  global $messageStack;
  global $credit_covers;

  // if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($_SESSION['cart']->count_contents() <= 0) {
    zen_redirect(zen_href_link(FILENAME_TIME_OUT));
  }

  // if the customer is not logged on, redirect them to the login page
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  } else {
    // validate customer
    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {
      $_SESSION['navigation']->set_snapshot();
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }

  // avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($_SESSION['cart']->cartID) && $_SESSION['cartID']) {
    if ($_SESSION['cart']->cartID != $_SESSION['cartID']) {
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

  // if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!$_SESSION['shipping']) {
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (isset($_POST['payment'])) $_SESSION['payment'] = $_POST['payment'];
  $_SESSION['comments'] = zen_db_prepare_input($_POST['comments']);

  //'checkout_payment_discounts'
  //zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));


  if (DISPLAY_CONDITIONS_ON_CHECKOUT == 'true') {
    if (!isset($_POST['conditions']) || ($_POST['conditions'] != '1')) {
      $messageStack->add_session('checkout_payment', ERROR_CONDITIONS_NOT_ACCEPTED, 'error');
    }
  }
  //echo $messageStack->size('checkout_payment');

  require(DIR_FS_CATALOG_ADDON_MODULES . 'products_with_attributes_stock/classes/order.php');
  $order = new pwas_order;

  // Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (zen_addOnModules_call_function('advanced_stock', 'advanced_stock_get_sendfor_status', array($products[$i]['id'])) != '') {
        continue;
      }

      $order->products[$i]['stock_check'] = '';
      // Added to allow individual stock of different attributes
      unset($attributes);
      if(is_array($order->products[$i]['attributes'])){
        $attributes = $order->products[$i]['attributes'];
      } else {
	$attributes = '';
      }
      // End change
      $stock_check = pwas_check_stock($order->products[$i]['id'], $order->products[$i]['qty'], $attributes);
      if (zen_not_null($stock_check)) {
	$any_out_of_stock = true;
	$order->products[$i]['stock_check'] = $stock_check;
      }
    }
  }
  // Out of Stock
  if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
    zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
  }
}

function pwas_switch_order_class() {
  require(DIR_FS_CATALOG_ADDON_MODULES . 'products_with_attributes_stock/classes/order.php');

  $pwas_order = new pwas_order;

  if (isset($GLOBALS['order']) && is_object($GLOBALS['order']) && isset($GLOBALS['order']->info['comments'])) {
    $pwas_order->info['comments'] = $GLOBALS['order']->info['comments'];
  }

  $GLOBALS['order'] = $pwas_order;
}
?>
