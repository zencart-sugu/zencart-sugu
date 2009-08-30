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
 * @version $Id: tpl_header.php 3192 2006-03-15 22:37:24Z wilt $
 */
// Display all header alerts via messageStack:
if ($messageStack->size('header') > 0) {
  echo $messageStack->output('header');
}
?>
    <table class="centershop" border="0" cellspacing="0" cellpadding="0">
<?php
if (!isset($flag_disable_header) || $flag_disable_header == false) {
?>
      <tr><td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="headerNavigation">
          <tr>
            <td align="left" valign="top" width="35%" class="headerNavigation">
              <a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a>&nbsp;|&nbsp;
<?php if (isset($_SESSION['customer_id'])) { ?>
              <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a>&nbsp;|&nbsp;
              <a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
<?php
      } else {
        if (STORE_STATUS == '0') {
?>
              <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGIN; ?></a>
<?php } } ?>
            </td>
            <td align="center" width="30%" class="headerNavigation"><?php require(DIR_WS_MODULES . 'sideboxes/' . 'search_header.php'); ?></td>
            <td align="right" valign="top" width="35%" class="headerNavigation">
<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
              <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a>&nbsp;|&nbsp;<a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?>&raquo;</a>
<?php }?>
            </td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="0" class="header">
          <tr><!-- All HEADER_ definitions in the columns below are defined in includes/languages/english.php //-->
            <td valign="middle" height="<?php echo HEADER_LOGO_HEIGHT; ?>" width="<?php echo HEADER_LOGO_WIDTH; ?>">
<?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT) . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?>
            </td>
            <td align="center" valign="top">
<?php
              if (HEADER_SALES_TEXT != '') {
                echo HEADER_SALES_TEXT;
              }
              if (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2)) {
                if ($banner->RecordCount() > 0) {
                  echo zen_display_banner('static', $banner);
                }
              }
?>
            </td>
          </tr>
        </table>
<?php
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="headerError">
            <td class="headerError"><?php echo htmlspecialchars(urldecode($_GET['error_message'])); ?></td>
          </tr>
        </table>
<?php
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="headerInfo">
            <td class="headerInfo"><?php echo htmlspecialchars($_GET['info_message']); ?></td>
          </tr>
        </table>
<?php
  }
?>
<?php
} else {
?>
    <tr><td>
<?php
}
?>
<!--bof-optional categories tabs navigation display-->
<?php
if (CATEGORIES_TABS_STATUS == '1') {
  require($template->get_template_dir('tpl_modules_categories_tabs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_categories_tabs.php');
}
?>
<!--eof-optional categories tabs navigation display-->

<!--bof-header ezpage links-->
<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
<?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
<?php } ?>
<!--eof-header ezpage links-->
