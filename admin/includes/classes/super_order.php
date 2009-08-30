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
//  DESCRIPTION:   Class file that manages inserting,   //
//  modifying, removing, and displaying payment data.   //
//////////////////////////////////////////////////////////
// $Id: super_order.php 27 2006-02-03 20:06:12Z BlindSide $
*/

//_TODO modify update functions to allow updates to specific (index) or all (orders_id)

class super_order {
  var $payment, $purchase_order, $po_payment, $refund, $payment_key, $payment_key_array;
  var $oID, $cID, $order_total, $amount_applied, $balance_due, $status, $status_date;

  // instantiates the class and gathers existing data
  function super_order($orders_id) {
    $this->payment = array();
    $this->purchase_order = array();
    $this->po_payment = array();
    $this->refund = array();
    $this->payment_key = array();
    $this->payment_key_array = array();

    $this->oID = (int)$orders_id;   // now you have the order_id whenever you need it
    $this->start();
  }


  function start() {
    global $db;

    // scrape some useful info from the record in the orders table
    $order_query = $db->Execute("select * from " . TABLE_ORDERS . " where orders_id = '" . $this->oID . "'");
    $this->cID = $order_query->fields['customers_id'];
    $this->order_total = $order_query->fields['order_total'];

    if (zen_not_null($order_query->fields['date_cancelled']) ) {
      $this->status_date = $order_query->fields['date_cancelled'];
      $this->status = "cancelled";
    }
    elseif (zen_not_null($order_query->fields['date_completed']) ) {
      $this->status_date = $order_query->fields['date_completed'];
      $this->status = "completed";
    }
    else {
      $this->status_date = false;
      $this->status = false;
    }

    // build an array to translate the payment_type codes stored in so_payments
    $payment_key_query = $db->Execute("select * from " . TABLE_SO_PAYMENT_TYPES . "
                                       where language_id = '" . $_SESSION['languages_id'] . "'
                                       order by payment_type_full asc");
    while(!$payment_key_query->EOF) {
      // this array is used by the full_type() function
      $this->payment_key_array[$payment_key_query->fields['payment_type_code']] = $payment_key_query->fields['payment_type_full'];

      // and this one can be used to build dropdown menus
      $this->payment_key[] = array('id' => $payment_key_query->fields['payment_type_code'],
                                   'text' => $payment_key_query->fields['payment_type_full']);
      $payment_key_query->MoveNext();
    }

    // get all payments not tied to a purchase order
    $payments_query = $db->Execute("select * from " . TABLE_SO_PAYMENTS . "
                                    where orders_id = '" . $this->oID . "'
                                    and purchase_order_id = 0
                                    order by date_posted asc");

    if (zen_not_null($payments_query->fields['orders_id'])) {
      while (!$payments_query->EOF) {
        $this->payment[] = array('index' => $payments_query->fields['payment_id'],
                                 'number' => $payments_query->fields['payment_number'],
                                 'name' => $payments_query->fields['payment_name'],
                                 'amount' => $payments_query->fields['payment_amount'],
                                 'type' => $payments_query->fields['payment_type'],
                                 'posted' => $payments_query->fields['date_posted'],
                                 'modified' => $payments_query->fields['last_modified']);
        $payments_query->MoveNext();
      }
    }
    else {
      unset($this->payment);
      $this->payment = false;
    }

    // get all the purchase orders for this order
    $purchase_order_query = $db->Execute("select * from " . TABLE_SO_PURCHASE_ORDERS . "
                                          where orders_id = '" . $this->oID . "'
                                          order by date_posted asc");

    if (zen_not_null($purchase_order_query->fields['orders_id'])) {
      while (!$purchase_order_query->EOF) {
        $this->purchase_order[] = array('index' => $purchase_order_query->fields['purchase_order_id'],
                                        'number' => $purchase_order_query->fields['po_number'],
                                        'posted' => $purchase_order_query->fields['date_posted'],
                                        'modified' => $purchase_order_query->fields['last_modified']);

        $purchase_order_query->MoveNext();
      }
    }
    else {
      unset($this->purchase_order);
      $this->purchase_order = false;
    }

    // get any payments that are tied to a purchase order
    if($this->purchase_order) {    // need a po before you can have po payments
      for($i = 0; $i < sizeof($this->purchase_order); $i++) {
        $this_po_id = $this->purchase_order[$i]['index'];

        $po_payments_query = $db->Execute("select * from " . TABLE_SO_PAYMENTS . "
                                          where purchase_order_id = '" . $this_po_id . "'
                                          order by date_posted asc");

        if (zen_not_null($po_payments_query->fields['orders_id'])) {
          while (!$po_payments_query->EOF) {
            $this->po_payment[] = array('index' => $po_payments_query->fields['payment_id'],
                                        'assigned_po' => $this_po_id,
                                        'number' => $po_payments_query->fields['payment_number'],
                                        'name' => $po_payments_query->fields['payment_name'],
                                        'amount' => $po_payments_query->fields['payment_amount'],
                                        'type' => $po_payments_query->fields['payment_type'],
                                        'posted' => $po_payments_query->fields['date_posted'],
                                        'modified' => $po_payments_query->fields['last_modified']);
            $po_payments_query->MoveNext();
          }
        }
      }

      if (sizeof($this->po_payment) < 1) {
        unset($this->po_payment);
        $this->po_payment = false;
      }

    }

    // get any refunds
    if($this->payment || $this->po_payment) {   // gotta have payments in order to refund them
      $refunds_query = $db->Execute("select * from " . TABLE_SO_REFUNDS . "
                                     where orders_id = '" . $this->oID . "'
                                     order by date_posted asc");

      if (zen_not_null($refunds_query->fields['orders_id'])) {
        while (!$refunds_query->EOF) {
          $this->refund[] = array('index' => $refunds_query->fields['refund_id'],
                                  'payment' => $refunds_query->fields['payment_id'],
                                  'number' => $refunds_query->fields['refund_number'],
                                  'name' => $refunds_query->fields['refund_name'],
                                  'amount' => $refunds_query->fields['refund_amount'],
                                  'type' => $refunds_query->fields['refund_type'],
                                  'posted' => $refunds_query->fields['date_posted'],
                                  'modified' => $refunds_query->fields['last_modified']);
          $refunds_query->MoveNext();
        }
      }
      else {
        unset($this->refund);
        $this->refund = false;
      }
    }

    // calculate and store the order total, amount applied, & balance due for the order

    // add individual payments if they exists
    if($this->payment) {
      for($i = 0; $i < sizeof($this->payment); $i++) {
        $this->amount_applied += $this->payment[$i]['amount'];
      }
    }

    // next add the po payments if they exist
    if ($this->po_payment) {
      for($i = 0; $i < sizeof($this->po_payment); $i++) {
        $this->amount_applied += $this->po_payment[$i]['amount'];
      }
    }

    // now subtract out any refunds if they exist
    if($this->refund) {
      for($i = 0; $i < sizeof($this->refund); $i++) {
        $this->amount_applied -= $this->refund[$i]['amount'];
      }
    }

    // subtract from the order total to get the balance due
    $this->balance_due = $this->order_total - $this->amount_applied;

    // compare this balance to the one stored in the orders table, update if necessary
    if ($this->balance_due != $order_query->fields['balance_due']) $this->new_balance();

  }   // END function start


  // input the current value of $this->balance_due into balance_due
  // field in the orders table
  function new_balance() {
    $a['balance_due'] = $this->balance_due;
    zen_db_perform(TABLE_ORDERS, $a, 'update', 'orders_id = ' . $this->oID);
  }


  // timestamp the date_completed field in orders table
  // will also NULL out date_cancelled field if set (you can't have both at once!)
  function mark_completed() {
    global $db;
    if ($this->status == false || $this->status == "cancelled") {
      $db->Execute("UPDATE " . TABLE_ORDERS . " SET date_completed = now() WHERE orders_id = '" . $this->oID . "'");

      if ($this->status == "cancelled") {
        $db->Execute("UPDATE " . TABLE_ORDERS . " SET date_cancelled = NULL WHERE orders_id = '" . $this->oID . "'");
      }
      if (STATUS_ORDER_COMPLETED != 0) {
        update_status($this->oID, STATUS_ORDER_COMPLETED);
      }
      $this->status = "completed";
      $this->status_date = zen_datetime_short(date('Y-m-d H:i:s'));
    }
  }


  // timestamp the date_cancelled field in orders table
  // will also NULL out date_completed field if set (you can't have both at once!)
  function mark_cancelled() {
    global $db;
    if ($this->status == false || $this->status == "completed") {
      $db->Execute("UPDATE " . TABLE_ORDERS . " SET date_cancelled = now() WHERE orders_id = '" . $this->oID . "'");

      if ($this->status == "completed") {
        $db->Execute("UPDATE " . TABLE_ORDERS . " SET date_completed = NULL WHERE orders_id = '" . $this->oID . "'");
      }
      if (STATUS_ORDER_CANCELLED != 0) {
        update_status($this->oID, STATUS_ORDER_CANCELLED);
      }
      $this->status = "cancelled";
      $this->status_date = zen_datetime_short(date('Y-m-d H:i:s'));
    }
  }


  // removes the cancelled/completed timestamp
  function reopen() {
    global $db;
    $db->Execute("update " . TABLE_ORDERS . " set
                  date_completed = NULL, date_cancelled = NULL
                  where orders_id = '" . $this->oID . "' limit 1");

    if (STATUS_ORDER_REOPEN != 0) {
      update_status($this->oID, STATUS_ORDER_REOPEN);
    }
    $this->status = false;
    $this->status_date = false;
  }


  // recreate credit card information stored in orders table as a line item in SO payment system
  function cc_line_item() {
    global $db;
    $cc_data = $db->Execute("select cc_type, cc_owner, cc_number, cc_expires, cc_cvv, date_purchased, order_total
                             from " . TABLE_ORDERS . " where orders_id = '" . $this->oID . "' limit 1");

    // convert CC type to match shorthand type in SO payemnt system
    // add your own CC types here to match
    $cc_type_key = array('Master Card' => 'MC',
                         'Visa' => 'VISA',
                         'American Express' => 'AMEX',
                         'Discover' => 'DISC');

    $payment_type = $cc_type_key[$cc_data->fields['cc_type']];

    $new_cc_payment = array('orders_id' => $this->oID,
                            'payment_number' => $cc_data->fields['cc_number'],
                            'payment_name' => $cc_data->fields['cc_owner'],
                            'payment_amount' => $cc_data->fields['order_total'],
                            'payment_type' => $payment_type,
                            'date_posted' => $cc_data->fields['date_purchased'],
                            'last_modified' => $cc_data->fields['date_purchased']);

    zen_db_perform(TABLE_SO_PAYMENTS, $new_cc_payment);
  }


  // builds an array of all PO's attached to an order, suitable for a dropdown menu
  function build_po_array($include_blank = false) {
    global $db;
    $po_array = array();

    // include a user-defined "empty" entry
    if ($include_blank) {
      $po_array[] = array('id' => false,
                          'text' => $include_blank);
    }

    $po_query = $db->Execute("select purchase_order_id, po_number from " . TABLE_SO_PURCHASE_ORDERS . " where orders_id = '" . $this->oID . "'");

    while(!$po_query->EOF) {
      $po_array[] = array('id' => $po_query->fields['purchase_order_id'],
                          'text' => $po_query->fields['po_number']);
      $po_query->MoveNext();
    }

    return $po_array;
  }



  // builds an array of all payments attached to an order, suitable for a dropdown menu
  function build_payment_array($include_blank = false) {
    global $db;
    $payment_array = array();

    // include a user-defined "empty" entry if requested
    if ($include_blank) {
      $payment_array[] = array('id' => false,
                               'text' => $include_blank);
    }

    $payment_query = $db->Execute("select payment_id, payment_number from " . TABLE_SO_PAYMENTS . " where orders_id = '" . $this->oID . "'");

    while(!$payment_query->EOF) {
      $payment_array[] = array('id' => $payment_query->fields['payment_id'],
                               'text' => $payment_query->fields['payment_number']);
      $payment_query->MoveNext();
    }

    return $payment_array;
  }



  // Displays a button that will open a popup window to enter a new payment entry
  // This code assumes you have the popupWindow() function defined in your header!
  // Valid $payment_mode entries are: 'payment', 'purchase_order', 'refund'
  function button_add($payment_mode) {
    echo '&nbsp;<a href="javascript:popupWindow(\'' .
    zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $this->oID . '&payment_mode=' . $payment_mode . '&action=add', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')">' .
    zen_image_button('btn_' . $payment_mode . '.gif', sprintf(ALT_TEXT_ADD, str_replace('_', ' ', $payment_mode))) . '</a>';
  }



  // Displays a button that will open a popup window to update an existing payment entry
  // This code assumes you have the popupWindow() function defined in your header!
  // Valid $payment_mode entries are: 'payment', 'purchase_order', 'refund'
  function button_update($payment_mode, $index) {
    echo '&nbsp;<a href="javascript:popupWindow(\'' .
    zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $this->oID . '&payment_mode=' . $payment_mode . '&index=' . $index . '&action=update', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')">' .
    zen_image_button('btn_modify.gif', sprintf(ALT_TEXT_UPDATE, str_replace('_', ' ', $payment_mode))) . '</a>';
  }



  // Displays a button that will open a popup window to confirm deleting a payment entry
  // This code assumes you have the popupWindow() function defined in your header!
  // Valid $payment_mode entries are: 'payment', 'purchase_order', 'refund'
  function button_delete($payment_mode, $index) {
    echo '&nbsp;<a href="javascript:popupWindow(\'' .
    zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $this->oID . '&payment_mode=' . $payment_mode . '&index=' . $index . '&action=delete', 'NONSSL') . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')">' .
    zen_image_button('btn_remove.gif', sprintf(ALT_TEXT_DELETE, str_replace('_', ' ', $payment_mode))) . '</a>';
  }



  function add_payment($payment_number, $payment_name, $payment_amount, $payment_type, $purchase_order_id = false) {

    $new_payment = array('orders_id' => $this->oID,
                         'payment_number' => zen_db_prepare_input($payment_number),
                         'payment_name' => zen_db_prepare_input($payment_name),
                         'payment_amount' => zen_db_prepare_input($payment_amount),
                         'payment_type' => zen_db_prepare_input($payment_type),
                         'date_posted' => 'now()',
                         'last_modified' => 'now()');

    // link the payment to its P.O. if applicable
    if ($purchase_order_id) {
      $new_payment['purchase_order_id'] = (int)$purchase_order_id;
    }

    zen_db_perform(TABLE_SO_PAYMENTS, $new_payment);

    $new_index = mysql_insert_id();
    return $new_index;
  }



  function update_payment($payment_id, $purchase_order_id = false, $payment_number = false, $payment_name = false, $payment_amount = false, $payment_type = false, $orders_id = false) {
    $update_payment = array();
    $update_payment['last_modified'] = 'now()';

    if ($orders_id && $orders_id != '') {
      $update_payment['orders_id'] = (int)$orders_id;
    }
    if ($payment_number && $payment_number != '') {
      $update_payment['payment_number'] = zen_db_prepare_input($payment_number);
    }
    if ($payment_name && $payment_name != '') {
      $update_payment['payment_name'] = zen_db_prepare_input($payment_name);
    }
    if ($payment_amount && $payment_amount != '') {
      $update_payment['payment_amount'] = zen_db_prepare_input($payment_amount);
    }
    if ($payment_type && $payment_type != '') {
      $update_payment['payment_type'] = zen_db_prepare_input($payment_type);
    }
    if (is_numeric($purchase_order_id)) {
      $update_payment['purchase_order_id'] = (int)$purchase_order_id;
    }

    zen_db_perform(TABLE_SO_PAYMENTS, $update_payment, 'update', "payment_id = '" . $payment_id . "'");
  }



  function add_purchase_order($po_number) {

    $add_po = array('po_number' => zen_db_prepare_input($po_number),
                    'orders_id' => $this->oID,
                    'date_posted' => 'now()',
                    'last_modified' => 'now()');

    zen_db_perform(TABLE_SO_PURCHASE_ORDERS, $add_po);

    $new_index = mysql_insert_id();
    return $new_index;
  }



  function update_purchase_order($purchase_order_id, $po_number = false, $orders_id = false) {
    $update_po = array();
    $update_po['last_modified'] = 'now()';

    if ($orders_id && $orders_id != '') {
      $update_po['orders_id'] = zen_db_prepare_input($orders_id);
    }
    if ($po_number && $po_number != '') {
      $update_po['po_number'] = zen_db_prepare_input($po_number);
    }

     zen_db_perform(TABLE_SO_PURCHASE_ORDERS, $update_po, 'update', "purchase_order_id = '" . $purchase_order_id . "'");
  }



  function add_refund($payment_id, $refund_number, $refund_name, $refund_amount, $refund_type) {

    $new_refund = array('payment_id' => (int)$payment_id,
                        'orders_id' => $this->oID,
                        'refund_number' => zen_db_prepare_input($refund_number),
                        'refund_name' => zen_db_prepare_input($refund_name),
                        'refund_amount' => zen_db_prepare_input($refund_amount),
                        'refund_type' => zen_db_prepare_input($refund_type),
                        'date_posted' => 'now()',
                        'last_modified' => 'now()');

    zen_db_perform(TABLE_SO_REFUNDS, $new_refund);

    $new_index = mysql_insert_id();
    return $new_index;
  }



  function update_refund($refund_id, $payment_id = false, $refund_number = false, $refund_name = false, $refund_amount = false, $refund_type = false, $orders_id = false) {
    $update_refund = array();
    $update_refund['last_modified'] = 'now()';

    if (is_numeric($payment_id)) {
      $update_refund['payment_id'] = (int)$payment_id;
    }
    if ($refund_number && $refund_number != '') {
      $update_refund['refund_number'] = zen_db_prepare_input($refund_number);
    }
    if ($refund_name && $refund_name != '') {
      $update_refund['refund_name'] = zen_db_prepare_input($refund_name);
    }
    if ($refund_amount && $refund_amount != '') {
      $update_refund['refund_amount'] = zen_db_prepare_input($refund_amount);
    }
    if ($refund_type && $refund_type != '') {
      $update_refund['refund_type'] = zen_db_prepare_input($refund_type);
    }
    if ($orders_id && $orders_id != '') {
      $update_refund['orders_id'] = (int)$orders_id;
    }

    zen_db_perform(TABLE_SO_REFUNDS, $update_refund, 'update', "refund_id = '" . $refund_id . "'");
  }



  function delete_refund($refund_id, $payment_id = false, $all = false) {
    global $db;
    $db->Execute("delete from " . TABLE_SO_REFUNDS . " where refund_id = '" . $refund_id . "' limit 1");
  }



  function delete_payment($payment_id) {
    global $db;
    $db->Execute("delete from " . TABLE_SO_PAYMENTS . " where payment_id = '" . $payment_id . "' limit 1");
  }



  function delete_purchase_order($purchase_order_id) {
    global $db;
    $db->Execute("delete from " . TABLE_SO_PURCHASE_ORDERS . " where purchase_order_id = '" . $purchase_order_id . "' limit 1");
  }



  function delete_all_data() {
    global $db;
    // remove payment data
    $db->Execute("delete from " . TABLE_SO_PAYMENTS . " where orders_id = '" . $this->oID . "'");
    // remove purchase order data
    $db->Execute("delete from " . TABLE_SO_PURCHASE_ORDERS . " where orders_id = '" . $this->oID . "'");
    // remove refund data
    $db->Execute("delete from " . TABLE_SO_REFUNDS . " where orders_id = '" . $this->oID . "'");
  }


  // translates payment type codes into full text
  function full_type($code) {
     if (array_key_exists($code, $this->payment_key_array)) {
       $full_text = $this->payment_key_array[$code];
     }
     else {
       $full_text = $code;
     }
     return $full_text;
  }



  function find_po_payments($purchase_order_id) {
    $po_payment_array = array();

    for ($x = 0; $x < sizeof($this->po_payment); $x++) {
      if ($this->po_payment[$x]['assigned_po'] == $purchase_order_id) {

        $po_payment_array[] = array('index' => $this->po_payment[$x]['index'],
                                    'assigned_po' => $purchase_order_id,
                                    'number' => $this->po_payment[$x]['number'],
                                    'name' => $this->po_payment[$x]['name'],
                                    'amount' => $this->po_payment[$x]['amount'],
                                    'type' => $this->po_payment[$x]['type'],
                                    'posted' => $this->po_payment[$x]['posted'],
                                    'modified' => $this->po_payment[$x]['modified']);
      }
    }

    return $po_payment_array;
  }


  function find_refunds($payment_id) {
    $refund_array = array();

    for ($x = 0; $x < sizeof($this->refund); $x++) {
      if ($this->refund[$x]['payment'] == $payment_id) {
        $refund_array[] = array('index' => $this->refund[$x]['index'],
                                'payment' => $payment_id,
                                'number' => $this->refund[$x]['number'],
                                'name' => $this->refund[$x]['name'],
                                'amount' => $this->refund[$x]['amount'],
                                'type' => $this->refund[$x]['type'],
                                'posted' => $this->refund[$x]['posted'],
                                'modified' => $this->refund[$x]['modified']);
      }
    }

    return $refund_array;
  }


}  // END class super_order
?>