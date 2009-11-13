<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_best_sellers.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = '';
	
  $content .= '' . "\n";
	
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
  $content .= '<dl id="bestsellers-'. $i .'">' . "\n";
	
	$content .= '<dt><span>'. $i .'</span><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">'. zen_image(DIR_WS_IMAGES . $bestsellers_list[$i]['image'], $bestsellers_list[$i]['name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</a></dt>' . "\n";

    $content .= '<dd class="description"><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' . $bestsellers_list[$i]['manufacturers'] .'<br />'. $bestsellers_list[$i]['name'] . '</a></dd>' . "\n";
  $content .= '<dd class="price">'.TEXT_PRICE_KN .''.zen_get_products_display_price($bestsellers_list[$i]['id']).
	''.'</dd>' . "\n";
		
		
  $content .= '</dl>' . "\n";
  }
	

	/*
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent">' . "\n";
  $content .= '<div class="wrapper">' . "\n" . '<ol>' . "\n";
  for ($i=1; $i<=sizeof($bestsellers_list); $i++) {
    $content .= '<li><a href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' . zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) . '</a></li>' . "\n";
  }
  $content .= '</ol>' . "\n";
  $content .= '</div>' . "\n";
  $content .= '</div>';*/
?>