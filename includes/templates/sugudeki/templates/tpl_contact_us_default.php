<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_contact_us_default.php 3651 2006-05-22 05:18:52Z ajeh $
 */
?>
<div class="centerColumn" id="contactUsDefault">
<?php if (MODULE_MT_PAGES_STATUS == 'true' and !empty($mt_page_contact_us_top_title)) { ?>
<h1 id="contactusDefaultHeading"><?php echo $mt_page_contact_us_top_title; ?></h1>
<?php } else { ?>
<h1 id="contactusDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php } ?>
<div id="centerColumnBody">
<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>

<div class="mainContent success"><?php echo TEXT_SUCCESS; ?></div>
<?php if (CONTACT_US_STORE_NAME_ADDRESS== '1') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>
<div class="buttonRow"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  } else {
?>

<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send', 'SSL')); ?>

<?php if (CONTACT_US_STORE_NAME_ADDRESS== '1') { ?>
<address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php } ?>

<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
<div class="content">
<?php
/**
 * require html_define for the contact_us page
 */
if (MODULE_MT_PAGES_STATUS == 'true' and !empty($mt_page_contact_us_top_message)) {
  echo $mt_page_contact_us_top_message;
}
?>
</div>
<?php } ?>

<h2 class="headline"><?php echo HEADING_TITLE; ?></h2>



<?php
    if (DISPLAY_CONTACT_US_PRIVACY_CONDITIONS == 'true') {
?>
<div id="contactUsNoticeContent" class="content">
     <?php echo '<div class="information">'.TEXT_PRIVACY_CONDITIONS_DESCRIPTION . '</div>' . zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy"') . '<label for="privacy">&nbsp;' . TEXT_PRIVACY_CONDITIONS_CONFIRM . '</label>'; ?>
</div>
<?php
    }
?>

<table class="border fit">
<?php
// show dropdown if set
    if (CONTACT_US_LIST !=''){
?>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo SEND_TO_TEXT; ?></label></th>
<td><?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 'id=\"send-to\"'); ?></td>
</tr>
<?php
    }
?>

<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_NAME ; ?></label></th>
<td><?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname"'); ?></td>
</tr>
<tr class="email">
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_EMAIL ; ?></label></th>
<td><?php echo zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="email-address"') ; ?></td>
</tr>
<tr>
<th scope="row"><span class="required"><?php echo TEXT_REQUIRED ?></span><label><?php echo ENTRY_ENQUIRY ; ?></label></th>
<td><?php echo zen_draw_textarea_field('enquiry', '30', '7', '', 'id="enquiry"'); ?></td>
</tr>
</table>


<div class="submit">
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT,'class="imgover"'); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT,'class="imgover"') . '</a>'; ?></div>
</div>
<?php
  }
?>
</form>
</div></div>