<?php
/**
 * visitors modules init file
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

if (zen_visitors_is_enabled()) {
  $visitors_force_logoff_pages = array(
    FILENAME_ACCOUNT,
    FILENAME_ACCOUNT_EDIT,
    FILENAME_ACCOUNT_HISTORY,
    FILENAME_ACCOUNT_HISTORY_INFO,
    FILENAME_ACCOUNT_NEWSLETTERS,
    FILENAME_ACCOUNT_NOTIFICATIONS,
    FILENAME_ACCOUNT_PASSWORD,
    FILENAME_ADDRESS_BOOK,
    FILENAME_ADDRESS_BOOK_PROCESS,
    //FILENAME_CONTACT_US,
    //FILENAME_DOWNLOAD,
    FILENAME_GV_REDEEM,
    FILENAME_GV_SEND,
    FILENAME_PRODUCT_REVIEWS_WRITE,
    FILENAME_TELL_A_FRIEND
  );

  if (zen_visitors_is_visitor()) {
    define('IS_VISITORS_SESSION', true);
    if (in_array($_GET['main_page'], $visitors_force_logoff_pages)) {
      //zen_visitors_delete_visitor($_SESSION['visitors_id']);
      zen_visitors_reset_session_vars();
      zen_redirect(zen_href_link($_GET['main_page'], zen_get_all_get_params()));
    }

    if (!zen_visitors_is_alive($_SESSION['visitors_id'])) {
      zen_visitors_reset_session_vars();
      zen_redirect(zen_href_link(FILENAME_TIME_OUT));
    }
  }
} else {
  define('IS_VISITORS_SESSION', false);
}
