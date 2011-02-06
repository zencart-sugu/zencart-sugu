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
  var category_getted = new Array();

  function toggle_categories(categories_id) {
    // 表示されていない時はサブカテゴリを取得して、表示
    // ただし２回目以降は取得しない
    if ($("#div_"+categories_id).css('display') == 'none') {
      if (category_getted["category_"+categories_id]) {
        $("#div_"+categories_id).show();
        $("#img_"+categories_id).attr("src","<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_minus.gif'; ?>").attr("title","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_CONTRACT; ?>").attr("alt","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_CONTRACT; ?>");
      }
      else {
        // サブカテゴリの取得
        $.ajax({
          type: "GET",
          url:  "<?php echo $html->href_link(); ?>",
          data: "module=easy_admin_products/ajax_get_sub_categories&category_id="+categories_id,
          success: function(json) {
            var html = '<table border="0" width="100%">';
            var categories = eval("("+json+")");
            for(var i=0; i<categories.length; i++) {
              html += '<tr>';
              html += '<td width="10"></td>';
              html += '<td>';
              if (categories[i].child==1) {
                html += '<a onclick="return toggle_categories('+categories[i].id+')">';
                html += '<img id="img_'+categories[i].id+'" src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_plus.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>"/>';
                html += '</a>';
              }
              else {
                html += '<a onclick="javascript:void();">';
                html += '<img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_non.gif'; ?>"/>';
                html += '</a>';
              }
              html += '<a onclick="return category_selected('+categories[i].id+')">';
              html += '<img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_unchecked.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>"/>';
              html += '</a>';
              html += categories[i].text;
              html += '<div id="div_'+categories[i].id+'" style="display:none;"></div>';
              html += '</td>';
              html += '</tr>';
            }
            html += '</table>';
            category_getted["category_"+categories_id] = 1;
            $("#div_"+categories_id).html(html);
            $("#div_"+categories_id).show();
            $("#img_"+categories_id).attr("src","<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_minus.gif'; ?>").attr("title","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_CONTRACT; ?>").attr("alt","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_CONTRACT; ?>");
          }
        });
      }
    }
    // 既に表示されている時は非表示
    else {
      $("#div_"+categories_id).hide();
      $("#img_"+categories_id).attr("src","<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_plus.gif'; ?>").attr("title","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>").attr("alt","<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>");
    }

    return false;
  }

  function category_selected(categories_id) {
    parent.category_selected(categories_id);
  }
</script>

<tr>
  <td colspan="3"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_LIST; ?></td>
</tr>

<?php if ($_REQUEST['category_id'] > 0) { ?>
  <tr>
    <td width="10"></td>
    <td colspan="2">
      <a href="javascript:void();" onclick="category_selected(0);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_RESET; ?></a>
    </td>
  </tr>
<?php } ?>

<tr>
  <td width="10"></td>
  <td colspan="2">
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
    <td>
      <?php if ($category['child']) { ?>
        <a onclick="return toggle_categories(<?php echo $category['id']; ?>);">
          <img id="img_<?php echo $category['id']; ?>" src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_plus.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>"/>
        </a>
      <?php } else { ?>
        <a onclick="javascript:void();">
          <img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_non.gif'; ?>"/>
        </a>
      <?php } ?>
      <a onclick="return category_selected(<?php echo $category['id']; ?>);">
        <img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_unchecked.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>"/>
      </a>
      <?php echo $category['text']; ?>
      <div id="div_<?php echo $category['id']; ?>" style="display:none;"></div>
    </td>
  </tr>
<?php
  }
?>

<tr>
  <td colspan="3"></td>
</tr>

<tr>
  <td colspan="3"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_TITLE_SEARCH; ?></td>
</tr>

<tr>
  <td width="10"></td>
  <td colspan="2">
    <?php echo $html->form('form_search', 'select_category'); ?>
      <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category['id']); ?>">
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
      <td>
        <?php if ($category['child']) { ?>
          <a onclick="return toggle_categories(<?php echo $category['id']; ?>);">
            <img id="img_<?php echo $category['id']; ?>" src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_plus.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_EXPAND; ?>"/>
          </a>
        <?php } else { ?>
          <a onclick="javascript:void();">
            <img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_non.gif'; ?>"/>
          </a>
        <?php } ?>
        <a onclick="return category_selected(<?php echo $category['id']; ?>);">
          <img src="<?php echo DIR_WS_CATALOG.DIR_WS_ADDON_MODULES.'/easy_admin_products/images/icon_unchecked.gif'; ?>" title="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?>"/>
        </a>
        <?php echo $category['text']; ?>
        <div id="div_<?php echo $category['id']; ?>" style="display:none;"></div>
      </td>
    </tr>
<?php
    }
  }
?>
