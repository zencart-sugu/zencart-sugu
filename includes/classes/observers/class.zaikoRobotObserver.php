<?php
/**
 * addoOnModulesObserver Class
 *
 * @package Observer
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.addOnModulesObserver.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class zaikoRobotObserver extends base {
  var $modules;

  // class constructor
  function zaikoRobotObserver() {
    global $zco_notifier;

    $zco_notifier->attach($this, array('NOTIFY_CHECKOUT_PROCESS_AFTER_SEND_ORDER_EMAIL'));
  }

  function update(&$callingClass, $notifier, $paramsArray) {
    global $db;
    global $order;

    if (ZAIKOROBOT_ENABLE == "true") {
      $email   = ZAIKOROBOT_EMAIL;
      $subject = "【".STORE_NAME."】ご注文ありがとうございます。";
      $text    = "";
      for ($i=0; $i<count($order->products); $i++) {
        // SKU型番に対応
        $model = zaikorobot_get_skumodel(
          $order->products[$i]['id'],
          $order->products[$i]['model'],
          $order->products[$i]['attributes']);

        $text .= "商品コード: ".$model."\n";
        $text .= "数量：".$order->products[$i]['qty']." 個\n";
        $text .= "\n";
      }

      zaikorobot_add_mail_log($email, $subject, $text, EMAIL_FROM);
      zen_mail("", $email, $subject, $text, STORE_NAME, EMAIL_FROM);
    }
  }
}
?>