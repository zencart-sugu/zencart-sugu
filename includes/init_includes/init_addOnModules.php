<?php
/**
 * addOnModules init file loader
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_addOnModules.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  ob_start();

  $addon_module_init_files = zen_addOnModules_get_module_init_files();
  for ($addon_counter = 0, $addon_count = count($addon_module_init_files); $addon_counter < $addon_count; $addon_counter++) {
    require($addon_module_init_files[$addon_counter]);
  }

  // get module specify css
  $styles = zen_addOnModules_get_styles($current_page_base);

  // get module specify js
  $jscripts = zen_addOnModules_get_jscripts($current_page_base);

  // get template layout location contents
  $layout_locations = array();
  if (file_exists(DIR_WS_TEMPLATE . 'template_layout.php')) {
    require(DIR_WS_TEMPLATE . 'template_layout.php');
  }

  $layout_location_blocks = array();
  if (count($layout_locations) > 0) {
    foreach ($layout_locations as $layout_location) {
      $layout_location_blocks = zen_addOnModules_get_layout_location_blocks($layout_location, $current_page_base);

      // get module block specify css
      $styles .= zen_addOnModules_get_block_styles($layout_location, $current_page_base);

      // get module block specify js
      $jscripts .= zen_addOnModules_get_block_jscripts($layout_location, $current_page_base);

      ${$layout_location} = zen_addOnModules_get_layout_contents($layout_location, $current_page_base);
    }
  }
?>