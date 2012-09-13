<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE',             'Calendar Setting');
define('HEADING_SUBTITLE_HOLIDAY',  '*Setting business days');
define('HEADING_SUBTITLE_SHIPPING', '*Settings deliverable days');

define('TEXT_HOLIDAY_INFORMATION',  'Please edit your holidays and business days.');

define('TEXT_ACTION_EDIT',   'Edit');
define('TEXT_ACTION_DELETE', 'Delete');
define('TEXT_ACTION_UPDATE', 'Update');
define('TEXT_ACTION_ADD',    'Addition');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'ERROR: Cache directory does not exist. Please set Configuration -> Cache');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'ERROR: Can not write to cache directory. Please set the correct user permissions.');

define('TEXT_CONFIRM_CALENDAR_DELETE', ' Do you want to delete this?');

define('TEXT_HEADER_CALENDAR_TYPE',      'Buiness day');
define('TEXT_HEADER_CALENDAR_NAME',      'Designated day');
define('TEXT_HEADER_CALENDAR_OPERATION', 'Operations');

define('TEXT_OPENDAY',      'Buiness date');

define('TEXT_LIST_ADD',     'Additional buiness days and holidays');
define('TEXT_LIST_WEEK',    '%s');
define('TEXT_LIST_WEEKCNT', 'Week %d');
define('TEXT_LIST_YEAR',    '%d');
define('TEXT_LIST_MONTH',   '%s');
define('TEXT_LIST_DAY',     '%d');

define('TEXT_RADIO_EVERYWEEK',   'Every week');
define('TEXT_RADIO_EVERYMONTH',  'Every month');
define('TEXT_RADIO_EVERYYEAR',   'Every year');
define('TEXT_RADIO_MONTH',       'Particular month');
define('TEXT_RADIO_SPECIFICDAY', 'Particular day');
define('TEXT_RADIO_HOLIDAY',     'Holiday');
define('TEXT_RADIO_OPENDAY',     'Buiness date');
define('TEXT_RADIO_DESCRIPTION', 'The specified date is set to <font color="red"> %s </font>.');

define('TEXT_UPDATE_SUCCESS', 'The calendar was updated');
define('TEXT_ERROR_SETTING',  'The date is set wrong');
define('TEXT_ERROR_DELIVERY', 'The delivery date is set wrong');
?>