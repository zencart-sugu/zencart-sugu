<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: customers_dhtml.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_CUSTOMERS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CUSTOMERS_CUSTOMERS, 'link' => zen_href_link(FILENAME_CUSTOMERS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CUSTOMERS_ORDERS, 'link' => zen_href_link(FILENAME_ORDERS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CUSTOMERS_GROUP_PRICING, 'link' => zen_href_link(FILENAME_GROUP_PRICING, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CUSTOMERS_PAYPAL, 'link' => zen_href_link(FILENAME_PAYPAL, '', 'NONSSL'));
if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/customers_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}
?>
<!-- customers //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- customers_eof //-->
