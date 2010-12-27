<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemapxml_reviews.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

$zen_SiteMapXML->message('<h3>' . TEXT_HEAD_REVIEWS . '</h3>');
$last_date = $db->Execute("SELECT MAX(GREATEST(r.date_added, IFNULL(r.last_modified, 0))) AS last_date
                           FROM " . TABLE_REVIEWS . " r
                           WHERE r.status = '1'");
if ($zen_SiteMapXML->SitemapOpen('reviews', $last_date->fields['last_date'])) {
    $reviews = $db->Execute("SELECT r.reviews_id, GREATEST(r.date_added, IFNULL(r.last_modified, '0001-01-01 00:00:00')) AS last_date, r.products_id, r.reviews_rating AS priority, rd.languages_id AS language_id
                           FROM " . TABLE_REVIEWS . " r
                             LEFT JOIN " . TABLE_REVIEWS_DESCRIPTION . " rd ON (r.reviews_id = rd.reviews_id)
                           WHERE r.status = '1'" .
                           (MODULE_SITEMAPXML_REVIEWS_ORDERBY != '' ? "ORDER BY " . MODULE_SITEMAPXML_REVIEWS_ORDERBY : ''));
  $zen_SiteMapXML->SitemapSetMaxItems($reviews->RecordCount());
  while(!$reviews->EOF) {
    $langParm = $zen_SiteMapXML->getLanguageParameter($reviews->fields['language_id']);
    $link = zen_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $reviews->fields['products_id'] . '&reviews_id=' . $reviews->fields['reviews_id'] . $langParm, 'NONSSL', false);
    $zen_SiteMapXML->SitemapWriteItem($link, strtotime($reviews->fields['last_date']), MODULE_SITEMAPXML_REVIEWS_CHANGEFREQ);
    $reviews->MoveNext();
  }
  $zen_SiteMapXML->SitemapClose();
}
