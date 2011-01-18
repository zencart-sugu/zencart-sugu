<?php
require_once DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/configure.php';
require_once DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/database_tables.php';
require_once DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/functions.php';
require_once DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/auto_loaders/init_functions.php';

if (isset($_POST['configuration']) && isset($_POST['configuration'][MODULE_M17N_CONFIGURATION_NAME_DEFAULT]) && isset($_POST['configuration'][MODULE_M17N_CONFIGURATION_NAME_DEFAULT]['configuration_value'])) {
  if (is_array($_POST['configuration'][MODULE_M17N_CONFIGURATION_NAME_DEFAULT]['configuration_value'])) {
    foreach ($_POST['configuration'][MODULE_M17N_CONFIGURATION_NAME_DEFAULT]['configuration_value'] as $key => $value) {
      if (preg_match('/^'.MODULE_M17N_CONFIGURATION_PRODUCT_TYPE_LAYOUT_PREFIX.'/', $key)) {
        $_POST[MODULE_M17N_CONFIGURATION_NAME_DEFAULT]['configuration_value'] = $value;
      } else {
        $_POST[MODULE_M17N_CONFIGURATION_NAME_DEFAULT]['configuration'][$key] = $value;
      }
    }
  }
}

zen_m17n_serialize_parameter(MODULE_M17N_CONFIGURATION_NAME_DEFAULT);
zen_m17n_select_exclude_db_config();
?>