<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_listing_display_order.php 3369 2006-04-03 23:09:13Z drbyte $
 */
?>
<?php
// NOTE: to remove a sort order option add an HTML comment around the option to be removed
?>

<div id="sorter">
<label for="disp-order-sorter"><?php echo TEXT_INFO_SORT_BY; ?></label>
<?php
  echo zen_draw_form('sorter_form', zen_href_link($_GET['main_page']), 'get');
  if(isset($_GET['page'])){
      echo zen_draw_hidden_field('page', $_GET['page']);
  }else{
      echo zen_draw_hidden_field('page', 1);
  }
  
  if(isset($_GET['cPath'])){
      echo zen_draw_hidden_field('main_page', $_GET['main_page']);
      echo zen_draw_hidden_field('cPath', $_GET['cPath']);
  }else{
      echo zen_draw_hidden_field('main_page', $_GET['main_page']);
  }
//  echo zen_draw_hidden_field('disp_order', $_GET['disp_order']);
  echo zen_hide_session_id();
  if(isset($_GET['keyword'])){ echo zen_draw_hidden_field('keyword', $_GET['keyword']); }
  if(isset($_GET['search_in_description'])){ echo zen_draw_hidden_field('search_in_description', $_GET['search_in_description']); }
  if(isset($_GET['categories_id'])){ echo zen_draw_hidden_field('categories_id', $_GET['categories_id']); }
  if(isset($_GET['inc_subcat'])){ echo zen_draw_hidden_field('inc_subcat', $_GET['inc_subcat']); }
  if(isset($_GET['manufacturers_id'])){ echo zen_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']); }
  if(isset($_GET['pfrom'])){ echo zen_draw_hidden_field('pfrom', $_GET['pfrom']); }
  if(isset($_GET['pto'])){ echo zen_draw_hidden_field('pto', $_GET['pto']); }
  if(isset($_GET['dfrom'])){ echo zen_draw_hidden_field('dfrom', $_GET['dfrom']); }
  if(isset($_GET['dto'])){ echo zen_draw_hidden_field('dto', $_GET['dto']); }
?>
    <select name="sort" " id="disp-order-sorter">
    <option value="1a" <?php echo ($_GET['sort'] == '1a' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_NAME; ?></option>
    <option value="1d" <?php echo ($_GET['sort'] == '1d' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC; ?></option>
    <option value="3a" <?php echo ($_GET['sort'] == '3a' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_PRICE; ?></option>
    <option value="3d" <?php echo ($_GET['sort'] == '3d' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC; ?></option>
    </select>
    <br>
    <input type="submit" value=<?php echo TEXT_SORT_PRODUCTS?>>
    </form></div>
