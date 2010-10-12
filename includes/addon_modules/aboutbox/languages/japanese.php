<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009 Liquid System Technology, Inc.                    |
// | Author Koji Sasaki                                                   |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
// $Id: japanese.php $
//

  // 管理画面用
define('MODULE_ABOUTBOX_TITLE', 'アバウトボックス');
define('MODULE_ABOUTBOX_DESCRIPTION', 'アバウトボックスブロック<br />アバウトボックスを表示するブロックを追加します。<br />有効化後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">ブロックの設定</a>から表示設定をしてください。');
define('MODULE_ABOUTBOX_STATUS_TITLE', 'アバウトボックスブロックの有効化');
define('MODULE_ABOUTBOX_STATUS_DESCRIPTION', 'アバウトボックスを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_ABOUTBOX_SORT_ORDER_TITLE', '優先順');
define('MODULE_ABOUTBOX_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');
define('MODULE_ABOUTBOX_HEADER_TITLE', 'アバウトボックスのタイトル');
define('MODULE_ABOUTBOX_HEADER_DESCRIPTION', 'アバウトボックスブロックに表示するタイトルを指定します。');
define('MODULE_ABOUTBOX_GREETING_TITLE_TITLE', 'アバウトボックス説明文のタイトル');
define('MODULE_ABOUTBOX_GREETING_TITLE_DESCRIPTION', 'アバウトボックスに表示する説明文のタイトルを指定します。');
define('MODULE_ABOUTBOX_GREETING_TEXT_TITLE', 'アバウトボックス説明文の本文');
define('MODULE_ABOUTBOX_GREETING_TEXT_DESCRIPTION', 'アバウトボックスに表示する説明文の本文を指定します。');
define('MODULE_ABOUTBOX_IMAGEPATH_TITLE', 'アバウトボックスに表示する画像');
define('MODULE_ABOUTBOX_IMAGEPATH_DESCRIPTION', 'アバウトボックスに表示する画像のパスを指定します。');
define('MODULE_ABOUTBOX_DISPLAY_CALENDAR_TITLE', 'カレンダー表示');
define('MODULE_ABOUTBOX_DISPLAY_CALENDAR_DESCRIPTION', '営業カレンダーを表示するかどうか指定します。営業カレンダーモジュールがインストールされていないとtrueにしても表示されません。<br />true: 表示<br />false: 非表示');
define('MODULE_ABOUTBOX_AVALABLE_CARDS_TITLE', '対応クレジットカード表示');
define('MODULE_ABOUTBOX_AVAILABLE_CARDS_DESCRIPTION', '対応クレジットカードを表示するかどうか指定します<br />0: 非表示<br />1: テキスト表示<br />2: 画像表示');

// install用
define('MODULE_ABOUTBOX_GREETING_TITLE_DEFAULT', '店長からの挨拶');
define('MODULE_ABOUTBOX_GREETING_TEXT_DEFAULT', '店長の○○○です');

// template用
define('MODULE_ABOUTBOX_CREDITCARDS_TITLE', '利用可能な支払い方法');

// addon_moduleブロック管理用
define('MODULE_ABOUTBOX_BLOCK_TITLE', 'アバウトボックス');

define('BUTTON_IMAGE_FOOTER_MORE', 'button_footer_more.gif');
define('BUTTON_FOOTER_MORE_ALT', '詳しく見る');

define('BUTTON_IMAGE_FOOTER_PAYMENT', 'button_footer_payment.gif');
define('BUTTON_FOOTER_PAYMENT_ALT', 'お支払い方法');

// クレジットカード用
define('MODULE_ABOUTBOX_NETMOVE_CC_PATTERN', '/クレジットカード/');
?>