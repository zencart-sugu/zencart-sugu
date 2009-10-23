<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: admin_block.php $
//
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// メッセージ
$success_message = "";
$error_message   = "";

// 使用言語の決定
$result = $db->Execute("select code from ".TABLE_LANGUAGES." where languages_id=".(int)$_SESSION['languages_id']);
if ($result->EOF)
  $language_code = "default";
else
  $language_code = $result->fields['code'];

// addonモジュールYAML取得
require_once('../includes/addon_modules/addon_modules/classes/spyc.php');
$spyc        = new Spyc();
$modules     = array();
$distributes = explode("\n", MODULE_ADDON_MODULES_DISTRIBUTION_URL);
for ($i=0; $i<count($distributes); $i++) {
  if (trim($distributes[$i]) != "") {
    $contents = @file_get_contents(trim($distributes[$i]).MODULE_ADDON_MODULES_MODULE_LIST_YML_NAME);
    if ($contents !== false) {
      $contents = mb_convert_encoding($contents, CHARSET, "utf-8");
      $yaml     = $spyc->load($contents);
      if (isset($yaml['modules'])) {
        foreach($yaml['modules'] as $k => $v) {
          // インストール状況確認
          $installed_version = "-";
          // ディレクトリが存在する場合はダウンロード済
          if (file_exists(getcwd()."/../".MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY.$k))
            $installed_version = MODULE_ADDON_MODULES_UNKNOWN_INSTALL_VERSION;
          if (isset($GLOBALS[$k])) {
            if (isset($GLOBALS[$k]->version))
              $installed_version = $GLOBALS[$k]->version;
            else
              $installed_version = MODULE_ADDON_MODULES_UNKNOWN_INSTALL_VERSION;
          }
          $v['filename']          = $k;
          $v['distribute']        = trim($distributes[$i]);
          $v['installed_version'] = $installed_version;
          $modules[]              = $v;
        }
      }
    }
  }
}

// ダウンロードモジュールのソート
$n = count($modules);
for ($i=0; $i<$n-1; $i++) {
  for ($j=$i+1; $j<$n; $j++) {
    if ($modules[$i]['filename']>$modules[$j]['filename'] ||
        $modules[$i]['filename']==$modules[$j]['filename'] &&
        $modules[$i]['version']>$modules[$j]['version']) {
      $work        = $modules[$i];
      $modules[$i] = $modules[$j];
      $modules[$j] = $work;
    }
  }
}

// 操作
$action = $_REQUEST['action'];
$row    = -1;
if (isset($_REQUEST['row']))
  $row  = (int)$_REQUEST['row'];

if ($action == "download") {
  $filename   = $_REQUEST['filename'];
  $distribute = $_REQUEST['distribute'];
  $version    = $_REQUEST['version'];

  // 書き込み権限のチェック
  clearstatcache();
  if (!is_writable(getcwd()."/../".MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY)) {
    $error_message .= ERROR_NO_PERMISSION_ADDON_DIR;
  }

  if (!is_writable(MODULE_ADDON_MODULES_DOWNLOAD_TEMP_DIRECTORY)) {
    $error_message .= ERROR_NO_PERMISSION_TEMP;
  }

  // ディレクトリが存在する場合はダウンロード済
  if (file_exists(getcwd()."/../".MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY.$filename)) {
    $error_message .= sprintf(ERROR_DOWNLOADED, $filename);
  }

  // エラーが無い場合のみダウンロード処理を行う
  if ($error_message == "") {
    // 該当するファイルが存在するか確認
    $find = -1;
    for ($i=0; $i<count($modules); $i++) {
      if ($modules[$i]['filename']   == $filename &&
          $modules[$i]['distribute'] == $distribute &&
          $modules[$i]['version']    == $version) {
        $find = $i;
        break;
      }
    }
    if ($find == -1) {
      $error_message .= sprintf(ERROR_NO_FILE, $filename);
    }
  }

  // バージョンチェック
  // #.#.#.#とoper#.#.#.#
  if ($error_message == "") {
    preg_match("/^([0-9.]+).*$/",      PROJECT_VERSION_MAJOR.".".PROJECT_VERSION_MINOR, $zencart_version);
    preg_match("/^(.*?)([0-9.]+).*$/", $modules[$find]['require_zen_cart_version'],     $require_zencart_version);

    $oper                    = trim($require_zencart_version[1]);
    $zencart_version         = explode(".", $zencart_version[1]);
    $require_zencart_version = explode(".", $require_zencart_version[2]);

    if (!version_check($oper, $zencart_version, $require_zencart_version))
      $error_message .= sprintf(ERROR_VERSION, $filename, $modules[$find]['require_zen_cart_version'], $modules[$find]['require_addon_modules_version']);
  }

  // addonコアのバージョンチェック
  if ($error_message == "") {
    $addon_version = $GLOBALS['addon_modules']->version;
    if ($addon_version == "")
      $addon_version = "1.0.0.0";

    preg_match("/^([0-9.]+).*$/",      $addon_version,                                   $adoon_version);
    preg_match("/^(.*?)([0-9.]+).*$/", $modules[$find]['require_addon_modules_version'], $require_adoon_version);

    $oper                  = trim($require_adoon_version[1]);
    $adoon_version         = explode(".", $adoon_version[1]);
    $require_adoon_version = explode(".", $require_adoon_version[2]);

    if (!version_check($oper, $adoon_version, $require_adoon_version))
      $error_message .= sprintf(ERROR_VERSION, $filename, $modules[$find]['require_zen_cart_version'], $modules[$find]['require_addon_modules_version']);
  }

  // エラーが無い場合のみダウンロード処理を行う
  if ($error_message == "") {
    // 一時ファイルに保存
    $archive = @file_get_contents($distribute."/".$filename.".tar");
    if ($archive === false) {
      $error_message .= sprintf(ERROR_CANNOT_DOWNLOAD, $filename);
    }
  }

  if ($error_message == "") {
    $tempfile = tempnam("/tmp", "download_");
    $temp     = fopen($tempfile, "w");
    fwrite($temp, $archive);
    fclose($temp);

    // tar展開
    ini_set('include_path', DIR_FS_CATALOG.'includes/addon_modules/addon_modules/pear/'.':'.ini_get('include_path'));
    require_once('Tar.php');
    umask(0);
    $tar    = new Archive_Tar($tempfile, "");
    $result = $tar->extract(getcwd()."/../".MODULE_ADDON_MODULES_DOWNLOAD_DIRECTORY);
    if ($result) {
      $success_message                     = sprintf(SUCCESS_EXTRACT, $filename);
      // ダウンロードしても、有効にしないとわからないので、とりあえず「不明」
      $modules[$find]['installed_version'] = MODULE_ADDON_MODULES_UNKNOWN_INSTALL_VERSION;
    }
    else
      $error_message = sprintf(ERROR_EXTRACT, $filename);

    unlink($tempfile);
  }
}

function version_check($oper, $current, $require) {
  if ($oper == '=' || $oper == '==') {
    if ((int)$current[0] == (int)$require[0] &&
        (int)$current[1] == (int)$require[1] &&
        (int)$current[2] == (int)$require[2] &&
        (int)$current[3] == (int)$require[3])
      return true;
  }

  else if ($oper == '>=' || $oper == '=>') {
    if ((int)$current[0] == (int)$require[0] &&
        (int)$current[1] == (int)$require[1] &&
        (int)$current[2] == (int)$require[2] &&
        (int)$current[3] >= (int)$require[3] ||

        (int)$current[0] == (int)$require[0] &&
        (int)$current[1] == (int)$require[1] &&
        (int)$current[2] >  (int)$require[2] ||

        (int)$current[0] == (int)$require[0] &&
        (int)$current[1] >  (int)$require[1] ||

        (int)$current[0] >  (int)$require[0])
      return true;
  }

  else if ($oper == '<=' || $oper == '=<') {
    if ((int)$current[0] == (int)$require[0] &&
        (int)$current[1] == (int)$require[1] &&
        (int)$current[2] == (int)$require[2] &&
        (int)$current[3] <= (int)$require[3] ||

        (int)$current[0] == (int)$require[0] &&
        (int)$current[1] == (int)$require[1] &&
        (int)$current[2] <  (int)$require[2] ||

        (int)$current[0] == (int)$require[0] &&
        (int)$current[1] <  (int)$require[1] ||

        (int)$current[0] <  (int)$require[0])
      return true;
  }

  // 比較無しは無条件ＯＫ
  else {
    return true;
  }

  return false;
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<div class="messageStackSuccess"><?php echo $success_message; ?></div>
<div class="messageStackError"><?php echo $error_message; ?></div>

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
  <table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td class="pageHeading"><br/><?php echo HEADING_TITLE; ?><br/><br/></td>
      <td align="right">
<?php
        echo zen_draw_form('back', FILENAME_ADDON_MODULES, '', "post");
        echo '<input type="submit" value="'.TEXT_BACK.'">'."\n";
        echo '</form>'."\n";
?>
      </td>
    </tr>

    <tr>
      <td valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
                <tr class="dataTableHeadingRow">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MODULE_NAME; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DESCRIPTION; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_VERSION; ?></td>
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ACTION; ?></td>
                </tr>

                <?php
                  for ($i=0; $i<count($modules); $i++) {
                    $onclick = 'onclick="document.location.href=\''.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_ADDON_MODULES."/download".'&row='.$i).'\'"';
                    if ($i == $row)
                      echo '<tr class="dataTableRowSelected" ';
                    else
                      echo '<tr class="dataTableRow" ';
                    echo 'onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
                    echo   '<td class="dataTableContent" nowrap '.$onclick.'>'."\n";
                    echo     $modules[$i]['name'][$language_code];
                    echo   '</td>'."\n";
                    echo   '<td class="dataTableContent" '.$onclick.'>'."\n";
                    $summary = $modules[$i]['summary'][$language_code];
                    $summary = str_replace("\n", "<br/>", $summary);
                    echo     $summary;
                    echo   '</td>'."\n";
                    echo   '<td class="dataTableContent" nowrap '.$onclick.'>'."\n";
                    echo     $modules[$i]['version']."[".$modules[$i]['installed_version']."]";
                    echo   '</td>'."\n";
                    echo   '<td class="dataTableContent" align="right" width="40" '.$onclick.'>'."\n";
                    if ($modules[$i]['installed_version'] == "-")
                      echo zen_image(DIR_WS_IMAGES . 'icons/file_download.gif');

                    if ($i == $row)
                      echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif');
                    else
                      echo zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO);
                    echo     '&nbsp;'."\n";
                    echo   '</td>'."\n";
                    echo '</tr>'."\n";
                }
              ?>
              </table>
            </td>
          </tr>
        </table>
      </td>
      <td width="25%" valign="top">
        <?php
        if ($row >= 0 && $row < count($modules)) {
        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="infoBoxHeading">
            <td class="infoBoxHeading"><b><?php echo HEADING_INFOBOX_TITLE; ?></b></td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_MODULE_NAME; ?></b><br/>
              <?php echo $modules[$row]['name'][$language_code]; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_FILENAME; ?></b><br/>
              <?php echo $modules[$row]['filename']; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_DISTRIBUTION_URL; ?></b><br/>
              <?php echo $modules[$row]['distribute']; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_AUTHOR; ?></b><br/>
              <?php echo $modules[$row]['author']; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_VERSION; ?></b><br/>
              <?php echo $modules[$row]['version']."[".$modules[$row]['installed_version']."]"; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_REQUIRE_ZENCART; ?></b><br/>
              <?php echo $modules[$row]['require_zen_cart_version']; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_REQUIRE_ADDON; ?></b><br/>
              <?php echo $modules[$row]['require_addon_modules_version']; ?><br/><br/>
            </td>
          </tr>
          <tr>
            <td class="infoBoxContent"><b><?php echo TEXT_INFO_BOX_DESCRIPTION; ?></b><br/>
              <?php echo $modules[$row]['summary'][$language_code]; ?><br/><br/>
            </td>
          </tr>
          <?php if ($modules[$row]['installed_version'] == "-") { ?>
          <tr>
            <td class="infoBoxContent" align="right">
            <?php
              echo zen_draw_form('download', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_ADDON_MODULES."/download", "post");
              echo zen_draw_hidden_field('action',     'download');
              echo zen_draw_hidden_field('filename',   $modules[$row]['filename']);
              echo zen_draw_hidden_field('distribute', $modules[$row]['distribute']);
              echo zen_draw_hidden_field('version',    $modules[$row]['version']);
              echo '<input type="submit" value="'.TEXT_DOWNLOAD.'">'."\n";
              echo '</form>'."\n";
            ?>
            </td>
          </tr>
          <?php } ?>
        </table>
        <?php
        }
        ?>
      </td>
    </tr>

  </table>
<!-- body_text_eof //-->

<br>
</body>
</html>
