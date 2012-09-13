<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//

define('MODULE_CHECKOUT_STEP_TITLE', 'Display of Step Order');
define('MODULE_CHECKOUT_STEP_DESCRIPTION', 'Display the step order.<br />The block where the step until completing the order is displayed is added.<br />Please display setting for the <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">Block Setting</a> after activation.');
define('MODULE_CHECKOUT_STEP_STATUS_TITLE', 'Activating Display of Step Order');
define('MODULE_CHECKOUT_STEP_STATUS_DESCRIPTION', 'Do you want to active to display of step order?<br />true: Active<br />false: Inactive');
define('MODULE_CHECKOUT_STEP_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_CHECKOUT_STEP_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_CHECKOUT_STEP_BLOCK_TITLE', 'Checkout Step');

define('MODULE_CHECKOUT_STEP_BLOCK_CART', 'Check Cart');
define('MODULE_CHECKOUT_STEP_BLOCK_SHIPPING', 'Shipping Method');
define('MODULE_CHECKOUT_STEP_BLOCK_PAYMENT', 'Payment Method');
define('MODULE_CHECKOUT_STEP_BLOCK_CONFIRMATION', 'Confirmation');
define('MODULE_CHECKOUT_STEP_BLOCK_SUCCESS', 'Success - Thank You');
define('MODULE_CHECKOUT_STEP_BLOCK_LOGIN', 'Log In or Register');


?>
