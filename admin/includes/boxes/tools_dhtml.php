<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tools_dhtml.php 3026 2006-02-13 06:01:09Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents = array();
  $za_heading = array();
  $za_heading = array('text' => BOX_HEADING_TOOLS, 'link' => zen_href_link(FILENAME_ALT_NAV, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_TEMPLATE_SELECT, 'link' => zen_href_link(FILENAME_TEMPLATE_SELECT, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_LAYOUT_CONTROLLER, 'link' => zen_href_link(FILENAME_LAYOUT_CONTROLLER, '', 'NONSSL'));
// removed broken
//  $za_contents[] = array('text' => BOX_TOOLS_BACKUP, 'link' => zen_href_link(FILENAME_BACKUP, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_BANNER_MANAGER, 'link' => zen_href_link(FILENAME_BANNER_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_MAIL, 'link' => zen_href_link(FILENAME_MAIL, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_NEWSLETTER_MANAGER, 'link' => zen_href_link(FILENAME_NEWSLETTERS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_SERVER_INFO, 'link' => zen_href_link(FILENAME_SERVER_INFO, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_WHOS_ONLINE, 'link' => zen_href_link(FILENAME_WHOS_ONLINE, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_ADMIN, 'link' => zen_href_link(FILENAME_ADMIN, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_EMAIL_WELCOME, 'link' => zen_href_link(FILENAME_EMAIL_WELCOME, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_STORE_MANAGER, 'link' => zen_href_link(FILENAME_STORE_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_DEVELOPERS_TOOL_KIT, 'link' => zen_href_link(FILENAME_DEVELOPERS_TOOL_KIT, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_EZPAGES, 'link' => zen_href_link(FILENAME_EZPAGES_ADMIN, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_DEFINE_PAGES_EDITOR, 'link' => zen_href_link(FILENAME_DEFINE_PAGES_EDITOR, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_TOOLS_SQLPATCH, 'link' => zen_href_link(FILENAME_SQLPATCH, '', 'NONSSL'));

if ($za_dir = @dir(DIR_WS_BOXES . 'extra_boxes')) {
  while ($zv_file = $za_dir->read()) {
    if (preg_match('/tools_dhtml.php$/', $zv_file)) {
      require(DIR_WS_BOXES . 'extra_boxes/' . $zv_file);
    }
  }
}

?>
<!-- tools //-->
<?php
echo zen_draw_admin_box($za_heading, $za_contents);
?>
<!-- tools_eof //-->
