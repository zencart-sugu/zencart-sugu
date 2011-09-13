<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<?php
  // make table header
  ob_start();
?>
  <tr>
    <?php
      $count = 0;
      for (;;) {
        $key = "MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_".$count;
        if (!defined($key))
          break;
    ?>
      <th><?php echo constant($key); ?></th>
    <?php
        $count++;
      }
    ?>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_HEADING_OPERATION; ?></th>
  </tr>
<?php
  $easy_admin_products_attributes_table_header = ob_get_contents();
  ob_end_clean();
?>
<?php
  $load_option_name = false;
  $can_operate = true;
  $current_options_name = '';
  while (!$products_attributes->EOF) {
    $fields = $model->convert_product_attributes_result($products_attributes, $load_option_name, $can_operate);
    if ($current_options_name != $fields['products_options_name']) {
      $current_options_name = $fields['products_options_name'];
?>
  <tr>
    <td colspan="9">
      <?php echo $current_options_name; ?>
      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "options_id" => $fields['options_id'],
                   "action"      => "delete_option",
                   "page"        => $page,
                 );
        $image = $html->input_image("icon_delete.gif", MODULE_EASY_ADMIN_PRODUCTS_DELETE);
        $link  = $html->href_link("attributes", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>
    </td>
  </tr>
<?php
      echo $easy_admin_products_attributes_table_header;
    }  
?>
  <tr>
    <?php foreach($model->display as $k => $v) { ?>
      <td <?php echo $v; ?>>
        <?php echo $fields[$k]; ?>
      </td>
    <?php } ?>
    <!-- Áàºî -->
    <td class="operation">
      <?php
        $image = $html->image("icon_edit.gif", MODULE_EASY_ADMIN_PRODUCTS_EDIT);
      ?>
      <a href="javascript:ajax_get_attributes_edit_form(<?php echo $fields['products_id'] ?>, <?php echo $fields['products_attributes_id'] ?>, false)"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "attributes_id" => $fields['products_attributes_id'],
                   "action"      => "delete",
                   "page"        => $page,
                 );
        $image = $html->input_image("icon_delete.gif", MODULE_EASY_ADMIN_PRODUCTS_DELETE);
        $link  = $html->href_link("attributes", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>
    </td>
  </tr>
<?php
    $products_attributes->MoveNext();
  }
?>
