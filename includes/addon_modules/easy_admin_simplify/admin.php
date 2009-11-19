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
  require("../includes/addon_modules/calendar/languages/" . $_SESSION['language'] . '.php');
?>
<?php
// メッセージ
$message = "";

// 操作
$action = $_REQUEST['action'];

if ($action == "update") {
  // いったん関連キーを削除
  $sql = "delete from ".TABLE_CONFIGURATION." where configuration_key like '".MODULE_EASY_ADMIN_SIMPLIFY_KEY."%'";
  $db->execute($sql);

  // 設定を行う
  for ($i=0; $i<count($easy_admin_simplify_config); $i++) {
    for ($j=0; $j<count($easy_admin_simplify_config[$i]['item']); $j++) {
      $key         = MODULE_EASY_ADMIN_SIMPLIFY_KEY.$easy_admin_simplify_config[$i]['item'][$j]['key'];
      $description = $easy_admin_simplify_config[$i]['item'][$j]['description'];
      if (isset($_POST[$key]))
        $value = "true";
      else
        $value = "false";
      $sql = "insert into ".TABLE_CONFIGURATION." "
           . "(configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) "
           . "VALUES ("
           . "'".addslashes($description)."',"
           . "'".addslashes($key)."',"
           . "'".addslashes($value)."',"
           . "'',"
           . "-1," // メニューには表示させない
           . "'1',"
           . "now())";
      $db->execute($sql);
    }
  }

  $_SESSION['easy_admin_simplify_message'] = TEXT_UPDATE_SUCCESS;
  zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN_SIMPLIFY));
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

      var specificday = document.getElementById('specificday');
      if (specificday) {
        while (specificday.childNodes.length)
          specificday.removeChild(specificday.childNodes.item(specificday.childNodes.length-1));
      }
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
<div class="messageStackSuccess"><?php
  echo $_SESSION['easy_admin_simplify_message'];
  $_SESSION['easy_admin_simplify_message'] = '';
?></div>

<?php echo zen_draw_form('update', FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN_SIMPLIFY); ?>
<input type="hidden" name="action" value="update">
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td valign="top">
      <table border="0" width="95%" cellspacing="0" cellpadding="2" align="center">
        <tr>
          <td class="pageHeading" colspan="3"><?php echo HEADING_TITLE; ?></td>
        </tr>
        <tr>
          <td class="errorText" colspan="3"><?php echo TEXT_INFORMATION; ?></td>
        </tr>
<?php
        for ($i=0; $i<count($easy_admin_simplify_config); $i++) {
          $title = $easy_admin_simplify_config[$i]['title'];
?>
          <tr>
            <td colspan="3"><hr/></td>
          </tr>
<?php
          for ($j=0; $j<count($easy_admin_simplify_config[$i]['item']); $j++) {
            if ($j!=0)
              $title = "";
            $type        = $easy_admin_simplify_config[$i]['item'][$j]['type'];
            $key         = MODULE_EASY_ADMIN_SIMPLIFY_KEY.$easy_admin_simplify_config[$i]['item'][$j]['key'];
            $description = $easy_admin_simplify_config[$i]['item'][$j]['description'];
            if ($type == 'D')
              $type = TEXT_DISPLAY;
            else if ($type == 'C')
              $type = TEXT_CHANGE;
            if (defined($key) && constant($key) == 'true')
              $checked = "CHECKED";
            else
              $checked = "";
?>
            <tr>
              <td width="10%" nowrap><?php echo $title; ?></td>
              <td width="10%" nowrap><?php echo $description; ?></td>
              <td><input type="checkbox" name="<?php echo $key; ?>" <?php echo $checked;?>><?php echo $type; ?></td>
            </tr>
<?php
          }
        }
?>
        <tr>
          <td>
            <input type="submit" value="<?php echo TEXT_UPDATE; ?>">
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</form>
<!-- body_text_eof //-->
<br>
</body>
</html>
