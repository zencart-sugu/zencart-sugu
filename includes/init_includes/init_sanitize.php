<?php
/**
 * sanitize the GET parameters
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sanitize.php 3714 2006-06-05 21:29:43Z wilt $
 * @todo move the array process to security class
 */

  if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
  }
  if (isset($_GET['products_id'])) $_GET['products_id'] = ereg_replace('[^0-9a-f:]', '', $_GET['products_id']);
  if (isset($_GET['manufacturers_id'])) $_GET['manufacturers_id'] = ereg_replace('[^0-9]', '', $_GET['manufacturers_id']);
  if (isset($_GET['cPath'])) $_GET['cPath'] = ereg_replace('[^0-9_]', '', $_GET['cPath']);
  if (isset($_GET['main_page'])) $_GET['main_page'] = ereg_replace('[^0-9a-zA-Z_]', '', $_GET['main_page']);
/**
 * process all $_GET terms
 */
  $strictReplace = '[<>\']';
  $unStrictReplace = '[<>]';
  if (isset($_GET)) {
    while (list($key, $value) = each($_GET)){
      if(is_array($value)){
        foreach($value as $key2 => $val2){
          if ($key2 == 'keyword') {
            $_GET[$key][$key2] = ereg_replace($unStrictReplace, '', $val2);
          } else {
            $_GET[$key][$key2] = ereg_replace($strictReplace, '', $val2);            
          }
          unset($GLOBALS[$key]);
        }
      } else {
        if ($key == 'keyword') {
          $_GET[$key] = ereg_replace($unStrictReplace, '', $value);
        } else {
          $_GET[$key] = ereg_replace($strictReplace, '', $value);          
        }
        unset($GLOBALS[$key]);
      }
    }
  }
/**
 * process all $_POST terms
 * @todo move the array process to security class
 */
  while (list($key, $value) = each($_POST)){
    if(is_array($value)){
      foreach($value as $key2 => $val2){
        unset($GLOBALS[$key]);
      }
    } else {
      unset($GLOBALS[$key]);
    }
  }
/**
 * process all $_COOKIE terms
 */
  while (list($key, $value) = each($_COOKIE)){
    if(is_array($value)){
      foreach($value as $key2 => $val2){
        unset($GLOBALS[$key]);
      }
    } else {
      unset($GLOBALS[$key]);
    }
  }
/**
 * process all $_SESSION terms
 */
  while (list($key, $value) = each($_SESSION)){
    if(is_array($value)){
      foreach($value as $key2 => $val2){
        unset($GLOBALS[$key]);
      }
    } else {
      unset($GLOBALS[$key]);
    }
  }
/**
 * validate products_id for search engines and bookmarks, etc.
 */
  if (isset($_GET['products_id']) && isset($_SESSION['check_valid']) &&  $_SESSION['check_valid'] != 'false') {
    $check_valid = zen_products_id_valid($_GET['products_id']);
    if (!$check_valid) {
      $_GET['main_page'] = zen_get_info_page($_GET['products_id']);
      /**
       * do not recheck redirect
       */
      $_SESSION['check_valid'] = 'false';
      zen_redirect(zen_href_link($_GET['main_page'], 'products_id=' . $_GET['products_id']));
    }
  } else {
    $_SESSION['check_valid'] = 'true';
  }
/**
 * We do some checks here to ensure $_GET['main_page'] has a sane value
 */
  if (!isset($_GET['main_page']) || !zen_not_null($_GET['main_page'])) $_GET['main_page'] = 'index';

  if (!is_dir(DIR_WS_MODULES .  'pages/' . $_GET['main_page'])) {
    if (MISSING_PAGE_CHECK == 'On' || MISSING_PAGE_CHECK == 'true') {
      $_GET['main_page'] = 'index';
    } elseif (MISSING_PAGE_CHECK == 'Page Not Found') {
      $_GET['main_page'] = 'page_not_found';
    }
  }
  $current_page = $_GET['main_page'];
  $current_page_base = $current_page;
  $code_page_directory = DIR_WS_MODULES . 'pages/' . $current_page_base;
  $page_directory = $code_page_directory;

?>