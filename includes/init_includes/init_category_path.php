<?php
/**
 * pre-calculate the category path
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_category_path.php 2753 2005-12-31 19:17:17Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$show_welcome = false;
if (isset($_GET['cPath'])) {
  $cPath = $_GET['cPath'];
} elseif (isset($_GET['products_id']) && !zen_check_url_get_terms()) {
  $cPath = zen_get_product_path($_GET['products_id']);
} else {
  if (SHOW_CATEGORIES_ALWAYS == '1' && !zen_check_url_get_terms()) {
    $show_welcome = true;
    $cPath = (defined('CATEGORIES_START_MAIN') ? CATEGORIES_START_MAIN : '');
  } else {
    $show_welcome = false;
    $cPath = '';
  }
}
if (zen_not_null($cPath)) {
  $cPath_array = zen_parse_category_path($cPath);
  $cPath = implode('_', $cPath_array);
  $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
} else {
  $current_category_id = 0;
  $cPath_array = array();
}
?>