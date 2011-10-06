<?php echo zen_draw_form('super_products_list', zen_href_link(FILENAME_ADDON, 'module=super_products_list/results', 'SSL'), 'get', 'onsubmit="return check_form();"'); ?>
<?php echo zen_draw_hidden_field('main_page', FILENAME_ADDON); ?>
<?php echo zen_draw_hidden_field('module', 'super_products_list/results'); ?>
  <ul>
    <li>keywords: <?php echo zen_draw_input_field('keywords', $keywords); ?></li>
    <li>categories_id: <?php echo zen_draw_pull_down_menu('categories_id', $categories_options, $categories_id); ?></li>
    <li>manufacturers_id: <?php echo zen_draw_pull_down_menu('manufacturers_id', $manufacturers_options, $manufacturers_id); ?></li>
    <li>price_from: <?php echo zen_draw_input_field('price_from', $price_from); ?></li>
    <li>price_to: <?php echo zen_draw_input_field('price_to', $price_to); ?></li>
<?php if (MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE == 'true') { ?>
    <li>date_from: <?php echo zen_draw_input_field('date_from', $date_from); ?></li>
    <li>date_to: <?php echo zen_draw_input_field('date_to', $date_to); ?></li>
<?php } ?>
    <li>sort: <?php echo zen_draw_pull_down_menu("sort", $sort_options, $sort, ''); ?>
              <?php echo zen_draw_pull_down_menu("direction", $direction_options, $direction, ''); ?></li>
    <li>limit: <?php echo zen_draw_pull_down_menu("limit", $limit_options, $limit, ''); ?></li>
  </ul>
<?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
</form>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript">
<!--
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
    if (price_from.value > price_to.value) {
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
