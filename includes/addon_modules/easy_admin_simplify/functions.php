<?php
/**
 * easy admin modules functions.php
 *
 * @package functions
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: functions.php $
 */

  function easy_admin_simplify_start() {
    ob_start();
  }

  function easy_admin_simplify_end() {
    $html_body = ob_get_contents();
    ob_end_clean();

    // モジュールを調べる
    preg_match("/\/([0-9a-z_]+\.php)$/i", $_SERVER['PHP_SELF'], $match);
    $module = $match[1];

    // actionを調べる
    if (isset($_REQUEST['action']))
      $action = $_REQUEST['action'];
    else
      $action = "";

    // setを調べる
    if (isset($_REQUEST['set']))
      $set = $_REQUEST['set'];
    else
      $set = "";

    // 不必要な機能を変更する
    if ($module == "categories.php" && $action == "") {
      $html_body = _categories_list_modify($html_body);
    }

    if ($module == "categories.php" && $action == "edit_category" ||
        $module == "categories.php" && $action == "new_category") {
      $html_body = _categories_modify($html_body);
    }

    if ($module == "categories.php" && $action == "edit_category_meta_tags") {
      $html_body = _categories_meta_tags_modify($html_body);
    }

    if ($module == "product.php" && $action == "new_product") {
      $html_body = _products_modify($html_body);
    }

    if ($module == "product.php" && $action == "update_product") {
      $html_body = _products_modify($html_body);
    }

    if ($module == "product.php" && $action == "new_product_preview") {
      $html_body = _products_preview_modify($html_body);
    }

    if ($module == "product.php" && $action == "new_product_meta_tags") {
      $html_body = _products_meta_tags_modify($html_body);
    }

    if ($module == "product.php" && $action == "update_product_meta_tags") {
      $html_body = _products_meta_tags_modify($html_body);
    }

    if ($module == "product.php" && $action == "new_product_preview_meta_tags") {
      $html_body = _products_preview_meta_tags_modify($html_body);
    }

    if ($module == "product.php" && $action == "copy_to") {
      $html_body = _products_copy_modify($html_body);
    }

    if ($module == "orders_status.php") {
      $html_body = _orders_status_modify($html_body);
    }

    if ($module == "customers.php" && $action == "edit") {
      $html_body = _customers_modify($html_body);
    }

    if ($module == "manufacturers.php" && $action == "new" ||
        $module == "manufacturers.php" && $action == "edit") {
      $html_body = _manufacturers_modify($html_body);
    }

    if ($module == "specials.php" && $action == "") {
      $html_body = _specials_modify($html_body);
    }

    if ($module == "specials.php" && $action == "edit") {
      $html_body = _specials_edit_modify($html_body);
    }

    if ($module == "featured.php" && $action == "") {
      $html_body = _featured_modify($html_body);
    }

    if ($module == "quick_updates.php") {
      $html_body = _quick_updates_modify($html_body);
    }

    if ($module == "options_name_manager.php") {
      $html_body = _options_name_manager_modify($html_body);
    }

    if ($module == "options_values_manager.php") {
      $html_body = _options_values_manager_modify($html_body);
    }

    if ($module == "attributes_controller.php" && $action == "") {
      $html_body = _attributes_controller_modify($html_body);
    }

    if ($module == "attributes_controller.php" && $action == "update_attribute") {
      $html_body = _attributes_controller_modify($html_body);
    }

    if ($module == "attributes_controller.php" && $action == "delete_product_attribute") {
      $html_body = _attributes_controller_delete_product_attribute_modify($html_body);
    }

    if ($module == "attributes_controller.php" && $action == "delete_option_name_values_confirm") {
      $html_body = _attributes_controller_delete_option_name_values_confirm_modify($html_body);
    }

    if ($module == "banner_manager.php" && $action == "new") {
      $html_body = _banner_manager_modify($html_body);
    }

    if ($module == "configuration.php") {
      $html_body = _configuration_modify($html_body);
    }

    if ($module == "modules.php" && $set="ordertotal") {
      $html_body = _modules_modify($html_body);
    }

    if ($module == "super_orders.php" && $action == "edit") {
      $html_body = _super_order_edit_modify($html_body);
    }

    if ($module == "super_edit.php") {
      $html_body = _super_edit_modify($html_body);
    }

    if ($module == "salemaker.php") {
      $html_body = _salemaker_edit_modify($html_body);
    }

    if ($module == "addon_modules_admin.php" && $_REQUEST["module"] == "product_csv/csv_format") {
      $html_body = _product_csv_csv_format_modify($html_body);
    }

    print $html_body;
  }

  // 商品管理
  function _products_modify($html_body) {
    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        $language_suffix  = "[".$languages[$i]['id']."]";

        $item = "products_name".$language_suffix;
        $pos  = strpos($html_body, $item);
        if ($pos !== false) {
          if (!_isVisibleLanguage($languages[$i]['code'])) {
            // 商品名の非表示化
            $tr = _find_tr($html_body, $pos);
            if ($tr !== FALSE)
              $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
          }
          // ヘッダーの書き換え
          else {
            $bth = _find_bth($html_body, $pos);
            if ($bth !== FALSE)
              $html_body = substr_replace($html_body, TEXT_PRODUCTS_NAME."</th>", $bth, 5);
          }
        }

        $item = "products_description".$language_suffix;
        $pos  = strpos($html_body, $item);
        if ($pos !== false) {
          if (!_isVisibleLanguage($languages[$i]['code'])) {
            // 商品名の非表示化
            $tr = _find_tr($html_body, $pos);
            if ($tr !== FALSE)
              $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
          }
          // ヘッダーの書き換え
          else {
            $bth = _find_bth($html_body, $pos);
            if ($bth !== FALSE)
              $html_body = substr_replace($html_body, TEXT_PRODUCTS_DESCRIPTION."</th>", $bth, 5);
          }
        }

        $item = "products_url".$language_suffix;
        $pos  = strpos($html_body, $item);
        if ($pos !== false) {
          if (!_isVisibleLanguage($languages[$i]['code'])) {
            // 商品名の非表示化
            $tr = _find_tr($html_body, $pos);
            if ($tr !== FALSE)
              $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
          }
          // ヘッダーの書き換え
          else {
            $bth = _find_bth($html_body, $pos);
            if ($bth !== FALSE)
              $html_body = substr_replace($html_body, TEXT_PRODUCTS_URL."</th>", $bth, 5);
          }
        }
      }
    }

    // 商品属性による価格
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_ATTRIBUTE != 'true') {
      $html_body = _change_tr($html_body, 'name="products_priced_by_attribute"');
    }

    // 税種別の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_TAX_CLASS != 'true') {
      $html_body = _change_td($html_body, 'name="products_tax_class_id"');
    }

    // 商品価格 (グロス)の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_GROSS != 'true') {
      $html_body = _change_td($html_body, 'name="products_price_gross"');
    }

    // 無料商品の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_FREE != 'true') {
      $html_body = _change_td($html_body, 'name="product_is_free"');
    }

    // 価格お問い合わせの非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_PRICE_CALL != 'true') {
      $html_body = _change_td($html_body, 'name="product_is_call"');
    }

    // ヴァーチャル商品の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_VIRTUAL != 'true') {
      $html_body = _change_td($html_body, 'name="products_virtual"');
    }

    // 常に送料無料の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_ALWAYS_FREE_SHIPPING != 'true') {
      $html_body = _change_td($html_body, 'name="product_is_always_free_shipping"');
    }

    // 商品の最小数量の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MAX != 'true') {
      $html_body = _change_td($html_body, 'name="products_quantity_order_min"');
    }

    // 商品の最大数量の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_MIN != 'true') {
      $html_body = _change_td($html_body, 'name="products_quantity_order_max"');
    }

    // 商品の数量単位の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_ORDER_UNIT != 'true') {
      $html_body = _change_td($html_body, 'name="products_quantity_order_units"');
    }

    // 最小数量/単位ミックスの非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_QUANTITY_MIXED != 'true') {
      $html_body = _change_td($html_body, 'name="products_quantity_mixed"');
    }

    // 商品重量の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_WEIGHT != 'true') {
      $html_body = _change_td($html_body, 'name="products_weight"');
    }

    // .0000は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".0000", "", $html_body);
    }

    // .00は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".00", "", $html_body);
    }

    return $html_body;
  }

  // 商品管理
  function _products_preview_modify($html_body) {
    // 国旗を元に非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $image_src  = '"'.DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'].'"';

          $pos = strpos($html_body, $image_src);
          if ($pos === FALSE)
            continue;
          $table = _find_table($html_body, $pos);
          if ($table !== FALSE) {
            $table = _find_table($html_body, $table);
            if ($table !== FALSE)
            $html_body = substr_replace($html_body, '<table'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
          }
        }
      }
    }

    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    return $html_body;
  }

  // 商品メタタグ管理
  function _products_meta_tags_modify($html_body) {
    // 国旗を元に非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $image_src  = '"'.DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'].'"';
          $startpos   = 0;
          for (;;) {
            $pos = strpos($html_body, $image_src, $startpos);
            if ($pos === FALSE)
              break;
            $td = _find_td($html_body, $pos);
            if ($td !== FALSE) {
              $td = _find_td($html_body, $td);
              if ($td !== FALSE)
                $html_body = substr_replace($html_body, '<td'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
            }
            $startpos = $pos + strlen($image_src);
          }
        }
      }
    }

    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    // 注意部分の削除
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_META_TAGS_USAGE != 'true') {
      $pos = strpos($html_body, TEXT_INFO_META_TAGS_USAGE);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, '', $pos, strlen(TEXT_INFO_META_TAGS_USAGE));
    }

    return $html_body;
  }

  // 商品メタタグ管理
  function _products_preview_meta_tags_modify($html_body) {
    // 国旗を元に非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $image_src  = '"'.DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'].'"';

          $pos = strpos($html_body, $image_src);
          if ($pos === FALSE)
            continue;
          $table = _find_table($html_body, $pos);
          if ($table !== FALSE) {
            $table = _find_table($html_body, $table);
            if ($table !== FALSE)
            $html_body = substr_replace($html_body, '<table'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
          }
        }
      }
    }

    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    return $html_body;
  }

  // 商品コピー
  function _products_copy_modify($html_body) {
    // 複数のカテゴリがマネージャをリンクします。ボタンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_PRODUCT_CATEGORY_MANAGER != 'true') {
      $button = '"'.BUTTON_PRODUCTS_TO_CATEGORIES.'"';
      $pos   = strpos($html_body, $button);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, $button." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, strlen($button));
    }

    return $html_body;
  }

  // カテゴリ管理
  function _categories_list_modify($html_body) {
    // 商品価格の管理へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRICE_LINK != 'true') {
      $pos       = 0;
      $image_src = DIR_WS_IMAGES.'icon_products_price_manager.gif';
      for (;;) {
        $pos = strpos($html_body, $image_src, $pos);
        if ($pos === FALSE)
          break;

        // 直前のa検索
        $a = _find_a($html_body, $pos);
        if ($a !== FALSE)
          $html_body = substr_replace($html_body, '<a'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $a, 2);

        $pos += strlen($image_src);
      }
    }

    // 商品種類のプルダウン
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_TYPE != 'true') {
      $html_body = _change_input($html_body, "product_type");
    }

    // 商品（Ａ）のリンク変更
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_PRODUCT_ATTRIBUTE != 'true') {
      $href = zen_href_link(FILENAME_CATEGORIES,  'cPath=[0-9_]+&pID');
      $href = str_replace('?', '\?', $href);
      $href = str_replace('=', '\=', $href);
      $href = str_replace('/', '\/', $href);
      $href = str_replace('"', '\"', $href);
      $href = str_replace('.', '\.', $href);
      $pattern = '/<a href="'.$href.'.+?>.+?<\/a>/sm';
      preg_match_all($pattern, $html_body, $match);
      for ($i=0; $i<count($match[0]); $i++) {
        if (preg_match("/cPath\=.*?([0-9]+)&/", $match[0][$i], $cPath)) {
          if (preg_match("/pID\=([0-9]+)&/", $match[0][$i], $pID)) {
            $replace   = str_replace(FILENAME_CATEGORIES, FILENAME_ATTRIBUTES_CONTROLLER, $match[0][$i]);
            $replace   = str_replace($cPath[0], "current_category_id=".$cPath[1]."&", $replace);
            $replace   = str_replace($pID[0],   "products_filter=".$pID[1]."&",       $replace);
            $replace   = str_replace('&action=attribute_features',  "",               $replace);
            $html_body = str_replace($match[0][$i], $replace, $html_body);
          }
        }
      }
    }

    return $html_body;
  }

  // カテゴリ管理
  function _categories_modify($html_body) {
    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $language_suffix  = "[".$languages[$i]['id']."]";
          // カテゴリ名の非表示化
          $html_body = _change_input($html_body, "categories_name".$language_suffix);
          // カテゴリ説明の非表示化
          $html_body = _change_input($html_body, "categories_description".$language_suffix);
        }
      }
    }

    return $html_body;
  }

  // カテゴリメタタグ管理
  function _categories_meta_tags_modify($html_body) {
    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CATEGORY_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $language_suffix  = "[".$languages[$i]['id']."]";
          // タイトル名の非表示化
          $html_body = _change_input($html_body, "metatags_title".$language_suffix);
          // キーワードの非表示化
          $html_body = _change_input($html_body, "metatags_keywords".$language_suffix);
          // 説明の非表示化
          $html_body = _change_input($html_body, "metatags_description".$language_suffix);
        }
      }
    }

    return $html_body;
  }

  // 注文ステータス管理
  function _orders_status_modify($html_body) {
    // 国旗を元に非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ORDER_STATUS_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $image_src = '"'.DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'].'"';
          // 注文文言無効化
          // <img...>****<br>
          $pos = strpos($html_body, $image_src);
          if ($pos !== false) {
            $pos = strpos($html_body, ">", $pos);
            if ($pos !== false) {
              $posend = strpos($html_body, "<", $pos);
              if ($pos !== false)
                $html_body = substr_replace($html_body, "", $pos+1, $posend-$pos-1);
            }
          }

          // 注文ステータスの非表示化
          $language_suffix  = "[".$languages[$i]['id']."]";
          $html_body        = _change_input($html_body, "orders_status_name".$language_suffix);
        }
      }
    }

    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ORDER_STATUS_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    return $html_body;
  }

  // 顧客管理
  function _customers_modify($html_body) {
    // Discount Pricing Groupの非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_GROUP_PRICING != 'true') {
      $html_body = _change_td($html_body, 'name="customers_group_pricing"');
    }

    // 割引券贈呈の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_CUSTOMERS_REFERRAL != 'true') {
      $html_body = _change_td($html_body, 'name="customers_referral"');
    }

    return $html_body;
  }

  // メーカー管理
  function _manufacturers_modify($html_body) {
    // 国旗を元に非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MANUFACTURERS_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $language_suffix  = "[".$languages[$i]['id']."]";
          // URL名の非表示化
          $html_body = _change_input($html_body, "manufacturers_url".$language_suffix);
        }
      }
    }

    // 国旗の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_MANUFACTURERS_LANGUAGE != 'true') {
      $html_body = _change_image_icon($html_body);
    }

    return $html_body;
  }

  // 特価商品管理
  function _specials_modify($html_body) {
    // 商品価格の管理へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRICE_LINK != 'true') {
      $link_url = 'href="'.zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit&products_filter=');
      $pos      = strpos($html_body, $link_url);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$link_url, $pos, strlen($link_url));
    }

    // 商品編集へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_EDIT_LINK != 'true') {
      $link_url = 'href="'.zen_href_link(FILENAME_CATEGORIES, '&action=new_product');
      $pos      = strpos($html_body, $link_url);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$link_url, $pos, strlen($link_url));
    }

    // 選択へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_PRE_ADD != 'true') {
      $link_url = 'href="'.zen_href_link(FILENAME_SPECIALS, 'action=pre_add');
      $pos      = strpos($html_body, $link_url);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$link_url, $pos, strlen($link_url));
    }

    return $html_body;
  }

  // 特価商品管理
  function _specials_edit_modify($html_body) {
    // .0000は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".0000", "", $html_body);
    }

    // .00は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SPECIALS_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".00", "", $html_body);
    }

    return $html_body;
  }

  // おすすめ商品管理
  function _featured_modify($html_body) {
    // 商品価格の管理へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_PRICE_LINK != 'true') {
      $link_url = 'href="'.zen_href_link(FILENAME_PRODUCTS_PRICE_MANAGER, 'action=edit&products_filter=');
      $pos      = strpos($html_body, $link_url);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$link_url, $pos, strlen($link_url));
    }

    // 商品編集へのリンク非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_FEATURED_EDIT_LINK != 'true') {
      $link_url = 'href="'.zen_href_link(FILENAME_CATEGORIES, '&action=new_product');
      $pos      = strpos($html_body, $link_url);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$link_url, $pos, strlen($link_url));
    }

    return $html_body;
  }

  // 商品一括管理
  function _quick_updates_modify($html_body) {
    // 警告: quick updatesを利用する前にデータベースのバックアップを行ってください 
    $pos = strpos($html_body, QU_HEADING_TEXT);
    if ($pos !== FALSE)
      $html_body = substr_replace($html_body, "", $pos, strlen(QU_HEADING_TEXT));

    // 数値/倍率帯全体非表示
    $form  = 'name="price_markup"';
    $pos   = strpos($html_body, $form);
    if ($pos !== FALSE)
      $table = _find_table($html_body, $pos);
      if ($table !== FALSE)
        $html_body = substr_replace($html_body, "<table"." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);

    // Edit Linked Catsの非表示
    $form  = 'name="form_categories_switch"';
    $pos   = strpos($html_body, $form);
    if ($pos !== FALSE)
      $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$form, $pos, strlen($form));

    // 商品価格の管理へのリンク非表示
    $pos       = 0;
    $image_src = DIR_WS_IMAGES.'icon_products_price_manager.gif';
    for (;;) {
      $pos = strpos($html_body, $image_src, $pos);
      if ($pos === FALSE)
        break;

      // 直前のa検索
      $a = _find_a($html_body, $pos);
      if ($a !== FALSE)
        $html_body = substr_replace($html_body, '<a'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $a, 2);

      $pos += strlen($image_src);
    }

    // 重量列の非表示
    $col = ">".TABLE_HEADING_WEIGHT."<";
    $pos = strpos($html_body, $col);
    if ($pos !== FALSE) {
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
    }

    $pos = 0;
    $col = 'name="quick_updates_old[products_weight]';
    for (;;) {
      $pos = strpos($html_body, $col, $pos);
      if ($pos === FALSE)
        break;
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);

      $pos += strlen($col);
    }

    // カテゴリ列の非表示
    $col = ">".TABLE_HEADING_CATEGORY."<";
    $pos = strpos($html_body, $col);
    if ($pos !== FALSE) {
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
    }

    $pos = 0;
    $col = 'name="quick_updates_old[master_categories_id]';
    for (;;) {
      $pos = strpos($html_body, $col, $pos);
      if ($pos === FALSE)
        break;
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);

      $pos += strlen($col);
    }

    // 価格列の非表示
    $col = ">".TABLE_HEADING_PRICE."<";
    $pos = strpos($html_body, $col);
    if ($pos !== FALSE) {
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
    }

    $pos = 0;
    $col = 'name="quick_updates_new[products_price]';
    for (;;) {
      $pos = strpos($html_body, $col, $pos);
      if ($pos === FALSE)
        break;
      $td = _find_td($html_body, $pos);
      if ($td !== FALSE)
        $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);

      $pos += strlen($col);
    }

    // quick copyの非表示
    $form  = 'name="quickcopyfrom"';
    $pos   = strpos($html_body, $form);
    if ($pos !== FALSE)
      $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$form, $pos, strlen($form));

    // .0000は無し
    $html_body = str_replace(".0000", "", $html_body);

    // .00は無し
    $html_body = str_replace(".00", "", $html_body);

    return $html_body;
  }

  // 商品オプション名の管理
  function _options_name_manager_modify($html_body) {
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_BIG_MODIFY != 'true') {
      $pos = strpos($html_body, TEXT_WARNING_BACKUP);
      if ($pos !== FALSE) {
        $html_body = substr_replace($html_body, '', $pos, strlen(TEXT_WARNING_BACKUP));

        // 以降のtableを全て消す
        for (;;) {
          $pos = strpos($html_body, "<table", $pos);
          if ($pos === FALSE)
            break;
          $html_body = substr_replace($html_body, '<table '.MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, 6);
          $pos += 6;
        }
      }
    }

    // テキスト属性の最長と表示サイズ以降の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LENGTH != 'true') {
      $pos = strpos($html_body, TEXT_OPTION_ATTIBUTE_MAX_LENGTH);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);

          $pos = strpos($html_body, "<tr", $pos);
          if ($pos !== FALSE)
            $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, 3);
      }
    }

    // 日本語入力以外の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_NAME_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        $text = strpos($html_body, $languages[$i]['code'].":");
        if ($text !== FALSE)
          $html_body = substr_replace($html_body, "", $text, strlen($languages[$i]['code'].":"));

        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $language_suffix  = "[".$languages[$i]['id']."]";
          $pos = strpos($html_body, "option_name".$language_suffix);
          if ($pos !== FALSE) {
            $text = strpos($html_body, TEXT_SORT, $pos);
            if ($text !== FALSE)
              $html_body = substr_replace($html_body, "", $text, strlen(TEXT_SORT));
          }

          // オプション名の非表示化
          $html_body = _change_input($html_body, "option_name".$language_suffix);
          // ソート順の非表示化
          $html_body = _change_input($html_body, "products_options_sort_order".$language_suffix);
        }
      }
    }

    return $html_body;
  }

  // 商品オプション値の管理
  function _options_values_manager_modify($html_body) {
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPY != 'true') {
      $pos   = strpos($html_body, TEXT_OPTION_VALUE_COPY_ALL);
      if ($pos !== FALSE) {
        $html_body = substr_replace($html_body, '', $pos, strlen(TEXT_OPTION_VALUE_COPY_ALL));

        // 以降のtrを全て消す
        for (;;) {
          $pos = strpos($html_body, "<tr", $pos);
          if ($pos === FALSE)
            break;
          $html_body = substr_replace($html_body, '<tr '.MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, 3);
          $pos += 3;
        }
      }
    }

    // おすすめ商品の表示の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_COPIER != 'true') {
      $form  = 'name="set_option_names_values_copier_form"';
      $pos   = strpos($html_body, $form);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$form, $pos, strlen($form));
    }

    // 日本語入力以外の非表示化
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_OPTIONS_VALUES_LANGUAGE != 'true') {
      $languages = zen_get_languages();
      for ($i=0; $i<count($languages); $i++) {
        $text = strpos($html_body, $languages[$i]['code'].":");
        if ($text !== FALSE)
          $html_body = substr_replace($html_body, "", $text, strlen($languages[$i]['code'].":"));

        // 処理対象は日本語以外
        if (!_isVisibleLanguage($languages[$i]['code'])) {
          $language_suffix  = "[".$languages[$i]['id']."]";
          $pos = strpos($html_body, "option_name".$language_suffix);
          if ($pos !== FALSE) {
            $text = strpos($html_body, TEXT_SORT, $pos);
            if ($text !== FALSE)
              $html_body = substr_replace($html_body, "", $text, strlen(TEXT_SORT));
          }

          // オプション値の非表示化
          $html_body = _change_input($html_body, "value_name".$language_suffix);
        }
      }
    }

    return $html_body;
  }

  // 商品オプション属性の管理(共通)
  function _attributes_controller_modify_common($html_body) {
    // 上部ボタンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_MODIFY != 'true') {
      $button = zen_image_button('button_edit_product.gif', IMAGE_EDIT_PRODUCT);
      $pos    = strpos($html_body, $button);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    // 複数カテゴリのリンク管理の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORY != 'true') {
      $link = zen_href_link(FILENAME_PRODUCTS_TO_CATEGORIES, '&products_filter=');
      $pos  = strpos($html_body, $link);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    // .0000は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".0000", "", $html_body);
    }

    // .00は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".00", "", $html_body);
    }

    return $html_body;
  }

  // 商品オプション属性の管理(属性追加)
  function _attributes_controller_modify_insert($html_body) {
    // 新しい属性の重量の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_WEIGHT != 'true') {
      $item = 'name="products_attributes_weight_prefix"';
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $td = _find_td($html_body, $pos);
        if ($td !== FALSE)
          $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
      }
    }

    // 新しい属性のワンタイム値引きの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_ONETIME != 'true') {
      $item = 'name="attributes_price_onetime"';
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $td = _find_td($html_body, $pos);
        if ($td !== FALSE)
          $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
      }
    }

    // 新しい属性のプライスファクターの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_FACTOR != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のワンタイムプライスファクターの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_FACTOR != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_PRICE_FACTOR_ONETIME;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションの数値値引きの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_QTY_PRICES != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_QTY_PRICES;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションのワンタイム数値値引きの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_QTY_PRICES != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_QTY_PRICES_ONETIME;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションの単語毎の価格の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_WORDS != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_PRICE_WORDS;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションの文字毎の価格の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRICE_WORDS != 'true') {
      $item = TABLE_HEADING_ATTRIBUTES_PRICE_LETTERS;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションの属性フラグの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_FLAGS != 'true') {
      $item = TEXT_ATTRIBUTES_FLAGS;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションの画像の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_IMAGE != 'true') {
      $item = TEXT_ATTRIBUTES_IMAGE;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 新しい属性のオプションのファイル名の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_IMAGE != 'true') {
      $item = 'name="products_attributes_filename"';
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    return $html_body;
  }

  // 商品オプション属性の管理(追加)
  function _attributes_controller_modify($html_body) {
    $html_body = _attributes_controller_modify_common($html_body);

    // カテゴリ選択プルダウンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORIES != 'true') {
      $form  = 'name="new_category"';
      $pos   = strpos($html_body, $form);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$form, $pos, strlen($form));
    }

    // 商品選択プルダウンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRODUCTS != 'true') {
      $form = 'name="set_products_filter_id"';
      $pos  = strpos($html_body, $form);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    // 属性凡例の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_LEGEND != 'true') {
      $item = '<td class="smallText" align="right">'.LEGEND_BOX.'</td>';
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 重量の列の非表示
    // 属性の列の非表示
    // 値引の列の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_COLUMN != 'true') {
      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_OPT_WEIGHT_PREFIX.'&nbsp;'.TABLE_HEADING_OPT_WEIGHT.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="center">'.LEGEND_BOX.'</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_PRICE_TOTAL.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      // <tr class="attributes-...">
      $pos  = 0;
      $item = '<tr class="attributes-';
      for (;;) {
        $pos = strpos($html_body, $item, $pos);
        if ($pos === FALSE)
          break;

        $pos_tr  = strpos($html_body, '</tr>',      $pos);
        $pos_td  = strpos($html_body, '<td class=', $pos);
        if ($pos_td < $pos_tr) {
          $tdcount = 1;
          for (;;) {
            if ($pos_td === FALSE)
              break;
            if ($pos_td > $pos_tr)
              break;
            if ($tdcount == 6 ||
                $tdcount == 8 ||
                $tdcount == 15) {
              $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos_td, 3);
            }

            $pos_td = strpos($html_body, '<td', $pos_td+4);
            $tdcount++;
          }
        }

        $pos += strlen($item);
      }
    }

    $html_body = _attributes_controller_modify_insert($html_body);

    return $html_body;
  }

  // 商品オプション属性の管理(削除)
  function _attributes_controller_delete_product_attribute_modify($html_body) {
    $html_body = _attributes_controller_modify_common($html_body);

    // 重量の列の非表示
    // 属性の列の非表示
    // 値引の列の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_COLUMN != 'true') {
      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_OPT_WEIGHT_PREFIX.'&nbsp;'.TABLE_HEADING_OPT_WEIGHT.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="center">'.LEGEND_BOX.'</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_PRICE_TOTAL.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      // <tr class="attributes-...">
      $pos  = 0;
      $item = '<tr class="attributes-';
      for (;;) {
        $pos = strpos($html_body, $item, $pos);
        if ($pos === FALSE)
          break;

        $pos_tr  = strpos($html_body, '</tr>',      $pos);
        $pos_td  = strpos($html_body, '<td class=', $pos);
        if ($pos_td < $pos_tr) {
          $tdcount = 1;
          for (;;) {
            if ($pos_td === FALSE)
              break;
            if ($tdcount == 6 ||
                $tdcount == 8) {
              $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos_td, 3);
            }

            $pos_td = strpos($html_body, '<td', $pos_td+4);
            $tdcount++;
          }
        }

        $pos += strlen($item);
      }
    }

    return $html_body;
  }

  // 商品オプション属性の管理(削除)
  function _attributes_controller_delete_option_name_values_confirm_modify($html_body) {
    $html_body = _attributes_controller_modify_common($html_body);

    // カテゴリ選択プルダウンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_CATEGORIES != 'true') {
      $form  = 'name="new_category"';
      $pos   = strpos($html_body, $form);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$form, $pos, strlen($form));
    }

    // 商品選択プルダウンの非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_PRODUCTS != 'true') {
      $form = 'name="set_products_filter_id"';
      $pos  = strpos($html_body, $form);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    // 属性凡例の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_LEGEND != 'true') {
      $item = '<td class="smallText" align="right">'.LEGEND_BOX.'</td>';
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 重量の列の非表示
    // 属性の列の非表示
    // 値引の列の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_ATTRIBUTES_CONTROLLER_COLUMN != 'true') {
      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_OPT_WEIGHT_PREFIX.'&nbsp;'.TABLE_HEADING_OPT_WEIGHT.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="center">'.LEGEND_BOX.'</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      $item = '<td class="dataTableHeadingContent" align="right">&nbsp;'.TABLE_HEADING_PRICE_TOTAL.'&nbsp;</td>';
      $pos   = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));

      // <tr class="attributes-...">
      $pos  = 0;
      $item = '<tr class="attributes-';
      for (;;) {
        $pos = strpos($html_body, $item, $pos);
        if ($pos === FALSE)
          break;

        $pos_tr  = strpos($html_body, '</tr>',      $pos);
        $pos_td  = strpos($html_body, '<td class=', $pos);
        if ($pos_td < $pos_tr) {
          $tdcount = 1;
          for (;;) {
            if ($pos_td === FALSE)
              break;
            if ($tdcount == 6 ||
                $tdcount == 8) {
              $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos_td, 3);
            }

            $pos_td = strpos($html_body, '<td', $pos_td+4);
            $tdcount++;
          }
        }

        $pos += strlen($item);
      }
    }

    $html_body = _attributes_controller_modify_insert($html_body);

    return $html_body;
  }

  // バナーの管理
  function _banner_manager_modify($html_body) {
    // または下に新しいバナー・グループを登録の非表示(inputも)
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_NEW_GROUP != 'true') {
      $item = TEXT_BANNERS_NEW_GROUP;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE)
        $html_body = substr_replace($html_body, "", $pos, strlen($item));
      $html_body = _change_input($html_body, "new_banners_group");
    }

    // または下にサーバ上の画像ファイル名を入力の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_LOCAL != 'true') {
      $item = TEXT_BANNERS_IMAGE_LOCAL;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $posend = strpos($html_body, "</td>", $pos);
        if ($posend !== FALSE)
          $html_body = substr_replace($html_body, "", $pos, $posend-$pos);
      }
    }

    // 画像の保存先:の非表示
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_BANNER_MANAGER_IMAGE_TARGET != 'true') {
      $item = TEXT_BANNERS_IMAGE_TARGET;
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    return $html_body;
  }

  // 設定
  function _configuration_modify_gid_cid($html_body, $gid, $cid) {
    $key = MODULE_EASY_ADMIN_SIMPLIFY_KEY."CONFIGURATION_".$gid."_".$cid;
    if (!defined($key) || constant($key) != "true") {
      $item = zen_href_link(FILENAME_CONFIGURATION, 'gID='.$gid.'&cID='.$cid.'&action=edit"');
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
        $pos = strpos($html_body, "<tr", $pos);
        if ($pos !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, 3);
      }

      $item = zen_href_link(FILENAME_CONFIGURATION, 'gID='.$gid.'&cID='.$cid."&action=edit'");
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    return $html_body;
  }

  function _configuration_modify($html_body) {
    // ショップ全般の設定を非表示化
    $html_body = _configuration_modify_gid_cid($html_body, 1, 2);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 5);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 6);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 7);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 8);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 10);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 11);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 13);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 14);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 15);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 16);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 17);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 18);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 19);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 23);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 20);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 21);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 22);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 24);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 25);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 27);
    $html_body = _configuration_modify_gid_cid($html_body, 1, 28);

    // メールの設定の設定を非表示化
    $html_body = _configuration_modify_gid_cid($html_body, 12, 206);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 212);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 213);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 214);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 215);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 216);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 217);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 220);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 221);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 227);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 228);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 229);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 230);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 231);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 232);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 233);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 234);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 235);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 236);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 237);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 238);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 239);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 242);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 243);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 207);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 208);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 209);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 210);
    $html_body = _configuration_modify_gid_cid($html_body, 12, 211);

    return $html_body;
  }

  function _modules_modify_module($html_body, $module) {
    $key = MODULE_EASY_ADMIN_SIMPLIFY_KEY."MODULES_".strtoupper($module);
    if (!defined($key) || constant($key) != "true") {
      $item = zen_href_link(FILENAME_MODULES, 'set=ordertotal&module='.$module);
      $pos  = strpos($html_body, $item);
      if ($pos !== FALSE) {
        $tr = _find_tr($html_body, $pos);
        if ($tr !== FALSE)
          $html_body = substr_replace($html_body, "<tr ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);
      }
    }

    return $html_body;
  }

  function _modules_modify($html_body) {
    $html_body = _modules_modify_module($html_body, "ot_shipping");
    $html_body = _modules_modify_module($html_body, "ot_subtotal");
    $html_body = _modules_modify_module($html_body, "ot_total");

    return $html_body;
  }

  function _super_order_edit_modify($html_body) {
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PAYMENT != 'true') {
      $pos = strpos($html_body, TEXT_NO_PAYMENT_DATA);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 注文最終設定
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_FINAL != 'true') {
      $pos = strpos($html_body, TABLE_HEADING_FINAL_STATUS);
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 梱包を分割
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_SPLIT != 'true') {
      $pos = strpos($html_body, "arrow_south_east.gif");
      if ($pos !== FALSE) {
        $table = _find_table($html_body, $pos);
        if ($table !== FALSE)
          $html_body = substr_replace($html_body, "<table ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $table, 6);
      }
    }

    // 商品を修正
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_PRODUCTS != 'true') {
      $pos = strpos($html_body, "target=product");
      if ($pos !== FALSE) {
        $td = _find_td($html_body, $pos);
        if ($td !== FALSE)
          $html_body = substr_replace($html_body, "<td ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);
      }
    }

    // 梱包分割チェックボックス
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_SPLIT != 'true') {
      $str = 'name="incl_product_';
      $pos = 0;
      for (;;) {
        $pos = strpos($html_body, $str, $pos);
        if ($pos === false)
          break;
        $html_body = substr_replace($html_body, MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$str, $pos, strlen($str));
        $pos      += strlen(MODULE_EASY_ADMIN_SIMPLIFY_STYLE." ".$str);
      }
    }

    return $html_body;
  }

  function _super_edit_modify($html_body) {
    // .0000は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".0000", "", $html_body);
    }

    // .00は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SUPER_ORDERS_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".00", "", $html_body);
    }

    return $html_body;
  }

  function _salemaker_edit_modify($html_body) {
    // .0000は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SALEMAKER_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".0000", "", $html_body);
    }

    // .00は無し
    if (MODULE_EASY_ADMIN_SIMPLIFY_CONFIG_SALEMAKER_NUMBER_UNIT != 'true') {
      $html_body = str_replace(".00", "", $html_body);
    }

    return $html_body;
  }

  function _product_csv_csv_format_modify($html_body) {
    // csvはとりあえずペンディング
    return $html_body;

    // <option...>...English..</option>を検索する
    preg_match_all('(<option.*?>.*?</option>)', $html_body, $match);

    // 項目をユニークとする
    $options = array();
    for ($i=0; $i<count($match[0]); $i++) {
      $key = $match[0][$i];
      if (!isset($options[$key]))
        $options[$key] = $key;
    }

    // 無効にする
    foreach($options as $value) {
      if (strpos($value, "English") !== false) {
        $pos = 0;
        for (;;) {
          $pos = strpos($html_body, $value, $pos);
          if ($pos === false)
            break;
          $html_body = substr_replace($html_body, "", $pos, strlen($value));
        }
      }
      if (strpos($value, "税種別") !== false) {
        $pos = 0;
        for (;;) {
          $pos = strpos($html_body, $value, $pos);
          if ($pos === false)
            break;
          $html_body = substr_replace($html_body, "", $pos, strlen($value));
        }
      }
      if (strpos($value, "(Japanese)") !== false) {
        $replace = str_replace("(Japanese)", "", $value);
        $pos = 0;
        for (;;) {
          $pos = strpos($html_body, $value, $pos);
          if ($pos === false)
            break;
          $html_body = substr_replace($html_body, $replace, $pos, strlen($value));
        }
      }
    }

    return $html_body;
  }

  /////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////
  // $posで指定された位置に一番近い<aを検索する
  function _find_a($html, $pos) {
    $findstr  = '<a';
    $startpos = 0;
    $oldpos   = FALSE;
    for (;;) {
      $newpos = strpos($html, $findstr, $startpos);
      if ($newpos === FALSE)
        return $oldpos;
      if ($newpos >= $pos)
        return $oldpos;
      $oldpos   = $newpos;
      $startpos = $newpos + strlen($findstr);
    }
  }

  // $posで指定された位置に一番近い<tdを検索する
  function _find_td($html, $pos) {
    $findstr  = '<td';
    $startpos = 0;
    $oldpos   = FALSE;
    for (;;) {
      $newpos = strpos($html, $findstr, $startpos);
      if ($newpos === FALSE)
        return $oldpos;
      if ($newpos >= $pos)
        return $oldpos;
      $oldpos   = $newpos;
      $startpos = $newpos + strlen($findstr);
    }
  }

  // $posで指定された位置に一番近い<trを検索する
  function _find_tr($html, $pos) {
    $findstr  = '<tr';
    $startpos = 0;
    $oldpos   = FALSE;
    for (;;) {
      $newpos = strpos($html, $findstr, $startpos);
      if ($newpos === FALSE)
        return $oldpos;
      if ($newpos >= $pos)
        return $oldpos;
      $oldpos   = $newpos;
      $startpos = $newpos + strlen($findstr);
    }
  }

  // $posで指定された位置に一番近い</th>を検索する
  function _find_bth($html, $pos) {
    $findstr  = '</th>';
    $startpos = 0;
    $oldpos   = FALSE;
    for (;;) {
      $newpos = strpos($html, $findstr, $startpos);
      if ($newpos === FALSE)
        return $oldpos;
      if ($newpos >= $pos)
        return $oldpos;
      $oldpos   = $newpos;
      $startpos = $newpos + strlen($findstr);
    }
  }

  // $posで指定された位置に一番近い<tableを検索する
  function _find_table($html, $pos) {
    $findstr  = '<table';
    $startpos = 0;
    $oldpos   = FALSE;
    for (;;) {
      $newpos = strpos($html, $findstr, $startpos);
      if ($newpos === FALSE)
        return $oldpos;
      if ($newpos >= $pos)
        return $oldpos;
      $oldpos   = $newpos;
      $startpos = $newpos + strlen($findstr);
    }
  }

  // 国旗を非表示化
  function _change_image_icon($html) {
    $languages  = zen_get_languages();
    for ($i=0; $i<count($languages); $i++) {
      $image_src  = '"'.DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'].'"';
      $startpos   = 0;
      for (;;) {
        $pos = strpos($html, $image_src, $startpos);
        if ($pos === FALSE)
          break;
        $html     = substr_replace($html, '"images/pixel_trans.gif" width="24" height="14"', $pos, strlen($image_src));
        $startpos = $pos + strlen($image_src);
      }
    }
    return $html;
  }

  // 指定要素の非表示化
  function _change_input($html, $name) {
    $element  = 'name="'.$name.'"';
    $startpos = 0;
    for (;;) {
      $pos = strpos($html, $element, $startpos);
      if ($pos === FALSE)
        break;
      $html     = substr_replace($html, $element." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $pos, strlen($element));
      $startpos = $pos + strlen($element);
    }

    return $html;
  }

  // 指定要素の非表示化
  function _change_td($html, $element) {
    $pos = strpos($html, $element);
    if ($pos === FALSE)
      return $html;

    // 直前のTD検索
    $td = _find_td($html, $pos);
    if ($td !== FALSE)
      $html = substr_replace($html, '<td'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);

    // さらに直前のTD検索
    $td = _find_td($html, $td);
    if ($td !== FALSE)
      $html = substr_replace($html, '<td'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $td, 3);

    return $html;
  }

  // 指定要素の非表示化
  function _change_tr($html, $element) {
    $pos = strpos($html, $element);
    if ($pos === FALSE)
      return $html;

    // 直前のTR検索
    $tr = _find_tr($html, $pos);
    if ($tr !== FALSE)
      $html = substr_replace($html, '<tr'." ".MODULE_EASY_ADMIN_SIMPLIFY_STYLE, $tr, 3);

    return $html;
  }

  // 表示要素か確認
  function _isVisibleLanguage($code) {
    if ($code == 'ja' ||
        $code == 'ja-mobile') {
      return true;
    }
    else {
      return false;
    }
  }

?>
