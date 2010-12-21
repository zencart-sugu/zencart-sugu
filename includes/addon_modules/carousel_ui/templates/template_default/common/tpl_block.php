<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_block.php $
 */
if (count($products)>0) {

if ($ui_conf['vertical'] == 'true') {
  $vh_class = 'vertical';
} else {
  $vh_class = 'horizontal';
}
?>

<p class="pagetop"><a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']) ?>#container"><?php echo PAGETOP ; ?></a></p>

<div id="block-<?php echo $module; ?>-<?php echo $block; ?>" class="block block-<?php echo $module; ?> <?php echo $vh_class; ?>">
<?php
if ($title):
?>
<h3 class="title transparent"><?php echo $title; ?></h3>
<?php
endif;
?>
<div class="content">
<?php
// 表示件数が多い場合カルーセル
if ((int)$ui_conf['visible'] < count($products)) {
?>
<script language="javascript" type="text/javascript">
  //<![CDATA[
  document.write('<div class="prev button prev-<?php echo $module . '-' . $block; ?>" tabindex="-1"><a href="javascript:;"><?php echo $prevbutton; ?></a></div>');
  //]]>
//--></script>

<script language="javascript" type="text/javascript">
  //<![CDATA[
  document.write('<div class="next button next-<?php echo $module . '-' . $block; ?>" tabindex="-1"><a href="javascript:;"><?php echo $nextbutton; ?></a></div>');
  //]]>
//--></script>
<?php
}
?>
<div class="carouselUI carouselUI-<?php echo $module . '-' . $block; ?>">
<?php echo $content; ?>
</div>

</div>
</div>
<?php } ?>
