<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 */


function xsell_zen_get_all_get_params($exclude_array = '') {
    return zen_get_all_get_params_with_urlencode($exclude_array);
}


function xsell_make_search_category() {
    $category[0] = array('id' => 'productName', 'text' => XSELL_TEXT_SEARCH_ITEM_PRODUCT_NAME);
    $category[1] = array('id' => 'productDescription', 'text' => XSELL_TEXT_SEARCH_ITEM_PRODUCT_DESCRIPTION);
    $category[2] = array('id' => 'productModel', 'text' => XSELL_TEXT_SEARCH_ITEM_PRODUCT_MODEL);
    return $category;
}


function xsell_add_search_condition($products_query_raw, $searchProduct, $searchKeyword) {
    switch ($searchProduct) {
    case 'productName':
        $products_query_raw = $products_query_raw . " and binary pd.products_name like '%". xsell_db_like_input($searchKeyword) . "%'";
        break;
    case 'productDescription':
        $products_query_raw = $products_query_raw . " and binary pd.products_description like '%". xsell_db_like_input($searchKeyword) . "%'";
        break;
    case 'productModel':
        $products_query_raw = $products_query_raw . " and binary p.products_model like '". xsell_db_like_input($searchKeyword) . "%'";
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

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      // URL Encode value.
      if (($key != zen_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) $get_url .= $key . '=' . rawurlencode($value) . '&';
    }

    return $get_url;
  }
// http://shimamura.ark-web.jp/pukiwiki/51.html <-
?>
