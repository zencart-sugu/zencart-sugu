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
//  DESCRIPTION:   Replaces admin/orders.php, adding    //
//  new features, navigation options, and an advanced   //
//  payment management system.                          //
//////////////////////////////////////////////////////////
// $Id: super_orders.php 43 2006-08-29 14:05:21Z BlindSide $
*/

//_TODO add admin account id to status history record
//_TODO form verifications on edit & payment popup forms
//_TODO payment_types table interface
//_TODO popup class to build/display help or additional data in new window
//_TODO make following replacements in all SO files...
//                 <br> --> <br />
//                  <b> --> <strong>
//        zen_db_output --> zen_db_scrub_out($x)
//         zen_db_input --> zen_db_scrub_in($x, true/false)
// zen_db_prepare_input --> zen_db_scrub_in($x, true/false)

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $oID = (isset($_GET['oID']) ? (int)$_GET['oID'] : false);
  if ($oID) {
    require_once(DIR_WS_CLASSES . 'super_order.php');
    $so = new super_order($oID);
  }

  if (zen_not_null($action)) {
    switch ($action) {
      case 'mark_completed':
        $so->mark_completed();
        $messageStack->add_session(sprintf(SUCCESS_MARK_COMPLETED, $oID), 'success');
        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, 'action=edit&oID=' . $oID, $request_type));
      break;
      case 'mark_cancelled':
        $so->mark_cancelled();
        $messageStack->add_session(sprintf(WARNING_MARK_CANCELLED, $oID), 'warning');
        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, 'action=edit&oID=' . $oID, $request_type));
      break;
      case 'reopen':
        $so->reopen();
        $messageStack->add_session(sprintf(WARNING_ORDER_REOPEN, $oID), 'warning');
        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, 'action=edit&oID=' . $oID, $request_type));
      break;
      case 'add_note':
        $oID = $_POST['oID'];

        $new_admin_note = array();
        $new_admin_note['customers_id'] = $_POST['cID'];
        $new_admin_note['date_added'] = 'now()';
        $new_admin_note['admin_id'] = $_SESSION['admin_id'];
        $new_admin_note['notes'] = zen_db_scrub_in($_POST['notes']);
        $new_admin_note['karma'] = $_POST['karma'];

        zen_db_perform(TABLE_CUSTOMERS_ADMIN_NOTES, $new_admin_note);

        $messageStack->add_session(SUCCESS_NEW_ADMIN_NOTE, 'success');
        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $oID . '&action=edit', $request_type));
      break;
      case 'edit':
        // reset single download to on
        if ($_GET['download_reset_on'] > 0) {
          // adjust download_maxdays based on current date
          $check_status = $db->Execute("select customers_name, customers_email_address, orders_status,
                                      date_purchased from " . TABLE_ORDERS . "
                                      where orders_id = '" . $_GET['oID'] . "'");
          $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + DOWNLOAD_MAX_DAYS;

          $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . $zc_max_days . "', download_count='" . DOWNLOAD_MAX_COUNT . "' where orders_id='" . $_GET['oID'] . "' and orders_products_download_id='" . $_GET['download_reset_on'] . "'";
          $db->Execute($update_downloads_query);
          unset($_GET['download_reset_on']);

          $messageStack->add_session(SUCCESS_ORDER_UPDATED_DOWNLOAD_ON, 'success');
          zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=edit', $request_type));
        }
        // reset single download to off
        if ($_GET['download_reset_off'] > 0) {
          // adjust download_maxdays based on current date
          $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='0', download_count='0' where orders_id='" . $_GET['oID'] . "' and orders_products_download_id='" . $_GET['download_reset_off'] . "'";
          unset($_GET['download_reset_off']);
          $db->Execute($update_downloads_query);

          $messageStack->add_session(SUCCESS_ORDER_UPDATED_DOWNLOAD_OFF, 'success');
          zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=edit', $request_type));
        }
      break;
      case 'update_order':
        $status = zen_db_scrub_in($_POST['status'], true);
        $comments = $_POST['comments'];
        $comments = stripslashes($comments);
        $comments = trim($comments);
        $comments = mysql_escape_string($comments);
        $comments = htmlspecialchars($comments);

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
            email_latest_status($oID);
          }

          if ($status == DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE) {
            // adjust download_maxdays based on current date
            $zc_max_days = date_diff($check_status->fields['date_purchased'], date('Y-m-d H:i:s', time())) + DOWNLOAD_MAX_DAYS;

            $update_downloads_query = "update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays='" . $zc_max_days . "', download_count='" . DOWNLOAD_MAX_COUNT . "' where orders_id='" . (int)$oID . "'";
            $db->Execute($update_downloads_query);
          }
          $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
        }
        else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=edit', $request_type));
        break;
      case 'deleteconfirm':
        zen_remove_order($oID, $_POST['restock']);
        $so->delete_all_data();

        zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')), $request_type));
      break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $orders = $db->Execute("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . $oID . "'");

    $order_exists = true;
    if ($orders->RecordCount() <= 0) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
      zen_redirect(zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')), $request_type));
    }
  }

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

  require(DIR_WS_CLASSES . 'order.php');
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

  function popupWindow(url, features) {
    window.open(url,'popupWindow',features)
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<?php
// easy admin simplify
if (MODULE_EASY_ADMIN_SIMPLIFY_STATUS == 'true') {
  easy_admin_simplify_start();
}
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
<?php if (empty($action)) {?>
<!-- search -->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr><?php echo zen_draw_form('search', FILENAME_SUPER_ORDERS, '', 'get', '', true); ?>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td colspan="2" class="smallText" align="right">
<?php
  // show search reset
  if ((isset($_GET['search']) && zen_not_null($_GET['search'])) or $_GET['cID'] !='') {
    echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, '', $request_type) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a><br />';
  }
  echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search');
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
  }
?>
            </td>
          </form></tr>
        </table></td>
      </tr>
<!-- search -->
<?php
  }  // END if (empty($action))
  /*
  ** ORDER DETAIL DISPLAY
  */
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order ($oID);

    if ($order->info['payment_module_code']) {
      if (file_exists(DIR_FS_CATALOG_MODULES . 'payment/' . $order->info['payment_module_code'] . '.php')) {
        require(DIR_FS_CATALOG_MODULES . 'payment/' . $order->info['payment_module_code'] . '.php');
        require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $order->info['payment_module_code'] . '.php');
        $module = new $order->info['payment_module_code'];
//        echo $module->admin_notification($oID);
      }
    }
    $get_prev = $db->Execute("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE orders_id < '" . $oID . "' ORDER BY orders_id DESC LIMIT 1");

    if (zen_not_null($get_prev->fields['orders_id'])) {
      $prev_button = '            <INPUT TYPE="BUTTON" VALUE="<<< ' . $get_prev->fields['orders_id'] . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $get_prev->fields['orders_id'] . '&action=edit') . '\'">';
    }
    else {
      $prev_button = '            <INPUT TYPE="BUTTON" VALUE="' . BUTTON_TO_LIST . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS) . '\'">';
    }


    $get_next = $db->Execute("SELECT orders_id FROM " . TABLE_ORDERS . " WHERE orders_id > '" . $oID . "' ORDER BY orders_id ASC LIMIT 1");

    if (zen_not_null($get_next->fields['orders_id'])) {
      $next_button = '            <INPUT TYPE="BUTTON" VALUE="' . $get_next->fields['orders_id'] . ' >>>" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $get_next->fields['orders_id'] . '&action=edit') . '\'">';
    }
    else {
      $next_button = '            <INPUT TYPE="BUTTON" VALUE="' . BUTTON_TO_LIST . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS) . '\'">';
    }
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_ORDER_DETAILS . $oID; ?></td>
            <?php if ($so->status) { ?>
            <td class="main" valign="middle"><?php echo
              '<span class="status-' . $so->status . '">' . zen_datetime_short($so->status_date) . '</span>&nbsp;' .
              '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'action=reopen&oID=' . $oID) . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_x.gif', '', '', '', '') . HEADING_REOPEN_ORDER . '</a>';
            ?></td>
            <?php } ?>
            <td align="center"><table border="0" cellspacing="3" cellpadding="0">
              <tr>
                <td class="main" align="center" valign="bottom"><?php echo $prev_button; ?></td>
                <td class="smallText" align="center" valign="bottom"><?php
                  echo SELECT_ORDER_LIST . '<br />';
                  echo zen_draw_form('input_oid', FILENAME_SUPER_ORDERS, '', 'get', '', true);
                  echo zen_draw_input_field('oID', '', 'size="6"');
                  echo zen_draw_hidden_field('action', 'edit');
                  echo '</form>';
                ?></td>
                <td class="main" align="center" valign="bottom"><?php echo $next_button; ?></td>
              </tr>
            </table></td>
            <td align="right"><?php
              echo '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $oID, $request_type) . '" target="_blank">' . zen_image_button('btn_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;&nbsp;';
              echo '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $oID, $request_type) . '" target="_blank">' . zen_image_button('button_invoice.gif', ICON_ORDER_INVOICE) . '</a>&nbsp;&nbsp;';
              echo '<a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $oID, $request_type) . '" target="_blank">' . zen_image_button('button_packingslip.gif', ICON_ORDER_PACKINGSLIP) . '</a>&nbsp;&nbsp;';
              echo '<a href="javascript:history.back()">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>';
            ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?php echo zen_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top">
                  <strong><?php echo ENTRY_CUSTOMER_ADDRESS; ?></strong><?php
                    if (!$so->status) {
                      echo '<br /><a href="javascript:popupWindow(\'' .
                      zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=contact', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=600,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
                      zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_CONTACT) . ICON_EDIT_CONTACT . '</a>';
                    }
                ?></td>
                <td class="main"><?php echo zen_address_format($order->customer['format_id'], $order->customer, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><strong><?php echo ENTRY_BILLING_ADDRESS; ?></strong></td>
                <td class="main"><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><strong><?php echo ENTRY_SHIPPING_ADDRESS; ?></strong></td>
                <td class="main"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><strong><?php echo ENTRY_TELEPHONE_NUMBER; ?></strong></td>
                <td class="main"><?php echo $order->customer['telephone']; ?></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo ENTRY_EMAIL_ADDRESS; ?></strong></td>
                <td class="main"><?php
                  echo $order->customer['email_address'] . '&nbsp;[<a href="mailto:' . $order->customer['email_address'] . '">' . TEXT_MAILTO . '</a>]&nbsp;[<a href="' . zen_href_link(FILENAME_MAIL, 'origin=super_orders.php&mode=NONSSL&selected_box=customers&customer=' . $order->customer['email_address'], $request_type) . '">' . TEXT_STORE_EMAIL . '</a>]';
                ?></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo TEXT_INFO_IP_ADDRESS; ?></strong></td>
                <?php if ($order->info['ip_address'] != '') { ?>
                <td class="main"><?php echo $order->info['ip_address'] . '&nbsp;[<a target="_blank" href="http://www.dnsstuff.com/tools/whois.ch?ip=' . $order->info['ip_address'] . '">' . TEXT_WHOIS_LOOKUP . '</a>]'; ?></td>
                <?php } else { ?>
                <td class="main"><?php echo TEXT_NONE; ?></td>
                <?php } ?>
              </tr>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo ENTRY_DATE_PURCHASED; ?></strong></td>
                <td class="main"><?php echo zen_datetime_long($order->info['date_purchased']); ?></td>
              </tr>
              <tr>
                <td class="main"><strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong></td>
                <td class="main"><?php echo $order->info['payment_method']; ?></td>
              </tr>
            </table></td>
<?php
    $notes = $db->Execute("select * from " . TABLE_CUSTOMERS_ADMIN_NOTES . " where customers_id = '" . $order->customer['id'] . "'");
    if ($notes->RecordCount() > 0) {
      $num_feedback_good = 0;
      $num_feedback_poor = 0;
      $num_admin_notes = 0;

      while (!$notes->EOF) {
        if ($notes->fields['rating'] > 0) $num_feedback_good++;
        if ($notes->fields['rating'] < 0) $num_feedback_poor++;
        if (zen_not_null($notes->fields['admin_notes'])) $num_admin_notes++;
        $notes->MoveNext();
      }
?>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
              </tr>
            </table></td>
<?php
    } // END if ($notes->RecordCount() > 0)
?>
            <td align="right"><table border="0" cellspacing="0" cellpadding="2">
<?php
    if (zen_not_null($order->info['cc_type']) || zen_not_null($order->info['cc_owner']) || zen_not_null($order->info['cc_number'])) {
?>
              <tr>
                <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
                <td class="main"><?php echo $order->info['cc_type']; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
                <td class="main"><?php echo $order->info['cc_owner']; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
                <td class="main"><?php echo $order->info['cc_number']; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CREDIT_CARD_CVV; ?></td>
                <td class="main"><?php echo $order->info['cc_cvv']; ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
                <td class="main"><?php echo $order->info['cc_expires']; ?></td>
              </tr>
<?php
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
      if (!$so->payment && !$so->refund && !$so->purchase_order && !$so->po_payment) {
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo TEXT_NO_PAYMENT_DATA; ?></strong></td>
            <td class="main"><?php $so->button_add('payment'); $so->button_add('purchase_order'); $so->button_add('refund'); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
      }
      else {
?>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo TEXT_PAYMENT_DATA; ?></strong></td>
            <td align="right" colspan="6"><?php $so->button_add('payment'); $so->button_add('purchase_order'); $so->button_add('refund'); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" align="left"><?php echo PAYMENT_TABLE_NUMBER; ?></td>
            <td class="dataTableHeadingContent" align="left"><?php echo PAYMENT_TABLE_NAME; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo PAYMENT_TABLE_AMOUNT; ?></td>
            <td class="dataTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_TYPE; ?></td>
            <td class="dataTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_POSTED; ?></td>
            <td class="dataTableHeadingContent" align="center"><?php echo PAYMENT_TABLE_MODIFIED; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo PAYMENT_TABLE_ACTION; ?></td>
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
          <tr class="paymentRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" <?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=payment&index=' . $so->payment[$a]['index'] . '&action=update', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')"'; ?>>
            <td class="paymentContent" align="left"><?php echo $so->payment[$a]['number']; ?></td>
            <td class="paymentContent" align="left"><?php echo $so->payment[$a]['name']; ?></td>
            <td class="paymentContent" align="right"><strong><?php echo $currencies->format($so->payment[$a]['amount']); ?></strong></td>
            <td class="paymentContent" align="center"><?php echo $so->full_type($so->payment[$a]['type']); ?></td>
            <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->payment[$a]['posted']); ?></td>
            <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->payment[$a]['modified']); ?></td>
            <td align="right"><?php $so->button_update('payment', $so->payment[$a]['index']); $so->button_delete('payment', $so->payment[$a]['index']);?></td>
          </tr>
<?php
            if ($so->refund) {
              for($b = 0; $b < sizeof($so->refund); $b++) {
                if ($so->refund[$b]['payment'] == $so->payment[$a]['index']) {
?>
          <tr class="refundRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" <?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=refund&index=' . $so->refund[$b]['index'] . '&action=update', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')"'; ?>>
            <td class="refundContent" align="left"><?php echo $so->refund[$b]['number']; ?></td>
            <td class="refundContent" align="left"><?php echo $so->refund[$b]['name']; ?></td>
            <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($so->refund[$b]['amount']); ?></strong></td>
            <td class="refundContent" align="center"><?php echo $so->full_type($so->refund[$b]['type']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$b]['posted']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$b]['modified']); ?></td>
            <td align="right"><?php $so->button_update('refund', $so->refund[$b]['index']); $so->button_delete('refund', $so->refund[$b]['index']); ?></td>
          </tr>
<?php
                }  // END if ($so->refund[$b]['payment'] == $so->payment[$a]['index'])

              }  // END for($b = 0; $b < sizeof($so->refund); $b++)

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
            <td colspan="7"><?php echo zen_black_line(); ?></td>
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
          <tr class="purchaseOrderRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" <?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=purchase_order&index=' . $so->purchase_order[$c]['index'] . '&action=update', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')"'; ?>>
            <td class="purchaseOrderContent" colspan="4" align="left"><strong><?php echo $so->purchase_order[$c]['number']; ?></strong></td>
            <td class="purchaseOrderContent" align="center"><?php echo zen_datetime_short($so->purchase_order[$c]['posted']); ?></td>
            <td class="purchaseOrderContent" align="center"><?php echo zen_datetime_short($so->purchase_order[$c]['modified']); ?></td>
            <td align="right"><?php $so->button_update('purchase_order', $so->purchase_order[$c]['index']); $so->button_delete('purchase_order', $so->purchase_order[$c]['index']);?></td>
          </tr>
<?php
            if ($so->po_payment) {
              for($d = 0; $d < sizeof($so->po_payment); $d++) {
                if ($so->po_payment[$d]['assigned_po'] == $so->purchase_order[$c]['index']) {
                  if ($d != 0) {
?>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
<?php
                  }
?>
          <tr class="paymentRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" <?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=payment&index=' . $so->po_payment[$d]['index'] . '&action=update', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')"'; ?>>
            <td class="paymentContent" align="left"><?php echo $so->po_payment[$d]['number']; ?></td>
            <td class="paymentContent" align="left"><?php echo $so->po_payment[$d]['name']; ?></td>
            <td class="paymentContent" align="right"><strong><?php echo $currencies->format($so->po_payment[$d]['amount']); ?></strong></td>
            <td class="paymentContent" align="center"><?php echo $so->full_type($so->po_payment[$d]['type']); ?></td>
            <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->po_payment[$d]['posted']); ?></td>
            <td class="paymentContent" align="center"><?php echo zen_datetime_short($so->po_payment[$d]['modified']); ?></td>
            <td align="right"><?php $so->button_update('payment', $so->po_payment[$d]['index']); $so->button_delete('payment', $so->po_payment[$d]['index']); ?></td>
          </tr>
<?php
                  if ($so->refund) {
                    for($e = 0; $e < sizeof($so->refund); $e++) {
                      if ($so->refund[$e]['payment'] == $so->po_payment[$d]['index']) {
?>
          <tr class="refundRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" <?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=refund&index=' . $so->refund[$e]['index'] . '&action=update', $request_type) . '\')"'; ?>>
            <td class="refundContent" align="left"><?php echo $so->refund[$e]['number']; ?></td>
            <td class="refundContent" align="left"><?php echo $so->refund[$e]['name']; ?></td>
            <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($so->refund[$e]['amount']); ?></strong></td>
            <td class="refundContent" align="center"><?php echo $so->full_type($so->refund[$e]['type']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$e]['posted']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$e]['modified']); ?></td>
            <td align="right"><?php $so->button_update('refund', $so->refund[$e]['index']); $so->button_delete('refund', $so->refund[$e]['index']); ?></td>
          </tr>
<?php
                      }  // END if ($so->refund[$e]['payment'] == $so->po_payment[$d]['index'])

                    }  // END for($e = 0; $e < sizeof($so->refund); $e++)

                  }  // END if ($so->refund)

                }  // END if ($so->po_payment[$d]['assigned_po'] == $so->purchase_order[$c]['index'])

              }  // END for($d = 0; $d < sizeof($so->po_payment); $d++)

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
            <td colspan="7"><?php echo zen_black_line(); ?></td>
          </tr>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
<?php
              } else {
?>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
<?php
              }
?>
          <tr class="refundRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)"<?php echo 'onclick="popupWindow(\'' . zen_href_link(FILENAME_SUPER_PAYMENTS, 'oID=' . $so->oID . '&payment_mode=refund&index=' . $so->refund[$f]['index'] . '&action=update', $request_type) . '\', \'scrollbars=yes,resizable=yes,width=400,height=300,screenX=150,screenY=100,top=100,left=150\')"'; ?>>
            <td class="refundContent" align="left"><?php echo $so->refund[$f]['number']; ?></td>
            <td class="refundContent" align="left"><?php echo $so->refund[$f]['name']; ?></td>
            <td class="refundContent" align="right"><strong><?php echo '-' . $currencies->format($so->refund[$f]['amount']); ?></strong></td>
            <td class="refundContent" align="center"><?php echo $so->full_type($so->refund[$f]['type']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$f]['posted']); ?></td>
            <td class="refundContent" align="center"><?php echo zen_datetime_short($so->refund[$f]['modified']); ?></td>
            <td align="right"><?php $so->button_update('refund', $so->refund[$f]['index']); $so->button_delete('refund', $so->refund[$f]['index']); ?></td>
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
      if ($so->payment || $so->refund || $so->purchase_order || $so->po_payment) {
?>
      </tr>
        <td><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" align="center"><?php echo HEADING_COLOR_KEY; ?></td>
            <td><table border="0" cellspacing="2" cellpadding="3">
              <tr class="purchaseOrderRow">
                <td class="dataTableContent" width="90" align="center"><?php echo TEXT_PURCHASE_ORDERS; ?></td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="2" cellpadding="3">
              <tr class="paymentRow">
                <td class="dataTableContent" width="90" align="center"><?php echo TEXT_PAYMENTS; ?></td>
              </tr>
            </table></td>
            <td><table border="0" cellspacing="2" cellpadding="3">
              <tr class="refundRow">
                <td class="dataTableContent" width="90" align="center"><?php echo TEXT_REFUNDS; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
      }

    if (method_exists($module, 'admin_notification')) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <?php echo $module->admin_notification($oID); ?>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
}
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <?php if (!$so->status) { ?>
      <tr>
        <td class="main"><?php echo '<a href="javascript:popupWindow(\'' .
          zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=product', $request_type) . '\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=650,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
          zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_PRODUCT) . ICON_EDIT_PRODUCT . '</a>';
        ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <?php if (sizeof($order->products) > 1) { ?>
            <td class="dataTableHeadingContent">&nbsp;</td>
            <?php } ?>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
          </tr>
<?php
    if (sizeof($order->products) > 1) {
      echo '          ' . zen_draw_form('split_packing', FILENAME_SUPER_PACKINGSLIP, '', 'get', 'target="_blank"', true) . "\n";
      echo '          ' . zen_draw_hidden_field('oID', (int)$oID) . "\n";
      echo '          ' . zen_draw_hidden_field('split', 'true') . "\n";
      echo '          ' . zen_draw_hidden_field('reverse_count', 0) . "\n";
    }
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '          <tr class="dataTableRow">' . "\n";
      if (sizeof($order->products) > 1) {
        echo '            <td class="dataTableContent" valign="top" width="10">' . zen_draw_checkbox_field('incl_product_' . $i, 'yes') . '</td>' . "\n";
      }
      echo '            <td class="dataTableContent" valign="middle" align="left">' . $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          if ($order->products[$i]['attributes'][$j]['product_attribute_is_free'] == '1' and $order->products[$i]['product_is_free'] == '1') echo TEXT_INFO_ATTRIBUTE_FREE;
          echo '</i></small></nobr>';
        }
      }

      echo '            </td>' . "\n" .
           '            <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle">' . zen_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format($order->products[$i]['onetime_charges'], true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="middle"><strong>' .
                          $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) .
                          ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') .
                        '</strong></td>' . "\n";
      echo '          </tr>' . "\n";
    }
?>
          <tr>
            <?php if (sizeof($order->products) > 1) { ?>
            <td valign="top" colspan="2"><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">&nbsp;&nbsp;<?php echo zen_image(DIR_WS_IMAGES . 'arrow_south_east.gif'); ?></td>
                <td valign="bottom" class="main"><input type="submit" value="<?php echo BUTTON_SPLIT; ?>"></td>
              </tr>
              <tr>
                <td class="smallText">&nbsp;</td>
                <td class="smallText" valign="top" align="center"><?php echo TEXT_DISPLAY_ONLY; ?></td>
              </tr>
            </table></td>
            </form>
<?php
             $colspan = 7;
           } else {
             $colspan = 8;
           }
?>
            <td align="right" colspan="<?php echo $colspan; ?>"><table border="0" cellspacing="0" cellpadding="2">
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
      echo '              <tr>' . "\n" .
           '                <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-Text">' . $display_title . '</td>' . "\n" .
           '                <td align="right" class="'. str_replace('_', '-', $order->totals[$i]['class']) . '-Amount">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '              </tr>' . "\n";
    }

    // determine what to display on the "Amount Applied" and "Balance Due" lines
    $amount_applied = $currencies->format($so->amount_applied);
    $balance_due = $currencies->format($so->balance_due);

    // determine display format of the number
    // 'balanceDueRem' = customer still owes money
    // 'balanceDueNeg' = customer is due a refund
    // 'balanceDueNone' = order is all paid up
    // 'balanceDueNull' = balance nullified by order status
    switch ($so->status) {
      case 'completed':
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;

      case 'cancelled':
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;

      default:
        switch ($so->balance_due) {
          case 0:
            $class = 'balanceDueNone';
          break;
          case $so->balance_due < 0:
            $class = 'balanceDueNeg';
          break;
          case $so->balance_due > 0:
            $class = 'balanceDueRem';
          break;
        }
      break;
    }
?>
              <tr>
                <td align="right" class="ot-tax-Text"><?php echo ENTRY_AMOUNT_APPLIED; ?></td>
                <td align="right" class="ot-tax-Amount"><?php echo $amount_applied; ?></td>
              </tr>
              <tr>
                <td align="right" class="ot-tax-Text"><?php echo ENTRY_BALANCE_DUE; ?></td>
                <td align="right" <?php echo 'class="' . $class . '">' . $balance_due; ?></td>
              </tr>
              <?php if (!$so->status) { ?>
              <tr>
                <td colspan="2" align="right"><?php echo '<a href="javascript:popupWindow(\'' .
                   zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=total', $request_type) . '\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=650,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
                   zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_TOTAL) . ICON_EDIT_TOTAL . '</a>';
                ?></td>
              </tr>
              <?php } ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><strong><?php echo TABLE_HEADING_STATUS_HISTORY; ?></strong></td>
      </tr>
      <tr>
        <td valign="top" class="main"><table border="1" cellspacing="0" cellpadding="5">
          <tr>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_STATUS; ?></strong></td>
            <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
          </tr>
<?php
    $orders_history = $db->Execute("select orders_status_id, date_added, customer_notified, comments
                                    from " . TABLE_ORDERS_STATUS_HISTORY . "
                                    where orders_id = '" . $oID . "'
                                    order by date_added");

    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF) {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" align="center">' . zen_datetime_short($orders_history->fields['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history->fields['customer_notified'] == '1') {
          echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
        } else {
          echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history->fields['orders_status_id']] . '</td>' . "\n";
        echo '            <td class="smallText">' . nl2br(zen_db_scrub_out($orders_history->fields['comments'])) . '&nbsp;</td>' . "\n" .
             '          </tr>' . "\n";
        $orders_history->MoveNext();
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <?php if (!$so->status) { ?>
      <tr>
        <td><?php echo '<a href="javascript:popupWindow(\'' .
                   zen_href_link(FILENAME_SUPER_EDIT, 'oID=' . $oID . '&target=history', $request_type) . '\', \'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=650,height=450,screenX=150,screenY=100,top=100,left=150\')">' .
                   zen_image(DIR_WS_IMAGES . 'icon_edit3.gif', ICON_EDIT_HISTORY) . ICON_EDIT_HISTORY . '</a>';
        ?></td>
      </tr>
      <?php } ?>
<?php
    // hide status-updating code and cancel/complete buttons
    // if the order is already closed
    if (!$so->status) {
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>
          <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="main"><strong><?php echo TABLE_HEADING_ADD_COMMENTS; ?></strong></td>
            </tr>
            <tr>
              <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
            </tr>
            <tr><?php echo zen_draw_form('status', FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('action')) . 'action=update_order', 'post', '', true); ?>
              <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td class="main"><?php echo zen_draw_textarea_field('comments', 'soft', '70', '4'); ?></td>
                  <td class="main" valign="center"><strong><?php
                    echo zen_draw_checkbox_field('notify', '', true); echo '&nbsp;' . ENTRY_NOTIFY_CUSTOMER . '<br />';
                    echo zen_draw_checkbox_field('notify_comments', '', true); echo '&nbsp;' . ENTRY_NOTIFY_COMMENTS;
                  ?></strong></td>
                </tr>
                <tr>
                  <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <tr>
                  <td class="main"><strong><?php echo ENTRY_STATUS; ?></strong> <?php echo zen_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
                  <td valign="top" align="right">&nbsp;<?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
                </tr>
              </table></td>
            </form></tr>
          </table></td>
          <td align="right" valign="bottom"><table border="1" bgcolor="FFFF99" rules="none" frame="box" cellspacing="2" cellpadding="2">
            <tr>
              <td class="invoiceHeading" align="center"><strong><?php echo TABLE_HEADING_FINAL_STATUS; ?></strong></td>
            </tr>
            <tr>
              <td align="center"><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'action=mark_completed&oID=' . $oID) . '">' . zen_image_button('btn_completed.gif', ICON_MARK_COMPLETED) . '</a>'; ?></td>
            </tr>
            <tr>
              <td align="center"><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'action=mark_cancelled&oID=' . $oID) . '">' . zen_image_button('btn_cancelled.gif', ICON_MARK_CANCELLED) . '</a>'; ?></td>
            </tr>
          </table></td>
<?php } ?>
        </tr></table></td>
      </tr>
<?php
/*
//_TODO move this to its own file after building customer class

      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator(); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <?php $admin_notes = get_admin_notes($order->customer['id']); ?>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo TABLE_HEADING_ADMIN_NOTES . '<span class="alert">' . TEXT_WARN_NOT_VISIBLE . '</span>'; ?></strong></td>
          </tr>
          <?php if ($admin_notes) { ?>
          <tr>
            <td><table border="1" cellspacing="0" cellpadding="5">
              <tr>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_DATE_ADDED; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_KARMA; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_AUTHOR; ?></strong></td>
                <td class="smallText" align="center"><strong><?php echo TABLE_HEADING_COMMENTS; ?></strong></td>
              </tr>
<?php
    for ($i = 0; $i < sizeof($admin_notes); $i++) {
      $total_karma += $admin_notes[$i]['karma'];
?>
              <tr>
                <td class="smallText" align="center"><?php echo zen_datetime_short($admin_notes[$i]['date']); ?></td>
                <td class="smallText" align="center"><?php echo $admin_notes[$i]['karma']; ?></td>
                <td class="smallText" align="center"><?php echo $admin_notes[$i]['name'] . ' (' . $admin_notes[$i]['email'] . ')'; ?></td>
                <td class="smallText" align="left"><?php echo zen_db_scrub_out($admin_notes[$i]['notes']); ?></td>
              </tr>
<?php
    }
?>
              <tr>
                <td class="main" colspan="4"><?php echo TEXT_TOTAL_KARMA . $total_karma; ?></td>
              </tr>
            </table></td>
          </tr>
          <?php } else { ?>
          <tr>
            <td class="main"><?php echo TEXT_ADMIN_NOTES_NONE; ?></td>
          </tr>
          <?php } ?>
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
          </tr>
          <tr>
          <?php echo zen_draw_form('status', FILENAME_SUPER_ORDERS, 'oID=' . $oID . '&action=add_note', 'post', '', true); ?>
          <?php echo zen_draw_hidden_field('cID', $order->customer['id']); ?>
          <?php echo zen_draw_hidden_field('oID', $oID); ?>
            <td><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main"><strong><?php echo TABLE_HEADING_ADD_NOTES; ?></strong></td>
                <td class="main" align="center"><strong><?php echo TABLE_HEADING_KARMA; ?></strong></td>
              </tr>
              <tr>
                <td><?php echo zen_draw_textarea_field('notes', 'soft', '60', '5'); ?></td>
                <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td class="main" valign="left"><strong><?php echo zen_draw_radio_field('karma', '-1') . 'Poor'; ?></strong></td>
                    <td class="main" valign="center"><strong><?php echo zen_draw_radio_field('karma', '0') . 'Neutral'; ?></strong></td>
                    <td class="main" valign="right"><strong><?php echo zen_draw_radio_field('karma', '1') . 'Good'; ?></strong></td>
                  </tr>
                  <tr>
                    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '25'); ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" align="center" valign="bottom"><?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
                  </tr>
                </table></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
*/
// check if order has open gv
        $gv_check = $db->Execute("select order_id, unique_id
                                  from " . TABLE_COUPON_GV_QUEUE ."
                                  where order_id = '" . $_GET['oID'] . "' and release_flag='N' limit 1");
        if ($gv_check->RecordCount() > 0) {
          $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE, 'order=' . $_GET['oID']) . '">' . zen_image_button('button_gift_queue.gif',IMAGE_GIFT_QUEUE) . '</a>';
          echo '      <tr><td align="right"><table width="225"><tr>';
          echo '        <td align="center">';
          echo $goto_gv . '&nbsp;&nbsp;';
          echo '        </td>';
          echo '      </tr></table></td></tr>';
        }
?>
<?php
  }

  /*
  ** ORDER LISTING DISPLAY
  */
  else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_ORDERS_LISTING . '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_STATUS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_STATUS, '') . '\'">' .
              '&nbsp;&nbsp;' .
              '<INPUT TYPE="BUTTON" VALUE="' . BOX_CUSTOMERS_SUPER_BATCH_FORMS . '" ONCLICK="window.location.href=\'' . zen_href_link(FILENAME_SUPER_BATCH_FORMS, '') . '\'">';
            ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr><?php echo zen_draw_form('orders', FILENAME_SUPER_ORDERS, '', 'get', '', true); ?>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . zen_draw_input_field('oID', '', 'size="12"') . zen_draw_hidden_field('action', 'edit'); ?></td>
              </form></tr>
              <tr><?php echo zen_draw_form('status', FILENAME_SUPER_ORDERS, '', 'get', '', true); ?>
                <td class="smallText" align="right"><?php
                  echo HEADING_TITLE_STATUS . ' ' . zen_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), $_GET['status'], 'onChange="this.form.submit();"');
                ?></td>
              </form></tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
<?php
// Sort Listing
          switch ($_GET['list_order']) {
              case "id-asc":
              $disp_order = "c.customers_id";
              break;
              case "firstname":
              $disp_order = "c.customers_firstname";
              break;
              case "firstname-desc":
              $disp_order = "c.customers_firstname DESC";
              break;
              case "lastname":
              $disp_order = "c.customers_lastname, c.customers_firstname";
              break;
              case "lastname-desc":
              $disp_order = "c.customers_lastname DESC, c.customers_firstname";
              break;
              case "company":
              $disp_order = "a.entry_company";
              break;
              case "company-desc":
              $disp_order = "a.entry_company DESC";
              break;
              default:
              $disp_order = "c.customers_id DESC";
          }
?>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_ORDERS_ID; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>

<?php
// create search filter
  $search = '';
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    $search = " and (o.customers_city like '%" . $keywords . "%' or o.customers_postcode like '%" . $keywords . "%' or o.date_purchased like '%" . $keywords . "%' or o.billing_name like '%" . $keywords . "%' or o.billing_company like '%" . $keywords . "%' or o.billing_street_address like '%" . $keywords . "%' or o.delivery_city like '%" . $keywords . "%' or o.delivery_postcode like '%" . $keywords . "%' or o.delivery_name like '%" . $keywords . "%' or o.delivery_company like '%" . $keywords . "%' or o.delivery_street_address like '%" . $keywords . "%' or o.billing_city like '%" . $keywords . "%' or o.billing_postcode like '%" . $keywords . "%' or o.customers_email_address like '%" . $keywords . "%' or o.customers_name like '%" . $keywords . "%' or o.customers_company like '%" . $keywords . "%' or o.customers_street_address  like '%" . $keywords . "%' or o.customers_telephone like '%" . $keywords . "%' or o.ip_address  like '%" . $keywords . "%')";
  }
  $new_fields = ", o.customers_street_address, o.delivery_name, o.delivery_street_address, o.billing_name, o.billing_street_address, o.payment_module_code, o.shipping_module_code, o.ip_address ";
  if (isset($_GET['cID'])) {
    $cID = zen_db_prepare_input($_GET['cID']);
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.customers_id, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total' order by orders_id DESC";
  } elseif ($_GET['status'] != '') {
    $status = zen_db_prepare_input($_GET['status']);
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total'  " . $search . " order by o.orders_id DESC";
  } else {
    $orders_query_raw = "select o.orders_id, o.customers_id, o.customers_name, o.payment_method, o.shipping_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, ot.text as order_total" . $new_fields . " from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$_SESSION['languages_id'] . "' and ot.class = 'ot_total'  " . $search . " order by o.orders_id DESC";
  }
  $orders_query_numrows = '';
  $orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $orders_query_raw, $orders_query_numrows);
  $orders = $db->Execute($orders_query_raw);
  while (!$orders->EOF) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders->fields['orders_id']))) && !isset($oInfo)) {
      $oInfo = new objectInfo($orders->fields);
    }

    // format shipping method to remove ()
    $clean_shipping = explode(" (", $oInfo->shipping_method, 2);
    $clean_shipping = rtrim($clean_shipping[0], ":");
    $shipping_method = $clean_shipping;

    if (isset($oInfo) && is_object($oInfo) && ($orders->fields['orders_id'] == $oInfo->orders_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', $request_type) . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders->fields['orders_id'], $request_type) . '\'">' . "\n";
    }
    //_TODO add new warning to diff between =! name and =! address
    $show_difference = '';
    if (($orders->fields['delivery_name'] != $orders->fields['billing_name'] and $orders->fields['delivery_name'] != '')) {
      $show_difference = '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
    }
    if (($orders->fields['delivery_street_address'] != $orders->fields['billing_street_address'] and $orders->fields['delivery_street_address'] != '')) {
      $show_difference = '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
    }
    //$show_payment_type = $orders->fields['payment_module_code'] . '<br />' . $orders->fields['shipping_module_code'];
    //<td class="dataTableContent" align="left" width="50"><?php echo $show_payment_type; </td>

    $close_status = so_close_status($orders->fields['orders_id']);
    if ($close_status) $class = "status-" . $close_status['type'];
    else $class = "dataTableContent";
?>
                <td class="<?php echo $class; ?>" align="left"><?php echo $orders->fields['orders_id'] . $show_difference; ?></td>
                <td class="dataTableContent"><?php
                  echo '<a href="' . zen_href_link(FILENAME_CUSTOMERS, 'cID=' . $orders->fields['customers_id'] . '&action=edit', $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_cust_info.gif', MINI_ICON_INFO) . '</a>&nbsp;';
                  echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'cID=' . $orders->fields['customers_id'], $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_cust_orders.gif', MINI_ICON_ORDERS) . '</a>&nbsp;';
                  echo '<a href="' . zen_href_link(FILENAME_MAIL, 'origin=super_orders.php&mode=NONSSL&selected_box=tools&customer=' . $orders->fields['customers_email_address'] . '&cID=' . (int)$cID, $request_type) . '">' . $orders->fields['customers_name'] . '</a>';
                ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders->fields['order_total']); ?></td>
                <td class="dataTableContent" align="center"><?php echo zen_datetime_short($orders->fields['date_purchased']); ?></td>
                <td class="dataTableContent" align="left"><?php echo $orders->fields['payment_method']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $orders->fields['orders_status_name']; ?></td>

                <td class="dataTableContent" align="right"><?php
                  if (isset($oInfo) && is_object($oInfo) && ($orders->fields['orders_id'] == $oInfo->orders_id)) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                  } else {
                    //echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID')) . 'oID=' . $orders->fields['orders_id'], $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $orders->fields['orders_id']) . '" target="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $orders->fields['orders_id'] . '&action=edit', $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS) . '</a>&nbsp';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_invoice.gif', ICON_ORDER_INVOICE) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_packingslip.gif', ICON_ORDER_PACKINGSLIP) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_SHIPPING_LABEL, 'oID=' . $orders->fields['orders_id']) . '" TARGET="_blank">' . zen_image(DIR_WS_IMAGES . 'icon_shipping_label.gif', ICON_ORDER_SHIPPING_LABEL) . '</a>&nbsp;';
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, 'oID=' . $orders->fields['orders_id'] . '&action=delete', $request_type) . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete2.gif', ICON_ORDER_DELETE) . '</a>';
                  }
                ?>&nbsp;</td>
              </tr>
<?php
      $orders->MoveNext();
    }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS_ORDERS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], zen_get_all_get_params(array('page', 'oID', 'action'))); ?></td>
                  </tr>
<?php
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
?>
                  <tr>
                    <td class="smallText" align="right" colspan="2">
                      <?php
                        echo '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, '', $request_type) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>';
                        if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
                          $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
                          echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
                        }
                      ?>
                    </td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_DELETE_ORDER . $oInfo->orders_id . '</strong>');

      $contents = array('form' => zen_draw_form('orders', FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=deleteconfirm', 'post', '', true));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br /><br /><strong>' . ENTRY_ORDER_ID . $oInfo->orders_id . '<br />' . $oInfo->order_total . '<br />' . $oInfo->customers_name . '</strong>');
      $contents[] = array('text' => '<br />' . zen_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id, $request_type) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<strong>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . zen_datetime_short($oInfo->date_purchased) . '</strong>');
//        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', $request_type) . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', $request_type) . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
//        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . zen_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', $request_type) . '">' . zen_image_button('button_details.gif', IMAGE_EDIT) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_SUPER_SHIPPING_LABEL, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_shippinglabel.gif', IMAGE_SHIPPING_LABEL) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . zen_href_link(FILENAME_SUPER_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . zen_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_DATA_SHEET, 'oID=' . $oInfo->orders_id) . '" target="_blank">' . zen_image_button('btn_print.gif', ICON_ORDER_PRINT) . '</a>&nbsp;<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=delete', $request_type) . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_DATE_ORDER_CREATED . ' ' . zen_date_short($oInfo->date_purchased));
        if (zen_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . zen_date_short($oInfo->last_modified));
        $contents[] = array('text' => '<br />' . TEXT_INFO_PAYMENT_METHOD . ' '  . $oInfo->payment_method);
        $contents[] = array('text' => TEXT_INFO_SHIPPING_METHOD . ' '  . $shipping_method);
        $contents[] = array('text' => TEXT_INFO_IP_ADDRESS . ' ' . $oInfo->ip_address);

// check if order has open gv
        $gv_check = $db->Execute("select order_id, unique_id
                                  from " . TABLE_COUPON_GV_QUEUE ."
                                  where order_id = '" . $oInfo->orders_id . "' and release_flag='N' limit 1");
        if ($gv_check->RecordCount() > 0) {
          $goto_gv = '<a href="' . zen_href_link(FILENAME_GV_QUEUE, 'order=' . $oInfo->orders_id) . '">' . zen_image_button('button_gift_queue.gif',IMAGE_GIFT_QUEUE) . '</a>';
          $contents[] = array('text' => '<br />' . zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3'));
          $contents[] = array('align' => 'center', 'text' => $goto_gv);
        }
      }

// indicate if comments exist
      $orders_history_query = $db->Execute("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . $oInfo->orders_id . "' and comments !='" . "'" );
      if ($orders_history_query->number_of_rows > 0) {
        $contents[] = array('align' => 'left', 'text' => '<br />' . TABLE_HEADING_COMMENTS);
      }

      $contents[] = array('text' => '<br />' . zen_image(DIR_WS_IMAGES . 'pixel_black.gif','','100%','3'));
      $order = new order($oInfo->orders_id);
      $contents[] = array('text' => 'Products Ordered: ' . sizeof($order->products) );
      for ($i=0; $i<sizeof($order->products); $i++) {
        $contents[] = array('text' => $order->products[$i]['qty'] . '&nbsp;x&nbsp;' . $order->products[$i]['name']);

        if (sizeof($order->products[$i]['attributes']) > 0) {
          for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) {
            $contents[] = array('text' => '&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'] . '</i></nobr>' );
          }
        }
        if ($i > MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING and MAX_DISPLAY_RESULTS_ORDERS_DETAILS_LISTING != 0) {
          $contents[] = array('align' => 'left', 'text' => TEXT_MORE);
          break;
        }
      }

      if (sizeof($order->products) > 0) {
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_ORDERS, zen_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&action=edit', $request_type) . '">' . zen_image_button('button_details.gif', IMAGE_EDIT) . '</a>');
      }
      break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
?>
            <td width="25%" valign="top"><table border="0" cellspacing="0" cellpadding="0" width="100%" valign="top">
              <tr>
                <td colspan="2" valign="top">
<?php
    $box = new box;
    echo $box->infoBox($heading, $contents);
?>
                </td>
              </tr>
              <!-- SHORTCUT ICON LEGEND BOF-->
              <tr>
                <td><table border="0" cellspacing="0" cellpadding="2" width="100%" valign="top">
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="smallText" colspan="2"><strong><?php echo TEXT_ICON_LEGEND; ?></strong><br />&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10); ?></td>
                    <td class="smallText"><?php echo TEXT_BILLING_SHIPPING_MISMATCH; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_cust_info.gif', MINI_ICON_INFO); ?></td>
                    <td class="smallText"><?php echo MINI_ICON_INFO; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_cust_orders.gif', MINI_ICON_ORDERS); ?></td>
                    <td class="smallText"><?php echo MINI_ICON_ORDERS; ?></td>
                  </tr>
                  <tr>
                    <td colspan="2"><?php echo zen_draw_separator('pixel_black.gif'); ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_print.gif', ICON_ORDER_PRINT); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_PRINT; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_details.gif', ICON_ORDER_DETAILS); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_DETAILS; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_invoice.gif', ICON_ORDER_INVOICE); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_INVOICE; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_packingslip.gif', ICON_ORDER_PACKINGSLIP); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_PACKINGSLIP; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_shipping_label.gif', ICON_ORDER_SHIPPING_LABEL); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_SHIPPING_LABEL; ?></td>
                  </tr>
                  <tr>
                    <td align="center"><?php echo zen_image(DIR_WS_IMAGES . 'icon_delete2.gif', ICON_ORDER_DELETE); ?></td>
                    <td class="smallText"><?php echo ICON_ORDER_DELETE; ?></td>
                  </tr>
                </table></td>
              </tr>
              <!-- SHORTCUT ICON LEGEND EOF -->
            </table></td>
<?php
  }  // END if ( (zen_not_null($heading)) && (zen_not_null($contents)) )
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<?php
// easy admin simplify
if (MODULE_EASY_ADMIN_SIMPLIFY_STATUS == 'true') {
  easy_admin_simplify_end();
}
?>

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
<dmin/super_orders.php/html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
