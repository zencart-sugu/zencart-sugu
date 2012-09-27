<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class super_products_list_model {

  var $search_params = array();

  // 検索パラメータ取得
  function get_search_params() {
    return $this->search_params;
  }

  // 検索パラメータセット
  function set_search_params($request) {
    $this->search_params = array(
      'keywords'         => $request['keywords'],
      'keywords_array'   => self::parse_keywords($request['keywords']),
      'categories_id'    => $request['categories_id'] ? $request['categories_id'] : "",
      'manufacturers_id' => $request['manufacturers_id'] ? $request['manufacturers_id'] : "",
      'price_from'       => self::get_numeric_value($request['price_from']),
      'price_to'         => self::get_numeric_value($request['price_to']),
      'date_from'        => self::get_date_value($request['date_from']),
      'date_to'          => self::get_date_value($request['date_to']),
      'sort'             => isset($request['sort']) ? $request['sort'] : MODULE_SUPER_PRODUCTS_LIST_SORT_DEFAULT,
      'direction'        => isset($request['direction']) ? $request['direction'] : MODULE_SUPER_PRODUCTS_LIST_SORT_DIRECTION_DEFAULT,
      'page'             => (int)$request['page'] ? (int)$request['page'] : 1,
      'limit'            => in_array($request['limit'], $this->get_limit_options()) ? (int)$request['limit'] : MODULE_SUPER_PRODUCTS_LIST_LIMIT_DEFAULT,
      'limit_manufacturers' => MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_LIST_LIMIT_DEFAULT,
      'featured'         => isset($request['featured']) ? $request['featured'] : false,
      'specials'         => isset($request['specials']) ? $request['specials'] : false,
    );
  }

  // キーワードをパース
  // ブランク区切り、ただしダブルクォートで囲まれたものはそのまま
  // ex) 'abc "def 123" xyz' -> array('abc', 'def 123', 'xyz')
  function parse_keywords($val) {
    $keywords = array();
    $quoted = false;
    $word = "";
    for ($i = 0, $n = mb_strlen($val); $i < $n; $i++) {
      $char = mb_substr($val, $i, 1);
      switch ($char) {
      case '"':
        $quoted = !$quoted;
        break;
      case ' ':
      case MODULE_SUPER_PRODUCTS_LIST_ZENKAKU_BLANK:
        if ($quoted) {
          $word .= $char;
        } else {
          if ($word != '') {
            $keywords[] = $word;
            $word = "";
          }
        }
        break;
      default:
        $word .= $char;
        break;
      }
    }
    if ($word != '') {
      $keywords[] = $word;
    }
    return $keywords;
  }

  // 全角→半角、数字以外を削除
  function get_numeric_value($val) {
    $val = mb_convert_kana($val, 'a');
    $val = preg_replace('/[^0-9]/', '', $val);
    return $val;
  }

  // 全角→半角、数字以外を「/」に変換
  function get_date_value($val) {
    $val = mb_convert_kana($val, 'a');
    $val = preg_replace('/[^0-9]/', '/', $val);
    return $val;
  }

  // 入力された値をチェック
  function validate_search_params() {
    $errors = array();

    // カテゴリが存在するか
    if (zen_not_null($this->search_params['categories_id'])) {
      if (!is_numeric($this->search_params['categories_id'])) {
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_CATEGORIES_ID;
        $this->search_params['categories_id'] = "";
      }else{
        $category = self::get_category($this->search_params['categories_id']);
        if (!$category) {
          $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_CATEGORY_NOT_FOUND;
          $this->search_params['categories_id'] = "";
        }
      }
    }

    // メーカーが存在するかチェック
    if (zen_not_null($this->search_params['manufacturers_id'])) {
      if (!is_numeric($this->search_params['manufacturers_id'])) {
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_MANUFACTURERS_ID;
        $this->search_params['manufacturers_id'] = "";
      }else{
        $manufacturer = self::get_manufacturer($this->search_params['manufacturers_id']);
        if (!$manufacturer) {
          $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_MANUFACTURER_NOT_FOUND;
          $this->search_params['manufacturers_id'] = "";
        }
      }
    }

    // price_from, price_to
    $price_check_error = false;
    if (zen_not_null($this->search_params['price_from'])) {
      if (!settype($this->search_params['price_from'], 'float')) {
        $price_check_error = true;
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_FROM_MUST_BE_NUM;
        $this->search_params['price_from'] = "";
      }
    }
    if (zen_not_null($this->search_params['price_to'])) {
      if (!settype($this->search_params['price_to'], 'float')) {
        $price_check_error = true;
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_MUST_BE_NUM;
        $this->search_params['price_to'] = "";
      }
    }
    if (($price_check_error == false) && is_float($this->search_params['price_from']) && is_float($this->search_params['price_to'])) {
      if ($this->search_params['price_from'] > $this->search_params['price_to']) {
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_LESS_THAN_PRICE_FROM;
        $this->search_params['price_to'] = "";
      }
    }

    // date_from, date_to
    $date_check_error = false;
    if (zen_not_null($this->search_params['date_from'])) {
      if (!zen_checkdate($this->search_params['date_from'], DOB_FORMAT_STRING, $dfrom_array)) {
        $date_check_error = true;
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_FROM_DATE;
        $this->search_params['date_from'] = "";
      }
    }
    if (zen_not_null($this->search_params['date_to'])) {
      if (!zen_checkdate($this->search_params['date_to'], DOB_FORMAT_STRING, $dto_array)) {
        $date_check_error = true;
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_TO_DATE;
        $this->search_params['date_to'] = "";
      }
    }
    if (($date_check_error == false) && zen_not_null($this->search_params['date_from']) && zen_not_null($this->search_params['date_to'])) {
      if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
        $errors[] = MODULE_SUPER_PRODUCTS_LIST_ERROR_TO_DATE_LESS_THAN_FROM_DATE;
        $this->search_params['date_to'] = "";
      }
    }

    return $errors;
  }

  // カテゴリを取得
  function get_category($categories_id) {
    global $db;

    $query = "SELECT c.*, cd.categories_name, cd.categories_description
              FROM ". TABLE_CATEGORIES ." c, ". TABLE_CATEGORIES_DESCRIPTION ." cd
              WHERE c.categories_id = ". (int)$categories_id ."
              AND c.categories_status = 1
              AND c.categories_id = cd.categories_id
              AND cd.language_id = " . (int)$_SESSION['languages_id']; 
    $result = $db->Execute($query);
    if (!$result->EOF) {
      return $result->fields;
    }
    return null;
  }

  // メーカーを取得
  function get_manufacturer($manufacturers_id) {
    global $db;

    $query = "SELECT *
              FROM ". TABLE_MANUFACTURERS ."
              WHERE manufacturers_id = ". (int)$manufacturers_id;
    $result = $db->Execute($query);
    if (!$result->EOF) {
      return $result->fields;
    }
    return null;
  }

  // 検索
  function search() {
    global $db;

    $select_str = "SELECT DISTINCT p.*, pd.products_name, pd.products_description";
    $query = $this->get_search_query($select_str) . 
             $this->get_search_order_by_query() .
             $this->get_search_limit_offset_query();
    $result = $db->Execute($query);
    $products = array();
    while (!$result->EOF) {
      $products[] = $this->convert_product_result($result->fields);
      $result->MoveNext();
    }
    return $products;
  }

  // 検索ヒット数を取得
  function count_all() {
    global $db;

    $select_str = "SELECT COUNT(DISTINCT p.products_id) AS count";
    $query = $this->get_search_query($select_str); 
    $result = $db->Execute($query);
    return (int)$result->fields['count'];
  }

  // 検索用クエリを作成
  function get_search_query($select_str, $add_where="", $force_price_with_tax=false) {
    global $db, $currencies;

    $price_with_tax = false;
    if ($force_price_with_tax) {
      $price_with_tax = true;
    }else{
      if ((DISPLAY_PRICE_WITH_TAX == 'true') && ((isset($this->search_params['price_from']) && $this->search_params['price_from'] !== '') || (isset($this->search_params['price_to']) && $this->search_params['price_to'] !== ''))) {
        $price_with_tax = true;
      }
    }

    /*
       from
    */
    $from_str = " FROM (" . TABLE_PRODUCTS . " p
                 LEFT JOIN " . TABLE_MANUFACTURERS . " m
                   USING(manufacturers_id), " . 
                 TABLE_PRODUCTS_DESCRIPTION . " pd, " . 
                 TABLE_CATEGORIES . " c, " . 
                 TABLE_PRODUCTS_TO_CATEGORIES . " p2c
                 LEFT JOIN " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " mtpd
                   ON mtpd.products_id= p2c.products_id
                   AND mtpd.language_id = :languagesID )";
    $from_str = $db->bindVars($from_str, ':languagesID', $_SESSION['languages_id'], 'integer');
    if (MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS == 'true') {
      $from_str .= " LEFT JOIN ". TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK ." AS pwas
                       ON p.products_id = pwas.products_id";
    }
    if ($price_with_tax) {
      if (!$_SESSION['customer_country_id']) {
        $_SESSION['customer_country_id'] = STORE_COUNTRY;
        $_SESSION['customer_zone_id'] = STORE_ZONE;
      }
      $from_str .= " LEFT JOIN " . TABLE_TAX_RATES . " tr
                       ON p.products_tax_class_id = tr.tax_class_id
                     LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                       ON tr.tax_zone_id = gz.geo_zone_id
                       AND (gz.zone_country_id IS null OR gz.zone_country_id = 0 OR gz.zone_country_id = :zoneCountryID)
                       AND (gz.zone_id IS null OR gz.zone_id = 0 OR gz.zone_id = :zoneID)";
      $from_str = $db->bindVars($from_str, ':zoneCountryID', $_SESSION['customer_country_id'], 'integer');
      $from_str = $db->bindVars($from_str, ':zoneID', $_SESSION['customer_zone_id'], 'integer');
    }
    if ($this->search_params['featured']) {
      $from_str .= " INNER JOIN ". TABLE_FEATURED . " f
                       ON p.products_id = f.products_id
                      AND f.status = 1";
    }
    if ($this->search_params['specials']) {
      $from_str .= " INNER JOIN ". TABLE_SPECIALS . " sp
                       ON p.products_id = sp.products_id
                      AND sp.status = 1";
    }

    /*
       where
    */
    $where_str = " WHERE p.products_status = 1
                   AND p.products_id = pd.products_id
                   AND pd.language_id = :languagesID
                   AND p.products_id = p2c.products_id
                   AND p2c.categories_id = c.categories_id ";
    $where_str = $db->bindVars($where_str, ':languagesID', $_SESSION['languages_id'], 'integer');
    // keywords
    if (!empty($this->search_params['keywords_array'])) {
      $target_columns = array(
        "pd.products_name",
        "pd.products_description",
//        "p.products_model",
//        "mtpd.metatags_keywords",
//        "mtpd.metatags_description",
      );
      if (MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS == 'true') {
//        $target_columns[] = "pwas.skumodel";
      }


      $tmp = array();
      foreach ($this->search_params['keywords_array'] as $keywords) {
        $keywords = zen_db_input($keywords);
        if (MODULE_SUPER_PRODUCTS_LIST_SENNA_STATUS == 'true') {
          $tmp[] = "MATCH(". join(",", $target_columns) .") AGAINST('". $keywords ."')";
        } else{
          $ors = array();
          foreach ($target_columns as $target_column) {
            $ors[] = $target_column ." LIKE '%". $keywords ."%'";
          }
          $tmp[] = '('. join(' OR ', $ors). ')';
        }
      }
      $where_str .= " AND (". join(" AND ", $tmp) .")";
    }
    // categories_id
    if ($this->search_params['categories_id']) {
      $subcategories = array($this->search_params['categories_id']);
      zen_get_subcategories($subcategories, $this->search_params['categories_id']);
      $where_str .= " AND p2c.categories_id IN (". join(',', $subcategories) .")";
    }
    // manufacturers_id
    if ($this->search_params['manufacturers_id']) {
      $where_str .= " AND p.manufacturers_id = ". (int)$this->search_params['manufacturers_id'];
    }
    // price
    $pfrom = $this->search_params['price_from'];
    $pto = $this->search_params['price_to'];
    $rate = $currencies->get_value($_SESSION['currency']);
    if ($rate) {
      $pfrom = $pfrom / $rate;
      $pto = $pto / $rate;
    }
    if (DISPLAY_PRICE_WITH_TAX == 'true') {
      if ($this->search_params['price_from'] !== '') {
        $where_str .= " AND (p.products_price_sorter * IF(gz.geo_zone_id IS null, 1, 1 + (tr.tax_rate / 100)) >= :price)";
        $where_str = $db->bindVars($where_str, ':price', $pfrom, 'float');
      }
      if ($this->search_params['price_to'] !== '') {
        $where_str .= " AND (p.products_price_sorter * IF(gz.geo_zone_id IS null, 1, 1 + (tr.tax_rate / 100)) <= :price)";
        $where_str = $db->bindVars($where_str, ':price', $pto, 'float');
      }
    } else {
      if ($this->search_params['price_from'] !== '') {
        $where_str .= " and (p.products_price_sorter >= :price)";
        $where_str = $db->bindVars($where_str, ':price', $pfrom, 'float');
      }
      if ($this->search_params['price_to'] !== '') {
        $where_str .= " and (p.products_price_sorter <= :price)";
        $where_str = $db->bindVars($where_str, ':price', $pto, 'float');
      }
    }
    // date
    if ($this->search_params['date_from']) {
      $where_str .= " AND p.products_date_available >= :dateAvailable";
      $where_str = $db->bindVars($where_str, ':dateAvailable', zen_date_raw($this->search_params['date_from']), 'date');
    }
    if ($this->search_params['date_to']) {
      $where_str .= " AND p.products_date_available <= :dateAvailable";
      $where_str = $db->bindVars($where_str, ':dateAvailable', zen_date_raw($this->search_params['date_to']), 'date');
    }

    $where_str .= $add_where;

    return $select_str . $from_str . $where_str;
  }

  // order by
  function get_search_order_by_query() {
    $order_by = "";
    $direction = ($this->search_params['direction'] == 'desc') ? 'DESC' : 'ASC';
    switch ($this->search_params['sort']) {
      case 'price':
        $order_by = " ORDER BY p.products_price_sorter $direction, pd.products_name ASC";
        break;
      case 'sort_order':
        $order_by = " ORDER BY p.products_sort_order $direction, pd.products_name ASC";
        break;
      case 'date':
        $order_by = " ORDER BY p.products_date_available IS NULL ASC, p.products_date_available $direction, pd.products_name ASC";
        break;
      default:
        $order_by = " ORDER BY pd.products_name $direction";
        break;
    }
    return $order_by;
  }

  // limit offset
  function get_search_limit_offset_query() {
    $limit_offset = "";
    $page   = (int)$this->search_params['page'];
    $limit  = (int)$this->search_params['limit'];
    $offset = ($page - 1) * $limit;
    if ($limit > 0) {
      $limit_offset .= " LIMIT ". $limit;
    }
    if ($offset > 0) {
      $limit_offset .= " OFFSET ". $offset;
    }
    return $limit_offset;
  }

  // 検索結果を表示用に変換
  function convert_product_result($fields) {
    $fields['path_image']  = self::get_product_path_image($fields);
    $fields['name']        = $fields['products_name'];
    $fields['url']         = zen_href_link(zen_get_info_page($fields['products_id']), 'products_id='. $fields['products_id'] .'&categories_id='. $this->search_params['categories_id']);
    $fields['description'] = zen_trunc_string(zen_clean_html(stripslashes($fields['products_description']), PRODUCT_LIST_DESCRIPTION));
    $fields['model']       = $fields['products_model'];
    $fields['quantity']    = $fields['products_quantity'];
    $fields['date_added']  = zen_date_long($fields['products_date_added']);
    $fields['price']       = $fields['products_price'];	#FIXME
    $fields['final_price'] = zen_get_products_display_price($fields['products_id']);
    $fields['cart_button'] = self::get_product_cart_button($fields);
    $categories = self::get_product_categories($fields['products_id']);
    foreach ($categories as $category_id) {
      $fields['categories_path'][] = self::get_categories_path($category_id, self::get_super_products_list_link('results'));
    }
    $fields['always_free_shipping'] = $fields['product_is_always_free_shipping'];
    return $fields;
  }

  function get_product_path_image($fields) {
    if ($fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
      $products_image = PRODUCTS_IMAGE_NO_IMAGE;
    } else {
      $products_image = $fields['products_image'];
    }
    return DIR_WS_IMAGES . $products_image;
  }

  function get_product_cart_button($fields) {
    $cart_button = "";
    $products_id = (int)$fields['products_id'];
    if (zen_has_product_attributes($products_id) or PRODUCT_LIST_PRICE_BUY_NOW == '0') {
      // オプション属性があったら、購入ボタンではなく詳細画面のリンクにする
      $cart_button = '<a href="' . $fields['url'] . '">' . MORE_INFO_TEXT . '</a>';
    }else{
      if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
        // do nothing
      } else {
        $flag_show_product_info_in_cart_qty = zen_get_show_product_switch($products_id, 'in_cart_qty');
        $display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($products_id)) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($products_id) . '</p>' : '');
        if ($fields['products_qty_box_status'] == 0 or $fields['products_quantity_order_max']== 1) {
          // hide the quantity box and default to 1
          $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', $products_id) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
        } else {
          // show the quantity box
          $the_button = PRODUCTS_ORDER_QTY_TEXT . '<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($products_id)) . '" maxlength="6" size="4" /><br />' . zen_get_products_quantity_min_units_display($products_id) . '<br />' . zen_draw_hidden_field('products_id', $products_id) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
        }
        $display_button = zen_get_buy_now_button($products_id, $the_button);
        if ($display_qty != '' or $display_button != '') {
          $cart_button = zen_draw_form('cart_quantity_'.$products_id, zen_href_link(zen_get_info_page($products_id), zen_get_all_get_params(array('action')) . 'action=add_product'), 'post', 'enctype="multipart/form-data"');
          $cart_button .= '<div>';
          $cart_button .= $display_qty;
          $cart_button .= $display_button;
          $cart_button .= '</div>';
          $cart_button .= '</form>';
        }
      }
    }
    return $cart_button;
  }

  // 商品の属するカテゴリID一覧を取得
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

  //「Ｔシャツ（白）＞アニマル（白）」とか、そんな値
  function get_categories_path($category_id, $link="", $separate="&nbsp;&gt;&nbsp;", $category_base_id=0) {
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
        $html .= '<a href="'.$link.'&categories_id='.$category['id'].'">'.$category['text'].'</a>';
      }
      return $html;
    }
  }

  // ページング情報取得
  function get_paging($count_all) {
    $max_page = (int)ceil($count_all / $this->search_params['limit']);
    $current_page = (int)$this->search_params['page'];
    $url = self::get_super_products_list_link('results');
    foreach ($this->search_params as $key => $val) {
      switch ($key) {
      case 'keywords':
      case 'categories_id':
      case 'manufacturers_id':
      case 'price_from':
      case 'price_to':
      case 'date_from':
      case 'date_to':
      case 'sort':
      case 'direction':
      case 'limit':
      case 'featured':
      case 'specials':
        if (zen_not_null($val)) {
          $url .= '&'. urlencode($key) .'='. urlencode($val);
        }
        break;
      }
    }

    $paging = array();
    $paging['current_page'] = $current_page;
    $paging['max_page'] = $max_page;
    $paging['prev'] = array(
      'string' => MODULE_SUPER_PRODUCTS_LIST_PAGING_PREV,
      'url' => ($current_page > 1) ? $url .'&page='. ($current_page - 1) : "",
    );
    $paging['next'] = array(
      'string' => MODULE_SUPER_PRODUCTS_LIST_PAGING_NEXT,
      'url' => ($current_page < $max_page) ? $url .'&page='. ($current_page + 1) : "",
    );
    $paging['page_list'] = array();
    $before_skipped = $after_skipped = false;
    for ($i = 1; $i <= $max_page; $i++) {
      // カレントページはリンクなし
      if ($i == $current_page) {
        $paging['page_list'][] = array('string' => $i, 'url' => '');
      }
      // 最初、最後、前後nページはリンク付きで表示
      elseif ($i == 1 || $i == $max_page || abs($i - $current_page) <= MODULE_SUPER_PRODUCTS_LIST_PAGING_ABS) {
        $paging['page_list'][] = array('string' => $i, 'url' => $url .'&page='. $i);
      }
      // nページより離れたページは、まとめて「...」にする
      elseif ($i < $current_page && !$before_skipped) {
        $paging['page_list'][] = array('string' => '...', 'url' => '');
        $before_skipped = true;
      }
      elseif ($i > $current_page && !$after_skipped) {
        $paging['page_list'][] = array('string' => '...', 'url' => '');
        $after_skipped = true;
      }
    }
    $paging['result_from'] = ($current_page - 1) * $this->search_params['limit'] + 1;
    $paging['result_to'] = min($count_all, $current_page * $this->search_params['limit']);
    return $paging;
  }

  function get_limit_options() {
    return explode(',', MODULE_SUPER_PRODUCTS_LIST_LIMIT_OPTIONS);
  }

  function get_super_products_list_link($page='') {
    $param = 'module=super_products_list';
    if (zen_not_null($page)) {
      $param .= '/'. $page;
    }
    return zen_href_link(FILENAME_ADDON, $param);
  }

  function toJSON($data) {
    if (function_exists('json_encode'))
      return json_encode($data);
    require_once('Zend/Json/Encoder.php');
    return Zend_Json_Encoder::encode($data);
  }

  // メーカーを検索
  function search_manufacturers() {
    global $db;
    $select_str = "SELECT DISTINCT m.manufacturers_id, m.manufacturers_name";
    $add_where = " AND m.manufacturers_id > 0";
    $query = $this->get_search_query($select_str, $add_where) .
             $this->get_search_manufacturers_order_by_query() .
             $this->get_search_manufacturers_limit_offset_query();
    $result = $db->Execute($query);
    $manufacturers = array();
    while (!$result->EOF) {
      $manufacturers[] = array(
        'id'   => $result->fields['manufacturers_id'],
        'name' => $result->fields['manufacturers_name'],
      );
      $result->MoveNext();
    }
    return $manufacturers;
  }

  // メーカー検索ヒット数を取得
  function count_all_manufacturers() {
    global $db;

    $select_str = "SELECT COUNT(DISTINCT m.manufacturers_id) AS count";
    $add_where = " AND m.manufacturers_id > 0";
    $query = $this->get_search_query($select_str, $add_where);
    $result = $db->Execute($query);
    return (int)$result->fields['count'];
  }

  function get_search_manufacturers_order_by_query() {
    $query = " ORDER BY manufacturers_name ASC";
    return $query;
  }

  function get_search_manufacturers_limit_offset_query() {
    $limit_offset = "";
    $page   = (int)$this->search_params['page'];
    $limit  = (int)$this->search_params['limit_manufacturers'];
    $offset = ($page - 1) * $limit;
    if ($limit > 0) {
      $limit_offset .= " LIMIT ". $limit;
    }
    if ($offset > 0) {
      $limit_offset .= " OFFSET ". $offset;
    }
    return $limit_offset;
  }

  // カテゴリツリーを取得
  function get_categories_tree($categories_id) {
    $current_category  = $this->get_category($categories_id);
    $categories = $this->get_subcategories($current_category['parent_id']);
    for ($i = 0, $n = count($categories); $i < $n; $i++) {
      if ($categories[$i]['categories_id'] == $categories_id) {
        $categories[$i]['is_current'] = true;
        $categories[$i]['subcategories'] = $this->get_subcategories($categories_id);
      }
    }
    return $categories;
  }

  // サブカテゴリを取得
  function get_subcategories($parent_id) {
    global $db;

    $query = "SELECT c.*, cd.categories_name, cd.categories_description
              FROM ". TABLE_CATEGORIES ." c, ". TABLE_CATEGORIES_DESCRIPTION ." cd
              WHERE c.parent_id = ". (int)$parent_id ."
              AND c.categories_status = 1
              AND c.categories_id = cd.categories_id
              AND cd.language_id = " . (int)$_SESSION['languages_id']; 
    $result = $db->Execute($query);

    $subcategories = array();
    while (!$result->EOF) {
      $subcategories[] = $result->fields;
      $result->MoveNext();
    }
    return $subcategories;
  }

  // 最安・最高価格を取得
  function get_min_max_price() {
    global $db;

    if (DISPLAY_PRICE_WITH_TAX == 'true') {
      $select_str = "SELECT 
                       MIN(p.products_price_sorter * IF(gz.geo_zone_id IS null, 1, 1 + (tr.tax_rate / 100))) AS min_price,
                       MAX(p.products_price_sorter * IF(gz.geo_zone_id IS null, 1, 1 + (tr.tax_rate / 100))) AS max_price";
    }else{
      $select_str = "SELECT 
                       MIN(p.products_price_sorter) AS min_price,
                       MAX(p.products_price_sorter) AS max_price";
    }
    $query = $this->get_search_query($select_str, '', true);
    $result = $db->Execute($query);
    if (!$result->EOF && $result->fields['min_price'] != null && $result->fields['max_price'] != null) {
      return array(
        'min_price' => floor($result->fields['min_price']),
        'max_price' => ceil($result->fields['max_price']),
      );
    }else{
      return false;
    }
  }

  // 最古・最新発売日を取得
  function get_min_max_date() {
    global $db;

    $select_str = "SELECT 
                     DATE_FORMAT(MIN(p.products_date_available), '%Y/%m/%d') AS min_date,
                     DATE_FORMAT(MAX(p.products_date_available), '%Y/%m/%d') AS max_date";
    $add_where = " AND p.products_date_available > '0000-00-00'";
    $query = $this->get_search_query($select_str, $add_where);
    $result = $db->Execute($query);
    if (!$result->EOF && $result->fields['min_date'] != null && $result->fields['max_date'] != null) {
      list($min_yy, $min_mm, $min_dd) = explode("/", $result->fields['min_date']);
      list($max_yy, $max_mm, $max_dd) = explode("/", $result->fields['max_date']);
      return array(
        'min_date'    => $result->fields['min_date'],
        'min_date_yy' => $min_yy,
        'min_date_mm' => $min_mm,
        'min_date_dd' => $min_dd,
        'max_date'    => $result->fields['max_date'],
        'max_date_yy' => $max_yy,
        'max_date_mm' => $max_mm,
        'max_date_dd' => $max_dd,
      );
    }else{
      return false;
    }
  }

  function min_date($date1, $date2) {
    return $date1 < $date2 ? $date1 : $date2;
  }

  function max_date($date1, $date2) {
    return $date1 > $date2 ? $date1 : $date2;
  }

  function parse_date($date) {
    if (function_exists('parse_date')) {
      return parse_date($date);
    }else{
      $split_pattern = '[\/\-\.]';
      if (preg_match("/(\d{4})$split_pattern(\d{1,2})$split_pattern(\d{1,2})/", $date, $matches)) {
        return array(
         'year' => $matches[1],
         'month' => $matches[2],
         'day' => $matches[3],
        );
      }else{
        return false;
      }
    }
  }

  // 日数を計算
  function calc_days($from_date, $to_date) {
    $from = self::parse_date($from_date);
    $to   = self::parse_date($to_date);
    if ($from && $to) {
      $from_time = mktime(0,0,0,$from['month'], $from['day'], $from['year']);
      $to_time   = mktime(0,0,0,$to['month'], $to['day'], $to['year']);
      return ($to_time - $from_time) / (60*60*24);
    }else{
      return 0;
    }
  }

  function get_products_master_categories_id($products_id) {
    global $db;

    $query = "SELECT master_categories_id FROM ". TABLE_PRODUCTS . "
              WHERE products_id = '". (int)$products_id ."'";
    $product = $db->Execute($query);
    if (!$product->EOF) {
      return $product->fields['master_categories_id'];
    }
    return null;
  }

  function get_current_categories_id() {
    global $current_category_id;

    $categories_id = null;
    if (zen_not_null($_REQUEST['categories_id'])) {
      $categories_id = (int)$_REQUEST['categories_id'];
    } else {
      if (zen_not_null($_REQUEST['products_id'])) {
        $categories_id = self::get_products_master_categories_id($_REQUEST['products_id']);
      }
    }
    return $categories_id;
  }

  function get_metatags_categories_description($categories_id) {
    global $db;

    $query = "SELECT *
                FROM ". TABLE_METATAGS_CATEGORIES_DESCRIPTION ."
               WHERE categories_id = ". (int)$categories_id ."
                 AND language_id = " . (int)$_SESSION['languages_id']; 
    $result = $db->Execute($query);
    if (!$result->EOF) {
      return $result->fields;
    }
    return null;
  }
}
?>
