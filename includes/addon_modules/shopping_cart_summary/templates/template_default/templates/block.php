<?php
/**
 * addon_modules block Template
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */



if ($contents_count > 0) {

echo '<p>';
echo sprintf(HEADER_SHOPPING_CART_TOTAL, $total);

//  echo $products[0]['name'];
 // if ($contents_count == 1) {
 //   echo sprintf(HEADER_SHOPPING_CART_A_CONTENT, 1);
//  } else {
    echo sprintf(HEADER_SHOPPING_CART_CONTENTS, $contents_count);
//  }
	
echo '</p>';
	
} else {
 // echo sprintf(HEADER_SHOPPING_CART_EMPTY, 0);
}

if ($contents_count > 0) {
  echo '<a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '">' . $block_module->imageButton(BUTTON_IMAGE_VIEW_SHOPPING_CART, BUTTON_VIEW_SHOPPING_CART_ALT,'class="imgover"') . '</a>';
}

?>
