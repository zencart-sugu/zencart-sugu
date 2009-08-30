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
// $Id: create_account_success.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE_1', 'Create an Account');
define('NAVBAR_TITLE_2', 'Success');
define('HEADING_TITLE', 'Your Account Has Been Created!');
define('TEXT_ACCOUNT_CREATED', 'Congratulations! Your new account has been successfully created! You can now take advantage of member privileges to enhance your online shopping experience with us. If you have <small><strong>ANY</strong></small> questions about the operation of this online shop, please email the <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">store owner</a>.<br /><br />A confirmation has been sent to the provided email address. If you have not received it within the hour, please <a href="' . zen_href_link(FILENAME_CONTACT_US) . '">contact us</a>.');
?>