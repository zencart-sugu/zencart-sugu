<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search.<br />
 * Displays options fields upon which a product search will be run
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_default.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
?>
<div class="centerColumn" id="advSearchDefault">

<?php echo zen_draw_form('advanced_search', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onsubmit="return check_form(this);"') . zen_hide_session_id(); ?>
<?php echo zen_draw_hidden_field('main_page', FILENAME_ADVANCED_SEARCH_RESULT); ?>
    
<h1 id="advSearchDefaultHeading"><?php echo HEADING_TITLE_1; ?></h1>
 
<div id="centerColumnBody">
<?php if ($messageStack->size('search') > 0) echo $messageStack->output('search'); ?>  

<table class="border fit search keyword">
<tr>
<th scope="row"><?php echo MODULE_SEARCH_MORE_ENTRY_KEYWORD; ?></th>
<td><?php echo zen_draw_input_field('keyword', KEYWORD_FORMAT_STRING, 'onfocus="RemoveFormatString(this, \'' . KEYWORD_FORMAT_STRING . '\')" class="keyword"'); ?>&nbsp;&nbsp;&nbsp;<?php echo zen_draw_checkbox_field('search_in_description', '1',$form_vars['search_in_description'], 'id="search-in-description"'); ?><label class="checkboxLabel" for="search-in-description"><?php echo MODULE_SEARCH_MORE_TEXT_SEARCH_IN_DESCRIPTION; ?></label></td>
</tr>
<tr>
<th scope="row"><?php echo MODULE_SEARCH_MORE_ENTRY_CATEGORIES; ?></th>
<td><?php echo zen_draw_pull_down_menu('categories_id', zen_get_categories(array(array('id' => '', 'text' => MODULE_SEARCH_MORE_TEXT_ALL_CATEGORIES)),0,'', '1'),$form_vars['categories_id'] ); ?>
<?php echo zen_draw_checkbox_field('inc_subcat', '1', $form_vars['inc_subcat'] , 'id="inc-subcat"'); ?><label class="checkboxLabel" for="inc-subcat"><?php echo MODULE_SEARCH_MORE_ENTRY_INCLUDE_SUBCATEGORIES; ?></label></td>
</tr>
<tr>
<th scope="row"><?php echo MODULE_SEARCH_MORE_ENTRY_MANUFACTURERS; ?></th>
<td><?php echo zen_draw_pull_down_menu('manufacturers_id', zen_get_manufacturers(array(array('id' => '', 'text' => MODULE_SEARCH_MORE_TEXT_ALL_MANUFACTURERS)))); ?></td>
</tr>
<tr>
<th scope="row"><?php echo MODULE_SEARCH_MORE_ENTRY_PRICE_RANGE; ?></th>
<td><?php echo zen_draw_input_field('pfrom',$form_vars['pfrom'] ,'','text',false); ?><?php echo TEXT_PRICE_EN ; ?>
        <?php echo MODULE_SEARCH_MORE_TEXT_FROM_TO ?> 
        <?php echo zen_draw_input_field('pto',$form_vars['pto'] ,'','text',false); ?><?php echo TEXT_PRICE_EN ; ?></td>
</tr>
<tr>
<th scope="row"><?php echo MODULE_SEARCH_MORE_ENTRY_DATE_RANGE; ?></th>
<td><?php echo zen_draw_input_field('dfrom', $form_vars['dfrom'] , 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"',false); ?> 
        <?php echo MODULE_SEARCH_MORE_TEXT_FROM_TO ?>
        <?php echo zen_draw_input_field('dto', $form_vars['dto'] , 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"',false); ?><?php echo DOB_FORMAT_STRING_SAMPLE; ?></td>
</tr>
</table>

<div class="submit">
<?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT,'class="imgover"'); ?>
</div>

</form>
</div></div>
