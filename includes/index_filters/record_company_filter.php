<?php
/**
 * record_company_filter.php  for index filters
 *
 * index filter for the music product type
 * show the products of a specified record company
 *
 * @package productTypes
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @todo Need to add/fine-tune ability to override or insert entry-points on a per-product-type basis
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: record_company_filter.php 3010 2006-02-11 16:08:42Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  if (!isset($select_column_list)) $select_column_list = "";
 // show the products of a specified record-company
  if (isset($_GET['record_company_id']))
  {
    if (isset($_GET['filter_id']) && zen_not_null($_GET['filter_id']))
    {
      // We are asked to show only a specific category
      $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type, p.products_price, p.products_tax_class_id, pd.products_description, if(s.status = 1, s.specials_new_products_price, NULL) AS specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping
        from " . TABLE_PRODUCTS . " p, " .
        TABLE_PRODUCTS_DESCRIPTION . " pd, " .
        TABLE_PRODUCT_MUSIC_EXTRA . " pme left join " . TABLE_SPECIALS . " s on pme.products_id = s.products_id, " .
        TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
        TABLE_RECORD_COMPANY . " m
        where m.record_company_id = '" . (int)$_GET['record_company_id'] . "'
          and p.products_id = pme.products_id
          and p.products_status = 1
          and pme.record_company_id = '" . (int)$_GET['record_company_id'] . "'
          and pme.products_id = p2c.products_id
          and pd.products_id = p2c.products_id
          and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
          and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
    } else {
      // We show them all
      $listing_sql = "select " . $select_column_list . " pme.products_id, p.products_type, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping
        from " . TABLE_PRODUCTS . " p, " .
        TABLE_PRODUCTS_DESCRIPTION . " pd, " .
        TABLE_PRODUCT_MUSIC_EXTRA . " pme left join " . TABLE_SPECIALS . " s on pme.products_id = s.products_id, " .
        TABLE_RECORD_COMPANY . " m
        where m.record_company_id = '" . (int)$_GET['record_company_id'] . "'
          and p.products_id = pme.products_id
          and p.products_status = 1
          and pd.products_id = pme.products_id
          and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
          and pme.record_company_id = '" . (int)$_GET['record_company_id'] . "'";
    }
  } else {
    // show the products in a given category
    if (isset($_GET['filter_id']) && zen_not_null($_GET['filter_id']))
    {
      // We are asked to show only specific category
      $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type, m.music_genre_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping
        from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " .
        TABLE_PRODUCTS_DESCRIPTION . " pd, " .
        TABLE_RECORD_COMPANY . " m, " .
        TABLE_PRODUCTS_MUSIC_EXTRA . " pme, " .
        TABLE_PRODUCTS_TO_CATEGORIES . " p2c
        where p.products_status = 1
          and pme.record_company_id = m.record_company_id
          and m.record_company_id = '" . (int)$_GET['filter_id'] . "'
          and p.products_id = p2c.products_id
          and pd.products_id = p2c.products_id
          and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
          and p2c.categories_id = '" . (int)$current_category_id . "'";
    } else {
      // We show them all
      if ($current_categories_id) {
        $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type, m.music_genre_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping
          from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
          TABLE_PRODUCTS . " p left join " . TABLE_RECORD_COMPANY . " m, " . TABLE_PRODUCT_MUSIC_EXTRA . " pme on pme.record_company_id = m.record_company_id, " .
          TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p2c.products_id = s.products_id
          where p.products_status = 1
            and p.products_id = p2c.products_id
            and pd.products_id = p2c.products_id
            and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
            and p2c.categories_id = '" . (int)$current_category_id . "'";
      } else {
        $listing_sql = "select " . $select_column_list . " p.products_id, p.products_type, m.music_genre_id, p.products_price, p.products_tax_class_id, pd.products_description, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price, p.products_sort_order, p.product_is_call, p.product_is_always_free_shipping
          from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
          TABLE_PRODUCTS . " p left join " . TABLE_RECORD_COMPANY . " m, " . TABLE_PRODUCT_MUSIC_EXTRA . " pme on pme.record_company_id = m.record_company_id, " .
          TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS . " s on p2c.products_id = s.products_id
          where p.products_status = 1
            and p.products_id = p2c.products_id
            and pd.products_id = p2c.products_id
            and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
      }
    }
  }
  // set the default sort order setting from the Admin when not defined by customer
  if (!isset($_GET['sort']) and PRODUCT_LISTING_DEFAULT_SORT_ORDER != '') {
    $_GET['sort'] = PRODUCT_LISTING_DEFAULT_SORT_ORDER;
  }

  $listing_sql = str_replace('m.manufacturers_name', 'm.record_company_name as manufacturers_name', $listing_sql);

  if (isset($column_list)) {
    if ( (!isset($_GET['sort'])) || (!ereg('[1-8][ad]', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) )
    {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++)
      {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME')
        {
          $_GET['sort'] = $i+1 . 'a';
          $listing_sql .= " order by p.products_sort_order, pd.products_name";
          break;
        }
      }
      // if set to nothing use products_sort_order and PRODUCTS_LIST_NAME is off
      if (PRODUCT_LISTING_DEFAULT_SORT_ORDER == '') {
        $_GET['sort'] = '20a';
      }
    } else {
      $sort_col = substr($_GET['sort'], 0 , 1);
      $sort_order = substr($_GET['sort'], 1);
      $listing_sql .= ' order by ';
      switch ($column_list[$sort_col-1])
      {
        case 'PRODUCT_LIST_MODEL':
        $listing_sql .= "p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        break;
        case 'PRODUCT_LIST_NAME':
        $listing_sql .= "pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
        break;
        case 'PRODUCT_LIST_MANUFACTURER':
        $listing_sql .= "m.record_company_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        break;
        case 'PRODUCT_LIST_QUANTITY':
        $listing_sql .= "p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        break;
        case 'PRODUCT_LIST_IMAGE':
        $listing_sql .= "pd.products_name";
        break;
        case 'PRODUCT_LIST_WEIGHT':
        $listing_sql .= "p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        break;
        case 'PRODUCT_LIST_PRICE':
        //          $listing_sql .= "final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        $listing_sql .= "p.products_price_sorter " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
        break;
      }
    }
  }
  // optional Product List Filter
  if (PRODUCT_LIST_FILTER > 0)
  {
    if (isset($_GET['record_company_id']))
    {
      $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name
        from " . TABLE_PRODUCTS . " p, " .
        TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
        TABLE_CATEGORIES . " c, " .
        TABLE_CATEGORIES_DESCRIPTION . " cd, " .
        TABLE_PRODUCT_MUSIC_EXTRA . " pme
        where p.products_status = 1
          and pme.products_id = p2c.products_id
          and p2c.categories_id = c.categories_id
          and p2c.categories_id = cd.categories_id
          and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
          and pme.record_company_id = '" . (int)$_GET['record_company_id'] . "'
        order by cd.categories_name";
    } else {
      $filterlist_sql= "select distinct m.music_genre_id as id, m.music_genre_name as name
        from " . TABLE_PRODUCTS . " p, " .
        TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " .
        TABLE_PRODUCT_MUSIC_EXTRA . " pme, " .
        TABLE_RECORD_COMPANY . " m
        where p.products_status = 1
          and pme.record_company_id = m.record_company_id
          and p.products_id = p2c.products_id
          and p2c.categories_id = '" . (int)$current_category_id . "'
        order by m.record_company_name";
    }
    $getoption_set =  false;
    $do_filter_list = false;
    $filterlist = $db->Execute($filterlist_sql);
    if ($filterlist->RecordCount() > 1)
    {
      $do_filter_list = true;
      if (isset($_GET['record_company_id']))
      {
        $getoption_set =  true;
        $get_option_variable = 'record_company_id';
        $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
      } else {
        $options = array(array('id' => '', 'text' => TEXT_ALL_MUSIC_GENRE));
      }
      while (!$filterlist->EOF) {
        $options[] = array('id' => $filterlist->fields['id'], 'text' => $filterlist->fields['name']);
        $filterlist->MoveNext();
      }
    }
  }

  // Get the right image for the top-right
  $image = DIR_WS_TEMPLATE_IMAGES . 'table_background_list.gif';
  if ($current_category_id) {

    $sql = "select categories_image from " . TABLE_CATEGORIES . "
                where  categories_id = '" . (int)$current_category_id . "'";

    $image_name = $db->Execute($sql);
    $image = $image_name->fields['categories_image'];
  }
?>