<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_currencies.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (strtolower(MODULE_PAYMENT_COD_STATUS) == 'true' && strtolower(MODULE_ORDER_TOTAL_MONEY_COD_STATUS) != 'true') {
  $messageStack->add(ERROR_OT_MONEY_COD_FEE_NOT_AVAILABLE,"error");
}
?>
