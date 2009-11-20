<?php
/**
 * visitors purchase modules init admin file
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  zen_visitors_purchase_clean_up_visitors_ordrs();

  if (basename($PHP_SELF) == FILENAME_ORDERS . '.php') {
    switch ($_GET['action']) {
      case 'update_order':
        // demo active test
        if (!zen_admin_demo()) {
          zen_visitors_purchase_update_visitors_order($_GET['oID']);
        }
        break;

      case 'deleteconfirm':
        // demo active test
        if (!zen_admin_demo()) {
          zen_visitors_purchase_delete_visitors_order($_GET['oID']);
        }
        break;
    }
  }
