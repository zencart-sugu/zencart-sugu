<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.core.php 3185 2006-03-14 19:19:55Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 
  $autoLoadConfig[200][] = array('autoType'=>'class',
                                 'loadFile'=>'observers/digitalcheck.php');
  $autoLoadConfig[200][] = array('autoType'=>'classInstantiate',
                                 'className'=>'digitalcheck',
                                 'objectName'=>'digitalcheck');
?>