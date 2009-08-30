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
// $Id: moneyorder.php 1969 2005-09-13 06:57:21Z drbyte $
//

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', '銀行振込');//'代金先払い' '郵便振替' '現金書留'　などに置き換え可能
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', '振込先:&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br /><br />店舗所在地:<br />' . nl2br(STORE_NAME_ADDRESS) . '<br /><br />' . 'ご入金を確認後、商品を発送いたします。');
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', "振込先:" . "\n\n" . MODULE_PAYMENT_MONEYORDER_PAYTO . "\n\n店舗所在地:\n" . STORE_NAME_ADDRESS . "\n\n" . 'ご入金を確認後、商品を発送いたします。');
?>
