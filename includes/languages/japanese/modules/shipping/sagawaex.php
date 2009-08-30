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

define('MODULE_SHIPPING_SAGAWAEX_TEXT_TITLE',       '佐川急便');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_DESCRIPTION', '佐川急便の配送料金');

define('MODULE_SHIPPING_SAGAWAEX_TEXT_WAY_NORMAL',  '通常便');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_WAY_COOL',    '飛脚クール便');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_WAY_TOP',     '飛脚航空便・飛脚トップ便');

define('MODULE_SHIPPING_SAGAWAEX_TEXT_NOTAVAILABLE', 'このサービスは、選択された地域間では提供されません。');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_OVERSIZE',     '重量またはサイズが制限を超えています。');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_ILLEGAL_ZONE', '指定された都道府県が正しくありません。');
define('MODULE_SHIPPING_SAGAWAEX_TEXT_OUT_OF_AREA',  '配達区域外です。');

// 時間帯サービス
$GLOBALS['a_sagawaex_time']=array(
  array('id'=>'希望なし',  'text'=>'希望なし'),
  array('id'=>'午前中',    'text'=>'午前中'),
  array('id'=>'12時〜15時','text'=>'12時〜15時'),
  array('id'=>'15時〜18時','text'=>'15時〜18時'),
  array('id'=>'18時〜21時','text'=>'18時〜21時'),
);
?>