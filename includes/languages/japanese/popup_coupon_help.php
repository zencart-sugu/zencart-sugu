<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: popup_coupon_help.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_COUPON_HELP', 'クーポンを利用する');
define('TEXT_CLOSE_WINDOW', 'ウィンドウを閉じる [x]');
define('TEXT_COUPON_HELP_HEADER', '割引クーポンをご利用いただけました。');
define('TEXT_COUPON_HELP_NAME', '<br /><br />クーポン名: %s');
define('TEXT_COUPON_HELP_FIXED', '<br /><br />このクーポンをご利用いただくと、商品価格から%s割引いたします。');
define('TEXT_COUPON_HELP_MINORDER', '<br /><br />%s以上お求めいただかないとこのクーポンはご利用いただけません。');
define('TEXT_COUPON_HELP_FREESHIP', '<br /><br />このクーポンをご利用いただくと配送料が無料になります。');
define('TEXT_COUPON_HELP_DESC', '<br /><br />クーポンの種類: %s');
define('TEXT_COUPON_HELP_DATE', '<br /><br />このクーポンは%sから%sの間だけご利用になれます。');
define('TEXT_COUPON_HELP_RESTRICT', '<br /><br />商品・カテゴリ制限');
define('TEXT_COUPON_HELP_CATEGORIES', 'カテゴリ');
define('TEXT_COUPON_HELP_PRODUCTS', '商品');
define('TEXT_ALLOW', '割引可');
define('TEXT_DENY', '割引対象外');

define('TEXT_ALLOWED', ' (割引可)');
define('TEXT_DENIED', ' (割引対象外)');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','割引クーポンは' . TEXT_GV_NAMES . 'をお買い求めの際はご利用いただけない場合があります。');
?>