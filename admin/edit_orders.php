<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

  global $db;
  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  include(DIR_WS_CLASSES . 'order.php');

    $oID = zen_db_prepare_input($_GET['oID']);
  $step = zen_db_prepare_input($_POST['step']);
  $add_product_categories_id = zen_db_prepare_input($_POST['add_product_categories_id']);
  $add_product_products_id = zen_db_prepare_input($_POST['add_product_products_id']);
  $add_product_quantity = zen_db_prepare_input($_POST['add_product_quantity']);



  // New "Status History" table has different format.
  $OldNewStatusValues = (zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "old_value") && zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "new_value"));
  /* $CommentsWithStatus = zen_field_exists(TABLE_ORDERS_STATUS_HISTORY, "comments"); */
  // $SeparateBillingFields = zen_field_exists(TABLE_ORDERS, "billing_name");

  // Default Tax Rate/Percent for Shipping
  $AddShippingTax = "0.0"; // e.g. shipping tax of 17.5% is "17.5"

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = $db -> Execute("select orders_status_id, orders_status_name 
  					from " . TABLE_ORDERS_STATUS . " 
					where language_id = '" . (int)$_SESSION['languages_id'] . "'");
#  while ($orders_status = zen_db_fetch_array($orders_status_query)) {
  while (!$orders_status_query -> EOF) {
    $orders_statuses[] = array('id' => $orders_status_query->fields['orders_status_id'],
                               'text' => $orders_status_query->fields['orders_status_name']);
    $orders_status_array[$orders_status_query->fields['orders_status_id']] = $orders_status_query->fields['orders_status_name'];
    $orders_status_query -> MoveNext();
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : 'edit');
//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
$order_query = $db -> Execute("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$oID . "'");
//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
////
// Check specific attributes_qty_prices or attributes_qty_prices_onetime for a given quantity price
  function get_attributes_quantity_price_for_editorders($check_what, $check_for) {
// $check_what='1:3.00,5:2.50,10:2.25,20:2.00';
// $check_for=50;
      $attribute_table_cost = split("[:,]" , $check_what);
      $size = sizeof($attribute_table_cost);
 $attribute_quantity_price = $attribute_table_cost[$size-1];
      for ($i=$size-2, $n=-2; $i>$n; $i-=2) {
        if ($check_for <= $attribute_table_cost[$i]) {
          $attribute_quantity_price = $attribute_table_cost[$i+1]; 
        }
      }
     return $attribute_quantity_price;
  }


  if (zen_not_null($action)) {
    switch ($action) {

// Update Order

	case 'update_order':
// TY TRACKER UPDATE ORDER BEGIN
if (TY_TRACKER == 'True') {

		$oID = zen_db_prepare_input($_GET['oID']);
		$order = new order($oID);
		//$status = zen_db_prepare_input($_POST['status']);
		$status = zen_db_prepare_input($_POST['status'], true);
// TY TRACKER 1 BEGIN, DEFINE VALUES  ----------------------------------------------
        $track_id1 = str_replace(" ", "", zen_db_scrub_in($_POST['track_id1']));
        $track_id2 = str_replace(" ", "", zen_db_scrub_in($_POST['track_id2']));
        $track_id3 = str_replace(" ", "", zen_db_scrub_in($_POST['track_id3']));
        $track_id4 = str_replace(" ", "", zen_db_scrub_in($_POST['track_id4']));
        $track_id5 = str_replace(" ", "", zen_db_scrub_in($_POST['track_id5']));
// END TY TRACKER 1 ------------------------------------------------------------------
        //$comments = zen_db_prepare_input($_POST['comments']);
		$comments = mysql_real_escape_string(stripslashes($_POST)); 
		$comments = zen_db_prepare_input($_POST['comments'],true);

		// Update Order Info updated 12/18/2010 to include last date modified

		$UpdateOrders = "update " . TABLE_ORDERS . " set
			customers_name = '" . zen_db_input(stripslashes($_POST['update_customer_name'])) . "',
			customers_company = '" . zen_db_input(stripslashes($_POST['update_customer_company'])) . "',
			customers_street_address = '" . zen_db_input(stripslashes($_POST['update_customer_street_address'])) . "',
			customers_suburb = '" . zen_db_input(stripslashes($_POST['update_customer_suburb'])) . "',
			customers_city = '" . zen_db_input(stripslashes($_POST['update_customer_city'])) . "',
			customers_state = '" . zen_db_input(stripslashes($_POST['update_customer_state'])) . "',
			customers_postcode = '" . zen_db_input(stripslashes($_POST['update_customer_postcode'])) . "',
			customers_country = '" . zen_db_input(stripslashes($_POST['update_customer_country'])) . "',
			customers_telephone = '" . zen_db_input(stripslashes($_POST['update_customer_telephone'])) . "',
			customers_email_address = '" . zen_db_input(stripslashes($_POST['update_customer_email_address'])) . "',
			last_modified=now(),";

		// if($SeparateBillingFields)
		// {
		$UpdateOrders .= "billing_name = '" . zen_db_input(stripslashes($_POST['update_billing_name'])) . "',
			billing_company = '" . zen_db_input(stripslashes($_POST['update_billing_company'])) . "',
			billing_street_address = '" . zen_db_input(stripslashes($_POST['update_billing_street_address'])) . "',
			billing_suburb = '" . zen_db_input(stripslashes($_POST['update_billing_suburb'])) . "',
			billing_city = '" . zen_db_input(stripslashes($_POST['update_billing_city'])) . "',
			billing_state = '" . zen_db_input(stripslashes($_POST['update_billing_state'])) . "',
			billing_postcode = '" . zen_db_input(stripslashes($_POST['update_billing_postcode'])) . "',
			billing_country = '" . zen_db_input(stripslashes($_POST['update_billing_country'])) . "',";
		// }

		$UpdateOrders .= "delivery_name = '" . zen_db_input(stripslashes($_POST['update_delivery_name'])) . "',
			delivery_company = '" . zen_db_input(stripslashes($_POST['update_delivery_company'])) . "',
			delivery_street_address = '" . zen_db_input(stripslashes($_POST['update_delivery_street_address'])) . "',
			delivery_suburb = '" . zen_db_input(stripslashes($_POST['update_delivery_suburb'])) . "',
			delivery_city = '" . zen_db_input(stripslashes($_POST['update_delivery_city'])) . "',
			delivery_state = '" . zen_db_input(stripslashes($_POST['update_delivery_state'])) . "',
			delivery_postcode = '" . zen_db_input(stripslashes($_POST['update_delivery_postcode'])) . "',
			delivery_country = '" . zen_db_input(stripslashes($_POST['update_delivery_country'])) . "',
			payment_method = '" . zen_db_input(stripslashes($_POST['update_info_payment_method'])) . "',
			cc_type = '" . zen_db_input(stripslashes($_POST['update_info_cc_type'])) . "',
			cc_owner = '" . zen_db_input(stripslashes($_POST['update_info_cc_owner'])) . "',";


		if(substr($update_info_cc_number,0,8) != "(Last 4)")
		$UpdateOrders .= "cc_number = '". zen_db_input(stripslashes($_POST['update_info_cc_number'])). "',";

		$UpdateOrders .= "cc_expires = '". zen_db_input(stripslashes($_POST['update_info_cc_expires'])). "',
			orders_status = '" . zen_db_input($status) . "'";

		/* if(!$CommentsWithStatus)
		{
			#$UpdateOrders .= ", comments = '" . zen_db_input($_POST[comments]) . "'";
		} */

		$UpdateOrders .= " where orders_id = '" . zen_db_input($oID) . "';";

		$db -> Execute($UpdateOrders);
		$order_updated = true;

		$check_status = $db->Execute("select customers_name, customers_email_address, orders_status, 
									  date_purchased from " . TABLE_ORDERS . " 
									  where orders_id = '" . (int)$oID . "'");
		// Update Status History & Email Customer if Necessary
		if (($order->info['orders_status'] != $status) ||  zen_not_null($comments))  {
// Notify the customer  
          $customer_notified = '0';
// Now, lets check to see if we want to notify the customer on this last entry          
          if (isset($_POST['notify']) && ($_POST['notify'] == '1')) {  
          $customer_notified = '1';
          }
// Here we check to see if we have clicked on the Hide RadioButton and if so, set the Variable to -1
          if (isset($_POST['notify']) && ($_POST['notify'] == '-1')){
            // hide comment
            $customer_notified = '-1';
          }
   
// OK, we have our Customer Notified Status Number, now update the Order Status History Table
// TY TRACKER 2 BEGIN, UPDATE STATUS  ----------------------------------------------
          update_status($oID, $status, $customer_notified, $comments, $track_id1, $track_id2, $track_id3, $track_id4, $track_id5);
// END TY TRACKER 2 ------------------------------------------------------------------
//   Send E-Mail to Customer if they should be notified. Send comments if append comments is checked.

         if ($customer_notified == '1') {
             if (isset($_POST['notify_comments']))   {
              $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $_POST[comments]) . "\n\n";
         }
              $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' <a href="' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . '">' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "</a>\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($check_status->fields['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]);
                          $html_msg['EMAIL_MESSAGE_HTML'] = str_replace('
','<br />',$email);
              zen_mail($check_status->fields['customers_name'], $check_status->fields['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $html_msg, NULL);
                        }
                }

		// Update Products
		$RunningSubTotal = 0;
		$RunningTax = 0;
        $update_products = $_POST['update_products'];
		foreach($update_products as $orders_products_id => $products_details)
		{
                        $AddedOptionsPrice = 0;
                        $AddedOptionsPrice_OneTime = 0;
			// Update orders_products Table
			//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
			#$order = zen_db_fetch_array($order_query);
			if ($products_details["qty"] != $order_query->fields['products_quantity']){
				$differenza_quantita = ($products_details["qty"] - $order_query->fields['products_quantity']);
				if (STOCK_LIMITED == "true")
                                   $db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order_query->fields['products_id'] . "'");
                                else
                                   $db -> Execute("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order_query->fields['products_id'] . "'");
			}
			//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
			if($products_details["qty"] > 0)
			{
				/* $Query = "update " . TABLE_ORDERS_PRODUCTS . " set
					products_model = '" . $products_details["model"] . "',
					products_name = '" . str_replace("'", "&#39;", $products_details["name"]) . "',
					final_price = '" . $products_details["final_price"] . "',
					products_tax = '" . $products_details["tax"] . "',
                                        onetime_charges = '" . $products_details["onetime_charges"] . "',
					products_quantity = '" . $products_details["qty"] . "'
					where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query); */

				// Update Tax and Subtotals
				$RunningSubTotal += ($products_details["qty"] * $products_details["final_price"]) + $products_details["onetime_charges"];
				$RunningTax += (($products_details["tax"]/100) * ($products_details["qty"] * $products_details["final_price"]));
                               
				// Update Any Attributes
   
			// Get Product Attribute Info For Old And New Attribute   
        $QuerySA=mysql_query("SELECT * FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id = '$orders_products_id'")
              or die('Failed to connect database:  SA');
        while($rowSA=mysql_fetch_array($QuerySA, MYSQL_ASSOC)) {
        $sendoptionon = "select_product_options_".$rowSA[orders_products_attributes_id];
        $sendoptionontv = $sendoptionon . "tv";
        $sendoptionontvid = $sendoptionon . "tvid";
        if (($_POST[$sendoptionon] && $rowSA[products_options_values_id] != $_POST[$sendoptionon]) || ($_POST[$sendoptionontv] && $rowSA[products_options_values] != $_POST[$sendoptionontv])) {
	$result9a=mysql_query("SELECT products_options_values_name FROM ".TABLE_PRODUCTS_OPTIONS_VALUES." WHERE products_options_values_id='$_POST[$sendoptionon]' ")
				or die("Failed to connect database: ");
				while($row9a=mysql_fetch_array($result9a, MYSQL_NUM)) {
					$attributes[$i]=$row9a[0]; }

$result8a=mysql_query("SELECT products_options_id FROM ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS." WHERE products_options_values_id='$_POST[$sendoptionon]'")
			or die('Failed to connect database: 8');
if ($_POST[$sendoptionontvid]) {
$attributestypenumber[$i] = $_POST[$sendoptionontvid];
} else {
while($row8a=mysql_fetch_array($result8a, MYSQL_NUM)) {
					$attributestypenumber[$i]=$row8a[0];   }
}

// Old Attribute

$resultOOV=mysql_query("SELECT products_options_values_id FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." WHERE products_options_id='$attributestypenumber[$i]' AND orders_id='$oID' AND orders_products_id='$orders_products_id'")
				or die("Failed to connect database: ");
				while($rowOOV=mysql_fetch_array($resultOOV, MYSQL_NUM)) {
					$OldOptionValueID=$rowOOV[0]; }
$OldPAID = 0;
$resultFPAID=mysql_query("SELECT products_attributes_id FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$attributestypenumber[$i]' AND options_values_id='$OldOptionValueID'")
				or die("Failed to connect database: ");
				while($rowFPAID=mysql_fetch_array($resultFPAID, MYSQL_NUM)) {
					$OldPAID=$rowFPAID[0]; }
$resultOPQ=mysql_query("SELECT products_quantity FROM ".TABLE_ORDERS_PRODUCTS." WHERE orders_products_id = '$orders_products_id'")
				or die("Failed to connect database: ");
				while($rowOPQ=mysql_fetch_array($resultOPQ, MYSQL_NUM)) {
					$OldProductQuantity=$rowOPQ[0]; }
$result9d = mysql_query("SELECT products_price, product_is_free FROM " . TABLE_PRODUCTS . " WHERE products_id='" . (int)$order_query->fields['products_id'] . "'")
                        or die('Failed to connect database:9d');
while($row9d=mysql_fetch_array($result9d, MYSQL_NUM)) {
					$prodpricebase=$row9d[0]; 
                                        $prodisfree=$row9d[1];    }

/* $result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_attributes_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE options_values_id='$OldOptionValueID' AND products_id='" . (int)$order_query->fields['products_id'] . "'")
				or die("Failed to connect database: "); */
$result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_options_values_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." WHERE products_options_id='$attributestypenumber[$i]' AND orders_id='$oID' AND orders_products_id='$orders_products_id'")
				or die("Failed to connect database: ");
				while($row10a=mysql_fetch_array($result10a, MYSQL_NUM)) {
                                        // $OldOptionValueID=$row10a[3];
                                        if ($row10a[2] == 1)
                                            $newpricechange = zen_get_discount_calc((int)$order_query->fields['products_id'], $OldPAID, $row10a[0], $OldProductQuantity);
                                        else
                                            $newpricechange = $row10a[0];
                                        if ($row10a[15] == 0 || $prodisfree == 0)
                                        {
                                           if ($row10a[1] == "-")
                                                $AddedOptionsPrice += $newpricechange;
                                           else
					        $AddedOptionsPrice -= $newpricechange; 
                                           if (ATTRIBUTES_ENABLED_PRICE_FACTOR == true) {
                                              if ($row10a[7] != 0)
                                                  $AddedOptionsPrice -= ($row10a[7] * $prodpricebase);
                                              if ($row10a[8] != 0)
                                                  $AddedOptionsPrice += ($row10a[8] * $prodpricebase);      
                                              if ($row10a[5] != 0)
                                                  $AddedOptionsPrice_OneTime -= ($row10a[5] * $prodpricebase);
                                              if ($row10a[6] != 0)
                                                  $AddedOptionsPrice_OneTime += ($row10a[6] * $prodpricebase);
                                           }
                                           $AddedOptionsPrice_OneTime -= $row10a[4];
                                           if (ATTRIBUTES_ENABLED_QTY_PRICES == true) {
                                              if ($row10a[9] != '' && $row10a[9] != NULL)
                                                  $AddedOptionsPrice -= get_attributes_quantity_price_for_editorders($row10a[9], $OldProductQuantity);
                                              if ($row10a[10] != '' && $row10a[10] != NULL)
                                                  $AddedOptionsPrice_OneTime -= get_attributes_quantity_price_for_editorders($row10a[10], $OldProductQuantity);
                                           }
                                           if ($_POST[$sendoptionontv] && ATTRIBUTES_ENABLED_TEXT_PRICES == true) {
                                              if ($row10a[11] != 0)
                                                  $AddedOptionsPrice -= zen_get_letters_count_price($rowSA[products_options_values],$row10a[12],$row10a[11]);
                                              if ($row10a[13] != 0)
                                                  $AddedOptionsPrice -= zen_get_word_count_price($rowSA[products_options_values],$row10a[14],$row10a[13]);
                                           }
                                        }
                                }
$OldAttFileName='';  $OldPAID = 0;
$resultFPAID=mysql_query("SELECT products_attributes_id FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$attributestypenumber[$i]' AND options_values_id='$OldOptionValueID'")
				or die("Failed to connect database: ");
				while($rowFPAID=mysql_fetch_array($resultFPAID, MYSQL_NUM)) {
					$OldPAID=$rowFPAID[0];
      $queryCPD=mysql_query("SELECT products_attributes_filename FROM " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " WHERE products_attributes_id='$OldPAID'")
                                           or die('Failed to connect database:  2');
                                        while($rowCPD=mysql_fetch_array($queryCPD, MYSQL_NUM)) {
                                        $OldAttFileName=$rowCPD[0]; }  }

// New Attribute


$result8c=mysql_query("SELECT products_options_name FROM ".TABLE_PRODUCTS_OPTIONS." WHERE products_options_id='$attributestypenumber[$i]'")   
			or die('Failed to connect database: 8');
while($row8c=mysql_fetch_array($result8c, MYSQL_NUM)) {
					$attributestype[$i]=$row8c[0]; }

$result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_attributes_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE options_values_id='$_POST[$sendoptionon]' AND products_id='" . (int)$order_query->fields['products_id'] . "'")
				or die("Failed to connect database: ");
				while($row10a=mysql_fetch_array($result10a, MYSQL_NUM)) { 
                                        if ($row10a[2] == 1)
                                            $newpricechange = zen_get_discount_calc((int)$order_query->fields['products_id'], $row10a[3], $row10a[0], $products_details["qty"]);
                                        else
                                            $newpricechange = $row10a[0];
                                        $addtotheprice[$i]=$row10a[0]; $addorsubfromprice[$i]=$row10a[1];
                                        if ($row10a[15] == 0 || $prodisfree == 0)
                                        {
                                           if ($row10a[1] == "-")
                                                $AddedOptionsPrice -= $newpricechange;
                                           else
					        $AddedOptionsPrice += $newpricechange; 
                                           if (ATTRIBUTES_ENABLED_PRICE_FACTOR == true) {
                                              if ($row10a[7] != 0)
                                                  $AddedOptionsPrice += ($row10a[7] * $prodpricebase);
                                              if ($row10a[8] != 0)
                                                  $AddedOptionsPrice -= ($row10a[8] * $prodpricebase);      
                                              if ($row10a[5] != 0)
                                                  $AddedOptionsPrice_OneTime += ($row10a[5] * $prodpricebase);
                                              if ($row10a[6] != 0)
                                                  $AddedOptionsPrice_OneTime -= ($row10a[6] * $prodpricebase);
                                           }
                                           $AddedOptionsPrice_OneTime += $row10a[4];
                                           if (ATTRIBUTES_ENABLED_QTY_PRICES == true) {
                                              if ($row10a[9] != '' && $row10a[9] != NULL)
                                                  $AddedOptionsPrice += get_attributes_quantity_price_for_editorders($row10a[9], $products_details["qty"]);
                                              if ($row10a[10] != '' && $row10a[10] != NULL)
                                                  $AddedOptionsPrice_OneTime += get_attributes_quantity_price_for_editorders($row10a[10], $products_details["qty"]);
                                           }
                                           if ($_POST[$sendoptionontv] && ATTRIBUTES_ENABLED_TEXT_PRICES == true) {
                                              if ($row10a[11] != 0)
                                                  $AddedOptionsPrice += zen_get_letters_count_price($_POST[$sendoptionontv],$row10a[12],$row10a[11]);
                                              if ($row10a[13] != 0)
                                                  $AddedOptionsPrice += zen_get_word_count_price($_POST[$sendoptionontv],$row10a[14],$row10a[13]);
                                           }
                                        }
                                }


$queryGA=mysql_query("SELECT products_attributes_id, product_attribute_is_free, products_attributes_weight, products_attributes_weight_prefix, attributes_discounted, attributes_price_base_included, attributes_price_onetime, attributes_price_factor, attributes_price_factor_offset, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_words, attributes_price_words_free, attributes_price_letters, attributes_price_letters_free FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$rowSA[products_options_id]' AND options_values_id='$_POST[$sendoptionon]'")
or die('Failed to connect database:  3');
while($row4=mysql_fetch_array($queryGA, MYSQL_NUM)) {
$sendoptionontv = $sendoptionon . "tv";
 if ($_POST[$sendoptionontv])
     $povid4topa = $_POST[$sendoptionontv];
 else 
     $povid4topa = str_replace("'","''",$attributes[$i]);

 $QueryTOPA = "UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " SET
						orders_id = $oID,
						orders_products_id = $orders_products_id,
						products_options = '" . str_replace("'","''",$attributestype[$i]) . "',
						products_options_values = '" . $povid4topa . "',
						options_values_price = '" . $addtotheprice[$i] . "',
                                                products_options_id = '" . $attributestypenumber[$i] . "',
                                                products_options_values_id = '" . $_POST[$sendoptionon] . "',
						price_prefix = '" . $addorsubfromprice[$i] . "',
                                                product_attribute_is_free = '" . $row4[1] . "',
                                                products_attributes_weight = '" . $row4[2] . "',
                                                products_attributes_weight_prefix = '" . $row4[3] . "',
                                                attributes_discounted = '" . $row4[4] . "',
                                                attributes_price_base_included = '" . $row4[5] . "',
                                                attributes_price_onetime = '" . $row4[6] . "',
                                                attributes_price_factor = '" . $row4[7] . "',
                                                attributes_price_factor_offset = '" . $row4[8] . "',
                                                attributes_price_factor_onetime = '" . $row4[9] . "',
                                                attributes_price_factor_onetime_offset = '" . $row4[10] . "',
                                                attributes_qty_prices = '" . $row4[11] . "',
                                                attributes_qty_prices_onetime = '" . $row4[12] . "',
                                                attributes_price_words = '" . $row4[13] . "',
                                                attributes_price_words_free = '" . $row4[14] . "',
                                                attributes_price_letters = '" . $row4[15] . "',
                                                attributes_price_letters_free = '" . $row4[16] . "'
                                                WHERE orders_id = $oID
                                                AND orders_products_id = $orders_products_id
                                                AND products_options_id = '" . $attributestypenumber[$i] . "';";
					$db -> Execute($QueryTOPA); 
 
     $query2=mysql_query("SELECT products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount FROM " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " WHERE products_attributes_id='$row4[0]'")
     or die('Failed to connect database:  2');
     while($row42=mysql_fetch_array($query2, MYSQL_NUM)) {
         if (DOWNLOAD_ENABLED == true) {
          $updatedpdownload = false;
         $queryCPD=mysql_query("SELECT orders_products_filename FROM " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " WHERE orders_id='$oID'")  // Update Download That Already Exists
     or die('Failed to connect database:  2');
         while($rowCPD=mysql_fetch_array($queryCPD, MYSQL_NUM)) {
         if ($rowCPD[0] == $row42[1]) {
         $Query3 = "UPDATE " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " SET
						orders_id = $oID,
                                                orders_products_id = $orders_products_id,
						orders_products_filename = '$row42[1]',
						download_maxdays = $row42[2],
						download_count = $row42[3]
                                                WHERE orders_id='$oID'
                                                AND orders_products_filename='$row42[1]';";
					$db -> Execute($Query3); 
        $updatedpdownload = true;
        }
        }
        if ($updatedpdownload == false) {  //  Add Download
        $Query = "delete from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_products_id = '$orders_products_id' and orders_id = '$oID' and orders_products_filename = '" . $OldAttFileName . "';";  
				$db -> Execute($Query);  // Delete Old Attribute Download First
        $Query3 = "insert into " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set
						orders_id = $oID,
                                                orders_products_id = $orders_products_id,
						orders_products_filename = '$row42[1]',
						download_maxdays = $row42[2],
						download_count = $row42[3];";
					$db -> Execute($Query3); 
        }
        }
     }
}

                                }
                                }

                                $RunningSubTotal += ($AddedOptionsPrice + $AddedOptionsPrice_OneTime);
                                $RunningTax += (($products_details["tax"]/100) * ($AddedOptionsPrice + $AddedOptionsPrice_OneTime));
                                $Query = "update " . TABLE_ORDERS_PRODUCTS . " set
					products_model = '" . $products_details["model"] . "',
					products_name = '" . str_replace("'", "&#39;", $products_details["name"]) . "',
					final_price = '" . ($products_details["final_price"] + $AddedOptionsPrice) . "',
					products_tax = '" . $products_details["tax"] . "',
                                        onetime_charges = '" . ($products_details["onetime_charges"] + $AddedOptionsPrice_OneTime) . "',
					products_quantity = '" . $products_details["qty"] . "'
					where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);

				if(IsSet($products_details[attributes]))
				{     
					foreach($products_details["attributes"] as $orders_products_attributes_id => $attributes_details)
					{
						$Query = "update " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
							products_options = '" . $attributes_details["option"] . "',
                                                        price_prefix = '" . $attributes_details["prefix"] . "',
                                                        options_values_price = '" . $attributes_details["price"] . "',
							products_options_values = '" . $attributes_details["value"] . "',
                                                        attributes_price_onetime = '" . $attributes_details["attributes_price_onetime"] . "'
							where orders_products_attributes_id = '$orders_products_attributes_id';";
						$db -> Execute($Query);
					}
				}
			}
			else
			{
				// 0 Quantity = Delete
$Query = "delete from " . TABLE_ORDERS_PRODUCTS . " where orders_products_id = '$orders_products_id';";
            $db -> Execute($Query);
                $row = $db->fields;
                    //UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
                #$order = zen_db_fetch_array($order_query);
                    if ($products_details["qty"] != $row->fields['products_quantity']){
                        $differenza_quantita = ($products_details["qty"] - $row->fields['products_quantity']);
                        if (STOCK_LIMITED == "true")
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$row->fields['products_id'] . "'");
                        else                           
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$row->fields['products_id'] . "'");
                    } 
				/* $Query = "delete from " . TABLE_ORDERS_PRODUCTS . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
					//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
				#$order = zen_db_fetch_array($order_query);
					if ($products_details["qty"] != $order['products_quantity']){
						$differenza_quantita = ($products_details["qty"] - $order['products_quantity']);
						$db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order['products_id'] . "'");
					} */
					//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
				$Query = "delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
                                $Query = "delete from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
			}
         $order_query -> MoveNext();
		}

		// Shipping Tax
            $update_totals = $_POST['update_totals'];
            $RunningTaxTotalChanges = 0;
			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");
//				if($ot_class == "ot_coupon" || $ot_class == "ot_group_pricing")
				if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing" ||
				$ot_class == "ot_better_together" ||
				$ot_class == "ot_big_chooser" ||
				$ot_class == "ot_bigspender_discount" ||
				$ot_class == "ot_combination_discounts" ||
				$ot_class == "ot_frequency_discount" ||
				$ot_class == "ot_quantity_discount" ||
				$ot_class == "ot_newsletter_discount" ||
				$ot_class == "ot_military_discount")
				{
					$RunningTaxTotalChanges -= (($RunningTax / $RunningSubTotal) * $ot_value);
				}
				if($ot_class == "ot_shipping")
				{ 
					$RunningTaxTotalChanges += (($_POST[shippingtaxrate] / 100) * $ot_value);
				}
			}
            $RunningTax += $RunningTaxTotalChanges;

		// Update Totals

			$RunningTotal = 0;
			$sort_order = 0;

			// Do pre-check for Tax field existence
				$ot_tax_found = 0;
				foreach($update_totals as $total_details)
				{
					extract($total_details,EXTR_PREFIX_ALL,"ot");
					if($ot_class == "ot_tax")
					{
						$ot_tax_found = 1;
						break;
					}
				}

			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");

				if( trim(strtolower($ot_title)) == "tax" || trim(strtolower($ot_title)) == "tax:" )
				{
					if($ot_class != "ot_tax" && $ot_tax_found == 0)
					{
						// Inserting Tax
						$ot_class = "ot_tax";
						$ot_value = "x"; // This gets updated in the next step
						$ot_tax_found = 1;
					}
				}

				if( trim($ot_title) && trim($ot_value) )
				{
					$sort_order++;
                                                $sendtotaltoorders = 0;
					// Update ot_subtotal, ot_tax, and ot_total classes
						if($ot_class == "ot_subtotal")
						$ot_value = $RunningSubTotal;

						if($ot_class == "ot_tax")
						{
						$ot_value = $RunningTax;
                                                $sendtotaltoorders = 2;
						// echo "ot_value = $ot_value<br>\n";
						}

						if($ot_class == "ot_total") {
                                                $sendtotaltoorders = 1;
						$ot_value = $RunningTotal;  }

					// Set $ot_text (display-formatted value)
						// $ot_text = "\$" . number_format($ot_value, 2, '.', ',');

						$order = new order($oID);
						$ot_text = $currencies->format($ot_value, true, $order->info['currency'], $order->info['currency_value']);
//						if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing")
						if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing" ||
						$ot_class == "ot_better_together" ||
						$ot_class == "ot_big_chooser" ||
						$ot_class == "ot_bigspender_discount" ||
						$ot_class == "ot_combination_discounts" ||
						$ot_class == "ot_frequency_discount" ||
						$ot_class == "ot_quantity_discount" ||
						$ot_class == "ot_newsletter_discount" ||
						$ot_class == "ot_military_discount")
                                                    $ot_text = "-" . $ot_text;  
						if($ot_class == "ot_total")
						    $ot_text = "" . $ot_text . "";
                                        if ($sendtotaltoorders == 2)  {   // Update Taxes in TABLE_ORDERS
                                                $Query = "update " . TABLE_ORDERS . " set
                                                        order_tax = '$ot_value'
							where orders_id = '$oID'";
						$db -> Execute($Query);
                                        }
                                        if ($sendtotaltoorders == 1)  {   // Update Order Total in TABLE_ORDERS
                                                $Query = "update " . TABLE_ORDERS . " set
                                                        order_total = '$ot_value'
							where orders_id = '$oID'";
						$db -> Execute($Query);
                                        }
					if($ot_total_id > 0)
					{
						// In Database Already - Update
						$Query = "update " . TABLE_ORDERS_TOTAL . " set
                                                        title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							sort_order = '$sort_order'
							where orders_total_id = '$ot_total_id'";
						$db -> Execute($Query);
					}
					else
					{

						// New Insert
						$Query = "insert into " . TABLE_ORDERS_TOTAL . " set
							orders_id = '$oID',
							title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							class = '$ot_class',
							sort_order = '$sort_order'";
						$db -> Execute($Query);
					}
//					if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing")
					if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing" ||
					$ot_class == "ot_better_together" ||
					$ot_class == "ot_big_chooser" ||
					$ot_class == "ot_bigspender_discount" ||
					$ot_class == "ot_combination_discounts" ||
					$ot_class == "ot_frequency_discount" ||
					$ot_class == "ot_quantity_discount" ||
					$ot_class == "ot_newsletter_discount" ||
					$ot_class == "ot_military_discount")
                                             $RunningTotal -= $ot_value;
                                        else
					     $RunningTotal += $ot_value;
				}
				else if($ot_total_id > 0)
				{
					// Delete Total Piece
					$Query = "delete from " . TABLE_ORDERS_TOTAL . " where orders_total_id = '$ot_total_id'";
					$db -> Execute($Query);
				}

			}

		if ($order_updated)
		{
			$messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
		}
        else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }
		zen_redirect(zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action')) . 'action=edit'));
// TY TRACKER UPDATE ORDER END
} else {

		$oID = zen_db_prepare_input($_GET['oID']);
		$order = new order($oID);
		//$status = zen_db_prepare_input($_POST['status']);
		$status = zen_db_prepare_input($_POST['status'], true);
        //$comments = zen_db_prepare_input($_POST['comments']);
		$comments = mysql_real_escape_string(stripslashes($_POST)); 
		$comments = zen_db_prepare_input($_POST['comments'],true);

		// Update Order Info updated 12/18/2010 to include last date modified

		$UpdateOrders = "update " . TABLE_ORDERS . " set
			customers_name = '" . zen_db_input(stripslashes($_POST['update_customer_name'])) . "',
			customers_company = '" . zen_db_input(stripslashes($_POST['update_customer_company'])) . "',
			customers_street_address = '" . zen_db_input(stripslashes($_POST['update_customer_street_address'])) . "',
			customers_suburb = '" . zen_db_input(stripslashes($_POST['update_customer_suburb'])) . "',
			customers_city = '" . zen_db_input(stripslashes($_POST['update_customer_city'])) . "',
			customers_state = '" . zen_db_input(stripslashes($_POST['update_customer_state'])) . "',
			customers_postcode = '" . zen_db_input(stripslashes($_POST['update_customer_postcode'])) . "',
			customers_country = '" . zen_db_input(stripslashes($_POST['update_customer_country'])) . "',
			customers_telephone = '" . zen_db_input(stripslashes($_POST['update_customer_telephone'])) . "',
			customers_email_address = '" . zen_db_input(stripslashes($_POST['update_customer_email_address'])) . "',
			last_modified=now(),";

		// if($SeparateBillingFields)
		// {
		$UpdateOrders .= "billing_name = '" . zen_db_input(stripslashes($_POST['update_billing_name'])) . "',
			billing_company = '" . zen_db_input(stripslashes($_POST['update_billing_company'])) . "',
			billing_street_address = '" . zen_db_input(stripslashes($_POST['update_billing_street_address'])) . "',
			billing_suburb = '" . zen_db_input(stripslashes($_POST['update_billing_suburb'])) . "',
			billing_city = '" . zen_db_input(stripslashes($_POST['update_billing_city'])) . "',
			billing_state = '" . zen_db_input(stripslashes($_POST['update_billing_state'])) . "',
			billing_postcode = '" . zen_db_input(stripslashes($_POST['update_billing_postcode'])) . "',
			billing_country = '" . zen_db_input(stripslashes($_POST['update_billing_country'])) . "',";
		// }

		$UpdateOrders .= "delivery_name = '" . zen_db_input(stripslashes($_POST['update_delivery_name'])) . "',
			delivery_company = '" . zen_db_input(stripslashes($_POST['update_delivery_company'])) . "',
			delivery_street_address = '" . zen_db_input(stripslashes($_POST['update_delivery_street_address'])) . "',
			delivery_suburb = '" . zen_db_input(stripslashes($_POST['update_delivery_suburb'])) . "',
			delivery_city = '" . zen_db_input(stripslashes($_POST['update_delivery_city'])) . "',
			delivery_state = '" . zen_db_input(stripslashes($_POST['update_delivery_state'])) . "',
			delivery_postcode = '" . zen_db_input(stripslashes($_POST['update_delivery_postcode'])) . "',
			delivery_country = '" . zen_db_input(stripslashes($_POST['update_delivery_country'])) . "',
			payment_method = '" . zen_db_input(stripslashes($_POST['update_info_payment_method'])) . "',
			cc_type = '" . zen_db_input(stripslashes($_POST['update_info_cc_type'])) . "',
			cc_owner = '" . zen_db_input(stripslashes($_POST['update_info_cc_owner'])) . "',";


		if(substr($update_info_cc_number,0,8) != "(Last 4)")
		$UpdateOrders .= "cc_number = '". zen_db_input(stripslashes($_POST['update_info_cc_number'])). "',";

		$UpdateOrders .= "cc_expires = '". zen_db_input(stripslashes($_POST['update_info_cc_expires'])). "',
			orders_status = '" . zen_db_input($status) . "'";

		/* if(!$CommentsWithStatus)
		{
			#$UpdateOrders .= ", comments = '" . zen_db_input($_POST[comments]) . "'";
		} */

		$UpdateOrders .= " where orders_id = '" . zen_db_input($oID) . "';";

		$db -> Execute($UpdateOrders);
		$order_updated = true;

		$check_status = $db->Execute("select customers_name, customers_email_address, orders_status, 
									  date_purchased from " . TABLE_ORDERS . " 
									  where orders_id = '" . (int)$oID . "'");
		// Update Status History & Email Customer if Necessary
		if (($order->info['orders_status'] != $status) ||  zen_not_null($comments))  {
// Notify the customer  
          $customer_notified = '0';
// Now, lets check to see if we want to notify the customer on this last entry          
          if (isset($_POST['notify']) && ($_POST['notify'] == '1')) {  
          $customer_notified = '1';
          }
// Here we check to see if we have clicked on the Hide RadioButton and if so, set the Variable to -1
          if (isset($_POST['notify']) && ($_POST['notify'] == '-1')){
            // hide comment
            $customer_notified = '-1';
          }
   
// OK, we have our Customer Notified Status Number, now update the Order Status History Table  
          update_status($oID, $status, $customer_notified, $comments);
//   Send E-Mail to Customer if they should be notified. Send comments if append comments is checked.

         if ($customer_notified == '1') {
             if (isset($_POST['notify_comments']))   {
              $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $_POST[comments]) . "\n\n";
         }
              $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' <a href="' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . '">' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "</a>\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($check_status->fields['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]);
                          $html_msg['EMAIL_MESSAGE_HTML'] = str_replace('
','<br />',$email);
              zen_mail($check_status->fields['customers_name'], $check_status->fields['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_NAME, STORE_OWNER_EMAIL_ADDRESS, $html_msg, NULL);
                        }
                }

		// Update Products
		$RunningSubTotal = 0;
		$RunningTax = 0;
        $update_products = $_POST['update_products'];
		foreach($update_products as $orders_products_id => $products_details)
		{
                        $AddedOptionsPrice = 0;
                        $AddedOptionsPrice_OneTime = 0;
			// Update orders_products Table
			//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
			#$order = zen_db_fetch_array($order_query);
			if ($products_details["qty"] != $order_query->fields['products_quantity']){
				$differenza_quantita = ($products_details["qty"] - $order_query->fields['products_quantity']);
				if (STOCK_LIMITED == "true")
                                   $db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order_query->fields['products_id'] . "'");
                                else
                                   $db -> Execute("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order_query->fields['products_id'] . "'");
			}
			//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
			if($products_details["qty"] > 0)
			{
				/* $Query = "update " . TABLE_ORDERS_PRODUCTS . " set
					products_model = '" . $products_details["model"] . "',
					products_name = '" . str_replace("'", "&#39;", $products_details["name"]) . "',
					final_price = '" . $products_details["final_price"] . "',
					products_tax = '" . $products_details["tax"] . "',
                                        onetime_charges = '" . $products_details["onetime_charges"] . "',
					products_quantity = '" . $products_details["qty"] . "'
					where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query); */

				// Update Tax and Subtotals
				$RunningSubTotal += ($products_details["qty"] * $products_details["final_price"]) + $products_details["onetime_charges"];
				$RunningTax += (($products_details["tax"]/100) * ($products_details["qty"] * $products_details["final_price"]));
                               
				// Update Any Attributes
   
			// Get Product Attribute Info For Old And New Attribute   
        $QuerySA=mysql_query("SELECT * FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_products_id = '$orders_products_id'")
              or die('Failed to connect database:  SA');
        while($rowSA=mysql_fetch_array($QuerySA, MYSQL_ASSOC)) {
        $sendoptionon = "select_product_options_".$rowSA[orders_products_attributes_id];
        $sendoptionontv = $sendoptionon . "tv";
        $sendoptionontvid = $sendoptionon . "tvid";
        if (($_POST[$sendoptionon] && $rowSA[products_options_values_id] != $_POST[$sendoptionon]) || ($_POST[$sendoptionontv] && $rowSA[products_options_values] != $_POST[$sendoptionontv])) {
	$result9a=mysql_query("SELECT products_options_values_name FROM ".TABLE_PRODUCTS_OPTIONS_VALUES." WHERE products_options_values_id='$_POST[$sendoptionon]' ")
				or die("Failed to connect database: ");
				while($row9a=mysql_fetch_array($result9a, MYSQL_NUM)) {
					$attributes[$i]=$row9a[0]; }

$result8a=mysql_query("SELECT products_options_id FROM ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS." WHERE products_options_values_id='$_POST[$sendoptionon]'")
			or die('Failed to connect database: 8');
if ($_POST[$sendoptionontvid]) {
$attributestypenumber[$i] = $_POST[$sendoptionontvid];
} else {
while($row8a=mysql_fetch_array($result8a, MYSQL_NUM)) {
					$attributestypenumber[$i]=$row8a[0];   }
}

// Old Attribute

$resultOOV=mysql_query("SELECT products_options_values_id FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." WHERE products_options_id='$attributestypenumber[$i]' AND orders_id='$oID' AND orders_products_id='$orders_products_id'")
				or die("Failed to connect database: ");
				while($rowOOV=mysql_fetch_array($resultOOV, MYSQL_NUM)) {
					$OldOptionValueID=$rowOOV[0]; }
$OldPAID = 0;
$resultFPAID=mysql_query("SELECT products_attributes_id FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$attributestypenumber[$i]' AND options_values_id='$OldOptionValueID'")
				or die("Failed to connect database: ");
				while($rowFPAID=mysql_fetch_array($resultFPAID, MYSQL_NUM)) {
					$OldPAID=$rowFPAID[0]; }
$resultOPQ=mysql_query("SELECT products_quantity FROM ".TABLE_ORDERS_PRODUCTS." WHERE orders_products_id = '$orders_products_id'")
				or die("Failed to connect database: ");
				while($rowOPQ=mysql_fetch_array($resultOPQ, MYSQL_NUM)) {
					$OldProductQuantity=$rowOPQ[0]; }
$result9d = mysql_query("SELECT products_price, product_is_free FROM " . TABLE_PRODUCTS . " WHERE products_id='" . (int)$order_query->fields['products_id'] . "'")
                        or die('Failed to connect database:9d');
while($row9d=mysql_fetch_array($result9d, MYSQL_NUM)) {
					$prodpricebase=$row9d[0]; 
                                        $prodisfree=$row9d[1];    }

/* $result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_attributes_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE options_values_id='$OldOptionValueID' AND products_id='" . (int)$order_query->fields['products_id'] . "'")
				or die("Failed to connect database: "); */
$result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_options_values_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_ORDERS_PRODUCTS_ATTRIBUTES." WHERE products_options_id='$attributestypenumber[$i]' AND orders_id='$oID' AND orders_products_id='$orders_products_id'")
				or die("Failed to connect database: ");
				while($row10a=mysql_fetch_array($result10a, MYSQL_NUM)) {
                                        // $OldOptionValueID=$row10a[3];
                                        if ($row10a[2] == 1)
                                            $newpricechange = zen_get_discount_calc((int)$order_query->fields['products_id'], $OldPAID, $row10a[0], $OldProductQuantity);
                                        else
                                            $newpricechange = $row10a[0];
                                        if ($row10a[15] == 0 || $prodisfree == 0)
                                        {
                                           if ($row10a[1] == "-")
                                                $AddedOptionsPrice += $newpricechange;
                                           else
					        $AddedOptionsPrice -= $newpricechange; 
                                           if (ATTRIBUTES_ENABLED_PRICE_FACTOR == true) {
                                              if ($row10a[7] != 0)
                                                  $AddedOptionsPrice -= ($row10a[7] * $prodpricebase);
                                              if ($row10a[8] != 0)
                                                  $AddedOptionsPrice += ($row10a[8] * $prodpricebase);      
                                              if ($row10a[5] != 0)
                                                  $AddedOptionsPrice_OneTime -= ($row10a[5] * $prodpricebase);
                                              if ($row10a[6] != 0)
                                                  $AddedOptionsPrice_OneTime += ($row10a[6] * $prodpricebase);
                                           }
                                           $AddedOptionsPrice_OneTime -= $row10a[4];
                                           if (ATTRIBUTES_ENABLED_QTY_PRICES == true) {
                                              if ($row10a[9] != '' && $row10a[9] != NULL)
                                                  $AddedOptionsPrice -= get_attributes_quantity_price_for_editorders($row10a[9], $OldProductQuantity);
                                              if ($row10a[10] != '' && $row10a[10] != NULL)
                                                  $AddedOptionsPrice_OneTime -= get_attributes_quantity_price_for_editorders($row10a[10], $OldProductQuantity);
                                           }
                                           if ($_POST[$sendoptionontv] && ATTRIBUTES_ENABLED_TEXT_PRICES == true) {
                                              if ($row10a[11] != 0)
                                                  $AddedOptionsPrice -= zen_get_letters_count_price($rowSA[products_options_values],$row10a[12],$row10a[11]);
                                              if ($row10a[13] != 0)
                                                  $AddedOptionsPrice -= zen_get_word_count_price($rowSA[products_options_values],$row10a[14],$row10a[13]);
                                           }
                                        }
                                }
$OldAttFileName='';  $OldPAID = 0;
$resultFPAID=mysql_query("SELECT products_attributes_id FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$attributestypenumber[$i]' AND options_values_id='$OldOptionValueID'")
				or die("Failed to connect database: ");
				while($rowFPAID=mysql_fetch_array($resultFPAID, MYSQL_NUM)) {
					$OldPAID=$rowFPAID[0];
      $queryCPD=mysql_query("SELECT products_attributes_filename FROM " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " WHERE products_attributes_id='$OldPAID'")
                                           or die('Failed to connect database:  2');
                                        while($rowCPD=mysql_fetch_array($queryCPD, MYSQL_NUM)) {
                                        $OldAttFileName=$rowCPD[0]; }  }

// New Attribute


$result8c=mysql_query("SELECT products_options_name FROM ".TABLE_PRODUCTS_OPTIONS." WHERE products_options_id='$attributestypenumber[$i]'")   
			or die('Failed to connect database: 8');
while($row8c=mysql_fetch_array($result8c, MYSQL_NUM)) {
					$attributestype[$i]=$row8c[0]; }

$result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_attributes_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE options_values_id='$_POST[$sendoptionon]' AND products_id='" . (int)$order_query->fields['products_id'] . "'")
				or die("Failed to connect database: ");
				while($row10a=mysql_fetch_array($result10a, MYSQL_NUM)) { 
                                        if ($row10a[2] == 1)
                                            $newpricechange = zen_get_discount_calc((int)$order_query->fields['products_id'], $row10a[3], $row10a[0], $products_details["qty"]);
                                        else
                                            $newpricechange = $row10a[0];
                                        $addtotheprice[$i]=$row10a[0]; $addorsubfromprice[$i]=$row10a[1];
                                        if ($row10a[15] == 0 || $prodisfree == 0)
                                        {
                                           if ($row10a[1] == "-")
                                                $AddedOptionsPrice -= $newpricechange;
                                           else
					        $AddedOptionsPrice += $newpricechange; 
                                           if (ATTRIBUTES_ENABLED_PRICE_FACTOR == true) {
                                              if ($row10a[7] != 0)
                                                  $AddedOptionsPrice += ($row10a[7] * $prodpricebase);
                                              if ($row10a[8] != 0)
                                                  $AddedOptionsPrice -= ($row10a[8] * $prodpricebase);      
                                              if ($row10a[5] != 0)
                                                  $AddedOptionsPrice_OneTime += ($row10a[5] * $prodpricebase);
                                              if ($row10a[6] != 0)
                                                  $AddedOptionsPrice_OneTime -= ($row10a[6] * $prodpricebase);
                                           }
                                           $AddedOptionsPrice_OneTime += $row10a[4];
                                           if (ATTRIBUTES_ENABLED_QTY_PRICES == true) {
                                              if ($row10a[9] != '' && $row10a[9] != NULL)
                                                  $AddedOptionsPrice += get_attributes_quantity_price_for_editorders($row10a[9], $products_details["qty"]);
                                              if ($row10a[10] != '' && $row10a[10] != NULL)
                                                  $AddedOptionsPrice_OneTime += get_attributes_quantity_price_for_editorders($row10a[10], $products_details["qty"]);
                                           }
                                           if ($_POST[$sendoptionontv] && ATTRIBUTES_ENABLED_TEXT_PRICES == true) {
                                              if ($row10a[11] != 0)
                                                  $AddedOptionsPrice += zen_get_letters_count_price($_POST[$sendoptionontv],$row10a[12],$row10a[11]);
                                              if ($row10a[13] != 0)
                                                  $AddedOptionsPrice += zen_get_word_count_price($_POST[$sendoptionontv],$row10a[14],$row10a[13]);
                                           }
                                        }
                                }


$queryGA=mysql_query("SELECT products_attributes_id, product_attribute_is_free, products_attributes_weight, products_attributes_weight_prefix, attributes_discounted, attributes_price_base_included, attributes_price_onetime, attributes_price_factor, attributes_price_factor_offset, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_words, attributes_price_words_free, attributes_price_letters, attributes_price_letters_free FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id='" . (int)$order_query->fields['products_id'] . "' AND options_id='$rowSA[products_options_id]' AND options_values_id='$_POST[$sendoptionon]'")
or die('Failed to connect database:  3');
while($row4=mysql_fetch_array($queryGA, MYSQL_NUM)) {
$sendoptionontv = $sendoptionon . "tv";
 if ($_POST[$sendoptionontv])
     $povid4topa = $_POST[$sendoptionontv];
 else 
     $povid4topa = str_replace("'","''",$attributes[$i]);

 $QueryTOPA = "UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " SET
						orders_id = $oID,
						orders_products_id = $orders_products_id,
						products_options = '" . str_replace("'","''",$attributestype[$i]) . "',
						products_options_values = '" . $povid4topa . "',
						options_values_price = '" . $addtotheprice[$i] . "',
                                                products_options_id = '" . $attributestypenumber[$i] . "',
                                                products_options_values_id = '" . $_POST[$sendoptionon] . "',
						price_prefix = '" . $addorsubfromprice[$i] . "',
                                                product_attribute_is_free = '" . $row4[1] . "',
                                                products_attributes_weight = '" . $row4[2] . "',
                                                products_attributes_weight_prefix = '" . $row4[3] . "',
                                                attributes_discounted = '" . $row4[4] . "',
                                                attributes_price_base_included = '" . $row4[5] . "',
                                                attributes_price_onetime = '" . $row4[6] . "',
                                                attributes_price_factor = '" . $row4[7] . "',
                                                attributes_price_factor_offset = '" . $row4[8] . "',
                                                attributes_price_factor_onetime = '" . $row4[9] . "',
                                                attributes_price_factor_onetime_offset = '" . $row4[10] . "',
                                                attributes_qty_prices = '" . $row4[11] . "',
                                                attributes_qty_prices_onetime = '" . $row4[12] . "',
                                                attributes_price_words = '" . $row4[13] . "',
                                                attributes_price_words_free = '" . $row4[14] . "',
                                                attributes_price_letters = '" . $row4[15] . "',
                                                attributes_price_letters_free = '" . $row4[16] . "'
                                                WHERE orders_id = $oID
                                                AND orders_products_id = $orders_products_id
                                                AND products_options_id = '" . $attributestypenumber[$i] . "';";
					$db -> Execute($QueryTOPA); 
 
     $query2=mysql_query("SELECT products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount FROM " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " WHERE products_attributes_id='$row4[0]'")
     or die('Failed to connect database:  2');
     while($row42=mysql_fetch_array($query2, MYSQL_NUM)) {
         if (DOWNLOAD_ENABLED == true) {
          $updatedpdownload = false;
         $queryCPD=mysql_query("SELECT orders_products_filename FROM " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " WHERE orders_id='$oID'")  // Update Download That Already Exists
     or die('Failed to connect database:  2');
         while($rowCPD=mysql_fetch_array($queryCPD, MYSQL_NUM)) {
         if ($rowCPD[0] == $row42[1]) {
         $Query3 = "UPDATE " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " SET
						orders_id = $oID,
                                                orders_products_id = $orders_products_id,
						orders_products_filename = '$row42[1]',
						download_maxdays = $row42[2],
						download_count = $row42[3]
                                                WHERE orders_id='$oID'
                                                AND orders_products_filename='$row42[1]';";
					$db -> Execute($Query3); 
        $updatedpdownload = true;
        }
        }
        if ($updatedpdownload == false) {  //  Add Download
        $Query = "delete from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_products_id = '$orders_products_id' and orders_id = '$oID' and orders_products_filename = '" . $OldAttFileName . "';";  
				$db -> Execute($Query);  // Delete Old Attribute Download First
        $Query3 = "insert into " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set
						orders_id = $oID,
                                                orders_products_id = $orders_products_id,
						orders_products_filename = '$row42[1]',
						download_maxdays = $row42[2],
						download_count = $row42[3];";
					$db -> Execute($Query3); 
        }
        }
     }
}

                                }
                                }

                                $RunningSubTotal += ($AddedOptionsPrice + $AddedOptionsPrice_OneTime);
                                $RunningTax += (($products_details["tax"]/100) * ($AddedOptionsPrice + $AddedOptionsPrice_OneTime));
                                $Query = "update " . TABLE_ORDERS_PRODUCTS . " set
					products_model = '" . $products_details["model"] . "',
					products_name = '" . str_replace("'", "&#39;", $products_details["name"]) . "',
					final_price = '" . ($products_details["final_price"] + $AddedOptionsPrice) . "',
					products_tax = '" . $products_details["tax"] . "',
                                        onetime_charges = '" . ($products_details["onetime_charges"] + $AddedOptionsPrice_OneTime) . "',
					products_quantity = '" . $products_details["qty"] . "'
					where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);

				if(IsSet($products_details[attributes]))
				{     
					foreach($products_details["attributes"] as $orders_products_attributes_id => $attributes_details)
					{
						$Query = "update " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
							products_options = '" . $attributes_details["option"] . "',
                                                        price_prefix = '" . $attributes_details["prefix"] . "',
                                                        options_values_price = '" . $attributes_details["price"] . "',
							products_options_values = '" . $attributes_details["value"] . "',
                                                        attributes_price_onetime = '" . $attributes_details["attributes_price_onetime"] . "'
							where orders_products_attributes_id = '$orders_products_attributes_id';";
						$db -> Execute($Query);
					}
				}
			}
			else
			{
				// 0 Quantity = Delete
$Query = "delete from " . TABLE_ORDERS_PRODUCTS . " where orders_products_id = '$orders_products_id';";
            $db -> Execute($Query);
                $row = $db->fields;
                    //UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
                #$order = zen_db_fetch_array($order_query);
                    if ($products_details["qty"] != $row->fields['products_quantity']){
                        $differenza_quantita = ($products_details["qty"] - $row->fields['products_quantity']);
                        if (STOCK_LIMITED == "true")
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$row->fields['products_id'] . "'");
                        else                           
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$row->fields['products_id'] . "'");
                    } 
				/* $Query = "delete from " . TABLE_ORDERS_PRODUCTS . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
					//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
				#$order = zen_db_fetch_array($order_query);
					if ($products_details["qty"] != $order['products_quantity']){
						$differenza_quantita = ($products_details["qty"] - $order['products_quantity']);
						$db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $differenza_quantita . ", products_ordered = products_ordered + " . $differenza_quantita . " where products_id = '" . (int)$order['products_id'] . "'");
					} */
					//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
				$Query = "delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
                                $Query = "delete from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_products_id = '$orders_products_id';";
				$db -> Execute($Query);
			}
         $order_query -> MoveNext();
		}

		// Shipping Tax
            $update_totals = $_POST['update_totals'];
            $RunningTaxTotalChanges = 0;
			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");
//									if($ot_class == "ot_coupon" || $ot_class == "ot_group_pricing")
//				{ 
									if ($ot_class == "ot_coupon" || $ot_class == "ot_group_pricing" || $ot_class == "ot_gv" ||
									$ot_class == "ot_better_together" ||
									$ot_class == "ot_big_chooser" ||
									$ot_class == "ot_bigspender_discount" ||
									$ot_class == "ot_combination_discounts" ||
									$ot_class == "ot_frequency_discount" ||
									$ot_class == "ot_quantity_discount" ||
									$ot_class == "ot_newsletter_discount" ||
									$ot_class == "ot_military_discount")
				{
					$RunningTaxTotalChanges -= (($RunningTax / $RunningSubTotal) * $ot_value);
				}
				if($ot_class == "ot_shipping")
				{ 
					$RunningTaxTotalChanges += (($_POST[shippingtaxrate] / 100) * $ot_value);
				}
			}
            $RunningTax += $RunningTaxTotalChanges;

		// Update Totals

			$RunningTotal = 0;
			$sort_order = 0;

			// Do pre-check for Tax field existence
				$ot_tax_found = 0;
				foreach($update_totals as $total_details)
				{
					extract($total_details,EXTR_PREFIX_ALL,"ot");
					if($ot_class == "ot_tax")
					{
						$ot_tax_found = 1;
						break;
					}
				}

			foreach($update_totals as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");

				if( trim(strtolower($ot_title)) == "tax" || trim(strtolower($ot_title)) == "tax:" )
				{
					if($ot_class != "ot_tax" && $ot_tax_found == 0)
					{
						// Inserting Tax
						$ot_class = "ot_tax";
						$ot_value = "x"; // This gets updated in the next step
						$ot_tax_found = 1;
					}
				}

				if( trim($ot_title) && trim($ot_value) )
				{
					$sort_order++;
                                                $sendtotaltoorders = 0;
					// Update ot_subtotal, ot_tax, and ot_total classes
						if($ot_class == "ot_subtotal")
						$ot_value = $RunningSubTotal;

						if($ot_class == "ot_tax")
						{
						$ot_value = $RunningTax;
                                                $sendtotaltoorders = 2;
						// echo "ot_value = $ot_value<br>\n";
						}

						if($ot_class == "ot_total") {
                                                $sendtotaltoorders = 1;
						$ot_value = $RunningTotal;  }

					// Set $ot_text (display-formatted value)
						// $ot_text = "\$" . number_format($ot_value, 2, '.', ',');

						$order = new order($oID);
						$ot_text = $currencies->format($ot_value, true, $order->info['currency'], $order->info['currency_value']);
//													if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing")
													if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing" ||
														$ot_class == "ot_better_together" ||
														$ot_class == "ot_big_chooser" ||
														$ot_class == "ot_bigspender_discount" ||
														$ot_class == "ot_combination_discounts" ||
														$ot_class == "ot_frequency_discount" ||
														$ot_class == "ot_quantity_discount" ||
														$ot_class == "ot_newsletter_discount" ||
														$ot_class == "ot_military_discount")
                                                    $ot_text = "-" . $ot_text;  
						if($ot_class == "ot_total")
						    $ot_text = "" . $ot_text . "";
                                        if ($sendtotaltoorders == 2)  {   // Update Taxes in TABLE_ORDERS
                                                $Query = "update " . TABLE_ORDERS . " set
                                                        order_tax = '$ot_value'
							where orders_id = '$oID'";
						$db -> Execute($Query);
                                        }
                                        if ($sendtotaltoorders == 1)  {   // Update Order Total in TABLE_ORDERS
                                                $Query = "update " . TABLE_ORDERS . " set
                                                        order_total = '$ot_value'
							where orders_id = '$oID'";
						$db -> Execute($Query);
                                        }
					if($ot_total_id > 0)
					{
						// In Database Already - Update
						$Query = "update " . TABLE_ORDERS_TOTAL . " set
                                                        title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							sort_order = '$sort_order'
							where orders_total_id = '$ot_total_id'";
						$db -> Execute($Query);
					}
					else
					{

						// New Insert
						$Query = "insert into " . TABLE_ORDERS_TOTAL . " set
							orders_id = '$oID',
							title = '$ot_title',
							text = '$ot_text',
							value = '$ot_value',
							class = '$ot_class',
							sort_order = '$sort_order'";
						$db -> Execute($Query);
					}
//										if ($ot_class == "ot_coupon" || $ot_class == "ot_gv" || $ot_class == "ot_group_pricing")
										if ($ot_class == "ot_gv" || $ot_class == "ot_coupon" || $ot_class == "ot_group_pricing" ||
										$ot_class == "ot_better_together" ||
										$ot_class == "ot_big_chooser" ||
										$ot_class == "ot_bigspender_discount" ||
										$ot_class == "ot_combination_discounts" ||
										$ot_class == "ot_frequency_discount" ||
										$ot_class == "ot_quantity_discount" ||
										$ot_class == "ot_newsletter_discount" ||
										$ot_class == "ot_military_discount")
                                             $RunningTotal -= $ot_value;
                                        else
					     $RunningTotal += $ot_value;
				}
				else if($ot_total_id > 0)
				{
					// Delete Total Piece
					$Query = "delete from " . TABLE_ORDERS_TOTAL . " where orders_total_id = '$ot_total_id'";
					$db -> Execute($Query);
				}

			}

		if ($order_updated)
		{
			$messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
		}
        else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }
		zen_redirect(zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action')) . 'action=edit'));
}

	break;

	// Add a Product
	case 'add_prdct':
		if($step == 5)
		{
			// Get Order Info
			$oID = zen_db_prepare_input($_GET['oID']);
			$order = new order($oID);

			$AddedOptionsPrice = 0;
                        $AddedOptionsPrice_OneTime = 0;

			// Get Product Attribute Info
if ($_POST[optionstoadd] != NULL) {
      for ($i=1; $i<=$_POST[optionstoadd]; $i++) {
        $sendoptionon = "add_product_options".$i;
        $sendoptionontv = $sendoptionon . "tv";
        $sendoptionontvid = $sendoptionon . "tvid";
	$result9a=mysql_query("SELECT products_options_values_name FROM ".TABLE_PRODUCTS_OPTIONS_VALUES." WHERE products_options_values_id='$_POST[$sendoptionon]' ")
				or die("Failed to connect database: ");
				while($row9a=mysql_fetch_array($result9a, MYSQL_NUM)) {
					$attributes[$i]=$row9a[0]; }
$result8a=mysql_query("SELECT products_options_id FROM ".TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS." WHERE  products_options_values_id='$_POST[$sendoptionon]'")
			or die('Failed to connect database: 8');
if ($_POST[$sendoptionontvid]) {
$attributestypenumber[$i]=$_POST[$sendoptionontvid];
} else {
while($row8a=mysql_fetch_array($result8a, MYSQL_NUM)) {
					$attributestypenumber[$i]=$row8a[0]; }
}
$result8c=mysql_query("SELECT products_options_name FROM ".TABLE_PRODUCTS_OPTIONS." WHERE products_options_id='$attributestypenumber[$i]'")
			or die('Failed to connect database: 8');

while($row8c=mysql_fetch_array($result8c, MYSQL_NUM)) {
					$attributestype[$i]=$row8c[0]; }
$result9d = mysql_query("SELECT products_price, product_is_free FROM " . TABLE_PRODUCTS . " WHERE products_id='$add_product_products_id'")
                        or die('Failed to connect database:9d');
while($row9d=mysql_fetch_array($result9d, MYSQL_NUM)) {
					$prodpricebase=$row9d[0]; 
                                        $prodisfree=$row9d[1];    }

$result10a=mysql_query("SELECT options_values_price, price_prefix, attributes_discounted, products_attributes_id, attributes_price_onetime, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_price_factor, attributes_price_factor_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_letters, attributes_price_letters_free, attributes_price_words, attributes_price_words_free, product_attribute_is_free FROM ".TABLE_PRODUCTS_ATTRIBUTES." WHERE options_values_id='$_POST[$sendoptionon]' AND products_id='$add_product_products_id'")
				or die("Failed to connect database: ");
				while($row10a=mysql_fetch_array($result10a, MYSQL_NUM)) { 
                                        if ($row10a[2] == 1 && $_POST[applyspecialstoprice])
                                            $newpricechange = zen_get_discount_calc($add_product_products_id, $row10a[3], $row10a[0], $add_product_quantity);
                                        else
                                            $newpricechange = $row10a[0];
                                        $addtotheprice[$i]=$row10a[0]; $addorsubfromprice[$i]=$row10a[1];
                                        if ($row10a[15] == 0 || $prodisfree == 0)
                                        {
                                           if ($row10a[1] == "-")
                                                $AddedOptionsPrice -= $newpricechange;
                                           else
					        $AddedOptionsPrice += $newpricechange; 
                                           if (ATTRIBUTES_ENABLED_PRICE_FACTOR == true) {
                                              if ($row10a[7] != 0)
                                                  $AddedOptionsPrice += ($row10a[7] * $prodpricebase);
                                              if ($row10a[8] != 0)
                                                  $AddedOptionsPrice -= ($row10a[8] * $prodpricebase);      
                                              if ($row10a[5] != 0)
                                                  $AddedOptionsPrice_OneTime += ($row10a[5] * $prodpricebase);
                                              if ($row10a[6] != 0)
                                                  $AddedOptionsPrice_OneTime -= ($row10a[6] * $prodpricebase);
                                           }
                                           $AddedOptionsPrice_OneTime += $row10a[4];
                                           if (ATTRIBUTES_ENABLED_QTY_PRICES == true) {
                                              if ($row10a[9] != '' && $row10a[9] != NULL)
                                                  $AddedOptionsPrice += get_attributes_quantity_price_for_editorders($row10a[9], $add_product_quantity);
                                              if ($row10a[10] != '' && $row10a[10] != NULL)
                                                  $AddedOptionsPrice_OneTime += get_attributes_quantity_price_for_editorders($row10a[10], $add_product_quantity);
                                           }
                                           if ($_POST[$sendoptionontv] && ATTRIBUTES_ENABLED_TEXT_PRICES == true) {
                                              if ($row10a[11] != 0)
                                                  $AddedOptionsPrice += zen_get_letters_count_price($_POST[$sendoptionontv],$row10a[12],$row10a[11]);
                                              if ($row10a[13] != 0)
                                                  $AddedOptionsPrice += zen_get_word_count_price($_POST[$sendoptionontv],$row10a[14],$row10a[13]);
                                           }
                                        }
                                }
}
}
			/* if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					$result = $db -> Execute("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id='$add_product_products_id' and options_id=$option_id and options_values_id=$option_value_id");
					###r.l. $row = zen_db_fetch_array($result);
                    $row = $result->fields;
					extract($row, EXTR_PREFIX_ALL, "opt");
					$AddedOptionsPrice += $opt_options_values_price;
					$option_value_details[$option_id][$option_value_id] = array ("options_values_price" => $opt_options_values_price);
					$option_names[$option_id] = $opt_products_options_name;
					$option_values_names[$option_value_id] = $opt_products_options_values_name;
				}
			} */

			// Get Product Info
			$InfoQuery = "select p.products_model,p.products_price,pd.products_name,p.products_tax_class_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id=p.products_id where p.products_id='$add_product_products_id'";
			$result = $db -> Execute($InfoQuery);
			#$row = zen_db_fetch_array($result);
			extract($result->fields, EXTR_PREFIX_ALL, "p");

			// Following functions are defined at the bottom of this file
			$CountryID = zen_get_country_id($order->delivery["country"]);
			$ZoneID = zen_get_zone_id($CountryID, $order->delivery["state"]);

			$ProductsTax = zen_get_tax_rate($p_products_tax_class_id, $CountryID, $ZoneID);
                        if ($_POST[applyspecialstoprice] && zen_get_products_special_price((int)$add_product_products_id))
                            $product_price_woa = zen_get_products_special_price((int)$add_product_products_id);
                        else
                            $product_price_woa = $p_products_price;
			$Query = "insert into " . TABLE_ORDERS_PRODUCTS . " set
				orders_id = $oID,
				products_id = $add_product_products_id,
				products_model = '$p_products_model',
				products_name = '" . str_replace("'", "&#39;", $p_products_name) . "',
				products_price = '$product_price_woa',
				final_price = '" . ($product_price_woa + $AddedOptionsPrice) . "',
				products_tax = '$ProductsTax',
				products_quantity = $add_product_quantity,
                                onetime_charges = $AddedOptionsPrice_OneTime;";
			$db -> Execute($Query);

			$new_product_id = zen_db_insert_id();
			//UPDATE_INVENTORY_QUANTITY_START##############################################################################################################
			if (STOCK_LIMITED == "true")
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity - " . $add_product_quantity . ", products_ordered = products_ordered + " . $add_product_quantity . " where products_id = '" . $add_product_products_id . "'");
                        else
                            $db -> Execute("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . $add_product_quantity . " where products_id = '" . $add_product_products_id . "'");
			//UPDATE_INVENTORY_QUANTITY_END##############################################################################################################
if ($_POST[optionstoadd] != NULL) {
      for ($i=1; $i<=$_POST[optionstoadd]; $i++) {
$sendoptionon = "add_product_options".$i;


$query=mysql_query("SELECT products_attributes_id, product_attribute_is_free, products_attributes_weight, products_attributes_weight_prefix, attributes_discounted, attributes_price_base_included, attributes_price_onetime, attributes_price_factor, attributes_price_factor_offset, attributes_price_factor_onetime, attributes_price_factor_onetime_offset, attributes_qty_prices, attributes_qty_prices_onetime, attributes_price_words, attributes_price_words_free, attributes_price_letters, attributes_price_letters_free FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id='$add_product_products_id' AND options_id='$attributestypenumber[$i]' AND options_values_id='$_POST[$sendoptionon]'")
or die('Failed to connect database:  3');
while($row4=mysql_fetch_array($query, MYSQL_NUM)) {
$sendoptionontv = $sendoptionon . "tv";
if ($_POST[$sendoptionontv])
     $povid4topa = $_POST[$sendoptionontv];
else
     $povid4topa = str_replace("'","''",$attributes[$i]);

 $QueryTOPA = "insert into " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
						orders_id = $oID,
						orders_products_id = $new_product_id,
						products_options = '" . str_replace("'","''",$attributestype[$i]) . "',
						products_options_values = '" . $povid4topa . "',
						options_values_price = '" . $addtotheprice[$i] . "',
                                                products_options_id = '" . $attributestypenumber[$i] . "',
                                                products_options_values_id = '" . $_POST[$sendoptionon] . "',
						price_prefix = '" . $addorsubfromprice[$i] . "',
                                                product_attribute_is_free = '" . $row4[1] . "',
                                                products_attributes_weight = '" . $row4[2] . "',
                                                products_attributes_weight_prefix = '" . $row4[3] . "',
                                                attributes_discounted = '" . $row4[4] . "',
                                                attributes_price_base_included = '" . $row4[5] . "',
                                                attributes_price_onetime = '" . $row4[6] . "',
                                                attributes_price_factor = '" . $row4[7] . "',
                                                attributes_price_factor_offset = '" . $row4[8] . "',
                                                attributes_price_factor_onetime = '" . $row4[9] . "',
                                                attributes_price_factor_onetime_offset = '" . $row4[10] . "',
                                                attributes_qty_prices = '" . $row4[11] . "',
                                                attributes_qty_prices_onetime = '" . $row4[12] . "',
                                                attributes_price_words = '" . $row4[13] . "',
                                                attributes_price_words_free = '" . $row4[14] . "',
                                                attributes_price_letters = '" . $row4[15] . "',
                                                attributes_price_letters_free = '" . $row4[16] . "';";
					$db -> Execute($QueryTOPA); 

     $query2=mysql_query("SELECT products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount FROM " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " WHERE products_attributes_id='$row4[0]'")
     or die('Failed to connect database:  2');
     while($row42=mysql_fetch_array($query2, MYSQL_NUM)) {
         if (DOWNLOAD_ENABLED == true) {
         $Query3 = "insert into " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set
						orders_id = $oID,
                                                orders_products_id = $new_product_id,
						orders_products_filename = '$row42[1]',
						download_maxdays = $row42[2],
						download_count = $row42[3];";
					$db -> Execute($Query3); 
        }
     }
}



}
}
/* if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					$Query = "insert into " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
						orders_id = $oID,
						orders_products_id = $new_product_id,
						products_options = '" . $option_names[$option_id] . "',
						products_options_values = '" . $option_values_names[$option_value_id] . "',
						options_values_price = '" . $option_value_details[$option_id][$option_value_id]["options_values_price"] . "',
						price_prefix = '+';";
					$db -> Execute($Query);
				}
			} */

			// Calculate Tax and Sub-Totals
			$order = new order($oID);
			$RunningSubTotal = 0;
			$RunningTax = 0;

			for ($i=0; $i<sizeof($order->products); $i++)
			{
			$RunningSubTotal += (($order->products[$i]['qty'] * $order->products[$i]['final_price']) + $order->products[$i]['onetime_charges']);
			$RunningTax += (($order->products[$i]['tax'] / 100) * ($order->products[$i]['qty'] * $order->products[$i]['final_price']));
			}
   
                          
			$order = new order($oID);
						                        

			// Tax
			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '" . $currencies->format($RunningTax, true, $order->info['currency'], $order->info['currency_value']) . "',
				value = '" . $RunningTax . "'
				where class='ot_tax' and orders_id=$oID";
			$db -> Execute($Query);

			// Sub-Total
			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '" . $currencies->format($RunningSubTotal, true, $order->info['currency'], $order->info['currency_value']) . "',
				value = '" . $RunningSubTotal . "'
				where class='ot_subtotal' and orders_id=$oID";
			$db -> Execute($Query);

			// Total
			$Query = "select sum(value) as total_value from " . TABLE_ORDERS_TOTAL . " where class != 'ot_total' and orders_id=$oID";
			$result = $db -> Execute($Query);
			#$row = zen_db_fetch_array($result);
			$Total = $result->fields["total_value"];

			$Query = "update " . TABLE_ORDERS_TOTAL . " set
				text = '" . $currencies->format($Total, true, $order->info['currency'], $order->info['currency_value']) . "',
				value = '" . $Total . "'
				where class='ot_total' and orders_id=$oID";
			$db -> Execute($Query);
			
			// Update TABLE_ORDERS with Total and Tax
			$Query = "SELECT * FROM " . TABLE_ORDERS_TOTAL . " WHERE class='ot_tax' and orders_id=$oID";
                        $result = mysql_query($query);
                        if ($result) {
			 $Query = "update " . TABLE_ORDERS . " set
                                                        order_tax = '$RunningTax',
                                                        order_total = '$Total'
							where orders_id = '$oID'";
						$db -> Execute($Query);
		        } else {
		         $Query = "update " . TABLE_ORDERS . " set
                                                        order_total = '$Total'
							where orders_id = '$oID'";
						$db -> Execute($Query);
			}
			
			zen_redirect(zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action')) . 'action=edit'));

		}
	break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = zen_db_prepare_input($_GET['oID']);

    $orders_query = $db -> Execute("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!$orders_query->RecordCount()) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/edit_orders.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>

</head>
<body onload="init()">
<!-- header //-->
<div class="header-area">
<?php 
	require(DIR_WS_INCLUDES . 'header.php'); 
?>
</div>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td valign="top">
	
</td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order($oID);
?>


      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?> #<?php echo $oID; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
<!-- BOF Return to order list or order details - if Super Orders admin flag is set to TRUE displays buttons to return to Super Orders order list or Super Orders order details page -->
<?php if (SO_SWITCH == 'True') { ?>
            <td class="pageHeading" align="right">
	    <?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?>
	    <?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_ORDER_DETAILS) . '</a>'; ?>
	    </td>	
<?php } else { ?>
            <td class="pageHeading" align="right">
	    <?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('action'))) . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?>
	    <?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_ORDER_DETAILS) . '</a>'; ?>
	    </td>
<?php } ?>
<!-- EOF Return to order list or order details - if Super Orders admin flag is set to TRUE displays buttons to return to Super Orders order list or Super Orders order details page -->
         </tr>
        </table></td>
      </tr>


<!-- Begin Addresses Block -->
      <tr><?php echo zen_draw_form('edit_order', FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action','paycc')) . 'action=update_order'); ?>
      <td>
      <table width="100%" border="0">
	  <tr> 
	  <td>
      <table width="100%" border="0">
 <tr>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER; ?></strong></td>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
    <td>&nbsp;</td>
    <td valign="top"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
  </tr>
 <tr>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_customers.png', ENTRY_CUSTOMER); ?></td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_billing.png', ENTRY_BILLING_ADDRESS); ?></td>
    <td>&nbsp;</td>
    <td valign="top"><?php echo zen_image(DIR_WS_IMAGES . 'icon_shipping.png', ENTRY_SHIPPING_ADDRESS); ?></td>
  </tr>

  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_NAME; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_name" size="45" value="<?php echo zen_html_quotes($order->customer['name']); ?>"></td>
	<td valign="top"><strong><?php echo ENTRY_CUSTOMER_NAME; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_name" size="45" value="<?php echo zen_html_quotes($order->billing['name']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_NAME; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_name" size="45" value="<?php echo zen_html_quotes($order->delivery['name']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COMPANY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_company" size="45" value="<?php echo zen_html_quotes($order->customer['company']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COMPANY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_company" size="45" value="<?php echo zen_html_quotes($order->billing['company']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COMPANY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_company" size="45" value="<?php echo zen_html_quotes($order->delivery['company']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_street_address" size="45" value="<?php echo zen_html_quotes($order->customer['street_address']); ?>"></td>
    <td valign="top"><strong> <?php echo ENTRY_CUSTOMER_ADDRESS; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_street_address" size="45" value="<?php echo zen_html_quotes($order->billing['street_address']); ?>"></td>
    <td valign="top"><strong> <?php echo ENTRY_CUSTOMER_ADDRESS; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_street_address" size="45" value="<?php echo zen_html_quotes($order->delivery['street_address']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_SUBURB; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_suburb" size="45" value="<?php echo zen_html_quotes($order->customer['suburb']); ?>"></td>
    <td valign="top"><strong> <?php echo ENTRY_CUSTOMER_SUBURB; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_suburb" size="45" value="<?php echo zen_html_quotes($order->billing['suburb']); ?>"></td>
    <td valign="top"><strong> <?php echo ENTRY_CUSTOMER_SUBURB; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_suburb" size="45" value="<?php echo zen_html_quotes($order->delivery['suburb']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_CITY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_city" size="45" value="<?php echo zen_html_quotes($order->customer['city']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_CITY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_city" size="45" value="<?php echo zen_html_quotes($order->billing['city']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_CITY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_city" size="45" value="<?php echo zen_html_quotes($order->delivery['city']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_STATE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_state" size="45" value="<?php echo zen_html_quotes($order->customer['state']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_STATE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_state" size="45" value="<?php echo zen_html_quotes($order->billing['state']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_STATE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_state" size="45" value="<?php echo zen_html_quotes($order->delivery['state']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_POSTCODE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_postcode" size="45" value="<?php echo zen_html_quotes($order->customer['postcode']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_POSTCODE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_postcode" size="45" value="<?php echo zen_html_quotes($order->billing['postcode']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_POSTCODE; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_postcode" size="45" value="<?php echo zen_html_quotes($order->delivery['postcode']); ?>"></td>
  </tr>
  <tr>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COUNTRY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_customer_country" size="45" value="<?php echo zen_html_quotes($order->customer['country']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COUNTRY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_billing_country" size="45" value="<?php echo zen_html_quotes($order->billing['country']); ?>"></td>
    <td valign="top"><strong><?php echo ENTRY_CUSTOMER_COUNTRY; ?>:&nbsp;</strong></td>
    <td valign="top"><input name="update_delivery_country" size="45" value="<?php echo zen_html_quotes($order->delivery['country']); ?>"></td>
  </tr>
</table>
</td></tr></table>
<!-- End Addresses Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Phone/Email Block -->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
      		<tr>
      		  <td class="main"><strong><?php echo ENTRY_TELEPHONE_NUMBER; ?></strong></td>
      		  <td class="main"><input name='update_customer_telephone' size='15' value='<?php echo zen_html_quotes($order->customer['telephone']); ?>'></td>
      		</tr>
      		<tr>
      		  <td class="main"><strong><?php echo ENTRY_EMAIL_ADDRESS; ?></strong></td>
      		  <td class="main"><input name='update_customer_email_address' size='35' value='<?php echo zen_html_quotes($order->customer['email_address']); ?>'></td>
      		</tr>
      	</table></td>
      </tr>
      </td>
      </tr>
<!-- End Phone/Email Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Payment Block -->
      <tr>
	<td><table border="0" cellspacing="0" cellpadding="2">
	  <tr>
	    <td class="main"><strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong></td>
	    <td class="main"><input name='update_info_payment_method' size='20' value='<?php echo zen_html_quotes($order->info['payment_method']); ?>'>
	    <?php
	    if($order->info['payment_method'] != "Credit Card")
	    echo ENTRY_UPDATE_TO_CC;
		else
	    echo ENTRY_UPDATE_TO_CK;		
	    ?></td>
	  </tr>

	<?php if ($order->info['cc_type'] || $order->info['cc_owner'] || $order->info['payment_method'] == "Credit Card" || $order->info['cc_number']) { ?>
	  <!-- Begin Credit Card Info Block -->
	  <tr>
	    <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
	  </tr>
	  <tr>
	    <td class="main"><strong><?php echo ENTRY_CREDIT_CARD_TYPE; ?></strong></td>
	    <td class="main"><input name='update_info_cc_type' size='10' value='<?php echo zen_html_quotes($order->info['cc_type']); ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><strong><?php echo ENTRY_CREDIT_CARD_OWNER; ?></strong></td>
	    <td class="main"><input name='update_info_cc_owner' size='20' value='<?php echo zen_html_quotes($order->info['cc_owner']); ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><strong><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></strong></td>
	    <td class="main"><input name='update_info_cc_number' size='20' value='<?php echo zen_html_quotes($order->info['cc_number']); ?>'></td>
	  </tr>
	  <tr>
	    <td class="main"><strong><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></strong></td>
	    <td class="main"><input name='update_info_cc_expires' size='4' value='<?php echo zen_html_quotes($order->info['cc_expires']); ?>'></td>
	  </tr>
	  <!-- End Credit Card Info Block -->
	<?php } ?>
	
	<?php
        if( (zen_not_null($order->info['account_name']) || zen_not_null($order->info['account_number']) || zen_not_null($order->info['po_number'])) ) {
		?>
		          <tr>
		            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_ACCOUNT_NAME; ?></td>
		            <td class="main"><?php echo zen_html_quotes($order->info['account_name']); ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_ACCOUNT_NUMBER; ?></td>
		            <td class="main"><?php echo zen_html_quotes($order->info['account_number']); ?></td>
		          </tr>
		          <tr>
		            <td class="main"><?php echo ENTRY_PURCHASE_ORDER_NUMBER; ?></td>
		            <td class="main"><?php echo zen_html_quotes($order->info['po_number']); ?></td>
		          </tr>
		<?php
		// purchaseorder end
		    }
?>

	</table></td>
      </tr>
      <tr>
	<td valign="top"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
      </tr>
<!-- End Payment Block -->

      <tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Products Listing Block -->
      <tr>
	<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr class="dataTableHeadingRow">
	    <td class="dataTableHeadingContent" colspan="2" width="35%"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
	    <td class="dataTableHeadingContent" width="35%"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
	    <td class="dataTableHeadingContent" align="right" width="10%"><?php echo TABLE_HEADING_TAX; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	    <td class="dataTableHeadingContent" align="right" width="10%"><?php echo TABLE_HEADING_UNIT_PRICE; ?></td>
	    <td class="dataTableHeadingContent" align="right" width="10%"><?php echo TABLE_HEADING_TOTAL_PRICE; ?></td>
	  </tr>

	<!-- Begin Products Listings Block -->
	<?php 
      	// Override order.php Class's Field Limitations
		$index = 0;
		$order->products = array();
		$orders_products_query = $db -> Execute("select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$oID . "'");
		#while ($orders_products = zen_db_fetch_array($orders_products_query)) {
      while (!$orders_products_query -> EOF){
		$order->products[$index] = array('qty' => $orders_products_query->fields['products_quantity'],
                                        'name' => zen_html_quotes($orders_products_query->fields['products_name']),
                                        'model' => zen_html_quotes($orders_products_query->fields['products_model']),
                                        'tax' => $orders_products_query->fields['products_tax'],
                                        'price' => $orders_products_query->fields['products_price'],
                                        'final_price' => $orders_products_query->fields['final_price'],
                                        'onetime_charges' => $orders_products_query->fields['onetime_charges'],
                                        'products_id' => $orders_products_query->fields['products_id'],
                                        'orders_products_id' => $orders_products_query->fields['orders_products_id']);

		$subindex = 0;
		$attributes_query_string = "select * from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$oID . "' and orders_products_id = '" . (int)$orders_products_query->fields['orders_products_id'] . "'";
		$attributes_query = $db -> Execute($attributes_query_string);

		#while ($attributes = zen_db_fetch_array($attributes_query)) {
      while (!$attributes_query -> EOF){
		  $order->products[$index]['attributes'][$subindex] = array('option' => zen_html_quotes($attributes_query->fields['products_options']),
		                                                           'value' => zen_html_quotes($attributes_query->fields['products_options_values']),
		                                                           'prefix' => $attributes_query->fields['price_prefix'],
		                                                           'price' => $attributes_query->fields['options_values_price'],
                                                                           'options_values_id' => $attributes_query->fields['products_options_values_id'],
                                                                           'options_id' => $attributes_query->fields['products_options_id'],
		                                                           'orders_products_attributes_id' => $attributes_query->fields['orders_products_attributes_id']);
		$subindex++;
      $attributes_query -> MoveNext();
		}
		$index++;
      $orders_products_query -> MoveNext();

		}

	for ($i=0; $i<sizeof($order->products); $i++) {
		$orders_products_id = $order->products[$i]['orders_products_id'];

		$RowStyle = "dataTableContent";

		echo '	  <tr class="dataTableRow">' . "\n" .
		   '	    <td class="' . $RowStyle . '" valign="top" align="left">' . "<input name='update_products[$orders_products_id][qty]' size='2' value='" . $order->products[$i]['qty'] . "'>&nbsp;&nbsp;&nbsp;&nbsp; X</td>\n" .
		   '	    <td class="' . $RowStyle . '" valign="top" align="left">' . "<input name='update_products[$orders_products_id][name]' size='55' value='" . $order->products[$i]['name'] . "'>";

		// Has Attributes?
		if (sizeof($order->products[$i]['attributes']) > 0) {
echo '<br><nobr><small>&nbsp;<i> '.TEXT_ATTRIBUTES_ONE_TIME_CHARGE.' ' . "<input name='update_products[$orders_products_id][onetime_charges]' size='8' value='" . $order->products[$i]['onetime_charges'] . "'>";
if ($_GET[advancedoptions] != 'yes')
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $PHP_SELF . "?oID=$oID&action=edit&advancedoptions=yes'> ". TEXT_ATTRIBUTES_ADVANCED_EDITOR ." </a>";
else
    echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='" . $PHP_SELF . "?oID=$oID&action=edit'> ". TEXT_ATTRIBUTES_SIMPLE_EDITOR ." </a>";
echo "</i></small></nobr>";
$regular_product_id = $order->products[$i]['products_id'];

// Get Options for Products
unset($Options);
unset($OptType);
unset($ProductOptionValues);
unset($OptionsThatAreText);
$OptionsThatAreText = array();
for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) {
      $arroptvalues[$j] = $order->products[$i]['attributes'][$j]['options_id'];
}
			$result = $db -> Execute("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id='$regular_product_id'");

            while (!$result -> EOF){
 					extract($result->fields,EXTR_PREFIX_ALL,"db");
					$Options[$db_products_options_id] = $db_products_options_name;
                                        $OptType[$db_products_options_id] = $db_products_options_type;
					$ProductOptionValues[$db_products_options_id][$db_products_options_values_id] = $db_products_options_values_name;
               $result -> MoveNext();
				}
                                $OptionOption = '';
				foreach($ProductOptionValues as $OptionID => $OptionValues)
				{
                                        $resultopai = mysql_query("SELECT orders_products_attributes_id FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE products_options_id='$OptionID' AND orders_products_id='$orders_products_id'")
                                              or die('Failed to connect database:opai');
                                        while($rowopai=mysql_fetch_array($resultopai, MYSQL_NUM)) {
                                        $sendoptionon = "select_product_options_".$rowopai[0];
                                        }
                                        $sendoptionontv = $sendoptionon . "tv"; 
                                        $sendoptionontvid = $sendoptionon . "tvid";
                                        if (in_array($OptionID, $arroptvalues))  {
                                            if ($OptType[$OptionID] == 1)
                                                $OptionOption .= "<br><nobr><small>&nbsp;<i>" . $Options[$OptionID] . " - ";
                                            else
	   		       		        $OptionOption .= "<br><nobr><small>&nbsp;<i>" . $Options[$OptionID] . " - <select name='$sendoptionon'>";
					    foreach($OptionValues as $OptionValueID => $OptionValueName)
					    { 
                                                if ($OptType[$OptionID] == 1)
                                                    $OptionOption .= "<input type='hidden' name='$sendoptionon' value='$OptionValueID'><input type='hidden' name='$sendoptionontvid' value='$OptionID'>";
                                                else
                                                    $OptionOption .= "<option value='$OptionValueID'> $OptionValueName\n";	
			                    }
                                          if ($OptType[$OptionID] == 1) {
                                              $OptionOption .= "<input type='text' size='15' name='" . $sendoptionon . "tv'>";
                                              $OptionsThatAreText[$OptionID] = $OptionID;
                                          } else {
                                              $OptionOption .= "</select>";
                                          }
                                          $OptionOption .= "</i></small></nobr>";
                                        
					/*if(IsSet($_POST[$sendoptionon])) {
                                        $sendoptionontv = $sendoptionon . "tv";
					$OptionOption = str_replace("value='" . $_POST[$sendoptionon] . "'","value='" . $_POST[$sendoptionon] . "' selected",$OptionOption);
                                        $OptionOption = str_replace("<input type='text' size='15' name='" . $sendoptionon . "tv'>","<input type='text' size='15' name='" . $sendoptionon . "tv' value='" . htmlentities($_POST[$sendoptionontv]) . "'>",$OptionOption);
                                        } */ 
					// echo $OptionOption . "";
                                        }
				}
// FINDME
        
			for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) { 
				$orders_products_attributes_id = $order->products[$i]['attributes'][$j]['orders_products_attributes_id'];
                                $sendoptionon = "select_product_options_".$orders_products_attributes_id;
                                $OptionOption = str_replace("option value='" . $order->products[$i]['attributes'][$j]['options_values_id'] . "'","option value='" . $order->products[$i]['attributes'][$j]['options_values_id'] . "' selected",$OptionOption);
                                if (in_array($order->products[$i]['attributes'][$j]['options_id'], $OptionsThatAreText)) {
                                   $OptionOption = str_replace("<input type='text' size='15' name='" . $sendoptionon . "tv'>","<input type='text' size='15' name='" . $sendoptionon . "tv' value='" . $order->products[$i]['attributes'][$j]['value'] . "'>",$OptionOption);
}
                                if ($_GET[advancedoptions] == 'yes') {
				echo '<br><nobr><small>&nbsp;<i> '.TEXT_ATTRIBUTES_PRODUCT_OPTION.' ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][option]' size='25' value='" . $order->products[$i]['attributes'][$j]['option'] . "'>" . ': ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][value]' size='20' value='" . $order->products[$i]['attributes'][$j]['value'] . "'>";
                                echo '</i></small></nobr>';
				echo '<br><nobr><small>&nbsp;<i> '.TEXT_ATTRIBUTES_OPTION_PRICE_CHANGE.' ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][prefix]' size='4' value='" . $order->products[$i]['attributes'][$j]['prefix'] . "'>" . ' ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][price]' size='8' value='" . $order->products[$i]['attributes'][$j]['price'] . "'>";
				echo '</i></small></nobr>';
                                }
			}
                        if ($_GET[advancedoptions] != 'yes')
                            echo $OptionOption;
		  } 

		echo '	    </td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][model]' size='55' value='" . $order->products[$i]['model'] . "'>" . '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input class='amount' name='update_products[$orders_products_id][tax]' size='3' value='" . zen_display_tax_value($order->products[$i]['tax']) . "'>" . '&nbsp; %</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input class='amount' name='update_products[$orders_products_id][final_price]' size='5' value='" . number_format($order->products[$i]['final_price'], 2, '.', '') . "'>" . '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . '</td>' . "\n" .
		     '	  </tr>' . "\n";
	}
	?>
	<!-- End Products Listings Block -->

	<!-- Begin Order Total Block -->
	  <tr>
	    <td align="right" colspan="6">
	    	<table border="0" cellspacing="0" cellpadding="2" width="100%">
	    	<tr>
	    <td valign='top'>
		<br>
		<?php echo '<a href="' . zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oID . '&amp;action=add_prdct', 'NONSSL') . '">' . zen_image_button('button_add_product.gif', TEXT_ADD_NEW_PRODUCT) . '</a>'; ?>
		</td>
	    	<td align='right'>
	    	<table border="0" cellspacing="0" cellpadding="2">
<?php

      	// Override order.php Class's Field Limitations
		$totals_query = $db -> Execute("select * from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$oID . "' order by sort_order");
		$order->totals = array();
		#while ($totals = zen_db_fetch_array($totals_query)) {
      while (!$totals_query -> EOF){
         $order->totals[] = array('title' => $totals_query->fields['title'], 'text' => $totals_query->fields['text'], 'class' => $totals_query->fields['class'], 'value' => $totals_query->fields['value'], 'orders_total_id' => $totals_query->fields['orders_total_id']);
         $totals_query -> MoveNext();
         }

	$TotalsArray = array();
	for ($i=0; $i<sizeof($order->totals); $i++) {
		$TotalsArray[] = array("Name" => $order->totals[$i]['title'], "Price" => number_format($order->totals[$i]['value'], 2, '.', ''), "Class" => $order->totals[$i]['class'], "TotalID" => $order->totals[$i]['orders_total_id']);
		$TotalsArray[] = array("Name" => "          ", "Price" => "", "Class" => "ot_custom", "TotalID" => "0");
	}

	array_pop($TotalsArray);
	foreach($TotalsArray as $TotalIndex => $TotalDetails)
	{
		$TotalStyle = "smallText";
		if(($TotalDetails["Class"] == "ot_subtotal") || ($TotalDetails["Class"] == "ot_total"))
		{
			echo	'	      <tr>' . "\n" .
				'		<td class="main" align="right"><strong>' . $TotalDetails["Name"] . '</strong></td>' .
				'		<td class="main" align="right"><strong>' . $TotalDetails["Price"] .
						"<input name='update_totals[$TotalIndex][title]' type='hidden' value='" . trim($TotalDetails["Name"]) . "' size='" . strlen($TotalDetails["Name"]) . "' >" .
						"<input class='amount' name='update_totals[$TotalIndex][value]' type='hidden' value='" . $TotalDetails["Price"] . "' size='6' >" .
						"<input class='amount' name='update_totals[$TotalIndex][class]' type='hidden' value='" . $TotalDetails["Class"] . "'>\n" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . '</strong></td>' .
				'	      </tr>' . "\n";
		}
		elseif($TotalDetails["Class"] == "ot_tax")
		{
			echo	'	      <tr>' . "\n" .
				'		<td align="right" class="' . $TotalStyle . '">' . "<input class='amount' name='update_totals[$TotalIndex][title]' size='" . strlen(trim($TotalDetails["Name"])) . "' value='" . trim($TotalDetails["Name"]) . "'>" . '</td>' . "\n" .
				'		<td class="main" align="right"><strong>' . $TotalDetails["Price"] .
						"<input class='amount' name='update_totals[$TotalIndex][value]' type='hidden' value='" . $TotalDetails["Price"] . "' size='6' >" .
						"<input class='amount' name='update_totals[$TotalIndex][class]' type='hidden' value='" . $TotalDetails["Class"] . "'>\n" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . '</strong></td>' .
				'	      </tr>' . "\n";
		}
		else
		{
			echo	'	      <tr>' . "\n";
                        if ($TotalDetails["Class"] == "ot_shipping")
			echo '		<td align="right" class="' . $TotalStyle . '">' . ENTRY_SHIPPING_TAX_RATE . "<input class='amount' name='shippingtaxrate' size='4' value='" . $AddShippingTax . "'> %&nbsp;&nbsp;&nbsp;&nbsp;"; /* . '</td>' . "\n"; */
                        else
                               echo	'		<td align="right" class="' . $TotalStyle . '">';
                        echo "<input class='amount' name='update_totals[$TotalIndex][title]' size='" . strlen(trim($TotalDetails["Name"])) . "' value='" . strip_tags(trim($TotalDetails["Name"])) . "'>" . '</td>' . "\n" .
				'		<td align="right" class="' . $TotalStyle . '">' . "<input class='amount' name='update_totals[$TotalIndex][value]' size='6' value='" . $TotalDetails["Price"] . "'>" .
						"<input type='hidden' name='update_totals[$TotalIndex][class]' value='" . $TotalDetails["Class"] . "'>" .
						"<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" .
						'</td>' . "\n" .
				'	      </tr>' . "\n";
		}
	}
?>
	    	</table>
	    	</td>
	    	</tr>
	    	</table>
	    </td>
	  </tr>
	<!-- End Order Total Block -->

	</table></td>
      </tr>

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
		<td class="main">
			<strong><?php echo zen_image(DIR_WS_IMAGES . 'icon_comment_add.png', TABLE_HEADING_STATUS_HISTORY) . '&nbsp;' . TABLE_HEADING_STATUS_HISTORY; ?></strong>
		</td>
      </tr>
      <tr>
        <td class="main">
		<table border="1" cellspacing="0" cellpadding="5" width="60%">
<?php if (TY_TRACKER == 'True') { ?>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent smallText" valign="top"  width="15%"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
            <td class="dataTableHeadingContent smallText" align="center" valign="top" width="12%"><strong><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></strong></td>
            <td class="dataTableHeadingContent smallText" valign="top" width="10%"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
<!-- TY TRACKER 3 BEGIN, DISPLAY TRACKING ID IN COMMENTS TABLE ------------------------------->
	    <td class="dataTableHeadingContent smallText" valign="top" width="23%"><strong><?php echo TABLE_HEADING_TRACKING_ID; ?></strong></td>
<!-- END TY TRACKER 3 ------------------------------------------------------------>
            <td class="dataTableHeadingContent smallText" valign="top" width="40%"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          </tr>
<?php
// TY TRACKER 4 BEGIN, INCLUDE DATABASE FIELDS ------------------------------
    $orders_history_query = $db->Execute("select orders_status_id, date_added, customer_notified, track_id1, track_id2, track_id3, track_id4, track_id5, comments
                                    from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by date_added");
// END TY TRACKER 4 -----------------------------------------------------------
    if ($orders_history_query->RecordCount()) {
      #while ($orders_history = zen_db_fetch_array($orders_history_query)) {
      while (!$orders_history_query -> EOF){
        echo '          <tr>' . "\n" .
             '            <td class="smallText" valign="top">' . zen_datetime_short($orders_history_query->fields['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history_query->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', TEXT_YES) . "</td>\n";
        } else if ($orders_history_query->fields['customer_notified'] == '-1') {
          echo zen_image(DIR_WS_ICONS . 'locked.gif', TEXT_HIDDEN) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'unlocked.gif', TEXT_VISIBLE) . "</td>\n";
        }
        echo '            <td class="smallText" valign="top">' . $orders_status_array[$orders_history_query->fields['orders_status_id']] . '</td>' . "\n";
// TY TRACKER 5 BEGIN, DEFINE TRACKING INFORMATION ON SUPER_ORDERS.PHP FILE ----------------
        $display_track_id = '&nbsp;';
	$display_track_id .= (empty($orders_history_query->fields['track_id1']) ? '' : CARRIER_NAME_1 . ": <a href=" . CARRIER_LINK_1 . nl2br(zen_output_string_protected($orders_history_query->fields['track_id1'])) . ' target="_blank">' . nl2br(zen_output_string_protected($orders_history_query->fields['track_id1'])) . "</a>&nbsp;" );
	$display_track_id .= (empty($orders_history_query->fields['track_id2']) ? '' : CARRIER_NAME_2 . ": <a href=" . CARRIER_LINK_2 . nl2br(zen_output_string_protected($orders_history_query->fields['track_id2'])) . ' target="_blank">' . nl2br(zen_output_string_protected($orders_history_query->fields['track_id2'])) . "</a>&nbsp;" );
	$display_track_id .= (empty($orders_history_query->fields['track_id3']) ? '' : CARRIER_NAME_3 . ": <a href=" . CARRIER_LINK_3 . nl2br(zen_output_string_protected($orders_history_query->fields['track_id3'])) . ' target="_blank">' . nl2br(zen_output_string_protected($orders_history_query->fields['track_id3'])) . "</a>&nbsp;" );
	$display_track_id .= (empty($orders_history_query->fields['track_id4']) ? '' : CARRIER_NAME_4 . ": <a href=" . CARRIER_LINK_4 . nl2br(zen_output_string_protected($orders_history_query->fields['track_id4'])) . ' target="_blank">' . nl2br(zen_output_string_protected($orders_history_query->fields['track_id4'])) . "</a>&nbsp;" );
	$display_track_id .= (empty($orders_history_query->fields['track_id5']) ? '' : CARRIER_NAME_5 . ": <a href=" . CARRIER_LINK_5 . nl2br(zen_output_string_protected($orders_history_query->fields['track_id5'])) . ' target="_blank">' . nl2br(zen_output_string_protected($orders_history_query->fields['track_id5'])) . "</a>&nbsp;" );
        echo '            <td class="smallText">' . $display_track_id . '</td>' . "\n";
// END TY TRACKER 5 -------------------------------------------------------------------

        echo '            <td class="smallText" valign="top">' . nl2br(zen_db_scrub_out($orders_history_query->fields['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
        $orders_history_query -> MoveNext();
        $current_status = $orders_status_array[$orders_history_query->fields['orders_status_id']]; 
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
<?php } else { ?>

          <tr class="dataTableHeadingRow">
            <td class="smallText dataTableHeadingContent" width="20%"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
            <td class="smallText dataTableHeadingContent" align="center" width="15%"><strong><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></strong></td>
            <td class="smallText dataTableHeadingContent" width="15%"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
            <td class="smallText dataTableHeadingContent" width="50%"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          </tr>
<?php
    $orders_history_query = $db->Execute("select orders_status_id, date_added, customer_notified, comments
                                    from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by date_added");
    if ($orders_history_query->RecordCount()) {
      #while ($orders_history = zen_db_fetch_array($orders_history_query)) {
      while (!$orders_history_query -> EOF){
        echo '          <tr>' . "\n" .
             '            <td class="smallText" valign="top">' . zen_datetime_short($orders_history_query->fields['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history_query->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', TEXT_YES) . "</td>\n";
        } else if ($orders_history_query->fields['customer_notified'] == '-1') {
          echo zen_image(DIR_WS_ICONS . 'locked.gif', TEXT_HIDDEN) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'unlocked.gif', TEXT_VISIBLE) . "</td>\n";
        }
        echo '            <td class="smallText" valign="top">' . $orders_status_array[$orders_history_query->fields['orders_status_id']] . '</td>' . "\n";

        echo '            <td class="smallText" valign="top">' . nl2br(zen_db_scrub_out($orders_history_query->fields['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
        $orders_history_query -> MoveNext();
        $current_status = $orders_status_array[$orders_history_query->fields['orders_status_id']]; 
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
<?php } ?>
        </table></td>
      </tr>

      <tr>
        <td class="main"><br><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td class="main">
			<table width="60%" border="0"  cellspacing="0" cellpadding="0">
				<tr>
					<td>
		
					<?php
					echo zen_draw_textarea_field('comments', 'soft', '60', '5');
					?>
					</td>
				</tr>
			</table>
        </td>
      </tr>

<!-- TY TRACKER 6 BEGIN, ENTER TRACKING INFORMATION -->
<?php if (TY_TRACKER == 'True') { ?>
	<tr>
        <td class="main">
			<table border="0" cellpadding="3" cellspacing="0">
				<tr>
					<td class="main"><strong><?php echo zen_image(DIR_WS_IMAGES . 'icon_track_add.png', ENTRY_ADD_TRACK) . '&nbsp;' . ENTRY_ADD_TRACK; ?></strong></td>
				</tr>
				<tr valign="top">
					<td width="400">
						<table border="1" cellpadding="3" cellspacing="0" width="100%">
							<tr class="dataTableHeadingRow">
								<td class="dataTableHeadingContent smallText"><strong><?php echo TABLE_HEADING_CARRIER_NAME; ?></strong></td>
								<td class="dataTableHeadingContent smallText"><strong><?php echo TABLE_HEADING_TRACKING_ID; ?></strong></td>
							</tr>
							<?php if (CARRIER_STATUS_1 == 'True') { ?>
							<tr>
							<td><?php echo CARRIER_NAME_1; ?></td><td valign="top"><?php echo zen_draw_input_field('track_id1', '', 'size="50"'); ?></td>
							</tr>
							<?php } ?>
							<?php if (CARRIER_STATUS_2 == 'True') { ?>
							<tr>
							<td><?php echo CARRIER_NAME_2; ?></td><td valign="top"><?php echo zen_draw_input_field('track_id2', '', 'size="50"'); ?></td>
							</tr>
							<?php } ?>
							<?php if (CARRIER_STATUS_3 == 'True') { ?>
							<tr>
							<td><?php echo CARRIER_NAME_3; ?></td><td valign="top"><?php echo zen_draw_input_field('track_id3', '', 'size="50"'); ?></td>
							</tr>
							<?php } ?>
							<?php if (CARRIER_STATUS_4 == 'True') { ?>
							<tr>
							<td><?php echo CARRIER_NAME_4; ?></td><td valign="top"><?php echo zen_draw_input_field('track_id4', '', 'size="50"'); ?></td>
							</tr>
							<?php } ?>
							<?php if (CARRIER_STATUS_5 == 'True') { ?>
							<tr>
							<td><?php echo CARRIER_NAME_5; ?></td><td valign="top"><?php echo zen_draw_input_field('track_id5', '', 'size="50"'); ?></td>
							</tr>
							<?php } ?>
						</table>
					</td>
				</tr>
			</table>
        </td>
	</tr>
<?php } ?>
<!-- TY TRACKER 6 END, ENTER TRACKING INFORMATION -->

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
       <tr>
       <td class="current_status"><strong><?php echo 'Current Status: '; ?><?php echo $orders_status_array[$orders_history_query->fields['orders_status_id']] ;?></strong></td>
       </tr>   
       <tr>
       <td class="current_status"><strong><?php echo ENTRY_STATUS; ?></strong> <?php echo zen_draw_pull_down_menu('status', $orders_statuses, $orders_history_query->fields['orders_status_id']); ?></td>
       </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><strong><?php echo ENTRY_NOTIFY_CUSTOMER; ?></strong> [<?php echo zen_draw_radio_field('notify', '1', true) . '-' . TEXT_EMAIL . ' ' . zen_draw_radio_field('notify', '0', FALSE) . '-' . TEXT_NOEMAIL . ' ' . zen_draw_radio_field('notify', '-1', FALSE) . '-' . TEXT_HIDE; ?>]&nbsp;&nbsp;&nbsp;</td>
                <td class="main"><strong><?php echo ENTRY_NOTIFY_COMMENTS; ?></strong> <?php echo zen_draw_checkbox_field('notify_comments', '', true); ?></td>
              </tr>
          <?php /* } */ ?>
        </table></td>
      </tr>

      <tr>
	<td valign="top"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
      </tr>
  </form> 
<?php
  }

if($action == "add_prdct")
{
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo ADDING_TITLE; ?> #<?php echo $oID; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
<!-- BOF Edit added buttons to return to current order being edited or order details instead of the order list page - if Super Orders admin flag is set to TRUE displays this directs you to the Super Orders order details page -->
<?php if (SO_SWITCH == 'True') { ?>
			<td class="pageHeading" align="right">
			<?php echo '<a href="' . zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('oID', 'action', 'resend')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_EDIT) . '</a>' ?>
			<?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action', 'resend')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_ORDER_DETAILS) . '</a>'; ?></td>
			</td>
<?php } else { ?>
			<td class="pageHeading" align="right">
			<?php echo '<a href="' . zen_href_link(FILENAME_ORDER_EDIT, zen_get_all_get_params(array('oID', 'action', 'resend')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_EDIT) . '</a>' ?>
			<?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, zen_get_all_get_params(array('oID', 'action', 'resend')) . 'oID=' . $oID . '&amp;action=edit', 'NONSSL') . '">' . zen_image_button('button_details.gif', IMAGE_ORDER_DETAILS) . '</a>'; ?></td>
			</td>
<?php } ?>
<!-- EOF Edit added buttons to return to current order being edited or order details instead of the order list page - if Super Orders admin flag is set to TRUE displays this directs you to the Super Orders order details page -->
          </tr>
        </table></td>
      </tr>

<?php
	// ############################################################################
	//   Get List of All Products
	// ############################################################################

		//$result = zen_db_query("SELECT products_name, p.products_id, x.categories_name, ptc.categories_id FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id=p.products_id LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc ON ptc.products_id=p.products_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id=ptc.categories_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " x ON x.categories_id=ptc.categories_id ORDER BY categories_id");
		$result = $db -> Execute("SELECT products_name, p.products_id, categories_name, ptc.categories_id FROM " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON pd.products_id=p.products_id LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc ON ptc.products_id=p.products_id LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON cd.categories_id=ptc.categories_id ORDER BY categories_name");
		#hile($row = zen_db_fetch_array($result)) 		{
      while (!$result -> EOF){
 		   extract($result->fields,EXTR_PREFIX_ALL,"db");
			$ProductList[$db_categories_id][$db_products_id] = $db_products_name;
			$CategoryList[$db_categories_id] = $db_categories_name;
			$LastCategory = $db_categories_name;
         $result -> MoveNext();
		}

		// ksort($ProductList);

		$LastOptionTag = "";
		$ProductSelectOptions = "<option value='0'>Don't Add New Product" . $LastOptionTag . "\n";
		$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
		foreach($ProductList as $Category => $Products)
		{
			$ProductSelectOptions .= "<option value='0'>$Category" . $LastOptionTag . "\n";
			$ProductSelectOptions .= "<option value='0'>---------------------------" . $LastOptionTag . "\n";
			asort($Products);
			foreach($Products as $Product_ID => $Product_Name)
			{
				$ProductSelectOptions .= "<option value='$Product_ID'> &nbsp; $Product_Name" . $LastOptionTag . "\n";
			}

			if($Category != $LastCategory)
			{
				$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
				$ProductSelectOptions .= "<option value='0'>&nbsp;" . $LastOptionTag . "\n";
			}
		}


	// ############################################################################
	//   Add Products Steps
	// ############################################################################

		echo "<tr><td><table border='0'>\n";

		// Set Defaults
			if(!IsSet($add_product_categories_id))
			$add_product_categories_id = .5;

			if(!IsSet($add_product_products_id))
			$add_product_products_id = 0;

		// Step 1: Choose Category
if ($add_product_categories_id == .5) {
$categoriesarr = zen_get_category_tree();
$catcount = count($categoriesarr);
$texttempcat1 = $categoriesarr[0][text];
$idtempcat1 = $categoriesarr[0][id];
$catcount++;
for ($i=1; $i<$catcount; $i++) {
   $texttempcat2 = $categoriesarr[$i][text];
   $idtempcat2 = $categoriesarr[$i][id];
   $categoriesarr[$i][id] = $idtempcat1;
   $categoriesarr[$i][text] = $texttempcat1;
   $texttempcat1 = $texttempcat2;
   $idtempcat1 = $idtempcat2;
}


$categoriesarr[0][text] = "Choose Category";
$categoriesarr[0][id] = .5;

			
                        $categoryselectoutput = zen_draw_pull_down_menu('add_product_categories_id', $categoriesarr, $current_category_id, 'onChange="this.form.submit();"');
                        $categoryselectoutput = str_replace('<option value="0" SELECTED>','<option value="0">',$categoryselectoutput);
                        $categoryselectoutput = str_replace('<option value=".5">','<option value=".5" SELECTED>',$categoryselectoutput);
} else {
                        $categoryselectoutput = zen_draw_pull_down_menu('add_product_categories_id', zen_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
}
			echo "<tr class='dataTableRow'>".zen_draw_form('add_prdct', FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action', 'oID')) . 'oID='.$oID.'&action=add_prdct', 'post', '', true); 
//			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&amp;action=$action' method='POST'>\n";
			echo "<td class='dataTableContent' align='right'><strong>" . ADDPRODUCT_TEXT_STEP1 . "</strong></td><td class='dataTableContent' valign='top'>";
			echo ' ' . $categoryselectoutput;
			echo "<input type='hidden' name='step' value='2'>";
			echo "</td>\n";
			echo "</form></tr>\n";
			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";

		// Step 2: Choose Product
		if(($step > 1) && ($add_product_categories_id != .5))
		{
			echo "<tr class='dataTableRow'>".zen_draw_form('add_prdct', FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action', 'oID')) . 'oID='.$oID.'&action=add_prdct', 'post', '', true); 
//			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&amp;action=$action' method='post'>\n";
			echo "<td class='dataTableContent' align='right'><strong>" . ADDPRODUCT_TEXT_STEP2 . "</strong></td><td class='dataTableContent' valign='top'><select name=\"add_product_products_id\" onChange=\"this.form.submit();\">";
			$ProductOptions = "<option value='0'>" .  ADDPRODUCT_TEXT_SELECT_PRODUCT . "\n";
			asort($ProductList[$add_product_categories_id]);
			foreach($ProductList[$add_product_categories_id] as $ProductID => $ProductName)
			{
			$ProductOptions .= "<option value='$ProductID'> $ProductName\n";
			}
			$ProductOptions = str_replace("value='$add_product_products_id'","value='$add_product_products_id' selected", $ProductOptions);
			echo $ProductOptions;
			echo "</select></td>\n";
			echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
			echo "<input type='hidden' name='step' value='3'>";
			echo "</form></tr>\n";
			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";
		}

		// Step 3: Choose Options
		if(($step > 2) && ($add_product_products_id > 0))
		{
			// Get Options for Products
			$result = $db -> Execute("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po ON po.products_options_id=pa.options_id LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov ON pov.products_options_values_id=pa.options_values_id WHERE products_id='$add_product_products_id'");

			// Skip to Step 4 if no Options
			if($result->RecordCount() == 0)
			{
				echo "<tr class=\"dataTableRow\">\n";
				echo "<td class='dataTableContent' align='right'><strong>" . ADDPRODUCT_TEXT_STEP3 . "</strong></td><td class='dataTableContent' valign='top' colspan='2'><i>".ADDPRODUCT_TEXT_OPTIONS_NOTEXIST."</i></td>";
				echo "</tr>\n";
				$step = 4;
			}
			else
			{
#				while($row = zen_db_fetch_array($result))  {
            while (!$result -> EOF){
 					extract($result->fields,EXTR_PREFIX_ALL,"db");
					$Options[$db_products_options_id] = $db_products_options_name;
                                        $OptType[$db_products_options_id] = $db_products_options_type;
					$ProductOptionValues[$db_products_options_id][$db_products_options_values_id] = $db_products_options_values_name;
               $result -> MoveNext();
				}

				echo "<tr class='dataTableRow'>".zen_draw_form('add_prdct', FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action', 'oID')) . 'oID='.$oID.'&action=add_prdct', 'post', '', true); 
//				echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
				echo "<td class='dataTableContent' align='right'><strong>" . ADDPRODUCT_TEXT_STEP3 . "</strong></td><td class='dataTableContent' valign='top'>";
                                $optionstoadd=0;
				foreach($ProductOptionValues as $OptionID => $OptionValues)
				{       $optionstoadd++;
                                        $sendoptionon = "add_product_options".$optionstoadd;
                                        if ($OptType[$OptionID] == 1) 
                                            $OptionOption = "<strong>" . $Options[$OptionID] . "</strong> - ";
                                        else     
	   		       		    $OptionOption = "<strong>" . $Options[$OptionID] . "</strong> - <select name='$sendoptionon'>";
					foreach($OptionValues as $OptionValueID => $OptionValueName)
					{
                                        if ($OptType[$OptionID] == 1)
                                            $OptionOption .= "<input type='hidden' name='$sendoptionon' value='$OptionValueID'><input type='hidden' name='" . $sendoptionon . "tvid' value='$OptionID'>";
                                        else
                                            $OptionOption .= "<option value='$OptionValueID'> $OptionValueName\n";	
					}
                                        if ($OptType[$OptionID] != 1) 
					    $OptionOption .= "</select>";
                                        else
                                            $OptionOption .= "<input type='text' size='15' name='" . $sendoptionon . "tv'>";
                                        $OptionOption .= "<br>\n";

					if(IsSet($_POST[$sendoptionon])) {
                                        $sendoptionontv = $sendoptionon . "tv";
                                        $newsendoptionontv = stripslashes($_POST[$sendoptionontv]);
                                        $newsendoptionontv = htmlspecialchars($newsendoptionontv,ENT_QUOTES);
					$OptionOption = str_replace("option value='" . $_POST[$sendoptionon] . "'","option value='" . $_POST[$sendoptionon] . "' selected",$OptionOption);
                                        $OptionOption = str_replace("<input type='text' size='15' name='" . $sendoptionon . "tv'>","<input type='text' size='15' name='" . $sendoptionon . "tv' value='" . $newsendoptionontv . "'>",$OptionOption);
                                        }
					echo $OptionOption;
				}
                                echo "<input type='hidden' name='optionstoadd' value='$optionstoadd'></td>";
				/* foreach($ProductOptionValues as $OptionID => $OptionValues)
				{
					$OptionOption = "<strong>" . $Options[$OptionID] . "</strong> - <select name='add_product_options[$OptionID]'>";
					foreach($OptionValues as $OptionValueID => $OptionValueName)
					{
					$OptionOption .= "<option value='$OptionValueID'> $OptionValueName\n";
					}
					$OptionOption .= "</select><br>\n";

					if(IsSet($add_product_options))  {
					$OptionOption = str_replace("value='" . $add_product_options[$OptionID] . "'","value='" . $add_product_options[$OptionID] . "' selected",$OptionOption);
                                        }
					echo $OptionOption;
				} 
				echo "</td>"; */
				echo "<td class='dataTableContent' align='center'><input type='submit' value='" . ADDPRODUCT_TEXT_OPTIONS_CONFIRM . "'>";
				echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
				echo "<input type='hidden' name='add_product_products_id' value='$add_product_products_id'>";
				echo "<input type='hidden' name='step' value='4'>";
				echo "</td>\n";
				echo "</form></tr>\n";
			}

			echo "<tr><td colspan='3'>&nbsp;</td></tr>\n";
		}

		// Step 4: Confirm
		if($step > 3)
		{
			echo "<tr class='dataTableRow'>".zen_draw_form('add_prdct', FILENAME_ORDER_EDIT, zen_get_all_get_params(array('action', 'oID')) . 'oID='.$oID.'&action=add_prdct', 'post', '', true); 
//			echo "<tr class=\"dataTableRow\"><form action='$PHP_SELF?oID=$oID&action=$action' method='POST'>\n";
			echo "<td class='dataTableContent' align='right'><strong>" . ADDPRODUCT_TEXT_STEP4 . "</strong></td>";
			echo "<td class='dataTableContent' valign='top'>" . ADDPRODUCT_TEXT_CONFIRM_QUANTITY . "<input name='add_product_quantity' size='2' value='1'>&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' name='applyspecialstoprice' CHECKED>". ADDPRODUCT_SPECIALS_SALES_PRICE ."</td>";
			echo "<td class='dataTableContent' align='center'><input type='submit' value='" . ADDPRODUCT_TEXT_CONFIRM_ADDNOW . "'>";
                        if($_POST[optionstoadd] != NULL)
			{
                                for ($i=1; $i<=$_POST[optionstoadd]; $i++) {
                                $sendoptionon = "add_product_options".$i;
                                echo "<input type='hidden' name='$sendoptionon' value='$_POST[$sendoptionon]'>";
                                $sendoptionontv = $sendoptionon . "tv";
                                $sendoptionontvid = $sendoptionon . "tvid";
                                if ($_POST[$sendoptionontv]) {
                                    $newsendoptionontv = stripslashes($_POST[$sendoptionontv]);
                                    $newsendoptionontv = htmlspecialchars($newsendoptionontv,ENT_QUOTES);
                                    echo "<input type='hidden' name='$sendoptionontv' value='$newsendoptionontv'><input type='hidden' name='$sendoptionontvid' value='$_POST[$sendoptionontvid]'>";
                                }
                                }
			}
                        echo "<input type='hidden' name='optionstoadd' value='$_POST[optionstoadd]'>";
			/* if(IsSet($add_product_options))
			{
				foreach($add_product_options as $option_id => $option_value_id)
				{
					echo "<input type='hidden' name='add_product_options[$option_id]' value='$option_value_id'>";
				}
			} */
			echo "<input type='hidden' name='add_product_categories_id' value='$add_product_categories_id'>";
			echo "<input type='hidden' name='add_product_products_id' value='$add_product_products_id'>";
			echo "<input type='hidden' name='step' value='5'>";
			echo "</td>\n";
			echo "</form></tr>\n";
		}

		echo "</table></td></tr>\n";
}
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>