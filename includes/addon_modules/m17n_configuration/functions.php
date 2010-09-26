<?php
function zen_cfg_m17n_textbox($configuration_name = '[configuration_value]', $configuration_value = '') {
  if ($configuration_name == '') {
    $configuration_name = '[configuration_value]';
  }
  $m17n_textbox = '';
  $default_language = zen_m17n_get_default_language();
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  $is_array = is_array($m17n_value) ? true : false;

  $languages = zen_m17n_get_languages();
  foreach ($languages as $language) {
    $image_path = DIR_WS_CATALOG_LANGUAGES . $language['directory'] . '/images/' . $language['image'];
    $m17n_textbox .= zen_image($image_path, $language['name'], $language['name']);

    if ($is_array) {
      $value = isset($m17n_value[$language['code']]) ? $m17n_value[$language['code']] : '';
    } elseif ($language['code'] == $default_language) {
      $value = $m17n_value;
    } else {
      $value = '';
    }
    $m17n_textbox .= zen_draw_input_field(MODULE_M17N_CONFIGURATION_NAME_DEFAULT . $configuration_name . '[' . $language['code'] . ']', htmlspecialchars($value), 'size="40"');
    $m17n_textbox .= '<br />';
  }
  return $m17n_textbox;
}
function zen_cfg_m17n_textarea($configuration_name = '[configuration_value]', $configuration_value = '') {
  if ($configuration_name == '') {
    $configuration_name = '[configuration_value]';
  }
  $m17n_textarea = '';
  $default_language = zen_m17n_get_default_language();
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  $is_array = is_array($m17n_value) ? true : false;

  $languages = zen_m17n_get_languages();
  foreach ($languages as $language) {
    $image_path = DIR_WS_CATALOG_LANGUAGES . $language['directory'] . '/images/' . $language['image'];
    $m17n_textarea .= zen_image($image_path, $language['name']);

    if ($is_array) {
      $value = isset($m17n_value[$language['code']]) ? $m17n_value[$language['code']] : '';
    } elseif ($language['code'] == $default_language) {
      $value = $m17n_value;
    } else {
      $value = '';
    }
    $m17n_textarea .= zen_draw_textarea_field(MODULE_M17N_CONFIGURATION_NAME_DEFAULT . $configuration_name . '[' . $language['code'] . ']', false, 60, 5, htmlspecialchars($value));
    $m17n_textarea .= '<br />';
  }
  return $m17n_textarea;
}
function zen_cfg_m17n_textarea_small($configuration_name = '[configuration_value]', $configuration_value = '') {
  if ($configuration_name == '') {
    $configuration_name = '[configuration_value]';
  }
  $m17n_textarea = '';
  $default_language = zen_m17n_get_default_language();
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  $is_array = is_array($m17n_value) ? true : false;

  $languages = zen_m17n_get_languages();
  foreach ($languages as $language) {
    $image_path = DIR_WS_CATALOG_LANGUAGES . $language['directory'] . '/images/' . $language['image'];
    $m17n_textarea .= zen_image($image_path, $language['name']);

    if ($is_array) {
      $value = isset($m17n_value[$language['code']]) ? $m17n_value[$language['code']] : '';
    } elseif ($language['code'] == $default_language) {
      $value = $m17n_value;
    } else {
      $value = '';
    }
    $m17n_textarea .= zen_draw_textarea_field(MODULE_M17N_CONFIGURATION_NAME_DEFAULT . $configuration_name . '[' . $language['code'] . ']', false, 35, 1, htmlspecialchars($value));
    $m17n_textarea .= '<br />';
  }
  return $m17n_textarea;
}

// 一般モジュールのディレクトリを走査
function zen_m17n_read_directory($module_directory) {
  global $PHP_SELF;
  $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
  $directory_array = array();
  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir($module_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }
  return $directory_array;
}
// 一般モジュールのファイルを読み込む
function zen_m17n_load_module_files($directory_array, $module_type, $module_directory) {
  $installed_modules = array();
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];
    include(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/' . $module_type . '/' . $file);
    include($module_directory . $file);
    $class = substr($file, 0, strrpos($file, '.'));
    if (zen_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        if ($module->sort_order > 0) {
          $installed_modules[$module->sort_order] = $module;
        } else {
          $installed_modules[] = $module;
        }
      }
    }
  }
  return $installed_modules;
}

// すでに更新済みであるかどうか
function zen_m17n_is_modified($key) {
  global $db;
  $sql = 'SELECT m17n_configuration_keys_id FROM '.TABLE_M17N_CONFIGURATION_KEYS.' WHERE m17n_configuration_key=\''.zen_db_input($key).'\' limit 1';
  $cfg_keys_id = $db->Execute($sql);
  if ($cfg_keys_id->RecordCount() == 0) {
    return false;
  } else {
    return true;
  }
}
// configuratinテーブルからset_function,use_functionを取得
function zen_m17n_get_functions($key, $product_type_layout = false) {
  global $db;
  $func_array = array();
  $table = TABLE_CONFIGURATION;
  if ($product_type_layout) {
    $table = TABLE_PRODUCT_TYPE_LAYOUT;
    $key = substr($key, strlen(MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX));
  }
  $sql = 'SELECT set_function, use_function FROM '.$table.' WHERE configuration_key=\''.zen_db_input($key).'\' limit 1';
  $functions = $db->Execute($sql);
    // NULL値は文字列NULLに置き換えて返値にセット
  $func_array['set_function'] = empty($functions->fields['set_function']) ? 'NULL' : $functions->fields['set_function'];
  $func_array['use_function'] = empty($functions->fields['use_function']) ? 'NULL' : $functions->fields['use_function'];
  return $func_array;
}
// set_functionの値に応じて新しいset_functionを決定
function zen_m17n_select_function($set_function, $configuration_name = '[configuration_value]') {
  switch ($set_function) {
  case (strpos($set_function, 'zen_cfg_textarea_small') === 0):
    $new_set_function = 'zen_cfg_m17n_textarea_small(\''.$configuration_name.'\',';
    break;
  case (strpos($set_function, 'zen_cfg_textarea') === 0):
    $new_set_function = 'zen_cfg_m17n_textarea(\''.$configuration_name.'\',';
    break;
  default:
    $new_set_function = 'zen_cfg_m17n_textbox(\''.$configuration_name.'\',';
    break;
  }
  return $new_set_function;
}
// 取得したfunctionをm17n_configuration_keysテーブルに挿入
function zen_m17n_backup_configuration($key, $set_function, $use_function) {
  global $db;
  $sql = 'INSERT INTO '.TABLE_M17N_CONFIGURATION_KEYS.' (m17n_configuration_key, set_function_backup, use_function_backup)
          VALUES (\''.zen_db_input($key).'\', \''.zen_db_input($set_function).'\', \''.zen_db_input($use_function).'\')';
  $db->Execute($sql);
}
// configurationテーブルを更新
function zen_m17n_update_configuration($key, $new_set_function, $product_type_layout = false) {
  global $db;
  $table = TABLE_CONFIGURATION;
  if ($product_type_layout) {
    $table = TABLE_PRODUCT_TYPE_LAYOUT;
    $key = substr($key, strlen(MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX));
  }
  $sql = 'UPDATE '.$table.' SET set_function=\''.zen_db_input($new_set_function).'\', use_function=\'zen_cfg_m17n_use_function\' WHERE configuration_key=\''.zen_db_input($key).'\'';
  $db->Execute($sql);
}
// チェックの無い項目はconfigurationテーブルを復元しm17n_configuration_keysテーブルから削除
function zen_m17n_restore_configuration($exclude = null) {
  global $db;
  $table = TABLE_CONFIGURATION;
  $condition = ' WHERE 1 ';
  // 変更があったことを示すフラグ
  $restored = false;

  if (is_array($exclude) && sizeof($exclude) > 0) {
    // チェックされた項目は除外
    $condition .= ' AND m17n_configuration_key NOT IN ('.implode(',', $exclude).')';
  }
  // backupしたfunctionを取得
  $sql = 'SELECT m17n_configuration_key, set_function_backup, use_function_backup FROM '.TABLE_M17N_CONFIGURATION_KEYS;
  if (isset($condition)) {
    $sql .= $condition;
  }
  $cfg = $db->Execute($sql);
  if (!$cfg->EOF) {
    $restored = true;
  }
  while (!$cfg->EOF) {
    // 文字列NULL以外はクオート
    if ($cfg->fields['set_function_backup'] != 'NULL') {
      $cfg->fields['set_function_backup'] = '\''.zen_db_input($cfg->fields['set_function_backup']).'\'';
    }
    if ($cfg->fields['use_function_backup'] != 'NULL') {
      $cfg->fields['use_function_backup'] = '\''.zen_db_input($cfg->fields['use_function_backup']).'\'';
    }
    // product_type_layoutの場合 keyのprefixを消してテーブルも変更
    if (strpos($cfg->fields['m17n_configuration_key'], MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX) === 0) {
      $cfg->fields['m17n_configuration_key'] = substr($cfg->fields['m17n_configuration_key'], strlen(MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX));
      $table = TABLE_PRODUCT_TYPE_LAYOUT;
    } else {
      $table = TABLE_CONFIGURATION;
    }
    // デフォルト言語のvalueを取得
    $sql = 'SELECT configuration_value FROM '.$table.' WHERE configuration_key=\''.$cfg->fields['m17n_configuration_key'].'\'';
    $cfg_value = $db->Execute($sql);
    $default_value = zen_cfg_m17n_use_function($cfg_value->fields['configuration_value'], true);
    // configurationテーブルをアップデート
    $sql = 'UPDATE '.$table.' SET configuration_value=\''.zen_db_input($default_value).'\',set_function='.$cfg->fields['set_function_backup'].',use_function='.$cfg->fields['use_function_backup'].' WHERE configuration_key=\''.zen_db_input($cfg->fields['m17n_configuration_key']).'\'';
    $db->Execute($sql);
    $cfg->MoveNext();
  }
  $sql = 'DELETE FROM '.TABLE_M17N_CONFIGURATION_KEYS;
  if (isset($condition)) {
    $sql .= $condition;
  }
  $db->Execute($sql);
  return $restored;
}
?>