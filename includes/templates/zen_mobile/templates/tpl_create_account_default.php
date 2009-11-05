<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_create_account_default.php 3359 2006-04-03 05:00:37Z drbyte $
 */
//echo "<font color=red>".$mobile->view_securepage_notice()."</font>";
?>
<div class="centerColumn" id="createAcctDefault">

<?php echo MOBILE_TITLE_START; ?><?php echo HEADING_TITLE; ?><?php echo MOBILE_TITLE_FINISH; ?>
<br>
<br>

<?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', '') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<div id="createAcctDefaultLoginLink"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(), 'SSL')); ?></div>

<br>

<fieldset>
<legend><?php echo CATEGORY_PERSONAL; ?></legend>

<?php require($template->get_template_dir('tpl_modules_create_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_create_account.php'); ?>

</fieldset>

<div class="buttonRow forward"><input type="submit" value="<?php echo BUTTON_SUBMIT_ALT; ?>">
</div>
</form>
</div>
