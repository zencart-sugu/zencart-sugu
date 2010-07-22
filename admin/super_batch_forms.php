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
// $Id: super_batch_forms.php 27 2006-02-03 20:06:12Z BlindSide $
*/

//_TODO: FILL CHECKBOX WHEN ANY PART OF LINE IS CLICKED (LIKE PHPMYADMIN)

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");

  while (!$orders_status->EOF) {
    $orders_statuses[] = array('id' => $orders_status->fields['orders_status_id'],
                               'text' => $orders_status->fields['orders_status_name'] . ' [' . $orders_status->fields['orders_status_id'] . ']');
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $products = all_products_array(DROPDOWN_ALL_PRODUCTS, true, false, true);
  $payments = all_payments_array(DROPDOWN_ALL_PAYMENTS, true);
  $customers = all_customers_array(DROPDOWN_ALL_CUSTOMERS, true, false);

  $ot_sign = array();
  $ot_sign[] = array('id' => '>=',
                     'text' => DROPDOWN_GREATER_THAN);
  $ot_sign[] = array('id' => '<=',
                     'text' => DROPDOWN_LESS_THAN);
  $ot_sign[] = array('id' => '=',
                     'text' => DROPDOWN_EQUAL_TO);

  if ($_GET['action'] == 'batch_forms') {
    $target_file = $_POST['target_file'];
    $selected_oids = $_POST['batch_order_numbers'];
    $num_copies = $_POST['num_copies'];

    batch_forms($target_file, $selected_oids, $num_copies);
  }

  else {
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
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
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "order_search", "start_date", "btnDate1", "<?php echo (($_GET['start_date'] == '') ? '' : $_GET['start_date']); ?>", scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "order_search", "end_date", "btnDate2", "<?php echo (($_GET['end_date'] == '') ? '' : $_GET['end_date']); ?>", scBTNMODE_CUSTOMBLUE);
</script>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
  <!-- search -->
    <td width="100%" valign="top" align="center"><table width="95%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
		  	 <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
		  </tr>
          <tr>
            <!--<td colspan="2" class="pageHeading"><?php echo
              HEADING_TITLE . '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_STATUS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_STATUS, '') . '\'">' .
              '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_ORDERS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, '') . '\'">';
            ?></td>-->
			<td colspan="2" class="pageHeading"><?php echo HEADING_TITLE ;?></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
          </tr>
          <tr>
            <td class="main" colspan="3">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableLayout1">
              <tr>
						<th colspan="3"><strong><?php echo HEADING_SEARCH_FILTER; ?></strong></th>
              </tr>
					<?php echo zen_draw_form('order_search', FILENAME_SUPER_BATCH_FORMS, '', 'get', '', true); ?>
              <tr>
						<td valign="top" class="borderRightNone">
							<p><?php echo HEADING_START_DATE; ?><br /><script language="javascript">
							StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></p>
							<p><?php echo HEADING_END_DATE; ?><br /><script language="javascript">
							EndDate.writeControl(); EndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></p>
                </td>
						<td valign="top" class="borderRightNone">
							<table border="0" cellspacing="0" cellpadding="0" class="tableLayout3 borderBottomNone">
              <tr>
									<th><?php echo HEADING_SEARCH_STATUS; ?></th>
									<td><?php echo zen_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), $_GET['status'], ''); ?></td>
              </tr>
              <tr>
							<th><?php echo HEADING_SEARCH_PRODUCTS; ?></th>
                <td class="smallText"><?php echo zen_draw_pull_down_menu('products', $products, $_GET['products'], ''); ?></td>
              </tr>
              <tr>
							<th><?php echo HEADING_SEARCH_CUSTOMERS; ?></th>
							<td><?php echo zen_draw_pull_down_menu('customers', $customers, $_GET['customers'], ''); ?></td>
              </tr>
							</table>
						</td>
						<td valign="top">
							<table border="0" cellspacing="0" cellpadding="0" class="tableLayout3 borderBottomNone">
              <tr>
							<th><?php echo HEADING_SEARCH_PAYMENT_METHOD; ?></th>
							<td colspan="2"><?php echo zen_draw_pull_down_menu('payments', $payments, $_GET['payments'], ''); ?></td>
              </tr>
              <tr>
							<th><?php echo HEADING_SEARCH_ORDER_TOTAL; ?></th>
							<td><?php echo zen_draw_pull_down_menu('ot_sign', $ot_sign, $_GET['ot_sign'], ''); ?></td>
							<td><?php echo zen_draw_input_field('order_total', '', 'size="8"') . TEXT_ORDER_VALUE; ?></td>
              </tr>
              <tr>
							<th><?php echo HEADING_SEARCH_TEXT; ?></th>
							<td colspan="2"><?php echo zen_draw_input_field('search', $_GET['search']); ?></td>
              </tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
          </tr>
          <tr>
            <td colspan="3">
				
			</td>
          </tr></form>
		   <tr>
            <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 20); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="3"><?php echo zen_draw_separator(); ?></td>
      </tr>
	  <tr>
            <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
      </tr>
<!-- end search -->
<?php
// we only need to check one variable since all are passed with the form
if (isset($_GET['start_date']) ) {
  // create query based on filter crieria
  $orders_query_raw = "SELECT o.orders_id, o.customers_id, o.customers_name,
                              o.payment_method, o.date_purchased, o.order_total, s.orders_status_name
                       FROM " . TABLE_ORDERS . " o
                       LEFT JOIN " . TABLE_ORDERS_STATUS . " s ON o.orders_status = s.orders_status_id";

  if (isset($_GET['products']) && zen_not_null($_GET['products'])) {
    $orders_query_raw .= " LEFT JOIN " . TABLE_ORDERS_PRODUCTS . " op ON o.orders_id = op.orders_id";
  }

  $orders_query_raw .= " WHERE s.language_id = '" . (int)$_SESSION['languages_id'] . "'";

  $search = '';
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_scrub_in($_GET['search'], true);
    $search = " and (o.customers_city like '%" . $keywords . "%' or o.customers_postcode like '%" . $keywords . "%' or o.date_purchased like '%" . $keywords . "%' or o.billing_name like '%" . $keywords . "%' or o.billing_company like '%" . $keywords . "%' or o.billing_street_address like '%" . $keywords . "%' or o.delivery_city like '%" . $keywords . "%' or o.delivery_postcode like '%" . $keywords . "%' or o.delivery_name like '%" . $keywords . "%' or o.delivery_company like '%" . $keywords . "%' or o.delivery_street_address like '%" . $keywords . "%' or o.billing_city like '%" . $keywords . "%' or o.billing_postcode like '%" . $keywords . "%' or o.customers_email_address like '%" . $keywords . "%' or o.customers_name like '%" . $keywords . "%' or o.customers_company like '%" . $keywords . "%' or o.customers_street_address  like '%" . $keywords . "%' or o.customers_telephone like '%" . $keywords . "%')";

    $orders_query_raw .= $search;
  }

  $sd = zen_date_raw(isset($_GET['start_date']) ? $_GET['start_date'] : '');
  $ed = zen_date_raw(isset($_GET['end_date']) ? $_GET['end_date'] : '');

  if ($sd != '' && $ed != '') {
    $orders_query_raw .= " AND o.date_purchased BETWEEN '" . $sd . "' AND DATE_ADD('" . $ed . "', INTERVAL 1 DAY)";
  }

  if (isset($_GET['status']) && zen_not_null($_GET['status'])) {
    $orders_query_raw .= " AND o.orders_status = '" . $_GET['status'] . "'";
  }

  if (isset($_GET['products']) && zen_not_null($_GET['products'])) {
    $orders_query_raw .= " AND op.products_id = '" . $_GET['products'] . "'";
  }

  if (isset($_GET['customers']) && zen_not_null($_GET['customers'])) {
    $orders_query_raw .= " AND o.customers_id = '" . $_GET['customers'] . "'";
  }

  if (isset($_GET['payments']) && zen_not_null($_GET['payments'])) {
    $orders_query_raw .= " AND o.payment_module_code = '" . $_GET['payments'] . "'";
  }
  if (isset($_GET['order_total']) && zen_not_null($_GET['order_total'])) {
    $orders_query_raw .= " AND o.order_total " . $_GET['ot_sign'] . " '" . (int)$_GET['order_total'] . "'";
  }

  else if ($sd != '') {
    $orders_query_raw .= " AND o.date_purchased >= '" . $sd . "'";
  }
  else if ($ed != '') {
    $orders_query_raw .= " AND o.date_purchased <= DATE_ADD('" . $ed . "', INTERVAL 1 DAY)";
  }
  $orders_query_raw .= " ORDER BY o.orders_id DESC";

  //DEBUG
  //echo '<br>'.$orders_query_raw.'<br>';

  $orders = $db->Execute($orders_query_raw);
  if ($orders->RecordCount() > 0) {
    $checked = ($_GET['checked'] == 1 ? true : false);
?>
      <tr>
      <?php echo zen_draw_form('batch_print', FILENAME_SUPER_BATCH_FORMS, 'action=batch_forms', 'post', 'target="_blank"'); ?>
        <td><table border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td class="main"><?php echo HEADING_SELECT_FORM; ?></td>
            <td class="main"><?php echo zen_draw_separator('pixel_trans.gif', 150, 1); ?></td>
            <td class="main"><?php echo HEADING_NUM_COPIES; ?></td>
          </tr>
          <tr>
            <td class="main" colspan="2"><?php echo zen_draw_radio_field('target_file', FILENAME_SUPER_INVOICE . '.php', true) . SELECT_INVOICE; ?></td>
            <td class="main"><select name="num_copies" size="1">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
          <tr>
            <td class="main" colspan="3"><?php echo zen_draw_radio_field('target_file', FILENAME_SUPER_PACKINGSLIP . '.php') . SELECT_PACKINGSLIP; ?></td>
          </tr>
          <tr>
            <td class="main" colspan="3"><?php echo zen_draw_radio_field('target_file', FILENAME_SUPER_SHIPPING_LABEL . '.php') . SELECT_SHIPPING_LABEL; ?></td>
          </tr>
          <tr>
            <td class="main" colspan="3" align="right"><input type="submit" value="<?php echo BUTTON_SUBMIT_PRINT; ?>"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="2" cellpadding="0">
          <tr>
            <td class="main" valign="bottom"><?php
              echo TEXT_TOTAL_ORDERS . '<strong>' . $orders->RecordCount() . '</strong>' . '&nbsp;&nbsp;';
              if ($checked) {
                echo '<INPUT TYPE="BUTTON" VALUE="' . BUTTON_UNCHECK_ALL . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_FORMS, zen_get_all_get_params(array('checked')) . 'checked=0', $request_type) . '\'">';
              } else {
                echo '<INPUT TYPE="BUTTON" VALUE="' . BUTTON_CHECK_ALL . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_FORMS, zen_get_all_get_params(array('checked')) . 'checked=1', $request_type) . '\'">';
              }
            ?></td>
            <td class="smallText" align="right" valign="bottom"><?php echo zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS) . '&nbsp;' . ICON_ORDER_DETAILS; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left" colspan="2">&nbsp;&nbsp;<?php echo TABLE_HEADING_ORDERS_ID; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="left"s><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></td>
                <td class="dataTableHeadingContent" align="left" colspan="2"><?php echo TABLE_HEADING_ORDER_STATUS; ?></td>
              </tr>
<?php
    while (!$orders->EOF) {
?>
              <tr class="dataTableRow" onmouseover="rowOverEffect(this);this.style.cursor='default'" onmouseout="rowOutEffect(this)">
                <td class="dataTableContent" align="left"><?php
                  echo zen_draw_checkbox_field('batch_order_numbers[' . $orders->fields['orders_id'] . ']', 'yes', $checked);
                  echo $orders->fields['orders_id'];
                ?></td>
                <td class="dataTableContent" align="right"><?php echo '[' . $orders->fields['customers_id'] . ']'; ?></td>
                <td class="dataTableContent" align="left"><?php echo $orders->fields['customers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $currencies->format($orders->fields['order_total']); ?></td>
                <td class="dataTableContent" align="center"><?php echo zen_datetime_short($orders->fields['date_purchased']); ?></td>
                <td class="dataTableContent" align="left"><?php echo $orders->fields['payment_method']; ?></td>
                <td class="dataTableContent" align="left"><?php echo $orders->fields['orders_status_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $orders->fields['orders_id'] . '&action=edit', $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS) . '</a>&nbsp'; ?></td>
              </tr>
<?php
      $orders->MoveNext();
    }
  }  // END if ($orders->RecordCount() > 0)
?>
                </form>
                </table></td>
              </tr>
              <tr>
                <td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
              </tr>
            </table></td>
          </tr>
<tr>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
</tr>
        </table></td>
      </tr>
<?php } else { ?>
      <!--<tr>
        <td colspan="2"><?php echo TEXT_ENTER_SEARCH; ?></td>
      </tr>-->
<?php } ?>
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php }

function batch_forms($target_file, $selected_oids, $num_copies = 1) {
        unset($batch_order_numbers);
        foreach($selected_oids as $order_number => $print_order) {
          $batch_order_numbers[] = $order_number;
        }

        // begin error handling
        if (!(is_array($batch_order_numbers))){
          exit(ERROR_NO_ORDERS);
        }

        if (!(is_file($target_file))){
          exit(ERROR_NO_FILE);
        }
        // end error handling

        sort($batch_order_numbers);
        $number_of_orders = sizeof($batch_order_numbers);
        $total_rows = $number_of_orders * $num_copies;

        // begin create framesetstart
        $frame_set_start = '<frameset rows="*';
        for ($i = 1; $i < $total_rows; $i++) {
          $frame_set_start .= ',*'; // print invoices 2 times
        }


        $frame_set_start .= '">' . "\n\n";
        // end create framesetstart

        // begin create frames
        foreach ($batch_order_numbers as $order_number) {
          $frames .= "\t" . '<frame src="' . $target_file . '?oID=' . $order_number . '">' . "\n";
          if ($num_copies > 1) {
            for ($i = 1; $i < $num_copies; $i++) {
              $frames .= "\t" . '<frame src="' . $target_file . '?oID=' . $order_number . '">' . "\n";
            }
          }
        }
        // end create frame

        // begin create frameset_end
        $frameset_end = '</frameset>' . "\n";
        // end create frameset_end

        // end create framesetstart

        // begin output:

        ?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
        <html>
        <head>
        <title><?php echo TITLE_BATCH_OUTPUT . '(' . $target_file . ' :: ' . $number_of_orders . ' pages :: ' . $num_copies . ' copies)'; ?></title>
        </head>
        <?php

        echo $frame_set_start;
        echo $frames;
        echo $frameset_end;

        // debug
        /*
        echo "Sessions: <pre>";
        echo 'order numbers:';
        print_r($batch_order_numbers);
        echo "</pre>";
        */
        echo '</html>';
        // end output:

        require(DIR_WS_INCLUDES . 'application_bottom.php');
}
?>
