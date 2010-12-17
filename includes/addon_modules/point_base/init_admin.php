<?php
/**
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_point.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/order_total/ot_addpoint.php');
require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/order_total/ot_subpoint.php');

$corrent_page = str_replace('.php', '', basename($PHP_SELF));

if ($corrent_page == FILENAME_ORDERS) {
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  switch ($action) {
    case 'update_order':
      // demo active test
      if (zen_admin_demo()) {
        break;
      }
      $oID = zen_db_prepare_input($_GET['oID']);
      $status = zen_db_prepare_input($_POST['status']);

      $precheck_order_updated = false;
      $query = "
        select
          customers_id, orders_status
        from " . TABLE_ORDERS . "
        where
          orders_id = :ordersID
        ;";
      $query = $db->bindVars($query, ':ordersID', $oID, 'integer');
      $result = $db->Execute($query);

      if (($result->fields['orders_status'] != $status)) {
        $precheck_order_updated = true;
      }

      if ($precheck_order_updated == true) {
        require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
        $point =& new point($result->fields['customers_id']);

        if ($status == MODULE_ORDER_TOTAL_ADDPOINT_DEPOSIT_ORDER_STATUS_ID) {
          $point_id = $point->getRelatedPointID('ot_addpoint', 'orders_id', $oID);
          if ($point_id > 0) {
            $point->pendingToDeposit($point_id);
            $messageStack->add_session(SUCCESS_ADDPOINT_DEPOSIT, 'success');
          }
        }

        if ($status == MODULE_ORDER_TOTAL_ADDPOINT_CANCEL_ORDER_STATUS_ID) {
          $point_id = $point->getRelatedPointID('ot_addpoint', 'orders_id', $oID);
          if ($point_id > 0) {
            $point->disable($point_id);
            $messageStack->add_session(SUCCESS_ADDPOINT_CANCEL, 'success');
          }
        }

        if ($status == MODULE_ORDER_TOTAL_SUBPOINT_CANCEL_ORDER_STATUS_ID) {
          $point_id = $point->getRelatedPointID('ot_subpoint', 'orders_id', $oID);
          if ($point_id > 0) {
            $point->disable($point_id);
            $messageStack->add_session(SUCCESS_SUBPOINT_CANCEL, 'success');
          }
        }

      }
      break;

    case 'deleteconfirm':
      // demo active test
      if (zen_admin_demo()) {
        break;
      }

      $oID = zen_db_prepare_input($_GET['oID']);
      $query = "
        select
          customers_id
        from " . TABLE_ORDERS . "
        where
          orders_id = :ordersID
        ;";
      $query = $db->bindVars($query, ':ordersID', $oID, 'integer');
      $result = $db->Execute($query);

      require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
      $point =& new point($result->fields['customers_id']);
      $point_id = $point->getRelatedPointID('ot_addpoint', 'orders_id', $oID);
      if ($point_id > 0) {
        $point->delete($point_id);
        $messageStack->add_session(SUCCESS_ADDPOINT_DELETE, 'success');
      }

      $point_id = $point->getRelatedPointID('ot_subpoint', 'orders_id', $oID);
      if ($point_id > 0) {
        $point->delete($point_id);
        $messageStack->add_session(SUCCESS_SUBPOINT_DELETE, 'success');
      }
      break;
  }
} elseif ($corrent_page == FILENAME_CUSTOMERS) {
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  switch ($action) {
    case 'deleteconfirm':
    // demo active test
    if (zen_admin_demo()) {
      break;
    }
    require_once(DIR_FS_CATALOG . $GLOBALS['point_base']->dir . 'classes/class.point.php');
    $customers_id = zen_db_prepare_input($_GET['cID']);
    $point =& new point($customers_id);
    $point->deleteCustomersPoints();
    $messageStack->add_session(SUCCESS_CUSTOMERS_POINTS_DELETE, 'success');
    break;
  }
}
