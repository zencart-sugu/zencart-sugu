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
$(document).ready(function() {
  $("#slider-range").slider({
    range:  true,
    min:    <?php echo (int)$min_value ?>,
    max:    <?php echo (int)$max_value ?>,
    values: [ <?php echo (int)$price_from ?>, <?php echo (int)$price_to ?> ],
    slide: function(event, ui) {
      $('#price_from').val(ui.values[0]);
      $('#price_to').val(ui.values[1]);
    }
  });
});
//-->
</script>
</head>
<body>

<?php if ($products_exists) { ?>
  <?php
  echo zen_draw_form('super_products_list_price_form', zen_href_link(FILENAME_ADDON, 'module=super_products_list/results', 'SSL'), 'get', 'id="super_products_list_price_form" onsubmit="return check_form();" target="_parent"');
  echo zen_draw_hidden_field('main_page', FILENAME_ADDON);
  echo zen_draw_hidden_field('module', 'super_products_list/results');
  echo zen_draw_hidden_field("keywords", $keywords, 'id="keywords"');
  echo zen_draw_hidden_field("categories_id", $categories_id, 'id="categories_id"');
  echo zen_draw_hidden_field("manufacturers_id", $manufacturers_id, 'id="manufacturers_id"');
  echo zen_draw_hidden_field("date_from", $date_from, 'id="date_from"');
  echo zen_draw_hidden_field("date_to", $date_to, 'id="date_to"');
  echo zen_draw_hidden_field("sort", $sort, 'id="sort"');
  echo zen_draw_hidden_field("limit", $limit, 'id="limit"');
  ?>
  <?php echo $symbol_left ?>
  <input type="text" id="price_from" name="price_from" value="<?php echo zen_output_string_protected($price_from) ?>" />
  <?php echo MODULE_SUPER_PRODUCTS_LIST_TEXT_FROM_TO ?>
  <input type="text" id="price_to" name="price_to" value="<?php echo zen_output_string_protected($price_to) ?>" />
  <?php echo $symbol_right ?>
  <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?>
  </form>

  <div id="slider-range"></div>
<?php }else{ ?>
  <p><?php echo $message ?></p>
<?php } ?>

</body>
</html>
