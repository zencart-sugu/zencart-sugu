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
  $page = $_GET['page'];
  while (!$products->EOF) {
    $fields = $model->convert_product_result($products->fields);
?>
  <tr>
    <?php foreach($model->display as $k => $v) { ?>
      <td <?php echo $v; ?>>
        <?php echo $fields[$k]; ?>
      </td>
    <?php } ?>
    <!-- 操作 -->
    <td class="operation">
      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "edit",
                   "page"        => $page,
                 );
        $image = $html->image("icon_edit.gif", MODULE_EASY_ADMIN_PRODUCTS_EDIT);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "delete",
                   "page"        => $page,
                 );
        $image = $html->image("icon_delete.gif", MODULE_EASY_ADMIN_PRODUCTS_DELETE);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "copy",
                   "page"        => $page,
                 );
        $image = $html->image("icon_copy.gif", MODULE_EASY_ADMIN_PRODUCTS_COPY);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "add_related_product_ID"   => $fields['products_id'],
                   "easy_admin_products_page" => $page,
                 );
        $image = $html->image("icon_xsell.gif", MODULE_EASY_ADMIN_PRODUCTS_XSELL);
        $link  = $html->href_link("xsell", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "",
                 );
        $image = $html->image("icon_option_edit.gif", MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_EDIT);
        $link  = $html->href_link("attributes", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        if (easy_admin_products_with_attributes_stock::is_have_attributes($fields['products_id'])) {
          $parm  = array(
                     "products_id"   => $fields['products_id'],
                     "easy_admin_products_page" => $page,
                   );
          $image = $html->image("icon_stock.gif", MODULE_EASY_ADMIN_PRODUCTS_STOCK);
          $link  = $html->href_link("attributes_stock", $parm);
        ?>
        <a href="<?php echo $link; ?>"><?php echo $image; ?></a>
      <?php } ?>
    </td>
  </tr>
<?php
    $products->MoveNext();
  }
?>
