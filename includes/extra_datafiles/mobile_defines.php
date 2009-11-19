<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mobile_filenames.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  define('MOBILE_LANGUAGE_CODE_SUFFIX', '-mobile');
  define('MOBILE_LANGUAGE_NAME_SUFFIX', '(mobile)');

  // 現状はzen_mobile固定になっているが、
  // 将来的には XXX_mobileなどの命名なら
  // モバイル用テンプレートであると、
  // setup_mobile_site.phpが認識し、
  // インストール対象としてリストしてくれるように
  // したい。  ( by 志田 2008-03-12)
  define('MOBILE_TEMPLATE_DIR', 'zen_mobile');

  define('MOBILE_IMAGES_WIDTH_LARGE', '150');
  define('MOBILE_IMAGES_WIDTH_SMALL', '120');
  define('DIR_WS_MOBILE_IMAGES', DIR_WS_IMAGES . 'mobile/');
  define('MOBILE_IMAGES_EXTENSION', '.jpg');
?>
