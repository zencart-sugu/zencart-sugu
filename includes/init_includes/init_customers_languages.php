<?php
/**
 * initialise customers_language handling
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @todo ICW(SECURITY) is it worth having a sanitizer for $_GET['language'] ?
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_customers_languages.php 2753 2008-01-15 19:17:17Z sasaki $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (isset($_GET['language']) && zen_not_null($_GET['language'])) {
  if (isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != '' && $_SESSION['languages_id'] > 0) {
    zen_update_customers_language($_SESSION['customer_id'], $_SESSION['languages_id']);

  }
}
?>