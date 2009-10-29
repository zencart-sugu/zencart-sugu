<?php
/**
 * Module Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: page.php $
 */

?>
<div id="page-<?php echo $page_class; ?>-<?php echo $page_method; ?>" class="page page-<?php echo $page_class; ?>">

<h1 class="title"><?php echo HEADING_TITLE; ?></h1>

<div class="content">
<p><?php echo TEXT_INFORMATION; ?></p>

<p><?php echo $var_1; ?><br />
<?php echo $var_2; ?><br />
<?php echo $var_3; ?></p>

<p><a href="<?php echo zen_href_link(FILENAME_ADDON, 'module=addon_modules_example/hogehoge'); ?>">link</a></p>
</div>

</div>