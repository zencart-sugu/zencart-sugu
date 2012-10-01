<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 3105 2006-03-04 18:24:20Z wilt $
 */
?>

<div class="centerColumn" id="accountDefault">
  
<h1 id="accountDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?> 

<?php
    if (zen_count_customer_orders() > 0) {
  ?>
<h2 class="headline"><?php echo OVERVIEW_PREVIOUS_ORDERS; ?></h2>
<table class="border fit account" id="account_history_abs">
    <tr class="tableHeading">
    <th scope="col" id="acDateHeading"><?php echo TABLE_HEADING_DATE; ?></th>
    <th scope="col" id="acOrderHeading"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
    <th scope="col" id="acShippedHeading"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
    <th scope="col"><?php echo TABLE_HEADING_STATUS; ?></th>
    <th scope="col" id="acTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
    <th scope="col" id="acViewHeading"><?php echo TABLE_HEADING_VIEW; ?></th>
  </tr>
<?php
  foreach($ordersArray as $orders) {
?>
  <tr>
    <td class="acDateHeading"><?php echo zen_date_short($orders['date_purchased']); ?></td>
    <td class="acOrderHeading"><?php echo $orders['orders_id']; ?></td>
    <td class="acShippedHeading"><?php echo zen_output_string_protected($orders['order_name']); ?></td>
    <td><?php echo $orders['orders_status_name']; ?></td>
    <td class="acTotalHeading"><span><?php echo $orders['order_total']; ?></span><?php echo TEXT_PRICE_TAX ; ?></td>
    <td class="acViewHeading"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '"> ' . zen_image_button(BUTTON_IMAGE_VIEW_SMALL, BUTTON_VIEW_SMALL_ALT,' class="imgover"') . '</a>'; ?></td>
  </tr>
<?php
  }
?>
</table>
<p><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . OVERVIEW_SHOW_ALL_ORDERS . '</a>'; ?></p>

<?php
  }
?>

<h2 class="headline"><?php echo MY_ACCOUNT_TITLE; ?></h2>
<ul id="myAccountGen" class="list">
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></li>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></li>
<li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></li>
</ul>

</div></div>