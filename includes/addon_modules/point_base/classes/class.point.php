<?php
/**
 * Point Class
 *
 * @package point
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: class.point.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

/**
 * point class
 *
 */
class point extends base {
  var $customers_id;

  function point($customers_id = null) {
    $this->customers_id = $customers_id;
  }

  function add($point, $description, $class = '', $related_id_name = null, $related_id_value = null, $pending = true) {
    $sql_data_array = array(
      'customers_id' => (int)$this->customers_id,
      'related_id_name' => $related_id_name,
      'related_id_value' => (int)$related_id_value,
      'deposit' => 0,
      'withdraw' => 0,
      'pending' => 0,
      'description' => $description,
      'class' => $class,
      'status' => 1
      );

    if ($pending) {
      $sql_data_array['pending'] = (int)$point;
    } else {
      $sql_data_array['deposit'] = (int)$point;
    }

    $id = $this->insert($sql_data_array);
    $this->updateCustomersPoints();
    return $id;
  }

  function sub($point, $description, $class = '', $related_id_name = null, $related_id_value = null, $pending = true) {
    $sql_data_array = array(
      'customers_id' => (int)$this->customers_id,
      'related_id_name' => $related_id_name,
      'related_id_value' => (int)$related_id_value,
      'deposit' => 0,
      'withdraw' => (int)$point,
      'pending' => 0,
      'description' => $description,
      'class' => $class,
      'status' => 1
      );

    $id = $this->insert($sql_data_array);
    $this->updateCustomersPoints();
    return $id;
  }

  function insert($sql_data_array) {
    global $db;
    $sql_data_array['created_at'] = 'now()';
    zen_db_perform(TABLE_POINT_HISTORIES, $sql_data_array);
    $id = $db->Insert_ID();
    return $id;
  }

  function update($id, $sql_data_array) {
    $sql_data_array['updated_at'] = 'now()';
    zen_db_perform(TABLE_POINT_HISTORIES, $sql_data_array, 'update', "id = " . (int)$id);
    $this->updateCustomersPoints();
    return $id;
  }

  function getRelatedPointID($class, $related_id_name = '', $related_id_value = 0) {
    global $db;
    $query = "
      select
        id
      from " . TABLE_POINT_HISTORIES . "
      where
        customers_id = :customersID
        and related_id_name = :relatedIDName
        and related_id_value = :relatedIDValue
        and class like :class
        and status = 1
      ;";

    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $query = $db->bindVars($query, ':relatedIDName', $related_id_name, 'string');
    $query = $db->bindVars($query, ':relatedIDValue', $related_id_value, 'integer');
    $query = $db->bindVars($query, ':class', $class, 'string');
    $result = $db->Execute($query);
    return $result->fields['id'];
  }

  function pendingToDeposit($id) {
    global $db;
    $query = "
      update " . TABLE_POINT_HISTORIES . "
      set
        deposit = pending,
        pending = 0,
        updated_at = now()
      where
        id = :ID
        and deposit = 0
        and pending > 0
      ;";
    $query = $db->bindVars($query, ':ID', $id, 'integer');
    $db->Execute($query);
    $this->updateCustomersPoints();
  }

  function depositToPending($id) {
    global $db;
    $query = "
      update " . TABLE_POINT_HISTORIES . "
      set
        pending = deposit,
        deposit = 0,
        updated_at = now()
      where
        id = :ID
        and deposit > 0
        and pending = 0
      ;";
    $query = $db->bindVars($query, ':ID', $id, 'integer');
    $db->Execute($query);
    $this->updateCustomersPoints();
  }

  function enable($id) {
    $sql_data_array['status'] = 1;
    $this->update($id, $sql_data_array);
  }

  function disable($id) {
    $sql_data_array['status'] = 0;
    $this->update($id, $sql_data_array);
  }

  function delete($id) {
    global $db;
    $query = "
      delete
      from " . TABLE_POINT_HISTORIES . "
      where
        id = :ID
      ;";
    $query = $db->bindVars($query, ':ID', $id, 'integer');
    $db->Execute($query);
    $this->updateCustomersPoints();
  }

  function calcPoints() {
    global $db;
    $query = "
      select
        sum(deposit) as deposit,
        sum(withdraw) as withdraw,
        sum(pending) as pending
      from " . TABLE_POINT_HISTORIES . "
      where
        customers_id = :customersID
        and status = 1
      ;";
    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $result = $db->Execute($query);
    return $result->fields;
  }

  function updateCustomersPoints() {
    if ($this->customers_id < 1) {
      return false;
    }

    if (!$this->existCustomersPoints(true)) {
      return false;
    }

    $points = $this->calcPoints();
    $deposit = $points['deposit'] - $points['withdraw'];
    $pending = $points['pending'];
    $sql_data_array = array(
      'deposit' => $deposit,
      'pending' => $pending,
      'updated_at' => 'now()'
      );

    zen_db_perform(TABLE_CUSTOMERS_POINTS, $sql_data_array, 'update', "customers_id = " . (int)$this->customers_id);

    return $deposit;
  }

  function getCustomersPoints() {
    global $db;

    if ($this->customers_id < 1) {
      return false;
    }

    if (!$this->existCustomersPoints(true)) {
      return false;
    }

    $query = "
      select *
      from " . TABLE_CUSTOMERS_POINTS . "
      where
        customers_id = :customersID
      ;";
    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $result = $db->Execute($query);
    if ($result->RecordCount() > 0) {
      return $result->fields;
    }
    return false;
  }

  function existCustomersPoints($create = false) {
    global $db;
    $query = "
      select *
      from " . TABLE_CUSTOMERS_POINTS . "
      where
        customers_id = :customersID
      ;";
    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $result = $db->Execute($query);
    if ($result->RecordCount() > 0) {
      return true;
    } elseif ($create) {
      $this->createCustomersPoints();
      return true;
    }
    return false;
  }

  function createCustomersPoints() {
    $points = $this->calcPoints();
    $deposit = $points['deposit'] - $points['withdraw'];
    $pending = $points['pending'];
    $sql_data_array = array(
      'customers_id' => $this->customers_id,
      'deposit' => $deposit,
      'pending' => $pending,
      'updated_at' => 'now()'
      );

    zen_db_perform(TABLE_CUSTOMERS_POINTS, $sql_data_array);
    return true;
  }

  function deleteCustomersPoints() {
    global $db;
    $query = "
      delete
      from " . TABLE_CUSTOMERS_POINTS . "
      where
        customers_id = :customersID
      ;";
    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $db->Execute($query);

    $query = "
      delete
      from " . TABLE_POINT_HISTORIES . "
      where
        customers_id = :customersID
      ;";
    $query = $db->bindVars($query, ':customersID', $this->customers_id, 'integer');
    $db->Execute($query);
  }

  function getCustomersIDByID($id) {
    global $db;
    $query = "
      select
        customers_id
      from " . TABLE_POINT_HISTORIES . "
      where
        id = :ID
      ;";

    $query = $db->bindVars($query, ':ID', $id, 'integer');
    $result = $db->Execute($query);
    return $result->fields['customers_id'];
  }

}
