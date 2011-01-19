<?php
/**
 * Sitemap XML Feed
 *
 * @package Sitemap XML Feed
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: site_map_xml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

define('NAVBAR_TITLE', 'SiteMapXML');
define('HEADING_TITLE', 'SiteMapXML (%s)');

define('TEXT_EXECUTION_TIME', 'Total Execution Time');
define('TEXT_TOTAL_SITEMAP', 'Total: files %s, items %s (%s bytes).');
define('TEXT_FILE_SITEMAP_INFO', 'File <a href="%s" target="_blank">%s</a>. Written %s items (%s bytes), Filesize: %s bytes');
define('TEXT_WRITTEN', 'Written %s items (%s bytes), Filesize: %s bytes');

define('TEXT_URL_FILE', 'URL - ');
define('TEXT_INCLUDE_FILE', 'Include ');
define('TEXT_FILE_NOT_CHANGED', 'have not changed - using existing file(s)');
define('TEXT_FAILED_TO_OPEN', '<span style="font-weight: bold); color: red;"> Failed to open file</span>');

define('TEXT_HEAD_SITEMAP_INDEX', 'Sitemap Index');
define('TEXT_HEAD_PING', 'Ping');

define('TEXT_ERROR_CURL_NOT_FOUND', 'CURL functions not found - required for ping/checkURL functions');
define('TEXT_ERROR_CURL_INIT', 'cURL Error: init cURL');
define('TEXT_ERROR_CURL_EXEC', 'cURL Error: "<b>%s</b>" reading "%s"');
define('TEXT_ERROR_CURL_NO_HTTPCODE', 'cURL Error: No http_code reading "%s"');
define('TEXT_ERROR_CURL_ERR_HTTPCODE', 'cURL Error: Error http_code "<b>%s</b>" reading "%s"');
define('TEXT_ERROR_CURL_0_DOWNLOAD', 'cURL Error: Zero download size reading "%s"');
define('TEXT_ERROR_CURL_ERR_DOWNLOAD', 'cURL Error: Reading less than page size "%s". Download = %s, Content length = %s.');

define('TEXT_HEAD_PRODUCTS', 'Products Sitemap');
define('TEXT_HEAD_CATEGORIES', 'Categories Sitemap');
define('TEXT_HEAD_EZPAGES', 'Ezpages Sitemap');
define('TEXT_HEAD_REVIEWS', 'Reviews Sitemap');
define('TEXT_HEAD_TESTIMONIALS', 'Testimonials Sitemap');

define('TEXT_ERRROR_EZPAGES_OUTOFBASE', 'EZ-Page ignored (out of base url): "<b>%s</b>" (%s)');
define('TEXT_ERRROR_EZPAGES_ROBOTS', 'EZ-Page ignored (found in ROBOTS_PAGES_TO_SKIP): "<b>%s</b>" (%s)');

// EOF
