<?php
/**
 * addon_modules block Template
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */


?>
<div id="footer-about"><div id="footer-about-body">


<?php if (!empty($sub_title) && !empty($text)): ?>
<div id="block-about" class="block block-about">
<h2 class="title"><?php echo $sub_title; ?></h2>
<div class="content">
<?php echo nl2br($text); ?>
</div>

</div>
<?php endif; ?>

<div id="block-cards" class="block block-cards">
<h2 class="title"><?php echo MODULE_ABOUTBOX_CREDITCARDS_TITLE; ?></h2>
<div class="content">
<ul>
<?php $payments = aboutbox_get_payment_enabled();
foreach($payments as $payment):
?>
<li><?php echo $payment; ?></li>
<?php endforeach; ?>
</ul>

<?php if (MODULE_ABOUTBOX_AVALABLE_CARDS == 1) {
      echo '<p class="card">'.zen_get_cc_enabled().'</p>';
    } else {
      echo '<p class="card">'.zen_get_cc_enabled('IMAGE_').'</p>';
    } ?>
		
</div>



</div>



<?php if (MODULE_ABOUTBOX_DISPLAY_CALENDAR == 'true' && isset($GLOBALS['calendar'])): ?>
<?php echo $GLOBALS['calendar']->getBlock('block', $current_page_base); ?>
<?php endif;?>

</div></div>
