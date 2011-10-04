<p>super_products_list/results</p>
keywords: <?php echo $keywords; ?><br />
categories_id: <?php echo $categories_id; ?><br />
categories_name: <?php echo $categories_name; ?><br />
manufacturers_id: <?php echo $manufacturers_id; ?><br />
manufacturers_name: <?php echo $manufacturers_name; ?><br />
price_from: <?php echo $price_from; ?><br />
price_to: <?php echo $price_to; ?><br />
date_from: <?php echo $date_from; ?><br />
date_to: <?php echo $date_to; ?><br />
sort: <?php echo $sort; ?><br />
page: <?php echo $page; ?><br />
result_all: <?php echo $result_all; ?><br />

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
<p><?php echo sprintf(MODULE_SUPER_PRODUCTS_LIST_FROM_TO, $paging['from'], $paging['to'], $result_all); ?></p>
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
    <li>zen_get_products_display_price: <?php echo zen_get_products_display_price($product['products_id']) ?></li>
    <li>cart_button: <?php echo $product['cart_button'] ?></li>
    <li>categories_path: 
      <ul>
<?php foreach ($product['categories_path'] as $product_categories_path) { ?>
        <li><?php echo $product_categories_path; ?></li>
<?php } ?>
      </ul>
    </li>
    <li>always_free_shipping: <?php echo $product['always_free_shipping'] ?></li>
  </ul>
<hr />
<?php } ?>
<!-- eof results //-->

<!-- bof paging //-->
<p><?php echo sprintf(MODULE_SUPER_PRODUCTS_LIST_FROM_TO, $paging['from'], $paging['to'], $result_all); ?></p>
<?php echo $paging_html ?>
<!-- eof paging //-->
<hr />

<?php } // if(empty($products)) { ?>

<!-- bof search form //-->
<?php require($page_module->getModuleTemplate($page_method, 'module_form')); ?>
<!-- eof search form //-->
