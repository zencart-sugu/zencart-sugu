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
//  DESCRIPTION:   Replaces admin/packingslip.php,      //
//  adding the ability to display a split packingslip   //
//  (accessible through the order details page),        //
//  product images, and properly aligned address info.  //
//////////////////////////////////////////////////////////
// $Id: super_packingslip.php 44 2006-08-29 22:25:43Z BlindSide $
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'order.php');
  require(DIR_WS_CLASSES . 'super_order.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  global $db;

  $oID = zen_db_prepare_input($_GET['oID']);
  $orders = $db->Execute("select orders_id
                          from " . TABLE_ORDERS . "
                          where orders_id = '" . (int)$oID . "'");

  $so = new super_order($oID);
  $order = new order($oID);

// SUPER_CODE_START

  $reverse_split = ( ($_GET['reverse_count'] % 2) ? 'odd' : 'even' );
  $_GET['reverse_count']++;

  $split = $_GET['split'];

  // Add product images if there are 3 or less products on order
  if (sizeof($order->products) < 4) {
    $display_images = 1;
  }
  else {
    $display_images = 0;
  }

  // Find any comments entered at checkout and display on invoice if they exist
  $orders_history = $db->Execute("SELECT orders_status_id, date_added, customer_notified, comments
                                  FROM " . TABLE_ORDERS_STATUS_HISTORY . "
                                  WHERE orders_id = '" . $oID . "'
                                  ORDER BY date_added");

  if ($orders_history->fields['comments'] != '') {
    $customer_notes = $orders_history->fields['comments'];
  }
  else {
    $customer_notes = 0;
  }

// SUPER_CODE_END

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/menu.js">
</script>
</head>

<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- body_text //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo nl2br(STORE_NAME_ADDRESS); ?></td>
        <td class="pageHeading" align="right"><a href="<?php echo FILENAME_SUPER_PACKINGSLIP . '?' . zen_get_all_get_params(); ?>"><?php echo zen_image(DIR_WS_IMAGES . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT)?></a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td colspan="4"><?php echo zen_draw_separator(); ?></td>
      </tr>

<?php
      $order_check = $db->Execute("SELECT cc_cvv, customers_name, customers_company, customers_street_address,
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
                                    FROM " . TABLE_ORDERS . "
                                    WHERE orders_id = '" . (int)$oID . "'");
?>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '25', '1'); ?></td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo ENTRY_SHIP_TO; ?></strong></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br />'); ?></td>
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
        <td><?php echo zen_draw_separator('pixel_trans.gif', '175', '1'); ?></td>
        <td valign="top" align="right"><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><strong><?php echo ENTRY_SOLD_TO; ?></strong></td>
          </tr>
          <tr>
            <td class="main"><?php echo zen_address_format($order->customer['format_id'], $order->billing, 1, '', '<br />'); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
<?php
  // Trim shipping details
  for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
    if ($order->totals[$i]['class'] == 'ot_shipping') {
      $format_shipping = explode(" (", $order->totals[$i]['title'], 2);
      $shipping_method = rtrim($format_shipping[0], ":");
      break;
    }
  }
?>
  <tr>
    <td><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><strong><?php echo ENTRY_ORDER_ID . $oID; ?></strong></td>
      </tr>
      <tr>
        <td class="main"><strong><?php echo ENTRY_DATE_PURCHASED; ?></strong></td>
        <td class="main"><?php echo zen_date_long($order->info['date_purchased']); ?></td>
      </tr>
      <tr>
        <td class="main"><strong><?php echo ENTRY_PAYMENT_METHOD; ?></strong></td>
        <td class="main"><?php echo $order->info['payment_method']; ?></td>
      </tr>
      <tr>
        <td class="main"><strong><?php echo ENTRY_SHIPPING_METHOD; ?></strong></td>
        <td class="main"><?php echo $shipping_method; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr class="dataTableHeadingRow">
<?php
//  SUPER_CODE_START
      if ($display_images) { ?>
        <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IMAGE; ?></td>
        <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_QTY; ?></td>
        <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
      <?php } else { ?>
        <td class="dataTableHeadingContent" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
      <?php } ?>
        <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
      </tr>
<?php
      for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
        echo '      <tr class="dataTableRow">' . "\n";

        if ($display_images) {
          if(isset($order->products[$i]['id']) ) {

          $products = $db->Execute("SELECT products_image
                                    FROM " . TABLE_PRODUCTS . "
                                    WHERE products_id ='" . $order->products[$i]['id'] . "'");

          echo '        <td class="dataTableContent" align="left">' . zen_image(DIR_WS_CATALOG . DIR_WS_IMAGES . $products->fields['products_image'] , $order->products[$i]['name'], SMALL_IMAGE_HEIGHT, SMALL_IMAGE_WIDTH) . '</a>&nbsp;</td>';
        }

        echo '        <td class="dataTableContent" valign="middle" align="center">';
} else {
echo '        <td class="dataTableContent" align="left"></td>';
}

        if ($split) {
          if (isset($_GET['incl_product_' . $i])) {
            if ($reverse_split == 'odd') {
              echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS);
            }
            else {
              echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK);
            }
          }
          else {
            if ($reverse_split == 'odd') {
              echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK);
            }
            else {
              echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS);
            }
          }
          echo '&nbsp;';
        }

        echo $order->products[$i]['qty'] . '&nbsp;</td>' . "\n" .
             '        <td class="dataTableContent" valign="middle">' . $order->products[$i]['name'];

        if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
          for ($j=0, $k=sizeof($order->products[$i]['attributes']); $j<$k; $j++) {
            echo '<br /><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
            echo '</i></small></nobr>';
          }
        }

        echo '        </td>' . "\n" .
             '        <td class="dataTableContent" valign="middle">' . $order->products[$i]['model'] . '</td>' . "\n" .
             '      </tr>' . "\n";
      }
?>
    </table></td>
  </tr>
<?php if ($customer_notes) { ?>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
  </tr>
  <tr>
    <td class="main" colspan="2"><strong><?php echo HEADER_CUSTOMER_NOTES; ?></strong></td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo $customer_notes; ?></td>
  </tr>
<?php } ?>
<?php if ($_GET['split']) { ?>
  <tr>
    <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
  </tr>
  <tr>
    <td align="right"><table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="smallText"><?php echo zen_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK); ?></td>
        <td class="smallText"><?php echo ENTRY_PRODUCTS_INCL; ?></td>
      </tr>
      <tr>
        <td class="smallText"><?php echo zen_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS); ?></td>
        <td class="smallText"><?php echo ENTRY_PRODUCTS_EXCL; ?></td>
      </tr>
    </table></td>
  </tr>
<?php } ?>
</table>
<!-- body_text_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
