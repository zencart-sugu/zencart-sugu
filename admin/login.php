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
//  $Id: login.php 4638 2006-09-30 22:32:05Z wilt $
//

  require('includes/application_top.php');

  $message = false;
  if (isset($_POST['submit'])) {
    $admin_name = zen_db_prepare_input($_POST['admin_name']);
    $admin_pass = zen_db_prepare_input($_POST['admin_pass']);
    $sql = "select admin_id, admin_name, admin_pass from " . TABLE_ADMIN . " where admin_name = '" . zen_db_input($admin_name) . "'";
    $result = $db->Execute($sql);
    if (!($admin_name == $result->fields['admin_name'])) {
      $message = true;
      $pass_message = ERROR_WRONG_LOGIN;
    }
    if (!zen_validate_password($admin_pass, $result->fields['admin_pass'])) {
      $message = true;
      $pass_message = ERROR_WRONG_LOGIN;
    }
    if ($message == false) {
      $_SESSION['admin_id'] = $result->fields['admin_id'];
      zen_redirect(zen_href_link(FILENAME_DEFAULT, '', 'SSL'));
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body id="login" onload="document.getElementById('admin_name').focus()">
<form name="login" action="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" method = "POST">
  <fieldset>
    <legend><?php echo HEADING_TITLE; ?></legend>
    <label class="loginLabel" for="admin_name"><?php echo TEXT_ADMIN_NAME; ?></label>
<input style="float: left" type="text" id="admin_name" name="admin_name" value="<?php echo zen_output_string($admin_name); ?>" />
<br class="clearBoth" />
    <label  class="loginLabel" for="admin_pass"><?php echo TEXT_ADMIN_PASS; ?></label>
<input style="float: left" type="password" id="admin_pass" name="admin_pass" value="<?php echo zen_output_string($admin_pass); ?>" />
<br class="clearBoth" />
    <?php echo $pass_message; ?>
    <input type="submit" name="submit" class="button" value="Login" />
    <?php echo '<a style="float: right;" href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
  </fieldset>
</form>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>
