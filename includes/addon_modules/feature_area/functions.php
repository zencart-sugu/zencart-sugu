<?php
/**
 * feature_area modules functions.php
 *
 * @package functions
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */
// Return the feature name in the needed language
  function feature_area_get_name($feature_id, $language_id) {
    global $db;
    $result = $db->Execute("select name
                                  from " . TABLE_ADDON_MODULES_FEATURE_AREA_INFO . "
                                  where id = '" . (int)$feature_id . "'
                                  and languages_id = '" . (int)$language_id . "'");

    return $result->fields['name'];
  }

// Set the status of a feature
  function zen_set_feature_status($feature_id, $status) {
    global $db;
    if ($status == '1') {
      $sql = "update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
              set status = 1
              where id = '" . (int)$feature_id . "'";

      return $db->Execute($sql);

    } elseif ($status == '0') {
      $sql = "update " . TABLE_ADDON_MODULES_FEATURE_AREA . "
              set status = 0
              where id = '" . (int)$feature_id . "'";

      return $db->Execute($sql);

    } else {
      return -1;
    }
  }

?>
