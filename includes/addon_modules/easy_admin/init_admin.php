<?php
  ini_set('include_path', ini_get('include_path').DIR_FS_CATALOG.'/admin'.':'.DIR_FS_CATALOG);

  switch ($_SERVER["SCRIPT_NAME"]) {
  case DIR_WS_ADMIN:
  case DIR_WS_HTTPS_ADMIN:
  case DIR_WS_HTTPS_ADMIN.'index.php':
    if (MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL != '') {
      zen_redirect(MODULE_EASY_ADMIN_DASHBOARD_REDIRECT_URL);
    }
    break;
  }

  if(basename($_SERVER['PHP_SELF']) != FILENAME_LOGIN . '.php') {
    $GLOBALS['easy_admin_block_header'] = $GLOBALS['easy_admin']->getBlock('block_header', $current_page_base);
    $GLOBALS['easy_admin_block_append_html_header'] = $GLOBALS['easy_admin']->getBlock('block_append_html_header', $current_page_base);
    ob_start("handle_easy_admin_ob");
  }
?>
