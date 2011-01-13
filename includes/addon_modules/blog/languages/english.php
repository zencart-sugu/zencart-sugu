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
define('MODULE_BLOG_TITLE',                  'ブログ');
define('MODULE_BLOG_DESCRIPTION',            'ブログ');

define('MODULE_BLOG_STATUS_TITLE',           'ブログの有効化');
define('MODULE_BLOG_STATUS_DESCRIPTION',     'ブログを有効にしますか？ <br />true: 有効<br />false: 無効');

define('MODULE_BLOG_URL_TITLE',              'ブログURL');
define('MODULE_BLOG_URL_DESCRIPTION',        '取得対象のURLを http:// から入力してください(https未対応)');

define('MODULE_BLOG_TIMEOUT_TITLE',          'タイムアウト');
define('MODULE_BLOG_TIMEOUT_DESCRIPTION',    '取得リミット時間を設定します、ここで指定した時間以上に取得に時間がかかった場合は取得を中止します');

define('MODULE_BLOG_COUNT_TITLE',            '表示件数');
define('MODULE_BLOG_COUNT_DESCRIPTION',      '最大表示件数を設定します、0の場合はすべてとなります');

define('MODULE_BLOG_SORT_ORDER_TITLE',       '優先順');
define('MODULE_BLOG_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// addon_moduleブロック管理用
define('MODULE_BLOG_BLOCK_TITLE', 'Blog');

define('BOX_BLOG', 'Blog');
?>
