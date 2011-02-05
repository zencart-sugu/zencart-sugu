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
    <td>
      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "edit",
                   "page"        => $page,
                 );
        $image = $html->input_image("icon_edit.gif", MODULE_EASY_ADMIN_PRODUCTS_EDIT);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "delete",
                   "page"        => $page,
                 );
        $image = $html->input_image("icon_delete.gif", MODULE_EASY_ADMIN_PRODUCTS_DELETE);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>

      <?php
        $parm  = array(
                   "products_id" => $fields['products_id'],
                   "action"      => "copy",
                   "page"        => $page,
                 );
        $image = $html->input_image("icon_copy.gif", MODULE_EASY_ADMIN_PRODUCTS_COPY);
        $link  = $html->href_link("", $parm);
      ?>
      <a href="<?php echo $link; ?>"><?php echo $image; ?></a>
    </td>
  </tr>
<?php
    $products->MoveNext();
  }
?>
