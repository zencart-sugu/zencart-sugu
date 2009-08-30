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
//  $Id: newsletter.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('TEXT_COUNT_CUSTOMERS', 'このメールマガジンを受け取る顧客数: %s');
define('HEADING_TITLE', 'メールマガジン管理');

define('TABLE_HEADING_NEWSLETTERS', 'メールマガジン');
define('TABLE_HEADING_SIZE', 'サイズ');
define('TABLE_HEADING_MODULE', 'モジュール');
define('TABLE_HEADING_SENT', '送信済み');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_NEWSLETTER_MODULE', 'モジュール:');
define('TEXT_NEWSLETTER_TITLE', '件名:');
define('TEXT_NEWSLETTER_CONTENT', 'テキスト形式 <br />内容:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'HTML(リッチテキスト)形式 <br />内容:');

define('TEXT_NEWSLETTER_DATE_ADDED', '作成日:');
define('TEXT_NEWSLETTER_DATE_SENT', '送信日:');

define('TEXT_INFO_DELETE_INTRO', 'このメールマガジンを本当に削除しますか?');

define('TEXT_PLEASE_SELECT_AUDIENCE','このメールマガジンの購読者を選択してください: ');
define('TEXT_PLEASE_WAIT', 'お待ちください .. メールマガジン送信中です...<br /><br />この送信作業を中断しないでください!');
define('TEXT_FINISHED_SENDING_EMAILS', 'メールマガジンを送信しました!');

define('ERROR_NEWSLETTER_TITLE', 'エラー: メールマガジンの件名がありません');
define('ERROR_NEWSLETTER_MODULE', 'エラー: メールマガジンのモジュールが必要です');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'エラー: 削除する前にメールマガジンをロックしてください');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'エラー: 編集する前にメールマガジンをロックしてください');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'エラー: 送信する前にメールマガジンをロックしてください');
?>