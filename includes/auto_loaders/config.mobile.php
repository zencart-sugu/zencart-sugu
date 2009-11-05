<?php
/**
 * autoloader array for catalog application_top.php
 * see  {@link  http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem wikitutorials} for more details.
 *
 * @package initSystem
 * @copyright Copyright (C) 2006 Zen Cart.JP
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @author Tadahito HIRAOKA <hira—s-page.net>
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IS_ADMIN_FLAG')) {
 die('Illegal Access');
} 

// 65: should be before init_sessions
  $autoLoadConfig[65][] = array('autoType'=>'init_script',
                              'loadFile'=>'init_mobile.php');
// 70: should override init_sessions.php
  $autoLoadConfig[70][0] = array('autoType'=>'init_script',
                                 'loadFile'=>'init_sessions_for_mobile.php');
// 75: should be before init_languages
  $autoLoadConfig[75][] = array('autoType'=>'init_script',
                                 'loadFile'=>'init_mobile2.php');
// 165: should be after init_special_funcs
// which call whose_online.php which has zen_whos_online_session_recreate()
  $autoLoadConfig[165][] = array('autoType'=>'init_script',
                                 'loadFile'=>'init_mobile3.php');
?>
