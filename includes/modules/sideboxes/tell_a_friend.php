<?php
/**
 * tell_a_friend sidebox - displays option to tell a friend about the selected product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tell_a_friend.php 2718 2005-12-28 06:42:39Z drbyte $
 */

// test if box should display
  $show_tell_a_friend= false;

  if (isset($_GET['products_id']) and zen_products_id_valid($_GET['products_id'])) {
    if (!($_GET['main_page']==FILENAME_TELL_A_FRIEND)) $show_tell_a_friend = true;
  }

  if ($show_tell_a_friend == true) {
    require($template->get_template_dir('tpl_tell_a_friend.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_tell_a_friend.php');
    $title =  BOX_HEADING_TELL_A_FRIEND;

    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
  }
?>