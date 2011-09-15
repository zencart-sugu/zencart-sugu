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
  echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&action=confirm", 'post', '', true);
  echo zen_draw_hidden_field('products_id',   $products_id);
?>
    <h3><?php echo $products_name; ?></h3>
    <table class="tableLayout3">
      <tr>
        <th><p><strong><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SKUMODEL; ?></strong></p></th>
        <td><?php echo zen_draw_input_field('skumodel'); ?></td>
      </tr>
<?php
      if (is_array($product_attributes)) {
        foreach($product_attributes as $option_name => $options) {
          $arrValues = array();
          if (is_array($options)) {
            if (sizeof($options) > 0) {
              foreach ($options as $k => $a) {
                $arrValues[] = $a['id'];
              }
            }
          }
?>
      <tr>
        <th><p><strong><?php echo $option_name; ?></strong></p></th>
        <td><?php echo zen_draw_pull_down_menu('attributes[]',$options); ?></td>
      </tr>
<?php
        }
      }
?>
      <tr>
        <th><p><strong><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY; ?></strong></p></th>
        <td><?php echo zen_draw_input_field('quantity'); ?></td>
      </tr>
    </table>

    <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SUBMIT ?>">
  </form>

<?php
  echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&products_id=".$products_id, 'post', '', true);
?>
    <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_CANCEL ?>">
  </form>
