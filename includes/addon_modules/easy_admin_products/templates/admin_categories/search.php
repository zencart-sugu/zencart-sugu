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
  ob_start();
?>
<script type="text/javascript">
  $(document).ready(function() {
  });
</script>

<?php
  $parm = array('action' => 'index');
  $tree_link = $html->href_link('categories', $parm);
?>
<ul>
  <li><a href="<?php echo $tree_link; ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_TREE; ?></a></li>
  <li><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH; ?></li>
</ul>

<?php echo $html->form('form_category_search', 'categories'); ?>
  <input type="hidden" name="action" value="search">
<div class="searchBox">
  <?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_TITLE; ?>
  <table cellspacing="0" cellpadding="0" border="0">
    <tr>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_CATEGORIES_NAME; ?></th>
      <td><?php echo zen_draw_input_field('search_name', $_REQUEST['search_name']); ?></td>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH_CATEGORIES_DESCRIPTION; ?></th>
      <td><?php echo zen_draw_input_field('search_description', $_REQUEST['search_description']); ?></td>
    </tr>
    <tr>
      <td colspan="4" class="submit"><input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH; ?>" /></td>
    </tr>
  </table>
</div>
</form>

<div class="listBox">
<table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">
  <?php require(dirname(__FILE__) . '/categories_list.php'); ?>
</table>
</div>

<div class="smallText" align="center">
<?php
  echo $split->display_count($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_MAX_RESULTS, $current_parm['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS);
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  $parm = "module=easy_admin_products/categories&action=search&search_name=". urlencode($current_parm['search_name']) ."&search_description=". urlencode($current_parm['search_description']);
  echo $split->display_links($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_MAX_RESULTS, "", $current_parm['page'], $parm);
?>
</div>

<?php
  global $easy_admin_products_categories_search_screent_html;
  $easy_admin_products_categories_search_screent_html = ob_get_contents();
  ob_end_clean();

  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_DISPLAY_SEARCH');
  print $easy_admin_products_categories_search_screent_html;
?>
