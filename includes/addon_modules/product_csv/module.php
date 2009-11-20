<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class product_csv extends addOnModuleBase {
    var $author = 'saito';
    var $author_email = 'info@zencart-sugu.jp';
    var $version = '0.0.2';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    var $title = MODULE_PRODUCT_CSV_TITLE;
    var $description = MODULE_PRODUCT_CSV_DESCRIPTION;
    var $sort_order = MODULE_PRODUCT_CSV_SORT_ORDER;
    var $icon;
    var $status = MODULE_PRODUCT_CSV_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_PRODUCT_CSV_STATUS_TITLE,
            'configuration_key' => 'MODULE_PRODUCT_CSV_STATUS',
            'configuration_value' => MODULE_PRODUCT_CSV_STATUS_DEFAULT,
            'configuration_description' => MODULE_PRODUCT_CSV_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_PRODUCT_CSV_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_PRODUCT_CSV_SORT_ORDER',
            'configuration_value' => MODULE_PRODUCT_CSV_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_PRODUCT_CSV_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
    );
    var $require_modules = array();
    var $notifier = array(
          );

    // class constructer for php4
    function product_csv() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
      global $db;
      $db->execute(CREATE_CSV_FORMAT_TYPES);
      $db->execute(CREATE_CSV_FORMATS);
      $db->execute(CREATE_CSV_COLUMNS);
      $db->execute(CREATE_CSV_FORMAT_COLUMNS);
      $insert_sql = sprintf(INSERT_CSV_FORMAT_TYPES, MODULE_PRODUCT_CSV_FORMAT_TYPES_1, MODULE_PRODUCT_CSV_FORMAT_TYPES_2, MODULE_PRODUCT_CSV_FORMAT_TYPES_3);
      $db->execute($insert_sql);

      foreach($GLOBALS['MODULE_PRODUCT_CSV_COLUMNS'] as $val) {
	if(preg_match('/:LANGUAGE_ID/', $val['name'])) {
	  zen_set_column_with_language(INSERT_CSV_COLUMNS, $val);
	  continue;
	}
	$insert_sql = sprintf(INSERT_CSV_COLUMNS, $val['column_id'], $val['type_id'], $val['name'], $val['validate'], $val['dbtable'], $val['dbcolumn']);
	$db->execute($insert_sql);
      }

      require(dirname(__FILE__).'/classes/ProductCSV.php');
      $ProductCSV = new ProductCSV();
      for ($i = 1; $i <= 3; $i++) {
	$columns = $ProductCSV->getFormatColumns($i);
	$count = 0;
	$values = array();
	foreach($columns as $val) {
	  $count++;
	  $values[$count] = $val['id'];
	}
	switch ($i) {
	case 1:
	  $name = MODULE_PRODUCT_CSV_FORMAT_PRODUCT_ALL;
	  break;
	case 2:
	  $name = MODULE_PRODUCT_CSV_FORMAT_CATEGORY_ALL;
	  break;
	case 3:
	  $name = MODULE_PRODUCT_CSV_FORMAT_OPTION_ALL;
	  break;
	}
	$ProductCSV->setFormat($i, $name, $values);
      }
    }

    function _update() {
    }

    function _remove() {
      global $db;
      $sql = "DROP TABLE IF EXISTS ".CSV_FORMAT_TYPES;
      $db->execute($sql);
      $sql = "DROP TABLE IF EXISTS ".CSV_FORMATS;
      $db->execute($sql);
      $sql = "DROP TABLE IF EXISTS ".CSV_COLUMNS;
      $db->execute($sql);
      $sql = "DROP TABLE IF EXISTS ".CSV_FORMAT_COLUMNS;
      $db->execute($sql);
    }

    function _cleanUp() {
    }

  }
?>