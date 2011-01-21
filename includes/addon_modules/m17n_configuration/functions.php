<?php
function zen_cfg_m17n_use_function($configuration_value = '') {
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  if(!is_array($m17n_value)) {
    return $m17n_value;
  }

  $user_language_id = zen_m17n_get_user_language();

  $languages = zen_m17n_get_languages();
  if ($user_language_id !== false) {
    foreach ($languages as $language) {
      if ($language['id'] == $user_language_id) {
        $user_language = $language['code'];
        break;
      }
    }
  }
  if (!isset($user_language)) {
    $user_language = zen_m17n_get_default_language();
  }

  if (isset($m17n_value[$user_language])) {
    return $m17n_value[$user_language];
  } else {
    return '';
  }
}
function zen_cfg_m17n_use_multi_func($configurations = '') {
  global $db;
  global $configuration;

  if (is_array($configurations)) {
    // if called in function zen_m17n_init_db_config_read
    $configuration_value = $configurations[0];
    $configuration_key = $configurations[1];
  } else {
    // if called in admin/configuration.php
    $configuration_value = $configurations;
    if (isset($configuration) && is_object($configuration) && isset($configuration->fields) && isset($configuration->fields['configuration_key'])) {
      $configuration_key = $configuration->fields['configuration_key'];
    } else {
      $configuration_key = '';
    }
  }

  if (empty($configuration_key)) {
    return false;
  }

  $m17n_value = zen_cfg_m17n_use_function($configuration_value);

  $sql = 'SELECT use_function_backup FROM '.TABLE_M17N_CONFIGURATION_KEYS.' WHERE m17n_configuration_key=\''.addslashes($configuration_key).'\'';
  $use_function_backup = $db->Execute($sql);
  if (!$use_function_backup->EOF && $use_function_backup->fields['use_function_backup'] != '' && $use_function_backup != 'NULL') {
    $use_function = $use_function_backup->fields['use_function_backup'];
  }
  if (isset($use_function)) {
    if (preg_match('/->/', $use_function)) {
      $use_functions = explode('->', $use_function);
      if (is_object($GLOBALS[$use_functions[0]]) && method_exists($GLOBALS[$use_functions[0]], $use_functions[1])) {
        $m17n_value = call_user_func_array(array($GLOBALS[$use_functions[0]], $use_functions[1]), array($m17n_value));
      } else {
        if ($use_functions[0] == 'currencies') {
          include_once(DIR_WS_CLASSES . 'currencies.php');
          if (file_exists(DIR_WS_CLASSES . $use_functions[0] . '_m17n.php')) {
            include_once(DIR_WS_CLASSES . $use_functions[0] . '_m17n.php');
            $class_name = 'currenciesM17n';
          } else {
            $class_name = 'currencies';
          }
        }
        ${$use_functions[0]} = new $class_name();
        $m17n_value = call_user_func_array(array(${$use_functions[0]}, $use_functions[1]), array($m17n_value));
      }
    } else {
      $m17n_value = call_user_func_array($use_function, array($m17n_value));
     }
  }

  return $m17n_value;
}

function zen_cfg_m17n_set_multi_func($configuration_name = '[configuration_value]', $configuration_key, $configuration_value = '') {
  global $db;
  // init and prepare
  if ($configuration_name == '') {
    $configuration_name = '[configuration_value]';
  }
  $m17n_setter = '';
  $default_language = zen_m17n_get_default_language();
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  $is_array = is_array($m17n_value) ? true : false;

  // get backuped set_function
  if (!empty($configuration_key)) {
    // general configuration
    $sql = 'SELECT set_function_backup FROM ' . TABLE_M17N_CONFIGURATION_KEYS . ' WHERE m17n_configuration_key = \'' . zen_db_input($configuration_key) . '\'';
    $result = $db->Execute($sql);
    if (!$result->EOF && $result->fields['set_function_backup'] != '') {
      $original_set_function = $result->fields['set_function_backup'];
    } else {
      // product type layout configuration
      $configuration_key = MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX . $configuration_key;
      $sql = 'SELECT set_function_backup FROM ' . TABLE_M17N_CONFIGURATION_KEYS . ' WHERE m17n_configuration_key = \'' . zen_db_input($configuration_key) . '\'';
      $result = $db->Execute($sql);
      if (!$result->EOF && $result->fields['set_function_backup'] != '') {
        $original_set_function = $result->fields['set_function_backup'];
      }
    }
  }

  $languages = zen_m17n_get_languages();
  foreach ($languages as $language) {
    $image_path = DIR_WS_CATALOG_LANGUAGES . $language['directory'] . '/images/' . $language['image'];
    $m17n_setter .= zen_image($image_path, $language['name'], $language['name']) . ': ' . $language['name'];

    if ($is_array) {
      $value = isset($m17n_value[$language['code']]) ? $m17n_value[$language['code']] : '';
    } elseif ($language['code'] == $default_language) {
      $value = $m17n_value;
    } else {
      $value = '';
    }
    // create setter form
    if (isset($original_set_function) && !empty($original_set_function) && strtoupper($original_set_function) != 'NULL') {
      eval('$m17n_setter .= ' . $original_set_function . '\'' . htmlspecialchars($value) . '\',\'' . MODULE_M17N_CONFIGURATION_NAME_DEFAULT . ']' . $configuration_name . '[' . $configuration_key . ']' . '[' . $language['code']  . '\');');
    } else {
      $m17n_setter .= zen_draw_input_field(MODULE_M17N_CONFIGURATION_NAME_DEFAULT . $configuration_name . '[' . $language['code'] . ']', htmlspecialchars($value), 'size="40"');
    }
    $m17n_setter .= '<br /><br />';
  }
  return $m17n_setter;
}
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

  // get languages. same as zen_get_lanugages (general.php)
function zen_m17n_get_languages() {
  global $db;

  static $languages_array = null;
  if (!is_null($languages_array) && is_array($languages_array)) {
    return $languages_array;
  }
  $languages = $db->Execute("select languages_id, name, code, image, directory
                             from " . TABLE_LANGUAGES . " order by sort_order");

  while (!$languages->EOF) {
    $languages_array[] = array('id' => $languages->fields['languages_id'],
                               'name' => $languages->fields['name'],
                               'code' => $languages->fields['code'],
                               'image' => $languages->fields['image'],
                               'directory' => $languages->fields['directory']);
    $languages->MoveNext();
  }

  return $languages_array;
}
// end of language
function zen_m17n_get_default_language() {
  global $db;

  $default_language = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'DEFAULT_LANGUAGE'");
  $default_language = $default_language->fields['configuration_value'];

  return $default_language;
}

function zen_m17n_get_browser_language() {
  if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $browser_languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    $catalog_languages = zen_m17n_get_languages();

    foreach ($catalog_languages as $id => $value) {
      $temp_languages[$value['code']] = $value;
    }
    $catalog_languages = $temp_languages;

    for ($i=0, $n=sizeof($browser_languages); $i<$n; $i++) {
      $lang = explode(';', $browser_languages[$i]);
      if (strlen($lang[0]) == 2) {
        $code = $lang[0];
      } elseif (strpos($lang[0], '-') == 2 || strpos($lang[0], '_') == 2) {
        $code = substr($lang[0], 0, 2);
      } else {
        continue;
      }
      if (isset($catalog_languages[$code])) {
        $language_id = $catalog_languages[$code]['id'];
        break;
      }
    }
  }
  $language_id = isset($language_id) ? $language_id : false;
  return $language_id;
}

function zen_m17n_get_user_language() {
  global $db;
  global $request_type;

  // get language from request parameter
  if (isset($_REQUEST['language'])) {
    $sql = 'SELECT languages_id FROM '.TABLE_LANGUAGES.' WHERE code = \''.addslashes($_REQUEST['language']).'\'';
    $language_id = $db->Execute($sql);
    if (!$language_id->EOF && !empty($language_id->fields['languages_id'])) {
      $user_language_id = $language_id->fields['languages_id'];
      return $user_language_id;
    }
  }

  if (isset($_SESSION)) {
    $user_language_id = $_SESSION['languages_id'];
    return $user_language_id;
  }

  // get browser language
  $sql = 'SELECT configuration_value FROM '.TABLE_CONFIGURATION.' WHERE configuration_key=\'LANGUAGE_DEFAULT_SELECTOR\'';
  $use_browser_language = $db->Execute($sql);
  if (!$use_browser_language->EOF && $use_browser_language->fields['configuration_value'] == 'Browser' && $user_language_id === false) {
    $user_language_id = zen_m17n_get_browser_language();
  }

  return $user_language_id;
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
function zen_m17n_select_function($set_function = '', $configuration_name = '[configuration_value]') {
  switch ($set_function) {
  case (strpos($set_function, 'zen_cfg_textarea_small') === 0):
    $new_set_function = 'zen_cfg_m17n_textarea_small(\''.$configuration_name.'\',';
    break;
  case (strpos($set_function, 'zen_cfg_textarea') === 0):
    $new_set_function = 'zen_cfg_m17n_textarea(\''.$configuration_name.'\',';
    break;
  case ('NULL'):
  case (''):
    $new_set_function = 'zen_cfg_m17n_textbox(\''.$configuration_name.'\',';
    break;
  default:
    $new_set_function = 'zen_cfg_m17n_set_multi_func(\''.$cofiguration_name.'\',';
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
function zen_m17n_update_configuration($key, $new_set_function, $use_function = '', $product_type_layout = false) {
  global $db;
  $table = TABLE_CONFIGURATION;
  if ($product_type_layout) {
    $table = TABLE_PRODUCT_TYPE_LAYOUT;
    $key = substr($key, strlen(MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX));
  }

  // zen_cfg_m17n_multi_funcならkeyを付加
  if (preg_match('/^zen_cfg_m17n_set_multi_func/', $new_set_function)) {
    $new_set_function .= '\'' . $key . '\', ';
  }

  // use_functionがあれば置き換え
  if ($use_function != '' && $use_function != 'NULL') {
    $new_use_function = 'zen_cfg_m17n_use_multi_func';
  } else {
    $new_use_function = 'zen_cfg_m17n_use_function';
  }

  $sql = 'UPDATE '.$table.' SET set_function=\''.zen_db_input($new_set_function).'\', use_function=\''.zen_db_input($new_use_function).'\' WHERE configuration_key=\''.zen_db_input($key).'\'';
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

function zen_m17n_set_show_product_switch() {
  // product_general
  $product_info = array('show_product_info_starting_at',
                        'show_product_info_model',
                        'show_product_info_weight',
                        'show_product_info_quantity',
                        'show_product_info_manufacturer',
                        'show_product_info_in_cart_qty',
                        'show_product_info_tell_a_friend',
                        'show_product_info_reviews',
                        'show_product_info_reviews_count',
                        'show_product_info_date_available',
                        'show_product_info_date_added',
                        'show_product_info_url',
                        'show_product_info_additional_images');
  foreach ($product_info as $name) {
    zen_m17n_set_show_product_switch_process($name);
  }

  // product music
  $music_info = array('show_product_music_info_artist',
                      'show_product_music_info_genre',
                      'show_product_music_info_record_company');
  foreach ($music_info as $name) {
    zen_m17n_set_show_product_switch_process($name);
  }
}
function zen_m17n_set_show_product_switch_process($name) {
  $flag_name = 'flag_' . $name;
  $define = strtoupper($name);
  if (isset($GLOBALS[$flag_name]) && defined($define)) {
    $GLOBALS[$flag_name] = constant($define);
  }
}
?>