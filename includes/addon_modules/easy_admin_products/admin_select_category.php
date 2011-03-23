<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$searchs = array('keyword');
$model   = new easy_admin_products_model();
$html    = new easy_admin_products_html();
$model->set_get_search_condition($searchs);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>easy_admin_products/templates/admin/css/easy_admin_products.css" media="screen" />
</head>
<body>
<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <!-- body_text //-->
    <td width="100%" valign="top" align="center"><table border="0" width="95%" cellspacing="0" cellpadding="2">
      <tr>
        <td>
          <?php require(dirname(__FILE__) . '/templates/admin/select_category.php'); ?>
        </td>
      </tr>
    </table></td>
    <!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
</body>
</html>
