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
// $Id: english.php $
//
define('MODULE_VIEWED_PRODUCTS_TITLE', 'Recently Viewed Products');
define('MODULE_VIEWED_PRODUCTS_DESCRIPTION', 'Record display the recently viewed products.');
define('MODULE_VIEWED_PRODUCTS_STATUS_TITLE', 'Activating Recently Viewed Products<br />Please block display setting of the "Recently Viewed Products" block from a <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks') . '">brock setting</a> after activating.');
define('MODULE_VIEWED_PRODUCTS_STATUS_DESCRIPTION', 'Do you want to active to recently viewed products?<br />true: Active<br />false: Inactive');
define('MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_TITLE', 'Maximum Display Number');
define('MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DESCRIPTION', 'Please set a maximum display number of recently viewed products.<br />Default = ' . MODULE_VIEWED_PRODUCTS_MAX_DISPLAY_VIEWED_DEFAULT);
define('MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_TITLE', 'Recently viewed product images (small) size');
define('MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DESCRIPTION', 'Please set the recently viewed product images (small) size by width x height.<br />Default = ' . MODULE_VIEWED_PRODUCTS_SMALL_IMAGE_SIZE_DEFAULT);
define('MODULE_VIEWED_PRODUCTS_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_VIEWED_PRODUCTS_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_VIEWED_PRODUCTS_BLOCK_TITLE', 'Commodity seen recently');
?>