<?php
function zen_m17n_htmlspecialchars_decode($text) {
  if (function_exists('htmlspecialchars_decode')) {
    return htmlspecialchars_decode($text);
  } else {
    return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
  }
}
function zen_m17n_serialize_value($configuration_value = '') {
  return serialize($configuration_value);
}
function zen_m17n_unserialize_value($configuration_value = '') {
  return unserialize($configuration_value);
}
function zen_m17n_serialize_parameter($name) {
  if (isset($_POST[$name])) {
    $m17n_parameter = zen_m17n_parse_parameter($_POST[$name]);
    if (is_array($m17n_parameter)) {
      foreach($m17n_parameter as $key => $value) {
        $_POST[$key] = $value;
      }
    }
  }
}
function zen_m17n_parse_parameter($array) {
  if (!is_array($array)) {
    return true;
  }
  foreach ($array as $key => $value) {
    $tmp = zen_m17n_parse_parameter($value);
    if ( $tmp === true) {
      $array['bottom'] = true;
      return $array;
    } elseif ($tmp['bottom'] === true) {
      $array[$key] = zen_m17n_serialize_value($value);
      continue;
    } else {
      $array[$key] = $tmp;
      return $array;
    }
  }
  return $array;
}

function zen_m17n_select_exclude_db_config() {
  global $db;
  global $exclude_db_configuration_keys;

  if (!is_array($exclude_db_configuration_keys)) {
    $exclude_db_configuration_keys = array();
  }

  $sql = '(SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue, use_function FROM '.TABLE_CONFIGURATION.' WHERE use_function=\'zen_cfg_m17n_use_function\' OR use_function=\'zen_cfg_m17n_use_multi_func\')
          UNION ALL
          (SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue, use_function FROM '.TABLE_PRODUCT_TYPE_LAYOUT.' WHERE use_function=\'zen_cfg_m17n_use_function\' OR use_function=\'zen_cfg_m17n_use_multi_func\')';
  $m17n_configuration = $db->Execute($sql);
  while (!$m17n_configuration->EOF) {
    $exclude_db_configuration_keys[] = strtoupper($m17n_configuration->fields['cfgkey']);
    $m17n_configuration->MoveNext();
  }
}
function zen_m17n_init_db_config_read() {
  global $db;

  $sql = '(SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue, use_function FROM '.TABLE_CONFIGURATION.' WHERE use_function=\'zen_cfg_m17n_use_function\' OR use_function=\'zen_cfg_m17n_use_multi_func\')
          UNION ALL
          (SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue, use_function FROM '.TABLE_PRODUCT_TYPE_LAYOUT.' WHERE use_function=\'zen_cfg_m17n_use_function\' OR use_function=\'zen_cfg_m17n_use_multi_func\')';
  $m17n_configuration = $db->Execute($sql);

  while (!$m17n_configuration->EOF) {
    $m17n_value = $m17n_configuration->fields['cfgvalue'] = call_user_func('zen_cfg_m17n_use_function', $m17n_configuration->fields['cfgvalue']);
    define(strtoupper($m17n_configuration->fields['cfgkey']), $m17n_value);
    $m17n_configuration->MoveNext();
  }
  unset($m17n_configuration);
}
?>
