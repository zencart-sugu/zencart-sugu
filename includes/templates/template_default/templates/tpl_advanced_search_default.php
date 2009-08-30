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
  
<?php if ($messageStack->size('search') > 0) echo $messageStack->output('search'); ?>  

<fieldset>
<legend><?php echo HEADING_SEARCH_CRITERIA; ?></legend>
<div class="forward"><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?></div>
<br class="clearBoth" />
    <div class="centeredContent"><?php echo zen_draw_input_field('keyword', KEYWORD_FORMAT_STRING, 'onfocus="RemoveFormatString(this, \'' . KEYWORD_FORMAT_STRING . '\')"'); ?>&nbsp;&nbsp;&nbsp;<?php echo zen_draw_checkbox_field('search_in_description', '1', false, 'id="search-in-description"'); ?><label class="checkboxLabel" for="search-in-description"><?php echo TEXT_SEARCH_IN_DESCRIPTION; ?></label></div>
<br class="clearBoth" />
</fieldset>

<fieldset class="floatingBox back">
    <legend><?php echo ENTRY_CATEGORIES; ?></legend>
    <div class="floatLeft"><?php echo zen_draw_pull_down_menu('categories_id', zen_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)),0 ,'', '1')); ?></div>
<?php echo zen_draw_checkbox_field('inc_subcat', '1', true, 'id="inc-subcat"'); ?><label class="checkboxLabel" for="inc-subcat"><?php echo ENTRY_INCLUDE_SUBCATEGORIES; ?></label>
<br class="clearBoth" />
</fieldset>

<fieldset class="floatingBox forward">
    <legend><?php echo ENTRY_MANUFACTURERS; ?></legend>
    <?php echo zen_draw_pull_down_menu('manufacturers_id', zen_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))); ?>
<br class="clearBoth" />
</fieldset>
<br class="clearBoth" />

<fieldset class="floatingBox back">
<legend><?php echo ENTRY_PRICE_RANGE; ?></legend>
<fieldset class="floatLeft">
    <legend><?php echo ENTRY_PRICE_FROM; ?></legend>
    <?php echo zen_draw_input_field('pfrom'); ?>
</fieldset>
<fieldset class="floatLeft">
    <legend><?php echo ENTRY_PRICE_TO; ?></legend>
    <?php echo zen_draw_input_field('pto'); ?>
</fieldset>
</fieldset> 

<fieldset class="floatingBox forward"> 
<legend><?php echo ENTRY_DATE_RANGE; ?></legend>
<fieldset class="floatLeft">
    <legend><?php echo ENTRY_DATE_FROM; ?></legend>
    <?php echo zen_draw_input_field('dfrom', DOB_FORMAT_STRING, 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
</fieldset> 
<fieldset class="floatLeft">
    <legend><?php echo ENTRY_DATE_TO; ?></legend>
    <?php echo zen_draw_input_field('dto', DOB_FORMAT_STRING, 'onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
</fieldset> 
</fieldset> 
<br class="clearBoth" />


<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT); ?></div>
<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

</form>
</div>