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
// $Id: functions_gvcoupons.php 1969 2005-09-13 06:57:21Z drbyte $
//
//
////
// Update the Customers GV account
  function zen_gv_account_update($c_id, $gv_id) {
    global $db;
    $customer_gv_query = "select amount
                          from " . TABLE_COUPON_GV_CUSTOMER . "
                          where customer_id = '" . $c_id . "'";

    $customer_gv = $db->Execute($customer_gv_query);
    $coupon_gv_query = "select coupon_amount
                        from " . TABLE_COUPONS . "
                        where coupon_id = '" . $gv_id . "'";

    $coupon_gv = $db->Execute($coupon_gv_query);

    if ($customer_gv->RecordCount() > 0) {

      $new_gv_amount = $customer_gv->fields['amount'] + $coupon_gv->fields['coupon_amount'];
      $gv_query = "update " . TABLE_COUPON_GV_CUSTOMER . "
                   set amount = '" . $new_gv_amount . "' where customer_id = '" . $c_id . "'";

      $db->Execute($gv_query);

    } else {

      $gv_query = "insert into " . TABLE_COUPON_GV_CUSTOMER . "
                                   (customer_id, amount)
                          values ('" . $c_id . "', '" . $coupon_gv->fields['coupon_amount'] . "')";

      $db->Execute($gv_query);
    }
  }

    function zen_user_has_gv_account($c_id) {
      global $db;
      if ($_SESSION['customer_id']) {
        $gv_result = $db->Execute("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $c_id . "'");
        if ($gv_result->RecordCount() > 0) {
          if ($gv_result->fields['amount'] > 0) {
            return $gv_result->fields['amount'];
          }
        }
        return '0.00';
      } else {
        return '0.00';
      }
    }

////
// Create a Coupon Code. length may be between 1 and 16 Characters
// $salt needs some thought.

  function zen_create_coupon_code($salt="secret", $length = SECURITY_CODE_LENGTH) {
    global $db;
    $ccid = md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    srand((double)microtime()*1000000); // seed the random number generator
    $random_start = @rand(0, (128-$length));
    $good_result = 0;
    while ($good_result == 0) {
      $id1=substr($ccid, $random_start,$length);
      $query = "select coupon_code
                from " . TABLE_COUPONS . "
                where coupon_code = '" . $id1 . "'";

      $rs = $db->Execute($query);

      if ($rs->RecordCount() == 0) $good_result = 1;
    }
    return $id1;
  }
?>