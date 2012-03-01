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
//  $Id: orders.php 3687 2006-06-02 00:06:48Z drbyte $
//
define('DEBUG_ORDERS_EXPORT', false);

  $template = 'index';

  // use classes
  include(dirname(__FILE__) . '/../classes/data_export.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  // select options
  $shipping_method_options = array();
  $shipping_method_options[] = array(
    'id' => '',
    'text' => MODULE_ORDERS_EXPORT_TEXT_ALL_SHIPPING_METHOD
  );
  $shipping_methods = $db->Execute("
    SELECT DISTINCT shipping_module_code
    FROM " . TABLE_ORDERS . "
    ORDER BY shipping_module_code
    ;");
  while (!$shipping_methods->EOF) {
    $shipping_method_options[] = array(
      'id' => $shipping_methods->fields['shipping_module_code'],
      'text' => $shipping_methods->fields['shipping_module_code']
      );
    $shipping_methods->MoveNext();
  }

  $payment_method_options = array();
  $payment_method_options[] = array(
    'id' => '',
    'text' => MODULE_ORDERS_EXPORT_TEXT_ALL_PAYMENT_METHOD
  );
  $payment_methods = $db->Execute("
    SELECT DISTINCT payment_module_code
    FROM " . TABLE_ORDERS . "
    ORDER BY payment_module_code
    ;");
  while (!$payment_methods->EOF) {
    $payment_method_options[] = array(
      'id' => $payment_methods->fields['payment_module_code'],
      'text' => $payment_methods->fields['payment_module_code']
      );
    $payment_methods->MoveNext();
  }

  $orders_status_options = array();
  $orders_status_options[] = array(
    'id' => '',
    'text' => MODULE_ORDERS_EXPORT_TEXT_ALL_ORDERS_STATUS
  );
  $orders_status_array = array();
  $orders_status = $db->Execute("
    SELECT orders_status_id, orders_status_name
    FROM " . TABLE_ORDERS_STATUS . "
    WHERE language_id = '" . (int)$_SESSION['languages_id'] . "'
    ;");

  while (!$orders_status->EOF) {
    $orders_status_options[] = array(
      'id' => $orders_status->fields['orders_status_id'],
      'text' => $orders_status->fields['orders_status_name'] . ' [' . $orders_status->fields['orders_status_id'] . ']'
      );
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $zoexp_base_dir = dirname(__FILE__) . '/../modules/orders_export';
  $formats = array();
  $format_options = array();
  if ($zoexp_dir = @dir($zoexp_base_dir)) {
    while ($zoexp_file = $zoexp_dir->read()) {
      $info_file = $zoexp_base_dir . '/'. $zoexp_file . '/info.php';
      if (file_exists($info_file)) {
        $formats[] = $zoexp_file;
        $format_name = $zoexp_file;
        require($info_file);
        $format_options[] = array('id' => $zoexp_file, 'text' => $format_name);
      }
    }
  }

  // get params
  $oID = (isset($_GET['oID']) ? $_GET['oID'] : '');
  $sm = (isset($_GET['sm']) ? $_GET['sm'] : '');
  $pm = (isset($_GET['pm']) ? $_GET['pm'] : '');
  $ctm = (isset($_GET['ctm']) ? $_GET['ctm'] : '');
  $com = (isset($_GET['com']) ? $_GET['com'] : '');
  $dfrom = (isset($_GET['dfrom']) ? $_GET['dfrom'] : '');
  $dto = (isset($_GET['dto']) ? $_GET['dto'] : '');
  $sts = (isset($_GET['sts']) ? $_GET['sts'] : '');

  $odr = (isset($_GET['odr']) ? $_GET['odr'] : '');

  if ($oID > 0) unset($_GET['all']);
  $all = (isset($_GET['all']) ? $_GET['all'] : '');

  $dl = (isset($_GET['dl_x']) ? $_GET['dl_x'] : '');
  $dl = (isset($_GET['dl']) ? $_GET['dl'] : $dl);

  $fmt = (isset($_GET['fmt']) ? $_GET['fmt'] : '');
  $sf = (isset($_GET['sf']) ? $_GET['sf'] : '');
  $vr = (isset($_GET['vr']) ? $_GET['vr'] : '');
  $vh = (isset($_GET['vh']) ? $_GET['vh'] : '');
  $inv = (isset($_GET['inv']) ? $_GET['inv'] : '');
  $pks = (isset($_GET['pks']) ? $_GET['pks'] : '');
  $exp = orders_export_get_exp();

  if ((int)$oID > 0 && $dl < 1) {
    $exp = array((int)$oID => 1);
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $iframe_export_url = '';
  $iframe_rawdata_url = '';
  $iframe_invoice_url = '';
  $iframe_packingslip_url = '';

  if ($dl > 0 && (count($exp) > 0 || ($all))) {
    $get_query_string = '';
    if ($all) {
      $get_params = array();
      if ($sm) $get_params['sm'] = $sm;
      if ($pm) $get_params['pm'] = $pm;
      if ($ctm) $get_params['ctm'] = $ctm;
      if ($com) $get_params['com'] = $com;
      if ($dfrom) $get_params['dfrom'] = $dfrom;
      if ($dto) $get_params['dto'] = $dto;
      if ($sts) $get_params['sts'] = $sts;
      if ($all) $get_params['all'] = $all;

      while (list($key, $value) = each($get_params)) {
        $get_query_string .= $key . '=' . urlencode($value) . '&';
      }
    } else {
      foreach($exp as $orders_id => $value) {
        $get_query_string .= 'exp_' . (int)$orders_id . '=1&';
      }
    }

    if ($odr) $get_query_string .= 'odr=' . $odr . '&';

    $iframe_export_url = zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/orders_export&' . $get_query_string . 'action=export&fmt=' . $fmt . '&vh=' . $vh . '&sf=' . $sf, 'SSL');

    if ($vr) {
      $iframe_rawdata_url = zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/orders_export&' . $get_query_string . 'action=export&fmt=' . $fmt . '&vr=1&vh=' . $vh, 'SSL');
    }

    if ($inv) {
      $iframe_invoice_url = zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/invoice_batch_print&' . $get_query_string, 'SSL');
    }

    if ($pks) {
      $iframe_packingslip_url = zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/packingslip_batch_print&' . $get_query_string, 'SSL');
    }
  }

  if ($action == 'export') {

    $params = array();
    $fields = array();
    $tables = array();
    $conditions = array();
    $order_by = array();

    if (in_array($fmt, $formats)) {
      $fmt_base_dir = dirname(__FILE__) . '/../modules/orders_export/' . $fmt;
      if (file_exists($fmt_base_dir . '/functions.php')) {
        require_once($fmt_base_dir . '/functions.php');
      }
      if (file_exists($fmt_base_dir . '/configure.php')) {
        require($fmt_base_dir . '/configure.php');
      }
    }

    if (count($fields) == 0) {
      die();
    }

    $params['view_header'] = (int)$vh;
    $params['save_file'] = (int)$sf;

    if ($all) {
      if ($sm) $get_params['sm'] = $sm;
      if ($pm) $get_params['pm'] = $pm;
      if ($ctm) $get_params['ctm'] = $ctm;
      if ($com) $get_params['com'] = $com;
      if ($dfrom) $get_params['dfrom'] = $dfrom;
      list($from_date, $from_hour) = split(' ', $dfrom);
      if ($from_hour == '') {
        $from_hour = '00:00:00';
      }
      if ($dto) $get_params['dto'] = $dto;
      list($to_date, $to_hour) = split(' ', $dto);
      if ($to_hour == '') {
        $to_hour = '23:59:59';
      }
      if ($sts) $get_params['sts'] = $sts;

      if (isset($sm) && zen_not_null($sm)) {
        $conditions[] = TABLE_ORDERS . ".shipping_module_code like '" . zen_db_input(zen_db_prepare_input($sm)) . "'";
      }
      if (isset($pm) && zen_not_null($pm)) {
        $conditions[] = TABLE_ORDERS . ".payment_module_code like '" . zen_db_input(zen_db_prepare_input($pm)) . "'";
      }
      if (isset($ctm) && zen_not_null($ctm)) {
        $conditions[] = TABLE_ORDERS . ".customers_name like '%" . zen_db_input(zen_db_prepare_input($ctm)) . "%'";
      }
      if (isset($com) && zen_not_null($com)) {
        $conditions[] = TABLE_ORDERS . ".customers_company like '%" . zen_db_input(zen_db_prepare_input($com)) . "%'";
      }
      if (isset($dfrom) && zen_not_null($dfrom)) {
        $conditions[] = TABLE_ORDERS . ".date_purchased >= '" . zen_db_input(zen_db_prepare_input($from_date . " " . $from_hour)) . "'";
      }
      if (isset($dto) && zen_not_null($dto)) {
        $conditions[] = TABLE_ORDERS . ".date_purchased <= '" . zen_db_input(zen_db_prepare_input($to_date . " " . $to_hour)) . "'";
      }
      if (isset($sts) && zen_not_null($sts)) {
        $conditions[] = TABLE_ORDERS . ".orders_status = '" . zen_db_input(zen_db_prepare_input($sts)) . "'";
      }

    } elseif (count($exp) > 0) {
      $orders_id_conditions = TABLE_ORDERS . ".orders_id IN (";
      foreach($exp as $orders_id => $value) {
        $orders_ids .= ", '" . (int)$orders_id . "'";
      }
      $orders_id_conditions .= trim($orders_ids, ',') . ")";
      $conditions[] = $orders_id_conditions;

    } else {
      die();
    }

    if ($odr) {
      // Sort Listing
      switch ($odr) {
        case "id":
          $order_by[] = TABLE_ORDERS . ".orders_id";
          break;

        case "id-d":
          $order_by[] = TABLE_ORDERS . ".orders_id DESC";
          break;

        case "dp":
          $order_by[] = TABLE_ORDERS . ".date_purchased";
          break;

        case "dp-d":
          $order_by[] = TABLE_ORDERS . ".date_purchased DESC";
          break;

        default:
          $order_by[] = TABLE_ORDERS . ".orders_id DESC";
          break;
      }
    }

    $export_config = array();
    $export_config['params'] = $params;
    $export_config['fields'] = $fields;
    $export_config['tables'] = $tables;
    $export_config['conditions'] = $conditions;
    $export_config['order_by'] = $order_by;

    if ($vr == '1') {
      $dataExport = new dataExport($export_config);
      $dataExport->excute();
      if (DEBUG_ORDERS_EXPORT === true) {
        echo '<pre>' . "\n";
        echo htmlspecialchars($dataExport->query);
        echo '</pre>' . "\n";
      }
      if (strlen($dataExport->body) > 0) {
        echo '<pre>' . "\n";
        echo htmlspecialchars($dataExport->contents);
        echo '</pre>' . "\n";
      } else {
        echo '<pre>' . "\n";
        echo CAUTION_NO_DATA;
        echo '</pre>' . "\n";
      }
    } else {
      $dataExport = new dataExport($export_config);
      $result = $dataExport->getFile();
      if ($result && $sf) {
        @chmod($result, 0777);
        echo MODULE_ORDERS_EXPORT_TEXT_SAVE_FILE_PATH . $result;
      } elseif (!$result) {
        echo CAUTION_NO_DATA;
      }
    }
    die();
  }

  include(DIR_WS_CLASSES . 'order.php');

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
    list($from_date, $from_hour) = split(' ', $dfrom);
    if ($from_hour == '') {
      $from_hour = '00:00:00';
    }
    $keywords = zen_db_input(zen_db_prepare_input($from_date . ' ' . $from_hour));
    $date_from_search = " and (o.date_purchased >=  '" . $keywords . "')";
  }

  $date_to_search = '';
  if (isset($dto) && zen_not_null($dto)) {
    list($to_date, $to_hour) = split(' ', $dto);
    if ($to_hour == '') {
      $to_hour = '23:59:59';
    }
    $keywords = zen_db_input(zen_db_prepare_input($to_date . ' ' . $to_hour));
    $date_to_search = " and (o.date_purchased <=  '" . $keywords . "')";
  }

  $status_search = '';
  if (isset($sts) && zen_not_null($sts)) {
    $keywords = zen_db_input(zen_db_prepare_input($sts));
    $status_search = " and (s.orders_status_id = '" . $keywords . "')";
  }

  $search = $shipping_method_search . $payment_method_search . $customer_search . $company_search . $date_from_search . $date_to_search . $status_search;

  $new_fields = ", o.customers_company, o.customers_email_address, o.customers_street_address, o.delivery_company, o.delivery_name, o.delivery_street_address, o.billing_company, o.billing_name, o.billing_street_address, o.payment_module_code, o.shipping_module_code, o.ip_address ";
  $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total'  " . $search . " order by " . $disp_order;

  // Split Page
  // reset page when page is unknown
  if (($_GET['page'] == '' or $_GET['page'] <= 1) and $_GET['oID'] != '') {
    $check_page = $db->Execute($orders_query_raw);
    $check_count=1;
    if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS_ORDERS) {
      while (!$check_page->EOF) {
        if ($check_page->fields['orders_id'] == $_GET['oID']) {
          break;
        }
        $check_count++;
        $check_page->MoveNext();
      }
      $_GET['page'] = round((($check_count/MAX_DISPLAY_SEARCH_RESULTS_ORDERS)+(fmod_round($check_count,MAX_DISPLAY_SEARCH_RESULTS_ORDERS) !=0 ? .5 : 0)),0);
    } else {
      $_GET['page'] = 1;
    }
  }

  // $orders_query_numrows = '';
  $orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $orders_query_raw, $orders_query_numrows);
  $orders = $db->Execute($orders_query_raw);
?>
