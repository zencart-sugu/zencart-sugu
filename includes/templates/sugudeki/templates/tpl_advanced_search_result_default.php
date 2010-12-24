<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=advanced_search_result.<br />
 * Displays results of advanced search
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_advanced_search_result_default.php 2786 2006-01-05 01:52:38Z birdbrain $
 */
?>
<div class="centerColumn" id="advSearchResultsDefault">

<h1 id="advSearchResultsDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="centerColumnBody">
<?php
/**
 * Used to collate and display products from advanced search results
 */
 require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
?>
<?php echo zen_addOnModules_get_block('search_more', 'block_search_form'); ?>

</div></div>
