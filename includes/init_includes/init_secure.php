<?php
/**
 * code to check that runing enviroment is safe.
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright (C) 2008 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// check if the register_globals "on".
$register_globals = ini_get("register_globals");
if ($register_globals != '' && ($register_globals =='1' || strtoupper($register_globals) =='ON')) {
  // if register globals "on", stop all process and exit;
  echo(WARNING_REGISTER_GLOBALS_ON);
  exit;
}

?>
