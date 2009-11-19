<?php
/**
 * @package point
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: init_point.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$corrent_page = str_replace('.php', '', basename($PHP_SELF));

if ($corrent_page == FILENAME_GROUP_PRICING) {
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  switch ($action) {
    case 'deleteconfirm':
    // demo active test
    if (zen_admin_demo()) {
      break;
    }
    $group_id = zen_db_prepare_input($_GET['gID']);
    $GLOBALS['point_grouprate']->deletePointRate($group_id);
    break;
  }
}
