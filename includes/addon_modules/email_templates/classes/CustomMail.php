<?php
class CustomMail {
  function CustomMail(){
  }

  function send_order_email( $zf_insert_id, $zf_mode ){
    global $db, $currencies, $order_totals, $order_back, $template;

    if ($order_back->email_low_stock != '' and SEND_LOWSTOCK_EMAIL=='1') {
      // send an email
      $email_low_stock = SEND_EXTRA_LOW_STOCK_EMAIL_TITLE . "\n\n" . $order_back->email_low_stock;
      zen_mail('', SEND_EXTRA_LOW_STOCK_EMAILS_TO, EMAIL_TEXT_SUBJECT_LOWSTOCK, $email_low_stock, STORE_OWNER, EMAIL_FROM, array('EMAIL_MESSAGE_HTML' => nl2br($email_low_stock)),'low_stock');
    }


    // make data for custom template
    $customer = $order_back->customer;
    $order_id = $zf_insert_id;
    // ÍËÆü¤â´Þ¤á¤ë
    $date_ordered  = strftime(MODULE_EMAIL_TEMPLATE_DATE_FORMAT_LONG);
    $weekday       = array ('ÆüÍËÆü', '·îÍËÆü', '²ÐÍËÆü', '¿åÍËÆü', 'ÌÚÍËÆü', '¶âÍËÆü', 'ÅÚÍËÆü');
    $date_ordered .= $weekday[strftime('%w')];

    $invoice_url = zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $zf_insert_id, 'SSL', false);
    $comments = zen_db_output($order_back->info['comments']);
    $info = $order_back->info;
    $products_ordered = $order_back->products_ordered;
    // totals
    $totals = '';
    for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
      $totals .= strip_tags($order_totals[$i]['title']) . ' ' . strip_tags($order_totals[$i]['text']) . "\n";
    }
    // delivery address
    if ($order_back->content_type != 'virtual') {
      $delivery_address = zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], 0, '', "\n");
    }
    // billing address & payment info
    $billing_address = zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], 0, '', "\n");
    if (is_object($GLOBALS[$_SESSION['payment']])) {
      $payment_class = $_SESSION['payment'];
      $payment_method = $GLOBALS[$payment_class]->title;
      if ($GLOBALS[$payment_class]->email_footer) {
        $payment_method .= "\n\n" . $GLOBALS[$payment_class]->email_footer;
      }
    } else {
      $payment_method = PAYMENT_METHOD_GV;
    }

    if (MODULE_VISITORS_PURCHASE_STATUS == 'true' && 
        zen_visitors_is_visitor()) {
      $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID;
    }
    else {
      $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID;
    }
    $query = "SELECT * FROM " . TABLE_EMAIL_TEMPLATES . 
             " WHERE id='". $email_template_id . "'";
    $email_template = $db->Execute($query);

    $email_order = $email_template->fields['contents'];
    $email_order = str_replace('[ORDER_ID]', 
                               stripslashes($zf_insert_id), 
                               $email_order);
    $email_order = str_replace('[CUSTOMER_NAME]', 
                               stripslashes($customer['firstname'] . ' ' . $customer['lastname']), 
                               $email_order);
    $email_order = str_replace('[DATE_ORDERED]', 
                               stripslashes($date_ordered), 
                               $email_order);
    $email_order = str_replace('[INVOICE_URL]', 
                               stripslashes($invoice_url), 
                               $email_order);
    $email_order = str_replace('[COMMENT]', 
                               stripslashes($comments),
                               $email_order);
    $email_order = str_replace('[PRODUCTS_ORDERED]', 
                               stripslashes($products_ordered),
                               $email_order);
    $email_order = str_replace('[TOTALS]', 
                               stripslashes($totals),
                               $email_order);
    $email_order = str_replace('[BILLING_ADDRESS]', 
                               stripslashes($billing_address),
                               $email_order);
    $email_order = str_replace('[DELIVERY_ADDRESS]', 
                               stripslashes($delivery_address),
                               $email_order);
    $email_order = str_replace('[PAYMENT_METHOD]', 
                               stripslashes($payment_method),
                               $email_order);

    while (strstr($email_order, '&nbsp;')) $email_order = str_replace('&nbsp;', ' ', $email_order);

    if (MODULE_VISITORS_PURCHASE_STATUS == 'true' && 
        zen_visitors_is_visitor()) {
      $email_module = 'checkout_visitor';
    }
    else {
      $email_module = 'checkout';
    }

    zen_mail(
      $order_back->customer['firstname'] . ' ' . $order_back->customer['lastname'], 
      $order_back->customer['email_address'], 
      $email_template->fields['subject'] . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id, 
      $email_order, 
      STORE_NAME, 
      EMAIL_FROM, 
      $html_msg, 
      $email_module);

    // send additional emails
    if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
      $extra_info=email_collect_extra_info('','', $order_back->customer['firstname'] . ' ' . $order_back->customer['lastname'], $order_back->customer['email_address'], $order_back->customer['telephone']);

      if (MODULE_VISITORS_PURCHASE_STATUS == 'true' && 
          zen_visitors_is_visitor()) {
        $email_module = 'checkout_visitor_extra';
      }
      else {
        $email_module = 'checkout_extra';
      }

      zen_mail(
        '', 
        SEND_EXTRA_ORDER_EMAILS_TO, 
        SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT . ' ' . $email_template->fields['subject'] . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id,
        $email_order . $extra_info['TEXT'], 
        STORE_NAME, 
        EMAIL_FROM, 
        $html_msg, 
        $email_module);
    }
  } 

  function send_welcome_email($customer_id, $to_email, $extra = '') {
    global $db;

    // get user information
    $query = "SELECT
                 customers_firstname
                ,customers_lastname
                ,customers_email_address
                ,customers_dob
                ,customers_telephone
                ,customers_fax
              from ".
                TABLE_CUSTOMERS."
              where
                customers_id=".(int)$customer_id;
    $customer = $db->Execute($query);

    // make data for custom template
    $email_template_id = (int)MODULE_EMAIL_TEMPLATE_CREATE_ACCOUNT_MAIL_ID;
    $query             = "SELECT * FROM " . TABLE_EMAIL_TEMPLATES . " WHERE id='". $email_template_id . "'";
    $email_template    = $db->Execute($query);
    $email_welcome     = $email_template->fields['contents'];
    $email_welcome     = str_replace('[CUSTOMER_NAME]', 
                         stripslashes($customer->fields['customers_firstname'] . ' ' . $customer->fields['customers_lastname']),
                         $email_welcome);
    $email_welcome     = str_replace('[CUSTOMER_EMAIL]', 
                         stripslashes($customer->fields['customers_email_address']),
                         $email_welcome);
    $email_welcome     = str_replace('[CUSTOMER_DOB]', 
                         stripslashes($customer->fields['customers_dob']),
                         $email_welcome);
    $email_welcome     = str_replace('[CUSTOMER_PHONE]', 
                         stripslashes($customer->fields['customers_telephone']),
                         $email_welcome);
    $email_welcome     = str_replace('[CUSTOMER_FAX]', 
                         stripslashes($customer->fields['customers_fax']),
                         $email_welcome);

    while (strstr($email_welcome, '&nbsp;'))
      $email_welcome = str_replace('&nbsp;', ' ', $email_welcome);

    $email_welcome .= $extra;

    if ($extra == '')
      $email_module = "welcome";
    else
      $email_module = "welcome_extra";

    zen_mail(
      $customer->fields['customer_first_name'] . ' ' . $customer->fields['customer_last_name'],
      $to_email,
      $email_template->fields['subject'],
      $email_welcome, 
      STORE_NAME, 
      EMAIL_FROM, 
      $html_msg, 
      $email_module);
  }

  function replace_status_email($oID, $comments) {
    require_once('includes/classes/currencies.php');
    $currencies = new currencies();

    require_once('includes/classes/order.php');
    $order = new order($oID);

    $comments = str_replace('[CUSTOMER_NAME]', 
                stripslashes($order->customer['name']),
                $comments);
    $comments = str_replace('[ORDER_ID]', 
                stripslashes($oID),
                $comments);
    $comments = str_replace('[INVOICE_URL]', 
                zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL'),
                $comments);

    // products
    $products_ordered = "";
    for ($i=0, $n=count($order->products); $i<$n; $i++) {
      $products_ordered_attributes = '';
      for ($j=0; $j<count($order->products[$i]['attributes']); $j++) {
          $products_ordered_attributes .= "\n\t"
                                        . $order->products[$i]['attributes'][$j]['option']
                                        . ' '
                                        . $order->products[$i]['attributes'][$j]['value'];
      }

      $products_ordered .= $order->products[$i]['name']
                         . ($order->products[$i]['model'] != '' ? ' (' . $order->products[$i]['model'] . ') ' : '')
                         . $order->products[$i]['qty'] . 'ÅÀ¡¡'
                         . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty'])
                         . ($order->products[$i]['onetime_charges'] !=0 ? "\n" . TEXT_ONETIME_CHARGES_EMAIL . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1) : '')
                         . $products_ordered_attributes . "\n";
    }

    $comments = str_replace('[PRODUCTS_ORDERED]', 
                stripslashes($products_ordered),
                $comments);

    // totals
    $totals = '';
    for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
      $totals .= strip_tags($order->totals[$i]['title']) . ' ' . strip_tags($order->totals[$i]['text']) . "\n";
    }
    $comments = str_replace('[TOTALS]', 
                stripslashes($totals),
                $comments);

    $billing_address = zen_address_format($order->billing['format_id'], $order->billing, 1, '', "<br />");
    $comments = str_replace('[BILLING_ADDRESS]', 
                stripslashes($billing_address),
                $comments);
    $delivery_address = zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', "<br />");
    $comments = str_replace('[DELIVERY_ADDRESS]', 
                stripslashes($delivery_address),
                $comments);
    $comments = str_replace('[PAYMENT_METHOD]', 
                stripslashes($order->info['payment_method']),
                $comments);

    $date_ordered  = strftime(MODULE_EMAIL_TEMPLATE_DATE_FORMAT_LONG, strtotime($order->info['date_purchased']));
    $weekday       = array ('ÆüÍËÆü', '·îÍËÆü', '²ÐÍËÆü', '¿åÍËÆü', 'ÌÚÍËÆü', '¶âÍËÆü', 'ÅÚÍËÆü');
    $date_ordered .= $weekday[strftime('%w', strtotime($order->info['date_purchased']))];

    $comments = str_replace('[DATE_ORDERED]', 
                $date_ordered,
                $comments);

//print_r($order);
//print $comments;
//die;

    return $comments;
  }

  function send_status_mail($oID, $email_template_id) {
    global $db;

    $sql    = "select customers_name,customers_email_address from ".TABLE_ORDERS." where orders_id=".(int)$oID;
    $result = $db->execute($sql);
    if ($result->EOF)
      return;
    $name   = $result->fields['customers_name'];
    $email  = $result->fields['customers_email_address'];

    // ºÇ½ª¥³¥á¥ó¥È¼èÆÀ
    $sql    = "select orders_status_history_id,comments from ".TABLE_ORDERS_STATUS_HISTORY." where orders_id=".(int)$oID." order by orders_status_history_id desc";
    $result = $db->execute($sql);
    if ($result->EOF)
      return;
    $comments = $result->fields['comments'];

    // subject¼èÆÀ
    $sql    = "select subject from ".TABLE_EMAIL_TEMPLATES." where id=".(int)$email_template_id;
    $result = $db->execute($sql);
    if ($result->EOF)
      return;
    $subject = $result->fields['subject'];

    zen_mail(
      $name,
      $email,
      $subject . ' #' . $oID,
      $comments,
      STORE_NAME,
      EMAIL_FROM,
      "",
      'order_status');

    // send extra emails
    if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') {
      zen_mail(
        '',
        SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO,
        SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . $subject . ' #' . $oID,
        $comments,
        STORE_NAME,
        EMAIL_FROM,
        "",
        'order_status_extra');
    }
  }


}
?>
