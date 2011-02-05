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
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "product", "products_date_available",          "btnDate1", "<?php echo $product['products_date_available']; ?>",          scBTNMODE_CUSTOMBLUE);
  var featuredStart = new ctlSpiffyCalendarBox("featuredStart", "product", "featured_featured_date_available", "btnDate2", "<?php echo $product['featured_featured_date_available']; ?>", scBTNMODE_CUSTOMBLUE);
  var featuredEnd   = new ctlSpiffyCalendarBox("featuredEnd",   "product", "featured_expires_date",            "btnDate3", "<?php echo $product['featured_expires_date']; ?>",            scBTNMODE_CUSTOMBLUE);
  var specialsStart = new ctlSpiffyCalendarBox("specialsStart", "product", "specials_specials_date_available", "btnDate4", "<?php echo $product['specials_specials_date_available']; ?>", scBTNMODE_CUSTOMBLUE);
  var specialsEnd   = new ctlSpiffyCalendarBox("specialsEnd",   "product", "specials_expires_date",            "btnDate5", "<?php echo $product['specials_expires_date']; ?>",            scBTNMODE_CUSTOMBLUE);

  var tax_rates = new Array();
  <?php
    $tax = $model->get_tax(true);
    foreach($tax as $v) {
      print 'tax_rates["'.$v['id'].'"] = '.$v['rate'].";\n";
    }
  ?>

  function doRound(x, places) {
    return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
  }

  function getTaxRate() {
    var v = $("#products_tax_class_id");
    var i = v[0].options[v[0].selectedIndex].value
    return tax_rates[i];
  }

  function updateGross() {
    var taxRate    = getTaxRate();
    var grossValue = $("#products_price")[0].value;

    if (taxRate > 0) {
      grossValue = grossValue * ((taxRate / 100) + 1);
    }

    $("#products_price_gross").val(doRound(grossValue, 4));
  }

  function updateNet() {
    var taxRate    = getTaxRate();
    var netValue = $("#products_price_gross")[0].value;

    if (taxRate > 0) {
      netValue = netValue / ((taxRate / 100) + 1);
    }

    $("#products_price").val(doRound(netValue, 4));
  }

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

<?php echo $html->form('index'); ?>
  <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_LIST; ?>">
</form>

<?php echo $html->form('product', '', 'enctype="multipart/form-data"'); ?>
  <input type="hidden" name="action"                           value="save">

  <input type="hidden" name="products_id"                      value="<?php echo $product['products_id']; ?>">
  <input type="hidden" name="featured_featured_id"             value="<?php echo $product['featured_featured_id']; ?>">
  <input type="hidden" name="specials_specials_id"             value="<?php echo $product['specials_specials_id']; ?>">

  <input type="hidden" name="products_type"                    value="1">
  <input type="hidden" name="products_discount_type"           value="0">
  <input type="hidden" name="products_discount_type_from"      value="0">
  <input type="hidden" name="products_mixed_discount_quantity" value="0">

  <table border="0" width="100%" cellspacing="0" cellpadding="0">
    <tr>
      <td colspan="3"><h3><?php echo ($product['products_id'])?MODULE_EASY_ADMIN_PRODUCTS_UPDATE_TITLE:MODULE_EASY_ADMIN_PRODUCTS_INSERT_TITLE; ?></h3></td>
    </tr>

    <!-- 基本設定 -->
    <tr>
      <td colspan="3"><?php echo MODULE_EASY_ADMIN_PRODUCTS_BASE_TITLE; ?></td>
    </tr>

    <tr>
      <?php
        $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_STATUS_1),
                        array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_STATUS_0));
        echo $html->radio("products_status", MODULE_EASY_ADMIN_PRODUCTS_HEADING_STATUS, $option, $product['products_status']);
      ?>
    </tr>

    <tr>
      <?php
        echo $html->text("products_model", MODULE_EASY_ADMIN_PRODUCTS_HEADING_MODEL, $product['products_model'], "", MODULE_EASY_ADMIN_PRODUCTS_INDISPENSABILITY);
      ?>
    </tr>
    <?php echo $html->error($validate, "products_model"); ?>

    <?php 
      $first = true;
      foreach($product['products_description_products_name'] as $k => $v) {
    ?>
      <tr>
        <?php
          $title = ($first)?MODULE_EASY_ADMIN_PRODUCTS_HEADING_NAME:"";
          $flag  = $model->language_flag($languages, $k);
          echo $html->text("products_description_products_name[".$k."]", $title, $v, $flag);
          $first = false;
        ?>
      </tr>
    <?php } ?>

    <tr>
      <?php
        $tax = $model->get_tax(true);
        echo $html->select("products_tax_class_id", MODULE_EASY_ADMIN_PRODUCTS_HEADING_TAX, $tax, $product['products_tax_class_id'], "", "", 'id="products_tax_class_id" onchange="updateGross();"');
      ?>
    </tr>

    <tr>
      <?php
        echo $html->text("products_price", MODULE_EASY_ADMIN_PRODUCTS_HEADING_PRICE, $product['products_price'], "", "", 'id="products_price" onkeyup="updateGross();"');
      ?>
    </tr>

    <tr>
      <?php
        echo $html->text("products_price_gross", MODULE_EASY_ADMIN_PRODUCTS_HEADING_GROSS, "", "", "", 'id="products_price_gross" onkeyup="updateNet();"');
      ?>
    </tr>

    <tr>
      <?php
        echo $html->file("products_image", MODULE_EASY_ADMIN_PRODUCTS_HEADING_IMAGE);
      ?>
    </tr>

    <tr>
      <?php
        $dir     = $model->get_upload();
        $default = substr($product['products_image'], 0, strpos($product['products_image'], '/')+1);
        $after   = '<br/>'.$product['products_image'].'<input type="hidden" name="products_previous_image" value="'.htmlspecialchars($product['products_image']).'">';
        echo $html->select("img_dir", MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD, $dir, $default, "", $after.MODULE_EASY_ADMIN_PRODUCTS_HEADING_UPLOAD_NOTE);
      ?>
    </tr>

    <tr>
      <?php
        $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                        array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
        echo $html->radio("overwrite", "", $option, 0);
      ?>
    </tr>

    <?php
      $first = true;
      foreach($product['products_description_products_description'] as $k => $v) {
    ?>
      <tr>
        <?php
          $title = ($first)?MODULE_EASY_ADMIN_PRODUCTS_HEADING_DESCRIPTION:"";
          $flag  = $model->language_flag($languages, $k);
          echo $html->textarea("products_description_products_description[".$k."]", $title, $v, $flag);
          $first = false;
        ?>
      </tr>
    <?php } ?>

    <tr>
      <?php
        echo $html->text("products_quantity", MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY, $product['products_quantity']);
      ?>
    </tr>

    <tr>
      <?php
        echo $html->text("products_weight", MODULE_EASY_ADMIN_PRODUCTS_HEADING_WEIGHT, $product['products_weight']);
      ?>
    </tr>

    <tr>
      <?php
        echo $html->pre_html(MODULE_EASY_ADMIN_PRODUCTS_HEADING_CATEGORY);
      ?>
      <td>
        <input id="categories" type="hidden" name="categories" value="<?php echo $product['categories']; ?>">
        <a id="fancybox_category" onclick="return category_select(0);"><?php echo MODULE_EASY_ADMIN_PRODUCTS_CATEGORY_SELECT; ?></a>
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_INDISPENSABILITY; ?>
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
    <?php echo $html->error($validate, "categories"); ?>

    <tr>
      <?php
        $manufacturer = $model->get_manufacturer(true);
        echo $html->select("manufacturers_id", MODULE_EASY_ADMIN_PRODUCTS_HEADING_MANUFACTURER, $manufacturer, $product['manufacturers_id']);
      ?>
    </tr>

    <?php
      $first = true;
      foreach($product['products_description_products_url'] as $k => $v) {
    ?>
      <tr>
        <?php
          $title = ($first)?MODULE_EASY_ADMIN_PRODUCTS_HEADING_URL:"";
          $flag  = $model->language_flag($languages, $k);
          echo $html->text("products_description_products_url[".$k."]", $title, $v, $flag);
          $first = false;
        ?>
      </tr>
    <?php } ?>

    <tr>
      <?php
        echo $html->text("products_sort_order", MODULE_EASY_ADMIN_PRODUCTS_HEADING_SORT, $product['products_sort_order']);
      ?>
    </tr>

    <tr>
      <?php
        echo $html->pre_html(MODULE_EASY_ADMIN_PRODUCTS_HEADING_DATE_AVAILABLE);
      ?>
      <td>
        <script type="text/javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script>
      </td>
    </tr>

    <tr>
      <?php
        $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                        array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
        $after  = '<br/>'
                . MODULE_EASY_ADMIN_PRODUCTS_HEADING_STARTDATE
                . '<script type="text/javascript">featuredStart.writeControl(); featuredStart.dateFormat="yyyy-MM-dd";</script>'
                . '<br/>'
                . MODULE_EASY_ADMIN_PRODUCTS_HEADING_ENDDATE
                . '<script type="text/javascript">featuredEnd.writeControl(); featuredEnd.dateFormat="yyyy-MM-dd";</script>';
        echo $html->radio("featured_status", MODULE_EASY_ADMIN_PRODUCTS_HEADING_FEATURED, $option, $product['featured_status'], "", $after);
      ?>
    </tr>

    <!-- 価格詳細設定 -->
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 0, 20); ?><td>
    </tr>

    <tr>
      <td colspan="2">
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_PRICE_TITLE; ?>
      </td>
      <td>
        <a id="a_products_price" href="javascript:void()" onclick="toggle_detail('products_price');">
          <?php echo MODULE_EASY_ADMIN_PRODUCTS_OPEN; ?>
        </a>
      </td>
    </tr>

    <tr id="tr_products_price" style="display:none;">
      <td colspan="3">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <?php
              $option = array(array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_0),
                              array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_1),
                              array('id' => 2, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_2),
                              array('id' => 3, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION_3));
              echo $html->select("specials_price_status", MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS_OPTION, $option, $product['specials_price_status']);
            ?>
          </tr>

          <tr>
            <?php
              $after  = '<br/>'
                      . MODULE_EASY_ADMIN_PRODUCTS_HEADING_STARTDATE
                      . '<script type="text/javascript">specialsStart.writeControl(); specialsStart.dateFormat="yyyy-MM-dd";</script>'
                      . '<br/>'
                      . MODULE_EASY_ADMIN_PRODUCTS_HEADING_ENDDATE
                      . '<script type="text/javascript">specialsEnd.writeControl(); specialsEnd.dateFormat="yyyy-MM-dd";</script>';
              echo $html->text("specials_specials_new_products_price", MODULE_EASY_ADMIN_PRODUCTS_HEADING_SPECIALS, $product['specials_specials_new_products_price'], "", $after);
            ?>
          </tr>
        </table>
      </td>
    </tr>

    <!-- 配送設定 -->
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 0, 20); ?><td>
    </tr>

    <tr>
      <td colspan="2">
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_SHIPPING_TITLE; ?>
      </td>
      <td>
        <a id="a_products_shipping" href="javascript:void()" onclick="toggle_detail('products_shipping');">
          <?php echo MODULE_EASY_ADMIN_PRODUCTS_OPEN; ?>
        </a>
      </td>
    </tr>

    <tr id="tr_products_shipping" style="display:none;">
      <td colspan="3">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_1),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL_0));
              echo $html->radio("products_virtual", MODULE_EASY_ADMIN_PRODUCTS_HEADING_VIRTUAL, $option, $product['products_virtual']);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_1),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_0),
                              array('id' => 2, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING_2));
              echo $html->radio("product_is_always_free_shipping", MODULE_EASY_ADMIN_PRODUCTS_HEADING_SHIPPING, $option, $product['product_is_always_free_shipping']);
            ?>
          </tr>
        </table>
      </td>
    </tr>

    <!-- カート追加設定 -->
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 0, 20); ?><td>
    </tr>

    <tr>
      <td colspan="2">
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_CART_TITLE; ?>
      </td>
      <td>
        <a id="a_products_cart" href="javascript:void()" onclick="toggle_detail('products_cart');">
          <?php echo MODULE_EASY_ADMIN_PRODUCTS_OPEN; ?>
        </a>
      </td>
    </tr>

    <tr id="tr_products_cart" style="display:none;">
      <td colspan="3">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_1),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX_0));
              echo $html->radio("products_qty_box_status", MODULE_EASY_ADMIN_PRODUCTS_HEADING_QTY_BOX, $option, $product['products_qty_box_status']);
            ?>
          </tr>

          <tr>
            <?php
              echo $html->text("products_quantity_order_min", MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MIN, $product['products_quantity_order_min']);
            ?>
          </tr>

          <tr>
            <?php
              echo $html->text("products_quantity_order_max", MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX, $product['products_quantity_order_max'], "", MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_MAX_NOTE);
            ?>
          </tr>

          <tr>
            <?php
              echo $html->text("products_quantity_order_units", MODULE_EASY_ADMIN_PRODUCTS_HEADING_ORDER_UNIT, $product['products_quantity_order_units']);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("products_quantity_mixed", MODULE_EASY_ADMIN_PRODUCTS_HEADING_QUANTITY_MIX, $option, $product['products_quantity_mixed']);
            ?>
          </tr>
        </table>
      </td>
    </tr>

    <!-- SEO設定 -->
    <tr>
      <td><?php echo zen_draw_separator('pixel_trans.gif', 0, 20); ?><td>
    </tr>

    <tr>
      <td colspan="2">
        <?php echo MODULE_EASY_ADMIN_PRODUCTS_SEO_TITLE; ?>
      </td>
      <td>
        <a id="a_products_seo" href="javascript:void()" onclick="toggle_detail('products_seo');">
          <?php echo MODULE_EASY_ADMIN_PRODUCTS_OPEN; ?>
        </a>
      </td>
    </tr>

    <tr id="tr_products_seo" style="display:none;">
      <td colspan="3">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("metatags_products_name_status", MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE, $option, $product['metatags_products_name_status'], MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_TITLE_NOTE.MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_NAME);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("metatags_title_status", "", $option, $product['metatags_title_status'], MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TITLE);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("metatags_model_status", "", $option, $product['metatags_model_status'], MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_MODEL);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("metatags_price_status", "", $option, $product['metatags_price_status'], MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_PRICE);
            ?>
          </tr>

          <tr>
            <?php
              $option = array(array('id' => 1, 'text' => MODULE_EASY_ADMIN_PRODUCTS_YES),
                              array('id' => 0, 'text' => MODULE_EASY_ADMIN_PRODUCTS_NO));
              echo $html->radio("metatags_title_tagline_status", "", $option, $product['metatags_title_tagline_status'], MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAGLINE);
            ?>
          </tr>
        </table>

        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php echo zen_draw_separator('pixel_trans.gif', 0, 10); ?><td>
          </tr>

          <tr>
            <td></td>
            <td></td>
            <td>
              <?php echo MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_IMMIDIATE; ?>
            </td>
          </tr>

          <?php
            foreach($product['meta_tags_products_description_metatags_title'] as $k => $v) {
          ?>
            <tr>
              <?php
                $flag  = $model->language_flag($languages, $k);
                echo $html->textarea("meta_tags_products_description_metatags_title[".$k."]", "", $v, $flag);
              ?>
            </tr>
          <?php } ?>

          <?php
            $first = true;
            foreach($product['meta_tags_products_description_metatags_keywords'] as $k => $v) {
          ?>
            <tr>
              <?php
                $title = ($first)?MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_KEYWORD:"";
                $flag  = $model->language_flag($languages, $k);
                echo $html->textarea("meta_tags_products_description_metatags_keywords[".$k."]", $title, $v, $flag);
                $first = false;
              ?>
            </tr>
          <?php } ?>

          <?php
            $first = true;
            foreach($product['meta_tags_products_description_metatags_description'] as $k => $v) {
          ?>
            <tr>
              <?php
                $title = ($first)?MODULE_EASY_ADMIN_PRODUCTS_HEADING_META_TAG_DESCRIPTION:"";
                $flag  = $model->language_flag($languages, $k);
                echo $html->textarea("meta_tags_products_description_metatags_description[".$k."]", $title, $v, $flag);
                $first = false;
              ?>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_SAVE; ?>">
      </td>
    </tr>

  </table>
</form>
