<?php
/**
 * iterates thru media collections/clips
 *
 * @package productTypes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: media_manager.php 3231 2006-03-21 08:28:29Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$zv_collection_query = "select * from " . TABLE_MEDIA_TO_PRODUCTS . "
                        where product_id = '" . (int)$_GET['products_id'] . "'";
$zq_collections = $db->Execute($zv_collection_query);
$zv_product_has_media = false;
if ($zq_collections->RecordCount() > 0) {
  $zv_product_has_media = true;
  while (!$zq_collections->EOF) {
    $zf_media_manager_query = "select * from " . TABLE_MEDIA_MANAGER . "
                               where media_id = '" . (int)$zq_collections->fields['media_id'] . "'";

    $zq_media_manager = $db->Execute($zf_media_manager_query);
    $za_media_manager[$zq_media_manager->fields['media_id']] = array('text' => $zq_media_manager->fields['media_name']);
    if ($zq_media_manager->RecordCount() < 1) {
      $zv_product_has_media = false;
    } else {
      $zv_clips_query = "select * from " . TABLE_MEDIA_CLIPS . "
                         where media_id = '" . (int)$zq_media_manager->fields['media_id'] . "'";

      $zq_clips = $db->Execute($zv_clips_query);
      if ($zq_clips->RecordCount() < 1) {
        $zv_product_has_media = false;
      } else {
        while (!$zq_clips->EOF) {

          $zf_clip_type_query = "select * from " . TABLE_MEDIA_TYPES . "
                                 where type_id = '" . (int)$zq_clips->fields['clip_type'] . "'";

          $zq_clip_type = $db->Execute($zf_clip_type_query);

          $za_media_manager[$zq_media_manager->fields['media_id']]['clips'][$zq_clips->fields['clip_id']] =
                array('clip_filename' => $zq_clips->fields['clip_filename'], 
                      'clip_type' => $zq_clip_type->fields['type_name']);
          $zq_clips->MoveNext();
        }
      }
    }
    $zq_collections->MoveNext();
  }
}
?>