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

define('MODULE_SHIPPING_NITTSU_TEXT_TITLE',       '日本通運ペリカン便');
define('MODULE_SHIPPING_NITTSU_TEXT_DESCRIPTION', '日本通運ペリカン便による配送料金');

define('MODULE_SHIPPING_NITTSU_TEXT_WAY_NORMAL',  '通常便');
define('MODULE_SHIPPING_NITTSU_TEXT_WAY_COOL',    'クールペリカン便');
define('MODULE_SHIPPING_NITTSU_TEXT_WAY_TOP',     '飛脚航空便・飛脚トップ便（日通には該当する箇所があるのかわかりませんので各自お願い致します。）');

define('MODULE_SHIPPING_NITTSU_TEXT_NOTAVAILABLE', '要求のあったサービスは、選択された地域間では提供されません.');
define('MODULE_SHIPPING_NITTSU_TEXT_OVERSIZE',     '重量またはサイズが制限を超えています.');
define('MODULE_SHIPPING_NITTSU_TEXT_ILLEGAL_ZONE', '指定された都道府県が不正です.');
define('MODULE_SHIPPING_NITTSU_TEXT_OUT_OF_AREA',  '配達区域外です.');

// 時間帯サービス
$GLOBALS['a_nittsu_time']=array(
  array('id'=>'希望なし',  'text'=>'希望なし'),
  array('id'=>'08時〜12時','text'=>'朝 8時〜12時'),
  array('id'=>'12時〜16時','text'=>'昼 12時〜16時'),
  array('id'=>'16時〜19時','text'=>'夕 16時〜19時'),
  array('id'=>'19時〜22時','text'=>'夜 19時〜22時'),
);
?>
