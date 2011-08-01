<?php
/**
 * @copyright Copyright (c) Voyager Japan, Inc. All rights reserved.
 * @author S.G.Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (file_exists("local_configure.php"))
  require "local_configure.php";

// 強制的にHTMLメール
define('ADMIN_EXTRA_EMAIL_FORMAT', 'HTML');

// loginに飛ぶのをごまかす
$_SERVER['PHP_SELF']      = "login.php";

$dir = getcwd();
chdir("../../../admin");
require('includes/application_top.php');
chdir("../");

$_SESSION['admin_id']     = 1;
$_SESSION['languages_id'] = 2;

//$error_level = error_reporting(0);
require_once 'includes/classes/class.addOnModuleBase.php';
require_once 'includes/addon_modules/product_csv/configure.php';
require_once 'includes/addon_modules/product_csv/functions.php';
require_once 'includes/addon_modules/product_csv/module.php';
require_once 'includes/addon_modules/product_csv/classes/ProductCSV.php';
require_once 'includes/addon_modules/product_csv/database_tables.php';
require_once 'includes/addon_modules/product_csv/languages/japanese.php';
require_once 'includes/addon_modules/product_csv/languages/japanese/admin.php';
//error_reporting($error_level);

ini_set('include_path',ini_get('include_path').':'.dirname(__FILE__).'/pear:');
require_once 'File/CSV.php';

// 排他制御
$fp = fopen(MODULE_PRODUCT_RESERVE_IMPORT."/".MODULE_PRODUCT_RESERVE_LOCK_FILE, "w+");
if (flock($fp, LOCK_EX | LOCK_NB) == FALSE) {
  exit;
}

// 現在時刻
$now = date('YmdHis');

// 対象ファイルの取得と移動
$files = product_csv_get_files(MODULE_PRODUCT_RESERVE_IMPORT, "csv");
foreach($files as $file) {
  $check = product_csv_check_filename($file);
  if ($check['errormsg'] != "") {
    $msg = $check['errormsg']."(".$file.")";
    product_csv_import_write_log("ERROR", $msg);
    send_html_mail(UNSUCCESS_PRODUCT_CSV_IMPORT.$file, $msg);

    // 何度もメールされるのが嫌なので移す
    $from_path = str_replace("//", "/", MODULE_PRODUCT_RESERVE_IMPORT);
    $to_path   = str_replace("//", "/", MODULE_PRODUCT_RESERVE_IMPORT."/".MODULE_PRODUCT_RESERVE_IMPORT_TEMP."/");
    if (!@rename($from_path.$file, $to_path.$file)) {
      $msg = ERROR_PRODUCT_CSV_IMPORT_FILE_MOVE."(".$from_path.$file." -> ".$to_path.$file.")";
      product_csv_import_write_log("ERROR", $msg);
      send_html_mail(UNSUCCESS_PRODUCT_CSV_IMPORT.$file, $msg);
    }
  }
  else {
    if ($now >= $check['time']) {
      $from_path = str_replace("//", "/", MODULE_PRODUCT_RESERVE_IMPORT);
      $to_path   = str_replace("//", "/", MODULE_PRODUCT_RESERVE_IMPORT."/".MODULE_PRODUCT_RESERVE_IMPORT_TEMP."/");
      if (!@rename($from_path.$file, $to_path.$file)) {
        $msg = ERROR_PRODUCT_CSV_IMPORT_FILE_MOVE."(".$from_path.$file." -> ".$to_path.$file.")";
        product_csv_import_write_log("ERROR", $msg);
        send_html_mail(UNSUCCESS_PRODUCT_CSV_IMPORT.$file, $msg);
      }
      else if (is_readable($to_path.$file)) {
        if (strpos($file, "products") === 0)
          $csv_format_id = 1;
        if (strpos($file, "categories") === 0)
          $csv_format_id = 2;
        if (strpos($file, "options") === 0)
          $csv_format_id = 3;
        $zco_notifier = new notifier();
        $ProductCSV = new ProductCSV();
        $template = new template_func(DIR_WS_TEMPLATES);
        ProductCSV::import($to_path.$file, $csv_format_id, true, false);
        $email = file_get_contents("includes/addon_modules/product_csv/email/email_template_default.html");
        $email = str_replace('$EMAIL_SUBJECT', sprintf(PRODUCT_CSV_IMPORTED, $file), $email);
        $email = str_replace('$EMAIL_MESSAGE_HTML', $body, $email);

        product_csv_import_write_log("INFO", $file."\n".$email);
        send_html_mail(SUCCESS_PRODUCT_CSV_IMPORT.$file, $email);
      }
      else {
        $msg = ERROR_PRODUCT_CSV_IMPORT_FILE_READ."(".$to_path.$file.")";
        product_csv_import_write_log("ERROR", $msg);
        send_html_mail(UNSUCCESS_PRODUCT_CSV_IMPORT.$file, $msg);
      }
    }
  }
}

// ファイル取得
function product_csv_get_files($base, $ext) {
  $handle = opendir($base);
  $files  = array();
  while (($filename = readdir($handle)) !== false) {
    if ($filename == "." ||
        $filename == "..")
      continue;
    if (filetype($base."/".$filename) == "file") {
      if (strpos($filename, "products") === 0 ||
          strpos($filename, "categories") === 0 ||
          strpos($filename, "options") === 0) {
        if ($ext == "" ||
          preg_match("/^.+\.".$ext."$/", $filename)) {
          $files[] = $filename;
        }
      }
    }
  }
  closedir($handle);
  return $files;
}

// ファイルチェック
function product_csv_check_filename($filename) {
  $return = array(
              'errormsg' => '',
              'time'     => '',
            );

  if (preg_match("/^[^_]*_([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})\.csv$/", $filename, $match)) {
    if (!checkdate($match[2], $match[3], $match[1]) ||
      $match[4] > 23 || $match[5] > 59 || $match[6] > 59)
      $return['errormsg'] = ERROR_PRODUCT_CSV_IMPORT_TIME_FORMAT;
    else
      $return['time']     = $match[1].$match[2].$match[3].$match[4].$match[5].$match[6];
  }
  else
    $return['errormsg'] = ERROR_PRODUCT_CSV_IMPORT_FILENAME;

  return $return;
}

// ログ出力
function product_csv_import_write_log($level, $message) {
  $message = date('Y/m/d H:i:s').' ['.$level."] ".$message."\n";
  print $message;
  $file = fopen(MODULE_PRODUCT_RESERVE_IMPORT."/".MODULE_PRODUCT_RESERVE_IMPORT_LOG."/import.log", "a+");
  fwrite($file, $message);
  fclose($file);
}

// メール送信
function send_html_mail($subject, $body) {
  $block = array(
             'EMAIL_MESSAGE_HTML' => $body,
           );

  zen_mail(
    STORE_NAME,
    EMAIL_FROM,
    $subject,
    '',
    STORE_NAME,
    EMAIL_FROM,
    $block,
    'import_extra'
  );
}
?>
