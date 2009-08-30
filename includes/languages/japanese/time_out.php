<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: time_out.php 3027 2006-02-13 17:15:51Z drbyte $
 */

define('NAVBAR_TITLE', 'タイムアウト');
define('HEADING_TITLE', '接続を切断させていただきました');
define('HEADING_TITLE_LOGGED_IN', '申し訳ありませんが動作を実行することができません。 ');
define('TEXT_INFORMATION', '<p>ご注文手続き中に一定時間が超過したため、セキュリティ上の理由から自動的にログアウトさせていただきました。</p>
<p>お客様のショッピングカートの内容は保存されていますので、お手続きが完了していない場合は再度ログインしてください。</p><p>手続きが完了したご注文内容をご覧になる場合' . (DOWNLOAD_ENABLED == 'true' ? '、またはダウンロード商品をダウンロードされる場合' : '') . 'は、<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">マイページ</a>からお入りください。</p>');

define('TEXT_INFORMATION_LOGGED_IN', 'ログインしているのでお買い物をお続けいただけます。メニューから行き先をお選び下さい。');

define('HEADING_RETURNING_CUSTOMER', 'ログイン');
define('TEXT_PASSWORD_FORGOTTEN', 'パスワードをお忘れですか?')
?>