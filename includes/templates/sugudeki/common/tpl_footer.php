<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 3183 2006-03-14 07:58:59Z birdbrain $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php
if (!$flag_disable_footer) {
?>

<?php
  // displays addon_modules layout blocks
  if ($footer) {
   echo $footer;
  }
?>

<!-- footer-subnavi -->
<div id="footer-subnavi">

<!-- navigation display -->
<div id="navSupp">
<?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'; ?><?php echo HEADER_TITLE_CATALOG; ?></a>
<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php echo EZPAGES_SEPARATOR_FOOTER; ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?>
<?php } ?>
</div>
<!-- /navigation display -->

<!--  site copyright display -->
<?php if (MODULE_EASY_DESIGN_STATUS == 'true') { ?>
<p id="siteinfoLegal" class="legalCopyright"><?php echo EASY_DESIGN_KEY_COPYLIGHT;?></p>
<?php } ?>
<!-- / site copyright display -->

</div>
<!-- /footer-subnavi -->

<?php
} // flag_disable_footer
?>