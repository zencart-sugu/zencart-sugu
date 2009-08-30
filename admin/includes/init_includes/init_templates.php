<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_templates.php 3739 2006-06-09 21:09:35Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
// Set theme related directories
  $template_query = $db->Execute("select template_dir
                                  from " . TABLE_TEMPLATE_SELECT .
                                  " where template_language = '0'");

  $template_dir = $template_query->fields['template_dir'];
  $template_query = $db->Execute("select template_dir
                                  from " . TABLE_TEMPLATE_SELECT .
                                  " where template_language = '" . $_SESSION['languages_id'] . "'");

  if ($template_query->RecordCount() > 0) {
    $template_dir = $template_query->fields['template_dir'];
  }

//  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_CATALOG_TEMPLATE . $template_dir . '/images/');
  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_CATALOG_TEMPLATE . 'template_default' . '/images/');
  define('DIR_WS_TEMPLATE_ICONS', DIR_WS_TEMPLATE_IMAGES . 'icons/');

  require(DIR_FS_CATALOG . DIR_WS_CLASSES . 'template_func.php');
  $template = new template_func(DIR_WS_TEMPLATE);

/**
 * send the content charset "now" so that all content is impacted by it - this is important for non-english sites
 */
  header("Content-Type: text/html; charset=" . CHARSET);

?>