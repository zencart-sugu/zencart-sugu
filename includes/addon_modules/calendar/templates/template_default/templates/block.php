<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */
?>

<p><?php echo $shippinginfo; ?></p>
<p><?php echo $shippingLastinfo; ?></p>
<div class="calendar">
<?php echo html_make_calendar($cur_calendar); ?>
<?php echo html_make_calendar($next_calendar); ?>
</div>
<p class="holyday"><?php echo MODULE_CALENDAR_DAY; ?></p>
<p class="more"><?php echo '<a href="'.zen_href_link(FILENAME_ADDON, '&module=mt_pages&page=shipping', 'NONSSL').'">'.zen_image_button(BUTTON_IMAGE_FOOTER_SHIPPING, BUTTON_FOOTER_SHIPPING_ALT,'class="imgover"') ; ?></a></p>

