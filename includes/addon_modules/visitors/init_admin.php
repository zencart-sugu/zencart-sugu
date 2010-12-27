<?php
/**
 * visitors modules init admin file
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_admin.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  zen_visitors_clean_up_visitors();

  if (basename($PHP_SELF) == FILENAME_CUSTOMERS . '.php') {
    switch ($_GET['action']) {
      case 'update':
        zen_visitors_update_visitors_data($_GET['cID'], $_POST['customers_email_address']);
        break;

      case 'deleteconfirm':
        // demo active test
        if (!zen_admin_demo()) {
          zen_visitors_delete_visitors_data($_GET['cID']);
        }
        break;
    }
  }
