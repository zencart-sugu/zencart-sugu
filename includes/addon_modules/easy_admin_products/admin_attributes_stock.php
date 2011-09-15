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
//  $Id: products_with_attributes_stock.php 2999 2006-02-09 17:21:39Z drbyte $
//
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(dirname(__FILE__) . '/includes/action_attributes_stock.php');
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script type="text/javascript" src="includes/menu.js"></script>
<script type="text/javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script type="text/javascript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
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
<body onLoad="init()">
<!-- header //-->
<?php
require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->
<div style="padding: 20px;">

<!-- body_text_eof //-->
<!-- body_eof //-->

<?php
switch($action) {
  case 'add':
    require(dirname(__FILE__) . '/templates/admin_attributes_stocks/add.php');
    break;

  case 'edit':
    require(dirname(__FILE__) . '/templates/admin_attributes_stocks/edit.php');
    break;

  default:
    require(dirname(__FILE__) . '/templates/admin_attributes_stocks/products_stock_list.php');
    break;
}
?>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</div>
</body>
</html>
