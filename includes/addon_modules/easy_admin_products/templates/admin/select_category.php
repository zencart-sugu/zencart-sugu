<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>easy_admin_products/templates/admin/js/jquery.js"></script>
<script type="text/javascript">
  function category_selected(categories_id) {
    parent.category_selected(categories_id);
  }
</script>

<tr>
  <td colspan="5"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_LIST; ?></td>
</tr>

<tr>
  <td width="10"></td>
  <td colspan="5">
    <?php
      $link = $html->href_link("select_category");
      print '<a href="'.$link.'">'.MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP.'</a>';
      if ($_REQUEST['category_id'] > 0) {
        print MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE;
        print $model->get_category($_REQUEST['category_id'], $link, MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE);
      }
    ?>
  </td>
</tr>

<?php
  $param      = array('category_id' => $_REQUEST['category_id']);
  $categories = $model->get_categories($param);
  foreach($categories as $category) {
?>
  <tr>
    <td width="10"></td>
    <td width="10"></td>
    <td width="1%" nowrap>
      <?php if ($category['child']) { ?>
        <a href="<?php echo $html->href_link("select_category", array('category_id'=>$category['id'])); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?></a>
      <?php } ?>
    </td>
    <td width="1%" nowrap>
      <a onclick="return category_selected(<?php echo $category['id']; ?>);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
    </td>
    <td>
      <?php echo $category['text']; ?>
    </td>
  </tr>
<?php
  }
?>

<tr>
  <td colspan="5"></td>
</tr>

<tr>
  <td colspan="5"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_SEARCH; ?></td>
</tr>

<tr>
  <td width="10"></td>
  <td colspan="4">
    <?php echo $html->form('form_search', 'select_category'); ?>
      <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($_REQUEST['category_id']); ?>">
      <?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_NAME; ?>
      <input type="text" name="keyword" value="<?php echo htmlspecialchars($_REQUEST['keyword']); ?>">
      <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEARCH; ?>">
    </form>
  </td>
</tr>

<?php
  if ($_REQUEST['keyword'] != "") {
    $param      = array('keyword' => $_REQUEST['keyword']);
    $categories = $model->get_categories($param);
    foreach($categories as $category) {
?>
    <tr>
      <td width="10"></td>
      <td width="10"></td>
      <td width="1%" nowrap>
        <?php if ($category['child']) { ?>
          <a href="<?php echo $html->href_link("select_category", array('category_id'=>$category['id'])); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?></a>
        <?php } ?>
      </td>
      <td width="1%" nowrap>
        <a onclick="return category_selected(<?php echo $category['id']; ?>);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
      </td>
      <td>
        <?php
          $link = $html->href_link("select_category");
          print '<a href="'.$link.'">'.MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP.'</a>';
          print MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE;
          print $model->get_category($category['id'], $link, MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE);
        ?>
      </td>
    </tr>
<?php
    }
  }
?>
