<?php
/**
 * upcoming_products module 
 *
 * @package modules
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: upcoming_products.php 3087 2006-03-01 06:09:47Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
  $expected_query = "select p.products_id, pd.products_name, products_date_available as date_expected
                       from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                       where to_days(products_date_available) > to_days(now())
                       and p.products_id = pd.products_id
                       and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                       order by " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT . "
                       limit " . MAX_DISPLAY_UPCOMING_PRODUCTS;
} else {
  $expected_query = "select p.products_id, pd.products_name, products_date_available as date_expected
                       from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
  TABLE_CATEGORIES . " c
                       where p.products_id = p2c.products_id
                       and p2c.categories_id = c.categories_id
                       and c.parent_id = '" . (int)$new_products_category_id . "'
                       and to_days(products_date_available) > to_days(now())
                       and p.products_id = pd.products_id
                       and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                       order by " . EXPECTED_PRODUCTS_FIELD . " " . EXPECTED_PRODUCTS_SORT . "
                       limit " . MAX_DISPLAY_UPCOMING_PRODUCTS;
}

$expected = $db->Execute($expected_query);

if ($expected->RecordCount() > 0) {
  require($template->get_template_dir('tpl_modules_upcoming_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_upcoming_products.php');
}
?>