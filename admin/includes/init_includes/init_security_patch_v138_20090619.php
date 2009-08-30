<?php
/**
 * @package patches
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_security_patch_v138_20090619.php 13619 2009-06-21 16:11:20Z wilt $
 */
/**
 * Security Patch v138 20090619
 * @package patches
 */ 
if (! isset ( $_SESSION ['securityToken'] ))
{
  $_SESSION ['securityToken'] = md5 ( uniqid ( rand (), true ) );
}
if (isset ( $_GET ['action'] ) && in_array ( $_GET ['action'], array ('save', 'layout_save', 'update', 'update_sort_order', 'update_confirm', 'copyconfirm', 'deleteconfirm', 'insert', 'move_category_confirm', 'delete_category_confirm', 'update_category_meta_tags', 'insert_category' ) ))
{
  if (strpos ( $PHP_SELF, FILENAME_PRODUCTS_PRICE_MANAGER ) === FALSE && strpos ( $PHP_SELF, FILENAME_PRODUCTS_OPTIONS_NAME ) === FALSE && (strpos( $PHP_SELF, FILENAME_CURRENCIES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_LANGUAGES ) === FALSE) && (strpos( $PHP_SELF, FILENAME_SPECIALS ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_FEATURED ) === FALSE)&& (strpos( $PHP_SELF, FILENAME_SALEMAKER ) === FALSE))
  {
    if ((! isset ( $_SESSION ['securityToken'] ) || ! isset ( $_POST ['securityToken'] )) || ($_SESSION ['securityToken'] !== $_POST ['securityToken']))
    {
      zen_redirect ( zen_href_link ( FILENAME_DEFAULT, '', 'SSL' ) );
    }
  }
}
