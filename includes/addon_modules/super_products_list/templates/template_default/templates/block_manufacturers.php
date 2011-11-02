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
      limit_manufacturers: <?php echo MODULE_SUPER_PRODUCTS_LIST_MANUFACTURERS_LIST_LIMIT_DEFAULT ?>
    },
    success: function(result) {
      $('#message').html("");
      $('#paging').html("");
      $('#manufacturers').html("");

      $('#message').html(result.message);
      if (result.result == "ok") {
        $.each(result.response.manufacturers, function(i, manufacturer) {
          $('#manufacturers').append('<li><a href="javascript:void(0)" onclick="set_manufacturer(\''+ manufacturer.id +'\',\''+ manufacturer.name +'\')">'+ manufacturer.name +'</a></li>');
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

<p id="message"></p>
<div id="paging"></div>
<ul id="manufacturers"></ul>
