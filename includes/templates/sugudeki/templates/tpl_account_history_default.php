<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_history.<br />
 * Displays all customers previous orders
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_default.php 2580 2005-12-16 07:31:21Z birdbrain $
 */
?>
<div class="centerColumn" id="accountHistoryDefault">

<h1 id="accountHistoryDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">
<?php
  if ($accountHasHistory === true) {
?>
<table class="border fit account" id="account_history">
  <tr class="tableHeading">
    <th scope="col" id="acDateHeading"><?php echo TABLE_HEADING_DATE; ?></th>
    <th scope="col" id="acOrderHeading"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
    <th scope="col" id="acShippedHeading"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
    <th scope="col"><?php echo TEXT_ORDER_STATUS; ?></th>
    <th scope="col" id="acTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
    <th scope="col" id="acViewHeading"><?php echo TABLE_HEADING_VIEW; ?></th>
  </tr>
<?php
    foreach ($accountHistory as $history) {
?>
  <tr>
    <td class="acDateHeading"><?php echo zen_date_short($history['date_purchased']);?></td>
    <td class="acOrderHeading"><?php echo $history['orders_id']; ?></td>
    <td class="acShippedHeading"><?php echo zen_output_string_protected($history['order_name']); ?></td>
    <td><?php echo $history['orders_status_name']; ?></dt>
    <td class="acTotalHeading"><span><?php echo strip_tags($history['order_total']); ?></span><?php echo TEXT_PRICE_TAX ; ?></td>
    <td class="acViewHeading"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_VIEW_SMALL, BUTTON_VIEW_SMALL_ALT,' class="imgover"') . '</a>'; ?></td>
  </tr>
<?php
  }
?>
</table>

<div class="navSplit">
<div class="navSplitLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<div class="navSplitResult"><?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></div>
</div>

<?php
  } else {
?>
<div class="centerColumn" id="noAcctHistoryDefault">
<?php echo TEXT_NO_PURCHASES; ?>
</div>
<?php
  }
?>

</div></div>