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
define('MODULE_POINT_CREATEACCOUNT_TITLE', '会員登録ポイント');
define('MODULE_POINT_CREATEACCOUNT_DESCRIPTION', '会員登録時にその会員にポイントをプレゼントします。');
define('MODULE_POINT_CREATEACCOUNT_STATUS_TITLE', '会員登録ポイント発行モジュールの有効化');
define('MODULE_POINT_CREATEACCOUNT_STATUS_DESCRIPTION', '会員登録ポイント発行モジュールを有効にしますか？<br />true: 有効<br />false: 無効');
define('MODULE_POINT_CREATEACCOUNT_PENDING_TITLE', '発行ポイントの保留');
define('MODULE_POINT_CREATEACCOUNT_PENDING_DESCRIPTION', 'ポイント発行時にそのポイントの使用を保留にしますか？<br />保留しない場合はポイント発行後すぐに使用できます。<br />true: 保留にする<br />false: 保留にしない（即時使用可能）');
define('MODULE_POINT_CREATEACCOUNT_POINT_TITLE', '会員登録ポイント数');
define('MODULE_POINT_CREATEACCOUNT_POINT_DESCRIPTION', '会員登録時にその会員へプレゼントするポイント数を設定します。<br />例: 500 (会員登録時に500ポイントプレゼント)');
define('MODULE_POINT_CREATEACCOUNT_SORT_ORDER_TITLE', '優先順');
define('MODULE_POINT_CREATEACCOUNT_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_POINT_CREATEACCOUNT_HISTORY_DESCRIPTION', '会員登録ポイント - 会員ID: %s');

define('BOX_CUSTOMERS_CUSTOMERS_POINTRATE', '顧客毎ポイント還元率設定');
