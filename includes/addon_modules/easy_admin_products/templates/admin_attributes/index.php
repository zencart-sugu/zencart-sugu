<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<?php
  ob_start();
?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#btn_insert_attribute').click(function() {
      ajax_get_attributes_edit_form(<?php echo $products_id ?>, 0, false);
    });
<?php if ($preload_attributes_edit_form) { ?>
    ajax_get_attributes_edit_form(<?php echo $products_id ?>, <?php echo $attributes_id ?>, true);
<?php } ?>
  });

  function ajax_get_attributes_edit_form(products_id, attributes_id, preload_posted_data) {
    var data = {
      products_id: products_id,
      attributes_id: attributes_id
    };
<?php if (!empty($attribute)) { ?>
    if (preload_posted_data) {
      data['attribute'] = {
<?php
  $js_datas = array();
  foreach ($attribute as $key => $val) {
    $js_datas[] = sprintf("        %s: '%s'", $key, $val);
  }
  print join(",\n", $js_datas) . "\n";
?>
      };
    }
<?php } ?>
    $.ajax({
      type: "POST",
      url: "<?php echo $html->href_link('ajax_get_attributes_edit_form'); ?>",
      data: data,
      success: function(html) {
        // display
        $('#action_buttons').hide();
        $('#attribute_edit_area').html(html);
        $('#attribute_edit_area').show(500);
        if (!preload_posted_data) {
          var targetOffset = $('#attribute_edit_area').offset().top;
          $('html,body').animate({scrollTop: targetOffset}, 500);
        }
        // set event
        $('#btn_cancel_attribute_edit').click(function() {
          $('#attribute_edit_area').hide(500);
          $('#action_buttons').show(500);
        });
      }
    });
  }
</script>

<?php
  echo $html->form('index');
?>
  <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_LIST; ?>">
</form>
<div>
<?php echo TEXT_INFO_ID . $products_id . ' ' . zen_get_products_model($products_id) . ' - ' . zen_get_products_name($products_id); ?>
</div>
<?php
  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_SEARCH_FORM');
?>


<div class="listBox">
<table border="0" class="tableLayout3" width="100%" cellspacing="0" cellpadding="0">
  <?php require(dirname(__FILE__) . '/products_attributes_list.php'); ?>
</table>
</div>

<div class="smallText" align="center">
<?php
  echo $split->display_count($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAX_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS);
  echo "&nbsp;&nbsp;&nbsp;&nbsp;";
  echo $split->display_links($query_numrows, MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_MAX_RESULTS, "", $_GET['page'], "module=easy_admin_products/attributes&products_id=". (int)$_REQUEST['products_id']);
?>
</div>

<div id="action_buttons">
  <input type="button" id="btn_insert_attribute" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_ATTRIBUTES_CREATE; ?>">
<?php echo $html->form('index'); ?>
  <input type="submit" value="<?php echo MODULE_EASY_ADMIN_PRODUCTS_LIST; ?>">
</form>
</div>

<div id="attribute_edit_area">
</div>

<?php
  global $easy_admin_products_attributes_index_screent_html;
  $easy_admin_products_attributes_index_screent_html = ob_get_contents();
  ob_end_clean();

  global $zco_notifier;
  $zco_notifier->notify('NOTIFY_EASY_ADMIN_PRODUCTS_ATTRIBUTES_FINISH_DISPLAY_INDEX');
  print $easy_admin_products_attributes_index_screent_html;
?>
