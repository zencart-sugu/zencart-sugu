<?php
/**
 * main_product_image module
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_product_image.php 3012 2006-02-11 16:34:02Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$products_image_extension = substr($products_image, strrpos($products_image, '.'));
$products_image_base = ereg_replace($products_image_extension, '', $products_image);
$products_image_medium = $products_image_base . IMAGE_SUFFIX_MEDIUM . $products_image_extension;
$products_image_large = $products_image_base . IMAGE_SUFFIX_LARGE . $products_image_extension;

// check for a medium image else use small
if (!file_exists(DIR_WS_IMAGES . 'medium/' . $products_image_medium)) {
  $products_image_medium = DIR_WS_IMAGES . $products_image;
} else {
  $products_image_medium = DIR_WS_IMAGES . 'medium/' . $products_image_medium;
}
// check for a large image else use medium else use small
if (!file_exists(DIR_WS_IMAGES . 'large/' . $products_image_large)) {
  if (!file_exists(DIR_WS_IMAGES . 'medium/' . $products_image_medium)) {
    $products_image_large = DIR_WS_IMAGES . $products_image;
  } else {
    $products_image_large = DIR_WS_IMAGES . 'medium/' . $products_image_medium;
  }
} else {
  $products_image_large = DIR_WS_IMAGES . 'large/' . $products_image_large;
}
/*
echo
'Base ' . $products_image_base . ' - ' . $products_image_extension . '<br>' .
'Medium ' . $products_image_medium . '<br><br>' .
'Large ' . $products_image_large . '<br><br>';
*/
// to be built into a single variable string

?>