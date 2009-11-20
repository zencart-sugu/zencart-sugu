<?php
 /*
  * Copyright (C) 2006 digitalcheck_edy INC.
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

  class digitalcheck_edy {
    var $code, $title, $description, $enabled;

// class constructor
    function digitalcheck_edy() {
      global $order;
      if (isset($_SESSION['digitalcheck_edy'])) {
        unset($_SESSION['digitalcheck_edy']);
      }
      $this->code        = 'digitalcheck_edy';
      $this->title       = MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_DESCRIPTION;
      $this->sort_order  = MODULE_PAYMENT_DIGITALCHECK_EDY_SORT_ORDER;
      $this->enabled     = ((MODULE_PAYMENT_DIGITALCHECK_EDY_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_DIGITALCHECK_EDY_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_DIGITALCHECK_EDY_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }

// class methods
    function update_status() {
      global $order, $db;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_DIGITALCHECK_EDY_ZONE > 0) ) {
        $check_flag = false;
        $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_DIGITALCHECK_EDY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      $js = '  if (payment_value == "' . $this->code . '") {'."\n"
          . '    var mobile_email = document.checkout_payment.digitalcheck_edy_mobile_email.value'."\n"
          . '                     + document.checkout_payment.digitalcheck_edy_mobile_base.value;'."\n"
          . '    if (mobile_email.match(/^[^@]+@docomo\.ne\.jp$/)==null &&'."\n"
          . '        mobile_email.match(/^[^@]+@ezweb\.ne\.jp$/)==null &&'."\n"
          . '        mobile_email.match(/^[^@]+@softbank\.ne\.jp$/)==null &&'."\n"
          . '        mobile_email.match(/^[^@]+@[dhtcrknsq]\.vodafone\.ne\.jp$/)==null) {'."\n"
          . '      error_message = error_message + "' . MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_JS_MOBILE_EMAIL . '";'."\n"
          . '      error = 1;'."\n"
          . '    }'."\n"
          . '  }'."\n";
	  return $js;
	}

    function selection() {
      $mobile_base[] = array('id' => '@docomo.ne.jp',     'text' => '@docomo.ne.jp');
      $mobile_base[] = array('id' => '@ezweb.ne.jp',      'text' => '@ezweb.ne.jp');
      $mobile_base[] = array('id' => '@softbank.ne.jp',   'text' => '@softbank.ne.jp');
      $mobile_base[] = array('id' => '@d.vodafone.ne.jp', 'text' => '@d.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@h.vodafone.ne.jp', 'text' => '@h.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@t.vodafone.ne.jp', 'text' => '@t.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@c.vodafone.ne.jp', 'text' => '@c.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@r.vodafone.ne.jp', 'text' => '@r.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@k.vodafone.ne.jp', 'text' => '@k.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@n.vodafone.ne.jp', 'text' => '@n.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@s.vodafone.ne.jp', 'text' => '@s.vodafone.ne.jp');
      $mobile_base[] = array('id' => '@q.vodafone.ne.jp', 'text' => '@q.vodafone.ne.jp');

      return array('id'     => $this->code,
                   'module' => $this->title,
                   'fields' => array(
                                     array('title' => MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_MOBILE_EMAIL,
                                           'field' => zen_draw_input_field('digitalcheck_edy_mobile_email', $_SESSION[$this->code.'-mobile-email'], 'id="'.$this->code.'-mobile-email" size="10"')
                                                    . zen_draw_pull_down_menu('digitalcheck_edy_mobile_base', $mobile_base, $_SESSION[$this->code.'-mobile-base'], 'id="'.$this->code.'-mobile-base"'),
                                           'tag'   => $this->code.'-mobile-email'),
                               )
                   );
    }

    function pre_confirmation_check() {
      global $_POST, $messageStack;

      $_SESSION[$this->code.'-mobile-email'] = $_POST['digitalcheck_edy_mobile_email'];
      $_SESSION[$this->code.'-mobile-base']  = $_POST['digitalcheck_edy_mobile_base'];
      $mobile_email = $_POST['digitalcheck_edy_mobile_email'].$_POST['digitalcheck_edy_mobile_base'];
      if (preg_match('/^[^@]+@docomo\.ne\.jp$/',                $mobile_email)==0 &&
          preg_match('/^[^@]+@ezweb\.ne\.jp$/',                 $mobile_email)==0 &&
          preg_match('/^[^@]+@softbank\.ne\.jp$/',              $mobile_email)==0 &&
          preg_match('/^[^@]+@[dhtcrknsq]\.vodafone\.ne\.jp$/', $mobile_email)==0) {
        $payment_error_return = 'payment_error=' . $this->code . '&digitalcheck_edy_mobile_email=' . urlencode($_POST['digitalcheck_edy_mobile_email']);
        $messageStack->add_session('checkout_payment', MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_JS_MOBILE_EMAIL . '['.$this->code.']', 'error');
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }
    }

    function confirmation() {
      $mobile_email = $_SESSION[$this->code.'-mobile-email'].$_SESSION[$this->code.'-mobile-base'];
      $confirmation = array('title' => MODULE_PAYMENT_DIGITALCHECK_EDY_TEXT_MOBILE_EMAIL."<BR>&nbsp;&nbsp;".htmlspecialchars($mobile_email));
      return $confirmation;
    }

    function process_button() {
      return "";
    }

    function before_process() {
      global $order;
      global $messageStack;

      // モバイルEdy２者間
      $sid  = digitalchcek_get_new_sid();
      $fuka = digitalchcek_get_fuka();
      $_SESSION['digitalcheck_edy_sid'] = $sid;

      $expire = MODULE_PAYMENT_DIGITALCHECK_EDY_EXPIRATION;
      $today  = mktime (0, 0, 0, date("m"), date("d"), date("y"));
      $today += 86400*$expire;

      $url  = MODULE_PAYMENT_DIGITALCHECK_EDY_URL;
      $parm = array('IP'      => MODULE_PAYMENT_DIGITALCHECK_EDY_IP,
                    'SID'     => $sid,
                    'N1'      => 'ITEM',
                    'K1'      => (int)$order->info['total'],
                    'MAIL'    => $_SESSION[$this->code.'-mobile-email'].$_SESSION[$this->code.'-mobile-base'],
                    'KIGEN2'  => date('Ymd', $today)."000000",
                    'STORE'   => '65',
                    'FUKA'    => $fuka,
                    );

      // 要求レコードの作成
      digitalchcek_save_request_parm($sid, 'edy', $url.'?'.digitalchcek_http_build_query($parm), $fuka);

      // post送信
      $data = array('http' => 
                    array('method'  => 'POST',
                          'content' => digitalchcek_http_build_query($parm)
                         )
                   );

      $ctx = stream_context_create($data);
      $fp  = @fopen($url, 'rb', false, $ctx);
      $res = mb_convert_encoding(@stream_get_contents($fp), CHARSET, "Shift-JIS");
      $res = str_replace("\r\n", "\n", $res);
      $res = str_replace("\r", "", $res);
      $res = explode("\n", $res);

      // エラーチェック
      if ($res[0] != "OK") {
        $messageStack->add_session('checkout_payment', $res[2] . '['.$this->code.']', 'error');
        zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT));
        return false;
      }
    }
	
    function after_process() {
      // 注文IDを保存する
      digitalchcek_save_orders_id($_SESSION['digitalcheck_edy_sid'], $_SESSION['order_number_created']);

      return false;
    }

    function get_error() {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_DIGITALCHECK_EDY_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added)               values ('デジタルチェック Edy決済', 'MODULE_PAYMENT_DIGITALCHECK_EDY_STATUS', 'True', 'デジタルチェック Edy決済を有効にしますか？', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                             values ('表示の整列順', 'MODULE_PAYMENT_DIGITALCHECK_EDY_SORT_ORDER', '0', '表示の整列順を設定できます. 数字が小さいほど上位に表示されます。', '6', '0' , now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('適用地域', 'MODULE_PAYMENT_DIGITALCHECK_EDY_ZONE', '0', '適用地域を選択すると、選択した地域のみで利用可能となります。', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('初期注文ステータス', 'MODULE_PAYMENT_DIGITALCHECK_EDY_ORDER_STATUS_ID', '0', '設定したステータスが受注時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('入金時ステータス', 'MODULE_PAYMENT_DIGITALCHECK_EDY_FINISH_PAYMENT_STATUS_ID', '0', '設定したステータスが入金時に適用されます。', '6', '0', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                             values ('加盟店コード', 'MODULE_PAYMENT_DIGITALCHECK_EDY_IP', '', '申し込み時に入手した加盟店コードを指定します。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                             values ('送信先URL', 'MODULE_PAYMENT_DIGITALCHECK_EDY_URL', '', '申し込み時に入手した送信先URLを指定します。', '6', '0', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added)                             values ('支払い期限', 'MODULE_PAYMENT_DIGITALCHECK_EDY_EXPIRATION', '14', 'Edyの支払期限を指定します。', '6', '0', now())");
    }

    function remove() {
      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_DIGITALCHECK_EDY_STATUS',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_ZONE',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_ORDER_STATUS_ID',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_FINISH_PAYMENT_STATUS_ID',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_SORT_ORDER',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_IP',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_URL',
                   'MODULE_PAYMENT_DIGITALCHECK_EDY_EXPIRATION');
    }
  }
?>
