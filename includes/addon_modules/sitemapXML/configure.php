<?php
/**
 * Module Configuration Settings
 *
 * @package Addon Modules
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: configure.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

define('MODULE_SITEMAPXML_STATUS_DEFAULT', 'true');
define('MODULE_SITEMAPXML_COMPRESS_DEFAULT', 'false');
define('MODULE_SITEMAPXML_LASTMOD_FORMAT_DEFAULT', 'date');
define('MODULE_SITEMAPXML_USE_EXISTING_FILES_DEFAULT', 'true');
define('MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_DEFAULT', 'true');
define('MODULE_SITEMAPXML_PING_URLS_DEFAULT', 'Google => http://www.google.com/webmasters/sitemaps/ping?sitemap=%s; Yahoo! => http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=%s; Ask.com => http://submissions.ask.com/ping?sitemap=%s; Microsoft => http://www.moreover.com/ping?u=%s');
define('MODULE_SITEMAPXML_PRODUCTS_ORDERBY_DEFAULT', 'products_sort_order ASC, last_date DESC');
define('MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_DEFAULT', 'weekly');
define('MODULE_SITEMAPXML_CATEGORIES_ORDERBY_DEFAULT', 'sort_order ASC, last_date DESC');
define('MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_DEFAULT', 'weekly');
define('MODULE_SITEMAPXML_REVIEWS_ORDERBY_DEFAULT', 'reviews_rating ASC, last_date DESC');
define('MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_DEFAULT', 'weekly');
define('MODULE_SITEMAPXML_EZPAGES_ORDERBY_DEFAULT', 'sidebox_sort_order ASC, header_sort_order ASC, footer_sort_order ASC');
define('MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_DEFAULT', 'weekly');
define('MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_DEFAULT', 'last_date DESC');
define('MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_DEFAULT', 'weekly');
define('MODULE_SITEMAPXML_SORT_ORDER_DEFAULT', '');
