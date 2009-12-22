<?php
/**
* Sitemap XML
*
* @package Sitemap XML
* @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
* @copyright Portions Copyright 2003-2008 Zen Cart Development Team
* @copyright Portions Copyright 2003 osCommerce
* @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
* @version $Id: sitemapxml_ezpages.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
*/

$zen_SiteMapXML->message('<h3>' . TEXT_HEAD_EZPAGES . '</h3>');
$select = '';
$from = '';
$where = '';
$order_by = '';
if (MODULE_SITEMAPXML_EZPAGES_ORDERBY != '') {
  $order_by = MODULE_SITEMAPXML_EZPAGES_ORDERBY;
}
$page_date_added = $db->Execute("SHOW COLUMNS
                                 FROM " . TABLE_EZPAGES . "
                                 LIKE 'date_added'");
$page_last_modified = $db->Execute("SHOW COLUMNS
                                    FROM " . TABLE_EZPAGES . "
                                    LIKE 'last_modified'");
$page_nofollow = $db->Execute("SHOW COLUMNS
                               FROM " . TABLE_EZPAGES . "
                               LIKE 'status_rel_nofollow'");
if (!$page_nofollow->EOF) {
  $where .= " AND status_rel_nofollow=0";
}
if (defined('TABLE_EZPAGES_TEXT')) {
  $from = " LEFT JOIN " . TABLE_EZPAGES_TEXT . " pt ON (p.pages_id = pt.pages_id)";
}
if (!$page_date_added->EOF && !$page_last_modified->EOF) {
    $select .= ", GREATEST(IFNULL(p.date_added, '0001-01-01 00:00:00'), IFNULL(p.last_modified, '0001-01-01 00:00:00')) AS last_date";
  if ($order_by != '') {
    $order_by .= ", ";
  }
  $order_by .= "last_date DESC";
    $last_date = $db->Execute("SELECT MAX(GREATEST(IFNULL(p.date_added, '0001-01-01 00:00:00'), IFNULL(p.last_modified, '0001-01-01 00:00:00'))) AS last_date
                             FROM " . TABLE_EZPAGES . " p " . $from . "
                            WHERE alt_url_external = ''" . $where);
  $last_date = $last_date->fields['last_date'];
} else {
  $last_date = 0;
}
if ($zen_SiteMapXML->SitemapOpen('ezpages', $last_date)) {
  $page_query = $db->Execute("SELECT p.toc_chapter
                              FROM " . TABLE_EZPAGES . " p " . $from . "
                              WHERE alt_url_external = ''
                                AND (   (status_header = 1 AND header_sort_order > 0)
                                     OR (status_sidebox = 1 AND sidebox_sort_order > 0)
                                     OR (status_footer = 1 AND footer_sort_order > 0)
                                     )
                                AND status_toc != 0" . $where . "
                              GROUP BY toc_chapter"); // pages_id
  $toc_chapter_array = array();
  while (!$page_query->EOF) {
//echo '<pre>';var_export($page_query->fields);echo '</pre>';
    $toc_chapter_array[$page_query->fields['toc_chapter']] = $page_query->fields['toc_chapter'];
    $page_query->MoveNext();
  }
  if (sizeof($toc_chapter_array) > 0) {
    $where_toc = " OR toc_chapter IN (" . implode(',', $toc_chapter_array) . ")";
  } else {
    $where_toc = '';
  }
  $page_query = $db->Execute("SELECT *" . $select . "
                              FROM " . TABLE_EZPAGES . " p " . $from . "
                              WHERE alt_url_external = ''
                                AND (   (status_header = 1 AND header_sort_order > 0)
                                     OR (status_sidebox = 1 AND sidebox_sort_order > 0)
                                     OR (status_footer = 1 AND footer_sort_order > 0)
                                     " . $where_toc . "
                                     )" . $where .
                              ($order_by != '' ? " ORDER BY " . $order_by : ''));
  $zen_SiteMapXML->SitemapSetMaxItems($page_query->RecordCount());
  while (!$page_query->EOF) {
    $page_query->fields['language_id'] = (isset($page_query->fields['language_id']) ? $page_query->fields['language_id'] : DEFAULT_LANGUAGE);
    $langParm = $zen_SiteMapXML->getLanguageParameter($page_query->fields['language_id']);
    if ($page_query->fields['alt_url'] != '') { // internal link
      if ($langParm != '') {
        $langParm = (strpos($page_query->fields['alt_url'], '?') === false ? '?' . ltrim('&', $langParm) : $langParm);
      }
      $link = (substr($page_query->fields['alt_url'],0,4) == 'http') ?
              $page_query->fields['alt_url'] :
              zen_href_link($page_query->fields['alt_url'] . $langParm, '', ($page_query->fields['page_is_ssl']=='0' ? 'NONSSL' : 'SSL'), false, true, true);
      $parse_url = parse_url($link);
      if (!isset($parse_url['path'])) $parse_url['path'] = '/';
      $link_base_url = $parse_url['scheme'] . '://' . $parse_url['host'] . str_replace('\\', '/', dirname($parse_url['path']));
      if ($link_base_url != $zen_SiteMapXML->base_url) {
        $zen_SiteMapXML->message(sprintf(TEXT_ERRROR_EZPAGES_OUTOFBASE, $page_query->fields['alt_url'], $link) . '<br />', 'error');
        $link = false;
      } else {
        if (basename($parse_url['path']) == 'index.php') {
          $query_string = explode('&', str_replace('&amp;', '&', $parse_url['query']));
          foreach($query_string as $query) {
            list($parm_name, $parm_value) = explode('=', $query);
            if ($parm_name == 'main_page') {
              if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($parm_value, explode(",", constant('ROBOTS_PAGES_TO_SKIP'))) || $parm_value == 'down_for_maintenance') {
                $zen_SiteMapXML->message(sprintf(TEXT_ERRROR_EZPAGES_ROBOTS, $page_query->fields['alt_url'], $link) . '<br />', 'error');
                $link = false;
                break;
              }
            }
          }
        }
      }
//$zen_SiteMapXML->checkHTTPcode($link);
    } else { // use EZPage ID to create link
      $link = zen_href_link(FILENAME_EZPAGES, 'id=' . $page_query->fields['pages_id'] . ((int)$page_query->fields['toc_chapter'] != 0 ? '&chapter=' . $page_query->fields['toc_chapter'] : '') . $langParm, ($page_query->fields['page_is_ssl']=='0' ? 'NONSSL' : 'SSL'), false);
    }
    if ($link != false) {
      if (isset($page_query->fields['last_date']) && $page_query->fields['last_date'] != null) {
        $last_date = strtotime($page_query->fields['last_date']);
      } else {
        $last_date = '';
      }
      $zen_SiteMapXML->SitemapWriteItem($link, $last_date, MODULE_SITEMAPXML_EZPAGES_CHANGEFREQ);
    }
    $page_query->MoveNext();
  }
  $zen_SiteMapXML->SitemapClose();
}
