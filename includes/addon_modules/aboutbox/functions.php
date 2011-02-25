<?php
function aboutbox_get_payment_enabled($text = 'TEXT_') {
  global $db;
  $module_payment_installed = MODULE_PAYMENT_INSTALLED;
  if (!empty($module_payment_installed)) {
    $modules = array();
    $modules_array = split(';', $module_payment_installed);
    for ($i=0, $n=sizeof($modules_array); $i<$n; $i++) {
      $module_name = substr($modules_array[$i], 0, strrpos($modules_array[$i], '.'));
      $sql = 'SELECT configuration_id FROM ' . TABLE_CONFIGURATION . ' WHERE configuration_key RLIKE \'MODULE_PAYMENT_'.strtoupper($module_name).'_STATUS\' AND configuration_value=\'True\'';
      $status = $db->Execute($sql);
      if (!$status->EOF) {
	$module_constant_name = 'MODULE_PAYMENT_'.strtoupper($module_name).'_TEXT_TITLE';
	if (!defined($module_constant_name)) {
	  require_once(DIR_WS_LANGUAGES.$_SESSION['language'].'/modules/payment/'.$module_name.'.php');
	}
	$modules[] = constant($module_constant_name);
      }
    }
    return $modules;
  }
}

function zen_cfg_textarea_aboutbox($text, $key = '') {
  $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');
  return zen_draw_textarea_field($name, false, 60, 10, $text);
}

function aboutbox_install($cfg_keys) {
  global $db;
  foreach($cfg_keys as $rowdata) {
    zen_m17n_backup_configuration($rowdata['m17n_configuration_key'],$rowdata['set_function_backup'],$rowdata['use_function_backup']);
    $set_func = zen_m17n_select_function($rowdata['set_function_backup'],'[configuration]['.$rowdata['m17n_configuration_key'].']') ;
    zen_m17n_update_configuration($rowdata['m17n_configuration_key'],$set_func);
  }
}

function aboutbox_remove($cfg_keys) {
  global $db;
  $db->Execute("DELETE FROM " . TABLE_M17N_CONFIGURATION_KEYS . " WHERE m17n_configuration_key  LIKE 'MODULE_ABOUTBOX_%';");
}
?>
