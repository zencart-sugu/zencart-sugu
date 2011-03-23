<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<script type="text/javascript">
  function category_select(html_id, category, category_base) {
    $.fancybox({
        'padding':       0,
        'autoScale':     false,
        'transitionIn':  'none',
        'transitionOut': 'none',
        'width':         '75%',
        'height':        '75%',
        'href':          '<?php echo $html->href_link("select_category"); ?>&html_id='+html_id+'&category_id='+category+'&category_base_id='+category_base,
        'type':          'iframe'
      });

    return false;
  }

  function category_selected(html_id, category_id) {
    // 既に同じカテゴリが選択されているか?
    var key   = "cat_"+category_id;
    var check = $("#"+key);
    if (check.length != 0) {
      $.fancybox.close();
      return;
    }

    $.ajax({
      type: "GET",
      url:  "<?php echo $html->href_link(); ?>",
      data: "module=easy_admin_products/ajax_get_category_name&category_id="+category_id,
      success: function(name) {
        var categories_ids = $("#"+html_id+"_id").val();
        if (categories_ids != "")
          categories_ids += ",";
        $("#"+html_id+"_id").val(categories_ids+category_id);

        var format = '<div id="'+key+'">'
                   +   '<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT; ?>'
                   +   '<a href="javascript:void()" onclick="category_remove('+category_id+');">'
                   +     '<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_DROP; ?>'
                   +   '<'+'/a>'
                   + '<'+'/div>';
        format = format.replace("\%s", name);
        var html = $("#"+html_id+"_div").html();
        $("#"+html_id+"_div").html(html+format);
        $.fancybox.close();
      }
    });
  }

  function category_remove_sub(name, categories_id) {
    var categories_ids = $("#"+name).val().split(",");
    var categories_new = new Array();
    for (var i=0; i<categories_ids.length; i++) {
      if (categories_ids[i] != categories_id)
        categories_new.push(categories_ids[i]);
    }
    $("#"+name).val(categories_new.join(","));
  }

  function category_remove(categories_id) {
    category_remove_sub('category_id', categories_id);
    $("#cat_"+categories_id).remove();
    return false;
  }

  function category_reset() {
    $("#category").val(0);
    $("#category_name").html("");
    return false;
  }
</script>

<?php
  ob_start();
  echo $html->form('form_search');
?>
<<<<<<< HEAD
  <table>
    <tr>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_CATEGORY; ?></td>
      <td>
        <input type="hidden" id="category" name="category" value="<?php echo htmlspecialchars($_SESSION['category']); ?>" />
        <a id="fancybox_category" onclick="return category_select();"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
      </td>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_TITLE; ?></td>
      <td><input id="title" name="title" type="text" value="<?php echo htmlspecialchars($_SESSION['title']); ?>" /></td>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_MODEL; ?></td>
      <td><input id="model" name="model" type="text" value="<?php echo htmlspecialchars($_SESSION['model']); ?>" /></td>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_MANUFACTURER; ?></td>
      <td><input id="manufacturer" name="manufacturer" type="text" value="<?php echo htmlspecialchars($_SESSION['manufacturer']); ?>" /></td>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_DESCRIPTION; ?></td>
      <td><input id="description" name="description" type="text" value="<?php echo htmlspecialchars($_SESSION['description']); ?>" /></td>
      <td align="right"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_SPECIAL; ?></td>
      <td><?php echo zen_draw_pull_down_menu("special", $special, $_SESSION['special'], 'id="special"'); ?></td>
      %__SEARCH_EXTERNAL_ITEMS__%
      <td><input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH; ?>"/></td>
    </tr>
  </table>
</form>
<?php
  global $easy_admin_products_search_form_html;
  $easy_admin_products_search_form_html = ob_get_contents();
  ob_end_clean();

  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_SEARCH_FORM');
  $easy_admin_products_search_form_html = str_replace('%__SEARCH_EXTERNAL_ITEMS__%', '', $easy_admin_products_search_form_html);
  print $easy_admin_products_search_form_html;
?>

<span id="category_name">
=======
<div class="searchBox">
  <table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_CATEGORY; ?></th>
       <td colspan="5">
        <input type="hidden" id="category_id" name="category_id" value="<?php echo htmlspecialchars($_SESSION['category']); ?>" />
        <a id="fancybox_category" onclick="return category_select('category', 0, 0);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
        <span id="category_div">
>>>>>>> VB_easy_admin_products
  <?php
    if ($_SESSION['category'] > 0) {
      echo sprintf(MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT, $model->get_category($_SESSION['category']));
      echo '<a href="javascript:void(0);" onclick="return category_reset();">'.MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_RESET.'</a>';
    }
  ?>
</span>
      </td>
     </tr>
	 <tr>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_TITLE; ?></th>
      <td id="itemTitle"><input id="title" name="title" type="text" value="<?php echo htmlspecialchars($_SESSION['title']); ?>" /></td>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_MODEL; ?></th>
      <td id="itemModel"><input id="model" name="model" type="text" value="<?php echo htmlspecialchars($_SESSION['model']); ?>" /></td>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_MANUFACTURER; ?></th>
      <td id="itemManufacturer"><input id="manufacturer" name="manufacturer" type="text" value="<?php echo htmlspecialchars($_SESSION['manufacturer']); ?>" /></td>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_DESCRIPTION; ?></th>
      <td id="itemDescription"><input id="description" name="description" type="text" value="<?php echo htmlspecialchars($_SESSION['description']); ?>" /></td>
      <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ITEM_SPECIAL; ?></th>
      <td id="itemSpecial"><?php echo zen_draw_pull_down_menu("special", $special, $_SESSION['special'], 'id="special"'); ?></td>
      %__SEARCH_EXTERNAL_ITEMS__%
      </tr>
	  <tr>
      <td colspan="10" class="submit"><input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH; ?>"/></td>
    </tr>
  </table>
</div>
</form>
<?php
  global $easy_admin_products_search_form_html;
  $easy_admin_products_search_form_html = ob_get_contents();
  ob_end_clean();

  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_SEARCH_FORM');
  $easy_admin_products_search_form_html = str_replace('%__SEARCH_EXTERNAL_ITEMS__%', '', $easy_admin_products_search_form_html);
  print $easy_admin_products_search_form_html;
?>


<div class="listBox">
<table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <?php
      $count = 0;
      for (;;) {
        $key = "MODULE_EASY_ADMIN_PRODUCTS_HEADING_".$count;
        if (!defined($key))
          break;
    ?>
      <th><?php echo constant($key); ?></th>
    <?php
        $count++;
      }
    ?>
  </tr>
  <?php require(dirname(__FILE__) . '/products_list.php'); ?>
</table>
</div>

<?php echo $html->form('new'); ?>
  <input type="hidden" name="action" value="new">
  <input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_INSERT_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_INSERT; ?>">
</form>

<div class="smallText" align="center">
<?php
  echo $split->display_count($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_MAX_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS);
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  echo $split->display_links($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_MAX_RESULTS, "", $_GET['page'], "module=easy_admin_products");
?>
</div>
