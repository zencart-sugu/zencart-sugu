<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: $
 */
?>
<div class="centerColumn" id="indexCategories">

<?php
// -> zen_smartphone: h1 ‚Í toolbar ‚ðŽg‚¤
/*
<h1 id="indexCategoriesHeading"><?php echo MODULE_ZEN_SMARTPHONE_CATEGORIES_LIST_TITLE; ?></h1>
*/
?>
<div class="toolbar"><h1><?php echo MODULE_ZEN_SMARTPHONE_CATEGORIES_LIST_TITLE; ?></h1></div>
<a class="back" href="#">cancel</a>
<?php
// <- zen_smartphone: h1 ‚Í toolbar ‚ðŽg‚¤
?>

<!-- BOF: Display grid of available sub-categories, if any -->
<?php
/**
 * require the code to display the sub-categories-grid, if any exist
 */
   require($template->get_template_dir('tpl_modules_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_row.php');
?>
<!-- EOF: Display grid of available sub-categories -->
</div>
