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
  <input type="hidden" name="action" value="setflag_process">
  <input type="hidden" name="cID"    value="<?php echo $cID; ?>">
  <input type="hidden" name="categories_status" value="<?php echo $category['categories_status']; ?>">
<?php foreach ($current_parm as $k => $v) { ?>
  <input type="hidden" name="current[<?php echo $k ?>]" value="<?php echo zen_output_string_protected($v) ?>" />
<?php } ?>

<table class="setflag" border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="infoBoxHeading">
    <td class="infoBoxHeading"><b><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SETFLAG_TITLE; ?></b></td>
  </tr>
</table>
<table class="setflag" border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="infoBoxContent"><?php echo zen_output_string_protected($category['categories_description_categories_name'][$_SESSION['languages_id']]); ?></td>
  </tr>
  <tr>
    <td class="infoBoxContent"><br /><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_WARNING; ?><br /><br /></td>
  </tr>
  <tr>
    <td class="infoBoxContent"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_INTRO . ' ' . ($category['categories_status'] == '1' ?  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_OFF :  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_ON); ?></td>
  </tr>
  <tr>
    <td class="infoBoxContent">
<?php if ($category['categories_status'] == '1') { ?>
      <br /><?php echo  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_INFO . ' ' .  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_OFF . zen_draw_hidden_field('set_products_status_off', true); ?>
<?php } else { ?>
      <br /><?php echo  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_INFO; ?><br />
      <?php echo zen_draw_radio_field('set_products_status', 'set_products_status_on', true) . ' ' .  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_ON; ?><br />
      <?php echo zen_draw_radio_field('set_products_status', 'set_products_status_off') . ' ' .  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_OFF; ?><br />
      <?php echo zen_draw_radio_field('set_products_status', 'set_products_status_nochange') . ' ' .  MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_STATUS_NOCHANGE; ?>
<?php } ?>
    </td>
  </tr>
  <tr>
    <td align="center" class="infoBoxContent">
      <br />
      <?php echo zen_image_submit('button_update.gif', IMAGE_UPDATE); ?>
      <a href="<?php echo $html->href_link('categories', $current_parm); ?>"><?php echo zen_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>
    </td>
  </tr>
</table>

</form>
