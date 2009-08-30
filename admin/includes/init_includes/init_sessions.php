<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_sessions.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// define how the session functions will be used
  require(DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'sessions.php');

  if (SESSION_USE_FQDN == 'False') $current_domain = '.' . $current_domain;
  zen_session_name('zenAdminID');
  zen_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
//   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, '/', (zen_not_null($current_domain) ? $current_domain : ''));
//  } elseif (function_exists('ini_set')) {
//    @ini_set('session.cookie_lifetime', '0');
//    @ini_set('session.cookie_path', DIR_WS_ADMIN);
//  }

// lets start our session
  zen_session_start();
  $session_started = true;
?>