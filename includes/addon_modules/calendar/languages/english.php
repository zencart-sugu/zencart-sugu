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
define('MODULE_CALENDAR_TITLE',                    'Business Calendar');
define('MODULE_CALENDAR_DESCRIPTION',              'Business Calendar');

define('MODULE_CALENDAR_STATUS_TITLE',             'Activating Business Calendar');
define('MODULE_CALENDAR_STATUS_DESCRIPTION',       'Do you want to active to business calendar?<br />true: Active<br />false: Inactive');

define('MODULE_CALENDAR_START_SUNDAY_TITLE',       'Sunday is the start of the week');
define('MODULE_CALENDAR_START_SUNDAY_DESCRIPTION', 'Do you want to start the week on Sunday?<br />true: Sunday<br />false: Monday');

define('MODULE_CALENDAR_DELIVERY_TITLE',           'Delivery dates can be specified');
define('MODULE_CALENDAR_DELIVERY_INPUT',           'Delivery dates can be specified¡§%s business days from the day after the order<br/>Final delivery date available¡§%s days from the date of the shortest possible delivery');
define('MODULE_CALENDAR_DELIVERY_DESCRIPTION',     'The range is specified as a delivery date in days');

define('MODULE_CALENDAR_DELIVERY_START_TITLE',     'The shortest possible delivery dates: Business day following the date of order.');
define('MODULE_CALENDAR_DELIVERY_END_TITLE',       'Final delivery date available: Days from the shortest possible delivery dates');
define('MODULE_CALENDAR_DELIVERY_DESCRIPTION',     'Specified as the number of days at range as the delivery date.');

define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_TITLE',       'Choice of delivery time');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_DESCRIPTION', 'Please enter comma separated at choice of delivery time.');

define('MODULE_CALENDAR_SORT_ORDER_TITLE',         'Sort Order');
define('MODULE_CALENDAR_SORT_ORDER_DESCRIPTION',   'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');

define('MODULE_CALENDAR_BLOCK_TITLE', 'Business Calendar');

define('MODULE_CALENDAR_TITLE_STYLE', '%s/%s');
define('MODULE_CALENDAR_SUN', 'Sun');
define('MODULE_CALENDAR_MON', 'Mon');
define('MODULE_CALENDAR_TUE', 'Tue');
define('MODULE_CALENDAR_WED', 'Wed');
define('MODULE_CALENDAR_THU', 'Thu');
define('MODULE_CALENDAR_FRI', 'Fri');
define('MODULE_CALENDAR_SAT', 'Sat');

define('MODULE_CALENDAR_SHIPPING',             'You order today, the earliest delivery date is %s.');
define('MODULE_CALENDAR_SHIPPING_END',         '%s can be specified as the delivery date.');
define('MODULE_CALENDAR_SHIIPING_DAY',         '%_MONTH_%/%_DAY_%');

define('MODULE_CALENDAR_HOLIDAY_DAY',          '%_DAY_% of every month');
define('MODULE_CALENDAR_HOLIDAY_WEEK',         'Every %_WEEK_%');
define('MODULE_CALENDAR_HOLIDAY_WEEKCNT',      'Every %_WEEKCNT_%th %_WEEK_%');
define('MODULE_CALENDAR_HOLIDAY_MONTHWEEKCNT', '%_WEEKCNT_%th %_WEEK_% of %_MONTH_%');
define('MODULE_CALENDAR_HOLIDAY_MONTHDAY',     '%_MONTH_%/%_DAY_%');
define('MODULE_CALENDAR_HOLIDAY_YEARMONTHDAY', '%_YEAR_%/%_MONTH_%/%_DAY_%');
define('MODULE_CALENDAR_HOLIDAY',              'is regular holiday.');

define('MODULE_CALENDAR_DAY', '<span class="today">X</span>Order date&nbsp;&nbsp;<span class="rest">X</span>Holiday&nbsp;&nbsp;<span>X</span>Buiness date');
define('BOX_CALENDAR', 'Business Calendar');

define('BUTTON_IMAGE_FOOTER_SHIPPING', 'button_footer_shipping.gif');
define('BUTTON_FOOTER_SHIPPING_ALT', 'Shipping Method');

define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_HEADER',  'Specified Delivery Date');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_HEADER', 'Specified Delivery Time');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FORMAT',  'm/d');
define('MODULE_CALENDAR_HOPE_DELIVERY_DAY_FAST',    'As Soon As Possible');
define('MODULE_CALENDAR_HOPE_DELIVERY_TIME_NONE',   'Not Specified');
?>
