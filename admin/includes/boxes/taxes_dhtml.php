<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: taxes_dhtml.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_LOCATION_AND_TAXES, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TAXES_COUNTRIES, 'link' => zen_href_link(FILENAME_COUNTRIES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TAXES_ZONES, 'link' => zen_href_link(FILENAME_ZONES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TAXES_GEO_ZONES, 'link' => zen_href_link(FILENAME_GEO_ZONES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TAXES_TAX_CLASSES, 'link' => zen_href_link(FILENAME_TAX_CLASSES, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TAXES_TAX_RATES, 'link' => zen_href_link(FILENAME_TAX_RATES, '', 'NONSSL'));
if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/taxes_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}
?>
<!-- taxes //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- taxes_eof //-->
