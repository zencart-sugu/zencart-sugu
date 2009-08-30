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
//  DESCRIPTION:   Report that displays all income for  //
//  the given date range.  Report results come solely   //
//  from the Super Orders payment system.               //
//////////////////////////////////////////////////////////
// $Id: super_report_cash.php 28 2006-02-06 15:11:28Z BlindSide $
*/

  require('includes/application_top.php');

  $target = (isset($_GET['target']) ? $_GET['target'] : false);
  $is_for_display = ($_GET['print_format'] == 1 ? false : true);

  if ($target) {
    require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
    require(DIR_WS_CLASSES . 'super_order.php');

    $sd = zen_date_raw((!isset($_GET['start_date']) ? date("m-d-Y",(time())) : $_GET['start_date']));
    $ed = zen_date_raw((!isset($_GET['end_date']) ? date("m-d-Y",(time())) : $_GET['end_date']));
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/super_stylesheet.css">
<?php if ($is_for_display) { ?>
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
<?php } ?>
</head>
<?php if ($is_for_display) { ?>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<script language="javascript">
var StartDate = new ctlSpiffyCalendarBox("StartDate", "search", "start_date", "btnDate1", "<?php echo (($_GET['start_date'] == '') ? '' : $_GET['start_date']); ?>", scBTNMODE_CUSTOMBLUE);
var EndDate = new ctlSpiffyCalendarBox("EndDate", "search", "end_date", "btnDate2", "<?php echo (($_GET['end_date'] == '') ? '' : $_GET['end_date']); ?>", scBTNMODE_CUSTOMBLUE);
</script>
<?php } ?>

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
<?php
  if (!$is_for_display) {
?>
<!-- Print Header -->
        <td><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_REPORT_CASH, 'target=' . $target) . '&start_date=' . $_GET['start_date'] . '&end_date=' . $_GET['end_date'] . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
        <td class="pageHeading" align="right"><?php echo $_GET['start_date'] . TEXT_TO . $_GET['end_date']; ?></td>
      </tr>
<!-- END Print Header -->
<?php
  }
  else {
?>
<!-- Display Header -->
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          <tr>
          <?php echo zen_draw_form('search', FILENAME_SUPER_REPORT_CASH, '', 'get'); ?>
          <tr>
            <td class="main"><?php echo HEADING_SELECT_TARGET; ?></td>
            <td class="main"><?php echo HEADING_DATE_RANGE; ?></td>
          </tr>
          <tr>
            <td valign="top"><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="main" valign="top"><?php echo zen_draw_radio_field('target', 'payments') . TEXT_PAYMENTS; ?></td>
              </tr>
              <tr>
                <td class="main" valign="top"><?php echo zen_draw_radio_field('target', 'refunds') . TEXT_REFUNDS; ?></td>
              </tr>
              <tr>
                <td class="main" valign="top"><?php echo zen_draw_radio_field('target', 'both') . TEXT_BOTH; ?></td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="smallText" align="left">
                  <?php echo HEADING_START_DATE . '<br />'; ?>
                  <script language="javascript">
                    StartDate.writeControl(); StartDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";
                  </script>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="left"><?php echo HEADING_END_DATE . '<br />'; ?>
                  <script language="javascript">
                    EndDate.writeControl(); EndDate.dateFormat="<?php echo DATE_FORMAT_SPIFFYCAL; ?>";
                  </script>
                </td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="2" cellpadding="0">
              <tr>
                <td class="smallText" valign="top"><br /><?php echo zen_draw_checkbox_field('print_format', 1) . HEADING_PRINT_FORMAT; ?></td>
              </tr>
              <tr>
                <td class="main" valign="bottom"><br /><input type="submit" value="<?php echo BUTTON_SEARCH; ?>"></td>
              </tr>
            </table></td>
          </tr>
          </form>
        </td></table>
<?php
    if ($target && $is_for_display) {
?>
        <td align="right" valign="bottom"><table border="0" cellspacing="2" cellpadding="3">
          <tr>
            <td class="main" align="center"><?php echo HEADING_COLOR_KEY; ?></td>
          </tr>
          <tr class="paymentRow">
            <td class="dataTableContent" align="center"><?php echo TEXT_PAYMENTS; ?></td>
          </tr>
          <tr class="refundRow">
            <td class="dataTableContent" align="center"><?php echo TEXT_REFUNDS; ?></td>
          </tr>
        </table></td>
<?php
    }
?>
      </tr>
<?php
  }  // END if ($is_for_display)
?>
    </table></td>
  </tr>
<!-- END Display Header -->
<?php
  if ($target) {
?>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ORDER_ID; ?></td>
        <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_POSTED; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_NUMBER; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_NAME; ?></td>
        <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_TYPE; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_STATE; ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_AMOUNT; ?></td>
      </tr>
<?php
    $grand_count = 0;
    $grand_total = 0;
    $num_of_types = 0;

    if ($target == 'payments' || $target == 'both') {
      $payment_query = "SELECT * FROM " . TABLE_SO_PAYMENTS . " p
                        LEFT JOIN " . TABLE_ORDERS . " o
                        ON p.orders_id = o.orders_id
                        WHERE date_posted BETWEEN '" . $sd . "' AND DATE_ADD('" . $ed . "', INTERVAL 1 DAY)
                        ORDER BY payment_type asc";
      $payment = $db->Execute($payment_query);

      if (zen_not_null($payment->fields['orders_id'])) {
        $so = new super_order($payment->fields['orders_id']);  // instantiated once simply for the full_type() function
        $current_type = strtoupper($payment->fields['payment_type']);
        $num_of_types++;
        $sub_total = 0;
        $sub_count = 0;
?>
      <tr>
        <td colspan="7" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . $so->full_type($current_type) . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
        //_TODO make this into a do/while loop so that the final sub_total values can be displayed
        while (!$payment->EOF) {
          if ($current_type != strtoupper($payment->fields['payment_type']) ) {
            // print subtotal line & count for type
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableContent" colspan="3" align="left"><strong><?php echo sprintf(TABLE_SUB_COUNT, $so->full_type($current_type)) . $sub_count; ?></strong></td>
        <td class="dataTableContent" colspan="4" align="right"><strong><?php echo sprintf(TABLE_SUB_TOTAL, $so->full_type($current_type)) . $currencies->format($sub_total); ?></strong></td>
      </tr>
<?php
            // reset type values for the next one
            $current_type = strtoupper($payment->fields['payment_type']);
            $num_of_types++;
            $sub_total = 0;
            $sub_count = 0;
?>
      <tr>
        <td colspan="7" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . $so->full_type($current_type) . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
          }
?>
      <tr class="paymentRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $payment->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $payment->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="center"><?php echo zen_datetime_short($payment->fields['date_posted']); ?></td>
        <td class="dataTableContent" align="left"><?php echo $payment->fields['payment_number']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $payment->fields['payment_name']; ?></td>
        <td class="dataTableContent" align="center"><?php echo zen_get_payment_type_name($payment->fields['payment_type']); ?></td>
        <td class="dataTableContent" align="left"><?php echo $payment->fields['billing_state']; ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($payment->fields['payment_amount']); ?></td>
      </tr>
<?php
          $sub_count++;
          $grand_count++;

          $sub_total += $payment->fields['payment_amount'];
          $grand_total += $payment->fields['payment_amount'];

          $payment->MoveNext();

        }  // END while (!$payment->EOF)
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableContent" colspan="3" align="left"><strong><?php echo sprintf(TABLE_SUB_COUNT, $so->full_type($current_type)) . $sub_count; ?></strong></td>
        <td class="dataTableContent" colspan="4" align="right"><strong><?php echo sprintf(TABLE_SUB_TOTAL, $so->full_type($current_type)) . $currencies->format($sub_total); ?></strong></td>
      </tr>
<?php
      }  // END if (zen_not_null($payment->fields['orders_id']))
      else {
?>
      <tr>
        <td class="dataTableContent" colspan="7" align="center"><strong><?php echo TEXT_NO_PAYMENT_DATA; ?></strong></td>
      </tr>
<?php
      }

    }  // END if ($target == 'payments' || $target == 'both')

    if ($target == 'refunds' || $target == 'both') {
      $refund_query = "SELECT * FROM " . TABLE_SO_REFUNDS . "
                       WHERE date_posted BETWEEN '" . $sd . "' AND DATE_ADD('" . $ed . "', INTERVAL 1 DAY)";

      $refund = $db->Execute($refund_query);

      if (zen_not_null($refund->fields['orders_id'])) {
        $refund_count = 0;
        $refund_total = 0;
?>
      <tr>
        <td colspan="7" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . TEXT_REFUNDS . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
        while (!$refund->EOF) {
?>
      <tr class="refundRow" width="100%" cellspacing="0" cellpadding="0" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $refund->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $refund->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="center"><?php echo zen_datetime_short($refund->fields['date_posted']); ?></td>
        <td class="dataTableContent" align="left"><?php echo $refund->fields['refund_number']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $refund->fields['refund_name']; ?></td>
        <td class="dataTableContent" align="center"><?php echo $refund->fields['refund_type']; ?></td>
        <td class="dataTableContent" align="left">&nbsp;</td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($refund->fields['refund_amount']); ?></td>
      </tr>
<?php
          $refund_count++;
          $refund_total += $refund->fields['refund_amount'];
          $refund->MoveNext();
        }

      }  // END if (zen_not_null($refund->fields['orders_id']))
      else {
?>
      <tr>
        <td class="dataTableContent" colspan="7" align="center"><strong><?php echo TEXT_NO_REFUND_DATA; ?></strong></td>
      </tr>
<?php
      }
      $total_income = $grand_total - $refund_total;
?>
      <tr>
        <td colspan="7" align="right"><table border="0" cellspacing="3" cellpadding="0">
          <tr>
            <td class="ot-tax-Text" align="right"><strong><?php echo (int)$grand_count . ' ' . TABLE_FOOTER_CASH_TOTAL; ?></strong></td>
            <td class="ot-tax-Amount" align="right"><?php echo $currencies->format($grand_total); ?></td>
          </tr>
          <tr>
            <td class="ot-tax-Text" align="right"><strong><?php echo (int)$refund_count . ' ' . TABLE_FOOTER_REFUND_TOTAL; ?></strong></td>
            <td class="ot-tax-Amount" align="right"><?php echo '-' . $currencies->format($refund_total); ?></td>
          </tr>
          <tr>
            <td class="ot-total-Text" align="right"><?php echo TABLE_FOOTER_TOTAL_INCOME; ?></td>
            <td class="ot-total-Amount" align="right"><?php echo $currencies->format($total_income); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
    }  // END if ($target == 'refunds' || $target == 'both')
    else {
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableContent" colspan="3" align="left"><strong><?php echo TABLE_FOOTER_NUM_PAYMENTS . $grand_count; ?></strong></td>
        <td class="dataTableContent" colspan="4" align="right"><strong><?php echo TABLE_FOOTER_TOTAL_INCOME . $currencies->format($grand_total); ?></strong></td>
      </tr>
<?php
    }
    if ($num_of_types > 1) {
?>
      <tr>
        <td class="dataTableContent" colspan="7" align="left"><?php echo $num_of_types . TABLE_FOOTER_NUM_TYPES; ?></td>
      </tr>
<?php
    }
?>
    </table></td>
<?php
  }  // END if ($target)
?>
<!-- body_text_eof //-->
</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php if ($is_for_display) require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>