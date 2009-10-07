<?php
/**
 * @package admin * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tools_dhtml.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$za_contents[] = array('text' => BOX_BLOCKS_MANAGER, 'link' => zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL'));
