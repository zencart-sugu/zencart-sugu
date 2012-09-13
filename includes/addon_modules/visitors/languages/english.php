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

define('MODULE_VISITORS_TITLE', 'Visitors Module');
define('MODULE_VISITORS_DESCRIPTION', 'Visitors Module');
define('MODULE_VISITORS_STATUS_TITLE', 'Activating Visitors Module');
define('MODULE_VISITORS_STATUS_DESCRIPTION', 'Do you want to active to visitors module?<br />true: Active<br />false: Inactive');
define('MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_TITLE', 'Save Days of Visitor Customers Data');
define('MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DESCRIPTION', 'Set a many days saving from a product purchase date at visitors customer data. If exceeds specified days, visitors customer data is automatically deleted from the database. If do not automatic deletion, set empty.<br />Default = ' . MODULE_VISITORS_CUSTOMERS_DATA_KEEP_DAYS_DEFAULT);
define('MODULE_VISITORS_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_VISITORS_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('NOT_INCLUDE_VISITORS_ALL_CUSTOMETS', 'All customers of except visitors');
define('NOT_INCLUDE_VISITORS_ALL_NEWSLETTER_SUBSCIBERS', 'Newsletter subscribers all except visitor');
define('NOT_INCLUDE_VISITORS_DORMANT_CUSTOMERS_LAST_3MONTHS_SUBSCIBERS', 'Customers on dormant except visitor (Order of three months or more ago) (Newsletter subscribers only)');
define('NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_SUBSCIBERS', 'The active customer excluding visitors who ordered within the past three months. (Newsletter subscribers only)');
define('NOT_INCLUDE_VISITORS_ACTIVE_CUSTOMERS_IN_PAST_3MONTHS_REGARDLESS_OF_SUBSCRIPTION_STATUS', 'The active customer excluding visitors who ordered within the past three months. (with not Newsletter subscribers)');

define('TEXT_VISITORS_ACCOUNT', 'Visitors');
define('BUTTON_IMAGE_VISITOR','button_visitor.gif');

//Member registration
define('MODULE_VISITORS_TABLE_HEADING_NAME', 'Name');
define('MODULE_VISITORS_ENTRY_NAME', 'Family Name');
define('MODULE_VISITORS_ENTRY_KANA', 'First Name');
define('MODULE_VISITORS_ENTRY_SAMPLE_01', 'alphanumeric¡¡Ex: who@example.co.jp');
define('MODULE_VISITORS_ENTRY_SAMPLE_02', 'alphanumeric,more than 5 characters.');
define('MODULE_VISITORS_ENTRY_SAMPLE_03', 're enter password for confirm.');
define('MODULE_VISITORS_ENTRY_SAMPLE_04', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_05', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_06', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_07', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_08', 'alphanumeric¡¡Ex: 123-4567');
define('MODULE_VISITORS_ENTRY_SAMPLE_09', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_10', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_11', '');
define('MODULE_VISITORS_ENTRY_SAMPLE_12', 'alphanumeric¡¡Ex: 03-1234-5678');
define('MODULE_VISITORS_ENTRY_SAMPLE_13', 'Ex¡§ 1970/05/21');
define('MODULE_VISITORS_ENTRY_SAMPLE_00', '<a href="http://www.post.japanpost.jp/zipcode/" target="_blank">Find a zip code</a>');

// Hiragana check
define('ENTRY_HIRAKANA_REGEXP',    '/^(\x82[\x9f-\xf1]|\x81[\x4a\x4b\x5b]|'.
                                   '\xa4[\xa1-\xf3]|\xa1[\xab\xac\xbc]|'.
                                   '\xe3\x81[\x81-\xbf]|\xe3\x82[\x9b\x9c]|\xe3\x83\xbc)+$/');
define('ENTRY_HIRAKANA_REGEXP_JS', '/^[¤¡-¤ó¡«¡¬¡¼]+$/');
define('ENTRY_HIRAKANA_NOMATCH',   ' can input only a full-size hiragana.');

define('MODULE_VISITORS_BUTTON_IMAGE_CHECKOUT_SHIPPING', 'button_checkout_shipping.gif');
define('MODULE_VISITORS_BUTTON_CHECKOUT_SHIPPING_ALT',   '');
define('MODULE_VISITORS_BUTTON_IMAGE_REGISTER',          'button_register.gif');
define('MODULE_VISITORS_BUTTON_REGISTER_ALT',            'Register');
define('MODULE_VISITORS_BUTTON_IMAGE_CHANGE_ORAGE',      'button_change_orage.gif');
define('MODULE_VISITORS_BUTTON_CHANGE_ALT',              'Change');

