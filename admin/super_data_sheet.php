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
//  FILENAME:      super_data_sheet.php                 //
//                                                      //
//  DESCRIPTION:   Takes all the order data found on    //
//  the details screen and formats it for printing on   //
//  standard 8.5" x 11" paper.                          //
//////////////////////////////////////////////////////////
// $Id: super_data_sheet.php 27 2006-02-03 20:06:12Z BlindSide $
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');
  require(DIR_WS_CLASSES . 'super_order.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = (int)$_GET['oID'];
  $order = new order($oID);
  $so = new super_order($oID);

  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");
  while (!$orders_status->EOF) {
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo PAGE_TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/super_stylesheet.css">
<script language="javascript" src="includes/menu.js"></script>
<script language="JavaScript" type="text/javascript">
  <!--
  function closePopup() {
    window.opener.focus();
    self.close();
  }
</script>
</head>
<body onload="print();" marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td><?php echo '<a href="#" onclick="closePopup();">' . zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></td>
          </tr>
        </table></td>
        <td class="pageHeading" align="right" valign="middle"><?php
          echo HEADER_ORDER_DATA . $oID . ':  '.
          zen_date_long($order->info['date_purchased']); ?></td>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator(); ?></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr class="printHeaderRow">
        <td class="printHeaderContent"><?php echo HEADER_ADDRESS_DATA; ?></td>
      </tr>
      <tr>
        <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="printMain" valign="top"><strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?></strong></td>
            <td class="printMain"><?php echo zen_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'); ?></td>
          </tr>
        </table></td>
        <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="printMain" valign="top"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
            <td class="printMain"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'); ?></td>
          </tr>
        </table></td>
        <td valign="top"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="printMain" valign="top"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
            <td class="printMain"><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="printMain"><strong><?php echo ENTRY_TELEPHONE_NUMBER; ?></strong></td>
        <td class="printMain"><?php echo $order->customer['telephone']; ?></td>
      </tr>
      <tr>
        <td class="printMain"><strong><?php echo ENTRY_EMAIL_ADDRESS; ?></strong></td>
        <td class="printMain"><?php echo $order->customer['email_address']; ?></td>
      </tr>
      <tr>
        <td class="printMain"><strong><?php echo TEXT_INFO_IP_ADDRESS; ?></strong></td>
        <?php if ($order->info['ip_address'] != '') { ?>
        <td class="printMain"><?php echo $order->info['ip_address']; ?></td>
        <?php } else { ?>
        <td class="printMain"><?php echo TEXT_NONE; ?></td>
        <?php } ?>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td class="printMain"><strong><?php echo ENTRY_DATE_PURCHASED; ?></strong></td>
        <td class="printMain"><?php echo zen_date_long($order->info['date_purchased']); ?></td>
      </tr>
      <tr>
        <td class="printMain"><strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong></td>
        <td class="printMain"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="printTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
        <td class="printTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
        <td class="printTableHeadingContent" align="center"><?php echo TABLE_HEADING_QUANTITY; ?></td>
        <td class="printTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
        <td class="printTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
        <td class="printTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
      </tr>
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n";
      echo '        <td class="printTableContent" valign="middle" align="left">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          if ($order->products[$i]['attributes'][$j]['product_attribute_is_free'] == '1' and $order->products[$i]['product_is_free'] == '1') echo TEXT_INFO_ATTRIBUTE_FREE;
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td class="printTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '        <td class="printTableContent" align="center" valign="middle">' . $order->products[$i]['qty'] . '</td>' . "\n" .
           '        <td class="printTableContent" align="right" valign="middle">' . zen_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '        <td class="printTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '        <td class="printTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n";
      echo '      </tr>' . "\n";
    }
?>
      <tr>
        <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
    // Short shipping display
    // Formats shipping entry to remove the TEXT_WAY define
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
      if ($order->totals[$i]['class'] == 'ot_shipping') {
        $format_shipping = explode(" (", $order->totals[$i]['title'], 2);
        $clean_shipping = rtrim($format_shipping[0], ":");
        $display_title = $clean_shipping . ':';
      }
      else {
        $display_title = $order->totals[$i]['title'];
      }
      echo '          <tr>' . "\n" .
           '            <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-TextPrint">' . $display_title . '</td>' . "\n" .
           '            <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-AmountPrint">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '          </tr>' . "\n";
    }
?>
          <tr>
            <td align="right" class="ot-tax-TextPrint"><?php echo ENTRY_AMOUNT_APPLIED; ?></td>
            <td align="right" class="printMain"><strong><?php echo $currencies->format($so->amount_applied); ?></strong></td>
          </tr>
          <tr>
            <td align="right" class="ot-tax-TextPrint"><?php echo ENTRY_BALANCE_DUE; ?></td>
            <td align="right" class="printMain"><strong><?php echo $currencies->format($so->balance_due); ?></strong></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr class="printHeaderRow">
    <td class="printHeaderContent"><?php echo HEADER_STATUS_HISTORY; ?></td>
  </tr>
  <tr>
    <td valign="top" class="printMain"><table border="1" cellspacing="0" cellpadding="3">
      <tr>
        <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
        <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></strong></td>
        <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
        <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
      </tr>
<?php
    $orders_history = $db->Execute("select orders_status_id, date_added, customer_notified, comments
                                    from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . zen_db_input($oID) . "'
                                    order by date_added");

    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF) {
        echo '      <tr>' . "\n" .
             '        <td class="smallText" align="center">' . zen_datetime_short($orders_history->fields['date_added']) . '</td>' . "\n" .
             '        <td class="smallText" align="center">';
        if ($orders_history->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
        }
        echo '        <td class="smallText">' . $orders_status_array[$orders_history->fields['orders_status_id']] . '</td>' . "\n";
        echo '        <td class="smallText">' . nl2br(zen_db_scrub_out($orders_history->fields['comments'])) . '&nbsp;</td>' . "\n" .
             '      </tr>' . "\n";
        $orders_history->MoveNext();
      }
    } else {
        echo '      <tr>' . "\n" .
             '        <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '      </tr>' . "\n";
    }
?>
    </table></td>
    <td><?php require(DIR_WS_MODULES . 'orders_download.php'); ?></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
<? /*
  <tr>
    <?php $so->get_admin_notes(); ?>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="printHeaderContent"><strong><?php echo TABLE_HEADING_ADMIN_NOTES . TEXT_WARN_NOT_VISIBLE; ?></strong></td>
      </tr>
      <?php if (!$so->admin_notes) { ?>
      <tr>
        <td class="printMain"><?php echo TEXT_ADMIN_NOTES_NONE; ?></td>
      </tr>
      <?php } else { ?>
      <tr>
        <td><table border="1" cellspacing="0" cellpadding="3">
          <tr>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_RATING; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_AUTHOR; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          </tr>
          <?php for ($i = 0; $i < sizeof($so->admin_notes); $i++) { ?>
          <tr>
            <td class="smallText" align="center"><?php echo zen_datetime_short($so->admin_notes[$i]['date']); ?></td>
            <td class="smallText" align="center"><?php echo $so->admin_notes[$i]['rating']; ?></td>
            <td class="smallText" align="center"><?php echo $so->admin_notes[$i]['name'] . ' (' . $so->admin_notes[$i]['email'] . ')'; ?></td>
            <td class="smallText" align="left"><?php echo zen_db_scrub_out($so->admin_notes[$i]['notes']); ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td colspan="4" class="printMain" align="right"><?php echo TEXT_AVG_RATING . '<strong>' . $so->avg_rating . '</strong>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <?php } ?>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
*/
?>
<?php
      if (!$so->payment && !$so->refund && !$so->purchase_order && !$so->po_payment) {
?>
  <tr>
    <td class="printMain"><strong><?php echo TEXT_NO_PAYMENT_DATA; ?></strong></td>
  </tr>
<?php
      }
      else {
?>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr class="printHeaderRow">
        <td class="printHeaderContent"><?php echo HEADER_PAYMENT_HISTORY; ?></td>
      </tr>
      <tr class="dataTableHeadingRow">
        <td class="printTableHeadingContent" align="left"><?php echo PAYMENT_TABLE_NUMBER; ?></td>
        <td class="printTableHeadingContent" align="left"><?php echo PAYMENT_TABLE_NAME; ?></td>
        <td class="printTableHeadingContent" align="right"><?php echo PAYMENT_TABLE_AMOUNT; ?></td>
        <td class="printTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_TYPE; ?></td>
        <td class="printTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_POSTED; ?></td>
        <td class="printTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_MODIFIED; ?></td>
      </tr>
<?php
        if ($so->payment) {
          for($a = 0; $a < sizeof($so->payment); $a++) {
            if ($a != 0) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
            }
?>
      <tr class="paymentRow">
        <td class="paymentContent" align="left"><?php echo $so->payment[$a]['number']; ?></td>
        <td class="paymentContent" align="left"><?php echo $so->payment[$a]['name']; ?></td>
        <td class="paymentContent" align="right"><strong><?php echo $currencies->format($so->payment[$a]['amount']); ?></strong></td>
        <td class="paymentContent" align="center"><?php echo $so->full_type($so->payment[$a]['type']); ?></td>
        <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->payment[$a]['posted']); ?></td>
        <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->payment[$a]['modified']); ?></td>
      </tr>
<?php
            if ($so->refund) {
              $payment_refunds = $so->find_refunds($so->payment[$a]['index']);
              if (sizeof($payment_refunds) > 0) {
                for($b = 0; $b < sizeof($payment_refunds); $b++) {
?>
      <tr class="refundRow">
        <td class="refundContent" align="left"><?php echo $payment_refunds[$b]['number']; ?></td>
        <td class="refundContent" align="left"><?php echo $payment_refunds[$b]['name']; ?></td>
        <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($payment_refunds[$b]['amount']); ?></strong></td>
        <td class="refundContent" align="center"><?php echo $so->full_type($payment_refunds[$b]['type']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($payment_refunds[$b]['posted']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($payment_refunds[$b]['modified']); ?></td>
      </tr>
<?php
                }  // END for($b = 0; $b < sizeof(payment_refunds); $b++)

              }  // END if (sizeof($payment_refunds) > 0)

            }  // END if ($so->refund)

          }  // END for($a = 0; $a < sizeof($payment); $a++)

        }  // END if ($so->payment)

        if ($so->purchase_order) {
          for($c = 0; $c < sizeof($so->purchase_order); $c++) {
            if ($c < 1 && $so->payment) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td colspan="6"><?php echo zen_black_line(); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
            }
            elseif ($c > 1) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
            }
?>
      <tr class="purchaseOrderRow">
        <td class="purchaseOrderContent" colspan="4" align="left"><strong><?php echo $so->purchase_order[$c]['number']; ?></strong></td>
        <td class="purchaseOrderContent" align="center"><?php echo zen_datetime_short($so->purchase_order[$c]['posted']); ?></td>
        <td class="purchaseOrderContent" align="center"><?php echo zen_datetime_short($so->purchase_order[$c]['modified']); ?></td>
      </tr>
<?php
            if ($so->po_payment) {
              $po_payments = $so->find_po_payments($so->purchase_order[$c]['index']);
              if (sizeof($po_payments) > 0) {

                for($d = 0; $d < sizeof($po_payments); $d++) {
                  if ($d != 0) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
                  }
?>
      <tr class="paymentRow">
        <td class="paymentContent" align="left"><?php echo $po_payments[$d]['number']; ?></td>
        <td class="paymentContent" align="left"><?php echo $po_payments[$d]['name']; ?></td>
        <td class="paymentContent" align="right"><strong><?php echo $currencies->format($po_payments[$d]['amount']); ?></strong></td>
        <td class="paymentContent" align="center"><?php echo $so->full_type($po_payments[$d]['type']); ?></td>
        <td class="paymentContent" align="center"><?php echo zen_datetime_short($po_payments[$d]['posted']); ?></td>
        <td class="paymentContent" align="center"><?php echo zen_datetime_short($po_payments[$d]['modified']); ?></td>
      </tr>
<?php
                  if ($so->refund) {
                    $po_refunds = $so->find_refunds($po_payments[$d]['index']);
                    if (sizeof($po_refunds) > 0) {

                      for($e = 0; $e < sizeof($po_refunds); $e++) {
?>
      <tr class="refundRow">
        <td class="refundContent" align="left"><?php echo $po_refunds[$e]['number']; ?></td>
        <td class="refundContent" align="left"><?php echo $po_refunds[$e]['name']; ?></td>
        <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($po_refunds[$e]['amount']); ?></strong></td>
        <td class="refundContent" align="center"><?php echo $so->full_type($po_refunds[$e]['type']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($po_refunds[$e]['posted']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($po_refunds[$e]['modified']); ?></td>
      </tr>
<?php
                      }  // END for($e = 0; $e < sizeof($po_payment_refunds); $e++)

                    }  // END if (sizeof($po_refunds) > 0)

                  }  // END if ($so->refund)

                }  // END for($d = 0; $d < sizeof($po_payments); $d++)

              }  // END if (sizeof($po_payments) > 0)

            }  // END if ($so->po_payment)

          }  // END for($c = 0; $c < sizeof($so->purchase_order); $c++)

        }  // END if ($so->purchase_order)


        // display any refunds not tied directly to a payment
        if ($so->refund) {
          for ($f = 0; $f < sizeof($so->refund); $f++) {
            if ($so->refund[$f]['payment'] == 0) {
              if ($f < 1) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td colspan="6"><?php echo zen_black_line(); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
              }
              else {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
<?php
              }
?>
      <tr class="refundRow">
        <td class="refundContent" align="left"><?php echo $so->refund[$f]['number']; ?></td>
        <td class="refundContent" align="left"><?php echo $so->refund[$f]['name']; ?></td>
        <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($so->refund[$f]['amount']); ?></strong></td>
        <td class="refundContent" align="center"><?php echo $so->full_type($so->refund[$f]['type']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$f]['posted']); ?></td>
        <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$f]['modified']); ?></td>
      </tr>
<?php
            }
          }
        }  // END if ($so->refund)
?>
    </table></td>
  </tr>
<?php
      }  // END else
?>
</table>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>