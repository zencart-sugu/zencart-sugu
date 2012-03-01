<?php
/**
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

function orders_export_get_exp() {
  $exp = array();
  foreach ($_GET as $key => $val) {
    if (preg_match("/^exp_(\d+)$/", $key, $matches)) {
      if (zen_not_null($val)) {
        $exp[$matches[1]] = $val;
      }
      unset($_GET[$key]);
    }
  }
  return $exp;
}
?>
