<?php
if (IS_ADMIN_FLAG != 'true') {
  $autoLoadConfig[75][] = array('autoType'=>'require',
                               'loadFile'=> DIR_WS_ADDON_MODULES . 'zen_smartphone/auto_loaders/init.php');
}
?>