<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<script type="text/javascript">
<!--
  var open_setting_label = '<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?>';
  var close_setting_label = '<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CLOSE_SETTING ?>';

  $(document).ready(function() {
    set_toggle_event('metatags_setting');
<?php if ($category['not_null_metatags']) { ?>
    open_setting('metatags_setting');
<?php } ?>
  });

  function set_toggle_event(name) {
    $('#toggle_'+ name).click(function() {
      if ($('#'+ name).css('display') == 'none') {
        open_setting(name);
      }else{
        close_setting(name);
      }
    });
  }

  function open_setting(name) {
    $('#toggle_'+ name).html(close_setting_label);
    $('#'+ name).show(350);
  }

  function close_setting(name) {
    $('#toggle_'+ name).html(open_setting_label);
    $('#'+ name).hide(350);
  }
//-->
</script>
<?php
  $parm = array(
            "category_id" => $current_category_id,
            "page"  => $page,
          );
?>
<a href="<?php echo $html->href_link('categories', $parm); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_BACK_TO_LIST; ?></a>
<?php echo $html->form('form_edit', 'categories', 'enctype="multipart/form-data"'); ?>
  <input type="hidden" name="action"      value="save">
  <input type="hidden" name="category_id" value="<?php echo $current_category_id; ?>">
  <input type="hidden" name="page"        value="<?php echo $page; ?>">
  <input type="hidden" name="cID"         value="<?php echo $cID; ?>">
  <input type="hidden" name="parent_id"   value="<?php echo $current_category_id; ?>">

<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_BASIC_SETTING; ?></h3>

<div id="basic_setting">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_NAME; ?></th>
    <td>
<?php 
      $field_length = zen_set_field_length(TABLE_CATEGORIES_DESCRIPTION, 'categories_name');
      foreach($category['categories_description_categories_name'] as $k => $v) {
          $flag  = easy_admin_products_model::language_flag($languages, $k);
          echo $flag . zen_draw_input_field('categories_description_categories_name['. $k .']', $v, $field_length) . '<br />';
      }
?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_IMAGE; ?></th>
    <td>
<?php echo zen_draw_file_field('categories_image'); ?><br />
<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_IMAGE_DIR; ?>
<?php
      $dir = @dir(DIR_FS_CATALOG_IMAGES);
      $dir_info[] = array('id' => '', 'text' => "Main Directory");
      while ($file = $dir->read()) {
        if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
          $dir_info[] = array('id' => $file . '/', 'text' => $file);
        }
      }

      $default_directory = substr( $category['categories_image'], 0,strpos( $category['categories_image'], '/')+1);
?>
<?php echo zen_draw_pull_down_menu('img_dir', $dir_info, $default_directory); ?><br />
<?php echo zen_info_image($category['categories_image'], $category['categories_name']); ?><br />
<?php echo $category['categories_image']; ?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DESCRIPTION; ?></th>
    <td>
<?php 
      foreach($category['categories_description_categories_description'] as $k => $v) {
          $flag  = easy_admin_products_model::language_flag($languages, $k);
          echo $flag . zen_draw_textarea_field('categories_description_categories_description['. $k .']', 'soft', '100%', '20', $v) . '<br />';
      }
?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SORT_ORDER; ?></th>
    <td>
<?php echo zen_draw_input_field('sort_order', $category['sort_order'], 'size="6"'); ?>
    </td>
  </tr>
</table>
</div>

<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_SETTING; ?> <a id="toggle_metatags_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="metatags_setting" style="display:none;">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_TITLE; ?></th>
    <td>
<?php 
      $field_length = zen_set_field_length(TABLE_METATAGS_CATEGORIES_DESCRIPTION, 'metatags_title');
      foreach($category['meta_tags_categories_description_metatags_title'] as $k => $v) {
          $flag  = easy_admin_products_model::language_flag($languages, $k);
          echo $flag . zen_draw_input_field('meta_tags_categories_description_metatags_title['. $k .']', $v, $field_length) . '<br />';
      }
?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_META_KEYWORDS; ?></th>
    <td>
<?php 
      foreach($category['meta_tags_categories_description_metatags_keywords'] as $k => $v) {
          $flag  = easy_admin_products_model::language_flag($languages, $k);
          echo $flag . zen_draw_textarea_field('meta_tags_categories_description_metatags_keywords['. $k .']', 'soft', '100%', '20', $v) . '<br />';
      }
?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADER_META_DESCRIPTION; ?></th>
    <td>
<?php 
      foreach($category['meta_tags_categories_description_metatags_description'] as $k => $v) {
          $flag  = easy_admin_products_model::language_flag($languages, $k);
          echo $flag . zen_draw_textarea_field('meta_tags_categories_description_metatags_description['. $k .']', 'soft', '100%', '20', $v) . '<br />';
      }
?>
    </td>
  </tr>
</table>
</div>

<div>
<?php echo zen_image_submit('button_save.gif', IMAGE_SAVE); ?>
<?php
  $parm = array(
            "category_id" => $current_category_id,
            "page"        => $page,
          );
?>
<a href="<?php echo $html->href_link('categories', $parm); ?>"><?php echo zen_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>
</div>

</form>
