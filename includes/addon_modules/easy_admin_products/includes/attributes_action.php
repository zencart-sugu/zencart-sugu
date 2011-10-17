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
global $easy_admin_products_attribute;
global $easy_admin_products_attribute_validate;
global $easy_admin_products_attribute_id;

$languages = zen_get_languages();
$model     = new easy_admin_products_attribute_model();
$html      = new easy_admin_products_html();
$action    = (isset($_REQUEST['action']) ? $_REQUEST['action'] : 'index');
$products_id   = (int)$_REQUEST['products_id'];
$attributes_id = (int)$_REQUEST['attributes_id'];
$options_id    = (int)$_REQUEST['options_id'];

require(dirname(__FILE__) . '/products_attributes.php');

$template  = "index";
$zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_BEFORE_ACTION');
switch($action) {
  case 'index':
    break;

  case 'status_on':
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_ATTRIBUTES_STATUS_ON');
    $ret_change_status = $model->change_status($products_id, $attributes_id, $_REQUEST['type'], 1);
    if ($ret_change_status) {
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_STATUS, 'success');
    }else{
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_STATUS_FAILED, 'error');
    }
    break;

  case 'status_off':
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_START_ATTRIBUTES_STATUS_OFF');
    $ret_change_status = $model->change_status($products_id, $attributes_id, $_REQUEST['type'], 0);
    if ($ret_change_status) {
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_STATUS, 'success');
    }else{
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_STATUS_FAILED, 'error');
    }
    break;

  case 'save':
    $template = "index";
    $preload_attribute_edit_form = false;

    // set posted data
    $attribute  = array();
    foreach($_POST as $k => $v) {
      $attribute[$k] = $v;
    }
    // fix options_values_id if not require option_value type
    $options_type = $model->get_options_type($attribute['options_id']);
    if ($model->is_require_option_value($options_type) == false) {
      $attribute['options_values_id'] = PRODUCTS_OPTIONS_VALUES_TEXT_ID;
    }
    // fix attributes_image
    if ($attribute['attributes_image'] == 'none') {
      $attribute['attributes_image'] = "";
    }
    // upload attributes_image
    if (isset($_FILES['attributes_image']) && zen_not_null($_FILES['attributes_image']['name'])) {
      if ($model->upload('attributes_image', $_POST['img_dir'], $_POST['overwrite'], $attributes_image)) {
        $attribute['attributes_image'] = $attributes_image;
      }else{
        $error_upload = true;
        $attribute['attributes_image'] = $_POST['attributes_previous_image'];
      }
    }else{
      $attribute['attributes_image'] = $_POST['attributes_previous_image'];
    }

    // validate
    $easy_admin_products_attribute  = $attribute;
    $easy_admin_products_attribute_validate = $model->validate_save($attribute);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_VALIDATE_SAVE');
    $attribute                      = $easy_admin_products_attribute;

    if ($error_upload || count($easy_admin_products_attribute_validate) > 0) {
      $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_ERROR_SAVE, 'error');
      foreach ($easy_admin_products_attribute_validate as $validate) {
        $messageStack->add($validate, 'error');
      }
      $preload_attributes_edit_form = true;
    }
    else {
      // save
      $attributes_id = $model->save_attribute($attribute);
      if ($attribute['attributes_id'] > 0) {
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_UPDATE, 'success');
      }else{
        $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_INSERT, 'success');
      }
      // reset products_price_sorter for searches etc.
      zen_update_products_price_sorter($products_id);
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes&products_id='.(int)$products_id));
    }
    break;

  case 'delete':
    $template = "delete";
    $columns  = array(
                  "attributes_column"  => $attributes_column,
                );
    $attribute = $model->load_attribute($columns, $products_id, $attributes_id);
    break;

  case 'delete_process':
    $template = "index";
    $columns  = array(
                  "attributes_column"  => $attributes_column,
                );
    $attribute = $model->load_attribute($columns, $products_id, $attributes_id);

    $easy_admin_products_attribute_id = (int)$attributes_id;
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_START_DELETE');
    $model->delete_attribute($attributes_id);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_DELETE');
    $messageStack->add(sprintf(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_DELETE, sprintf("ID#%0d %s - %s ", $attributes_id, $attribute['products_options_name'], $attribute['products_options_values_name'])), 'success');
    // reset products_price_sorter for searches etc.
    zen_update_products_price_sorter($products_id);
    break;

  case 'delete_option':
    $template = "delete_option";
    $columns  = array(
                  "attributes_column"  => $attributes_column,
                );
    $attributes = $model->load_attributes_by_options_id($columns, $products_id, $options_id);
    break;

  case 'delete_option_process':
    $template = "index";
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_START_DELETE_OPTION');
    $model->delete_attributes_by_options_id($products_id, $options_id);
    $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_DELETE_OPTION');
    $messageStack->add(sprintf(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_NOTICE_DELETE_OPTION, zen_options_name($options_id)), 'success');
    // reset products_price_sorter for searches etc.
    zen_update_products_price_sorter($products_id);
    break;

}

$query_raw = $model->get_products_attributes_query($products_id);
$split     = new splitPageResults($_GET['page'], MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAX_RESULTS, $query_raw, $query_numrows);
$products_attributes  = $db->Execute($query_raw);
?>
