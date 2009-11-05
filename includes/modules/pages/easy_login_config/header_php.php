<?php

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}
if(isset($_POST['config'])){
    if($_POST['config']){
        $serial = $mobile->getSerialNumber();
        if($serial){
            $query = "update ".TABLE_CUSTOMERS." set customers_mobile_serial_number = '".$serial."' where customers_id = :customersID";
            $query = $db->bindVars($query, ':customersID', $_SESSION['customer_id'], 'integer');
            $db->Execute($query);
        }
    }else{
        $query = "update ".TABLE_CUSTOMERS." set customers_mobile_serial_number = NULL where customers_id = :customersID";
        $query = $db->bindVars($query, ':customersID', $_SESSION['customer_id'], 'integer');
        $db->Execute($query);
    }
}
$query = "select customers_mobile_serial_number from ". TABLE_CUSTOMERS ." where customers_id = :customersID";
$query = $db->bindVars($query, ':customersID', $_SESSION['customer_id'], 'integer');
$result = $db->Execute($query);
$cmsn = $result->fields['customers_mobile_serial_number'];
if(isset($cmsn)){
    $current_config = TEXT_CONFIG_ACTIVE;
    $conf_flg = true;
}else{
    $current_config = TEXT_CONFIG_NON_ACTIVE;
    $conf_flg = false;
}


?>
