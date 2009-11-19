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
// $Id: japanese.php $
//
define('MODULE_REVIEWS_TITLE', '商品レビュー');
define('MODULE_REVIEWS_DESCRIPTION', '商品レビュー');
define('MODULE_REVIEWS_STATUS_TITLE', '商品レビューの有効化');
define('MODULE_REVIEWS_STATUS_DESCRIPTION', '商品レビューを有効にしますか？ <br />true: 有効<br />false: 無効');
define('MODULE_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_TITLE', '商品詳細ページ　レビュー表示数');
define('MODULE_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_DESCRIPTION', '商品詳細ページで表示される商品レビューの数を設定してください。<br />商品レビュー一覧ページのレビュー数は「一般設定」-「最大値の設定」-「新しいレビューの表示数最大値」で設定してください。');
define('MODULE_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_TITLE', '非ログインユーザーの商品レビュー閲覧禁止');
define('MODULE_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_DESCRIPTION', 'ログインしていないユーザーは商品レビュー閲覧ができない。');
define('MODULE_REVIEWS_SORT_ORDER_TITLE', '優先順');
define('MODULE_REVIEWS_SORT_ORDER_DESCRIPTION', 'モジュールの優先順を設定できます。数字が小さいほど先にモジュールの読み込みと処理が実行されます。半角数字で他のモジュールと重ならないように設定してください。');

define('MODULE_REVIEWS_BLOCK_TITLE', '商品レビュー');
define('MODULE_REVIEWS_TITLE', '商品レビュー');

define('MODULE_REVIEWS_NAVBAR_TITLE', 'レビュー');

define('SUB_TITLE_FROM', '投稿者:');
define('SUB_TITLE_REVIEW', '是非お客様のご意見、ご感想をお聞かせください。他のお客様の参考にもなります。この商品に焦点を絞ったコメントをよろしくお願いいたします。');
define('SUB_TITLE_RATING', 'この商品のランキングを選んで下さい。１つ星が最悪で５つ星が最高です。');

define('TEXT_NO_HTML', '<strong>注意:</strong>  HTMLタグは使用できません。');
define('TEXT_BAD', '最悪');
define('TEXT_GOOD', '最高');
define('TEXT_PRODUCT_INFO', '');

define('TEXT_APPROVAL_REQUIRED', '<strong>注意:</strong>  ご投稿いただいたレビューはショップ管理者が確認させていただいた後に掲載されます。');

define('EMAIL_REVIEW_PENDING_SUBJECT','承認待ちのレビュー: %s');
define('EMAIL_PRODUCT_REVIEW_CONTENT_INTRO','%sについてのレビューが投稿され承認待ちです。'."\n\n");
define('EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS','レビューの内容: %s');


define('VIEW_ALL_REVIEWS', 'すべてのレビューを見る');
?>