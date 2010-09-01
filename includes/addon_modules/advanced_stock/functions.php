<?php
// あり、なし、お取り寄せの表示
function display_advanced_stock($products_id) {
  global $db;
  $sql = 'SELECT products_quantity, send_for_status FROM ' . TABLE_PRODUCTS . ' WHERE products_id='.zen_db_input($products_id);
  $product_info = $db->Execute($sql);
  if ($product_info->RecordCount() == 1) {
    if ($product_info->fields['products_quantity'] > 0) {
      $message = MODULE_ADDON_MODULES_ADVANCED_STOCK_ENABLE;
    } elseif ($product_info->fields['send_for_status'] == 1) {
      $message = MODULE_ADDON_MODULES_ADVANCED_STOCK_SEND_FOR;
    } else {
      $message = MODULE_ADDON_MODULES_ADVANCED_STOCK_DISABLE;
    }
  } else {
    $message = '';
  }
  return $message;
}
// カートに追加ボタンを表示 function_general.php zen_get_buy_now_button()より
function advanced_stock_get_buy_now_button($product_id, $link, $additional_link = false) {
  global $db;

  // 0 = normal shopping
  // 1 = Login to shop
  // 2 = Can browse but no prices
  // verify display of prices
  switch (true) {
  case (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == ''):
    // customer must be logged in to browse
    $login_for_price = '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' .  TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE . '</a>';
    return $login_for_price;
    break;
  case (CUSTOMERS_APPROVAL == '2' and $_SESSION['customer_id'] == ''):
    if (TEXT_LOGIN_FOR_PRICE_PRICE == '') {
      // show room only
      return TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE;
    } else {
      // customer may browse but no prices
      $login_for_price = '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' .  TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE . '</a>';
    }
    return $login_for_price;
    break;
    // show room only
  case (CUSTOMERS_APPROVAL == '3'):
    $login_for_price = TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM;
    return $login_for_price;
    break;
  case ((CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and CUSTOMERS_APPROVAL_AUTHORIZATION != '3') and $_SESSION['customer_id'] == ''):
    // customer must be logged in to browse
    $login_for_price = TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE;
    return $login_for_price;
    break;
  case ((CUSTOMERS_APPROVAL_AUTHORIZATION == '3') and $_SESSION['customer_id'] == ''):
    // customer must be logged in and approved to add to cart
    $login_for_price = '<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '">' .  TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE . '</a>';
    return $login_for_price;
    break;
  case (CUSTOMERS_APPROVAL_AUTHORIZATION != '0' and $_SESSION['customers_authorization'] > '0'):
    // customer must be logged in to browse
    $login_for_price = TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE;
    return $login_for_price;
    break;
  default:
    // proceed normally
    break;
  }
  
  // show case only
  if (STORE_STATUS != '0') {
    return '<a href="' . zen_href_link(FILENAME_CONTACT_US) . '">' .  TEXT_SHOWCASE_ONLY . '</a>';
  }
  
  $button_check = $db->Execute("select product_is_call, products_quantity, send_for_status from " . TABLE_PRODUCTS . " where products_id = '" . $product_id . "'");
  switch (true) {
    // cannot be added to the cart
  case (zen_get_products_allow_add_to_cart($product_id) == 'N'):
    return $additional_link;
    break;
  case ($button_check->fields['product_is_call'] == '1'):
    $return_button = '<a href="' . zen_href_link(FILENAME_CONTACT_US) . '">' . TEXT_CALL_FOR_PRICE . '</a>';
    break;
  case ($button_check->fields['products_quantity'] <= 0 and $button_check->fields['send_for_status'] != 1 and SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1'):
    if ($_GET['main_page'] == zen_get_info_page($product_id)) {
      $return_button = '</dl><div id="cartAdd">'.zen_image_button(BUTTON_IMAGE_SOLD_OUT, BUTTON_SOLD_OUT_ALT).'</div>';
    } else {
      $return_button = '<dd class="soldout">'.zen_image_button(BUTTON_IMAGE_SOLD_OUT_SMALL, BUTTON_SOLD_OUT_SMALL_ALT).'</dd>';
    }
    break;
  case ($button_check->fields['products_quantity'] <= 0 and $button_check->fields['send_for_status'] == 1 and SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1'):
    if ($_GET['main_page'] == zen_get_info_page($product_id)) {
      $return_button = $link;
    } else {
      $return_button = '<dd class="soldout">'.zen_image_button(BUTTON_IMAGE_BACK_ORDER_SMALL, BUTTON_BACK_ORDER_SMALL_ALT).'</dd>';
    }
    break;
  default:
    $return_button = $link;
    break;
  }
  if ($return_button != $link and $additional_link != false) {
    return $additional_link . '<br />' . $return_button;
  } else {
    return $return_button;
  }
}
// お取り寄せ商品の判定
function advanced_stock_get_sendfor_status($products_id) {
  global $db;
  $sql = 'SELECT send_for_status FROM ' . TABLE_PRODUCTS . ' WHERE products_id='.(int)$products_id;
  $status = $db->Execute($sql);
  if ($status->RecordCount() == 1) {
    $send_for_status = $status->fields['send_for_status'];
  } else {
    $send_for_status = 0;
  }
  $send_for_status = $send_for_status == 0 ? false : true;
  return $send_for_status;
}
// お取り寄せ商品に記号を付加
function advanced_stock_get_mark() {
  $mark = '<span class="markProductOutOfStock">' . MODULE_ADDON_MODULES_ADVANCED_STOCK_FLAG . '</span>';
  return $mark;
}
// お取り寄せ商品のメッセージ表示
function advanced_stock_get_sendfor_message() {
  $message = MODULE_ADDON_MODULES_ADVANCED_STOCK_MESSAGE;
  return $message;
}
// 商品管理画面に表示
function advanced_stock_draw_sendfor_flag() {
  if (isset($_GET['pID']) && empty($_POST)) {
    $send_for_status = advanced_stock_get_sendfor_status((int)$_GET['pID']);
  } elseif (isset($_POST['send_for_status'])) {
    $send_for_status = $_POST['send_for_status'];
  }
  // send for status
  if (MODULE_ADDON_MODULES_ADVANCED_STOCK_STATUS == 'true') {
    if (!isset($send_for_status)) $send_for_status = '0';
    switch ($send_for_status) {
    case '0': $send_on = false; $send_off = true; break;
    case '1':
    default: $send_on = true; $send_off = false;
      break;
    }
  }
  $send_for_html = '
          <tr>
            <th class="main">' . TEXT_PRODUCTS_SEND_FOR . '</th>
            <td class="main">' . zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . zen_draw_radio_field('send_for_status', '1', $send_on) . '&nbsp;' . TEXT_PRODUCTS_SEND_ON . '&nbsp;' . zen_draw_radio_field('send_for_status', '0', $send_off) . '&nbsp;' . TEXT_PRODUCTS_SEND_OFF . '</td>
          </tr>
';
  return $send_for_html;
}
// ステータスをDBに保存
function advanced_stock_set_sendfor_status($products_id) {
  global $db;
  
  $tmp_value = (int)zen_db_prepare_input($_POST['send_for_status']);
  $send_for_status = (!zen_not_null($tmp_value) || $tmp_value=='' || $tmp_value == 0) ? 0 : $tmp_value;

  $sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET send_for_status=' . zen_db_input($send_for_status) . ' WHERE products_id='.(int)$products_id;
  $db->Execute($sql);
}
?>
