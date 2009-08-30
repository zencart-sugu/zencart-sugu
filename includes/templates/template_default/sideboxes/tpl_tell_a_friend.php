<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 zZen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tell_a_friend.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content .= zen_draw_form('tell_a_friend', zen_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get');
  $content .= zen_draw_hidden_field('main_page', FILENAME_TELL_A_FRIEND);
  $content .= zen_draw_input_field('to_email_address', '', 'size="10"') . '&nbsp;' . zen_image_submit(BUTTON_IMAGE_TELL_A_FRIEND, BUTTON_TELL_A_FRIEND_ALT) . zen_draw_hidden_field('products_id', $_GET['products_id']) . zen_hide_session_id() . '<br />' . BOX_TELL_A_FRIEND_TEXT;
  $content .= "</form>";
  $content .= '</div>';
?>