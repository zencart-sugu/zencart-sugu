<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
  <tr>
    <?php
      $count = 0;
      for (;;) {
        $key = ($action == "search" ? "MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_HEADING_" : "MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_").$count;
        if (!defined($key))
          break;
    ?>
      <th><?php echo constant($key); ?></th>
    <?php
        $count++;
      }
    ?>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_HEADING_OPERATION; ?></th>
  </tr>
<?php
  while (!$categories->EOF) {
    $fields = $model->convert_categories_result($categories, $action);
?>
  <tr>
    <td nowrap>
      <?php echo $fields['categories_id']; ?>
    </td>
    <td wrap>
      <?php $subcategory_icon = ($fields['subcategories_count'] > 0) ? $html->image('icon_plus.gif', MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_ICON_PLUS) : ''; ?>
      <?php echo $fields['link_to_categories'] . $subcategory_icon; ?></a>
    </td>
    <td align="center">
      <a href="<?php echo $fields['link_to_products']; ?>"><?php echo zen_output_string_protected(MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_LINK_TO_PRODUCTS); ?></a>
    </td>
    <td>
<?php 
if ($fields['categories_status']) {
    $status_icon = $html->image('icon_green_on.gif', IMAGE_ICON_STATUS_ON);
}else{
    $status_icon = $html->image('icon_red_on.gif', IMAGE_ICON_STATUS_OFF);
}
?>
      <a href="<?php echo $fields['link_to_status']; ?>"><?php echo $status_icon; ?></a>
<?php if ($fields['is_link']) { ?>
      &nbsp;&nbsp;<?php echo $html->image('icon_yellow_on.gif', IMAGE_ICON_LINKED); ?>
<?php } ?>
    </td>
    <td align="right">
      <?php echo $fields['sort_order']; ?>
    </td>
    <!-- Áàºî -->
    <td class="operation">
      <?php
        $parm  = array(
                   "cID"         => $fields['categories_id'],
                   "action"      => "edit",
                   "parent_id"   => $current_parm['category_id'],
                 );
        $parm = $model->add_current_parm($parm);
        $link  = $html->href_link("categories", $parm);
        $image = $html->image("icon_edit.gif", MODULE_EASY_ADMIN_PRODUCTS_EDIT);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "cID"         => $fields['categories_id'],
                   "action"      => "delete",
                 );
        $parm = $model->add_current_parm($parm);
        $link  = $html->href_link("categories", $parm);
        $image = $html->image("icon_delete.gif", MODULE_EASY_ADMIN_PRODUCTS_DELETE);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>
    </td>
  </tr>
<?php
    $categories->MoveNext();
  }
?>
