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
 * @version $Id: block.php $
 */
?>

<?php echo $error; ?>
<p id="rssfeed"><a href="" target="_blank"><img src="includes/templates/accessible_and_usable/images/button_rss.gif" alt="RSS" width="54" height="22" /></a></p>
<dl>
<?php
  for ($i=0; $i<count($rss); $i++) {
?>
<dt><?php echo $rss[$i]['date']>0?date("Y/m/d", $rss[$i]['date']):""; ?></dt>
<dd><a href="<?php echo $rss[$i]['link']; ?>" target="_blank"><?php echo $rss[$i]['title']; ?></a></dd>
<?php
  }
?>
</dl>
