<?php
/**
 * read the configuration settings from the db
 *
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_db_config_read.php 2753 2005-12-31 19:17:17Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$template_dir = "";
$template_query = $db->Execute("select template_dir
        from " . TABLE_TEMPLATE_SELECT ." where template_language = 0");
$template_dir = $template_query->fields['template_dir'];
$template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . "
                                where template_language = '" . $_SESSION['languages_id'] . "'");
if ($template_query->RecordCount() > 0) {
  $template_dir = $template_query->fields['template_dir'];
}

$use_cache = (isset($_GET['nocache']) ? false : true ) ;
$configuration = $db->Execute('SELECT configuration_key AS cfgkey, configuration_value AS cfgvalue FROM '
                              .TABLE_CONFIGURATION_FOREACH_TEMPLATE.' WHERE template_dir = "'.$template_dir.'"', '', $use_cache, 150);
db_define($configuration);

$configuration = $db->Execute('SELECT DISTINCT cfg_t.configuration_key AS cfgkey,
                                               cfg_t.configuration_value AS cfgvalue 
                               FROM ' . TABLE_CONFIGURATION.' AS cfg_t 
                               LEFT JOIN ' . TABLE_CONFIGURATION_FOREACH_TEMPLATE .' AS cfg_ft 
                                 ON cfg_t.configuration_key=cfg_ft.configuration_key 
                               WHERE cfg_ft.configuration_key IS NOT NULL 
                                 AND cfg_ft.template_dir<>"'.$template_dir.'"');
db_define($configuration);

/*
function db_define($configuration){
  while (!$configuration->EOF) {
 // dynamic define based on info read from DB
    define(strtoupper($configuration->fields['cfgkey']), $configuration->fields['cfgvalue']);
    $configuration->MoveNext();
  }
}
*/
?>
