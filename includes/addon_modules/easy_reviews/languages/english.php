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
define('MODULE_EASY_REVIEWS_TITLE', 'Product Review');
define('MODULE_EASY_REVIEWS_DESCRIPTION', 'Product Review');
define('MODULE_EASY_REVIEWS_STATUS_TITLE', 'Activating Product Review');
define('MODULE_EASY_REVIEWS_STATUS_DESCRIPTION', 'Do you want to active to product review?<br />true: Active<br />false: Inactive');
define('MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_TITLE', 'Product detail page, Number of review displays');
define('MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_DESCRIPTION', 'Please set the number of review displays in the product detail page.<br />Reviews of product review list pageis is [Configuration] - [Maximum Values] - [New Product Reviews Per Page] setting please.');
define('MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_TITLE', 'Non-login user is prohibited view at product review');
define('MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_DESCRIPTION', 'User not logged in can not View product reviews.');
define('MODULE_EASY_REVIEWS_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_EASY_REVIEWS_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_EASY_REVIEWS_BLOCK_TITLE', 'Product Review');
define('MODULE_EASY_REVIEWS_TITLE', 'Product Review');

define('MODULE_EASY_REVIEWS_NAVBAR_TITLE', 'Review');

define('SUB_TITLE_FROM', 'Reviewer:');
define('SUB_TITLE_REVIEW', 'Please tell us your opinions and impressions by all means. Other customers will also be helpful. Thank you to focus your comments on this product.');
define('SUB_TITLE_RATING', 'Please choose a ranking for this product. Five stars is the highest one star is the worst.');

define('TEXT_NO_HTML', '<strong>Notes:</strong>  HTML tags are not allowed.');
define('TEXT_BAD', 'Highest');
define('TEXT_GOOD', 'Worst');
define('TEXT_PRODUCT_INFO', '');

define('TEXT_APPROVAL_REQUIRED', '<strong>Notes:</strong>  The review you\'ve posted will only be published after they had reviewed by shop management.');

define('EMAIL_REVIEW_PENDING_SUBJECT','Pending Review: %s');
define('EMAIL_PRODUCT_REVIEW_CONTENT_INTRO','There are pending review about %s .'."\n\n");
define('EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS','Review contents: %s');


define('VIEW_ALL_REVIEWS', 'View All Reviews');
?>
