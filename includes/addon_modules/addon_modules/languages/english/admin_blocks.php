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
//  $Id: blocks.php $
//

define('HEADING_TITLE', 'Block Setting');

define('TABLE_HEADING_BOX_NAME', 'Box Name');
define('TABLE_HEADING_BLOCK_NAME', 'Block Name');
define('TABLE_HEADING_BOX', 'Box File');
define('TABLE_HEADING_MODULE', 'Module');
define('TABLE_HEADING_BLOCK', 'Block Method');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_LOCATION', 'Location');
define('TABLE_HEADING_SORT_ORDER', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_EDIT_INTRO', 'Please do a necessary change. ');
define('TEXT_INFO_MODULE_NAME', 'Module Name: ');

define('TEXT_INFO_BOX','Selecting Box: ');
define('TEXT_INFO_BOX_NAME', 'Box Name:');
define('TEXT_INFO_BOX_LOCATION','Location: ');
define('TEXT_INFO_BOX_STATUS', 'Box Status: ');
define('TEXT_INFO_BOX_STATUS_INFO','ON=1 OFF=0');
define('TEXT_INFO_BOX_SORT_ORDER', 'Sort Order:');
define('TEXT_INFO_BOX_VISIBLE', 'Display / Hide Per Page: ');
define('TEXT_INFO_BOX_PAGES', 'Page: ');
define('TEXT_INFO_INSERT_BOX_INTRO', 'Please enter data in the new box.');
define('TEXT_INFO_DELETE_BOX_INTRO', 'Do you want to delete this box?');
define('TEXT_INFO_HEADING_NEW_BOX', 'New Box');
define('TEXT_INFO_HEADING_EDIT_BOX', 'Edit Box');
define('TEXT_INFO_HEADING_DELETE_BOX', 'Delete Box');
define('TEXT_INFO_DELETE_MISSING_BOX','The missing box is deleted from the template list: ');
define('TEXT_INFO_DELETE_MISSING_BOX_NOTE','NOTE: The file is not deleted. When the file is added to the directory, the box can be added again.<br /><br /><strong>Delete Box: </strong>');
define('TEXT_INFO_BOX_DETAILS','Box Details: ');

define('TEXT_INFO_BLOCK', 'Selected block: ');
define('TEXT_INFO_BLOCK_NAME', 'Block Name: ');
define('TEXT_INFO_BLOCK_LOCATION', 'Location: ');
define('TEXT_INFO_BLOCK_STATUS', 'Block Status: ');
define('TEXT_INFO_BLOCK_STATUS_INFO', 'ON=1 OFF=0');
define('TEXT_INFO_BLOCK_SORT_ORDER', 'Sort Order: ');
define('TEXT_INFO_BLOCK_VISIBLE', 'Display / Hide Per Page: ');
define('TEXT_INFO_BLOCK_PAGES', 'Page: ');
define('TEXT_CHECK_ALL', 'All');
define('TEXT_INFO_INSERT_BLOCK_INTRO', 'Please enter data in the new block.');
define('TEXT_INFO_DELETE_BLOCK_INTRO', 'Do you want to delete this block?');
define('TEXT_INFO_HEADING_NEW_BLOCK', 'New Block');
define('TEXT_INFO_HEADING_EDIT_BLOCK', 'Edit Block');
define('TEXT_INFO_HEADING_DELETE_BLOCK', 'Delete Block');
define('TEXT_INFO_DELETE_MISSING_BLOCK', 'The missing block is deleted from the template list: ');
define('TEXT_INFO_DELETE_MISSING_BLOCK_NOTE', 'NOTE: The module is not deleted. The block can be added again by making installing the module and activating.<br /><br /><strong>Delete Block: </strong>');
define('TEXT_INFO_BLOCK_DETAILS', 'Block Details: ');

////////////////

// file exists
define('TEXT_GOOD_BLOCK', ' ');
define('TEXT_BAD_BLOCK', '<font color="ff0000"><b>MISSING!!</b></font><br />');


// Success message
define('SUCCESS_BLOCK_DELETED', 'It succeeded in deleting the block template.: ');
define('SUCCESS_BLOCK_RESET', 'The block template was returned to the setting of default.: ');
define('SUCCESS_BLOCK_UPDATED', 'It succeeded in updating the block setting.: ');
define('SUCCESS_BLOCKS_UPDATED', 'It succeeded in updating the blocks setting.');

define('TEXT_ON', ' ON ');
define('TEXT_OFF', ' OFF ');
define('TEXT_VISIBLE_PAGES', 'Display the following pages only');
define('TEXT_INVISIBLE_PAGES', 'Hide the following pages only');

define('TEXT_NO_LAYOUT_LOCATIONS', 'Layout position is not defined.');

// box names
define('BOXNAME_BANNER_BOX', 'Banner');
define('BOXNAME_BANNER_BOX2', 'Banner 2');
define('BOXNAME_BANNER_BOX_ALL', 'Banner All');
define('BOXNAME_BEST_SELLERS', 'Bestsellers');
define('BOXNAME_CATEGORIES', 'Categories');
define('BOXNAME_CURRENCIES', 'Currency');
define('BOXNAME_DOCUMENT_CATEGORIES', 'Documents');
define('BOXNAME_EZPAGES', 'Important Links');
define('BOXNAME_FEATURED', 'Featured');
define('BOXNAME_INFORMATION', 'Information');
define('BOXNAME_LANGUAGES', 'Languages');
define('BOXNAME_MANUFACTURER_INFO', 'Product Information');
define('BOXNAME_MANUFACTURERS', 'Manufacturers');
define('BOXNAME_MORE_INFORMATION', 'More Information');
define('BOXNAME_MUSIC_GENRES', 'Music Genre');
define('BOXNAME_ORDER_HISTORY', 'Latest Orders');
define('BOXNAME_PRODUCT_NOTIFICATIONS', 'Notifications');
define('BOXNAME_RECORD_COMPANIES', 'Record Companies');
define('BOXNAME_REVIEWS', 'Reviews');
define('BOXNAME_SEARCH', 'Product Search');
define('BOXNAME_SEARCH_HEADER', 'Product Search (Header)');
define('BOXNAME_SHOPPING_CART', 'Shopping Cart');
define('BOXNAME_SPECIALS', 'Specials');
define('BOXNAME_TELL_A_FRIEND', 'Tell a Friend');
define('BOXNAME_WHATS_NEW', 'What\'s New');
define('BOXNAME_WHOS_ONLINE', 'Who\'s Online');

// page names
define('PAGENAME_ACCOUNT', 'My Account');
define('PAGENAME_ACCOUNT_EDIT', 'Edit Account ');
define('PAGENAME_ACCOUNT_HISTORY', 'Previous Orders');
define('PAGENAME_ACCOUNT_HISTORY_INFO', 'Order Information');
define('PAGENAME_ACCOUNT_NEWSLETTERS', 'Newsletter Subscriptions');
define('PAGENAME_ACCOUNT_NOTIFICATIONS', 'Product Notifications');
define('PAGENAME_ACCOUNT_PASSWORD', 'Change Password');
define('PAGENAME_ADDRESS_BOOK', 'Address Book');
define('PAGENAME_ADDRESS_BOOK_PROCESS', 'Address');
define('PAGENAME_ADVANCED_SEARCH', 'Search Result');
define('PAGENAME_ADVANCED_SEARCH_RESULT', 'Detail Search');
define('PAGENAME_CHECKOUT_CONFIRMATION', 'Please check your order.');
define('PAGENAME_CHECKOUT_PAYMENT', 'Please enter your billing information.');
define('PAGENAME_CHECKOUT_PAYMENT_ADDRESS', 'Please change your billing address.');
define('PAGENAME_CHECKOUT_SHIPPING', 'Please fill in the shipping and delivery methods.');
define('PAGENAME_CHECKOUT_SHIPPING_ADDRESS', 'Please change your shipping address.');
define('PAGENAME_CHECKOUT_SUCCESS', 'Congratulations on completing your order.');
define('PAGENAME_CONDITIONS', 'Conditions');
define('PAGENAME_CONTACT_US', 'Contact Us');
define('PAGENAME_COOKIE_USAGE', 'Cookie Usage');
define('PAGENAME_CREATE_ACCOUNT', 'Create Account');
define('PAGENAME_CREATE_ACCOUNT_SUCCESS', 'Your Account Has Been Created!');
define('PAGENAME_CUSTOMERS_AUTHORIZATION', 'It is following a procedure for approval...');
define('PAGENAME_DISCOUNT_COUPON', 'Discount Coupon');
define('PAGENAME_DOCUMENT_GENERAL_INFO', 'Document Information (General)');
define('PAGENAME_DOCUMENT_PRODUCT_INFO', 'Document Information (Products)');
define('PAGENAME_DOWN_FOR_MAINTENANCE', 'Maintenance...');
define('PAGENAME_DOWNLOAD_TIME_OUT', 'Download...');
define('PAGENAME_FEATURED_PRODUCTS', 'Featured Products');
define('PAGENAME_GV_FAQ', 'Questions and answers about Gift Certificates');
define('PAGENAME_GV_REDEEM', 'Gift Certificate Redemption');
define('PAGENAME_GV_SEND', 'Send Gift Certificate');
define('PAGENAME_INDEX', 'Top Page');
define('PAGENAME_INDEX_CATEGORIES', 'Categories and Sub Categories Page List');
define('PAGENAME_INDEX_PRODUCTS', 'Categories and Products Page List');
define('PAGENAME_INFO_SHOPPING_CART', 'Visitors Cart / Members Cart');
define('PAGENAME_LOGIN', 'Login');
define('PAGENAME_LOGOFF', 'Timeout');
define('PAGENAME_PAGE', 'EZ Page');
define('PAGENAME_PAGE_2', 'Page 2');
define('PAGENAME_PAGE_3', 'Page 3');
define('PAGENAME_PAGE_4', 'Page 4');
define('PAGENAME_PAGE_NOT_FOUND', 'Page Not Found');
define('PAGENAME_PASSWORD_FORGOTTEN', 'Forgotten Password');
define('PAGENAME_PRIVACY', 'Privacy Policy');
define('PAGENAME_PRODUCT_FREE_SHIPPING_INFO', 'Product Information (Shipping Free)');
define('PAGENAME_PRODUCT_INFO', 'Product Information (General)');
define('PAGENAME_PRODUCT_MUSIC_INFO', 'Product Information (Music)');
define('PAGENAME_PRODUCT_REVIEWS', 'Reviews');
define('PAGENAME_PRODUCT_REVIEWS_INFO', 'Reviews');
define('PAGENAME_PRODUCT_REVIEWS_WRITE', 'Reviews');
define('PAGENAME_PRODUCTS_ALL', 'All Products');
define('PAGENAME_PRODUCTS_NEW', 'New Products');
define('PAGENAME_REVIEWS', 'Reviews');
define('PAGENAME_SHIPPINGINFO', 'Shipping & Returns');
define('PAGENAME_SHOPPING_CART', 'Shopping Cart');
define('PAGENAME_SITE_MAP', 'Site Map');
define('PAGENAME_SPECIALS', 'Specials');
define('PAGENAME_SSL_CHECK', 'Security Check');
define('PAGENAME_TELL_A_FRIEND', 'Tell a friend about product');
define('PAGENAME_TIME_OUT', 'We have to disconnect');
define('PAGENAME_UNSUBSCRIBE', 'Newsletter Unsubscribe');
