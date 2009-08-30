<?php 
/**
 * @package patches
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: security_patch_v138_20090619.php 13603 2009-06-19 15:46:22Z wilt $
 */
/**
 * Security Patch v138 20090619
 * @package patches
 */ 
if (strtolower(basename ( $PHP_SELF )) == strtolower(FILENAME_PASSWORD_FORGOTTEN . '.php') && substr_count ( strtolower($PHP_SELF), '.php' ) > 1)
{
  zen_redirect ( zen_href_link ( FILENAME_LOGIN, '', 'SSL' ) );
}
