<?php
class CustomMail {

  function CustomMail(){
  }

  //注文時
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
    // 曜日も含める
    $date_ordered  = strftime(MODULE_EMAIL_TEMPLATE_DATE_FORMAT_LONG);
    $weekday       = array ('日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日');
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

    //ログイン情報を取得
    //if (MODULE_VISITORS_PURCHASE_STATUS == 'true' && zen_visitors_is_visitor()) {
    if ($_SESSION['customer_id'] > 0 && !isset($_SESSION['visitors_id'])) {
       $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID;	//ログインしてる（会員用）
    }
    else {
      $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID;	//ログインしてない（ゲスト用）
    }

	$query = "select "
					. "* "
			. "from "
					. TABLE_EMAIL_TEMPLATES . " et "
			. "left join "
					. TABLE_EMAIL_TEMPLATES_DESCRIPTION . " etd "
			. "on "
					. "et.id = etd.email_templates_id "
			. "where "
					. "et.id = " . $email_template_id . " "
			. "and "
					. "etd.language_id = " . $_SESSION['languages_id'];

	$email_template = $db->Execute($query);
 	//=========================================



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
      '',
      $email_module
     );

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

  //会員登録時
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


    $email_template_id = 1;

	$query = "select "
					. "* "
			. "from "
					. "email_templates "
			. "left join "
					. "email_templates_description "
			. "on "
					. "email_templates.id = email_templates_description.email_templates_id "
			. "where "
					. "email_templates.id = " . $email_template_id . " "
			. "and "
					. "email_templates_description.language_id = " . $_SESSION['languages_id'];

    $email_template    = $db->Execute($query);

	//make data for custom template

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
      '',
      $email_module);
  }

  //任意に選択された注文詳細のコメントを部分置換する
  function replace_status_email($oID, $comments) {
    require_once('includes/classes/currencies.php');
    $currencies = new currencies();

    //オーダー情報の取得
    require_once('includes/classes/order.php');
    $order = new order($oID);

    //============ 以下、予約語を置換 ============
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
                         . $order->products[$i]['qty'] . '点　'
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
    $weekday       = array ('日曜日', '月曜日', '火曜日', '水曜日', '木曜日', '金曜日', '土曜日');
    $date_ordered .= $weekday[strftime('%w', strtotime($order->info['date_purchased']))];

    $comments = str_replace('[DATE_ORDERED]',
                $date_ordered,
                $comments);

//print_r($order);
//print $comments;
//die;

    return $comments;
  }

  //function send_status_mail($oID, $email_template_id) {
  function send_status_mail($oID, $email_template_id, $language_id) {

    global $db;

	$sql = "select "
				. TABLE_EMAIL_TEMPLATES_DESCRIPTION . ".subject, "
				. TABLE_EMAIL_TEMPLATES_DESCRIPTION . ".contents "
		. "from "
				. TABLE_EMAIL_TEMPLATES . " "
		. "inner join "
				. TABLE_EMAIL_TEMPLATES_DESCRIPTION . " "
		. "on "
				. TABLE_EMAIL_TEMPLATES . ".id = " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . ".email_templates_id "
		. "where "
				. TABLE_EMAIL_TEMPLATES . ".id = " . MODULE_EMAIL_TEMPLATE_STATUS_MAIL_ID . " "
		. "and "
				. TABLE_EMAIL_TEMPLATES_DESCRIPTION . ".language_id = " . $language_id;

	$get_template = $db->Execute($sql);

	$CustomMail = new CustomMail();
	$contents = $CustomMail->replace_status_email($oID, $get_template->fields['contents']);
	//==========================================

    $sql    = "select customers_name,customers_email_address from ".TABLE_ORDERS." where orders_id=".(int)$oID;
    $result = $db->execute($sql);
    if ($result->EOF) return;

    $name   = $result->fields['customers_name'];
    $email  = $result->fields['customers_email_address'];

    zen_mail(
      $name,
      $email,
      $get_template->fields['subject'] . ' #' . $oID,
      $contents,
      STORE_NAME,
      EMAIL_FROM,
      "",
      'order_status'
    );

    // send extra emails
    //管理画面→一般設定→メールの設定で[ショップ運営者の注文ステータスメール(コピー)の送信先]が有効になっている場合
    if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') {
		zen_mail(
			'',
			SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO,
			SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . $subject . ' #' . $oID,
			$contents,
			STORE_NAME,
			EMAIL_FROM,
			"",
			'order_status_extra'
		);
    }
  }


}
?>
