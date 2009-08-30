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
// $Id: gv_redeem.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE', '' . TEXT_GV_NAME . '引き換え');
define('HEADING_TITLE', '' . TEXT_GV_NAME . '引き換え');
define('TEXT_INFORMATION', '' . TEXT_GV_NAME . 'について詳しくお知りになりたい方は、<a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '</a>をご覧ください。');
define('TEXT_INVALID_GV', '' . TEXT_GV_NAME . 'の番号はすでに引き換えられています。ご不明な点がありましたら、お問い合わせページから当ショップの管理者にお問い合わせください。');
define('TEXT_VALID_GV', '' . TEXT_GV_NAME . 'の引き換えが完了しました。 引換え額：%s');
?>