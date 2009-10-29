<?php
/**
 * addon header_php.php
 *
 * @package page
 * @copyright Copyright 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ADDON');

$perse_page_module = zen_addOnModules_persePageModule($_GET['module']);
$page_class = $perse_page_module['class'];
$page_method = $perse_page_module['method'];
// check module page enable
$enable_module_page = false;

$enabled_modules = zen_addOnModules_get_enabled_modules();
if (in_array($page_class, $enabled_modules) && method_exists($page_class, $page_method)) {
  $enable_module_page = true;
}

if (!$enable_module_page) {
  if (MISSING_PAGE_CHECK == 'On' || MISSING_PAGE_CHECK == 'true') {
    $redirect_page = FILENAME_DEFAULT;
  } elseif (MISSING_PAGE_CHECK == 'Page Not Found') {
    $redirect_page = FILENAME_PAGE_NOT_FOUND;
  }
  zen_redirect(zen_href_link($redirect_page));
}

$page_module = $GLOBALS[$page_class];
$page_module->requirePageLanguages($template_dir, $page_method);
extract($page_module->getPageHeader($page_method));
$page_module->addPageBreadcrumb($page_method);
$page_module->definePageMetaTags($page_method);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ADDON');
?>