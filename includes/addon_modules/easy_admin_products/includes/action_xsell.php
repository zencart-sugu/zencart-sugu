<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 * Modified S.G.Kohata
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

require(DIR_WS_CLASSES . 'currencies.php');
$currencies    = new currencies();
$languages_id  = $_SESSION['languages_id'];
$xsellcsv      = $_FILES['xsellcsv']['tmp_name'];
$xsellcsv_name = $_FILES['xsellcsv']['name'];
$xsellcsv_type = $_FILES['xsellcsv']['type'];
$xsellcsv_size = $_FILES['xsellcsv']['size'];

if (!empty($_POST['doSearch'])) {
  $_GET['page'] = "1";
}

if (!empty($_POST['doSearchReset'])) {
  $_GET['page'] = "1";
  unset($_POST['searchProduct']);
  unset($_POST['searchKeyword']);
  unset($_GET['searchProduct']);
  unset($_GET['searchKeyword']);
  unset($_REQUEST['searchProduct']);
  unset($_REQUEST['searchKeyword']);
}

if (isset($_POST['searchProduct'])) {
  $_GET['searchProduct'] = $_POST['searchProduct'];
}

if (isset($_POST['searchKeyword'])) {
  $_GET['searchKeyword'] = $_POST['searchKeyword'];
}

if (isset($_GET['easy_admin_products_page'])) {
  $_SESSION['easy_admin_products_page'] = $_GET['easy_admin_products_page'];
}

switch($_GET['action']) {
  case 'update_cross' :
    if (!empty($_POST['doSearch'])) {
        break;
    }
    if (!empty($_POST['doSearchReset'])) {
        break;
    }

    easy_admin_products_model::update_products_xsell($_GET['add_related_product_ID'], $_POST['product'], $_POST['cross']);
    $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_CROSS_SELL_SUCCESS, 'success');
    break;

  case 'update_sort' :
    easy_admin_products_model::update_xsell_order($_POST);
    $messageStack->add(MODULE_EASY_ADMIN_PRODUCTS_SORT_CROSS_SELL_SUCCESS, 'success');
    break;
}
?>
