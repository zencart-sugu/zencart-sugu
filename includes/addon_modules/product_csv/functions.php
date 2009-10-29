<?php
function zen_set_column_with_language($INSERT_SQL, $values) {
  global $db;

  $languages = zen_get_languages();
  foreach($languages as $val) {
    $name = preg_replace('/LANGUAGE_NAME/', $val['name'], $values['name']);
    $name = preg_replace('/LANGUAGE_ID/' , 'language_id='.$val['id'], $name);
    $insert_sql = sprintf($INSERT_SQL, $values['column_id'], $values['type_id'], $name, $values['validate'], $values['dbtable'], $values['dbcolumn']);
    $db->Execute($insert_sql);
    $values['column_id'] = $values['column_id'] + 1;
  }
}

// from http://php.benscom.com/manual/ja/function.ini-get.php
function return_bytes($val) {
  $val = trim($val);
  $last = strtolower($val[strlen($val)-1]);
  switch($last) {
    // 'G' は PHP 5.1.0 以降で使用可能です
  case 'g':
    $val *= 1024;
  case 'm':
    $val *= 1024;
  case 'k':
    $val *= 1024;
  }

  return $val;
}

function checkNecessity($posted_columns, $saved_columns) {
  global $messageStack;
  // get format type id
  $format_type_id = $saved_columns[0]['csv_format_type_id'];
  // get required name
  switch ($format_type_id) {
  case 1:
    $necessity = FORM_FORMAT_NECESSITY_PRODUCT;
    break;
  case 2:
    $necessity = FORM_FORMAT_NECESSITY_SHORT_CATEGORY;
    break;
  case 3:
    $necessity = FORM_FORMAT_NECESSITY_OPTION;
    break;
  }
  // get required id
  $columns = array();
  foreach ($saved_columns as $val) {
    if (preg_match('/'.$necessity.'$/', $val['text'])) {
      $ids[] = $val['id'];
    }
    // for use category check
    if ($val['language_id'] == MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID) {
      $columns[$val['id']] = $val['text'];
    }
  }
  // check required
  $return = false;
  if ($format_type_id != 2) {
    foreach ($posted_columns as $val) {
      if (in_array($val, $ids)) {
	$return = true;
      }
    }
  } else {
    // for categories
    $return = true;
    $arr = array();
    // get category number each language
    foreach ($posted_columns as $val) {
      if (preg_match('/^(.*)'.FORM_FORMAT_CATEGORY_LEVEL_PREFIX.'([1-9]*)$/', $columns[$val], $matches)) {
	$arr[$matches[1]][] = $matches[2];
	$category_prefix = $matches[1];
      }
    }
    // check top level(1) category
    foreach ($arr as $val) {
      if (!in_array(1, $val)) {
	$return = false;
      }
    }
  }
  if ($return == false) {
    if ($format_type_id == 2) {
      $necessity = $category_prefix . $necessity;
    }
    $messageStack->add(sprintf(FORM_FORMAT_ERROR_NECESSITY, $necessity), 'caution');
  }
  return $return;
}
function checkNecessityOption($posted_columns, $saved_columns) {
  global $messageStack;
  list($necessity1, $necessity2, $necessity3) = explode(' ', FORM_FORMAT_NECESSITY_OPTION);
  $columns = array();
  foreach ($saved_columns as $val) {
    if (preg_match('/'.$necessity1.'/',$val['text'])) {
      $columns[$val['language_id']][] = $val['id'];
    } elseif (preg_match('/'.$necessity2.'/',$val['text'])) {
      $columns[$val['language_id']][] = $val['id'];
    } elseif (preg_match('/'.$necessity3.'/',$val['text'])) {
      $products_model_id = $val['id'];
    }
  }
  $return = false;
  foreach ($columns as $language_id => $ids) {
    if (in_array($ids[0], $posted_columns) && in_array($ids[1], $posted_columns)) {
      $return = true;
    }
  }
  if (in_array($products_model_id, $posted_columns)) {
    $return = $return && true;
  } else {
    $return = $return && false;
  }
  if ($return == false) {
    $messageStack->add(sprintf(FORM_FORMAT_ERROR_NECESSITY, FORM_FORMAT_NECESSITY_OPTION), 'caution');
  }
  return $return;
}
function checkDuplicate($posted_columns, $saved_columns, $allowed_column) {
  global $messageStack;
  $allowed_id = $allowed_column['csv_column_id'];
  // create id=>text array
  $columns = array();
  foreach ($saved_columns as $val) {
    $columns[$val['id']] = $val['text'];
  }
  // check repeated id
  $arr = array();
  $return = true;
  foreach($posted_columns as $val) {
    if (isset($arr[$val])) {
      if ($val != $allowed_id) {
	$return = false;
	$arr[$val] += 1;
      }
    } else {
      $arr[$val] = 1;
    }
  }
  // create message stack
  foreach($arr as $key => $val) {
    if ($val > 1) {
      $messageStack->add(sprintf(FORM_FORMAT_ERROR_REPEATED, $columns[$key]), 'caution');
    }
  }

  return $return;
}
function checkSequential($posted_columns, $saved_columns) {
  global $messageStack;
  // create id=>text array
  $columns = array();
  foreach ($saved_columns as $val) {
    $columns[$val['id']] = $val['text'];
  }
  // get category level
  $arr = array();
  foreach ($posted_columns as $val) {
    if (preg_match('/^(.*)('.FORM_FORMAT_CATEGORY_LEVEL_PREFIX.')(\d+)/', $columns[$val], $matches)) {
      $arr[$matches[1]][] = $matches[3];
    }
  }
  // check it
  $return = true;
  foreach ($arr as $key => $val) {
    sort($val);
    $next = 1;
    foreach ($val as $level) {
      if (isset($next)) {
	if ($level != $next) {
	  $return = false;
	  $messageStack->add(sprintf(FORM_FORMAT_CATEGORY_LEVEL_SEQ_ERROR, $key), 'caution');
	  break;
	}
      }
      $next = $level + 1;
    }
  }
  return $return;
}
function checkDepth($posted_columns, $saved_columns) {
  global $messageStack;
  // create id=>array
  $columns = array();
  foreach ($saved_columns as $val) {
    $columns[$val['id']] = $val;
  }
  // get category array
  $arr = array();
  $preferred = array();
  foreach ($posted_columns as $val) {
    if (preg_match('/^(.*)('.FORM_FORMAT_CATEGORY_LEVEL_PREFIX.')(\d+)/', $columns[$val]['text'], $matches)) {
      if ($columns[$val]['language_id'] == MODULE_PRODUCT_CSV_PREFERRED_LANGUAGE_ID) {
	$preferred[0]['columns'][] = $columns[$val];
	$preferred[0]['name'] = $matches[1];
      } else {
	$arr[$matches[1]]['columns'][] = $columns[$val];
      }
    }
  }
  // check
  $return = true;
  $preferred = zen_add_number_to_format($preferred[0]);
  $preferred_max_depth = zen_get_max_depth($preferred);
  foreach ($arr as $val) {
    $val = zen_add_number_to_format($val);
    if ($preferred_max_depth < zen_get_max_depth($val)) {
      $messageStack->add(sprintf(FORM_FORMAT_CATEGORY_LEVEL_OVER, $preferred['name']), 'caution');
      $return = false;
    }
  }
  return $return;
}

function zen_add_number_to_format($format) {
  foreach ($format['columns'] as $key => $val) {
    if ($val['csv_columns_dbtable'] == 'categories_description' && $val['csv_columns_dbcolumn'] == 'categories_name') {
      if (preg_match('/(\d+)/', $val['csv_column_name'], $matches)) {
	$format['columns'][$key]['number'] = $matches[1];
      }
    }
  }
  return $format;
}
function zen_get_max_depth($format) {
  $number = 1;
  foreach ($format['columns'] as $key => $val) {
    if (array_key_exists('number', $val)) {
      $number = $number > $val['number'] ? $number : $val['number'];
    }
  }
  return $number;
}
function zen_get_categories_with_depth($category_id, $depth) {
  global $db;
  $categories = array();
  $categories_array = array();
  $columns = array();
  $tables = array();
  $conditions = array();
  $join = '';
  $on = '';

  // get categories
  for ($i=0; $i<$depth; $i++) {
    $columns[] = 'c'.$i.'.categories_id as c'.$i.'id';
    if ($i>0) {
      $join = ' LEFT JOIN ';
      $on = ' ON c'.($i-1).'.categories_id=c'.$i.'.parent_id';
    }
    $tables[] = $join . TABLE_CATEGORIES . ' as c'.$i.$on;
    $conditions[] = 'c'.$i.'.categories_id='.zen_db_input($category_id);
  }
  $sql = 'SELECT ' . implode(',', $columns) . ' FROM ' . implode('', $tables) . ' WHERE c0.parent_id=0';
  if ($category_id != 0) {
    $sql .= ' AND (' . implode(' OR ', $conditions) . ')';
  }
  $categories_record = $db->Execute($sql);
  while (!$categories_record->EOF) {
    $data = array();
    foreach ($categories_record->fields as $id) {
      $data[] = $id;
    }
    $categories[] = $data;
    $categories_record->MoveNext();
  }
  if (count($categories) == 0) {
    zen_get_parent_categories($categories_array, $category_id);
    if (count($categories_array) > 0) {
      $categories_array = array_reverse($categories_array);
      $categories_array[] = $category_id;
      if (count($categories_array) >= $depth) {
	$categories = array(array_slice($categories_array, 0, $depth));
      }
    }
  }

  return $categories;
}
function zen_get_attributes($products_id) {
  global $db;
  $products_id = zen_db_input($products_id);
  $sql = 'SELECT products_attributes_id FROM ' . TABLE_PRODUCTS_ATTRIBUTES . ' pa WHERE pa.products_id='.$products_id;
  $attributes = $db->Execute($sql);
  $attributes_ids = array();
  while (!$attributes->EOF) {
    $attributes_ids[] = $attributes->fields['products_attributes_id'];
    $attributes->MoveNext();
  }
  return $attributes_ids;
}
?>