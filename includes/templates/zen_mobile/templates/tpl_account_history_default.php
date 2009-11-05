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
echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>
<div class="centerColumn" id="accountHistoryDefault">

<?php
echo BOX_HEADING_COLORBOX.HEADING_TITLE; 
echo "<br>";
?>
<hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
  if ($accountHasHistory === true) {
    foreach ($accountHistory as $history) {


        echo TEXT_ORDER_NUMBER . $history['orders_id'];?>
            <div class="notice forward"><?php echo TEXT_ORDER_STATUS . $history['orders_status_name']; ?></div>

            <div class="content back">
  <?php echo TEXT_ORDER_DATE . zen_date_long($history['date_purchased']) . '<br />' . $history['order_type'].zen_output_string_protected($history['order_name']); ?>
            </div>
    <div class="content">
    <?php echo TEXT_ORDER_PRODUCTS . $history['product_count'] . '<br />'.TEXT_ORDER_COST . strip_tags($history['order_total']); ?>
    </div>
    <div class="content forward">
    <?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_VIEW_SMALL, BUTTON_VIEW_SMALL_ALT) . '</a><br>'; ?></div>
    <hr size="1" width="95%" align="center" color="<?php echo MOBILE_THEME_COLOR?>">
<?php
    }
?>
<div class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $history_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<div class="navSplitPagesResult"><?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></div>
<?php
  } else {
?>
<div class="centerColumn" id="noAcctHistoryDefault">
<?php echo TEXT_NO_PURCHASES; ?>
</div>
<?php
  }
?>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

</div>
