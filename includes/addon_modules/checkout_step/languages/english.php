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
define('MODULE_CHECKOUT_STEP_TITLE', '注文ステップ表示');
define('MODULE_CHECKOUT_STEP_DESCRIPTION', '注文ステップ表示<br />注文完了までステップを表示するブロックを追加します。<br />有効化後に<a href="' . zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module=addon_modules/blocks', 'NONSSL') . '">ブロックの設定</a>から表示設定をしてください。');
define('MODULE_CHECKOUT_STEP_STATUS_TITLE', '注文ステップ表示の有効化');
define('MODULE_CHECKOUT_STEP_STATUS_DESCRIPTION', '注文ステップ表示を有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_CHECKOUT_STEP_SORT_ORDER_TITLE', '優先順');
define('MODULE_CHECKOUT_STEP_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

// addon_moduleブロック管理用
define('MODULE_CHECKOUT_STEP_BLOCK_TITLE', 'Checkout Step');

// ブロック表示用
define('MODULE_CHECKOUT_STEP_BLOCK_CART', 'Check Cart');
define('MODULE_CHECKOUT_STEP_BLOCK_SHIPPING', 'Shipping Method');
define('MODULE_CHECKOUT_STEP_BLOCK_PAYMENT', 'Payment Method');
define('MODULE_CHECKOUT_STEP_BLOCK_CONFIRMATION', 'Confirmation');
define('MODULE_CHECKOUT_STEP_BLOCK_SUCCESS', 'Success - Thank You');
define('MODULE_CHECKOUT_STEP_BLOCK_LOGIN', 'Log In or Register');


?>
