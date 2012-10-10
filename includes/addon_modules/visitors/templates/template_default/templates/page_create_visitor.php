<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_visitor.<br />
 * Displays Create Visitor form.
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: page_create_visitor.php $
 */
?>
<div class="centerColumn" id="createAcctDefault">

<h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">

<p class="attention"><?php echo sprintf(TEXT_ORIGIN_LOGIN, zen_href_link(FILENAME_LOGIN, zen_get_all_get_params(), 'SSL')); ?></p>

<?php echo zen_draw_form('create_visitor', zen_href_link(FILENAME_ADDON, 'module=visitors/create_visitor', 'SSL'), 'post', 'onsubmit="return check_form(create_visitor);"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<?php require($page_module->getModuleTemplate($page_method, 'module_create_visitor')); ?>


<div class="submit"><?php echo zen_image_submit(MODULE_VISITORS_BUTTON_IMAGE_CHECKOUT_SHIPPING, MODULE_VISITORS_BUTTON_CHECKOUT_SHIPPING_ALT,'class="imgover"'); ?></div>

</form>
</div></div>