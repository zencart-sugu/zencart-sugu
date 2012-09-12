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

define('MODULE_ABOUTBOX_TITLE', 'About Box');
define('MODULE_ABOUTBOX_DESCRIPTION', 'About Box Block<br />Add a block that displays the about box.<br />Please block display setting from the <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">Block Setting</a> after activation.');
define('MODULE_ABOUTBOX_STATUS_TITLE', 'Activating About Box Block');
define('MODULE_ABOUTBOX_STATUS_DESCRIPTION', 'Do you want to active to about box module?<br />true: Active<br />false: Inactive');
define('MODULE_ABOUTBOX_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_ABOUTBOX_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');
define('MODULE_ABOUTBOX_HEADER_TITLE', 'About Box Title');
define('MODULE_ABOUTBOX_HEADER_DESCRIPTION', 'Specifies the title to be displayed in about box block.');
define('MODULE_ABOUTBOX_GREETING_TITLE_TITLE', 'About Box Title Description');
define('MODULE_ABOUTBOX_GREETING_TITLE_DESCRIPTION', 'Specifies the title of the about box to display descriptions.');
define('MODULE_ABOUTBOX_GREETING_TEXT_TITLE', 'Full Descriptions About Box');
define('MODULE_ABOUTBOX_GREETING_TEXT_DESCRIPTION', 'Specifies the text of the description to be displayed in about box.');
define('MODULE_ABOUTBOX_IMAGEPATH_TITLE', 'Images to be Displayed in About Box');
define('MODULE_ABOUTBOX_IMAGEPATH_DESCRIPTION', 'The path to the about box to display the image.');
define('MODULE_ABOUTBOX_DISPLAY_CALENDAR_TITLE', 'Show Calendar');
define('MODULE_ABOUTBOX_DISPLAY_CALENDAR_DESCRIPTION', 'Specifies whether to display the business calendar. If not installed the business calendar module, do not displayed true to the setting.<br />true: Display<br />false: Hidden');
define('MODULE_ABOUTBOX_AVALABLE_CARDS_TITLE', 'Credit for display');
define('MODULE_ABOUTBOX_AVAILABLE_CARDS_DESCRIPTION', 'Specifies whether to display the corresponding card.<br />0: Hidden<br />1: Display Text<br />2: Display Image');

// For the installation
define('MODULE_ABOUTBOX_GREETING_TITLE_DEFAULT', 'Greetings from the shop master');
define('MODULE_ABOUTBOX_GREETING_TEXT_DEFAULT', 'I\'m John Smith,the shop master.');

// For the template
define('MODULE_ABOUTBOX_CREDITCARDS_TITLE', 'Available Payment Method');

// For the addon_module block management
define('MODULE_ABOUTBOX_BLOCK_TITLE', 'About Box');

?>
