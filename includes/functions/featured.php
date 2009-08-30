<?php
/**
 * featured-products functions
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: featured.php 2618 2005-12-20 00:35:47Z drbyte $
 */

////
// Set the status of a featured product
  function zen_set_featured_status($featured_id, $status) {
    global $db;
    $sql = "update " . TABLE_FEATURED . "
            set status = '" . $status . "', date_status_change = now()
            where featured_id = '" . (int)$featured_id . "'";

    return $db->Execute($sql);
   }

////
// Auto expire products on featured
  function zen_expire_featured() {
    global $db;
    $featured_query = "select featured_id
                       from " . TABLE_FEATURED . "
                       where status = '1'
                       and ((now() >= expires_date and expires_date != '0001-01-01')
                       or (now() < featured_date_available and featured_date_available != '0001-01-01'))";

    $featured = $db->Execute($featured_query);

    if ($featured->RecordCount() > 0) {
      while (!$featured->EOF) {
        zen_set_featured_status($featured->fields['featured_id'], '0');
        $featured->MoveNext();
      }
    }
  }

////
// Auto start products on featured
  function zen_start_featured() {
    global $db;

    $featured_query = "select featured_id
                       from " . TABLE_FEATURED . "
                       where status = '0'
                       and (((featured_date_available <= now() and featured_date_available != '0001-01-01') and (expires_date >= now()))
                       or ((featured_date_available <= now() and featured_date_available != '0001-01-01') and (expires_date = '0001-01-01'))
                       or (featured_date_available = '0001-01-01' and expires_date >= now()))
                       ";

    $featured = $db->Execute($featured_query);

    if ($featured->RecordCount() > 0) {
      while (!$featured->EOF) {
        zen_set_featured_status($featured->fields['featured_id'], '1');
        $featured->MoveNext();
      }
    }

// turn off featured if not active yet
    $featured_query = "select featured_id
                       from " . TABLE_FEATURED . "
                       where status = '1'
                       and (now() < featured_date_available and featured_date_available != '0001-01-01')
                       ";

    $featured = $db->Execute($featured_query);

    if ($featured->RecordCount() > 0) {
      while (!$featured->EOF) {
        zen_set_featured_status($featured->fields['featured_id'], '0');
        $featured->MoveNext();
      }
    }

  }
?>