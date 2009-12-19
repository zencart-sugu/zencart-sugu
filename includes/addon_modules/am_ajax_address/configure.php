<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
define('MODULE_AM_AJAX_ADDRESS_STATUS_DEFAULT',             'true');
define('MODULE_AM_AJAX_ADDRESS_SORT_ORDER_DEFAULT',         '100');

define('MODULE_AM_AJAX_ADDRESS_JSONDATA', '
<script type="text/javascript"><!--
var JSONDATA = \'%s/data\';
//--></script>'."\n");
define('MODULE_AM_AJAX_ADDRESS_AJAXZIP2', '<script type="text/javascript" src="%s/ajaxzip2.js" charset="UTF-8"></script>'."\n");
define('MODULE_AM_AJAX_ADDRESS_ADD_EVENT', '
<script type="text/javascript"><!--
$(document).ready(function(){
  $("#postcode").keyup(function(){AjaxZip2.zip2addr(this, "state", "city", null, "addr", "street_address")});
});
//--></script>'."\n");
?>