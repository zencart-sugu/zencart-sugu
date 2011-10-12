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
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>jquery/templates/template_default/jscript/jquery.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_CATALOG . DIR_WS_ADDON_MODULES ?>super_products_list/templates/js/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function() {
  ajax_get_manufacturers(1);
});

function ajax_get_manufacturers(page) {
  $('#paging').hide();
  $('#manufacturers').hide();
  $('#message').html("<?php echo MODULE_SUPER_PRODUCTS_LIST_NOW_LOADING ?>");
  $.ajax({
    type: "GET",
    url: "<?php echo zen_href_link(FILENAME_ADDON, '', 'SSL') ?>",
    data: {
      module:        'super_products_list/ajax_get_manufacturers',
      keywords:      '<?php echo zen_output_string_protected($keywords) ?>',
      categories_id: '<?php echo zen_output_string_protected($categories_id) ?>',
      price_from:    '<?php echo zen_output_string_protected($price_from) ?>',
      price_to:      '<?php echo zen_output_string_protected($price_to) ?>',
      date_from:     '<?php echo zen_output_string_protected($date_from) ?>',
      date_to:       '<?php echo zen_output_string_protected($date_to) ?>',
      page:          page,
      limit:         <?php echo MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_LIST_LIMIT_DEFAULT ?>
    },
    success: function(result) {
      result = eval('('+result+')');

      $('#message').html("");
      $('#paging').html("");
      $('#manufacturers').html("");

      $('#message').html(result.result.message);
      if (result.result == "ok") {
        $.each(result.response.manufacturers, function(i, manufacturer) {
          $('#manufacturers').append('<li><a target="_parent" href="<?php echo zen_href_link(FILENAME_ADDON, 'module=super_products_list/results'. $encoded_params, 'SSL') ?>&manufacturers_id='+ manufacturer.id +'">'+ manufacturer.name +'</a></li>');
        });

        for (var i = 1; i <= result.response.max_page; i++) {
          if (i == page) {
            $('#paging').append('&nbsp;'+ i +'&nbsp;');
          }else{
            $('#paging').append('&nbsp;<a href="javascript:void(0)" onclick="ajax_get_manufacturers('+ i +')">'+ i +'</a>&nbsp;');
          }
        }
      }
      $('#paging').show();
      $('#manufacturers').show();
    }
  });
}
//-->
</script>
</head>
<body>

<p id="message"></p>
<div id="paging"></div>
<ul id="manufacturers"></ul>

</body>
</html>
