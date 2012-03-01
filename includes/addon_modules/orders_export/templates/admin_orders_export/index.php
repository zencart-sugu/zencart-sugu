        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <?php echo zen_draw_form('orders_export', FILENAME_ADDON_MODULES_ADMIN, '', 'get', 'id="orders_export"'); ?>
          <?php echo zen_draw_hidden_field('module', 'orders_export/orders_export'); ?>
          <?php echo zen_hide_session_id(); ?>
          <?php echo zen_draw_hidden_field('odr', $odr); ?>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" align="left">
                  <?php echo TEXT_LEGEND . ' ' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10) . ' ' . MODULE_ORDERS_EXPORT_TEXT_BILLING_SHIPPING_MISMATCH; ?>
                </td>
              </tr>
              <tr>
                <td>
                  <label for="allmatch_orders-top"><?php echo zen_draw_checkbox_field('all', '1', false, '', 'id="allmatch_orders-top" onClick="checkAllMatchOrders(this, this.form);"'); ?>
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_ALLMATCH_ORDERS; ?> </label>
                </td>
                <td class="smallText" align="right"><?php
  if (isset($search) && zen_not_null($search)) {
    echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/orders_export', 'SSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>' . "&nbsp;";
  }
?>
                  <?php echo zen_image_submit('button_search.gif', IMAGE_SEARCH); ?>
                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top">
            <table id="orders-list" border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_EXPORT; ?>
                </td>
                <td class="dataTableHeadingContent" align="center">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDERS_ID; ?>
                  <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('page', 'oID', 'allcheck', 'exp', 'action', 'x', 'y', 'dl', 'dl_x', 'dl_y', 'odr')) . 'odr=id', 'SSL'); ?>"><?php echo ($odr == 'id' ? '<span class="SortOrderHeader">' . MODULE_ORDERS_EXPORT_TEXT_ASC . '</span>' : '<span class="SortOrderHeaderLink">' . MODULE_ORDERS_EXPORT_TEXT_ASC . '</b>'); ?></a>
                  <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('page', 'oID', 'allcheck', 'exp', 'action', 'x', 'y', 'dl', 'dl_x', 'dl_y', 'odr')) . 'odr=id-d', 'SSL'); ?>"><?php echo ($odr == 'id-d' ? '<span class="SortOrderHeader">' . MODULE_ORDERS_EXPORT_TEXT_DESC . '</span>' : '<span class="SortOrderHeaderLink">' . MODULE_ORDERS_EXPORT_TEXT_DESC . '</span>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="left" width="50">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_SHIPPING_METHOD; ?> <br>
                </td>
                <td class="dataTableHeadingContent" align="left" width="50">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_PAYMENT_METHOD; ?> <br>
                </td>
                <td class="dataTableHeadingContent">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_CUSTOMERS; ?> <br>
                </td>
                <td class="dataTableHeadingContent">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_COMPANY; ?> <br>
                </td>
                <td class="dataTableHeadingContent" align="right"><?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td class="dataTableHeadingContent" align="center">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_DATE_PURCHASED; ?>
                  <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('page', 'oID', 'allcheck', 'exp', 'action', 'x', 'y', 'dl', 'dl_x', 'dl_y', 'odr')) . 'odr=dp', 'SSL'); ?>"><?php echo ($odr == 'dp' ? '<span class="SortOrderHeader">' . MODULE_ORDERS_EXPORT_TEXT_ASC . '</span>' : '<span class="SortOrderHeaderLink">' . MODULE_ORDERS_EXPORT_TEXT_ASC . '</b>'); ?></a>
                  <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('page', 'oID', 'allcheck', 'exp', 'action', 'x', 'y', 'dl', 'dl_x', 'dl_y', 'odr')) . 'odr=dp-d', 'SSL'); ?>"><?php echo ($odr == 'dp-d' ? '<span class="SortOrderHeader">' . MODULE_ORDERS_EXPORT_TEXT_DESC . '</span>' : '<span class="SortOrderHeaderLink">' . MODULE_ORDERS_EXPORT_TEXT_DESC . '</span>'); ?></a>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo MODULE_ORDERS_EXPORT_TABLE_HEADING_STATUS; ?></td>
              </tr>
              <tr class="dataTableHeadingRow" valign="top">
                <td class="dataTableHeadingContent" align="left">
                  <label for="orders_export-allcheck-top"><?php echo zen_draw_checkbox_field('allcheck', '1', false, '', 'id="orders_export-allcheck-top" onClick="changeAllCheckBox(this, this.form);"'); ?>
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_ALL; ?></label>
                </td>
                <td class="dataTableHeadingContent" align="center">
                  <?php echo zen_draw_input_field('oID', $oID, 'size="11" style="text-align: right;" id="orders-id"'); ?>
                </td>
                <td class="dataTableHeadingContent" align="left" width="50">
                  <?php echo zen_draw_pull_down_menu('sm', $shipping_method_options, $sm, 'onChange="this.form.submit();"'); ?>
                </td>
                <td class="dataTableHeadingContent" align="left" width="50">
                  <?php echo zen_draw_pull_down_menu('pm', $payment_method_options, $pm, 'onChange="this.form.submit();"'); ?>
                </td>
                <td class="dataTableHeadingContent">
                  <?php echo zen_draw_input_field('ctm', $ctm); ?>
                </td>
                <td class="dataTableHeadingContent">
                  <?php echo zen_draw_input_field('com', $com); ?>
                </td>
                <td class="dataTableHeadingContent" align="right">

                </td>
                <td class="dataTableHeadingContent" align="center">
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_FROM; ?> <script language="javascript">dateFrom.writeControl(); dateFrom.dateFormat="yyyy-MM-dd";</script> <br>
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_TO; ?> <script language="javascript">dateTo.writeControl(); dateTo.dateFormat="yyyy-MM-dd";</script>
                </td>
                <td class="dataTableHeadingContent" align="left">
                  <?php echo zen_draw_pull_down_menu('sts', $orders_status_options, $sts, 'onChange="this.form.submit();"'); ?>
                </td>
              </tr>
<?php
  while (!$orders->EOF) {
    $show_difference = '';
    if (($orders->fields['delivery_name'] != $orders->fields['billing_name'] and $orders->fields['delivery_name'] != '')) {
      $show_difference = zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10) . '&nbsp;';
    }
    if (($orders->fields['delivery_street_address'] != $orders->fields['billing_street_address'] and $orders->fields['delivery_street_address'] != '')) {
      $show_difference = zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10) . '&nbsp;';
    }

    $row_class_name = 'dataTableRow';
    if ($exp[$orders->fields['orders_id']]) {
      $row_class_name = 'dataTableRowSelected';
    }
?>
              <tr id="<?php echo 'data-row-' . $orders->fields['orders_id']; ?>" class="<?php echo $row_class_name; ?>" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="toggleCheckBox('orders_export-<?php echo $orders->fields['orders_id']; ?>', 'data-row-<?php echo $orders->fields['orders_id'] ?>');">
                <td class="dataTableContent" align="left">
                  <?php echo zen_draw_checkbox_field('exp_' . $orders->fields['orders_id'], '1', $exp[$orders->fields['orders_id']], '', 'id="orders_export-' . $orders->fields['orders_id'] . '" onclick="checkBoxClick(this, \'data-row-' . $orders->fields['orders_id'] . '\');"'); ?>
                </td>
                <td class="dataTableContent" align="right">
                  <?php echo '<a href="' . zen_href_link(FILENAME_ORDERS, 'oID=' . $orders->fields['orders_id'], 'SSL') . '">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW . ' ' . MODULE_ORDERS_EXPORT_TABLE_HEADING_ORDERS) . '</a>&nbsp;'; ?>
                  <?php echo $show_difference . $orders->fields['orders_id']; ?>
                </td>
                <td class="dataTableContent" align="left" width="50"><?php echo $orders->fields['shipping_module_code']; ?></td>
                <td class="dataTableContent" align="left" width="50"><?php echo $orders->fields['payment_module_code']; ?></td>
                <td class="dataTableContent">
                  <?php echo '<a href="' . zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $orders->fields['customers_id'], 'SSL') . '">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW . ' ' . MODULE_ORDERS_EXPORT_TABLE_HEADING_CUSTOMERS) . '</a>&nbsp;'; ?>
                  <?php echo $orders->fields['customers_name']; ?>
                </td>
                <td class="dataTableContent">
                  <?php echo ($orders->fields['customers_company'] != '' ? $orders->fields['customers_company'] : ''); ?>
                </td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders->fields['order_total']); ?></td>
                <td class="dataTableContent" align="center">
                  <?php echo zen_datetime_short($orders->fields['date_purchased']); ?>
                </td>
                <td class="dataTableContent" align="left">
                  <?php echo $orders->fields['orders_status_name']; ?>
                </td>
              </tr>
<?php
    $orders->MoveNext();
  }
?>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left" valign="bottom">
                  <label for="orders_export-allcheck-bottom"><?php echo zen_draw_checkbox_field('allcheck', '1', false, '', 'id="orders_export-allcheck-bottom" onClick="changeAllCheckBox(this, this.form);"'); ?>
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_ALL; ?></label>
                </td>
                <td class="dataTableHeadingContent" colspan="8" align="center" valign="bottom">
                  &nbsp;
                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
                  <label for="allmatch_orders-bottom"><?php echo zen_draw_checkbox_field('all', '1', false, '', 'id="allmatch_orders-bottom" onClick="checkAllMatchOrders(this, this.form);"'); ?>
                  <?php echo MODULE_ORDERS_EXPORT_TEXT_ALLMATCH_ORDERS; ?> </label>
                </td>
                <td align="right" valign="top"><table>
                  <tr>
                    <td align="left" colspan="3">
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_FORMAT; ?>
                      <?php echo zen_draw_pull_down_menu('fmt', $format_options, $fmt); ?>&nbsp;
                      <label for="save-file"><?php echo zen_draw_checkbox_field('sf', '1', $sf, '', 'id="save-file"'); ?>
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_SAVE_FILE; ?></label>&nbsp;
                    </td>
                  </tr>
                  <tr>
                    <td align="left">
                      <label for="view-header"><?php echo zen_draw_checkbox_field('vh', '1', $vh, '', 'id="view-header"'); ?>
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_VIEW_HEADER; ?></label>&nbsp;<br>
                      <label for="view-rawdata"><?php echo zen_draw_checkbox_field('vr', '1', $vr, '', 'id="view-rawdata"'); ?>
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_VIEW_RAWDATA; ?></label>&nbsp;
                    </td>
                    <td align="left">
                      <label for="print-invoice"><?php echo zen_draw_checkbox_field('inv', '1', $inv, '', 'id="print-invoice"'); ?>
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_PRINT_INVOICE; ?></label>&nbsp;<br>
                      <label for="print-packingslip"><?php echo zen_draw_checkbox_field('pks', '1', $pks, '', 'id="print-packingslip"'); ?>
                      <?php echo MODULE_ORDERS_EXPORT_TEXT_PRINT_PAKINGSLIP; ?></label>&nbsp;
                    </td>
                    <td align="right">
                      <?php echo zen_image_submit('button_download_now.gif', IMAGE_DOWNLOAD, 'name="dl"'); ?>&nbsp;
                    </td>
                  </tr>
                 </table></td>
              </tr>
             </table></td>
          </tr></form>
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'oID', 'allcheck', 'exp', 'action', 'x', 'y', 'dl', 'dl_x', 'dl_y'))); ?></td>
                  </tr>
<?php
  if (isset($search) && zen_not_null($search)) {
?>
                  <tr>
                    <td class="smallText" align="right" colspan="2">
                      <?php echo '<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=orders_export/orders_export', 'SSL') . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?>
                    </td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
<?php
  if ($iframe_rawdata_url != '' || ($iframe_export_url != '' && $sf)) {
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo MODULE_ORDERS_EXPORT_TEXT_RAWDATA; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"> </td>
          </tr>
        </table></td>
      </tr>
<?php
  if ($iframe_export_url != '' && $sf) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <iframe src="<?php echo $iframe_export_url; ?>" name="iframeExportOrders" height="50px" width="100%"></iframe>
            </td>
          </tr>
        </table></td>
      </tr>
<?php
    }
?>
<?php
  if ($iframe_rawdata_url != '') {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td>
              <iframe src="<?php echo $iframe_rawdata_url; ?>" name="iframeRawData" height="300px" width="100%"></iframe>
            </td>
          </tr>
        </table></td>
      </tr>
<?php
    }
?>
    </table></td>
  </tr>
</table>
<?php
  }
?>
<?php
  if ($iframe_export_url != '' && !$sf) {
?>
<iframe src="<?php echo $iframe_export_url; ?>" name="iframeExportOrders" height="0" width="0" style="visibility: hidden;"></iframe>
<?php
  }
?>
<?php
  if ($iframe_invoice_url != '') {
?>
<iframe src="<?php echo $iframe_invoice_url; ?>" name="iframePrintInvoices" height="0" width="0" onload="window.iframePrintInvoices.print();" style="visibility: hidden;"></iframe>
<?php
  }
?>
<?php
  if ($iframe_packingslip_url != '') {
?>
<iframe src="<?php echo $iframe_packingslip_url; ?>" name="iframePrintPackingslips" height="0" width="0" onload="window.iframePrintPackingslips.print();" style="visibility: hidden;"></iframe>
<?php
  }
?>
