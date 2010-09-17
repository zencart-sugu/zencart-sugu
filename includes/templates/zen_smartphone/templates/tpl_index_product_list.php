<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays product-listing when a particular category/subcategory is selected for browsing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_product_list.php 2975 2006-02-05 19:33:51Z birdbrain $
 */

// -> zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
// <- zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
?>

<div class="centerColumn" id="indexProductList">
<?php
// -> zen_smartphone: h1 は toolbar を使う
/*
<h1 id="productListHeading"><?php echo $breadcrumb->last(); ?></h1>

<div id="centerColumnBody">
<?php
// categories_description
    if ($current_categories_description != '') {
?>
<div id="indexProductListCatDescription" class="content"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>
*/
?>
<div class="toolbar"><h1><?php echo $breadcrumb->last(); ?></h1></div>
<a class="back" href="#">back</a>
<?php
// <- zen_smartphone: h1 は toolbar を使う
?>

<?php
// -> zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
}
// <- zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
?>

<?php
/**
 * require the code for listing products
 */
// -> zen_mobile: ページング指定のない場合と、ページング中の場合のテンプレートを分けた
// require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
 require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
} else {
 require($template->get_template_dir('tpl_modules_product_listing_parts.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing_parts.php');
}
// <- zen_mobile: ページング指定のない場合と、ページング中の場合のテンプレートを分けた
?>


<?php
//// bof: categories error
if ($error_categories==true) {
  // verify lost category and reset category
  $check_category = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_id='" . $cPath . "'");
  if ($check_category->RecordCount() == 0) {
    $new_products_category_id = '0';
    $cPath= '';
  }
?>

<?php
$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MISSING);

?>

<?php
} //// eof: categories
?>
<?php
// -> zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
if (! isset($_GET['page']) or $_GET['page'] <= 1) {
// <- zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
?>
</div>
<?php
// -> zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
}
// <- zen_mobile: ページング指定のない場合のみ、<div>タグなどを付与する
?>
