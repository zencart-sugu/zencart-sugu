<?php
/**
 * addon_modules block Template
 *
 * @package templateSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */


?>
<?php if (!empty($sub_title) && !empty($text) && !empty($image)): ?>
<div class="greeting">
  <h3 class="title"><?php echo $sub_title; ?></h3>
	<dl>
		<dt>
			<?php if (!empty($image)) {
					echo '<img src="'.$image.'" />';
			} ?>
		</dt>
		<dd>
			<?php echo nl2br($text); ?>
		</dd>
	</dl>
</div>
<?php endif; ?>
  <?php if (MODULE_ABOUTBOX_DISPLAY_CALENDAR == 'true' && isset($GLOBALS['calendar'])): ?>
    <?php echo $GLOBALS['calendar']->getBlock('block', $current_page_base); ?>
<?php endif;?>
<?php if (MODULE_ABOUTBOX_AVALABLE_CARDS != '0'): ?>
<div class="cards">
  <h3 class="title"><?php echo MODULE_ABOUTBOX_CREDITCARDS_TITLE; ?></h3>
   <p>
   <?php if (MODULE_ABOUTBOX_AVALABLE_CARDS == 1) {
      echo zen_get_cc_enabled();
    } else {
      echo zen_get_cc_enabled('IMAGE_');
    } ?>
    </p>
</div>
<?php endif;?>
