<?php
/**
 * Tell a Friend
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3000 2006-02-09 21:11:37Z wilt $
 */

//
if (!$_SESSION['customer_id'] && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$valid_product = false;
if (isset($_GET['products_id'])) {
  $product_info_query = "SELECT pd.products_name
                         FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                         WHERE p.products_status = '1'
                         AND p.products_id = :productsID
                         AND p.products_id = pd.products_id
                         AND pd.language_id = :languageID";

  $product_info_query = $db->bindVars($product_info_query, ':productsID', $_GET['products_id'], 'integer');
  $product_info_query = $db->bindVars($product_info_query, ':languageID', $_SESSION['languages_id'], 'integer');
  $product_info = $db->Execute($product_info_query);

  if ($product_info->RecordCount() > 0) {
    $valid_product = true;
  }
}

if ($valid_product == false) {
  zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
  $error = false;

  $to_email_address = zen_db_prepare_input($_POST['to_email_address']);
  $to_name = zen_db_prepare_input($_POST['to_name']);
  $from_email_address = zen_db_prepare_input($_POST['from_email_address']);
  $from_name = zen_db_prepare_input($_POST['from_name']);
  $message = zen_db_prepare_input($_POST['message']);

  if (empty($from_name)) {
    $error = true;

    $messageStack->add('friend', ERROR_FROM_NAME);
  }

  if (!zen_validate_email($from_email_address)) {
    $error = true;

    $messageStack->add('friend', ERROR_FROM_ADDRESS);
  }

  if (empty($to_name)) {
    $error = true;

    $messageStack->add('friend', ERROR_TO_NAME);
  }

  if (!zen_validate_email($to_email_address)) {
    $error = true;

    $messageStack->add('friend', ERROR_TO_ADDRESS);
  }

  if ($error == false) {
    $email_subject = sprintf(EMAIL_TEXT_SUBJECT, $from_name, STORE_NAME);
    $email_body = sprintf(EMAIL_TEXT_GREET, $to_name);
    $email_body .= sprintf(EMAIL_TEXT_INTRO,$from_name, $product_info->fields['products_name'], STORE_NAME) . "\n\n";
    $html_msg['EMAIL_GREET'] = str_replace('\n','',sprintf(EMAIL_TEXT_GREET, $to_name));
    $html_msg['EMAIL_INTRO'] = sprintf(EMAIL_TEXT_INTRO,$from_name, $product_info->fields['products_name'], STORE_NAME);

    if (zen_not_null($message)) {
      $email_body .= sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $from_name)  . "\n\n";
      $email_body .= strip_tags($message) . "\n\n" . EMAIL_SEPARATOR . "\n\n";
      $html_msg['EMAIL_MESSAGE_HTML'] = sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $from_name).'<br />';
      $html_msg['EMAIL_MESSAGE_HTML'] .= strip_tags($message);
    } else {
      $email_body .= '';
      $html_msg['EMAIL_MESSAGE_HTML'] = '';
    }

    $email_body .= sprintf(EMAIL_TEXT_LINK, zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']), '', false) . "\n\n" .
    sprintf(EMAIL_TEXT_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

    $html_msg['EMAIL_TEXT_HEADER'] = EMAIL_TEXT_HEADER;
    $html_msg['EMAIL_PRODUCT_LINK'] = sprintf(str_replace('\n\n','<br />',EMAIL_TEXT_LINK), '<a href="'.zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']).'">'.$product_info->fields['products_name'].'</a>' , '', false);
    $html_msg['EMAIL_TEXT_SIGNATURE'] = sprintf(str_replace('\n','',EMAIL_TEXT_SIGNATURE), '' );

    // include disclaimer
    $email_body .= "\n\n" . EMAIL_ADVISORY . "\n\n";

    //send the email
    zen_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address, $html_msg, 'tell_a_friend');

    // send additional emails
    if (SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS == '1' and SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO !='') {
      if ($_SESSION['customer_id']) {
        $account_query = "SELECT customers_firstname, customers_lastname, customers_email_address
                          FROM " . TABLE_CUSTOMERS . "
                          WHERE customers_id = :customersID";

        $account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
        $account = $db->Execute($account_query);
      }
      $extra_info=email_collect_extra_info($from_name,$from_email_address, $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'] , $account->fields['customers_email_address'] );

      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
      zen_mail('', SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO, SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT . ' ' . $email_subject,
      $email_body . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'tell_a_friend_extra');
    }

    $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info->fields['products_name'], zen_output_string_protected($to_name)), 'success');

    zen_redirect(zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']));
  }
} elseif ($_SESSION['customer_id']) {
  $account_query = "SELECT customers_firstname, customers_lastname, customers_email_address
                    FROM " . TABLE_CUSTOMERS . "
                    WHERE customers_id = :customersID";

  $account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $account = $db->Execute($account_query);

  $from_name = $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'];
  $from_email_address = $account->fields['customers_email_address'];
}

$breadcrumb->add(NAVBAR_TITLE);
?>