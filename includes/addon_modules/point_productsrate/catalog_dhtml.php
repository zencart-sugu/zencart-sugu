<?php
/**
 * @package point
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: point_catalog_dhtml.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (!function_exists("page_allowed") ||
    function_exists("page_allowed") && page_allowed('module=point_productsrate') == 'true') {
  $za_contents[] = array('text' => BOX_CATALOG_PRODUCTS_POINTRATE, 'link' => zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=point_productsrate', 'NONSSL'));
}
