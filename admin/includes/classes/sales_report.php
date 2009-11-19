<?php
/*
//////////////////////////////////////////////////////////
//  SALES REPORT                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2006 The Zen Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION: The class file acts as the engine in   //
//  the sales report.  All the data displayed is        //
//  gathered and calculated in here.  The logic tree    //
//  provides a brief summary of the main functions at   //
//  work every time a report is generated.              //
//////////////////////////////////////////////////////////
// $Id: sales_report.php 104 2006-11-12 00:12:59Z BlindSide $
*/

/*
** Logic Tree of class sales_report functions
  sales_report - establishes base class variables, initializes loop for timeframes
   |
   |_build_timeframe - initial oID query for given timeframe
       |_build_li_totals - basic totals for each timeframe
           |_build_li_orders - line item for each order in the timeframe
           |_build_li_products - line item for each product in the timeframe
       |_build_matrix - calculate detailed stats for each timeframe; non-linear display;
                        uses data from build_li_orders and build_li_products
*/

  //_TODO modularize time format code, allowing for other formats

  class sales_report {
    var $timeframe_group, $sd, $ed, $sd_raw, $ed_raw, $date_target, $date_status;
    var $payment_method, $current_status, $manufacturer, $detail_level, $output_format;
    var $timeframe, $timeframe_id, $current_date, $product_filter;

    function sales_report($timeframe, $sd, $ed, $date_target, $date_status, $payment_method, $current_status, $manufacturer, $detail_level, $output_format) {
      global $db;

      // place passed variables into class variables
      $this->timeframe_group = $timeframe;
      $this->date_target = $date_target;
      $this->date_status = $date_status;
      $this->payment_method = $payment_method;
      $this->current_status = $current_status;
      $this->manufacturer = $manufacturer;
      $this->detail_level = $detail_level;
      $this->output_format = $output_format;

      // all our calculations are done using a "raw" timestamp format, which are
      // pulled from entered date strings using the substr function (similar to zen_date_raw)
//      $this->sd_raw = mktime(0, 0, 0, substr($sd, 0, 2), substr($sd, 3, 2), substr($sd, 6, 4) );
//      $this->ed_raw = mktime(0, 0, 0, substr($ed, 0, 2), substr($ed, 3, 2), substr($ed, 6, 4) );
	$this->sd_raw = mktime(0, 0, 0, substr($sd, 5, 2), substr($sd, 8, 2), substr($sd, 0, 4) );
	$this->ed_raw = mktime(23, 59, 59, substr($ed, 5, 2), substr($ed, 8, 2), substr($ed, 0, 4) );

      // run a few checks on the dates
      // avoid dates before the first order
      $first = $db->Execute("select UNIX_TIMESTAMP(min(date_purchased)) as date FROM " . TABLE_ORDERS);
      $first_order = $first->fields['date'];
      $this->global_sd = mktime(0, 0, 0, date("m", $first_order), date("d", $first_order), date("Y", $first_order));
      if ($this->sd_raw < $this->global_sd) $this->sd_raw = $this->global_sd;
      if ($this->ed_raw < $this->global_sd) $this->ed_raw = $this->global_sd;

      // avoid days in the future
      $now = mktime(0, 0, 0, date("m"), date("d"), date("Y") );
      if ($this->sd_raw > $now) $this->sd_raw = $now;
      if ($this->ed_raw > $now) $this->ed_raw = $now;

      // now that the date checks are out of the way, let's begin
      $this->sd = date(DATE_FORMAT_SPIFFYCAL, $this->sd_raw);
      $this->ed = date(DATE_FORMAT_SPIFFYCAL, $this->ed_raw);
      $this->current_date = $this->sd_raw;

      $this->timeframe_id = 0;
      $this->timeframe = array();
      $this->grand_total = array('goods' => 0,
                                 'num_orders' => 0,
                                 'num_products' => 0,
                                 'shipping' => 0,
                                 'tax' => 0,
                                 'discount' => 0,
                                 'discount_qty' => 0,
                                 'gc_sold' => 0,
                                 'gc_sold_qty' => 0,
                                 'gc_used' => 0,
                                 'gc_used_qty' => 0,
                                 'grand' => 0);

      while ($this->current_date <= $this->ed_raw) {
        $this->build_timeframe();
      }

      // build matrix data if requested
      // By placing it here and adding 'matrix' to the 'if' statements
      // for building order and product line items, we have all
      // the possible data at our disposal
      if ($this->detail_level == 'matrix') {
        $this->build_matrix();
      }
    }  // END function sales_report


    //////////////////////////////////////////////////////////
    // Each time this function runs, another timeframe array
    // is built.  The variable $this->current_date acts as the
    // key, used to determine the start and end dates of this
    // particular timeframe.  All other functions are called
    // from within here to build all the requested timeframe
    // information (order line items, product line items, or
    // data matrix).
    //
    function build_timeframe() {
      global $db;
      $id = $this->timeframe_id;  // we use $id to keep arrays short, easier to read

      // $sd and $ed are local to this function, not to be confused with
      // $this->start_date and $this->end_date, entered by the user
      $sd = $this->current_date;

      switch ($this->timeframe_group) {
        case 'year':
          $ed = mktime(0, 0, 0, date("m", $sd), date("d", $sd), date("Y", $sd) + 1);
        break;
        case 'month':
          $ed = mktime(0, 0, 0, date("m", $sd) + 1, 1, date("Y", $sd));
        break;
        case 'week':
          $ed = mktime(0, 0, 0, date("m", $sd), date("d", $sd) + 7, date("Y", $sd));
        break;
        case 'day':
          $ed = mktime(0, 0, 0, date("m", $sd), date("d", $sd) + 1, date("Y", $sd));
        break;
      }

      // dial back $ed if it's beyond the user-specified end date
      // we go 1 day beyond specified end date because end date is exclusive in the query
      if ($ed > $this->ed_raw) {
        $ed = mktime(0, 0, 0, date("m", $this->ed_raw), date("d", $this->ed_raw) + 1, date("Y", $this->ed_raw));
      }

      // define the timeframe array
      $this->timeframe[$id] = array();

      // store the start date and end date for this timeframe
      // timestamp format allows us to use whatever display format we want at output
      // we subtract 1 day so that the displayed end date is the actual end date
      $this->timeframe[$id]['sd'] = $sd;
      $this->timeframe[$id]['ed'] = mktime(0, 0, 0, date("m", $ed), date("d", $ed) - 1, date("Y", $ed));

      // build the excluded products array
      $this->product_filter = "";
      $exclude_products = unserialize(EXCLUDE_PRODUCTS);
      if (is_array($exclude_products) && sizeof($exclude_products) > 0) {
        foreach($exclude_products as $pID) {
          $this->product_filter .= " and op.products_id != '" . $pID . "' \n";
        }
      }

      // build the SQL query of order numbers within the current timeframe
      $sql = "SELECT DISTINCT o.orders_id from " . TABLE_ORDERS . " o \n";
      if ($this->date_target == 'status') {
        $sql .= "LEFT JOIN " . TABLE_ORDERS_STATUS_HISTORY . " osh ON o.orders_id = osh.orders_id \n";
        $sql .= "WHERE osh.date_added >= '" . date("Y-m-d H:i:s", $sd) . "' AND osh.date_added < '" . date("Y-m-d H:i:s", $ed) . "' \n";
        $sql .= "AND osh.orders_status_id = '" . $this->date_status . "' \n";
      }
      else {
        $sql .= "WHERE o.date_purchased >= '" . date("Y-m-d H:i:s", $sd) . "' AND o.date_purchased < '" . date("Y-m-d H:i:s", $ed) . "' \n";
      }
      if ($this->payment_method) $sql .= "AND o.payment_module_code LIKE '" . $this->payment_method . "' \n";
      if ($this->current_status) $sql .= "AND o.orders_status = '" . $this->current_status . "' \n";
      $sql .= "ORDER BY o.orders_id DESC";

      // DEBUG
      //$this->sql[$id] = $sql;

      // loop through query and build the arrays for this timeframe
      $sales = $db->Execute($sql);
      // make sure we actually have orders to process
      if ($sales->RecordCount() > 0) {
        // initialize the various timeframe arrays
        // by creating them inside the RecordCount() check, we can easily
        // check for an empty timeframe with is_array() in the report
        $this->timeframe[$id]['total'] = array('goods' => 0,
                                               'num_orders' => 0,
                                               'num_products' => 0,
                                               'shipping' => 0,
                                               'tax' => 0,
                                               'discount' => 0,
                                               'discount_qty' => 0,
                                               'gc_sold' => 0,
                                               'gc_sold_qty' => 0,
                                               'gc_used' => 0,
                                               'gc_used_qty' => 0,
                                               'grand' => 0,
                                               'diff_products' => array());

        if ($this->detail_level == 'order') {
          $this->timeframe[$id]['orders'] = array();
        }
        elseif ($this->detail_level == 'product') {
          $this->timeframe[$id]['products'] = array();
        }

        while (!$sales->EOF) {
          $oID = $sales->fields['orders_id'];
          $grand_total += $this->build_li_totals($oID);
          
          if (sizeof($this->timeframe[$id]['orders']) == 0) $this->timeframe[$id]['orders'] = false;
          if (sizeof($this->timeframe[$id]['products']) == 0) $this->timeframe[$id]['products'] = false;
          $sales->MoveNext();
        }

        // calculate the total for the timeframe
        $this->timeframe[$id]['total']['grand'] = $grand_total;
        //_MATHCHECK compare this figure to total of individual orders/products

        // add values to the grand total line at the bottom of the report
        $this->grand_total['goods'] += $this->timeframe[$id]['total']['goods'];
        $this->grand_total['num_orders'] += $this->timeframe[$id]['total']['num_orders'];
        $this->grand_total['num_products'] += $this->timeframe[$id]['total']['num_products'];
        $this->grand_total['shipping'] += $this->timeframe[$id]['total']['shipping'];
        $this->grand_total['tax'] += $this->timeframe[$id]['total']['tax'];
        $this->grand_total['discount'] += $this->timeframe[$id]['total']['discount'];
        $this->grand_total['discount_qty'] += $this->timeframe[$id]['total']['discount_qty'];
        $this->grand_total['gc_sold'] += $this->timeframe[$id]['total']['gc_sold'];
        $this->grand_total['gc_sold_qty'] += $this->timeframe[$id]['total']['gc_sold_qty'];
        $this->grand_total['gc_used'] += $this->timeframe[$id]['total']['gc_used'];
        $this->grand_total['gc_used_qty'] += $this->timeframe[$id]['total']['gc_used_qty'];
        $this->grand_total['grand'] += $this->timeframe[$id]['total']['grand'];
      }

      // Since $sd is inclusive, but $ed is exclusive in our query, we need
      // only set next starting point to the current $ed
      $this->current_date = $ed;

      // increment the id number
      $this->timeframe_id++;
    }  // END function build_timeframe()


    //////////////////////////////////////////////////////////
    // build_li_totals() actually does the tallying for each
    // order found within the timeframe set and searched in
    // build_timeframe().  It calls build_li_orders() and
    // build_li_products() as needed.
    //
    function build_li_totals($oID) {
      global $db;
      $id = $this->timeframe_id;

      // if we have to filter on manufacturer, the SQL is totally different
      if ($this->manufacturer) {
        $products_sql = "select op.* from " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p
                         where p.products_id = op.products_id
                         and p.manufacturers_id = " . $this->manufacturer . "
                         and op.orders_id = '" . $oID . "'" . $this->product_filter;
      } else {
        $products_sql = "select op.* from " . TABLE_ORDERS_PRODUCTS . " op
                         where op.orders_id = '" . $oID . "'" . $this->product_filter;
      }
      $products = $db->Execute($products_sql);

      // these "order_" variables are local to the build_li_totals() function.  They
      // are used to determine order total, timeframe grand total, and order count
      $order_goods = 0;
      $order_tax = 0;
      $order_shipping = 0;
      $order_discount = 0;
      $order_gc_sold = 0;
      $order_gc_used = 0;

      while (!$products->EOF) {
        // assign key values to shorter variables for clarity
        $pID = $products->fields['products_id'];
        $final_price = $products->fields['final_price'];
        $quantity = $products->fields['products_quantity'];
        $tax = $products->fields['products_tax'];
        $onetime_charges = $products->fields['onetime_charges'];
        $model = zen_db_output($products->fields['products_model']);

        // do the math

        // gift certificates aren't products, so we must separate those out
        if (substr($model, 0, 4) == 'GIFT') {
          $order_gc_sold += ($final_price * $quantity);
          $this->timeframe[$id]['total']['gc_sold'] += ($final_price * $quantity);
          $this->build_li_orders($oID, 'gc_sold', ($final_price * $quantity) );

          $this->timeframe[$id]['total']['gc_sold_qty'] += $quantity;
          $this->build_li_orders($oID, 'gc_sold_qty', $quantity);

          $order_goods += $onetime_charges;
          $this->timeframe[$id]['total']['goods'] += $onetime_charges;
          $this->build_li_orders($oID, 'goods', $onetime_charges);
        }
        // otherwise calculate the worth of normal goods
        else {
          $order_goods += ( ($final_price * $quantity) + $onetime_charges );
          $this->timeframe[$id]['total']['goods'] += ( ($final_price * $quantity) + $onetime_charges );
          $this->build_li_orders($oID, 'goods', (($final_price * $quantity) + $onetime_charges) );

          $this->timeframe[$id]['total']['num_products'] += $quantity;
          $this->build_li_orders($oID, 'num_products', $quantity);
        }
        // future code - currently being pulled from orders_total table for better accuracy
        // calculate tax values
        //$this->timeframe[$id]['total']['tax'] += zen_calculate_tax($onetime_charges, $tax);
        //$this->timeframe[$id]['total']['tax'] += zen_calculate_tax(($final_price * $quantity), $tax);

        // check to see if product is unique in this timeframe
        // add to 'diff_products' array if so
        $diff_prod_total = $this->unique_count($pID, $this->timeframe[$id]['total']['diff_products']);
        if ($diff_prod_total) $this->timeframe[$id]['total']['diff_products'][] = $pID;

        $diff_prod_order = $this->unique_count($pID, $this->timeframe[$id]['orders'][$oID]['diff_products']);
        if ($diff_prod_order) $this->timeframe[$id]['orders'][$oID]['diff_products'][] = $pID;


        // build product line items (if requested)
        if ($this->detail_level == 'product' || $this->detail_level == 'matrix') {
          // build array of product info so the function already has what it needs, avoiding another query
          $product_tax = (zen_calculate_tax($onetime_charges, $tax)) +
                         (zen_calculate_tax(($final_price * $quantity), $tax));

          $this_product = array('id' => $pID,
                                'name' => $products->fields['products_name'],
                                'model' => $model,
                                'base_price' => $products->fields['products_price'],
                                'quantity' => $quantity,
                                'tax' => $product_tax,
                                'onetime_charges' => $onetime_charges,
                                'total' => ( ($final_price * $quantity) + $onetime_charges) );

          $this->build_li_products($this_product);
        }

        $products->MoveNext();
      }

      // pull shipping, discounts, tax, and gift certificates used from orders_total table
      $totals = $db->Execute("select * from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $oID . "'");
      while (!$totals->EOF) {
        $class = $totals->fields['class'];
        $value = $totals->fields['value'];
        if ($class != "ot_total" && $class != "ot_subtotal") {
          if($class == "ot_gv") {
            $order_gc_used += $value;
            $this->timeframe[$id]['total']['gc_used'] += $value;
            $this->build_li_orders($oID, 'gc_used', $value);

            $this->timeframe[$id]['total']['gc_used_qty']++;
            $this->build_li_orders($oID, 'gc_used_qty', 1);
          }
          elseif ($class == "ot_coupon" || $class == "ot_group_pricing") {
            $order_discount += $value;
            $this->timeframe[$id]['total']['discount'] += $value;
            $this->build_li_orders($oID, 'discount', $value);

            $this->timeframe[$id]['total']['discount_qty']++;
            $this->build_li_orders($oID, 'discount_qty', 1);
          }
          elseif ($class == "ot_tax") {
            $order_tax += $value;
            $this->timeframe[$id]['total']['tax'] += $value;
            $this->build_li_orders($oID, 'tax', $value);
          }
          elseif ($class == "ot_shipping") {
            $order_shipping += $value;
            $this->timeframe[$id]['total']['shipping'] += $value;
            $this->build_li_orders($oID, 'shipping', $value);
          }
          // this allows for a custom discount, a la Super Orders
          elseif ($value < 0) {
            $order_discount += abs($value);
            $this->timeframe[$id]['total']['discount'] += abs($value);
            $this->build_li_orders($oID, 'discount', abs($value) );

            $this->timeframe[$id]['total']['discount_qty']++;
            $this->build_li_orders($oID, 'discount_qty', 1);
          }
        }

        $totals->MoveNext();
      }

      // we want to count an order if it has a value in any category
      $order_values = ($order_goods + $order_tax + $order_shipping + $order_gc_sold + $order_discount + $order_gc_used);
      if ($order_values != 0) {
        $this->timeframe[$id]['total']['num_orders']++;
        $this->build_li_orders($oID, 'has_no_value', false);

        // add up stored values for order grand total
        // (goods + tax + shipping + gc_sold) - (discount + gc_used)
        $order_total = ($order_goods + $order_tax + $order_shipping + $order_gc_sold) - ($order_discount + $order_gc_used);

        if ($this->detail_level == 'order' || $this->detail_level == 'matrix') {
          $this->build_li_orders($oID, 'grand', $order_total);
        }

        return $order_total;
      }
      else {
        $this->build_li_orders($oID, 'has_no_value', true);
        return 0;
      }

    }  // END function build_li_totals($oID)


    //////////////////////////////////////////////////////////
    // build_li_orders() is called each time a value is added
    // to the 'total' array.  If the customer wishes to
    // display order line items, the value is added to the
    // corresponding 'orders' array.
    //
    function build_li_orders($oID, $field, $value) {
      $id = $this->timeframe_id;
      // first check to see if we even need to do anything
      if ($this->detail_level == 'order' || $this->detail_level == 'matrix') {
        // create the array if it doesn't already exist
        if (!is_array($this->timeframe[$id]['orders'][$oID]) ) {
          $this->timeframe[$id]['orders'][$oID] = array('oID' => $oID,
                                                        // the $oID key will be reset when we sort the array at
                                                        // display, so we store it as a part of the array as well
                                                        'goods' => 0,
                                                        'num_products' => 0,
                                                        'diff_products' => array(),
                                                        'shipping' => 0,
                                                        'tax' => 0,
                                                        'discount' => 0,
                                                        'discount_qty' => 0,
                                                        'gc_sold' => 0,
                                                        'gc_sold_qty' => 0,
                                                        'gc_used' => 0,
                                                        'gc_used_qty' => 0,
                                                        'grand' => 0);

          // get the customer data
          global $db;
          $c_data = $db->Execute("select c.* from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS . " o
                                  where o.customers_id = c.customers_id
                                  and o.orders_id = '" . $oID . "' limit 1");

          $customers_id = $c_data->fields['customers_id'];
          $first_name = zen_db_output($c_data->fields['customers_firstname']);
          $last_name = zen_db_output($c_data->fields['customers_lastname']);

          $this->timeframe[$id]['orders'][$oID]['customers_id'] = $customers_id;
          $this->timeframe[$id]['orders'][$oID]['first_name'] = $first_name;
          $this->timeframe[$id]['orders'][$oID]['last_name'] = $last_name;
        }

        // add the passed $value to the passed $field in the ['orders'] array
        $this->timeframe[$id]['orders'][$oID][$field] += $value;
      }
    }


    //////////////////////////////////////////////////////////
    // Since product line items don't need to look at the
    // orders_total table, we can just call build_li_products
    // once and build/increment the product array per product
    // (i.e. products are already line items, orders are not).
    //
    function build_li_products($product) {
      $id = $this->timeframe_id;
      $pID = $product['id'];

      // initialize the array for this products_id if it doesn't exist yet
      if (!is_array($this->timeframe[$id]['products'][$pID]) ) {
        $this->timeframe[$id]['products'][$pID] = array('pID' => $pID,
                                                        'name' => $product['name'],
                                                        'model' => $product['model'],
                                                        'manufacturer' => '',
                                                        'base_price' => $product['base_price'],
                                                        'quantity' => $product['quantity'],
                                                        'onetime_charges' => $product['onetime_charges'],
                                                        'total' => $product['total'], // 'total' = ( ($final_price * $quantity) + $onetime_charges ) )
                                                        'tax' => $product['tax'],
                                                        'grand' => $product['total'] + $product['tax']);

        // get the manufacturers_id from `products` table
        if (DISPLAY_MANUFACTURER) {
          global $db;
          $get_manu_id = $db->Execute("select m.* from " . TABLE_PRODUCTS . " p, " . TABLE_MANUFACTURERS . " m
                                       where m.manufacturers_id = p.manufacturers_id
                                       and products_id = '" . $pID . "' limit 1");
          if ($get_manu_id->RecordCount() > 0) {
            $this->timeframe[$id]['products'][$pID]['manufacturer'] = $get_manu_id->fields['manufacturers_name'];
          } else {
            $this->timeframe[$id]['products'][$pID]['manufacturer'] = TEXT_NONE;
          }
        }
      }

      // or add the values of ordered product to existing 'products' array
      // note that the informational fields are only defined once (i.e. the SQL sort order matters!)
      else {
        $this->timeframe[$id]['products'][$pID]['quantity'] += $product['quantity'];
        $this->timeframe[$id]['products'][$pID]['onetime_charges'] += $product['onetime_charges'];
        $this->timeframe[$id]['products'][$pID]['total'] += $product['total'];
        $this->timeframe[$id]['products'][$pID]['tax'] += $product['tax'];
        $this->timeframe[$id]['products'][$pID]['grand'] += $product['total'] + $product['tax'];
      }

    }  // END function build_li_products($product)



    //////////////////////////////////////////////////////////
    // Building the data matrix requires data from both the
    // order and product level, so we build both arrays when
    // creating a data matrix.  This saves us from having to
    // run several queries and makes the adding the matrix
    // report a snap, since we can just tack it on after
    // building all the data arrays!
    //
    function build_matrix() {
      global $db;
      for ($i = 0; $i < sizeof($this->timeframe); $i++) {
        // skip the current timeframe if there isn't any data
        if (!is_array($this->timeframe[$i]['orders']) ) continue;
        if (!is_array($this->timeframe[$i]['products']) ) continue;

        $tf =& $this->timeframe[$i];
        $tf['matrix'] = array('diff_customers' => array(),
                              'payment_methods' => array(),
                              'shipping_methods' => array(),
                              'credit_cards' => array(),
                              'currencies' => array(),
                              'biggest_per_revenue' => 0,
                              'biggest_per_products' => 0,
                              'smallest_per_revenue' => 0,
                              'smallest_per_products' => 0,
                              'avg_order_value' => 0,
                              'avg_products_per_order' => 0,
                              'avg_diff_products_per_order' => 0,
                              'avg_orders_per_customer' => 0,
                              'product_spread' => array(),
                              'product_revenue_ratio' => array(),
                              'product_quantity_ratio' => array() );

        // gather statistics from orders array
        foreach($tf['orders'] as $oID => $o_data) {
          $order = $db->Execute("select * from " . TABLE_ORDERS . " where orders_id = '" . $oID . "'");

          // place pertient data in short variables
          $cc_type = $order->fields['cc_type'];
          $payment_method = $order->fields['payment_method'];
          $payment_module_code = $order->fields['payment_module_code'];
          $shipping_method = $order->fields['shipping_method'];
          $shipping_module_code = $order->fields['shipping_module_code'];
          $currency = $order->fields['currency'];

          // Format shipping method to remove the data in parentheses
          $shipping_method = explode(" (", $shipping_method, 2);
          $shipping_method = rtrim($shipping_method[0], ":");

          // Number of unique customers
          $cID = $o_data['customers_id'];
          $new_customer = true;
          foreach($tf['matrix']['diff_customers'] as $this_cID => $c_data) {
            $c_data =& $tf['matrix']['diff_customers'][$this_cID];
            if ($cID == $this_cID) {
              $c_data['num_orders']++;
              $new_customer = false;
              break;
            }
            unset($c_data);
          }
          if ($new_customer) {
            $tf['matrix']['diff_customers'][$cID] = array('first_name' => $o_data['first_name'],
                                                          'last_name' => $o_data['last_name'],
                                                          'num_orders' => 1);
          }

          // Payment methods used, with count
          $new_payment_method = true;
          foreach($tf['matrix']['payment_methods'] as $key => $value) {
            $value =& $tf['matrix']['payment_methods'][$key];
            if ($value['module_code'] == $payment_module_code) {
              $value['count']++;
              $new_payment_method = false;
              unset($value);
              break;
            }
            unset($value);
          }
          if ($new_payment_method) {
            $tf['matrix']['payment_methods'][] = array('method' => $payment_method,
                                                       'module_code' => $payment_module_code,
                                                       'count' => 1);
          }

          // Shipping methods used, with count
          $new_shipping_method = true;
          foreach($tf['matrix']['shipping_methods'] as $key => $value) {
            $value =& $tf['matrix']['shipping_methods'][$key];
            if ($value['module_code'] == $shipping_module_code) {
              $value['count']++;
              $new_shipping_method = false;
              unset($value);
              break;
            }
            unset($value);
          }
          if ($new_shipping_method) {
            $tf['matrix']['shipping_methods'][] = array('method' => $shipping_method,
                                                        'module_code' => $shipping_module_code,
                                                        'count' => 1);
          }

          // Credit cards used, with count
          $new_credit_card = true;
          foreach($tf['matrix']['credit_cards'] as $key => $value) {
            $value =& $tf['matrix']['credit_cards'][$key];
            if ($value['type'] == $cc_type) {
              $value['count']++;
              $new_credit_card = false;
              unset($value);
              break;
            }
            unset($value);
          }
          if ($new_credit_card && $cc_type != '') {
            $tf['matrix']['credit_cards'][] = array('type' => $cc_type,
                                                    'count' => 1);
          }

          // Currencies used, with count
          // eliminate display on report with "if (sizeof($timeframe['matrix']['currencies']) > 1)"
          $new_currency = true;
          foreach($tf['matrix']['currencies'] as $key => $value) {
            $value =& $tf['matrix']['currencies'][$key];
            if ($value['type'] == $currency) {
              $value['count']++;
              $new_currency = false;
              unset($value);
              break;
            }
            unset($value);
          }
          if ($new_currency) {
            $tf['matrix']['currencies'][] = array('type' => $currency,
                                                  'count' => 1);
          }

          // Biggest order by revenue (display order # and customer name)
          if ($tf['matrix']['biggest_per_revenue'] == 0) {
            $tf['matrix']['biggest_per_revenue'] = $oID;
          }
          else {
            $current_leader = $tf['orders'][ $tf['matrix']['biggest_per_revenue'] ];
            if ($o_data['goods'] > $current_leader['goods']) {
              $tf['matrix']['biggest_per_revenue'] = $oID;
            }
          }

          // Smallest order by revenue (display order # and customer name)
          if ($tf['matrix']['smallest_per_revenue'] == 0) {
            $tf['matrix']['smallest_per_revenue'] = $oID;
          }
          else {
            $current_leader = $tf['orders'][ $tf['matrix']['smallest_per_revenue'] ];
            if ($o_data['goods'] < $current_leader['goods']) {
              $tf['matrix']['smallest_per_revenue'] = $oID;
            }
          }

          // Biggest order by product count (display order # and customer name)
          if ($tf['matrix']['biggest_per_product'] == 0) {
            $tf['matrix']['biggest_per_product'] = $oID;
          }
          else {
            $current_leader = $tf['orders'][ $tf['matrix']['biggest_per_product'] ];
            if ($o_data['num_products'] > $current_leader['num_products']) {
              $tf['matrix']['biggest_per_product'] = $oID;
            }
          }

          // Smallest order by product count (display order # and customer name)
          if ($tf['matrix']['smallest_per_product'] == 0) {
            $tf['matrix']['smallest_per_product'] = $oID;
          }
          else {
            $current_leader = $tf['orders'][ $tf['matrix']['smallest_per_product'] ];
            if ($o_data['num_products'] < $current_leader['num_products']) {
              $tf['matrix']['smallest_per_product'] = $oID;
            }
          }

        }  // END foreach($tf['orders'] as $oID => $o_data)

        // Avg order value
        $tf['matrix']['avg_order_value'] = ($tf['total']['grand'] / sizeof($tf['orders']));

        // Avg number of products in an order
        $tf['matrix']['avg_products_per_order'] = ($tf['total']['num_products'] / sizeof($tf['orders']));

        // Avg number of unique products in an order
        $tf['matrix']['avg_diff_products_per_order'] = (sizeof($tf['total']['diff_products']) / sizeof($tf['orders']));

        // Avg # orders per unique customer
        $tf['matrix']['avg_orders_per_customer'] = (sizeof($tf['orders']) / sizeof($tf['matrix']['diff_customers']));

        // gather statistics from products array
        foreach($tf['products'] as $pID => $p_data) {

          // Per product "spread" (number of orders that a product is a part of)
          foreach($tf['orders'] as $oID => $o_data) {
            foreach($o_data['diff_products'] as $ordered_pID) {
              if ($pID == $ordered_pID) {
                $tf['matrix']['product_spread'][$pID]++;
                break;
              }
            }
          }

          // percentage of all revenue by product BEFORE shipping, tax, discounts, and gc's
          $tf['matrix']['product_revenue_ratio'][$pID] = number_format((($p_data['total'] / $tf['total']['goods']) * 100), 3);

          // percentage of all quantity by product
          $tf['matrix']['product_quantity_ratio'][$pID] = number_format((($p_data['quantity'] / $tf['total']['num_products']) * 100), 3);
        }  // END foreach($tf['products'] as $pID => $p_data)

      }  // END for ($i = 0, $i < sizeof($this->timeframe); $i++)

    }  // END function build_matrix()


    function unique_count($item, $item_array) {
      if (sizeof($item_array) == 0) {
        return true;
      }
      foreach ($item_array as $id => $compare_item) {
        if ($item == $compare_item) {
          return false;
        }
      }
      return true;
    }

    //////////////////////////////////////////////////////////
    // This function actually creates the CSV file when CSV
    // output is requested.  The logic and looping structure
    // is nearly identical to that found in the HTML output,
    // but we seperate it out for the sake of code clarity and
    // to allow for some differences between the 2 outputs.
    //
    function output_csv($csv_header, $timeframe_sort, $li_sort_a, $li_sort_order_a, $li_sort_b, $li_sort_order_b) {
      $display_tax =  ($this->grand_total['tax'] > 0 ? true : false);

      $filename = CSV_FILENAME_PREFIX . date('Ymd', $this->sd_raw) . "-" . date('Ymd', $this->ed_raw);
      header("Pragma: cache");
      header("Content-Type: text/comma-separated-values");
      header("Content-Disposition: attachment; filename=" . urlencode($filename) . ".csv");

      if ($csv_header) {
        switch ($this->detail_level) {
          case 'timeframe':
            echo CSV_HEADING_START_DATE . CSV_SEPARATOR;
            echo CSV_HEADING_END_DATE . CSV_SEPARATOR;
            echo TABLE_HEADING_NUM_ORDERS . CSV_SEPARATOR;
            echo TABLE_HEADING_NUM_PRODUCTS . CSV_SEPARATOR;
            echo TABLE_HEADING_TOTAL_GOODS . CSV_SEPARATOR;
            if ($display_tax) echo TABLE_HEADING_TAX . CSV_SEPARATOR;
            echo TABLE_HEADING_SHIPPING . CSV_SEPARATOR;
            echo TABLE_HEADING_DISCOUNTS . CSV_SEPARATOR;
            echo TABLE_HEADING_GC_SOLD . CSV_SEPARATOR;
            echo TABLE_HEADING_GC_USED . CSV_SEPARATOR;
            echo TABLE_HEADING_TOTAL . CSV_NEWLINE;
          break;
          case 'order':
            echo CSV_HEADING_START_DATE . CSV_SEPARATOR;
            echo CSV_HEADING_END_DATE . CSV_SEPARATOR;
            echo TABLE_HEADING_ORDERS_ID . CSV_SEPARATOR;
            echo CSV_HEADING_LAST_NAME . CSV_SEPARATOR;
            echo CSV_HEADING_FIRST_NAME . CSV_SEPARATOR;
            echo TABLE_HEADING_NUM_PRODUCTS . CSV_SEPARATOR;
            echo TABLE_HEADING_TOTAL_GOODS . CSV_SEPARATOR;
            if ($display_tax) echo TABLE_HEADING_TAX . CSV_SEPARATOR;
            echo TABLE_HEADING_SHIPPING . CSV_SEPARATOR;
            echo TABLE_HEADING_DISCOUNTS . CSV_SEPARATOR;
            echo TABLE_HEADING_GC_SOLD . CSV_SEPARATOR;
            echo TABLE_HEADING_GC_USED . CSV_SEPARATOR;
            echo TABLE_HEADING_ORDER_TOTAL . CSV_NEWLINE;
          break;
          case 'product':
            echo CSV_HEADING_START_DATE . CSV_SEPARATOR;
            echo CSV_HEADING_END_DATE . CSV_SEPARATOR;
            echo TABLE_HEADING_PRODUCT_ID . CSV_SEPARATOR;
            echo TABLE_HEADING_PRODUCT_NAME . CSV_SEPARATOR;
            if (DISPLAY_MANUFACTURER) echo TABLE_HEADING_MANUFACTURER . CSV_SEPARATOR;
            echo TABLE_HEADING_MODEL . CSV_SEPARATOR;
            echo TABLE_HEADING_BASE_PRICE . CSV_SEPARATOR;
            echo TABLE_HEADING_QUANTITY . CSV_SEPARATOR;
            if ($display_tax) echo TABLE_HEADING_TAX . CSV_SEPARATOR;
            if (DISPLAY_ONE_TIME_FEES) echo TABLE_HEADING_ONETIME_CHARGES . CSV_SEPARATOR;
            if ($display_tax) echo TABLE_HEADING_TOTAL . CSV_SEPARATOR;
            echo TABLE_HEADING_PRODUCT_TOTAL . CSV_NEWLINE;
          break;
        }
      }  // END if ($csv_header)


      if ($timeframe_sort == 'desc') {
        krsort($this->timeframe);
      }

      foreach ($this->timeframe as $id => $timeframe) {
        // format the dates
        switch ($this->timeframe_group) {
          case 'day':
            $start_date = date(TIME_DISPLAY_DAY, $timeframe['sd']);
            $end_date = date(TIME_DISPLAY_DAY, $timeframe['ed']);
          break;
          case 'week':
            $start_date = date(TIME_DISPLAY_WEEK, $timeframe['sd']);
            $end_date = date(TIME_DISPLAY_WEEK, $timeframe['ed']);
          break;
          case 'month':
            $start_date = date(TIME_DISPLAY_MONTH, $timeframe['sd']);
            $end_date = date(TIME_DISPLAY_MONTH, $timeframe['ed']);
          break;
          case 'year':
            $start_date = date(TIME_DISPLAY_YEAR, $timeframe['sd']);
            $end_date = date(TIME_DISPLAY_YEAR, $timeframe['ed']);
          break;
        }
        switch ($this->detail_level) {
          case 'timeframe':
            echo $start_date . CSV_SEPARATOR;
            echo $end_date . CSV_SEPARATOR;
            echo $timeframe['total']['num_orders'] . CSV_SEPARATOR;
            echo $timeframe['total']['num_products'] . CSV_SEPARATOR;
            //echo TEXT_DIFF . sizeof($timeframe['total']['diff_products']) . CSV_SEPARATOR;
            echo $timeframe['total']['goods'] . CSV_SEPARATOR;
            if ($display_tax) $timeframe['total']['tax'] . CSV_SEPARATOR;
            echo $timeframe['total']['shipping'] . CSV_SEPARATOR;
            echo $timeframe['total']['discount'] . CSV_SEPARATOR;
            //echo TEXT_QTY . $timeframe['total']['discount_qty'] . CSV_SEPARATOR;
            echo $timeframe['total']['gc_sold'] . CSV_SEPARATOR;
            //echo TEXT_QTY . $timeframe['total']['gc_sold_qty'] . CSV_SEPARATOR;
            echo $timeframe['total']['gc_used'] . CSV_SEPARATOR;
            //echo TEXT_QTY . $timeframe['total']['gc_used_qty'] . CSV_SEPARATOR;
            echo $timeframe['total']['grand'] . CSV_NEWLINE;
          break;

          case 'order':
            // sort the orders according to requested sort options
            unset($dataset1, $dataset2);
// add kino
	if(isset($timeframe['orders'])){
// add kino
            foreach($timeframe['orders'] as $oID => $o_data) {
              $dataset1[$oID] = $o_data[$li_sort_a];
              $dataset2[$oID] = $o_data[$li_sort_b];
            }

            if ($li_sort_order_a == 'asc') {
              if ($li_sort_order_b == 'asc') {
                array_multisort($dataset1, SORT_ASC, $dataset2, SORT_ASC, $timeframe['orders']);
              }
              elseif ($li_sort_order_b == 'desc') {
                array_multisort($dataset1, SORT_ASC, $dataset2, SORT_DESC, $timeframe['orders']);
              }
            }
            elseif ($li_sort_order_a == 'desc') {
              if ($li_sort_order_b == 'asc') {
                array_multisort($dataset1, SORT_DESC, $dataset2, SORT_ASC, $timeframe['orders']);
              }
              elseif ($li_sort_order_b == 'desc') {
                array_multisort($dataset1, SORT_DESC, $dataset2, SORT_DESC, $timeframe['orders']);
              }
            }

            foreach($timeframe['orders'] as $key => $o_data) {
              // skip order if it has no value
              if ($o_data['has_no_value']) continue;

              echo $start_date . CSV_SEPARATOR;
              echo $end_date . CSV_SEPARATOR;
              echo $o_data['oID'] . CSV_SEPARATOR;
              echo $o_data['first_name'] . CSV_SEPARATOR;
              echo $o_data['last_name'] . CSV_SEPARATOR;
              echo $o_data['num_products'] . CSV_SEPARATOR;
              //echo (sizeof($o_data['diff_products']) > 1 ? TEXT_DIFF . sizeof($o_data['diff_products']) : TEXT_SAME) . CSV_SEPARATOR;
              echo $o_data['goods'] . CSV_SEPARATOR;
              if ($display_tax) echo $o_data['tax'] . CSV_SEPARATOR;
              echo $o_data['shipping'] . CSV_SEPARATOR;
              echo $o_data['discount'] . CSV_SEPARATOR;
              //echo TEXT_QTY . $o_data['discount_qty'] . CSV_SEPARATOR;
              echo $o_data['gc_sold'] . CSV_SEPARATOR;
              //echo TEXT_QTY . $o_data['gc_sold_qty'] . CSV_SEPARATOR;
              echo $o_data['gc_used'] . CSV_SEPARATOR;
              //echo TEXT_QTY . $o_data['gc_used_qty'] . CSV_SEPARATOR;
              echo $o_data['grand'] . CSV_NEWLINE;
            }

//            echo CSV_NEWLINE;
        }
          break;

          case 'product':
            // sort the products according to requested sort options
            unset($dataset1, $dataset2);
// add kino
	if(isset($timeframe['products'])){
// add kino
            foreach($timeframe['products'] as $pID => $p_data) {
              $dataset1[$pID] = $p_data[$li_sort_a];
              $dataset2[$pID] = $p_data[$li_sort_b];
            }

            if ($li_sort_order_a == 'asc') {
              if ($li_sort_order_b == 'asc') {
                array_multisort($dataset1, SORT_ASC, $dataset2, SORT_ASC, $timeframe['products']);
              }
              elseif ($li_sort_order_b == 'desc') {
                array_multisort($dataset1, SORT_ASC, $dataset2, SORT_DESC, $timeframe['products']);
              }
            }
            elseif ($li_sort_order_a == 'desc') {
              if ($li_sort_order_b == 'asc') {
                array_multisort($dataset1, SORT_DESC, $dataset2, SORT_ASC, $timeframe['products']);
              }
              elseif ($li_sort_order_b == 'desc') {
                array_multisort($dataset1, SORT_DESC, $dataset2, SORT_DESC, $timeframe['products']);
              }
            }

            foreach($timeframe['products'] as $key => $p_data) {
              echo $start_date . CSV_SEPARATOR;
              echo $end_date . CSV_SEPARATOR;
              echo $p_data['pID'] . CSV_SEPARATOR;
              echo $p_data['name'] . CSV_SEPARATOR;
              if (DISPLAY_MANUFACTURER) echo $p_data['manufacturer'] . CSV_SEPARATOR;
              echo $p_data['model'] . CSV_SEPARATOR;
              echo $p_data['base_price'] . CSV_SEPARATOR;
              echo $p_data['quantity'] . CSV_SEPARATOR;
              if ($display_tax) echo $p_data['tax'] . CSV_SEPARATOR;
              if (DISPLAY_ONE_TIME_FEES) echo $p_data['onetime_charges'] . CSV_SEPARATOR;
              if ($display_tax) echo $p_data['total'] . CSV_SEPARATOR;
              echo $p_data['grand'] . CSV_NEWLINE;
            }

//            echo CSV_NEWLINE;
// add kino
	}
// add kino
          break;
        }  //END switch ($this->detail_level)

      }  // END foreach ($this->timeframe as $id => $timeframe)

    }  // END function output_csv()

/*
** END OF CLASS
*/

  }
?>