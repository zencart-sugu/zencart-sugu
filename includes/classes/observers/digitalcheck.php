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
  class digitalcheck extends base {

// class constructor
    function digitalcheck() {
      global $zco_notifier;

      $zco_notifier->attach($this, array("NOTIFY_CHECKOUT_PROCESS_BEGIN"));
    }

// for timeout
    function update(&$callingClass, $notifier, $paramsArray) {
      if ($notifier != "NOTIFY_CHECKOUT_PROCESS_BEGIN")
        return;

      // セッションが存在する場合は無処理
      if ($_SESSION['customer_id'])
        return;

      // セッションがタイムアウトした
      // パラメータの確認
      if (!isset($_REQUEST['SID'])  ||
          !isset($_REQUEST['FUKA']))
        return;

      // 存在チェック
      $sid  = $_REQUEST['SID'];
      $fuka = $_REQUEST['FUKA'];
      if (!digitalchcek_is_exist($sid, $fuka))
        return;

      // 状態チェック
      // タイムアウトしたが、既に精算済みか？
      if (digitalchcek_get_status($sid, $fuka, 'cc') == 'success') {
        $customers_id = digitalchcek_get_customers_id($sid, $fuka);
        require_once "includes/languages/".$_SESSION['language']."/modules/payment/digitalcheck_cc.php";
        $email_timeout = sprintf(MODULE_PAYMENT_DIGITALCHECK_CC_MAIL_TIMEOUT, $customers_id, $sid);
        zen_mail('',
                 STORE_OWNER_EMAIL_ADDRESS,
                 MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TIMEOUT,
                 $email_timeout,
                 STORE_NAME,
                 EMAIL_FROM,
                 $email_timeout,
                 'digitalcheck cc');
      }
    }
  }
?>
