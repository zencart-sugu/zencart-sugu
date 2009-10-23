<?php
/**
 * Common Template - tpl_block.php
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_block.php $
 */
?>
<div id="block-<?php echo $module; ?>-<?php echo $block; ?>" class="block block-<?php echo $module; ?>">
<?php
if ($title) {
?>
<h3 class="title"><?php echo $title; ?></h3>
<?php
}
?>
<?php
if ($content) {
?>
<div class="content">
<?php echo $content; ?>
</div>
<?php
}
?>
</div>
