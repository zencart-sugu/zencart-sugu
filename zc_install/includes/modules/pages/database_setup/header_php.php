<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3768 2006-06-13 07:54:16Z drbyte $
 * @todo -- test with Mac and Fedora Core 2 ... to see why sometimes fields with just '' are written with only one single-quote instead of two
 *
 */

if (!isset($_GET['debug'])  && !zen_not_null($_POST['debug']))  define('ZC_UPG_DEBUG',false);
if (!isset($_GET['debug2']) && !zen_not_null($_POST['debug2'])) define('ZC_UPG_DEBUG2',false);
if (!isset($_GET['debug3']) && !zen_not_null($_POST['debug3'])) define('ZC_UPG_DEBUG3',false);
$write_config_files_only = ((isset($_POST['submit']) && $_POST['submit']==ONLY_UPDATE_CONFIG_FILES) || (isset($_POST['configfile']) && zen_not_null($_POST['configfile'])) || (isset($_GET['configfile']) && zen_not_null($_GET['configfile'])) || ZC_UPG_DEBUG3 != false) ? true : false;

// Turn on progress meter
$zc_show_progress='yes';
if (defined('DO_NOT_USE_PROGRESS_METER') && DO_NOT_USE_PROGRESS_METER == 'do_not_use') $zc_show_progress='no';

// check to see if we're upgrading
$is_upgrade = $_GET['is_upgrade'];

  $zc_install->error = false;
  $zc_install->fatal_error = false;
  $zc_install->error_list = array();

  if (isset($_POST['submit'])) {
    if ($_POST['db_type'] != 'mysql') $_POST['db_prefix'] = '';  // if not using mysql, don't support prefixes
    if ($_POST['db_sess'] != 'true' || $_POST['cache_type'] == 'file') {  //if not storing sessions in database, or if caching to file, check folder
      $zc_install->isEmpty($_POST['sql_cache_dir'],  ERROR_TEXT_CACHE_DIR_ISEMPTY, ERROR_CODE_CACHE_DIR_ISEMPTY);
      $zc_install->isDir($_POST['sql_cache_dir'],  ERROR_TEXT_CACHE_DIR_ISDIR, ERROR_CODE_CACHE_DIR_ISDIR);
      $zc_install->isWriteable($_POST['sql_cache_dir'],  ERROR_TEXT_CACHE_DIR_ISWRITEABLE, ERROR_CODE_CACHE_DIR_ISWRITEABLE);
    }
    $zc_install->noDots($_POST['db_prefix'], ERROR_TEXT_DB_PREFIX_NODOTS, ERROR_CODE_DB_PREFIX_NODOTS);
    $zc_install->isEmpty($_POST['db_host'], ERROR_TEXT_DB_HOST_ISEMPTY, ERROR_CODE_DB_HOST_ISEMPTY);
    $zc_install->isEmpty($_POST['db_username'], ERROR_TEXT_DB_USERNAME_ISEMPTY, ERROR_CODE_DB_USERNAME_ISEMPTY);
    $zc_install->isEmpty($_POST['db_name'], ERROR_TEXT_DB_NAME_ISEMPTY, ERROR_CODE_DB_NAME_ISEMPTY);
    $zc_install->fileExists($_POST['db_type'] . '_zencart.sql', ERROR_TEXT_DB_SQL_NOTEXIST, ERROR_CODE_DB_SQL_NOTEXIST);
    $zc_install->functionExists($_POST['db_type'], ERROR_TEXT_DB_NOTSUPPORTED, ERROR_CODE_DB_NOTSUPPORTED);
    $zc_install->dbConnect($_POST['db_type'], $_POST['db_host'], $_POST['db_name'], $_POST['db_username'], $_POST['db_pass'], ERROR_TEXT_DB_CONNECTION_FAILED, ERROR_CODE_DB_CONNECTION_FAILED,ERROR_TEXT_DB_NOTEXIST, ERROR_CODE_DB_NOTEXIST);
    $zc_install->dbExists(false, $_POST['db_type'], $_POST['db_host'], $_POST['db_username'], $_POST['db_pass'], $_POST['db_name'], ERROR_TEXT_DB_NOTEXIST, ERROR_CODE_DB_NOTEXIST);

    if (!$zc_install->fatal_error) {
      include('../includes/classes/db/' . $_POST['db_type'] . '/query_factory.php');
      if ($_POST['db_sess'] == 'true') {
        $_POST['db_sess'] = 'db';
      } else {
        $_POST['db_sess'] = '';
      }
      $virtual_http_path = parse_url($_GET['virtual_http_path']);
      $http_server = $virtual_http_path['scheme'] . '://' . $virtual_http_path['host'];
      $http_catalog = $virtual_http_path['path'];
      if (isset($virtual_http_path['port']) && !empty($virtual_http_path['port'])) {
        $http_server .= ':' . $virtual_http_path['port'];
      }
      if (substr($http_catalog, -1) != '/') {
        $http_catalog .= '/';
      }
      $sql_cache_dir = $_GET['sql_cache_dir'];
      $cache_type = $_GET['cache_type'];
      $https_server = $_GET['virtual_https_server'];
      $https_catalog = $_GET['virtual_https_path'];
      //if the https:// entries were left blank, use catalog versions
      if ($https_server=='' || $https_server=='https://') {$https_server=$http_server;}
      if ($https_catalog=='') {$https_catalog=$http_catalog;}
      $https_catalog_path = ereg_replace($https_server,'',$https_catalog) . '/';
      $https_catalog = $https_catalog_path;

      //now let's write the files
      // Catalog version first:
      require('includes/store_configure.php');
      $fp = fopen($_GET['physical_path'] . '/includes/configure.php', 'w');
      fputs($fp, $file_contents);
      fclose($fp);
      @chmod($_GET['physical_path'] . '/includes/configure.php', 0644);
      // now Admin version:
      require('includes/admin_configure.php');
      $fp = fopen($_GET['physical_path'] . '/admin/includes/configure.php', 'w');
      fputs($fp, $file_contents);
      fclose($fp);
      @chmod($_GET['physical_path'] . '/admin/includes/configure.php', 0644);


// @todo -- test with Mac and Fedora Core 2 ... to see why sometimes fields with just '' are written with only one single-quote instead of two
      // test whether the files were written successfully
      $ztst_http_server = zen_read_config_value('HTTP_SERVER');
      $ztst_db_server = zen_read_config_value('DB_SERVER');
      $ztst_sqlcachedir = zen_read_config_value('DIR_FS_SQL_CACHE');
      if ($ztst_http_server != $http_server || $ztst_db_server != $_POST['db_host'] || $ztst_sqlcachedir != $_POST['sql_cache_dir']) {
        $zc_install->setError(ERROR_TEXT_COULD_NOT_WRITE_CONFIGURE_FILES, ERROR_CODE_COULD_NOT_WRITE_CONFIGURE_FILES, true);
      }

      //OK, files written -- now let's connect to the database and load the tables:
      if ($is_upgrade && !$zc_install->fatal_error) { //if upgrading, move on to the upgrade page
         //update the cache folder setting:
         $db = new queryFactory;
         $db->Connect($_POST['db_host'], $_POST['db_username'], $_POST['db_pass'], $_POST['db_name'], true);
         $sql = "update ".$_POST['db_prefix']."configuration set configuration_value='".$_POST['sql_cache_dir']."' where configuration_key='SESSION_WRITE_DIRECTORY'";
         $db->Execute($sql);
         //update the logging_folder setting:
         $sql = "update ".$_POST['db_prefix']."configuration set configuration_value='".$_POST['sql_cache_dir']."/page_parse_time.log' where configuration_key='STORE_PAGE_PARSE_TIME_LOG'";
         $db->Execute($sql);
         //update the phpbb setting:
         $sql = "update ".$_POST['db_prefix']."configuration set configuration_value='".$_GET['use_phpbb']."' where configuration_key='PHPBB_LINKS_ENABLED'";
         $db->Execute($sql);

         header('location: index.php?main_page=database_upgrade&language=' . $language);
         exit;
      } elseif (!$zc_install->fatal_error && $_POST['submit']==SAVE_DATABASE_SETTINGS) {
			 // not upgrading - load the fresh database
         $db = new queryFactory;
         $db->Connect($_POST['db_host'], $_POST['db_username'], $_POST['db_pass'], $_POST['db_name'], true);

         if ($zc_show_progress == 'yes') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title>Zen Cart&trade; Installer</title>
<link rel="stylesheet" type="text/css" href="includes/templates/template_default/css/stylesheet.css">
</head>
<div id="wrap">
  <div id="header">
  <img src="includes/templates/template_default/images/zen_header_bg.jpg">
  </div>
<div class="progress" align="center"><?php echo INSTALLATION_IN_PROGRESS; ?><br /><br />
<?php
         }
         executeSql($_POST['db_type'] . '_zencart.sql', $_POST['db_name'], $_POST['db_prefix']);

         //update the cache folder setting:
         $sql = "update ".$_POST['db_prefix']."configuration set configuration_value='".$_POST['sql_cache_dir']."' where configuration_key='SESSION_WRITE_DIRECTORY'";
         $db->Execute($sql);
         //update the phpbb setting:
         $sql = "update ".$_POST['db_prefix']."configuration set configuration_value='".$_GET['use_phpbb']."' where configuration_key='PHPBB_LINKS_ENABLED'";
         $db->Execute($sql);

         $db->Close();
         // done - now on to next page for Store Setup (entries into database)

         if ($zc_show_progress == 'yes') {
           $linkto = 'index.php?main_page=store_setup&language=' . $language;
           $link = '<a href="' . $linkto . '">' . '<br /><br />Done!<br />Click Here To Continue<br /><br />' . '</a>';
           echo "\n<script type=\"text/javascript\">\nwindow.location=\"$linkto\";\n</script>\n";
           echo '<noscript>'.$link.'</noscript><br /><br />';
           echo '<div id="footer"><p>Copyright &copy; 2003-2006 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a></p></div></div></body></html>';
         } else {
           header('location: index.php?main_page=store_setup&language=' . $language);
         }
         exit;
      } elseif ($write_config_files_only && !$zc_install->fatal_error) {
         header('location: index.php?main_page=database_upgrade&language=' . $language);
         exit;
      } //endif $is_upgrade
    }
  }

if ($is_upgrade) { // read previous settings from configure.php
   $zdb_type       = zen_read_config_value('DB_TYPE');
   $zdb_prefix     = zen_read_config_value('DB_PREFIX');
   $zdb_server     = zen_read_config_value('DB_SERVER');
   $zdb_user       = zen_read_config_value('DB_SERVER_USERNAME');
   $zdb_pwd        = zen_read_config_value('DB_SERVER_PASSWORD');
   $zdb_name       = zen_read_config_value('DB_DATABASE');
   $zdb_sql_cache  = ($_GET['sql_cache']=='') ? zen_read_config_value('DIR_FS_SQL_CACHE') : $_GET['sql_cache'];
   $zdb_cache_type = zen_read_config_value('SQL_CACHE_METHOD');
   $zdb_persistent = zen_read_config_value('USE_PCONNECT');
   $zdb_sessions   = (zen_read_config_value('STORE_SESSIONS')) ? 'true' : 'false';

  } else { // set defaults:
   $zdb_type       = 'MySQL';
   $zdb_prefix     = '';
   $zdb_server     = 'localhost';
   $zdb_user       = 'root';
   $zdb_name       = 'zencart';
   $zdb_sql_cache  = $_GET['sql_cache'];
   $zdb_cache_type = 'none';
   $zdb_persistent = 'false';
   $zdb_sessions   = 'true';
 } //endif $is_upgrade

  if (!isset($_POST['db_host']))     $_POST['db_host']    = $zdb_server;
  if (!isset($_POST['db_username'])) $_POST['db_username']= $zdb_user;
  if (!isset($_POST['db_name']))     $_POST['db_name']    = $zdb_name;
  if (!isset($_POST['sql_cache']))   $_POST['sql_cache']  = $zdb_sql_cache;
  if (!isset($_POST['db_conn']))     $_POST['db_conn']    = $zdb_persistent;
  if (!isset($_POST['db_sess']))     $_POST['db_sess']    = $zdb_sessions;
  if (!isset($_POST['db_prefix']))   $_POST['db_prefix']  = $zdb_prefix;
  if (!isset($_POST['db_type']))     $_POST['db_type']    = $zdb_type;
  if (!isset($_POST['cache_type']))  $_POST['cache_type'] = $zdb_cache_type;

  setInputValue($_POST['db_host'],    'DATABASE_HOST_VALUE', $zdb_server);
  setInputValue($_POST['db_username'],'DATABASE_USERNAME_VALUE', $zdb_user);
  setInputValue($_POST['db_name'],    'DATABASE_NAME_VALUE', $zdb_name);
  setInputValue($_POST['sql_cache'],  'SQL_CACHE_VALUE', $zdb_sql_cache);
  setInputValue($_POST['db_prefix'],  'DATABASE_NAME_PREFIX', $zdb_prefix );
  setRadioChecked($_POST['db_conn'],  'DB_CONN', $zdb_persistent);
  setRadioChecked($_POST['db_sess'],  'DB_SESS', $zdb_sessions);
?>