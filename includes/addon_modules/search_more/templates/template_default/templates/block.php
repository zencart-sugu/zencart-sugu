<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Otsuji Takashi
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */
?>
<?php
$dir_tmpl = $this->_getTemplateDir('.php', $page, 'templates') . '/';
require($dir_tmpl. 'block_search_form.php');
require($dir_tmpl. 'block_par_page.php');
require($dir_tmpl. 'block_sort.php');
?>
