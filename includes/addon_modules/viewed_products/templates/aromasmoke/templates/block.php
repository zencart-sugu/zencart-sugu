<h2><?php echo MODULE_VIEWED_PRODUCTS_BLOCK_TITLE;?></h2>
<?php foreach ($viewed_products as $viewed_product): ?>
<dl>
<dt><a href="<?php echo $viewed_product['url']?>"><?php echo zen_image($viewed_product['image'], $viewed_product['name'], $small_width, $small_height)?></a></dt>
<dd class="name"><a href="<?php echo $viewed_product['url']?>"><?php echo $viewed_product['name']; ?></a></dd>
<dd class="price"><?php echo $viewed_product['display_price']; ?></dd>
</dl>
<?php endforeach; ?>

