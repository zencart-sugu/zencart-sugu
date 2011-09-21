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

global $zco_notifier;
global $easy_admin_products_category;
global $easy_admin_products_category_validate;
global $easy_admin_products_category_id;

$languages = zen_get_languages();
$model     = new easy_admin_products_category_model();
$html      = new easy_admin_products_html();
$action    = (isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index');
$current_category_id = (int)$_REQUEST['category_id'];
$page      = (int)($_REQUEST['page'] ? $_REQUEST['page'] : 1);
$cID       = (int)$_REQUEST['cID'];

require(dirname(__FILE__) . '/categories.php');

$template  = "index";
$zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_BEFORE_ACTION');
switch($action) {
  case 'index':
    break;

  case 'setflag':
    $template = "setflag";
    $columns  = array(
                  "languages"          => $languages,
                  "categories_column"  => $categories_column,
                  "categories_description_column"  => $categories_description_column,
                  "meta_tags_categories_description_column"  => $meta_tags_categories_description_column,
                );
    $category = $model->load_category($columns, $cID);
    break;

  case 'setflag_process':
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_CATEGORIES_SETFLAG');
    $ret_change_status = $model->change_status($cID, $_REQUEST['categories_status'], $_REQUEST['set_products_status']);
    if ($ret_change_status) {
      $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_SETFLAG, 'success');
    }else{
      $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_SETFLAG_FAILED, 'error');
    }
    $parm = array(
      'category_id' => $current_category_id,
      'page'        => $page,
    );
    zen_redirect($html->href_link('categories', $parm));
    break;

  case 'edit':
    $template = "edit";
    $columns  = array(
                  "languages"          => $languages,
                  "categories_column"  => $categories_column,
                  "categories_description_column"  => $categories_description_column,
                  "meta_tags_categories_description_column"  => $meta_tags_categories_description_column,
                );
    $category = $model->load_category($columns, $cID);
    break;

  case 'save':
    $template = "edit";
    $category  = array();
    foreach($_POST as $k => $v) {
      $category[$k] = $v;
    }

    $easy_admin_products_category  = $category;
    $easy_admin_products_category_validate = $model->validate_save($category);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_VALIDATE_SAVE');
    $category                      = $easy_admin_products_category;

    if (count($easy_admin_products_category_validate) > 0) {
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_ERROR_SAVE, 'error');
    }
    else {
      $cID = $model->save_category($category);
      if ($category['cID'] > 0) {
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_UPDATE, 'success');
      }else{
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_INSERT, 'success');
      }
      $parm = array(
        'category_id' => $current_category_id,
        'page'        => $page,
        'cID'         => $cID,
        'action'      => 'edit',
      );
      zen_redirect($html->href_link('categories', $parm));
    }
    break;

  case 'delete':
    $template = "delete";
    $columns  = array(
                  "languages"          => $languages,
                  "categories_column"  => $categories_column,
                  "categories_description_column"  => $categories_description_column,
                  "meta_tags_categories_description_column"  => $meta_tags_categories_description_column,
                );
    $category = $model->load_category($columns, $cID);
    break;

  case 'delete_process':
    $columns  = array(
                  "languages"          => $languages,
                  "categories_column"  => $categories_column,
                  "categories_description_column"  => $categories_description_column,
                  "meta_tags_categories_description_column"  => $meta_tags_categories_description_column,
                );
    $category = $model->load_category($columns, $cID);
    $category_name = $category['categories_description_categories_name'][$_SESSION['languages_id']];

    $easy_admin_products_category_id = (int)$cID;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_START_DELETE');
    $model->delete_category($easy_admin_products_category_id);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_DELETE');
    $messageStack->add_session(sprintf(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NOTICE_DELETE, sprintf("ID#%0d %s ", $cID, $category_name)), 'success');
    $parm = array(
      'category_id' => $current_category_id,
      'page'        => $page,
    );
    zen_redirect($html->href_link('categories', $parm));
    break;

}

if ($template == 'index') {
  $breadcrumb = $model->get_breadcrumb($current_category_id);
//  $query_raw = $model->get_categories_query($current_category_id);
  $search_param = array(
    'category_id' => $current_category_id,
    'keyword'     => '',
  );
  $query_raw = easy_admin_products_model::get_categories_query($search_param);
  $split     = new splitPageResults($page, MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_MAX_RESULTS, $query_raw, $query_numrows);
  $categories  = $db->Execute($query_raw);
}
?>
