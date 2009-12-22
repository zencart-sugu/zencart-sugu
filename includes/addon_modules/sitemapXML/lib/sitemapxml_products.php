<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemapxml_products.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

$zen_SiteMapXML->message('<h3>' . TEXT_HEAD_PRODUCTS . '</h3>');
// BOF hideCategories
if (defined('TABLE_HIDE_CATEGORIES')) {
  $from = " LEFT JOIN " . TABLE_HIDE_CATEGORIES . " h ON (p.master_categories_id = h.categories_id)";
  $where = " AND (h.visibility_status < 2 OR h.visibility_status IS NULL)";
} else {
  $from = '';
  $where = '';
}
// EOF hideCategories
$last_date = $db->Execute("SELECT MAX(GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0))) AS last_date
                           FROM " . TABLE_PRODUCTS . " p
                           WHERE p.products_status = '1'");
if ($zen_SiteMapXML->SitemapOpen('products', $last_date->fields['last_date'])) {
  $products = $db->Execute("SELECT p.products_id, GREATEST(p.products_date_added, IFNULL(p.products_last_modified, '0001-01-01 00:00:00')) AS last_date, p.products_sort_order AS priority, pd.language_id
                            FROM " . TABLE_PRODUCTS . " p
                              LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id)" . $from . "
                            WHERE p.products_status = '1'" . $where .
                            (MODULE_SITEMAPXML_PRODUCTS_ORDERBY != '' ? "ORDER BY " . MODULE_SITEMAPXML_PRODUCTS_ORDERBY : ''));
  $zen_SiteMapXML->SitemapSetMaxItems($products->RecordCount());
  while(!$products->EOF) {
    $langParm = $zen_SiteMapXML->getLanguageParameter($products->fields['language_id']);
    $link = zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id'] . $langParm, 'NONSSL', false);
    $zen_SiteMapXML->SitemapWriteItem($link, strtotime($products->fields['last_date']), MODULE_SITEMAPXML_PRODUCTS_CHANGEFREQ);
    $products->MoveNext();
  }
  $zen_SiteMapXML->SitemapClose();
}
