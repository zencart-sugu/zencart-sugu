<?php
/**
 * viewed_products.php
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: viewed_products.php 3012 2007-11-16 16:34:02Z sasaki $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class viewedProducts extends base {

  /**
   * viewed products
   * @var array
   */
  var $products =array();

  /**
   * store db
   * @var bool
   */
  var $store_db = false;

  /**
   * constructor method
   *
   * Simply resets the viewed products.
   * @return void
   */
  function viewedProducts() {
    $this->notify('NOTIFIER_VIEWED_INSTANTIATE_START');

    $this->cleanup();

    $this->notify('NOTIFIER_VIEWED_INSTANTIATE_END');

  }

  function setStoreDB() {
    if (isset($_SESSION['customer_id'])) {
      $this->store_db = true;
    }

  }

  function unsetStoreDB() {
    $this->store_db = false;

  }

 /**
   * Method to reset viewed products
   *
   * resets the products of the session viewed(e,g, empties it)
   * Depending on the setting of the $reset_database parameter will
   * also empty the products of the database stored viewed. (Only relevant
   * if the customer is logged in)
   *
   * @param boolean whether to reset customers db viewed products
   * @return void
   * @global object access to the db object
   */
  function reset($reset_database = false) {
    global $db;

    $this->notify('NOTIFIER_VIEWED_RESET_START');
    $this->products = array();

    if (isset($_SESSION['customer_id']) && ($reset_database == true)) {
      $this->resetDB();
    }

    $this->notify('NOTIFIER_VIEWED_RESET_END');

  }

  function resetDB () {
    global $db;

    $delete_viewed_products_query = "
      DELETE FROM " . TABLE_CUSTOMERS_VIEWED_PRODUCTS . "
      WHERE customers_id = :customersID;";
    $delete_viewed_products_query  = $db->bindVars($delete_viewed_products_query, ':customersID', $_SESSION['customer_id'], 'integer');
    $db->Execute($delete_viewed_products_query);

  }

  /**
   * Method to restore viewed products
   *
   * For customers who login, viewed products are also stored in the database.
   * {TABLE_CUSTOMERS_VIEWED_PRODUCTS et al}. This allows the system to remember the
   * products of their viewed over multiple sessions.
   * This method simply retrieve the content of the databse store viewed
   * for a given customer. Note also that if the customer already has
   * some items in their viewed before thet login, these are merged with
   * the stored products.
   *
   * @return void
   * @global object access to the db object
   */
  function restoreProducts() {
    global $db;

    if (!$_SESSION['customer_id'] || !$this->store_db) return false;
    $this->notify('NOTIFIER_VIEWED_RESTORE_PRODUCTS_START');

    $tmp_products = $this->getDB();

    if (count($this->products) > 0) {
      foreach ($this->products as $key => $value) {
        $tmp_products[$key] = $value;
      }
    }

    $this->products = $tmp_products;

    $this->notify('NOTIFIER_VIEWED_RESTORE_PRODUCTS_END');
    $this->cleanup();

  }

  function storeProducts() {
    global $db;

    if (count($this->products) > 0) {
      foreach ($this->products as $key => $value) {
        $insert_viewed_products_query = "
          INSERT INTO " . TABLE_CUSTOMERS_VIEWED_PRODUCTS . "
          (customers_id, products_id, date_added)
          VALUES
          (:customersID, :productsID, :dateAdded);";
        $insert_viewed_products_query  = $db->bindVars($insert_viewed_products_query, ':customersID', $_SESSION['customer_id'], 'integer');
        $insert_viewed_products_query  = $db->bindVars($insert_viewed_products_query, ':productsID', $key, 'integer');
        $insert_viewed_products_query  = $db->bindVars($insert_viewed_products_query, ':dateAdded', $value, 'date');
        $db->Execute($insert_viewed_products_query);
      }
    }

  }

  function getDB() {
    global $db;

    $tmp_products = array();
    $viewed_products_query = "
      SELECT products_id, date_added
      FROM " . TABLE_CUSTOMERS_VIEWED_PRODUCTS . "
      WHERE customers_id = :customersID
      ORDER BY date_added DESC;";
    $viewed_products_query  = $db->bindVars($viewed_products_query, ':customersID', $_SESSION['customer_id'], 'integer');
    $viewed_products_result = $db->Execute($viewed_products_query);
    while (!$viewed_products_result->EOF) {
      $tmp_products[$viewed_products_result->fields['products_id']] = $viewed_products_result->fields['date_added'];

      $viewed_products_result->MoveNext();
    }

    return $tmp_products;

  }

  /**
   * Method to clean up viewed products
   *
   * @return void
   */
  function cleanup() {
    $tmp_products = array();
    if (count($this->products) > 0) {
      foreach ($this->products as $key => $value) {
        if($this->getProductsStatus($key) > 0) {
          $tmp_products[$key] = $value;
        }
      }
    }

    arsort($tmp_products);

    while (count($tmp_products) > (MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED + 1)) {
      array_pop($tmp_products);
    }

    $this->products = $tmp_products;

    if ($this->store_db) {
      $this->resetDB();
      $this->storeProducts();
    }

  }

  function addProduct($products_id) {
    $this->products[(int)$products_id] = $this->getAddDate();
    $this->cleanup();

  }

  function getAddDate($timestamp = null) {
    if (is_null($timestamp)) $timestamp = time();
    return date('Y-m-d H:i:s', $timestamp);

  }

  function removeProduct($products_id) {
    unset($this->products[(int)$products_id]);
    $this->cleanup();

  }

  function getProductsStatus($products_id) {
    global $db;

    $check_query = "
      SELECT products_status
      FROM " . TABLE_PRODUCTS . "
      WHERE products_id = :productsID
      ;";
    $check_query  = $db->bindVars($check_query, ':productsID', $products_id, 'integer');
    $check_result = $db->Execute($check_query);
    return $check_result->fields['products_status'];

  }

  function getProducts() {
    $this->cleanup();
    if (count($this->products) < 1) {
      return false;
    }

    $exclude_products_id = 0;
    if (isset($_GET['products_id']) && $_GET['products_id'] > 0) {
      $exclude_products_id = (int)$_GET['products_id'];
    }
    $products = array();
    foreach ($this->products as $products_id => $add_date) {
      if ($products_id != $exclude_products_id) {
        $products[] = array(
          'id' => $products_id,
          'add_date' => $add_date,
          'name' => zen_get_products_name($products_id),
          'display_price' => zen_get_products_display_price($products_id),
          'image' => DIR_WS_IMAGES . zen_products_lookup($products_id, 'products_image'),
          'url' => zen_href_link(zen_get_info_page($products_id), 'products_id=' . $products_id));
      }

      if (count($products) >= MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED) {
        break;
      }
    }
    return $products;
  }

}
