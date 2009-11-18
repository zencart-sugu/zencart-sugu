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

// +----------------------------------------------------------------------+
// | Copyright (c) 2008 Hunglead Co. Ltd.                                 |
// |                                                                      |
// | Portions Copyright (c) 2008 Zen Cart                                 |
// +----------------------------------------------------------------------+
// | Released under the GNU General Public License                        |
// +----------------------------------------------------------------------+
//

require('includes/application_top.php');

///////////////////////////////////////////////////////////////////
zaikorobot_add_post_log($_POST, $_SERVER);

// 認証
if (auth_user() == false) {
  echo ZAIKOROBOT_STATUS_NG . "\n";
  echo ZAIKOROBOT_ERROR_MSG_AUTH . "\n";
  exit;
}

update_zaiko();
exit;

///////////////////////////////////////////////////////////////////
// return true: success
function auth_user() {
  if ($_POST['sys_id'] != ZAIKOROBOT_USERID)
    return false;

  if ($_POST['sys_pass'] != ZAIKOROBOT_PASSWORD)
    return false;

  return true;
}

///////////////////////////////////////////////////////////////////
function update_zaiko() {
  global $db;

  if (!isset($_POST['product'])) {
    echo ZAIKOROBOT_STATUS_NG . "\n";
    echo ZAIKOROBOT_ERROR_MSG_NOQUERY . "\n";
    return;
  }

  $error = false;
  foreach($_POST['product'] as $key => $val) {
    $find = false;

    if (MODULE_PRODUCTS_WITH_ATTRIBUTES_STOCK_STATUS == 'true') {
      // SKU型番確認
      $sql = "select
                 stock_id
                ,products_id
              from ".
                TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK."
              where
                skumodel='".zen_db_input($val['product_code'])."'";
      $result = $db->Execute($sql);
      if (!$result->EOF) {
        $find = true;
        // 存在したので在庫更新
        $sql = "update ".
                  TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK."
                set
                  quantity=".(int)$val['stock']."
                where
                  stock_id=".(int)$result->fields['stock_id'];
        $db->Execute($sql);
        // 親の在庫を修正する
        $sql = "update ".
                  TABLE_PRODUCTS."
                set
                  products_quantity=(
                    select sum(quantity)
                    from ".TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK."
                    where products_id=".(int)$result->fields['products_id']."
                  )
                where
                  products_id=".(int)$result->fields['products_id'];
        $db->Execute($sql);
      }
    }

    // SKUに一致しないので、通常商品
    if (!$find) {
      $sql = "select
                products_id
              from ".
                TABLE_PRODUCTS."
              where
                products_model='".zen_db_input($val['product_code'])."'";
      $result = $db->Execute($sql);
      // 検索したが存在しない商品だった
      if ($result->EOF) {
        if ($error == false) {
          $error = true;
          echo ZAIKOROBOT_STATUS_NG . "\n";
        }
        echo sprintf(ZAIKOROBOT_ERROR_MSG_PRODUCT_UNKNOWN, $val['product_code'])."\n";
      }
      // 存在したので在庫更新
      else {
        $sql = "update ".
                  TABLE_PRODUCTS."
                set
                  products_quantity=".(int)$val['stock']."
                where
                  products_id=".(int)$result->fields['products_id'];
        $db->Execute($sql);
      }
    }
  }

  if ($error == false)
    echo ZAIKOROBOT_STATUS_OK."\n";
}
?>

