<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin_history.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  // log page visit into admin activity history
  if (basename($PHP_SELF) != FILENAME_LOGIN . '.php' && basename($PHP_SELF) != FILENAME_DEFAULT . '.php' && isset($_SESSION['admin_id'])) {
    $sql_data_array = array( 'access_date' => 'now()',
                             'admin_id' => $_SESSION['admin_id'],
                             'page_accessed' =>  basename($PHP_SELF),
                             'page_parameters' => zen_get_all_get_params(),
                             'ip_address' => $_SERVER['REMOTE_ADDR']
                             );
    zen_db_perform(TABLE_ADMIN_ACTIVITY_LOG, $sql_data_array);
  }
?>