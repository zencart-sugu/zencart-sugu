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
  function category_select(category) {
    $.fancybox({
        'padding':       0,
        'autoScale':     false,
        'transitionIn':  'none',
        'transitionOut': 'none',
        'width':         '75%',
        'height':        '75%',
        'href':          '<?php echo $html->href_link("select_category"); ?>&category_id='+category,
        'type':          'iframe'
      });

    return false;
  }

  function category_selected(categories_id) {
    // 既に同じカテゴリが選択されているか?
    var key   = "cat_"+categories_id;
    var check = $("#"+key);
    if (check.length != 0) {
      $.fancybox.close();
      return;
    }

    $.ajax({
      type: "GET",
      url:  "<?php echo $html->href_link(); ?>",
      data: "module=easy_admin_products/ajax_get_category_name&category_id="+categories_id,
      success: function(name) {
        var categories_ids = $("#categories").val();
        if (categories_ids != "")
          categories_ids += ",";
        $("#categories").val(categories_ids+categories_id);

        var format = '<div id="'+key+'">'
                   +   '<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT; ?>'
                   +   '<a href="javascript:void()" onclick="category_remove('+categories_id+');">'
                   +     '<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_DROP; ?>'
                   +   '<'+'/a>'
                   + '<'+'/div>';
        format = format.replace("\%s", name);
        var html = $("#selected_categories").html();
        $("#selected_categories").html(html+format);
        $.fancybox.close();
      }
    });
  }

  function category_remove(categories_id) {
    var categories_ids = $("#categories").val().split(",");
    var categories_new = new Array();
    for (var i=0; i<categories_ids.length; i++) {
      if (categories_ids[i] != categories_id)
        categories_new.push(categories_ids[i]);
    }
    $("#categories").val(categories_new.join(","));
    $("#cat_"+categories_id).remove();
    return false;
  }

  function toggle_detail(id) {
    $("#tr_"+id).toggle();
    if ($("#tr_"+id).css("display") == "none")
      $("#a_"+id).html("<?php echo MODULE_EASY_ADMIN_PRODUCTS_OPEN; ?>");
    else
      $("#a_"+id).html("<?php echo MODULE_EASY_ADMIN_PRODUCTS_CLOSE; ?>");
  }

  $(document).ready(function(){
    updateGross();
  });
</script>

<?php echo $html->form('copy'); ?>
  <input type="hidden" name="action"         value="copy_process">
  <input type="hidden" name="products_id"    value="<?php echo $_REQUEST['products_id']; ?>">
  <input type="hidden" name="products_name"  value="<?php echo htmlspecialchars($product["products_description_products_name"][(int)$_SESSION['languages_id']]); ?>">
  <input type="hidden" name="products_image" value="<?php echo htmlspecialchars($product["products_image"]); ?>">

<div class="copy">
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_COPY_TITLE; ?></h3>
<p>        <?php
          echo sprintf(MODULE_EASY_ADMIN_PRODUCTS_COPY_NOTE, htmlspecialchars($product["products_description_products_name"][(int)$_SESSION['languages_id']])."(ID:".$_REQUEST['products_id'].")");
        ?>
</p>
<table class="tableLayout3" border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <?php
        echo $html->pre_html(MODULE_EASY_ADMIN_PRODUCTS_COPY_CATEGORY);
      ?>
      <td id="categoriesSelect">
        <input id="categories" type="hidden" name="categories" value="<?php echo $product['categories']; ?>">
        <a id="fancybox_category" onclick="return category_select(0);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_COPY_SELECT_TXT; ?>
        <div id="selected_categories">
          <?php
            $categories = explode(",", $product['categories']);
            foreach($categories as $v) {
              if ($v > 0) {
                $name = $model->get_category($v);
                echo '<div id=cat_'.$v.'>';
                echo sprintf(MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT, $name);
                echo '<a href="javascript:void()" onclick="category_remove('.$v.');">';
                echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_DROP;
                echo '</a>';
                echo '</div>';
              }
            }
          ?>
        </div>
      </td>
    </tr>
    <?php echo $html->error($easy_admin_products_validate, "categories"); ?>
<<<<<<< HEAD

=======
</table>    
<table>
>>>>>>> VB_easy_admin_products
    <tr>
      <td>
        <input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_COPY_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_COPY; ?>">
        <a href="<?php echo $html->href_link(); ?>"><input type="image" src="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CANCEL_BTN; ?>" alt="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CANCEL; ?>"></a>
      </td>
    </tr>

  </table>
  </div> 
</form>
