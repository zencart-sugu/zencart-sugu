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
//  DESCRIPTION:   Manages the payment types for the    //
//  Super Orders payment system.  Similar in form to    //
//  the order status management page.                   //
//////////////////////////////////////////////////////////
// $Id: super_payment_types.php 35 2006-07-24 13:31:27Z BlindSide $
*/
/*
LOGIC HOLES
- code stored on payment/refund -> must always match payment_types table across languages
- If payment code changes in payment_types, change must also be applied to `refunds` and `payments`
- language_id can only affect full payment name, should I even use it?
- Why use a code at all? Should payment code be replaced by static int?
*/

  require('includes/application_top.php');

  $action = ( (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '');

  if (zen_not_null($action)) {
    if (isset($_GET['payment_type_id'])) $payment_type_id = (int)$_GET['payment_type_id'];
    if (isset($_GET['payment_type_code'])) $payment_type_code = $_GET['payment_type_code'];

    switch ($action) {
      case 'insert':
      case 'save':
        $languages = zen_get_languages();
        $payment_type_full_array = $_POST['payment_type_full'];
        $payment_type_code_array = $_POST['payment_type_code'];

        for ($i = 0; $i < sizeof($languages); $i++) {
          $language_id = (int)$languages[$i]['id'];
          $payment_type_code = zen_db_scrub_in($payment_type_code_array[$language_id], true);
          $payment_type_full = zen_db_scrub_in($payment_type_full_array[$language_id], true);

          if ($action == 'insert') {
            $sql_array = array('payment_type_full' => $payment_type_full,
                               'payment_type_code' => $payment_type_code,
                               'language_id' => $language_id);

            zen_db_perform(TABLE_SO_PAYMENT_TYPES, $sql_array);
            $messageStack->add(sprintf(SUCCESS_PAYMENT_TYPE_INSERTED, $sql_array['payment_type_full'], $sql_array['payment_type_code']), 'success');
          }

          elseif ($action == 'save') {
            // get the original payment_type texts
            $pt_data = $db->Execute("select * from " . TABLE_SO_PAYMENT_TYPES . " where payment_type_id = '" . $payment_type_id . "'");

            if ($pt_data->fields['payment_type_full'] != $payment_type_full) {
              $sql_array['payment_type_full'] = $payment_type_full;
            }
            if ($pt_data->fields['payment_type_code'] != $payment_type_code) {
              $sql_array['payment_type_code'] = $payment_type_code;
            }

            // don't need this
            //$sql_array['language_id'] = $language_id;

            zen_db_perform(TABLE_SO_PAYMENT_TYPES, $sql_array, 'update', "payment_type_id = '" . $payment_type_id . "'");

            // make changes to the payment & refund tables so that the new payment code matches up
            $db->Execute("update " . TABLE_SO_PAYMENTS . "
                          set payment_type = '" . $payment_type_code . "'
                          where payment_type like '" . $pt_data->fields['payment_type_code'] . "'");

            $messageStack->add(sprintf(SUCCESS_PAYMENT_TYPE_SAVED, $sql_array['payment_type_full'], $sql_array['payment_type_code']), 'success');
          }
        }

        zen_redirect(zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment_type_id));
      break;
      case 'delete':
        $remove_status = true;
        $used_count = 0;

        // check to see if the payment_type is in use on any payments or refunds
        $attached_payments = $db->Execute("select * from " . TABLE_SO_PAYMENTS . "
                                           where payment_type LIKE '" . $payment_type_code . "'");
        $attached_refunds = $db->Execute("select * from " . TABLE_SO_REFUNDS . "
                                          where refund_type LIKE '" . $payment_type_code . "'");
        if ($attached_payments->RecordCount() > 0  || $attached_refunds->RecordCount() > 0) {
          $remove_status = false;
          $used_count += $attached_payments->RecordCount();
          $used_count += $attached_refunds->RecordCount();
        }
      break;
      case 'deleteconfirm':
        $db->Execute("delete from " . TABLE_SO_PAYMENT_TYPES . "
                      where payment_type_id = '" . $payment_type_id . "'");

        $messageStack->add(SUCCESS_PAYMENT_TYPE_REMOVED, 'success');
        zen_redirect(zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page']));
      break;
    }
  }  // end if (zen_not_null($action))
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
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
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <?php if (isset($sql)) { ?>
      <!-- DEBUGGING CODE -->
      <tr><td><?php echo $sql; ?></td></tr>
      <!-- END DEBUGGING CODE -->
      <?php } ?>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PAYMENT_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PAYMENT_CODE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?></td>
              </tr>
<?php
  $payment_type_query = "select * from " . TABLE_SO_PAYMENT_TYPES . "
                         where language_id = '" . (int)$_SESSION['languages_id'] . "'
                         order by payment_type_full";

  $payment_type_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $payment_type_query, $payment_type_query_numrows);
  $payment_types = $db->Execute($payment_type_query);
  while (!$payment_types->EOF) {
    if (
         (!isset($_GET['payment_type_id']) ||
           (isset($_GET['payment_type_id']) &&
             ($_GET['payment_type_id'] == $payment_types->fields['payment_type_id'])
           )
         )
         && !isset($payment)
       ) {
      $payment = new objectInfo($payment_types->fields);
    }

    if (isset($payment) && is_object($payment) && ($payment_types->fields['payment_type_id'] == $payment->payment_type_id)) {
      echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id . '&action=edit') . '\'">' . "\n";
    }
    else {
      echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment_types->fields['payment_type_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $payment_types->fields['payment_type_full']; ?></td>
                <td class="dataTableContent"><?php echo $payment_types->fields['payment_type_code']; ?></td>
                <td class="dataTableContent" align="right"><?php
                  if (isset($payment) && is_object($payment) && ($payment_types->fields['payment_type_code'] == $payment->payment_type_code)) {
                    echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
                  }
                  else {
                    echo '<a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment_types->fields['payment_type_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
                  }
                ?>&nbsp;</td>
              </tr>
<?php
    $payment_types->MoveNext();
  }
?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $payment_type_split->display_count($payment_type_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PAYMENT_TYPES); ?></td>
                    <td class="smallText" align="right"><?php echo $payment_type_split->display_links($payment_type_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php if (empty($action)) { ?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php } ?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<strong>' . BOX_HEADING_NEW_PAYMENT_TYPE . '</strong>');

      $contents = array('form' => zen_draw_form('status', FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&action=insert'));
      $contents[] = array('text' => BOX_NEW_INTRO);

      $payment_type_input_string = '';
      $languages = zen_get_languages();
      for ($i = 0; $i < sizeof($languages); $i++) {
        $payment_type_input_string .= "\n" .
         '<br /><table border="0" width="100%" cellspacing="0" cellpadding="2">
             <tr>
               <td valign="bottom">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '</td>
               <td>' . BOX_PAYMENT_TYPE_FULL . '<br />' . zen_draw_input_field('payment_type_full[' . $languages[$i]['id'] . ']') . '</td>
               <td>' . BOX_PAYMENT_TYPE_CODE . '<br />' . zen_draw_input_field('payment_type_code[' . $languages[$i]['id'] . ']') . '</td>
             </tr>
          </table>';
      }
      $contents[] = array('text' => $payment_type_input_string);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_insert.gif', IMAGE_INSERT) . ' <a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    case 'edit':
      $heading[] = array('text' => '<strong>' . BOX_HEADING_EDIT_PAYMENT_TYPE . '</strong>');

      $contents = array('form' => zen_draw_form('status', FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id  . '&action=save'));
      $contents[] = array('text' => BOX_EDIT_INTRO);

      $payment_type_input_string = '';
      $languages = zen_get_languages();
      for ($i = 0; $i < sizeof($languages); $i++) {
        $payment_type_input_string .= "\n" .
         '<br /><table border="0" width="100%" cellspacing="0" cellpadding="2">
             <tr>
               <td valign="bottom">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '</td>
               <td>' . BOX_PAYMENT_TYPE_FULL . '<br />' . zen_draw_input_field('payment_type_full[' . $languages[$i]['id'] . ']', $payment->payment_type_full, 'maxlength="20"') . '</td>
               <td>' . BOX_PAYMENT_TYPE_CODE . '<br />' . zen_draw_input_field('payment_type_code[' . $languages[$i]['id'] . ']', $payment->payment_type_code, 'size="4" maxlength="4"') . '</td>
             </tr>
          </table>';
      }
      $contents[] = array('text' => $payment_type_input_string);
      $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    case 'delete':
      $heading[] = array('text' => '<strong>' . BOX_HEADING_DELETE_PAYMENT_TYPE . '</strong>');
      $contents[] = array('text' => '<br /><strong>' . $payment->payment_type_full . ' [' . $payment->payment_type_code . ']</strong>');

      if ($remove_status) {
      $contents = array('form' => zen_draw_form('status', FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id  . '&action=deleteconfirm'));
      $contents[] = array('text' => BOX_DELETE_INTRO);      
        $contents[] = array('align' => 'center', 'text' => '<br />' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_code=' . $payment->payment_type_code) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      }
      elseif (!$remove_status) {
        $contents[] = array('align' => 'left', 'text' => '<br /><span class="alert">' . TEXT_CANT_DELETE . '</span>');
        $contents[] = array('align' => 'left', 'text' => sprintf(BOX_TEXT_CANT_DELETE_INFO, $used_count) );
      }
    break;
    default:
      if (isset($payment) && is_object($payment)) {
        $heading[] = array('text' => '<strong>' . $payment->payment_type_full . ' [' . $payment->payment_type_code . ']</strong>');

        // show some stats: number of uses per payment/refund, number of orders, total value of payments/refunds using this type

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_SUPER_PAYMENT_TYPES, 'page=' . $_GET['page'] . '&payment_type_id=' . $payment->payment_type_id . '&payment_type_code=' . $payment->payment_type_code . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
      }
    break;
  }

  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>