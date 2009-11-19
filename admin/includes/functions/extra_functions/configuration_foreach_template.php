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
?>
