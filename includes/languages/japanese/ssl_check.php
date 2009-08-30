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
// $Id: ssl_check.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('NAVBAR_TITLE', 'セキュリティチェック');
define('HEADING_TITLE', 'セキュリティチェック');

define('TEXT_INFORMATION', 'お客様のWebブラウザが使用しているSSLセッションIDと、当ショップのセキュリティページが使用しているSSLセッションIDが異なっています。');
define('TEXT_INFORMATION_2', 'セキュリティ上の問題があります。恐れ入りますが、もう一度ログインしてください。');
define('TEXT_INFORMATION_3','いくつかのWebブラウザは、当ショップのご利用に必要な安全なSSLセッションIDを自動的に運用できません。そのようなWebブラウザをご使用の場合、他のブラウザに変更されることをお薦めします。互換性のあるブラウザはこちらなどで入手できます。：<a href="http://www.microsoft.com/ie/" target="_blank">Microsoft Internet Explorer</a>│<a href="http://channels.netscape.com/ns/browsers/download_other.jsp" target="_blank">Netscape</a>│<a href="http://www.mozilla.org/releases/" target="_blank">Mozilla</a>');
define('TEXT_INFORMATION_4','お客様の情報保護のためにこのような措置をとらせていただいておりますが、ご不便をおかけしますことを深くお詫び申し上げます。');
define('TEXT_INFORMATION_5','セキュリティについてや、当ショップのご利用全般についてのご質問は、当ショップ管理者までどうぞ。');

define('BOX_INFORMATION_HEADING', '個人情報保護およびセキュリティについて');
define('BOX_INFORMATION', '当店ではWebサーバ上の全ての保護されたページにおいて、お客様のWebブラウザで自動的にSSLセッションIDを有効にします。<br /><br />これにより、当ショップを訪れているのがお客様ご本人であることを確認しています。');
?>
