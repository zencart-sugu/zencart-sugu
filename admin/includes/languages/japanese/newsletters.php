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
//  $Id: newsletters.php 3020 2006-02-13 04:24:58Z ajeh $
//

define('HEADING_TITLE', 'メールマガジンの管理');

define('TABLE_HEADING_NEWSLETTERS', 'メールマガジン');
define('TABLE_HEADING_SIZE', 'サイズ');
define('TABLE_HEADING_MODULE', '種類');
define('TABLE_HEADING_SENT', '送信状態');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_NEWSLETTER_MODULE', '種類の選択:');
define('TEXT_NEWSLETTER_TITLE', 'メールマガジンの件名:');
define('TEXT_NEWSLETTER_CONTENT', 'テキスト形式 <br />内容:');
define('TEXT_NEWSLETTER_CONTENT_HTML', 'HTML(リッチテキスト)形式 <br />内容:');

define('TEXT_NEWSLETTER_DATE_ADDED', '登録日:');
define('TEXT_NEWSLETTER_DATE_SENT', '送信日:');

define('TEXT_INFO_DELETE_INTRO', 'このメールマガジンを本当に削除しますか？');

define('TEXT_PLEASE_WAIT', 'しばらくお待ちください。メールを送信しています.....<br /><br />この処理を中断しないでください!');
define('TEXT_FINISHED_SENDING_EMAILS', 'メール送信を終了しました!');

define('TEXT_AFTER_EMAIL_INSTRUCTIONS','%s件の emailが処理中です。 <br /><br /><UL><LI>a)バウンスされたメール</LI><LI>b) 無効になっているメールアドレス</LI><LI>c) 受け取り拒否の依頼</LI></UL>、あなたのメールボックスを確認してください ('.EMAIL_FROM.') メールの削除は管理画面/顧客メニューの顧客の記録を編集することで可能になります');

define('ERROR_NEWSLETTER_TITLE', 'エラー: メールマガジンの件名が必要です。');
define('ERROR_NEWSLETTER_MODULE', 'エラー: 種類でメールマガジンを選択してください。');
define('ERROR_PLEASE_SELECT_AUDIENCE','エラー: 今回のニュースレターを受け取る顧客群を選択してください');
define('ERROR_REMOVE_UNLOCKED_NEWSLETTER', 'エラー: 削除するにはメールマガジンのロックが必要です。');
define('ERROR_EDIT_UNLOCKED_NEWSLETTER', 'エラー: 編集するにはメールマガジンのロックが必要です。');
define('ERROR_SEND_UNLOCKED_NEWSLETTER', 'エラー: 送信するにはメールマガジンのロックが必要です。');
?>
