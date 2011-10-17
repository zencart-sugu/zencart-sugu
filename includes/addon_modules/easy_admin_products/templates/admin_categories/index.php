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
  $parm = array('action' => 'search');
  $search_link = $html->href_link('categories', $parm);
?>
<ul>
  <li><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_TREE; ?></li>
  <li><a href="<?php echo $search_link; ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_SEARCH; ?></a></li>
</ul>

<?php echo $breadcrumb; ?>

<div class="listBox">
<table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">
  <?php require(dirname(__FILE__) . '/categories_list.php'); ?>
</table>
</div>

<div class="smallText" align="center">
<?php
  echo $split->display_count($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_MAX_RESULTS, $current_parm['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS);
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  echo $split->display_links($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_MAX_RESULTS, "", $current_parm['page'], "module=easy_admin_products/categories&category_id=". $current_parm['category_id']);
?>
</div>

<div id="action_buttons">
<?php
  $parm  = array(
             "action"      => "new",
             "parent_id" => $current_parm['category_id'],
           );
  $parm = $model->add_current_parm($parm);
  $link  = $html->href_link("categories", $parm);
?>
  <a href="<?php echo $link ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORIES_CREATE_BTN ?></a>
</div>

<?php
  global $easy_admin_products_categories_index_screent_html;
  $easy_admin_products_categories_index_screent_html = ob_get_contents();
  ob_end_clean();

  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_CATEGORIES_FINISH_DISPLAY_INDEX');
  print $easy_admin_products_categories_index_screent_html;
?>
