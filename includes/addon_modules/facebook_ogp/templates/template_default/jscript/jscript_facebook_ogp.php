<?php 
if ($_GET['main_page'] == 'product_info') {
    global $db;
    $sql = "select p.products_id, pd.products_name,
                  pd.products_description, p.products_model,
                  p.products_quantity, p.products_image,
                  pd.products_url, p.products_price,
                  p.products_tax_class_id, p.products_date_added,
                  p.products_date_available, p.manufacturers_id, p.products_quantity,
                  p.products_weight, p.products_priced_by_attribute, p.product_is_free,
                  p.products_qty_box_status,
                  p.products_quantity_order_max,
                  p.products_discount_type, p.products_discount_type_from, p.products_sort_order, p.products_price_sorter
           from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
           where  p.products_status = '1'
           and    p.products_id = '" . (int)$_GET['products_id'] . "'
           and    pd.products_id = p.products_id
           and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $product_info = $db->Execute($sql);

    $products_name = $product_info->fields['products_name'];
    $products_model = $product_info->fields['products_model'];
    $products_description = $product_info->fields['products_description'];
    if ($product_info->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
        $products_image = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
    } else {
        $products_image = DIR_WS_IMAGES . $product_info->fields['products_image'];
    }
    $products_image = zen_href_link($products_image, '', 'SSL', false, true, true);
    $products_url =  zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')));
?>
    <meta property="og:title" content="<?php echo $products_name ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo $products_url ?>"/>
    <meta property="og:image" content="<?php echo $products_image ?>"/>
    <meta property="og:site_name" content="<?php echo STORE_NAME ?>"/>
    <meta property="fb:admins" content="<?php echo MODULE_FACEBOOK_OGP_USER_IDS ?>"/>
    <meta property="og:description" content="<?php echo strip_tags(preg_replace("/\n/", "", $products_description)); ?>"/>
<?php   if (zen_not_null(MODULE_FACEBOOK_OGP_OG_EMAIL)) { ?>
    <meta property="og:email" content="<?php echo MODULE_FACEBOOK_OGP_OG_EMAIL ?>"/>
<?php   } ?>
<?php   if (zen_not_null(MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER)) { ?>
    <meta property="og:phone_number" content="<?php echo MODULE_FACEBOOK_OGP_OG_PHONE_NUMBER ?>"/>
<?php   } ?>
<?php   if (zen_not_null(MODULE_FACEBOOK_OGP_OG_FAX_NUMBER)) { ?>
    <meta property="og:fax_number" content="<?php echo MODULE_FACEBOOK_OGP_OG_FAX_NUMBER ?>"/>
<?php   } ?>
<?php 
}
?>
