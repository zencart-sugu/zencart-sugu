<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/jquery.fancybox-1.3.4.css" media="screen" />

<?php echo zen_draw_form('super_products_list', zen_href_link(FILENAME_ADDON, 'module=super_products_list/results', 'SSL'), 'get', 'id="super_products_list" onsubmit="return check_form();"'); ?>
<?php echo zen_draw_hidden_field('main_page', FILENAME_ADDON); ?>
<?php echo zen_draw_hidden_field('module', 'super_products_list/results'); ?>
<?php echo zen_draw_hidden_field('manufacturers_id', $manufacturers_id, 'id="manufacturers_id"'); ?>
<?php echo zen_draw_hidden_field('price_from', $price_from, 'id="price_from"'); ?>
<?php echo zen_draw_hidden_field('price_to', $price_to, 'id="price_to"'); ?>
<?php echo zen_draw_hidden_field('date_from', $date_from, 'id="date_from"'); ?>
<?php echo zen_draw_hidden_field('date_to', $date_to, 'id="date_to"'); ?>
  <ul>
    <li>keywords: <?php echo zen_draw_input_field('keywords', $keywords, 'id="keywords"'); ?></li>
    <li>categories_id: <?php echo zen_draw_pull_down_menu('categories_id', $categories_options, $categories_id, 'id=categories_id'); ?></li>
    <li>manufacturers: <?php echo $current_manufacturers_name ?> <a href="javascript:void(0)" id="open_manufacturer_setting"><?php echo MODULE_SUPER_PRODUCTS_LIST_OPEN_MANUFACTURER_SETTING ?></a>
    <li>price: <?php echo $price_from_to ?> <a href="javascript:void(0)" id="open_price_setting"><?php echo MODULE_SUPER_PRODUCTS_LIST_OPEN_PRICE_SETTING ?></a>
<?php if (MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE == 'true') { ?>
    <li>date: <?php echo $date_from_to ?> <a href="javascript:void(0)" id="open_date_setting"><?php echo MODULE_SUPER_PRODUCTS_LIST_OPEN_DATE_SETTING ?></a>
<?php } ?>
    <li>sort: <?php echo zen_draw_pull_down_menu("sort", $sort_options, $sort, 'id="sort"'); ?>
              <?php echo zen_draw_pull_down_menu("direction", $direction_options, $direction, 'id="direction"'); ?></li>
    <li>limit: <?php echo zen_draw_pull_down_menu("limit", $limit_options, $limit, 'id="limit"'); ?></li>
  </ul>
<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
</form>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
  $('#open_manufacturer_setting').click(function() {
    if (!check_form()) {
      return false;
    }
    $.fancybox({
      'padding':       0,
      'autoScale':     false,
      'transitionIn':  'none',
      'transitionOut': 'none',
      'width':         '75%',
      'height':        '75%',
      'href':          '<?php echo zen_href_link(FILENAME_ADDON, 'module=super_products_list/manufacturers', 'SSL') ?>' + get_search_params(),
      'type':          'iframe'
    });
  });

  $('#open_price_setting').click(function() {
    if (!check_form()) {
      return false;
    }
    $.fancybox({
      'padding':       0,
      'autoScale':     false,
      'transitionIn':  'none',
      'transitionOut': 'none',
      'width':         '75%',
      'height':        '75%',
      'href':          '<?php echo zen_href_link(FILENAME_ADDON, 'module=super_products_list/price_setting', 'SSL') ?>' + get_search_params(),
      'type':          'iframe'
    });
  });

  $('#open_date_setting').click(function() {
    if (!check_form()) {
      return false;
    }
    $.fancybox({
      'padding':       0,
      'autoScale':     false,
      'transitionIn':  'none',
      'transitionOut': 'none',
      'width':         '75%',
      'height':        '75%',
      'href':          '<?php echo zen_href_link(FILENAME_ADDON, 'module=super_products_list/date_setting', 'SSL') ?>' + get_search_params(),
      'type':          'iframe'
    });
  });
});

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
