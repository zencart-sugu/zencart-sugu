<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: gv_admin_dhtml.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_GV_ADMIN, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));

// don't Coupons unless installed
if (MODULE_ORDER_TOTAL_COUPON_STATUS=='true') {
  $za_contents[] = array('text' => BOX_COUPON_ADMIN, 'link' => zen_href_link(FILENAME_COUPON_ADMIN, '', 'NONSSL'));
 } // coupons installed

// don't Gift Vouchers unless installed
if (MODULE_ORDER_TOTAL_GV_STATUS=='true') {
  $za_contents[] = array('text' => BOX_GV_ADMIN_QUEUE, 'link' => zen_href_link(FILENAME_GV_QUEUE, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_GV_ADMIN_MAIL, 'link' => zen_href_link(FILENAME_GV_MAIL, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_GV_ADMIN_SENT, 'link' => zen_href_link(FILENAME_GV_SENT, '', 'NONSSL'));
} // gift vouchers installed

// if both are off display msg
if (!defined('MODULE_ORDER_TOTAL_COUPON_STATUS') and !defined('MODULE_ORDER_TOTAL_GV_STATUS')) {
  $za_contents[] = array('text' => NOT_INSTALLED_TEXT, 'link' => '');
} // coupons and gift vouchers not installed
if ($za_dir = @dir(DIR_WS_BOXES . 'gv_admin_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/gv_admin_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}
?>
<!-- gv_admin //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- gv_admin_eof //-->
