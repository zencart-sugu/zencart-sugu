<?php
/**
 * File contains just the shopping cart class
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: shopping_cart.php 3379 2006-04-06 00:54:13Z drbyte $
 */
/**
 * Class for managing the Shopping Cart
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
class shoppingCart extends base {
  /**
   * shopping cart contents
   * @var array
   */
  var $contents;
  /**
   * shopping cart total price
   * @var decimal
   */
  var $total;
  /**
   * shopping cart total weight
   * @var decimal
   */
  var $weight;
  /**
   * cart identifier
   * @var integer
   */
  var $cartID;
  /**
   * overall content type of shopping cart
   * @var string
   */
  var $content_type;
  /**
   * number of free shipping items in cart
   * @var decimal
   */
  var $free_shipping_item;
  /**
   * total price of free shipping items in cart
   * @var decimal
   */
  var $free_shipping_weight;
  /**
   * total weight of free shipping items in cart
   * @var decimal
   */
  var $free_shipping_price;
  /**
   * constructor method
   *
   * Simply resets the users cart.
   * @return void
   */
  function shoppingCart() {
    $this->notify('NOTIFIER_CART_INSTANTIATE_START');
    $this->reset();
    $this->notify('NOTIFIER_CART_INSTANTIATE_END');
  }
  /**
   * Method to restore cart contents
   *
   * For customers who login, cart contents are also stored in the database.
   * {TABLE_CUSTOMER_BASKET et al}. This allows the system to remember the
   * contents of their cart over multiple sessions.
   * This method simply retrieve the content of the databse store cart
   * for a given customer. Note also that if the customer already has
   * some items in their cart before thet login, these are merged with
   * the stored contents.
   *
   * @return void
   * @global object access to the db object
   */
  function restore_contents() {
    global $db;
    if (!$_SESSION['customer_id']) return false;
    $this->notify('NOTIFIER_CART_RESTORE_CONTENTS_START');
    // insert current cart contents in database
    if (is_array($this->contents)) {
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        //          $products_id = urldecode($products_id);
        $qty = $this->contents[$products_id]['qty'];
        $product_query = "select products_id
                            from " . TABLE_CUSTOMERS_BASKET . "
                            where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                            and products_id = '" . zen_db_input($products_id) . "'";

        $product = $db->Execute($product_query);

        if ($product->RecordCount()<=0) {
          $sql = "insert into " . TABLE_CUSTOMERS_BASKET . "
                                (customers_id, products_id, customers_basket_quantity,
                                 customers_basket_date_added)
                                 values ('" . (int)$_SESSION['customer_id'] . "', '" . zen_db_input($products_id) . "', '" .
          $qty . "', '" . date('Ymd') . "')";

          $db->Execute($sql);

          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {

              //clr 031714 udate query to include attribute value. This is needed for text attributes.
              $attr_value = $this->contents[$products_id]['attributes_values'][$option];
              //                zen_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id, products_options_value_text) values ('" . (int)$customer_id . "', '" . zen_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "', '" . zen_db_input($attr_value) . "')");
              $products_options_sort_order= zen_get_attributes_options_sort_order(zen_get_prid($products_id), $option, $value);
              if ($attr_value) {
                $attr_value = zen_db_input($attr_value);
              }
              $sql = "insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                                    (customers_id, products_id, products_options_id,
                                     products_options_value_id, products_options_value_text, products_options_sort_order)
                                     values ('" . (int)$_SESSION['customer_id'] . "', '" . zen_db_input($products_id) . "', '" .
              $option . "', '" . $value . "', '" . $attr_value . "', '" . $products_options_sort_order . "')";

              $db->Execute($sql);
            }
          }
        } else {
          $sql = "update " . TABLE_CUSTOMERS_BASKET . "
                    set customers_basket_quantity = '" . $qty . "'
                    where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                    and products_id = '" . zen_db_input($products_id) . "'";

          $db->Execute($sql);

        }
      }
    }

    // reset per-session cart contents, but not the database contents
    $this->reset(false);

    $products_query = "select products_id, customers_basket_quantity
                         from " . TABLE_CUSTOMERS_BASKET . "
                         where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

    $products = $db->Execute($products_query);

    while (!$products->EOF) {
      $this->contents[$products->fields['products_id']] = array('qty' => $products->fields['customers_basket_quantity']);
      // attributes
      // set contents in sort order

      //CLR 020606 update query to pull attribute value_text. This is needed for text attributes.
      //        $attributes_query = zen_db_query("select products_options_id, products_options_value_id, products_options_value_text from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . zen_db_input($products['products_id']) . "'");

      $order_by = ' order by LPAD(products_options_sort_order,11,"0")';

      $attributes = $db->Execute("select products_options_id, products_options_value_id, products_options_value_text
                             from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                             where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                             and products_id = '" . zen_db_input($products->fields['products_id']) . "' " . $order_by);

      while (!$attributes->EOF) {
        $this->contents[$products->fields['products_id']]['attributes'][$attributes->fields['products_options_id']] = $attributes->fields['products_options_value_id'];
        //CLR 020606 if text attribute, then set additional information
        if ($attributes->fields['products_options_value_id'] == PRODUCTS_OPTIONS_VALUES_TEXT_ID) {
          $this->contents[$products->fields['products_id']]['attributes_values'][$attributes->fields['products_options_id']] = $attributes->fields['products_options_value_text'];
        }
        $attributes->MoveNext();
      }
      $products->MoveNext();
    }
    $this->notify('NOTIFIER_CART_RESTORE_CONTENTS_END');
    $this->cleanup();
  }
  /**
   * Method to reset cart contents
   *
   * resets the contents of the session cart(e,g, empties it)
   * Depending on the setting of the $reset_database parameter will
   * also empty the contents of the database stored cart. (Only relevant
   * if the customer is logged in)
   *
   * @param boolean whether to reset customers db basket
   * @return void
   * @global object access to the db object
   */
  function reset($reset_database = false) {
    global $db;
    $this->notify('NOTIFIER_CART_RESET_START');
    $this->contents = array();
    $this->total = 0;
    $this->weight = 0;
    $this->content_type = false;

    // shipping adjustment
    $this->free_shipping_item = 0;
    $this->free_shipping_price = 0;
    $this->free_shipping_weight = 0;

    if (isset($_SESSION['customer_id']) && ($reset_database == true)) {
      $sql = "delete from " . TABLE_CUSTOMERS_BASKET . "
                where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

      $db->Execute($sql);

      $sql = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

      $db->Execute($sql);
    }

    unset($this->cartID);
    $_SESSION['cartID'] = '';
    $this->notify('NOTIFIER_CART_RESET_END');
  }
  /**
   * Method to add an item to the cart
   *
   * This method is usually called as the result of a user action.
   * As the method name applies it adds an item to the uses current cart
   * and if the customer is logged in, also adds to the database sored
   * cart.
   *
   * @param integer the product ID of the item to be added
   * @param decimal the quantity of the item to be added
   * @param array any attributes that are attache to the product
   * @param boolean whether to add the product to the notify list
   * @return void
   * @global object access to the db object
   * @todo ICW - documentation stub
   */
  function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {
    global $db;
    $this->notify('NOTIFIER_CART_ADD_CART_START');
    $products_id = zen_get_uprid($products_id, $attributes);
    if ($notify == true) {
      $_SESSION['new_products_id_in_cart'] = $products_id;
    }

    if ($this->in_cart($products_id)) {
      $this->update_quantity($products_id, $qty, $attributes);
    } else {
      $this->contents[] = array($products_id);
      $this->contents[$products_id] = array('qty' => $qty);
      // insert into database
      if (isset($_SESSION['customer_id'])) {
        $sql = "insert into " . TABLE_CUSTOMERS_BASKET . "
                              (customers_id, products_id, customers_basket_quantity,
                              customers_basket_date_added)
                              values ('" . (int)$_SESSION['customer_id'] . "', '" . zen_db_input($products_id) . "', '" .
        $qty . "', '" . date('Ymd') . "')";

        $db->Execute($sql);
      }

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          //CLR 020606 check if input was from text box.  If so, store additional attribute information
          //CLR 020708 check if text input is blank, if so do not add to attribute lists
          //CLR 030228 add htmlspecialchars processing.  This handles quotes and other special chars in the user input.
          $attr_value = NULL;
          $blank_value = FALSE;
          if (strstr($option, TEXT_PREFIX)) {
            if (trim($value) == NULL) {
              $blank_value = TRUE;
            } else {
              $option = substr($option, strlen(TEXT_PREFIX));
              $attr_value = stripslashes($value);
              $value = PRODUCTS_OPTIONS_VALUES_TEXT_ID;
              $this->contents[$products_id]['attributes_values'][$option] = $attr_value;
            }
          }

          if (!$blank_value) {
            if (is_array($value) ) {
              reset($value);
              while (list($opt, $val) = each($value)) {
                $this->contents[$products_id]['attributes'][$option.'_chk'.$val] = $val;
              }
            } else {
              $this->contents[$products_id]['attributes'][$option] = $value;
            }
            // insert into database
            //CLR 020606 update db insert to include attribute value_text. This is needed for text attributes.
            //CLR 030228 add zen_db_input() processing
            if (isset($_SESSION['customer_id'])) {

              //              if (zen_session_is_registered('customer_id')) zen_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id, products_options_value_text) values ('" . (int)$customer_id . "', '" . zen_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "', '" . zen_db_input($attr_value) . "')");
              if (is_array($value) ) {
                reset($value);
                while (list($opt, $val) = each($value)) {
                  $products_options_sort_order= zen_get_attributes_options_sort_order(zen_get_prid($products_id), $option, $opt);
                  $sql = "insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                                        (customers_id, products_id, products_options_id, products_options_value_id, products_options_sort_order)
                                        values ('" . (int)$_SESSION['customer_id'] . "', '" . zen_db_input($products_id) . "', '" .
                                        (int)$option.'_chk'.$val . "', '" . $val . "',  '" . $products_options_sort_order . "')";

                                        $db->Execute($sql);
                }
              } else {
                if ($attr_value) {
                  $attr_value = zen_db_input($attr_value);
                }
                $products_options_sort_order= zen_get_attributes_options_sort_order(zen_get_prid($products_id), $option, $value);
                $sql = "insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                                      (customers_id, products_id, products_options_id, products_options_value_id, products_options_value_text, products_options_sort_order)
                                      values ('" . (int)$_SESSION['customer_id'] . "', '" . zen_db_input($products_id) . "', '" .
                                      (int)$option . "', '" . $value . "', '" . $attr_value . "', '" . $products_options_sort_order . "')";

                                      $db->Execute($sql);
              }
            }
          }
        }
      }
    }
    $this->cleanup();

    // assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
    $this->cartID = $this->generate_cart_id();
    $this->notify('NOTIFIER_CART_ADD_CART_END');
  }
  /**
   * Method to update a cart items quantity
   *
   * Changes the current quamtity of a certain item in the cart to
   * a new value. Also updates the database sored cart if customer is
   * logged in.
   *
   * @param mixed product ID of item to update
   * @param decimal the quantity to update the item to
   * @param array product atributes attached to the item
   * @return void
   * @global object access to the db object
   */
  function update_quantity($products_id, $quantity = '', $attributes = '') {
    global $db;
    $this->notify('NOTIFIER_CART_UPDATE_QUANTITY_START');
    if (empty($quantity)) return true; // nothing needs to be updated if theres no quantity, so we return true..

    $this->contents[$products_id] = array('qty' => $quantity);
    // update database
    if (isset($_SESSION['customer_id'])) {
      $sql = "update " . TABLE_CUSTOMERS_BASKET . "
                set customers_basket_quantity = '" . (float)$quantity . "'
                where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                and products_id = '" . zen_db_input($products_id) . "'";

      $db->Execute($sql);

    }

    if (is_array($attributes)) {
      reset($attributes);
      while (list($option, $value) = each($attributes)) {
        //CLR 020606 check if input was from text box.  If so, store additional attribute information
        //CLR 030108 check if text input is blank, if so do not update attribute lists
        //CLR 030228 add htmlspecialchars processing.  This handles quotes and other special chars in the user input.
        $attr_value = NULL;
        $blank_value = FALSE;
        if (strstr($option, TEXT_PREFIX)) {
          if (trim($value) == NULL) {
            $blank_value = TRUE;
          } else {
            $option = substr($option, strlen(TEXT_PREFIX));
            $attr_value = stripslashes($value);
            $value = PRODUCTS_OPTIONS_VALUES_TEXT_ID;
            $this->contents[$products_id]['attributes_values'][$option] = $attr_value;
          }
        }

        if (!$blank_value) {
          if (is_array($value) ) {
            reset($value);
            while (list($opt, $val) = each($value)) {
              $this->contents[$products_id]['attributes'][$option.'_chk'.$val] = $val;
            }
          } else {
            $this->contents[$products_id]['attributes'][$option] = $value;
          }
          // update database
          //CLR 020606 update db insert to include attribute value_text. This is needed for text attributes.
          //CLR 030228 add zen_db_input() processing
          //          if (zen_session_is_registered('customer_id')) zen_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "', products_options_value_text = '" . zen_db_input($attr_value) . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . zen_db_input($products_id) . "' and products_options_id = '" . (int)$option . "'");

          if ($attr_value) {
            $attr_value = zen_db_input($attr_value);
          }
          if (is_array($value) ) {
            reset($value);
            while (list($opt, $val) = each($value)) {
              $products_options_sort_order= zen_get_attributes_options_sort_order(zen_get_prid($products_id), $option, $opt);
              $sql = "update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                        set products_options_value_id = '" . $val . "'
                        where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                        and products_id = '" . zen_db_input($products_id) . "'
                        and products_options_id = '" . (int)$option.'_chk'.$val . "'";

              $db->Execute($sql);
            }
          } else {
            if (isset($_SESSION['customer_id'])) {
              $sql = "update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                        set products_options_value_id = '" . $value . "', products_options_value_text = '" . $attr_value . "'
                        where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                        and products_id = '" . zen_db_input($products_id) . "'
                        and products_options_id = '" . (int)$option . "'";

              $db->Execute($sql);
            }
          }
        }
      }
    }
    $this->notify('NOTIFIER_CART_UPDATE_QUANTITY_END');
  }
  /**
   * Method to clean up carts contents
   *
   * For various reasons, the quantity of an item in the cart can
   * fall to zero. This method removes from the cart
   * all items that have reached this state. The database-stored cart
   * is also updated where necessary
   *
   * @return void
   * @global object access to the db object
   */
  function cleanup() {
    global $db;
    $this->notify('NOTIFIER_CART_CLEANUP_START');
    reset($this->contents);
    while (list($key,) = each($this->contents)) {
      if (!isset($this->contents[$key]['qty']) || $this->contents[$key]['qty'] <= 0) {
        unset($this->contents[$key]);
        // remove from database
        if (isset($_SESSION['customer_id'])) {
          $sql = "delete from " . TABLE_CUSTOMERS_BASKET . "
                    where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                    and products_id = '" . $key . "'";

          $db->Execute($sql);

          $sql = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                    where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                    and products_id = '" . $key . "'";

          $db->Execute($sql);
        }
      }
    }
    $this->notify('NOTIFIER_CART_CLEANUP_END');
  }
  /**
   * Method to count total number of items in cart
   *
   * Note this is not just the number of distinct items in the cart,
   * but the number of items adjusted for the quantity of each item
   * in the cart, So we have had 2 items in the cart, one with a quantity
   * of 3 and the other with a quantity of 4 our total number of items
   * would be 7
   *
   * @return total number of items in cart
   */
  function count_contents() {
    $this->notify('NOTIFIER_CART_COUNT_CONTENTS_START');
    $total_items = 0;
    if (is_array($this->contents)) {
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $total_items += $this->get_quantity($products_id);
      }
    }
    $this->notify('NOTIFIER_CART_COUNT_CONTENTS_END');
    return $total_items;
  }
  /**
   * Method to get the quantity of an item in the cart
   *
   * @param mixed product ID of item to check
   * @return decimal the quantity of the item
   */
  function get_quantity($products_id) {
    $this->notify('NOTIFIER_CART_GET_QUANTITY_START');
    if (isset($this->contents[$products_id])) {
    $this->notify('NOTIFIER_CART_GET_QUANTITY_END_QTY');
      return $this->contents[$products_id]['qty'];
    } else {
    $this->notify('NOTIFIER_CART_GET_QUANTITY_END_FALSE');
      return 0;
    }
  }
  /**
   * Method to check wheter a product exists in the cart
   *
   * @param mixed product ID of item to check
   * @return boolean
   */
  function in_cart($products_id) {
    //  die($products_id);
    $this->notify('NOTIFIER_CART_IN_CART_START');
    if (isset($this->contents[$products_id])) {
    $this->notify('NOTIFIER_CART_IN_CART_END_TRUE');
      return true;
    } else {
    $this->notify('NOTIFIER_CART_IN_CART_END_FALSE');
      return false;
    }
  }
  /**
   * Method to remove an item from the cart
   *
   * @param mixed product ID of item to remove
   * @return void
   * @global object access to the db object
   */
  function remove($products_id) {
    global $db;
    $this->notify('NOTIFIER_CART_REMOVE_START');
    //die($products_id);
    //CLR 030228 add call zen_get_uprid to correctly format product ids containing quotes
    //      $products_id = zen_get_uprid($products_id, $attributes);
    unset($this->contents[$products_id]);
    // remove from database
    if ($_SESSION['customer_id']) {

      //        zen_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . zen_db_input($products_id) . "'");

      $sql = "delete from " . TABLE_CUSTOMERS_BASKET . "
                where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                and products_id = '" . zen_db_input($products_id) . "'";

      $db->Execute($sql);

      //        zen_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . zen_db_input($products_id) . "'");

      $sql = "delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . "
                where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                and products_id = '" . zen_db_input($products_id) . "'";

      $db->Execute($sql);

    }

    // assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
    $this->cartID = $this->generate_cart_id();
    $this->notify('NOTIFIER_CART_REMOVE_END');
  }
  /**
   * Method remove all products from the cart
   *
   * @return void
   */
  function remove_all() {
    $this->notify('NOTIFIER_CART_REMOVE_ALL_START');
    $this->reset();
    $this->notify('NOTIFIER_CART_REMOVE_ALL_END');
  }
  /**
   * Method return a comma separated list of all products in the cart
   *
   * @return string
   * @todo ICW - is this actually used anywhere?
   */
  function get_product_id_list() {
    $product_id_list = '';
    if (is_array($this->contents)) {
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $product_id_list .= ', ' . zen_db_input($products_id);
      }
    }
    return substr($product_id_list, 2);
  }
  /**
   * Method to calculate cart totals(price and weight)
   *
   * @return void
   * @global object access to the db object
   */
  function calculate() {
    global $db;
    $this->total = 0;
    $this->weight = 0;

    // shipping adjustment
    $this->free_shipping_item = 0;
    $this->free_shipping_price = 0;
    $this->free_shipping_weight = 0;

    if (!is_array($this->contents)) return 0;

    reset($this->contents);
    while (list($products_id, ) = each($this->contents)) {
      $qty = $this->contents[$products_id]['qty'];

      // products price
      $product_query = "select products_id, products_price, products_tax_class_id, products_weight,
                          products_priced_by_attribute, product_is_always_free_shipping, products_discount_type, products_discount_type_from,
                          products_virtual, products_model
                          from " . TABLE_PRODUCTS . "
                          where products_id = '" . (int)$products_id . "'";

      if ($product = $db->Execute($product_query)) {
        $prid = $product->fields['products_id'];
        $products_tax = zen_get_tax_rate($product->fields['products_tax_class_id']);
        $products_price = $product->fields['products_price'];

        // adjusted count for free shipping
        if ($product->fields['product_is_always_free_shipping'] != 1 and $product->fields['products_virtual'] != 1) {
          $products_weight = $product->fields['products_weight'];
        } else {
          $products_weight = 0;
        }

        $special_price = zen_get_products_special_price($prid);
        if ($special_price and $product->fields['products_priced_by_attribute'] == 0) {
          $products_price = $special_price;
        } else {
          $special_price = 0;
        }

        if (zen_get_products_price_is_free($product->fields['products_id'])) {
          // no charge
          $products_price = 0;
        }

        // adjust price for discounts when priced by attribute
        if ($product->fields['products_priced_by_attribute'] == '1' and zen_has_product_attributes($product->fields['products_id'], 'false')) {
          // reset for priced by attributes
          //            $products_price = $products->fields['products_price'];
          if ($special_price) {
            $products_price = $special_price;
          } else {
            $products_price = $product->fields['products_price'];
          }
        } else {
          // discount qty pricing
          if ($product->fields['products_discount_type'] != '0') {
            $products_price = zen_get_products_discount_price_qty($product->fields['products_id'], $qty);
          }
        }

        // shipping adjustments
        if (($product->fields['product_is_always_free_shipping'] == 1) or ($product->fields['products_virtual'] == 1) or (ereg('^GIFT', addslashes($product->fields['products_model'])))) {
          $this->free_shipping_item += $qty;
          $this->free_shipping_price += zen_add_tax($products_price, $products_tax) * $qty;
          $this->free_shipping_weight += ($qty * $products_weight);
        }

        $this->total += zen_add_tax($products_price, $products_tax) * $qty;
        $this->weight += ($qty * $products_weight);
      }

      // attributes price
      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          /*
          products_attributes_id, options_values_price, price_prefix,
          attributes_display_only, product_attribute_is_free,
          attributes_discounted
          */

          $attribute_price_query = "select *
                                      from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                      where products_id = '" . (int)$prid . "'
                                      and options_id = '" . (int)$option . "'
                                      and options_values_id = '" . (int)$value . "'";

          $attribute_price = $db->Execute($attribute_price_query);

          $new_attributes_price = 0;
          $discount_type_id = '';
          $sale_maker_discount = '';

          // bottom total
          //            if ($attribute_price->fields['product_attribute_is_free']) {
          if ($attribute_price->fields['product_attribute_is_free'] == '1' and zen_get_products_price_is_free((int)$prid)) {
            // no charge for attribute
          } else {
            // + or blank adds
            if ($attribute_price->fields['price_prefix'] == '-') {
              if ($attribute_price->fields['attributes_discounted'] == '1') {
                // calculate proper discount for attributes
                $new_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                $this->total -= $qty * zen_add_tax( ($new_attributes_price), $products_tax);
// appears to confuse products priced by attributes
//                $this->free_shipping_price -= $qty * zen_add_tax( ($new_attributes_price), $products_tax);
              } else {
                $this->total -= $qty * zen_add_tax($attribute_price->fields['options_values_price'], $products_tax);
              }
            } else {
              if ($attribute_price->fields['attributes_discounted'] == '1') {
                // calculate proper discount for attributes
                $new_attributes_price = zen_get_discount_calc($product->fields['products_id'], $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
                $this->total += $qty * zen_add_tax( ($new_attributes_price), $products_tax);
// appears to confuse products priced by attributes
//                $this->free_shipping_price += $qty * zen_add_tax( ($new_attributes_price), $products_tax);
              } else {
                $this->total += $qty * zen_add_tax($attribute_price->fields['options_values_price'], $products_tax);
              }
            }

            ////////////////////////////////////////////////
            // calculate additional attribute charges
            $chk_price = zen_get_products_base_price($products_id);
            $chk_special = zen_get_products_special_price($products_id, false);
            // products_options_value_text
            if (zen_get_attributes_type($attribute_price->fields['products_attributes_id']) == PRODUCTS_OPTIONS_TYPE_TEXT) {
              $text_words = zen_get_word_count_price($this->contents[$products_id]['attributes_values'][$attribute_price->fields['options_id']], $attribute_price->fields['attributes_price_words_free'], $attribute_price->fields['attributes_price_words']);
              $text_letters = zen_get_letters_count_price($this->contents[$products_id]['attributes_values'][$attribute_price->fields['options_id']], $attribute_price->fields['attributes_price_letters_free'], $attribute_price->fields['attributes_price_letters']);

              $this->total += $qty * zen_add_tax($text_letters, $products_tax);
              $this->total += $qty * zen_add_tax($text_words, $products_tax);
            }

            // attributes_price_factor
            $added_charge = 0;
            if ($attribute_price->fields['attributes_price_factor'] > 0) {
              $added_charge = zen_get_attributes_price_factor($chk_price, $chk_special, $attribute_price->fields['attributes_price_factor'], $attribute_price->fields['attributes_price_factor_offset']);

              $this->total += $qty * zen_add_tax($added_charge, $products_tax);
            }
            // attributes_qty_prices
            $added_charge = 0;
            if ($attribute_price->fields['attributes_qty_prices'] != '') {
              $added_charge = zen_get_attributes_qty_prices_onetime($attribute_price->fields['attributes_qty_prices'], $qty);

              $this->total += $qty * zen_add_tax($added_charge, $products_tax);
            }

            //// one time charges
            // attributes_price_onetime
            $this->total += zen_add_tax($attribute_price->fields['attributes_price_onetime'], $products_tax);
	    if ( $this->total < 0 ) { $this->total = 0; }
            // attributes_price_factor_onetime
            $added_charge = 0;
            if ($attribute_price->fields['attributes_price_factor_onetime'] > 0) {
              $chk_price = zen_get_products_base_price($products_id);
              $chk_special = zen_get_products_special_price($products_id, false);
              $added_charge = zen_get_attributes_price_factor($chk_price, $chk_special, $attribute_price->fields['attributes_price_factor_onetime'], $attribute_price->fields['attributes_price_factor_onetime_offset']);

              $this->total += zen_add_tax($added_charge, $products_tax);
            }
            // attributes_qty_prices_onetime
            $added_charge = 0;
            if ($attribute_price->fields['attributes_qty_prices_onetime'] != '') {
              $chk_price = zen_get_products_base_price($products_id);
              $chk_special = zen_get_products_special_price($products_id, false);
              $added_charge = zen_get_attributes_qty_prices_onetime($attribute_price->fields['attributes_qty_prices_onetime'], $qty);
              $this->total += zen_add_tax($added_charge, $products_tax);
            }
            ////////////////////////////////////////////////
          }
        }
      } // attributes price

      // attributes weight
      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          $attribute_weight_query = "select products_attributes_weight, products_attributes_weight_prefix
                                       from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                       where products_id = '" . (int)$prid . "'
                                       and options_id = '" . (int)$option . "'
                                       and options_values_id = '" . (int)$value . "'";

          $attribute_weight = $db->Execute($attribute_weight_query);

          // adjusted count for free shipping
          if ($product->fields['product_is_always_free_shipping'] != 1) {
            $new_attributes_weight = $attribute_weight->fields['products_attributes_weight'];
          } else {
            $new_attributes_weight = 0;
          }

          // + or blank adds
          if ($attribute_weight->fields['products_attributes_weight_prefix'] == '-') {
            $this->weight -= $qty * $new_attributes_weight;
          } else {
            $this->weight += $qty * $new_attributes_weight;
          }
        }
      } // attributes weight

    }
  }
  /**
   * Method to calculate price of attributes for a given item
   *
   * @param mixed the product ID of the item to check
   * @return decimal the pice of the items attributes
   * @global object access to the db object
   */
  function attributes_price($products_id) {
    global $db;

    $attributes_price = 0;
    $qty = $this->contents[$products_id]['qty'];

    if (isset($this->contents[$products_id]['attributes'])) {

      reset($this->contents[$products_id]['attributes']);
      while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {

        $attribute_price_query = "select *
                                    from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                    where products_id = '" . (int)$products_id . "'
                                    and options_id = '" . (int)$option . "'
                                    and options_values_id = '" . (int)$value . "'";

        $attribute_price = $db->Execute($attribute_price_query);

        $new_attributes_price = 0;
        $discount_type_id = '';
        $sale_maker_discount = '';

        //          if ($attribute_price->fields['product_attribute_is_free']) {
        if ($attribute_price->fields['product_attribute_is_free'] == '1' and zen_get_products_price_is_free((int)$products_id)) {
          // no charge
        } else {
          // + or blank adds
          if ($attribute_price->fields['price_prefix'] == '-') {
            // calculate proper discount for attributes
            if ($attribute_price->fields['attributes_discounted'] == '1') {
              $discount_type_id = '';
              $sale_maker_discount = '';
              $new_attributes_price = zen_get_discount_calc($products_id, $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
              $attributes_price -= ($new_attributes_price);
            } else {
              $attributes_price -= $attribute_price->fields['options_values_price'];
            }
          } else {
            if ($attribute_price->fields['attributes_discounted'] == '1') {
              // calculate proper discount for attributes
              $discount_type_id = '';
              $sale_maker_discount = '';
              $new_attributes_price = zen_get_discount_calc($products_id, $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);
              $attributes_price += ($new_attributes_price);
            } else {
              $attributes_price += $attribute_price->fields['options_values_price'];
            }
          }

          //////////////////////////////////////////////////
          // calculate additional charges
          // products_options_value_text
          if (zen_get_attributes_type($attribute_price->fields['products_attributes_id']) == PRODUCTS_OPTIONS_TYPE_TEXT) {
            $text_words = zen_get_word_count_price($this->contents[$products_id]['attributes_values'][$attribute_price->fields['options_id']], $attribute_price->fields['attributes_price_words_free'], $attribute_price->fields['attributes_price_words']);
            $text_letters = zen_get_letters_count_price($this->contents[$products_id]['attributes_values'][$attribute_price->fields['options_id']], $attribute_price->fields['attributes_price_letters_free'], $attribute_price->fields['attributes_price_letters']);
            $attributes_price += $text_letters;
            $attributes_price += $text_words;
          }
          // attributes_price_factor
          $added_charge = 0;
          if ($attribute_price->fields['attributes_price_factor'] > 0) {
            $chk_price = zen_get_products_base_price($products_id);
            $chk_special = zen_get_products_special_price($products_id, false);
            $added_charge = zen_get_attributes_price_factor($chk_price, $chk_special, $attribute_price->fields['attributes_price_factor'], $attribute_price->fields['attributes_price_factor_offset']);
            $attributes_price += $added_charge;
          }
          // attributes_qty_prices
          $added_charge = 0;
          if ($attribute_price->fields['attributes_qty_prices'] != '') {
            $chk_price = zen_get_products_base_price($products_id);
            $chk_special = zen_get_products_special_price($products_id, false);
            $added_charge = zen_get_attributes_qty_prices_onetime($attribute_price->fields['attributes_qty_prices'], $this->contents[$products_id]['qty']);
            $attributes_price += $added_charge;
          }

          //////////////////////////////////////////////////
        }
        // Validate Attributes
        if ($attribute_price->fields['attributes_display_only']) {
          $_SESSION['valid_to_checkout'] = false;
          $_SESSION['cart_errors'] .= zen_get_products_name($attribute_price->fields['products_id'], $_SESSION['languages_id']) . ERROR_PRODUCT_OPTION_SELECTION . '<br />';
        }
        /*
        //// extra testing not required on text attribute this is done in application_top before it gets to the cart
        if ($attribute_price->fields['attributes_required']) {
        $_SESSION['valid_to_checkout'] = false;
        $_SESSION['cart_errors'] .= zen_get_products_name($attribute_price->fields['products_id'], $_SESSION['languages_id'])  . ERROR_PRODUCT_OPTION_SELECTION . '<br />';
        }
        */
      }
    }

    return $attributes_price;
  }
  /**
   * Method to calculate one time price of attributes for a given item
   *
   * @param mixed the product ID of the item to check
   * @param decimal item quantity
   * @return decimal the pice of the items attributes
   * @global object access to the db object
   */
  function attributes_price_onetime_charges($products_id, $qty) {
    global $db;

    $attributes_price_onetime = 0;

    if (isset($this->contents[$products_id]['attributes'])) {

      reset($this->contents[$products_id]['attributes']);
      while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {

        $attribute_price_query = "select *
                                    from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                    where products_id = '" . (int)$products_id . "'
                                    and options_id = '" . (int)$option . "'
                                    and options_values_id = '" . (int)$value . "'";

        $attribute_price = $db->Execute($attribute_price_query);

        $new_attributes_price = 0;
        $discount_type_id = '';
        $sale_maker_discount = '';

        //          if ($attribute_price->fields['product_attribute_is_free']) {
        if ($attribute_price->fields['product_attribute_is_free'] == '1' and zen_get_products_price_is_free((int)$products_id)) {
          // no charge
        } else {
          $discount_type_id = '';
          $sale_maker_discount = '';
          $new_attributes_price = zen_get_discount_calc($products_id, $attribute_price->fields['products_attributes_id'], $attribute_price->fields['options_values_price'], $qty);

          //////////////////////////////////////////////////
          // calculate additional one time charges
          //// one time charges
          // attributes_price_onetime
          if ((int)$products_id != $products_id) {
            die('I DO NOT MATCH ' . $products_id);
          }
          $attributes_price_onetime += $attribute_price->fields['attributes_price_onetime'];
          // attributes_price_factor_onetime
          $added_charge = 0;
          if ($attribute_price->fields['attributes_price_factor_onetime'] > 0) {
            $chk_price = zen_get_products_base_price($products_id);
            $chk_special = zen_get_products_special_price($products_id, false);
            $added_charge = zen_get_attributes_price_factor($chk_price, $chk_special, $attribute_price->fields['attributes_price_factor_onetime'], $attribute_price->fields['attributes_price_factor_onetime_offset']);

            $attributes_price_onetime += $added_charge;
          }
          // attributes_qty_prices_onetime
          $added_charge = 0;
          if ($attribute_price->fields['attributes_qty_prices_onetime'] != '') {
            $chk_price = zen_get_products_base_price($products_id);
            $chk_special = zen_get_products_special_price($products_id, false);
            $added_charge = zen_get_attributes_qty_prices_onetime($attribute_price->fields['attributes_qty_prices_onetime'], $qty);
            $attributes_price_onetime += $added_charge;
          }

          //////////////////////////////////////////////////
        }
      }
    }

    return $attributes_price_onetime;
  }
  /**
   * Method to calculate weight of attributes for a given item
   *
   * @param mixed the product ID of the item to check
   * @return decimal the weight of the items attributes
   */
  function attributes_weight($products_id) {
    global $db;

    $attribute_weight = 0;

    if (isset($this->contents[$products_id]['attributes'])) {
      reset($this->contents[$products_id]['attributes']);
      while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
        $attribute_weight_query = "select products_attributes_weight, products_attributes_weight_prefix
                                    from " . TABLE_PRODUCTS_ATTRIBUTES . "
                                    where products_id = '" . (int)$products_id . "'
                                    and options_id = '" . (int)$option . "'
                                    and options_values_id = '" . (int)$value . "'";

        $attribute_weight_info = $db->Execute($attribute_weight_query);

        // adjusted count for free shipping
        $product = $db->Execute("select products_id, product_is_always_free_shipping
                          from " . TABLE_PRODUCTS . "
                          where products_id = '" . (int)$products_id . "'");

        if ($product->fields['product_is_always_free_shipping'] != 1) {
          $new_attributes_weight = $attribute_weight_info->fields['products_attributes_weight'];
        } else {
          $new_attributes_weight = 0;
        }

        // + or blank adds
        if ($attribute_weight_info->fields['products_attributes_weight_prefix'] == '-') {
          $attribute_weight -= $new_attributes_weight;
        } else {
          $attribute_weight += $attribute_weight_info->fields['products_attributes_weight'];
        }
      }
    }

    return $attribute_weight;
  }
  /**
   * Method to return details of all products in the cart
   *
   * @param boolean whether to check if cart contents are valid
   * @return array
   */
  function get_products($check_for_valid_cart = false) {
    global $db;

    $this->notify('NOTIFIER_CART_GET_PRODUCTS_START');

    if (!is_array($this->contents)) return false;

    $products_array = array();
    reset($this->contents);
    while (list($products_id, ) = each($this->contents)) {
      $products_query = "select p.products_id, p.products_status, pd.products_name, p.products_model, p.products_image,
                                  p.products_price, p.products_weight, p.products_tax_class_id,
                                  p.products_quantity_order_min, p.products_quantity_order_units,
                                  p.product_is_free, p.products_priced_by_attribute,
                                  p.products_discount_type, p.products_discount_type_from
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = '" . (int)$products_id . "'
                           and pd.products_id = p.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

      if ($products = $db->Execute($products_query)) {

        $prid = $products->fields['products_id'];
        $products_price = $products->fields['products_price'];
        //fix here
        /*
        $special_price = zen_get_products_special_price($prid);
        if ($special_price) {
        $products_price = $special_price;
        }
        */
        $special_price = zen_get_products_special_price($prid);
        if ($special_price and $products->fields['products_priced_by_attribute'] == 0) {
          $products_price = $special_price;
        } else {
          $special_price = 0;
        }

        if (zen_get_products_price_is_free($products->fields['products_id'])) {
          // no charge
          $products_price = 0;
        }

        // adjust price for discounts when priced by attribute
        if ($products->fields['products_priced_by_attribute'] == '1' and zen_has_product_attributes($products->fields['products_id'], 'false')) {
          // reset for priced by attributes
          //            $products_price = $products->fields['products_price'];
          if ($special_price) {
            $products_price = $special_price;
          } else {
            $products_price = $products->fields['products_price'];
          }
        } else {
          // discount qty pricing
          if ($products->fields['products_discount_type'] != '0') {
            $products_price = zen_get_products_discount_price_qty($products->fields['products_id'], $this->contents[$products_id]['qty']);
          }
        }

// validate cart contents for checkout
        if ($check_for_valid_cart == true) {
          $fix_once = 0;

          // Check products_status if not already
          $check_status = $products->fields['products_status'];
          if ( $check_status == 0 ) {
            $fix_once ++;
            $_SESSION['valid_to_checkout'] = false;
            $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_STATUS_SHOPPING_CART . '<br />';
            $this->remove($products_id);
          }

          // check only if valid products_status
          if ($fix_once == 0) {
            $check_quantity = $this->contents[$products_id]['qty'];
            $check_quantity_min = $products->fields['products_quantity_order_min'];
            // Check quantity min
            if ($new_check_quantity = $this->in_cart_mixed($prid) ) {
              $check_quantity = $new_check_quantity;
            }
          }

          if ($fix_once == 0) {
            if ($check_quantity < $check_quantity_min) {
              $fix_once ++;
              $_SESSION['valid_to_checkout'] = false;
              $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART . ERROR_PRODUCT_QUANTITY_ORDERED . $check_quantity  . ' <span class="alertBlack">' . zen_get_products_quantity_min_units_display((int)$prid, false, true) . '</span> ' . '<br />';
            }
          }

          // Check Quantity Units if not already an error on Quantity Minimum
          if ($fix_once == 0) {
            $check_units = $products->fields['products_quantity_order_units'];
            if ( fmod_round($check_quantity,$check_units) != 0 ) {
              $_SESSION['valid_to_checkout'] = false;
              $_SESSION['cart_errors'] .= ERROR_PRODUCT . $products->fields['products_name'] . ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART . ERROR_PRODUCT_QUANTITY_ORDERED . $check_quantity  . ' <span class="alertBlack">' . zen_get_products_quantity_min_units_display((int)$prid, false, true) . '</span> ' . '<br />';
            }
          }

          // Verify Valid Attributes
        }

        //clr 030714 update $products_array to include attribute value_text. This is needed for text attributes.

        // convert quantity to proper decimals
        if (QUANTITY_DECIMALS != 0) {
          //          $new_qty = round($new_qty, QUANTITY_DECIMALS);

          $fix_qty = $this->contents[$products_id]['qty'];
          switch (true) {
            case (!strstr($fix_qty, '.')):
            $new_qty = $fix_qty;
            break;
            default:
            $new_qty = preg_replace('/[0]+$/','',$this->contents[$products_id]['qty']);
            break;
          }
        } else {
          $new_qty = $this->contents[$products_id]['qty'];
        }

        $new_qty = round($new_qty, QUANTITY_DECIMALS);

        if ($new_qty == (int)$new_qty) {
          $new_qty = (int)$new_qty;
        }

        $products_array[] = array('id' => $products_id,
        'name' => $products->fields['products_name'],
        'model' => $products->fields['products_model'],
        'image' => $products->fields['products_image'],
        'price' => ($products->fields['product_is_free'] =='1' ? 0 : $products_price),
        //                                    'quantity' => $this->contents[$products_id]['qty'],
        'quantity' => $new_qty,
        'weight' => $products->fields['products_weight'] + $this->attributes_weight($products_id),
        // fix here
        'final_price' => ($products_price + $this->attributes_price($products_id)),
        'onetime_charges' => ($this->attributes_price_onetime_charges($products_id, $new_qty)),
        'tax_class_id' => $products->fields['products_tax_class_id'],
        'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''),
        'attributes_values' => (isset($this->contents[$products_id]['attributes_values']) ? $this->contents[$products_id]['attributes_values'] : ''),
        'products_priced_by_attribute' => $products->fields['products_priced_by_attribute'],
        'product_is_free' => $products->fields['product_is_free'],
        'products_discount_type' => $products->fields['products_discount_type'],
        'products_discount_type_from' => $products->fields['products_discount_type_from']);
      }
    }
    $this->notify('NOTIFIER_CART_GET_PRODUCTS_END');
    return $products_array;
  }
  /**
   * Method to calculate total price of items in cart
   *
   * @return decimal Total Price
   */
  function show_total() {
    $this->notify('NOTIFIER_CART_SHOW_TOTAL_START');
    $this->calculate();
    $this->notify('NOTIFIER_CART_SHOW_TOTAL_END');
    return $this->total;
  }
  /**
   * Method to calculate total weight of items in cart
   *
   * @return decimal Total Weight
   */
  function show_weight() {
    $this->calculate();
    return $this->weight;
  }
  /**
   * Method to generate a cart ID
   *
   * @param length of ID to generate
   * @return string cart ID
   */
  function generate_cart_id($length = 5) {
    return zen_create_random_value($length, 'digits');
  }
  /**
   * Method to calculate the content type of a cart
   *
   * @param boolean whether to test for Gift Vouchers only
   * @return string
   */
  function get_content_type($gv_only = 'false') {
    global $db;

    $this->content_type = false;
    $gift_voucher = 0;

    //      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
    if ( $this->count_contents() > 0 ) {
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $free_ship_check = $db->Execute("select products_virtual, products_model, products_price, product_is_always_free_shipping from " . TABLE_PRODUCTS . " where products_id = '" . zen_get_prid($products_id) . "'");
        $virtual_check = false;
        if (ereg('^GIFT', addslashes($free_ship_check->fields['products_model']))) {
          $gift_voucher += ($free_ship_check->fields['products_price'] + $this->attributes_price($products_id)) * $this->contents[$products_id]['qty'];
        }
        // product_is_always_free_shipping = 2 is special requires shipping
        // Example: Product with download
        if (isset($this->contents[$products_id]['attributes']) and $free_ship_check->fields['product_is_always_free_shipping'] != 2) {
          reset($this->contents[$products_id]['attributes']);
          while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
            $virtual_check_query = "select count(*) as total
                                      from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, "
            . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                      where pa.products_id = '" . (int)$products_id . "'
                                      and pa.options_values_id = '" . (int)$value . "'
                                      and pa.products_attributes_id = pad.products_attributes_id";

            $virtual_check = $db->Execute($virtual_check_query);

            if ($virtual_check->fields['total'] > 0) {
              switch ($this->content_type) {
                case 'physical':
                $this->content_type = 'mixed';
                if ($gv_only == 'true') {
                  return $gift_voucher;
                } else {
                  return $this->content_type;
                }
                break;
                default:
                $this->content_type = 'virtual';
                break;
              }
            } else {
              switch ($this->content_type) {
                case 'virtual':
                if ($free_ship_check->fields['products_virtual'] == '1') {
                  $this->content_type = 'virtual';
                } else {
                  $this->content_type = 'mixed';
                  if ($gv_only == 'true') {
                    return $gift_voucher;
                  } else {
                    return $this->content_type;
                  }
                }
                break;
                case 'physical':
                if ($free_ship_check->fields['products_virtual'] == '1') {
                  $this->content_type = 'mixed';
                  if ($gv_only == 'true') {
                    return $gift_voucher;
                  } else {
                    return $this->content_type;
                  }
                } else {
                  $this->content_type = 'physical';
                }
                break;
                default:
                if ($free_ship_check->fields['products_virtual'] == '1') {
                  $this->content_type = 'virtual';
                } else {
                  $this->content_type = 'physical';
                }
              }
            }
          }
        } else {
          switch ($this->content_type) {
            case 'virtual':
            if ($free_ship_check->fields['products_virtual'] == '1') {
              $this->content_type = 'virtual';
            } else {
              $this->content_type = 'mixed';
              if ($gv_only == 'true') {
                return $gift_voucher;
              } else {
                return $this->content_type;
              }
            }
            break;
            case 'physical':
            if ($free_ship_check->fields['products_virtual'] == '1') {
              $this->content_type = 'mixed';
              if ($gv_only == 'true') {
                return $gift_voucher;
              } else {
                return $this->content_type;
              }
            } else {
              $this->content_type = 'physical';
            }
            break;
            default:
            if ($free_ship_check->fields['products_virtual'] == '1') {
              $this->content_type = 'virtual';
            } else {
              $this->content_type = 'physical';
            }
          }
        }
      }
    } else {
      $this->content_type = 'physical';
    }

    if ($gv_only == 'true') {
      return $gift_voucher;
    } else {
      return $this->content_type;
    }
  }
  /**
   * Method to unserialize a cart object
   *
   * @deprecated
   * @private
   */
  function unserialize($broken) {
    for(reset($broken);$kv=each($broken);) {
      $key=$kv['key'];
      if (gettype($this->$key)!="user function")
      $this->$key=$kv['value'];
    }
  }
  /**
   * Method to calculate item quantity, bounded the mixed/min units settings
   *
   * @param boolean product id of item to check
   * @return deciaml
   */
  function in_cart_mixed($products_id) {
    global $db;
    // if nothing is in cart return 0
    if (!is_array($this->contents)) return 0;

    // check if mixed is on
    //      $product = $db->Execute("select products_id, products_quantity_mixed from " . TABLE_PRODUCTS . " where products_id='" . (int)$products_id . "' limit 1");
    $product = $db->Execute("select products_id, products_quantity_mixed from " . TABLE_PRODUCTS . " where products_id='" . zen_get_prid($products_id) . "' limit 1");

    // if mixed attributes is off return qty for current attribute selection
    if ($product->fields['products_quantity_mixed'] == '0') {
      return $this->get_quantity($products_id);
    }

    // compute total quantity regardless of attributes
    $in_cart_mixed_qty = 0;
    $chk_products_id= zen_get_prid($products_id);

    // reset($this->contents); // breaks cart
    $check_contents = $this->contents;
    while (list($products_id, ) = each($check_contents)) {
      $test_id = zen_get_prid($products_id);
      if ($test_id == $chk_products_id) {
        $in_cart_mixed_qty += $check_contents[$products_id]['qty'];
      }
    }
    return $in_cart_mixed_qty;
  }
  /**
   * Method to calculate item quantity, bounded the mixed/min units settings
   *
   * @param boolean product id of item to check
   * @return deciaml
   */
  function in_cart_mixed_discount_quantity($products_id) {
    global $db;
    // if nothing is in cart return 0
    if (!is_array($this->contents)) return 0;

    // check if mixed is on
    //      $product = $db->Execute("select products_id, products_mixed_discount_quantity from " . TABLE_PRODUCTS . " where products_id='" . (int)$products_id . "' limit 1");
    $product = $db->Execute("select products_id, products_mixed_discount_quantity from " . TABLE_PRODUCTS . " where products_id='" . zen_get_prid($products_id) . "' limit 1");

    // if mixed attributes is off return qty for current attribute selection
    if ($product->fields['products_mixed_discount_quantity'] == '0') {
      return $this->get_quantity($products_id);
    }

    // compute total quantity regardless of attributes
    $in_cart_mixed_qty_discount_quantity = 0;
    $chk_products_id= zen_get_prid($products_id);

    // reset($this->contents); // breaks cart
    $check_contents = $this->contents;
    while (list($products_id, ) = each($check_contents)) {
      $test_id = zen_get_prid($products_id);
      if ($test_id == $chk_products_id) {
        $in_cart_mixed_qty_discount_quantity += $check_contents[$products_id]['qty'];
      }
    }
    return $in_cart_mixed_qty_discount_quantity;
  }
  /**
   * Method to calculate the number of items in a cart based on an abitrary property
   *
   * $check_what is the fieldname example: 'products_is_free'
   * $check_value is the value being tested for - default is 1
   * Syntax: $_SESSION['cart']->in_cart_check('product_is_free','1');
   *
   * @param string product field to check
   * @param mixed value to check for
   * @return integer number of items matching restraint
   */
  function in_cart_check($check_what, $check_value='1') {
    global $db;
    // if nothing is in cart return 0
    if (!is_array($this->contents)) return 0;

    // compute total quantity for field
    $in_cart_check_qty=0;

    reset($this->contents);
    while (list($products_id, ) = each($this->contents)) {
      $testing_id = zen_get_prid($products_id);
      // check if field it true
      $product_check = $db->Execute("select " . $check_what . " as check_it from " . TABLE_PRODUCTS . " where products_id='" . $testing_id . "' limit 1");
      if ($product_check->fields['check_it'] == $check_value) {
        $in_cart_check_qty += $this->contents[$products_id]['qty'];
      }
    }
    return $in_cart_check_qty;
  }
  /**
   * Method to check whether cart contains only Gift Vouchers
   *
   * @return mixed value of Gift Vouchers in cart
   */
  function gv_only() {
    $gift_voucher = $this->get_content_type(true);
    return $gift_voucher;
  }
  /**
   * Method to return the number of free shipping items in the cart
   *
   * @return decimal
   */
  function free_shipping_items() {
    $this->calculate();
    return $this->free_shipping_item;
  }
  /**
   * Method to return the total price of free shipping items in the cart
   *
   * @return decimal
   */
  function free_shipping_prices() {
    $this->calculate();

    return $this->free_shipping_price;
  }
  /**
   * Method to return the total weight of free shipping items in the cart
   *
   * @return decimal
   */
  function free_shipping_weight() {
    $this->calculate();

    return $this->free_shipping_weight;
  }
  /**
   * Method to handle cart Action - update product
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionUpdateProduct($goto, $parameters) {
    global $messageStack;

    for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
      $adjust_max= 'false';
      if ( in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array())) or $_POST['cart_quantity'][$i]==0) {
        $this->remove($_POST['products_id'][$i]);
      } else {
        $add_max = zen_get_products_quantity_order_max($_POST['products_id'][$i]);
        $cart_qty = $this->in_cart_mixed($_POST['products_id']);
        $new_qty = $_POST['cart_quantity'][$i];
//die('I see Update Cart: ' . $_POST['products_id'][$i] . ' add qty: ' . $add_max . ' - cart qty: ' . $cart_qty . ' - newqty: ' . $new_qty);
        if (($add_max == 1 and $cart_qty == 1)) {
          // do not add
          $adjust_max= 'true';
        } else {
          // adjust quantity if needed
          if (($new_qty + $cart_qty > $add_max) and $add_max != 0) {
            $adjust_max= 'true';
            $new_qty = $add_max - $cart_qty;
          }
          $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
          $this->add_cart($_POST['products_id'][$i], $new_qty, $attributes, false);
        }
        if ($adjust_max == 'true') {
          $messageStack->add_session('shopping_cart', ERROR_MAXIMUM_QTY . ' - ' . zen_get_products_name($_POST['products_id'][$i]), 'caution');
        }
      }
    }
    zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
  }
  /**
   * Method to handle cart Action - add product
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionAddProduct($goto, $parameters) {
    global $messageStack, $db;
    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
      // verify attributes and quantity first
      $the_list = '';
      $adjust_max= 'false';
      if (isset($_POST['id'])) {
        foreach ($_POST['id'] as $key => $value) {
          $check = zen_get_attributes_valid($_POST['products_id'], $key, $value);
          if ($check == false) {
            $the_list .= TEXT_ERROR_OPTION_FOR . '<span class="alertBlack">' . zen_options_name($key) . '</span>' . TEXT_INVALID_SELECTION . '<span class="alertBlack">' . (zen_values_name($value) == 'TEXT' ? TEXT_INVALID_USER_INPUT : zen_values_name($value)) . '</span>' . '<br />';
          }
        }
      }
      // verify qty to add
//          $real_ids = $_POST['id'];
//die('I see Add to Cart: ' . $_POST['products_id'] . 'real id ' . zen_get_uprid($_POST['products_id'], $real_ids) . ' add qty: ' . $add_max . ' - cart qty: ' . $cart_qty . ' - newqty: ' . $new_qty);
      $add_max = zen_get_products_quantity_order_max($_POST['products_id']);
      $cart_qty = $this->in_cart_mixed($_POST['products_id']);
      $new_qty = $_POST['cart_quantity'];
      if (($add_max == 1 and $cart_qty == 1)) {
        // do not add
        $new_qty = 0;
        $adjust_max= 'true';
      } else {
        // adjust quantity if needed
        if (($new_qty + $cart_qty > $add_max) and $add_max != 0) {
          $adjust_max= 'true';
          $new_qty = $add_max - $cart_qty;
        }
      }
      if ((zen_get_products_quantity_order_max($_POST['products_id']) == 1 and $this->in_cart_mixed($_POST['products_id']) == 1)) {
        // do not add
      } else {
        // process normally
        // bof: set error message
        if ($the_list != '') {
          $messageStack->add('product_info', ERROR_CORRECTIONS_HEADING . $the_list, 'caution');
//          $messageStack->add('header', 'REMOVE ME IN SHOPPING CART CLASS BEFORE RELEASE<br/><BR />' . ERROR_CORRECTIONS_HEADING . $the_list, 'error');
        } else {
          // process normally
          // iii 030813 added: File uploading: save uploaded files with unique file names
          $real_ids = isset($_POST['id']) ? $_POST['id'] : "";
          if (isset($_GET['number_of_uploads']) && $_GET['number_of_uploads'] > 0) {
            /**
             * Need the upload class for attribute type that allows user uploads.
             *
             */
            include(DIR_WS_CLASSES . 'upload.php');
            for ($i = 1, $n = $_GET['number_of_uploads']; $i <= $n; $i++) {
              if (zen_not_null($_FILES['id']['tmp_name'][TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]]) and ($_FILES['id']['tmp_name'][TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] != 'none')) {
                $products_options_file = new upload('id');
                $products_options_file->set_destination(DIR_FS_UPLOADS);
                if ($products_options_file->parse(TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i])) {
                  $products_image_extension = substr($products_options_file->filename, strrpos($products_options_file->filename, '.'));
                  if ($_SESSION['customer_id']) {
                    $db->Execute("insert into " . TABLE_FILES_UPLOADED . " (sesskey, customers_id, files_uploaded_name) values('" . zen_session_id() . "', '" . $_SESSION['customer_id'] . "', '" . zen_db_input($products_options_file->filename) . "')");
                  } else {
                    $db->Execute("insert into " . TABLE_FILES_UPLOADED . " (sesskey, files_uploaded_name) values('" . zen_session_id() . "', '" . zen_db_input($products_options_file->filename) . "')");
                  }
                  $insert_id = $db->Insert_ID();
                  $real_ids[TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] = $insert_id . ". " . $products_options_file->filename;
                  $products_options_file->set_filename("$insert_id" . $products_image_extension);
                  if (!($products_options_file->save())) {
                    break;
                  }
                } else {
                  break;
                }
              } else { // No file uploaded -- use previous value
                $real_ids[TEXT_PREFIX . $_POST[UPLOAD_PREFIX . $i]] = $_POST[TEXT_PREFIX . UPLOAD_PREFIX . $i];
              }
            }
          }

          $this->add_cart($_POST['products_id'], $this->get_quantity(zen_get_uprid($_POST['products_id'], $real_ids))+($new_qty), $real_ids);
          // iii 030813 end of changes.
        } // eof: set error message
      } // eof: quantity maximum = 1

      if ($adjust_max == 'true') {
        $messageStack->add_session('shopping_cart', ERROR_MAXIMUM_QTY . ' - ' . zen_get_products_name($_POST['products_id']), 'caution');
      }
    }
    if ($the_list == '') {
      // no errors
      zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
    } else {
      // errors - display popup message
    }
  }
  /**
   * Method to handle cart Action - buy now
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionBuyNow($goto, $parameters) {
    if (isset($_GET['products_id'])) {
      if (zen_has_product_attributes($_GET['products_id'])) {
        zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
      } else {
        $add_max = zen_get_products_quantity_order_max($_GET['products_id']);
        $cart_qty = $this->in_cart_mixed($_GET['products_id']);
        $new_qty = zen_get_buy_now_qty($_GET['products_id']);
//die('I see Buy Now Cart: ' . $add_max . ' - cart qty: ' . $cart_qty . ' - newqty: ' . $new_qty);
        if (($add_max == 1 and $cart_qty == 1)) {
          // do not add
          $new_qty = 0;
        } else {
          // adjust quantity if needed
          if (($new_qty + $cart_qty > $add_max) and $add_max != 0) {
            $new_qty = $add_max - $cart_qty;
          }
        }
        if ((zen_get_products_quantity_order_max($_GET['products_id']) == 1 and $this->in_cart_mixed($_GET['products_id']) == 1)) {
          // do not add
        } else {
          // check for min/max and add that value or 1
          // $add_qty = zen_get_buy_now_qty($_GET['products_id']);
          //                                    $_SESSION['cart']->add_cart($_GET['products_id'], $_SESSION['cart']->get_quantity($_GET['products_id'])+$add_qty);
          $this->add_cart($_GET['products_id'], $this->get_quantity($_GET['products_id'])+$new_qty);
        }
      }
    }
    zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
  }
  /**
   * Method to handle cart Action - multiple add products
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionMultipleAddProduct($goto, $parameters) {
    global $messageStack;
    while ( list( $key, $val ) = each($_POST['products_id']) ) {
      if ($val > 0) {
        $prodId = $key;
        $qty = $val;
        $add_max = zen_get_products_quantity_order_max($prodId);
        $cart_qty = $this->in_cart_mixed($prodId);
        $new_qty = $qty;
        if (($add_max == 1 and $cart_qty == 1)) {
          // do not add
          $adjust_max= 'true';
        } else {
          // adjust quantity if needed
          if (($new_qty + $cart_qty > $add_max) and $add_max != 0) {
            $adjust_max= 'true';
            $new_qty = $add_max - $cart_qty;
          }
          $this->add_cart($prodId, $this->get_quantity($prodId)+($new_qty));
        }
        if ($adjust_max == 'true') {
          $messageStack->add_session('shopping_cart', ERROR_MAXIMUM_QTY . ' - ' . zen_get_products_name($prodId), 'caution');
        }
      }
    }
    zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
  }
  /**
   * Method to handle cart Action - notify
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionNotify($goto, $parameters) {
    global $db;
    if ($_SESSION['customer_id']) {
      if (isset($_GET['products_id'])) {
        $notify = $_GET['products_id'];
      } elseif (isset($_GET['notify'])) {
        $notify = $_GET['notify'];
      } elseif (isset($_POST['notify'])) {
        $notify = $_POST['notify'];
      } else {
        zen_redirect(zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'notify', 'main_page'))));
      }
      if (!is_array($notify)) $notify = array($notify);
      for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
        $check_query = "select count(*) as count
                          from " . TABLE_PRODUCTS_NOTIFICATIONS . "
                          where products_id = '" . $notify[$i] . "'
                          and customers_id = '" . $_SESSION['customer_id'] . "'";
        $check = $db->Execute($check_query);
        if ($check->fields['count'] < 1) {
          $sql = "insert into " . TABLE_PRODUCTS_NOTIFICATIONS . "
                    (products_id, customers_id, date_added)
                     values ('" . $notify[$i] . "', '" . $_SESSION['customer_id'] . "', now())";
          $db->Execute($sql);
        }
      }
//      zen_redirect(zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'notify', 'main_page'))));
      zen_redirect(zen_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, zen_get_all_get_params(array('action', 'notify', 'main_page'))));
    } else {
      $_SESSION['navigation']->set_snapshot();
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }
  /**
   * Method to handle cart Action - notify remove
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionNotifyRemove($goto, $parameters) {
    global $db;
    if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {
      $check_query = "select count(*) as count
                        from " . TABLE_PRODUCTS_NOTIFICATIONS . "
                        where products_id = '" . $_GET['products_id'] . "'
                        and customers_id = '" . $_SESSION['customer_id'] . "'";

      $check = $db->Execute($check_query);
      if ($check->fields['count'] > 0) {
        $sql = "delete from " . TABLE_PRODUCTS_NOTIFICATIONS . "
                  where products_id = '" . $_GET['products_id'] . "'
                  and customers_id = '" . $_SESSION['customer_id'] . "'";
        $db->Execute($sql);
      }
      zen_redirect(zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'main_page'))));
    } else {
      $_SESSION['navigation']->set_snapshot();
      zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
    }
  }
  /**
   * Method to handle cart Action - Customer Order
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionCustomerOrder($goto, $parameters) {
    global $zco_page;
    if ($_SESSION['customer_id'] && isset($_GET['pid'])) {
      if (zen_has_product_attributes($_GET['pid'])) {
        zen_redirect(zen_href_link(zen_get_info_page($_GET['pid']), 'products_id=' . $_GET['pid']));
      } else {
        $this->add_cart($_GET['pid'], $this->get_quantity($_GET['pid'])+1);
      }
    }
    zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
  }
  /**
   * Method to handle cart Action - remove product
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionRemoveProduct($goto, $parameters) {
    if (isset($_GET['product_id']) && zen_not_null($_GET['product_id'])) $this->remove($_GET['product_id']);
    zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
  }
  /**
   * Method to handle cart Action - user action
   *
   * @param string forward destination
   * @param url parameters
   */
  function actionCartUserAction($goto, $parameters) {
    $this->notify('NOTIFY_CART_USER_ACTION');
  }
}
?>
