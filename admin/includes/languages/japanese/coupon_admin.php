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
//  $Id: coupon_admin.php 2457 2005-11-27 04:51:37Z ajeh $
//

define('TOP_BAR_TITLE', '統計');
define('HEADING_TITLE', 'クーポン券の管理');
define('HEADING_TITLE_STATUS', 'ステータス : ');
define('TEXT_CUSTOMER', '顧客:');
define('TEXT_COUPON', 'クーポン名:');
define('TEXT_COUPON_ALL', '全てのクーポン');
define('TEXT_COUPON_ACTIVE', '有効なクーポン券');
define('TEXT_COUPON_INACTIVE', '無効なクーポン券');
define('TEXT_SUBJECT', '件名:');
define('TEXT_UNLIMITED', '無制限');
define('TEXT_FROM', '差出人:');
define('TEXT_FREE_SHIPPING', '無料配送');
define('TEXT_MESSAGE', '本文:');
define('TEXT_RICH_TEXT_MESSAGE','本文(HTML形式):');
define('TEXT_SELECT_CUSTOMER', '顧客の選択');
define('TEXT_ALL_CUSTOMERS', '全ての顧客');
define('TEXT_NEWSLETTER_CUSTOMERS', '全てのメールマガジン購読者へ');
define('TEXT_CONFIRM_DELETE', 'このクーポン券を本当に削除しますか？');
define('TEXT_SEE_RESTRICT', '制限を適用する');

define('TEXT_COUPON_ANNOUNCE','ありがとうございます。クーポン券を提供いたします。');

define('TEXT_TO_REDEEM', '商品購入時にこのクーポンを使用することができます。支払情報を入力するときに下記のクーポンコードを指定してください。');
define('TEXT_IN_CASE', ' 問題が発生した場合 ');
define('TEXT_VOUCHER_IS', 'クーポン コード ');
define('TEXT_REMEMBER', 'クーポン コードをなくさないよう安全な場所に保存してください。');
define('TEXT_VISIT', 'Visit us at %s');
define('TEXT_ENTER_CODE', ' クーポンコードを入力してください。 ');

define('TABLE_HEADING_ACTION', '操作');

define('CUSTOMER_ID', '顧客 ID');
define('CUSTOMER_NAME', '顧客名');
define('REDEEM_DATE', '引き換え日付');
define('IP_ADDRESS', 'IP アドレス');

define('TEXT_REDEMPTIONS', '引き換え');
define('TEXT_REDEMPTIONS_TOTAL', '合計');
define('TEXT_REDEMPTIONS_CUSTOMER', '顧客');
define('TEXT_NO_FREE_SHIPPING', '無料配送しない');

define('NOTICE_EMAIL_SENT_TO', '注意: メールの送信先: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'エラー: 選択された顧客は存在しません。');
define('ERROR_NO_SUBJECT', 'エラー: 件名が入力されていません。');

define('COUPON_NAME', 'クーポン名');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'クーポン券の額');
define('COUPON_CODE', 'クーポン コード');
define('COUPON_STARTDATE', '開始日');
define('COUPON_FINISHDATE', '終了日');
define('COUPON_FREE_SHIP', '無料配送');
define('COUPON_DESC', 'クーポン券の説明 <br />(顧客は見ることができます。)');
define('COUPON_MIN_ORDER', 'クーポン券利用最低額');
define('COUPON_USES_COUPON', 'クーポン券ごとの利用数');
define('COUPON_USES_USER', '顧客ごとの利用数');
define('COUPON_PRODUCTS', '有効な商品のリスト');
define('COUPON_CATEGORIES', '有効なカテゴリのリスト');
define('VOUCHER_NUMBER_USED', '利用数');
define('DATE_CREATED', '作成日');
define('DATE_MODIFIED', '更新日');
define('TEXT_HEADING_NEW_COUPON', '新しいクーポン券を作成する');
define('TEXT_NEW_INTRO', '新しいクーポン情報を入力してください。<br />');

define('ERROR_NO_COUPON_AMOUNT', 'クーポン券の額が入力されていません。');
define('ERROR_NO_COUPON_NAME', 'クーポン名が入力されていません。 ');
define('ERROR_COUPON_EXISTS', 'このクーポン コードは既に存在します。');


define('COUPON_NAME_HELP', '作成するクーポン券の名称');
define('COUPON_AMOUNT_HELP', 'クーポン券を利用したときの引き換え額 「%」を最後につけた場合は割引率のパーセンテージ');
define('COUPON_CODE_HELP', 'クーポンコードを入力してください。空白の場合は自動で生成されます。');
define('COUPON_STARTDATE_HELP', 'クーポン券が有効になる日付');
define('COUPON_FINISHDATE_HELP', 'クーポン券の有効期限の日付');
define('COUPON_FREE_SHIP_HELP', 'クーポン券の効果を配送料を無料にする。<BR>ノート： これはクーポンの利用額に関係なく適用されますが、利用最低額は適用されます。');
define('COUPON_FREE_SHIP_ITEM_HELP', '<BR>また、商品金額に対しては適用されません。');
define('COUPON_DESC_HELP', '顧客向けの説明文');
define('COUPON_MIN_ORDER_HELP', 'クーポン券が有効な場合の最低利用額');
define('COUPON_USES_COUPON_HELP', 'クーポン券の最大利用回数。空白の場合は無制限になります。');
define('COUPON_USES_USER_HELP', 'クーポン券の最大利用回数。空白の場合は無制限になります。');
define('COUPON_PRODUCTS_HELP', 'クーポン券を利用できるproduct_idsのカンマで区切られたリスト。空白の場合は無制限');
define('COUPON_CATEGORIES_HELP', 'クーポン券を利用できるcpathsのリスト。空白の場合は無制限');
define('COUPON_BUTTON_PREVIEW', 'プレビュー');
define('COUPON_BUTTON_CONFIRM', '確定');
define('COUPON_BUTTON_BACK', '戻る');

define('COUPON_ACTIVE', 'ステータス');
define('COUPON_START_DATE', '利用開始日');
define('COUPON_EXPIRE_DATE', '有効期限');

define('ERROR_DISCOUNT_COUPON_WELCOME', 'Discount Coupon CANNOT be deactivated. This Discount Coupon is the Welcome Discount Coupon<br /><br />Change the Welcome Discount Coupon before trying to delete it.');
define('SUCCESS_COUPON_DISABLED', 'Success! Discount Coupon was set to Inactive ...');
define('TEXT_COUPON_NEW', 'コピーで新しく作成するクーポン券のクーポンコードを指定してください。');
define('ERROR_DISCOUNT_COUPON_DUPLICATE', '警告! 指定されたクーポンコードは既に存在します。コピー処理を取りやめました。');
define('TEXT_CONFIRM_COPY', 'このクーポン券をコピーして新しいクーポン券を作成しますか？作成する場合は[保存]ボタンを押してください。');
?>
