<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: catalog_dhtml.php 3009 2006-02-11 15:41:10Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array('text' => BOX_HEADING_CATALOG, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_CATEGORIES_PRODUCTS, 'link' => zen_href_link(FILENAME_CATEGORIES, '', 'NONSSL'));

  $za_contents[] = array('text' => BOX_CATALOG_PRODUCT_TYPES, 'link' => zen_href_link(FILENAME_PRODUCT_TYPES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_PRODUCTS_PRICE_MANAGER, 'link' => zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER, 'link' => zen_href_link(FILENAME_OPTIONS_NAME_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER, 'link' => zen_href_link(FILENAME_OPTIONS_VALUES_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER, 'link' => zen_href_link(FILENAME_ATTRIBUTES_CONTROLLER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER, 'link' => zen_href_link(FILENAME_DOWNLOADS_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_PRODUCT_OPTIONS_NAME, 'link' => zen_href_link(FILENAME_PRODUCTS_OPTIONS_NAME, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_PRODUCT_OPTIONS_VALUES, 'link' => zen_href_link(FILENAME_PRODUCTS_OPTIONS_VALUES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_MANUFACTURERS, 'link' => zen_href_link(FILENAME_MANUFACTURERS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_REVIEWS, 'link' => zen_href_link(FILENAME_REVIEWS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_SPECIALS, 'link' => zen_href_link(FILENAME_SPECIALS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_FEATURED, 'link' => zen_href_link(FILENAME_FEATURED, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_SALEMAKER, 'link' => zen_href_link(FILENAME_SALEMAKER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_PRODUCTS_EXPECTED, 'link' => zen_href_link(FILENAME_PRODUCTS_EXPECTED, '', 'NONSSL'));


if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/catalog_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}

?>
<!-- catalog //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- catalog_eof //-->
