<?php
class CustomMail {
  function CustomMail(){
  }

  function send_order_email( $zf_insert_id, $zf_mode ){
    global $currencies, $order_totals, $order_back, $template;

    if ($order_back->email_low_stock != '' and SEND_LOWSTOCK_EMAIL=='1') {
      // send an email
      $email_low_stock = SEND_EXTRA_LOW_STOCK_EMAIL_TITLE . "\n\n" . $order_back->email_low_stock;
      zen_mail('', SEND_EXTRA_LOW_STOCK_EMAILS_TO, EMAIL_TEXT_SUBJECT_LOWSTOCK, $email_low_stock, STORE_OWNER, EMAIL_FROM, array('EMAIL_MESSAGE_HTML' => nl2br($email_low_stock)),'low_stock');
    }


    // make data for custom template
    $customer = $order_back->customer;
    $order_id = $zf_insert_id;
    $date_ordered = strftime(DATE_FORMAT_LONG);
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


    ob_start();
    require($template->get_template_dir('tpl_modules_checkout_process_email.php', DIR_WS_TEMPLATE, $current_page_base, 'templates'). '/tpl_modules_checkout_process_email.php');
    $email_order = ob_get_contents();
    ob_end_clean();


    while (strstr($email_order, '&nbsp;')) $email_order = str_replace('&nbsp;', ' ', $email_order);

    zen_mail(
      $order_back->customer['firstname'] . ' ' . $order_back->customer['lastname'], 
      $order_back->customer['email_address'], 
      EMAIL_TEXT_SUBJECT . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id, 
      $email_order, 
      STORE_NAME, 
      EMAIL_FROM, 
      $html_msg, 
      'checkout');

    // send additional emails
    if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
      $extra_info=email_collect_extra_info('','', $order_back->customer['firstname'] . ' ' . $order_back->customer['lastname'], $order_back->customer['email_address'], $order_back->customer['telephone']);

      zen_mail(
        '', 
        SEND_EXTRA_ORDER_EMAILS_TO, 
        SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT . ' ' . EMAIL_TEXT_SUBJECT . EMAIL_ORDER_NUMBER_SUBJECT . $zf_insert_id,
        $email_order . $extra_info['TEXT'], 
        STORE_NAME, 
        EMAIL_FROM, 
        $html_msg, 
        'checkout_extra');
    }
  } 

}
?>
