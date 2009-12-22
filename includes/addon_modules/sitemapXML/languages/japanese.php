<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: japanese.php $
//
define('MODULE_SITEMAPXML_TITLE', 'Sitemap XML');
define('MODULE_SITEMAPXML_DESCRIPTION', '');

define('MODULE_SITEMAPXML_STATUS_TITLE', 'Sitemap XMLの有効化');
define('MODULE_SITEMAPXML_STATUS_DESCRIPTION', 'Sitemap XMLを有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_SITEMAPXML_COMPRESS_TITLE', 'Compress XML File');
define('MODULE_SITEMAPXML_COMPRESS_DESCRIPTION', 'Compress Google XML Sitemap file');

define('MODULE_SITEMAPXML_LASTMOD_FORMAT_TITLE', 'Lastmod tag format');
define('MODULE_SITEMAPXML_LASTMOD_FORMAT_DESCRIPTION', 'Lastmod tag format:<br />date - Complete date: YYYY-MM-DD (eg 1997-07-16)<br />full -    Complete date plus hours, minutes and seconds: YYYY-MM-DDThh:mm:ssTZD (eg 1997-07-16T19:20:30+01:00)');

define('MODULE_SITEMAPXML_USE_EXISTING_FILES_TITLE', 'Use Existing Files');
define('MODULE_SITEMAPXML_USE_EXISTING_FILES_DESCRIPTION', 'Use Existing XML Files');

define('MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_TITLE', 'Generate language_id for default language');
define('MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE_DESCRIPTION', 'Generate language_id parameter for default language');

define('MODULE_SITEMAPXML_PING_URLS_TITLE', 'Ping urls');
define('MODULE_SITEMAPXML_PING_URLS_DESCRIPTION', 'List of pinging urls separated by ;');

define('MODULE_SITEMAPXML_PRODUCTS_ORDERBY_TITLE', 'Products order by');
define('MODULE_SITEMAPXML_PRODUCTS_ORDERBY_DESCRIPTION', '');

define('MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_TITLE', 'Products changefreq');
define('MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ_DESCRIPTION', 'How frequently the Product pages page is likely to change.');

define('MODULE_SITEMAPXML_CATEGORIES_ORDERBY_TITLE', 'Categories order by');
define('MODULE_SITEMAPXML_CATEGORIES_ORDERBY_DESCRIPTION', '');

define('MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_TITLE', 'Category changefreq');
define('MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ_DESCRIPTION', 'How frequently the Category pages page is likely to change.');

define('MODULE_SITEMAPXML_REVIEWS_ORDERBY_TITLE', 'Reviews order by');
define('MODULE_SITEMAPXML_REVIEWS_ORDERBY_DESCRIPTION', '');

define('MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_TITLE', 'Reviews changefreq');
define('MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ_DESCRIPTION', 'How frequently the Category pages page is likely to change.');

define('MODULE_SITEMAPXML_EZPAGES_ORDERBY_TITLE', 'EZPages order by');
define('MODULE_SITEMAPXML_EZPAGES_ORDERBY_DESCRIPTION', '');

define('MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_TITLE', 'EZPages changefreq');
define('MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ_DESCRIPTION', 'How frequently the EZPages pages page is likely to change.');

define('MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_TITLE', 'Testimonials order by');
define('MODULE_SITEMAPXML_TESTIMONIALS_ORDERBY_DESCRIPTION', '');

define('MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_TITLE', 'Testimonials changefreq');
define('MODULE_SITEMAPXML_TESTIMONIALS_CHANGEFREQ_DESCRIPTION', 'How frequently the EZPages pages page is likely to change.');

define('MODULE_SITEMAPXML_SORT_ORDER_TITLE', '優先順');
define('MODULE_SITEMAPXML_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('BOX_SITEMAPXML', 'Sitemap XML');
?>
