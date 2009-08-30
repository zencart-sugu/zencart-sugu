<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: store_configure.php 3121 2006-03-06 21:49:11Z drbyte $
 */

if (!isset($_GET['phpbb_dir'])) $_GET['phpbb_dir'] = '';

$file_contents =
'<'.'?php' . "\n" .
'/**' . "\n" .
' *' . "\n" .
' * @package Configuration Settings' . "\n" .
' * @copyright Copyright 2003-2006 Zen Cart Development Team' . "\n" .
' * @copyright Portions Copyright 2003 osCommerce' . "\n" .
' * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0' . "\n" .
' */' . "\n" .
'' . "\n" .
'' . "\n" .
'// Define the webserver and path parameters' . "\n" .
'  // HTTP_SERVER is your Main webserver: eg, http://www.yourdomain.com' . "\n" .
'  // HTTPS_SERVER is your Secure webserver: eg, https://www.yourdomain.com' . "\n" .
'  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
'  define(\'HTTPS_SERVER\', \'' . $https_server . '\');' . "\n\n" .
'  // Use secure webserver for checkout procedure?' . "\n" .
'  define(\'ENABLE_SSL\', \'' . $_GET['enable_ssl'] . '\');' . "\n\n" .
'// NOTE: be sure to leave the trailing \'/\' at the end of these lines if you make changes!' . "\n" .
'// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
'  // these paths are relative to top of your webspace ... (ie: under the public_html or httpdocs folder)' . "\n" .
'  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
'  define(\'DIR_WS_HTTPS_CATALOG\', \'' . $https_catalog . '\');' . "\n\n" .
'  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
'  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
'  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
'  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
'  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
'  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
'  define(\'DIR_WS_DOWNLOAD_PUBLIC\', DIR_WS_CATALOG . \'pub/\');' . "\n" .
'  define(\'DIR_WS_TEMPLATES\', DIR_WS_INCLUDES . \'templates/\');' . "\n\n" .
'  define(\'DIR_WS_PHPBB\', \'' . $_GET['phpbb_dir'] . '/\');' . "\n\n" .
'// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
'  //the following path is a COMPLETE path to your Zen Cart files. eg: /var/www/vhost/accountname/public_html/store/' . "\n" .
'  define(\'DIR_FS_CATALOG\', \'' . $_GET['physical_path'] . '/\');' . "\n" .
'  define(\'DIR_FS_HTTPS_CATALOG\', \'' . $_GET['physical_https_path'] . '\');' . "\n\n" .
'  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
'  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n" .
'  define(\'DIR_WS_UPLOADS\', DIR_WS_IMAGES . \'uploads/\');' . "\n" .
'  define(\'DIR_FS_UPLOADS\', DIR_FS_CATALOG . DIR_WS_UPLOADS);' . "\n" .
'  define(\'DIR_FS_EMAIL_TEMPLATES\', DIR_FS_CATALOG . \'email/\');' . "\n\n" .
'// define our database connection' . "\n" .
'  define(\'DB_TYPE\', \'' . $_POST['db_type']. '\');' . "\n" .
'  define(\'DB_PREFIX\', \'' . $_POST['db_prefix']. '\');' . "\n" .
'  define(\'DB_SERVER\', \'' . $_POST['db_host'] . '\'); // eg, localhost - should not be empty' . "\n" .
'  define(\'DB_SERVER_USERNAME\', \'' . $_POST['db_username'] . '\');' . "\n" .
'  define(\'DB_SERVER_PASSWORD\', \'' . $_POST['db_pass'] . '\');' . "\n" .
'  define(\'DB_DATABASE\', \'' . $_POST['db_name'] . '\');' . "\n" .
'  define(\'USE_PCONNECT\', \'false\'); // use persistent connections?' . "\n" .
'  define(\'STORE_SESSIONS\', \'' . $_POST['db_sess'] . '\'); // leave empty \'\' for default handler or set to \'db\'' . "\n\n" .
'  // The next 2 "defines" are for SQL cache support.' . "\n" .
'  // For SQL_CACHE_METHOD, you can select from:  none, database, or file' . "\n" .
'  // If you choose "file", then you need to set the DIR_FS_SQL_CACHE to a directory where your apache ' . "\n" .
'  // or webserver user has write privileges (chmod 666 or 777). We recommend using the "cache" folder inside the Zen Cart folder' . "\n" .
'  // ie: /path/to/your/webspace/public_html/zen/cache   -- leave no trailing slash  ' . "\n" .
'  define(\'SQL_CACHE_METHOD\', \'' . $_POST['cache_type'] . '\'); ' . "\n" .
'  define(\'DIR_FS_SQL_CACHE\', \'' . $_POST['sql_cache_dir'] . '\');' . "\n\n" .
'?'.'>';
?>