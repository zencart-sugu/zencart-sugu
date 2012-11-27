<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/themes/base/jquery.ui.all.css">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/ui-lightness/jquery-ui-1.8.16.custom.css">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/jquery.bubblepopup.v2.3.1.css" media="screen" />
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.slider.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/jquery.bubblepopup.v2.3.1.min.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
  $(document).mousedown(function(event) {
    checkExternalClick(event, $('#open_manufacturer_setting'));
    checkExternalClick(event, $('#price_setting'));
  });

  $('#open_manufacturer_setting').CreateBubblePopup({
    themePath: '<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/jquerybubblepopup-theme/',
    themeName: 'azure',
    width: 400,
    height: 200,
    selectable: true,
    innerHtml: 'Loading...',
    manageMouseEvents: false,
    afterShown: function() {
      $.get('<?php echo zen_href_link(FILENAME_ADDON, '', $request_type) ?>' + '&module=super_products_list/manufacturers' + get_search_params(), function(data) {
        $('#open_manufacturer_setting').SetBubblePopupInnerHtml(data, false);
      });
    }
  });
  $('#open_manufacturer_setting').click(function() {
    $('#open_manufacturer_setting').ShowBubblePopup();
  });

  $('#price_setting').CreateBubblePopup({
    themePath: '<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/jquerybubblepopup-theme/',
    themeName: 'azure',
    width: 300,
    height: 100,
    selectable: true,
    innerHtml: '<?php echo $currencies->format($min_price) ?> - <?php echo $currencies->format($max_price) ?><div id="price_slider">',
    manageMouseEvents: false,
    afterShown: function() {
      $('#price_slider').slider({
        range:  true,
        step:   100,
        min:    <?php echo (int)$min_price ?>,
        max:    <?php echo (int)$max_price ?>,
        values: [
          ($('#price_from').val() != '' ? parseInt($('#price_from').val()) : <?php echo (int)$min_price ?>),
          ($('#price_to').val() != '' ? parseInt($('#price_to').val()) : <?php echo (int)$max_price ?>),
        ],
        slide: function(event, ui) {
          $('#price_from').val(ui.values[0]);
          $('#price_to').val(ui.values[1]);
        }
      });
    }
  });
  $('#price_setting').click(function() {
    $('#price_setting').ShowBubblePopup();
  });

  $('#date_from').datepicker({
<?php if (zen_not_null($min_date)) { ?>
    minDate: new Date(<?php echo (int)$min_date_yy?>, <?php echo (int)$min_date_mm - 1 ?>, <?php echo (int)$min_date_dd ?>),
<?php } ?>
<?php if (zen_not_null($max_date)) { ?>
    maxDate: new Date(<?php echo (int)$max_date_yy?>, <?php echo (int)$max_date_mm - 1 ?>, <?php echo (int)$max_date_dd ?>),
<?php } ?>
<?php if (zen_not_null($date_from)) { ?>
    defaultDate: new Date(<?php echo $date_from_yy?>, <?php echo $date_from_mm - 1 ?>, <?php echo $date_from_dd ?>),
<?php } ?>
    changeYear: true,
    changeMonth: true,
    dateFormat: 'yy/mm/dd'
  });

  $('#date_to').datepicker({
<?php if (zen_not_null($min_date)) { ?>
    minDate: new Date(<?php echo (int)$min_date_yy?>, <?php echo (int)$min_date_mm - 1 ?>, <?php echo (int)$min_date_dd ?>),
<?php } ?>
<?php if (zen_not_null($max_date)) { ?>
    maxDate: new Date(<?php echo (int)$max_date_yy?>, <?php echo (int)$max_date_mm - 1 ?>, <?php echo (int)$max_date_dd ?>),
<?php } ?>
<?php if (zen_not_null($date_to)) { ?>
    defaultDate: new Date(<?php echo $date_to_yy?>, <?php echo $date_to_mm - 1 ?>, <?php echo $date_to_dd ?>),
<?php } ?>
    changeYear: true,
    changeMonth: true,
    dateFormat: 'yy/mm/dd'
  });

  $('#reset_manufacturer_setting').click(function() {
    $('#reset_manufacturer_setting').hide();
    $('#manufacturers_id').val("");
    $('#current_manufacturers_name').html("");
  });
});

function checkExternalClick(event, popup) {
  var popup_id = popup.GetBubblePopupID();
  var $target = $(event.target);
  if ($target[0].id != popup_id &&
      $target.parents('#' + popup_id).length == 0) {
    popup.HideBubblePopup();
  } 
}

function set_manufacturer(id, name) {
  $('#manufacturers_id').val(id);
  $('#current_manufacturers_name').html(name);
  $('#open_manufacturer_setting').HideBubblePopup();
  $('#reset_manufacturer_setting').show();
}

function get_search_params() {
  return '&keywords='+ encodeURIComponent($('#keywords').val()) +
         '&categories_id='+ encodeURIComponent($('#categories_id').val()) +
         '&manufacturers_id='+ encodeURIComponent($('#manufacturers_id').val()) +
         '&price_from='+ encodeURIComponent($('#price_from').val()) +
         '&price_to='+ encodeURIComponent($('#price_to').val()) +
         '&date_from='+ encodeURIComponent($('#date_from').val()) +
         '&date_to='+ encodeURIComponent($('#date_to').val()) +
         '&sort='+ encodeURIComponent($('#sort').val()) +
         '&direction='+ encodeURIComponent($('#direction').val()) +
         '&limit='+ encodeURIComponent($('#limit').val());
}

function check_form() {
  // elements
  var price_from = document.super_products_list.elements['price_from'];
  var price_to   = document.super_products_list.elements['price_to'];
  var date_from  = document.super_products_list.elements['date_from'];
  var date_to    = document.super_products_list.elements['date_to'];

  // zen2han and replace not numeric chars
  price_from.value = zen2han(price_from.value).replace(/[^0-9]/g, "");
  price_to.value   = zen2han(price_to.value).replace(/[^0-9]/g, "");
  date_from.value  = zen2han(date_from.value).replace(/[^0-9]/g, "/");
  date_to.value    = zen2han(date_to.value).replace(/[^0-9]/g, "/");

  var errors = [];
  var price_check_error = false;
  if (price_from.value != '' && isNaN(price_from.value)) {
    price_check_error = true;
    errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_FROM_MUST_BE_NUM ?>');
  }
  if (price_to.value != '' && isNaN(price_to.value)) {
    price_check_error = true;
    errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_MUST_BE_NUM ?>');
  }
  if (price_check_error == false && price_from.value != '' && price_to.value != '') {
    if (parseInt(price_from.value) > parseInt(price_to.value)) {
      errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_PRICE_TO_LESS_THAN_PRICE_FROM ?>');
    }
  }
  var date_check_error = false;
  if (date_from.value != '' && !IsValidDate(date_from.value, 'yyyy/mm/dd')) {
    date_check_error = true;
    errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_FROM_DATE ?>');
  }
  if (date_to.value != '' && !IsValidDate(date_to.value, 'yyyy/mm/dd')) {
    date_check_error = true;
    errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_INVALID_TO_DATE ?>');
  }
  if (date_check_error == false && date_from.value != '' && date_to.value != '') {
    if (!CheckDateRange(date_from, date_to)) {
      errors.push('* <?php echo MODULE_SUPER_PRODUCTS_LIST_ERROR_TO_DATE_LESS_THAN_FROM_DATE ?>');
    }
  }

  if (errors.length > 0) {
    alert(errors.join("\n"));
    return false;
  }

  return true;
}

function zen2han(val) {
  var han = '<?php echo MODULE_SUPER_PRODUCTS_LIST_HANKAKU_STRINGS ?>';
  var zen = '<?php echo MODULE_SUPER_PRODUCTS_LIST_ZENKAKU_STRINGS ?>';
  var to = [];
  for (i = 0; i < val.length; i++) {
    for (j = 0; j < zen.length; j++) {
      if (val.charAt(i) == zen[j]) {
        to.push(han[j]);
        break;
      }
    }
    if (j == zen.length) {
      to.push(val.charAt(i));
    }
  }
  return to.join('');
}
//-->
</script>

<noscript>
<h3><?php echo MODULE_SUPER_PRODUCTS_LIST_NOSCRIPT_WARNING ?></h3>
</noscript>

<?php echo zen_draw_form('super_products_list', zen_href_link(FILENAME_ADDON, 'module=super_products_list/results', $request_type), 'get', 'id="super_products_list" onsubmit="return check_form();"'); ?>
<?php echo zen_draw_hidden_field('main_page', FILENAME_ADDON); ?>
<?php echo zen_draw_hidden_field('module', 'super_products_list/results'); ?>
<?php echo zen_draw_hidden_field('categories_id', $categories_id, 'id="categories_id"'); ?>
<?php echo zen_draw_hidden_field('manufacturers_id', $manufacturers_id, 'id="manufacturers_id"'); ?>
  <ul>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_KEYWORDS ?>: <?php echo zen_draw_input_field('keywords', $keywords, 'id="keywords"'); ?></li>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_MANUFACTURER ?>:
      <span id="current_manufacturers_name"><?php echo $current_manufacturers_name ?></span>
      <a href="javascript:void(0)" id="open_manufacturer_setting"><?php echo MODULE_SUPER_PRODUCTS_LIST_OPEN_MANUFACTURER_SETTING ?></a>
      <a href="javascript:void(0)" id="reset_manufacturer_setting" style="display: <?php echo $manufacturers_id ? 'inline' : 'none' ?>;"><?php echo MODULE_SUPER_PRODUCTS_LIST_RESET_SETTING ?></a>
    </li>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_PRICE ?>: 
      <span id="price_setting">
      <?php echo $symbol_left ?><input type="text" id="price_from" name="price_from" value="<?php echo $price_from ?>" /><?php echo $symbol_right ?>
      <?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO ?>
      <?php echo $symbol_left ?><input type="text" id="price_to" name="price_to" value="<?php echo $price_to ?>" /><?php echo $symbol_right ?>
      </span>
    </li>
<?php if (MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE == 'true') { ?>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_DATE ?>:
      <?php echo zen_draw_input_field('date_from', $date_from, 'id="date_from"'); ?>
      <?php echo zen_draw_input_field('date_to', $date_to, 'id="date_to"'); ?>
    </li>
<?php } ?>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_SORT ?>: 
      <?php echo zen_draw_pull_down_menu("sort", $sort_options, $sort, 'id="sort"'); ?>
      <?php echo zen_draw_pull_down_menu("direction", $direction_options, $direction, 'id="direction"'); ?>
    </li>
    <li><?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_LIMIT ?>: 
      <?php echo zen_draw_pull_down_menu("limit", $limit_options, $limit, 'id="limit"'); ?>
    </li>
    <li>
      <?php echo zen_draw_checkbox_field('featured', 1, $featured, 'id=featured'); ?>
      <?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_FEATURED ?>
    </li>
    <li>
      <?php echo zen_draw_checkbox_field('specials', 1, $specials, 'id=specials'); ?>
      <?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_SPECIALS ?>
    </li>
  </ul>
<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
</form>
