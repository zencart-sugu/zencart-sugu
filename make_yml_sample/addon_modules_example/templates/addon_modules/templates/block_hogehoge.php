<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block_hogehoge.php $
 */
?>
<?php
if (count($list)) {
?>
<ul>
<?php
  foreach($list as $item) {
?>
<li><?php echo $item; ?></li>
<?php
  }
?>
</ul>
<?php
}
?>
<p>This is a override template.</p>