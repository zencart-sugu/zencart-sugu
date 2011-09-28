<?php
  ini_set('include_path', ini_get('include_path').DIR_FS_CATALOG.'/admin'.':'.DIR_FS_CATALOG);

  if(basename($_SERVER['PHP_SELF']) != FILENAME_LOGIN . '.php') {
    $GLOBALS['easy_admin_block_header'] = $GLOBALS['easy_admin']->getBlock('block_header', $current_page_base);
    ob_start("handle_easy_admin_ob");
  }
?>
