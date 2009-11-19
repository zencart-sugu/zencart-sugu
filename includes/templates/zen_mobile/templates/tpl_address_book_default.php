<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=adress_book.<br />
 * Allows customer to manage entries in their address book
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_default.php 2905 2006-01-28 01:25:36Z birdbrain $
 */
echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>
<div class="centerColumn" id="addressBookDefault">

<?php echo BOX_HEADING_COLORBOX.HEADING_TITLE; ?>
 
<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?> 
      
<?php 
echo "<br>";
echo "<font size=2>".BOX_HEADING_CATEGORIES_LIST."</font>";
echo PRIMARY_ADDRESS_TITLE; 
echo "<br>";
echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br />') . "<br><br>"; 
echo PRIMARY_ADDRESS_DESCRIPTION;
echo "<br>";
echo "<br>";
echo BOX_HEADING_COLORBOX.ADDRESS_BOOK_TITLE; ?>
<div class="alert forward"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
<br>
<?php
/**
 * Used to loop thru and display address book entries
 */
  foreach ($addressArray as $addresses) {

if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id'])
    echo PRIMARY_ADDRESS."<br>" ;

echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br />'); ?>

<div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_EDIT_SMALL, BUTTON_EDIT_SMALL_ALT) . '</a> <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_DELETE, BUTTON_DELETE_ALT) . '</a>'; ?></div>
<br class="clearBoth">
<?php
  }
?>

<?php
  if (zen_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
?>
   <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_ADD_ADDRESS, BUTTON_ADD_ADDRESS_ALT) . '</a>'; ?></div>
<?php
  }
?>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<br class="clearBoth" />
</div>
