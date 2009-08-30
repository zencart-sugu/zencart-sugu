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
//  $Id: english.php 3020 2006-02-13 04:24:58Z ajeh $
//

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

mb_language('Japanese');
mb_internal_encoding("EUC-JP");
mb_http_output("EUC-JP");

// EMAIL config
define('EMAIL_CHARSET', 'ISO-2022-JP');
define('EMAIL_ENCODING', '7bit');
define('EMAIL_MIMEHEADER', 'B');
define('EMAIL_IS_MULTIBYTE', TRUE);

// added defines for header alt and text
define('HEADER_ALT_TEXT', 'Admin Powered by Zen Cart :: The Art of E-Commerce');
define('HEADER_LOGO_WIDTH', '200px');
define('HEADER_LOGO_HEIGHT', '70px');
define('HEADER_LOGO_IMAGE', 'logo.gif');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'ja_JP.euc-jp');
define('DATE_FORMAT_SHORT', '%Y/%m/%d');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%Y年%m月%d日(%a)'); // this is used for strftime()
define('DATE_FORMAT', 'Y/m/d'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'Y/m/d H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');
define('DATE_FORMAT_SPIFFYCAL', 'yyyy/MM/dd');  //Use only 'dd', 'MM' and 'yyyy' here in any order

////
// Return date in raw format
// $date should be in format yyyy/mm/dd
// raw date is in format YYYYMMDD, or DDMMYYYY
function zen_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 0, 4);
  } else {
    return substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
  }
}

// removed for meta tags
// page title
//define('TITLE', 'Zen Cart');

// include template specific meta tags defines
  if (file_exists(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');
//die(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// meta tags
define('ICON_METATAGS_ON', 'メタタグの定義します。');
define('ICON_METATAGS_OFF', 'メタタグを定義しません。');
define('TEXT_LEGEND_META_TAGS', 'メタタグの定義:');
define('TEXT_INFO_META_TAGS_USAGE', '<strong>注意:</strong> 「定義済みタグライン」は[meta_tags.php]ファイル内で定義されています。');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="ja"');

// charset for web pages and emails
define('CHARSET', 'EUC-JP');

// page title
define('TITLE', 'Zen Cart : 管理画面');


define('HEADER_TITLE_TOP', '管理者ホーム');
define('HEADER_TITLE_SUPPORT_SITE', 'Zen Cart.com');
define('HEADER_TITLE_SUPPORT_SITE_JP', 'Zen Cart.JP');
define('HEADER_TITLE_ONLINE_CATALOG', 'オンラインショップ');
define('HEADER_TITLE_VERSION', 'バージョン');
define('HEADER_TITLE_LOGOFF', 'ログオフ');
//define('HEADER_TITLE_ADMINISTRATION', 'Administration');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','ギフト券');
  define('TEXT_GV_NAMES','ギフト券');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','引き換えコード');

// text for gender
define('MALE', '男性');
define('FEMALE', '女性');

// text for date of birth example
define('DOB_FORMAT_STRING', 'yyyy/mm/dd');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', '一般設定');
define('BOX_CONFIGURATION_MYSTORE', 'マイストア');
define('BOX_CONFIGURATION_LOGGING', 'ロギング');
define('BOX_CONFIGURATION_CACHE', 'キャッシュ');

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'モジュール');
define('BOX_MODULES_PAYMENT', '支払い');
define('BOX_MODULES_SHIPPING', '配送');
define('BOX_MODULES_ORDER_TOTAL', '注文合計');
define('BOX_MODULES_PRODUCT_TYPES', '商品タイプ');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', '商品の管理');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'カテゴリ・商品の管理');
define('BOX_CATALOG_PRODUCT_TYPES', '商品タイプの管理');
define('BOX_CATALOG_CATEGORIES_OPTIONS_NAME_MANAGER', 'オプション名の管理');
define('BOX_CATALOG_CATEGORIES_OPTIONS_VALUES_MANAGER', 'オプション値の管理');
define('BOX_CATALOG_MANUFACTURERS', 'メーカーの管理');
define('BOX_CATALOG_REVIEWS', 'レビューの管理');
define('BOX_CATALOG_SPECIALS', '特価商品の管理');
define('BOX_CATALOG_PRODUCTS_EXPECTED', '入荷予定商品の管理');
define('BOX_CATALOG_SALEMAKER', 'セールの管理(SALE Maker)');
define('BOX_CATALOG_PRODUCTS_PRICE_MANAGER', '商品価格の管理');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', '顧客・注文の管理');
define('BOX_CUSTOMERS_CUSTOMERS', '顧客管理');
define('BOX_CUSTOMERS_ORDERS', '注文管理');
define('BOX_CUSTOMERS_GROUP_PRICING', '割引顧客グループの管理');
define('BOX_CUSTOMERS_PAYPAL', 'PayPal IPN');

// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', '地域・税率設定');
define('BOX_TAXES_COUNTRIES', '国名設定');
define('BOX_TAXES_ZONES', '地域設定');
define('BOX_TAXES_GEO_ZONES', '地域税設定');
define('BOX_TAXES_TAX_CLASSES', '税種別設定');
define('BOX_TAXES_TAX_RATES', '税率設定');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', '販促レポート');
define('BOX_REPORTS_PRODUCTS_VIEWED', '商品の閲覧回数ランキング');
define('BOX_REPORTS_PRODUCTS_PURCHASED', '商品の販売数ランキング');
define('BOX_REPORTS_ORDERS_TOTAL', '顧客別の売上ランキング');
define('BOX_REPORTS_PRODUCTS_LOWSTOCK', '在庫数の少ない商品ランキング');
define('BOX_REPORTS_CUSTOMERS_REFERRALS', '顧客紹介の状況');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', '追加設定・ツール');
define('BOX_TOOLS_ADMIN', '管理者の設定');
define('BOX_TOOLS_TEMPLATE_SELECT', 'テンプレートの設定');
define('BOX_TOOLS_BACKUP', 'DBバックアップ管理');
define('BOX_TOOLS_BANNER_MANAGER', 'バナーの管理');
define('BOX_TOOLS_CACHE', 'キャッシュコントロール');
define('BOX_TOOLS_DEFINE_LANGUAGE', '言語ファイル管理');
define('BOX_TOOLS_FILE_MANAGER', 'ファイル管理');
define('BOX_TOOLS_MAIL', 'メールの送信');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'メールマガジンの管理');
define('BOX_TOOLS_SERVER_INFO', 'サーバ情報のチェック');
define('BOX_TOOLS_WHOS_ONLINE', 'オンラインユーザのチェック');
define('BOX_TOOLS_STORE_MANAGER', 'ショップ管理者用ツール');
define('BOX_TOOLS_DEVELOPERS_TOOL_KIT', '開発者用ツール');
define('BOX_TOOLS_SQLPATCH','SQLパッチのインストール');
define('BOX_TOOLS_EZPAGES','EZ-Pages');

define('BOX_HEADING_EXTRAS', 'その他');

// define pages editor files
define('BOX_TOOLS_DEFINE_PAGES_EDITOR','定番ページの編集');
define('BOX_TOOLS_DEFINE_MAIN_PAGE', 'メインページ');
define('BOX_TOOLS_DEFINE_CONTACT_US','お問い合わせ');
define('BOX_TOOLS_DEFINE_PRIVACY','個人情報');
define('BOX_TOOLS_DEFINE_SHIPPINGINFO','配送と返品');
define('BOX_TOOLS_DEFINE_CONDITIONS','ご利用規約');
define('BOX_TOOLS_DEFINE_CHECKOUT_SUCCESS','ご注文完了');
define('BOX_TOOLS_DEFINE_PAGE_2','Page 2');
define('BOX_TOOLS_DEFINE_PAGE_3','Page 3');
define('BOX_TOOLS_DEFINE_PAGE_4','Page 4');


// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'ローカライズ');
define('BOX_LOCALIZATION_CURRENCIES', '通貨設定');
define('BOX_LOCALIZATION_LANGUAGES', '言語設定');
define('BOX_LOCALIZATION_ORDERS_STATUS', '注文ステータス設定');

// gift vouchers box text in includes/boxes/gv_admin.php
define('BOX_HEADING_GV_ADMIN', TEXT_GV_NAME . '・クーポン券');
define('BOX_GV_ADMIN_QUEUE', '承認待ち' . TEXT_GV_NAMES);
define('BOX_GV_ADMIN_MAIL', '' . TEXT_GV_NAME.'をメール送付');
define('BOX_GV_ADMIN_SENT', TEXT_GV_NAMES . 'の送付記録');
define('BOX_COUPON_ADMIN','クーポン券の管理');

define('IMAGE_RELEASE', 'Redeem ', '引き換え');

// javascript messages
define('JS_ERROR', 'エラー： フォームの内容にエラーがあります。!\n以下の内容を確認してください。\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* 新商品の価格が必要です。\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* 商品オプション属性の価格は±のいずれかが必要です。\n');

define('JS_PRODUCTS_NAME', '* 新商品名は必須です。\n');
define('JS_PRODUCTS_DESCRIPTION', '* 新商品の説明が入力されていません。\n');
define('JS_PRODUCTS_PRICE', '* 新商品の価格が入力されていません。\n');
define('JS_PRODUCTS_WEIGHT', '* 新商品の重量が入力されていません。\n');
define('JS_PRODUCTS_QUANTITY', '* 新商品の在庫数が入力されていません。\n');
define('JS_PRODUCTS_MODEL', '* 新商品の型番が入力されていません。\n');
define('JS_PRODUCTS_IMAGE', '* 新商品の画像が入力されていません。\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* この商品の新しい価格を設定してください。\n');

define('JS_GENDER', '* \'性別\'を選択してください。\n');
define('JS_FIRST_NAME', '* \'姓\'を入力してください。' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上\n');
define('JS_LAST_NAME', '* \'名\'を入力してください。' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上\n');
define('JS_FIRST_NAME_KANA', '* \'姓ふりがな\'を入力してください。' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上\n');
define('JS_LAST_NAME_KANA', '* \'名ふりがな\'を入力してください。' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上\n');
define('JS_DOB', '* \'生年月日\'を入力してください。フォーマット: xxxx/xx/xx (西暦/月/日).\n');
define('JS_EMAIL_ADDRESS', '* \'メールアドレス\'を入力してください。' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '文字以上\n');
define('JS_ADDRESS', '* \'住所\'を入力してください。 ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '文字以上\n');
define('JS_POST_CODE', '* \'郵便番号\'を入力してください。' . ENTRY_POSTCODE_MIN_LENGTH . '文字以上\n');
define('JS_CITY', '* \'市区町村\'を入力してください。' . ENTRY_CITY_MIN_LENGTH . '文字以上\n');
define('JS_STATE', '* \'都道府県\'を入力してください。\n');
define('JS_STATE_SELECT', '-- 選択してください --');
define('JS_ZONE', '* \'都道府県\'をリストから選択してください。');
define('JS_COUNTRY', '* \'国名\'を選択してください。\n');
define('JS_TELEPHONE', '* \'電話番号\'を入力してください。' . ENTRY_TELEPHONE_MIN_LENGTH . '文字以上.\n');
define('JS_PASSWORD', '* \'パスワード\' と \'パスワード確認\'が一致するように入力してください。' . ENTRY_PASSWORD_MIN_LENGTH . '文字以上\n');

define('JS_ORDER_DOES_NOT_EXIST', '注文番号%sは存在しません。');

define('CATEGORY_PERSONAL', '個人情報');
define('CATEGORY_ADDRESS', 'ご住所');
define('CATEGORY_CONTACT', 'ご連絡先');
define('CATEGORY_COMPANY', '会社名');
define('CATEGORY_OPTIONS', 'オプション');

define('ENTRY_GENDER', '性別:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">必須です</span>');
define('ENTRY_FIRST_NAME', '姓:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上</span>');
define('ENTRY_LAST_NAME', '名:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上</span>');
// ->furikana
define('ENTRY_FIRST_NAME_KANA', '姓ふりがな:');
define('ENTRY_FIRST_NAME_KANA_ERROR', '&nbsp;<span class="errorText">' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上</span>');
define('ENTRY_LAST_NAME_KANA', '名ふりがな:');
define('ENTRY_LAST_NAME_KANA_ERROR', '&nbsp;<span class="errorText">' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上</span>');
// <-furikana
define('ENTRY_DATE_OF_BIRTH', '生年月日:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(記入例: 1970/05/21)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail アドレス:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '文字以上</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">このメールアドレスは不正です。</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">このメールアドレスは既に登録されています。</span>');
define('ENTRY_COMPANY', '会社名:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_PRICING_GROUP', 'Discount Pricing Group');
define('ENTRY_STREET_ADDRESS', '住所1:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '文字以上</span>');
define('ENTRY_SUBURB', '住所2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', '郵便番号:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">' . ENTRY_POSTCODE_MIN_LENGTH . '文字以上</span>');
define('ENTRY_CITY', '市区町村:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">' . ENTRY_CITY_MIN_LENGTH . '文字以上</span>');
define('ENTRY_STATE', '都道府県:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">必須</span>');
define('ENTRY_COUNTRY', '国名:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', '電話番号:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">' . ENTRY_TELEPHONE_MIN_LENGTH . '文字以上</span>');
define('ENTRY_FAX_NUMBER', 'Fax番号:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'メールマガジン:');
define('ENTRY_NEWSLETTER_YES', '購読する');
define('ENTRY_NEWSLETTER_NO', '購読しない');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'メール送信');
define('IMAGE_BACK', '戻る');
define('IMAGE_BACKUP', 'バックアップ');
define('IMAGE_CANCEL', 'キャンセル');
define('IMAGE_CONFIRM', '確認');
define('IMAGE_COPY', 'コピー');
define('IMAGE_COPY_TO', 'コピー先');
define('IMAGE_DETAILS', '詳細');
define('IMAGE_DELETE', '削除');
define('IMAGE_EDIT', '編集');
define('IMAGE_EMAIL', 'E-Mail');
define('IMAGE_FILE_MANAGER', 'ファイル管理');
define('IMAGE_ICON_STATUS_GREEN', '有効');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', '有効にする');
define('IMAGE_ICON_STATUS_RED', '無効');
define('IMAGE_ICON_STATUS_RED_LIGHT', '無効にする');
define('IMAGE_ICON_INFO', '情報');
define('IMAGE_INSERT', '挿入');
define('IMAGE_LOCK', 'ロック');
define('IMAGE_MODULE_INSTALL', 'モジュールのインストール');
define('IMAGE_MODULE_REMOVE', 'モジュールのアンインストール');
define('IMAGE_MOVE', '移動');
define('IMAGE_NEW_BANNER', '新しいバナー');
define('IMAGE_NEW_CATEGORY', '新しいカテゴリ');
define('IMAGE_NEW_COUNTRY', '新しい国名');
define('IMAGE_NEW_CURRENCY', '新しい通貨');
define('IMAGE_NEW_FILE', '新しいファイル');
define('IMAGE_NEW_FOLDER', '新しいフォルダ');
define('IMAGE_NEW_LANGUAGE', '新しい言語');
define('IMAGE_NEW_NEWSLETTER', '新しいメールマガジン');
define('IMAGE_NEW_PRODUCT', '新しい商品');
define('IMAGE_NEW_SALE', '新しいセール');
define('IMAGE_NEW_TAX_CLASS', '新しい税種別');
define('IMAGE_NEW_TAX_RATE', '新しい税率');
define('IMAGE_NEW_TAX_ZONE', '新しい税地域');
define('IMAGE_NEW_ZONE', '新しい地域');
define('IMAGE_OPTION_NAMES', 'オプション名の管理');
define('IMAGE_OPTION_VALUES', 'オプション値の管理');
define('IMAGE_ORDERS', '注文');
define('IMAGE_ORDERS_INVOICE', '納品書');
define('IMAGE_ORDERS_PACKINGSLIP', '配送票');
define('IMAGE_PREVIEW', 'プレビュー');
define('IMAGE_RESTORE', '復元');
define('IMAGE_RESET', 'リセット');
define('IMAGE_SAVE', '保存');
define('IMAGE_SEARCH', '検索');
define('IMAGE_SELECT', '選択');
define('IMAGE_SEND', '送信');
define('IMAGE_SEND_EMAIL', 'メール送信');
define('IMAGE_UNLOCK', 'ロック解除');
define('IMAGE_UPDATE', '更新');
define('IMAGE_UPDATE_CURRENCIES', '為替レート更新');
define('IMAGE_UPLOAD', 'アップロード');
define('IMAGE_TAX_RATES','税率');
define('IMAGE_DEFINE_ZONES','地域設定');
define('IMAGE_PRODUCTS_PRICE_MANAGER', '商品価格の管理');
define('IMAGE_UPDATE_PRICE_CHANGES', '商品価格の更新');
define('IMAGE_ADD_BLANK_DISCOUNTS','Add ' . DISCOUNT_QTY_ADD . ' Blank Discount Qty');
define('IMAGE_CHECK_VERSION', 'zen-cartのアップデートをチェック');
define('IMAGE_PRODUCTS_TO_CATEGORIES', '複数カテゴリのリンク管理');

define('IMAGE_ICON_STATUS_ON', 'ステータス - オン');
define('IMAGE_ICON_STATUS_OFF', 'ステータス - オフ');
define('IMAGE_ICON_LINKED', 'Product is Linked');

define('IMAGE_REMOVE_SPECIAL','特別価格を削除する');
define('IMAGE_REMOVE_FEATURED','おすすめ商品情報を削除する');
define('IMAGE_INSTALL_SPECIAL', '特別価格の情報を設定する');
define('IMAGE_INSTALL_FEATURED', 'おすすめ商品情報を追加する');

define('ICON_PRODUCTS_PRICE_MANAGER','商品価格の管理');
define('ICON_COPY_TO', 'コピー先');
define('ICON_CROSS', '偽(False)');
define('ICON_CURRENT_FOLDER', '現在のフォルダ');
define('ICON_DELETE', '削除');
define('ICON_EDIT', '編集');
define('ICON_ERROR', 'エラー');
define('ICON_FILE', 'ファイル');
define('ICON_FILE_DOWNLOAD', 'ダウンロード');
define('ICON_FOLDER', 'フォルダ');
define('ICON_LOCKED', 'ロック');
define('ICON_MOVE', '移動');
define('ICON_PREVIOUS_LEVEL', '前のレベル');
define('ICON_PREVIEW', 'プレビュー');
define('ICON_RESET', 'リセット');
define('ICON_STATISTICS', '統計');
define('ICON_SUCCESS', '成功');
define('ICON_TICK', '真(True)');
define('ICON_UNLOCKED', 'ロック解除');
define('ICON_WARNING', '警告');

// constants for use in zen_prev_next_display function
define('TEXT_RESULT_PAGE', '%sページ (全%dページ)');
define('TEXT_DISPLAY_NUMBER_OF_ADMINS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_CATEGORIES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_PRICING_GROUPS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCT_TYPES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_SALES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_TEMPLATES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');


define('TEXT_DEFAULT', 'デフォルト');
define('TEXT_SET_DEFAULT', 'デフォルトに設定');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* 必須</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'エラー: デフォルトの通貨が設定されていません。「ローカライズ」->「通貨設定」から設定してください。');

define('TEXT_CACHE_CATEGORIES', 'カテゴリボックス');
define('TEXT_CACHE_MANUFACTURERS', 'メーカーボックス');
define('TEXT_CACHE_ALSO_PURCHASED', '関連の商品モジュール');

define('TEXT_NONE', '--なし--');
define('TEXT_TOP', 'トップ');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'エラー: 送り先が存在しません。%s');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'エラー: 送り先が書き込み不可になっています。%s');
define('ERROR_FILE_NOT_SAVED', 'エラー: アップロードしたファイルは保存されませんでした。');
define('ERROR_FILETYPE_NOT_ALLOWED', 'エラー: ファイルアップロードが許可されていません。%s');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', '成功: アップロードされたファイルが保存されました。%s');
define('WARNING_NO_FILE_UPLOADED', '警告: アップロードファイルが指定されていません。');
define('WARNING_FILE_UPLOADS_DISABLED', '警告: このPHPではファイルアップロードがサポートされていません。iniファイルを修正してください。');
define('ERROR_ADMIN_SECURITY_WARNING', '警告: 管理人のログインが安全ではありません ... まだ初期ログインの設定がされていません。: Admin アドミンは取り外されていないか、または変更されていません。<br />できるだけ早く、Shopのセキュリティのためにログインを変えるべきです。<br />ツールに行きます->ログインIDとパスワードを変える管理人設定。<br />管理人のための追加セキュリティに関しては、/docsを参照してください。');
define('WARNING_DATABASE_VERSION_OUT_OF_DATE','データベースのパッチレベルを上げる必要があります。 ツールを見てください->サーバ情報を参照のもと、パッチレベルを見直してください。');
define('WARN_DATABASE_VERSION_PROBLEM','true'); //データベースバージョンミスマッチに関する警告をオフにする設定にします。');
define('WARNING_ADMIN_DOWN_FOR_MAINTENANCE', '<strong>警告</strong> サイトは現在メンテナンス中のため閉鎖されています。<br />注意: メンテナンス時には、Paymentや送料のモジュールテストを行なうことはできません。');

define('_JANUARY', '1月');
define('_FEBRUARY', '2月');
define('_MARCH', '3月');
define('_APRIL', '4月');
define('_MAY', '5月');
define('_JUNE', '6月');
define('_JULY', '7月');
define('_AUGUST', '8月');
define('_SEPTEMBER', '9月');
define('_OCTOBER', '10月');
define('_NOVEMBER', '11月');
define('_DECEMBER', '12月');

define('TEXT_DISPLAY_NUMBER_OF_GIFT_VOUCHERS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');
define('TEXT_DISPLAY_NUMBER_OF_COUPONS', '<b>%d</b>から<b>%d</b>件を表示 (全<b>%d</b>件)');

define('TEXT_VALID_PRODUCTS_LIST', '商品リスト');
define('TEXT_VALID_PRODUCTS_ID', '商品ID');
define('TEXT_VALID_PRODUCTS_NAME', '商品名');
define('TEXT_VALID_PRODUCTS_MODEL', '商品型番');

define('TEXT_VALID_CATEGORIES_LIST', 'カテゴリリスト');
define('TEXT_VALID_CATEGORIES_ID', 'カテゴリID');
define('TEXT_VALID_CATEGORIES_NAME', 'カテゴリ名');

define('DEFINE_LANGUAGE','言語定義:');

define('BOX_ENTRY_COUNTER_DATE','カウント開始日:');
define('BOX_ENTRY_COUNTER','カウント:');

// not installed
define('NOT_INSTALLED_TEXT','インストールされていません');

// Product Options Values Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_VALUES','オプション値のソート順設定');

  define('TEXT_UPDATE_SORT_ORDERS_OPTIONS','<strong>オプション属性をオプション値でソートする</strong> ');
  define('TEXT_INFO_ATTRIBUTES_FEATURES_UPDATES','<strong>オプション属性の表示順を更新する</strong><br />デフォルトの表示順s:<br />');

// Product Options Name Sort Order - option_values.php
  define('BOX_CATALOG_PRODUCT_OPTIONS_NAME','オプション名のソート順設定');

// Attributes only
  define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_CONTROLLER','オプション属性の管理');

// generic model
  define('TEXT_MODEL','型番:');

// column controller
  define('BOX_TOOLS_LAYOUT_CONTROLLER','サイドボックスの表示設定');

// check GV release queue and alert store owner
  define('SHOW_GV_QUEUE',true);
  define('TEXT_SHOW_GV_QUEUE','%s 承認待ち ');
  define('IMAGE_GIFT_QUEUE', TEXT_GV_NAME . ' 処理待ち');
  define('IMAGE_ORDER','Order');

  define('BOX_TOOLS_EMAIL_WELCOME','ウェルカムメールのプレビュー');

  define('IMAGE_DISPLAY','表示');
  define('IMAGE_UPDATE_SORT','ソート順更新');
  define('IMAGE_EDIT_PRODUCT','商品編集');
  define('IMAGE_EDIT_ATTRIBUTES','商品オプション編集');
  define('TEXT_NEW_PRODUCT', 'カテゴリ中の商品: &quot;%s&quot;');
  define('IMAGE_OPTIONS_VALUES','オプション名とオプションの値');
  define('TEXT_PRODUCTS_PRICE_MANAGER','商品価格管理');
  define('TEXT_PRODUCT_EDIT','商品編集');
  define('TEXT_ATTRIBUTE_EDIT','商品オプション編集');
  define('TEXT_PRODUCT_DETAILS','詳細');

// sale maker
  define('DEDUCTION_TYPE_DROPDOWN_0', '値引き額');
  define('DEDUCTION_TYPE_DROPDOWN_1', '率（%）');
  define('DEDUCTION_TYPE_DROPDOWN_2', '新しい価格');

// Min and Units
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','最小:');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','単位:');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','カート:');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','追加:');

  define('TEXT_PRODUCTS_MIX_OFF','*オプション含まず');
  define('TEXT_PRODUCTS_MIX_ON','*オプション込み');

// search filters
  define('TEXT_INFO_SEARCH_DETAIL_FILTER','検索フィルタ: ');
  define('HEADING_TITLE_SEARCH_DETAIL','検索: ');

  define('PREV_NEXT_PRODUCT', '商品: ');
  define('TEXT_CATEGORIES_STATUS_INFO_OFF', '<span class="alert">*カテゴリは無効です</span>');
  define('TEXT_PRODUCTS_STATUS_INFO_OFF', '<span class="alert">*商品は無効です</span>');

// admin demo
  define('ADMIN_DEMO_ACTIVE','管理者デモが有効になっています。 いくつかの設定項目は操作できないようになっています。');
  define('ADMIN_DEMO_ACTIVE_EXCLUSION','管理者デモが有効になっています。 いくつかの設定項目は操作できないようになっています。 - <strong>注意: 管理者の再設定は可能です。</strong>');
  define('ERROR_ADMIN_DEMO','管理者デモが有効になっています。e ... 実行しようとした設定は無効になりました。');

// Version Check notices
  define('TEXT_VERSION_CHECK_NEW_VER','利用可能な新しいバージョン');
  define('TEXT_VERSION_CHECK_NEW_PATCH','利用可能な新しいパッチ');
  define('TEXT_VERSION_CHECK_PATCH','パッチ');
  define('TEXT_VERSION_CHECK_DOWNLOAD','パッチをダウンロードする');
  define('TEXT_VERSION_CHECK_CURRENT','Zen Cart&tradeのバージョン; とくに問題はありません。');

// downloads manager
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_DOWNLOADS_MANAGER', ' <b>%d</b>から<b>%d</b>を表示中(ダウンロード全<b>%d</b>件)');
define('BOX_CATALOG_CATEGORIES_ATTRIBUTES_DOWNLOADS_MANAGER', 'ダウンロード商品の管理');

define('BOX_CATALOG_FEATURED','おすすめ商品の管理');

define('ERROR_NOTHING_SELECTED', '何も選択されていません ... 変更されていません');
define('TEXT_STATUS_WARNING','<strong>注意:</strong> 日付を設定しておくと、ステータスが自動的にオン・オフになります。');

define('TEXT_LEGEND_LINKED', 'リンクされた商品');
define('TEXT_MASTER_CATEGORIES_ID','商品マスターカテゴリ:');
define('TEXT_LEGEND', '凡例: ');
define('TEXT_LEGEND_STATUS_OFF', 'ステータス - オン');
define('TEXT_LEGEND_STATUS_ON', 'ステータス - オフ');

define('TEXT_INFO_MASTER_CATEGORIES_ID', '<strong>注意: マスターカテゴリは、例えばセールなど商品カテゴリ毎に<br />価格設定をするような場合に使用します。</strong>');

define('TEXT_YES', 'Yes');
define('TEXT_NO', 'No');

// shipping error messages
define('ERROR_SHIPPING_CONFIGURATION', '<strong>配送設定エラー!</strong>');
define('ERROR_SHIPPING_ORIGIN_ZIP', '<strong>警告:</strong> 店舗の郵便番号が設定されていません');
define('ERROR_ORDER_WEIGHT_ZERO_STATUS', '<strong>警告:</strong> 配送料無料に重量0が設定されているので、配送料無料モジュールは無効です');
define('ERROR_USPS_STATUS', '<strong>警告:</strong> USPS is either missing the username and/or password, or ... it is set to TEST rather than PRODUCTION and will not work<br />If you still cannot retrieve quotes, contact USPS and activate your live account');

// text pricing
define('TEXT_CHARGES_WORD','料金計算結果:');
define('TEXT_PER_WORD','<br />語句単位料金: ');
define('TEXT_WORDS_FREE',' 語無料 ');
define('TEXT_CHARGES_LETTERS','料金計算結果:');
define('TEXT_PER_LETTER','<br />文字単位料金: ');
define('TEXT_LETTERS_FREE',' 文字無料 ');
define('TEXT_ONETIME_CHARGES','*ワンタイム料金 = ');
define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*ワンタイム料金 = ');
define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', '数量割引オプション');
define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','数量');
define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','価格');
define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', '数量割引、ワンタイム料金オプション');
define('TEXT_CATEGORIES_PRODUCTS', '商品カテゴリを選択してください');
define('TEXT_PRODUCT_TO_VIEW', '商品を選択し、表示ボタンを押してください。');

define('TEXT_INFO_SET_MASTER_CATEGORIES_ID', '無効のマスターカテゴリ ID');
define('TEXT_INFO_ID', ' ID# ');
define('TEXT_INFO_SET_MASTER_CATEGORIES_ID_WARNING', '<strong>警告:</strong> この商品は複数のカテゴリにリンクされますが、マスターカテゴリは全く設定されていません!');

define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT', '価格 問い合せ');
define('PRODUCTS_PRICE_IS_FREE_TEXT','価格無料');

define('TEXT_PRODUCT_WEIGHT_UNIT','lbs');

// min, max, units
define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING', '最大:');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','割引額:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% off');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;off');
// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','セール:&nbsp;');

// Rich Text / HTML resources
define('TEXT_HTML_EDITOR_NOT_DEFINED','HTMLエディタを設定していないかJavascriptをオフにしている場合は、直接HTMLテキストを入力してください。');
define('TEXT_WARNING_HTML_DISABLED','<span class = "main">注意: あなたはテキスト形式のメールを使っています。HTML形式のメールを送りたい場合は「メールオプション」でHTML形式メールを有効にするオプションを設定してください。</span>');
define('TEXT_WARNING_CANT_DISPLAY_HTML','<span class = "main">注意: あなたはテキスト形式のメールを使っています。HTML形式のメールを送りたい場合は、「メールオプション」でHTML形式メールを有効にするオプションを設定してください。</span>');
define('TEXT_EMAIL_CLIENT_CANT_DISPLAY_HTML',"このメールはHTMLフォーマットです。あなたがお使いのメールソフトでは適切に表示できないようです。");
define('ENTRY_EMAIL_PREFERENCE','メールフォーマット設定:');
define('ENTRY_EMAIL_FORMAT_COMMENTS','「全て拒否(none)」か「オプトアウト(購読者から外す)」を選ぶと、注文確認メールを含む全てのメールを受信しない状態になります。');
define('ENTRY_EMAIL_HTML_DISPLAY','HTML形式');
define('ENTRY_EMAIL_TEXT_DISPLAY','テキスト形式');
define('ENTRY_EMAIL_NONE_DISPLAY','全て拒否');
define('ENTRY_EMAIL_OPTOUT_DISPLAY','メールマガジン配信を拒否');
define('ENTRY_NOTHING_TO_SEND','メッセージの入力内容がありません。');
 define('EMAIL_SEND_FAILED','エラー: "%s"へのメール送信失敗 <%s> 対象で: "%s"');

// toggle on/off
  define('TEXT_HTML_AREA', 'htmlArea');
  define('TEXT_EDITOR_INFO', 'テキストエディタ');
  define('TEXT_CATEGORIES_PRODUCTS_SORT_ORDER_INFO', 'カテゴリ/商品 注文形式: ');
  define('TEXT_SORT_PRODUCTS_SORT_ORDER_PRODUCTS_NAME', '商品のソート順決定, 商品');
  define('TEXT_SORT_PRODUCTS_NAME', '商品');
  define('TEXT_SORT_PRODUCTS_MODEL', 'モデル');
  define('TEXT_SORT_PRODUCTS_QUANTITY', '注文数+, 商品');
  define('TEXT_SORT_PRODUCTS_QUANTITY_DESC', '注文数-, 商品');
  define('TEXT_SORT_PRODUCTS_PRICE', '価格+, 商品');
  define('TEXT_SORT_PRODUCTS_PRICE_DESC', '価格-, 商品');
  define('TEXT_SORT_CATEGORIES_SORT_ORDER_PRODUCTS_NAME', 'カテゴリのソート順決定, カテゴリ');
  define('TEXT_SORT_CATEGORIES_NAME', 'カテゴリ');



  define('TABLE_HEADING_YES','はい');
  define('TABLE_HEADING_NO','いいえ');
  define('TEXT_IMAGES_OVERWRITE', '既存のオプション画像を上書きしますか？<br/>上書きしたくない場合は[いいえ]を選択して、既存ファイルとは異なる名前のファイルを[オプション画像]に指定してください。');
  define('TEXT_IMAGE_OVERWRITE_WARNING','警告: 属性見本画像をアップロードしましたが、上書きできませんでした。 ');

  define('ERROR_DEFINE_OPTION_NAMES', '警告: オプションネームの定義がされていません。');
  define('ERROR_DEFINE_OPTION_VALUES', '警告: オプションヴァリューの定義がされていません。');
  define('ERROR_DEFINE_PRODUCTS', '警告: 商品の定義がされていません。');
  define('ERROR_DEFINE_PRODUCTS_MASTER_CATEGORIES_ID', '警告: マスターカテゴリのIDはこの商品に設定されていません。');

  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_ON','サブカテゴリを含めて加えます。');
  define('BUTTON_ADD_PRODUCT_TYPES_SUBCATEGORIES_OFF','サブカテゴリ以外で加えてください。');

  define('BUTTON_PREVIOUS_ALT','前の商品');
  define('BUTTON_NEXT_ALT','次の商品');

  define('BUTTON_PRODUCTS_TO_CATEGORIES', '複数のカテゴリがマネージャをリンクします。');
  define('BUTTON_PRODUCTS_TO_CATEGORIES_ALT', '複数のカテゴリへの商品をコピーします。');

  define('TEXT_INFO_OPTION_NAMES_VALUES_COPIER_STATUS', 'すべての商品をコピー, 追加と削除、 おすすめ商品のステータスは現在オフです。');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_ON', 'おすすめ商品の表示 - ON');
  define('TEXT_SHOW_OPTION_NAMES_VALUES_COPIER_OFF', 'おすすめ商品の表示 - OFF');

// moved from categories and all product type language files
  define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'エラー: 同じカテゴリで商品をリンクすることはできません。');
  define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'エラー: カタログイメージディレクトリの書き込みが可能ではありません。: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'エラー: カタログイメージディレクトリが存在していません。: ' . DIR_FS_CATALOG_IMAGES);
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'エラー: サブカテゴリにカテゴリを動かすことができません。');
  define('ERROR_CANNOT_MOVE_PRODUCT_TO_CATEGORY_SELF', 'エラー: 既に存在するところに同じカテゴリ、または、カテゴリの中への商品を移動することができません。');
  define('ERROR_CATEGORY_HAS_PRODUCTS', 'エラー: カテゴリに、商品があります!<br /><br />あなたのカテゴリを造るために一時これができますが… カテゴリはProductsかCategoriesのどちらかにもかかわらず、決して両方を保持するというわけではありません!');
  define('SUCCESS_CATEGORY_MOVED', '成功! カテゴリは正常に移動しました。');
  define('ERROR_CANNOT_MOVE_CATEGORY_TO_CATEGORY_SELF', 'エラー: 同じカテゴリにカテゴリを移動することはできません!
 ID#');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', '警告: EZ-PAGES HEADER - 管理人IPのみ有効になっています。');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', '警告: EZ-PAGES FOOTER - 管理人IPのみ有効になっています。');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', '警告: EZ-PAGES SIDEBOX - 管理人IPのみ有効になっています。');

// moved from product types
// warnings on Virtual and Always Free Shipping
  define('TEXT_VIRTUAL_PREVIEW','警告: この商品はマーク商品です。 - 送料無料、お届け先の住所をスキップします。<br />注文商品のすべてがデモ商品であるとき、送料は発生しません。');
  define('TEXT_VIRTUAL_EDIT','警告: この商品はマーク商品です。 - 送料無料、お届け先の住所をスキップします。<br />注文商品のすべてがデモ商品であるとき、送料は発生しません。');
  define('TEXT_FREE_SHIPPING_PREVIEW','警告: この商品はマーク商品です。 - 送料無料、お届け先の住所が必要です。<br />オーダーにおけるすべての商品が常に送料無料であるときに、送料無料用のモジュールが必要です。');
  define('TEXT_FREE_SHIPPING_EDIT','警告: はい、マーク商品です。 - 送料無料, お届け先の住所が必要です。<br />オーダーにおけるすべての商品が常に送料無料であるときに、送料無料用のモジュールが必要です。');

// admin activity log warnings
  define('WARNING_ADMIN_ACTIVITY_LOG_DATE', '警告: 管理人のログ記録は、設定を2ヵ月以上にすることをお勧めします。');
  define('WARNING_ADMIN_ACTIVITY_LOG_RECORDS', '警告: 管理人のログ記録は、設定を50,000以上にすることをお勧めします');
  define('RESET_ADMIN_ACTIVITY_LOG', '管理人のログ記録をリセットするため、管理人画面へ移動します。');

  define('CATEGORY_HAS_SUBCATEGORIES', '注意: カテゴリにサブカテゴリがあります。<br />商品を追加できません。');

  define('WARNING_REGISTER_GLOBALS_ON', 'ご使用中のサーバーはregister_globalsがOnで運用されています。<br/>register_globalsはセキュリティ上重大な問題を引き起こす可能性があるため、Zen Cartは、register_globalsの設定をOffにしなければ動作しません。<br/>Zen Cartのインストールディレクトリに.htaccessファイルが正しくアップロードされているのにこのメッセージが表示されている場合、ご使用中のサーバーでは.htaccessでregister_globalsの設定を変更できないことを意味しています。<br/>この問題を解決するためには、次のうち2つのどちらかの対応が必要です。<br/><br/><br/>1. サーバーの設定を変更する<br/>2. register_globalsがOffで運用可能なサーバーに再インストールする');

///////////////////////////////////////////////////////////
// include additional files:
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_EMAIL_EXTRAS);
  include(zen_get_file_directory(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/', FILENAME_OTHER_IMAGES_NAMES, 'false'));


?>
