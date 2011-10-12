block categories

<ul>
<?php foreach ($categories as $category) { ?>
  <li<?php echo ($category['is_current']) ? ' class="current"' : '' ?>><a href="<?php echo $search_link .'&categories_id='. $category['categories_id'] ?>"><?php echo zen_output_string_protected($category['categories_name']) ?></a></li>
<?php   if (isset($category['subcategories'])) { ?>
  <ul>
<?php     foreach ($category['subcategories'] as $subcategory) { ?>
    <li><a href="<?php echo $search_link .'&categories_id='. $subcategory['categories_id'] ?>"><?php echo zen_output_string_protected($subcategory['categories_name']) ?></a></li>
<?php     } ?>
  </ul>
<?php   } ?>
<?php } ?>
</ul>
