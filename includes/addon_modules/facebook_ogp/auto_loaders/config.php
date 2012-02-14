<?php
if (IS_ADMIN_FLAG != 'true') {
  $autoLoadConfig[95][] = array('autoType'=>'require',
                               'loadFile'=> DIR_WS_ADDON_MODULES . 'facebook_ogp/auto_loaders/init.php');
}
?>
