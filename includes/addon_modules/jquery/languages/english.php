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
define('MODULE_JQUERY_TITLE', 'jQuery');
define('MODULE_JQUERY_DESCRIPTION', 'Load jQuery library.');
define('MODULE_JQUERY_STATUS_TITLE', 'Activating jQuery');
define('MODULE_JQUERY_STATUS_DESCRIPTION', 'Do you want to active to jQuery?<br />true: Active<br />false: Inactive');

define('MODULE_JQUERY_LIBRARY_TITLE', 'jQuery Library');
define('MODULE_JQUERY_LIBRARY_DESCRIPTION', 'Set the jQuery library file name. There is no need to change unless there is a specific reason.<br />Default = ' . MODULE_JQUERY_LIBRARY_DEFAULT);

define('MODULE_JQUERY_NOCONFLICT_STATUS_TITLE', 'Activating noConflict');
define('MODULE_JQUERY_NOCONFLICT_STATUS_DESCRIPTION', 'Do you want to active to noConflict?<br />true: Active<br />false: Inactive');

define('MODULE_JQUERY_SORT_ORDER_TITLE', 'Sort Order');
define('MODULE_JQUERY_SORT_ORDER_DESCRIPTION', 'I can set the priority order of the module. Reading and the disposal of modules are carried out earlier so that a number is small. Please set it not to fall on other modules with a half size number.');
