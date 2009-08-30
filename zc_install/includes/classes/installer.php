<?php
/**
 * installer Class.
 * This class is used during the installation and upgrade processes *
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: installer.php 3794 2006-06-18 08:07:28Z drbyte $
 */


  class installer {

    function installer() {
      $this->php_version = PHP_VERSION;
      $this->user_agent = $_SERVER['HTTP_USER_AGENT'];
    }

    function test_admin_configure($zp_error_text, $zp_error_code) {
      if (!file_exists('../admin/includes/configure.php')) {
        @chmod('../admin/includes', 0777);
        @touch('../admin/includes/configure.php');
        @chmod('../admin/includes', 0755);
        if (!file_exists('../admin/includes/configure.php')) {
          $this->setError($zp_error_text, $zp_error_code, true);
          return false;
        }
      } else {
        return true;
      }
    }


    function test_admin_configure_write($zp_error_text, $zp_error_code) {
      $fp = @fopen('../admin/includes/configure.php', 'a');
      if (!is_writeable('../admin/includes/configure.php') || (!$fp) ) {
        $this->setError($zp_error_text, $zp_error_code, true);
        $this->admin_config_writable=false;
      } else {
        $this->admin_config_writable=true;
      }
    }

    function test_store_configure_write($zp_error_text, $zp_error_code) {
      $fp = @fopen('../includes/configure.php', 'a');
      if (!is_writeable('../includes/configure.php') || (!$fp) ) {
        $this->setError($zp_error_text, $zp_error_code, true);
        $this->store_config_writable=false;
      } else {
        $this->store_config_writable=true;
      }
    }

    function test_store_configure($zp_error_text, $zp_error_code) {
      if (!file_exists('../includes/configure.php')) {
        @chmod('../includes', 0777);
        @touch('../includes/configure.php');
        @chmod('../includes', 0755);
        if (!file_exists('../includes/configure.php')) {
          $this->setError($zp_error_text, $zp_error_code, true);
          return false;
        }
      } else {
        return true;
      }
    }

    function test_php_version ($zp_test, $test_version, $zp_error_text='', $zp_error_code='', $zp_fatal=false) {
      if (isset($_GET['ignorephpver']) && $_GET['ignorephpver']=='1') return false;
      $string = explode('.',substr($this->php_version,0,6));
      foreach ($string as $key=>$value) {
        $string[$key] = str_pad((int)$value, 2, '0', STR_PAD_LEFT);
      }
      $myver_string = implode('',$string);

      $string = explode('.',$test_version);
      foreach ($string as $key=>$value) {
        $string[$key] = str_pad($value, 2, '0', STR_PAD_LEFT);
      }
      $test_version = implode('',$string);

      $zp_error_text = $this->php_version . ' ' . $zp_error_text;
//echo '<br />$myver='.$myver_string . '  $test_ver = ' . $test_version . ' &nbsp;&nbsp;&nbsp;TEST: ' . $zp_test . '&nbsp;&nbsp;error-text: ' . $zp_error_text;

      switch ($zp_test) {
        case '=':
          if ($myver_string == $test_version) {
					  $this->setError($zp_error_text, $zp_error_code, $zp_fatal);
            return true;
          }
          break;
        case '<':
          if ($myver_string < $test_version) {
					  $this->setError($zp_error_text, $zp_error_code, $zp_fatal);
            return true;
          }
        break;
      }
      return false;
  }

    function isEmpty($zp_test, $zp_error_text, $zp_error_code) {
      if (!$zp_test || $zp_test=='http://' || $zp_test=='https://' ) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function noDots($zp_test, $zp_error_text, $zp_error_code) {
      if (str_replace(array('.','/',"\\"),'',$zp_test) != $zp_test) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function fileExists($zp_file, $zp_error_text, $zp_error_code) {
      if (!file_exists($zp_file)) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function isDir($zp_file, $zp_error_text, $zp_error_code) {
      if (!is_dir($zp_file)) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function isWriteable($zp_file, $zp_error_text='', $zp_error_code='') {
      if (is_dir($zp_file)) $zp_file .= '/test_writable.txt';
      $fp = @fopen($zp_file, 'a');
      if (!is_writeable($zp_file) || (!$fp) ) {
        if ($zp_error_code !='') $this->setError($zp_error_text, $zp_error_code, true);
        return false;
      }
      return true;
    }

    function functionExists($zp_type, $zp_error_text, $zp_error_code) {
      if ($zp_type == 'mysql') {
        $function = 'mysql_connect';
      }
      if (!function_exists($function)) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function dbConnect($zp_type, $zp_host, $zp_database, $zp_username, $zp_pass, $zp_error_text, $zp_error_code, $zp_error_text2=ERROR_TEXT_DB_NOTEXIST, $zp_error_code2=ERROR_CODE_DB_NOTEXIST) {
      if ($this->error == false) {
        if ($zp_type == 'mysql') {
          if (@mysql_connect($zp_host, $zp_username, $zp_pass) == false ) {
            $this->setError($zp_error_text.'<br />'.@mysql_error(), $zp_error_code, true);
          } else {
            if (!@mysql_select_db($zp_database)) {
              $this->setError($zp_error_text2.'<br />'.@mysql_error(), $zp_error_code2, true);
            } else {
              @mysql_close();
            }
          }
        }
      }
    }

    function dbCreate($zp_create, $zp_type, $zp_name, $zp_error_text, $zp_error_code) {
      if ($zp_create == 'true' && $this->error == false) {
        if ($zp_type == 'mysql' && (@mysql_query('CREATE DATABASE ' . $zp_name) == false)) {
          $this->setError($zp_error_text, $zp_error_code, true);
        }
      }
    }

    function dbExists($zp_create, $zp_type, $zp_host, $zp_username, $zp_pass, $zp_name, $zp_error_text, $zp_error_code) {
      //    echo $zp_create;
      if ($zp_create != 'true' && $this->error == false) {
        if ($zp_type == 'mysql') {
          @mysql_connect($zp_host, $zp_username, $zp_pass);
          if (@mysql_select_db($zp_name) == false) {
            $this->setError($zp_error_text.'<br />'.@mysql_error(), $zp_error_code, true);
          }
        }
      }
    }

    function isEmail($zp_param, $zp_error_text, $zp_error_code) {
      if (zen_validate_email($zp_param) == false) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function isEqual($zp_param1, $zp_param2, $zp_error_text, $zp_error_code) {
      if ($zp_param1 != $zp_param2) {
        $this->setError($zp_error_text, $zp_error_code, true);
      }
    }

    function setError($zp_error_text, $zp_error_code, $zp_fatal = false) {
      $this->error = true;
      $this->fatal_error = $zp_fatal;
      $this->error_array[] = array('text'=>$zp_error_text, 'code'=>$zp_error_code);
    }
  }

?>