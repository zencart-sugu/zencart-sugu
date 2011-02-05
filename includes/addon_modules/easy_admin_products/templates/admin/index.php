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
  function category_select() {
    var category = $("#category").val();
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
    $("#category").val(categories_id);
    $.ajax({
      type: "GET",
      url:  "<?php echo $html->href_link(); ?>",
      data: "module=easy_admin_products/ajax_get_category_name&category_id="+categories_id,
      success: function(name) {
        var format = "<?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT; ?>";
        format = format.replace("\%s", name);
        $("#category_name").html(format);
        $.fancybox.close();
      }
    });
  }
</script>

<?php echo $html->form('form_search'); ?>
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
      <td><input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SEARCH; ?>"/></td>
    </tr>
  </table>
</form>

<span id="category_name">
  <?php
    if ($_SESSION['category'] > 0)
      echo sprintf(MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_FORMAT, $model->get_category($_SESSION['category']));
  ?>
</span>

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

<?php echo $html->form('new'); ?>
  <input type="hidden" name="action" value="new">
  <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_INSERT; ?>">
</form>

<div class="smallText" align="center">
<?php
  echo $split->display_count($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_MAX_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS);
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  echo $split->display_links($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_MAX_RESULTS, "", $_GET['page'], "module=easy_admin_products");
?>
</div>
