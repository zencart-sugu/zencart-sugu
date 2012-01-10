<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Generates a pop-up window to edit    //
//  the selected order information, broken into         //
//  sections: contact, product, history, and total.     //
//////////////////////////////////////////////////////////
// $Id: super_edit.php 27 2006-02-03 20:06:12Z BlindSide $
*/

  //_TODO merge orders code
  // 1. Set orders_id in `orders_products`
  //                     `orders_products_attributes`
  //                     `orders_products_download`
  //                     `orders_status_history` (mark w/ original order #)
  // 2. Add a new "merged" status entry
  // 3. Recalc order total
  // 4. Remove merged order's entry in `orders` table

  // SO_TODO change payment method of an order

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');
  global $db;  

  $target = $_REQUEST['target'];  // 'contact', 'product', 'history', or 'total'
  $oID = (int)$_REQUEST['oID'];
  $order = new order($oID);

  // recreate the $order->products array, adding in some extra fields
  $index = 0;
  $orders_products = $db->Execute("select orders_products_id, products_name, products_model,
                                          products_price, products_tax, products_quantity,
                                          final_price, onetime_charges,
                                          product_is_free, products_id
                                   from " . TABLE_ORDERS_PRODUCTS . "
                                   where orders_id = '" . $oID . "'");

  while (!$orders_products->EOF) {
    // convert quantity to proper decimals - account history
    if (QUANTITY_DECIMALS != 0) {
      $fix_qty = $orders_products->fields['products_quantity'];
      switch (true) {
        case (!strstr($fix_qty, '.')):
          $new_qty = $fix_qty;
        break;
        default:
          $new_qty = preg_replace('/[0]+$/', '', $orders_products->fields['products_quantity']);
        break;
      }
    } else {
      $new_qty = $orders_products->fields['products_quantity'];
    }

    $new_qty = round($new_qty, QUANTITY_DECIMALS);

    if ($new_qty == (int)$new_qty) {
      $new_qty = (int)$new_qty;
    }

    $order->products[$index] = array('qty' => $new_qty,
                                     'name' => $orders_products->fields['products_name'],
                                     'products_id' => $orders_products->fields['products_id'],
                                     'model' => $orders_products->fields['products_model'],
                                     'tax' => $orders_products->fields['products_tax'],
                                     'price' => $orders_products->fields['products_price'],
                                     'onetime_charges' => $orders_products->fields['onetime_charges'],
                                     'final_price' => $orders_products->fields['final_price'],
                                     'product_is_free' => $orders_products->fields['product_is_free'],
                                     'orders_products_id' => $orders_products->fields['orders_products_id']);

    $subindex = 0;
    $attributes = $db->Execute("select products_options, products_options_values, options_values_price,
                                       price_prefix,
                                       product_attribute_is_free
                                from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
                                where orders_id = '" . $oID . "'
                                and orders_products_id = '" . (int)$orders_products->fields['orders_products_id'] . "'");
    if ($attributes->RecordCount()>0) {
      while (!$attributes->EOF) {
        $order->products[$index]['attributes'][$subindex] = array('option' => $attributes->fields['products_options'],
                                                                  'value' => $attributes->fields['products_options_values'],
                                                                  'prefix' => $attributes->fields['price_prefix'],
                                                                  'price' => $attributes->fields['options_values_price'],
                                                                  'product_attribute_is_free' => $attributes->fields['product_attribute_is_free']);

        $subindex++;
        $attributes->MoveNext();
      }
    }

    $index++;
    $orders_products->MoveNext();
  }  // END while (!$orders_products->EOF) {


  if ($_POST['process'] == 1) {
    $update = array();
    switch ($target) {
      case 'contact':

        // customer address data
        if ($_POST['customers_name'] != $order->customer['name']) {
          $update['customers_name'] = zen_db_scrub_in($_POST['customers_name'], true);
        }
        if ($_POST['customers_company'] != $order->customer['company']) {
          $update['customers_company'] = zen_db_scrub_in($_POST['customers_company'], true);
        }
        if ($_POST['customers_street_address'] != $order->customer['street_address']) {
          $update['customers_street_address'] = zen_db_scrub_in($_POST['customers_street_address'], true);
        }
        if ($_POST['customers_suburb'] != $order->customer['suburb']) {
          $update['customers_suburb'] = zen_db_scrub_in($_POST['customers_suburb'], true);
        }
        if ($_POST['customers_city'] != $order->customer['city']) {
          $update['customers_city'] = zen_db_scrub_in($_POST['customers_city'], true);
        }
        if ($_POST['customers_postcode'] != $order->customer['postcode']) {
          $update['customers_postcode'] = zen_db_scrub_in($_POST['customers_postcode'], true);
        }
        if ($_POST['customers_state'] != $order->customer['state']) {
          $update['customers_state'] = zen_db_scrub_in($_POST['customers_state'], true);
        }
        if ($_POST['customers_country'] != $order->customer['country']) {
          $update['customers_country'] = zen_db_scrub_in($_POST['customers_country'], true);
        }

        // delivery address data
        if ($_POST['delivery_name'] != $order->delivery['name']) {
          $update['delivery_name'] = zen_db_scrub_in($_POST['delivery_name'], true);
        }
        if ($_POST['delivery_company'] != $order->delivery['company']) {
          $update['delivery_company'] = zen_db_scrub_in($_POST['delivery_company'], true);
        }
        if ($_POST['delivery_street_address'] != $order->delivery['street_address']) {
          $update['delivery_street_address'] = zen_db_scrub_in($_POST['delivery_street_address'], true);
        }
        if ($_POST['delivery_suburb'] != $order->delivery['suburb']) {
          $update['delivery_suburb'] = zen_db_scrub_in($_POST['delivery_suburb'], true);
        }
        if ($_POST['delivery_city'] != $order->delivery['city']) {
          $update['delivery_city'] = zen_db_scrub_in($_POST['delivery_city'], true);
        }
        if ($_POST['delivery_postcode'] != $order->delivery['postcode']) {
          $update['delivery_postcode'] = zen_db_scrub_in($_POST['delivery_postcode'], true);
        }
        if ($_POST['delivery_state'] != $order->delivery['state']) {
          $update['delivery_state'] = zen_db_scrub_in($_POST['delivery_state'], true);
        }
        if ($_POST['delivery_country'] != $order->delivery['country']) {
          $update['delivery_country'] = zen_db_scrub_in($_POST['delivery_country'], true);
        }

        // billing address data
        if ($_POST['billing_name'] != $order->billing['name']) {
          $update['billing_name'] = zen_db_scrub_in($_POST['billing_name'], true);
        }
        if ($_POST['billing_company'] != $order->billing['company']) {
          $update['billing_company'] = zen_db_scrub_in($_POST['billing_company'], true);
        }
        if ($_POST['billing_street_address'] != $order->billing['street_address']) {
          $update['billing_street_address'] = zen_db_scrub_in($_POST['billing_street_address'], true);
        }
        if ($_POST['billing_suburb'] != $order->billing['suburb']) {
          $update['billing_suburb'] = zen_db_scrub_in($_POST['billing_suburb'], true);
        }
        if ($_POST['billing_city'] != $order->billing['city']) {
          $update['billing_city'] = zen_db_scrub_in($_POST['billing_city'], true);
        }
        if ($_POST['billing_postcode'] != $order->billing['postcode']) {
          $update['billing_postcode'] = zen_db_scrub_in($_POST['billing_postcode'], true);
        }
        if ($_POST['billing_state'] != $order->billing['state']) {
          $update['billing_state'] = zen_db_scrub_in($_POST['billing_state'], true);
        }
        if ($_POST['billing_country'] != $order->billing['country']) {
          $update['billing_country'] = zen_db_scrub_in($_POST['billing_country'], true);
        }

        // personal contact data
        if ($_POST['customers_telephone'] != $order->customer['telephone']) {
          $update['customers_telephone'] = zen_db_scrub_in($_POST['customers_telephone'], true);
        }
        if ($_POST['customers_email_address'] != $order->customer['email_address']) {
          $update['customers_email_address'] = zen_db_scrub_in($_POST['customers_email_address'], true);
        }

        // targetted customer
        if ($_POST['change_customer'] == 'on' && $_POST['customers_id'] != $order->customer['id']) {
          $update['customers_id'] = $_POST['customers_id'];
        }

        // confirm that there are changes to make to avoid a SQL error
        if (sizeof($update) >= 1) {
          zen_db_perform(TABLE_ORDERS, $update, 'update', "orders_id = '" . $oID . "'");
        }
      break;


      case 'product':
        require(DIR_WS_CLASSES . 'super_order.php');
        require(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();

        if (isset($_POST['split_products']) && zen_not_null($_POST['split_products'])) {
          // Duplicate order details from "orders" table
          $old_order = $db->Execute("SELECT * FROM " . TABLE_ORDERS. " WHERE orders_id = '" . $oID . "' LIMIT 1");
          $new_order = array('customers_id' => $old_order->fields['customers_id'],
                             'customers_name' => $old_order->fields['customers_name'],
                             'customers_company' => $old_order->fields['customers_company'],
                             'customers_street_address' => $old_order->fields['customers_street_address'],
                             'customers_suburb' => $old_order->fields['customers_suburb'],
                             'customers_city' => $old_order->fields['customers_city'],
                             'customers_postcode' => $old_order->fields['customers_postcode'],
                             'customers_state' => $old_order->fields['customers_state'],
                             'customers_country' => $old_order->fields['customers_country'],
                             'customers_telephone' => $old_order->fields['customers_telephone'],
                             'customers_email_address' => $old_order->fields['customers_email_address'],
                             'customers_address_format_id' => $old_order->fields['customers_address_format_id'],
                             'delivery_name' => $old_order->fields['delivery_name'],
                             'delivery_company' => $old_order->fields['delivery_company'],
                             'delivery_street_address' => $old_order->fields['delivery_street_address'],
                             'delivery_suburb' => $old_order->fields['delivery_suburb'],
                             'delivery_city' => $old_order->fields['delivery_city'],
                             'delivery_postcode' => $old_order->fields['delivery_postcode'],
                             'delivery_state' => $old_order->fields['delivery_state'],
                             'delivery_country' => $old_order->fields['delivery_country'],
                             'delivery_address_format_id' => $old_order->fields['delivery_address_format_id'],
                             'billing_name' => $old_order->fields['billing_name'],
                             'billing_company' => $old_order->fields['billing_company'],
                             'billing_street_address' => $old_order->fields['billing_street_address'],
                             'billing_suburb' => $old_order->fields['billing_suburb'],
                             'billing_city' => $old_order->fields['billing_city'],
                             'billing_postcode' => $old_order->fields['billing_postcode'],
                             'billing_state' => $old_order->fields['billing_state'],
                             'billing_country' => $old_order->fields['billing_country'],
                             'billing_address_format_id' => $old_order->fields['billing_address_format_id'],
                             'payment_method' => $old_order->fields['payment_method'],
                             'payment_module_code' => $old_order->fields['payment_module_code'],
                             'shipping_method' => $old_order->fields['shipping_method'],
                             'shipping_module_code' => $old_order->fields['shipping_module_code'],
                             'coupon_code' => $old_order->fields['coupon_code'],
                             'cc_type' => $old_order->fields['cc_type'],
                             'cc_owner' => $old_order->fields['cc_owner'],
                             'cc_number' => $old_order->fields['cc_number'],
                             'cc_expires' => $old_order->fields['cc_expires'],
                             'cc_cvv' => $old_order->fields['cc_cvv'],
                             'last_modified' => 'now()',
                             'date_purchased' => $old_order->fields['date_purchased'],
                             'orders_status' => $old_order->fields['orders_status'],                             
                             'currency' => $old_order->fields['currency'],
                             'currency_value' => $old_order->fields['currency_value'],
                             'order_total' => $old_order->fields['order_total'],
                             'order_tax' => $old_order->fields['order_tax']);
          zen_db_perform(TABLE_ORDERS, $new_order);

          // get new order ID to use with other split actions
          $new_order_id = mysql_insert_id();
          $messageStack->add_session('New order ID: ' . $new_order_id, 'warning');

          // update "orders_status_history" table
          $old_order_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = '" . $oID . "'");
          while (!$old_order_status_history->EOF) {
            $new_order_status_history = array('orders_id' => $new_order_id,
                                              'orders_status_id' => $old_order_status_history->fields['orders_status_id'],
                                              'date_added' => $old_order_status_history->fields['date_added'],
                                              'customer_notified' => $old_order_status_history->fields['customer_notified'],
                                              'comments' => $old_order_status_history->fields['comments']);

            zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $new_order_status_history);
            $old_order_status_history->MoveNext();
          }

          // update "orders_total" table
          $old_order_total = $db->Execute("SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE orders_id = '" . $oID . "'");
          while (!$old_order_total->EOF) {
            $new_order_total = array('orders_id' => $new_order_id,
                                     'title' => $old_order_total->fields['title'],
                                     'text' => $old_order_total->fields['text'],
                                     'value' => $old_order_total->fields['value'],
                                     'class' => $old_order_total->fields['class'],
                                     'sort_order' => $old_order_total->fields['sort_order']);

            zen_db_perform(TABLE_ORDERS_TOTAL, $new_order_total);
            $old_order_total->MoveNext();
          }

          // duplicate an existing Super Order payment data (if requested)
          //if (isset($_POST['copy_payments'])) {
          //SO_TODO split a credit card payment in half (if paid in full with a CC)
          if (false) {
            $so = new super_order($oID);
            if ($so->payment) {
              for ($i = 0; $i < sizeof($so->payment); $i++) {
                unset($old_payment, $new_payment);
                $old_payment = $so->payment[$i];
                $new_payment = array();

                $new_payment['orders_id'] = $new_order_id;
                $new_payment['payment_number'] = $old_payment['number'];
                $new_payment['payment_name'] = $old_payment['name'];
                $new_payment['payment_amount'] = $old_payment['amount'];
                $new_payment['payment_type'] = $old_payment['type'];
                $new_payment['date_posted'] = $old_payment['posted'];
                $new_payment['last_modified'] = $old_payment['modified'];

                zen_db_perform(TABLE_SO_PAYMENTS, $new_payment);
              }
            }

            if ($so->po_payment) {
              for ($i = 0; $i < sizeof($so->po_payment); $i++) {
                unset($old_payment, $new_payment);
                $old_payment = $so->po_payment[$i];
                $new_payment = array();

                $new_payment['orders_id'] = $new_order_id;
                $new_payment['payment_number'] = $old_payment['number'];
                $new_payment['payment_name'] = $old_payment['name'];
                $new_payment['payment_amount'] = $old_payment['amount'];
                $new_payment['payment_type'] = $old_payment['type'];
                $new_payment['date_posted'] = $old_payment['posted'];
                $new_payment['last_modified'] = $old_payment['modified'];
                $new_payment['purchase_order_id'] = $old_payment['assigned_po'];

                zen_db_perform(TABLE_SO_PAYMENTS, $new_payment);
              }
            }

            if ($so->purchase_order) {
              for ($i = 0; $i < sizeof($so->purchase_order); $i++) {
                unset($old_po, $new_po);
                $old_po = $so->purchase_order[$i];
                $new_po = array();

                $new_po['orders_id'] = $new_order_id;
                $new_po['po_number'] = $old_po['number'];
                $new_po['date_posted'] = $old_po['posted'];
                $new_po['last_modified'] = $old_po['modified'];

                zen_db_perform(TABLE_SO_PURCHASE_ORDERS, $new_po);
              }
            }

            if ($so->refund) {
              for ($i = 0; $i < sizeof($so->refund); $i++) {
                unset($old_refund, $new_refund);
                $old_refund = $so->refund[$i];
                $new_refund = array();

                $new_refund['orders_id'] = $new_order_id;
                $new_refund['payment_id'] = $old_refund['payment'];
                $new_refund['refund_number'] = $old_refund['number'];
                $new_refund['refund_name'] = $old_refund['name'];
                $new_refund['refund_amount'] = $old_refund['amount'];
                $new_refund['refund_type'] = $old_refund['type'];
                $new_refund['date_posted'] = $old_refund['posted'];
                $new_refund['last_modified'] = $old_refund['modified'];

                zen_db_perform(TABLE_SO_REFUNDS, $new_refund);
              }
            }
          }  // END if (isset($_POST['copy_payments']))

          // Reassign affected products to new order
          $split_products = $_POST['split_products'];
          foreach($split_products as $orders_products_id) {
            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");

            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");

            $db->Execute("UPDATE " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " SET
                          orders_id = '" . $new_order_id . "'
                          WHERE orders_products_id = '" . $orders_products_id . "'");
          }

          // recalculate totals on both orders
          recalc_total($oID);
          recalc_total($new_order_id);

          // add history comments to both orders reflecting the split
          $notify_split = (isset($_POST['notify_split']) ? 1 : 0);

          // entry for original order
          $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                       (orders_id, orders_status_id, date_added, customer_notified, comments)
                       VALUES ('" . $oID . "',
                       '" . $new_order['orders_status'] . "',
                       now(),
                       '" . $notify_split . "',
                       '" . COMMENTS_SPLIT_OLD . $new_order_id . "')");

          // entry for new order
          $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                       (orders_id, orders_status_id, date_added, customer_notified, comments)
                       VALUES ('" . $new_order_id . "',
                       '" . $new_order['orders_status'] . "',
                       now(),
                       '" . $notify_split . "',
                       '" . COMMENTS_SPLIT_NEW . $oID . "')");

          // notify customer (if selected)
          if ($notify_split) {
            email_latest_status($oID);
          }
        }  // END if (isset($_POST['split_products']) && zen_not_null($_POST['split_products']))
      break;


      case 'history':
        $update_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                               WHERE orders_id = '" . $oID . "'
                                               ORDER BY orders_status_history_id DESC");

        while (!$update_status_history->EOF) {
          $this_history_id = $update_status_history->fields['orders_status_history_id'];

          $this_status = $_POST['status_' . $this_history_id];
          $this_comments = zen_db_scrub_in($_POST['comments_' . $this_history_id]);
          $this_delete = $_POST['delete_' . $this_history_id];
          $change_exists = false;

          if ($this_delete == 1) {
            zen_db_delete(TABLE_ORDERS_STATUS_HISTORY, "orders_status_history_id = '" . $this_history_id . "'");
          }

          if ($this_status != $update_status_history->fields['orders_status_id']) {
            $update_history['orders_status_id'] = $this_status;
            $change_exists = true;
          }

          if ($this_comments != $update_status_history->fields['comments']) {
            $update_history['comments'] = $this_comments;
            $change_exists = true;
          }

          if ($change_exists) {
            zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $update_history, 'update', "orders_status_history_id  = '" . $this_history_id . "'");
          }

          $update_status_history->MoveNext();
        }

        // Re-query the orders_status_history table and reset the
        // current status and modify date in the orders table
        $update_status_history = $db->Execute("SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                               WHERE orders_id = '" . $oID . "'
                                               ORDER BY orders_status_history_id DESC limit 1");

        $tbl_orders_history['orders_status'] = $update_status_history->fields['orders_status_id'];
        $tbl_orders_history['last_modified'] = $update_status_history->fields['date_added'];
        zen_db_perform(TABLE_ORDERS, $tbl_orders_history, 'update', "orders_id = '" . $oID . "'");
      break;


      case 'total':
        require(DIR_WS_CLASSES . 'currencies.php');
        $currencies = new currencies();

        $update_totals = $_POST['update_totals'];
        $running_total = 0;
        $sort_order = 0;

        foreach($update_totals as $total_index => $total_details) {
          extract($total_details, EXTR_PREFIX_ALL, "ot");

          if (trim($ot_title) && trim($ot_value)) {
            $sort_order++;

            // add values to running_total
            if($ot_class == "ot_subtotal") {
              $running_total += $ot_value;
            }

            elseif($ot_class == "ot_tax") {
              $running_total += $ot_value;
            }

            elseif($ot_class == "ot_gv" || $ot_class == "ot_coupon" || $ot_class == "ot_group_pricing") {
              $running_total -= $ot_value;
            }

            elseif($ot_class == "ot_total") {
              $ot_value = $running_total;
              $db->Execute("update " . TABLE_ORDERS . " set
                            order_total = '" . $ot_value . "'
                            where orders_id = '" . $oID . "'");
            }

            elseif($ot_class == "ot_add_point") {
              ;  // do NOT add to running_total
            }

            else {
              $running_total += $ot_value;
            }

            // format the text version of the amount
            if ($ot_class == "ot_gv" || $ot_class == "ot_coupon" || $ot_class == "ot_group_pricing") {
              $ot_text = "-" . $currencies->format($ot_value);
            }

            elseif($ot_class == "ot_add_point") {
              $ot_text = $ot_value . MODULE_POINT_BASE_POINT_SYMBOL;
            }

            else {
              $ot_text = $currencies->format($ot_value);
            }

            if($ot_total_id > 0) {
              $query = "UPDATE " . TABLE_ORDERS_TOTAL . " SET
                        title = '" . $ot_title . "',
                        text = '" . $ot_text . "',
                        value = '" . $ot_value . "',
                        sort_order = '" . $sort_order . "'
                        WHERE orders_total_id = '" . $ot_total_id . "'";
              $db->Execute($query);
            }
            else {
              $query = "INSERT INTO " . TABLE_ORDERS_TOTAL . " SET
                        orders_id = '" . $oID . "',
                        title = '" . $ot_title . "',
                        text = '" . $ot_text . "',
                        value = '" . $ot_value . "',
                        class = '" . $ot_class . "',
                        sort_order = '" . $sort_order . "'";
              $db->Execute($query);
            }

          }
          
          // an empty line means the value should be deleted
          elseif($ot_total_id > 0) {
            zen_db_delete(TABLE_ORDERS_TOTAL, "orders_total_id = '" . $ot_total_id . "'");
          }

        }
      break;
    }  // END switch ($target)
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php echo REDIRECT; ?></title>
<script language="JavaScript" type="text/javascript">
  <!--
  function returnParent() {
    window.opener.location.reload(true);
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="returnParent()">
</body>
</html>
<?php
  }  // END if ($_POST['process'] == 1)
  else {
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="JavaScript" type="text/javascript">
  <!--
  function closePopup() {
    window.opener.focus();
    self.close();
  }
  //-->
</script>
</head>
<!-- header_eof //-->
<body onload="self.focus()">
<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>
<!-- body_text //-->
  <td align="center"><table border="0" cellspacing="0" cellpadding="2">
<?php
  $usessl = ($request_type == 'SSL');
  if($ussessl){
     $usessl = (ENABLE_SSL_ADMIN == 'true');
  }
  echo '    ' . zen_draw_form('edit', FILENAME_SUPER_EDIT, '', 'post', '', $usessl) . NL;
  echo '      ' . zen_draw_hidden_field('target', $target) . NL;
  echo '      ' . zen_draw_hidden_field('process', 1) . NL;
  echo '      ' . zen_draw_hidden_field('oID', $oID) . NL;
?>
<?php
  switch ($target) {
    case 'contact':
      $customers_sql = $db->Execute("select customers_id, customers_email_address, customers_firstname, customers_lastname
                                     from " . TABLE_CUSTOMERS . "
                                     order by customers_lastname, customers_firstname, customers_email_address");
      while(!$customers_sql->EOF) {
        $customers[] = array('id' => $customers_sql->fields['customers_id'],
                             'text' => $customers_sql->fields['customers_lastname'] . ', ' . $customers_sql->fields['customers_firstname'] . ' (' . $customers_sql->fields['customers_email_address'] . ')');

        $customer_array[$customers_sql->fields['customers_id']] = $customers_sql->fields['customers_firstname'] . ' ' . $customers_sql->fields['customers_lastname'];
        $customers_sql->MoveNext();
      }
?>
    <tr>
      <td colspan="3" align="center" class="pageHeading"><?php echo HEADER_EDIT_ORDER . $oID; ?></td>
    </tr>
    <tr>
      <td colspan="3" align="center" class="main"><strong><?php echo HEADER_EDIT_CONTACT; ?></strong></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Contact Block -->
    <tr>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main">&nbsp;</td>
          <td class="main"><strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_NAME; ?></td>
          <td class="main"><input name="customers_name" size="25" value="<?php echo zen_db_scrub_out($order->customer['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_COMPANY; ?></td>
          <td class="main"><input name="customers_company" size="25" value="<?php echo zen_db_scrub_out($order->customer['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_ADDRESS; ?></td>
          <td class="main"><input name="customers_street_address" size="25" value="<?php echo zen_db_scrub_out($order->customer['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_SUBURB; ?></td>
          <td class="main"><input name="customers_suburb" size="25" value="<?php echo zen_db_scrub_out($order->customer['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_CITY; ?></td>
          <td class="main"><input name="customers_city" size="25" value="<?php echo zen_db_scrub_out($order->customer['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_STATE; ?></td>
          <td class="main"><input name="customers_state" size="25" value="<?php echo zen_db_scrub_out($order->customer['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_POSTCODE; ?></td>
          <td class="main"><input name="customers_postcode" size="25" value="<?php echo zen_db_scrub_out($order->customer['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
          <td class="main"><input name="customers_country" size="25" value="<?php echo zen_db_scrub_out($order->customer['country'], true); ?>"></td>
        </tr>
      </table></td>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_name" size="25" value="<?php echo zen_db_scrub_out($order->billing['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_company" size="25" value="<?php echo zen_db_scrub_out($order->billing['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_street_address" size="25" value="<?php echo zen_db_scrub_out($order->billing['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_suburb" size="25" value="<?php echo zen_db_scrub_out($order->billing['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_city" size="25" value="<?php echo zen_db_scrub_out($order->billing['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_state" size="25" value="<?php echo zen_db_scrub_out($order->billing['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_postcode" size="25" value="<?php echo zen_db_scrub_out($order->billing['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="billing_country" size="25" value="<?php echo zen_db_scrub_out($order->billing['country'], true); ?>"></td>
        </tr>
      </table></td>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_name" size="25" value="<?php echo zen_db_scrub_out($order->delivery['name'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_company" size="25" value="<?php echo zen_db_scrub_out($order->delivery['company'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_street_address" size="25" value="<?php echo zen_db_scrub_out($order->delivery['street_address'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_suburb" size="25" value="<?php echo zen_db_scrub_out($order->delivery['suburb'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_city" size="25" value="<?php echo zen_db_scrub_out($order->delivery['city'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_state" size="25" value="<?php echo zen_db_scrub_out($order->delivery['state'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_postcode" size="25" value="<?php echo zen_db_scrub_out($order->delivery['postcode'], true); ?>"></td>
        </tr>
        <tr>
          <td class="main"><input name="delivery_country" size="25" value="<?php echo zen_db_scrub_out($order->delivery['country'], true); ?>"></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
    </tr>
    <tr>
      <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo ENTRY_TELEPHONE_NUMBER; ?></strong></td>
          <td class="main"><input name='customers_telephone' size="15" value="<?php echo $order->customer['telephone']; ?>"></td>
        </tr>
        <tr>
          <td class="main"><strong><?php echo ENTRY_EMAIL_ADDRESS; ?></strong></td>
          <td class="main"><input name='customers_email_address' size="35" value="<?php echo $order->customer['email_address']; ?>"></td>
        </tr>
      </table</td>
    </tr>
    <tr>
      <td colspan="3"><table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><strong><?php echo zen_draw_checkbox_field('change_customer', 'on', false) . ENTRY_CHANGE_CUSTOMER; ?></strong></td>
        </tr>
        <tr>
          <td class="main"><?php echo zen_draw_pull_down_menu('customers_id', $customers, $order->customer['id']); ?></td>
        </tr>
      </table></td>
    </tr>
<!-- End Contact Block -->
<?php
    break;


    case 'product':
      require(DIR_WS_CLASSES . 'currencies.php');
      $currencies = new currencies();

      // next available order number
      $nextID = $db->Execute("SELECT (orders_id + 1) AS nextID FROM " . TABLE_ORDERS . " ORDER BY orders_id DESC LIMIT 1");
      $nextID = $nextID->fields['nextID'];
?>
<!-- Begin Products Listing Block -->
    <tr>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr class="dataTableHeadingRow">
          <?php if (sizeof($order->products) > 1) { ?>
          <td class="dataTableHeadingContent">&nbsp;</td>
          <?php } ?>
          <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
          <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
          <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
        </tr>
<?php
    for ($i = 0; $i < sizeof($order->products); $i++) {
      $orders_products_id = $order->products[$i]['orders_products_id'];
      echo '        <tr class="dataTableRow">' . NL;
      if (sizeof($order->products) > 1) {
        echo '          <td class="dataTableContent" valign="top" align="center">' . zen_draw_checkbox_field('split_products[' . $i . ']', $orders_products_id) . NL;
      }
      echo '          <td class="dataTableContent" valign="middle" align="left">' . $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          if ($order->products[$i]['attributes'][$j]['product_attribute_is_free'] == '1' and $order->products[$i]['product_is_free'] == '1') echo TEXT_INFO_ATTRIBUTE_FREE;
          echo '</i></small></nobr>';
        }
      }

      echo '          </td>' . NL .
           '          <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle">' . zen_display_tax_value($order->products[$i]['tax']) . '%</td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL .
           '          <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . NL;
      echo '        </tr>' . NL;
    }
?>
        <tr>
          <td valign="middle"><?php echo zen_draw_checkbox_field('notify_split', 1); ?></td>
          <td valign="middle" class="smallText"><?php
            echo ENTRY_NOTIFY_CUSTOMER . '<br />';
            echo TEXT_SPLIT_EXPLAIN . '<strong>' . $nextID . '</strong>';
          ?></td>
        </tr>
      </table></td>
    </tr>
<!-- End Products Listings Block -->
<?php
    break;


    case 'history':
      $orders_statuses = array();
      $status_query = $db->Execute("select orders_status_id, orders_status_name
                                    from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$_SESSION['languages_id'] . "'");
      while (!$status_query->EOF) {
        $orders_statuses[] = array('id' => $status_query->fields['orders_status_id'],
                                   'text' => $status_query->fields['orders_status_name']);
        $status_query->MoveNext();
      }
?>
    <tr>
      <td align="center" class="pageHeading"><?php echo HEADER_EDIT_ORDER . $oID; ?></td>
    </tr>
    <tr>
      <td align="center" class="main"><strong><?php echo HEADER_EDIT_HISTORY; ?></strong></td>
    </tr>
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Order Status History -->
    <tr>
      <td align="center"><table border="1" cellspacing="0" cellpadding="5">
        <tr>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DELETE_COMMENTS; ?></strong></td>
        </tr>
<?php
    $orders_history = $db->Execute("select * from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by orders_status_history_id asc");
    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF){
        echo '        <tr>' . NL .
             '          <td class="smallText" align="center">' . zen_datetime_short($orders_history->fields['date_added']) . '</td>' . NL;

        $status_id = 'status_' . $orders_history->fields['orders_status_history_id'];
        $status_default = $orders_history->fields['orders_status_id'];
        $comments_id  = 'comments_' . $orders_history->fields['orders_status_history_id'];
        $comments_default = zen_db_scrub_out($orders_history->fields['comments']);
        $delete_id = 'delete_' . $orders_history->fields['orders_status_history_id'];

        echo '          <td>' . zen_draw_pull_down_menu($status_id, $orders_statuses, $status_default) . '</td>' . NL;
        echo '          <td>' . zen_draw_textarea_field($comments_id, 'soft', '30', '2', $comments_default) . '</td>' . NL;
        echo '          <td align="center">' . zen_draw_checkbox_field($delete_id, 1) . '</td>' . NL;
        echo '        </tr>' . NL;

        $orders_history->MoveNext();
      }
    } else {
        echo '          <tr>' . NL .
             '            <td class="smallText" colspan="4">' . TEXT_NO_ORDER_HISTORY . '</td>' . NL .
             '          </tr>' . NL;
    }
?>
      </table></td>
    </tr>
<!-- End Order Status History -->
<?php
    break;


    case 'total':
      require(DIR_WS_CLASSES . 'currencies.php');
      $currencies = new currencies();
?>
    <tr>
      <td colspan="2" align="center" class="pageHeading"><?php echo HEADER_EDIT_ORDER . $oID; ?></td>
    </tr>
    <tr>
      <td colspan="2" align="center" class="main"><strong><?php echo HEADER_EDIT_TOTAL; ?></strong></td>
    </tr>
    <tr>
      <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
    </tr>
<!-- Begin Order Total Block -->
<?php
      $TotalArray = array();
      $totals_query = $db->Execute("select * from " . TABLE_ORDERS_TOTAL . "
                                    where orders_id = '" . $oID . "' order by sort_order");
      while (!$totals_query->EOF) {
        $TotalArray[] = array("Name" => $totals_query->fields['title'],
                              "Price" => number_format($totals_query->fields['value'], 2, '.', ''),
                              "Class" => $totals_query->fields['class'],
                              "TotalID" => $totals_query->fields['orders_total_id']);

        if ($totals_query->fields['class'] == 'ot_subtotal') {
          // This blank entry allows for entering a special order adjustment
          $TotalArray[] = array("Name" => "",
                                "Price" => "",
                                "Class" => "ot_custom",
                                "TotalID" => "0");
        }
        $totals_query->MoveNext();
      }

      foreach ($TotalArray as $TotalIndex => $TotalData) {
        if($TotalData["Class"] == "ot_subtotal" || $TotalData["Class"] == "ot_total") {
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][title]', trim($TotalData["Name"])) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][value]', $TotalData["Price"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][class]', $TotalData["Class"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][total_id]', $TotalData["TotalID"]) . NL;
?>
    <tr>
      <td class="main" align="right"><strong><?php echo $TotalData["Name"]; ?></strong></td>
      <td class="main" align="right"><strong><?php echo $currencies->format($TotalData["Price"]); ?></strong></td>
    </tr>
<?php
        }
        else {
          if ($TotalData["Class"] == 'ot_shipping') {
            $format_shipping = explode(" (", $TotalData["Name"], 2);
            $clean_shipping = rtrim($format_shipping[0], ":");
            $display_title = $clean_shipping . ':';
          }
          else {
            $display_title = $TotalData["Name"];
          }
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][class]', $TotalData["Class"]) . NL;
          echo '    ' . zen_draw_hidden_field('update_totals[' . $TotalIndex . '][total_id]', $TotalData["TotalID"]) . NL;
?>
    <tr>
      <td align="right" class="main"><?php echo zen_draw_input_field('update_totals[' . $TotalIndex . '][title]', trim($display_title)); ?></td>
      <td align="right" class="main"><?php echo zen_draw_input_field('update_totals[' . $TotalIndex . '][value]', $TotalData["Price"], 'style="text-align:right"'); ?></td>
    </tr>
<?php
        }
      }  // END foreach
?>
<!-- End Order Total Block -->
<?php
    break;

  }  // END switch ($target)
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
      </tr>
      <tr>
        <td class="main" colspan="3" align="right">
        <?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE , 'onclick="return check_form()"'); ?>
        <?php echo zen_image_submit('button_cancel.gif', IMAGE_CANCEL , 'onclick="closePopup()"'); ?>
        </td>
      </tr>
      </form>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
</body>
</html>
<?php
  }  // END else
?>
