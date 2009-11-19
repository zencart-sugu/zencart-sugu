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
 * @version $Id: tpl_visitor_edit_default.php $
 */
?>
<div class="centerColumn" id="createAcctDefault">

<h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">

<?php echo zen_draw_form('visitor_edit', zen_href_link(FILENAME_ADDON, 'module=visitors/visitor_edit', 'SSL'), 'post', 'onsubmit="return check_form(visitor_edit);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<h4 id="createAcctDefaultLoginLink"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(), 'SSL')); ?></h4>

<?php require($page_module->getModuleTemplate($page_method, 'module_create_visitor')); ?>

<div class="submit">
<div class="buttonRow forward"><?php echo zen_image_submit(MODULE_VISITORS_BUTTON_IMAGE_CHANGE_ORAGE, MODULE_VISITORS_BUTTON_CHANGE_ALT,'class="imgover"'); ?></div>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT,'class="imgover"','class="imgover"') . '</a>'; ?></div>
</div>

</form>
</div></div>
