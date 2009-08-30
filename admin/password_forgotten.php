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
//$Id: password_forgotten.php 4639 2006-09-30 22:54:30Z wilt $
//

  require('includes/application_top.php');

  // demo active test
  if (zen_admin_demo()) {
    $_GET['action']= '';
    $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
    zen_redirect(zen_href_link(FILENAME_DEFAULT));
  }

  if (isset($_POST['login'])) {
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

$error_check = false;

if (isset($_POST['submit'])) {

  if ( !$_POST['admin_email'] ) {
    $error_check = true;
    $email_message = ERROR_WRONG_EMAIL_NULL;
  }

  $admin_email = zen_db_prepare_input($_POST['admin_email']);

  $sql = "select admin_id, admin_name, admin_email, admin_pass from " . TABLE_ADMIN . " where admin_email = '" . zen_db_input($admin_email) . "'";

  $result = $db->Execute($sql);

  if (!($admin_email == $result->fields['admin_email'])) {
    $error_check = true;
    $email_message = ERROR_WRONG_EMAIL;
  }

  if ($error_check == false) {

    $new_password = zen_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
    $admin_pass = zen_encrypt_password($new_password);
    $sql = "update " . TABLE_ADMIN . " set admin_pass = '" . zen_db_input($admin_pass) . "' where admin_email = '" . $result->fields['admin_email'] . "'";

    $db->Execute($sql);

    $html_msg['EMAIL_CUSTOMERS_NAME'] = $result->fields['admin_name'];
    $html_msg['EMAIL_MESSAGE_HTML'] = sprintf(TEXT_EMAIL_MESSAGE, $new_password);
    zen_mail($result->fields['admin_name'], $result->fields['admin_email'], TEXT_EMAIL_SUBJECT, sprintf(TEXT_EMAIL_MESSAGE, $new_password), STORE_NAME, EMAIL_FROM, $html_msg, 'password_forgotten_admin');
    $email_message = SUCCESS_PASSWORD_SENT;

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
<body id="login">
<form name="login" action="<?php echo zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'); ?>" method = "POST">
<fieldset>
<legend><?php echo HEADING_TITLE; ?></legend>
<label for="admin_email"><?php echo TEXT_ADMIN_EMAIL; ?><input type="text" id="admin_email" name="admin_email" value="<?php echo zen_output_string($admin_email); ?>" /></label>
<?php echo $email_message; ?>

<input type="submit" name="submit" class="button" value="resend" />
<input type="submit" name="login" class="button" value="login" />

</fieldset>
</form>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>
