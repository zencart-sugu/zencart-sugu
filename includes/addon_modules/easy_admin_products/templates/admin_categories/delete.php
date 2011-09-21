<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<?php echo $html->form('setflag', 'categories'); ?>
  <input type="hidden" name="action"       value="delete_process">
  <input type="hidden" name="cID"          value="<?php echo $cID; ?>">
  <input type="hidden" name="category_id"  value="<?php echo $current_category_id; ?>">
  <input type="hidden" name="page"         value="<?php echo $page; ?>">

<table class="delete" border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="infoBoxHeading">
    <td class="infoBoxHeading"><b><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_TITLE; ?></b></td>
  </tr>
</table>
<table class="delete" border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="infoBoxContent"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_INTRO; ?></td>
  </tr>
  <tr>
    <td class="infoBoxContent"><br /><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_DELETE_INTRO_LINKED_PRODUCTS; ?><br /><br /></td>
  </tr>
  <tr>
    <td class="infoBoxContent"><br /><b><?php echo zen_output_string_protected($category['categories_description_categories_name'][$_SESSION['languages_id']]); ?></a></td>
  </tr>
<?php if ($category['childs_count'] > 0) { ?>
  <tr>
    <td class="infoBoxContent"><br /><?php echo sprintf(TEXT_DELETE_WARNING_CHILDS, $category['childs_count']); ?></td>
  </tr>
<?php } ?>
<?php if ($category['products_count'] > 0){ ?>
  <tr>
    <td class="infoBoxContent"><br /><?php echo sprintf(TEXT_DELETE_WARNING_PRODUCTS, $category['products_count']); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td align="center" class="infoBoxContent">
      <br />
      <?php echo zen_image_submit('button_delete.gif', IMAGE_DELETE); ?>
      <?php
        $parm = array(
                  "category_id" => $current_category_id,
                  "page"        => $page,
                );
      ?>
      <a href="<?php echo $html->href_link('categories', $parm); ?>"><?php echo zen_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>
    </td>
  </tr>
</table>

</form>
