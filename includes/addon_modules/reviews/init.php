<?php
/**
 * reviews modules init file
 * see {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2008 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: init.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if (strstr($_GET['main_page'], 'reviews_write')){
    zen_redirect(zen_href_link(FILENAME_ADDON, 'module=reviews/product_reviews_write&' . zen_get_all_get_params(array('main_page', 'module'))));
}
if ($_GET['main_page']=='product_reviews'){
    zen_redirect(zen_href_link(FILENAME_ADDON, 'module=reviews/product_reviews&' . zen_get_all_get_params(array('main_page', 'module'))));
}



?>