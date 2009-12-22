<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: sitemapxml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */
  @define('MODULE_SITEMAPXML_VERSION', 'v 2.1.0 30.04.2009 10:35');
/*
Version 2.0.
Generate xml-sitemaps for:
1. Products,
2. Categories,
3. Reviews,
4. EZ-pages
- multi-language support,
- 'EZ pages rel=nofollow attribute' support (http://www.zen-cart.com/index.php?main_page=product_contrib_info&products_id=944),
- 'date_added'/'last_modified' support,
- check internal links ('alt_url') by "noindex" rule (main_page in ROBOTS_PAGES_TO_SKIP),
- toc_chapter proccessing
5. Testimonials,

If the products, categories, reviews have not changed since the last generation (time creation corresponding xml-sitemap file), a new xml-sitemap file not created (using existing xml-sitemap).

Priority is calculated on the basis of the positions in the selection from the database, ie the operator ORDER BY in the sql query. First item have priority=1.00, last=0.10. So can no longer be situations where all items in the file have the same priority.
Products - ORDER BY p.products_sort_order ASC, last_date DESC
Categories - ORDER BY c.sort_order ASC, last_date DESC
Reviews - ORDER BY r.reviews_rating ASC, last_date DESC
EZ-pages - ORDER BY p.sidebox_sort_order ASC, last_date DESC
Testimonials - ORDER BY last_date DESC

Support 3 $_GET parameters:
ping=yes - Pinging Google, Yahoo!, Ask.com and Microsoft.
inline=yes - output file sitemapindex.xml.
genxml=no - don't generate xml-files.
rebuild=yes - force rebuild xml files
checkurl=yes - check urls


Using index.php wrapper - http://domain.com/index.php?main_page=sitemapxml
Using languages file and etc.

Comments and suggestions are welcome.
If you need any more sitemaps (faq, news, etc) you may ask me, but I will do only if it matches with my interests.
*/
/*
TODO:
1. Add sitemap for manufacturers (???)
*/

//@ini_set('display_errors', '1');
//error_reporting(E_ALL);

$time_start = explode (' ', microtime());

@define('MODULE_SITEMAPXML_COMPRESS', 'false');
@define('MODULE_SITEMAPXML_LASTMOD_FORMAT', 'date');
@define('MODULE_SITEMAPXML_USE_EXISTING_FILES', 'true'); // new
@define('MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE', 'true'); // new
@define('MODULE_SITEMAPXML_PING_URLS', "Google => http://www.google.com/webmasters/sitemaps/ping?sitemap=%s
Yahoo! => http://search.yahooapis.com/SiteExplorerService/V1/ping?sitemap=%s
Ask.com => http://submissions.ask.com/ping?sitemap=%s
Microsoft => http://www.moreover.com/ping?u=%s"); // new

@define('MODULE_SITEMAPXML_PRODUCTS_ORDERBY', 'p.products_sort_order ASC, last_date DESC'); // new
@define('MODULE_SITEMAPXML_CATEGORIES_ORDERBY', 'c.sort_order ASC, last_date DESC'); // new
@define('MODULE_SITEMAPXML_REVIEWS_ORDERBY', 'r.reviews_rating ASC, last_date DESC'); // new
@define('MODULE_SITEMAPXML_EZPAGES_ORDERBY', 'p.sidebox_sort_order ASC'); // new
@define('MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY', 'last_date DESC'); // new

@define('MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ', '');
@define('MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ', '');
@define('MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ', ''); // new
@define('MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ', '');
@define('MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ', ''); // new

// Deleted:
// MODULE_SITEMAPXML_EZPAGES_HEADER
// MODULE_SITEMAPXML_EZPAGES_SIDEBOX
// MODULE_SITEMAPXML_EZPAGES_FOOTER
// MODULE_SITEMAPXML_EZPAGES_CHANGE_PRIOR
// MODULE_SITEMAPXML_CAT_CHANGE_PRIOR
// MODULE_SITEMAPXML_PROD_CHANGE_PRIOR
// MODULE_SITEMAPXML_XML_FS_DIRECTORY
// MODULE_SITEMAPXML_USE_XSL

if (!get_cfg_var('safe_mode') && function_exists('set_time_limit')) {
  set_time_limit(0);
}

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_SITEMAPXML');
require_once('includes/addon_modules/sitemapXML/classes/sitemapxml.php');
/**
 * load language files
 */
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$breadcrumb->add(NAVBAR_TITLE);

$inline   = (isset($_GET['inline']) && $_GET['inline'] == 'yes') ? true : false;
$genxml   = (!isset($_GET['genxml']) || $_GET['genxml'] != 'no') ? true : false;
$ping     = (isset($_GET['ping']) && $_GET['ping'] == 'yes') ? true : false;
$checkurl = (isset($_GET['checkurl']) && $_GET['checkurl'] == 'yes') ? true : false;
$rebuild = (isset($_GET['rebuild']) && $_GET['rebuild'] == 'yes') ? true : false;

/**
 * load the site map class
 */

$zen_SiteMapXML = new zen_SiteMapXML($inline, $ping, $rebuild, $genxml, 'pub/');
$zen_SiteMapXML->setCheckURL($checkurl);

//$tpl_dir = $template->get_template_dir('gss\.xsl', DIR_WS_TEMPLATE, $current_page_base, 'css');
$zen_SiteMapXML->setStylesheet(zen_href_link($gss_tpl_dir . '/gss.xsl', '', 'NONSSL', false, false, true));

$SiteMapXMLmodules = array();
//$SiteMapXMLmodules = glob(DIR_WS_MODULES . 'pages/' . $current_page_base . '/sitemapxml_*.php');
$SiteMapXMLmodules = glob('includes/addon_modules/sitemapXML/lib/sitemapxml_*.php');

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_SITEMAPXML');

  @ini_set('display_errors', '0');
  error_reporting(0);
?>
