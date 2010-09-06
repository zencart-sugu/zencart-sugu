<?php
include(DIR_FS_CATALOG.'includes/extra_configures/configuration_foreach_template.php');
function zen_get_not_cfg_query($mark){
  $not_cfg_query = "";
  global $not_cfg_array;
  while(current($not_cfg_array)){
    $not_cfg_query .= "configuration_key".$mark." '".current($not_cfg_array)."'";
    if(next($not_cfg_array)){
      $not_cfg_query .= " AND ";
    }
  }
  return $not_cfg_query;
}
function zen_get_template_dir(){
    global $db;
    $template_dir = "";
    $template_query = $db->Execute("select template_dir
            from " . TABLE_TEMPLATE_SELECT ." where template_language = 0");
    $template_dir = $template_query->fields['template_dir'];
    $template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . "
            where template_language = '" . $_SESSION['languages_id'] . "'");
    if ($template_query->RecordCount() > 0) {
        $template_dir = $template_query->fields['template_dir'];
    }
    return $template_dir;
}
//group_id,RIGHT or LEFT (RIGHT=1 LEFT=2 
function zen_get_sql_product_display($group_id,$way){
    $template_dir = zen_get_template_dir();
    $query = "select configuration_key,configuration_value from ".TABLE_CONFIGURATION_FOREACH_TEMPLATE." 
        where configuration_group_id='$group_id' and (configuration_value >= ".$way."000 and configuration_value <= ".$way."999) 
        and template_dir='$template_dir'
        union 
        select cfg.configuration_key,cfg.configuration_value from ".TABLE_CONFIGURATION." as cfg 
        left join ".TABLE_CONFIGURATION_FOREACH_TEMPLATE." as cfg_ft 
        on cfg.configuration_key = cfg_ft.configuration_key and cfg_ft.template_dir='$template_dir' 
        where cfg_ft.configuration_key IS NULL and cfg.configuration_group_id='$group_id' 
        and (cfg.configuration_value >= ".$way."000 and cfg.configuration_value <= ".$way."999) order by LPAD(configuration_value,11,0)";
    return $query;
}
?>
