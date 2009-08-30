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
// $Id: privacy.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE', '個人情報保護方針');
define('HEADING_TITLE', '個人情報保護方針');

define('TEXT_INFORMATION', '【ショップ開店の前に - 個人情報保護方針について】<br />
<br />
<span class="alert">2005年4月1日に施行された「個人情報保護法」では、個人情報保護方針を「本人が容易に知りうる状態」に置くことを定めています。</span><br />
したがって、ショップ開店前に「個人情報保護方針」を策定し、このページに開示することを薦めます。<br />
<br />
この部分を変更するには、<br /><strong>/includes/languages/japanese/privacy.php</strong>の<strong>define(\'TEXT_INFORMATION\',</strong>の右側の<br />
シングルクォーテーション(\')の間を編集してください。<br />また、下部のテキストボックスのみを使用する場合は、<br /><strong>define(\'TEXT_IN
FORMATION\',\'\')</strong><br />のようにシングルクォーテーションの間には、何も記入せずに保存することで、この部分は非表示になります。
');
?>