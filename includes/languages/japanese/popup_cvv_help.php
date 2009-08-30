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
// $Id: popup_cvv_help.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_CVV', 'CVVとは?');
define('TEXT_CVV_HELP1', 'Visa、Mastercard、Discoverカード照合番号(CVV)<br /><br />
                    お客様の情報保護のため、カード照合番号(CVV)を記入してください。<br /><br />
                    カード照合番号(CVV)はカードの裏面の署名欄に記入されている3桁の数字です。
                    カード番号の下3桁か、その後に記載されています。<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));

define('TEXT_CVV_HELP2', 'American Expressカード照合番号(CVV)<br /><br />
                    お客様の情報保護のため、カード照合番号(CVV)を記入してください。<br /><br />
                    American Expressのカード照合番号は表面の4桁の番号です。
                    カード番号の下4桁かその後にある数字です。<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));

define('TEXT_CLOSE_CVV_WINDOW', 'ウィンドウを閉じる[x]');
?>