<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemapxml_categories.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

$zen_SiteMapXML->message('<h3>' . TEXT_HEAD_CATEGORIES . '</h3>');
// BOF hideCategories
if (defined('TABLE_HIDE_CATEGORIES')) {
  $from = " LEFT JOIN " . TABLE_HIDE_CATEGORIES . " h ON (c.categories_id = h.categories_id)";
  $where = " AND (h.visibility_status < 2 OR h.visibility_status IS NULL)";
} else {
  $from = '';
  $where = '';
}
// EOF hideCategories
$last_date = $db->Execute("SELECT MAX(GREATEST(c.date_added, IFNULL(c.last_modified, 0))) AS last_date
                           FROM " . TABLE_CATEGORIES . " c
                           WHERE c.categories_status = '1'");
if ($zen_SiteMapXML->SitemapOpen('categories', $last_date->fields['last_date'])) {
    $categories = $db->Execute("SELECT c.categories_id, GREATEST(c.date_added, IFNULL(c.last_modified, '0001-01-01 00:00:00')) AS last_date, c.sort_order AS priority, cd.language_id
                              FROM " . TABLE_CATEGORIES . " c
                                LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd ON (cd.categories_id = c.categories_id)" . $from . "
                              WHERE c.categories_status = '1'" . $where .
                              (MODULE_SITEMAPXML_CATEGORIES_ORDERBY != '' ? "ORDER BY " . MODULE_SITEMAPXML_CATEGORIES_ORDERBY : ''));
  $zen_SiteMapXML->SitemapSetMaxItems($categories->RecordCount());
  while(!$categories->EOF) {
    if (SKIP_SINGLE_PRODUCT_CATEGORIES=='True') {
      $products = $db->Execute("SELECT COUNT(*) AS total
                                FROM " . TABLE_PRODUCTS . " p
                                  LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c ON (p.products_id = p2c.products_id)
                                WHERE p.products_status = '1'
                                  AND p2c.categories_id = '" . (int)$categories->fields['categories_id'] . "'");
    } else {
      $products->fields['total'] = 2;
    }
    if ($products->fields['total'] != 1) {
      $langParm = $zen_SiteMapXML->getLanguageParameter($categories->fields['language_id']);
      $link = zen_href_link(FILENAME_DEFAULT, 'cPath=' . $zen_SiteMapXML->GetFullcPath($categories->fields['categories_id']) . $langParm, 'NONSSL', false);
      $zen_SiteMapXML->SitemapWriteItem($link, strtotime($categories->fields['last_date']), MODULE_SITEMAPXML_CATEGORIES_CHANGEFREQ);
    }
    $categories->MoveNext();
  }
  $zen_SiteMapXML->SitemapClose();
}
