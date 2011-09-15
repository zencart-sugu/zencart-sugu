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
  echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock".'&action=confirm', 'post', '', true)."\n";
  echo zen_draw_hidden_field('stock_id',      $stock_id);
  echo zen_draw_hidden_field('products_id',   $products_id);
  echo zen_draw_hidden_field('attributes[]',  $attributes);
?>

    <h3><?php echo $products_name; ?></h3>

    <table class="tableLayout3">
      <tr>
        <th><p><strong><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SKUMODEL; ?></strong></p></th>
        <td><?php echo zen_draw_input_field('skumodel', $skumodel); ?></td>
<?php
      foreach($attributes_list as $attributes) {
?>
        <tr>
          <th><p><strong><?php echo $attributes['option']; ?></strong></p></th>
          <td><?php echo $attributes['value']; ?></td>
        </tr>
<?php
      }
?>
      <tr><th><p><strong><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY; ?></strong></p></th>
      <td><?php echo zen_draw_input_field('quantity', $qty); ?></td>
    </table>

    <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SUBMIT ?>">
  </form>

  <?php echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&products_id=".$products_id, 'post', '', true)."\n"; ?>
    <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_CANCEL ?>">
  </form>
