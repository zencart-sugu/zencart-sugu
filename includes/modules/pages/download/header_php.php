<?php
/**
 * download header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 2973 2006-02-04 23:27:35Z wilt $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_DOWNLOAD');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// if the customer is not logged on, redirect them to the time out page
if (!$_SESSION['customer_id']) {
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}

// Check download.php was called with proper GET parameters
if ((isset($_GET['order']) && !is_numeric($_GET['order'])) || (isset($_GET['id']) && !is_numeric($_GET['id'])) ) {
  // if the paramaters are wrong, redirect them to the time out page
  zen_redirect(zen_href_link(FILENAME_TIME_OUT));
}

// Check that order_id, customer_id and filename match
$sql = "SELECT date_format(o.date_purchased, '%Y-%m-%d')
          AS date_purchased_day, opd.download_maxdays, opd.download_count, opd.download_maxdays, opd.orders_products_filename 
          FROM " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " opd 
          WHERE o.customers_id = customersID 
          AND o.orders_id = ordersID 
          AND o.orders_id = op.orders_id 
          AND op.orders_products_id = opd.orders_products_id 
          AND opd.orders_products_download_id = downloadID 
          AND opd.orders_products_filename != ''";

$sql = $db->bindVars($sql, 'customersID', $_SESSION['customer_id'], 'integer');
$sql = $db->bindVars($sql, 'downloadID', $_GET['id'], 'integer');
$sql = $db->bindVars($sql, 'ordersID', $_GET['order'], 'integer');
$downloads = $db->Execute($sql);
if ($downloads->RecordCount() <= 0 ) die;
// MySQL 3.22 does not have INTERVAL
list($dt_year, $dt_month, $dt_day) = explode('-', $downloads->fields['date_purchased_day']);
$download_timestamp = mktime(23, 59, 59, $dt_month, $dt_day + $downloads->fields['download_maxdays'], $dt_year);

// Die if time expired (maxdays = 0 means no time limit)
if (($downloads->fields['download_maxdays'] != 0) && ($download_timestamp <= time())) {
  zen_redirect(zen_href_link(FILENAME_DOWNLOAD_TIME_OUT));
}
// Die if remaining count is <=0 (maxdays = 0 means no time limit)
if ($downloads->fields['download_count'] <= 0 and $downloads->fields['download_maxdays'] != 0) {
  zen_redirect(zen_href_link(FILENAME_DOWNLOAD_TIME_OUT));
}

// FIX HERE AND GIVE ERROR PAGE FOR MISSING FILE
// Die if file is not there
if (!file_exists(DIR_FS_DOWNLOAD . $downloads->fields['orders_products_filename'])) die('Sorry. File not found. Please contact the webmaster to report this error.<br />c/f: ' . $downloads->fields['orders_products_filename']);

// Now decrement counter
$sql = "UPDATE " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . "
          SET download_count = download_count-1 
          WHERE orders_products_download_id = downloadID";

$sql = $db->bindVars($sql, 'downloadID', $_GET['id'], 'integer');
$db->Execute($sql);

// Returns a random name, 16 to 20 characters long
// There are more than 10^28 combinations
// The directory is "hidden", i.e. starts with '.'
function zen_random_name()
{
  $letters = 'abcdefghijklmnopqrstuvwxyz';
  $dirname = '.';
  $length = floor(zen_rand(16,20));
  for ($i = 1; $i <= $length; $i++) {
    $q = floor(zen_rand(1,26));
    $dirname .= $letters[$q];
  }
  return $dirname;
}

// Unlinks all subdirectories and files in $dir
// Works only on one subdir level, will not recurse
function zen_unlink_temp_dir($dir)
{
  $h1 = opendir($dir);
  while ($subdir = readdir($h1)) {
    // Ignore non directories
    if (!is_dir($dir . $subdir)) continue;
    // Ignore . and .. and CVS
    if ($subdir == '.' || $subdir == '..' || $subdir == 'CVS') continue;
    // Loop and unlink files in subdirectory
    $h2 = opendir($dir . $subdir);
    while ($file = readdir($h2)) {
      if ($file == '.' || $file == '..') continue;
      @unlink($dir . $subdir . '/' . $file);
    }
    closedir($h2);
    @rmdir($dir . $subdir);
  }
  closedir($h1);
}


// Now send the file with header() magic
header("Expires: Mon, 26 Nov 1962 00:00:00 GMT");
header("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: Application/octet-stream");
header("Content-disposition: attachment; filename=" . $downloads->fields['orders_products_filename']);
$zv_filesize = filesize(DIR_FS_DOWNLOAD . $downloads->fields['orders_products_filename']);

if (DOWNLOAD_BY_REDIRECT == 'true') {
  // This will work only on Unix/Linux hosts
  zen_unlink_temp_dir(DIR_FS_DOWNLOAD_PUBLIC);
  $tempdir = zen_random_name();
  umask(0000);
  mkdir(DIR_FS_DOWNLOAD_PUBLIC . $tempdir, 0777);
  $download_link = str_replace(array('/','\\'),'_',$downloads->fields['orders_products_filename']);
  $link_create_status = symlink(DIR_FS_DOWNLOAD . $downloads->fields['orders_products_filename'], DIR_FS_DOWNLOAD_PUBLIC . $tempdir . '/' . $download_link);
  $zco_notifier->notify('NOTIFY_DOWNLOAD_VIA_SYMLINK___BEGINS');

  if ($link_create_status==true) zen_redirect(DIR_WS_DOWNLOAD_PUBLIC . $tempdir . '/' . $download_link);
}

if (DOWNLOAD_BY_REDIRECT != 'true' or $link_create_status==false ) {
  // not downloading by redirect; instead, we stream it to the browser.  This happens if the symlink couldn't happen, or if set as default in Admin
  if (DOWNLOAD_IN_CHUNKS != 'true') {
    // This will work on all systems, but will need considerable resources
    header("Content-Length: " . $zv_filesize);
    $zco_notifier->notify('NOTIFY_DOWNLOAD_WITHOUT_REDIRECT___COMPLETED');
    readfile(DIR_FS_DOWNLOAD . $downloads->fields['orders_products_filename']);
  } else {
    // loop with fread($fp, xxxx) to allow streaming in chunk sizes below the PHP memory_limit
    header("Content-Length: " . $zv_filesize);
    $handle = fopen(DIR_FS_DOWNLOAD . $downloads->fields['orders_products_filename'], "rb");
    while (!feof($handle)) {
      echo(fread($handle, 4096));
      flush();
    }
    fclose($handle);
    $zco_notifier->notify('NOTIFY_DOWNLOAD_WITHOUT_REDIRECT_VIA_CHUNKS___COMPLETED');
  }
}

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_DOWNLOAD');
?>