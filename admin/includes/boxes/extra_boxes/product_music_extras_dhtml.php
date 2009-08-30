<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_music_extras_dhtml.php 3001 2006-02-09 21:45:06Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
  $za_contents[] = array('text' => BOX_CATALOG_RECORD_ARTISTS, 'link' => zen_href_link(FILENAME_RECORD_ARTISTS, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_RECORD_COMPANY, 'link' => zen_href_link(FILENAME_RECORD_COMPANY, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_MUSIC_GENRE, 'link' => zen_href_link(FILENAME_MUSIC_GENRE, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_MEDIA_MANAGER, 'link' => zen_href_link(FILENAME_MEDIA_MANAGER, '', 'NONSSL'));
  $za_contents[] = array('text' => BOX_CATALOG_MEDIA_TYPES, 'link' => zen_href_link(FILENAME_MEDIA_TYPES, '', 'NONSSL'));
?>
