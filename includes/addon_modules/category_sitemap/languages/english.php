<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2008 Liquid System Technology, Inc.                    |
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
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TITLE',                  'Category Site Map');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_DESCRIPTION',            'Display category site map');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_TITLE',           'Activating Category Site Map');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_STATUS_DESCRIPTION',     'Do you want to active to category site map?<br />true: Active<br />false: Inactive');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_TITLE',       'Display The Category Hierarchy');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DESCRIPTION', 'Specify to display the category hierarchy. (Default='.MODULE_ADDON_MODULES_CATEGORY_SITEMAP_TREE_LEVEL_DEFAULT.')');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_TITLE',       'Sort Order');
define('MODULE_ADDON_MODULES_CATEGORY_SITEMAP_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_CATEGORY_SITEMAP_TITLE',            'Category Site Map');
define('MODULE_CATEGORY_SITEMAP_BLOCK_TITLE',      'Category Site Map');

// header_navigation extra_boxes
define('BOX_CATEGORY_SITEMAP',               'Products Categories List');
define('MODULE_CATEGORY_SITEMAP_PAGE_TITLE', 'Categories Site Map');
?>
