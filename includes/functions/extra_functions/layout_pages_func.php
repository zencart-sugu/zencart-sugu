<?php
function zen_get_current_layout_page($template_dir)
{
  $layout_page = zen_get_layout_page($_GET['main_page']);
  // use default setting if there is no current page setting.
  if( ! zen_exists_layout_page_setting( $template_dir, $layout_page ) ){
    $layout_page = LAYOUT_PAGE_ID_DEFAULT;
  }
  return $layout_page;
}

function zen_get_layout_page( $page_name )
{
  $layout_page = LAYOUT_PAGE_ID_DEFAULT;

  switch( $page_name ){
    // top
    case '':
    case 'index':
      if( isset($_GET['cPath']) ){
        $layout_page = LAYOUT_PAGE_ID_PRODUCT_LIST;
      }else{
        $layout_page = LAYOUT_PAGE_ID_INDEX;
      }
      break;
    // product list
    case 'featured_products':
    case 'products_all':
    case 'products_new':
    case 'specials':
      $layout_page = LAYOUT_PAGE_ID_PRODUCT_LIST;
      break;
    // product info
    case 'product_info':
    case 'product_music_info':
    case 'product_free_shipping_info':
    case 'document_general_info':
    case 'document_product_info':
      $layout_page = LAYOUT_PAGE_ID_PRODUCT_INFO;
      break;
    // shopping cart
    case 'shopping_cart':
    case 'checkout_confirmation':
    case 'checkout_payment':
    case 'checkout_payment_address':
    case 'checkout_process':
    case 'checkout_shipping':
    case 'checkout_shipping_address':
    case 'checkout_success':
      $layout_page = LAYOUT_PAGE_ID_SHOPPING_CART;
      break;
    // mypage
    case 'account':
    case 'account_edit':
    case 'account_history':
    case 'account_history_info':
    case 'account_newsletters':
    case 'account_notifications':
    case 'account_password':
    case 'address_book':
    case 'address_book_process':
      $layout_page = LAYOUT_PAGE_ID_MYPAGE;
      break;
    default:
      break;
  }

  return $layout_page;
}

function zen_exists_layout_page_setting($template_dir, $layout_page)
{
  global $db;

  $check = $db->Execute("SELECT layout_box_name FROM " . TABLE_LAYOUT_BOXES . " WHERE layout_template = '" . zen_db_prepare_input($template_dir) . "' AND layout_page = '" . zen_db_prepare_input($layout_page) . "'");

  return( $check->RecordCount() > 0 );
}
?>
