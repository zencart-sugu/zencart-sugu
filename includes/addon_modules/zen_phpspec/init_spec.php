<?php
// テスト用のDB定義
define('DB_TYPE',            'mysql');
define('DB_PREFIX',          '');
define('DB_SERVER',          '127.0.0.1');
define('DB_SERVER_USERNAME', 'root');
define('DB_SERVER_PASSWORD', '');
define('DB_DATABASE',        'zencart-sugu');
define('USE_PCONNECT',       'false');
define('STORE_SESSIONS',     'db');
define('ZC_UPG_DEBUG3',      false);

require_once 'init_variables.php';

$cwd = getcwd();
chdir("../../../../");
require('includes/application_top.php');
chdir($cwd);
?>
