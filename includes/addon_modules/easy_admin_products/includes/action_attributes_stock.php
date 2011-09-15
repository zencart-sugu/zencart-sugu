<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
//  $Id: products_with_attributes_stock.php 2999 2006-02-09 17:21:39Z drbyte $
//
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(DIR_WS_CLASSES . 'currencies.php');
require(dirname(__FILE__) . '/../classes/easy_admin_products_with_attributes_stock.php');

$stock = new easy_admin_products_with_attributes_stock;

if (isset($_GET['easy_admin_products_page'])) {
  $_SESSION['easy_admin_products_page'] = $_GET['easy_admin_products_page'];
}

$language_id = 2;
if(isset($_SESSION['languages_id'])){
  $language_id = (int)$_SESSION['languages_id'];
}

$html        = new easy_admin_products_html();
$action      = $_REQUEST['action'];
$products_id = (int)$_REQUEST['products_id'];

if(!zen_products_id_valid($products_id)) {
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products&page='.$_SESSION['easy_admin_products_page']));
}
$products_name     = zen_get_products_name($products_id);
$products_model    = zen_get_products_model($products_id);
$products_quantity = $stock->get_products_quantity($products_id);
$hidden_form  = '';

switch($action)
{
  case 'add':
    $product_attributes = $stock->get_products_attributes($products_id, $language_id);
    $hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
    break;

  case 'edit':
    $stock_id = (int)$_REQUEST['stock_id'];
    $stock_attributes = $stock->get_stock_attributes($products_id, $stock_id);
    if ($stock_attributes === false) {
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    }

    $attributes = explode(",", $stock_attributes['stock_attributes']);
    foreach($attributes as $attribute_id) {
      $attributes_list[] = $stock->get_attributes_name($attribute_id, $_SESSION['languages_id']);
    }
    $stock_id    = $stock_attributes['stock_id'];
    $products_id = $stock_attributes['products_id'];
    $attributes  = $stock_attributes['stock_attributes'];
    $qty         = $stock_attributes['quantity'];
    $skumodel    = $stock_attributes['skumodel'];
    break;

  case 'confirm':
    if(!isset($_POST['quantity']) || !is_numeric($_POST['quantity'])) {
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    }
    if(is_numeric($_REQUEST['quantity'])) {
      $quantity = $_REQUEST['quantity'];
    }
    $skumodel = $_REQUEST['skumodel'];

    $attributes = $_REQUEST['attributes'];

    if (is_array($attributes)) {
      foreach($attributes as $attribute_id)
      {
        $hidden_form .= zen_draw_hidden_field('attributes[]',$attribute_id)."\n";
        $attributes_list[] = $stock->get_attributes_name($attribute_id, $_SESSION['languages_id']);
      }
    }
    $hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
    $hidden_form .= zen_draw_hidden_field('quantity',$quantity)."\n";
    $hidden_form .= zen_draw_hidden_field('skumodel',$skumodel)."\n";
    $s_mack_noconfirm  ="module=easy_admin_products/attributes_stock&";
    $s_mack_noconfirm .="products_id=" . $products_id . "&"; //s_mack:noconfirm
    $s_mack_noconfirm .="quantity=" . $quantity . "&"; //s_mack:noconfirm
    $s_mack_noconfirm .="skumodel=" . urlencode(urlencode($skumodel)) . "&"; //s_mack:noconfirm

    if(sizeof($attributes) > 1) {
      sort($attributes);
      $stock_attributes = implode(',',$attributes);
    }
    else {
      $stock_attributes = $attributes[0];
    }
    $s_mack_noconfirm .='attributes=' . $stock_attributes . '&'; //kuroi: to pass string not array

    $stock_attributes = $stock->get_stock_attributes_by_stock_attributes($products_id, $stock_attributes);
    if ($stock_attributes !== false) {
      $hidden_form .= zen_draw_hidden_field('add_edit','edit');
      $hidden_form .= zen_draw_hidden_field('stock_id',$stock_attributes['stock_id']);
      $s_mack_noconfirm .="stock_id=" . $stock_attributes['stock_id'] . "&"; //s_mack:noconfirm
      $s_mack_noconfirm .="add_edit=edit&"; //s_mack:noconfirm
      $add_edit = 'edit';
    }
    else {
      $hidden_form .= zen_draw_hidden_field('add_edit','add')."\n";
      $s_mack_noconfirm .="add_edit=add&"; //s_mack:noconfirm
    }

    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, $s_mack_noconfirm . "action=execute", 'NONSSL')); //s_mack:noconfirm
    break;

  case 'execute':
    $attributes = $_POST['attributes'];
    if ($_GET['attributes']) {
      $attributes = $_GET['attributes'];
    } //s_mack:noconfirm

    $quantity = $_POST['quantity']; //s_mack:noconfirm
    if ($_GET['quantity']) {
      $quantity = $_GET['quantity'];
    } //s_mack:noconfirm
    if(!is_numeric((int)$quantity)) { //s_mack:noconfirm
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    }

    $skumodel = $_REQUEST['skumodel']; //s_mack:noconfirm
    if(trim($skumodel) == '') { //s_mack:noconfirm
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    }
    $skumodel = zen_db_input(urldecode($skumodel));

    if(($_POST['add_edit'] == 'add') || ($_GET['add_edit'] == 'add')) //s_mack:noconfirm
    {
      if (preg_match("/\|/", $attributes)) {

        $arrTemp = preg_split("/\,/", $attributes);
        $arrMain = array();
        $intCount = 0;
        for ($i = 0;$i < sizeof($arrTemp);$i++) {
          $arrTemp1 = preg_split("/\|/", $arrTemp[$i]);
          $arrMain[] = $arrTemp1;
          if ($intCount) {
            $intCount = $intCount * sizeof($arrTemp1);
          } else {
            $intCount = sizeof($arrTemp1);
          }
        }
        $intVars = sizeof($arrMain);
        $arrNew = array();
        if ($intVars >= 1) {
          eval('
            for ($i = 0;$i < sizeof($arrMain[0]);$i++) {
              if ($intVars >= 2) {
                for ($j = 0;$j < sizeof($arrMain[1]);$j++) {
                  if ($intVars >= 3) {
                    for ($k = 0;$k < sizeof($arrMain[2]);$k++) {
                      if ($intVars >= 4) {
                        for ($l = 0;$l < sizeof($arrMain[3]);$l++) {
                          if ($intVars >= 5) {
                            for ($m = 0;$m < sizeof($arrMain[4]);$m++) {
                              if ($intVars >= 6) {
                                for ($n = 0;$n < sizeof($arrMain[5]);$n++) {
                                  $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m], $arrMain[5][$n]);
                                }
                              } else {
                                $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m]);
                              }
                            }
                          } else {
                            $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l]);
                          }
                        }
                      } else {
                        $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k]);
                      }
                    }
                  } else {
                    $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j]);
                  }
                }
              } else {
                $arrNew[] = array($arrMain[0][$i]);
              }
            }
          ');
        }
        for ($i = 0;$i < sizeof($arrNew);$i++) {
          $strAttributes = implode(",", $arrNew[$i]);
          $query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`,`skumodel`) values ('.(int)$products_id.',"'.zen_db_prepare_input($strAttributes).'",'.(float)$quantity.",'".zen_db_prepare_input($skumodel)."'".') ON DUPLICATE KEY UPDATE `stock_attributes` = "'.zen_db_prepare_input($strAttributes).'", `quantity` = '.(float)$quantity;
          $db->Execute($query);
        }
      } else {
        $query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`,`skumodel`) values ('.(int)$products_id.',"'.zen_db_prepare_input($attributes).'",'.(float)$quantity.",'".zen_db_prepare_input($skumodel)."')";
        $db->Execute($query);
      }
    }
    elseif(($_POST['add_edit'] == 'edit') || ($_GET['add_edit'] == 'edit')) //s_mack:noconfirm
    {
      $stock_id = $_POST['stock_id']; //s_mack:noconfirm
      if ($_GET['stock_id']) { $stock_id = $_GET['stock_id']; } //s_mack:noconfirm
      if(!is_numeric((int)$stock_id)) //s_mack:noconfirm
      {
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
      }

      $query = 'update `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` set quantity='.(float)$quantity.",skumodel='".zen_db_prepare_input($skumodel)."' where stock_id=".(int)$stock_id.' limit 1';
      $db->Execute($query);
    }


    $stock->update_parent_products_stock($products_id);
    $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_PWA_UPDATE_VARIANT_PROCESSED, 'success');
    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));

    break;

  case 'delete':
    // delete it
    $query = 'delete from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where stock_id="'.(int)$_REQUEST['stock_id'].'" limit 1';
    $db->Execute($query);
    $stock->update_parent_products_stock((int)$products_id);
    $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_PROCESSED, 'failure');
    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    break;

  case 'resync':
    $stock->update_parent_products_stock((int)$products_id);
    $messageStack->add_session(MODULE_EASY_ADMIN_PRODUCTS_PWA_UPDATE_PARENT_PROCESSED, 'success');
    zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&products_id='.$products_id, 'NONSSL'));
    break;

  // ひとつもない場合は追加モードで起動
  default:
    if (!$stock->is_have_stock_attributes_by_products_id($products_id)) {
      zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=easy_admin_products/attributes_stock&action=add&products_id='.$products_id, 'NONSSL'));
    }
    break;
}
