<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Otsuji Takashi <ohtsuji@ark-web.jp>
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block_hogehoge.php $
 */
?>
<?php
$dir_tmpl = $this->_getTemplateDir('.php', $page, 'templates') . '/';
require($dir_tmpl. 'block_expd.php');
require($dir_tmpl. 'block_thmb.php');
?>