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

  function checkDataTop()
  {
    var error = "";

    // 適用対象
    var top_menu_name       = document.getElementById('top_menu_name');
    var top_menu_dropdown_1 = document.getElementById('top_menu_dropdown_1');
    var top_menu_dropdown_0 = document.getElementById('top_menu_dropdown_0');
    var top_menu_sort_order = document.getElementById('top_menu_sort_order');

    if (top_menu_name.value == '')
      error += "<?php echo TEXT_ERROR_MENU_NAME;?>\n";

    if (!top_menu_dropdown_1.checked  &&
        !top_menu_dropdown_0.checked)
      error += "<?php echo TEXT_ERROR_MENU_DROPDOWN;?>\n";

    if (!top_menu_sort_order.value.match(/^[0-9]+$/))
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

// 操作
$action    = $_REQUEST['action'];
$topmenuid = (int)$_REQUEST['top_menu_id'];
$submenuid = (int)$_REQUEST['sub_menu_id'];

if ($action == "top-update" ||
    $action == "top-insert") {
  $top_menu_name  = $_REQUEST['top_menu_name'];
  $dropdown       = $_REQUEST['top_menu_dropdown'];
  $top_menu_order = $_REQUEST['top_menu_order'];

  // データのチェック
  if ($action == "top-insert" || $action == "top-update" && $topmenuid > 0) {
    if ($top_menu_name == "")
      $error .= "<br/>".TEXT_ERROR_MENU_NAME;

    if ($dropdown != '0' && $dropdown != '1')
      $error .= "<br/>".TEXT_ERROR_MENU_DROPDOWN;

    if ($error == "") {
      if ($action == "top-insert") {
        insertTopMenu($top_menu_name, $dropdown, $top_menu_order);
        $message = TEXT_INSERT_SUCCESS_TOPMENU;
      }
      else {
        updateTopMenu($topmenuid, $top_menu_name, $dropdown, $top_menu_order);
        $message = TEXT_UPDATE_SUCCESS_TOPMENU;
      }
    }
  }
}
else if ($action == "top-delete") {
  if ($topmenuid > 0) {
    deleteTopMenu($topmenuid);
    $message = TEXT_DELETE_SUCCESS_TOPMENU;
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
                <td class="pageHeading" colspan="4"><?php echo TEXT_HEADER_TOP_MENU; ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_TOP_MENU_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_TOP_MENU_TYPE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_TOP_MENU_ORDER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TEXT_HEADER_TOP_MENU_ACTION; ?></td>
              </tr>
<?php
              // トップメニュー
              $top_menus = getTopMenus();
              for ($i=0; $i<count($top_menus); $i++) {
                $top_menu_id         = $top_menus[$i]['id'];
                $top_menu_name       = $top_menus[$i]['name'];
                $dropdown            = $top_menus[$i]['dropdown'];
                $top_menu_sort_order = $top_menus[$i]['order'];
                $onclick = 'onclick="document.location.href=\''.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'&top_menu_id='.$top_menu_id).'\'"';

                echo '<tr class=';
                if ($top_menu_id == $topmenuid)
                  echo '"dataTableRowSelected" ';
                else
                  echo '"dataTableRow" ';
                echo   'onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";

                echo   '<td nowrap '.$onclick.'>'."\n";
                echo     $top_menu_name;
                echo   '</td>'."\n";

                echo   '<td '.$onclick.'>'."\n";
                if ($dropdown)
                  echo TEXT_MENU_TYPE_DROPDOWN;
                else
                  echo TEXT_MENU_TYPE_RIGHTUP;
                echo   '</td>'."\n";

                echo   '<td nowrap '.$onclick.'>'."\n";
                echo     $top_menu_sort_order;
                echo   '</td>'."\n";

                echo   '<td align="right" width="220">'."\n";
                echo     zen_draw_form('edit', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN);
                echo       zen_draw_hidden_field('top_menu_id',     $top_menu_id);
                echo       '<input type="submit" value="'.TEXT_ACTION_EDIT.'">'."\n";
                echo     '</form>'."\n";
                echo     zen_draw_form('delete', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN);
                echo       zen_draw_hidden_field('action', 'top-delete');
                echo       zen_draw_hidden_field('top_menu_id',     $top_menu_id);
                echo       '<input type="submit" value="'.TEXT_ACTION_DELETE.'" onClick="return deleteConfirm('."'".$top_menu_name."'".');">'."\n";
                echo     '</form>'."\n";
                echo     zen_draw_form('delete', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN."/".FILENAME_EASY_ADMIN_SUB_MENU);
                echo       zen_draw_hidden_field('top_menu_id',     $top_menu_id);
                echo       '<input type="submit" value="'.TEXT_ACTION_SUBMENU.'">'."\n";
                echo     '</form>'."\n";
                echo     '<a href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'&top_menu_id='.$top_menu_id).'">';
                if ($top_menu_id == $topmenuid)
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
            echo       zen_draw_hidden_field('action', 'top-add');
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
          if ($action == "top-add") {
            $top_menu_id         = "";
            $top_menu_name       = "";
            $dropdown            = 1;
            $top_menu_sort_order = "";
            $info                = TEXT_INPUT_ADD;
          }
          else if ($topmenuid > 0) {
            $menu = getTopMenus($topmenuid);
            if (count($menu)) {
              $top_menu_id         = $menu[0]['id'];
              $top_menu_name       = $menu[0]['name'];
              $dropdown            = $menu[0]['dropdown'];
              $top_menu_sort_order = $menu[0]['order'];
              $info                = $top_menu_name;
            }
            else
              $topmenuid = 0;
          }
          else
            $topmenuid = 0;

          if ($action == "top-add" || $topmenuid>0) {
            echo   '<td class="infoBoxHeading" colspan="3"><b>'.$info.'</b></td>'."\n";
            echo '</tr>'."\n";

            echo zen_draw_form('warranty', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN);
            if ($action == "top-add")
              echo zen_draw_hidden_field('action', 'top-insert');
            else
              echo zen_draw_hidden_field('action', 'top-update');
            echo zen_draw_hidden_field('top_menu_id', $topmenuid);

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_NAME;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_input_field("top_menu_name", $top_menu_name, 'id="top_menu_name" size="64"');
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_TYPE;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_radio_field("top_menu_dropdown", '1', $dropdown==1, '', 'id="top_menu_dropdown_1"').TEXT_MENU_TYPE_DROPDOWN."<br/>";
            echo     zen_draw_radio_field("top_menu_dropdown", '0', $dropdown==0, '', 'id="top_menu_dropdown_0"').TEXT_MENU_TYPE_RIGHTUP."<br/>";
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            echo '<tr>'."\n";
            echo   '<td width="10%" align="right" nowrap>'."\n";
            echo     TEXT_INPUT_ORDER;
            echo   '</td>'."\n";
            echo   '<td>'."\n";
            echo     zen_draw_input_field("top_menu_order", $top_menu_sort_order, 'id="top_menu_order" size="8"');
            echo   '</td>'."\n";
            echo '</tr>'."\n";

            // 追加or更新
            echo '<tr>'."\n";
            echo   '<td>'."\n";
            if ($action == "top-add")
              echo     '<input type="submit" value="'.TEXT_ACTION_ADD.'" onClick="return checkDataTop();">'."\n";
            else
              echo     '<input type="submit" value="'.TEXT_ACTION_UPDATE.'" onClick="return checkDataTop();">'."\n";
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
