<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
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
?>