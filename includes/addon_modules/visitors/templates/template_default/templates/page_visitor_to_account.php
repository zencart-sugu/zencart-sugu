<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_visitor_to_account_default.php $
 */
$page = 'createAcct';
?>
<div class="centerColumn" id="createAcctDefault">

<h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">

<?php echo zen_draw_form('visitor_to_account', zen_href_link(FILENAME_ADDON, 'module=visitors/visitor_to_account', 'SSL'), 'post', 'onsubmit="return check_form(visitor_to_account);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>

<?php require($template->get_template_dir('tpl_modules_create_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_create_account.php'); ?>

<div class="submit"><?php echo zen_image_submit(MODULE_VISITORS_BUTTON_IMAGE_REGISTER, MODULE_VISITORS_BUTTON_REGISTER_ALT,'class="imgover"'); ?></div>

</form>
</div></div>
