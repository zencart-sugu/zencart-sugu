<?php
/**
 * if gzip_compression is enabled, start to buffer the output
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @todo ICW note some of this can go if we move to php>4.2
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init_gzip.php 2753 2005-12-31 19:17:17Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if ( (GZIP_LEVEL == '1') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
  if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
    if (PHP_VERSION >= '4.0.4') {
      ob_start('ob_gzhandler');
    } else {
      /**
       * include the gzip compression functions
       */
      include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
      ob_start();
      ob_implicit_flush();
    }
  } else {
    @ini_set('zlib.output_compression_level', GZIP_LEVEL);
  }
}
?>