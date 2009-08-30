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

define('MODULE_SHIPPING_YAMATO_TEXT_TITLE',       'ヤマト運輸(宅急便)');
define('MODULE_SHIPPING_YAMATO_TEXT_DESCRIPTION', '宅急便の配送料金');

define('MODULE_SHIPPING_YAMATO_TEXT_WAY_NORMAL',  '宅急便');
define('MODULE_SHIPPING_YAMATO_TEXT_WAY_COOL',    'クール宅急便');
define('MODULE_SHIPPING_YAMATO_TEXT_WAY_TOP',     '超速宅急便');

define('MODULE_SHIPPING_YAMATO_TEXT_NOTAVAILABLE', 'このサービスは、選択された地域間では提供されません。');
define('MODULE_SHIPPING_YAMATO_TEXT_OVERSIZE',     '重量またはサイズが制限を超えています。');
define('MODULE_SHIPPING_YAMATO_TEXT_ILLEGAL_ZONE', '指定された都道府県が正しくありません。');
define('MODULE_SHIPPING_YAMATO_TEXT_OUT_OF_AREA',  '配達区域外です。');

// 時間帯サービス
$GLOBALS['a_yamato_time']=array(
  array('id'=>'希望なし',  'text'=>'希望なし'),
  array('id'=>'午前中',    'text'=>'午前中'),
  array('id'=>'12時〜14時','text'=>'12時〜14時'),
  array('id'=>'14時〜16時','text'=>'14時〜16時'),
  array('id'=>'16時〜18時','text'=>'16時〜18時'),
  array('id'=>'18時〜20時','text'=>'18時〜20時'),
  array('id'=>'20時〜21時','text'=>'20時〜21時'),
);
?>
