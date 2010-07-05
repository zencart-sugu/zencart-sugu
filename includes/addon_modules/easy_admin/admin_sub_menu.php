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
//  $Id: email_welcome.php 2999 2006-02-09 17:21:39Z drbyte $
//
  require("../includes/addon_modules/easy_design/languages/" . $_SESSION['language'] . '.php');

// チェック
if ((int)$_REQUEST['top_menu_id'] == 0)
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN));

$menu = getTopMenus((int)$_REQUEST['top_menu_id']);
if (count($menu) == 0)
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN));

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
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;

      var specificday = document.getElementById('specificday');
      if (specificday) {
        while (specificday.childNodes.length)
          specificday.removeChild(specificday.childNodes.item(specificday.childNodes.length-1));
      }
    }
  }

  function deleteConfirm(str)
  {
    return window.confirm("["+str+"]"+"<?php echo TEXT_CONFIRM_MENU_DELETE; ?>");
  }

  function checkDataSub()
  {
    var error = "";

    // 適用対象
    var sub_menu_name       = document.getElementById('sub_menu_name');
    var sub_menu_url        = document.getElementById('sub_menu_url');
    var sub_menu_sort_order = document.getElementById('sub_menu_sort_order');

    if (sub_menu_name.value == '')
      error += "<?php echo TEXT_ERROR_MENU_NAME;?>\n";

    if (sub_menu_url.value == '')
      error += "<?php echo TEXT_ERROR_MENU_SELECT;?>\n";

    if (!sub_menu_sort_order.value.match(/^[0-9]+$/))
      error += "<?php echo TEXT_ERROR_MENU_ORDER;?>\n";

    if (error != "") {
      window.alert(error);
      return false;
    }

    return true;
  }
  // -->
</script>

<link rel="stylesheet" href="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/css/colorPicker.css" type="text/css" />
<script language="javascript" src="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/js/jquery-1.3.2.min.js"></script>
<script language="javascript" src="<?php echo DIR_WS_CATALOG.DIR_WS_INCLUDES; ?>addon_modules/easy_design/js/jquery.colorPicker.js"></script>
<script type="text/javascript">
  <!--
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
<?php
// メッセージ
$message = "";
$error   = "";

// 旧メニュー
$old_menus = parseAdminMenus();
$key_menus = convertKeyAdminMenus($old_menus);

// 操作
$action    = $_REQUEST['action'];
$topmenuid = (int)$_REQUEST['top_menu_id'];
$submenuid = (int)$_REQUEST['sub_menu_id'];
$topmenu   = getTopMenus($topmenuid);

if ($action == "sub-update" ||
    $action == "sub-insert") {
  $sub_menu_name  = $_REQUEST['sub_menu_name'];
  $sub_menu_url   = $_REQUEST['sub_menu_url'];

  $sub_menu_order = $_REQUEST['sub_menu_order'];

  // データのチェック
  if ($action == "sub-insert" || $action == "sub-update" && $topmenuid > 0 && $submenuid > 0) {
    if ($sub_menu_name == "")
      $error .= "<br/>".TEXT_ERROR_MENU_NAME;

    if ($sub_menu_url == "")
      $error .= "<br/>".TEXT_ERROR_MENU_SELECT;

    if ($sub_menu_order == "")
      $error .= "<br/>".TEXT_ERROR_MENU_ORDER;

    if ($error == "") {
      if ($action == "sub-insert") {
        insertSubMenu($topmenuid, $sub_menu_name, $sub_menu_url, $sub_menu_order);
        $message = TEXT_INSERT_SUCCESS_SUBMENU;
      }
      else {
        updateSubMenu($topmenuid, $submenuid, $sub_menu_name, $sub_menu_url, $sub_menu_order);
        $message = TEXT_UPDATE_SUCCESS_SUBMENU;
      }
    }
  }
}
else if ($action == "sub-delete") {
  if ($topmenuid > 0 && $submenuid > 0) {
    deleteSubMenu($topmenuid, $submenuid);
    $message = TEXT_DELETE_SUCCESS_SUBMENU;
  }
}
?>

<div class="messageStackSuccess"><?php echo $message; ?></div>
<div class="messageStackError"><?php echo $error; ?></div>

<h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

<table border="0" width="100%" height="100%" cellspacing="0" cellpadding="2">
  <tr>
    <!-- 左側 -->
    <td valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="pageHeading" colspan="4"><?php echo $topmenu[0]['name'].TEXT_HEADER_SUB_MENU; ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_SUB_MENU_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_SUB_MENU_OLD; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_SUB_MENU_ORDER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_SUB_MENU_ACTION; ?></td>
              </tr>
<?php
              // サブメニュー
              $sub_menus = getSubMenus($topmenuid);
              for ($i=0; $i<count($sub_menus); $i++) {
                $sub_menu_id         = $sub_menus[$i]['id'];
                $top_menu_id         = $sub_menus[$i]['topid'];
                $sub_menu_name       = $sub_menus[$i]['name'];
                $sub_menu_url        = $sub_menus[$i]['url'];
                $sub_menu_sort_order = $sub_menus[$i]['order'];
                if (isset($key_menus[$sub_menu_url]))
                  $sub_menu_old      = $key_menus[$sub_menu_url];
                else
                  $sub_menu_old      = TEXT_MENU_OLD_UNDEFINE;
                $onclick = 'onclick="document.location.href=\''.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU.'&top_menu_id='.$top_menu_id.'&sub_menu_id='.$sub_menu_id).'\'"';

                echo '<tr class=';
                if ($sub_menu_id == $submenuid)
                  echo '"dataTableRowSelected" ';
                else
                  echo '"dataTableRow" ';
                echo   'onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
                echo   '<td nowrap '.$onclick.'>'."\n";
                echo     $sub_menu_name;
                echo   '</td>'."\n";

                echo   '<td '.$onclick.'>'."\n";
                echo     $sub_menu_old."(".$sub_menu_url.")";
                echo   '</td>'."\n";

                echo   '<td '.$onclick.'>'."\n";
                echo     $sub_menu_sort_order;
                echo   '</td>'."\n";

                echo   '<td align="right" width="120">'."\n";
                echo     zen_draw_form('edit', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU);
                echo       zen_draw_hidden_field('top_menu_id', $top_menu_id);
                echo       zen_draw_hidden_field('sub_menu_id', $sub_menu_id);
                echo       '<input type="submit" value="'.TEXT_ACTION_EDIT.'">'."\n";
                echo     '</form>'."\n";
                echo     zen_draw_form('delete', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU);
                echo       zen_draw_hidden_field('action', 'sub-delete');
                echo       zen_draw_hidden_field('top_menu_id', $top_menu_id);
                echo       zen_draw_hidden_field('sub_menu_id', $sub_menu_id);
                echo       '<input type="submit" value="'.TEXT_ACTION_DELETE.'" onClick="return deleteConfirm('."'".$sub_menu_name."'".');">'."\n";
                echo     '</form>'."\n";
                echo     '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU.'&top_menu_id='.$top_menu_id).'">';
                if ($sub_menu_id == $submenuid)
                  echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif');
                else
                  echo zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO);
                echo     '</a>&nbsp;'."\n";
                echo   '</td>'."\n";
                echo '</tr>'."\n";
              }
?>
            </table>
          </td>
        </tr>

        <!-- TOP追加 -->
        <tr>
          <td colspan="3" align="right">
<?php
            echo     zen_draw_form('add', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN);
            echo       '<input type="submit" value="'.TEXT_ACTION_BACK.'">'."\n";
            echo     '</form>'."\n";

            echo     zen_draw_form('add', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU);
            echo       zen_draw_hidden_field('action',      'sub-add');
            echo       zen_draw_hidden_field('top_menu_id', $topmenuid);
            echo       '<input type="submit" value="'.TEXT_ACTION_ADD.'">'."\n";
            echo     '</form>'."\n";
            echo     zen_draw_separator("pixel_trans.gif", 17);
?>
          </td>
        </tr>

      </table>
    </td>

    <!-- 右側 -->
    <td width="30%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td class="pageHeading">&nbsp;</td>
        </tr>
        <tr class="infoBoxHeading">
<?php
          if ($action == "sub-add") {
            $top_menu_id    = $topmenuid;
            $sub_menu_id    = "";
            $sub_menu_name  = "";
            $sub_menu_url   = "";
            $sub_menu_order = "";
            $info           = TEXT_INPUT_ADD;
          }
          else if ($submenuid > 0) {
            $menu = getSubMenus($topmenuid, $submenuid);
            if (count($menu)) {
              $top_menu_id    = $topmenuid;
              $sub_menu_id    = $menu[0]['id'];
              $sub_menu_name  = $menu[0]['name'];
              $sub_menu_url   = $menu[0]['url'];
              $sub_menu_order = $menu[0]['order'];
              $info           = $sub_menu_name;
            }
            else
              $submenuid = 0;
          }
          else
            $submenuid = 0;

          if ($action == "sub-add" || $submenuid>0) {
            // 対応旧メニュー作成
            $menu_select = array();
            for ($i=0; $i<count($old_menus); $i++) {
              for ($j=0; $j<count($old_menus[$i]['menus']); $j++) {
                $menu_select[] = array('id'   => $old_menus[$i]['menus'][$j]['url'],
                                  'text' => $old_menus[$i]['title']." > ".$old_menus[$i]['menus'][$j]['menu']);
              }
            }

            echo   '<td class="infoBoxHeading" colspan="3"><b>'.$info.'</b></td>'."\n";
            echo '</tr>'."\n";

            echo zen_draw_form('warranty', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/'.FILENAME_EASY_ADMIN_SUB_MENU);
            if ($action == "sub-add")
              echo zen_draw_hidden_field('action', 'sub-insert');
            else
              echo zen_draw_hidden_field('action', 'sub-update');
            echo zen_draw_hidden_field('top_menu_id', $topmenuid);
            echo zen_draw_hidden_field('sub_menu_id', $submenuid);

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_NAME;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_input_field("sub_menu_name", $sub_menu_name, 'id="sub_menu_name" size="64"');
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_OLD;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_pull_down_menu("sub_menu_url", $menu_select, $sub_menu_url, 'id="sub_menu_url"');
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_ORDER;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_input_field("sub_menu_order", $sub_menu_sort_order, 'id="sub_menu_sort_order" size="8"');
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            // 追加or更新
            echo '<tr>'."\n";
            echo   '<td>'."\n";
            if ($action == "top-add")
              echo     '<input type="submit" value="'.TEXT_ACTION_ADD.'" onClick="return checkDataSub();">'."\n";
            else
              echo     '<input type="submit" value="'.TEXT_ACTION_UPDATE.'" onClick="return checkDataSub();">'."\n";
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            echo '</form>'."\n";
          }
?>
        </tr>
      </table>
    </td>
  </tr>

</table>
<!-- body_text_eof //-->

<br>
</body>
</html>
