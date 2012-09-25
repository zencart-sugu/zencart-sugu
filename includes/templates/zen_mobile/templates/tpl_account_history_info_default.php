<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_info_default.php 3543 2006-04-29 17:16:39Z drbyte $
 */
echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>

<div class="centerColumn" id="accountHistInfo">
<br>
<div class="forward"><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></div>
<br class="clearBoth" />

<?php 
echo BOX_HEADING_COLORBOX.HEADING_TITLE;
echo "<br>";
echo sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); 
echo "<br>";
echo "<br>";
echo BOX_HEADING_COLORBOX.HEADING_PRODUCTS; 
echo "<br>";
if (sizeof($order->info['tax_groups']) > 1) {
    echo HEADING_TAX; 
}
for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
    echo  $order->products[$i]['name'];
    echo  QUANTITY_SUFFIX .$order->products[$i]['qty'] ; 
    echo "<br>";
    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
        for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
            echo  $order->products[$i]['attributes'][$j]['option'] . TEXT_OPTION_DIVIDER . nl2br($order->products[$i]['attributes'][$j]['value']) ;
        
        }
    }
    if (sizeof($order->info['tax_groups']) > 1) {
        echo zen_display_tax_value($order->products[$i]['tax']) . '%'; 
    }
    
    echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '');
    echo "<br>";
}
?>
<br>
<?php

  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
     echo $order->totals[$i]['title'] ;
     echo $order->totals[$i]['text']; 
     echo "<br>";
  }
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
/**
 * Used to loop thru and display order status information
 */
if (sizeof($statusArray)) {
    echo BOX_HEADING_COLORBOX.HEADING_ORDER_HISTORY;
    echo "<br>";
    foreach ($statusArray as $statuses) {
    echo TABLE_HEADING_STATUS_DATE.":"; 
    echo zen_date_short($statuses['date_added']); 
    echo "<br>";
    echo TABLE_HEADING_STATUS_ORDER_STATUS; 
    echo ":";
    echo $statuses['orders_status_name']; 
    echo "<br>";
    echo TABLE_HEADING_STATUS_COMMENTS; 
    echo ":";
    echo (empty($statuses['comments']) ? '&nbsp;' : $statuses['comments']); 
//    echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); 
    }
} 
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
if ($order->delivery != false) {
    echo BOX_HEADING_COLORBOX.HEADING_DELIVERY_ADDRESS; 
    echo "<br>";
    echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />');
}
if (zen_not_null($order->info['shipping_method'])) {
    echo HEADING_SHIPPING_METHOD; 
    echo $order->info['shipping_method']; 
} else { // temporary just remove these 4 lines 
    
}

echo "<br>";
echo "<br>";
echo BOX_HEADING_COLORBOX.HEADING_BILLING_ADDRESS;
echo "<br>";

echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); 
echo "<br>";
echo "<br>";
echo BOX_HEADING_COLORBOX.HEADING_PAYMENT_METHOD; 
echo "<br>";
echo $order->info['payment_method']; 
?>
