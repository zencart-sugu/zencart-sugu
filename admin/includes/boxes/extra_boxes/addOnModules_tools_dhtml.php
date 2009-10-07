<?php
/**
 * @package admin
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addOnModules_tools_dhtml.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$za_contents[] = array('text' => BOX_ADDON_MODULES_MANAGER, 'link' => zen_href_link(FILENAME_ADDON_MODULES, '', 'NONSSL'));
zen_addOnModules_load_boxes_dhtml($za_contents, 'tools_dhtml.php');
