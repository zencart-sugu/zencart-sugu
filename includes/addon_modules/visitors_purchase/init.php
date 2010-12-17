<?php
/**
 * visitors purchase modules init file
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (zen_visitors_purchase_is_enabled()) {
  define('VISITORS_PURCHASE_ENABLED', true);
} else {
  define('VISITORS_PURCHASE_ENABLED', false);
}
