<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003-2005 The zen-cart developers                      |
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
// $Id: config.customers_languages.php 3009 2008-01-15 00:00:00Z sasaki $
//
/**
 * autoloader array for catalog application_top.php
 *
 * @package admin
 * @copyright Copyright 2003-2005 zen-cart Development Team
**/

/**
 * Breakpoint 65.
 *
 * require('includes/init_includes/init_customers_languages.php');
 *
 */
  $autoLoadConfig[65][] = array('autoType'=> 'init_script',
                                  'loadFile'=> 'init_customers_languages.php');
?>