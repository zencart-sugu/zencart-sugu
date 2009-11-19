<?php
/**
 * zaikorobot functions
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zaikorobot.php 2967 2006-02-04 03:08:54Z ajeh $
 */

function zaikorobot_add_mail_log($to, $subject, $text, $from) {
  // ログ機能が有効な場合のみ
  if (ZAIKOROBOT_LOG != "true")
    return;

  $sql_data_array = array(
    "from_zaikorobot" => "",
    "to_zaikorobot"   => "To:".$to."\n".
                         "From:".$from."\n".
                         "Subject:".$subject."\n".
                         "Text:".$text,
    "date_added"      => "now()",
  );
  zen_db_perform(FILENAME_ZAIKOROBOT_LOGS, $sql_data_array);
}

function zaikorobot_add_post_log($post, $server) {
  // ログ機能が有効な場合のみ
  if (ZAIKOROBOT_LOG != "true")
    return;

  $sql_data_array = array(
//    "from_zaikorobot" => serialize($post)."\n".
//                         serialize($server),
    "from_zaikorobot" => print_r($post,   true)."\n".
                         print_r($server, true),
    "to_zaikorobot"   => "",
    "date_added"      => "now()",
  );
  zen_db_perform(FILENAME_ZAIKOROBOT_LOGS, $sql_data_array);
}

// products_idとオプションによるSKU型番の取得
// $attributes[] = array('option_id' => ###,
//                       'value_id'  => ###);
function zaikorobot_get_skumodel($products_id, $model, $attributes) {
  global $db;

  if (MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS == 'true') {
    // SKU型番に対応
    $products_attributes_ids = array();
    for ($i=0; $i<count($attributes); $i++) {
      // products_attributes_idを収集
      $sql = "select products_attributes_id
              from ".TABLE_PRODUCTS_ATTRIBUTES."
              where products_id      =".(int)$products_id."
                and options_id       =".(int)$attributes[$i]['option_id']."
                and options_values_id=".(int)$attributes[$i]['value_id'];
      $result = $db->Execute($sql);
      if (!$result->EOF)
        $products_attributes_ids[] = $result->fields['products_attributes_id'];
    }
    sort($products_attributes_ids);
    if (count($products_attributes_ids) > 0) {
      $sql = "select skumodel
              from ".TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK."
              where products_id     =".(int)$products_id."
                and stock_attributes='".implode(",", $products_attributes_ids)."'";
      $result = $db->Execute($sql);
      if (!$result->EOF)
        $model = $result->fields['skumodel'];
    }
  }

  return $model;
}
?>
