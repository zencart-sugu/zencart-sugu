<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: congfig.addOnModules.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}

  $autoLoadConfig[][] = array('autoType'=>'class',
                              'loadFile'=>'class.addOnModuleBase.php');
  $autoLoadConfig[][] = array('autoType'=>'class',
                              'loadFile'=>'observers/class.addOnModulesObserver.php');
  $autoLoadConfig[][] = array('autoType'=>'classInstantiate',
                              'className'=>'addOnModulesObserver',
                              'objectName'=>'addOnModulesObserver');

  $autoLoadConfig[1000][] = array('autoType'=>'init_script',
                                  'loadFile'=>'init_addOnModules.php');

  $enabled_addon_modules_text_file = DIR_FS_SQL_CACHE . "/enabled_addon_modules.txt";
  if (is_readable($enabled_addon_modules_text_file)) {
    $enabled_modules_str = file_get_contents($enabled_addon_modules_text_file);
    $enabled_modules = preg_split("/;/", $enabled_modules_str);
    foreach ($enabled_modules as $enabled_module) {
      $auto_load_config = DIR_FS_CATALOG_ADDON_MODULES . $enabled_module . "/auto_loaders/config.php";
      if (is_readable($auto_load_config)) {
	require_once($auto_load_config);
      }
    }
  }
  
?>