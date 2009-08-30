<?php
/**
 * discount coupon info
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3253 2006-03-25 17:26:14Z birdbrain $
 */

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $text_coupon_help = '';
  if (isset($_POST['lookup_discount_coupon']) and $_POST['lookup_discount_coupon'] != '') {
// lookup requested discount coupon

    $coupon = $db->Execute("select * from " . TABLE_COUPONS . " where coupon_code = '" . $_POST['lookup_discount_coupon'] . "' and  coupon_type != 'G'");

    if ($coupon->RecordCount() < 1) {
// invalid discount coupon code
      $text_coupon_help = sprintf(TEXT_COUPON_FAILED, $_POST['lookup_discount_coupon']);
    } else {
// valid discount coupon code
      $lookup_coupon_id = $coupon->fields['coupon_id'];

      $coupon_desc = $db->Execute("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $lookup_coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
      $text_coupon_help = TEXT_COUPON_HELP_HEADER;
      $text_coupon_help .= sprintf(TEXT_COUPON_HELP_NAME, $coupon_desc->fields['coupon_name']);
      if (zen_not_null($coupon_desc->fields['coupon_description'])) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DESC, $coupon_desc->fields['coupon_description']);
      $coupon_amount = $coupon->fields['coupon_amount'];
      switch ($coupon->fields['coupon_type']) {
        case 'F':
        $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, $currencies->format($coupon->fields['coupon_amount']));
        break;
        case 'P':
        $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, number_format($coupon->fields['coupon_amount'],2). '%');
        break;
        case 'S':
        $text_coupon_help .= TEXT_COUPON_HELP_FREESHIP;
        break;
        default:
      }
      if ($coupon->fields['coupon_minimum_order'] > 0 ) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_MINORDER, $currencies->format($coupon->fields['coupon_minimum_order']));
      $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DATE, zen_date_short($coupon->fields['coupon_start_date']),zen_date_short($coupon->fields['coupon_expire_date']));
      $text_coupon_help .= TEXT_COUPON_HELP_RESTRICT;
      $text_coupon_help .= TEXT_COUPON_HELP_CATEGORIES;
      $get_result=$db->Execute("select * from " . TABLE_COUPON_RESTRICT . "  where coupon_id='".$lookup_coupon_id."' and category_id !='0'");
      $cats = '';
      while (!$get_result->EOF) {
        if ($get_result->fields['coupon_restrict'] == 'N') {
          $restrict = TEXT_CAT_ALLOWED;
        } else {
          $restrict = TEXT_CAT_DENIED;
        }
        $result = $db->Execute("SELECT * FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id and cd.language_id = '" . $_SESSION['languages_id'] . "' and c.categories_id='" . $get_result->fields['category_id'] . "'");
        $cats .= '<br />' . $result->fields["categories_name"] . $restrict;
        $get_result->MoveNext();
      }
      if ($cats=='') $cats = TEXT_NO_CAT_RESTRICTIONS;
      $text_coupon_help .= $cats;
      $text_coupon_help .= TEXT_COUPON_HELP_PRODUCTS;
      $get_result=$db->Execute("select * from " . TABLE_COUPON_RESTRICT . "  where coupon_id='".$lookup_coupon_id."' and product_id !='0'");

      while (!$get_result->EOF) {
        if ($get_result->fields['coupon_restrict'] == 'N') {
          $restrict = TEXT_PROD_ALLOWED;
        } else {
          $restrict = TEXT_PROD_DENIED;
        }
        $result = $db->Execute("SELECT * FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.products_id = pd.products_id and pd.language_id = '" . $_SESSION['languages_id'] . "'and p.products_id = '" . $get_result->fields['product_id'] . "'");
        $prods .= '<br />' . $result->fields['products_name'] . $restrict;
        $get_result->MoveNext();
      }
      if ($prods=='') $prods = TEXT_NO_PROD_RESTRICTIONS;
      $text_coupon_help .= $prods . TEXT_COUPON_GV_RESTRICTION;
    }
  }

// include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_DISCOUNT_COUPON, 'false');
$breadcrumb->add(NAVBAR_TITLE);
?>