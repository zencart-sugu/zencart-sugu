<?php
/**
 * Sitemap XML Feed
 *
 * @package Sitemap XML Feed
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: sitemapxml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (!function_exists("page_allowed") ||
    function_exists("page_allowed") && page_allowed('module='.FILENAME_SITEMAPXML) == 'true') {
  $za_contents[] = array('text' => BOX_SITEMAPXML, 'link' => zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_SITEMAPXML, 'NONSSL'));
}
?>
