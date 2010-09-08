<?php
/**
 * $Id: zen_smartphone_model.php,v 1.7 2006/03/26 02:04:00 shida Exp $
 *
 * Zen Cart mobile module 0.9
 *  Copyright (C) 2006 by Zen Cart.JP
 *  http://zen-cart.jp
 *
 * Note: Original work copyright to 2006 ARK-Web co., ltd.
 *   http://www.ark-web.jp
 *
 * Zen Cart mobile module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Zen Cart mobile module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Shigeo; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$include_path = DIR_FS_CATALOG.DIR_WS_CLASSES ."pear";
$include_path .= PATH_SEPARATOR . ini_get("include_path");
ini_set("include_path", $include_path);
require_once 'Net/UserAgent/Mobile.php';

/**
 * Zen Cartをモバイル対応させるためのメソッド等を提供します。
 * 
 * @author Yuki SHIDA <shida＠ark-web.jp>
 * @author Syuichi KOHATA <kohata@e7-ware.com>
 * @package ZenCart
 * @access public
 */
class zen_smartphone_model {

  var $agent;
  var $db;

  function zen_smartphone_model() {
  }

  function init($strUserAgent, $db) {
    $this->agent = $strUserAgent;
    $this->db    = $db;
    
    $this->initLanguage();
    return true;
  }

  function isSmartPhone() {
    return $this->isiPhone() ||
           $this->isAndroid() ||
           $this->isWindowsMobile();
  }

  function isiPhone() {
    if (ereg("iPhone", $this->agent))
      return true;
    else
      return false;
  }

  function isAndroid() {
    if (ereg("Android", $this->agent))
      return true;
    else
      return false;
  }

  function isWindowsMobile() {
    $mobiles = array(
                 "Windows CE",
                 "HT01A",
                 "T-01A",
                 "SC-01B",
                 "T-01B",
               );
    foreach($mobiles as $mobile) {
      if (ereg($mobile, $this->agent))
        return true;
    }

    return false;
  }

  function initLanguage() {
      // セッションがあっても、強制的に書き換えていいと思うのだが
      //if ($this->isSmartPhone()) && !isset($_SESSION['language']) ) {
      if ($this->isSmartPhone()) {
          $lng = new language();
          if (LANGUAGE_DEFAULT_SELECTOR=='Browser') {
              $lng->get_browser_language();
          } else {
              $lng->set_language(DEFAULT_LANGUAGE);
          }
          $language_code        = (zen_not_null($lng->language['code']) ? $lng->language['code'] : 'en');
          $mobile_language_code = $language_code . MODULE_ZEN_SMARTPHONE_CODE_SUFFIX;
          $mobile_language      = $this->db->Execute("select * from " . TABLE_LANGUAGES . " where code = '" . zen_db_prepare_input($mobile_language_code) . "'");
          if ($mobile_language->RecordCount() > 0 ){
              $_SESSION['language']       = $mobile_language->fields['directory'];
              $_SESSION['languages_id']   = $mobile_language->fields['languages_id'];
              $_SESSION['languages_code'] = $mobile_language->fields['code'];
          }
      }
  }

  function getCategories($db, $current = 0) {
    $categories = array();
    $indent = '';
    $status = 1;
    
    $categories = $this->_get_categories_object($db, $current, $indent, $status);
    
    return $categories;
  }

  // functions_categories.php の zen_get_categories より、今のカテゴリーを取得したオブジェクトだけを返す (再起しない).
  function _get_categories_object($db, $parent_id = '0', $indent = '', $status_setting = '') {
    if (!is_array($categories_array)) $categories_array = array();

    // show based on status
    if ($status_setting != '') {
      $zc_status = " c.categories_status='" . $status_setting . "' and ";
    } else {
      $zc_status = '';
    }

    $categories_query = "select c.categories_id, cd.categories_name, c.categories_status
                         from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         where " . $zc_status . "
                         parent_id = '" . (int)$parent_id . "'
                         and c.categories_id = cd.categories_id
                         and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         order by sort_order, cd.categories_name";

    $categories = $db->Execute($categories_query);
    return $categories;
  }

  function getProductInfo($id) {

    return array(
             'id'    => $id,
             'name'  => zen_products_lookup($id, 'products_name',  $_SESSION['languages_id']),
             'image' => zen_products_lookup($id, 'products_image', $_SESSION['languages_id']),
           );
    
  }
}
?>
