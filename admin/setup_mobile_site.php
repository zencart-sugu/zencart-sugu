<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: setup_mobile_site.php 3813 2006-06-20 03:49:38Z ajeh $

  require('includes/application_top.php');
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  if (zen_not_null($action)) {
    switch ($action) {
      case 'setup':

        // expands languages.code column  char(2) -> varchar(20)
        $db->Execute("ALTER TABLE " . TABLE_LANGUAGES . " MODIFY code varchar(20) not null");

        // check orginal language is exists
        $code = zen_db_prepare_input($_GET['code']);
        $org_language = $db->Execute("select * from " . TABLE_LANGUAGES . " where code = '" . $code . "'");
        if( $org_language->RecordCount() == 0 ){
          $messageStack->add_session(ERROR_LANGUAGE_CODE_NOT_EXISTS, 'error');
          zen_redirect(zen_href_link(FILENAME_SETUP_MOBILE_SITE));
        }

        // insert mobile language
        $mobile_name = $org_language->fields['name'] . MOBILE_LANGUAGE_NAME_SUFFIX;
        $mobile_code = $org_language->fields['code'] . MOBILE_LANGUAGE_CODE_SUFFIX;
        $mobile_image = $org_language->fields['image'];
        $mobile_directory = $org_language->fields['directory'];
        $mobile_sort_order = $org_language->fields['sort_order'];

        $check = $db->Execute("select * from " . TABLE_LANGUAGES . " where code = '" . zen_db_prepare_input($mobile_code) . "'");
        if ($check->RecordCount() > 0) {
          $messageStack->add_session(ERROR_DUPLICATE_LANGUAGE_CODE, 'error');
          zen_redirect(zen_href_link(FILENAME_SETUP_MOBILE_SITE));
        } else {

          $db->Execute("insert into " . TABLE_LANGUAGES . "
                        (name, code, image, directory, sort_order)
                        values ('" . zen_db_input($mobile_name) . "', '" . zen_db_input($mobile_code) . "',
                                '" . zen_db_input($mobile_image) . "', '" . zen_db_input($mobile_directory) . "',
                                '" . zen_db_input($mobile_sort_order) . "')");

          $insert_id = $db->Insert_ID();

          // insert template_select
          $db->Execute("insert into " . TABLE_TEMPLATE_SELECT . "
                       (template_dir, template_language)
                       values ('" . zen_db_input(MOBILE_TEMPLATE_DIR) . "', '" . (int)$insert_id . "')");

// create additional ezpages records
/*
          $ezpages = $db->Execute("select * from " . TABLE_EZPAGES . "
                                   where languages_id = '" . (int)$org_language->fields['languages_id'] . "'");

          while (!$ezpages->EOF) {
            $db->Execute("insert into " . TABLE_EZPAGES . "
                          (languages_id, pages_title, alt_url, alt_url_external, pages_html_text, status_header, status_sidebox, status_footer, status_toc, header_sort_order, sidebox_sort_order, footer_sort_order, toc_sort_order, page_open_new_window, page_is_ssl, toc_chapter)
                          values ('" . (int)$insert_id . "',
                                  '" . zen_db_input($ezpages->fields['pages_title']) . "',
                                  '" . zen_db_input($ezpages->fields['alt_url']) . "',
                                  '" . zen_db_input($ezpages->fields['alt_url_external']) . "',
                                  '" . zen_db_input($ezpages->fields['pages_html_text']) . "',
                                  '" . zen_db_input($ezpages->fields['status_header']) . "',
                                  '" . zen_db_input($ezpages->fields['status_sidebox']) . "',
                                  '" . zen_db_input($ezpages->fields['status_footer']) . "',
                                  '" . zen_db_input($ezpages->fields['status_toc']) . "',
                                  '" . zen_db_input($ezpages->fields['header_sort_order']) . "',
                                  '" . zen_db_input($ezpages->fields['sidebox_sort_order']) . "',
                                  '" . zen_db_input($ezpages->fields['footer_sort_order']) . "',
                                  '" . zen_db_input($ezpages->fields['toc_sort_order']) . "',
                                  '" . zen_db_input($ezpages->fields['page_open_new_window']) . "',
                                  '" . zen_db_input($ezpages->fields['page_is_ssl']) . "',
                                  '" . zen_db_input($ezpages->fields['toc_chapter']) . "')");
            $ezpages->MoveNext();
          }
*/
// create additional configuration_foreach_template records
          if (file_exists(DIR_FS_CATALOG.DIR_WS_CLASSES.'ZenCart/configuration_for_zen_mobile.csv')){
            $fp = fopen(DIR_FS_CATALOG.DIR_WS_CLASSES.'ZenCart/configuration_for_zen_mobile.csv','r');
            if($fp){
              while (($data = fgetcsv($fp, 1000, ',')) !== FALSE) { 
                if(!empty($data[0])){
                  $cfg = $db->Execute('SELECT * FROM '.TABLE_CONFIGURATION.' WHERE configuration_key="'.$data[0].'"');
                  $check_cfg_ft = $db->Execute('SELECT configuration_key FROM '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.' 
                                      WHERE configuration_key="'.$data[0].'" AND template_dir="'.MOBILE_TEMPLATE_DIR.'"');
                  if(empty($check_cfg_ft->fields['configuration_key'])){
                    $insertquery = 'INSERT INTO '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.' 
                                   (configuration_id,configuration_title,configuration_key,
                                   configuration_value,configuration_description,configuration_group_id,
                                   template_dir,sort_order,last_modified,date_added,use_function,set_function)
                                   VALUES(NULL'.
                                   ',"'.zen_db_input($cfg->fields['configuration_title']).'"'.
                                   ',"'.zen_db_input($data[0]).'"'.
                                   ',"'.zen_db_input($data[1]).'"'.
                                   ',"'.zen_db_input($cfg->fields['configuration_description']).'"'.
                                   ',"'.zen_db_input($cfg->fields['configuration_group_id']).'"'.
                                   ',"'.zen_db_input(MOBILE_TEMPLATE_DIR).'"'.
                                   ',"'.zen_db_input($cfg->fields['sort_order']).'"'.
                                   ',"'.zen_db_input($cfg->fields['last_modified']).'"'.
                                   ',"'.zen_db_input($cfg->fields['date_added']).'"'.
                                   ',"'.zen_db_input($cfg->fields['use_function']).'"'.
                                   ',"'.zen_db_input($cfg->fields['set_function']).'")';
                    $db->Execute($insertquery);
                  }
                }
              }
              fclose($fp);
            }
          }

// create additional layout_boxes records for zen_mobile
          if (file_exists(DIR_FS_CATALOG.DIR_WS_CLASSES.'ZenCart/layout_boxes_for_zen_mobile.csv')){
            $fp = fopen(DIR_FS_CATALOG.DIR_WS_CLASSES.'ZenCart/layout_boxes_for_zen_mobile.csv','r');
            if($fp){
              $db->Execute('delete from '.TABLE_LAYOUT_BOXES.' where layout_template="'.MOBILE_TEMPLATE_DIR.'"');
              while (($data = fgetcsv($fp, 1000, ',')) !== FALSE) { 
                if(!empty($data[0])){
                $insertquery = 'INSERT INTO '.TABLE_LAYOUT_BOXES.' 
                      (layout_id,
                       layout_template,
                       layout_box_name,
                       layout_box_status,
                       layout_box_location,
                       layout_box_sort_order,
                       layout_box_sort_order_single,
                       layout_box_status_single,
                       layout_page) 
                 VALUES(null,
                       "'.MOBILE_TEMPLATE_DIR.'",
                       "'.zen_db_input($data[0]).'"'.
                       ',"'.zen_db_input($data[1]).'"'.
                       ',"'.zen_db_input($data[2]).'"'.
                       ',"'.zen_db_input($data[3]).'"'.
                       ',"'.zen_db_input($data[4]).'"'.
                       ',"'.zen_db_input($data[5]).'"'.
                       ',"'.zen_db_input($data[6]).'")';
                  $db->Execute($insertquery);
                }
              }
              fclose($fp);
            }
          }
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
/*
	  // create carrier table
	  $carriers = $db->Execute("create table if not exists " . TABLE_CARRIER . " (
                                    carrier_id int(11) NOT NULL auto_increment,
                                    carrier_code varchar(20) UNIQUE NOT NULL default '',
                                    carrier_name varchar(64) NOT NULL default '',
                                    PRIMARY KEY (carrier_id),
                                    KEY idx_carrier_code_zen (carrier_code)
                                  ) TYPE=MyISAM;");

	  // create emoji table
	  $carriers = $db->Execute("create table if not exists " . TABLE_EMOJI . " (
                                    emoji_id int(11) NOT NULL auto_increment,
                                    emoji_name varchar(64) UNIQUE NOT NULL default '',
                                    PRIMARY KEY (emoji_id),
                                    KEY idx_emoji_name_zen (emoji_name)
                                    ) TYPE=MyISAM;");

	  // create carrier_emoji table
	  $carriers = $db->Execute("create table if not exists " . TABLE_CARRIER_EMOJI . " (
                                    carrier_id int(11) NOT NULL default '0',
                                    emoji_id int(11) NOT NULL default '0',
                                    emoji_value varchar(32) NOT NULL default '',
                                    PRIMARY KEY (carrier_id, emoji_id)
                                  ) TYPE=MyISAM;");

	  // insert into carrier
	  $carrier_name_code_array = array(array("carrier_name" => "DoCoMo",
						 "carrier_code" => "I"),
					   array("carrier_name" => "EZweb",
						 "carrier_code" => "E"),
					   array("carrier_name" => "Softbank",
						 "carrier_code" => "V"));

	  foreach ($carrier_name_code_array as $carrier_name_code) {
	    $carrier_name = $db->Execute("select carrier_name
                                          from " . TABLE_CARRIER . "
                                          where carrier_name='" . $carrier_name_code["carrier_name"]. "'");

	    if ($carrier_name->EOF) {
	      $db->Execute("insert into " . TABLE_CARRIER . "
                            (carrier_code, carrier_name)
                             values ('" . $carrier_name_code["carrier_code"] . "', 
                                     '" . $carrier_name_code["carrier_name"] . "')");
	    }
	  }
*/	  
	  // add layout_page column intolayout_boxes 
	  $layout_page_exists = false;
	  $result = $db->Execute("show fields from " . TABLE_LAYOUT_BOXES);
	  while (!$result->EOF) {
	    if  ($result->fields['Field'] == 'layout_page') {
	      $layout_page_exists = true;
	    }
	    $result->MoveNext();
	  }

	  if (! $layout_page_exists) {
	    $db->Execute("ALTER TABLE " . TABLE_LAYOUT_BOXES . " ADD layout_page VARCHAR(64) DEFAULT ''");
	  }

        }

        $messageStack->add_session(SETUP_MOBILE_SITE_SUCCESS, 'success');
        zen_redirect(zen_href_link(FILENAME_SETUP_MOBILE_SITE));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $mobile_setuped_languages = array();
  $mobile_not_setuped_languages = array();

  // get all languages except mobile languages
  $languages = $db->Execute("select * from " . TABLE_LANGUAGES . " where code NOT like '%" . MOBILE_LANGUAGE_CODE_SUFFIX . "' order by sort_order");
  while( !$languages->EOF ){
    // check [code + MOBILE_LANGUAGE_CODE_SUFFIX] language.code is exist
    $mobile_template_info = $db->Execute("select template_dir from " . TABLE_LANGUAGES . " as l, " . TABLE_TEMPLATE_SELECT . " as ts where code = '" . zen_db_input($languages->fields['code'] . MOBILE_LANGUAGE_CODE_SUFFIX) . "' and l.languages_id = ts.template_language");

    if( $mobile_template_info->RecordCount() > 0 ){
      $mobile_setuped_languages[] = array_merge($languages->fields, array('template_dir' => $mobile_template_info->fields['template_dir']));
    }else{
      $mobile_not_setuped_languages[] = $languages->fields;
    }
    $languages->MoveNext();
  }
?>
<?php
  if( count($mobile_setuped_languages) > 0 ){
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><br><br><?php echo MOBILE_SETUPED_TITLE; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="500" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_CODE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MOBILE_TEMPLATE; ?></td>
              </tr>
<?php
    foreach( $mobile_setuped_languages as $setuped_language ){
?>
              <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $setuped_language['directory'] . '/images/' . $setuped_language['image'], $setuped_language['name']) . $setuped_language['name']; ?></td>
                <td class="dataTableContent"><?php echo $setuped_language['code']; ?></td>
                <td class="dataTableContent"><?php echo $setuped_language['template_dir']; ?></td>
              </tr>
<?php
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
<?php
  if( count($mobile_not_setuped_languages) > 0 ){
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><br><br><?php echo MOBILE_NOT_SETUPED_TITLE; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="600" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_CODE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MOBILE_TEMPLATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?></td>
              </tr>
<?php
    foreach( $mobile_not_setuped_languages as $not_setuped_language ){
?>
              <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $not_setuped_language['directory'] . '/images/' . $not_setuped_language['image'], $not_setuped_language['name']) . $not_setuped_language['name']; ?></td>
                <td class="dataTableContent"><?php echo $not_setuped_language['code']; ?></td>
                <td class="dataTableContent"><?php echo MOBILE_TEMPLATE_DIR; ?></td>
                <td class="dataTableContent" align="right"><a href="<?php echo zen_href_link(FILENAME_SETUP_MOBILE_SITE, 'action=setup&code=') . $not_setuped_language['code'] ?>"><?php echo ACTION_SETUP_MOBILE_SITE ?></a></td>
              </tr>
<?php
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
