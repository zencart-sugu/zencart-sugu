<?php
  if ($orders->RecordCount() > 0) {
    while(!$orders->EOF) {
      $oID = $orders->fields['orders_id'];
      $order = new order($oID);
?>
<!-- body_text //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo nl2br(STORE_NAME_ADDRESS); ?></td>
        <td class="pageHeading" align="right"><?php echo zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT); ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="2"><?php echo zen_draw_separator(); ?></td>
      </tr>

<?php
      $order_check = $db->Execute("select cc_cvv, customers_name, customers_company, customers_street_address,
                                    customers_suburb, customers_city, customers_postcode,
                                    customers_state, customers_country, customers_telephone,
                                    customers_email_address, customers_address_format_id, delivery_name,
                                    delivery_company, delivery_street_address, delivery_suburb,
                                    delivery_city, delivery_postcode, delivery_state, delivery_country,
                                    delivery_address_format_id, billing_name, billing_company,
                                    billing_street_address, billing_suburb, billing_city, billing_postcode,
                                    billing_state, billing_country, billing_address_format_id,
                                    payment_method, cc_type, cc_owner, cc_number, cc_expires, currency,
                                    currency_value, date_purchased, orders_status, last_modified
                             from " . TABLE_ORDERS . "
                             where orders_id = '" . (int)$oID . "'");
  $show_customer = 'false';
  if ($order_check->fields['billing_name'] != $order_check->fields['delivery_name']) {
    $show_customer = 'true';
  }
  if ($order_check->fields['billing_street_address'] != $order_check->fields['delivery_street_address']) {
    $show_customer = 'true';
  }
  if ($show_customer == 'true') {
?>
      <tr>
        <td class="main"><b><?php echo MODULE_ORDERS_EXPORT_ENTRY_CUSTOMER; ?></b></td>
      </tr>
      <tr>
        <td class="main"><?php echo zen_address_format($order->customer['format_id'], $order->customer, 1, '', '<br>'); ?></td>
      </tr>
<?php } ?>
      <tr>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
         <tr>
            <td class="main"><b><?php echo MODULE_ORDERS_EXPORT_ENTRY_SOLD_TO; ?></b></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_address_format($order->customer['format_id'], $order->billing, 1, '', '<br>'); ?></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo $order->customer['telephone']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '">' . $order->customer['email_address'] . '</a>'; ?></td>
          </tr>
        </table></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo MODULE_ORDERS_EXPORT_ENTRY_SHIP_TO; ?></b></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td class="main"><b><?php echo MODULE_ORDERS_EXPORT_ENTRY_ORDER_ID . $oID; ?></b></td>
  </tr>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><strong><?php echo MODULE_ORDERS_EXPORT_ENTRY_DATE_PURCHASED; ?></strong></td>
        <td class="main"><?php echo zen_date_long($order->info['date_purchased']); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo MODULE_ORDERS_EXPORT_ENTRY_PAYMENT_METHOD; ?></b></td>
        <td class="main"><?php echo $order->info['payment_method']; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
        <td class="dataTableHeadingContent" colspan="2"><?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS; ?></td>
        <td class="dataTableHeadingContent"><?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_PRODUCTS_MODEL; ?></td>
      </tr>
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '      <tr class="dataTableRow">' . "\n" .
           '        <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j=0, $k=sizeof($order->products[$i]['attributes']); $j<$k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' .
$order->products[$i]['attributes'][$j]['option'] . ': ' .
nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value']));
          echo '</i></small></nobr>';
        }
      }

      echo '        </td>' . "\n" .
           '        <td class="dataTableContent" valign="top">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '      </tr>' . "\n";
    }
?>
    </table></td>
  </tr>
</table>
<!-- body_text_eof //-->

<br style="page-break-after: always;">
<?php
      $orders->MoveNext();
    }
  }
?>
