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
//  DESCRIPTION: This is where everything starts and    //
//  ends.  This file builds the HTML display, calls the //
//  class file to build the data, then displays that    //
//  data for the user.                                  //
//////////////////////////////////////////////////////////
// $Id: stats_sales_report.php 103 2006-10-13 21:06:48Z BlindSide $
*/

//_TODO popup confirm box when report date range is very large
//_TODO option to load report into new window (can continue with other tasks)
//_TODO save report data to session var or temp file to redisplay without rebuilding
//_TODO "Help Me" link at the top to give basic usage instructions
//_TODO make presence of hidden back button on print display more obvious somehow...
//_TODO option to "count" sorting element on order/product line item views
//_TODO ability filter results by manufacturer (not just sort!)
//_TODO Matrix -> checkboxes for "per manufacturer" / "per product" / "per customer" stats


  require('includes/application_top.php');
  // we ramp up the execution time to make sure those
  // really big reports don't time out
  ini_set('max_execution_time', '300');

  $output_format = (isset($_GET['output_format']) ? $_GET['output_format'] : false);
  // possible scenarios: open clean             ($output_format = false)
  //                     display report         ($output_format = 'display')
  //                     print report           ($output_format = 'print')
  //                     csv report             ($output_format = 'csv')
  //                     criteria but no search ($output_format = 'none')

  // build arrays for dropdowns in search menu
  if (!$output_format || $output_format != 'print') {

    $status_array = array();
    $status_table = array();
    $orders_status = $db->Execute("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . "
                                   where language_id = '" . (int)$_SESSION['languages_id'] . "'
                                   order by orders_status_id asc");
    while (!$orders_status->EOF) {
      $status_array[] = array('id' => $orders_status->fields['orders_status_id'],
                              'text' => $orders_status->fields['orders_status_name'] . ' [' . $orders_status->fields['orders_status_id'] . ']');
      $status_table[ $orders_status->fields['orders_status_id'] ] = $orders_status->fields['orders_status_name'];
      $orders_status->MoveNext();
    }


    $payments_table = array();
    $payments_array[] = array('id' => false,
                              'text' => TEXT_EMPTY_SELECT);
    $payments = $db->Execute("select distinct payment_method, payment_module_code from " . TABLE_ORDERS);
    while (!$payments->EOF) {
      $payments_array[] = array('id' => $payments->fields['payment_module_code'],
                                'text' => $payments->fields['payment_method'] .
                                          ' [' . $payments->fields['payment_module_code'] . ']');
      $payments_table[ $payments->fields['payment_module_code'] ] = $payments->fields['payment_method'];
      $payments->MoveNext();
    }

    $manufacturers = $db->Execute("select * from " . TABLE_MANUFACTURERS . " order by manufacturers_name asc");
    if ($manufacturers->RecordCount() ) {
      $manufacturer_table = array();
      $manufacturer_array = array();
      $manufacturer_array[] = array('id' => false,
                                    'text' => TEXT_EMPTY_SELECT);
      while (!$manufacturers->EOF) {
        $id = (int)$manufacturers->fields['manufacturers_id'];
        $name = $manufacturers->fields['manufacturers_name'];
        $manufacturer_array[] = array('id' => $id,
                                      'text' => $name);
        $manufacturer_table[$id] = $name;
        $manufacturers->MoveNext();
      }
    } else {
      $manufacturer_table = false;
      $manufacturer_array = false;
    }

    $detail_array[] = array('id' => 'timeframe',
                            'text' => SELECT_DETAIL_TIMEFRAME);
    $detail_array[] = array('id' => 'product',
                            'text' => SELECT_DETAIL_PRODUCT);
    $detail_array[] = array('id' => 'order',
                            'text' => SELECT_DETAIL_ORDER);
    $detail_array[] = array('id' => 'matrix',
                            'text' => SELECT_DETAIL_MATRIX);


    $output_array[] = array('id' => 'display',
                            'text' => SELECT_OUTPUT_DISPLAY);
    $output_array[] = array('id' => 'print',
                            'text' => SELECT_OUTPUT_PRINT);
    $output_array[] = array('id' => 'csv',
                            'text' => SELECT_OUTPUT_CSV);
  }

  // build "key tables" to translate form values into text for print format headings
  if ($output_format == 'print') {
    $status_key = array();
    $orders_status = $db->Execute("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . "
                                   where language_id = '" . (int)$_SESSION['languages_id'] . "'
                                   order by orders_status_id asc");
    while (!$orders_status->EOF) {
      $status_key[ $orders_status->fields['orders_status_id'] ] = $orders_status->fields['orders_status_name'];
      $orders_status->MoveNext();
    }


    $payment_key = array();
    $payments = $db->Execute("select distinct payment_method, payment_module_code from " . TABLE_ORDERS);
    while (!$payments->EOF) {
      $payment_key[ $payments->fields['payment_module_code'] ] = $payments->fields['payment_method'];
      $payments->MoveNext();
    }

    $detail_key['timeframe'] = SELECT_DETAIL_TIMEFRAME;
    $detail_key['product'] = SELECT_DETAIL_PRODUCT;
    $detail_key['order'] = SELECT_DETAIL_ORDER;
    $detail_key['matrix'] = SELECT_DETAIL_MATRIX;

    $timeframe_key['day'] = SEARCH_TIMEFRAME_DAY;
    $timeframe_key['week'] = SEARCH_TIMEFRAME_WEEK;
    $timeframe_key['month'] = SEARCH_TIMEFRAME_MONTH;
    $timeframe_key['year'] = SEARCH_TIMEFRAME_YEAR;
  }


  if ($output_format) {
    // start the page parsing timer
    $parse_start = get_microtime();

    // process the search criteria
    $timeframe = $_GET['timeframe'];
    $timeframe_sort = $_GET['timeframe_sort'];

    // the sheer number of options for date range requires some extra checking...
    $date_preset = ($_GET['date_preset'] != '' ? $_GET['date_preset'] : false);
    if ($date_preset) {
      switch ($date_preset) {
        case 'yesterday':
          $start_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
          $end_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m"), date("d") - 1, date("Y")));
        break;
        case 'this_month':
          $start_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m"), 1, date("Y")));
          $end_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m"), date("d"), date("Y")));
        break;
        case 'last_month':
          $start_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m") - 1, 1, date("Y")));
          $end_date = date(DATE_FORMAT, mktime(0, 0, 0, date("m"), 0, date("Y")));
        break;
      }
    }  // END if ($date_preset)

    // no preset date range, so it must be a custom
    else {
      // defaults to beginning of the month when not set
      $start_date = ($_GET['start_date'] != '' ? $_GET['start_date'] : date(DATE_FORMAT, mktime(0, 0, 0, date("m") - 1, 1, date("Y"))) );

      // defaults to start date when not set (only have to enter a single day just once)
      $end_date = ($_GET['end_date'] != '' ? $_GET['end_date'] : $_GET['start_date']);
    }

    $date_target = ($_GET['date_target'] != '' ? $_GET['date_target'] : false);
    if ($date_target == 'status') {
      $date_status = $_GET['date_status'];
    } else {
      $date_status = false;
    }

    $payment_method = ($_GET['payment_method'] != '' ? $_GET['payment_method'] : false);
    $current_status = ($_GET['current_status'] != '' ? $_GET['current_status'] : false);
    $manufacturer = ($_GET['manufacturer'] != '' ? $_GET['manufacturer'] : false);
    $detail_level = ($_GET['detail_level'] != '' ? $_GET['detail_level'] : false);

    $li_sort_a = ($_GET['li_sort_a'] != '' ? $_GET['li_sort_a'] : false);
    $li_sort_order_a = ($_GET['li_sort_order_a'] != '' ? $_GET['li_sort_order_a'] : false);

    $li_sort_b = ($_GET['li_sort_b'] != '' ? $_GET['li_sort_b'] : false);
    $li_sort_order_b = ($_GET['li_sort_order_b'] != '' ? $_GET['li_sort_order_b'] : false);

    $auto_print = ($_GET['auto_print'] != '' ? true : false);
    $csv_header = ($_GET['csv_header'] != '' ? true : false);

    // if any required field is empty, cancel the report and alert the user
    // JavaScript checks should usually catch these, this is "just in case"
    if (!$start_date || !$end_date || !$date_target || !$detail_level || !$output_format) {
      $messageStack->add_session(ERROR_MISSING_REQ_INFO . '<br />' . $_GET['start_date'] . '<br />' . $_GET['end_date'], 'error');
      zen_redirect(zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('output_format')), 'NONSSL'));
    }

    // build the report array
    if ($output_format != 'none') {
      require(DIR_WS_CLASSES . 'sales_report.php');
                                                          //  (* = required)
      $sr = new sales_report($timeframe,                  //* determines how sales tallies are grouped
                             $start_date, $end_date,      //* the date range
                             $date_target, $date_status,  //* what date field to search, and the status (if needed)
                             $payment_method,             //  payment method used for desired orders
                             $current_status,             //  currently assigned status to the order
                             $manufacturer,               //  only include orders with assigned manufacturer
                             $detail_level,               //* what information to output
                             $output_format);             //* how to display the results


      if ($output_format == 'csv') {
	mb_http_output('SJIS');
	ob_start('mb_output_handler');
        // we have to pass the sorting values of the form since
        // the class instantiation does not require them
        $sr->output_csv($csv_header,
                        $timeframe_sort,
                        $li_sort_a,
                        $li_sort_order_a,
                        $li_sort_b,
                        $li_sort_order_b);

        exit;
      }
    }  // END if ($output_format != 'none')
  }  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<?php if ($output_format != 'print') { ?>
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="javascript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script language="javascript" src="includes/menu.js"></script>
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
<?php } ?>
<?php require(DIR_WS_INCLUDES . 'javascript/sales_report.js.php'); ?>
<style type="text/css">
<!--
fieldset{
margin:0 auto 30px auto;
padding:0px;
border-right:none;
border-bottom:none;
border-left:none;
}
legend{
background:#ffffff;
border:1px solid #C96E29;
color:#333333;
font-size:90%;
padding:0.2em 0.5em;
}
.detailTable{
border:1px solid #50504E;
}
.detailTable td{
padding:5px 10px;
}
.totalHeadingRow{
background-color:#50504E;
}
.totalHeadingContent{
color:#FFFFFF;
font-weight:bold;
font-size:12px;
}
.totalRow{
background-color:#EFEDEC;
}
.totalRowOver{
background-color:#FFFFFF;
}
.totalContent{
color:#000000;
font-size:12px;
border-bottom:1px solid #50504E;
}
.lineItemHeadingRow{
background-color:#FFFFFF;
}
.lineItemHeadingRow table{
border-top:1px solid #DCDCDC;
border-right:1px solid #DCDCDC;
border-left:1px solid #DCDCDC;
}
.lineItemHeadingRow table td{
padding:5px;
border-bottom:1px solid #DCDCDC;
}
.lineItemHeadingContent{
font-weight:bold;
font-size:12px;
background:#EFEDEC;
}
.lineItemRow{
background-color:#FFFFFF;
cursor:auto;
}
.lineItemRowOver{
background-color:#FFFFFF;
cursor:pointer;
}
.lineItemContent{
color:#000000;
font-size:12px;
}
.footerRow{
background-color:#df882f;
}
.footerContent{
color:#FFFFFF;
font-weight:bold;
font-size:12px;
}
.tableLayout1{
margin:10px 0 0 0;
}
.tableLayout1 th,
.tableLayout1None table th{
height:1em;
padding:0.5em 5px;  
}
.tableLayout1 td,
.tableLayout1None table td{
height:1em;
padding:0.5em 5px;  
}
.tableLayout1 select{
height:1.5em;
}
#tbl_date_preset th,
#tbl_date_custom th{
height:9em;
}
.tableLayout2{
margin:30px 0 0 0;
}
.paddingNone{
padding:0!important;
}
.imgMargin{
margin-top:5px;
}
-->
</style>
</head>
<?php
  // display the print header
  if ($output_format == 'print') {
    if ($auto_print) {
      echo '<body onload="print();">';
    }
?>
<table border="0" width="95%" cellspacing="0" cellpadding="0"  align="center">
  <!-- PRINT HEADER -->
  <tr>
    <td align="center" colspan="2"><?php echo '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('output_format')) . 'output_format=none', 'NONSSL') . '"><span class="pageHeading">' . PAGE_HEADING . '</span></a><br />'; ?></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><?php echo '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('output_format')) . 'output_format=none', 'NONSSL') . '"><span class="pageHeading">' . $start_date . PRINT_DATE_TO . $end_date . '</span></a><br />'; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top"><table border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td class="smalltext"><?php
          echo PRINT_DATE_TARGET;
          if ($date_target == 'purchased') {
            echo PRINT_DATE_PURCHASED;
          }
          elseif ($date_target == 'status') {
            echo PRINT_DATE_STATUS . ' (' . $status_key[$date_status] . ')';
          }
        ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo sprintf(PRINT_TIMEFRAMES, $timeframe_key[$timeframe], $timeframe_sort); ?></td>
      </tr>
      <tr>
        <td class="smalltext"><?php echo PRINT_DETAIL_LEVEL . $detail_key[$detail_level]; ?></td>
      </tr>
    </table></td>
    <td align="right" valign="top"><table border="0" cellspacing="1" cellpadding="2">
      <?php if ($payment_method) { ?>
      <tr>
        <td class="smalltext"><?php echo PRINT_PAYMENT_METHOD; ?></td>
        <td class="smalltext"><?php echo $payment_key[$payment_method]; ?></td>
      </tr>
      <?php } ?>
      <?php if ($current_status) { ?>
      <tr>
        <td class="smalltext"><?php echo PRINT_CURRENT_STATUS; ?></td>
        <td class="smalltext"><?php echo sprintf(PRINT_ORDER_STATUS, $status_key[$current_status], $current_status); ?></td>
      </tr>
      <?php } ?>
    </table><td/>
  </tr>
  <tr>
    <td colspan="2"><?php echo zen_black_line(); ?></td>
  </tr>
  <!-- END PRINT HEADER -->
<?php
  }
  // display the normal search header
  elseif (!$output_format || $output_format != 'print') {
?>
<body onload="init(); populate_search();">
<div id="spiffycalendar" class="text"></div>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "search", "start_date", "btnDate1", "<?php echo (($start_date == '') ? '' : $sr->sd); ?>", scBTNMODE_CALBTN);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "search", "end_date", "btnDate2", "<?php echo (($end_date == '') ? '' : $sr->ed); ?>", scBTNMODE_CALBTN);
/*
var scBTNMODE_DEFAULT;
var scBTNMODE_CUSTOMBLUE;
var scBTNMODE_CALBTN;
*/
</script>
<table border="0" width="95%" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="pageHeading" align="left"><?php echo PAGE_HEADING; ?></td>
    <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
  </tr>
  <?php echo zen_draw_form('search', FILENAME_STATS_SALES_REPORT, '', 'get', '', true); ?>
  <tr><td colspan="2">
    <fieldset><legend><?php echo HEADING_TITLE_SEARCH; ?></legend>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout1">
      <tr>
        <td valign="top"  rowspan="3" class="paddingNone">
          <table border="0"  cellspacing="0" cellpadding="0" id="tbl_date_preset">
            <tr>
              <th class="smallText borderBottomNone" width="100"><strong><?php echo SEARCH_DATE_PRESET; ?></strong>
               &nbsp;<a href="JavaScript:swap_date_search('date_preset')" class="imgPadding"><?php echo zen_image(DIR_WS_IMAGES . 'icons/custom_range.gif', '', '', '', 'align="bottom" class="imgMargin"'); ?></a></th>
            <td  class="borderBottomNone borderRightNone">
            <ul style="list-style:none; padding:0;margin:0;">
              <li class="smallText" id="td_yesterday"><?php echo zen_draw_radio_field('date_preset', 'yesterday', false) . sprintf(SEARCH_DATE_YESTERDAY, date("m-j", mktime(0, 0, 0, date("m"), date("d") - 1, date("Y"))) ); ?></li>
              <li class="smallText" id="td_last_month"><?php echo zen_draw_radio_field('date_preset', 'last_month', false) . sprintf(SEARCH_DATE_LAST_MONTH, date("Y-m", mktime(0, 0, 0, date("m") - 1)) ); ?></li>
              <li class="smallText" id="td_this_month"><?php echo zen_draw_radio_field('date_preset', 'this_month', false) . sprintf(SEARCH_DATE_THIS_MONTH, date("Y-m") ); ?></li>
              </ul>
              </td>
            </tr>
          </table>
          <table border="0" cellspacing="0" cellpadding="0"  id="tbl_date_custom" style="display:none">
            <tr>
              <th class="smallText borderBottomNone" width="100"><strong><?php echo SEARCH_DATE_CUSTOM; ?></strong>
                &nbsp;<a href="JavaScript:swap_date_search('date_custom')"><?php echo zen_image(DIR_WS_IMAGES . 'icons/preset_range.gif', '', '', '', 'align="bottom" class="imgMargin"'); ?></a>
              </th>
            
              <td class="smallText borderBottomNone  borderRightNone"><?php echo SEARCH_START_DATE ?><br /><script language="javascript">
                StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script><br />
              <?php echo SEARCH_END_DATE; ?><br /><script language="javascript">
                EndDate.writeControl(); EndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
              </td>
            </tr>
          </table>
        </td>
        
            <th valign="top" rowspan="3" class="smallText"><strong><?php echo SEARCH_DATE_TARGET; ?></strong></th>
            <td class="smallText"  rowspan="3">
              <input type="radio" name="date_target" value="purchased" onclick="hide('td_date_status', true)"><?php echo RADIO_DATE_TARGET_PURCHASED; ?><br />
              <input type="radio" name="date_target" value="status" onclick="show('td_date_status')"><?php echo RADIO_DATE_TARGET_STATUS; ?>
              <p id="td_date_status" style="visibility:hidden"><?php echo zen_draw_pull_down_menu('date_status', $status_array, $_GET['date_status'], 'id="date_status"'); ?></p>
            </td>
         
        
            <th class="smallText borderRightNone"><strong><?php echo
              SEARCH_PAYMENT_METHOD . '</strong></th><td>' .
              zen_draw_pull_down_menu('payment_method', $payments_array, $_GET['payment_method'], 'id="payment_method"');
            ?></td>
          </tr>
          <tr>
            <th class="smallText borderRightNone"><strong><?php echo
              SEARCH_CURRENT_STATUS . '</strong></th><td>' .
              zen_draw_pull_down_menu('current_status', array_merge(array(array('id' => '', 'text' => TEXT_EMPTY_SELECT)), $status_array), $_GET['current_status'], 'id="current_status"');
            ?></td>
          </tr>
          <?php if ($manufacturer_array) { ?>
          <tr>
            <th class="smallText borderRightNone"><strong><?php echo
              SEARCH_MANUFACTURER . '</strong></th><td>' .
              zen_draw_pull_down_menu('manufacturer', $manufacturer_array, $_GET['manufacturer'], 'id="manufacturer"');
            ?></td>
          </tr>
          <?php } ?>
      
    </table>
    </fieldset></td>
  </tr>
  <tr><td colspan="2">
    <fieldset><legend><?php echo HEADING_TITLE_SORT; ?></legend>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout1None">
      <tr>
        <!-- nested table to show/hide sort options without shifting entire row-->
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th class="smallText" valign="middle"><strong><?php echo SEARCH_TIMEFRAME; ?></strong></th>
            </tr>
            <tr>
              <td class="smallText borderBottomNone"><?php echo
                zen_draw_radio_field('timeframe', 'day', true) . SEARCH_TIMEFRAME_DAY . '<br />' .
                zen_draw_radio_field('timeframe', 'week') . SEARCH_TIMEFRAME_WEEK . '<br />' .
                zen_draw_radio_field('timeframe', 'month') . SEARCH_TIMEFRAME_MONTH . '<br />' .
                zen_draw_radio_field('timeframe', 'year') . SEARCH_TIMEFRAME_YEAR;
              ?></td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th class="smallText" valign="middle"><strong><?php echo SEARCH_TIMEFRAME_SORT; ?></strong></th>
            </tr>
            <tr>
              <td class="smallText borderBottomNone" valign="top"><?php echo
                zen_draw_radio_field('timeframe_sort', 'asc', true) . zen_image(DIR_WS_IMAGES . 'icons/up_arrow.gif') . '&nbsp;' . RADIO_TIMEFRAME_SORT_ASC . '<br />' .
                zen_draw_radio_field('timeframe_sort', 'desc') . zen_image(DIR_WS_IMAGES . 'icons/down_arrow.gif') . '&nbsp;' . RADIO_TIMEFRAME_SORT_DESC;
              ?></td>
            </tr>
          </table></td>
          <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th class="smallText"><strong><?php echo
                SEARCH_DETAIL_LEVEL . '</strong></th></tr><tr><td class="borderBottomNone"><br />' .
                zen_draw_pull_down_menu('detail_level', $detail_array, $_GET['detail_level'], 'id="detail_level" onchange="set_sort_options(document.search.detail_level.options[document.search.detail_level.selectedIndex].value);"');
              ?></td>
            </tr>
          </table></td>
        <!-- end table nesting -->          
        <td valign="top"><div id="div_li_table_a" style="display:block; visibility:hidden">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th class="smallText" valign="top"><strong>
                <span id="span_sort_title"><!-- JS will populate this --></span>
              </strong></th>
            </tr>
            <tr>
              <td class="smallText borderBottomNone" valign="top">
                <select name="li_sort_a" id="li_sort_a" size="0"><!-- JS will populate this --></select><br />
                <?php echo
                zen_draw_radio_field('li_sort_order_a', 'asc', true) . zen_image(DIR_WS_IMAGES . 'icons/up_arrow.gif') . '&nbsp;' . RADIO_LI_SORT_ASC . '<br />' .
                zen_draw_radio_field('li_sort_order_a', 'desc') . zen_image(DIR_WS_IMAGES . 'icons/down_arrow.gif') . '&nbsp;' . RADIO_LI_SORT_DESC;
              ?></td>
            </tr>
          </table>
        </div></td>
        <td valign="top"><div id="div_li_table_b" style="display:block; visibility:hidden">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <th class="smallText borderRightNone" valign="top"><strong><?php echo SEARCH_SORT_THEN; ?></strong></th>
            </tr>
            <tr>
              <td class="smallText borderBottomNone" valign="top">
                <select name="li_sort_b" id="li_sort_b" size="0"><!-- JS will populate this --></select><br />
                <?php echo
                zen_draw_radio_field('li_sort_order_b', 'asc', true) . zen_image(DIR_WS_IMAGES . 'icons/up_arrow.gif') . '&nbsp;' . RADIO_LI_SORT_ASC . '<br />' .
                zen_draw_radio_field('li_sort_order_b', 'desc') . zen_image(DIR_WS_IMAGES . 'icons/down_arrow.gif') . '&nbsp;' . RADIO_LI_SORT_DESC;
              ?></td>
            </tr>
          </table>
        </div></td>
      </tr>
    </table>
    </fieldset></td>
  </tr>
  <tr>
    <td colspan="2"><fieldset>
    <legend><?php echo HEADING_TITLE_PROCESS; ?></legend>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout1">
      <tr>
        <th class="smallText" width="200"><?php echo
          '<strong>' . SEARCH_OUTPUT_FORMAT . '</strong></th><td class="borderRightNone" width="150">' .
          zen_draw_pull_down_menu('output_format', $output_array, $_GET['output_format'], 'id="output_format" onchange="format_checkbox(document.search.output_format.options[document.search.output_format.selectedIndex].value);"');
        ?>
        </td>
        <td>
          <span id="span_auto_print" style="display:none"><?php echo zen_draw_checkbox_field('auto_print', '1', false) . CHECKBOX_AUTO_PRINT; ?></span>
          <span id="span_csv_header" style="display:none"><?php echo zen_draw_checkbox_field('csv_header', '1', false) . CHECKBOX_CSV_HEADER; ?></span></td>
          
        </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="tableLayout2">
        <tr>
        <td align="center" colspan="4">
        <input type="button" id="defaults" value="<?php echo BUTTON_LOAD_DEFAULTS; ?>" onclick="populate_search(true);"></input>&nbsp;
        <input type="button" id="btn_submit" value="<?php echo BUTTON_SEARCH; ?>" onclick="form_check();"><br />
        <?php echo zen_draw_checkbox_field('new_window', '1', false) . CHECKBOX_NEW_WINDOW; ?>
          </td>
      </tr>
    </table>
    </fieldset></td>
  </tr></form>
  <tr>
    <td align="left"><?php echo zen_draw_separator('pixel_trans.gif', 1, 15); ?></td>
    <td align="right" valign="top" id="td_wait_text" class="alert" style="font-size:12px; visibility:hidden"><?php echo SEARCH_WAIT_TEXT; ?>&nbsp;&nbsp;</td>
  </tr>
<?php
  }  // END <?php if ( (!$output_format || $output_format = 'display') && $output_format != 'print')
  if ($output_format == 'print' || $output_format == 'display') {
    // start currencies class to display monetary values
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();

    // timeframes are in ascending order by default, so we only
    // need to make changes if the user requests descending order
    if ($timeframe_sort == 'desc') {
      krsort($sr->timeframe);
    }

    // determine whether or not there are taxes
    $display_tax =  ($sr->grand_total['tax'] > 0 ? true : false);
    // DEBUG
    //$display_tax = true;

    // determine if lines should have the rollover effect
    $rollover = "";
    if ($output_format == 'display') {
      $rollover = 'onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)"';
?>
  <tr>
    <td colspan="2" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('output_format', 'auto_print')) . 'output_format=print&auto_print=1', 'NONSSL') . '" title="' . TEXT_PRINT_FORMAT_TITLE . '"><span class="smallText">' . zen_image(DIR_WS_IMAGES . 'icons/icon_print.gif') . '&nbsp;' . TEXT_PRINT_FORMAT . '</span></a>'; ?></td>
  </tr>
<?php
    }  // END if ($output_format == 'display')
?>
  <tr>
    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="0" class="detailTable">
<?php
    if ($sr->detail_level == 'timeframe') {
      // timeframe header line is coded twice because we only call it
      // once if we're displaying just totals, but repeats when
      // displaying the line item breakouts
?>
      <!--TIMEFRAME TOTAL HEADER 1-->
      <tr class="totalHeadingRow">
        <td class="totalHeadingContent"><?php echo TABLE_HEADING_TIMEFRAME; ?></td>
        <td class="totalHeadingContent" align="left"><?php echo TABLE_HEADING_NUM_ORDERS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_NUM_PRODUCTS; ?></td>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_GOODS; ?></td>
        <?php if ($display_tax) { ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <?php } ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_SHIPPING; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_USED; ?></td>
        <td class="totalHeadingContent" align="right" valign="middle"><?php echo TABLE_HEADING_TOTAL; ?></td>
      </tr>
<?php
    }
    // loop through each timeframe, displaying data according to the detail level
    foreach ($sr->timeframe as $id => $timeframe) {
      // generate the timeframe date display
      switch ($sr->timeframe_group) {
        case 'day':
          $time_display = date(TIME_DISPLAY_DAY, $timeframe['sd']);
        break;
        case 'week':
          $time_display = date(TIME_DISPLAY_WEEK, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_WEEK, $timeframe['ed']);
        break;
        case 'month':
          $time_display = date(TIME_DISPLAY_MONTH, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_MONTH, $timeframe['ed']);
        break;
        case 'year':
          $time_display = date(TIME_DISPLAY_YEAR, $timeframe['sd']) . DATE_SPACER . date(TIME_DISPLAY_YEAR, $timeframe['ed']);
        break;
      }

      // display the timeframe totals line, if necessary
      if ($sr->detail_level != 'timeframe') {
?>
      <!--TIMEFRAME TOTAL HEADER 2-->
      <tr class="totalHeadingRow">
        <td class="totalHeadingContent"><?php echo TABLE_HEADING_TIMEFRAME; ?></td>
        <td class="totalHeadingContent" align="left"><?php echo TABLE_HEADING_NUM_ORDERS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_NUM_PRODUCTS; ?></td>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_GOODS; ?></td>
        <?php if ($display_tax) { ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <?php } ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_SHIPPING; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_USED; ?></td>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL; ?></td>
      </tr>
<?php
      }
      if (is_array($timeframe['total'])) {
?>
      <tr class="totalRow" <?php echo $rollover; ?>>
        <td class="totalContent" align="left"><?php echo $time_display; ?></td>
        <td class="totalContent" align="left"><?php echo $timeframe['total']['num_orders']; ?></td>
        <td class="totalContent" align="right"><?php echo $timeframe['total']['num_products']; ?></td>
        <td class="totalContent" align="left" nowrap><?php echo TEXT_DIFF . sizeof($timeframe['total']['diff_products']); ?></td>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['goods']); ?></td>
        <?php if ($display_tax) { ?>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['tax']); ?></td>
        <?php } ?>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['shipping']); ?></td>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['discount']); ?></td>
        <td class="totalContent" nowrap><?php echo TEXT_QTY . $timeframe['total']['discount_qty']; ?></td>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['gc_sold']); ?></td>
        <td class="totalContent" nowrap><?php echo TEXT_QTY . $timeframe['total']['gc_sold_qty']; ?></td>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['gc_used']); ?></td>
        <td class="totalContent" nowrap><?php echo TEXT_QTY . $timeframe['total']['gc_used_qty']; ?></td>
        <td class="totalContent" align="right"><?php echo $currencies->format($timeframe['total']['grand']); ?></td>
      </tr>
<?php
      } elseif (DISPLAY_EMPTY_TIMEFRAMES) {
        // don't display anything
      } else {
        // display the "no data" line
        $colspan = 12;
        if ($display_tax) $colspan++;
?>
      <tr class="totalRow" <?php echo $rollover; ?>>
        <td class="totalContent" align="left"><?php echo $time_display; ?></td>
        <td class="totalContent" align="center" colspan="<?php echo $colspan; ?>"><?php echo TEXT_NO_DATA; ?></td>
      </tr>
<?php
      }

      // display order line items, if necessary
      if ($sr->detail_level == 'order' && is_array($timeframe['orders']) ) {
        // sort the orders according to requested sort options
        unset($dataset1, $dataset2);
        foreach($timeframe['orders'] as $oID => $o_data) {
          $dataset1[$oID] = $o_data[$li_sort_a];
          $dataset2[$oID] = $o_data[$li_sort_b];
        }

        // set the sorting arrays to all-lowercase so that the data
        // is sorted independent of any capitalization
        $dataset1 = array_map('strtolower', $dataset1);
        $dataset2 = array_map('strtolower', $dataset2);

/*
        //DEBUGGING
        echo '<br /><br />]] DATA SET ONE [[<br /><br />';
        print_r($dataset1);
        echo '<br /><br />)) DATA SET TWO ((<br /><br />';
        print_r($dataset2);
        echo '<br /><br />-- END ITERATION --<br /><br />';
*/
        // we can't put sorting flags (SORT_ASC, SORT_DESC) into variables, so
        // we use a series of if/else statements to choose the proper sort
        // direction and perform the sort
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
?>
      <!--ORDER LINE ITEM HEADER-->
      <tr class="lineItemHeadingRow">
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_ORDERS_ID . show_arrow('oID'); ?></td>
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMER . show_arrow('last_name'); ?></td>
        <td class="lineItemHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_NUM_PRODUCTS . show_arrow('num_products'); ?></td>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_GOODS . show_arrow('goods'); ?></td>
        <?php if ($display_tax) { ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <?php } ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_SHIPPING . show_arrow('shipping'); ?></td>
        <td class="lineItemHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS . show_arrow('discount'); ?></td>
        <td class="lineItemHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD . show_arrow('gc_sold'); ?></td>
        <td class="lineItemHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_USED . show_arrow('gc_used'); ?></td>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL . show_arrow('grand'); ?></td>
      </tr>
<?php
        foreach($timeframe['orders'] as $key => $o_data) {
          // skip order if it has no value
          // search 'has_no_value' in class file to see how it is set
          if ($o_data['has_no_value']) continue;
?>
      <tr class="lineItemRow" <?php echo $rollover; ?> onclick="document.location.href=<?php echo '\'' . zen_href_link(FILENAME_ORDERS, 'oID=' . $o_data['oID'] . '&action=edit', 'NONSSL') . '\''; ?>">
        <td class="lineItemContent" align="left"><strong><?php echo $o_data['oID']; ?></strong></td>
        <td class="lineItemContent" align="left"><?php echo $o_data['first_name'] . ', ' . $o_data['last_name']; ?></td>
        <td class="lineItemContent" align="right"><?php echo $o_data['num_products']; ?></td>
        <td class="lineItemContent" align="left" nowrap><?php echo (sizeof($o_data['diff_products']) > 1 ? TEXT_DIFF . sizeof($o_data['diff_products']) : ($o_data['num_products'] > 1 ? TEXT_SAME : TEXT_SAME_ONE) ); ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['goods']); ?></td>
        <?php if ($display_tax) { ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['tax']); ?></td>
        <?php } ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['shipping']); ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['discount']); ?></td>
        <td class="lineItemContent" align="left" nowrap><?php echo TEXT_QTY . $o_data['discount_qty']; ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['gc_sold']); ?></td>
        <td class="lineItemContent" align="left" nowrap><?php echo TEXT_QTY . $o_data['gc_sold_qty']; ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['gc_used']); ?></td>
        <td class="lineItemContent" align="left" nowrap><?php echo TEXT_QTY . $o_data['gc_used_qty']; ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($o_data['grand']); ?></td>
      </tr>
<?php
        }
      }
      // display product line items, if necessary
      elseif ($sr->detail_level == 'product' && is_array($timeframe['products']) ) {
        // sort the products according to requested sort options
        unset($dataset1, $dataset2);
        foreach($timeframe['products'] as $pID => $p_data) {
          $dataset1[$pID] = $p_data[$li_sort_a];
          $dataset2[$pID] = $p_data[$li_sort_b];
        }
        // set the sorting arrays to all-lowercase so that the data
        // is sorted independent of any capitalization
        $dataset1 = array_map('strtolower', $dataset1);
        $dataset2 = array_map('strtolower', $dataset2);

        // we can't put sorting flags (SORT_ASC, SORT_DESC) into variables, so
        // we use a series of if/else statements to choose the proper sort
        // direction and perform the sort
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

        // we have to nest tables for product line items
        // because the displayed data is so different from timeframe
        // totals, otherwise column layout is a nightmare :)
        $colspan = 13;
        if ($display_tax) $colspan++;
?>
<tr class="lineItemHeadingRow">
<td colspan="<?php echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <!--PRODUCT LINE ITEM HEADER -->
      <tr class="lineItemHeadingRow">
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT_ID . show_arrow('pID'); ?></td>
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCT_NAME . show_arrow('name'); ?></td>
        <?php if (DISPLAY_MANUFACTURER) { ?>
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_MANUFACTURER . show_arrow('manufacturer'); ?></td>
        <?php } ?>
        <td class="lineItemHeadingContent" align="left"><?php echo TABLE_HEADING_MODEL . show_arrow('model'); ?></td>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_BASE_PRICE . show_arrow('base_price'); ?></td>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_QUANTITY . show_arrow('quantity'); ?></td>
        <?php if ($display_tax) { ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <?php } if (DISPLAY_ONE_TIME_FEES) { ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_ONETIME_CHARGES . show_arrow('onetime_charges'); ?></td>
        <?php } if ($display_tax) { ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL; ?></td>
        <?php } ?>
        <td class="lineItemHeadingContent" align="right"><?php echo TABLE_HEADING_PRODUCT_TOTAL . show_arrow('grand'); ?></td>
      </tr>
<?php
        foreach($timeframe['products'] as $key => $p_data) {
?>
      <tr class="lineItemRow" <?php echo $rollover; ?>>
        <td class="lineItemContent" align="left"><strong><?php echo $p_data['pID']; ?></strong></td>
        <td class="lineItemContent" align="left"><?php echo $p_data['name']; ?></td>
        <?php if (DISPLAY_MANUFACTURER) { ?>
        <td class="lineItemContent" align="left"><?php echo $p_data['manufacturer']; ?></td>
        <?php } ?>
        <td class="lineItemContent" align="left"><?php echo $p_data['model']; ?></td>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($p_data['base_price']); ?></td>
        <td class="lineItemContent" align="right"><?php echo $p_data['quantity']; ?></td>
        <?php if ($display_tax) { ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($p_data['tax']); ?></td>
        <?php } if (DISPLAY_ONE_TIME_FEES) { ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($p_data['onetime_charges']); ?></td>
        <?php } if ($display_tax) { ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($p_data['total']); ?></td>
        <?php } ?>
        <td class="lineItemContent" align="right"><?php echo $currencies->format($p_data['grand']); ?></td>
      </tr>
<?php
        }  // END foreach($timeframe['products'] as $pID => $p_data) {
?>
</table></td></tr>
<tr class="lineItemHeadingRow">
<td colspan="<?php echo $colspan; ?>">
<?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?>
</td>
</tr>
<?php
      }  // END elseif ($sr->detail_level == 'product')

      // display the data matrix
      elseif ($sr->detail_level == 'matrix' && (is_array($timeframe['orders']) && is_array($timeframe['products']) ) ) {
        $colspan = 13;
        if ($display_tax) $colspan++;
?>
      <tr class="lineItemHeadingRow">
        <td class="lineItemHeadingContent" align="center" colspan="<?php echo $colspan; ?>"><?php echo MATRIX_GENERAL_STATS; ?></td>
      </tr>
      <tr class="lineItemRow">
        <td colspan="<?php echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="lineItemRow">
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="3"><strong><?php echo MATRIX_ORDER_REVENUE; ?></strong></td>
              </tr>
              <tr>
                <td class="lineItemContent"><?php echo MATRIX_LARGEST; ?></td>
                <td class="lineItemContent"><?php echo $timeframe['matrix']['biggest_per_revenue']; ?></td>
                <td class="lineItemContent"><?php echo '(' . $currencies->format($timeframe['orders'][ $timeframe['matrix']['biggest_per_revenue'] ]['goods']) . ')'; ?></td>
              </tr>
              <tr>
                <td class="lineItemContent"><?php echo MATRIX_SMALLEST; ?></td>
                <td class="lineItemContent"><?php echo $timeframe['matrix']['smallest_per_revenue']; ?></td>
                <td class="lineItemContent"><?php echo '(' . $currencies->format($timeframe['orders'][ $timeframe['matrix']['smallest_per_revenue'] ]['goods']) . ')'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="3"><strong><?php echo MATRIX_ORDER_PRODUCT_COUNT; ?></strong></td>
              </tr>
              <tr>
                <td class="lineItemContent"><?php echo MATRIX_LARGEST; ?></td>
                <td class="lineItemContent"><?php echo $timeframe['matrix']['biggest_per_product']; ?></td>
                <td class="lineItemContent"><?php echo '(' . $timeframe['orders'][ $timeframe['matrix']['biggest_per_product'] ]['num_products'] . ')'; ?></td>
              </tr>
              <tr>
                <td class="lineItemContent"><?php echo MATRIX_SMALLEST; ?></td>
                <td class="lineItemContent"><?php echo $timeframe['matrix']['smallest_per_product']; ?></td>
                <td class="lineItemContent"><?php echo '(' . $timeframe['orders'][ $timeframe['matrix']['smallest_per_product'] ]['num_products'] . ')'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="2" align="left"><strong><?php echo MATRIX_AVERAGES; ?></strong></td>
              </tr>
              <tr>
                <td class="lineItemContent" align="right"><strong><?php echo $currencies->format($timeframe['matrix']['avg_order_value']); ?></strong></td>
                <td class="lineItemContent"><?php echo MATRIX_AVG_ORDER; ?></td>
              </tr>
              <tr>
                <td class="lineItemContent" align="right"><strong><?php echo number_format($timeframe['matrix']['avg_products_per_order'], NUM_DECIMAL_PLACES); ?></strong></td>
                <td class="lineItemContent"><?php echo MATRIX_AVG_PROD_ORDER; ?></td>
              </tr>
              <tr>
                <td class="lineItemContent" align="right"><strong><?php echo number_format($timeframe['matrix']['avg_diff_products_per_order'], NUM_DECIMAL_PLACES); ?></strong></td>
                <td class="lineItemContent"><?php echo MATRIX_AVG_PROD_ORDER_DIFF; ?></td>
              </tr>
              <tr>
                <td class="lineItemContent" align="right"><strong><?php echo number_format($timeframe['matrix']['avg_orders_per_customer'], NUM_DECIMAL_PLACES); ?></strong></td>
                <td class="lineItemContent"><?php echo MATRIX_AVG_ORDER_CUST; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr class="lineItemHeadingRow">
        <td class="lineItemHeadingContent" align="center" colspan="<?php echo $colspan; ?>"><?php echo MATRIX_ORDER_STATS; ?></td>
      </tr>
      <tr class="lineItemRow">
        <td colspan="<?php echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="lineItemRow">
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="3"><strong><?php echo MATRIX_TOTAL_PAYMENTS; ?></strong></td>
              </tr>
              <?php foreach($timeframe['matrix']['payment_methods'] as $key => $payment) { ?>
              <tr>
                <td class="lineItemContent"><?php echo $payment['method']; ?></td>
                <td class="lineItemContent"><?php echo '&nbsp;[' . $payment['module_code'] . ']'; ?></td>
                <td class="lineItemContent" align="right"><?php echo $payment['count']; ?></td>
              </tr>
              <?php } ?>
            </table></td>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="2"><strong><?php echo MATRIX_TOTAL_CC; ?></strong></td>
              </tr>
              <?php foreach($timeframe['matrix']['credit_cards'] as $key => $cc) { ?>
              <tr>
                <td class="lineItemContent"><?php echo $cc['type']; ?></td>
                <td class="lineItemContent" align="right"><?php echo $cc['count']; ?></td>
              </tr>
              <?php } ?>
            </table></td>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="3"><strong><?php echo MATRIX_TOTAL_SHIPPING; ?></strong></td>
              </tr>
              <?php foreach($timeframe['matrix']['shipping_methods'] as $key => $shipping) { ?>
              <tr>
                <td class="lineItemContent"><?php echo $shipping['method']; ?></td>
                <td class="lineItemContent"><?php echo '&nbsp;[' . $shipping['module_code'] . ']'; ?></td>
                <td class="lineItemContent" align="right"><?php echo $shipping['count']; ?></td>
              </tr>
              <?php } ?>
            </table></td>
          <?php if (sizeof($timeframe['matrix']['currencies']) > 0) { ?>
            <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="lineItemContent" colspan="2"><strong><?php echo MATRIX_TOTAL_CURRENCIES; ?></strong></td>
              </tr>
              <?php foreach($timeframe['matrix']['currencies'] as $key => $currency) { ?>
              <tr>
                <td class="lineItemContent"><?php echo $currency['type']; ?></td>
                <td class="lineItemContent" align="right"><?php echo $currency['count']; ?></td>
              </tr>
              <?php } ?>
            </table></td>
          <?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr class="lineItemHeadingRow">
        <td class="lineItemHeadingContent" align="center" colspan="<?php echo $colspan; ?>"><?php echo MATRIX_PRODUCT_STATS; ?></td>
      </tr>
      <tr class="lineItemRow">
        <td colspan="<?php echo $colspan; ?>"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="lineItemRow">
            <td class="lineItemContent"><strong><?php echo TABLE_HEADING_PRODUCT_ID; ?></strong></td>
            <td class="lineItemContent"><strong><?php echo TABLE_HEADING_PRODUCT_NAME; ?></strong></td>
            <td class="lineItemContent" align="center"><strong><?php echo MATRIX_PRODUCT_SPREAD; ?></strong></td>
            <td class="lineItemContent" align="right"><strong><?php echo MATRIX_PRODUCT_REVENUE_RATIO; ?></strong></td>
            <td class="lineItemContent" align="right"><strong><?php echo MATRIX_PRODUCT_QUANTITY_RATIO; ?></strong></td>
          </tr>
<?php
        foreach($timeframe['products'] as $pID => $p_data) {
?>
          <tr class="lineItemRow">
            <td class="lineItemContent"><?php echo $pID; ?></td>
            <td class="lineItemContent"><?php echo $p_data['name']; ?></td>
            <td class="lineItemContent" align="center"><?php echo $timeframe['matrix']['product_spread'][$pID]; ?></td>
            <td class="lineItemContent" align="right"><?php echo $timeframe['matrix']['product_revenue_ratio'][$pID]; ?></td>
            <td class="lineItemContent" align="right"><?php echo $timeframe['matrix']['product_quantity_ratio'][$pID]; ?></td>
          </tr>
<?php
        }
?>
        </table></td>
      </tr>
<?php
      }  // END elseif ($sr->detail_level == 'matrix' && is_array($timeframe['matrix']) )

    }  // END for ($i = 0; $i < sizeof($sr->timeframe); $i++)

    // now display the grand total line (if necessary)
    // the totals don't change with only 1 timeframe, so we
    // require that there be more than one to display it
    if (sizeof($sr->timeframe) > 1) {
?>
      
      <?php if ($sr->detail_level != 'timeframe') { ?>
      <tr class="totalHeadingRow">
        <td class="totalHeadingContent"><?php echo TABLE_HEADING_TIMEFRAME; ?></td>
        <td class="totalHeadingContent" align="left"><?php echo TABLE_HEADING_NUM_ORDERS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_NUM_PRODUCTS; ?></td>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_GOODS; ?></td>
        <?php if ($display_tax) { ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <?php } ?>
        <td class="totalHeadingContent" align="right"><?php echo TABLE_HEADING_SHIPPING; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_DISCOUNTS; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_SOLD; ?></td>
        <td class="totalHeadingContent" align="center" colspan="2"><?php echo TABLE_HEADING_GC_USED; ?></td>
        <td class="totalHeadingContent" align="right" valign="middle"><?php echo TABLE_HEADING_TOTAL; ?></td>
      </tr>
      <?php } ?>
      <!-- GRAND TOTAL LINE -->
      <tr class="footerRow">
        <td class="footerContent"><?php echo sizeof($sr->timeframe) . TABLE_FOOTER_TIMEFRAMES; ?></td>
        <td class="footerContent" align="left"><?php echo $sr->grand_total['num_orders']; ?></td>
        <td class="footerContent" align="center" colspan="2"><?php echo $sr->grand_total['num_products']; ?></td>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['goods']); ?></td>
        <?php if ($display_tax) { ?>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['tax']); ?></td>
        <?php } ?>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['shipping']); ?></td>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['discount']); ?></td>
        <td class="footerContent" align="left" nowrap><?php echo TEXT_QTY . $sr->grand_total['discount_qty']; ?></td>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['gc_sold']); ?></td>
        <td class="footerContent" align="left" nowrap><?php echo TEXT_QTY . $sr->grand_total['gc_sold_qty']; ?></td>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['gc_used']); ?></td>
        <td class="footerContent" align="left" nowrap><?php echo TEXT_QTY . $sr->grand_total['gc_used_qty']; ?></td>
        <td class="footerContent" align="right"><?php echo $currencies->format($sr->grand_total['grand']); ?></td>
      </tr>
      <!-- END GRAND TOTAL LINE -->
<?php
    }  // END if (sizeof($sr->timeframe) > 1)
?>
    </table></td>
  </tr>
<?php
    if ($output_format == 'print') {
?>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', 30, 20); ?></td>
    <td align="right" valign="bottom" class="smallText"><?php echo TEXT_REPORT_TIMESTAMP . zen_datetime_short(date("Y-m-d H:i:s")); ?></td>
  </tr>
<?php
    }
    elseif ($output_format == 'display') {
      $parse_end = get_microtime();
      $parse_time = $parse_end - $parse_start;
?>
  <tr>
    <td colspan="2" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('output_format', 'auto_print')) . 'output_format=print&auto_print=1', 'NONSSL') . '" title="' . TEXT_PRINT_FORMAT_TITLE . '"><span class="smallText">' . zen_image(DIR_WS_IMAGES . 'icons/icon_print.gif') . '&nbsp;' . TEXT_PRINT_FORMAT . '</span></a>'; ?></td>
  </tr>
  <tr>
    <td valign="bottom" class="smallText"><?php printf(TEXT_PARSE_TIME, number_format($parse_time, 5) ); ?></td>
    <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 20); ?></td>
  </tr>
<?php
    }
  }  // END if ($output_format == 'print' || $output_format == 'display')
?>
</table>
<?php if ($output_format != 'print') require(DIR_WS_INCLUDES . 'footer.php'); ?>
</body>
</html>
<?php
require(DIR_WS_INCLUDES . 'application_bottom.php');

// used to show the page parse time
// look for $parse_start and $parse_end to see how it works
function get_microtime() {
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}

// controls the sorting arrows that appear next to the sorted
// columns with order/product line item displays
function show_arrow($report_field) {
  global $li_sort_a, $li_sort_order_a, $li_sort_b, $li_sort_order_b, $output_format;
  $arrow = "";
  $link = "";

  if ($report_field == $li_sort_a) {
    if ($li_sort_order_a == 'asc') {
      $link = '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('li_sort_order_a')) . 'li_sort_order_a=desc', 'NONSSL') . '" ' .
      'onmouseover="img_over(\'img_sort_a\', \'' . DIR_WS_IMAGES . 'icons/down_arrow.gif' . '\')" ' .
      'onmouseout="img_over(\'img_sort_a\', \'' . DIR_WS_IMAGES . 'icons/up_arrow.gif' . '\'' . ')">';

      $arrow = zen_image(DIR_WS_IMAGES . 'icons/up_arrow.gif', ALT_TEXT_SORT_DESC, '', '', 'align=bottom id="img_sort_a"') . '<span class="lineItemHeadingContent">1</span>';

      if ($output_format == 'display') {
        return '&nbsp;' . $link . $arrow . '</a>';
      } else {
        return '&nbsp;' . $arrow;
      }
    }

    elseif ($li_sort_order_a == 'desc') {
      $link = '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('li_sort_order_a')) . 'li_sort_order_a=asc', 'NONSSL') . '" ' .
      'onmouseover="img_over(\'img_sort_a\', \'' . DIR_WS_IMAGES . 'icons/up_arrow.gif' . '\')" ' .
      'onmouseout="img_over(\'img_sort_a\', \'' . DIR_WS_IMAGES . 'icons/down_arrow.gif' . '\'' . ')">';

      $arrow = zen_image(DIR_WS_IMAGES . 'icons/down_arrow.gif', ALT_TEXT_SORT_ASC, '', '', 'align=bottom id="img_sort_a"') . '<span class="lineItemHeadingContent">1</span>';

      if ($output_format == 'display') {
        return '&nbsp;' . $link . $arrow . '</a>';
      } else {
        return '&nbsp;' . $arrow;
      }

    }
  }
  elseif ($report_field == $li_sort_b) {
    if ($li_sort_order_b == 'asc') {
      $link = '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('li_sort_order_b')) . 'li_sort_order_b=desc', 'NONSSL') . '" ' .
      'onmouseover="img_over(\'img_sort_b\', \'' . DIR_WS_IMAGES . 'icons/down_arrow.gif' . '\')" ' .
      'onmouseout="img_over(\'img_sort_b\', \'' . DIR_WS_IMAGES . 'icons/up_arrow.gif' . '\'' . ')">';

      $arrow = zen_image(DIR_WS_IMAGES . 'icons/up_arrow.gif', ALT_TEXT_SORT_DESC, '', '', 'align=bottom id="img_sort_b"') .' <span class="lineItemHeadingContent">2</span>';

      if ($output_format == 'display') {
        return '&nbsp;' . $link . $arrow . '</a>';
      } else {
        return '&nbsp;' . $arrow;
      }
    }

    elseif ($li_sort_order_b == 'desc') {
      $link = '<a href="' . zen_href_link(FILENAME_STATS_SALES_REPORT, zen_get_all_get_params(array('li_sort_order_b')) . 'li_sort_order_b=asc', 'NONSSL') . '" ' .
      'onmouseover="img_over(\'img_sort_b\', \'' . DIR_WS_IMAGES . 'icons/up_arrow.gif' . '\')" ' .
      'onmouseout="img_over(\'img_sort_b\', \'' . DIR_WS_IMAGES . 'icons/down_arrow.gif' . '\'' . ')">';

      $arrow = zen_image(DIR_WS_IMAGES . 'icons/down_arrow.gif', ALT_TEXT_SORT_ASC, '', '', 'align=bottom id="img_sort_b"') . '<span class="lineItemHeadingContent">2</span>';

      if ($output_format == 'display') {
        return '&nbsp;' . $link . $arrow . '</a>';
      } else {
        return '&nbsp;' . $arrow;
      }
    }
  }
}
?>