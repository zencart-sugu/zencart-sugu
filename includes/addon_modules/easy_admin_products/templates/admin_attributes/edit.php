<script type="text/javascript">
  var options_id_default = '<?php echo $options_id_default ?>';
  var options_values_id_default = '<?php echo $options_values_id_default ?>';
  var products_options = <?php print $model->toJSON($options_for_json); ?>;
  var open_setting_label = '<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?>';
  var close_setting_label = '<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CLOSE_SETTING ?>';

  $(document).ready(function() {
    $('#list_options').change(function() {
      var options_id = $('#list_options').val();
      change_list_options_values(options_id);
    });
    set_toggle_event('price_factor_setting');
    set_toggle_event('qty_prices_setting');
    set_toggle_event('price_words_setting');
    set_toggle_event('image_setting');
    set_toggle_event('download_setting');

    change_list_options_values(options_id_default);
<?php if ($open_price_factor_setting) { ?>
    open_setting('price_factor_setting');
<?php } ?>
<?php if ($open_qty_prices_setting) { ?>
    open_setting('qty_prices_setting');
<?php } ?>
<?php if ($open_price_words_setting) { ?>
    open_setting('price_words_setting');
<?php } ?>
<?php if ($open_image_setting) { ?>
    open_setting('image_setting');
<?php } ?>
<?php if ($open_download_setting) { ?>
    open_setting('download_setting');
<?php } ?>
  });

  function set_toggle_event(name) {
    $('#toggle_'+ name).click(function() {
      if ($('#'+ name).css('display') == 'none') {
        open_setting(name);
      }else{
        close_setting(name);
      }
    });
  }

  function open_setting(name) {
    $('#toggle_'+ name).html(close_setting_label);
    $('#'+ name).show(350);
  }

  function close_setting(name) {
    $('#toggle_'+ name).html(open_setting_label);
    $('#'+ name).hide(350);
  }

  function change_list_options_values(options_id) {
    if (products_options[options_id] && products_options[options_id]['require_value']) {
      ajax_get_options_values(options_id);
      $('.option_value_setting').show();
    }else{
      $('.option_value_setting').hide();
    }
  }

  function ajax_get_options_values(options_id) {
    $.ajax({
      type: "GET",
      url: "<?php echo $html->href_link(); ?>",
      data: "module=easy_admin_products/ajax_get_options_values&options_id="+ options_id,
      success: function(json) {
        $('#list_options_values').empty();
        var data = eval('('+json+')');
        if (data.result == 'ok') {
          $option_entries = new Array();
          $.each(data.response, function(i) {
            var selected = (options_values_id_default == data.response[i]['id']) ? ' selected' : '';
            $option_entries.push('<option value="'+ data.response[i]['id'] +'"'+ selected +'>'+ data.response[i]['label'] +'</option>');
          });
          $('#list_options_values').append($option_entries.join());
        }
      }
    });
  }
</script>
<h2><?php echo $edit_mode ? MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_EDIT_TITLE : MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_TITLE ?></h2>

<?php echo $html->form('form_attributes', 'attributes', 'enctype="multipart/form-data"'); ?>
<input type="hidden" name="action" value="save" />
<input type="hidden" name="products_id" value="<?php echo $products_id ?>" />
<input type="hidden" name="attributes_id" value="<?php echo $attributes_id ?>" />

<!--option setting-->
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_SETTING ?></h3>
<div id="option_setting">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_NAME ?></th>
    <th class="option_value_setting" style="display:none;"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPTION_VALUE ?></th>
  </tr>
  <tr>
    <td>
      <?php print zen_draw_pull_down_menu("options_id", $products_options, $options_id_default, 'id="list_options" size="5"'); ?><br />
      <a href="<?php echo zen_href_link(FILENAME_OPTIONS_NAME_MANAGER); ?>"><?php echo $html->image(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_NAME_BTN, MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_NAME); ?></a>
      </div>
    </td>
    <td class="option_value_setting" style="display:none;">
      <select id="list_options_values" name="options_values_id" size="5"></select><br />
      <a href="<?php echo zen_href_link(FILENAME_OPTIONS_VALUES_MANAGER); ?>"><?php echo $html->image(MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_VALUE_BTN, MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT_OPTION_VALUE); ?></a>
    </td>
  </tr>
</table>
</div>

<!--price and weight setting-->
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_AND_WEIGHT_SETTING ?></h3>
<div id="price_and_weight_setting">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE ?>:</th>
    <td>
      <?php echo zen_draw_input_field('options_values_price', $attribute['options_values_price']); ?>
      <?php echo zen_draw_pull_down_menu("price_prefix", $price_prefix_options, $attribute['price_prefix']); ?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_WEIGHT ?>:</th>
    <td>
      <?php echo zen_draw_input_field('products_attributes_weight', $attribute['products_attributes_weight']); ?>
      <?php echo zen_draw_pull_down_menu("products_attributes_weight_prefix", $weight_prefix_options, $attribute['products_attributes_weight_prefix']); ?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_SORT_ORDER ?>:</th>
    <td>
      <?php echo zen_draw_input_field('products_options_sort_order', $attribute['products_options_sort_order']); ?>
    </td>
  </tr>
</table>
</div>

<!--status setting-->
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_STATUS_SETTING ?></h3>
<div id="status_setting">
<table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DISPLAY_ONLY ?></th>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRODUCT_ATTRIBUTE_IS_FREE ?></th>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DEFAULT ?></th>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_DISCOUNTED ?></th>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_PRICE_BASE_INCLUDED ?></th>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_ATTRIBUTES_REQUIRED ?></th>
  </tr>
  <tr>
    <td nowrap><?php echo $html->onoff_radio('attributes_display_only', $attribute['attributes_display_only']); ?></td>
    <td nowrap><?php echo $html->onoff_radio('product_attribute_is_free', $attribute['product_attribute_is_free']); ?></td>
    <td nowrap><?php echo $html->onoff_radio('attributes_default', $attribute['attributes_default']); ?></td>
    <td nowrap><?php echo $html->onoff_radio('attributes_discounted', $attribute['attributes_discounted']); ?></td>
    <td nowrap><?php echo $html->onoff_radio('attributes_price_base_included', $attribute['attributes_price_base_included']); ?></td>
    <td nowrap><?php echo $html->onoff_radio('attributes_required', $attribute['attributes_required']); ?></td>
  </tr>
</table>
</div>

<!--price factor setting-->
<?php if (ATTRIBUTES_ENABLED_PRICE_FACTOR == 'true') { ?>
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_SETTING ?>
 <a id="toggle_price_factor_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="price_factor_setting" style="display:none;">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_ONETIME ?>:</th>
    <td><?php echo zen_draw_input_field('attributes_price_onetime', $attribute['attributes_price_onetime']); ?></td>
  </tr>
</table>
<p><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_TITLE ?><a href="#">(?)</a></p>
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR ?>:</th>
    <td><?php echo zen_draw_input_field('attributes_price_factor', $attribute['attributes_price_factor']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_OFFSET ?>:</th>
    <td><?php echo zen_draw_input_field('attributes_price_factor_offset', $attribute['attributes_price_factor_offset']); ?></td>
  </tr>
</table>
<p><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME_TITLE ?><a href="#">(?)</a></p>
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME ?>:</th>
    <td><?php echo zen_draw_input_field('attributes_price_factor_onetime', $attribute['attributes_price_factor_onetime']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_FACTOR_ONETIME_OFFSET ?>:</th>
    <td><?php echo zen_draw_input_field('attributes_price_factor_onetime_offset', $attribute['attributes_price_factor_onetime_offset']); ?></td>
  </tr>
</table>
</div>
<?php
    } else {
      echo zen_draw_hidden_field('attributes_price_factor', $attribute['attributes_price_factor']);
      echo zen_draw_hidden_field('attributes_price_factor_offset', $attribute['attributes_price_factor_offset']);
      echo zen_draw_hidden_field('attributes_price_factor_onetime', $attribute['attributes_price_factor_onetime']);
      echo zen_draw_hidden_field('attributes_price_factor_onetime_offset', $attribute['attributes_price_factor_onetime_offset']);
    } // ATTRIBUTES_ENABLED_PRICE_FACTOR
?>

<!--qty prices setting-->
<?php if (ATTRIBUTES_ENABLED_QTY_PRICES == 'true') { ?>
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES_SETTING ?> <a id="toggle_qty_prices_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="qty_prices_setting" style="display:none;">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES ?><a href="#">(?)</a></th>
    <td><?php echo zen_draw_input_field('attributes_qty_prices', $attribute['attributes_qty_prices']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_QTY_PRICES_ONETIME ?><a href="#">(?)</a></th>
    <td><?php echo zen_draw_input_field('attributes_qty_prices_onetime', $attribute['attributes_qty_prices_onetime']); ?></td>
  </tr>
</table>
</div>
<?php
    } else {
      echo zen_draw_hidden_field('attributes_qty_prices', $attribute['attributes_qty_prices']);
      echo zen_draw_hidden_field('attributes_qty_prices_onetime', $attribute['attributes_qty_prices_onetime']);
    } // ATTRIBUTES_ENABLED_QTY_PRICES
?>

<!--price words setting-->
<?php if (ATTRIBUTES_ENABLED_TEXT_PRICES == 'true') { ?>
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS_SETTING ?> <a id="toggle_price_words_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="price_words_setting" style="display:none;">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS ?></th>
    <td><?php echo zen_draw_input_field('attributes_price_words', $attribute['attributes_price_words']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_WORDS_FREE ?></th>
    <td><?php echo zen_draw_input_field('attributes_price_words_free', $attribute['attributes_price_words_free']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_LETTERS ?></th>
    <td><?php echo zen_draw_input_field('attributes_price_letters', $attribute['attributes_price_letters']); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_PRICE_LETTERS_FREE ?></th>
    <td><?php echo zen_draw_input_field('attributes_price_letters_free', $attribute['attributes_price_letters_free']); ?></td>
  </tr>
</table>
</div>
<?php
    } else {
      echo zen_draw_hidden_field('attributes_price_words', $attribute['attributes_price_words']);
      echo zen_draw_hidden_field('attributes_price_words_free', $attribute['attributes_price_words_free']);
      echo zen_draw_hidden_field('attributes_price_letters', $attribute['attributes_price_letters']);
      echo zen_draw_hidden_field('attributes_price_letters_free', $attribute['attributes_price_letters_free']);
    } // ATTRIBUTES_ENABLED_TEXT_PRICES
?>

<!--image setting-->
<?php if (ATTRIBUTES_ENABLED_IMAGES == 'true') { ?>
<?php
  // attributes images
  $dir = @dir(DIR_FS_CATALOG_IMAGES);
  $dir_info[] = array('id' => '', 'text' => "Main Directory");
  while ($file = $dir->read()) {
    if (is_dir(DIR_FS_CATALOG_IMAGES . $file) && strtoupper($file) != 'CVS' && $file != "." && $file != "..") {
      $dir_info[] = array('id' => $file . '/', 'text' => $file);
    }
  }

  sort($dir_info);

  if ($attribute['attributes_image'] != '') {
    $default_directory = substr( $attribute['attributes_image'], 0,strpos( $attribute['attributes_image'], '/')+1);
  } else {
    $default_directory = 'attributes/';
  }
?>
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_SETTING ?> <a id="toggle_image_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="image_setting" style="display:none;">
<?php echo ($attribute['attributes_image'] != '' ? zen_image(DIR_WS_CATALOG_IMAGES . $attribute['attributes_image']) : ''); ?>
<table>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE ?>:</th>
    <td>
      <?php echo zen_draw_file_field('attributes_image'); ?>
      <?php echo zen_draw_hidden_field('attributes_previous_image', $attribute['attributes_image']); ?>
    </td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_DIR ?>:</th>
    <td><?php echo zen_draw_pull_down_menu('img_dir', $dir_info, $default_directory); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_OVERWRITE ?>:</th>
    <td>
      <?php echo zen_draw_radio_field('overwrite', '0', $off_overwrite) . '&nbsp;' . TABLE_HEADING_NO . ' ' . zen_draw_radio_field('overwrite', '1', $on_overwrite) . '&nbsp;' . TABLE_HEADING_YES; ?>
    </td>
  </tr>
</table>
<p><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_IMAGE_OVERWRITE_DESCRIPTION ?></p>
</div>
<?php
    } else {
      echo zen_draw_hidden_field('attributes_previous_image', $attribute['attributes_image']);
      echo zen_draw_hidden_field('attributes_image', $attribute['attributes_image']);
    } // ATTRIBUTES_ENABLED_IMAGES
?>

<!--download setting-->
<?php if (DOWNLOAD_ENABLED == 'true') { ?>
<h3><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_DOWNLOAD_SETTING ?> <a id="toggle_download_setting" href="javascript:void(0)"><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_OPEN_SETTING ?></a></h3>
<div id="download_setting" style="display:none;">
<table border="0" class="tableLayout3" cellspacing="0" cellpadding="0">
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FILENAME ?></th>
    <td><?php echo zen_draw_input_field('products_attributes_filename', $attribute['products_attributes_filename'], zen_set_field_length(TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD, 'products_attributes_filename', 35)); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAXDAYS ?></th>
    <td><?php echo zen_draw_input_field('products_attributes_maxdays', $attribute['products_attributes_maxdays'], 'size="5"'); ?></td>
  </tr>
  <tr>
    <th><?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAXCOUNT ?></th>
    <td><?php echo  zen_draw_input_field('products_attributes_maxcount', $attribute['products_attributes_maxcount'], 'size="5"'); ?></td>
  </tr>
</table>
<?php } // DOWNLOAD_ENABLED ?>
</div>


<!--action buttons-->
<div>
<?php if ($edit_mode) { ?>
  <input type="submit" id="btn_submit_attribute_edit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_UPDATE ?>">
<?php }else{ ?>
  <input type="submit" id="btn_submit_attribute_edit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_INSERT ?>">
<?php } ?>
  <input type="button" id="btn_cancel_attribute_edit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_CANCEL ?>">
</div>

</form>
