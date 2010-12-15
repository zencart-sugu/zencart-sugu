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
//  $Id: blocks.php $
//

define('HEADING_TITLE', 'ブロックの設定');

define('TABLE_HEADING_BOX_NAME', 'ボックス名');
define('TABLE_HEADING_BLOCK_NAME', 'ブロック名');
define('TABLE_HEADING_BOX', 'ボックスファイル');
define('TABLE_HEADING_MODULE', 'モジュール');
define('TABLE_HEADING_BLOCK', 'ブロックメソッド');
define('TABLE_HEADING_STATUS', 'ステータス');
define('TABLE_HEADING_LOCATION', '表示位置');
define('TABLE_HEADING_SORT_ORDER', '整列順');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_INFO_EDIT_INTRO', '必要な変更を行ってください。');
define('TEXT_INFO_MODULE_NAME', 'モジュール名: ');

define('TEXT_INFO_BOX','選択中のボックス: ');
define('TEXT_INFO_BOX_NAME', 'ボックス名:');
define('TEXT_INFO_BOX_LOCATION','表示位置: ');
define('TEXT_INFO_BOX_STATUS', 'ボックス ステータス: ');
define('TEXT_INFO_BOX_STATUS_INFO','ON= 1 OFF=0');
define('TEXT_INFO_BOX_SORT_ORDER', '整列順:');
define('TEXT_INFO_BOX_VISIBLE', 'ページ毎の表示/非表示: ');
define('TEXT_INFO_BOX_PAGES', 'ページ: ');
define('TEXT_INFO_INSERT_BOX_INTRO', '新しいボックスのデータを入力してください。');
define('TEXT_INFO_DELETE_BOX_INTRO', 'このボックスを本当に削除しますか?');
define('TEXT_INFO_HEADING_NEW_BOX', '新しいボックス');
define('TEXT_INFO_HEADING_EDIT_BOX', 'ボックスを編集');
define('TEXT_INFO_HEADING_DELETE_BOX', 'ボックスを削除');
define('TEXT_INFO_DELETE_MISSING_BOX','テンプレートリストから不明のボックスを削除: ');
define('TEXT_INFO_DELETE_MISSING_BOX_NOTE','ノート: ファイル自体は削除されません。ファイルをディレクトリに追加するとボックスを再度追加することができます。<br /><br /><strong>削除するボックス: </strong>');
define('TEXT_INFO_BOX_DETAILS','ボックス詳細: ');

define('TEXT_INFO_BLOCK', '選択中のブロック: ');
define('TEXT_INFO_BLOCK_NAME', 'ブロック名: ');
define('TEXT_INFO_BLOCK_LOCATION', '表示位置: ');
define('TEXT_INFO_BLOCK_STATUS', 'ブロック ステータス: ');
define('TEXT_INFO_BLOCK_STATUS_INFO', 'ON= 1 OFF=0');
define('TEXT_INFO_BLOCK_SORT_ORDER', '整列順: ');
define('TEXT_INFO_BLOCK_VISIBLE', 'ページ毎の表示/非表示: ');
define('TEXT_INFO_BLOCK_PAGES', 'ページ: ');
define('TEXT_CHECK_ALL', '全て');
define('TEXT_INFO_INSERT_BLOCK_INTRO', '新しいブロックのデータを入力してください。');
define('TEXT_INFO_DELETE_BLOCK_INTRO', 'このブロックを本当に削除しますか?');
define('TEXT_INFO_HEADING_NEW_BLOCK', '新しいブロック');
define('TEXT_INFO_HEADING_EDIT_BLOCK', 'ブロックを編集');
define('TEXT_INFO_HEADING_DELETE_BLOCK', 'ブロックを削除');
define('TEXT_INFO_DELETE_MISSING_BLOCK', 'テンプレートリストから不明のブロックを削除: ');
define('TEXT_INFO_DELETE_MISSING_BLOCK_NOTE', 'ノート: モジュール自体は削除されません。モジュールをインストールして有効化するとブロックを再度追加することができます。<br /><br /><strong>削除するブロック: </strong>');
define('TEXT_INFO_BLOCK_DETAILS', 'ブロック詳細: ');

////////////////

// file exists
define('TEXT_GOOD_BLOCK', ' ');
define('TEXT_BAD_BLOCK', '<font color="ff0000"><b>MISSING!!</b></font><br />');


// Success message
define('SUCCESS_BLOCK_DELETED', 'ブロックテンプレートの削除に成功しました。: ');
define('SUCCESS_BLOCK_RESET', 'ブロックテンプレートをデフォルトの設定に戻しました。: ');
define('SUCCESS_BLOCK_UPDATED', 'ブロック設定の更新に成功しました。: ');
define('SUCCESS_BLOCKS_UPDATED', 'ブロック設定の更新に成功しました。');

define('TEXT_ON', ' ON ');
define('TEXT_OFF', ' OFF ');
define('TEXT_VISIBLE_PAGES', '以下のページのみ表示');
define('TEXT_INVISIBLE_PAGES', '以下のページのみ非表示');

define('TEXT_NO_LAYOUT_LOCATIONS', 'レイアウト表示位置が定義されていません。');

// box names
define('BOXNAME_BANNER_BOX', 'バナー');
define('BOXNAME_BANNER_BOX2', 'バナー2');
define('BOXNAME_BANNER_BOX_ALL', 'バナーALL');
define('BOXNAME_BEST_SELLERS', 'ベストセラー');
define('BOXNAME_CATEGORIES', 'カテゴリ');
define('BOXNAME_CURRENCIES', '通貨');
define('BOXNAME_DOCUMENT_CATEGORIES', '書類');
define('BOXNAME_EZPAGES', '重要なリンク');
define('BOXNAME_FEATURED', 'おすすめ');
define('BOXNAME_INFORMATION', 'インフォメーション');
define('BOXNAME_LANGUAGES', '言語');
define('BOXNAME_MANUFACTURER_INFO', '商品情報');
define('BOXNAME_MANUFACTURERS', 'メーカー');
define('BOXNAME_MORE_INFORMATION', '追加情報');
define('BOXNAME_MUSIC_GENRES', '音楽ジャンル');
define('BOXNAME_ORDER_HISTORY', '最近のご注文');
define('BOXNAME_PRODUCT_NOTIFICATIONS', 'お知らせメール');
define('BOXNAME_RECORD_COMPANIES', 'レコード会社');
define('BOXNAME_REVIEWS', 'レビュー');
define('BOXNAME_SEARCH', '商品検索');
define('BOXNAME_SEARCH_HEADER', '商品検索 (ヘッダー)');
define('BOXNAME_SHOPPING_CART', 'ショッピングカート');
define('BOXNAME_SPECIALS', '特価商品');
define('BOXNAME_TELL_A_FRIEND', '友達に知らせる');
define('BOXNAME_WHATS_NEW', '新着商品');
define('BOXNAME_WHOS_ONLINE', 'オンラインのお客様');

// page names
define('PAGENAME_ACCOUNT', 'マイページ');
define('PAGENAME_ACCOUNT_EDIT', '登録情報変更');
define('PAGENAME_ACCOUNT_HISTORY', 'ご注文履歴');
define('PAGENAME_ACCOUNT_HISTORY_INFO', 'ご注文情報');
define('PAGENAME_ACCOUNT_NEWSLETTERS', 'ニュースレター購読');
define('PAGENAME_ACCOUNT_NOTIFICATIONS', 'お知らせメール購読');
define('PAGENAME_ACCOUNT_PASSWORD', 'パスワード変更');
define('PAGENAME_ADDRESS_BOOK', 'アドレス帳');
define('PAGENAME_ADDRESS_BOOK_PROCESS', '住所');
define('PAGENAME_ADVANCED_SEARCH', '検索結果');
define('PAGENAME_ADVANCED_SEARCH_RESULT', '詳細検索');
define('PAGENAME_CHECKOUT_CONFIRMATION', 'ご注文内容を確認してください');
define('PAGENAME_CHECKOUT_PAYMENT', 'お支払い情報を記入してください');
define('PAGENAME_CHECKOUT_PAYMENT_ADDRESS', '請求先住所を変更してください');
define('PAGENAME_CHECKOUT_SHIPPING', 'お届け先と配送方法を記入してください');
define('PAGENAME_CHECKOUT_SHIPPING_ADDRESS', 'お届け先住所を変更してください');
define('PAGENAME_CHECKOUT_SUCCESS', 'ご注文の手続きが完了しました。');
define('PAGENAME_CONDITIONS', 'ご利用規約');
define('PAGENAME_CONTACT_US', 'お問い合わせ');
define('PAGENAME_COOKIE_USAGE', 'クッキー(Cookie)の使用について');
define('PAGENAME_CREATE_ACCOUNT', 'アカウント作成');
define('PAGENAME_CREATE_ACCOUNT_SUCCESS', 'お客様のアカウントを作成いたしました。');
define('PAGENAME_CUSTOMERS_AUTHORIZATION', '承認手続き中 ...');
define('PAGENAME_DISCOUNT_COUPON', '割引クーポン');
define('PAGENAME_DOCUMENT_GENERAL_INFO', '書類詳細 (通常)');
define('PAGENAME_DOCUMENT_PRODUCT_INFO', '書類詳細 (商品)');
define('PAGENAME_DOWN_FOR_MAINTENANCE', 'メンテナンス中...');
define('PAGENAME_DOWNLOAD_TIME_OUT', 'ダウンロード ...');
define('PAGENAME_FEATURED_PRODUCTS', 'おすすめ商品');
define('PAGENAME_GV_FAQ', 'ギフト券についてよくある質問と答え');
define('PAGENAME_GV_REDEEM', 'ギフト券引き換え');
define('PAGENAME_GV_SEND', 'ギフト券送信');
define('PAGENAME_INDEX', 'トップページ');
define('PAGENAME_INDEX_CATEGORIES', 'カテゴリーサブカテゴリ一覧ページ');
define('PAGENAME_INDEX_PRODUCTS', 'カテゴリー商品一覧ページ');
define('PAGENAME_INFO_SHOPPING_CART', 'ビジターズカート / メンバーズカート');
define('PAGENAME_LOGIN', 'ログイン');
define('PAGENAME_LOGOFF', 'ログアウト');
define('PAGENAME_PAGE', 'EZページ');
define('PAGENAME_PAGE_2', 'ページ2');
define('PAGENAME_PAGE_3', 'ページ3');
define('PAGENAME_PAGE_4', 'ページ4');
define('PAGENAME_PAGE_NOT_FOUND', 'ページが見つかりません');
define('PAGENAME_PASSWORD_FORGOTTEN', 'パスワードをお忘れですか?');
define('PAGENAME_PRIVACY', '個人情報保護方針');
define('PAGENAME_PRODUCT_FREE_SHIPPING_INFO', '商品詳細 (無料配送)');
define('PAGENAME_PRODUCT_INFO', '商品詳細 (通常)');
define('PAGENAME_PRODUCT_MUSIC_INFO', '商品詳細 (音楽)');
define('PAGENAME_PRODUCT_REVIEWS', 'レビュー');
define('PAGENAME_PRODUCT_REVIEWS_INFO', 'レビュー');
define('PAGENAME_PRODUCT_REVIEWS_WRITE', 'レビュー');
define('PAGENAME_PRODUCTS_ALL', '全商品');
define('PAGENAME_PRODUCTS_NEW', '新着商品');
define('PAGENAME_REVIEWS', 'レビュー');
define('PAGENAME_SHIPPINGINFO', '配送と返品について');
define('PAGENAME_SHOPPING_CART', 'カートの内容');
define('PAGENAME_SITE_MAP', 'サイトマップ');
define('PAGENAME_SPECIALS', '特価商品');
define('PAGENAME_SSL_CHECK', 'セキュリティチェック');
define('PAGENAME_TELL_A_FRIEND', '商品について友達に教える');
define('PAGENAME_TIME_OUT', '接続を切断させていただきました');
define('PAGENAME_UNSUBSCRIBE', 'ニュースレター配信停止');
