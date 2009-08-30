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
//  DESCRIPTION:   This report displays orders that     //
//  have outstanding payments and refunds, or           //
//  missing purchase order data.  Orders missing a      //
//  purchase order are not included in the missing      //
//  payment report.                                     //
//////////////////////////////////////////////////////////
// $Id: super_report_await_pay.php 32 2006-03-30 22:44:14Z BlindSide $
*/

require('includes/application_top.php');
require(DIR_WS_CLASSES . 'super_order.php');
require(DIR_WS_CLASSES . 'currencies.php');
$currencies = new currencies();

$report_type = (isset($_GET['report_type']) ? $_GET['report_type'] : false);
$isForDisplay = (($_GET['print_format'] < 1) ? true : false);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/super_stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<?php if ($isForDisplay) { ?>
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
<?php if ($isForDisplay) { ?>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<?php } ?>
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <?php if (!$isForDisplay) {
        if ($report_type == 'out_po') {
          $this_report = OUT_PO;
        }
        elseif ($report_type == 'out_payment') {
          $this_report = OUT_PAYMENTS;
        }

        elseif ($report_type == 'out_refund') {
          $this_report = OUT_REFUNDS;
        }
      ?>
      <!-- print_header //-->
      <tr>
        <td><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_REPORT_AWAIT_PAY, 'report_type=' . $report_type) . '"><span class="pageHeading">' .  HEADING_TITLE . '</span></a>'; ?></td>
        <td class="pageHeading" align="right"><?php echo date('l M d, Y', time()); ?></td>
      </tr>
      <tr>
        <td class="pageHeading"><?php echo $this_report; ?><br />&nbsp;</td>
      </tr>
      <!-- print_header_eof //-->
      <?php } else { ?>
      <tr>
        <td class="pageHeading" align="left"><?php echo HEADING_TITLE; ?></td>
        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
      </tr>
      <tr>
        <?php echo zen_draw_form('select_search', FILENAME_SUPER_REPORT_AWAIT_PAY, '', 'get'); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo HEADING_REPORT_TYPE; ?></td>
            <td width="50">&nbsp;</td>
            <td class="smallText"><?php echo zen_draw_checkbox_field('print_format', 1) . HEADING_PRINT_FORMAT; ?></td>
          </tr>
          <tr>
            <td class="main">
              <?php echo zen_draw_radio_field('report_type', 'out_po') . OUT_PO . '<br />'; ?>
              <?php echo zen_draw_radio_field('report_type', 'out_payment') . OUT_PAYMENTS . '<br />'; ?>
              <?php echo zen_draw_radio_field('report_type', 'out_refund') . OUT_REFUNDS . '<br />'; ?>
            </td>
            <td width="50">&nbsp;</td>
            <td class="smallText" valign="top"><?php echo zen_draw_checkbox_field('within_limit', 1) . HEADING_WITHIN_LIMIT; ?></td>
          </tr>
          <tr>
            <td class="main" align="right" colspan="3"><input type="submit" value="<?php echo BUTTON_SEARCH; ?>"></td>
          </tr>
        </table></td>
        </form>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
<?
  if ($report_type) {
?>
  <tr>
    <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_STATE; ?></td>
        <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_BILLING_NAME; ?></td>
        <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS_PHONE; ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
<?php
    if ($report_type == 'out_payment' || $report_type == 'out_refund') {
?>
        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_AMOUNT_APPLIED; ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SO_BALANCE; ?></td>
<?php
    }
?>
      </tr>
<?php
  if ($_GET['within_limit'] == 1) {
    $date_limit = "";
  }
  else {
    $date_limit = " AND date_purchased <= DATE_ADD(CURDATE(), INTERVAL -1 MONTH) ";
  }

  $num_orders = 0;
  $total_applied = 0;
  $total_balance = 0;
  $order_grand_total = 0;

  if ($report_type == 'out_po') {
    $outstanding = $db->Execute("SELECT o.* FROM " . TABLE_ORDERS . " o
                                 LEFT JOIN " . TABLE_SO_PURCHASE_ORDERS . " p
                                 ON o.orders_id = p.orders_id
                                 WHERE o.payment_module_code = 'purchaseorder'
                                 AND o.date_cancelled IS NULL
                                 AND o.balance_due > 0
                                 AND p.orders_id IS NULL " .
                                 $date_limit . "
                                 ORDER BY o.orders_id ASC");
    while (!$outstanding->EOF) {
      $order_grand_total += $outstanding->fields['order_total'];
      $num_orders++;
?>
      <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $outstanding->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $outstanding->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $outstanding->fields['customers_state']; ?></td>
        <td class="dataTableContent" align="center"><?php echo $outstanding->fields['date_purchased']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $outstanding->fields['billing_name']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $outstanding->fields['customers_telephone']; ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($outstanding->fields['order_total']); ?></td>
      </tr>
<?php
      $outstanding->MoveNext();
    }
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableHeadingContent" align="left"><?php echo $num_orders . TEXT_ORDERS; ?></td>
        <td colspan="4">&nbsp;</td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($order_grand_total); ?></td>
      </tr>
<?php
  } // END if ($report_type == 'out_po')


  elseif ($report_type == 'out_payment') {
    $sub_order_total = 0;
    $sub_applied = 0;
    $sub_balance = 0;
    $sub_num_orders = 0;

    // first display any outstanding payments on purchase orders
    // this is money owed to us for stuff already shipped
    $out_po_check = $db->Execute("SELECT * FROM " . TABLE_ORDERS . "
                                  WHERE payment_module_code = 'purchaseorder'
                                  AND date_completed IS NULL
                                  AND date_cancelled IS NULL
                                  AND balance_due > 0
                                  AND orders_status != 1" .
                                  $date_limit . "
                                  ORDER BY orders_id ASC");
    if ($out_po_check->RecordCount() > 0) {
?>
      <tr>
        <td colspan="8" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . TABLE_SUBHEADING_PO_CHECKS . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
      while (!$out_po_check->EOF) {
        unset($so);
        $so = new super_order($out_po_check->fields['orders_id']);

        if ($so->purchase_order) {
          $sub_order_total += $so->order_total;
          $sub_applied += $so->amount_applied;
          $sub_balance += $so->balance_due;
          $sub_num_orders++;
?>
      <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $out_po_check->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $out_po_check->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_po_check->fields['customers_state']; ?></td>
        <td class="dataTableContent" align="center"><?php echo $out_po_check->fields['date_purchased']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_po_check->fields['billing_name']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_po_check->fields['customers_telephone']; ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->order_total); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->amount_applied); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->balance_due); ?></td>
      </tr>
<?php
        }
        $out_po_check->MoveNext();
      }
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableHeadingContent" align="left"><?php echo $sub_num_orders . TEXT_ORDERS; ?></td>
        <td colspan="4">&nbsp;</td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_order_total); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_applied); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_balance); ?></td>
      </tr>
<?php
      // add to grand totals
      $order_grand_total += $sub_order_total;
      $total_applied += $sub_applied;
      $total_balance += $sub_balance;
      $num_orders += $sub_num_orders;

      // zero out the sub-total variables
      $sub_order_total = 0;
      $sub_applied = 0;
      $sub_balance = 0;
      $sub_num_orders = 0;
    }  // END if ($out_po_check->RecordCount() > 0)

    // then display outstanding checks
    // these orders aren't shipped until we have payment
    $out_check = $db->Execute("SELECT * FROM " . TABLE_ORDERS . "
                               WHERE payment_module_code = 'moneyorder'
                               AND date_completed IS NULL
                               AND date_cancelled IS NULL
                               AND balance_due > 0
                               AND orders_status != 1" .
                               $date_limit . "
                               ORDER BY orders_id ASC");
    if ($out_check->RecordCount() > 0) {
?>
      <tr>
        <td colspan="8" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . TABLE_SUBHEADING_CHECKS . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
      while (!$out_check->EOF) {
        unset($so);
        $so = new super_order($out_check->fields['orders_id']);

        $sub_order_total += $so->order_total;
        $sub_applied += $so->amount_applied;
        $sub_balance += $so->balance_due;
        $sub_num_orders++;
?>
      <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $out_check->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $out_check->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_check->fields['customers_state']; ?></td>
        <td class="dataTableContent" align="center"><?php echo $out_check->fields['date_purchased']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_check->fields['billing_name']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_check->fields['customers_telephone']; ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->order_total); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->amount_applied); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->balance_due); ?></td>
      </tr>
<?php
        $out_check->MoveNext();
      }
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableHeadingContent" align="left"><?php echo $sub_num_orders . TEXT_ORDERS; ?></td>
        <td colspan="4">&nbsp;</td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_order_total); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_applied); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($sub_balance); ?></td>
      </tr>
<?php
      // add to grand totals
      $order_grand_total += $sub_order_total;
      $total_applied += $sub_applied;
      $total_balance += $sub_balance;
      $num_orders += $sub_num_orders;
    }  // END if ($out_check->RecordCount() > 0)
?>
      <tr>
        <td colspan="7" class="dataTableContent" align="center"><strong><?php echo zen_draw_separator() . TABLE_SUBHEADING_TOTAL_PAYMENTS . zen_draw_separator(); ?></strong></td>
      </tr>
<?php
  }  // END elseif ($report_type == 'out_payment')


  elseif ($report_type == 'out_refund') {
    $out_refund = $db->Execute("SELECT * FROM " . TABLE_ORDERS . "
                                WHERE balance_due < 0 " .
                                $date_limit . "
                                ORDER BY orders_id ASC");

    while (!$out_refund->EOF) {
      unset($so);
      $so = new super_order($out_refund->fields['orders_id']);

      $order_grand_total += $so->order_total;
      $total_applied += $so->amount_applied;
      $total_balance += $so->balance_due;
      $num_orders++;
?>
      <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $out_refund->fields['orders_id'] . '&action=edit'); ?>'">
        <td class="dataTableContent" align="left"><?php echo $out_refund->fields['orders_id']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_refund->fields['customers_state']; ?></td>
        <td class="dataTableContent" align="center"><?php echo $out_refund->fields['date_purchased']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_refund->fields['billing_name']; ?></td>
        <td class="dataTableContent" align="left"><?php echo $out_refund->fields['customers_telephone']; ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->order_total); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->amount_applied); ?></td>
        <td class="dataTableContent" align="right"><?php echo $currencies->format($so->balance_due); ?></td>
      </tr>
<?php
      $out_refund->MoveNext();
    }  // END while (!$outstanding->EOF)
  }

  if ($report_type == 'out_payment' || $report_type == 'out_refund') {
?>
      <tr class="dataTableRowUnique" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        <td class="dataTableHeadingContent" align="left"><?php echo $num_orders . TEXT_ORDERS; ?></td>
        <td colspan="4">&nbsp;</td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($order_grand_total); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($total_applied); ?></td>
        <td class="dataTableHeadingContent" align="right"><?php echo $currencies->format($total_balance); ?></td>
      </tr>
<?php
  }  // END if ($report_type == 'out_payment' || $report_type == 'out_refund')
?>
    </table></td>
<?php
  }  // END if ($report_type)
?>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<?php if ($isForDisplay) { ?>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php } ?>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>