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
//  $Id: geo_zones.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'Zone Definitions - Taxes, Payment and Shipping');

define('TABLE_HEADING_COUNTRY', 'Country');
define('TABLE_HEADING_COUNTRY_ZONE', 'Zone');
define('TABLE_HEADING_TAX_ZONES', 'Tax Zones');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_INFO_HEADING_NEW_ZONE', 'New Zone');
define('TEXT_INFO_NEW_ZONE_INTRO', 'Please enter the new zone information');

define('TEXT_INFO_HEADING_EDIT_ZONE', 'Edit Zone');
define('TEXT_INFO_EDIT_ZONE_INTRO', 'Please make any necessary changes');

define('TEXT_INFO_HEADING_DELETE_ZONE', 'Delete Zone');
define('TEXT_INFO_DELETE_ZONE_INTRO', 'Are you sure you want to delete this zone?');

define('TEXT_INFO_HEADING_NEW_SUB_ZONE', 'New Sub Zone');
define('TEXT_INFO_NEW_SUB_ZONE_INTRO', 'Please enter the new sub zone information');

define('TEXT_INFO_HEADING_EDIT_SUB_ZONE', 'Edit Sub Zone');
define('TEXT_INFO_EDIT_SUB_ZONE_INTRO', 'Please make any necessary changes');

define('TEXT_INFO_HEADING_DELETE_SUB_ZONE', 'Delete Sub Zone');
define('TEXT_INFO_DELETE_SUB_ZONE_INTRO', 'Are you sure you want to delete this sub zone?');

define('TEXT_INFO_DATE_ADDED', 'Date Added:');
define('TEXT_INFO_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_ZONE_NAME', 'Zone Name:');
define('TEXT_INFO_NUMBER_ZONES', 'Number of Zones:');
define('TEXT_INFO_ZONE_DESCRIPTION', 'Description:');
define('TEXT_INFO_COUNTRY', 'Country:');
define('TEXT_INFO_COUNTRY_ZONE', 'Zone:');
define('TYPE_BELOW', 'All Zones');
define('PLEASE_SELECT', 'All Zones');
define('TEXT_ALL_COUNTRIES', 'All Countries');

define('TEXT_INFO_NUMBER_TAX_RATES','Number of Tax Rates:');
define('ERROR_TAX_RATE_EXISTS','WARNING: Tax Rate(s) are defined for this zone. Please delete the Tax Rate(s) before removing this zone');
?>