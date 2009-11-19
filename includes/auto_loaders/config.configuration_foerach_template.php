<?php

if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
}

$autoLoadConfig[80][] = array('autoType'=>'init_script',
                                'loadFile'=>'init_define_queries_configuration_foreach_template.php');
$autoLoadConfig[105][] = array('autoType'=>'init_script',
                                'loadFile'=>'init_db_config_foreach_template_read.php');

?>
