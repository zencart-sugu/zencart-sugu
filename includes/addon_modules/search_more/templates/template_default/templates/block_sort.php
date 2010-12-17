<?php
/**
 * Module Template
 *
 * Template used to render attribute display/input fields
 *
 * @package templateSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */
?>
<div id="block_search_more_sort">
<?php
  $form = zen_draw_form('search_more_sort', zen_href_link($_GET['main_page']), 'get','class="sort"');
  echo $form;
  echo zen_draw_hidden_field('main_page', $_GET['main_page']);
  echo zen_draw_hidden_field('per_page', $sel_per_page);
  echo '<label class="inputLabel">' .MODULE_SEARCH_MORE_SORT_LIST_NAME . '</label>';
  echo zen_draw_pull_down_menu('sort', $opt_sort, $sel_sort);
  echo zen_hide_session_id();
  echo $field_hidden;
?>
<?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT,'class="imgover"'); ?>
</form>
</div>
