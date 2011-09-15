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
  function delete_confirm() {
    if (window.confirm("<?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT_CONFIRMATION; ?>"))
      return true;
    else
      return false;
  }
  // -->
</script>

<?php echo $html->form('index', '&page='.$_SESSION['easy_admin_products_page']); ?>
  <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_LIST; ?>">
</form>

  <table id="mainProductTable" class="tableLayout3">
    <tr>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_ID; ?></th>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_NAME; ?></th>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_PRODUCT_MODEL; ?></th>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY_FOR_ALL_VARIANTS; ?></th>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_ACTION; ?></th>
    </tr>

    <tr class="productRow">
      <td class="pwas"><?php echo $products_id; ?></td>
      <td><?php echo $products_name; ?></td>
      <td><?php echo $products_model; ?></td>
      <td align="center"><?php echo $products_quantity; ?></td>
      <td><a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&action=resync&amp;products_id=".$products_id, 'NONSSL'); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SYNC_QUANTITY; ?></a></td>
    </tr>

<?php
  $stocks = $stock->get_stocks($products_id);
  if (!$stocks->EOF) {
?>
    <tr>
      <td colspan="6">
        <table class="stockAttributesTable">
          <tr>
            <th class="stockAttributesHeadingStockId"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_STOCK_ID; ?></th>
            <th class="stockAttributesHeadingSKUModel"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_SKUMODEL; ?></th>
            <th class="stockAttributesHeadingVariant"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_VARIANT; ?></th>
            <th class="stockAttributesHeadingQuantity"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_QUANTITY_IN_STOCK; ?></th>
            <th class="stockAttributesHeadingEdit" colspan="2"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_ACTION; ?></th>
          </tr>
<?php
    while (!$stocks->EOF) {
?>
          <tr id="sid-<?php echo $stocks->fields['stock_id']; ?>">
            <td class="stockAttributesCellStockId"><?php echo $stocks->fields['stock_id']; ?></td>
            <td class="stockAttributesSKUModel"><?php echo htmlspecialchars($stocks->fields['skumodel']); ?></td>
            <td class="stockAttributesCellVariant">
<?php
              $attributes_of_stock = explode(',',$stocks->fields['stock_attributes']);
              $attributes_output = array();
              foreach($attributes_of_stock as $attri_id) {
                $stock_attribute = $stock->get_attributes_name($attri_id, $_SESSION['languages_id']);
                $attributes_output[] = '<strong>'.$stock_attribute['option'].':</strong> '.$stock_attribute['value'].'<br/>';
              }
              sort($attributes_output);
              echo implode("\n",$attributes_output);
?>
            </td>
            <td class="stockAttributesCellQuantity" align="right" id="stockid-<?php echo $stocks->fields['stock_id']; ?>"><?php echo $stocks->fields['quantity']; ?></td>
            <td class="stockAttributesCellEdit">
              <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&action=edit&amp;products_id=".$products_id."&amp;stock_id=".$stocks->fields['stock_id'], 'NONSSL'); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_EDIT_QUANTITY;?></a>
            </td>
            <td class="stockAttributesCellDelete">
              <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&action=delete&amp;products_id=".$products_id."&amp;stock_id=".$stocks->fields['stock_id'], 'NONSSL'); ?>" onclick="return delete_confirm();"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_DELETE_VARIANT; ?></a>
            </td>
          </tr>
<?php
      $stocks->MoveNext();
    }
?>
        </table>
      </td>
    </tr>
<?php
  }
?>

  </table>

  <a href="<?php echo zen_href_link(FILENAME_ADDON_MODULES_ADMIN, "module=easy_admin_products/attributes_stock&action=add&amp;products_id=".$products_id, 'NONSSL'); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_PWA_ADD_QUANTITY; ?></a>
