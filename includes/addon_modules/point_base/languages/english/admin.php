<?php
/**
 * Points
 *
 * @package point
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: points.php $
 */

define('HEADING_TITLE', 'Point Manager');
define('HEADING_TITLE_SEARCH', 'Customer ID:');
define('HEADING_TITLE_CLASS', 'Module class:');

define('TABLE_HEADING_POINTS_ID', 'ID');
define('TABLE_HEADING_CUSTOMERS', 'Customer Name');
define('TABLE_HEADING_DESCRIPTION', 'Apply');
define('TABLE_HEADING_DEPOSIT', 'Enable');
define('TABLE_HEADING_PENDING', 'Pending');
define('TABLE_HEADING_WITHDRAW', 'Use');
define('TABLE_HEADING_CLASS', 'Module class');
define('TABLE_HEADING_CREATED', 'Registration Date');
define('TABLE_HEADING_UPDATED', 'Date Modified');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_ALL_POINTS', 'All');
define('TEXT_DISPLAY_NUMBER_OF_POINTS', 'Show <b>%d</b to <b>%d</b (All <b>%d</b>)');

define('ENTRY_POINT_ID','ID: ');

define('ENTRY_CUSTOMERS_ID','Customer ID: ');
define('ENTRY_CUSTOMERS_NAME','Customer Name: ');
define('ENTRY_CUSTOMERS_EMAIL','Customer Email: ');
define('ENTRY_DESCRIPTION','Apply: ');
define('ENTRY_POINT','Point: ');
define('ENTRY_DEPOSIT','Valid point: ');
define('ENTRY_PENDING','Pending Point: ');
define('ENTRY_WITHDRAW','Use Point: ');
define('ENTRY_STATUS','Status: ');

define('TEXT_INFO_HEADING_NEW_POINT', 'Register New Point');
define('TEXT_NEW_INTRO', 'Register a new point.');

define('TEXT_INFO_HEADING_NEWCONFIRM_POINT', 'Confirmation Register New Point');
define('TEXT_NEWCONFIRM_INTRO', 'Do you want to register a new point with the contents of the following?<br />To reflect the balance calculation point after register status ON.');

define('TEXT_INFO_HEADING_EDIT_POINT', 'Edit Point');
define('TEXT_EDIT_INTRO', 'Edit this point.');

define('TEXT_INFO_HEADING_DELETE_POINT', 'Confirmation Point Delete');
define('TEXT_INFO_DELETE_INTRO', 'Do you want to delete this point?<br />The data is completely removed. Performing this operation can not be undone.');
define('TEXT_INFO_HEADING_STATUS_OFF_POINT', 'Confirmation Status OFF');
define('TEXT_INFO_STATUS_OFF_INTRO', 'Do you want to status OFF of this point?<br />If set to OFF status then balance calculation point will not be reflected.');
define('TEXT_INFO_HEADING_STATUS_ON_POINT', 'Confirmation Status ON');
define('TEXT_INFO_STATUS_ON_INTRO', 'Do you want to status ON of this point?<br />If set to ON status then balance calculation point will be reflected.');
define('TEXT_INFO_HEADING_PENDING_TO_DEPOSIT_POINT', 'Confirmation Point Valid');
define('TEXT_INFO_PENDING_TO_DEPOSIT_INTRO', 'Do you want to enable this point?');
define('TEXT_INFO_HEADING_DEPOSIT_TO_PENDING_POINT', 'Confirmation Point Pending');
define('TEXT_INFO_DEPOSIT_TO_PENDING_INTRO', 'Do you want to pending this point?');
define('TEXT_STATUS_OFF', 'Set OFF status');
define('TEXT_STATUS_ON', 'Set ON status');
define('TEXT_PENDING_TO_DEPOSIT', 'Enabling Point');
define('TEXT_DEPOSIT_TO_PENDING', 'Pending Point');
define('TEXT_DATE_POINT_CREATED', 'Registration Date:');
define('TEXT_DATE_POINT_UPDATED', 'Last Updated:');
define('TEXT_INFO_POINT_CLASS', 'Module class:');

define('SUCCESS_POINT_INSERTED', 'Point was registered. To reflect the balance calculation point set ON status.');
define('SUCCESS_POINT_UPDATED', 'Points have been updated.');
define('SUCCESS_POINT_DELETED', 'Points have been removed.');

define('ERROR_CUSTOMERS_ID', 'Customer ID does not exist.');
define('ERROR_DESCRIPTION', 'Please enter the application.');
define('ERROR_POINT_VALUE', 'The number of points enter greater than 1.');
define('ERROR_POINT_SPECIFY', 'Invalid point type.');
