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
 * @version $Id: block_specials_products.php $
 */

?>
<div align="right"></div>
<?php
if (count($products) > 0 ):
?>
<ul>
<?php
 foreach ($products as $product):
?>
<li>
<dl>
<?php
  if ($product['id'] > 0) {
?>
<dt><a href="<?php echo $product['link']; ?>"><?php echo zen_image(DIR_WS_IMAGES . $product['image'], $product['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?></a></dt>
<dd class="name"><a href="<?php echo $product['link']; ?>"><?php echo $product['manufacturers']; ?><br /><?php echo $product['name']; ?></a></dd>
<dd class="price"><?php echo TEXT_PRICE_KN ; ?><?php echo $product['price']; ?></dd>
<?php
  } else {
?>
<dt></dt>
<dd class="name"><br /></dd>
<dd class="price"></dd>
<?php
  }
?>
</dl>
</li>
<?php
  endforeach;
?>
</ul>
<?php
endif;