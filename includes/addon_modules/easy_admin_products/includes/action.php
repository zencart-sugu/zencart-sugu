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

if (file_exists(DIR_WS_CLASSES . 'split_page_results.php')) {
  require_once(DIR_WS_CLASSES . 'split_page_results.php');
}
require(dirname(__FILE__) . '/../classes/easy_admin_products_with_attributes_stock.php');

global $zco_notifier;
global $easy_admin_products_product;
global $easy_admin_products_validate;
global $easy_admin_products_product_id;
global $easy_admin_products_searchs;

// 検索条件が指定されていた場合はセッションへ
// 指定されていない場合はセッションから戻す
$zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SEARCH');
$searchs  = array(
  'category_id',
  'title',
  'model',
  'manufacturer',
  'description',
  'special'
);
if (is_array($easy_admin_products_searchs)) {
  foreach($easy_admin_products_searchs as $v)
    $searchs[] = $v;
}


$languages = zen_get_languages();
$model     = new easy_admin_products_model();
$html      = new easy_admin_products_html();
$action    = (isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index');

$model->set_get_search_condition($searchs);

require(dirname(__FILE__) . '/products.php');

$special  = array(
  array('id' => '',                   'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SELECT),
  array('id' => 'special_download',   'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DOWNLOAD),
  array('id' => 'special_featured',   'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_FEATURED),
  array('id' => 'special_special',    'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_SPECIAL),
  array('id' => 'special_quantity',   'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_QUANTITY),
  array('id' => 'special_arrival',    'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_ARRIVAL),
  array('id' => 'special_display',    'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_DISPLAY),
  array('id' => 'special_nondisplay', 'text' => MODULE_EASY_ADMIN_PRODUCTS_SPECIAL_NONDISPLAY),
);

$template  = "index";
$zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_ACTION');
switch($action) {
  case 'index':
    break;

  case 'status_on':
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_STATUS_ON');
    $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_STATUS, 'success');
    $model->change_status($_REQUEST['products_id'], 1);
    break;

  case 'status_off':
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_STATUS_OFF');
    $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_STATUS, 'success');
    $model->change_status($_REQUEST['products_id'], 0);
    break;

  case 'new':
    $template = "edit";
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_EDIT');
    $columns  = array(
                  "languages"                             => $languages,
                  "products_column"                       => $products_column,
                  "products_description_column"           => $products_description_column,
                  "featured_column"                       => $featured_column,
                  "specials_column"                       => $specials_column,
                  "meta_tags_products_description_column" => $meta_tags_products_description_column,
                );
    $product  = $model->new_product($columns);
    $product['categories'] = $_SESSION['category_id'];
    $easy_admin_products_validate = array();
    break;

  case 'edit':
    $template = "edit";
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_EDIT');
    $columns  = array(
                  "languages"                             => $languages,
                  "products_column"                       => $products_column,
                  "products_description_column"           => $products_description_column,
                  "featured_column"                       => $featured_column,
                  "specials_column"                       => $specials_column,
                  "meta_tags_products_description_column" => $meta_tags_products_description_column,
                );
    $product  = $model->load_product($columns, $_REQUEST['products_id']);
    $easy_admin_products_validate = array();

    // open/close settings
    $open_price_setting    = $model->is_default_price_setting($product);
    $open_shipping_setting = $model->is_default_shipping_setting($product);
    $open_cart_setting     = $model->is_default_cart_setting($product);
    $open_seo_setting      = $model->is_default_seo_setting($product);

    break;

  case 'save':
    $template = "edit";
    $product  = array();
    foreach($_POST as $k => $v) {
      $product[$k] = $v;
    }
    $product['categories'] = $product['categories_id'];

    $easy_admin_products_product  = $product;
    $easy_admin_products_validate = $model->validate_save($product);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_SAVE');
    $product                      = $easy_admin_products_product;
    $product['products_additional_image'] = easy_admin_products_model::get_additional_image($product['products_image']);

    // open/close settings
    $open_price_setting    = $model->is_default_price_setting($product);
    $open_shipping_setting = $model->is_default_shipping_setting($product);
    $open_cart_setting     = $model->is_default_cart_setting($product);
    $open_seo_setting      = $model->is_default_seo_setting($product);

    if (count($easy_admin_products_validate) > 0) {
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_ERROR_SAVE, 'error');
    }
    else {
      $products_id = $model->save_product($product);
      if ($product['products_id'] > 0)
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_UPDATE, 'success');
      else
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_INSERT, 'success');
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products&products_id='.(int)$products_id.'&action=edit'));
    }
    break;

  case 'delete':
    $template = "delete";
    $columns  = array(
                  "languages"                             => $languages,
                  "products_column"                       => $products_column,
                  "products_description_column"           => $products_description_column,
                  "featured_column"                       => $featured_column,
                  "specials_column"                       => $specials_column,
                  "meta_tags_products_description_column" => $meta_tags_products_description_column,
                );
    $product  = $model->load_product($columns, $_REQUEST['products_id']);
    break;

  case 'delete_process':
    $template = "index";
    $easy_admin_products_product_id = (int)$_REQUEST['products_id'];
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_DELETE');
    $model->delete_product($_REQUEST['products_id'], $_REQUEST['products_image']);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DELETE');
    $messageStack->add(sprintf(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_DELETE, $_REQUEST['products_name']."(ID:".$_REQUEST['products_id'].")"), 'success');
    break;

  case 'copy':
    $template = "copy";
    $columns  = array(
                  "languages"                             => $languages,
                  "products_column"                       => $products_column,
                  "products_description_column"           => $products_description_column,
                  "featured_column"                       => $featured_column,
                  "specials_column"                       => $specials_column,
                  "meta_tags_products_description_column" => $meta_tags_products_description_column,
                );
    $product  = $model->load_product($columns, $_REQUEST['products_id']);


    $categories_html = array();
    $categories      = $model->get_product_categories($product['products_id']);
    foreach($categories as $category_id) {
      $categories_html[] = $model->get_category($category_id, "");
    }
    $product['current_categories'] = implode("<br/>", $categories_html);

    $product['categories'] = "";
    break;

  case 'copy_process':
    $columns  = array(
                  "languages"                             => $languages,
                  "products_column"                       => $products_column,
                  "products_description_column"           => $products_description_column,
                  "featured_column"                       => $featured_column,
                  "specials_column"                       => $specials_column,
                  "meta_tags_products_description_column" => $meta_tags_products_description_column,
                );
    $product  = $model->load_product($columns, $_REQUEST['products_id']);

    $categories_html = array();
    $categories      = $model->get_product_categories($product['products_id']);
    foreach($categories as $category_id) {
      $categories_html[] = $model->get_category($category_id, "");
    }
    $product['current_categories'] = implode("<br/>", $categories_html);

    foreach($_POST as $k => $v) {
      $product[$k] = $v;
    }
    $easy_admin_products_product  = $product;
    $easy_admin_products_validate = $model->validate_copy($product);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_COPY');
    $product                      = $easy_admin_products_product;
    if (count($easy_admin_products_validate) > 0) {
      $template = "copy";
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_ERROR_SAVE, 'error');
    }
    else {
      $template = "index";
      $names    = array();
      $categories      = explode(",", $product['categories']);
      foreach($categories as $v) {
        if ($v > 0) {
          $names[] = $model->get_category($v);
        }
      }

      $model->copy_product($_REQUEST['products_id'], $_REQUEST['products_image'], $_REQUEST['categories']);
      $messageStack->add_session(sprintf(MODULE_EASY_ADMIN_PRODUCTS_NOTICE_COPY, $_REQUEST['products_name']."(ID:".$_REQUEST['products_id'].")", implode(" , ", $names)), 'success');
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products'));
    }
    break;

  case 'delete_image':
    unlink(DIR_FS_CATALOG_IMAGES.$_REQUEST['filename']);
    unlink(DIR_FS_CATALOG_IMAGES.'large/'.$_REQUEST['filename']);
    // 連番を変更
    $info = $model->separate_filename($_REQUEST['filename']);
    if (preg_match("/^(.*?\_)([0-9]+)$/", $info['name'], $match)) {
      for($i=$match[2]; $i<MODULE_EASY_ADMIN_PRODUCTS_MAX_ADDITIONAL_IMAGES; $i++) {
        $from = DIR_FS_CATALOG_IMAGES.$match[1].($i+1).".".$info['ext'];
        $to   = DIR_FS_CATALOG_IMAGES.$match[1].$i.".".$info['ext'];
        if (!file_exists($from)) {
          break;
        }
        rename($from, $to);
      }
    }
    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products&products_id='.(int)$_REQUEST['products_id'].'&action=edit'));
    break;
}

$query_raw = $model->get_products_query($_REQUEST);
$split     = new splitPageResults($_GET['page'], MODULE_EASY_ADMIN_PRODUCTS_MAX_RESULTS, $query_raw, $query_numrows);
$products  = $db->Execute($query_raw);
?>
