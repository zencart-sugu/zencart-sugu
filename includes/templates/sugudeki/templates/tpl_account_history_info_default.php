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
?>
<div class="centerColumn" id="accountHistInfo">
<h1 id="accountHistInfoHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">
<h2 class="headline"><?php echo sprintf(HEADING_ORDER_NUMBER, $_GET['order_id']); ?></h2>

<p><?php echo HEADING_ORDER_DATE . ' ' . zen_date_long($order->info['date_purchased']); ?></p>

 <table width="100%" id="cartContentsDisplay" class="border">
    <tr class="tableHeading">
        <th scope="col" id="ccProductsHeading"><?php echo HEADING_PRODUCTS; ?></th>
        <th scope="col" id="ccUnitHeading"><?php echo TABLE_HEADING_PRICE; ?></th>
        <th scope="col" id="ccQuantityHeading"><?php echo HEADING_QUANTITY; ?></th>
<?php
  if (sizeof($order->info['tax_groups']) > 1) {
?>
        <th scope="col" id="myAccountTax"><?php echo HEADING_TAX; ?></th>
<?php
 }
?>
        <th scope="col" id="ccTotalHeading"><?php echo HEADING_TOTAL; ?></th>
    </tr>
<?php
  for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
  ?>
    <tr>
        <td class="cartProductDisplay">
				<?php if (0) { ?>
				<a href="<?php echo zen_href_link(zen_get_info_page($order->products[$i]['id']), 'products_id=' . $order->products[$i]['id']); ?>"><?php echo  $order->products[$i]['name'];?></a>
        <?php } ?>
				<?php echo  $order->products[$i]['name'];?>
<?php 
    if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
      echo '<ul id="orderAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
        echo '<li>' . $order->products[$i]['attributes'][$j]['option'] .
nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])) . '</li>';
      }
        echo '</ul>';
    }
?>
        </td>
        <td class="cartUnitDisplay"><span><?php echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') ?>
				</span><?php echo TEXT_PRICE_TAX; ?></td>
        <td class="cartQuantity"><?php echo  $order->products[$i]['qty']; ?></td>
<?php
    if (sizeof($order->info['tax_groups']) > 1) {
?>
        <td class="cartTotalDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']) . '%' ?></td>
<?php
    }
?>
        <td class="cartTotalDisplay"><span><?php echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') ?>
				</span><?php echo TEXT_PRICE_TAX; ?></td>
    </tr>
<?php
  }
?>

</table>
<div id="orderTotals">
<table>
<?php
  for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
    if ($order->totals[$i]['class'] == 'ot_addpoint')
      continue;
    if ($order->totals[$i]['class'] == 'ot_subpoint')
      continue;
?>

<tr id="<?php echo ($order->totals[$i]['class'] == 'ot_total' ? 'orderTotal-last':'orderTotal') ?>">
<th><?php echo $order->totals[$i]['title'] ?></th>
<td><?php echo $order->totals[$i]['text'] ?></td>
</tr>

<?php
  }
?>
</table>
</div>

<?php
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>

<?php
  if ($order->delivery != false) {
?>
<h2 class="headline"><?php echo HEADING_DELIVERY_ADDRESS; ?></h2>
<address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></address>
<?php
  }
?>

<?php
    if (zen_not_null($order->info['shipping_method'])) {
?>
<h2 class="headline"><?php echo HEADING_SHIPPING_METHOD; ?></h2>
<p class="area"><?php echo $order->info['shipping_method']; ?></p>
<?php } else { // temporary just remove these 4 lines ?>
<div>WARNING: Missing Shipping Information</div>
<?php
    }
?>

<h2 class="headline"><?php echo HEADING_BILLING_ADDRESS; ?></h2>
<address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></address>

<h2 class="headline"><?php echo HEADING_PAYMENT_METHOD; ?></h2>
<p class="area"><?php echo $order->info['payment_method']; ?></p>

<?php
/**
 * Used to loop thru and display order status information
 */
if (sizeof($statusArray)) {
?>

<h2 class="headline"><?php echo HEADING_ORDER_HISTORY; ?></h2>
<table class="border fit">
    <tr class="tableHeading">
        <th scope="col" id="myAccountStatusDate"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
        <th scope="col" id="myAccountStatusComments"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       </tr>
<?php
  foreach ($statusArray as $statuses) {
?>
    <tr>
        <td><?php echo zen_date_short($statuses['date_added']); ?></td>
        <td><?php echo (empty($statuses['comments']) ? '&nbsp;' : $statuses['comments']); ?></td> 
     </tr>
<?php
  }
?>
</table>
<?php } ?>

</div></div>
