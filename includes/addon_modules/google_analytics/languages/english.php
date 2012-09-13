<?php
/**
 * japanese.php
 *
 * @package zen-cart addon module google analytics
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: japanese.php $
 * based on tpl_footer_googleanalytics.php, v 2.2.1 01.09.2008 01:23 Andrew Berezin
 */

define('MODULE_GOOGLE_ANALYTICS_TITLE',             'Google Analytics');
define('MODULE_GOOGLE_ANALYTICS_DESCRIPTION',       'Using Google Analytics');

define('MODULE_GOOGLE_ANALYTICS_STATUS_TITLE',             'Activating Google Analytics');
define('MODULE_GOOGLE_ANALYTICS_STATUS_DESCRIPTION',       'Do you want to active to Google Analytics?<br />true: Active<br />false: Inactive');

define('MODULE_GOOGLE_ANALYTICS_ACCOUNT_TITLE',                           'Account');
define('MODULE_GOOGLE_ANALYTICS_ACCOUNT_DESCRIPTION',                     'Please enter your Google Analytics account');
define('MODULE_GOOGLE_ANALYTICS_TARGET_TITLE',                            'Addresses to analyze');
define('MODULE_GOOGLE_ANALYTICS_TARGET_DESCRIPTION',                      'Please select Google Analytics to analyze your address (City / Province / Country will be sent)<br />Customers: <br />delivery: <br />billing: ');
define('MODULE_GOOGLE_ANALYTICS_AFFILIATION_TITLE',                       'Affiliation');
define('MODULE_GOOGLE_ANALYTICS_AFFILIATION_DESCRIPTION',                 'Please enter the store name (not a problem in the blank)');
define('MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_TITLE',                       'sku/code Selection');
define('MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_DESCRIPTION',                 'Sent to Google Analytics Please select SKU code<br />products_id: products id<br />products_model: products model');
define('MODULE_GOOGLE_ANALYTICS_PAGENAME_TITLE',                          'Use page name');
define('MODULE_GOOGLE_ANALYTICS_PAGENAME_DESCRIPTION',                    'Do you use Google Analytics to analyze the page name?<br />true: Use<br />false: Do not use');
define('MODULE_GOOGLE_ANALYTICS_BRACKETS_TITLE',                          'Optional enclosure character products');
define('MODULE_GOOGLE_ANALYTICS_BRACKETS_DESCRIPTION',                    'Please enter the characters enclosed the product options');
define('MODULE_GOOGLE_ANALYTICS_DELIMITER_TITLE',                         'product options delimiter');
define('MODULE_GOOGLE_ANALYTICS_DELIMITER_DESCRIPTION',                   'Please enter the characters that separate multiple product options');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_TITLE',                          'transfer to an external site');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_DESCRIPTION',                    'Do you want a transfer to an external site?<br />true: Record<br />false: Do not record');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_TITLE',             'String that identifies an external site');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_DESCRIPTION',       'To navigate to external sites will be added to this string');
define('MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_TITLE',            'Use AdWords Conversion');
define('MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_DESCRIPTION',      'Do you use AdWords Conversion?<br />true: Use<br />false: Do not use');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_TITLE',             'AdWords Conversion ID');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_DESCRIPTION',       'Please enter the Google Conversion ID');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_TITLE',       'Language used in the AdWords Conversion');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_DESCRIPTION', 'Please enter the Google Conversion in your language.<br />Eg) en_US, ja_JP');

?>