<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: modules_dhtml.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_MODULES, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_MODULES_PAYMENT, 'link' => zen_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL'));
  $za_contents[] = array('text' => BOX_MODULES_SHIPPING, 'link' => zen_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL'));
  $za_contents[] = array('text' => BOX_MODULES_ORDER_TOTAL, 'link' => zen_href_link(FILENAME_MODULES, 'set=ordertotal',  'NONSSL'));
if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/modules_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}
?>
<!-- modules //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- modules_eof //-->
