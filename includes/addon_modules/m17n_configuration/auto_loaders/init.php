<?php
require DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/configure.php';
require DIR_FS_CATALOG_ADDON_MODULES . 'm17n_configuration/auto_loaders/init_functions.php';

zen_m17n_serialize_parameter(MODULE_M17N_CONFIGURATION_NAME_DEFAULT);
zen_m17n_init_db_config_read();
?>