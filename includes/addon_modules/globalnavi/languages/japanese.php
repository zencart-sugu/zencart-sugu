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
define('MODULE_GLOBALNAVI_TITLE', 'グローバルナビ');
define('MODULE_GLOBALNAVI_DESCRIPTION', 'グローバルナビ<br />グローバルナビを表示するブロックを追加します。<br />有効化後に<a href="' . zen_href_link(FILENAME_BLOCKS) . '">ブロックの設定</a>から表示設定をしてください。');
define('MODULE_GLOBALNAVI_STATUS_TITLE', 'グローバルナビブロックの有効化');
define('MODULE_GLOBALNAVI_STATUS_DESCRIPTION', 'グローバルナビを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_GLOBALNAVI_SORT_ORDER_TITLE', '優先順');
define('MODULE_GLOBALNAVI_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// install用
define('MODULE_GLOBALNAVI_LIMIT_TITLE', '表示するカテゴリの上限');
define('MODULE_GLOBALNAVI_LIMIT_DESCRIPTION', 'グローバルナビに表示するカテゴリ数の上限を設定します');


// addon_moduleブロック管理用
define('MODULE_GLOBALNAVI_BLOCK_TITLE', 'グローバルナビ');

?>