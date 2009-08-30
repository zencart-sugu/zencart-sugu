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
// $Id: define_pages_editor.php 1969 2005-09-13 06:57:21Z drbyte $
//

define('HEADING_TITLE', '定番ページの編集: ');
define('NAVBAR_TITLE', '定番ページの編集');

define('TEXT_INFO_EDIT_PAGE', '編集するページを選択:');

define('TEXT_INFO_MAIN_PAGE', 'メインページ');

define('TEXT_INFO_SHIPPINGINFO', '配送・返品について');
define('TEXT_INFO_PRIVACY', '個人情報保護方針');
define('TEXT_INFO_CONDITIONS', 'サイトのご利用について');
define('TEXT_INFO_CONTACT_US', 'お問い合わせ');
define('TEXT_INFO_CHECKOUT_SUCCESS', 'チェックアウト完了');

define('TEXT_INFO_PAGE_2', 'Page 2');
define('TEXT_INFO_PAGE_3', 'Page 3');
define('TEXT_INFO_PAGE_4', 'Page 4');

define('TEXT_FILE_DOES_NOT_EXIST', 'ファイルが存在しません: %s');

define('ERROR_FILE_NOT_WRITEABLE', 'エラー: ファイルに書き込みができません。以下のファイルに正しい書き込み権限を設定してください。: %s');

define('TEXT_INFO_SELECT_FILE', '編集するファイルを選択');
define('TEXT_INFO_EDITING', 'ファイルを編集:');

define('TEXT_INFO_CAUTION','注意:テンプレートオーバーライドディレクトリにあるファイルを編集するようにしてください。例:  /languages/' . $_SESSION['language'] . '/html_includes/' . $template_dir . '<br />
ファイルを更新する前に必ずバックアップを取ってください');
?>