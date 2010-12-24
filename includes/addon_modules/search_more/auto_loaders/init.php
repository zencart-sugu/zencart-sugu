<?php
global $exclude_db_configuration_keys;

if (!is_array($exclude_db_configuration_keys)) {
  $exclude_db_configuration_keys = array();
}

if (isset($_GET['per_page']) && is_numeric($_GET['per_page'])) {
  define('MAX_DISPLAY_PRODUCTS_LISTING', $_GET['per_page']);
  $exclude_db_configuration_keys[] = 'MAX_DISPLAY_PRODUCTS_LISTING';
}
?>