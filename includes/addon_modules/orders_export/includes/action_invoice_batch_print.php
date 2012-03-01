<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: invoice_batch_print.php sasaki $
//
  $template = 'index';

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  // get params
  $sm = (isset($_GET['sm']) ? $_GET['sm'] : '');
  $pm = (isset($_GET['pm']) ? $_GET['pm'] : '');
  $ctm = (isset($_GET['ctm']) ? $_GET['ctm'] : '');
  $com = (isset($_GET['com']) ? $_GET['com'] : '');
  $dfrom = (isset($_GET['dfrom']) ? $_GET['dfrom'] : '');
  $dto = (isset($_GET['dto']) ? $_GET['dto'] : '');
  $sts = (isset($_GET['sts']) ? $_GET['sts'] : '');
  $odr = (isset($_GET['odr']) ? $_GET['odr'] : '');
  $all = (isset($_GET['all']) ? $_GET['all'] : '');
  $exp = orders_export_get_exp();

  // Sort Listing
  switch ($odr) {
    case "id":
      $disp_order = "o.orders_id";
      break;

    case "id-d":
      $disp_order = "o.orders_id DESC";
      break;

    case "dp":
      $disp_order = "o.date_purchased";
      break;

    case "dp-d":
      $disp_order = "o.date_purchased DESC";
      break;

    default:
      $disp_order = "o.orders_id DESC";
      break;
  }

  if ($all) {
    // create search filter
    $shipping_method_search = '';
    if (isset($sm) && zen_not_null($sm)) {
      $keywords = zen_db_input(zen_db_prepare_input($sm));
      $shipping_method_search = " and (o.shipping_module_code like '" . $keywords . "')";
    }

    $payment_method_search = '';
    if (isset($pm) && zen_not_null($pm)) {
      $keywords = zen_db_input(zen_db_prepare_input($pm));
      $payment_method_search = " and (o.payment_module_code like '" . $keywords . "')";
    }

    $customer_search = '';
    if (isset($ctm) && zen_not_null($ctm)) {
      $keywords = zen_db_input(zen_db_prepare_input($ctm));
      $customer_search = " and (o.customers_name like '%" . $keywords . "%')";
    }

    $company_search = '';
    if (isset($com) && zen_not_null($com)) {
      $keywords = zen_db_input(zen_db_prepare_input($com));
      $company_search = " and (o.customers_company like '%" . $keywords . "%')";
    }

    $date_from_search = '';
    if (isset($dfrom) && zen_not_null($dfrom)) {
      $keywords = zen_db_input(zen_db_prepare_input($dfrom));
      $date_from_search = " and (o.date_purchased >=  '" . $keywords . " 00:00:00')";
    }

    $date_to_search = '';
    if (isset($dto) && zen_not_null($dto)) {
      $keywords = zen_db_input(zen_db_prepare_input($dto));
      $date_to_search = " and (o.date_purchased <=  '" . $keywords . " 23:59:59')";
    }

    $status_search = '';
    if (isset($sts) && zen_not_null($sts)) {
      $keywords = zen_db_input(zen_db_prepare_input($sts));
      $status_search = " and (s.orders_status_id = '" . $keywords . "')";
    }

    $search = $shipping_method_search . $payment_method_search . $customer_search . $company_search . $date_from_search . $date_to_search . $status_search;

  } elseif (count($exp) > 0) {
    $search = " and o.orders_id IN (";
    foreach($exp as $orders_id => $value) {
      $orders_ids .= ", '" . (int)$orders_id . "'";
    }
    $search .= trim($orders_ids, ',') . ")";

  } else {
    die();
  }


  $new_fields = ", o.customers_company, o.customers_email_address, o.customers_street_address, o.delivery_company, o.delivery_name, o.delivery_street_address, o.billing_company, o.billing_name, o.billing_street_address, o.payment_module_code, o.shipping_module_code, o.ip_address ";
  $orders_query = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total'  " . $search . " order by " . $disp_order;

  $orders = $db->Execute($orders_query);

  include(DIR_WS_CLASSES . 'order.php');
?>
