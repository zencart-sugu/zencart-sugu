<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: english.php 3260 2006-03-26 00:18:01Z drbyte $
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'Zen Cart!');
//define('SITE_TAGLINE', 'The Art of E-commerce');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

  define('FOOTER_TEXT_BODY', 'Copyright &copy; 2003-2006 <a href="http://www.zen-cart.com" target="_blank">Zen Cart</a> Powered by <a href="http://www.zen-cart.com" target="_blank">zen-cart.com</a> / <a href="http://www.zen-cart.jp" target="_blank">zen-cart.jp</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
  @setlocale(LC_TIME, 'ja_JP.EUC-JP');
mb_language('Japanese');
mb_internal_encoding("EUC-JP");
mb_http_output("EUC-JP");

// if mbstring is not load, use mb-emulator 

  define('DATE_FORMAT_SHORT', '%Y/%m/%d');  // this is used for strftime()
  define('DATE_FORMAT_LONG', '%Y年%m月%d日(%a)'); // this is used for strftime()
  define('DATE_FORMAT', 'Y/m/d'); // this is used for date()
  define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// EMAIL config
  define('EMAIL_CHARSET', 'ISO-2022-JP');
  define('EMAIL_ENCODING', '7bit');
  define('EMAIL_MIMEHEADER', 'B');
  define('EMAIL_IS_MULTIBYTE', TRUE);

////
// Return date in raw format mm/dd/yyyy
// $date should be in format yyyy/mm/dd -- Change for Japanese date format
// raw date is in format YYYYMMDD, or DDMMYYYY
  if (!function_exists('zen_date_raw')) {
    function zen_date_raw($date, $reverse = false) {
      if ($reverse) {
    return substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 0, 4);
      } else {
    return substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
      }
    }
  }

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
  define('LANGUAGE_CURRENCY', 'JPY');

// Global entries for the <html> tag
  define('HTML_PARAMS','dir="ltr" lang="ja"');

// charset for web pages and emails
  define('CHARSET', 'EUC-JP');

// footer text in includes/footer.php
  define('FOOTER_TEXT_REQUESTS_SINCE', 'requests since');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','ギフト券');
  define('TEXT_GV_NAMES','ギフト券');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','引き換えコード');

// text for gender
  define('MALE', '男性');
  define('FEMALE', '女性');
  define('MALE_ADDRESS', '男性');
  define('FEMALE_ADDRESS', '女性');

// text for date of birth example
  define('DOB_FORMAT_STRING', 'yyyy/mm/dd');

//text for sidebox heading links
  define('BOX_HEADING_LINKS', '&nbsp;&nbsp;[more]');

// categories box text in sideboxes/categories.php
  define('BOX_HEADING_CATEGORIES', 'カテゴリ');

// manufacturers box text in sideboxes/manufacturers.php
  define('BOX_HEADING_MANUFACTURERS', 'メーカー');

// whats_new box text in sideboxes/whats_new.php
  define('BOX_HEADING_WHATS_NEW', '新着商品');
  define('CATEGORIES_BOX_HEADING_WHATS_NEW', '新着商品...');

  define('BOX_HEADING_FEATURED_PRODUCTS', 'おすすめ');
  define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', 'おすすめ商品...');
  define('TEXT_NO_FEATURED_PRODUCTS', 'おすすめ商品はまもなく登録されますので、また後ほどご覧ください。');

  define('TEXT_NO_ALL_PRODUCTS', '商品はまもなく登録されますので、また後ほどご覧ください。');
  define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', '全商品...');

// quick_find box text in sideboxes/quick_find.php
  define('BOX_HEADING_SEARCH', '商品検索');
  define('BOX_SEARCH_ADVANCED_SEARCH', '詳細検索');

// specials box text in sideboxes/specials.php
  define('BOX_HEADING_SPECIALS', '特価商品');
  define('CATEGORIES_BOX_HEADING_SPECIALS','特価商品 ...');

// reviews box text in sideboxes/reviews.php
  define('BOX_HEADING_REVIEWS', 'レビュー');
  define('BOX_REVIEWS_WRITE_REVIEW', 'この商品のレビューを書く');
  define('BOX_REVIEWS_NO_REVIEWS', '商品のレビューはまだありません。');
  define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s点 / 5点満点');

// shopping_cart box text in sideboxes/shopping_cart.php
  define('BOX_HEADING_SHOPPING_CART', 'ショッピングカート');
  define('BOX_SHOPPING_CART_EMPTY', 'カートは空です');
  define('BOX_SHOPPING_CART_DIVIDER', '&nbsp;x&nbsp;');

// order_history box text in sideboxes/order_history.php
  define('BOX_HEADING_CUSTOMER_ORDERS', '最近のご注文');

// best_sellers box text in sideboxes/best_sellers.php
  define('BOX_HEADING_BESTSELLERS', 'ベストセラー');
  define('BOX_HEADING_BESTSELLERS_IN', 'ベストセラー<br />&nbsp;&nbsp;');

// notifications box text in sideboxes/products_notifications.php
  define('BOX_HEADING_NOTIFICATIONS', 'お知らせメール');
  define('BOX_NOTIFICATIONS_NOTIFY', '<strong>%s</strong>についてのお知らせメールを受け取る');
  define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', '<strong>%s</strong>についてのお知らせメールを受け取らない');

// manufacturer box text
  define('BOX_HEADING_MANUFACTURER_INFO', '商品情報');
  define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Webサイト');
  define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', '他の商品');

// languages box text in sideboxes/languages.php
  define('BOX_HEADING_LANGUAGES', '言語');

// currencies box text in sideboxes/currencies.php
  define('BOX_HEADING_CURRENCIES', '通貨');

// information box text in sideboxes/information.php
  define('BOX_HEADING_INFORMATION', 'インフォメーション');
  define('BOX_INFORMATION_PRIVACY', '個人情報保護方針');
  define('BOX_INFORMATION_CONDITIONS', 'ご利用規約');
  define('BOX_INFORMATION_SHIPPING', '配送と返品について');
  define('BOX_INFORMATION_CONTACT', 'お問い合わせ');
  define('BOX_BBINDEX', 'フォーラム');
  define('BOX_INFORMATION_UNSUBSCRIBE', 'ニュースレター登録解除');

  define('BOX_INFORMATION_SITE_MAP', 'サイトマップ');

// information box text in sideboxes/more_information.php - were TUTORIAL_
  define('BOX_HEADING_MORE_INFORMATION', '追加情報');
  define('BOX_INFORMATION_PAGE_2', 'ページ2');
  define('BOX_INFORMATION_PAGE_3', 'ページ3');
  define('BOX_INFORMATION_PAGE_4', 'ページ4');

// tell a friend box text in sideboxes/tell_a_friend.php
  define('BOX_HEADING_TELL_A_FRIEND', '友達に知らせる');
  define('BOX_TELL_A_FRIEND_TEXT', 'この商品を友達に知らせる');

// wishlist box text in includes/boxes/wishlist.php
  define('BOX_HEADING_CUSTOMER_WISHLIST', 'ウィッシュリスト');
  define('BOX_WISHLIST_EMPTY', 'ウィッシュリストに何も登録されていません');
  define('IMAGE_BUTTON_ADD_WISHLIST', 'ウィッシュリストに加える');
  define('TEXT_WISHLIST_COUNT', '現在ウィッシュリストに商品が %s 点登録されています。');
  define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', '<strong>%d</strong>から <strong>%d</strong>までを表示しています (ウィッシュリストの数:<strong>%d</strong>)');

//New billing address text
  define('SET_AS_PRIMARY' , '標準の配送先として設定');
  define('NEW_ADDRESS_TITLE', '請求先住所');

// javascript messages
  define('JS_ERROR', 'フォームの処理中にエラーが発生しました。\n\n次の項目を訂正してください:\n\n');

  define('JS_REVIEW_TEXT', '* レビューの文章が短すぎます。最低' . REVIEW_TEXT_MIN_LENGTH . '文字以上入力してください。');
  define('JS_REVIEW_RATING', '* 商品の評価を選択してください。');

  define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* お支払い方法を選択してください。');

  define('JS_ERROR_SUBMITTED', '入力フォームは既に送信されています。OK ボタンをクリックして処理が完了するまでお待ちください。');

  define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'お支払い方法を選択してください。');
  define('ERROR_CONDITIONS_NOT_ACCEPTED', 'ご利用規約に同意される場合はチェックボックスをクリックしてください。');
  define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', '個人情報保護方針に同意される場合はチェックボックスをクリックしてください。');

  define('CATEGORY_COMPANY', '会社名（会社でご利用の場合）');
  define('CATEGORY_PERSONAL', '個人情報');
  define('CATEGORY_ADDRESS', '住所');
  define('CATEGORY_CONTACT', '連絡先');
  define('CATEGORY_OPTIONS', 'オプション');
  define('CATEGORY_PASSWORD', 'パスワード');
  define('CATEGORY_LOGIN', 'ログイン');
  define('PULL_DOWN_DEFAULT', '国名を選択してください');

  define('ENTRY_COMPANY', '会社名・部署:');
  define('ENTRY_COMPANY_ERROR', '');
  define('ENTRY_COMPANY_TEXT', '');
  define('ENTRY_GENDER', '性別:');
  define('ENTRY_GENDER_ERROR', '性別を選択してください');
  define('ENTRY_GENDER_TEXT', '*');
  define('ENTRY_FIRST_NAME', '姓:');
  define('ENTRY_FIRST_NAME_ERROR', '姓は最低' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_FIRST_NAME_TEXT', '*');
  define('ENTRY_LAST_NAME', '名:');
  define('ENTRY_LAST_NAME_ERROR', '名は最低' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_LAST_NAME_TEXT', '*');
  // ->furikana
  define('ENTRY_FIRST_NAME_KANA', '姓ふりがな:');
  define('ENTRY_FIRST_NAME_KANA_ERROR', '姓ふりがなは最低' . ENTRY_FIRST_NAME_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_FIRST_NAME_KANA_TEXT', '*');
  define('ENTRY_LAST_NAME_KANA', '名ふりがな:');
  define('ENTRY_LAST_NAME_KANA_ERROR', '名ふりがなは最低' . ENTRY_LAST_NAME_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_LAST_NAME_KANA_TEXT', '*');
  // <-furikana
  define('ENTRY_DATE_OF_BIRTH', '誕生日:');
  define('ENTRY_DATE_OF_BIRTH_ERROR', '誕生日は[1970/05/21](西暦/月/日)の書式で入力してください。');
  define('ENTRY_DATE_OF_BIRTH_TEXT', '* (記入例 1970/05/21)');
  define('ENTRY_EMAIL_ADDRESS', 'Eメールアドレス:');
  define('ENTRY_EMAIL_ADDRESS_ERROR', 'Eメールアドレスは半角で' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'メールアドレスが正しく入力されていないようです。');
  define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'このメールアドレスはすでに登録されています。このメールアドレスでログインされるか、違うアドレスでアカウントを登録してください。');
  define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
  define('ENTRY_NICK', 'フォーラムニックネーム:');
  define('ENTRY_NICK_TEXT', ''); // note to display beside nickname input field
  define('ENTRY_NICK_DUPLICATE_ERROR', 'このニックネームはすでに使われています');
  define('ENTRY_NICK_LENGTH_ERROR', 'ニックネームは最低' . ENTRY_NICK_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_STREET_ADDRESS', '番地 マンション・アパート名:');
  define('ENTRY_STREET_ADDRESS_ERROR', '番地 マンション・アパート名は最低' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_STREET_ADDRESS_TEXT', '*');
  define('ENTRY_SUBURB', '住所2:');
  define('ENTRY_SUBURB_ERROR', '');
  define('ENTRY_SUBURB_TEXT', '');
  define('ENTRY_POST_CODE', '郵便番号:');
  define('ENTRY_POST_CODE_ERROR', '郵便番号は最低' . ENTRY_POSTCODE_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_POST_CODE_TEXT', '*');
  define('ENTRY_CITY', '市町村区:');
  define('ENTRY_CUSTOMERS_REFERRAL', '照会コード:');

  define('ENTRY_CITY_ERROR', '市町村区名は最低' . ENTRY_CITY_MIN_LENGTH . ' 文字以上入力してください');
  define('ENTRY_CITY_TEXT', '*');
  define('ENTRY_STATE', '都道府県:');
  define('ENTRY_STATE_ERROR', '都道府県名は最低' . ENTRY_STATE_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_STATE_ERROR_SELECT', 'プルダウンメニューから都道府県を選択してください');
  define('ENTRY_STATE_TEXT', '*');
  define('ENTRY_COUNTRY', '国名:');
  define('ENTRY_COUNTRY_ERROR', 'プルダウンメニューから国名を選択してください');
  define('ENTRY_COUNTRY_TEXT', '*');
  define('ENTRY_TELEPHONE_NUMBER', '電話番号:');
  define('ENTRY_TELEPHONE_NUMBER_ERROR', '電話番号は最低' . ENTRY_TELEPHONE_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
  define('ENTRY_FAX_NUMBER', 'ファックス番号:');
  define('ENTRY_FAX_NUMBER_ERROR', '');
  define('ENTRY_FAX_NUMBER_TEXT', '');
  define('ENTRY_NEWSLETTER', 'ニュースレターを購読する');
  define('ENTRY_NEWSLETTER_TEXT', '');
  define('ENTRY_NEWSLETTER_YES', '購読');
  define('ENTRY_NEWSLETTER_NO', '購読解除');
  define('ENTRY_NEWSLETTER_ERROR', '');
  define('ENTRY_PASSWORD', 'パスワード:');
  define('ENTRY_PASSWORD_ERROR', 'パスワードは最低' . ENTRY_PASSWORD_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'パスワードの確認欄は同じパスワードを再入力してください');
  define('ENTRY_PASSWORD_TEXT', '* (半角英数字で最低' . ENTRY_PASSWORD_MIN_LENGTH . '文字以上)');
  define('ENTRY_PASSWORD_CONFIRMATION', 'パスワードの確認:');
  define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT', '現在のパスワード:');
  define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT_ERROR', 'パスワードは半角英数字で最低' . ENTRY_PASSWORD_MIN_LENGTH . ' 文字以上入力してください');
  define('ENTRY_PASSWORD_NEW', '新しいパスワード:');
  define('ENTRY_PASSWORD_NEW_TEXT', '*');
  define('ENTRY_PASSWORD_NEW_ERROR', '新しいパスワードは半角英数字で' . ENTRY_PASSWORD_MIN_LENGTH . '文字以上入力してください');
  define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'パスワードの確認欄は新しいパスワードを再入力してください');
  define('PASSWORD_HIDDEN', '--表示されません--');

  define('FORM_REQUIRED_INFORMATION', '* 必須項目');
  define('ENTRY_REQUIRED_SYMBOL', '*');

  // constants for use in zen_prev_next_display function
  define('TEXT_RESULT_PAGE', '');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '<strong>%d</strong>から<strong>%d</strong> を表示中 (商品の数: <strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '<strong>%d</strong>から<strong>%d</strong> を表示中 (ご注文数: <strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '<strong>%d</strong>から<strong>%d</strong> を表示中 (レビュー数: <strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', '<strong>%d</strong>から<strong>%d</strong> を表示中 (新着商品の数: <strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '<strong>%d</strong>から<strong>%d</strong> を表示中 (特価商品の数: <strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', '<strong>%d</strong>から<strong>%d</strong>を表示中 (おすすめ商品の数:<strong>%d</strong>)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', '<strong>%d</strong>から<strong>%d</strong>を表示中 (全商品の数:<strong>%d</strong>)');

define('PREVNEXT_TITLE_FIRST_PAGE', '最初のページ');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', '前のページ');
define('PREVNEXT_TITLE_NEXT_PAGE', '次のページ');
define('PREVNEXT_TITLE_LAST_PAGE', '最後のページ');
define('PREVNEXT_TITLE_PAGE_NO', '%dページ');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', '前の%dページ');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', '次の%dページ');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;最初');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;前へ]');
define('PREVNEXT_BUTTON_NEXT', '[次へ&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', '最後&gt;&gt;');

define('TEXT_BASE_PRICE','ベース価格: ');

define('TEXT_CLICK_TO_ENLARGE', '拡大表示');

  define('TEXT_SORT_PRODUCTS', '商品の並べ替え ');
  define('TEXT_DESCENDINGLY', '降順');
  define('TEXT_ASCENDINGLY', '昇順');
  define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', '投稿: %s様');
define('TEXT_REVIEW_WORD_COUNT', '%s語');
define('TEXT_REVIEW_RATING', '評価: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', '登録日: %s');
define('TEXT_NO_REVIEWS', '商品のレビューはまだありません。');

  define('TEXT_NO_NEW_PRODUCTS', '新着商品はまもなく登録されますので、また後ほどご覧ください。');

  define('TEXT_UNKNOWN_TAX_RATE', '税率不明');

  define('TEXT_REQUIRED', '<span class="errorText">必須</span>');

  define('TEXT_TIME_SPECIFY','お届け時間帯');

  define('WARNING_REGISTER_GLOBALS_ON', 'ご使用中のサーバーはregister_globalsがOnで運用されています。<br/>register_globalsはセキュリティ上重大な問題を引き起こす可能性があるため、Zen Cartは、register_globalsの設定をOffにしなければ動作しません。<br/>Zen Cartのインストールディレクトリに.htaccessファイルが正しくアップロードされているのにこのメッセージが表示されている場合、ご使用中のサーバーでは.htaccessでregister_globalsの設定を変更できないことを意味しています。<br/>この問題を解決するためには、次のうち2つのどちらかの対応が必要です。<br/><br/><br/>1. サーバーの設定を変更する<br/>2. register_globalsがOffで運用可能なサーバーに再インストールする');
  $warn_path = (isset($_SERVER['SCRIPT_FILENAME']) ? @dirname($_SERVER['SCRIPT_FILENAME']) : '.....');
  define('WARNING_INSTALL_DIRECTORY_EXISTS', '警告: インストールディレクトリがそのまま残っています : ' . $warn_path . '/zc_install. セキュリティ上危険なのでこのディレクトリを削除してください。');
  define('WARNING_CONFIG_FILE_WRITEABLE', '警告: 設定ファイルが書き込み可能になっています : ' . $warn_path . '/includes/configure.php. セキュリティ上危険なので、このファイルに正しいユーザー権限を設定して下さい。');
  unset($warn_path);
  define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', '警告: セッション保存ディレクトリが存在しません : ' . zen_session_save_path() . '. このディレクトリが作られるまでセッション機能は動作しません。');
  define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', '警告: セッション保存ディレクトリに書き込みできません: ' . zen_session_save_path() . '. 正しいアクセス権が設定されるまでセッション機能は動作しません。');
  define('WARNING_SESSION_AUTO_START', '警告: session.auto_start が有効になっています - このphp機能をphp.iniで無効にし、Webサーバを再起動してください。');
  define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', '警告: ダウンロード商品ディレクトリが存在しません: ' . DIR_FS_DOWNLOAD . '. このディレクトリが有効になるまでダウンロード商品機能は動作しません。');
  define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', '警告: SQLキャッシュディレクトリが存在しません: ' . DIR_FS_SQL_CACHE . '. このディレクトリが作られるまでSQLキャッシュ機能は動作しません。');
  define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', '警告: SQLキャッシュディレクトリに書き込みできません: ' . DIR_FS_SQL_CACHE . '. 正しいアクセス権が設定されるまでSQLキャッシュ機能は動作しません。');
  define('WARNING_DATABASE_VERSION_OUT_OF_DATE', 'お使いのデータベースのPatch Levelを上げる必要があるようです。管理画面->追加設定・ツール->サーバー情報のチェック でpatch levelを確認してください。');


  define('TEXT_CCVAL_ERROR_INVALID_DATE', '入力されたクレジットカードの有効期限は無効です。ご確認の上もう一度入力してください。');
  define('TEXT_CCVAL_ERROR_INVALID_NUMBER', '入力されたクレジットカードのカード番号は無効です。ご確認の上もう一度入力してください。');
  define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'カード番号の最初の４桁: %s が間違いでなければ、当ショップではこのカードのお取り扱いができません。番号が間違っているようでしたらもう一度入力してください。');

  define('BOX_INFORMATION_DISCOUNT_COUPONS', '割引クーポン');
  define('BOX_INFORMATION_GV', TEXT_GV_NAME . ' よくある質問');
  define('VOUCHER_BALANCE', TEXT_GV_NAME . ' 残高 ');
  define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . 'アカウント');
  define('GV_FAQ', TEXT_GV_NAME . ' よくある質問');
  define('ERROR_REDEEMED_AMOUNT', '引き換えに成功しました');
  define('ERROR_NO_REDEEM_CODE', '' . TEXT_GV_REDEEM . 'が入力されていません。');
  define('ERROR_NO_INVALID_REDEEM_GV', '無効な' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . 'です');
  define('TABLE_HEADING_CREDIT', 'ご利用可能なクレジットカード');
define('GV_HAS_VOUCHERA', 'お客様の' . TEXT_GV_NAME . 'アカウントに残高があります。ご希望でしたら <br />

                           この残高を送る <a class="pageResults" href="');
define('GV_HAS_VOUCHERB', '"><strong>Eメール</strong></a>を送る');
define('ENTRY_AMOUNT_CHECK_ERROR', 'この金額を送るには残高が不足しています');
define('BOX_SEND_TO_FRIEND', ' ' . TEXT_GV_NAME . 'を贈る');

  define('VOUCHER_REDEEMED',  TEXT_GV_NAME . 'を引き換えました。');
  define('CART_COUPON', 'クーポン :');
  define('CART_COUPON_INFO', 'さらに詳しく');
  define('TEXT_SEND_OR_SPEND','お客様の' . TEXT_GV_NAME . 'アカウントに残高があります。 お使いいただくことも、どなたかに送ることもできます。送る場合は下記のボタンをクリックしてください。');
  define('TEXT_BALANCE_IS', 'お客様の' . TEXT_GV_NAME . '残高: ');
  define('TEXT_AVAILABLE_BALANCE', 'お客様の' . TEXT_GV_NAME . 'アカウント');

// payment method is GV/Discount
  define('PAYMENT_METHOD_GV', 'ギフト券/クーポン');
  define('PAYMENT_MODULE_GV', 'GV/DC');

  define('TABLE_HEADING_CREDIT_PAYMENT', 'ご利用可能なクレジットカード');

  define('TEXT_INVALID_REDEEM_COUPON', '無効なクーポンコードです');
  define('TEXT_INVALID_REDEEM_COUPON_MINIMUM', 'このクーポンは %s 円以上のお買い物でご利用いただけます');
  define('TEXT_INVALID_STARTDATE_COUPON', 'このクーポンはまだお使いいただけません');
  define('TEXT_INVALID_FINISDATE_COUPON', 'このクーポンは有効期限が切れています');
  define('TEXT_INVALID_USES_COUPON', 'このクーポンは全てのお客様のご利用回数の合計で最大 ');
  define('TIMES', '回 までのご利用になっております。');
  define('TIME', ' 回 までのご利用になっております。');
  define('TEXT_INVALID_USES_USER_COUPON', 'クーポンコード: %s は既に最大使用回数に達しています。このクーポンはお客様ごとに最大 ');
  define('REDEEMED_COUPON', '割引額 ');
  define('REDEEMED_MIN_ORDER', '円以上のご注文');
  define('REDEEMED_RESTRICTIONS', ' [商品カテゴリが限定されます]');
  define('TEXT_ERROR', 'エラーがおこりました');
  define('TEXT_INVALID_COUPON_PRODUCT', '現在カートに入っている商品でこのクーポンコードをお使いいただけるものがありません');
  define('TEXT_VALID_COUPON', '割引クーポンを引き換えました');

// more info in place of buy now
  define('MORE_INFO_TEXT','...詳細');

// IP Address
  define('TEXT_YOUR_IP_ADDRESS','IPアドレス: ');

//Generic Address Heading
  define('HEADING_ADDRESS_INFORMATION','アドレス情報');

// cart contents
  define('PRODUCTS_ORDER_QTY_TEXT_IN_CART','カート内の数量: ');
  define('PRODUCTS_ORDER_QTY_TEXT','カートに入れる: ');

  define('TEXT_PRODUCT_WEIGHT_UNIT','kg');

// Shipping
  define('TEXT_SHIPPING_WEIGHT','kg');
  define('TEXT_SHIPPING_BOXES', '個口');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','割引:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','%OFF');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;OFF');

// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','特価:&nbsp;');

//universal symbols
  define('TEXT_NUMBER_SYMBOL', '# ');

// banner_box
  define('BOX_HEADING_BANNER_BOX','スポンサー');
  define('TEXT_BANNER_BOX','当ショップのスポンサーにもお立ち寄りください。');

// banner box 2
  define('BOX_HEADING_BANNER_BOX2','ご存じですか?');
  define('TEXT_BANNER_BOX2','是非チェックしてください!');

// banner_box - all
  define('BOX_HEADING_BANNER_BOX_ALL','スポンサー');
  define('TEXT_BANNER_BOX_ALL','当ショップのスポンサーにもお立ち寄りください。');

// boxes defines
  define('PULL_DOWN_ALL','選択してください');
  define('PULL_DOWN_MANUFACTURERS','- リセット -');
// shipping estimator
  define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', '選択してください');

// general Sort By
  define('TEXT_INFO_SORT_BY','表示順: ');

// close window image popups
  define('TEXT_CLOSE_WINDOW',' - ウインドウを閉じる');
// close popups
  define('TEXT_CURRENT_CLOSE_WINDOW','[ ウィンドウを閉じる ]');

// iii 031104 added:  File upload error strings
  define('ERROR_FILETYPE_NOT_ALLOWED', 'エラー: このファイルタイプは許可されていません');
  define('WARNING_NO_FILE_UPLOADED', '警告:  何もアップロードされていません');
  define('SUCCESS_FILE_SAVED_SUCCESSFULLY', '成功:  ファイルが保存されました');
  define('ERROR_FILE_NOT_SAVED', 'エラー:  ファイルが保存されていません');
  define('ERROR_DESTINATION_NOT_WRITEABLE', 'エラー:  保存ディレクトリが書き込み可能になっていません');
  define('ERROR_DESTINATION_DOES_NOT_EXIST', 'エラー: 保存ディレクトリが存在しません');
// End iii added

  define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'お知らせ: メンテナンス作業のためまもなくサイトを休止いたします。　予定日時：');
  define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'お知らせ: ただいまメンテナンス作業のためサイトを休止しています。');

  define('PRODUCTS_PRICE_IS_FREE_TEXT','無料です!');
  define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT','価格お問い合わせ');
  define('TEXT_CALL_FOR_PRICE','価格お問い合わせ商品');

  define('TEXT_INVALID_SELECTION',' 選択は無効です。:  ');
  define('TEXT_ERROR_OPTION_FOR',' オプション: ');
  define('TEXT_INVALID_USER_INPUT', '入力してください<br />');

// product_listing
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','最小:');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','購入単位:');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','カートの内容:');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','追加する:');

  define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING','最大:');

  define('TEXT_PRODUCTS_MIX_OFF','*オプション複合不可');
  define('TEXT_PRODUCTS_MIX_ON','オプション複合可');

  define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','*単位内オプション複合不可<br />');
  define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART','*単位内オプション複合可<br />');

  define('ERROR_MAXIMUM_QTY','数量を変更しました - 一度にお求めいただける最大数がカートに入っています ');
  define('ERROR_CORRECTIONS_HEADING','こちらを修正してください: <br />');

// Downloads Controller
  define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG','注意:お支払いが完了するまで商品のダウンロードはできません。');
  define('TEXT_FILESIZE_BYTES', ' bytes');
  define('TEXT_FILESIZE_MEGS', ' MB');

// shopping cart errors
  define('ERROR_PRODUCT','商品名: ');
  define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br />あいにくこの商品は現在取り扱っておりません。<br />ショッピングカートから取り除かせていただきました。');
  define('ERROR_PRODUCT_QUANTITY_MIN',' ... 最小個数エラー - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS',' ... 購入単位エラー - ');
  define('ERROR_PRODUCT_OPTION_SELECTION','<br /> ... 無効なオプションが選択されています ');
  define('ERROR_PRODUCT_QUANTITY_ORDERED','<br /> ご注文数量: ');
  define('ERROR_PRODUCT_QUANTITY_MAX',' ... 最大個数エラー - ');
  define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART',' ... 最小個数エラー - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART',' ... 購入単位エラー - ');
  define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... 最大個数エラー - ');

  define('TABLE_HEADING_FEATURED_PRODUCTS','おすすめ商品');

  define('TABLE_HEADING_NEW_PRODUCTS', '%sの新着商品');
  define('TABLE_HEADING_UPCOMING_PRODUCTS', '入荷予定商品');
  define('TABLE_HEADING_DATE_EXPECTED', '予定日');
  define('TABLE_HEADING_SPECIALS_INDEX', '%s: 今月の特価品');

// meta tags special defines
  define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','無料!');

// customer login
  define('TEXT_SHOWCASE_ONLY','お問い合わせ');
// set for login for prices
  define('TEXT_LOGIN_FOR_PRICE_PRICE','価格はログイン後');
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE','価格をご覧になるにはログインしてください');
// set for show room only
  define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', ''); 
// blank for prices or enter your own text
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM','閲覧のみ');

// authorization pending
  define('TEXT_AUTHORIZATION_PENDING_PRICE', '価格はログイン後');
  define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', '承認手続き中');
  define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','ログイン');

// text pricing
  define('TEXT_CHARGES_WORD','金額の計算結果:');
  define('TEXT_PER_WORD','<br />1つの語句につき: ');
  define('TEXT_WORDS_FREE',' 無料語数 ');
  define('TEXT_CHARGES_LETTERS','金額の計算結果:');
  define('TEXT_PER_LETTER','<br />1文字につき: ');
  define('TEXT_LETTERS_FREE',' 無料文字数');
  define('TEXT_ONETIME_CHARGES','*基本料 = ');
  define('TEXT_ONETIME_CHARGES_EMAIL',"?t" . '*基本料 = ');
  define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', '数量値引');
  define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','数量');
  define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','金額');
  define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', '基本数量値引');

// textarea attribute input fields
  define('TEXT_MAXIMUM_CHARACTERS_ALLOWED',' 最大文字数');
  define('TEXT_REMAINING','残り');

// Shipping Estimator
  define('CART_SHIPPING_OPTIONS', '送料計算');
  define('CART_SHIPPING_OPTIONS_LOGIN', '送料を表示するには<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">ログイン</span></a>してください');
  define('CART_SHIPPING_METHOD_TEXT', '配送方法');
  define('CART_SHIPPING_METHOD_RATES', '料金');
  define('CART_SHIPPING_METHOD_TO','配送先: ');
  define('CART_SHIPPING_METHOD_TO_NOLOGIN', '配送先: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">ログイン</span></a>');
  define('CART_SHIPPING_METHOD_FREE_TEXT','配送料無料');
  define('CART_SHIPPING_METHOD_ALL_DOWNLOADS','- ダウンロード');
  define('CART_SHIPPING_METHOD_RECALCULATE','再計算');
  define('CART_SHIPPING_METHOD_ZIP_REQUIRED','true');
  define('CART_SHIPPING_METHOD_ADDRESS','ご住所:');
  define('CART_OT','合計金額お見積もり:');
  define('CART_OT_SHOW','true'); // set to false if you don't want order totals
  define('CART_ITEMS','カートの中身: ');
  define('CART_SELECT','選択');
  define('ERROR_CART_UPDATE', 'ご注文内容を更新してください ...<br />');
  define('IMAGE_BUTTON_UPDATE_CART', 'カートの内容を更新');

// multiple product add to cart
  define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', '追加: ');
  define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', '追加: ');
  define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', '追加: ');
  define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', '追加: ');
  //moved SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART to button_names.php as BUTTON_ADD_PRODUCTS_TO_CART_ALT

// discount qty table
  define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', '数量割引価格');
  define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', '数量割引適用後価格');
  define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', '数量割引価格');
  define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* 割引は表記オプションにより異なります');
  define('TEXT_HEADER_DISCOUNTS_OFF', '数量割引はご利用いただけません...');

// sort order titles for dropdowns
  define('PULL_DOWN_ALL_RESET','- リセット - ');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', '商品名');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', '商品名 - 降順');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', '価格 - 低〜高');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', '価格 - 高〜低');
  define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', 'モデル');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', '登録日 - 新〜旧');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', '登録日 - 旧〜新');
  define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', '既定の表示');

// downloads module defines
  define('TABLE_HEADING_DOWNLOAD_DATE', 'リンク有効期限');
  define('TABLE_HEADING_DOWNLOAD_COUNT', '残り');
  define('HEADING_DOWNLOAD', 'ファイルをダウンロードするにはダウンロードボタンを押してポップアップメニューから「ディスクに保存」を選択してください。');
  define('TABLE_HEADING_DOWNLOAD_FILENAME','ファイル名');
  define('TABLE_HEADING_PRODUCT_NAME','品名');
  define('TABLE_HEADING_BYTE_SIZE','ファイルサイズ');
  define('TEXT_DOWNLOADS_UNLIMITED', '無制限');
  define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc
  define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
  define('TABLE_HEADING_QUANTITY', '数量.');
  define('TABLE_HEADING_PRODUCTS', '品名');
  define('TABLE_HEADING_TOTAL', '合計');

// create account - login shared
  define('TABLE_HEADING_PRIVACY_CONDITIONS', '個人情報保護方針');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '弊社の個人情報保護方針に同意される場合はチェックボックスをクリックしてください。個人情報保護方針は<a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">こちら</span></a>。');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '個人情報保護方針に同意します');
  define('TABLE_HEADING_ADDRESS_DETAILS', '住所');
  define('TABLE_HEADING_PHONE_FAX_DETAILS', '連絡先');
  define('TABLE_HEADING_DATE_OF_BIRTH', '年齢の確認');
  define('TABLE_HEADING_LOGIN_DETAILS', 'ログイン');
  define('TABLE_HEADING_REFERRAL_DETAILS', '紹介ですか?');

  define('ENTRY_EMAIL_PREFERENCE','ニュースレターおよびEメールについて');
  define('ENTRY_EMAIL_HTML_DISPLAY','HTML形式');
  define('ENTRY_EMAIL_TEXT_DISPLAY','テキスト形式');
  define('EMAIL_SEND_FAILED','エラー: Eメールの送信に失敗しました。宛先: "%s" <%s> 件名: "%s"');

  define('DB_ERROR_NOT_CONNECTED', 'エラー - データベースに接続できません');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', '警告: EZ-PAGES ヘッダー - 管理者IPだけに表示');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', '警告: EZ-PAGES フッター - 管理者IPだけに表示');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', '警告: EZ-PAGES サイドボックス - 管理者IPだけに表示');


///////////////////////////////////////////////////////////
// include email extras
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_EMAIL_EXTRAS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_EMAIL_EXTRAS);

// include template specific header defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_HEADER)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_HEADER);

// include template specific button name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_BUTTON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_BUTTON_NAMES);

// include template specific icon name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_ICON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_ICON_NAMES);

// include template specific other image name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_OTHER_IMAGES_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_OTHER_IMAGES_NAMES);

// credit cards
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_CREDIT_CARDS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select. FILENAME_CREDIT_CARDS);

// include template specific whos_online sidebox defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_WHOS_ONLINE . '.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_WHOS_ONLINE . '.php');

// include template specific meta tags defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// END OF EXTERNAL LANGUAGE LINKS
?>
