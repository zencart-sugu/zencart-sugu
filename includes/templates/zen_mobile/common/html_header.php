<?php
/**
 * Common Template
 *
 * outputs the html header. i,e, everything that comes before the \</head\> tag <br />
 * 
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: html_header.php 3688 2006-06-02 00:12:18Z drbyte $
 */
/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
/**
 * output main page HEAD tag and related headers/meta-tags, etc
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo META_TAG_TITLE; ?></title>
<?php /*
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
*/?>
<?php /* zen_mobile ->
<meta http-equiv="imagetoolbar" content="no" />
<meta name="author" content="The Zen Cart&trade; Team and others" />
<meta name="generator" content="shopping cart program by Zen Cart&trade;, http://www.zen-cart.com" />
<- zen_mobile */ ?>
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance') { ?>
<meta name="robots" content="noindex, nofollow" />
<?php } ?>
<?php if (defined('FAVICON')) { ?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon" />
<?php } //endif FAVICON ?>
<?php /* zen_mobile ->
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>" />
<- zen_mobile */ ?>
<?php
/**
 * load all template-specific stylesheets, named like "style*.css", alphabetically
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^style/', '.css');
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
<- zen_mobile */
	
/**
 * load stylesheets on a per-page/per-language/per-product/per-manufacturer/per-category basis. Concept by JuxiJoza.
 */
 
/* zen_mobile ->
  $manufacturers_id = (isset($_GET['manufacturers_id'])) ? $_GET['manufacturers_id'] : '';
  $tmp_products_id = (isset($_GET['products_id'])) ? (int)$_GET['products_id'] : '';
  $sheets_array = array('/^' . $_SESSION['language'] . '_stylesheet/' , 
                        '/^' . $current_page_base.'/', 
                        '/^' . $_SESSION['language'] . '_' . $current_page_base .'/', 
                        '/^c_' . (int)$cPath .'/',
                        '/^' . $_SESSION['language'] . '_c_' . (int)$cPath . '/',
                        '/^m_' . $manufacturers_id.'/',
                        '/^' . $_SESSION['language'] . '_m_' . (int)$manufacturers_id . '/', 
                        '/^p_' . $tmp_products_id . '/',
                        '/^' . $_SESSION['language'] . '_p_' . $tmp_products_id . '/'
                        );
  while(list ($key, $value) = each($sheets_array)) {
//echo "<--$value-->\n";
    $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), $value, '.css');
    sort($directory_array);
    while(list ($key2, $value2) = each($directory_array)) {
      echo '<link rel="stylesheet" type="text/css" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value2 .'" />'."\n";
    }
  }
<- zen_mobile */

/**
 * load printer-friendly stylesheets -- named like "print*.css", alphabetically
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css'), '/^print/', '.css');
  sort($directory_array);
  while(list ($key, $value) = each($directory_array)) {
    echo '<link rel="stylesheet" type="text/css" media="print" href="' . $template->get_template_dir('.css',DIR_WS_TEMPLATE, $current_page_base,'css') . '/' . $value . '" />'."\n";
  }
<- zen_mobile */

/**
 * load all site-wide jscript_*.js files from includes/templates/YOURTEMPLATE/jscript, alphabetically
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' .  $template->get_template_dir('.js',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value . '"></script>'."\n";
  }
<- zen_mobile */

/**
 * load all page-specific jscript_*.js files from includes/modules/pages/PAGENAME, alphabetically
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/', '.js');
  while(list ($key, $value) = each($directory_array)) {
    echo '<script type="text/javascript" src="' . $page_directory . '/' . $value . '"></script>' . "\n";
  }
<- zen_mobile */

/**
 * load all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript'), '/^jscript_/', '.php');
  while(list ($key, $value) = each($directory_array)) {
<- zen_mobile */
	
/**
 * include content from all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically.
 * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
 */
 
/* zen_mobile ->
    require($template->get_template_dir('.php',DIR_WS_TEMPLATE, $current_page_base,'jscript') . '/' . $value); echo "\n";
  }
<- zen_mobile */
	
/**
 * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
 */
 
/* zen_mobile ->
  $directory_array = $template->get_template_part($page_directory, '/^jscript_/');
  while(list ($key, $value) = each($directory_array)) {
<- zen_mobile */
	
/**
 * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
 * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
 */
 
/* zen_mobile ->
    require($page_directory . '/' . $value); echo "\n";
  }
<- zen_mobile */
?>
</head>
<?php // NOTE: Blank line following is intended: ?>
