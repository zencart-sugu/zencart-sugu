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
//  $Id: languages.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', 'Setup Mobile Site');

define('MOBILE_SETUPED_TITLE', 'Mobile site of following languages are already setuped.<br>
<br>
if you change a mobile template please do from "Tools" -> "Template Selection"<br>');

define('MOBILE_NOT_SETUPED_TITLE', 'Make a Mobile site of the following languages?');

define('TABLE_HEADING_LANGUAGE_NAME', 'Language');
define('TABLE_HEADING_LANGUAGE_CODE', 'Code');
define('TABLE_HEADING_MOBILE_TEMPLATE', 'Template');
define('TABLE_HEADING_ACTION', 'Action');
define('ACTION_SETUP_MOBILE_SITE', 'Setup');


define('ERROR_REMOVE_DEFAULT_LANGUAGE', 'Error: The default language can not be removed. Please set another language as default, and try again.');
define('ERROR_DUPLICATE_LANGUAGE_CODE', 'Error: A language with that code has already been defined.');
define('ERROR_LANGUAGE_CODE_NOT_EXISTS', 'Error: The specified language does not exist.');
define('SETUP_MOBILE_SITE_SUCCESS', 'Setup of Mobile site was completed.');
?>
