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
// $Id$
// 
// »ÙÊ§¤¤¥â¥¸¥å¡¼¥ë ¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È
//
// ºî¼Ô
// Í­¸Â²ñ¼Ò¥Ó¥Ã¥°¥Þ¥¦¥¹¡¡º´¡¹ÌÚ¡¡¹ä¼£
// sasaki@bigmouse.jp
// http://www.bigmouse.jp
//
// 
// ¹¹¿·ÍúÎò
// 2005/03/21
// ¡¦ºÇÄãÅ¬ÍÑ¶â³Û¤òÀßÄê¤Ç¤­¤ë¤è¤¦¤Ë¤·¤Þ¤·¤¿¡£
// 
// 
// ¥Ñ¥Ã¥±¡¼¥¸¤ÎÆâÍÆ ----------------------------------------------------
// 
// ¡¦¥¯¥í¥Í¥³@¥Ú¥¤¥á¥ó¥È¥â¥¸¥å¡¼¥ë¥¯¥é¥¹¥Õ¥¡¥¤¥ë
// includes/modules/payment/kuroneko_at_payment.php
// 
// ¡¦¥¯¥í¥Í¥³@¥Ú¥¤¥á¥ó¥È¥â¥¸¥å¡¼¥ë¸À¸ì¥Õ¥¡¥¤¥ë¡Êjapanese¡Ë
// includes/languages/japanese/modules/payment/kuroneko_at_payment.php
// 
// ¡¦¥¯¥í¥Í¥³@¥Ú¥¤¥á¥ó¥È¥ê¥ó¥¯¥Ü¥¿¥ó²èÁü¥Õ¥¡¥¤¥ë¡Êjapanese¡Ë
// includes/templates/template_default/buttons/japanese/button_kuroneko_at_payment.gif
// 
// ¡¦tpl_checkout_success_default.php¥Æ¥ó¥×¥ì¡¼¥È¥Õ¥¡¥¤¥ë½¤ÀµÎã
// includes/templates/template_default/templates/tpl_checkout_success_default.php
// ¡¡$,1s;(B23¹ÔÌÜ¤Ë < ?php if (isset($_SESSION['kuroneko_at_payment'])) echo $_SESSION['kuroneko_at_payment']['box']; ? >¡¡¤òÁÞÆþ
// 
// ----------------------------------------------------------------------
// 
// 
// ÃíÊ¸³ÎÇ§¸å¡¢$_SESSION['kuroneko_at_payment']¡¡¤Ë¥ê¥ó¥¯¥Ü¥¿¥ó¤ÎHTML¥½¡¼¥¹¤¬
// ÇÛÎó¤ÇÂåÆþ¤µ¤ì¤Þ¤¹¡£
// 
// ÇÛÎó¤ÎÆâÍÆ
// $_SESSION['kuroneko_at_payment']['link_button'] ¡¡¥ê¥ó¥¯¥Ü¥¿¥ó¤Î¤ß¤Îhtml¥½¡¼¥¹
// $_SESSION['kuroneko_at_payment']['text_urge']¡¡·èºÑ¼êÂ³¤­¤ØÂ¥¤¹Ê¸¾Ï¤Îhtml¥½¡¼¥¹
// $_SESSION['kuroneko_at_payment']['box']¡¡¾åµ­£²¤Ä¤ò´Þ¤àplainBox¤Îhtml¥½¡¼¥¹
// 
// includes/templates/template_default/templates/tpl_checkout_success_default.php¡¡Æâ¤Ç
// É¬Í×¤Ê¥½¡¼¥¹¤òecho¤¹¤ë
// 
// Îã¡Ë¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È·èºÑ¤Ø¤Î¥Ü¥Ã¥¯¥¹¤ÎÉ½¼¨
// < ?php if (isset($_SESSION['kuroneko_at_payment'])) echo $_SESSION['kuroneko_at_payment']['box'];  ? >
// 
// ----------------------------------------------------------------------
// 
// 
// 
// ¥â¥¸¥å¡¼¥ëÀßÄê -------------------------------------------------------
// 
// ¡¦¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¥â¥¸¥å¡¼¥ë¤òÍ­¸ú¤Ë¤¹¤ë
// ¡¡¡¡True¡¡¡¦¡¦¡¦ Í­¸ú
// ¡¡¡¡False ¡¦¡¦¡¦ Ìµ¸ú
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡True
// 
// ¡¦ËÜÈÖ¥Ú¡¼¥¸¤Ø¤ÎÀÚÂØ¤¨
// ¡¡¡¡True¡¡¡¦¡¦¡¦ ËÜÅö¤Î·èºÑ¥Ú¡¼¥¸¤Ø¤Ä¤Ê¤¬¤ê¤Þ¤¹¡£
// ¡¡¡¡False ¡¦¡¦¡¦ Æ°ºî¥Æ¥¹¥ÈÍÑ¤Î¥Ú¡¼¥¸¤Ë¤Ä¤Ê¤¬¤ê¤Þ¤¹¡£
// ¡¡¡¡$,1s;(B ËÜÈÖ²ÔÆ°¤ÎÁ°¤ËÆ°ºî¥Æ¥¹¥ÈÍÑ¤Î¥Ú¡¼¥¸¤Ç½½Ê¬¥Æ¥¹¥È¤·¤Æ¤¯¤À¤µ¤¤¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡False
// 
// ¡¦²ÃÌÁÅ¹¥³¡¼¥É
// ¡¡¡¡²ÃÌÁÅ¹¥³¡¼¥É¤òÈ¾³Ñ¿ô»ú¤ÇÆþÎÏ¤·¤Þ¤¹¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡¶õÍó
// 
// ¡¦ºÇÄã¶â³Û
// ¡¡¡¡¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤òÅ¬ÍÑ¤¹¤ëºÇÄã¶â³Û¤òÆþÎÏ¤·¤Þ¤¹¡£
// ¡¡¡¡ÆâÀÇ³°ÀÇ¤Î·×»»¤Ë´Ø·¸¤Ê¤¯¥«¡¼¥È¤Î¾®·×¤¬ÆþÎÏ¤·¤¿¶â³Û°Ê¾å¤Ç
// ¡¡¡¡É½¼¨¤µ¤ì¤Þ¤¹¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡0
// 
// ¡¦Á÷¿®ÀèURL
// ¡¡¡¡¥ê¥ó¥¯¥Ü¥¿¥ó¡Ê¥Õ¥©¡¼¥à¡Ë¤ÎÁ÷¿®Àè¤ÎURL¤òÆþÎÏ¤·¤Þ¤¹¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡https://payment.kuronekoyamato.co.jp/kuroneko/servlet/YCS_ServletC
// 
// ¡¦¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¥ê¥ó¥¯¥Ð¥Ê¡¼
// ¡¡¡¡¤ª»ÙÊ§¤¤ÊýË¡ÁªÂò¥Ú¡¼¥¸¤Ç¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤ÎÀâÌÀ¥Ú¡¼¥¸¤Ø¤Î¥ê¥ó¥¯¥Ð¥Ê¡¼¤Î¥½¡¼¥¹¤ò
// ¡¡¡¡ÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£¥ê¥ó¥¯¥Ð¥Ê¡¼¤Î¥½¡¼¥¹¤Ï¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤ÎWEB¥µ¥¤¥È¤«¤éÆþ¼ê
// ¡¡¡¡½ÐÍè¤Þ¤¹¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡<a href="http://payment.kuronekoyamato.co.jp/help/hanbai/card.html" target="_blank"><img src=http://payment.kuronekoyamato.co.jp/help/images/payment04.gif width="50" height="50" border="0" alt="¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È"></a>
// 
// ¡¦Å¬ÍÑÃÏ°è
// ¡¡¡¡ÆüËÜ°Ê³°¤ÎÃÏ°è¤¬ÁªÂò²ÄÇ½¤Ë¤Ê¤Ã¤Æ¤¤¤Þ¤¹¤¬É¬¤ºÆüËÜ¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡ÆüËÜ
// 
// ¡¦½é´üÃíÊ¸¥¹¥Æ¡¼¥¿¥¹
// ¡¡¡¡ÃíÊ¸³ÎÇ§´°Î»¸å¤ÎÃíÊ¸¥¹¥Æ¡¼¥¿¥¹¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡¥Ç¥Õ¥©¥ë¥È
// 
// ¡¦É½¼¨¤ÎÀ°Îó½ç
// ¡¡¡¡¤ª»ÙÊ§¤¤ÊýË¡ÁªÂò¥Ú¡¼¥¸¤Ç¤ÎÉ½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤Ç¤­¤Þ¤¹¡£¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£
// ¡¡¡¡¥Ç¥Õ¥©¥ë¥ÈÃÍ¡¡0
// 
// ----------------------------------------------------------------------
//
// [»²¾È]
// http://www.zen-cart.jp/bbs/7/tree.php?all=126
// http://www.zen-cart.jp/bbs/7/tree.php?all=166
// http://www.zen-cart.jp/bbs/7/tree.php?all=230

  class kuroneko_at_payment {
    var $code, $title, $description, $enabled;

// class constructor
    function kuroneko_at_payment() {
      global $order;
      if (isset($_SESSION['kuroneko_at_payment'])) {
        unset($_SESSION['kuroneko_at_payment']);
      }
      $this->code = 'kuroneko_at_payment';
      $this->title = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_KURONEKO_AT_PAYMENT_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        $total_price = $_SESSION['cart']->show_total();
        if ($total_price < MODULE_PAYMENT_KURONEKO_AT_PAYMENT_MINIMUM_TOTAL_PRICE) {
          $check_flag = false;
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }

// disable the module if the order only contains virtual products
      if ($this->enabled == true) {
        if ($order->content_type != 'physical') {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->title,
                   'fields' => array(array('title' => MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_ABOUT,
                                                      'field' => MODULE_PAYMENT_KURONEKO_AT_PAYMENT_LINK_BANNER)));
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return array('title' => MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_CONFIRMATION);
    }

    function process_button() {
      return false;
    }

    function before_process() {
      return false;
    }

    function after_process() {
      global $db;
      $orders_query = "select orders_id, billing_name, order_total, billing_telephone, customers_email_address from " . TABLE_ORDERS . "
                       where customers_id = '" . (int)$_SESSION['customer_id'] . "'
                       order by date_purchased desc limit 1";

      $orders = $db->Execute($orders_query);

      $products_array = array();

      $products_query = "select products_id, products_name, products_quantity from " . TABLE_ORDERS_PRODUCTS . "
                         where orders_id = '" . (int)$orders->fields['orders_id'] . "'
                         order by products_name";

      $products = $db->Execute($products_query);
      $leading_product_name = sprintf(MODULE_PAYMENT_KURONEKO_AT_PAYMENT_LEADING_PRODUCT, $products->fields['products_name'], (int)$products->fields['products_quantity']);
      $products_count = $products->RecordCount();
      $total_products_quantity = 0;
      $products->MoveNext();
      while (!$products->EOF) {
        $other_products_quantity = $other_products_quantity + (int)$products->fields['products_quantity'];
        $products->MoveNext();
      }

      $action = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ACTION_URL;
      if (MODULE_PAYMENT_KURONEKO_AT_PAYMENT_NO_TEST == 'True') {
        $trs_map = 'V_W02';
      } else {
        $trs_map = 'L_TEST';
      }
      $trader_code = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TRADER_CODE;
      $order_no = (int)$orders->fields['orders_id'];
      $goods_name = $leading_product_name;
      if ($other_products_quantity > 0) {
       $goods_name .= sprintf(MODULE_PAYMENT_KURONEKO_AT_PAYMENT_OTHER_PRODUCTS, $other_products_quantity);
      }
      $settle_price = (int)$orders->fields['order_total'];
      $buyer_name_kanji = $orders->fields['billing_name'];
      $buyer_tel = $orders->fields['billing_telephone'];
      $buyer_email = $orders->fields['customers_email_address'];
      $button_image = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_BUTTON_IMAGE;
      $button_alt = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_BUTTON_ALT;

      $link_button .= zen_draw_form('UserForm', $action, 'post', 'target="_blank"') . "\n";
      $link_button .= zen_draw_hidden_field('TRS_MAP', $trs_map) . "\n";
      $link_button .= zen_draw_hidden_field('trader_code', $trader_code) . "\n";
      $link_button .= zen_draw_hidden_field('order_no', $order_no) . "\n";
      $link_button .= zen_draw_hidden_field('goods_name', $goods_name) . "\n";
      $link_button .= zen_draw_hidden_field('settle_price', $settle_price) . "\n";
      $link_button .= zen_draw_hidden_field('buyer_name_kanji', $buyer_name_kanji) . "\n";
      $link_button .= zen_draw_hidden_field('buyer_tel', $buyer_tel) . "\n";
      $link_button .= zen_draw_hidden_field('buyer_email', $buyer_email) . "\n";
      $link_button .= zen_image_submit($button_image, $button_alt) . "\n";
      $link_button .= "</form>\n";

      $text_urge = MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_URGE;

      $box = "<table  width=\"100%\" border=\"0\" cellspacing=\"2\" cellpadding=\"2\">\n";
      $box .= "  <tr>\n";
      $box .= "    <td class=\"plainBox\" align=\"center\">" . MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TEXT_URGE . "<br />\n";
      $box .= $link_button;
      $box .= "    </td>\n";
      $box .= "  </tr>\n";
      $box .= "</table>\n";

      $kuroneko_at_payment = array('link_button' => $link_button,'text_urge' => $text_urge,'box' => $box);
      $_SESSION['kuroneko_at_payment'] = $kuroneko_at_payment;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¥â¥¸¥å¡¼¥ë¤òÍ­¸ú¤Ë¤¹¤ë', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_STATUS', 'True', '¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤ò¼õ¤±ÉÕ¤±¤Þ¤¹¤«¡©', '6', '1', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('ËÜÈÖ¥Ú¡¼¥¸¤Ø¤ÎÀÚÂØ¤¨', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_NO_TEST', 'False', 'ËÜÈÖ¥Ú¡¼¥¸¤ØÀÚ¤êÂØ¤¨¤Þ¤¹¤«¡©<br />ËÜÈÖ¥Ú¡¼¥¸¤ØÀÚ¤êÂØ¤¨¤Ï¡¢½½Ê¬¤Ë¥Æ¥¹¥È¤ò¤·¤Æ¤«¤é¹Ô¤Ã¤Æ¤¯¤À¤µ¤¤¡£', '6', '2', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('²ÃÌÁÅ¹¥³¡¼¥É', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TRADER_CODE', '', '²ÃÌÁÅ¹¥³¡¼¥É', '6', '3', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ºÇÄã¶â³Û', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_MINIMUM_TOTAL_PRICE', '0', '¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤òÅ¬ÍÑ¤¹¤ëºÇÄã¶â³Û¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£', '6', '4', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Á÷¿®ÀèURL', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ACTION_URL', 'https://payment.kuronekoyamato.co.jp/kuroneko/servlet/YCS_ServletC', '¥ê¥ó¥¯¥Ü¥¿¥ó¤ÎÁ÷¿®Àè¤ÎURL¤ò»ØÄê¤·¤Þ¤¹¡£', '6', '5', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¥ê¥ó¥¯¥Ð¥Ê¡¼', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_LINK_BANNER', '<a href=\"http://payment.kuronekoyamato.co.jp/help/hanbai/card.html\" target=\"_blank\"><img src=http://payment.kuronekoyamato.co.jp/help/images/payment04.gif width=\"50\" height=\"50\" border=\"0\" alt=\"¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È\"></a>', '¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¥ê¥ó¥¯¥Ð¡¼¥Ê¡¼¤ÎHTML¥½¡¼¥¹¤òÆþÎÏ¤·¤Æ¤¯¤À¤µ¤¤¡£', '6', '6', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Å¬ÍÑÃÏ°è', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ZONE', '2', 'É¬¤ºÆüËÜ¤òÁªÂò¤·¤Æ¤¯¤À¤µ¤¤¡£<br />¥¯¥í¥Í¥³¡÷¥Ú¥¤¥á¥ó¥È¤ÏÆüËÜ¹ñ³°¤Ç¤ÏÍøÍÑ¤Ç¤­¤Þ¤»¤ó¡£', '6', '7', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('É½¼¨¤ÎÀ°Îó½ç', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_SORT_ORDER', '0', 'É½¼¨¤ÎÀ°Îó½ç¤òÀßÄê¤Ç¤­¤Þ¤¹¡£¿ô»ú¤¬¾®¤µ¤¤¤Û¤É¾å°Ì¤ËÉ½¼¨¤µ¤ì¤Þ¤¹¡£', '6', '8', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('½é´üÃíÊ¸¥¹¥Æ¡¼¥¿¥¹', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ORDER_STATUS_ID', '0', 'ÀßÄê¤·¤¿¥¹¥Æ¡¼¥¿¥¹¤¬¼õÃí»þ¤ËÅ¬ÍÑ¤µ¤ì¤Þ¤¹¡£', '6', '9', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
   }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_KURONEKO_AT_PAYMENT_STATUS', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_NO_TEST', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_TRADER_CODE', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_MINIMUM_TOTAL_PRICE', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ACTION_URL', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_LINK_BANNER', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ZONE', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_ORDER_STATUS_ID', 'MODULE_PAYMENT_KURONEKO_AT_PAYMENT_SORT_ORDER');
    }
  }

?>
