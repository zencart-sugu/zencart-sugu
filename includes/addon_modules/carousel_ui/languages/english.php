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
define('MODULE_CAROUSEL_UI_TITLE', 'Carousel UI');
define('MODULE_CAROUSEL_UI_DESCRIPTION', 'Carousel UI<br />\'New Products\', \'Featured Products\', \'Specials\' displayed in the carousel UI block.<br />Please block display setting from the <a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">Block Setting</a> after activation.');

define('MODULE_CAROUSEL_UI_STATUS_TITLE', 'Activating Carousel UI');
define('MODULE_CAROUSEL_UI_STATUS_DESCRIPTION', 'Do you want to active to Carousel UI?<br />true: Active<br />false: Inactive');

define('MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_TITLE', 'jCarouselLite Library');
define('MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DESCRIPTION', 'Setting jCarouselLite library file name. Need to be changed unless there is no particular reason.<br />Default = ' . MODULE_CAROUSEL_UI_JCAROUSELLITE_LIBRARY_DEFAULT);

define('MODULE_CAROUSEL_UI_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_CAROUSEL_UI_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_TITLE', 'New Products - The maximum display number');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DESCRIPTION', 'Sets the maximum display number of new products.<br />Default = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_TITLE', 'New Products - Auto Scrolling');
define('MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DESCRIPTION', 'If you want to automatic scrolling the new products, set the interval(milliseconds).<br />If you do not auto scroll 0 milliseconds.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_AUTO_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_TITLE', 'New Products - Scroll Speed');
define('MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DESCRIPTION', 'New Products scrolling speed (milliseconds) sets.<br />When a set value is higher, it scrolls slowly. It does not scroll when setting it to 0.<br />¡¦Default = ' . MODULE_CAROUSEL_UI_CONF_SPEED_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_TITLE', 'New Products - Vertical Scrolling');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DESCRIPTION', 'Do you want to vertical scrolling at new products?<br />true: Vertical Scrolling<br />false: Horizontal scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_TITLE', 'New Products - Circulation Scrolling');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DESCRIPTION', 'Do you want to circulation scrolling at new products?<br />true: Circulation Scrolling<br />false: Round Trip Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_TITLE', 'New Products - Display number of scrollable area');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DESCRIPTION', 'Sets the scroll area to display the number of new products.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_NEW_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_TITLE', 'New Products - Scroll Number');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DESCRIPTION', 'Set the scroll at the same time the number of new products.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_NEW_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_TITLE', 'Featured Products - The maximum display number');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DESCRIPTION', 'Sets the maximum display number of featured products.<br />Default = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_TITLE', 'Featured Products - Auto Scrolling');
define('MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DESCRIPTION', 'If you want to automatic scrolling the featured products, set the interval(milliseconds).<br />It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_AUTO_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_TITLE', 'Featured Products - Scroll Speed');
define('MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DESCRIPTION', 'Featured Products scrolling speed (milliseconds) sets.<br />When a set value is higher, it scrolls slowly. It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SPEED_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_TITLE', 'Featured Products - Vertical Scrolling');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DESCRIPTION', 'Do you want to vertical scrolling at featured products?<br />true: Vertical Scrolling<br />false: Horizontal Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_TITLE', 'Featured Products - Circulation Scrolling');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DESCRIPTION', 'Do you want to circulation scrolling at featured products?<br />true: Circulation Scrolling<br />false: Round Trip Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_TITLE', 'Featured Products - Display number of scrollable area');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DESCRIPTION', 'Sets the scroll area to display the number of featured products.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_FEATURED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_TITLE', 'Featured Products - Scroll Number');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DESCRIPTION', 'Set the scroll at the same time the number of featured products.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_FEATURED_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_TITLE', 'Specials - The maximum display number');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DESCRIPTION', 'Sets the maximum display number of specials.<br />Default = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_TITLE', 'Specials - Auto Scrolling');
define('MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DESCRIPTION', 'If you want to automatic scrolling the specials, set the interval(milliseconds).<br />It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_AUTO_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_TITLE', 'Specials - Scroll Speed');
define('MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DESCRIPTION', 'Specials scrolling speed (milliseconds) sets.<br />When a set value is higher, it scrolls slowly. It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SPEED_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_TITLE', 'Specials - Vertical Scrolling');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DESCRIPTION', 'Do you want to vertical scrolling at specials?<br />true: Vertical Scrolling<br />false: Horizontal Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_TITLE', 'Specials - Circulation Scrolling');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DESCRIPTION', 'Do you want to circulation scrolling at specials?<br />true: Circulation Scrolling<br />false: Round Trip Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_TITLE', 'Specials - Display number of scrollable area');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DESCRIPTION', 'Sets the scroll area to display the number of specials.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_SPECIALS_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_TITLE', 'Specials - Scroll Number');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DESCRIPTION', 'Set the scroll at the same time the number of specials.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_SPECIALS_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - The maximum display number');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'Sets the maximum display number of \'This Item Also Bought\'.<br />Default = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Auto Scrolling');
define('MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'If you want to automatic scrolling the \'This Item Also Bought\', set the interval(milliseconds).<br />It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_AUTO_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Scroll Speed');
define('MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', '\'This Item Also Bought\' scrolling speed (milliseconds) sets.<br />When a set value is higher, it scrolls slowly. It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SPEED_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Vertical Scrolling');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'Do you want to vertical scrolling at \'This Item Also Bought\'?<br />true: Vertical Scrolling<br />false: Horizontal Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Circulation Scrolling');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'Do you want to circulation scrolling at \'This Item Also Bought\'?<br />true: Circulation Scrolling<br />false: Round Trip Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Display number of scrollable area');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'Sets the scroll area to display the number of \'This Item Also Bought\'.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_ALSO_PURCHASED_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_TITLE', 'This Item Also Bought - Scroll Number');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DESCRIPTION', 'Set the scroll at the same time the number of \'This Item Also Bought\'.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_ALSO_PURCHASED_PRODUCTS_DEFAULT);

define('MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - The maximum display number');
define('MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DESCRIPTION', 'Sets the maximum display number of similar items by category.<br />Default = ' . MODULE_CAROUSEL_UI_MAX_DISPLAY_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Auto Scrolling');
define('MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DESCRIPTION', 'If you want to automatic scrolling the similar items by category, set the interval(milliseconds).<br />It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Scroll Speed');
define('MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DESCRIPTION', 'Similar items by category scrolling speed (milliseconds) sets.<br />When a set value is higher, it scrolls slowly. It does not scroll when setting it to 0.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Vertical Scrolling');
define('MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DESCRIPTION', 'Do you want to vertical scrolling at similar items by category?<br />true: Vertical Scrolling<br />false: Horizontal Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Circulation Scrolling');
define('MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DESCRIPTION', 'Do you want to circulation scrolling at similar items by category?<br />true: Circulation Scrolling<br />false: Round Trip Scrolling<br />Default = ' . MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Display number of scrollable area');
define('MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DESCRIPTION', 'Sets the scroll area to display the number of similar items by category.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS_DEFAULT);
define('MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_TITLE', 'Similar Items by Category - Scroll Number');
define('MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DESCRIPTION', 'Set the scroll at the same time the number of similar items by category.<br />Default = ' . MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS_DEFAULT);

define('BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS', 'button_carousel_ui_prev.gif');
define('BUTTON_CAROUSEL_UI_PREVIOUS_ALT', 'Previous');
define('BUTTON_IMAGE_CAROUSEL_UI_NEXT', 'button_carousel_ui_next.gif');
define('BUTTON_CAROUSEL_UI_NEXT_ALT', 'Next');
define('BUTTON_IMAGE_CAROUSEL_UI_PREVIOUS_DISABLED', 'button_carousel_ui_prev-disabled.gif');
define('BUTTON_IMAGE_CAROUSEL_UI_NEXT_DISABLED',     'button_carousel_ui_next-disabled.gif');
define('BUTTON_CAROUSEL_UI_DISABLED_ALT', 'Inactive');

define('MODULE_CAROUSEL_UI_BLOCK_NEW_PRODUCTS_TITLE', '%s\'s New Products');
define('MODULE_CAROUSEL_UI_BLOCK_FEATURED_PRODUCTS_TITLE', 'Featured Products');
define('MODULE_CAROUSEL_UI_BLOCK_SPECIALS_PRODUCTS_TITLE', '%s: Specials of the Month');
define('MODULE_CAROUSEL_UI_BLOCK_ALSO_PURCHASED_PRODUCTS_TITLE', 'Customers Who Bought This Item Also Bought');
define('MODULE_CAROUSEL_UI_BLOCK_XSELL_PRODUCTS_TITLE', 'Frequently Bought Together');

define('BUTTON_IMAGE_SHIPPING', 'button_footer_shipping.gif');
define('BUTTON_SHIPPING_ALT', 'Available Shipping Methods');

define('BUTTON_CAROUSEL_UI_PAGE', 'Page:');
