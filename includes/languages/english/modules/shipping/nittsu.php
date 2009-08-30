<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2004 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+

define('MODULE_SHIPPING_NITTSU_TEXT_TITLE',       'Nittsu Express');
define('MODULE_SHIPPING_NITTSU_TEXT_DESCRIPTION', 'Nittsu Express');

define('MODULE_SHIPPING_NITTSU_TEXT_WAY_NORMAL',  'Groud');
define('MODULE_SHIPPING_NITTSU_TEXT_WAY_COOL',    'Cool Express');
define('MODULE_SHIPPING_NITTSU_TEXT_WAY_TOP',     'Top Express');

define('MODULE_SHIPPING_NITTSU_TEXT_NOTAVAILABLE', 'Service is not available between the areas.');
define('MODULE_SHIPPING_NITTSU_TEXT_OVERSIZE',     'Too large to delivery.');
define('MODULE_SHIPPING_NITTSU_TEXT_ILLEGAL_ZONE', 'Illegal zone.');
define('MODULE_SHIPPING_NITTSU_TEXT_OUT_OF_AREA',  'Out of delivery area.');

// 時間帯サービス
$GLOBALS['a_nittsu_time']=array(
  array('id'=>'希望なし',  'text'=>'None'),
  array('id'=>'08時〜12時','text'=>'Morning'),
  array('id'=>'12時〜16時','text'=>'12 a.m. - 4 p.m.'),
  array('id'=>'16時〜19時','text'=>'4 p.m. - 7 p.m.'),
  array('id'=>'19時〜22時','text'=>'7 p.m. - 10 p.m.'),
);
?>
