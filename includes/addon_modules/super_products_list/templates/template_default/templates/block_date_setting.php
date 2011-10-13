<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="The Zen Cart&trade; Team and others" />
<meta name="generator" content="shopping cart program by Zen Cart&trade;, http://www.zen-cart.com" />
<meta name="robots" content="noindex, nofollow" />
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />
<link rel="stylesheet" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/css/ui-lightness/jquery-ui-1.8.16.custom.css">
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>jquery/templates/template_default/jscript/jquery.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/ui/jquery.ui.slider.js"></script>
<script type="text/javascript">
<!--
var $g = {
  values: {
    MAX:  500,	// px
    DAYS: <?php echo (int)$days ?>,
    START_DATE: [<?php echo $start_date[0] ?>, <?php echo $start_date[1] ?>, <?php echo $start_date[2] ?>]
  }
};

$(document).ready(function() {
  $("#slider-range").slider({
    range:  true,
    min:    0,
    max:    $g.values.MAX,
    values: [ convertSliderValFromDay(<?php echo $date_from_days ?>), convertSliderValFromDay(<?php echo $date_to_days ?>) ],
    step: Math.floor($g.values.MAX / $g.values.DAYS),
    slide: function(event, ui) {
      $('#date_from').val(convertSliderToDate(ui.values[0]));
      $('#date_to').val(convertSliderToDate(ui.values[1]));
    }
  });
});

function convertSliderValFromDay(day) {
  return Math.floor($g.values.MAX * day / $g.values.DAYS);
}

function convertSliderToDate(val) {
  var day = Math.ceil($g.values.DAYS * val / $g.values.MAX);
  var date = new Date($g.values.START_DATE[0], $g.values.START_DATE[1] - 1, $g.values.START_DATE[2] + day);
  var yy = date.getFullYear();
  var mm = date.getMonth() + 1;
  if (mm < 10) {
    mm = '0' + mm;
  }
  var dd = date.getDate();
  if (dd < 10) {
    dd = '0' + dd;
  }
  return yy +"/"+ mm +"/"+ dd;
}
//-->
</script>
</head>
<body>

<?php if ($products_exists) { ?>
  <?php
  echo zen_draw_form('super_products_list_date_form', zen_href_link(FILENAME_ADDON, 'module=super_products_list/results', 'SSL'), 'get', 'id="super_products_list_date_form" onsubmit="return check_form();" target="_parent"');
  echo zen_draw_hidden_field('main_page', FILENAME_ADDON);
  echo zen_draw_hidden_field('module', 'super_products_list/results');
  echo zen_draw_hidden_field("keywords", $keywords, 'id="keywords"');
  echo zen_draw_hidden_field("categories_id", $categories_id, 'id="categories_id"');
  echo zen_draw_hidden_field("manufacturers_id", $manufacturers_id, 'id="manufacturers_id"');
  echo zen_draw_hidden_field("price_from", $price_from, 'id="price_from"');
  echo zen_draw_hidden_field("price_to", $price_to, 'id="price_to"');
  echo zen_draw_hidden_field("sort", $sort, 'id="sort"');
  echo zen_draw_hidden_field("limit", $limit, 'id="limit"');
  ?>
  <input type="text" id="date_from" name="date_from" value="<?php echo zen_output_string_protected($date_from) ?>" />
  <?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO ?>
  <input type="text" id="date_to" name="date_to" value="<?php echo zen_output_string_protected($date_to) ?>" />
  <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
  </form>
  <div id="slider-range"></div>
<?php }else{ ?>
  <p><?php echo $message ?></p>
<?php } ?>

</body>
</html>
