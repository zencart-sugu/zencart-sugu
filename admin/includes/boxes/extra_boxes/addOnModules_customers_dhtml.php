<?php
/**
 * @package admin
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addOnModules_customers_dhtml.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

zen_addOnModules_load_boxes_dhtml($za_contents, 'customers_dhtml.php');
