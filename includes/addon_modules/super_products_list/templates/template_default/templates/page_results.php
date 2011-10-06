<p>super_products_list/results</p>
keywords: <?php echo $keywords; ?><br />
categories_id: <?php echo $categories_id; ?><br />
current_categories_path: <?php echo $current_categories_path; ?><br />
current_categories_name: <?php echo $current_categories_name; ?><br />
current_categories_description: <?php echo $current_categories_description; ?><br />
manufacturers_id: <?php echo $manufacturers_id; ?><br />
current_manufacturers_name: <?php echo $current_manufacturers_name; ?><br />
price_from: <?php echo $price_from; ?><br />
price_to: <?php echo $price_to; ?><br />
<?php if (MODULE_SUPER_PRODUCTS_LIST_ENABLE_SEARCH_BY_DATE_AVAILABLE == 'true') { ?>
date_from: <?php echo $date_from; ?><br />
date_to: <?php echo $date_to; ?><br />
<?php } ?>
sort: <?php echo $sort; ?><br />
limit: <?php echo $limit; ?><br />
page: <?php echo $page; ?><br />
result_all: <?php echo $result_all; ?><br />

<!-- bof search form //-->
<?php require($page_module->getModuleTemplate($page_method, 'module_form')); ?>
<!-- eof search form //-->

<?php if (empty($products)) { ?>
  <p><?php echo MODULE_SUPER_PRODUCTS_LIST_NOT_FOUND_PRODUCTS; ?></p>
<?php }else{ ?>

<?php
$paging_html = '';
if ($paging['prev']['url']) {
  $paging_html .= '<a href="'. $paging['prev']['url'] .'">'. $paging['prev']['string'] .'</a>';
}else{
  $paging_html .= $paging['prev']['string'];
}
foreach ($paging['page_list'] as $page_list) {
  $paging_html .= '&nbsp;';
  if ($page_list['url']) {
    $paging_html .= '<a href="'. $page_list['url'] .'">'. $page_list['string'] .'</a>';
  }else{
    $paging_html .= $page_list['string'];
  }
}
$paging_html .= '&nbsp;';
if ($paging['next']['url']) {
  $paging_html .= '<a href="'. $paging['next']['url'] .'">'. $paging['next']['string'] .'</a>';
}else{
  $paging_html .= $paging['next']['string'];
}
?>

<hr />
<!-- bof paging //-->
<p><?php echo sprintf(MODULE_SUPER_PRODUCTS_LIST_RESULT_FROM_TO, $paging['result_from'], $paging['result_to'], $result_all); ?></p>
<?php echo $paging_html ?>
<!-- eof paging //-->
<hr />

<!-- bof results //-->
<?php foreach ($products as $product) { ?>
  <ul>
    <li>path_image: <?php echo zen_image($product['path_image'], addslashes($product['name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) ?></li>
    <li>name: <?php echo zen_output_string_protected($product['name']) ?></li>
    <li>url: <a href="<?php echo $product['url'] ?>"><?php echo MORE_INFO_TEXT ?></a></li>
    <li>description: <?php echo $product['description'] ?></li>
    <li>model: <?php echo zen_output_string_protected($product['model']) ?></li>
    <li>quantity: <?php echo zen_output_string_protected($product['quantity']) ?></li>
    <li>date_added: <?php echo zen_output_string_protected($product['date_added']) ?></li>
    <li>final_price: <?php echo $product['final_price'] ?></li>
    <li>cart_button: <?php echo $product['cart_button'] ?></li>
    <li>categories: 
      <ul>
<?php foreach ($product['categories_path'] as $product_categories_path) { ?>
        <li>path: <?php echo $product_categories_path; ?></li>
<?php } ?>
      </ul>
    </li>
    <li>always_free_shipping: <?php echo $product['always_free_shipping'] ?></li>
  </ul>
<hr />
<?php } ?>
<!-- eof results //-->

<!-- bof paging //-->
<p><?php echo sprintf(MODULE_SUPER_PRODUCTS_LIST_RESULT_FROM_TO, $paging['result_from'], $paging['result_to'], $result_all); ?></p>
<?php echo $paging_html ?>
<!-- eof paging //-->
<hr />

<?php } // if(empty($products)) { ?>
