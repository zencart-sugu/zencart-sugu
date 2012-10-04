<?php
/*
//////////////////////////////////////////////////////////////////////////
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//////////////////////////////////////////////////////////////////////////
// $Id: common_orders_functions.php v 2010-10-24 $
*/

/////////////////
// Function    : zen_db_scrub_in
// Arguments   : string
// Return      : scrubbed string
// Description : An all-purpose string scrubber to prep data for DB input.
//               Strips whitespace, formats for HTML viewing (tags are untouched), and prevents SQL injections
/////////////////
function zen_db_scrub_in($string, $strip_tags = false) {
  if ( $string == '""' || $string == "''" || strcasecmp($string, 'null') == 0 || strcasecmp($string, 'now()') == 0 ) {
    return $string;
  }
  elseif (is_string($string)) {
    $string = trim(stripslashes($string));
    $string = nl2br($string);
    if ($strip_tags) {
      $string = strip_tags($string);
    }
    $string = mysql_real_escape_string($string);
    return $string;
  }
  elseif (is_array($string)) {
    reset($string);
    while (list($key, $value) = each($string)) {
      if (!is_numeric($value)) $string[$key] = zen_db_scrub_in($value);
    }
    return $string;
  }
  else {
    return $string;
  }
}


/////////////////
// Function    : zen_db_scrub_out
// Arguments   : string
// Return      : unscrubbed string
// Description : used to remove slashes before displaying the string
/////////////////
function zen_db_scrub_out($string, $strip_tags = false) {
  if ($strip_tags) {
    $string = strip_tags($string);
  }
  return stripslashes($string);
}

/////////////////
// Function    : update_status
// Arguments   : oID, new_status, notified(optional), comments(optional)
// Return      : none
// Description : Adds a new status entry to an order
/////////////////
if (TY_TRACKER == 'True') {
// TY TRACKER 1 BEGIN  ----------------------------------------------
function update_status($oID, $new_status, $customer_notified, $comments = '', $track_id1, $track_id2, $track_id3, $track_id4, $track_id5) {
// END TY TRACKER 1 -------------------------------------------------
  global $db;

// TY TRACKER 2 BEGIN  ----------------------------------------------
  $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                (orders_id, orders_status_id, date_added, customer_notified, comments, track_id1, track_id2, track_id3, track_id4, track_id5)
                VALUES ('" . (int)$oID . "',
                '" . $new_status . "',
                now(),
                '" . $customer_notified . "',
                '" . zen_db_input($comments)  . "',
                '" . $track_id1  . "',
                '" . $track_id2  . "',
                '" . $track_id3  . "',
                '" . $track_id4  . "',
                '" . $track_id5 . "')");
// END TY TRACKER 2 -------------------------------------------------

  $db->Execute("UPDATE " . TABLE_ORDERS . " SET
                orders_status = '" . $new_status . "'
                WHERE orders_id = '" . (int)$oID . "'");
}  
} else {
function update_status($oID, $new_status, $customer_notified, $comments = '') {
  global $db;

  $db->Execute("INSERT INTO " . TABLE_ORDERS_STATUS_HISTORY . "
                (orders_id, orders_status_id, date_added, customer_notified, comments)
                VALUES ('" . (int)$oID . "',
                '" . $new_status . "',
                now(),
                '" . $customer_notified . "',
                '" . zen_db_input($comments)  . "')");

  $db->Execute("UPDATE " . TABLE_ORDERS . " SET
                orders_status = '" . $new_status . "'
                WHERE orders_id = '" . (int)$oID . "'");
}  
}
/////////////////
// Function    : email_latest_status
// Arguments   : oID, orders_status_array
// Return      : NONE
// Description : Sends email to customer notifying of the latest status assigned to given order
/////////////////
if (TY_TRACKER == 'True') {
function email_latest_status($oID) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');
  global $db;
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");
  while (!$orders_status->EOF) {
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $customer_info = $db->Execute("SELECT customers_name, customers_email_address, date_purchased
                                 FROM " . TABLE_ORDERS . "
                                 WHERE orders_id = '" . $oID . "'");

// TY TRACKER 3 BEGIN  ----------------------------------------------
  $status_info = $db->Execute("SELECT orders_status_id, comments, track_id1, track_id2, track_id3, track_id4, track_id5
                               FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                               WHERE orders_id = '" . $oID . "'
                               ORDER BY date_added Desc limit 1");
// END TY TRACKER 3 -------------------------------------------------

// TY TRACKER 4 BEGIN  ----------------------------------------------
  $status = $status_info->fields['orders_status_id'];
  $track_id1 = $status_info->fields['track_id1'];
  $track_id2 = $status_info->fields['track_id2'];
  $track_id3 = $status_info->fields['track_id3'];
  $track_id4 = $status_info->fields['track_id4'];
  $track_id5 = $status_info->fields['track_id5'];
  if (zen_not_null($status_info->fields['comments']) && $status_info->fields['comments'] != '' && $_POST['notify_comments'] == 'on') {
    $notify_comments = EMAIL_TEXT_COMMENTS_UPDATE . $status_info->fields['comments'] . "\n\n";
  }
    if (zen_not_null($track_id1)) { $notify_comments .= "\n\n<br /><br />Your " . CARRIER_NAME_1 . " Tracking ID is " . $track_id1 . " \n<br /><a href=" . CARRIER_LINK_1 . $track_id1 . ">Click here</a> to track your package. \n<br />If the above link does not work, copy the following URL address and paste it into your Web browser. \n<br />" . CARRIER_LINK_1 . $track_id1 . "\n\n<br /><br />It may take up to 24 hours for the tracking information to appear on the website." . "\n<br />"; }
    if (zen_not_null($track_id2)) { $notify_comments .= "\n\n<br /><br />Your " . CARRIER_NAME_2 . " Tracking ID is " . $track_id2 . " \n<br /><a href=" . CARRIER_LINK_2 . $track_id2 . ">Click here</a> to track your package. \n<br />If the above link does not work, copy the following URL address and paste it into your Web browser. \n<br />" . CARRIER_LINK_2 . $track_id2 . "\n\n<br /><br />It may take up to 24 hours for the tracking information to appear on the website." . "\n<br />"; }
    if (zen_not_null($track_id3)) { $notify_comments .= "\n\n<br /><br />Your " . CARRIER_NAME_3 . " Tracking ID is " . $track_id3 . " \n<br /><a href=" . CARRIER_LINK_3 . $track_id3 . ">Click here</a> to track your package. \n<br />If the above link does not work, copy the following URL address and paste it into your Web browser. \n<br />" . CARRIER_LINK_3 . $track_id3 . "\n\n<br /><br />It may take up to 24 hours for the tracking information to appear on the website." . "\n<br />"; }
    if (zen_not_null($track_id4)) { $notify_comments .= "\n\n<br /><br />Your " . CARRIER_NAME_4 . " Tracking ID is " . $track_id4 . " \n<br /><a href=" . CARRIER_LINK_4 . $track_id4 . ">Click here</a> to track your package. \n<br />If the above link does not work, copy the following URL address and paste it into your Web browser. \n<br />" . CARRIER_LINK_4 . $track_id4 . "\n\n<br /><br />It may take up to 24 hours for the tracking information to appear on the website." . "\n<br />"; }
    if (zen_not_null($track_id5)) { $notify_comments .= "\n\n<br /><br />Your " . CARRIER_NAME_5 . " Tracking ID is " . $track_id5 . " \n<br /><a href=" . CARRIER_LINK_5 . $track_id5 . ">Click here</a> to track your package. \n<br />If the above link does not work, copy the following URL address and paste it into your Web browser. \n<br />" . CARRIER_LINK_5 . $track_id5 . "\n\n<br /><br />It may take up to 24 hours for the tracking information to appear on the website." . "\n<br />"; }
// END TY TRACKER 4 -------------------------------------------------

  // send email to customer
  $message = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" .
  EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n\n" .
  EMAIL_TEXT_INVOICE_URL . ' ' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n\n" .
  EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']) . "\n\n" .
  strip_tags($notify_comments) .
  EMAIL_TEXT_STATUS_UPDATED . sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ) .
  EMAIL_TEXT_STATUS_PLEASE_REPLY;

  $html_msg['EMAIL_CUSTOMERS_NAME']    = $customer_info->fields['customers_name'];
  $html_msg['EMAIL_TEXT_ORDER_NUMBER'] = EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID;
  $html_msg['EMAIL_TEXT_INVOICE_URL']  = '<a href="' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') .'">'.str_replace(':','',EMAIL_TEXT_INVOICE_URL).'</a>';
  $html_msg['EMAIL_TEXT_DATE_ORDERED'] = EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']);
  $html_msg['EMAIL_TEXT_STATUS_COMMENTS'] = $notify_comments;
  $html_msg['EMAIL_TEXT_STATUS_UPDATED'] = str_replace('\n','', EMAIL_TEXT_STATUS_UPDATED);
  $html_msg['EMAIL_TEXT_STATUS_LABEL'] = str_replace('\n','', sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ));
  $html_msg['EMAIL_TEXT_NEW_STATUS'] = $orders_status_array[$status];
  $html_msg['EMAIL_TEXT_STATUS_PLEASE_REPLY'] = str_replace('\n','', EMAIL_TEXT_STATUS_PLEASE_REPLY);

  zen_mail($customer_info->fields['customers_name'], $customer_info->fields['customers_email_address'], EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status');

  // send extra emails
  if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') {
    zen_mail('', SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO, SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status_extra');
  }

  //_TODO accept an optional array of additional recipients

}
} else {
function email_latest_status($oID) {
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'order_status_email.php');
  global $db;
  $orders_status_array = array();
  $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                 from " . TABLE_ORDERS_STATUS . "
                                 where language_id = '" . (int)$_SESSION['languages_id'] . "'");
  while (!$orders_status->EOF) {
    $orders_status_array[$orders_status->fields['orders_status_id']] = $orders_status->fields['orders_status_name'];
    $orders_status->MoveNext();
  }

  $customer_info = $db->Execute("SELECT customers_name, customers_email_address, date_purchased
                                 FROM " . TABLE_ORDERS . "
                                 WHERE orders_id = '" . $oID . "'");

  $status_info = $db->Execute("SELECT orders_status_id, comments
                               FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                               WHERE orders_id = '" . $oID . "'
                               ORDER BY date_added Desc limit 1");

  $status = $status_info->fields['orders_status_id'];
  if (zen_not_null($status_info->fields['comments']) && $status_info->fields['comments'] != '' && $_POST['notify_comments'] == 'on') {
    $notify_comments = EMAIL_TEXT_COMMENTS_UPDATE . $status_info->fields['comments'] . "\n\n";
  }

  // send email to customer
  $message = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" .
  EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n\n" .
  EMAIL_TEXT_INVOICE_URL . ' ' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n\n" .
  EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']) . "\n\n" .
  strip_tags($notify_comments) .
  EMAIL_TEXT_STATUS_UPDATED . sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ) .
  EMAIL_TEXT_STATUS_PLEASE_REPLY;

  $html_msg['EMAIL_CUSTOMERS_NAME']    = $customer_info->fields['customers_name'];
  $html_msg['EMAIL_TEXT_ORDER_NUMBER'] = EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID;
  $html_msg['EMAIL_TEXT_INVOICE_URL']  = '<a href="' . zen_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') .'">'.str_replace(':','',EMAIL_TEXT_INVOICE_URL).'</a>';
  $html_msg['EMAIL_TEXT_DATE_ORDERED'] = EMAIL_TEXT_DATE_ORDERED . ' ' . zen_date_long($customer_info->fields['date_purchased']);
  $html_msg['EMAIL_TEXT_STATUS_COMMENTS'] = $notify_comments;
  $html_msg['EMAIL_TEXT_STATUS_UPDATED'] = str_replace('\n','', EMAIL_TEXT_STATUS_UPDATED);
  $html_msg['EMAIL_TEXT_STATUS_LABEL'] = str_replace('\n','', sprintf(EMAIL_TEXT_STATUS_LABEL, $orders_status_array[$status] ));
  $html_msg['EMAIL_TEXT_NEW_STATUS'] = $orders_status_array[$status];
  $html_msg['EMAIL_TEXT_STATUS_PLEASE_REPLY'] = str_replace('\n','', EMAIL_TEXT_STATUS_PLEASE_REPLY);

  zen_mail($customer_info->fields['customers_name'], $customer_info->fields['customers_email_address'], EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status');

  // send extra emails
  if (SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_STATUS == '1' and SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO != '') {
    zen_mail('', SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO, SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . ' ' . EMAIL_TEXT_SUBJECT . ' #' . $oID, $message, STORE_NAME, EMAIL_FROM, $html_msg, 'order_status_extra');
  }

  //_TODO accept an optional array of additional recipients

}
}
?>