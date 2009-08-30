<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @copyright Originally Programmed By: Christopher Bradley (www.wizardsandwars.com) for OsCommerce
 * @copyright Modified by Jim Keebaugh for OsCommerce
 * @copyright Adapted for Zen Cart
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: unsubscribe.php 3159 2006-03-11 01:35:04Z drbyte $
 */

define('NAVBAR_TITLE', '配信停止');
define('HEADING_TITLE', 'ニュースレター配信停止');

define('UNSUBSCRIBE_TEXT_INFORMATION', '<br />ニュースレターの配信停止をご希望とのこと、誠に残念です。お客様の個人情報の取り扱いについては、当店の<a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">個人情報保護方針</span></a>をご覧ください。<br /><br />ニュースレターの購読をされている方には新製品情報、割引情報などショップからのお知らせをお届けしております。<br /><br />配信停止をご希望でしたら下のボタンをクリックしてください。 ');
define('UNSUBSCRIBE_TEXT_NO_ADDRESS_GIVEN', '<br />ニュースレターの配信停止をご希望とのこと、誠に残念です。お客様の個人情報の取り扱いについては、当店の<a href="' . zen_href_link(FILENAME_PRIVACY,'','NONSSL') . '"><span class="pseudolink">個人情報保護方針</span></a>をご覧ください。<br /><br />ニュースレターの購読をされている方には新製品情報、割引情報などショップからのお知らせをお届けしております。<br /><br />配信停止をご希望でしたら下のボタンをクリックしてください。購読の設定ができるアカウント設定のページに飛びます。最初にログインする必要があるかもしれません。');
define('UNSUBSCRIBE_DONE_TEXT_INFORMATION', '<br />お客様のご要望により、以下のメールアドレスを配信リストから削除いたしました。<br /><br />');
define('UNSUBSCRIBE_ERROR_INFORMATION', '<br />以下のメールアドレスは当ショップのニュースレター配信リストにないか、あるいは既に配信停止の手続きが完了しています。 <br /><br />');
?>