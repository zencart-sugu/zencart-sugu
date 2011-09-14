<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<?php echo $html->form('delete', 'attributes'); ?>
  <input type="hidden" name="action"         value="delete_option_process">
  <input type="hidden" name="products_id"    value="<?php echo $products_id; ?>">
  <input type="hidden" name="options_id"  value="<?php echo $options_id; ?>">

<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_DELETE_OPTION_TITLE; ?></h3>
<div>
<?php echo TEXT_INFO_ID . $products_id . ' ' . zen_get_products_model($products_id) . ' - ' . zen_get_products_name($products_id); ?>
</div>
<table class="tableLayout3 delete" border="0" width="100%" cellspacing="0" cellpadding="0">
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
  </tr>
<?php foreach ($attributes as $attribute) { ?>
  <tr>
    <?php foreach($model->display as $k => $v) { ?>
      <td <?php echo $v; ?>>
        <?php echo $attribute[$k]; ?>
      </td>
    <?php } ?>
  </tr>
<?php } ?>
</table>

  <table border="0" width="100%" cellspacing="0" cellpadding="0">

    <tr>
      <td  colspan="2" class="submit">
        <input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_DELETE_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_DELETE; ?>">
        <?php
          $parm = array(
                    "products_id" => $products_id,
                  );
        ?>
        <a href="<?php echo $html->href_link('attributes', $parm); ?>"><?php echo $html->image(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CANCEL_BTN, MODULE_EASY_ADMIN_PRODUCTS_CANCEL); ?></a>
      </td>
    </tr>

  </table>
</form>
