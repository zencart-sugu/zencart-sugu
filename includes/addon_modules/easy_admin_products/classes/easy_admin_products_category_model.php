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

class easy_admin_products_category_model {

  var $subcategories_counts = array();

  // 全カテゴリ直下のサブカテゴリ数を取得
  function get_subcategories_counts() {
    global $db;

    if (empty($this->subcategories_counts)) {
      $query = "SELECT parent_id, COUNT(*) AS count
              FROM ". TABLE_CATEGORIES ."
              GROUP BY parent_id";
      $results = $db->Execute($query);
      while (!$results->EOF) {
        $id = $results->fields['parent_id'];
        $this->subcategories_counts[$id] = $results->fields['count'];
        $results->MoveNext();
      }
    }
    return $this->subcategories_counts;
  }

  // 検索された各カテゴリの情報を追加、変更する
  function convert_categories_result($categories_values, $action = 'index') {

    $categories_id = $categories_values->fields['categories_id'];

    // link_to_categories
    $parm = array(
      'category_id' => $categories_id,
    );
    $link = easy_admin_products_html::href_link("categories", $parm);
    if ($action == 'search') {
      $categories_values->fields['link_to_categories'] = easy_admin_products_model::get_category($categories_id, $link);
    }else{
      $categories_values->fields['link_to_categories'] = '<a href="'.$link.'">'. zen_output_string_protected($categories_values->fields['categories_name']) .'</a>';
      // subcategories_count
      $subcategories_counts = self::get_subcategories_counts();
      $categories_values->fields['subcategories_count'] = (int)$subcategories_counts[$categories_id];
    }


    // link_to_products
    $parm = array(
      'category_id' => $categories_id,
    );
    $categories_values->fields['link_to_products'] = easy_admin_products_html::href_link("", $parm);

    // link_to_status
    $parm = array(
      'action'      => 'setflag',
      'cID'         => $categories_id,
      'flag'        => ($categories_values->fields['categories_status'] == '1' ? 0 : 1),
    );
    $parm = self::add_current_parm($parm);
    $categories_values->fields['link_to_status'] = easy_admin_products_html::href_link("categories", $parm);

    $categories_values->fields['is_link'] = (zen_get_products_to_categories($categories_id, true, 'products_active') == 'true');

    return $categories_values->fields;
  }

  // ステータス変更
  function change_status($categories_id, $status, $set_products_status) {
    global $db;

    // disable category and products including subcategories
    $categories_id = zen_db_prepare_input($categories_id);

    $categories = zen_get_category_tree($categories_id, '', '0', '', true);

    for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
      $product_ids = $db->Execute("select products_id
                                     from " . TABLE_PRODUCTS_TO_CATEGORIES . "
                                     where categories_id = '" . (int)$categories[$i]['id'] . "'");

      while (!$product_ids->EOF) {
        $products[$product_ids->fields['products_id']]['categories'][] = $categories[$i]['id'];
        $product_ids->MoveNext();
      }
    }

    // change the status of categories and products
    zen_set_time_limit(600);
    for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
      if ($status == '1') {
        $categories_status = '0';
        $products_status = '0';
      } else {
        $categories_status = '1';
        $products_status = '1';
      }

      $sql = "update " . TABLE_CATEGORIES . " set categories_status='" . $categories_status . "'
              where categories_id='" . $categories[$i]['id'] . "'";
      $db->Execute($sql);

      // set products_status based on selection
      if ($set_products_status == 'set_products_status_nochange') {
        // do not change current product status
      } else {
        if ($set_products_status == 'set_products_status_on') {
          $products_status = '1';
        } else {
          $products_status = '0';
        }

        $sql = "select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id='" . $categories[$i]['id'] . "'";
        $category_products = $db->Execute($sql);

        while (!$category_products->EOF) {
          $sql = "update " . TABLE_PRODUCTS . " set products_status='" . $products_status . "' where products_id='" . $category_products->fields['products_id'] . "'";
          $db->Execute($sql);
          $category_products->MoveNext();
        }
      }
    } // for
    return true;
  }

  // category情報構築
  function new_category($columns) {
    $category = array();
    foreach($columns['categories_column'] as $k => $v) {
      $category[$k] = $v;
    }
    foreach($columns['languages'] as $v) {
      $language_id          = $v['id'];
      // description
      foreach($columns['categories_description_column'] as $k => $v) {
        if ($k != "language_id") {
          if (!isset($category['categories_description_'.$k]))
            $category['categories_description_'.$k] = array();
          $category['categories_description_'.$k][$language_id] = $v;
        }
      }
      // meta_tags
      foreach($columns['meta_tags_categories_description_column'] as $k => $v) {
        if ($k != "language_id") {
          if (!isset($category['meta_tags_categories_description_'.$k]))
            $category['meta_tags_categories_description_'.$k] = array();
          $category['meta_tags_categories_description_'.$k][$language_id] = $v;
        }
      }
    }
    return $category;
  }

  // 取得
  function load_category($columns, $categories_id) {
    global $db;

    // デフォルト設定
    $category = self::new_category($columns);

    // categories
    $column = array();
    foreach($columns['categories_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_CATEGORIES." where categories_id=".(int)$categories_id;
    $result = $db->Execute($query);
    if (!$result->EOF) {
      foreach($columns['categories_column'] as $k => $v) {
        if (isset($result->fields[$k]))
          $category[$k] = $result->fields[$k];
      }
    }

    // categories_description
    $column = array();
    foreach($columns['categories_description_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_CATEGORIES_DESCRIPTION." where categories_id=".(int)$categories_id;
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $language_id = $result->fields['language_id'];
      foreach($columns['categories_description_column'] as $k => $v) {
        if (isset($result->fields[$k]))
          $category['categories_description_'.$k][$language_id] = $result->fields[$k];
      }
      $result->MoveNext();
    }

    // meta_tags_categories_description
    $category['not_null_metatags'] = false;
    $column = array();
    foreach($columns['meta_tags_categories_description_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_METATAGS_CATEGORIES_DESCRIPTION." where categories_id=".(int)$categories_id;
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $language_id = $result->fields['language_id'];
      foreach($columns['meta_tags_categories_description_column'] as $k => $v) {
        if (isset($result->fields[$k])) {
          $category['meta_tags_categories_description_'.$k][$language_id] = $result->fields[$k];
          if ($k != 'language_id' && zen_not_null($result->fields[$k])) {
            $category['not_null_metatags'] = true;
          }
        }
      }
      $result->MoveNext();
    }

    return $category;
  }

  // チェック
  function validate_save($post) {
    global $db;

    $errors = array();

    return $errors;
  }

  // 保存
  function save_category($category) {
    global $db;
    global $sql_data_array;
    global $language_id;
    global $zco_notifier;
    global $category_save;

    $categories_id     = (int)$category['cID'];
    $insert_categories = ($categories_id == 0);

    // save categories
    $save_columns = array(
      'sort_order',
    );

    // upload image
    if ($categories_image = new upload('categories_image')) {
      $categories_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
      if ($categories_image->parse() && $categories_image->save()) {
        $category['categories_image'] = $_POST['img_dir'] . $categories_image->filename;
      }
      if ($categories_image->filename == 'none') {
        $category['categories_image'] = '';
      }
      if ($categories_image->filename != '') {
        $save_columns[] = 'categories_image';
      }
    }

    $sql_data_array = array();
    foreach ($save_columns as $column) {
      $sql_data_array[$column] = zen_db_input($category[$column]);
    }

    $category_save = $category;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_BEFORE_SAVE_PRODUCTS');

    if ($insert_categories) {
      $sql_data_array['parent_id'] = zen_db_input($category['parent_id']);
      $sql_data_array['date_added'] = 'now()';
      zen_db_perform(TABLE_CATEGORIES, $sql_data_array);
      $categories_id = zen_db_insert_id();

      // save product_types_to_category
      $product_type_id = self::get_product_type_id('product');	//Product - General
      $insert_sql_data = array('category_id' => $categories_id,
                               'product_type_id' => $product_type_id);
      zen_db_perform(TABLE_PRODUCT_TYPES_TO_CATEGORY, $insert_sql_data);
    }
    else {
      $sql_data_array['last_modified'] = 'now()';
      zen_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update', "categories_id=".(int)$categories_id);
    }

    // save categories_description
    foreach($category['categories_description_categories_name'] as $k => $v) {
      $sql_data_array = array(
        'categories_id'        => $categories_id,
        'language_id'          => $k,
        'categories_name'      => $category['categories_description_categories_name'][$k],
        'categories_description' => $category['categories_description_categories_description'][$k],
      );
      $language_id = $k;
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_CATEGORIES_DESCRIPTION');

      if ($insert_categories) {
        zen_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
      }
      else {
        zen_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', "categories_id=".(int)$categories_id." and language_id=".$k);
      }
    }

    // save meta_tags_categories_description
    foreach($category['meta_tags_categories_description_metatags_title'] as $k => $v) {
      $sql_data_array = array(
        'categories_id'        => $categories_id,
        'language_id'          => $k,
        'metatags_title'       => $category['meta_tags_categories_description_metatags_title'][$k],
        'metatags_keywords'    => $category['meta_tags_categories_description_metatags_keywords'][$k],
        'metatags_description' => $category['meta_tags_categories_description_metatags_description'][$k],
      );
      $language_id = $k;
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_META_TAGS_CATEGORIES_DESCRIPTION');

      $check = $db->Execute("select * 
                             from ". TABLE_METATAGS_CATEGORIES_DESCRIPTION ."
                             where categories_id=". (int)$categories_id ."
                             and language_id=". (int)$k);
      if ($check->RecordCount() == 0) {
        zen_db_perform(TABLE_METATAGS_CATEGORIES_DESCRIPTION, $sql_data_array);
      }
      else {
        zen_db_perform(TABLE_METATAGS_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', "categories_id=".(int)$categories_id." and language_id=".$k);
      }
    }

    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_SAVE');
    if ($insert_categories) {
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_INSERT');
    }

    return $categories_id;
  }

  // 削除
  function delete_category($categories_id) {
    global $db, $zc_products;

    // future cat specific deletion
    $delete_linked = 'true';
    if ($_POST['delete_linked'] == 'delete_linked_no') {
      $delete_linked = 'false';
    } else {
      $delete_linked = 'true';
    }

    // delete category and products
    $categories_id = zen_db_prepare_input($categories_id);

    // create list of any subcategories in the selected category,
    $categories = zen_get_category_tree($categories_id, '', '0', '', true);

    zen_set_time_limit(600);

    // loop through this cat and subcats for delete-processing.
    for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
      $sql = "select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id='" . $categories[$i]['id'] . "'";
      $category_products = $db->Execute($sql);

      while (!$category_products->EOF) {
        // determine product-type-specific override script for this product
        $product_type = zen_get_products_type($category_products->fields['products_id']);
        // now loop thru the delete_product_confirm script for each product in the current category
        if (file_exists(DIR_WS_MODULES . $zc_products->get_handler($product_type) . '/delete_product_confirm.php')) {
          require(DIR_WS_MODULES . $zc_products->get_handler($product_type) . '/delete_product_confirm.php');
        } else {
          require(DIR_WS_MODULES . 'delete_product_confirm.php');
        }

        // THIS LINE COMMENTED BECAUSE IT'S DONE ALREADY DURING DELETE_PRODUCT_CONFIRM.PHP:
        //zen_remove_product($category_products->fields['products_id'], $delete_linked);
        $category_products->MoveNext();
      }

      zen_remove_category($categories[$i]['id']);

    } // end for loop
  }

  function get_breadcrumb($categories_id, $separater='&nbsp;&gt;&nbsp;') {
    $breadcrumbs = array();

    $categories = zen_generate_category_path($categories_id);
    for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
      for ($j=0, $k=sizeof($categories[$i]); $j<$k; $j++) {
        $id = $categories[$i][$j]['id'];
        if (empty($id)) {
          continue;
        }
        if ($id != $categories_id) {
          $parm = array('category_id' => $id);
          $link = easy_admin_products_html::href_link("categories", $parm);
          $breadcrumb = '<a href="'. $link .'">'. zen_output_string_protected($categories[$i][$j]['text']) .'</a>';
        }else{
          $breadcrumb = zen_output_string_protected($categories[$i][$j]['text']);
        }
        array_unshift($breadcrumbs, $breadcrumb);
      }
    }

    if (empty($breadcrumbs)) {
      $top = TEXT_TOP;
    }else{
      $top = '<a href="'. easy_admin_products_html::href_link("categories") .'">'. TEXT_TOP .'</a>';
    }
    array_unshift($breadcrumbs, $top);

    return join($separater, $breadcrumbs);
  }

  function get_product_type_id($type_handler) {
    global $db;

    $sql = "SELECT type_id FROM ". TABLE_PRODUCT_TYPES ."
            WHERE type_handler='". zen_db_input($type_handler) ."'";
    $product_type = $db->Execute($sql);
    if ($product_type->RecordCount()) {
      return $type->fields['type_id'];
    }else{
      return null;
    }
  }

  function add_current_parm($parm) {
    global $current_parm;

    foreach ($current_parm as $k => $v) {
      $parm['current['. $k .']'] = $v;
    }
    return $parm;
  }
}
?>
