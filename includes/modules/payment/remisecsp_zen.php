<?php
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// | This source file is subject to version 2.0 of the GPL license,       |
// +----------------------------------------------------------------------+
// | Remise.jp Payment Module V.1.0.2a                                     |
// | includes/modules/payment/remisecsp_zen.php                           |
// | Module created by REMISE(www.remise.jp) - 11/28/2006                 |
// | Released under GPL                                                   |
// +----------------------------------------------------------------------+

/*
文字化け、エラー等が発生する場合は下記のどちらかで対処してください。

apacheのhttpd.confに設定する場合の推奨例

php_flag output_buffering on
php_value output_handler mb_output_handler
php_value mbstring.http_output EUC-JP
php_value mbstring.http_input auto
php_value mbstring.internal_encoding EUC-JP
php_value mbstring.language Japanese
php_value mbstring.detect_order auto
php_value mbstring.substitute_character none
php_flag mbstring.encoding_translation on

php.iniに設定する場合の推奨例

output_buffering      = on
output_handler	= mb_output_handler
mbstring.http_output  = EUC-JP
mbstring.http_input   = auto
mbstring.internal_encoding = EUC-JP
mbstring.language = Japanese
mbstring.detect_order	= auto
mbstring.substitute_character = none
mbstring.encoding_translation = On

*/
// PHPは、4.0.6以上

  class remisecsp_zen {
    var $code, $title, $description, $enabled;

// class constructor
    function remisecsp_zen() {
      global $order;
 
      if(ini_get('output_handler') != 'mb_output_handler')
      ob_start("mb_output_handler");

      $this->code = 'remisecsp_zen';
      $this->title = MODULE_PAYMENT_REMISECSP_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_REMISECSP_TEXT_DESCRIPTION;
      $this->explain = MODULE_PAYMENT_REMISECSP_TEXT_EXPLAIN;
      $this->sort_order = MODULE_PAYMENT_REMISECSP_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_REMISECSP_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_REMISECSP_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_REMISECSP_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url =MODULE_PAYMENT_REMISECSP_URL;
      $this->email_footer = MODULE_PAYMENT_REMISECSP_TEXT_EMAIL_FOOTER;
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_REMISE_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_REMISE_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while (!$check->EOF) {
          if ($check->fields['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check->fields['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
          $check->MoveNext();
        }

        if ($check_flag == false) {
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
                  'fields' => array(array('title' => $this->explain,'field' => '')));
    }

    function pre_confirmation_check() {
      global $order;

      	$encode =mb_http_input();			
		if($encode == 'ASCII' ){ $encode = 'UTF-8';}
      
		$phonenum=ereg_replace("-","",mb_convert_kana($order->customer['telephone'],"a")); 
	
		if(strlen($phonenum)>11 || strlen($phonenum)<9){
			
			$error=mb_convert_encoding(MODULE_PAYMENT_REMISECSP_TEXT_ERROR_INVALID_PHONE_NUM,$encode);
				
			$payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error);
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
		}

		return false;
		
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order, $customer_id;
      
      	mb_http_output("SJIS-win");
      
		$customer_address = mb_convert_kana($order->billing['state'].$order->billing['city'].$order->billing['street_address']. $order->billing['suburb'],"KVHAS");
		
		if(strlen($customer_address)<=50){
			$address1 = $customer_address;
			$address2 = '';
			$address3 = '';
		}elseif (strlen($customer_address)<=100){    	
			$address1 = mb_strcut($customer_address,0,50);
			$address2 = mb_strcut($customer_address,26,50);
			$address3 = '';
		}else{
			$address1 = mb_strcut($customer_address,0,50);
			$address2 = mb_strcut($customer_address,26,50);
			$address3 = mb_strcut($customer_address,51,100);
		}
		                
      $process_button_string = 
			zen_draw_hidden_field('SHOPCO', MODULE_PAYMENT_REMISECSP_SHOP_CODE) .
			zen_draw_hidden_field('HOSTID', MODULE_PAYMENT_REMISECSP_HOST_ID) .
			zen_draw_hidden_field('S_TORIHIKI_NO', $customer_id . date('ymdHis')) .
			zen_draw_hidden_field('NAME1', mb_strcut(mb_convert_kana($order->billing['firstname'],"KVHA"),0,20)) .
			zen_draw_hidden_field('NAME2', mb_strcut(mb_convert_kana($order->billing['lastname'],"KVHA"),0,20)) .
			zen_draw_hidden_field('KANA1', mb_strcut(mb_convert_kana(MODULE_PAYMENT_REMISECSP_TEXT_INPUT_KANA,"KVHA"),0,20)) .
			zen_draw_hidden_field('KANA2', mb_strcut(mb_convert_kana(MODULE_PAYMENT_REMISECSP_TEXT_INPUT_KANA,"KVHA"),0,20)) .
			zen_draw_hidden_field('YUBIN1', ereg_replace("-","",mb_convert_kana(substr($order->billing['postcode'],0,3),"a"))) .
			zen_draw_hidden_field('ADD1', $address1) .
			zen_draw_hidden_field('ADD2', $address2) .
			zen_draw_hidden_field('ADD3', $address3) . 
			zen_draw_hidden_field('TEL', substr(ereg_replace("-","",mb_convert_kana($order->customer['telephone'],"a")),0,11) ) .
			zen_draw_hidden_field('MAIL', mb_convert_kana($order->customer['email_address'],"a") ) .
			zen_draw_hidden_field('TAX', '0') .
			zen_draw_hidden_field('TOTAL', $order->info['total']) .
			zen_draw_hidden_field('S_PAYDATE', date('Ymd',mktime(0,0,0,date(m),date(d)+MODULE_PAYMENT_REMISECSP_PAYDATE,date(Y)))) .
			zen_draw_hidden_field('SEIYAKUDATE', date('Ymd')) .
			zen_draw_hidden_field('RETURL', zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', true)) . 
			zen_draw_hidden_field('NG_RETURL', zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .  
			zen_draw_hidden_field('MNAME_01', mb_convert_kana(MODULE_PAYMENT_REMISECSP_TEXT_GOODS_NAME,"KVHA") ) .
			zen_draw_hidden_field('MSUM_01', $order->info['total']);

      return $process_button_string;
    }

    function before_process() {
      return true;
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function get_error() {
	  if (isset($_GET['error']) && (strlen($_GET['error']) > 0)) {
        $error = stripslashes(urldecode($_GET['error']));
      }else{
      	$error = MODULE_PAYMENT_REMISECSP_TEXT_ERROR_MESSAGE;
      }
      
      return array('title' => MODULE_PAYMENT_REMISECSP_TEXT_ERROR,
                   'error' => $error);
    }

    function check() {  	
      global $db;
      
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_REMISECSP_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;
      
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable REMISECSP Module', 'MODULE_PAYMENT_REMISECSP_STATUS', 'True', 'ルミーズコンビニ決済を有効にしますか?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('REMISECSP Url', 'MODULE_PAYMENT_REMISECSP_URL', 'https://www.remise.jp/', '決済情報送信先URL', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Shop Code', 'MODULE_PAYMENT_REMISECSP_SHOP_CODE', '00000000', '加盟店コード', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Host Id', 'MODULE_PAYMENT_REMISECSP_HOST_ID', '00000000', 'ホスト番号', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Pay Date', 'MODULE_PAYMENT_REMISECSP_PAYDATE', '10', '支払い期限(2日以上59日以内)', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('表示の整列順', 'MODULE_PAYMENT_REMISECSP_SORT_ORDER', '0', '表示の整列順を設定できます。数字が小さいほど上位に表示されます。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_REMISECSP_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('初期注文ステータス', 'MODULE_PAYMENT_REMISECSP_ORDER_STATUS_ID', '0', '設定したステータスが受注時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

    }

    function remove() {
      global $db;
      
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_REMISECSP_STATUS', 'MODULE_PAYMENT_REMISECSP_URL','MODULE_PAYMENT_REMISECSP_SHOP_CODE','MODULE_PAYMENT_REMISECSP_HOST_ID', 'MODULE_PAYMENT_REMISECSP_PAYDATE','MODULE_PAYMENT_REMISECSP_ZONE', 'MODULE_PAYMENT_REMISECSP_ORDER_STATUS_ID', 'MODULE_PAYMENT_REMISECSP_SORT_ORDER');
    }
  }
  
?>