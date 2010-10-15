<?php
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
  else {
    // get session save path
    $sql = 'SELECT configuration_value FROM '.TABLE_CONFIGURATION.' WHERE configuration_key=\'SESSION_WRITE_DIRECTORY\'';
    $session_write_directory = $db->Execute($sql);
    if (!$session_write_directory->EOF) {
      $session_write_directory = $session_write_directory->fields['configuration_value'];
    } else {
      $session_write_directory = '';
    }

    // set sessions
    session_name('zenid');
    if (!empty($session_write_directory)) {
      session_save_path($session_write_directory);
    }
    // get session key
    if (isset($_POST[session_name()])) {
      session_id($_POST[zen_session_name()]);
    } elseif ( ($request_type == 'SSL') && isset($_GET[session_name()]) ) {
      session_id($_GET[session_name()]);
    }
    // start settion
    session_start();
    if (STORE_SESSIONS == 'db') {
      $sql = 'SELECT value FROM '.TABLE_SESSIONS.' WHERE sesskey=\''.addslashes(session_id()).'\'';
      $session_value = $db->Execute($sql);
      if (!empty($session_value->fields['value'])) {
        session_decode($session_value->fields['value']);
        $user_language_id = !empty($_SESSION['languages_id']) ? $_SESSION['languages_id'] : false;
        session_destroy();
      } else {
        $user_language_id = false;
        session_destroy();
      }
    }
    else {
      $user_language_id = !empty($_SESSION['languages_id']) ? $_SESSION['languages_id'] : false;
      session_write_close();
    }
  }

  // get browser language
  $sql = 'SELECT configuration_value FROM '.TABLE_CONFIGURATION.' WHERE configuration_key=\'LANGUAGE_DEFAULT_SELECTOR\'';
  $use_browser_language = $db->Execute($sql);
  if (!$use_browser_language->EOF && $use_browser_language->fields['configuration_value'] == 'Browser' && $user_language_id === false) {
    $user_language_id = zen_m17n_get_browser_language();
  }

  return $user_language_id;
}

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

function zen_cfg_m17n_use_function($configuration_value = '', $default = false) {
  $m17n_value = ($unserialized = zen_m17n_unserialize_value(zen_m17n_htmlspecialchars_decode($configuration_value))) == '' ? $configuration_value : $unserialized;
  if(!is_array($m17n_value)) {
    return $m17n_value;
  }

  if ($default) {
    $user_language_id = false;
  } else {
    $user_language_id = zen_m17n_get_user_language();
  }

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

function zen_m17n_init_db_config_read() {
  global $db;
  $sql = 'SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue FROM '.TABLE_CONFIGURATION.' WHERE use_function=\'zen_cfg_m17n_use_function\'';
  $configuration = $db->Execute($sql);
  while (!$configuration->EOF) {
    $configuration->fields['cfgvalue'] = call_user_func('zen_cfg_m17n_use_function', $configuration->fields['cfgvalue']);
    define(strtoupper($configuration->fields['cfgkey']), $configuration->fields['cfgvalue']);
    $configuration->MoveNext();
  }
}
?>