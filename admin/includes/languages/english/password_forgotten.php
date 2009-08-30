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
// $Id: password_forgotten.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'Resend Password');

define('TEXT_ADMIN_EMAIL', 'Admin Email Address: ');

define('ERROR_WRONG_EMAIL', '<p>You entered the wrong email address.</p>');
define('ERROR_WRONG_EMAIL_NULL', '<p>Nice try mate :-P</p>');
define('SUCCESS_PASSWORD_SENT', '<p>Success: A new password has been sent to your e-mail address.</p>');

define('TEXT_EMAIL_SUBJECT', 'Your Requested change');
define('TEXT_EMAIL_FROM', EMAIL_FROM);
define('TEXT_EMAIL_MESSAGE', 'A new password was requested from ' . $_SESSION['REMOTE_ADDR'] . '.' . "\n\n" . 'Your new password to \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");

?>