<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_viewed_products.php 3001 2007-11-27 00:00:00Z yokoyama $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $filename = basename($_SERVER['SCRIPT_NAME']);
  $sql = "select type_handler from " . TABLE_PRODUCT_TYPES;
  $products_types = $db->Execute($sql);
  $delete_product = FALSE;
  while (!$products_types->EOF) {
    if ($products_types->fields['type_handler'] . '.php' == $filename) {
      $delete_product = TRUE;
      break;
    }
    $products_types->MoveNext();
  }

  if ($delete_product && $_GET['action'] == 'delete_product_confirm' && $_POST['products_id'] > 0) {
    $products_id = zen_db_prepare_input($_POST['products_id']);
    $query = 'delete from '. TABLE_CUSTOMERS_VIEWED_PRODUCTS . ' where products_id="' . $products_id .'"';
    $db->Execute($query);
  } else if ($filename == FILENAME_CATEGORIES . '.php' && $_GET['action'] == 'delete_category_confirm' && $_POST['categories_id'] > 0) {
    $categories_id = zen_db_prepare_input($_POST['categories_id']);
    $categories = zen_get_category_tree($categories_id, '', '0', '', true);
    zen_set_time_limit(600);
    for ($i = 0, $n = sizeof($categories); $i < $n; $i ++) {
      $sql = "select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id='" . $categories[$i]['id'] . "'";
      $category_products = $db->Execute($sql);
      while (!$category_products->EOF) {
        $query = 'delete from '.TABLE_CUSTOMERS_VIEWED_PRODUCTS . ' where products_id="' . $category_products->fields['products_id'] .'"';
        $db->Execute($query);
        $category_products->MoveNext();
      }
    }
  } else if ($filename == FILENAME_CUSTOMERS . '.php' && $_GET['action'] == 'deleteconfirm' && $_GET['cID'] > 0) {
    $customers_id = zen_db_prepare_input($_GET['cID']);
    $query = 'delete from '. TABLE_CUSTOMERS_VIEWED_PRODUCTS . ' where customers_id="' . (int)$customers_id .'"';
    $db->Execute($query);
  }
}
