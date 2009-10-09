<?php
/**
 * make_module_list.php Make yml list for addon module.
 *
 * @package initSystem
 * @copyright Copyright 2009 Ark-web
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: make_module_list.php 3185 2006-03-14 19:19:55Z wilt $
 */
  define('IS_ADMIN_FLAG', 'true');
  define('YML_FILENAME', 'addon_module_list.yml');

  require_once 'includes/configure.php';
  require_once 'includes/extra_configures/addon_modules.php';
  require_once 'includes/filenames.php';
  require_once 'includes/addon_modules/addon_modules/pear/Tar.php';
  require_once 'includes/classes/class.base.php';
  require_once 'includes/classes/class.addOnModuleBase.php';
  require_once 'includes/functions/functions_general.php';
  require_once 'includes/functions/html_output.php';

  if ($argc < 2) {
    echo sprintf("Usage\n  php -f %s [search & write addon module directory]\n", $argv[0]);
    exit;
  }

  // ディレクトリの確認
  $directory = $argv[1];
  if (substr($directory, -1) != "/")
    $directory .= "/";
  if (!file_exists($directory) || !is_dir($directory)) {
    echo sprintf("%s is not directory\n", $directory);
    exit;
  }

  // 書き込み確認
  if (!is_writable($directory)) {
    echo sprintf("%s is not writable\n", $directory);
    exit;
  }

  // 該当ファイル取得
  // *.tarのみ
  $files = array();
  $dir   = opendir($directory);
  while (($file = readdir($dir)) !== false) {
    if (preg_match("/^.*?\.tar$/", $file)) {
      $files[] = $file;
    }
  }
  closedir($dir);

  // 該当ファイルがある場合のみ処理
  if (count($files) == 0) {
    echo sprintf("%s is empty(*.tar is not exists)\n", $directory);
    exit;
  }
  sort($files);

  // tarプロパティの取得
  $addon_modules = array();
  for ($i=0; $i<count($files); $i++) {
    preg_match("/^(.*?)\.tar$/", $files[$i], $match);
    $module_name = $match[1];
    echo "\n---------------------------------\n";
    echo "extract ".$module_name." - ";
    // 展開
    $tempdir = $directory."extract_".md5(uniqid(rand(), true))."/";
    mkdir($tempdir);
    $tar     = new Archive_Tar($directory.$files[$i], "");
    $result  = $tar->extract($tempdir);
    if ($result) {
      echo "successed\n";
    }
    else {
      echo "failed\n";
    }

    $level = error_reporting(E_ERROR);
    require $tempdir.$module_name."/configure.php";
    require $tempdir.$module_name."/languages/japanese.php";
    require $tempdir.$module_name."/module.php";
    $class = new $module_name;
    error_reporting($level);

    // 英語リソース
    $english_title       = "";
    $english_description = "";
    if (file_exists($tempdir.$module_name."/languages/english.php")) {
      $resource = explode("\n", file_get_contents($tempdir.$module_name."/languages/english.php"));
      if (count($resource)) {
        foreach ($resource as $define) {
          $define = str_replace('"', "'", $define);
          if (preg_match("/define.*?'(.+?)'\s*,\s*'(.+)'/", $define, $match)) {
            if ($match[1] == strtoupper('MODULE_'.$module_name.'_TITLE'))
              $english_title = $match[2];
            if ($match[1] == strtoupper('MODULE_'.$module_name.'_DESCRIPTION'))
              $english_description = $match[2];
          }
        }
      }
    }

    // 必須プロパティのチェック
    $indispensableBAD  = false;
    $indispensableBAD |= property_check($class, "title");
    $indispensableBAD |= property_check($class, "description");
    $indispensableBAD |= property_check($class, "author_email");
    $indispensableBAD |= property_check($class, "version");
    $indispensableBAD |= property_check($class, "require_zen_cart_version");
    $indispensableBAD |= property_check($class, "require_addon_modules_version");

    // エラーがない場合追加
    if ($indispensableBAD == false) {
      $a_addon_module['class']                         = $module_name;
      if (isset($class->author) && $class->author!="")
        $a_addon_module['author'] = $class->author;
      else
        $a_addon_module['author'] = $class->author_email;
      $a_addon_module['author_email']                  = $class->author_email;
      $a_addon_module['name']                          = $class->title;
      $a_addon_module['summary']                       = $class->description;
      $a_addon_module['version']                       = $class->version;
      $a_addon_module['require_zen_cart_version']      = $class->require_zen_cart_version;
      $a_addon_module['require_addon_modules_version'] = $class->require_addon_modules_version;
      $a_addon_module['english_name']                  = $english_title;
      $a_addon_module['english_summary']               = $english_description;
      $addon_modules[] = $a_addon_module;
      echo "=== processed!!!\n";
    }
    else {
      echo "*** rejected!!!\n";
    }

    system("rm -fr ".$tempdir);
  }

  // yml書き込み
  if (count($addon_modules) == 0) {
    echo sprintf("no effective modules(s)\n");
    exit;
  }

  // 現在のymlのバックアップ
  if (file_exists($directory.YML_FILENAME)) {
    rename($directory.YML_FILENAME, $directory.YML_FILENAME.".".date("YmdHis"));
  }

  $handle = fopen($directory.YML_FILENAME, "w");
  convert_write($handle, "modules :\n");
  for ($i=0; $i<count($addon_modules); $i++) {
    convert_write($handle, "  ".$addon_modules[$i]['class']." :\n");
    convert_write($handle, "    author : ".$addon_modules[$i]['author']."\n");
    convert_write($handle, "    author_email : ".$addon_modules[$i]['author_email']."\n");
    convert_write($handle, "    name :\n");
    convert_write($handle, "      default : ".$addon_modules[$i]['name']."\n");
    if ($addon_modules[$i]['english_name'] != "")
      convert_write($handle, "      en : "     .$addon_modules[$i]['english_name']."\n");
    convert_write($handle, "      ja : "     .$addon_modules[$i]['name']."\n");
    convert_write($handle, "    summary :\n");
    convert_write($handle, "      default : ".$addon_modules[$i]['summary']."\n");
    if ($addon_modules[$i]['english_summary'] != "")
      convert_write($handle, "      en : "     .$addon_modules[$i]['english_summary']."\n");
    convert_write($handle, "      ja : "     .$addon_modules[$i]['summary']."\n");
    convert_write($handle, "    version : ".$addon_modules[$i]['version']."\n");
    convert_write($handle, "    require_zen_cart_version : ".$addon_modules[$i]['require_zen_cart_version']."\n");
    convert_write($handle, "    require_addon_modules_version : ".$addon_modules[$i]['require_addon_modules_version']."\n");
    // 修正の時にみづらいので、セパレータ
    convert_write($handle, "    ******************************************\n\n");
  }
  fclose($handle);

  echo "\ndone\n";

function property_check($class, $name) {
  if (!isset($class->$name) || $class->$name=="") {
    echo "  property not set:'".$name."'\n";
    return true;
  }
  return false;
}

function convert_write($handle, $text) {
  fwrite($handle, mb_convert_encoding($text, "UTF-8", "EUC"));
}
?>
