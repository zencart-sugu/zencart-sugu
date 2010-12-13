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
//  FILENAME:      super_batch_status.php               //
//                                                      //
//  DESCRIPTION:   Updates order statuses en masse.     //
//  Displayed orders can be customized based on         //
//  available filters (date range, current status,      //
//  customer, and product)                              //
//////////////////////////////////////////////////////////
// $Id: super_batch_status.php 25 2006-02-03 18:55:56Z BlindSide $
*/
//_TODO Row-clicking abilities similar to phpMyAdmin
  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

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
 	$sbs_languages = all_languages_array(DROPDOWN_ALL_LANGUAGES, true, false);

  $ot_sign = array();
  $ot_sign[] = array('id' => '>=',
                     'text' => DROPDOWN_GREATER_THAN);
  $ot_sign[] = array('id' => '<=',
                     'text' => DROPDOWN_LESS_THAN);
  $ot_sign[] = array('id' => '=',
                     'text' => DROPDOWN_EQUAL_TO);

  if ($_GET['action'] == 'batch_status') {
    $selected_oids = $_POST['batch_order_numbers'];
    if (!is_array($selected_oids)) {
      // DEBUG
      //echo '<br>' . $selected_oids . '<br>';
      exit(ERROR_NO_ORDERS);
    }

    $status = zen_db_scrub_in($_POST['assign_status'], true);
    $comments = $_POST['comments'];
    $comments = stripslashes($comments);
    $comments = trim($comments);
    $comments = mysql_escape_string($comments);
    $comments = htmlspecialchars($comments);

    $notify = (int)$_POST['notify'];
    $notify_comments = $_POST['notify_comments'];

    foreach($selected_oids as $oID => $print_order) {
      batch_status($oID, $status, $comments, $notify, $notify_comments);
    }
    zen_redirect(zen_href_link(FILENAME_SUPER_BATCH_STATUS, '', $request_type));
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
  function init() {
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
<body onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "order_search", "start_date", "btnDate1", "<?php echo (($_GET['start_date'] == '') ? '' : $_GET['start_date']); ?>", scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "order_search", "end_date", "btnDate2", "<?php echo (($_GET['end_date'] == '') ? '' : $_GET['end_date']); ?>", scBTNMODE_CUSTOMBLUE);
</script>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- begin search -->
    <td width="100%" valign="top" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
		  	 <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
		  </tr>
		  <tr>
            <!--<td colspan="3" class="pageHeading"><?php echo
              HEADING_TITLE . '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_FORMS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_FORMS, '') . '\'">' .
              '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_ORDERS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, '') . '\'">';
            ?></td>-->
			<td colspan="3" class="pageHeading"><?php echo HEADING_TITLE ; ?></td>
          </tr>
          <tr>
            <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
          </tr>
          <tr>
            <td class="main" colspan="3">
				<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tableLayout1">
					<tr>
						<th colspan="3"><strong><?php echo HEADING_SEARCH_FILTER; ?></strong></th>
          </tr>
          <?php echo zen_draw_form('order_search', FILENAME_SUPER_BATCH_STATUS, '', 'get', '', true); ?>
          <tr>
						<td valign="top" class="borderRightNone">
							<p><?php echo HEADING_START_DATE; ?><script language="javascript">
							StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script></p>
							<p><?php echo HEADING_END_DATE; ?><script language="javascript">
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
									<td><?php echo zen_draw_pull_down_menu('products', $products, $_GET['products'], ''); ?></td>
              </tr>
              <tr>
									<th><?php echo HEADING_SEARCH_CUSTOMERS; ?></th>
									<td><?php echo zen_draw_pull_down_menu('customers', $customers, $_GET['customers'], ''); ?></td>
              </tr>
              <tr>
									<th><?php echo HEADING_SEARCH_LANGUAGES; ?></th>
									<td><?php echo zen_draw_pull_down_menu('languages', $sbs_languages, $_GET['languages'], ''); ?></td>
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
							<table>
								<tr>
									<td><input type="submit" value="¸¡º÷" /></td>
								</tr>
							</table>
						</td>
              </tr>
				</table>
				</td>
          </tr>
          <tr>
            <td  colspan="3"><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
					</tr>
          </form>
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

  if (isset($_GET['languages']) && zen_not_null($_GET['languages'])) {
    $orders_query_raw .= " LEFT JOIN " . TABLE_CUSTOMERS . " c ON o.customers_id = c.customers_id";
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

  if (isset($_GET['languages']) && zen_not_null($_GET['languages'])) {
    $orders_query_raw .= " AND c.customers_languages_id = '" . $_GET['languages'] . "'";
  }

  if (isset($_GET['payments']) && zen_not_null($_GET['payments'])) {
    $orders_query_raw .= " AND o.payment_module_code = '" . $_GET['payments'] . "'";
  }
  if (isset($_GET['order_total']) && zen_not_null($_GET['order_total'])) {
    $orders_query_raw .= " AND o.order_total " . $_GET['ot_sign'] . " '" . (int)$_GET['order_total'] . "'";
  }

  $orders_query_raw .= " ORDER BY o.orders_id DESC";

  //DEBUG
  //echo '<br>'.$orders_query_raw.'<br>';

  $orders = $db->Execute($orders_query_raw);
  if ($orders->RecordCount() > 0) {
    $checked = ($_GET['checked'] == 1 ? true : false);
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <?php echo zen_draw_form('batch_status', FILENAME_SUPER_BATCH_STATUS, 'action=batch_status', 'post', ''); ?>
          <tr>
            <td align="left" colspan="2"><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="main" colspan="3"><strong><?php echo HEADING_UPDATE_ORDERS; ?></strong></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo HEADING_SELECT_STATUS; ?></strong></td>
                <td class="smallText" colspan="2"><?php echo zen_draw_pull_down_menu('assign_status', $orders_statuses, $_GET['assign_status'], ''); ?></td>
              </tr>
              <tr>
                <td class="main" valign="top"><strong><?php echo HEADING_ADD_COMMENTS; ?></strong></td>
                <td width="400" class="smallText"><?php echo zen_draw_textarea_field('comments', 'soft', '70', '4'); ?></td>
                <td class="main" valign="center"><strong><?php
                  echo zen_draw_checkbox_field('notify', '', true); echo '&nbsp;' . ENTRY_NOTIFY_CUSTOMER . '<br/>';
                  echo zen_draw_checkbox_field('notify_comments', '', true); echo '&nbsp;' . ENTRY_NOTIFY_COMMENTS; ?></strong>
                  <br /><br />
                  &nbsp;<?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
              </tr>
            </table></td>
              </tr>
              <tr>
            <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', 1, 5); ?></td>
          </tr>
          <tr>
            <td class="main" valign="bottom"><?php
              echo TEXT_TOTAL_ORDERS . '<strong>' . $orders->RecordCount() . '</strong>' . '&nbsp;&nbsp;';
              if ($checked) {
                echo '<INPUT TYPE="BUTTON" VALUE="' . BUTTON_UNCHECK_ALL . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_STATUS, zen_get_all_get_params(array('checked')) . 'checked=0', 'NONSSL') . '\'">';
              } else {
                echo '<INPUT TYPE="BUTTON" VALUE="' . BUTTON_CHECK_ALL . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_STATUS, zen_get_all_get_params(array('checked')) . 'checked=1', 'NONSSL') . '\'">';
              }
            ?></td>
            <td class="main" align="right" valign="bottom"><strong><?php echo zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS) . '&nbsp;' . ICON_ORDER_DETAILS; ?></strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
                  <tr class="dataTableRow" onMouseOver="rowOverEffect(this);this.style.cursor='default'" onMouseOut="rowOutEffect(this)">
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
        </table></td>
      </tr>
<?php } else { ?>
      <!--
      <tr>
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
function batch_status($oID, $status, $comments, $notify = 0, $notify_comments = 0) {

	global $db, $messageStack;
  require(DIR_WS_LANGUAGES . 'english/super_orders.php');

  $order_updated = false;
  $check_status = $db->Execute("select customers_name, customers_email_address, orders_status,
                                date_purchased from " . TABLE_ORDERS . "
                                where orders_id = '" . (int)$oID . "'");

  if ( ($check_status->fields['orders_status'] != $status) || zen_not_null($comments)) {
    $customer_notified = '0';
  if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
    $customer_notified = '1';
  }

  update_status($oID, $status, $customer_notified, $comments);

  if ($customer_notified == '1') {
    email_latest_status($oID, $notify_comments);
  }

    $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
  }
  else {
    $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
  }
}
?>
