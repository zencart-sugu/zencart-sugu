<?php
/**
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_header = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_header.php 3392 2006-04-08 15:17:37Z birdbrain $
 */
?>

<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
?>

<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
?>

<?php echo GLOBAL_HEADER_FONT;  ?>

<!-- header -->
<div id="headerArea">
<div id="header">

<?php if (MODULE_EASY_DESIGN_STATUS == 'true') { ?>
<?php if (EASY_DESIGN_TAGLINE != '') { ?>
<p id="tagline"><?php echo EASY_DESIGN_TAGLINE;?></p>
<?php } ?>
<?php if($category_depth == 'top'){?>
<h1 id="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '"><img src="'.getLogoImage(getDefaultTemplate()).'" alt="'.TITLE.'" title="'.TITLE.'"/></a>'; ?></h1>
<?php }else{ ?>
<p id="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '"><img src="'.getLogoImage(getDefaultTemplate()).'" alt="'.LINK_TO_HOME.'" title="'.LINK_TO_HOME.'"/></a>'; ?></p>
<?php } ?>
<?php } ?>

<?php
  // displays addon_modules layout blocks
  if ($header) {
?>
<div id="header-content">
<?php echo $header; ?>
</div>
<!-- header-bar-->
<?php
  }
?>

<!-- header-nav -->
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
<?php } ?>
<!-- /header-nav -->

</div>
<!-- /header -->
</div>
<!-- /headerArea -->
<?php } ?>


<!-- header-bar-->
<div id="header-bar" class="transparent"><div id="header-bar-inner">
<!-- global-header-login -->
<div id="global-header-login">
<?php if (IS_VISITORS_SESSION === true) { ?>
<?php  echo HEADER_TEXT_FOR_VISITOR ?>
<?php } elseif ($_SESSION['customer_id']) { ?>
<?php  echo HEADER_TEXT_FOR_ACCOUNT ?><?php
      } else {
?>
<?php  echo HEADER_TEXT_FOR_NOACCOUNT ?>
<?php } ?>
</div>
<!-- /global-header-login -->
</div></div>
