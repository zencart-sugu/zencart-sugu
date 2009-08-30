<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_category_icon_display.php 2747 2005-12-31 06:05:37Z ajeh $
 */
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CATEGORY_ICON_DISPLAY));
?>

<div align="<?php echo $align; ?>" id="categoryIcon" class="categoryIcon"><?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new, 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . zen_get_categories_image(zen_get_products_category_id((int)$_GET['products_id'])),zen_get_categories_name(zen_get_products_category_id((int)$_GET['products_id']), $_SESSION['languages_id']), CATEGORY_ICON_IMAGE_WIDTH, CATEGORY_ICON_IMAGE_HEIGHT) . '<br />' . zen_get_categories_name(zen_get_products_category_id((int)$_GET['products_id']), $_SESSION['languages_id']) .  '</a>'; ?></div>