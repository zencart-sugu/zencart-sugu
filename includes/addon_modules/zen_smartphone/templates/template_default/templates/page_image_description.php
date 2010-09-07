<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: $
 */
?>
<div class="centerColumn" id="indexCategories">

<h1 id="indexCategoriesHeading"><?php echo $product['name']; ?></h1>

<div>
<?php
  echo zen_image(DIR_WS_IMAGES.$product['image'], $product['name'], MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT);
?>
<div><a href="<?php echo zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product['id']); ?>"><?php echo MODULE_ZEN_SMARTPHONE_IMAGE_DESCRIPTION_RETURN; ?></a></div>
</div>

</div>
