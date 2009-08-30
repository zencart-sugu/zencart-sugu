<?php
/**
 * functions/sessions.php
 * Session functions
 *
 * @package functions
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sessions.php 3772 2006-06-13 18:51:58Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  if (STORE_SESSIONS == 'db') {
    if (defined('DIR_WS_ADMIN')) {
      if (!$SESS_LIFE = (SESSION_TIMEOUT_ADMIN + 900)) {
        $SESS_LIFE = (SESSION_TIMEOUT_ADMIN + 900);
      }
    } else {
      if (!$SESS_LIFE = get_cfg_var('session.gc_maxlifetime')) {
        $SESS_LIFE = 1440;
      }
    }

    function _sess_open($save_path, $session_name) {
      return true;
    }

    function _sess_close() {
      return true;
    }

    function _sess_read($key) {
      global $db;
      $qid = "select value
              from " . TABLE_SESSIONS . "
              where sesskey = '" . zen_db_input($key) . "'
              and expiry > '" . time() . "'";

      $value = $db->Execute($qid);

      if (isset($value->fields['value']) && $value->fields['value']) {
        return $value->fields['value'];
      }

      return ("");
    }

    function _sess_write($key, $val) {
      global $db;
      if (!is_object($db)) {
        //PHP 5.2.0 bug workaround ... 
        $db = new queryFactory();
        $db->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false);
      }

      global $SESS_LIFE;

      $expiry = time() + $SESS_LIFE;
      $value = $val;

      $qid = "select count(*) as total
              from " . TABLE_SESSIONS . "
              where sesskey = '" . zen_db_input($key) . "'";

      $total = $db->Execute($qid);

      if ($total->fields['total'] > 0) {
        $sql = "update " . TABLE_SESSIONS . "
                set expiry = '" . zen_db_input($expiry) . "', value = '" . zen_db_input($value) . "'
                where sesskey = '" . zen_db_input($key) . "'";

        return $db->Execute($sql);

      } else {
        $sql = "insert into " . TABLE_SESSIONS . "
                values ('" . zen_db_input($key) . "', '" . zen_db_input($expiry) . "', '" .
                         zen_db_input($value) . "')";

        return $db->Execute($sql);

      }
    }

    function _sess_destroy($key) {
      global $db;
      $sql = "delete from " . TABLE_SESSIONS . " where sesskey = '" . zen_db_input($key) . "'";
      return $db->Execute($sql);
    }

    function _sess_gc($maxlifetime) {
      global $db;
      $sql = "delete from " . TABLE_SESSIONS . " where expiry < '" . time() . "'";
      $db->Execute($sql);
      return true;
    }

    session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
  }

  function zen_session_start() {
    if (defined('DIR_WS_ADMIN')) {
      @ini_set('session.gc_maxlifetime', (SESSION_TIMEOUT_ADMIN < 900 ? (SESSION_TIMEOUT_ADMIN + 900) : SESSION_TIMEOUT_ADMIN));
    }
    return session_start();
  }

  function zen_session_register($variable) {
    die('This function has been deprecated. Please use Register Globals Off compatible code');
  }

  function zen_session_is_registered($variable) {
    die('This function has been deprecated. Please use Register Globals Off compatible code');
  }

  function zen_session_unregister($variable) {
    die('This function has been deprecated. Please use Register Globals Off compatible code');
  }

  function zen_session_id($sessid = '') {
    if (!empty($sessid)) {
      return session_id($sessid);
    } else {
      return session_id();
    }
  }

  function zen_session_name($name = '') {
    if (!empty($name)) {
      return session_name($name);
    } else {
      return session_name();
    }
  }

  function zen_session_close() {
    if (function_exists('session_close')) {
      return session_close();
    }
  }

  function zen_session_destroy() {
    return session_destroy();
  }

  function zen_session_save_path($path = '') {
    if (!empty($path)) {
      return session_save_path($path);
    } else {
      return session_save_path();
    }
  }

  function zen_session_recreate() {
    global $http_domain, $https_domain, $current_domain;
      if ($http_domain == $https_domain) {
      $saveSession = $_SESSION;
      $oldSessID = session_id();
      session_regenerate_id();
      $newSessID = session_id();
      session_id($oldSessID);
      session_id($newSessID);
      if (STORE_SESSIONS == 'db') {
        session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
      }
      session_start();
      $_SESSION = $saveSession;
      whos_online_session_recreate($oldSessID, $newSessID);
    } else {
    /*
      $saveSession = $_SESSION;
      $oldSessID = session_id();
      session_regenerate_id();
      $newSessID = session_id();
      session_id($oldSessID);
      session_destroy();
      session_id($newSessID);
      session_set_cookie_params(0, '/', (zen_not_null($http_domain) ? $http_domain : ''));
      session_id($newSessID);
      if (STORE_SESSIONS == 'db') {
        session_set_save_handler('_sess_open', '_sess_close', '_sess_read', '_sess_write', '_sess_destroy', '_sess_gc');
      }
      session_start();
      session_set_cookie_params(0, '/', (zen_not_null($current_domain) ? $current_domain : ''));
      session_start();
      $_SESSION = $saveSession;
      */
    }
  }
?>