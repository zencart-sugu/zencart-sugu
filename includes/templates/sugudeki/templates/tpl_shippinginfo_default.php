<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shippinginfo_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="centerColumn" id="shippingInfo">
<h1 id="shippingInfoHeading"><?php echo HEADING_TITLE; ?></h1>
<div id="centerColumnBody">
<?php if (DEFINE_SHIPPINGINFO_STATUS >= 1 and DEFINE_SHIPPINGINFO_STATUS <= 2) { ?>
<div id="shippingInfoMainContent" class="content">
<?php
/**
 * require the html_define for the shippinginfo page
 */
  require($define_page);
?>
 <?php
 /**
  * display the shipping type cost table
  */
 //require($template->get_template_dir('/tpl_modules_shipping_type_table.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_shipping_type_table.php'); ?>
 
</div>
<?php } ?>

<div class="submit"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
</div>