<?php
/**
 * addon_modules_example Module
 *
 * @package Viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class zen_smartphone extends addonModuleBase {
    var $author                        = array("tiadeen2");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title       = MODULE_ZEN_SMARTPHONE_TITLE;
    var $description = MODULE_ZEN_SMARTPHONE_DESCRIPTION;
    var $sort_order  = MODULE_ZEN_SMARTPHONE_SORT_ORDER;
    var $icon;
    var $status      = MODULE_ZEN_SMARTPHONE_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_ZEN_SMARTPHONE_STATUS_TITLE,
            'configuration_key'         => 'MODULE_ZEN_SMARTPHONE_STATUS',
            'configuration_value'       => MODULE_ZEN_SMARTPHONE_STATUS_DEFAULT,
            'configuration_description' => MODULE_ZEN_SMARTPHONE_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
          ),
          array(
            'configuration_title'       => MODULE_ZEN_SMARTPHONE_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_ZEN_SMARTPHONE_SORT_ORDER',
            'configuration_value'       => MODULE_ZEN_SMARTPHONE_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ZEN_SMARTPHONE_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier        = array();

    // class constructer for php4
    function zen_smartphone() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
      global $db;

      $db->Execute("ALTER TABLE " . TABLE_LANGUAGES . " MODIFY code varchar(20) not null");

      // レイアウト用設定
      if (file_exists("../".$this->dir.'zc_install/layout_boxes_for_zen_smartphone.csv')){
        $fp = fopen("../".$this->dir.'zc_install/layout_boxes_for_zen_smartphone.csv', 'r');
        if ($fp){
          while (($data = fgetcsv($fp, 1000, ',')) !== FALSE) { 
            if (!empty($data[0])){
              $sql_data_array = array(
                                  'layout_template'              => MOBILE_ZEN_SMARTPHONE_TEMPLATE_DIR,
                                  'layout_box_name'              => $data[0],
                                  'layout_box_status'            => $data[1],
                                  'layout_box_location'          => $data[2],
                                  'layout_box_sort_order'        => $data[3],
                                  'layout_box_sort_order_single' => $data[4],
                                  'layout_box_status_single'     => $data[5],
                                  'layout_page'                  => $data[6],
                                );
              zen_db_perform(TABLE_LAYOUT_BOXES, $sql_data_array);
            }
          }
          fclose($fp);
        }
      }

      $org_language = $db->Execute("select * from ".TABLE_LANGUAGES." where code not like '%-%'");
      while (!$org_language->EOF) {
        // コード追加
        $sql_data_array = array(
                            'name'       => $org_language->fields['name'].MODULE_ZEN_SMARTPHONE_NAME_SUFFIX,
                            'code'       => $org_language->fields['code'].MODULE_ZEN_SMARTPHONE_CODE_SUFFIX,
                            'image'      => $org_language->fields['image'],
                            'directory'  => $org_language->fields['directory'],
                            'sort_order' => $org_language->fields['sort_order'],
                          );
        zen_db_perform(TABLE_LANGUAGES, $sql_data_array);
        // テンプレート追加
        $insert_id = $db->Insert_ID();
        $sql_data_array = array(
                            'template_dir'      => MOBILE_ZEN_SMARTPHONE_TEMPLATE_DIR,
                            'template_language' => $insert_id,
                          );
        zen_db_perform(TABLE_TEMPLATE_SELECT, $sql_data_array);

        // create additional record_artists_info records
        $record_artists_info = $db->Execute("select * from " . TABLE_RECORD_ARTISTS_INFO . "
                                             where languages_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$record_artists_info->EOF) {
          $db->Execute("insert into " . TABLE_RECORD_ARTISTS_INFO . "
                        (artists_id, languages_id, artists_url)
                        values ('" . (int)$record_artists_info->fields['artists_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($record_artists_info->fields['toc_chaper']) . "')");
          $record_artists_info->MoveNext();
        }

        // create additional record_company_info records
        $record_company_info = $db->Execute("select * from " . TABLE_RECORD_COMPANY_INFO . "
                                             where languages_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$record_company_info->EOF) {
          $db->Execute("insert into " . TABLE_RECORD_COMPANY_INFO . "
                        (record_company_id, languages_id, record_company_url)
                        values ('" . (int)$record_company_info->fields['record_company_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($record_company_info->fields['record_company_url']) . "')");
          $record_company_info->MoveNext();
        }

        // create additional reviews_description records
        $reviews_description = $db->Execute("select * from " . TABLE_REVIEWS_DESCRIPTION . "
                                             where languages_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$reviews_description->EOF) {
          $db->Execute("insert into " . TABLE_REVIEWS_DESCRIPTION . "
                        (reviews_id, languages_id, reviews_text)
                        values ('" . (int)$reviews_description->fields['reviews_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($reviews_description->fields['reviews_text']) . "')");
          $reviews_description->MoveNext();
        }

        // ++ hereafter, as well as language.php ++
        // create additional categories_description records
        $categories = $db->Execute("select c.categories_id, cd.categories_name,
                                    categories_description
                                    from " . TABLE_CATEGORIES . " c
                                    left join " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                    on c.categories_id = cd.categories_id
                                    where cd.language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$categories->EOF) {
          $db->Execute("insert into " . TABLE_CATEGORIES_DESCRIPTION . "
                        (categories_id, language_id, categories_name,
                        categories_description)
                        values ('" . (int)$categories->fields['categories_id'] . "', '" . (int)$insert_id . "',
                                '" . zen_db_input($categories->fields['categories_name']) . "',
                                '" . zen_db_input($categories->fields['categories_description']) . "')");
          $categories->MoveNext();
        }

        // create additional products_description records
        $products = $db->Execute("select p.products_id, pd.products_name, pd.products_description,
                                         pd.products_url
                                  from " . TABLE_PRODUCTS . " p
                                  left join " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                  on p.products_id = pd.products_id
                                  where pd.language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$products->EOF) {
          $db->Execute("insert into " . TABLE_PRODUCTS_DESCRIPTION . "
                       (products_id, language_id, products_name, products_description, products_url)
                       values ('" . (int)$products->fields['products_id'] . "',
                               '" . (int)$insert_id . "',
                               '" . zen_db_input($products->fields['products_name']) . "',
                               '" . zen_db_input($products->fields['products_description']) . "',
                               '" . zen_db_input($products->fields['products_url']) . "')");
          $products->MoveNext();
        }

        // create additional meta_tags_products_description records
        $meta_tags_products = $db->Execute("select mt.products_id, mt.metatags_title, mt.metatags_keywords,
                                              mt.metatags_description
                                            from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION. " mt
                                            where mt.language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$meta_tags_products->EOF) {
          $db->Execute("insert into " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . "
                        (products_id, language_id, metatags_title, metatags_keywords, metatags_description)
                        values ('" . (int)$meta_tags_products->fields['products_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($meta_tags_products->fields['metatags_title']) . "',
                                '" . zen_db_input($meta_tags_products->fields['metatags_keywords']) . "',
                                '" . zen_db_input($meta_tags_products->fields['metatags_description']) . "')");
          $meta_tags_products->MoveNext();
        }

        // create additional meta_tags_categories_description records
        $meta_tags_categories = $db->Execute("select mt.categories_id, mt.metatags_title, mt.metatags_keywords,
                                                mt.metatags_description
                                              from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION. " mt
                                              where mt.language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$meta_tags_categories->EOF) {
          $db->Execute("insert into " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . "
                        (categories_id, language_id, metatags_title, metatags_keywords, metatags_description)
                        values ('" . (int)$meta_tags_categories->fields['categories_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($meta_tags_categories->fields['metatags_title']) . "',
                                '" . zen_db_input($meta_tags_categories->fields['metatags_keywords']) . "',
                                '" . zen_db_input($meta_tags_categories->fields['metatags_description']) . "')");
          $meta_tags_categories->MoveNext();
        }

        // create additional products_options records
        $products_options = $db->Execute("select products_options_id, products_options_name,
                                            products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size,
                                            products_options_images_per_row, products_options_images_style
                                          from " . TABLE_PRODUCTS_OPTIONS . "
                                          where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$products_options->EOF) {
          $db->Execute("insert into " . TABLE_PRODUCTS_OPTIONS . "
                        (products_options_id, language_id, products_options_name,
                         products_options_sort_order, products_options_type, products_options_length, products_options_comment, products_options_size, products_options_images_per_row, products_options_images_style)
                        values ('" . (int)$products_options->fields['products_options_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($products_options->fields['products_options_name']) . "',
                                '" . zen_db_input($products_options->fields['products_options_sort_order']) . "',
                                '" . zen_db_input($products_options->fields['products_options_type']) . "',
                                '" . zen_db_input($products_options->fields['products_options_length']) . "',
                                '" . zen_db_input($products_options->fields['products_options_comment']) . "',
                                '" . zen_db_input($products_options->fields['products_options_size']) . "',
                                '" . zen_db_input($products_options->fields['products_options_images_per_row']) . "',
                                '" . zen_db_input($products_options->fields['products_options_images_style']) . "')");
          $products_options->MoveNext();
        }

        // create additional products_options_values records
        $products_options_values = $db->Execute("select products_options_values_id,
                                                   products_options_values_name, products_options_values_sort_order
                                                 from " . TABLE_PRODUCTS_OPTIONS_VALUES . "
                                                 where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$products_options_values->EOF) {
          $db->Execute("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . "
                      (products_options_values_id, language_id, products_options_values_name, products_options_values_sort_order)
                       values ('" . (int)$products_options_values->fields['products_options_values_id'] . "',
                               '" . (int)$insert_id . "', '" . zen_db_input($products_options_values->fields['products_options_values_name']) . "', '" . zen_db_input($products_options_values->fields['products_options_values_sort_order']) . "')");
          $products_options_values->MoveNext();
        }

        // create additional manufacturers_info records
        $manufacturers = $db->Execute("select m.manufacturers_id, mi.manufacturers_url
                                       from " . TABLE_MANUFACTURERS . " m
                                       left join " . TABLE_MANUFACTURERS_INFO . " mi
                                       on m.manufacturers_id = mi.manufacturers_id
                                       where mi.languages_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$manufacturers->EOF) {
          $db->Execute("insert into " . TABLE_MANUFACTURERS_INFO . "
                       (manufacturers_id, languages_id, manufacturers_name, manufacturers_url)
                        values ('" . $manufacturers->fields['manufacturers_id'] . "', '" . (int)$insert_id . "',
                                '" . zen_db_input($manufacturers->fields['manufacturers_name']) . "',
                                '" . zen_db_input($manufacturers->fields['manufacturers_url']) . "')");
          $manufacturers->MoveNext();
        }

        // create additional orders_status records
        $orders_status = $db->Execute("select orders_status_id, orders_status_name
                                       from " . TABLE_ORDERS_STATUS . "
                                       where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$orders_status->EOF) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . "
                        (orders_status_id, language_id, orders_status_name)
                        values ('" . (int)$orders_status->fields['orders_status_id'] . "',
                                '" . (int)$insert_id . "',
                                '" . zen_db_input($orders_status->fields['orders_status_name']) . "')");
          $orders_status->MoveNext();
        }

        if (defined('TABLE_TAX_CLASS_M17N')) {
          $tax_class_m17n = $db->Execute("select tax_class_id, language_id, tax_class_title, tax_class_description
                                          from " . TABLE_TAX_CLASS_M17N . "
                                          where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

          while (!$tax_class_m17n->EOF) {
            $db->Execute("insert into " . TABLE_TAX_CLASS_M17N . "
                          (tax_class_id, language_id, tax_class_title, tax_class_description)
                          values ('" . (int)$tax_class_m17n->fields['tax_class_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($tax_class_m17n->fields['tax_class_title']) . "',
                                  '" . zen_db_input($tax_class_m17n->fields['tax_class_description']) . "')");
            $tax_class_m17n->MoveNext();
          }
        }

        if (defined('TABLE_TAX_RATES_M17N')) {
          $tax_rates_m17n = $db->Execute("select tax_rates_id, language_id, tax_description
                                          from " . TABLE_TAX_RATES_M17N . "
                                          where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

          while (!$tax_rates_m17n->EOF) {
            $db->Execute("insert into " . TABLE_TAX_RATES_M17N . "
                          (tax_rates_id, language_id, tax_description)
                          values ('" . (int)$tax_rates_m17n->fields['tax_rates_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($tax_rates_m17n->fields['tax_description']) . "')");
            $tax_rates_m17n->MoveNext();
          }
        }

        if (defined('TABLE_CURRENCIES_M17N')) {
          $currencies_m17n = $db->Execute("select currencies_id, language_id, symbol_left, symbol_right
                                           from " . TABLE_CURRENCIES_M17N . "
                                           where language_id = '" . (int)$org_language->fields['languages_id'] . "'");
  
          while (!$currencies_m17n->EOF) {
            $db->Execute("insert into " . TABLE_CURRENCIES_M17N . "
                          (currencies_id, language_id, symbol_left, symbol_right)
                          values ('" . (int)$currencies_m17n->fields['currencies_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($currencies_m17n->fields['symbol_left']) . "',
                                  '" . zen_db_input($currencies_m17n->fields['symbol_right']) . "')");
            $currencies_m17n->MoveNext();
          }
        }

        if (defined('TABLE_GROUP_PRICING_M17N')) {
          $group_pricing_m17n = $db->Execute("select group_id, language_id, group_name
                                              from " . TABLE_GROUP_PRICING_M17N . "
                                              where language_id = '" . (int)$org_language->fields['languages_id'] . "'");
  
          while (!$group_pricing_m17n->EOF) {
            $db->Execute("insert into " . TABLE_GROUP_PRICING_M17N . "
                          (group_id, language_id, group_name)
                          values ('" . (int)$group_pricing_m17n->fields['group_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($group_pricing_m17n->fields['group_name']) . "')");
            $group_pricing_m17n->MoveNext();
          }
        }

        if (defined('TABLE_ZONES_M17N')) {
          $zones_m17n = $db->Execute("select zone_id, language_id, zone_name_m17n
                                      from " . TABLE_ZONES_M17N . "
                                      where language_id = '" . (int)$org_language->fields['languages_id'] . "'");
  
          while (!$zones_m17n->EOF) {
            $db->Execute("insert into " . TABLE_ZONES_M17N . "
                          (zone_id, language_id, zone_name_m17n)
                          values ('" . (int)$zones_m17n->fields['zone_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($zones_m17n->fields['zone_name_m17n']) . "')");
            $zones_m17n->MoveNext();
          }
        }

        if (MODULE_EMAIL_TEMPLATES_STATUS == 'true') {
          $email_templates_description = 
          $db->Execute("select email_templates_id, language_id, subject, contents
                        from " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . "
                        where language_id = '" . (int)$org_language->fields['languages_id'] . "'");

          while (!$email_templates_description->EOF) {
            $db->Execute("insert into " . TABLE_EMAIL_TEMPLATES_DESCRIPTION . "
                          (email_templates_id, language_id, subject, contents)
                          values ('" . (int)$email_templates_description->fields['email_templates_id'] . "',
                                  '" . (int)$insert_id . "',
                                  '" . zen_db_input($email_templates_description->fields['subject']) . "',
                                  '" . zen_db_input($email_templates_description->fields['contents']) . "')");
            $email_templates_description->MoveNext();
          }
        }

        // create additional coupons_description records
        $coupons = $db->Execute("select c.coupon_id, cd.coupon_name, cd.coupon_description
                                  from " . TABLE_COUPONS . " c
                                  left join " . TABLE_COUPONS_DESCRIPTION . " cd
                                  on c.coupon_id = cd.coupon_id
                                  where cd.language_id = '" . (int)$org_language->fields['languages_id'] . "'");

        while (!$coupons->EOF) {
          $db->Execute("insert into " . TABLE_COUPONS_DESCRIPTION . "
                        (coupon_id, language_id, coupon_name, coupon_description)
                         values ('" . (int)$coupons->fields['coupon_id'] . "',
                                 '" . (int)$insert_id . "',
                                 '" . zen_db_input($coupons->fields['coupon_name']) . "',
                                 '" . zen_db_input($coupons->fields['coupon_description']) . "')");
          $coupons->MoveNext();
        }

        $org_language->MoveNext();
      }
    }

    function _update() {
    }

    function _remove() {
      global $db;

      // 追加した言語に関連するものの削除
      $smartphone_language = $db->Execute("select * from ".TABLE_LANGUAGES." where code like '%".MODULE_ZEN_SMARTPHONE_CODE_SUFFIX."'");
      while (!$smartphone_language->EOF) {
        $languages_id = $smartphone_language->fields['languages_id'];
        $db->Execute("delete from " . TABLE_RECORD_ARTISTS_INFO .             " where languages_id=" . (int)$languages_id);
        $db->Execute("delete from " . TABLE_RECORD_COMPANY_INFO .             " where languages_id=" . (int)$languages_id);
        $db->Execute("delete from " . TABLE_REVIEWS_DESCRIPTION .             " where languages_id=" . (int)$languages_id);
        $db->Execute("delete from " . TABLE_CATEGORIES_DESCRIPTION .          " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_PRODUCTS_DESCRIPTION .            " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION .  " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_METATAGS_CATEGORIES_DESCRIPTION . " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_PRODUCTS_OPTIONS .                " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES .         " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_MANUFACTURERS_INFO .              " where languages_id=" . (int)$languages_id);
        $db->Execute("delete from " . TABLE_ORDERS_STATUS .                   " where language_id="  . (int)$languages_id);
        if (defined('TABLE_TAX_CLASS_M17N'))     $db->Execute("delete from " . TABLE_TAX_CLASS_M17N .     " where language_id="  . (int)$languages_id);
        if (defined('TABLE_TAX_RATES_M17N'))     $db->Execute("delete from " . TABLE_TAX_RATES_M17N .     " where language_id="  . (int)$languages_id);
        if (defined('TABLE_CURRENCIES_M17N'))    $db->Execute("delete from " . TABLE_CURRENCIES_M17N .    " where language_id="  . (int)$languages_id);
        if (defined('TABLE_GROUP_PRICING_M17N')) $db->Execute("delete from " . TABLE_GROUP_PRICING_M17N . " where language_id="  . (int)$languages_id);
        if (defined('TABLE_ZONES_M17N'))         $db->Execute("delete from " . TABLE_ZONES_M17N .         " where language_id="  . (int)$languages_id);
        $db->Execute("delete from " . TABLE_COUPONS_DESCRIPTION .             " where language_id="  . (int)$languages_id);

        if (MODULE_EMAIL_TEMPLATES_STATUS == 'true') {
          $db->Execute("delete from " . TABLE_EMAIL_TEMPLATES_DESCRIPTION .   " where language_id=" . (int)$languages_id);
        }

        $smartphone_language->MoveNext();
      }

      $db->Execute("delete from ".TABLE_LANGUAGES." where code like '%".MODULE_ZEN_SMARTPHONE_CODE_SUFFIX."'");
      $db->Execute("delete from ".TABLE_LAYOUT_BOXES." where layout_template='".MOBILE_ZEN_SMARTPHONE_TEMPLATE_DIR."'");
    }

    function _cleanUp() {
    }

    function page_categories_list() {
      global $db;
      $return = array();
      
      require_once(DIR_FS_CATALOG . $this->dir . 'classes/zen_smartphone_model.php');
      $model = new zen_smartphone_model();
      $categories = $model->getCategories($db);
//print_R($categories);
      return array(
        'categories' => $categories,
      );
    }

    function page_image_description() {
      $return = array();
      
      require_once(DIR_FS_CATALOG . $this->dir . 'classes/zen_smartphone_model.php');
      $model = new zen_smartphone_model();
      $product = $model->getProductInfo($_GET['products_id']);
//print_R($product);
      return array(
        'product' => $product,
      );
    }

    function page_xsell_list() {
      return $return = array();
    }
    function page_xsell_list_parts() {
      return $return = array();
    }

  }
?>