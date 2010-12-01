<?php
// search index of phpmailer 
foreach ($autoLoadConfig[0] as $idx => $cfg) {
  if ($cfg['autoType'] == 'class' && $cfg['loadFile'] == 'class.phpmailer.php') {
    $phpmailer_index = $idx;
    break;
  }
}
// load customized phpmailer
$autoLoadConfig[0][$phpmailer_index] = array('autoType'=>'require',
                                             'loadFile'=> DIR_FS_CATALOG_ADDON_MODULES . 'email_templates/classes/class.phpmailer.php');
unset($phpmailer_index);
?>