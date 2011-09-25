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

class easy_admin_products_model {
  var $display = array(
    'categories'          => 'nowrap',
    'products_name'       => 'wrap',
    'products_model'      => '',
    'products_price'      => 'align="right"',
    'products_quantity'   => 'align="right"',
    'products_status'     => 'align="center"',
    'products_sort_order' => 'align="right"',
  );

  var $columns = array(
    'p.products_id',
    'p.products_model',
    'p.products_price',
    'p.products_quantity',
    'p.products_status',
    'p.products_sort_order',
    'pd.products_name',
    'pd.products_description',
  );

  var $order   = array('p.products_sort_order',
                       'pd.products_name');

  // 商品検索のsql生成
  function get_products_query($search_param) {
    $join  = "";
    $where = "";

    if ($search_param['category_id'] > 0) {
      $categories = array();
      foreach(explode(",", $search_param['category_id']) as $v) {
        if ($v > 0) {
          self::zen_get_subcategories($acategories, (int)$v);
          $categories[] = (int)$v;
          if (is_array($acategories))
            $categories   = array_merge($categories, $acategories);
        }
      }
      $where .= " and p2c.categories_id in (".implode(",", $categories).")";
    }

    if ($search_param['title'] != "") {
      $where .= " and pd.products_name like '%".zen_db_input($search_param['title'])."%'";
    }

    if ($search_param['model'] != "") {
      $where .= " and p.products_model like '%".zen_db_input($search_param['model'])."%'";
    }

    if ($search_param['manufacturer'] != "") {
      $where .= " and m.manufacturers_name like '%".zen_db_input($search_param['manufacturer'])."%'";
    }

    if ($search_param['description'] != "") {
      $where .= " and pd.products_description like '%".zen_db_input($search_param['description'])."%'";
    }

    if ($search_param['special'] != "") {
      switch($search_param['special']) {
        case 'download':
          $where .= " and p.product_is_always_free_shipping=2";
          break;
        case 'featured':
          $join .= " inner join ".TABLE_FEATURED." f on f.products_id=p.products_id";
          break;
        case 'special':
          $join .= " inner join ".TABLE_SPECIALS." s on s.products_id=p.products_id";
          break;
        case 'quantity':
          $join .= " inner join ".TABLE_PRODUCTS_DISCOUNT_QUANTITY." q on q.products_id=p.products_id";
          break;
        case 'arrival':
          $where .= " and p.products_date_available >= now()";
          break;
        case 'display':
          $where .= " and p.products_status=1";
          break;
        case 'nondisplay':
          $where .= " and p.products_status=0";
          break;
      }
    }

    global $zco_notifier;
    global $easy_admin_products_search_where;
    global $easy_admin_products_search_join;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SEARCH');

    $query = "select distinct ".
                implode(",", $this->columns)."
              from ".
                TABLE_PRODUCTS." p,".
                TABLE_PRODUCTS_DESCRIPTION." pd
              where
                    p.products_id=pd.products_id
                and pd.language_id=".(int)$_SESSION['languages_id']."
                and p.products_id in (
                  select distinct
                    p.products_id
                  from ".
                    TABLE_PRODUCTS." p".
                    $join."
                    left outer join ".TABLE_MANUFACTURERS." m
                      on p.manufacturers_id=m.manufacturers_id
                    inner join ".TABLE_PRODUCTS_TO_CATEGORIES." p2c
                      on p2c.products_id=p.products_id,".
                    TABLE_PRODUCTS_DESCRIPTION." pd ".
                    $easy_admin_products_search_join."
                  where
                        p.products_id=pd.products_id
                    and pd.language_id=".(int)$_SESSION['languages_id'].
                    $where." ".
                    $easy_admin_products_search_where."
                )
              order by ".
                implode(",", $this->order);
    return $query;
  }

  // 検索された各商品の情報を追加、変更する
  function convert_product_result($fields) {
    // カテゴリ
    $categories_html = array();
    $categories      = self::get_product_categories($fields['products_id']);
    $link = easy_admin_products_html::href_link('categories');
    foreach($categories as $category_id) {
      $categories_html[] = self::get_category($category_id, $link);
    }
    $fields['categories'] = implode("<br/>", $categories_html);

    // ステータス
    if (isset($_REQUEST['page']))
      $page = "&page=".$_REQUEST['page'];
    else
      $page = "";

    if ($fields['products_status'] == 1) {
      $parm  = array(
                 "products_id" => $fields['products_id'],
                 "action"      => "status_off",
                 "page"        => $page,
               );
      $image = easy_admin_products_html::input_image("icon_green_on.gif", MODULE_EASY_ADMIN_PRODUCTS_STATUS_ON);
    }
    else {
      $parm  = array(
                 "products_id" => $fields['products_id'],
                 "action"      => "status_on",
                 "page"        => $page,
               );
      $image = easy_admin_products_html::input_image("icon_red_on.gif", MODULE_EASY_ADMIN_PRODUCTS_STATUS_OFF);
    }
    $fields['products_status'] = '<a href="'.easy_admin_products_html::href_link("", $parm).'">'.$image.'</a>';

    return $fields;
  }

  // 商品が属する全カテゴリ取得
  function get_product_categories($products_id) {
    global $db;

    $query      = "select categories_id from ".TABLE_PRODUCTS_TO_CATEGORIES." where products_id=".(int)$products_id;
    $result     = $db->Execute($query);
    $categories = array();
    while (!$result->EOF) {
      $categories[] = $result->fields['categories_id'];
      $result->MoveNext();
    }
    return $categories;
  }

  // 指定されたカテゴリをトップカテゴリから構築
  function get_category($category_id, $link="", $separate="&nbsp;>&nbsp;", $category_base_id=0) {
    global $db;

    $categories = array();
    for (;;) {
      $query = "select
                  c.categories_id,
                  c.parent_id,
                  cd.categories_name
                from ".
                  TABLE_CATEGORIES." c,".
                  TABLE_CATEGORIES_DESCRIPTION." cd
                where
                      c.categories_id=".(int)$category_id."
                  and c.categories_id=cd.categories_id
                  and cd.language_id=".(int)$_SESSION['languages_id'];
      $result      = $db->Execute($query);
      if ($result->EOF)
        break;
      $categories[] = array('id'   => $result->fields['categories_id'],
                            'text' => $result->fields['categories_name']);
      $category_id = $result->fields['parent_id'];
      if ($category_id == 0)
        break;
      if ($result->fields['categories_id'] == $category_base_id)
        break;
    }
    krsort($categories);

    if ($link == "") {
      $html  = "";
      $first = true;
      foreach($categories as $category) {
        if (!$first)
          $html .= $separate;
        $first = false;
        $html .= $category['text'];
      }
      return $html;
    }
    else {
      $html  = "";
      $first = true;
      foreach($categories as $category) {
        if (!$first)
          $html .= $separate;
        $first = false;
        $html .= '<a href="'.$link.'&category_id='.$category['id'].'">'.$category['text'].'</a>';
      }
      return $html;
    }
  }

  // ステータス変更
  function change_status($products_id, $on) {
    global $db;

    $db->Execute("update ".TABLE_PRODUCTS." set products_status=".(int)$on." where products_id=".(int)$products_id);
  }

  // カテゴリ取得
  // idもしくはキーワード検索(排他)
  function get_categories_query($search_param) {
    $category_id = (int)$search_param['category_id'];
    $keyword     = $search_param['keyword'];
    $description = $search_param['description'];

    $where = array(
      "c.categories_id=cd.categories_id",
      "cd.language_id=".(int)$_SESSION['languages_id'],
    );
    if ($category_id==0 && $keyword == "" && $description == "") {
      $where[] = "c.parent_id=0";	// 条件指定なしならトップカテゴリ直下すべて
    }else{
      if ($category_id>0) {
        $where[] = "c.parent_id=".(int)$category_id;
      }
      if ($keyword != "") {
        $where[] = "cd.categories_name like '%".zen_db_input($keyword)."%'";
      }
      if ($description != "") {
        $where[] = "cd.categories_description like '%".zen_db_input($description)."%'";
      }
    }

    $query       = "select
                      c.categories_id,
                      c.categories_status,
                      c.sort_order,
                      cd.categories_name
                    from ".
                      TABLE_CATEGORIES." c,".
                      TABLE_CATEGORIES_DESCRIPTION." cd
                    where ". join(" and ", $where) ."
                      order by
                        c.sort_order,
                        cd.categories_name";
    return $query;
  }

  function get_categories($search_param) {
    global $db;

    $query = self::get_categories_query($search_param);
    $result      = $db->Execute($query);
    $categories  = array();
    while (!$result->EOF) {
      // サブカテゴリが存在するか？
      $check = $db->Execute("select categories_id from ".TABLE_CATEGORIES." where parent_id=".(int)$result->fields['categories_id']);
      if ($check->EOF)
        $child = 0;
      else
        $child = 1;
      $categories[] = array('id'    => $result->fields['categories_id'],
                            'text'  => $result->fields['categories_name'],
                            'child' => $child);
      $result->MoveNext();
    }

    return $categories;
  }

  // 指定されたカテゴリ配下のカテゴリ一覧取得
  function zen_get_subcategories(&$subcategories_array, $parent_id = 0) {
    global $db;
    $subcategories_query = "select categories_id
                            from " . TABLE_CATEGORIES . "
                            where parent_id = '" . (int)$parent_id . "'";

    $subcategories = $db->Execute($subcategories_query);

    while (!$subcategories->EOF) {
      $subcategories_array[sizeof($subcategories_array)] = $subcategories->fields['categories_id'];
      if ($subcategories->fields['categories_id'] != $parent_id) {
        self::zen_get_subcategories($subcategories_array, $subcategories->fields['categories_id']);
      }
      $subcategories->MoveNext();
    }
  }

  // 検索条件のセッションへの保存、および取り出し
  function set_get_search_condition($searchs) {
    foreach($searchs as $k) {
      if (isset($_REQUEST[$k]))
        $_SESSION[$k] = $_REQUEST[$k];
      else
        $_REQUEST[$k] = $_SESSION[$k];
    }
  }

  // product情報構築
  function new_product($columns) {
    $product = array();
    foreach($columns['products_column'] as $k => $v) {
      $product[$k] = $v;
    }
    $product['categories']            = "";

    foreach($columns['languages'] as $v) {
      $language_id          = $v['id'];
      $products_description = array();
      foreach($columns['products_description_column'] as $k => $v) {
        if ($k != "language_id") {
          if (!isset($product['products_description_'.$k]))
            $product['products_description_'.$k] = array();
          $product['products_description_'.$k][$language_id] = $v;
        }
      }
    }

    foreach($columns['featured_column'] as $k => $v) {
      $product['featured_'.$k] = $v;
    }

    foreach($columns['specials_column'] as $k => $v) {
      $product['specials_'.$k] = $v;
    }
    $product['specials_price_status'] = 0;

    foreach($columns['languages'] as $v) {
      $language_id                    = $v['id'];
      $meta_tags_products_description = array();
      foreach($columns['meta_tags_products_description_column'] as $k => $v) {
        if ($k != "language_id") {
          if (!isset($product['meta_tags_products_description_'.$k]))
            $product['meta_tags_products_description_'.$k] = array();
          $product['meta_tags_products_description_'.$k][$language_id] = $v;
        }
      }
    }

    return $product;
  }

  // 国旗
  function language_flag($languages, $language_id) {
    foreach($languages as $v) {
      if ($v['id'] == $language_id)
        return zen_image(DIR_WS_CATALOG_LANGUAGES.$v['directory'].'/images/'.$v['image'], $v['name']);
    }
    return "";
  }

  // 税金
  function get_tax($need_none=false) {
    global $db;

    $query = "select
                tc.tax_class_id,
                tc.tax_class_title,
                tr.tax_rate
              from ".
                TABLE_TAX_CLASS." tc,".
                TABLE_TAX_RATES." tr
              where
                tc.tax_class_id=tr.tax_class_id
              order by
                tax_class_title";

    $result = $db->Execute($query);
    $array  = array();
    if ($need_none) {
      $array[] = array('id'   => 0,
                       'text' => MODULE_EASY_ADMIN_PRODUCTS_TAX_0,
                       'rate' => 0);
    }
    while (!$result->EOF) {
      $array[] = array('id'   => $result->fields['tax_class_id'],
                       'text' => $result->fields['tax_class_title'],
                       'rate' => $result->fields['tax_rate']);
      $result->MoveNext();
    }

    return $array;
  }

  // 画像アップロード先
  function get_upload() {
    $dir         = @dir(DIR_FS_CATALOG_IMAGES);
    $dir_info[]  = array('id' => '', 'text' => "Main Directory");
    while ($file = $dir->read()) {
      if (is_dir(DIR_FS_CATALOG_IMAGES . $file) &&
          strtoupper($file) != 'CVS' &&
          strtoupper($file) != 'PRODUCTS_RESIZE' &&
          strtoupper($file) != '.SVN' &&
          $file != "." &&
          $file != "..") {
        $dir_info[] = array('id' => $file . '/', 'text' => $file);
      }
    }

    return $dir_info;
  }

  // メーカー名
  function get_manufacturer($need_none=false) {
    global $db;

    $query = "select
                m.manufacturers_id,
                mi.manufacturers_name
              from ".
                TABLE_MANUFACTURERS." m
                  left join ".TABLE_MANUFACTURERS_INFO." mi
                    on m.manufacturers_id=mi.manufacturers_id and
                       mi.languages_id=".(int)$_SESSION['languages_id']."
              order by
                mi.manufacturers_name";
    $result = $db->Execute($query);
    $array  = array();
    if ($need_none) {
      $array[] = array('id'   => 0,
                       'text' => MODULE_EASY_ADMIN_PRODUCTS_MANUFACTURER_0);
    }
    while (!$result->EOF) {
      $array[] = array('id'   => $result->fields['manufacturers_id'],
                       'text' => $result->fields['manufacturers_name']);
      $result->MoveNext();
    }

    return $array;
  }

  // チェック
  function validate_save($post) {
    $errors = array();
    // 品番
    if ($post['products_model'] == "") {
      $errors['products_model'] = MODULE_EASY_ADMIN_PRODUCTS_ERROR_MODEL;
    }

    // カテゴリ
    if ($post['categories_id'] == 0) {
      $errors['categories_id'] = MODULE_EASY_ADMIN_PRODUCTS_ERROR_CATEGORIES;
    }

    return $errors;
  }

  // チェック
  function validate_copy($post) {
    $errors = array();
    // カテゴリ
    if ($post['categories'] == 0) {
      $errors['categories'] = MODULE_EASY_ADMIN_PRODUCTS_ERROR_CATEGORIES;
    }

    return $errors;
  }

  // 取得
  function load_product($columns, $products_id) {
    global $db;

    // デフォルト設定
    $product = self::new_product($columns);

    // categories
    $product['categories'] = implode(",", self::get_product_categories($products_id));

    // products
    $column = array();
    foreach($columns['products_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_PRODUCTS." where products_id=".(int)$products_id;
    $result = $db->Execute($query);
    if (!$result->EOF) {
      foreach($columns['products_column'] as $k => $v) {
        if (isset($result->fields[$k]))
          $product[$k] = $result->fields[$k];
      }
    }

    // products_description
    $column = array();
    foreach($columns['products_description_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_PRODUCTS_DESCRIPTION." where products_id=".(int)$products_id;
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $language_id = $result->fields['language_id'];
      foreach($columns['products_description_column'] as $k => $v) {
        if (isset($result->fields[$k]))
          $product['products_description_'.$k][$language_id] = $result->fields[$k];
      }
      $result->MoveNext();
    }

    // featured
    $column = array();
    foreach($columns['featured_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_FEATURED." where products_id=".(int)$products_id;
    $result = $db->Execute($query);
    if (!$result->EOF) {
      foreach($columns['featured_column'] as $k => $v) {
        if (isset($result->fields[$k])) {
          if ($k == 'featured_date_available' ||
              $k == 'expires_date') {
            if ($result->fields[$k] == '0001-01-01')
              $result->fields[$k] = '';
          }
          $product['featured_'.$k] = $result->fields[$k];
        }
      }
    }

    // specials
    $column = array();
    foreach($columns['specials_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_SPECIALS." where products_id=".(int)$products_id;
    $result = $db->Execute($query);
    if (!$result->EOF) {
      foreach($columns['specials_column'] as $k => $v) {
        if (isset($result->fields[$k])) {
          if ($k == 'featured_date_available' ||
              $k == 'expires_date') {
            if ($result->fields[$k] == '0001-01-01')
              $result->fields[$k] = '';
          }
          $product['specials_'.$k] = $result->fields[$k];
        }
      }
    }

    if ($product['product_is_free'] == 1)
      $product['specials_price_status'] = 2;
    else if ($product['product_is_call'] == 1)
      $product['specials_price_status'] = 3;
    else if ($product['specials_status'] == 0)
      $product['specials_price_status'] = 0;
    else
      $product['specials_price_status'] = 1;

    // meta_tags_products_description
    $column = array();
    foreach($columns['meta_tags_products_description_column'] as $k => $v) {
      $column[] = $k;
    }
    $query  = "select distinct ".implode(",", $column)." from ".TABLE_META_TAGS_PRODUCTS_DESCRIPTION." where products_id=".(int)$products_id;
    $result = $db->Execute($query);
    while (!$result->EOF) {
      $language_id = $result->fields['language_id'];
      foreach($columns['meta_tags_products_description_column'] as $k => $v) {
        if (isset($result->fields[$k]))
          $product['meta_tags_products_description_'.$k][$language_id] = $result->fields[$k];
      }
      $result->MoveNext();
    }

    return $product;
  }

  // 保存
  function save_product($product) {
    global $db;
    global $sql_data_array;
    global $language_id;
    global $zco_notifier;
    global $product_save;
    global $products_id;

    $products_id     = $product['products_id'];
    $insert_products = ($products_id == 0);

    // イメージ保存
    $products_image = new upload('products_image');
    $products_image->set_destination(DIR_FS_CATALOG_IMAGES . $_POST['img_dir']);
    if ($products_image->parse() && $products_image->save($_POST['overwrite'])) {
      $products_image_name = $_POST['img_dir'] . $products_image->filename;
    } else {
      $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
    }

    // products
    // 特殊価格
    if ($product['specials_price_status'] == 0) {
      $product['products_priced_by_attribute'] = 0;
      $product['product_is_free']              = 0;
      $product['product_is_call']              = 0;
    }
    else if ($product['specials_price_status'] == 1) {
      $product['products_priced_by_attribute'] = 0;
      $product['product_is_free']              = 0;
      $product['product_is_call']              = 0;
    }
    else if ($product['specials_price_status'] == 2) {
      $product['products_priced_by_attribute'] = 0;
      $product['product_is_free']              = 1;
      $product['product_is_call']              = 0;
    }
    else if ($product['specials_price_status'] == 3) {
      $product['products_priced_by_attribute'] = 0;
      $product['product_is_free']              = 0;
      $product['product_is_call']              = 1;
    }

    $sql_data_array = array(
      'products_type'                    => $product['products_type'],
      'products_quantity'                => $product['products_quantity'],
      'products_model'                   => $product['products_model'],
      'products_image'                   => $products_image_name,
      'products_price'                   => $product['products_price'],
      'products_virtual'                 => $product['products_virtual'],
      'products_date_available'          => ($product['products_date_available']=="")?'null':$product['products_date_available'],
      'products_weight'                  => $product['products_weight'],
      'products_status'                  => $product['products_status'],
      'products_tax_class_id'            => $product['products_tax_class_id'],
      'manufacturers_id'                 => $product['manufacturers_id'],
      'products_quantity_order_min'      => $product['products_quantity_order_min'],
      'products_quantity_order_units'    => $product['products_quantity_order_units'],
      'products_priced_by_attribute'     => $product['products_priced_by_attribute'],
      'product_is_free'                  => $product['product_is_free'],
      'product_is_call'                  => $product['product_is_call'],
      'products_quantity_mixed'          => $product['products_quantity_mixed'],
      'product_is_always_free_shipping'  => $product['product_is_always_free_shipping'],
      'products_qty_box_status'          => $product['products_qty_box_status'],
      'products_quantity_order_max'      => $product['products_quantity_order_max'],
      'products_sort_order'              => $product['products_sort_order'],
      'products_discount_type'           => $product['products_discount_type'],
      'products_discount_type_from'      => $product['products_discount_type_from'],
      'products_price_sorter'            => $product['products_price'],
      'master_categories_id'             => (int)$product['categories'],
      'products_mixed_discount_quantity' => $product['products_mixed_discount_quantity'],
      'metatags_title_status'            => $product['metatags_title_status'],
      'metatags_products_name_status'    => $product['metatags_products_name_status'],
      'metatags_model_status'            => $product['metatags_model_status'],
      'metatags_price_status'            => $product['metatags_price_status'],
      'metatags_title_tagline_status'    => $product['metatags_title_tagline_status'],
    );

    $product_save = $product;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_PRODUCTS');

    if ($insert_products) {
      $sql_data_array['products_date_added'] = 'now()';
      zen_db_perform(TABLE_PRODUCTS, $sql_data_array);
      $products_id = zen_db_insert_id();
    }
    else {
      $sql_data_array['products_last_modified'] = 'now()';
      zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id=".(int)$products_id);
    }

    // products_to_categories
    // いったんすべてのカテゴリを削除後、追加する
    $db->Execute("delete from ".TABLE_PRODUCTS_TO_CATEGORIES." where products_id=".(int)$products_id);
    $array = explode(",", $product['categories_id']);
    foreach($array as $v) {
      if ($v > 0) {
        $sql_data_array = array(
          'products_id'   => $products_id,
          'categories_id' => $v,
        );
        zen_db_perform(TABLE_PRODUCTS_TO_CATEGORIES, $sql_data_array);
      }
    }

    // products_description
    foreach($product['products_description_products_name'] as $k => $v) {
      $sql_data_array = array(
        'products_id'          => $products_id,
        'language_id'          => $k,
        'products_name'        => $product['products_description_products_name'][$k],
        'products_description' => $product['products_description_products_description'][$k],
        'products_url'         => $product['products_description_products_url'][$k],
      );
      $language_id = $k;
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_PRODUCTS_DESCRIPTION');

      if ($insert_products) {
        zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
      }
      else {
        zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id=".(int)$products_id." and language_id=".$k);
      }
    }

    // meta_tags_products_description
    if (is_array($product['meta_tags_products_description_metatags_title'])) {
      foreach($product['meta_tags_products_description_metatags_title'] as $k => $v) {
        $sql_data_array = array(
          'products_id'          => $products_id,
          'language_id'          => $k,
          'metatags_title'       => $product['meta_tags_products_description_metatags_title'][$k],
          'metatags_keywords'    => $product['meta_tags_products_description_metatags_keywords'][$k],
          'metatags_description' => $product['meta_tags_products_description_metatags_description'][$k],
        );

        $language_id = $k;
        $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_META_TAGS_PRODUCTS_DESCRIPTION');

        if ($insert_products) {
          zen_db_perform(TABLE_META_TAGS_PRODUCTS_DESCRIPTION, $sql_data_array);
        }
        else {
          zen_db_perform(TABLE_META_TAGS_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id=".(int)$products_id." and language_id=".$k);
        }
      }
    }

    // featured
    if (isset($product['featured_status'])) {
      if ($product['featured_expires_date'] == "")
        $product['featured_expires_date'] = '0001-01-01';
      if ($product['featured_featured_date_available'] == "")
        $product['featured_featured_date_available'] = '0001-01-01';

      if ($product['featured_status'] == 1) {
        $sql_data_array = array(
          'products_id'             => $products_id,
          'expires_date'            => $product['featured_expires_date'],
          'status'                  => $product['featured_status'],
          'featured_date_available' => $product['featured_featured_date_available'],
        );

      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_FEATURED');

        if ($product['featured_featured_id'] == 0) {
          $sql_data_array['featured_date_added'] = 'now()';
          zen_db_perform(TABLE_FEATURED, $sql_data_array);
          $product['featured_featured_id'] = zen_db_insert_id();
        }
        else {
          $sql_data_array['featured_last_modified'] = 'now()';
          zen_db_perform(TABLE_FEATURED, $sql_data_array, "update", "featured_id=".$product['featured_featured_id']);
        }
      }
      else {
        $db->Execute("delete from ".TABLE_FEATURED." where products_id=".(int)$products_id);
      }
    }

    // specials
    if (isset($product['specials_price_status'])) {
      if ($product['specials_expires_date'] == "")
        $product['specials_expires_date'] = '0001-01-01';
      if ($product['specials_specials_date_available'] == "")
        $product['specials_specials_date_available'] = '0001-01-01';

      if ($product['specials_price_status'] == 0 ||
          $product['specials_price_status'] == 1) {
        $sql_data_array = array(
          'products_id'             => $products_id,
          'specials_new_products_price' => $product['specials_specials_new_products_price'],
          'expires_date'                => $product['specials_expires_date'],
          'status'                      => $product['specials_price_status'],
          'specials_date_available'     => $product['specials_specials_date_available'],
        );

        $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SAVE_SPECIALS');

        if ($product['specials_specials_id'] == 0) {
          $sql_data_array['specials_date_added'] = 'now()';
          zen_db_perform(TABLE_SPECIALS, $sql_data_array);
          $product['specials_specials_id'] = zen_db_insert_id();
        }
        else {
          $sql_data_array['specials_last_modified'] = 'now()';
          zen_db_perform(TABLE_SPECIALS, $sql_data_array, "update", "specials_id=".$product['specials_specials_id']);
        }
      }
      else {
        $db->Execute("delete from ".TABLE_SPECIALS." where products_id=".(int)$products_id);
      }
    }

    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_SAVE');
    if ($insert_products) {
      $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_INSERT');
    }

    return $products_id;
  }

  // 削除
  function delete_product($products_id, $products_image) {
    global $db;

    // イメージ
    if ($products_image != "")
      @unlink(DIR_FS_CATALOG_IMAGES.$products_image);

    $tables = array(
      TABLE_PRODUCTS,
      TABLE_PRODUCTS_TO_CATEGORIES,
      TABLE_PRODUCTS_DESCRIPTION,
      TABLE_PRODUCTS_ATTRIBUTES,
      TABLE_PRODUCTS_DISCOUNT_QUANTITY,
      TABLE_PRODUCTS_NOTIFICATIONS,
      TABLE_PRODUCTS_POINT_RATE,
      TABLE_META_TAGS_PRODUCTS_DESCRIPTION,
      TABLE_FEATURED,
      TABLE_SPECIALS,
    );

    foreach($tables as $v) {
      $db->Execute("delete from ".$v." where products_id=".(int)$products_id);
    }
  }

  // コピー
  function copy_product($products_id, $products_image, $categories) {
    global $db;

    // TABLE_PRODUCTSは必ず最初
    $tables = array(
      TABLE_PRODUCTS                       => array("products_id"),
      TABLE_PRODUCTS_DESCRIPTION           => array("products_id"),
      TABLE_PRODUCTS_ATTRIBUTES            => array("products_id", "products_attributes_id"),
      TABLE_PRODUCTS_DISCOUNT_QUANTITY     => array("products_id"),
      TABLE_PRODUCTS_POINT_RATE            => array("products_id"),
      TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK => array("products_id", "stock_id"),
      TABLE_PRODUCTS_XSELL                 => array("products_id", "ID"),
      TABLE_META_TAGS_PRODUCTS_DESCRIPTION => array("products_id"),
      TABLE_FEATURED                       => array("products_id", "featured_id"),
      TABLE_SPECIALS                       => array("products_id", "specials_id"),
    );

    foreach($tables as $v => $c) {
      $columns = self::get_table_columns($v, $c);
      if ($v == TABLE_PRODUCTS) {
        $query           = "insert into ".$v." (".implode(",", $columns).") select ".implode(",", $columns)." from ".$v." where products_id=".(int)$products_id;
        $db->Execute($query);
        $new_products_id = zen_db_insert_id();
      }
      else {
        $query = "insert into ".$v." (products_id,".implode(",", $columns).") select ".$new_products_id." products_id, ".implode(",", $columns)." from ".$v." where products_id=".(int)$products_id;
        $db->Execute($query);
      }
    }

    // products_image
    if ($products_image != "") {
      $dirname  = dirname($products_image);
      $filename = basename($products_image);
      preg_match("/(.*)\.(.*)/", $filename, $match);
      $newname  = $dirname."/".$match[1]."-".$new_products_id.".".$match[2];
      copy(DIR_FS_CATALOG_IMAGES.$products_image, DIR_FS_CATALOG_IMAGES.$newname);
    }
    $db->Execute("update ".TABLE_PRODUCTS." set products_image='".zen_db_input($newname)."' where products_id=".$new_products_id);

    // products_to_categories
    $array = explode(",", $categories);
    foreach($array as $v) {
      if ($v > 0) {
        $sql_data_array = array(
          'products_id'   => $new_products_id,
          'categories_id' => $v,
        );
        zen_db_perform(TABLE_PRODUCTS_TO_CATEGORIES, $sql_data_array);
      }
    }
  }

  // desc
  function get_table_columns($table, $exclude=array()) {
    global $db;

    $columns = array();
    $check   = $db->Execute("desc ".$table);
    while (!$check->EOF) {
      if (!in_array($check->fields['Field'], $exclude))
        $columns[] = $check->fields['Field'];
      $check->MoveNext();
    }

    return $columns;
  }

  // cross sell
  function update_products_xsell($products_id, $product, $cross) {
    global $db;

    if (is_array($product)) {
      foreach ($product as $temp_prod){
        $query = 'delete from '.TABLE_PRODUCTS_XSELL.' where xsell_id='.(int)$temp_prod.' and products_id='.(int)$products_id;
        $db->Execute($query);
      }
    }

    $sort_start_query  = 'select sort_order from '.TABLE_PRODUCTS_XSELL.' where products_id='.(int)$products_id.' order by sort_order desc limit 1';
    $sort_start_result = $db->Execute($sort_start_query);
    $sort              = (int)$sort_start_result->fields['sort_order'];

    if (is_array($cross)) {
      foreach ($cross as $temp) {
        $sort++;
        $insert_array = array(
          'products_id' => (int)$products_id,
          'xsell_id'    => (int)$temp,
          'sort_order'  => $sort);
        zen_db_perform(TABLE_PRODUCTS_XSELL, $insert_array);
      }
    }
  }

  function update_xsell_order($cross) {
    global $db;

    if (is_array($cross)) {
      foreach ($cross as $key_a => $value_a){
        $query = 'update '.TABLE_PRODUCTS_XSELL.' set sort_order='.(int)$value_a.' where xsell_id='.(int)$key_a;
        $db->Execute($query);
      }
    }
  }

  function xsell_zen_get_all_get_params($exclude_array = '') {
      return self::zen_get_all_get_params_with_urlencode($exclude_array);
  }

  function xsell_make_search_category() {
      $category[0] = array('id' => 'productName',        'text' => MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_NAME);
      $category[1] = array('id' => 'productDescription', 'text' => MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_DESCRIPTION);
      $category[2] = array('id' => 'productModel',       'text' => MODULE_EASY_ADMIN_PRODUCTS_XSELL_TEXT_SEARCH_ITEM_PRODUCT_MODEL);
      return $category;
  }

  function xsell_add_search_condition($products_query_raw, $searchProduct, $searchKeyword) {
      switch ($searchProduct) {
      case 'productName':
          $products_query_raw = $products_query_raw . " and binary pd.products_name like '%". easy_admin_products_model::xsell_db_like_input($searchKeyword) . "%'";
          break;
      case 'productDescription':
          $products_query_raw = $products_query_raw . " and binary pd.products_description like '%". easy_admin_products_model::xsell_db_like_input($searchKeyword) . "%'";
          break;
      case 'productModel':
          $products_query_raw = $products_query_raw . " and binary p.products_model like '". easy_admin_products_model::xsell_db_like_input($searchKeyword) . "%'";
          break;
      }
      return $products_query_raw;
  }

  function xsell_db_like_input($inputText) {
      $text = zen_db_input($inputText);
      $text = mb_ereg_replace("%", "\\%", $text);
      $text = mb_ereg_replace("_", "\\_", $text);
      return $text;
  }

  function xsell_is_registered_relation($mainProductId, $relateProductId) {
      $sql = "SELECT count(*) as c FROM ".TABLE_PRODUCTS_XSELL." WHERE products_id='".zen_db_input($mainProductId)."' AND xsell_id='".zen_db_input($relateProductId)."'";
      $result = mysql_query($sql);
      $countRow = mysql_fetch_array($result);
      return $countRow['c'] > 0;
  }

  function xsell_count_products($productModel) {
      $sql = "SELECT count(*) as c FROM ".TABLE_PRODUCTS_XSELL." AS xs INNER JOIN ".TABLE_PRODUCTS." AS p" .
             " ON p.products_id=xs.products_id WHERE p.products_model='".zen_db_input($productModel)."'";
      $result = mysql_query($sql);
      $countRow = mysql_fetch_array($result);
      return $countRow['c'] > 0;
  }

  function xsell_get_products_id($products_model) {
      $sql = "SELECT products_id FROM ".TABLE_PRODUCTS." WHERE products_model='".zen_db_input($products_model)."'";
      $result = mysql_query($sql);
      if ( mysql_num_rows($result) == 0 )
          return null;
      $row = mysql_fetch_array($result);
      return $row["products_id"];
  }

  function xsell_allocate_sort_order($products_id) {
      $sql = 'select sort_order from ' . TABLE_PRODUCTS_XSELL . ' where products_id = "'.$products_id.'" order by sort_order desc limit 1';
      $result = mysql_query($sql);
      $sort_start = mysql_fetch_array($result);
      $sort = (($sort_start['sort_order'] > 0) ? ($sort_start['sort_order'] + 1) : '1');
      return $sort;
  }

  function xsell_make_error_deco($message) {
      $msg = "<font color=red>" . $message . "</font>";
      return $msg;
  }

  // http://shimamura.ark-web.jp/pukiwiki/51.html -> A
  function zen_get_all_get_params_with_urlencode($exclude_array = '') {
    global $_GET;

    if ($exclude_array == '')
      $exclude_array = array();

    $get_url = '';

    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      // URL Encode value.
      if (($key != zen_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) $get_url .= $key . '=' . rawurlencode($value) . '&';
    }

    return $get_url;
  }
  // http://shimamura.ark-web.jp/pukiwiki/51.html <-
}
?>
