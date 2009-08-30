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
//  $Id: admin.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE', '管理者の設定');

define('TABLE_HEADING_ADMINS_NAME', '管理者名');
define('TABLE_HEADING_ADMINS_ID', 'ID');
define('TABLE_HEADING_ADMINS_EMAIL', 'Email');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_ADMIN', '新規作成');
define('TEXT_HEADING_EDIT_ADMIN', '編集');
define('TEXT_HEADING_DELETE_ADMIN', '削除');
define('TEXT_HEADING_RESET_PASSWORD', 'パスワードリセット');

define('TEXT_ADMINS', 'Admins:');
define('TEXT_ADMINS_EMAIL', 'Email:');

define('TEXT_NEW_INTRO', '以下のフォームに新しい管理者用の情報を入力してください。');
define('TEXT_EDIT_INTRO', '必要な修正を行ってください。');

define('TEXT_ADMINS_NAME', '管理者名:');
define('TEXT_ADMINS_PASSWORD', 'パスワード:');
define('TEXT_ADMINS_CONFIRM_PASSWORD', 'パスワード(確認用):');

define('TEXT_DELETE_INTRO', '本当に削除しますか？');
define('TEXT_DELETE_IMAGE', '管理者画像を削除しますか？');


define('ENTRY_PASSWORD_NEW_ERROR', 'パスワードは' . ENTRY_PASSWORD_MIN_LENGTH . '文字以上です');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'パスワードと確認用のパスワードが一致していません。');

define('TEXT_ADMINS_LEVEL','管理者レベル:');
define('TEXT_ADMIN_LEVEL_INSTRUCTIONS','管理者レベルを1にすると管理者デモの有効/無効を選択することができます。レベル1の管理者はパスワードなどを変更することができます。');
define('TEXT_ADMIN_DEMO','デモ版として利用したい際に、管理者デモを利用すると管理者の管理権限をシステムが壊されない程度に制限することが出来ます。<br />また、管理者レベル1の管理者のみがデモ版が有効の場合にも管理者の全権限を持つことができます。<br />ですので、デモ用の管理者は管理者レベルを0にすることを忘れないでください。');
define('TEXT_DEMO_STATUS','管理者デモ:');
define('TEXT_DEMO_OFF','無効');
define('TEXT_DEMO_ON','有効');
?>