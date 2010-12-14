<?php
if ($_SESSION['languages_code'] == 'ja') {
  if (!empty($template_dir)) {
    $GLOBALS['jscripts'] .= '<script type="text/javascript"><!--
var JSONDATA = \''.$template_dir.'/ajaxzip2/data\';
//--></script>'."\n";
    $GLOBALS['jscripts'] .= '<script type="text/javascript" src="'.$template_dir.'/ajaxzip2/ajaxzip2.js" charset="UTF-8"></script>'."\n";
    $GLOBALS['jscripts'] .= '<script type="text/javascript"><!--
  '.JQUERY_ALIAS.'(document).ready(function(){
    '.JQUERY_ALIAS.'("#postcode").keyup(function(){AjaxZip2.zip2addr(this, "state", "city", null, "addr", "street_address")});
    '.JQUERY_ALIAS.'("#postcode").blur(function(){AjaxZip2.zip2addr(this, "state", "city", null, "addr", "street_address")});
  });
//--></script>'."\n";
  }
} // end of SESSION['language']
/*
else {
  $GLOBALS['jscripts'] .= '<script type="text/javascript"><!--
  var AjaxZip2 = {};
  AjaxZip2.zip2addr = function() {return false;};
//--></script>'."\n";
}
*/
?>