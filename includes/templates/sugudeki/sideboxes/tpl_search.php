<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_search.php 3743 2006-06-10 06:05:06Z drbyte $
 */
  $content = "";
 // $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content .= zen_draw_form('quick_find', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get','');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();


  $content .= zen_draw_input_field('keyword', '', 'size="18" maxlength="100" value="' . HEADER_SEARCH_DEFAULT_TEXT . '" onfocus="if (this.value == \'' . HEADER_SEARCH_DEFAULT_TEXT . '\') this.value = \'\';" class="keyword"') . zen_image_submit (BUTTON_IMAGE_SEARCH_SMALL,BUTTON_SEARCH_SMALL_ALT,'id="header-button-search" class="imgover"');
  
//	$content .= '<button type="submit" class="button">'.BUTTON_SEARCH_ALT;
//	$content .= zen_image_button(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT,'class="imgover"');
//	$content .= '</button>';


//  $content .= '<a href="#" onClick="OnBtnSubmit()">'.zen_image_button(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT,'class="imgover"').'</a>';

  $content .= "</form>";
//  $content .= '</div>';
?>