<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class ProductCSV {
  // class member
  var $db;
  var $messageStack;
  // constructor
  function ProductCSV() {
    $this->db = &$GLOBALS['db'];
    $this->messageStack = new ProductCSVMessageStack();
  }

  // class methods
  function getFormatColumns($type_id = 1) {
    $sql = 'SELECT * FROM ' . CSV_COLUMNS . ' WHERE csv_format_type_id=' . zen_db_input($type_id) . ' ORDER BY csv_column_id';
    $format_columns = $this->db->Execute($sql);
    $return = array();
    while(!$format_columns->EOF) {
      $data = $format_columns->fields;
      if (preg_match('/:language_id=(.*)$/', $data['csv_column_name'], $matches)) {
	$data['language_id'] = $matches[1];
	$data['csv_column_name'] = preg_replace('/:language_id.*$/', '', $data['csv_column_name']);
      }
      $data['id'] = $data['csv_column_id'];
      $data['text'] = $data['csv_column_name'];
      $return[] = $data;
      $format_columns->MoveNext();
    }
    return $return;
  }

  function getFormatTypes() {
    $sql = 'SELECT * FROM ' . CSV_FORMAT_TYPES . ' ORDER BY csv_format_type_id';
    $format_types = $this->db->Execute($sql);
    $return = array();
    while(!$format_types->EOF) {
      $return[] = array('id' => $format_types->fields['csv_format_type_id'], 'text' => $format_types->fields['csv_format_type_name']);
      $format_types->MoveNext();
    }
    return $return;
  }

  function getFormats() {
    $sql = 'SELECT * FROM ' . CSV_FORMATS . ' LEFT JOIN ' . CSV_FORMAT_TYPES . ' USING (csv_format_type_id) ' . ' ORDER BY csv_format_id';
    $formats = $this->db->Execute($sql);
    $return = array();
    while(!$formats->EOF) {
      $data = $formats->fields;
      $data['id'] = $data['csv_format_id'];
      $data['text'] = $data['csv_format_name'];
      $return[] = $data;
      $formats->MoveNext();
    }
    return $return;
  }

  function getFormatById($csv_format_id) {
    $sql = 'SELECT * FROM ' . CSV_FORMATS . ' WHERE csv_format_id='.zen_db_input($csv_format_id).'';
    $format = $this->db->Execute($sql);
    $return = array();
    if($format->RecordCount() == 1) {
      $return = $format->fields;
      $sql = 'SELECT * FROM ' . CSV_FORMAT_COLUMNS . ' LEFT JOIN ' . CSV_COLUMNS . ' USING (csv_column_id) WHERE csv_format_id='.zen_db_input($csv_format_id).' ORDER BY csv_format_id, csv_format_column_number';
      $format = $this->db->Execute($sql);
      while(!$format->EOF) {
	$data = $format->fields;
	if (preg_match('/:language_id=(.*)$/', $data['csv_column_name'], $matches)) {
	  $data['language_id'] = $matches[1];
	  $data['csv_column_name'] = preg_replace('/:language_id.*$/', '', $format->fields['csv_column_name']);
	}
	$return['columns'][] = $data;
	$format->MoveNext();
      }
    }
    return $return;
  }

  function getFormatColumnDelete($csv_format_type_id) {
    $sql = 'SELECT * FROM ' . CSV_COLUMNS . ' WHERE csv_columns_dbtable=\'\' AND csv_columns_dbcolumn=\''.MODULE_PRODUCT_CSV_FORMAT_COLUMN_DELETE.'\' AND csv_format_type_id='.zen_db_input($csv_format_type_id).'';
    $column = $this->db->Execute($sql);
    if ($column->RecordCount() == 1) {
      $return = $column->fields;
    }
    return $return;
  }
  function getFormatColumnIgnore($csv_format_type_id) {
    $sql = 'SELECT * FROM ' . CSV_COLUMNS . ' WHERE csv_columns_dbtable=\'\' AND csv_columns_dbcolumn=\''.MODULE_PRODUCT_CSV_FORMAT_COLUMN_IGNORE.'\' AND csv_format_type_id='.zen_db_input($csv_format_type_id).'';
    $column = $this->db->Execute($sql);
    if ($column->RecordCount() == 1) {
      $return = $column->fields;
    }
    return $return;
  }

  function setFormat($format_type_id, $name, $values, $csv_format_id=false) {
    // insert record
    if (!$csv_format_id) {
      $sql = 'INSERT INTO ' . CSV_FORMATS . ' (csv_format_date_added) VALUES (NOW())';
      $this->db->Execute($sql);
      $csv_format_id = $this->db->Insert_ID();
    }
    // update all values
    $sql = 'UPDATE ' . CSV_FORMATS . ' SET
            csv_format_type_id='.zen_db_input($format_type_id).',
            csv_format_name=\''.zen_db_input($name).'\',
            csv_format_last_modified=NOW()
            WHERE csv_format_id='.zen_db_input($csv_format_id).'';
    $this->db->Execute($sql);
    if (count($values) > 0) {
      // delete columns first
      $this->deleteFormatColumns($csv_format_id);
      // insert columns
      foreach ($values as $key => $val) {
	$sql = 'INSERT INTO ' . CSV_FORMAT_COLUMNS . ' (csv_format_id, csv_column_id, csv_format_column_number)
                VALUES ('.zen_db_input($csv_format_id).',\''.zen_db_input($val).'\',\''.zen_db_input($key).'\')';
	$this->db->Execute($sql);
      }
    }
  }

  function deleteFormat($csv_format_id) {
    // delete columns first
    $this->deleteFormatColumns($csv_format_id);
    // delete format
    $sql = 'DELETE FROM ' . CSV_FORMATS . ' WHERE csv_format_id='.zen_db_input($csv_format_id).'';
    $this->db->Execute($sql);
  }

  function deleteFormatColumns($csv_format_id) {
    $sql = 'DELETE FROM ' . CSV_FORMAT_COLUMNS . ' WHERE csv_format_id='.zen_db_input($csv_format_id).'';
    $this->db->Execute($sql);
  }

  function getExportDataProduct($products_id, $format) {
    // prepare data
    $products_id = zen_db_input($products_id);
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_id = $delete_column['csv_column_id'];
    $return = array();
    // get default
    $sql = 'SELECT * FROM ' . TABLE_PRODUCTS . ' p LEFT JOIN ' . TABLE_PRODUCT_TYPES . ' pt ON pt.type_id=p.products_type
            LEFT JOIN ' . TABLE_TAX_CLASS . ' tc ON tc.tax_class_id=p.products_tax_class_id
            LEFT JOIN ' . TABLE_MANUFACTURERS . ' m ON m.manufacturers_id=p.manufacturers_id
            WHERE p.products_id='.$products_id.'';

    $product = $this->db->Execute($sql);
    if ($product->RecordCount() == 1) {
      $product = $product->fields;
    }
    // fetch return data
    foreach ($format['columns'] as $val) {
      if (array_key_exists($val['csv_columns_dbcolumn'], $product)) {
	if ($val['csv_columns_dbcolumn'] == 'products_date_added' || $val['csv_columns_dbcolumn'] == 'products_date_available') {
	  $return[] = $product[$val['csv_columns_dbcolumn']] == MODULE_PRODUCT_CSV_EXPORT_DATETIME_DEFAULT || $product[$val['csv_columns_dbcolumn']] == MODULE_PRODUCT_CSV_EXPORT_DATETIME_ZERO ? '' : $product[$val['csv_columns_dbcolumn']];
	} else {
	  $return[] = $product[$val['csv_columns_dbcolumn']];
	}
      } elseif ($val['csv_column_id'] == $ignore_id) {
	$return[] = '';
      } elseif ($val['csv_column_id'] == $delete_id) {
	$return[] = 0;
      } else {
	$sql = 'SELECT ' . $val['csv_columns_dbcolumn'] . ' FROM ' . DB_PREFIX.$val['csv_columns_dbtable'] . ' WHERE products_id='.$products_id.'';
	if (isset($val['language_id'])) {
	  $sql .= ' AND language_id=' . $val['language_id'] . '';
	}
	$column = $this->db->Execute($sql);
	if ($column->RecordCount() == 1) {
	  if (($val['csv_columns_dbtable'] == 'featured' && ($val['csv_columns_dbcolumn'] == 'expires_date' || $val['csv_columns_dbcolumn'] == 'featured_date_available'))
	      || ($val['csv_columns_dbtable'] == 'specials' && ($val['csv_columns_dbcolumn'] == 'expires_date' || $val['csv_columns_dbcolumn'] == 'specials_date_available'))) {
	    $return[] = $product[$val['csv_columns_dbcolumn']] == MODULE_PRODUCT_CSV_EXPORT_DATE_DEFAULT || $product[$val['csv_columns_dbcolumn']] == MODULE_PRODUCT_CSV_EXPORT_DATE_ZERO ? '' : $product[$val['csv_columns_dbcolumn']];
	  } else {
	    $return[] = $column->fields[$val['csv_columns_dbcolumn']];
	  }
	} else {
	  $return[] = '';
	}
      }
    }
    return $return;
  }
  function getExportDataCategory($category_id, $format) {
    // prepare data
    static $category = array();
    $category_id = zen_db_input($category_id);
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_id = $delete_column['csv_column_id'];
    $return = array();
    // store category_id
    if (!array_key_exists($category_id, $category)) {
      $category[$category_id] = array();
    } elseif (zen_childs_in_category_count($category_id) > 0) {
      // has child categories
      return false;
    }
    // get category tree
    $parent_category_tree = array();
    zen_get_parent_categories($parent_category_tree, $category_id);
    $parent_category_id = array_reverse($parent_category_tree);
    $parent_category_id[] = $category_id;
    // fetch data
    foreach ($format['columns'] as $val) {
      if ($val['csv_column_id'] == $delete_id) {
	$return[] = 0;
      } elseif ($val['csv_column_id'] == $ignore_id) {
	$return[] = '';
      } elseif ($val['csv_columns_dbtable'] == 'products') {
	$sql = 'SELECT p.products_id, p.products_model FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' as p2c 
                LEFT JOIN ' . TABLE_PRODUCTS . ' as p ON p2c.products_id=p.products_id
                WHERE p2c.categories_id='.$category_id.'';
	$products = $this->db->Execute($sql);
	while (!$products->EOF) {
	  $products_id = $products->fields['products_id'];
	  if (!in_array($products_id, $category[$category_id])) {
	    $category[$category_id][] = $products_id;
	    $model = $products->fields['products_model'];
	    break;
	  }
	  $products->MoveNext();
	}
	$return[] = $model;
      } elseif ($val['csv_columns_dbtable'] == 'categories_description' && $val['csv_columns_dbcolumn'] == 'categories_name') {
	if (!array_key_exists($val['number']-1, $parent_category_id)) {
	  $return[] = '';
	  continue;
	}
	$sql = 'SELECT ' . $val['csv_columns_dbcolumn'] . ' FROM ' . DB_PREFIX.$val['csv_columns_dbtable'] . '
                WHERE categories_id='.$parent_category_id[$val['number']-1].' AND language_id='.$val['language_id'].'';
	$name = $this->db->Execute($sql);
	if ($name->RecordCount() == 1) {
	  $return[] = $name->fields[$val['csv_columns_dbcolumn']];
	} else {
	  $return[] = '';
	}
      } else {
	$sql = 'SELECT ' . $val['csv_columns_dbcolumn'] . ' FROM ' . DB_PREFIX.$val['csv_columns_dbtable'] . ' WHERE categories_id='.$category_id.'';
	if (isset($val['language_id'])) {
	  $sql .= ' AND language_id=' . $val['language_id'] . '';
	}
	$column = $this->db->Execute($sql);
	if ($column->RecordCount() == 1) {
	  $return[] = $column->fields[$val['csv_columns_dbcolumn']];
	} else {
	  $return[] = '';
	}
      }
    }
    return $return;
  }
  function getExportDataOption($attributes_id, $format) {
    // prepare data
    $attributes_id = zen_db_input($attributes_id);
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_id = $delete_column['csv_column_id'];
    $return = array();
    // get options
    $sql = 'SELECT * FROM ' . TABLE_PRODUCTS_ATTRIBUTES . ' pa 
            LEFT JOIN ' . TABLE_PRODUCTS . ' p ON pa.products_id=p.products_id
            WHERE pa.products_attributes_id='.$attributes_id;
    $options = $this->db->Execute($sql);
    if ($options->RecordCount() == 1) {
      $option = $options->fields;
    } else {
      return $return;
    }
    // get data row
    foreach($format['columns'] as $val) {
      if ($val['csv_column_id'] == $ignore_id) {
	$return[] = '';
      } elseif ($val['csv_column_id'] == $delete_id) {
	$return[] = 0;
      } elseif (isset($val['language_id'])) {
	if ($val['csv_columns_dbtable'] == 'products_options') {
	  $sql = 'SELECT * FROM ' . TABLE_PRODUCTS_OPTIONS . ' WHERE products_options_id='.$option['options_id'];
	  $option_name = $this->db->Execute($sql);
	  if ($option_name->RecordCount() > 0) {
	    $temp = '';
	    while(!$option_name->EOF) {
	      if ($option_name->fields['language_id'] == $val['language_id']) {
		$temp = $option_name->fields[$val['csv_columns_dbcolumn']];
		if ($temp == PRODUCT_CSV_RESERVED_OPTION_NAME) {
		  $return = array();
		  return $return;
		}
		break;
	      }
	      $option_name->MoveNext();
	    }
	    $return[] = $temp;
	  } else {
	    $return = array();
	    return $return;
	  }
	} elseif ($val['csv_columns_dbtable'] == 'products_options_values') {
	  $sql = 'SELECT * FROM ' . TABLE_PRODUCTS_OPTIONS_VALUES . ' WHERE products_options_values_id='.$option['options_values_id'];
	  $option_value = $this->db->Execute($sql);
	  if ($option_value->RecordCount() > 0) {
	    $temp = '';
	    while(!$option_value->EOF) {
	      if ($option_value->fields['language_id'] == $val['language_id']) {
		$temp = $option_value->fields[$val['csv_columns_dbcolumn']];
		break;
	      }
	      $option_value->MoveNext();
	    }
	    $return[] = $temp;
	  } else {
	    $return = array();
	    return $return;
	  }
	}
      } else {
	$return[] = $option[$val['csv_columns_dbcolumn']];
      }
    }
    return $return;
  }

  // import each line
  function importProduct($data, $format) {
    // prepare data
    $validate = true;
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $delete_id = $delete_column['csv_column_id'];
    $this->messageStack->reset();
    // search products_model and validate
    foreach ($format['columns'] as $key => $val) {
      if (!empty($val['csv_column_validate_function'])) {
	$validate_function = $val['csv_column_validate_function'];
	if ($this->$validate_function($data[$key], $val['csv_column_name']) === true) {
	  $validate = $validate && true;
	} else {
	  $validate = $validate && false;
	}
      }

      if ($val['csv_columns_dbtable'] == 'products' && $val['csv_columns_dbcolumn'] == 'products_model') {
	$products_model = $data[$key];
      }
      if ($val['csv_column_id'] == $delete_id) {
	if ($data[$key] == 1) {
	  $delete_flag = true;
	} else {
	  $delete_flag = false;
	}
      }
    }
    if (empty($products_model)) {
      $validate = $validate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_MODEL, 'warning');
    }
    // return if validate is false
    if ($validate === false) {
      return false;
    }

    // main
    $sql = 'SELECT * FROM ' . TABLE_PRODUCTS . ' WHERE products_model=\''.zen_db_input($products_model).'\'';
    $product = $this->db->Execute($sql);
    if ($product->RecordCount() == 0) {
      $sql = 'INSERT INTO ' . TABLE_PRODUCTS . ' (products_model, products_date_added, products_status) VALUES(\''.zen_db_input($products_model).'\', NOW(), 1)';
      $this->db->Execute($sql);
      $products_id = $this->db->Insert_ID();
      // search language id
      foreach ($format['columns'] as $val) {
	if (isset($val['language_id'])) {
	  $language_ids[$val['language_id']] = 1;
	}
      }
      // insert products description
      foreach ($language_ids as $language_id => $flag) {
	$sql = 'INSERT INTO ' . TABLE_PRODUCTS_DESCRIPTION . ' (products_id, language_id) VALUES (\'' . $products_id . '\', \'' . $language_id . '\')';
	$this->db->Execute($sql);
	$sql = 'INSERT INTO ' . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . ' (products_id, language_id) VALUES (\''.$products_id.'\', \''.$language_id.'\')';
	$this->db->Execute($sql);
      }
    } else {
      $products_id = $product->fields['products_id'];
    }
    // delete product
    if ($delete_flag === true) {
      zen_remove_product($products_id);
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_DELETE, 'success');
      return true;
    }

    foreach ($format['columns'] as $key => $val) {
      if ($val['csv_column_id'] == $ignore_id) {
	continue;
      }
      if ($val['csv_columns_dbtable'] == 'products') {
	if ($val['csv_columns_dbcolumn'] == 'products_status' && $data[$key] == '') {
	  continue;
	}
	$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
	if ($val['csv_columns_dbcolumn'] == 'products_price') {
	  $products_price = $data[$key];
	}
      } elseif ($val['csv_columns_dbtable'] == 'tax_class') {
	$sql = 'SELECT tax_class_id FROM ' . TABLE_TAX_CLASS . ' WHERE ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\'';
	$tax_class = $this->db->Execute($sql);
	$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET products_tax_class_id=\'' . $tax_class->fields['tax_class_id'] . '\' WHERE products_id=\''.$products_id.'\'';
	$this->db->Execute($sql);
      } elseif ($val['csv_columns_dbtable'] == 'product_types') {
	$sql = 'SELECT type_id FROM ' . TABLE_PRODUCT_TYPES . ' WHERE ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\'';
	$product_type = $this->db->Execute($sql);
	$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET products_type=\'' . $product_type->fields['type_id'] . '\' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      } elseif ($val['csv_columns_dbtable'] == 'manufacturers') {
	$sql = 'SELECT manufacturers_id FROM ' . TABLE_MANUFACTURERS . ' WHERE ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\'';
	$manufacturer = $this->db->Execute($sql);
	if ($manufacturer->RecordCount() == 0) {
	  // insert manufacturer
	  $sql = 'INSERT INTO ' . TABLE_MANUFACTURERS . ' (manufacturers_name, date_added, last_modified) VALUES (\''.zen_db_input($data[$key]).'\', NOW(), NOW())';
	  $this->db->Execute($sql);
	  $manufacturer_id = $this->db->Insert_ID();
	} else {
	  $manufacturer_id = $manufacturer->fields['manufacturers_id'];
	}
	$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET manufacturers_id=\'' . $manufacturer_id . '\' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      } elseif ($val['csv_columns_dbtable'] == 'products_description') {

	if (isset($val['language_id'])) {
	  $sql = 'UPDATE ' . TABLE_PRODUCTS_DESCRIPTION . ' SET ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\' WHERE products_id='.$products_id.' AND language_id='.$val['language_id'].'';
	  $this->db->Execute($sql);
	}
      } elseif ($val['csv_columns_dbtable'] == 'meta_tags_products_description') {
	if (isset($val['language_id'])) {
	  $meta_tags[$val['language_id']][$val['csv_columns_dbcolumn']] = $data[$key];
	}
      } elseif ($val['csv_columns_dbtable'] == 'featured') {
	$featured[$val['csv_columns_dbcolumn']] = $data[$key];
      } elseif ($val['csv_columns_dbtable'] == 'specials') {
	$specials[$val['csv_columns_dbcolumn']] = $data[$key];
      }
    }
    if (isset($meta_tags)) {
      foreach ($meta_tags as $key => $val) {
	if (!empty($val['metatags_title']) || !empty($val['metatags_keywords']) || !empty($val['metatags_description'])) {
	  // set metatags
	  $sql = 'SELECT * FROM ' . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . ' WHERE products_id='.$products_id.' AND language_id='.$key.'';
	  $meta_tags_record = $this->db->Execute($sql);
	  if ($meta_tags_record->RecordCount() == 0) {
	    $sql = 'INSERT INTO ' . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . ' (products_id, language_id) VALUES (\''.$products_id.'\', \''.$key.'\')';
	    $this->db->Execute($sql);
	  }
	  $sql = 'UPDATE ' . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . ' SET metatags_title=\''.zen_db_input($val['metatags_title']).'\', metatags_keywords=\''.zen_db_input($val['metatags_keywords']).'\', metatags_description=\''.zen_db_input($val['metatags_description']).'\' WHERE products_id='.$products_id.' AND language_id='.$key.'';;
	  $this->db->Execute($sql);
	} else {
	  // delete metatags
	  $sql = 'DELETE FROM ' . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . ' WHERE products_id='.$products_id.' AND language_id='.$key.'';
	  $this->db->Execute($sql);
	}
      }
    }
    if (isset($featured)) {
      if (!empty($featured['featured_date_available']) || !empty($featured['expires_date'])) {
	// set featured
	$sql = 'SELECT * FROM ' . TABLE_FEATURED . ' WHERE products_id='.$products_id.'';
	$featured_record = $this->db->Execute($sql);
	if ($featured_record->RecordCount() == 0) {
	  $sql = 'INSERT INTO ' . TABLE_FEATURED . ' (products_id) VALUES (\''.$products_id.'\')';
	  $this->db->Execute($sql);
	}
	$sql = 'UPDATE ' . TABLE_FEATURED . ' SET featured_date_available=\''.zen_db_input($featured['featured_date_available']).'\', expires_date=\''.zen_db_input($featured['expires_date']).'\' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      } else {
	// delete featured
	$sql = 'DELETE FROM ' . TABLE_FEATURED . ' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      }
    }
    if (isset($specials)) {
      if (!empty($specials['specials_new_products_price'])) {
	// prepare data
	$status = 1;
	if (!isset($specials['specials_date_available']) || empty($specials['specials_date_available'])) {
	  $specials['specials_date_available'] = '0001-01-01';
	  $status = $status * 1;
	} else {
	  $available_time = strtotime($specials['specials_date_available']);
	  if ($available_time !== false && $available_time <= time()) {
	    $status = $status * 1;
	  } else {
	    $status = $status * 0;
	  }
	}
	if (!isset($specials['expires_date']) || empty($specials['expires_date'])) {
	  $specials['expires_date'] = '0001-01-01';
	  $status = $status * 1;
	} else {
	  $expire_time = strtotime($specials['expires_date']);
	  if ($expire_time !== false && $expire_time >= time()) {
	    $status = $status * 1;
	  } else {
	    $status = $status * 0;
	  }
	}

	// set specials
	$sql = 'SELECT * FROM ' . TABLE_SPECIALS . ' WHERE products_id='.$products_id.'';
	$specials_record = $this->db->Execute($sql);
	if ($specials_record->RecordCount() == 0) {
	  $sql = 'INSERT INTO ' . TABLE_SPECIALS . ' (products_id, specials_date_added, specials_last_modified) VALUES (\''.$products_id.'\', NOW(), NOW())';
	  $this->db->Execute($sql);
	}
	$sql = 'UPDATE ' . TABLE_SPECIALS . ' SET specials_new_products_price=\''.zen_db_input($specials['specials_new_products_price']).'\', expires_date=\''.zen_db_input($specials['expires_date']).'\', specials_date_available=\''.zen_db_input($specials['specials_date_available']).'\', status='.$status.', date_status_change=NOW(), specials_last_modified=NOW() WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      } else {
	// delete specials
	$sql = 'DELETE FROM ' . TABLE_SPECIALS . ' WHERE products_id='.$products_id.'';
	$this->db->Execute($sql);
      }
    }
    // update products_price_sorter
    $special_price = zen_get_products_special_price($products_id);
    $products_price = (isset($products_price)) ? $products_price : 0;
    $products_price_sorter = ($special_price === false) ? $products_price : $special_price;
    $sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET products_price_sorter=\''.zen_db_input($products_price_sorter).'\' WHERE products_id='.$products_id;
    $this->db->Execute($sql);

    $this->messageStack->add(PRODUCT_CSV_MESSAGE_SUCCESS, 'success');
    return true;
  }
  // import each line
  function importCategory($data, $format) {
    // prepare data
    $validate = true;
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $delete_id = $delete_column['csv_column_id'];
    $category_name_flag = 0;
    $extra_depth = 0;
    $this->messageStack->reset();
    // validate
    foreach ($format['columns'] as $key => $val) {
      if (!empty($val['csv_column_validate_function'])) {
	$validate_function = $val['csv_column_validate_function'];
	if ($this->$validate_function($data[$key], $val['csv_column_name']) === true) {
	  $validate = $validate && true;
	} else {
	  $validate = $validate && false;
	}
      }

      if ($val['csv_column_id'] == $delete_id) {
	if ($data[$key] == 1) {
	  $delete_flag = true;
	} else {
	  $delete_flag = false;
	}
      }
      // store category name
      if ($val['number'] > 0 && $val['language_id'] > 0) {
	$category_name[$val['number']][$val['language_id']] = $data[$key];
	if ($val['language_id'] == MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID && $data[$key] != '') {
	  $category_name_flag += pow(2, ($val['number']-1));
	} elseif ($data[$key] != '') {
	  $extra_depth = $extra_depth > $val['number'] ? $extra_depth : $val['number'];
	}
      }
    }
    // check if category is sequential
    switch ($category_name_flag) {
    case 1:
      $depth = 1;
      break;
    case 3:
      $depth = 2;
      break;
    case 7:
      $depth = 3;
      break;
    case 15:
      $depth = 4;
      break;
    case 31:
      $depth = 5;
      break;
    case 63:
      $depth = 6;
      break;
    case 127:
      $depth = 7;
      break;
    case 255:
      $depth = 8;
      break;
    case 511:
      $depth = 9;
      break;
    case 1023:
      $depth = 10;
      break;
    default:
      // check top level category
      if (($category_name_flag & 1) != 1) {
	$validate = $validate && false;
	$this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_TOPLEVEL_CATEGORY, 'caution');
      } else {
	$validate = $validate && false;
	$this->messageStack->add(PRODUCT_CSV_MESSAGE_NOT_SEQUENTIAL, 'caution');
      }
      break;
    }
    if (is_numeric($depth) && $extra_depth > $depth) {
      $validate = $vaidate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_CATEGORY_NAME, 'caution');
    }
    // return if validate is false
    if ($validate === false) {
      return false;
    }
    // check and insert category name
    $parent_id = 0;
    for ($i=1; $i<=$depth; $i++) {
      $sql = 'SELECT c.categories_id FROM ' . TABLE_CATEGORIES . ' c LEFT JOIN ' . TABLE_CATEGORIES_DESCRIPTION . ' cd ON c.categories_id=cd.categories_id
              WHERE language_id='.MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID.'
              AND categories_name=\''.zen_db_input($category_name[$i][MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID]).'\'
              AND parent_id='.$parent_id.'';
      $category_record = $this->db->Execute($sql);
      if ($category_record->RecordCount() == 1) {
	$category_id = $category_record->fields['categories_id'];
	foreach ($category_name[$i] as $language_id => $name) {
	  if ($language_id == MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID) {
	    continue;
	  }
	  $sql = 'SELECT categories_id FROM ' . TABLE_CATEGORIES_DESCRIPTION . '
                  WHERE language_id='.$language_id.' AND categories_name=\''.zen_db_input($name).'\' AND categories_id='.$category_id.'';
	  $category_record = $this->db->Execute($sql);
	  if ($category_record->RecordCount() == 0) {
	    $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_MATCH, $name), 'caution');
	    return false;
	  }
	}
      } else {
	// check child products
	$sql = 'SELECT categories_id FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' WHERE categories_id='.$parent_id.'';
	$category_record = $this->db->Execute($sql);
	if ($category_record->RecordCount() == 0) {
	  // insert new category
	  $sql = 'INSERT INTO ' . TABLE_CATEGORIES . ' (date_added, last_modified, parent_id) VALUES (NOW(), NOW(), \''.$parent_id.'\')';
	  $this->db->Execute($sql);
	  $category_id = $this->db->Insert_ID();
	  foreach ($category_name[$i] as $language_id => $name) {
	    $sql = 'INSERT INTO ' . TABLE_CATEGORIES_DESCRIPTION . ' (categories_id, language_id, categories_name) VALUES (\''.$category_id.'\', \''.$language_id.'\', \''.zen_db_input($name).'\')';
	    $this->db->Execute($sql);
	    $this->messageStack->add(PRODUCT_CSV_MESSAGE_CREATE_CATEGORY, 'success');
	  } 
	}
	else {
	  $this->messageStack->add(PRODUCT_CSV_MESSAGE_CANNOT_ADD_CATEGORY, 'caution');
	  return false;
	}
      }
      $parent_id = $category_id;
    }
    foreach ($format['columns'] as $key => $val) {
      if ($val['csv_column_id'] == $ignore_id) {
	continue;
      }
      if ($val['csv_columns_dbtable'] == 'categories') {
	if ($val['csv_columns_dbcolumn'] == 'categories_status' && $data[$key] == '') {
	  continue;
	}
	$sql = 'UPDATE ' . DB_PREFIX.$val['csv_columns_dbtable'] . ' SET ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\' WHERE categories_id='.$category_id.'';
	$this->db->Execute($sql);
      } elseif ($val['csv_columns_dbtable'] == 'categories_description' && $val['csv_columns_dbcolumn'] == 'categories_description') {
	if (isset($val['language_id'])) {
	  $sql = 'UPDATE ' . DB_PREFIX.$val['csv_columns_dbtable'] . ' SET ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]).'\' WHERE categories_id='.$category_id.' AND language_id='.$language_id.'';
	  $this->db->Execute($sql);
	}
      } elseif ($val['csv_columns_dbtable'] == 'products' && $data[$key] != '') {
	if (zen_childs_in_category_count($category_id) > 0) {
	  // category has sub category
	  $this->messageStack->add(PRODUCT_CSV_MESSAGE_CANNOT_ADD_PRODUCT, 'caution');
	  return false;
	} else {
	  // category doesnt have sub category
	  $sql = 'SELECT products_id, master_categories_id FROM ' . TABLE_PRODUCTS . ' WHERE products_model=\''.zen_db_input($data[$key]).'\'';
	  $product_record = $this->db->Execute($sql);
	  // check products_model
	  if ($product_record->RecordCount() == 1) {
	    $products_id = $product_record->fields['products_id'];
	    $master_categories_id = $product_record->fields['master_categories_id'];
	    if ($delete_flag !== true) {
	      if ($master_categories_id == 0) {
		// update master_categories_id
		$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET master_categories_id='.$category_id.' WHERE products_id='.$products_id.'';
		$this->db->Execute($sql);
	      }
	      $sql = 'SELECT products_id, categories_id FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' WHERE products_id='.$products_id.' AND categories_id='.$category_id.'';
	      $record = $this->db->Execute($sql);
	      if ($record->RecordCount() == 0) {
		$sql = 'INSERT INTO ' . TABLE_PRODUCTS_TO_CATEGORIES . ' (products_id, categories_id) VALUES (\''.$products_id.'\', \''.$category_id.'\')';
		$this->db->Execute($sql);
	      }
	    } else {
	      // delete
	      $sql = 'DELETE FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' WHERE products_id='.$products_id.' AND categories_id='.$category_id.'';
	      $this->db->Execute($sql);
	      if ($master_categories_id == $category_id) {
		$sql = 'SELECT categories_id FROM ' . TABLE_PRODUCTS_TO_CATEGORIES . ' WHERE products_id='.$products_id.'';
		$record = $this->db->Execute($sql);
		if ($record->RecordCount() == 0) {
		  $categories_id = 0;
		} else {
		  $categories_id = $record->fields['categories_id'];
		}
		$sql = 'UPDATE ' . TABLE_PRODUCTS . ' SET master_categories_id=\''.$categories_id.'\' WHERE products_id='.$products_id.'';
		$this->db->Execute($sql);
	      }
	      $this->messageStack->add(PRODUCT_CSV_MESSAGE_DELETE_CATEGORY, 'success');
	    }
	  } else {
	    $this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_MODEL, 'caution');
	    return false;
	  }
	}
      } elseif ($val['csv_columns_dbtable'] == 'meta_tags_categories_description') {
	if (isset($val['language_id'])) {
	  $meta_tags[$val['language_id']][$val['csv_columns_db_column']] = $data[$key];
	}
      }
    }
    if (isset($meta_tags)) {
      foreach ($meta_tags as $key => $val) {
	if (!empty($val['metatags_title']) || !empty($val['metatags_keywords']) || !empty($val['metatags_description'])) {
	  $sql = 'SELECT * FROM ' . TABLE_METATAGS_CATEGORIES_DESCRIPTION . ' WHERE categories_id='.$category_id.' AND language_id='.$key.'';
	  $meta_tags_record = $this->db->Execute($sql);
	  if ($meta_tags_record->RecordCount() == 0) {
	    $sql = 'INSERT INT ' . TABLE_METATAGS_CATEGORIES_DESCRIPTION . ' (categories_id, language_id) VALUES (\''.$category_id.'\',\''.$key.'\')';
	    $this->db->Execute($sql);
	  }
	  $sql = 'UPDATE ' . TABLE_METATAGS_CATEGORIES_DESCRIPTION . ' SET metatags_title=\''.zen_db_input($val['metatags_title']).'\', metatags_keywords=\''.zen_db_input($val['metatags_keywords']).'\', metatags_description=\''.zen_db_input($val['metatags_description']).'\' WHERE categories_id='.$category_id.' AND language_id='.$key.'';
	  $this->db->Execute($sql);
	} else {
	  // delete meta tags
	  $sql = 'DELETE FROM ' . TABLE_METATAGS_CATEGORIES_DESCRIPTION . ' WHERE categories_id='.$category_id.' AND language_id='.$key.'';
	  $this->db->Execute($sql);
	}
      }
    }
    $this->messageStack->add(PRODUCT_CSV_MESSAGE_SUCCESS, 'success');
    return true;
  }
  function importOption($data, $format) {
    // prepare data
    $validate = true;
    $ignore_column = $this->getFormatColumnIgnore($format['csv_format_type_id']);
    $ignore_id = $ignore_column['csv_column_id'];
    $delete_column = $this->getFormatColumnDelete($format['csv_format_type_id']);
    $delete_id = $delete_column['csv_column_id'];
    $this->messageStack->reset();
    // search products_model and validate
    foreach ($format['columns'] as $key => $val) {
      if (!empty($val['csv_column_validate_function'])) {
	$validate_function = $val['csv_column_validate_function'];
	if ($this->$validate_function($data[$key], $val['csv_column_name']) === true) {
	  $validate = $validate && true;
	} else {
	  $validate = $validate && false;
	}
      }

      if ($val['csv_columns_dbtable'] == 'products' && $val['csv_columns_dbcolumn'] == 'products_model') {
	$products_model = $data[$key];
      }
      if ($val['csv_columns_dbtable'] == 'products_options_values' && $val['csv_columns_dbcolumn'] == 'products_options_values_name') {
	$value_name[$val['language_id']] = $data[$key];
      }
      if ($val['csv_columns_dbtable'] == 'products_options' && $val['csv_columns_dbcolumn'] == 'products_options_name') {
	$option_name[$val['language_id']] = $data[$key];
      }
      if ($val['csv_column_id'] == $delete_id) {
	if ($data[$key] == 1) {
	  $delete_flag = true;
	} else {
	  $delete_flag = false;
	}
      }
    }
    if (isset($products_model) && empty($products_model)) {
      $validate = $validate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_MODEL, 'warning');
    } else {
      $sql = 'SELECT * FROM ' . TABLE_PRODUCTS . ' WHERE products_model=\''.zen_db_input($products_model).'\'';
      $products = $this->db->Execute($sql);
      if ($products->RecordCount() > 0) {
	$product_id = $products->fields['products_id'];
      } else {
	$validate = $vaidate && false;
	$this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_MODEL, 'warning');
      }
    }
    // check option name
    $option_name_exists = false;
    foreach ($option_name as $language_id => $name) {
      if ($name != '') {
	$option_name_exists = true;
	break;
      }
    }
    if (!$option_name_exists) {
      $validate = $validate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_OPTION_NAME_IS_EMPTY, 'caution');
    }
    $conditions = array();
    $froms = array();
    foreach($option_name as $language_id => $name) {
      $po = 'po'.$language_id;
      $sub_condition = empty($po_prev) ? '' : ' AND ' . $po_prev.'.products_options_id='.$po.'.products_options_id';
      $conditions[] = ' '.$po.'.language_id='.$language_id.' AND '.$po.'.products_options_name=\''.zen_db_input($name).'\''.$sub_condition;
      $froms[] = ' '.TABLE_PRODUCTS_OPTIONS.' '.$po;
      $po_prev = $po;
    }
    $sql = 'SELECT distinct '.$po.'.products_options_id FROM '.implode(',',$froms).' WHERE '.implode(' AND ', $conditions);
    $options = $this->db->Execute($sql);
    if ($options->RecordCount() == 0) {
      $validate = $validate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_NO_OPTION_NAME, 'caution');
    } else {
      while(!$options->EOF) {
	$option_id = $options->fields['products_options_id'];
	$options->MoveNext();
      }
    }
    // check option value
    $option_value_exists = false;
    foreach ($value_name as $language_id => $name) {
      if ($name != '') {
	$option_value_exists = true;
	break;
      }
    }
    if (!$option_value_exists) {
      $validate = $validate && false;
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_OPTION_VALUE_IS_EMPTY, 'caution');
    }
    $conditions = array();
    $froms = array();
    foreach($value_name as $language_id => $name) {
      $pov = 'pov'.$language_id;
      $sub_condition = empty($pov_prev) ? '' : ' AND ' . $pov_prev.'.products_options_values_id='.$pov.'.products_options_values_id';
      $conditions[] = ' '.$pov.'.language_id='.$language_id.' AND '.$pov.'.products_options_values_name=\''.zen_db_input($name).'\''.$sub_condition;
      $froms[] = ' '.TABLE_PRODUCTS_OPTIONS_VALUES.' '.$pov;
      $pov_prev = $pov;
    }
    $sql = 'SELECT distinct '.$pov.'.products_options_values_id FROM '.implode(',',$froms).' WHERE '.implode(' AND ', $conditions);
    $values = $this->db->Execute($sql);
    while(!$values->EOF) {
      $value_id = $values->fields['products_options_values_id'];
      $values->MoveNext();
    }
    // return if validate is false
    if ($validate === false) {
      return false;
    }
    // delete attribute
    if ($delete_flag === true && isset($option_id) && isset($product_id) && isset($value_id)) {
      $sql = 'DELETE FROM ' . TABLE_PRODUCTS_ATTRIBUTES . ' WHERE options_id='.$option_id.' AND products_id='.$product_id.' AND options_values_id='.$value_id;
      $this->db->Execute($sql);
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_OPTION_DELETE, 'success');
      return true;
    }
    // insert values
    if (!isset($value_id)) {
      // get products_options_values_id
      $sql = 'SELECT MAX(products_options_values_id) as max FROM ' . TABLE_PRODUCTS_OPTIONS_VALUES;
      $temp = $this->db->Execute($sql);
      $products_options_values_id = empty($temp->fields['max']) ? 0 : $temp->fields['max'];
      $products_options_values_id += 1; // increment
      foreach($value_name as $language_id => $name) {
	$sql = 'INSERT INTO ' . TABLE_PRODUCTS_OPTIONS_VALUES . ' (products_options_values_id, language_id, products_options_values_name) VALUES ('.$products_options_values_id.','.$language_id.', \''.zen_db_input($name).'\')';
	$values = $this->db->Execute($sql);
	$value_id = $products_options_values_id;
	$this->messageStack->add(PRODUCT_CSV_MESSAGE_OPTION_VALUE, 'success');
      }
    }
    // get attributes_id
    $sql = 'SELECT products_attributes_id FROM ' . TABLE_PRODUCTS_ATTRIBUTES . ' WHERE products_id='.$product_id.' AND options_id='.$option_id.' AND options_values_id='.$value_id;
    $attributes = $this->db->Execute($sql);
    if ($attributes->RecordCount() > 0) {
      $attribute_id = $attributes->fields['products_attributes_id'];
    } else {
      $sql = 'INSERT INTO ' . TABLE_PRODUCTS_ATTRIBUTES . ' (products_id, options_id, options_values_id, product_attribute_is_free, attributes_default, attributes_discounted, attributes_required) VALUES ('.$product_id.','.$option_id.','.$value_id.', 0, 0, 0, 0)';
      $attributes = $this->db->Execute($sql);
      $attribute_id = $this->db->Insert_ID();
    }
    // update attribute
    foreach ($format['columns'] as $key => $val) {
      if ($val['csv_column_id'] == $ignore_id) {
	continue;
      }
      if ($val['csv_columns_dbtable'] == 'products_attributes') {
	if ($data[$key] == '' && ($val['csv_columns_dbcolumn'] == 'product_attribute_is_free' || $val['csv_columns_dbcolumn'] == 'attributes_default' || $val['csv_columns_dbcolumn'] == 'attributes_discounted' || $val['csv_columns_dbcolumn'] == 'attributes_required')) {
	  continue;
	}
	$sql = 'UPDATE ' . TABLE_PRODUCTS_ATTRIBUTES . ' SET ' . $val['csv_columns_dbcolumn'] . '=\''.zen_db_input($data[$key]) . '\' WHERE products_attributes_id='.$attribute_id;
	$this->db->Execute($sql);
      }
    }
    $this->messageStack->add(PRODUCT_CSV_MESSAGE_SUCCESS, 'success');
    return true;
  }

  // validate function
  function validateIsString($data, $name) {
    if (preg_match('/^.*$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_STRING, $name), 'caution');
      return false;
    }
  }
  function validateIsStringWithReturn($data, $name) {
    if (preg_match('/^.*/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_STRING, $name), 'caution');
      return false;
    }
  }
  function validateIsPathString($data, $name) {
    if (preg_match('/^[a-zA-Z0-9.\/_-]*$/', $data) && !preg_match('/\.\.\//', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_PATHSTRING, $name), 'caution');
      return false;
    }
  }
  function validateIsUrlString($data, $name) {
    if (preg_match('/^(https?:\/\/[a-zA-Z0-9-.$,;:&=?!*~@#_()\/]*)?$/', $data)) {
	return true;
      } else {
	$this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_URLSTRING, $name),'caution');
	return false;
      }
  }
  function validateIsInt($data, $name) {
    if (preg_match('/^([0-9]*)?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_INT, $name), 'caution');
      return false;
    }
  }
  function validateIsSignedInt($data, $name) {
    if (preg_match('/^([+-]?[0-9]*)?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_SIGNED_INT, $name), 'caution');
      return false;
    }
  }
  function validateIsFloat($data, $name) {
    if (preg_match('/^([0-9]{1,}(\.[0-9]+)?)?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_FLOAT, $name), 'caution');
      return false;
    }
  }
  function validateIsSignedFloat($data, $name) {
    if (preg_match('/^([+-]?[0-9]{1,}(\.[0-9]+)?)?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_SIGNED_FLOAT, $name), 'caution');
      return false;
    }
  }
  function validateIsZeroOne($data, $name) {
    if ($data == '') {
      return true;
    }
    if (is_numeric($data) && ($data == 0 || $data == 1)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_ZERO_ONE, $name), 'caution');
      return false;
    }
  }
  function validateIsPlusMinus($data, $name) {
    if ($data == '+' || $data == '-' || $data == '') {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_PLUS_MINUS, $name), 'caution');
      return false;
    }
  }
  function validateIsNotReservedOptionName($data, $name) {
    if ($data == PRODUCT_CSV_RESERVED_OPTION_NAME) {
      $this->messageStack->add(PRODUCT_CSV_MESSAGE_OPTION_NAME_RESERVED, 'caution');
      return false;
    }
    return $this->validateIsString($data, $name);
  }
  function validateIsDatetimeShort($data, $name) {
    if (preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2})?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_DATETIME_SHORT, $name), 'caution');
      return false;
    }
  }
  function validateIsDatetimeLong($data, $name) {
    if (preg_match('/^([0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}:[0-9]{2})?$/', $data)) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NOT_DATETIME_LONG, $name), 'caution');
      return false;
    }
  }
  function validateProductTypeExists($data, $name) {
    $sql = 'SELECT * FROM ' . TABLE_PRODUCT_TYPES . ' WHERE type_handler=\''.zen_db_input($data).'\'';
    $temp = $this->db->Execute($sql);
    if ($temp->RecordCount() > 0) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NO_PRODUCT_TYPE, $data), 'caution');
      return false;
    }
  }
  function validateTaxClassExists($data, $name) {
    if ($data == '') {
      return true;
    }
    $sql = 'SELECT * FROM ' . TABLE_TAX_CLASS . ' WHERE tax_class_title=\''.zen_db_input($data).'\'';
    $temp = $this->db->Execute($sql);
    if ($temp->RecordCount() > 0) {
      return true;
    } else {
      $this->messageStack->add(sprintf(PRODUCT_CSV_MESSAGE_NO_TAX_CLASS_TITLE, $data), 'caution');
      return false;
    }
  }
}

// class message stack
class ProductCSVMessageStack extends messageStack {
  function ProductCSVMessageStack() {
    $this->reset();
  }
}
?>
