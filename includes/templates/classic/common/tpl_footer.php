<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: tpl_footer.php 3371 2006-04-04 04:59:46Z ajeh $
//

  // this file can be copied to /templates/your_template_dir/pagename
  // example: to override the privacy page
  // make a directory /templates/my_template/privacy
  // copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php
  // to override the global settings and turn off the footer un-comment the following line:

  // $flag_disable_footer = true;
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));

if (!isset($flag_disable_footer) || $flag_disable_footer == false) {
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr class="footertop">
        <td class="footertop" align="center">&nbsp;|&nbsp;<a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'NONSSL'); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a>&nbsp;|&nbsp;</td>
      </tr>
    </table>
    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="footer">

<!--bof-EZ-Pages footer display -->
<?php if (EZPAGES_STATUS_FOOTER == '1' or (EZPAGES_STATUS_FOOTER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
      <tr>
        <td class="footerbottom">
          <?php require($template->get_template_dir('tpl_ezpages_bar_footer.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_footer.php'); ?>
        </td>
      </tr>
<?php } ?>
<!--eof-EZ-Pages footer display -->

<?php
if (SHOW_FOOTER_IP == '1') {
?>
      <tr>
        <td class="footerbottom"><?php echo TEXT_YOUR_IP_ADDRESS . '  ' . $_SERVER['REMOTE_ADDR']; ?></td>
      </tr>
<?php
}
?>
<?php
  if (SHOW_BANNERS_GROUP_SET5 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5)) {
    if ($banner->RecordCount() > 0) {
?>
      <tr>
        <td align="center"><div class="banners"><?php echo zen_display_banner('static', $banner); ?></div></td>
      </tr>
<?php
    }
  }
?>
      <tr>
        <td class="footerbottom"><?php echo FOOTER_TEXT_BODY; ?></td>
      </tr>
    </table>
  </td></tr>
<?php
} // flag_disable_footer
?>
</table>