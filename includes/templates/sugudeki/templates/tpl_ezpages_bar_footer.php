<?php
/**
 * Page Template
 *
 * Displays EZ-Pages footer-bar content.<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_ezpages_bar_footer.php 3377 2006-04-05 04:43:11Z ajeh $
 */

   /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_footer.php'));
?>
<?php if (sizeof($var_linksList) >= 1) { ?>

<?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
<a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a><?php echo ($i < $n ? EZPAGES_SEPARATOR_FOOTER : '') . ""; ?>
<?php } // end FOR loop ?>

<?php } ?>
