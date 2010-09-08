<?php
  require_once(DIR_WS_ADDON_MODULES . 'zen_smartphone/classes/zen_smartphone_model.php');
  require_once(DIR_WS_ADDON_MODULES . 'zen_smartphone/configure.php');

  $smartphone_model = new zen_smartphone_model();
  $smartphone_model->init($_SERVER['HTTP_USER_AGENT'], $db);
?>