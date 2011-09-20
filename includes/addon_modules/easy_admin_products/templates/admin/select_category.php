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
  function category_selected(id, categories_id) {
    parent.category_selected(id, categories_id);
  }
</script>

<table id="selectCategoryBox" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td id="categoryList">
			<h2><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_LIST; ?></h2>
			<p> <?php
            $parm = array('html_id'=>$_REQUEST['html_id']);
            if ($_REQUEST['category_base_id'] > 0) {
              $parm = array('category_base_id' => $_REQUEST['category_base_id']);
            }
            $link = $html->href_link("select_category", $parm);
            if ($_REQUEST['category_base_id'] == 0) {
              print '<a href="'.$link.'">'.MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP.'</a>';
              print MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE;
            }
            if ($_REQUEST['category_id'] > 0) {
              print $model->get_category($_REQUEST['category_id'], $link, MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE, $_REQUEST['category_base_id']);
            }
   			?>
   		</p>
   		<table border="0" cellpadding="0" cellspacing="0">
   		<?php
			  $param      = array('category_id' => $_REQUEST['category_id']);
			  $categories = $model->get_categories($param);
			  foreach($categories as $category) {
			?>
   			<tr>
   				<td class="categoryName">
      			<?php if ($category['child']) { ?><a href="<?php echo $html->href_link("select_category", array('html_id'=>$_REQUEST['html_id'], 'category_id'=>$category['id'], 'category_base_id'=>$_REQUEST['category_base_id'])); ?>"><?php } ?><?php echo $category['text']; ?></span><?php if ($category['child']) { ?><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?></a>
      			<?php } ?>
      		</td>
      		<td class="categoryChoice">
      			<a onclick="return category_selected('<?php echo $_REQUEST['html_id']; ?>', <?php echo $category['id']; ?>);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
      		</td>
      	</tr>
		<?php
		  }
		?>
		</table>

		</td>
		<td width="5">&nbsp;</td>
		<td id="categorySearch">
			<h2><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_SEARCH; ?></h2>

		  <?php echo $html->form('form_search', 'select_category'); ?>
		    <input type="hidden" name="html_id" value="<?php echo htmlspecialchars($_REQUEST['html_id']); ?>">
		    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($_REQUEST['category_id']); ?>">
		    <?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_NAME; ?>
		    <input type="text" name="keyword" value="<?php echo htmlspecialchars($_REQUEST['keyword']); ?>">
		    <input  type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEARCH; ?>">
		  </form>

      <table border="0" cellpadding="0" cellspacing="0">
        <?php
          if ($_REQUEST['keyword'] != "") {
            $param      = array('keyword' => $_REQUEST['keyword']);
            $categories = $model->get_categories($param);
            foreach($categories as $category) {
        ?>
        <tr>
   				<td class="categoryName">
            <?php
              $link = $html->href_link("select_category");
              print '<a href="'.$link.'">'.MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TOP.'</a>';
              print MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE;
              print $model->get_category($category['id'], $link, MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SEPARATE);
            ?>
            <?php if ($category['child']) { ?>
              <a href="<?php echo $html->href_link("select_category", array('html_id'=>$_REQUEST['html_id'], 'category_id'=>$category['id'])); ?>"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?></a>
            <?php } ?>
          </td>
      	  <td class="categoryChoice">
            <a onclick="return category_selected('<?php echo $_REQUEST['html_id']; ?>', <?php echo $category['id']; ?>);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
          </td>
        </tr>
        <?php
            }
          }
        ?>
      </table>
    </td>
  </tr>
</table>
