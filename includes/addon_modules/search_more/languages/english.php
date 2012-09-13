<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Ohtsuji Takashi                                                   |
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
define('MODULE_SEARCH_MORE_TITLE', 'Search More');
define('MODULE_SEARCH_MORE_DESCRIPTION', 'This module can specify additional conditions for search results.');
define('MODULE_SEARCH_MORE_STATUS_TITLE', 'Activating Search More');
define('MODULE_SEARCH_MORE_STATUS_DESCRIPTION', 'Do you want to active to Search More?<br />true: Active<br />false: Inactive');
define('MODULE_SEARCH_MORE_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_SEARCH_MORE_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_TITLE', 'Title of the display number list box');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_DESCRIPTION', 'Please specify the label of the list that specifies number of products displayed in product list. Default value is \'Display Number\'.');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_TITLE', 'Value of the display number list box');
define('MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_DESCRIPTION', 'Please specify the content of the list by comma (,) delimitation that specifies number of products displayed in product list. Default value is \'10,25,50,100\'.');
define('MODULE_SEARCH_MORE_SORT_LIST_NAME_TITLE', 'Title of the sort list box');
define('MODULE_SEARCH_MORE_SORT_LIST_NAME_DESCRIPTION', 'Please specify the label of the list that order of sorting of the commodity list is specified. Default value is \'Sort Order\'.');

define('MODULE_SEARCH_MORE_BLOCK_TITLE', 'Search More');
define('MODULE_SEARCH_MORE_BLOCK_SEARCH_FORM_TITLE', 'Search More:Search Form');
define('MODULE_SEARCH_MORE_BLOCK_SORT_TITLE', 'Search More：Sort');
define('MODULE_SEARCH_MORE_BLOCK_PAR_PAGE_TITLE', 'Search More：Search Result');

define('HEADING_TITLE_1', 'Advanced Search(Search Result for [%s])');
define('HEADING_TITLE_2', 'Search Again');
define('MODULE_SEARCH_MORE_ENTRY_KEYWORD', 'Keyword');
define('MODULE_SEARCH_MORE_TEXT_SEARCH_IN_DESCRIPTION', 'Search In Product descriptions.');
define('MODULE_SEARCH_MORE_ENTRY_CATEGORIES', 'Categories');
define('MODULE_SEARCH_MORE_ENTRY_INCLUDE_SUBCATEGORIES', 'Include Subcategories');
define('MODULE_SEARCH_MORE_ENTRY_MANUFACTURERS', 'manufactures');
define('MODULE_SEARCH_MORE_ENTRY_PRICE_RANGE', 'Product Price Range');
define('MODULE_SEARCH_MORE_ENTRY_DATE_RANGE', 'Product Entry date');

define('MODULE_SEARCH_MORE_TEXT_SEARCH_HELP_LINK', 'Help [?]');
define('MODULE_SEARCH_MORE_TEXT_ALL_CATEGORIES', 'All categories');
define('MODULE_SEARCH_MORE_TEXT_ALL_MANUFACTURERS', 'All');
define('MODULE_SEARCH_MORE_TEXT_FROM_TO', '-');

define('MODULE_SEARCH_MORE_TEXT_NO_PRODUCTS', 'No products matches this search.');
define('MODULE_SEARCH_MORE_KEYWORD_FORMAT_STRING', 'Please input at least one or more keywords.');
define('MODULE_SEARCH_MORE_ERROR_AT_LEAST_ONE_INPUT', 'Please specify at least one or more search items.');
define('MODULE_SEARCH_MORE_ERROR_INVALID_FROM_DATE', 'The starting date is invalid.');
define('MODULE_SEARCH_MORE_ERROR_INVALID_TO_DATE', 'The end date is invalid.');
define('MODULE_SEARCH_MORE_ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Please input the same as start date or date after that at the end date.');
define('MODULE_SEARCH_MORE_ERROR_PRICE_FROM_MUST_BE_NUM', 'Please input a number into a minimum price.');
define('MODULE_SEARCH_MORE_ERROR_PRICE_TO_MUST_BE_NUM', 'Please input a number into a maximum price.');
define('MODULE_SEARCH_MORE_ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Please input the same as minimum price or minimum price that at the maximum price.');
define('MODULE_SEARCH_MORE_ERROR_INVALID_KEYWORDS', 'Invalid Keyword');
define('MODULE_SEARCH_MORE_TEXT_PRICE_EN'                  ,'Yen');
define('MODULE_SEARCH_MORE_PRICE_FORMAT_STRING_SAMPLE'     ,'Eg：500 '.MODULE_SEARCH_MORE_TEXT_FROM_TO.' 10000');
define('MODULE_SEARCH_MORE_DOB_FORMAT_STRING_SAMPLE'       ,'Eg：2009/01/01 '.MODULE_SEARCH_MORE_TEXT_FROM_TO.' 2009/06/30');

define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL'            ,'Model');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL_DESC'       ,'Model(Descending)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME'             ,'Product Name');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC'        ,'Product Name(Descending)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER'     ,'Manufacturer');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER_DESC','Manufacturer(Descending)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY'         ,'Quantity');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY_DESC'    ,'Quantity(Descending)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT'           ,'Weight');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT_DESC'      ,'Weight(Descending)');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE'            ,'Price');
define('MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC'       ,'Price(Descending)');

define('MODULE_SEARCH_MORE_TEXT_DISPLAY', '<img src="includes/templates/sugudeki/buttons/japanese/button_display_small.gif" width="37" height="23" alt="Show" />');
?>