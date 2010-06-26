<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_customers_languages.php 3001 2008-01-15 21:45:06Z sasaki $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$restore_language_pages = array();
$filename = basename($_SERVER['SCRIPT_NAME']);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($filename == FILENAME_MAIL . '.php') {
    if ( ($_GET['action'] == 'send_email_to_user') && isset($_POST['customers_email_address']) && !isset($_POST['back_x']) ) {
      $_GET['language'] = $_POST['customer_language'];
    }
  } elseif ($filename == FILENAME_NEWSLETTERS . '.php') {
    if ($_GET['action'] == 'confirm_send') {
      $_GET['language'] = $_POST['customer_language'];
    }
  }
}


$restore_language_pages[] = FILENAME_ORDERS . '.php';
$restore_language_pages[] = 'invoice.php';
$restore_language_pages[] = 'packingslip.php';
if (($filename == FILENAME_ORDERS . '.php' && $_GET['oID'] > 0 && ($_GET['action'] == 'edit' || $_GET['action'] == 'update_order'))
  || (($filename == 'invoice.php' || $filename == 'packingslip.php') && $_GET['oID'] > 0)) {
  if ($orders_language_id = zen_get_orders_language_id($_GET['oID'])) {
    $admin_language = zen_get_language_code($_SESSION['languages_id']);
    $_GET['language'] = zen_get_language_code($orders_language_id);
  }
}

$restore_language_pages[] = FILENAME_CUSTOMERS . '.php';
if ($filename == FILENAME_CUSTOMERS . '.php' && $_GET['cID'] > 0 && ($_GET['action'] == 'edit' || $_GET['action'] == 'update')) {
  if ($customers_language_id = zen_get_customers_language_id($_GET['cID'])) {
    $admin_language = zen_get_language_code($_SESSION['languages_id']);
    $_GET['language'] = zen_get_language_code($customers_language_id);
  }
}

?>