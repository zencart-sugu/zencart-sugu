<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: config.viewedProducts.php 3185 2007-11-21 19:19:55Z sasaki $
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}

/**
 *
 * require(DIR_WS_CLASSES . 'viewed_products.php');
 *
 */
  $autoLoadConfig[0][] = array('autoType'=>'class',
                                'loadFile'=>'viewed_products.php');
/**
 * Breakpoint 80.
 *
 * if(!$_SESSION['viewed']) $_SESSION['viewed'] = new viewedProducts();
 *
 */
  $autoLoadConfig[80][] = array('autoType'=>'classInstantiate',
                                'className'=>'viewedProducts',
                                'objectName'=>'viewed',
                                'checkInstantiated'=>true,
                                'classSession'=>true);

?>