<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// |                                                                      |
// |   DevosC, Developing open source Code                                |
// |   Copyright (c) 2004 DevosC.com                                      |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: paypal_admin_notification.php 1113 2005-04-05 02:23:26Z drbyte $
//

// strip slashes in case they were added to handle apostrophes:
  foreach ($ipn->fields as $key=>$value){
    $ipn->fields[$key] = stripslashes($value);
  }

// display all paypal status fields (in admin Orders page):
          $output = '<td><table>'."\n";
          $output .= '<tr style="background-color : #cccccc; border-style : dotted;">'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['first_name']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['last_name']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_business_name']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_name']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_street']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_city']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_state']."\n";
          $output .= '</td></tr>'."\n";
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_country']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_email']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['ebay_address_id']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payer_status']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['address_status']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['txn_type']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['txn_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['parent_txn_id']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payment_type']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['payment_status']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['pending_reason']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['invoice']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= zen_datetime_short($ipn->fields['payment_date'])."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '<td valign="top"><table>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_currency']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_gross']."\n";
          $output .= '</td></tr>'."\n";
          
          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['mc_fee']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['exchange_rate']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '<tr><td class="main">'."\n";
          $output .= MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS."\n";
          $output .= '</td><td class="main">'."\n";
          $output .= $ipn->fields['num_cart_items']."\n";
          $output .= '</td></tr>'."\n";

          $output .= '</table></td>'."\n";

          $output .= '</tr>'."\n";
          $output .='</table></td>'."\n";
?>