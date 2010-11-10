<ul>
<?php foreach ($viewed_products as $viewed_product): ?>
<li><a href="<?php echo $viewed_product['url']?>"><?php echo zen_image($viewed_product['image'], $viewed_product['name'], $small_width, $small_height)?><br />
<?php echo $viewed_product['name']; ?></a><br >
<?php echo $viewed_product['display_price']; ?></li>
<?php endforeach; ?>
</ul>
