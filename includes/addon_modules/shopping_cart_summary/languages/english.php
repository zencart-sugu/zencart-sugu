<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
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
define('MODULE_SHOPPING_CART_SUMMARY_TITLE', 'Shopping Cart Summary');
define('MODULE_SHOPPING_CART_SUMMARY_DESCRIPTION', 'Shopping Cart Summary<br />Add a block that displays the shopping cart summary.<br />Please block display setting from <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">block setting</a> after Enabling.');
define('MODULE_SHOPPING_CART_SUMMARY_STATUS_TITLE', 'Activating Shopping Cart Summary');
define('MODULE_SHOPPING_CART_SUMMARY_STATUS_DESCRIPTION', 'Do you want to active to shopping cart summary?<br />true: Active<br />false: Inactive');
define('MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_SHOPPING_CART_SUMMARY_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_SHOPPING_CART_SUMMARY_BLOCK_TITLE', 'Shopping Cart Summary');
define('HEADER_SHOPPING_CART_A_CONTENT', '');
define('HEADER_SHOPPING_CART_CONTENTS', '<span class="total">(%s Item(s))</span>');
define('HEADER_SHOPPING_CART_EMPTY', 'Empty');
define('HEADER_SHOPPING_CART_TOTAL', 'Total:<span class="price">%s</span>');
define('BUTTON_IMAGE_VIEW_SHOPPING_CART', 'button_view_shopping_cart.gif');
define('BUTTON_VIEW_SHOPPING_CART_ALT', 'View Shopping Cart');
?>
