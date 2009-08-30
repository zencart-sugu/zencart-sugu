<?php
/**
 * category_icon_display module
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_icon_display.php 3012 2006-02-11 16:34:02Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if ($cPath == '') {
  $cPath= zen_get_product_path((int)$_GET['products_id']);
}

$cPath_new = zen_get_path(zen_get_products_category_id((int)$_GET['products_id']));
//      if ((zen_get_categories_image(zen_get_products_category_id((int)$_GET['products_id']))) !='') {
switch(true) {
  case ($module_show_categories=='1'):
  $align='left';
  break;
  case ($module_show_categories=='2'):
  $align='center';
  break;
  case ($module_show_categories=='3'):
  $align='right';
  break;
}
//    }
?>