<?php
 /*
  * Copyright (C) 2006 digitalcheck_cc INC.
  *
  * This program is free software; you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation; either version 2 of the License, or
  * (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with Shigeo; if not, write to the Free Software
  * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
  *
  * $Id$
  */
//
  class digitalcheck_cc {
    var $code, $title, $description, $enabled;

// class constructor
    function digitalcheck_cc() {
      global $order;

      $this->code        = 'digitalcheck_cc';
      $this->title       = MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_DESCRIPTION;
      $this->sort_order  = MODULE_PAYMENT_DIGITALCHECK_CC_SORT_ORDER;
      $this->enabled     = ((MODULE_PAYMENT_DIGITALCHECK_CC_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_DIGITALCHECK_CC_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_DIGITALCHECK_CC_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = zen_href_link(FILENAME_DIGITALCHECK_CC_PREPROCESS);
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_DIGITALCHECK_CC_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_DIGITALCHECK_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return true;
    }

    function confirmation() {
      return true;
    }

    function process_button() {
      return "";
    }

    function before_process() {
      global $messageStack;

      // パラメータの確認
      if (!isset($_REQUEST['SID'])  ||
          !isset($_REQUEST['FUKA'])) {
        zen_redirect(zen_href_link(FILENAME_DEFAULT));
        return false;
      }

      // 存在チェック
      $sid  = $_REQUEST['SID'];
      $fuka = $_REQUEST['FUKA'];
      if (!digitalchcek_is_exist($sid, $fuka)) {
        zen_redirect(zen_href_link(FILENAME_DEFAULT));
        return false;
      }

      // 状態チェック
      if (digitalchcek_get_status($sid, $fuka, 'cc') != 'success') {
        $messageStack->add_session('checkout_payment', MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_NOT_SUCCESS, 'error');
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT));
        return false;
      }

      return false;
    }
	
    function after_process() {
      // 注文IDを保存する
      $sid  = $_REQUEST['SID'];
      $fuka = $_REQUEST['FUKA'];
      digitalchcek_save_orders_id($sid, $_SESSION['order_number_created']);

      // 注文ステータス更新
      // ccの場合はfinish後に、こちらの処理に飛んでくるので
      // 保存しておいたシリアライズデータを利用する
      $response = digitalchcek_get_response($sid, $fuka, "cc");
      if ($response) {
        $response  = unserialize($response);
        $comments  = "決済済み:".$response['CVS']."\n"
                   . "SID:".$response['SID']."\n"
                   . "通知番号:".$response['SEQ']."\n"
                   . "入金日:".$response['DATE'];
        $status_id = MODULE_PAYMENT_DIGITALCHECK_CC_FINISH_PAYMENT_STATUS_ID;
        // 入金したときはデフォルトで処理中
        if ($status_id == 0)
          $status_id = DEFAULT_ORDERS_STATUS_ID;
        digitalchcek_save_status($sid, $status_id, $comments);
      }

      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_DIGITALCHECK_CC_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)                 values ('デジタルチェック クレジットカード決済', 'MODULE_PAYMENT_DIGITALCHECK_CC_STATUS', 'True', 'デジタルチェック クレジットカード決済を有効にしますか？', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                               values ('表示の整列順', 'MODULE_PAYMENT_DIGITALCHECK_CC_SORT_ORDER', '0', '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。', '6', '0' , now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added)   values ('適用地域', 'MODULE_PAYMENT_DIGITALCHECK_CC_ZONE', '0', '適用地域を選択すると、選択した地域のみで利用可能となります。', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added)   values ('初期注文ステータス', 'MODULE_PAYMENT_DIGITALCHECK_CC_ORDER_STATUS_ID', '0', '設定したステータスが受注時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added)   values ('入金時ステータス', 'MODULE_PAYMENT_DIGITALCHECK_CC_FINISH_PAYMENT_STATUS_ID', '0', '設定したステータスが入金時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                               values ('加盟店コード', 'MODULE_PAYMENT_DIGITALCHECK_CC_IP', '', '申し込み時に入手した加盟店コードを指定します。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                               values ('送信先URL', 'MODULE_PAYMENT_DIGITALCHECK_CC_URL', 'https://www.digitalcheck.jp/settle/settle3/bp3.dll', '申し込み時に入手した送信先URLを指定します。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)                 values ('与信のみ/売り上げ計上', 'MODULE_PAYMENT_DIGITALCHECK_CC_IS_AUTHORIZE_ONLY', 'False', '売り上げを計上せずに与信のみとする場合は「True」を設定します。売り上げまでを計上する場合は「Flase」を設定します。', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
//      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)               values ('取り消し処理', 'MODULE_PAYMENT_DIGITALCHECK_CC_CANCEL_AVAILABLE', 'True', 'キャンセルステータス適用時にデジタルチェックに取り消し要求を送信するかどうかを設定します。', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
//      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('キャンセル注文ステータス', 'MODULE_PAYMENT_DIGITALCHECK_CC_CANCEL_STATUS_ID', '0', '設定したステータスが適用された際にキャンセル処理を行います。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_DIGITALCHECK_CC_STATUS', 
                   'MODULE_PAYMENT_DIGITALCHECK_CC_ZONE',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_ORDER_STATUS_ID',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_FINISH_PAYMENT_STATUS_ID',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_SORT_ORDER',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_IP',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_URL',
                   'MODULE_PAYMENT_DIGITALCHECK_CC_IS_AUTHORIZE_ONLY');
    }
  }
?>
