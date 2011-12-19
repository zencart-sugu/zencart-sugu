<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class easy_admin_products_attribute_model {
  var $display = array(
    'products_attributes_id'      => 'nowrap',
    'products_options_name'       => 'wrap',
    'products_options_values_name' => '',
    'products_display_price'      => 'align="right"',
    'products_attributes_display_weight' => 'align="right"',
    'products_options_sort_order' => 'align="right"',
    'products_status'             => 'align="center"',
    'attributes_display_price_final' => '',
  );

  var $columns = array(
    'pa.products_attributes_id',
    'po.products_options_name',
    'pov.products_options_values_name',
    'pa.products_display_price',
    'pa.products_attributes_display_weight',
    'pa.products_options_sort_order',
    'pa.status',
    'pa.attributes_display_price_final',
  );

  var $order   = array('p.products_sort_order',
                       'pd.products_name');

  var $statuses = array(
    'attributes_display_only' => array(
      'color' => 'yellow',
      'alt' => LEGEND_ATTRIBUTES_DISPLAY_ONLY,
    ),
    'product_attribute_is_free' => array(
      'color' => 'blue',
      'alt' => LEGEND_ATTRIBUTES_IS_FREE,
    ),
    'attributes_default' => array(
      'color' => 'orange',
      'alt' => LEGEND_ATTRIBUTES_DEFAULT,
    ),
    'attributes_discounted' => array(
      'color' => 'pink',
      'alt' => LEGEND_ATTRIBUTE_IS_DISCOUNTED,
    ),
    'attributes_price_base_included' => array(
      'color' => 'purple',
      'alt' => LEGEND_ATTRIBUTE_PRICE_BASE_INCLUDED,
    ),
    'attributes_required' => array(
      'color' => 'red',
      'alt' => LEGEND_ATTRIBUTES_REQUIRED,
    ),
  );

  // 商品検索のsql生成
  function get_products_attributes_query($products_id) {
    global $zco_notifier;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_BEFORE_SEARCH');

    $query = "SELECT pa.*,
                     po.products_options_name,
                     pov.products_options_values_name
              FROM ". TABLE_PRODUCTS_ATTRIBUTES . " pa
              LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po
                 ON pa.options_id = po.products_options_id
                AND po.language_id = '" . (int)$_SESSION['languages_id'] . "'
              LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov
                 ON pa.options_values_id = pov.products_options_values_id
                AND pov.language_id = '" . (int)$_SESSION['languages_id'] . "'
              WHERE pa.products_id = '" . (int)$products_id . "'
              ORDER BY LPAD(po.products_options_sort_order,11,'0'),
                       LPAD(pa.products_options_sort_order,11,'0')";

    return $query;
  }

  // 検索された各商品属性の情報を追加、変更する
  function convert_product_attributes_result($attributes_values, $load_option_name = true, $can_operate = false) {
    if ($load_option_name) {
      $attributes_values->fields['products_options_name'] = zen_options_name($attributes_values->fields['options_id']);
      $attributes_values->fields['products_options_values_name'] = zen_values_name($attributes_values->fields['options_values_id']);
    }
    $attributes_values->fields['products_display_price'] = $attributes_values->fields['price_prefix'] . $attributes_values->fields['options_values_price'];
    $attributes_values->fields['products_attributes_display_weight'] = $attributes_values->fields['products_attributes_weight_prefix'] . $attributes_values->fields['products_attributes_weight'];

    require_once(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
    $attributes_price_final = zen_get_attributes_price_final($attributes_values->fields["products_attributes_id"], 1, $attributes_values, 'false');
    $attributes_price_final_value = $attributes_price_final;
    $attributes_price_final = $currencies->display_price($attributes_price_final, zen_get_tax_rate(1), 1);
    $attributes_price_final_onetime = zen_get_attributes_price_final_onetime($attributes_values->fields["products_attributes_id"], 1, $attributes_values);
    $attributes_price_final_onetime = $currencies->display_price($attributes_price_final_onetime, zen_get_tax_rate(1), 1);
    $new_attributes_price= '';
    if ($attributes_values->fields["attributes_discounted"]) {
      $new_attributes_price = zen_get_attributes_price_final($attributes_values->fields["products_attributes_id"], 1, '', 'false');
      $new_attributes_price = zen_get_discount_calc($attributes_values->fields['products_id'], true, $new_attributes_price);
      if ($new_attributes_price != $attributes_price_final_value) {
        $new_attributes_price = '|' . $currencies->display_price($new_attributes_price, zen_get_tax_rate(1), 1);
      } else {
        $new_attributes_price = '';
      }
    }
    $attributes_values->fields['attributes_display_price_final'] = $attributes_price_final . $new_attributes_price . ' ' . $attributes_price_final_onetime;

    // status
    $attributes_values->fields['products_status'] = "";
    foreach ($this->statuses as $type => $icon_info) {
      $attributes_values->fields['products_status'] .= self::make_status_link($attributes_values->fields, $type, $icon_info['color'], $icon_info['alt'], $can_operate); 
    }

    return $attributes_values->fields;
  }

  function make_status_link($fields, $type, $color, $alt="", $can_operate) {
    $image_name = sprintf("icon_%s_%s.gif", $color, ($fields[$type] == 0 ? "off" : "on"));
    if ($can_operate) {
      $parm = array(
              "products_id"   => $fields['products_id'],
              "attributes_id" => $fields['products_attributes_id'],
              "action"        => ($fields[$type] == 0 ? 'status_on' : 'status_off'),
              "type"          => $type,
              "page"          => $page,
            );
      $image =  easy_admin_products_html::input_image($image_name, $alt);
      return '<a href="'.easy_admin_products_html::href_link("attributes", $parm).'">'.$image.'</a>';
    }else{
      return easy_admin_products_html::image($image_name, $alt);
    }
  }

  // ステータス変更
  function change_status($products_id, $attributes_id, $type, $on) {
    global $db;

    if (array_key_exists($type, $this->statuses)) {
      return $db->Execute("
        update ".TABLE_PRODUCTS_ATTRIBUTES." 
           set ". $type ."=".(int)$on."
         where products_id=".(int)$products_id ."
           and products_attributes_id=". (int)$attributes_id);
    }else{
      return false;
    }
  }

  // attribute情報構築
  function new_attribute($columns, $products_id) {
    $atrribute = array();
    foreach($columns['attributes_column'] as $k => $v) {
      $attribute[$k] = $v;
    }
    // set defaults by configration
    $attribute['attribute_is_free'] = zen_get_show_product_switch($products_id, 'ATTRIBUTE_IS_FREE', 'DEFAULT_', '');
    $attribute['attributes_display_only'] = zen_get_show_product_switch($products_id, 'ATTRIBUTES_DISPLAY_ONLY', 'DEFAULT_', '');
    $attribute['attributes_default'] = zen_get_show_product_switch($products_id, 'ATTRIBUTES_DEFAULT', 'DEFAULT_', '');
    $attribute['attributes_discounted'] = zen_get_show_product_switch($products_id, 'ATTRIBUTES_DISCOUNTED', 'DEFAULT_', '');
    $attribute['attributes_price_base_included'] = zen_get_show_product_switch($products_id, 'ATTRIBUTES_PRICE_BASE_INCLUDED', 'DEFAULT_', '');
    $attribute['attributes_required'] = zen_get_show_product_switch($products_id, 'ATTRIBUTES_REQUIRED', 'DEFAULT_', '');
    $default_price_prefix = zen_get_show_product_switch($products_id, 'PRICE_PREFIX', 'DEFAULT_', '');
    $attribute['price_prefix'] = ($default_price_prefix == 1 ? '+' : ($default_price_prefix == 2 ? '-' : ''));
    $default_products_attributes_weight_prefix  = zen_get_show_product_switch($products_id, 'PRODUCTS_ATTRIBUTES_WEIGHT_PREFIX', 'DEFAULT_', '');
    $attribute['products_attributes_weight_prefix'] = ($default_products_attributes_weight_prefix  == 1 ? '+' : ($default_products_attributes_weight_prefix == 2 ? '-' : ''));

    return $attribute;
  }

  // チェック
  function validate_save($post) {
    global $db;

    $errors = array();

    // check for duplicate and block them
    $query =  "select * from " . TABLE_PRODUCTS_ATTRIBUTES . "
                where products_id ='" . $post['products_id'] . "'
                  and options_id = '" . $post['options_id'] . "'
                  and options_values_id = '" . $post['options_values_id'] . "'";
    if ($post['attributes_id']) {
      $query .= " and products_attributes_id != '". $post['attributes_id'] ."'";
    }
    $check_duplicate = $db->Execute($query);
    if ($check_duplicate->RecordCount() > 0) {
      $errors[] = ATTRIBUTE_WARNING_DUPLICATE . ' - ' . zen_options_name($post['options_id']) . ' : ' . zen_values_name($post['options_values_id']);
    }else{
      // Validate options_id and options_value_id
      if (!zen_validate_options_to_options_value($post['options_id'], $post['options_values_id'])) {
        // do not add invalid match
        $errors[] = ATTRIBUTE_WARNING_INVALID_MATCH . ' - ' . zen_options_name($post['options_id']) . ' : ' . zen_values_name($post['options_values_id']);
      }
    }

    return $errors;
  }

  // 取得
  function load_attribute($columns, $products_id, $attributes_id) {
    global $db;

    // デフォルト設定
    $attribute = self::new_attribute($columns, $products_id);

    // attributes
    $query = "SELECT *
              FROM ". TABLE_PRODUCTS_ATTRIBUTES . "
              WHERE products_id = '" . (int)$products_id . "'
                AND products_attributes_id = '" . (int)$attributes_id . "'";
    $result = $db->Execute($query);
    if (!$result->EOF) {
      $converted_fields = self::convert_product_attributes_result($result); 
      foreach($columns['attributes_column'] as $k => $v) {
        if (isset($converted_fields[$k]))
          $attribute[$k] = $converted_fields[$k];
      }
      // download setting
      if (DOWNLOAD_ENABLED == 'true') {
        $query = "SELECT *
                  FROM ". TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD ."
                  WHERE products_attributes_id='". (int)$attributes_id . "'";
        $download = $db->Execute($query);
        if ($download->RecordCount() > 0) {
          $attribute['products_attributes_filename'] = $download->fields['products_attributes_filename'];
          $attribute['products_attributes_maxdays'] = $download->fields['products_attributes_maxdays'];
          $attribute['products_attributes_maxcount'] = $download->fields['products_attributes_maxcount'];
        }
      }
    }

    return $attribute;
  }

  function load_attributes_by_options_id($columns, $products_id, $options_id) {
    global $db;

    $attributes = array();
    $query = "SELECT *
              FROM ". TABLE_PRODUCTS_ATTRIBUTES ."
              WHERE products_id = '". (int)$products_id ."'
                AND options_id = '". (int)$options_id . "'";
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $attribute = array();
      $converted_fields = self::convert_product_attributes_result($result); 
      foreach($columns['attributes_column'] as $k => $v) {
        if (isset($converted_fields[$k]))
          $attribute[$k] = $converted_fields[$k];
      }
      $attributes[] = $attribute;
      $result->MoveNext();
    }
    return $attributes;
  }

  // 保存
  function save_attribute($attribute) {
    global $db;
    global $sql_data_array;
    global $language_id;
    global $zco_notifier;
    global $attribute_save;
    global $products_id;
    global $attributes_id;

    $products_id       = (int)$attribute['products_id'];
    $attributes_id     = (int)$attribute['attributes_id'];
    $insert_attributes = ($attributes_id == 0);

    $save_columns = array(
      'products_id',
      'options_id',
      'options_values_id',
      'price_prefix',
      'options_values_price',
      'products_attributes_weight_prefix',
      'products_attributes_weight',
      'products_options_sort_order',
      'attributes_display_only',
      'product_attribute_is_free',
      'attributes_default',
      'attributes_discounted',
      'attributes_image',
      'attributes_price_base_included',
      'attributes_required',
      'attributes_price_onetime',
      'attributes_price_factor',
      'attributes_price_factor_offset',
      'attributes_price_factor_onetime',
      'attributes_price_factor_onetime_offset',
      'attributes_qty_prices',
      'attributes_qty_prices_onetime',
      'attributes_price_words',
      'attributes_price_words_free',
      'attributes_price_letters',
      'attributes_price_letters_free',
    );

    $sql_data_array = array();
    foreach ($save_columns as $column) {
      $sql_data_array[$column] = zen_db_input($attribute[$column]);
    }

    $attribute_save = $attribute;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_BEFORE_SAVE_PRODUCTS');

    if ($insert_attributes) {
      zen_db_perform(TABLE_PRODUCTS_ATTRIBUTES, $sql_data_array);
      $attributes_id = zen_db_insert_id();
    }
    else {
      zen_db_perform(TABLE_PRODUCTS_ATTRIBUTES, $sql_data_array, 'update', "products_attributes_id=".(int)$attributes_id);
    }

    // save download setting
    if (DOWNLOAD_ENABLED == 'true') {
      $products_attributes_filename = zen_db_prepare_input($attribute['products_attributes_filename']);
      $products_attributes_maxdays = zen_db_prepare_input($attribute['products_attributes_maxdays']);
      $products_attributes_maxcount = zen_db_prepare_input($attribute['products_attributes_maxcount']);

      if (zen_not_null($products_attributes_filename)) {
        $db->Execute("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . "
                      set products_attributes_id = '" . (int)$attributes_id . "',
                          products_attributes_filename = '" . zen_db_input($products_attributes_filename) . "',
                          products_attributes_maxdays = '" . zen_db_input($products_attributes_maxdays) . "',
                          products_attributes_maxcount = '" . zen_db_input($products_attributes_maxcount) . "'");
      }
    }

    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_SAVE');
    if ($insert_attributes) {
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_INSERT');
    }

    return $attributes_id;
  }

  function upload($name, $img_dir, $overwrite, &$image_name) {
    $image = new upload($name);
    $image->set_output_messages('direct');
    $image->set_destination(DIR_FS_CATALOG_IMAGES . $img_dir);
    if ($image->parse() && $image->save($overwrite)) {
      $image_name = $img_dir . $image->filename;
      return true;
    } else {
      return false;
    }
  }

  // 削除
  function delete_attribute($attributes_id) {
    global $db;

    $db->Execute("delete from ". TABLE_PRODUCTS_ATTRIBUTES ."
                   where products_attributes_id=".(int)$attributes_id);
    $db->Execute("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . "
                   where products_attributes_id=".(int)$attributes_id);
  }

  // 削除
  function delete_attributes_by_options_id($products_id, $options_id) {
    global $db;

    $result = $db->Execute(
      "select * from " . TABLE_PRODUCTS_ATTRIBUTES . " 
       where products_id='" . $products_id . "' 
         and options_id='" . $options_id . "'");
    while (!$result->EOF) {
      self::delete_attribute($result->fields['products_attributes_id']);
      $result->MoveNext();
    }
  }

  function get_products_options() {
    global $db;

    $options = array();
    $query  = "SELECT po.*, pot.products_options_types_name
               FROM " . TABLE_PRODUCTS_OPTIONS . " AS po
               LEFT JOIN ". TABLE_PRODUCTS_OPTIONS_TYPES ." pot
                 ON po.products_options_type = pot.products_options_types_id
                where po.language_id = '" . $_SESSION['languages_id'] . "' 
                  and products_options_name != ''
                order by products_options_name";
    $results = $db->Execute($query);
    while (!$results->EOF) {
      $options[] = array(
        "id" => $results->fields['products_options_id'],
        "option_name" => $results->fields['products_options_name'],
        "type" => $results->fields['products_options_type'],
        "type_name" => $results->fields['products_options_types_name'],
        "text" => $results->fields['products_options_name'] .'&nbsp;&nbsp;&nbsp;[' . $results->fields['products_options_types_name'] .']',	// for dropdown
      );
      $results->MoveNext();
    }
    return $options;
  }

  function get_options_values($options_id) {
    global $db;

    $query = "SELECT distinct pov.*
              FROM ". TABLE_PRODUCTS_OPTIONS_VALUES ." AS pov
              LEFT JOIN ". TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " AS pov2po
                ON pov.products_options_values_id = pov2po.products_options_values_id
              WHERE pov.language_id = '". $_SESSION['languages_id'] . "'
                AND pov2po.products_options_id = '". (int)$options_id ."'
               ORDER BY pov.products_options_values_sort_order";
    $results = $db->Execute($query);
    return $results;
  }

  function get_options_type($options_id) {
    global $db;

    $results = $db->Execute("select products_options_type from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $options_id . "'");
    return $results->fields['products_options_type'];
  }

  function is_require_option_value($type) {
    return ($type != PRODUCTS_OPTIONS_TYPE_TEXT &&
            $type != PRODUCTS_OPTIONS_TYPE_FILE); 
  }

  function toJSON($data) {
    if (function_exists('json_encode'))
      return json_encode($data);
    require_once('Zend/Json/Encoder.php');
    return Zend_Json_Encoder::encode($data);
  }
}
?>
