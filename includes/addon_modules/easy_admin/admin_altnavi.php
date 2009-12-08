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
<script language="JavaScript" src="includes/menu.js" type="text/JavaScript"></script>

<link rel="stylesheet" href="includes/nde-basic.css" type="text/css" media="screen, projection">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
<?php
$pid       = (int)$_REQUEST['id'];
if ($pid == 0)
  $pid = -1;
$top_menu  = getTopMenus($pid);
$sub_menus = getSubMenus($pid);
?>
<table align="center" cellpadding="0" cellspacing="0" width="95%">
<tr>
	<td><?php echo zen_draw_separator('pixel_trans.gif', 1, 10); ?></td>
</tr>
<tr>
<td>
  <a class="pageHeading" target="_top" href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/altnavi').'&id='.$top_menu[0]['id']; ?>"><?php echo $top_menu[0]['name']; ?></a></h1
  <ul class="submenu ">

<?php
  for ($i=0; $i<count($sub_menus); $i++) {
    // ページは許可されているか？
    $page = $sub_menus[$i]['url'];
    $page = str_replace(DIR_WS_ADMIN, "", $page);
    if (function_exists("page_allowed") && page_allowed($page) != 'true')
      continue;
?>
  <li><a href="<?php echo $sub_menus[$i]['url']; ?>"><?php echo $sub_menus[$i]['name']; ?></a></li>
<?php
  }
?>

  </ul>

</td>
</tr>
</table>
<!-- body_text_eof //-->

<br>
</body>
</html>
