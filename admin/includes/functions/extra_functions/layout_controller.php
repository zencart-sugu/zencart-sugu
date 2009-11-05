<?php
// get all layout_pages 
function zen_get_all_layout_pages()
{
  $layout_pages_array = array(
    array('id' => LAYOUT_PAGE_ID_DEFAULT, 'text' => LAYOUT_PAGE_TEXT_DEFAULT),
    array('id' => LAYOUT_PAGE_ID_INDEX, 'text' => LAYOUT_PAGE_TEXT_INDEX),
    array('id' => LAYOUT_PAGE_ID_PRODUCT_LIST, 'text' => LAYOUT_PAGE_TEXT_PRODUCT_LIST),
    array('id' => LAYOUT_PAGE_ID_PRODUCT_INFO, 'text' => LAYOUT_PAGE_TEXT_PRODUCT_INFO),
    array('id' => LAYOUT_PAGE_ID_SHOPPING_CART, 'text' => LAYOUT_PAGE_TEXT_SHOPPING_CART),
    array('id' => LAYOUT_PAGE_ID_MYPAGE, 'text' => LAYOUT_PAGE_TEXT_MYPAGE)
  );

  return $layout_pages_array;
}

// get setuped layout_pages on $template_dir
function zen_get_setuped_layout_pages($template_dir)
{
  global $db;

  $layout_pages_array = array();
  $layout_pages = $db->Execute("SELECT layout_page FROM " . TABLE_LAYOUT_BOXES . " WHERE layout_template = '" . zen_db_prepare_input($template_dir) . "' GROUP BY layout_page");
  while( !$layout_pages->EOF ){
    $layout_pages_array[] = array('id' => $layout_pages->fields['layout_page'], 'text' => zen_get_layout_page_name($layout_pages->fields['layout_page']));
    $layout_pages->MoveNext();
  }
  return $layout_pages_array;
}

// get not setuped layout pages on $templated_dir
function zen_get_not_setuped_layout_pages($template_dir)
{
  global $db;

  $setuped_pages_id = array();
  $setuped_pages = $db->Execute("SELECT layout_page FROM " . TABLE_LAYOUT_BOXES . " WHERE layout_template = '" . zen_db_prepare_input($template_dir) . "' GROUP BY layout_page");
  while( !$setuped_pages->EOF ){
    $setuped_pages_id[] = $setuped_pages->fields['layout_page'];
    $setuped_pages->MoveNext();
  }

  $not_setuped_pages = array();
  $all_pages = zen_get_all_layout_pages();
  foreach( $all_pages as $page ){
    if( !in_array($page['id'], $setuped_pages_id) ){
      $not_setuped_pages[] = $page;
    }
  }
  return $not_setuped_pages;
}

// get layout_page name by $layout_page_id
function zen_get_layout_page_name($layout_page_id)
{
  $name = '';
  $all_layout_pages = zen_get_all_layout_pages();
  foreach( $all_layout_pages as $layout_page_info ){
    if( $layout_page_info['id'] == $layout_page_id ){
      $name = $layout_page_info['text'];
      break;
    }
  }
  return $name;
}
?>
